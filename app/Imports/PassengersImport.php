<?php

namespace App\Imports;

use App\Passenger;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PassengersImport implements ToCollection, WithHeadingRow
{
    public function __construct(int $company_id)
    {
        $this->company_id = $company_id;
    }

    /**
    * @param Collection $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        try {

            DB::table('passengers')->update(['deleted' => 1]);

            $data = [];
        
            foreach ($rows as $key =>$row) {

                if (!$row['badge']) {
                    break;
                }

                $data[] = [
                    'badge_number' => $row['badge'],
                    'name' => $row['name'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                    'company_id' => $this->company_id,
                    'email_notification' => 1,
                    'deleted' => 0
                ];
                
                if ($key % 1000 == 1) {
    
                    DB::beginTransaction();
        
                    DB::table('passengers')->upsert(
                        $data,
                        'badge_number',
                        ['name', 'phone', 'email', 'deleted']
                    );
        
                    DB::commit();
    
                    $data = [];
                }
            }

            DB::beginTransaction();

            DB::table('passengers')->upsert(
                $data,
                'badge_number',
                ['name', 'phone', 'email', 'deleted']
            );

            DB::commit();

        } catch (\Throwable $th) {
            info($th);
            DB::rollback();
        }
    }

    /**
     * Set Heading Row
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
}
