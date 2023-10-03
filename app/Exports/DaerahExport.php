<?php

namespace App\Exports;

use App\Models\Provinces;
use App\Models\Regencies;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DaerahExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $province = Provinces::select('id as value', 'name as text');
        $regency = Regencies::select('id as value', 'name as text')->union($province)->orderBy('value', 'ASC')->get();
        return $regency;
    }
    public function headings(): array
    {
        return ["id", "Nama"];
    }
}
