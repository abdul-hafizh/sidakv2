<div style="margin: 0; padding: 0;">
    <div style="margin: 0;">
        <div style="text-align:center;">
          <h4 style="font-size: 14px; margin: 0;">LAPORAN RENCANA PENGGUNAAN DAK NONFISIK FASILITASI PENANAMAN MODAL </h4>
          <h4 style="font-size: 14px; margin: 0;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU </h4>
          <h4 style="font-size: 14px; text-transform: uppercase; margin: 0;">{{ $rows->nama_daerah }}</h4>
          <h4 style="font-size: 14px; margin: 0;">TAHUN ANGGARAN {{ $rows->periode_id }}</h4>
        </div>

        <table border="0" style="font-size: 13px; margin-top: 40px">
          <thead style="border-top: 1px solid #000;text-align: center;">
            <tr>
              <th rowspan="2" style="text-align: center;padding: 5px 10px;border-left: 1px solid #000;border-bottom: 1px solid #000;">No</th>
              <th rowspan="2" colspan="2" style="text-align: center;padding: 5px 10px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Kegiatan/Sub Kegiatan</th>
              <th colspan="2" style="text-align: center;padding: 5px 10px 10px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Perencanaan</th>
              <th rowspan="2" colspan="2" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000;">Pagu APBN (Rp)</th>
            </tr>
            <tr style="text-align: center;padding: 5px 10px;border-right: 1px solid #000;border-left: 1px solid #000;border-bottom: 1px solid #000;">
              <th style="text-align: center;padding: 5px 10px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Jumlah</th>
              <th style="text-align: center;padding: 5px 10px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Satuan</th>
            </tr>
          </thead>          
          <tbody>
            <tr style="border-bottom: 1px solid #000;">
              <td rowspan="4" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">1.</td>
              <td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Pengawasan Penanaman Modal</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->pengawas_analisa_target + $rows->pengawas_inspeksi_target + $rows->pengawas_evaluasi_target }}</td>
              <td width="110" style="text-align: center;padding: 10px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Kegiatan Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: cpx 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->pengawas_analisa_pagu + $rows->pengawas_inspeksi_pagu + $rows->pengawas_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">a.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Analisa dan verifikasi data, profil dan informasi kegiatan usaha dari Pelaku Usaha</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->pengawas_analisa_target }}</td>
              <td width="110" style="text-align: center;border-left: 1px solid #000;border-bottom: 1px solid #000;padding: 10px 0px;">Kegiatan Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->pengawas_analisa_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">b.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Inspeksi Lapangan</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->pengawas_inspeksi_target }}</td>
              <td width="110" style="text-align: center;padding: vpx 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Kegiatan Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->pengawas_inspeksi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">c.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->pengawas_evaluasi_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Pelaku Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->pengawas_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td rowspan="3" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">2.</td>
              <td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Bimbingan Teknis kepada Pelaku Usaha</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->bimtek_perizinan_target + $rows->bimtek_pengawasan_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Pelaku Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->bimtek_perizinan_pagu + $rows->bimtek_pengawasan_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">a.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->bimtek_perizinan_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Pelaku Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->bimtek_perizinan_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">b.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->bimtek_pengawasan_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Pelaku Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->bimtek_pengawasan_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td rowspan="4" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">3.</td>
              <td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> {{ $rows->penyelesaian_identifikasi_target + $rows->penyelesaian_realisasi_target + $rows->penyelesaian_evaluasi_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Kegiatan Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->penyelesaian_identifikasi_pagu + $rows->penyelesaian_realisasi_pagu + $rows->penyelesaian_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">a.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Identifikasi Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->penyelesaian_identifikasi_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Kegiatan Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->penyelesaian_identifikasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">b.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->penyelesaian_realisasi_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Kegiatan Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->penyelesaian_realisasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">c.</td>
              <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Evaluasi Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya Perizinan Berusaha Para Pelaku Usaha</td>
              <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">{{ $rows->penyelesaian_evaluasi_target }}</td>
              <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;">Kegiatan Usaha</td>
              <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;border-bottom: 1px solid #000;"> Rp. </td>
              <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;border-bottom: 1px solid #000;">{{ number_format($rows->penyelesaian_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>            
            <tr style="border-bottom: 1px solid #000;">
              <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;"></td>
              <td style="border-bottom: 1px solid #000;">&nbsp;</td>
              <td style="text-align: center;padding: 5px 5px;border-bottom: 1px solid #000;"></td>
              <td colspan="2" style="text-align: right;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">
                <span style="float:right;font-weight:bold;">Total :</span>
              </td>
              <td style="text-align: right;padding: 5px 5px;font-weight:bold;border-left: 1px solid #000;border-bottom: 1px solid #000;">Rp.</td>
              <td colspan="4" style="text-align: right;padding: 5px 0px;font-weight:bold;border-bottom: 1px solid #000;border-right: 1px solid #000;"> {{ number_format($rows->pengawas_analisa_pagu + $rows->pengawas_inspeksi_pagu + $rows->pengawas_evaluasi_pagu + $rows->bimtek_perizinan_pagu + $rows->bimtek_pengawasan_pagu + $rows->penyelesaian_identifikasi_pagu + $rows->penyelesaian_realisasi_pagu + $rows->penyelesaian_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
              <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;"></td>
              <td style="border-bottom: 1px solid #000;"></td>
              <td colspan="1" style="text-align: center;padding: 5px 5px;border-bottom: 1px solid #000;"></td>
              <td colspan="2" style="text-align: right;padding: 5px 5px;border-left: 1px solid #000;border-bottom: 1px solid #000;">
                <span style="float:right;font-weight:bold;">Pagu APBN : </span>
              </td>
              <td style="text-align: right;padding: 5px 5px;font-weight:bold;border-left: 1px solid #000;border-bottom: 1px solid #000;">Rp.</td>
              <td colspan="4" style="text-align: right;padding: 5px 0px;font-weight:bold;border-right: 1px solid #000;border-bottom: 1px solid #000;"> {{ number_format($rows->pagu_apbn, 0, ',', '.') }}</td>
            </tr>
            <tr>
              <td rowspan="2" colspan="6"></td>
            </tr>
            <tr style="text-align:center;height:20px;">
              <td></td>
            </tr>
            <tr style="text-align:center;">
              <td colspan="3"></td>
              <td colspan="4" style="text-align:center;height:150px;">
                {{ $rows->lokasi }} , {{ Carbon\Carbon::parse($rows->tgl_tandatangan)->format('d F Y') }}
              </td>
            </tr>
            <tr style="text-align:center;">
              <td colspan="3"></td>
              <td colspan="4">
                {{ $rows->nama_pejabat }}
              </td>
            </tr>
            <tr style="text-align:center;">
              <td colspan="3"></td>
              <td colspan="4" style="text-align:center;"> NIP : {{ $rows->nip_pejabat }}
              </td>
            </tr>
          </tbody>

        </table>
    </div>
</div>
