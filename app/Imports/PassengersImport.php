<?php

namespace App\Imports;

use App\Passenger;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PassengersImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
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
