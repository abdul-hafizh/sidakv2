
<div style="display: none">
  <div style="margin: 0px 20px;">
    <div style="text-align:center;padding: 20px 0px 20px;">
      <h4 style="font-size: 14px;">LAPORAN RENCANA PENGGUNAAN DAK NONFISIK FASILITASI PENANAMAN MODAL </h4>
      <h4 style="font-size: 14px;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU </h4>
      <h4 style="font-size: 14px;text-transform: uppercase;">--  daerah_nama  --</h4>
      <h4 style="font-size: 14px;">TAHUN ANGGARAN --  periode_tahun  --</h4>
    </div>
    <table border="0" id="dataPrPdf" style="font-size: 13px;margin: 0px 20px;">
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
          <td rowspan="4" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">1.</td>
          <td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Pengawasan Penanaman Modal</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">--  item.pengawas_inspeksi_target  --</td>
          <td width="110" style="text-align: center;padding: 10px 0px;border-left: 1px solid #000;">--  item.pengawas_inspeksi_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: cpx 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.pengawas_analisa_pagu + item.pengawas_inspeksi_pagu + item.pengawas_evaluasi_pagu)  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">a.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Analisa dan verifikasi data, profil dan informasi kegiatan usaha dari Pelaku Usaha</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">
            --  item.pengawas_analisa_target  --
          </td>
          <td width="110" style="text-align: center;border-left: 1px solid #000;padding: 10px 0px;">
            --  item.pengawas_analisa_satuan  --
          </td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.pengawas_analisa_pagu)  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">b.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Inspeksi Lapangan</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">
            --  item.pengawas_inspeksi_target  --
          </td>
          <td width="110" style="text-align: center;padding: vpx 0px;border-left: 1px solid #000;">
            --  item.pengawas_inspeksi_satuan  --
          </td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.pengawas_inspeksi_pagu)  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">c.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">
            --  item.pengawas_evaluasi_target  --
          </td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">
            --  item.pengawas_evaluasi_satuan  --
          </td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.pengawas_evaluasi_pagu)  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td rowspan="3" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">2.</td>
          <td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Bimbingan Teknis kepada Pelaku Usaha</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">--  item.bimtek_perizinan_target +  item.bimtek_pengawasan_target --</td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.bimtek_perizinan_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">--  new Intl.NumberFormat('id-ID').format(item.bimtek_pengawasan_pagu + item.bimtek_perizinan_pagu)  --</td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">a.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">
            --  item.bimtek_perizinan_target  --
          </td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.bimtek_perizinan_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.bimtek_perizinan_pagu )  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">b.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">
            --  item.bimtek_pengawasan_target  --
          </td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.bimtek_pengawasan_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.bimtek_pengawasan_pagu )  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td rowspan="4" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">3.</td>
          <td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;"> --  item.penyelesaian_realisasi_target  --</td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;"> --  item.penyelesaian_realisasi_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">--  new Intl.NumberFormat('id-ID').format(item.penyelesaian_identifikasi_pagu + item.penyelesaian_realisasi_pagu + item.penyelesaian_evaluasi_pagu)  --</td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">a.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Identifikasi Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">
            --  item.penyelesaian_identifikasi_target  --
          </td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.penyelesaian_identifikasi_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.penyelesaian_identifikasi_pagu )  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">b.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">
            --  item.penyelesaian_realisasi_target  --
          </td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.penyelesaian_realisasi_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.penyelesaian_realisasi_pagu)  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">c.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Evaluasi Penyelesaian Permasalahan dan Hambatan yang dihadapi Pelaku Usaha dalam merealisasikan kegiatan usahanya Perizinan Berusaha Para Pelaku Usaha</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">--  item.penyelesaian_evaluasi_target  --</td>
          <td width="110" style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.penyelesaian_evaluasi_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            --  new Intl.NumberFormat('id-ID').format(item.penyelesaian_evaluasi_pagu)  --
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td rowspan="2" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">4.</td>
          <td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Penyusunan Bahan Promosi Penanaman Modal</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;"> --  item.promosi_pengadaan_target  --</td>
          <td style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.promosi_pengadaan_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">--  new Intl.NumberFormat('id-ID').format(item.promosi_pengadaan_pagu)  --</td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">a.</td>
          <td style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Penyediaan Video Promosi Digital sebagai Bahan Promosi Penanaman Modal</td>
          <td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">--  item.promosi_pengadaan_target  --</td>
          <td style="text-align: center;padding: 5px 0px;border-left: 1px solid #000;">--  item.promosi_pengadaan_satuan  --</td>
          <td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;"> Rp. </td>
          <td style="text-align: right;padding: 5px 0px;border-right: 1px solid #000;">
            <div>--  new Intl.NumberFormat('id-ID').format(item.promosi_pengadaan_pagu)  -- </div>
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="border-left: 1px solid #000;"></td>
          <td></td>
          <td style="text-align: center;padding: 5px 5px;"></td>
          <td colspan="2" style="text-align: right;padding: 5px 5px;border-left: 1px solid #000;">
            <span style="float:right;font-weight:bold;">Total :</span>
          </td>
          <td style="text-align: right;padding: 5px 5px;font-weight:bold;border-left: 1px solid #000;">Rp.</td>
          <td colspan="4" style="text-align: right;padding: 5px 0px;font-weight:bold;border-bottom: 1px solid #000;border-right: 1px solid #000;"> --  new Intl.NumberFormat('id-ID').format(item.pengawas_analisa_pagu + item.pengawas_inspeksi_pagu + item.pengawas_evaluasi_pagu + item.bimtek_pengawasan_pagu + item.bimtek_perizinan_pagu + item.penyelesaian_identifikasi_pagu + item.penyelesaian_realisasi_pagu + item.penyelesaian_evaluasi_pagu + item.promosi_pengadaan_pagu)  --</td>
        </tr>
        <tr style="border-bottom: 1px solid #000;">
          <td style="border-left: 1px solid #000;"></td>
          <td></td>
          <td colspan="1" style="text-align: center;padding: 5px 5px;"></td>
          <td colspan="2" style="text-align: right;padding: 5px 5px;border-left: 1px solid #000;">
            <span style="float:right;font-weight:bold;">Pagu APBN : </span>
          </td>
          <td style="text-align: right;padding: 5px 5px;font-weight:bold;border-left: 1px solid #000;">Rp.</td>
          <td colspan="4" style="text-align: right;padding: 5px 0px;font-weight:bold;border-right: 1px solid #000;"> --  new Intl.NumberFormat('id-ID').format(item.pagu_apbn)  --</td>
        </tr>
        <tr>
          <td rowspan="2" colspan="6"></td>
        </tr>
        <tr style="text-align:center;height:20px;">
          <td></td>
        </tr>
        <tr height="50" style="text-align:center;height:80px;">
          <td colspan="3"></td>
          <td colspan="4" style="text-align:center;">
            --  item.lokasi  -- , --  item.tgl_tandatangan_convert  --
          </td>
        </tr>
        <tr style="text-align:center;">
          <td colspan="3"></td>
          <td colspan="4">
            --  item.nama_pejabat  --
          </td>
        </tr>
        <tr style="text-align:center;">
          <td colspan="3"></td>
          <td colspan="4" style="text-align:center;"> NIP : --  item.nip_pejabat  --
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>