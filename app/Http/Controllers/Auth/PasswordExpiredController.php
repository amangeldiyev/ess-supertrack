<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordExpiredController extends Controller
{
    public function expired()
    {
        return view('concept.auth.password-expired');
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'different:current_password',
                'string',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        $user = $request->user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }

        // Deny usage of old password
        foreach (DB::table('old_passwords')->where('user_id', $user->id)->get() as $password) {
            if (Hash::check($request->password, $password->hash)) {
                return redirect()->back()->withErrors(['password' => 'You can\'t use old password']);
            }
        }

        // Save old password
        DB::table('old_passwords')->insert([
            'user_id' => $user->id,
            'hash' => $user->password,
            'created_at' => Carbon::now()
        ]);

        // Delete if older passwords
        if ($count = DB::table('old_passwords')->where('user_id', $user->id)->offset(8)->get()->count()) {
            DB::table('old_passwords')->where('user_id', $user->id)->take($count)->delete();
        }

        $user->update([
            'password' => bcrypt($request->password),
            'password_changed_at' => Carbon::now()
        ]);
        
        return redirect()->route('home');
    }
}
