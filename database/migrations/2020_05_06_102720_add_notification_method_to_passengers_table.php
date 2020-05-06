<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationMethodToPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->tinyInteger('sms_notification')->default(0)->after('company_id');
            $table->tinyInteger('email_notification')->default(0)->after('company_id');
            $table->tinyInteger('lang')->default(0)->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->dropColumn('sms_notification');
            $table->dropColumn('email_notification');
            $table->dropColumn('lang');
        });
    }
}
