<?php

namespace App\Imports;

use App\Models\Bimsos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BimsosImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Bimsos([
            //
            'nama_daerah'     => $row[1],
            'daerah_id'    => $row[2],
            'type_daerah' => $row[3],
            'periode_id' => $row[4],
            'pagu_apbn' => $row[5],
            'pagu_promosi' => $row[6],
            'pagu_dalak' => $row[7],
            'target_pengawasan' => $row[8],
            'target_penyelesaian_permasalahan' => $row[9],
            'target_bimbingan_teknis' => $row[10],
            'target_video_promosi' => $row[11],

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
