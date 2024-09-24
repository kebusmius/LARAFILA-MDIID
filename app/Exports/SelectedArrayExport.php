<?php

namespace App\Exports;

use App\Models\Esmdiid;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SelectedArrayExport implements FromArray, WithHeadings
{
    protected $records;

    public function __construct(array $records)
    {
        $this->records = $records;
    }

    public function array(): array
    {
        return $this->records;
    }

    public function headings(): array
    {
        return [
            // 'No Account',
            // 'Nama Perusahaan',
            // 'No Customer',
        ];
    }
}
