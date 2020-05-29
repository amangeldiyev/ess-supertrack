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
        
            foreach ($rows as $key => $row) {
                if (!$row['badge']) {
                    break;
                }

                $data[] = [
                    'badge_number' => trim(pg_escape_string($row['badge'])),
                    'name' => trim(pg_escape_string($row['name'])),
                    'phone' => trim(pg_escape_string($row['phone'])),
                    'email' => trim(pg_escape_string($row['email'])),
                    'company_id' => $this->company_id,
                    'email_notification' => 1,
                    'deleted' => 0
                ];
                
                if ($key && $key % 1000 == 0) {
                    DB::table('passengers')->upsert(
                        $data,
                        'badge_number',
                        ['name', 'phone', 'email', 'deleted']
                    );
    
                    $data = [];
                }
            }

            DB::table('passengers')->upsert(
                $data,
                'badge_number',
                ['name', 'phone', 'email', 'deleted']
            );
        } catch (\Throwable $th) {
            info($th);
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
