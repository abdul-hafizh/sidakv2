<?php

namespace App\Imports;

use App\Models\PaguTarget;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PaguTargetImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PaguTarget([
            //
            'nama_daerah'     => $row[1],
            'daerah_id'    => $row[2],
            'type_daerah' => $row[3],
            'periode_id' => $row[4],
            'pagu_apbn' => $row[5],
            'pagu_pengawasan' => $row[6],
            'pagu_penyelesaian_permasalahan' => $row[7],
            'pagu_bimbingan_teknis' => $row[8],
            'pagu_promosi' => $row[9],
            'pagu_dalak' => $row[10],
            'target_pengawasan' => $row[11],
            'target_penyelesaian_permasalahan' => $row[12],
            'target_bimbingan_teknis' => $row[13],
            'target_video_promosi' => $row[14],

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
