<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {    
    padding: 5px;
  }
  .boder-true {
    border: 1px solid #000;
  }
</style>

<div style="margin: 0; padding: 0;">
    <div style="margin: 0;">
        <div style="text-align:center;">
          <h4 style="font-size: 14px; margin: 0;">LAPORAN RENCANA PENGGUNAAN DAK NONFISIK FASILITASI PENANAMAN MODAL </h4>
          <h4 style="font-size: 14px; margin: 0;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU </h4>
          <h4 style="font-size: 14px; text-transform: uppercase; margin: 0;">{{ $rows->nama_daerah }}</h4>
          <h4 style="font-size: 14px; margin: 0;">TAHUN ANGGARAN {{ $rows->periode_id }}</h4>
        </div>

        <table border="0" style="font-size: 13px; margin-top: 40px;">
          <thead>
            <tr>
              <th rowspan="2" class="boder-true">No</th>
              <th rowspan="2" colspan="2" class="boder-true">Kegiatan/Sub Kegiatan</th>
              <th colspan="2" class="boder-true">Perencanaan</th>
              <th rowspan="2" colspan="2" class="boder-true">Pagu APBN (Rp)</th>
            </tr>
            <tr>
              <th class="boder-true">Jumlah</th>
              <th class="boder-true">Satuan</th>
            </tr>
          </thead>
          <tbody>
            <tr class="boder-true">
              <th rowspan="4" class="boder-true">1.</th>
              <th colspan="2" class="boder-true">Pengawasan Penanaman Modal</th>
              <td class="boder-true">{{ $rows->pengawas_inspeksi_target }}</td>
              <td width="110" class="boder-true">{{ $rows->pengawas_inspeksi_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->pengawas_analisa_pagu + $rows->pengawas_inspeksi_pagu + $rows->pengawas_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <td>a.</td>
              <td class="boder-true">Perencanaan Inspeksi Lapangan Tahunan</td>
              <td class="boder-true">{{ $rows->pengawas_analisa_target }}</td>
              <td width="110" class="boder-true">{{ $rows->pengawas_analisa_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->pengawas_analisa_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <td>b.</td>
              <td class="boder-true">Pelaksanaan Inspeksi Lapangan</td>
              <td class="boder-true">{{ $rows->pengawas_inspeksi_target }}</td>
              <td width="110" class="boder-true">{{ $rows->pengawas_inspeksi_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->pengawas_inspeksi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <td>c.</td>
              <td class="boder-true">Penilaian Kepatuhan Pelaksanaan Perizinan Berusaha</td>
              <td class="boder-true">{{ $rows->pengawas_evaluasi_target }}</td>
              <td width="110" class="boder-true">{{ $rows->pengawas_evaluasi_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->pengawas_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <th rowspan="3" class="boder-true">2.</th>
              <th colspan="2" class="boder-true">Bimbingan Teknis Kepada Pelaku Usaha</th>
              <td class="boder-true">{{ $rows->bimtek_perizinan_target + $rows->bimtek_pengawasan_target }}</td>
              <td width="110" class="boder-true">{{ $rows->bimtek_perizinan_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->bimtek_perizinan_pagu + $rows->bimtek_pengawasan_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <td>a.</td>
              <td class="boder-true">Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko dan Pengawasan Perizinan Berusaha Berbasis Risiko</td>
              <td class="boder-true">{{ $rows->bimtek_perizinan_target }}</td>
              <td width="110" class="boder-true">{{ $rows->bimtek_perizinan_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->bimtek_perizinan_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <td>b.</td>
              <td class="boder-true">Bimbingan Teknis/Sosialisasi Laporan Kegiatan Penanaman Modal</td>
              <td class="boder-true">{{ $rows->bimtek_pengawasan_target }}</td>
              <td width="110" class="boder-true">{{ $rows->bimtek_pengawasan_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->bimtek_pengawasan_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <th rowspan="3" class="boder-true">3.</th>
              <th colspan="2" class="boder-true">Penyelesaian Permasalahan dan Hambatan yang Dihadapi Pelaku Usaha dalam Merealisasikan Kegiatan Usahanya</th>
              <td class="boder-true"> {{ $rows->penyelesaian_realisasi_target }}</td>
              <td width="110" class="boder-true">{{ $rows->penyelesaian_realisasi_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->penyelesaian_identifikasi_pagu + $rows->penyelesaian_realisasi_pagu + $rows->penyelesaian_evaluasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <td>a.</td>
              <td class="boder-true">Identifikasi Permasalahan dan Hambatan yang Dihadapi Pelaku Usaha dalam Merealisasikan Kegiatan Usahanya</td>
              <td class="boder-true">{{ $rows->penyelesaian_identifikasi_target }}</td>
              <td width="110" class="boder-true">{{ $rows->penyelesaian_identifikasi_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->penyelesaian_identifikasi_pagu, 0, ',', '.') }}</td>
            </tr>
            <tr class="boder-true">
              <td>b.</td>
              <td class="boder-true">Penyelesaian Permasalahan dan Hambatan yang Dihadapi Pelaku Usaha dalam Merealisasikan Kegiatan Usahanya</td>
              <td class="boder-true">{{ $rows->penyelesaian_realisasi_target }}</td>
              <td width="110" class="boder-true">{{ $rows->penyelesaian_realisasi_satuan }}</td>
              <td> Rp. </td>
              <td style="text-align: right;">{{ number_format($rows->penyelesaian_realisasi_pagu, 0, ',', '.') }}</td>
            </tr>

            @if ($rows->promosi_pengadaan_pagu > 0)
              <tr class="boder-true">
                <th rowspan="4" class="boder-true">4.</th>
                <th colspan="2" class="boder-true">Penyusunan Peta Potensi Investasi Provinsi</th>
                <td class="boder-true">1</td>
                <td width="110" class="boder-true">{{ $rows->promosi_pengadaan_satuan }}</td>
                <td> Rp. </td>
                <td style="text-align: right;">{{ number_format($rows->promosi_pengadaan_pagu + $rows->identifikasi_peta_potensi + $rows->perumusan_peta_potensi, 0, ',', '.') }}</td>
              </tr>
              <tr class="boder-true">
                <td>a.</td>
                <td class="boder-true">Identifikasi Pemetaan Potensi Investasi Provinsi</td>
                <td class="boder-true">-</td>
                <td width="110" class="boder-true">-</td>
                <td> Rp. </td>
                <td style="text-align: right;">{{ number_format($rows->identifikasi_peta_potensi, 0, ',', '.') }}</td>
              </tr>
              <tr class="boder-true">
                <td>b.</td>
                <td class="boder-true">Perumusan dan Pelaksanaan Pemetaan Potensi Investasi Provinsi</td>
                <td class="boder-true">-</td>
                <td width="110" class="boder-true">-</td>
                <td> Rp. </td>
                <td style="text-align: right;">{{ number_format($rows->perumusan_peta_potensi, 0, ',', '.') }}</td>
              </tr>
              <tr class="boder-true">
                <td>c.</td>
                <td class="boder-true">Penyusunan Peta Potensi Investasi Provinsi</td>
                <td class="boder-true">1</td>
                <td width="110" class="boder-true">{{ $rows->promosi_pengadaan_satuan }}</td>
                <td> Rp. </td>
                <td style="text-align: right;">{{ number_format($rows->promosi_pengadaan_pagu, 0, ',', '.') }}</td>
              </tr>
              <tr class="boder-true">
                <td colspan="5" class="boder-true">
                  <span style="float:right;font-weight:bold;">Total Peta Potensi :</span>
                </td>
                <td>Rp.</td>
                <td style="text-align: right;"> {{ number_format($rows->promosi_pengadaan_pagu + $rows->identifikasi_peta_potensi + $rows->perumusan_peta_potensi, 0, ',', '.') }}</td>
              </tr>
            @endif

            <tr class="boder-true">
              <td colspan="5" class="boder-true">
                <span style="float:right;font-weight:bold;">Total Perencanaan :</span>
              </td>
              <td>Rp.</td>
              <td style="text-align: right;"> {{ number_format($rows->pengawas_analisa_pagu + $rows->pengawas_inspeksi_pagu + $rows->pengawas_evaluasi_pagu + $rows->bimtek_perizinan_pagu + $rows->bimtek_pengawasan_pagu + $rows->penyelesaian_identifikasi_pagu + $rows->penyelesaian_realisasi_pagu + $rows->penyelesaian_evaluasi_pagu, 0, ',', '.') }} </td>
            </tr>
            <tr class="boder-true">
              <td colspan="5" class="boder-true">
                <span style="float:right;font-weight:bold;">Pagu APBN :</span>
              </td>
              <td>Rp.</td>
              <td style="text-align: right;"> {{ number_format($rows->pagu_apbn, 0, ',', '.') }} </td>
            </tr>

            <tr style="text-align:center;">
              <td colspan="3">&nbsp;</td>
              <td colspan="4" style="text-align:center;height:150px;">
                {{ $rows->lokasi }} , {{ Carbon\Carbon::parse($rows->tgl_tandatangan)->format('d F Y') }}
              </td>
            </tr>

            <tr style="text-align:center;border: none;">
              <td colspan="3">&nbsp;</td>
              <td colspan="4">
                {{ $rows->nama_pejabat }}
              </td>
            </tr>

            <tr style="text-align:center;border: none;">
              <td colspan="3">&nbsp;</td>
              <td colspan="4" style="text-align:center;"> NIP : {{ $rows->nip_pejabat }}
              </td>
            </tr>
                        
          </tbody>
        </table>
    </div>
</div>
