<div style="margin: 0; padding: 0;">
    <div style="margin: 0;">

       <div style="text-align:center;margin:0px 0px 50px;">
          <h4 style="font-size: 14px; margin: 0;">LAPORAN PEMETAAN PENGGUNAAN DAK NONFISIK FASILITASI PENANAMAN MODAL </h4>
          <h4 style="font-size: 14px; margin: 0;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU </h4>
          <h4 style="font-size: 14px; text-transform: uppercase; margin: 0;">PROVINSI {{ $rows->daerah_name }}</h4>
          <h4 style="font-size: 14px; margin: 0;">TAHUN ANGGARAN {{ $rows->periode_id }}</h4>
        </div>
        

        <table class="table table-hover text-nowrap" border="0">
              
          <thead>
            <tr>

              <th rowspan="2" class=" font-bold">No</th>
              <th rowspan="2" colspan="3" class="text-center font-bold">
               
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
          <tbody>
                          
                         <tr lass="pull-left full">
                            <td rowspan="5" class="font-bold text-center">1</td>
                            <td colspan="5" class="font-bold"> Identifikasi Pemetaan Potensi Investasi : </td>
                            <td align="right"><strong id="total_pra_produksi">{{ $rows->total_identifikasi }}</td>
                           
                         </tr>


                         <tr>
                         <td class="font-bold">A.</td>
                         <td class="-abjad font-bold" colspan="2">Rapat Teknis Membahas Rencana Kerja</td>
                         <td>{{ $rows->tgl_awal_rencana_kerja }}</td>
                         <td>{{ $rows->tgl_ahir_rencana_kerja }}</td>
                         <td align="right">{{ $rows->budget_rencana_kerja }}</td>  
                             
                       </tr>
                       <tr>
                         <td class="font-bold">B.</td>
                         <td class="font-bold" colspan="2">Studi literatur</td>
                         <td>{{ $rows->tgl_awal_studi_literatur }}</td>
                         <td>{{ $rows->tgl_ahir_studi_literatur }}</td>
                         <td align="right">{{ $rows->budget_studi_literatur }}</td> 
                              
                       </tr>


                       <tr >
                         <td class="font-bold">C.</td>
                         <td class="font-bold" colspan="2">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>
                         <td>{{ $rows->tgl_awal_rapat_kordinasi }}</td>
                         <td>{{ $rows->tgl_ahir_rapat_kordinasi }}</td>
                         <td align="right">{{ $rows->budget_rapat_kordinasi }}</td> 
                       
                              
                       </tr>
                       <tr >
                         <td class="font-bold">D.</td>
                         <td class="font-bold" colspan="2">Pengumpulan data sekunder</td>
                         <td>{{ $rows->tgl_awal_data_sekunder }}</td>
                         <td>{{ $rows->tgl_ahir_data_sekunder }}</td>
                         <td align="right">{{ $rows->budget_data_sekunder }}</td>       
                       </tr>                        

                         <tr>
                            <td rowspan="11" class="font-bold text-center">2</td>
                            <td colspan="5" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : </td>
                             <td align="right"><strong id="total_pasca_produksi">{{ $rows->total_pelaksanaan }}</td>
                            
                            </tr>
                         <tr>

                          <tr>
                              <td class="font-bold">A.</td>
                               
                              <td class="-abjad font-bold" colspan="2">Melaksanakan Rapat Koordinasi Persiapan antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</td>
                                <td>{{ $rows->tgl_awal_fgd_persiapan }}</td>
                              <td>{{ $rows->tgl_ahir_fgd_persiapan }}</td>
                              <td align="right">{{ $rows->budget_fgd_persiapan }}</td> 
                             
                         </tr>     

                        <tr>
                              <td class="font-bold">B.</td>
                           
                              <td class="-abjad font-bold" colspan="2">
                                Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis
                              </td>
                            
                              <td>{{ $rows->tgl_awal_fgd_identifikasi }}</td>
                              <td>{{ $rows->tgl_ahir_fgd_identifikasi }}</td>
                              <td align="right">{{ $rows->budget_fgd_identifikasi }}</td> 
                             
                         </tr>
                              

                         <tr>
                              <td class="font-bold" rowspan="5">C.</td>
                              <td class="-abjad font-bold" colspan="5">
                                   Pengolahan dan analisis data untuk menghasilkan potensi sektor dan subsektor unggulan daerah :
                              </td>
                             
                         </tr>


                         <tr>
                             
                              <td class="font-bold table-number" >
                                   1.
                              </td>
                              <td class="-abjad font-bold"> LQ</td>
                              <td>{{ $rows->tgl_awal_lq }}</td>
                              <td>{{ $rows->tgl_ahir_lq }}</td>
                              <td align="right">{{ $rows->budget_lq }}</td>  
                             
                         </tr>


                         <tr>
                             
                              <td class="font-bold table-number" >
                                   2.
                              </td>
                              <td class="-abjad font-bold"> Shift Share</td>
                              <td>{{ $rows->tgl_awal_shift_share }}</td>
                              <td>{{ $rows->tgl_ahir_shift_share }}</td>
                              <td align="right">{{ $rows->budget_shift_share }}</td>  
                             
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   3.
                              </td>
                              <td class="-abjad font-bold"> Tipologi Sektor</td>
                              <td>{{ $rows->tgl_awal_tipologi_sektor }}</td>
                              <td>{{ $rows->tgl_ahir_tipologi_sektor }}</td>
                              <td align="right">{{ $rows->budget_tipologi_sektor }}</td>
                              
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   4.
                              </td>
                              <td class="-abjad font-bold"> Klassen</td>
                              <td>{{ $rows->tgl_awal_klassen }}</td>
                              <td>{{ $rows->tgl_ahir_klassen }}</td>
                              <td align="right">{{ $rows->budget_klassen }}</td>
                             
                         </tr>

                        
                         <tr>
                         <td class="font-bold">D.</td>
                         <td></td>
                         <td class="-abjad font-bold">Melaksanakan Focus Group Discussion (FGD) terkait Klarifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</td>
                              <td>{{ $rows->tgl_awal_fgd_klarifikasi }}</td>
                              <td>{{ $rows->tgl_ahir_fgd_klarifikasi }}</td>
                              <td align="right">{{ $rows->budget_fgd_klarifikasi }}</td>
                              
                         </tr>
                         

                          


                        
                        <tr>
                         <td class="font-bold">E.</td>
                         <td></td>
                         <td class="-abjad font-bold" >Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</td>
                              <td>{{ $rows->tgl_awal_finalisasi }}</td>
                              <td>{{ $rows->tgl_ahir_finalisasi }}</td>
                              <td align="right">{{ $rows->budget_finalisasi }}</td>
                             
                         </tr>
                      
                         <tr>
                            <td rowspan="12" class="font-bold text-center">3</td>
                            <td colspan="5" class="font-bold"> Penyusunan Peta Potensi Investasi : </td>
                             <td align="right"><strong id="total_pasca_produksi"> {{ $rows->total_penyusunan }}</td>
                           
                            </tr>
                         <tr>


                         <tr>
                              <td class="font-bold" rowspan="8">A.</td>
                              <td class="-abjad font-bold" colspan="6">
                                   Menyusun hasil identifikasi, pengolahan, dan analisis data dalam bentuk dokumen
                              </td>
                         </tr>


                        <tr>
                             
                              <td class="font-bold table-number" >
                                   1.
                              </td>
                              <td class="-abjad font-bold"> Deskripsi singkat sektor unggulan</td>
                              <td>{{ $rows->tgl_awal_summary_sektor_unggulan }}</td>
                              <td>{{ $rows->tgl_ahir_summary_sektor_unggulan }}</td>
                              <td align="right">{{ $rows->budget_summary_sektor_unggulan }}</td>
                             
                         </tr>


                         <tr>
                             
                              <td class="font-bold table-number" >
                                   2.
                              </td>
                              <td class="-abjad font-bold"> Deskripsi sektor unggulan</td>
                              <td>{{ $rows->tgl_awal_sektor_unggulan }}</td>
                              <td>{{ $rows->tgl_ahir_sektor_unggulan }}</td>
                              <td align="right">{{ $rows->budget_sektor_unggulan }}</td>
                              
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   3.
                              </td>
                              <td class="-abjad font-bold">  Potensi pasar</td>
                              <td>{{ $rows->tgl_awal_potensi_pasar }}</td>
                              <td>{{ $rows->tgl_ahir_potensi_pasar }}</td>
                              <td align="right">{{ $rows->budget_potensi_pasar }}</td>
                             
                              
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   4.
                              </td>
                              <td class="-abjad font-bold"> Parameter data sektor unggulan</td>
                              <td>{{ $rows->tgl_awal_parameter_sektor_unggulan }}</td>
                              <td>{{ $rows->tgl_ahir_parameter_sektor_unggulan }}</td>
                              <td align="right">{{ $rows->budget_parameter_sektor_unggulan }}</td>
                              
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   5.
                              </td>

                              <td class="-abjad font-bold"> Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</td>
                              <td>{{ $rows->tgl_awal_subsektor_unggulan }}</td>
                              <td>{{ $rows->tgl_ahir_subsektor_unggulan }}</td>
                              <td align="right">{{ $rows->budget_subsektor_unggulan }}</td>
                             
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   6.
                              </td>
                              <td class="-abjad font-bold"> Insentif daerah</td>
                               <td>{{ $rows->tgl_awal_intensif_daerah }}</td>
                              <td>{{ $rows->tgl_ahir_intensif_daerah }}</td>
                              <td align="right">{{ $rows->budget_intensif_daerah }}</td>
                            
                         </tr>

                          <tr>
                             
                              <td class="font-bold table-number" >
                                   7.
                              </td>
                              <td class="-abjad font-bold"> Potensi lanjutan komoditas sektor unggulan</td>
                               <td>{{ $rows->tgl_awal_potensi_lanjutan }}</td>
                              <td>{{ $rows->tgl_ahir_potensi_lanjutan }}</td>
                              <td align="right">{{ $rows->budget_potensi_lanjutan }}</td>
                             
                         </tr>



                       <tr>

                         <td class="font-bold">B.</td>
                          <td></td>
                         <td class="-abjad font-bold" colspan="2">Penyusunan Infografis Peta Potensi Investasi dalam 2 bahasa (bahasa indonesia dan bahasa inggris)</td>
                           <td>{{ $rows->tgl_awal_info_grafis }}</td>
                              <td>{{ $rows->tgl_ahir_info_grafis }}</td>
                              <td align="right">{{ $rows->budget_info_grafis }}</td>
                       </tr>
                       <tr>
                         <td class="font-bold">C.</td>
                          <td></td>
                         <td class="font-bold" colspan="2">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</td>
                        
                              <td>{{ $rows->tgl_awal_dokumentasi }}</td>
                              <td>{{ $rows->tgl_ahir_dokumentasi }}</td>
                              <td align="right">{{ $rows->budget_dokumentasi }}</td>  
                             
                        </tr> 
                        <tr>
                            <td colspan="5" ></td> 
                            <td class="font-bold"> Total : </td>
                             <td align="right"><strong id="total_pasca_produksi">{{ $rows->total_pelaksanaan }}</td>
                            
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
