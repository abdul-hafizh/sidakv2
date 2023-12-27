 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
 <div style="margin: 0; padding: 0;" id="myTable">
    <div style="margin: 0;">

       <div style="text-align:center;margin:50px 0px 50px;">
          <h4 style="font-size: 14px; margin: 0;">LAPORAN PEMETAAN PENGGUNAAN DAK NONFISIK FASILITASI PENANAMAN MODAL </h4>
          <h4 style="font-size: 14px; margin: 0;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU </h4>
          <h4 style="font-size: 14px; text-transform: uppercase; margin: 0;">PROVINSI {{ $rows->daerah_name }}</h4>
          <h4 style="font-size: 14px; margin: 0;">TAHUN ANGGARAN {{ $rows->periode_id }}</h4>
        </div>


     <div class="page">
        <div class="subpage">


  
         <table class="table table-hover text-nowrap" border="1" >
                         <thead>
                              <tr>

                                   <th rowspan="2"  class=" font-bold">No</th>
                                   
                                   
                                   <th rowspan="2" colspan="8" class="text-center font-bold">
                                     <span class="padding-top-bottom-12 ">Proses Kegiatan</span>
                                   </th>
                                     
                                    <th width="500" rowspan="2" colspan="2" class="text-center font-bold">
                                     <span class="padding-top-bottom-12 ">Jenis Pekerjaan</span>
                                   </th>
                                  
                                   <th colspan="2" class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Periode Pelaksanaan</span>
                                   </th>
                                  

                                   <th rowspan="2"  class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Budget (Rp)</span>
                                   </th>
                                  

                                   <th rowspan="2"  class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Realisasi (Rp)</span>
                                   </th>
                                 
                                   
                              </tr>
                             <tr>
                                   <th  class="text-center font-bold">
                                        
                                        <span class="padding-top-bottom-12">Periode Mulai</span>
                                   </th>
                                  
                                   <th  class="text-center font-bold">
                                       
                                      <span class="position-top-10">Periode Akhir</span>
                                   </th>
                             </tr>
                              
                         </thead>
                       <tbody>
                          
                       <tr>
                            <td  class="font-bold text-center">1</td>
                           
                            <td colspan="12" class="font-bold"> Identifikasi Pemetaan Potensi Investasi : </td>
                            <td align="right"><strong id="total-budget-indentifikasi">{{ $rows->total_budget_identifikasi }}</td>
                            <td align="right"><strong id="total-realisasi-identifikasi">{{ $rows->total_realisasi_identifikasi }}</td>
                                   
                       </tr>


                        <tr>
                          <td></td>
                             
                          <td>
                            @if($rows->checklist_rk =='true')
                            
                                 <input disabled name="checklist_rk" id="checklist-rk" value="true" checked type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                           @else
                               <input disabled name="checklist_rk" id="checklist-rk" value="true" type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                           @endif
                           
                          </td>     
                          <td class="font-bold">A.</td>

                       
                          <td colspan="6" class="-abjad font-bold" >Rapat Teknis Membahas Rencana Kerja</td>
                         
                          <td width="80" rowspan="4" colspan="2" class="text-center font-bold"><div  class="potensi-sektor">Jasa Konsultan</div></td> 
                        
                          <td rowspan="4" >
                             {{ $rows->tgl_awal_potensi }}
                          </td>
                         
                          <td rowspan="4">
                             {{ $rows->tgl_ahir_potensi }}
                          </td>
                        
                          <td width="85" rowspan="4" align="right" >
                            <b>{{ $rows->budget_potensi }}</b>
                          </td>
                         
                          <td width="85" rowspan="4" align="right" >
                              <b>{{ $rows->realisasi_potensi }}</b>
                          </td>
                         
                       </tr>
                       <tr>
                           <td></td>
                             
                           <td>
                               @if($rows->checklist_sl =='true')
                             
                                  <input disabled name="checklist_sl" checked id="checklist-sl" value="true" type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                               @else
                                   <input disabled name="checklist_sl" id="checklist-sl" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                               @endif

                           
                           </td> 
                           <td class="font-bold">B.</td>
                        
                           <td class="font-bold" colspan="6">Studi literatur</td>
                          
                           
                       </tr>


                       <tr >
                          <td></td>
                           
                          <td>

                            
                               @if($rows->checklist_kor =='true')
                             
                                  <input disabled name="checklist_kor" id="checklist-kor" checked value="true" type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                               @else
                                   <input disabled name="checklist_kor" id="checklist-kor" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                               @endif

                         </td> 
                         <td class="font-bold">C.</td>
                       
                         <td class="font-bold" colspan="6">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>
                        
                        
                       </tr>
                       <tr >
                             <td></td>    
                          <td>

                           
                               @if($rows->checklist_kor =='true')
                             
                                 <input disabled name="checklist_ds" checked id="checklist-ds" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                               @else
                                   <input disabled name="checklist_ds" id="checklist-ds" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi">
                               @endif

                         </td> 
                         <td class="font-bold">D.</td>
                        
                         <td class="font-bold" colspan="6">Pengumpulan data sekunder</td>
                         
                              
                        </tr>       

                     <tr>
                            <td  class="font-bold text-center">2</td>
                           
                            <td colspan="12" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : Investasi : </td>
                            <td align="right"><strong id="total-pelaksanaan-budget">{{ $rows->total_budget_pelaksanaan }}</td>
                            
                              <td align="right"><strong id="total-pelaksanaan-realisasi">{{ $rows->total_realisasi_pelaksanaan }}</td>
                                  
                      </tr> 

                      <tr>
                              <td></td>
                             
                              <td class="font-bold">A.</td>

                              <td class="-abjad font-bold " colspan="7"><div class="textarea-table">
                                Melaksanakan Rapat Koordinasi Persiapan antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</div></td>
                             

                             
                              <td  width="80" colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                              <td>   
                                   {{ $rows->tgl_awal_fgd_persiapan }}   
                             </td>
                           
                              <td>
                                   {{ $rows->tgl_ahir_fgd_persiapan }}
                              </td>
                             
                              <td align="right" width="85">
                                <b>{{ $rows->budget_fgd_persiapan }}</b>
                              </td>
                             
                              <td align="right" width="85">
                                 <b>{{ $rows->realisasi_fgd_persiapan }}</b>
                              </td>
                             
                         </tr> 

                        <tr>
                              <td></td>
                            
                              <td class="font-bold">B.</td>

                              <td class="-abjad font-bold" colspan="7"><div class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</div>
                              </td>
                           

                             <td  width="80" colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                            
                              <td>      
                                     
                                {{ $rows->tgl_awal_fgd_identifikasi }}
                             </td>
                            
                              <td>
                                {{ $rows->tgl_ahir_fgd_identifikasi }}
                              </td>
                            
                              <td align="right" width="85">
                                 <b>{{ $rows->budget_fgd_identifikasi }}</b>
                              </td>
                             
                              <td align="right" width="85">
                                  <b>{{ $rows->realisasi_fgd_identifikasi }}</b>
                              </td>
                             
                         </tr>

                         <tr>
                              <td></td>
                              
                              <td class="font-bold">C.</td>

                              <td class="-abjad font-bold" colspan="20">
                                   <div > Pengolahan dan analisis data untuk menghasilkan potensi sektor dan subsektor unggulan daerah : </div>
                                  <span id="pengolahan-messages"></span>
                              </td>   
                             
                         </tr>  

                        

                          <tr>
                             
                              <td></td>
                              <td></td>
                              <td>
                                 
                               @if($rows->checklist_lq =='true')
                                 <input disabled name="checklist_lq" checked id="checklist-lq" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @else
                                   <input disabled name="checklist_lq" id="checklist-lq" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @endif
                                
                                

                              </td>
                              <td  class="font-bold table-number">
                                   1.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> LQ</td>
                             
                             
                              <td  colspan="2"  rowspan="4" class="text-center font-bold">
                                   <div class="potensi-sektor">Jasa Konsultan</div>
                              </td>
                              
                              <td  rowspan="4">
                                   {{ $rows->tgl_awal_sektor }}
                              </td>
                        
                              <td  rowspan="4">
                                 {{ $rows->tgl_ahir_sektor }}
                              </td>
                            
                              <td align="right"  rowspan="4" width="85">
                                  <b> {{ $rows->budget_sektor }}</b>
                              </td>
                             
                             <td  align="right" rowspan="4" width="85">
                                <b>{{ $rows->realisasi_sektor }}</b>
                              </td>
                             
                           
                         </tr> 

                          <tr>
                             
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_shift_share =='true')
                                 <input disabled name="checklist_shift_share" checked id="checklist-shift-share" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @else
                                   <input disabled name="checklist_shift_share" id="checklist-shift-share" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @endif

                               

                              </td>
                              <td  class="font-bold table-number">
                                   2.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Shift Share</td>
                             
         
                           
                         </tr> 

                          <tr>
                              
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_tipologi_sektor =='true')
                                 <input disabled name="checklist_tipologi_sektor" checked id="checklist-tipologi-sektor" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @else
                                 <input disabled name="checklist_tipologi_sektor" id="checklist-tipologi-sektor" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @endif

                               

                              </td>
                              <td  class="font-bold table-number">
                                   3.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Tipologi Sektor</td>
                             
                        
                           
                         </tr> 

                          <tr>
                             
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_klassen =='true')
                                <input disabled name="checklist_klassen" checked id="checklist-klassen" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @else
                                 <input disabled name="checklist_klassen" id="checklist-klassen" value="false" type="checkbox" class="checkbox-pengolahan item-sektor">
                               @endif

                               

                              </td>
                              <td  class="font-bold table-number">
                                   4.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Klassen</td>
                             
                           
                         </tr> 


                         <tr>
                             
                              <td></td>
                              <td class="font-bold">D.</td>

                              <td class="-abjad font-bold" colspan="7"><div readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Klarifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</div>
                              </td>
                             

                             <td  width="80" colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                             
                              <td>             
                                 {{ $rows->tgl_awal_fgd_klarifikasi }}
                             </td>
                           
                              <td>
                                 {{ $rows->tgl_ahir_fgd_klarifikasi }}
                              </td>
                             
                              <td align="right" width="85">
                              <b> {{ $rows->budget_fgd_klarifikasi }}</b>
                              </td>
                             
                              <td align="right" width="85">
                                  <b> {{ $rows->realisasi_fgd_klarifikasi }}</b>
                              </td>
                              
                         </tr>

                         <tr>
                              <td></td>
                             
                              <td class="font-bold">E.</td>

                              <td class="-abjad font-bold" colspan="7"><div  class="textarea-table">Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</div>
                              </td>
                            

                             <td  width="80"  colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                            
                              <td>      
                                {{ $rows->tgl_awal_finalisasi }}
                             </td>
                           
                              <td>
                                  {{ $rows->tgl_ahir_finalisasi }}
                              </td>
                             
                              <td align="right" width="85">
                               <b> {{ $rows->budget_finalisasi }}</b>
                              </td>
                             
                              <td align="right" width="85">
                                 <b>{{ $rows->realisasi_finalisasi }}</b>
                              </td>
                             
                         </tr>

                        <tr>
                            <td class="font-bold text-center">3</td>
                            
                            <td colspan="12" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : Investasi : </td>
                            <td align="right"><strong id="total-penyusunan-budget">{{ $rows->total_budget_penyusunan }}</strong></td>
                            
                              <td align="right"><strong id="total-penyusunan-realisasi">{{ $rows->total_realisasi_penyusunan }}</strong></td>
                                 
                         </tr>

                        
                        <tr>
                              <td></td>
                              <td></td>
                              <td class="font-bold">A.</td>

                              <td class="-abjad font-bold" colspan="20">
                                   <div > Menyusun hasil identifikasi, pengolahan, dan analisis data dalam bentuk dokumen : </div>
                                  <span id="pengolahan-messages"></span>
                              </td>   
                             
                        </tr> 

                        <tr>
                             
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_summary_sektor_unggulan =='true')
                                  <input disabled checked name="checklist_summary_sektor_unggulan" id="checklist-summary-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox">
                               @else
                                 <input disabled name="checklist_summary_sektor_unggulan" id="checklist-summary-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox">
                               @endif

                              </td>
                              <td  class="font-bold table-number">
                                   1.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Deskripsi singkat sektor unggulan</td>
                             
                            
                              <td  colspan="2"  rowspan="7" class="text-center font-bold">
                                   <div class="penyusunan-peta">Jasa Konsultan</div>
                              </td>
                            
                              <td  rowspan="7">
                                  {{ $rows->tgl_awal_penyusunan }}
                              </td>
                       
                              <td  rowspan="7">
                                    {{ $rows->tgl_ahir_penyusunan }}
                              </td>
                             
                              <td  rowspan="7" align="right" width="85">
                                     <b>{{ $rows->budget_penyusunan }}</b>
                              </td>
                            
                             <td  rowspan="7" align="right" width="85">
                                 <b>{{ $rows->realisasi_penyusunan }}</b>
                              </td>
                             
                              
                           
                         </tr> 

                          <tr>
                            
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_sektor_unggulan =='true')
                                  <input name="checklist_sektor_unggulan" id="checklist-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox" disabled>
                               @else
                                 <input disabled name="checklist_sektor_unggulan" id="checklist-summary-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox">
                               @endif

                               


                              </td>
                              <td  class="font-bold table-number">
                                   2.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Deskripsi sektor unggulan</td>
                             
         
                           
                         </tr> 

                          <tr>
                             
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_potensi_pasar =='true')
                                  <input name="checklist_potensi_pasar" checked id="checklist-potensi-pasar" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox" disabled>
                               @else
                                 <input name="checklist_potensi_pasar" id="checklist-potensi-pasar" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox" disabled>
                               @endif

                               

                              </td>
                              <td  class="font-bold table-number">
                                   3.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Potensi pasar</td>
                             
         
                           
                         </tr> 

                          <tr>
                             
                              <td></td>
                              <td></td>
                              <td>

                                @if($rows->checklist_parameter_sektor_unggulan =='true')
                                  <input name="checklist_parameter_sektor_unggulan" checked type="checkbox" id="checklist-parameter-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" disabled>
                               @else
                                 <input name="checklist_parameter_sektor_unggulan" type="checkbox" id="checklist-parameter-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" disabled>
                               @endif

                               

                              </td>
                              <td  class="font-bold table-number">
                                   4.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Parameter data sektor unggulan</td>
                             
                        
                           
                         </tr> 

                          <tr>
                             
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_subsektor_unggulan =='true')
                                  <input name="checklist_subsektor_unggulan" checked id="checklist-subsektor-unggulan" value="false" class="checkbox-penyusunan item-penyusunan" type="checkbox" disabled>
                               @else
                                 <input name="checklist_subsektor_unggulan" id="checklist-subsektor-unggulan" value="false" class="checkbox-penyusunan item-penyusunan" type="checkbox" disabled>
                               @endif

          
                              </td>
                              <td  class="font-bold table-number">
                                   5.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</td>
                             
                           
                         </tr> 

                         

                          <tr>
                              
                              <td></td>
                              <td></td>
                              <td>

                                @if($rows->checklist_intensif_daerah =='true')
                                  <input disabled name="checklist_intensif_daerah" checked id="checklist-intensif-daerah" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox">
                               @else
                                 <input disabled name="checklist_intensif_daerah" id="checklist-intensif-daerah" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox">
                               @endif

                               

                              </td>
                              <td  class="font-bold table-number" >
                                   6.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Insentif daerah</td>
                             
         
                           
                         </tr> 

                          <tr>
                             
                              <td></td>
                              <td></td>
                              <td>

                               @if($rows->checklist_potensi_lanjutan =='true')
                                   <input disabled name="checklist_potensi_lanjutan" checked id="checklist-potensi-lanjutan" value="false" type="checkbox" class="checkbox-pengolahan item-penyusunan">
                               @else
                                  <input disabled name="checklist_potensi_lanjutan" id="checklist-potensi-lanjutan" value="false" type="checkbox" class="checkbox-pengolahan item-penyusunan">
                               @endif

                              

                              </td>
                              <td  class="font-bold table-number">
                                   7.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Potensi lanjutan komoditas sektor unggulan</td>

                         </tr> 


                         <tr>
                              <td></td>
                        
                              <td class="font-bold">B.</td>

                              <td class="-abjad font-bold" colspan="7"><div  class="textarea-table">Penyusunan Infografis Peta Potensi Investasi dalam 2 bahasa (bahasa indonesia dan bahasa inggris)</div>
                              </td>
                            

                             <td  width="80" colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                          
                              <td>      
                                 {{ $rows->tgl_awal_info_grafis }}
                             </td>
                           
                              <td>
                                 {{ $rows->tgl_ahir_info_grafis }}
                              </td>
                             
                              <td align="right" width="85">
                                 <b>{{ $rows->budget_info_grafis }}</b>
                              </td>
                              
                              <td align="right" width="85">
                                 <b>{{ $rows->realisasi_info_grafis }}</b>
                              </td>
                             
                         </tr>

                         <tr>
                              <td></td>
                             
                              <td class="font-bold">C.</td>

                              <td class="-abjad font-bold" colspan="7"><div  class="textarea-table">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</div>
                              </td>
                             
                             <td  width="80" colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                             
                              <td>      
                                {{ $rows->tgl_awal_dokumentasi }}   
                                 
                             </td>
                            
                              <td>
                                 {{ $rows->tgl_ahir_dokumentasi }}
                              </td>
                             
                              <td align="right" width="85">
                                 <b>{{ $rows->budget_dokumentasi }}</b>
                              </td>
                             
                              <td align="right" width="85">
                                  <b> {{ $rows->realisasi_dokumentasi }}</b>
                              </td>
                              
                         </tr>  
                          <tr>
                             <td colspan="13" align="right"><b>Total</b> :</td>
                             <td align="right"><b>{{ $rows->total_budget }}</b></td>
                             <td align="right"><b>{{ $rows->total_realisasi }}</b></td>
                          </tr> 
                            
                    </tbody>
                         
                    </table>
    </div>
</div>
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

.page {
        width: 16cm;
        min-height: 29.7cm;
      
        margin: 1cm auto;
      
    }
    .subpage {
        padding:0.5cm;
        height: 256mm;
        
    }
    
   
</style>
