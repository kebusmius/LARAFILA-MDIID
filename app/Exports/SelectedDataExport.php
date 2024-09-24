<?php

namespace App\Exports;

use App\Models\Esmdiid;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SelectedDataExport implements FromCollection, WithHeadings
{
    protected $records;

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function headings(): array
    {
        return [
            'No MDIID',
            'Nama Perusahaan',
            'Total',
            'PPH',
        ];
    }
}
