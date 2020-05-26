<?php

namespace App\Imports;

use App\Vehicle;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehiclesImport implements ToModel, WithHeadingRow
{
    public function __construct(int $company_id)
    {
        $this->company_id = $company_id;
    }

    /**
    * @param array $collection
    */
    public function model(array $row)
    {
        if (isset($row['name'])) {
            return new Vehicle([
                'name' => $row['name'],
                'type' => $row['type'],
                'company_id' => $this->company_id,
                'created_at' => Carbon::now()
            ]);
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
