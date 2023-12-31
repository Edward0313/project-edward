<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\OrderByShippedSheet;

class OrderMultipleExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];
        foreach([true, false] as $isShipped){
            $sheets[] = new OrderByShippedSheet($isShipped);
        }
        return $sheets;
    }

}
