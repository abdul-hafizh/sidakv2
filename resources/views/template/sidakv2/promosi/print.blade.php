<div style="margin: 0; padding: 0;">
    <div style="margin: 0;">

       <div style="text-align:center;margin:0px 0px 50px;">
          <h4 style="font-size: 14px; margin: 0;">LAPORAN PROMOSI PENGGUNAAN DAK NONFISIK FASILITASI PENANAMAN MODAL </h4>
          <h4 style="font-size: 14px; margin: 0;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU </h4>
          <h4 style="font-size: 14px; text-transform: uppercase; margin: 0;">PROVINSI {{ $rows->daerah_name }}</h4>
          <h4 style="font-size: 14px; margin: 0;">TAHUN ANGGARAN {{ $rows->periode_id }}</h4>
        </div>
        

        <table class="table table-hover text-nowrap" border="0">
              
          <thead>
            <tr>

              <th rowspan="2" class=" font-bold">No</th>
              <th rowspan="2" colspan="2" class="text-center font-bold">
               
                <span class="padding-top-bottom-12 ">Proses Kegiatan</span>
                             
              </th>
              <th colspan="2" class="text-center font-bold">
                <span class="padding-top-bottom-12">Periode Pelaksanaan</span>             
              </th>
              <th rowspan="2" class="text-center font-bold">
              
                <span class="padding-top-bottom-12">Budget (Rp)</span>
              </th>
                

              
            </tr>
            <tr>
              <th class="text-center font-bold">
                
                <span class="padding-top-bottom-12">Periode Mulai</span>
              </th>
              <th class="text-center font-bold">
                 
                 <span class="span-title">Periode Akhir</span>
              </th>
            </tr>
            
          </thead>
            <tbody id="content">
              <tr>
                <td colspan="6" class="text-center font-bold">Proses Pengadaan Barang/Jasa</td>
              </tr>

              <tr >
                <td rowspan="9" class="font-bold text-center">1.</td>
                <td colspan="4" class="font-bold"> Pra Produksi Meliputi : </td>
                <td><strong id="total_pra_produksi">{{ $rows->total_pra_produksi }}</strong></td>
                
              </tr>

              <tr>
                <td class="font-bold">A.</td>
                <td class="-abjad font-bold">Rapat Teknis Membahas Rencana Kerja Antara Lain Menentukan Proyek/Peluang/Potensi Invenstasi Yang Akan Tampil Dalam Video</td>
                <td>{{ $rows->tgl_awal_peluang }}</td>
                <td>{{ $rows->tgl_ahir_peluang }}</td>
                <td>{{ $rows->budget_peluang }}</td>
               
              </tr>

              <tr>
                <td class="font-bold">B.</td>
                <td class="font-bold">Membuat Storyline</td>
                <td>{{ $rows->tgl_awal_storyline }}</td>
                <td>{{ $rows->tgl_ahir_storyline }}</td>
                <td>{{ $rows->budget_storyline }}</td>
                
              </tr>

              <tr>
                <td class="font-bold">C.</td>
                <td class="font-bold">Membuat StoryBoard</td>
                <td>{{ $rows->tgl_awal_storyboard }}</td>
                <td>{{ $rows->tgl_ahir_storyboard}}</td>
                <td>{{ $rows->budget_storyboard }}</td>
                
              </tr>

              <tr>
                <td class="font-bold">D.</td>
                <td class="font-bold">Penentuan Lokasi</td>
                <td>{{ $rows->tgl_awal_lokasi }}</td>
                <td>{{ $rows->tgl_ahir_lokasi }}</td>
                <td>{{ $rows->budget_lokasi }}</td>
               
              </tr>

              <tr>
                <td class="font-bold">E.</td>
                <td class="font-bold">Pemilihan Talent</td>
                <td>{{ $rows->tgl_awal_talent }}</td>
                <td>{{ $rows->tgl_ahir_talent }}</td>
                <td>{{ $rows->budget_talent }}</td>
              
              </tr>

              <tr>
                <td class="font-bold">F.</td>
                <td class="font-bold">Pemilihan Pelaku Usaha Yang Memberikan Testimoni</td>
                <td>{{ $rows->tgl_awal_testimoni }}</td>
                <td>{{ $rows->tgl_ahir_testimoni }}</td>
                <td>{{ $rows->budget_testimoni }}</td>
                
              </tr>

              <tr>
                <td class="font-bold">G.</td>
                <td class="font-bold">Pemilihan Element Audio Visual</td>
                <td>{{ $rows->tgl_awal_audio }}</td>
                <td>{{ $rows->tgl_ahir_audio }}</td>
                <td>{{ $rows->budget_audio }}</td>
            
              </tr>

              <tr>
                <td class="font-bold">H.</td>
                <td class="font-bold">Pemilihan Video Editing Tools</td>
                <td>{{ $rows->tgl_awal_editing }}</td>
                <td>{{ $rows->tgl_ahir_editing }}</td>
                <td>{{ $rows->budget_editing }}</td>
               
              </tr>

              <tr>
                <td rowspan="3" class="font-bold text-center">2.</td>
                <td colspan="4" class="font-bold"> Produksi : </td>
                <td><strong id="total_produksi">{{ $rows->total_produksi }}</strong></td>
               
              </tr>

              <tr>
                <td class="font-bold">A.</td>
                <td class="-abjad font-bold">Pengambilan Gambar Testimoni Pelaku Usaha</td>
                <td>{{ $rows->tgl_awal_gambar }}</td>
                <td>{{ $rows->tgl_ahir_gambar }}</td>
                <td>{{ $rows->budget_gambar }}</td>
              
              </tr>

              <tr>
                <td class="font-bold">B.</td>
                <td class="-abjad font-bold">Pengambilan Gambar Di Lapangan Dan Pengumpulan Video</td>
                 <td>{{ $rows->tgl_awal_video }}</td>
                <td>{{ $rows->tgl_ahir_video }}</td>
                <td>{{ $rows->budget_video }}</td>
              
              </tr>

              <tr>
                <td rowspan="9" class="font-bold text-center">3.</td>
                <td colspan="4" class="font-bold"> Pasca Produksi : </td>
                <td><strong id="total_produksi">{{ $rows->total_pasca_produksi }}</strong></td>
                
              </tr>

              <tr>
                <td class="font-bold">A.</td>
                <td class="-abjad font-bold">Editing Video</td>
                <td>{{ $rows->tgl_awal_editvideo }}</td>
                <td>{{ $rows->tgl_ahir_editvideo }}</td>
                <td>{{ $rows->budget_editvideo }}</td>
               
              </tr>

              <tr>
                <td class="font-bold">B.</td>
                <td class="font-bold">Motion Grafik</td>
                <td>{{ $rows->tgl_awal_grafik }}</td>
                <td>{{ $rows->tgl_ahir_grafik }}</td>
                <td>{{ $rows->budget_grafik }}</td>
             
              </tr>

              <tr>
                <td class="font-bold">C.</td>
                <td class="font-bold">Music Compose Dan Mixing</td>
                <td>{{ $rows->tgl_awal_mixing }}</td>
                <td>{{ $rows->tgl_ahir_mixing }}</td>
                <td>{{ $rows->budget_mixing }}</td>
             
              </tr>

              <tr>
                <td class="font-bold">D.</td>
                <td class="font-bold">Voice Over Talent</td>
                <td>{{ $rows->tgl_awal_talent }}</td>
                <td>{{ $rows->tgl_ahir_talent }}</td>
                <td>{{ $rows->budget_talent }}</td>
              
              </tr>

              <tr>
                <td class="font-bold">E.</td>
                <td class="font-bold">Subtitle</td>
                <td>{{ $rows->tgl_awal_subtitle }}</td>
                <td>{{ $rows->tgl_ahir_subtitle }}</td>
                <td>{{ $rows->budget_subtitle }}</td>
               
              </tr>
            </tbody>
          </table>
    </div>
</div>

<style type="text/css">
  
  .font-bold{
    font-weight: bold;
  }

  .text-center{
    text-align: center;
  }
  .-abjad {
    text-wrap: wrap!important;
}

.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}
.table>thead>tr>th {
    vertical-align: bottom;
    /*border-bottom: 2px solid #ddd;*/
}

table {
    background-color: transparent;
    border: 1px solid #ddd;
    font-family: "Montserrat", "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    font-weight: 400;
    overflow-x: hidden;
    overflow-y: auto;
    font-size: 8px;
}
table {
    border-spacing: 0;
    border-collapse: collapse;
}
.padding-top-bottom-12 {
    padding: 5px 0px!important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 4px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    border-right: 1px solid #ddd;
}
.split-table {
    background: #0e298f;
    height: 44px;
    width: 1px;
    border: 1px solid #0e298f;
    border-radius: 3px;
    float: left;
    margin: 0px 16px 0px 0px;
}
.split-table-right {
    background: #0e298f;
    height: 44px;
    width: 1px;
    border: 1px solid #0e298f;
    border-radius: 3px;
    float: right;
}
</style>
