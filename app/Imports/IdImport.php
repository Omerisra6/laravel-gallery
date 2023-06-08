<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;

class IdImport implements OnEachRow, WithStartRow
{
    public $ids;

    public function __construct()
    {
        $this->ids = collect([]);
    }

    public function onRow(Row $row)
    {
        $driveUrl = $row[ 7 ];
        $urlParts = explode('/', $driveUrl);

        $id = 0;
        if (count($urlParts) > 5) {
            $id = $urlParts[ 5 ];
        }

        $this->ids->push($id);
    }

    public function startRow(): int
    {
        return 2;
    }

}
