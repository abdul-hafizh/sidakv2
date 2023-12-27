@extends('template/sidakv2/layout.app')
@section('content')

<style> tr.border-bottom td { border-bottom: 3pt solid #f4f4f4; } td { padding: 10px !important; } </style>

<div class="content">
     <form id="FormSubmit">
          <div class="row padding-default" style="margin-bottom: 20px">
               <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-body btn-primary border-radius-13">
                         <div class="card-body table-responsive p-0">
                              <div class="media">
                                   <div class="media-body text-left">
                                        <span>Pagu Pemetaan</span>
                                        <h3 class="card-text" id="pagu-apbn"></h3>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-body btn-primary border-radius-13">     
                         <div class="card-body table-responsive p-0">
                              <div class="media">
                                   <div class="media-body text-left">
                                        <span>Total Budget Pemetaan</span>
                                        <h3 class="card-text" id="total-budget"></h3>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-body btn-primary border-radius-13">     
                         <div class="card-body table-responsive p-0">
                              <div class="media">
                                   <div class="media-body text-left">
                                        <span>Total Realisasi Pemetaan</span>
                                        <h3 class="card-text" id="total-realisasi"></h3>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body">
                         <div class="row pd-top-bottom-15">                                
                              <div class="col-lg-4">
                                   <div id="periode-alert" class="form-group">
                                        <label class="col-sm-5 label-header-box form-group margin-none">Pilih Periode :</label>
                                        <div class="col-sm-7">
                                             <div id="selectPeriode" class="form-group margin-none"></div>
                                             <span id="periode-id-messages"></span>
                                            
                                        </div>
                                   </div>
                              </div>
                         </div>                          
                    </div>
               </div>
          </div>

          <div id="alert-jasa-konsultasi" style="display:none;" class="callout callout-info"></div>
       
          <div id="alert-swakelola" style="display:none;" class="callout callout-warning"></div>

          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-nowrap" border="0" >
                         <thead>
                              <tr>

                                   <th rowspan="3"  class=" font-bold">No</th>
                                   
                                   <th rowspan="3" class="text-center font-bold">
                                        <div class="split-table"></div>
                                   </th>
                                   <th rowspan="3" colspan="8" class="text-center font-bold">
                                     <span class="padding-top-bottom-12 ">Proses Kegiatan</span>
                                   </th>
                                     <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                                    <th rowspan="3" colspan="2" class="text-center font-bold">
                                     <span class="padding-top-bottom-12 ">Jenis Pekerjaan</span>
                                   </th>
                                   <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                                   <th colspan="3" class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Periode Pelaksanaan</span>
                                   </th>
                                   <th rowspan="3" ><div class="split-table padding-none"></div> </th>

                                   <th rowspan="3"  class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Budget (Rp)</span>
                                   </th>
                                   <th rowspan="3" ><div class="split-table padding-none"></div> </th>

                                   <th rowspan="3"  class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Realisasi (Rp)</span>
                                   </th>
                                  <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                                  <th rowspan="3" class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Keterangan</span>
                                  </th>

                                   
                              </tr>
                             <tr>
                                   <th  class="text-center font-bold">
                                        
                                        <span class="padding-top-bottom-12">Periode Mulai</span>
                                   </th>
                                   <th ><div class="split-table  padding-none"></div> </th>
                                   <th  class="text-center font-bold">
                                       
                                      <span class="position-top-10">Periode Akhir</span>
                                   </th>
                             </tr>
                              
                         </thead>
                       <tbody>
                          
                       <tr>
                            <td  class="font-bold text-center">1</td>
                            <td></td>
                            <td colspan="16" class="font-bold"> Identifikasi Pemetaan Potensi Investasi : </td>
                            <td align="right"><strong id="total-budget-indentifikasi">Rp 0</td>
                              <td></td>
                              <td align="right"><strong id="total-realisasi-identifikasi">Rp 0</td>
                             <td></td>
                             <td></td>       
                       </tr>


                       <tr>
                          <td></td>
                          <td></td>      
                          <td><input disabled name="checklist_rk" id="checklist-rk" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td>     
                          <td class="font-bold">A.</td>

                       
                          <td colspan="6" class="-abjad font-bold" >Rapat Teknis Membahas Rencana Kerja</td>
                          <td></td> 
                          <td rowspan="4" colspan="2" class="text-center font-bold"><div class="potensi-sektor">Jasa Konsultan</div></td> 
                          <td rowspan="4"></td> 
                          <td rowspan="4">
                              <div id="startdate-potensi-alert" class="margin-none form-group input-text-pilihan"> 
                                   <input  type="date"   id="startdate-potensi" name="startdate_potensi" class="form-control" disabled>
                                   <span id="startdate-potensi-messages"></span>
                            </div>
                          </td>
                          <td rowspan="4"></td> 
                          <td rowspan="4">
                            <div id="enddate-potensi-alert" class="margin-none form-group input-text-pilihan"> 
                                        <input type="date"   id="enddate-potensi" name="enddate_potensi" class="form-control" disabled>
                                 <span id="enddate-potensi-messages"></span>
                            </div>
                          </td>
                          <td rowspan="4"></td> 
                          <td rowspan="4">
                            <div id="budget-potensi-alert" class="margin-none form-group input-text-pilihan">
                                        <input type="number" id="budget-potensi" disabled   min="0" oninput="this.value = Math.abs(this.value)" placeholder="Budget" value="0" name="budget_potensi" class="form-control identifikasi-budget pemetaan-budget">
                                 <span id="budget-potensi-messages"></span>
                            </div>
                          </td>
                          <td rowspan="4"></td> 
                          <td rowspan="4">
                              <div id="realisasi-potensi-alert" class="margin-none form-group input-text-pilihan">
                                        <input type="number" id="realisasi-potensi" disabled   min="0" oninput="this.value = Math.abs(this.value)" placeholder="Realisasi" value="0" name="realisasi_potensi" class="form-control identifikasi-realisasi pemetaan-realisasi">
                                 <span id="realisasi-potensi-messages"></span>
                              </div>
                          </td>
                          <td rowspan="4"></td> 
                          <td rowspan="4">
                                   <div id="desc-potensi-alert" class="potensi-sektor">
                                        <button id="file-potensi" disabled type="button" class="file btn btn-default "> Upload File</button>
                                     
                                        <div id="img-file-potensi"></div>
                                        <input type="file" style="display:none;" disabled id="desc-potensi" name="desc_potensi" class="form-control">
                                        <span id="desc-potensi-messages"></span>
                                   </div>

                          </td>
                       </tr>
                       <tr>
                           <td></td>
                           <td></td>    
                           <td><input disabled name="checklist_sl" id="checklist-sl" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td> 
                           <td class="font-bold">B.</td>
                        
                           <td class="font-bold" colspan="6">Studi literatur</td>
                          
                           
                       </tr>


                       <tr >
                          <td></td>
                          <td></td>    
                          <td><input disabled name="checklist_kor" id="checklist-kor" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td> 
                         <td class="font-bold">C.</td>
                       
                         <td class="font-bold" colspan="6">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>
                        
                        
                       </tr>
                       <tr >
                           <td></td>  <td></td>    
                          <td><input disabled name="checklist_ds" id="checklist-ds" value="false" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td> 
                         <td class="font-bold">D.</td>
                        
                         <td class="font-bold" colspan="6">Pengumpulan data sekunder</td>
                         
                              
                        </tr>       

                     <tr>
                            <td  class="font-bold text-center">2</td>
                            <td></td>
                            <td colspan="16" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : Investasi : </td>
                            <td align="right"><strong id="total-pelaksanaan-budget">Rp 0</td>
                              <td></td>
                              <td align="right"><strong id="total-pelaksanaan-realisasi">Rp 0</td>
                             <td></td>
                             <td></td>       
                      </tr> 

                      <tr>
                              <td></td>
                              <td></td>
                              <td class="font-bold">A.</td>

                              <td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Persiapan antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                              <td></td>

                             
                              <td  colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                              <td></td>
                              <td>   
                                   <div id="startdate-a-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="startdate-a-pro" name="startdate_a_pro" class="form-control">
                                        <span id="startdate-a-pro-messages"></span>
                                   </div>      
                             </td>
                             <td></td>
                              <td>
                                   <div id="enddate-a-pro-alert" class="margin-none form-group"> 
                                      <input type="date" disabled="" id="enddate-a-pro" name="enddate_a_pro" class="form-control">
                                      <span id="enddate-a-pro-messages"></span>
                                   </div>
                              </td>
                              <td></td>
                              <td>
                                 <div id="budget-a-pro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0"  oninput="this.value = Math.abs(this.value)" id="budget-a-pro" name="budget_a_pro" class="form-control pelaksanaan-budget pemetaan-budget swakelola-budget">
                                      <span id="budget-a-pro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>
                                  <div id="realisasi-a-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Realisasi" value="0" oninput="this.value = Math.abs(this.value)" id="realisasi-a-pro" name="realisasi_a_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi">
                                        <span id="realisasi-a-pro-messages"></span>
                                   </div>
                              </td>
                              <td></td>
                              <td>


                                   <div id="desc-a-pro-alert" class="pdf-btn-center">
                                        
                                          <button id="file-persiapan" disabled type="button" class="file btn btn-default "> Upload File</button>
                                       
                                        <div id="img-file-persiapan"></div>
                                        <input type="file" style="display:none;"  disabled id="desc-a-pro"  name="desc_a_pro"  class="form-control">
                                        <span id="desc-a-pro-messages"></span>
                                   </div>

                              </td>
                         </tr> 

                         <tr>
                              <td></td>
                              <td></td>
                              <td class="font-bold">B.</td>

                              <td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea>
                              </td>
                              <td></td>

                             <td  colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                              <td></td>
                              <td>      
                                     
                              <div id="startdate-b-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-b-pro" name="startdate_b_pro" class="form-control">
                                   <span id="startdate-b-pro-messages"></span>
                              </div>
                             </td>
                             <td></td>
                              <td>
                            <div id="enddate-b-pro-alert" class="margin-none form-group"> 
                                 <input type="date" disabled id="enddate-b-pro" name="enddate_b_pro" class="form-control">
                                 <span id="enddate-b-pro-messages"></span>
                            </div>
                              </td>
                              <td></td>
                              <td>
                                 <div id="budget-b-pro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0"  oninput="this.value = Math.abs(this.value)" id="budget-b-pro" name="budget_b_pro" class="form-control pelaksanaan-budget pemetaan-budget swakelola-budget">
                                      <span id="budget-b-pro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>
                                 <div id="realisasi-b-pro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Realisasi" value="0"  oninput="this.value = Math.abs(this.value)" id="realisasi-b-pro" name="realisasi_b_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi">
                                      <span id="realisasi-b-pro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>

                                   <div id="desc-b-pro-alert" class="pdf-btn-center">
                                          <button id="file-fgd-identifikasi" type="button" class="file btn btn-default " disabled> Upload File</button>
                                       
                                        <div id="img-file-fgd-identifikasi"></div>
                                        <input type="file" style="display:none;" id="desc-b-pro" name="desc_b_pro" class="form-control">
                                        <span id="desc-b-pro-messages"></span>
                                   </div>

                                  

                              </td>
                         </tr>

                         <tr>
                              <td></td>
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
                              <td></td>
                              <td><input disabled name="checklist_lq" id="checklist-lq" value="false" type="checkbox" class="checkbox-pengolahan item-sektor"></td>
                              <td  class="font-bold table-number">
                                   1.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> LQ</td>
                             
                              <td rowspan="4"></td>
                              <td  colspan="2"  rowspan="4" class="text-center font-bold">
                                   <div class="potensi-sektor">Jasa Konsultan</div>
                              </td>
                              <td rowspan="4"></td>
                              <td  rowspan="4">
                              <div id="startdate-c-1-pro-alert" class="margin-none form-group input-text-pilihan"> 
                                   <input type="date" disabled name="startdate_sektor" id="startdate-sektor" class="form-control">
                                   <span id="startdate-c-1-pro-messages"></span>
                            </div>
                         </td>
                         <td rowspan="4"></td>
                              <td  rowspan="4">
                            <div id="enddate-c-1-pro-alert" class="margin-none form-group input-text-pilihan"> 
                                        <input type="date" disabled name="enddate_sektor" id="enddate-sektor" class="form-control">
                                 <span id="enddate-c-1-pro-messages"></span>
                            </div>
                              </td>
                            <td rowspan="4"></td>  
                              <td  rowspan="4">
                            <div id="budget-c-1-pro-alert" class="margin-none form-group input-text-pilihan">
                                        <input min="0" disabled type="number" id="budget-sektor" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_sektor" class="form-control pelaksanaan-budget pemetaan-budget">
                                 <span id="budget-c-1-pro-messages"></span>
                            </div>
                              </td>
                             <td rowspan="4"></td>
                             <td  rowspan="4">
                            <div id="realisasi-c-1-pro-alert" class="margin-none form-group input-text-pilihan">
                                        <input min="0" disabled type="number" id="realisasi-sektor" placeholder="Relalisasi" value="0" oninput="this.value = Math.abs(this.value)" name="realisasi_sektor" class="form-control pelaksanaan-realisasi pemetaan-realisasi">
                                 <span id="realisasi-c-1-pro-messages"></span>
                            </div>
                              </td>
                              <td rowspan="4"></td>
                              <td rowspan="4">
                                  <div id="desc-c-1-pro-alert" class="potensi-sektor">
                                  <button id="file-sektor" disabled type="button" class="file btn btn-default"> Upload File</button>
                                   
                                    <div id="img-file-sektor"></div>
                                    <span id="desc-c-1-pro-messages"></span>
                                  </div>
                                  <input type="file" style="display:none" id="keterangan-sektor" name="keterangan_sektor">

                                 
                              </td>  
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input disabled name="checklist_shift_share" id="checklist-shift-share" value="false" type="checkbox" class="checkbox-pengolahan item-sektor"></td>
                              <td  class="font-bold table-number">
                                   2.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Shift Share</td>
                             
         
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input disabled name="checklist_tipologi_sektor" id="checklist-tipologi-sektor" value="false" type="checkbox" class="checkbox-pengolahan item-sektor"></td>
                              <td  class="font-bold table-number">
                                   3.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Tipologi Sektor</td>
                             
                        
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input disabled name="checklist_klassen" id="checklist-klassen" value="false" type="checkbox" class="checkbox-pengolahan item-sektor"></td>
                              <td  class="font-bold table-number">
                                   4.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Klassen</td>
                             
                           
                         </tr> 


                         <tr>
                              <td></td>
                              <td></td>
                              <td class="font-bold">D.</td>

                              <td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Klarifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea>
                              </td>
                              <td></td>

                             <td  colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                              <td></td>
                              <td>             
                              
                                   <div id="startdate-d-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled="" id="startdate-d-pro" name="startdate_d_pro" class="form-control">
                                        <span id="startdate-d-pro-messages"></span>
                                   </div>
                             </td>
                             <td></td>
                              <td>
                                   <div id="enddate-d-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled="" id="enddate-d-pro" name="enddate_d_pro" class="form-control">
                                        <span id="enddate-d-pro-messages"></span>
                                   </div>
                              </td>
                              <td></td>
                              <td>
                                <div id="budget-d-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-d-pro" name="budget_d_pro" class="form-control pelaksanaan-budget pemetaan-budget swakelola-budget">
                                 <span id="budget-d-pro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>
                                  <div id="realisasi-d-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Realisasi" value="0" oninput="this.value = Math.abs(this.value)" id="realisasi-d-pro" name="realisasi_d_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi">
                                 <span id="realisasi-d-pro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>
                                   <div id="desc-d-pro-alert" class="pdf-btn-center">
                                         <button id="file-fgd-klarifikasi" disabled="" type="button" class="file btn btn-default"> Upload File</button>
                                   
                                         <div id="img-file-fgd-klarifikasi"></div>
                                        <input type="file" style="display:none;" disabled="" id="desc-d-pro" name="desc_d_pro" class="form-control ">
                                        <span id="desc-d-pro-messages"></span>
                                   </div>

                              </td>
                         </tr>

                         <tr>
                              <td></td>
                              <td></td>
                              <td class="font-bold">E.</td>

                              <td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea>
                              </td>
                              <td></td>

                             <td  colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                              <td></td>
                              <td>      
                                     
                                <div id="startdate-e-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled="" id="startdate-e-pro" name="startdate_e_pro" class="form-control">
                                   <span id="startdate-e-pro-messages"></span>
                                </div>
                             </td>
                             <td></td>
                              <td>
                                   <div id="enddate-e-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled="" id="enddate-e-pro" name="enddate_e_pro" class="form-control">
                                     <span id="enddate-e-pro-messages"></span>
                                   </div>
                              </td>
                              <td></td>
                              <td>
                                <div id="budget-e-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-e-pro" name="budget_e_pro" class="form-control pelaksanaan-budget pemetaan-budget swakelola-budget">
                                 <span id="budget-e-pro-messages"></span>
                                </div>
                              </td>
                              <td></td>
                              <td>
                                 <div id="realisasi-e-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Realisasi" value="0" oninput="this.value = Math.abs(this.value)" id="realisasi-e-pro" name="realisasi_e_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi">
                                 <span id="realisasi-e-pro-messages"></span>
                                </div>
                              </td>
                              <td></td>
                              <td>
                                   <div id="desc-e-pro-alert" class="pdf-btn-center">
                                        <button id="file-fgd-konfirmasi" disabled="" type="button" class="file btn btn-default"> Upload File</button>
                                   
                                         <div id="img-file-fgd-konfirmasi"></div>
                                        <input type="file" style="display:none;" disabled="" id="desc-e-pro" name="desc_e_pro" class="form-control">
                                        <span id="desc-e-pro-messages"></span>
                                   </div>
                              </td>
                         </tr>

                         <tr>
                            <td class="font-bold text-center">3</td>
                            <td></td>
                            <td colspan="16" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : Investasi : </td>
                            <td align="right"><strong id="total-penyusunan-budget">Rp 0</strong></td>
                              <td></td>
                              <td align="right"><strong id="total-penyusunan-realisasi">Rp 0</strong></td>
                             <td></td>
                             <td></td>       
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
                              <td></td>
                              <td>
                                  <input disabled name="checklist_summary_sektor_unggulan" id="checklist-summary-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox">

                              </td>
                              <td  class="font-bold table-number">
                                   1.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Deskripsi singkat sektor unggulan</td>
                             
                              <td rowspan="7"></td>
                              <td  colspan="2"  rowspan="7" class="text-center font-bold">
                                   <div class="penyusunan-peta">Jasa Konsultan</div>
                              </td>
                              <td rowspan="7"></td>
                              <td  rowspan="7">
                              <div id="startdate-a-ppro-alert" class="margin-none form-group penyusunan-peta"> 
                                  <input type="date" disabled="" id="startdate-penyusunan" name="startdate_penyusunan" class="form-control">
                                   <span id="startdate-a-ppro-messages"></span>
                            </div>
                         </td>
                         <td rowspan="7"></td>
                              <td  rowspan="7">
                            <div id="enddate-a-ppro-alert" class="margin-none form-group penyusunan-peta"> 
                                       <input type="date" disabled id="enddate-penyusunan" name="enddate_penyusunan" class="form-control">
                                 <span id="enddate-a-ppro-messages"></span>
                            </div>
                              </td>
                            <td rowspan="7"></td>  
                              <td  rowspan="7">
                            <div id="budget-a-ppro-alert" class="margin-none form-group penyusunan-peta">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-penyusunan" name="budget_penyusunan" class="form-control penyusunan-budget pemetaan-budget">
                                 <span id="budget-a-ppro-messages"></span>
                            </div>
                              </td>
                             <td rowspan="7"></td>
                             <td  rowspan="7">
                            <div id="realisasi-a-ppro-alert" class="margin-none form-group penyusunan-peta">
                                       <input min="0" disabled="" type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="realisasi-penyusunan" name="realisasi_penyusunan" class="form-control penyusunan-realisasi pemetaan-realisasi">
                                 <span id="realisasi-a-ppro-messages"></span>
                            </div>
                              </td>
                              <td rowspan="7"></td>
                              <td rowspan="7">
                                  <div id="desc-a-ppro-alert" class="penyusunan-peta">
                                  <button id="file-penyusunan" type="button" disabled="" class="file btn btn-default"> Upload File</button>
                                 
                                  <div id="img-file-penyusunan"></div>
                                   <span id="desc-a-ppro-messages"></span>
                                  </div>
                                 <input type="file" style="display:none" id="keterangan-penyusunan" name="keterangan_penyusunan">

                                 
                              </td>  
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input name="checklist_sektor_unggulan" id="checklist-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox" disabled></td>
                              <td  class="font-bold table-number">
                                   2.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Deskripsi sektor unggulan</td>
                             
         
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input name="checklist_potensi_pasar" id="checklist-potensi-pasar" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox" disabled></td>
                              <td  class="font-bold table-number">
                                   3.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Potensi pasar</td>
                             
         
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input name="checklist_parameter_sektor_unggulan" type="checkbox" id="checklist-parameter-sektor-unggulan" class="checkbox-penyusunan item-penyusunan" value="false" disabled></td>
                              <td  class="font-bold table-number">
                                   4.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Parameter data sektor unggulan</td>
                             
                        
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input name="checklist_subsektor_unggulan" id="checklist-subsektor-unggulan" value="false" class="checkbox-penyusunan item-penyusunan" type="checkbox" disabled></td>
                              <td  class="font-bold table-number">
                                   5.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</td>
                             
                           
                         </tr> 

                         

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input disabled name="checklist_intensif_daerah" id="checklist-intensif-daerah" class="checkbox-penyusunan item-penyusunan" value="false" type="checkbox"></td>
                              <td  class="font-bold table-number" >
                                   6.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Insentif daerah</td>
                             
         
                           
                         </tr> 

                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><input disabled name="checklist_potensi_lanjutan" id="checklist-potensi-lanjutan" value="false" type="checkbox" class="checkbox-pengolahan item-penyusunan"></td>
                              <td  class="font-bold table-number">
                                   7.
                              </td>
                              <td class="-abjad font-bold" colspan="5"> Potensi lanjutan komoditas sektor unggulan</td>

                         </tr> 


                         <tr>
                              <td></td>
                              <td></td>
                              <td class="font-bold">B.</td>

                              <td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Penyusunan Infografis Peta Potensi Investasi dalam 2 bahasa (bahasa indonesia dan bahasa inggris)</textarea>
                              </td>
                              <td></td>

                             <td  colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                              <td></td>
                              <td>      
                                  <div id="startdate-b-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled="" id="startdate-b-ppro" name="startdate_b_ppro" class="form-control">
                                   <span id="startdate-b-ppro-messages"></span>
                                  </div>
                             </td>
                             <td></td>
                              <td>
                                  <div id="enddate-b-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled="" id="enddate-b-ppro" name="enddate_b_ppro" class="form-control">
                                    <span id="enddate-b-ppro-messages"></span>
                                  </div>
                              </td>
                              <td></td>
                              <td>
                                <div id="budget-b-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-b-ppro" name="budget_b_ppro" class="form-control penyusunan-budget pemetaan-budget swakelola-budget">
                                 <span id="budget-b-ppro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>
                                 <div id="realisasi-b-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Realisasi" value="0" oninput="this.value = Math.abs(this.value)" id="realisasi-b-ppro" name="realisasi_b_ppro" class="form-control penyusunan-realisasi pemetaan-realisasi">
                                 <span id="realisasi-b-ppro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>
                                   <div id="desc-b-ppro-alert" class="pdf-btn-center">
                                        <button id="file-info-grafis" type="button" disabled="" class="file btn btn-default"> Upload File</button>
                                 
                                        <div id="img-file-info-grafis"></div>
                                        <input type="file" style="display:none;" disabled="" id="desc-b-ppro" name="desc_b_ppro" class="form-control">
                                        <span id="desc-b-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>

                         <tr>
                              <td></td>
                              <td></td>
                              <td class="font-bold">C.</td>

                              <td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</textarea>
                              </td>
                              <td></td>

                             <td  colspan="2" class="text-center font-bold">
                                   <div >Swakelola</div>
                              </td>
                             
                              <td></td>
                              <td>      
                                 <div id="startdate-c-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled="" id="startdate-c-ppro" name="startdate_c_ppro" class="form-control">
                                   <span id="startdate-c-ppro-messages"></span>
                                 </div>    
                                 
                             </td>
                             <td></td>
                              <td>
                                 <div id="enddate-c-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled="" id="enddate-c-ppro" name="enddate_c_ppro" class="form-control">
                                      <span id="enddate-c-ppro-messages"></span>
                                 </div>
                              </td>
                              <td></td>
                              <td>
                                 <div id="budget-c-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-c-ppro" name="budget_c_ppro" class="form-control penyusunan-budget pemetaan-budget swakelola-budget">
                                   <span id="budget-c-ppro-messages"></span>
                                   </div>
                              </td>
                              <td></td>
                              <td>
                                   <div id="realisasi-c-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled="" type="number" placeholder="Realisasi" value="0" oninput="this.value = Math.abs(this.value)" id="realisasi-c-ppro" name="realisasi_c_ppro" class="form-control penyusunan-realisasi pemetaan-realisasi">
                                   <span id="realisasi-c-ppro-messages"></span>
                                   </div>
                              </td>
                              <td></td>
                              <td>
                                  <div id="desc-c-ppro-alert" class="pdf-btn-center">
                                         <button id="file-doc-info-grafis" type="button" disabled="" class="file btn btn-default"> Upload File</button>
                                          <div id="img-file-doc-info-grafis"></div>
                                        <input type="file" style="display:none;" disabled="" id="desc-c-ppro" name="desc_c_ppro" class="form-control pasca-produksi">
                                   <span id="desc-c-ppro-messages"></span>
                                   </div>
                              </td>
                         </tr> 
                          
                            
                    </tbody>
                         
                    </table>
                    </div>
               </div>
          </div>
          
          

          <div class="box-footer">
               <div id="btn-submit" class="btn-group just-center">
                   
               </div> 
          </div> 
     </form>
</div>

<script type="text/javascript">

     $(document).ready(function() {

          var periode =[];
          var pagu_apbn = 0;
          var total_budget = 0;

          var total_identifikasi_budget = 0;  
          var total_identifikasi_realisasi = 0;   

          var total_pelaksanaan_budget = 0;
          var total_pelaksanaan_realisasi = 0;

          var total_penyusunan_budget = 0;
          var total_penyusunan_realisasi = 0;
        
          var temp_total_identifikasi_budget = 0;
          var temp_total_identifikasi_realisasi = 0;

          var temp_total_pelaksanaan_budget = 0;
          var temp_total_pelaksanaan_realisasi = 0;

          var temp_total_penyusunan_budget = 0;
          var temp_total_penyusunan_realisasi = 0;
           
          var total_swakelola_budget = 0;  
          var temp_total_swakelola_budget = 0;

          var temp_total_budget = 0;
          var temp_total_realisasi = 0; 
          var file_data_potensi = '';
          var file_studi_literatur = '';
          var file_rapat_kordinasi = '';
          var file_data_sekunder = '';


          var file_fgd_persiapan = '';
          var file_data_identifikasi = '';
          var file_data_sektor = '';
          var file_data_klarifikasi = '';
          var file_data_finalisasi = '';
          var file_data_penyusunan = '';
          var file_penyusunan_infografis = '';
          var file_doc_info_grafis = '';

          var btn_potensi = 'false';
         


          var btn_fgd_persiapan = 'false';
          var btn_data_identifikasi = 'false';
          var btn_data_sektor = 'false';
          var btn_data_klarifikasi = 'false';
          var btn_data_finalisasi = 'false';

          var btn_data_penyusunan = 'false';
          var btn_penyusunan_infografis = 'false';
          var btn_doc_info_grafis = 'false';

          $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>'); 
     
          $('#pagu-apbn').html('<b>Rp. 0</b>');           
          $('#total-budget').html('<b>Rp. 0</b>'); 
          $('#total-realisasi').html('<b>Rp. 0</b>'); 
          $(".pemetaan-budget").on("input", updateTotalPemetaanBudget);
          $(".pemetaan-realisasi").on("input", updateTotalPemetaanRealisasi);

        

          getChecklistIdentifikasi(); 
          getChecklistPelaksanaan();      
          getChecklistPetaInvenstasi();
          
          getperiode();  


          $(".identifikasi-budget").on("input", function() {
               calculateIdentifikasiBudget();
          }); 

          $(".identifikasi-realisasi").on("input", function() {
               calculateIdentifikasiRealisasi();
          });        

          $(".pelaksanaan-budget").on("input", function() {
               calculatePelaksanaanBudget();
          });
          $(".pelaksanaan-realisasi").on("input", function() {
               calculatePelaksanaanRealisasi();
          });

          $(".penyusunan-budget").on("input", function() {
               calculatePenyusunanBudget();
          });

          $(".penyusunan-realisasi").on("input", function() {
               calculatePenyusunanRealisasi();
          });


          $(".swakelola-budget").on("input", function() {
               calculateSwakelolaBudget();
          });
          
          UploadFilePotensi();
          
          UploadFilePersiapan();
          UploadFileFGDKlarifikasi();
          UploadFileSektor();
          UploadFileFGDKonfirmasi();
          UploadFileFGDIndentifikasi(); 
         


          UploadFilePenyusunan();
          UploadFilePenyusunanInfoGrafis(); 
          UploadFileDokumentasiInfoGrafis(); 
           
         
          getbutton();

          function getbutton(){
              
               var btn = '';
                    btn+='<button id="simpan"  type="button" class="btn btn-warning col-md-2"><i class="fa fa-send"></i> SIMPAN</button>';

                   
                    

                  if(btn_potensi == 'true' && btn_fgd_persiapan == 'true' && btn_data_identifikasi == 'true' && btn_data_sektor == 'true' && btn_data_penyusunan == 'true' && btn_penyusunan_infografis == 'true' && btn_doc_info_grafis == 'true')
                  {  
                    btn+='<button id="kirim"  type="button" class="btn btn-primary col-md-2"><i class="fa fa-upload"></i> KIRIM</button>';
                  }else{
                    btn+='<button disabled  type="button" class="btn btn-primary col-md-2"><i class="fa fa-upload"></i> KIRIM</button>';  
                  }  
                    $('#btn-submit').html(btn);

              $("#simpan").click( () => {
                var status_jasa_konsultan = false;
                var status_swakelola = false;
              
               
               var form = {
                    'status_laporan_id':13,
                    'type': 'draft',
               };

               var total_jasa_konsultan = temp_total_identifikasi_budget + temp_total_pelaksanaan_budget + temp_total_penyusunan_budget;
                    var total_swakelola =  ''
                    const min_jasa = pagu_apbn * 60 / 100;                       
     
               if(min_jasa > total_jasa_konsultan) 
               {
                    status_jasa_konsultan = false;
                    var alt = '';
                    alt +='<h4>Info!</h4>'
                    alt += 'Anggaran jasa konsultan tidak boleh kurang dari <b>Rp'+ accounting.formatNumber(min_jasa, 0, ".", ".") +' </b> atau  <b>60%</b> dari total APBN.';
                     $('#alert-jasa-konsultasi').show().html(alt);
                     $('#total-budget').removeClass('text-black').addClass('text-red').addClass('blinking-text');
               } else {
                   $('#alert-jasa-konsultasi').hide().html('');  
                   $('#total-budget').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
                   status_jasa_konsultan = true;
               }  


               var total_sakelola = temp_total_swakelola_budget;
               const min_swakelola = pagu_apbn * 40 / 100;
               if (min_swakelola > total_sakelola) 
               {
                    status_swakelola = false;
                    var alt = '';
                     alt +='<h4>Info!</h4>';
                     alt += 'Anggaran swakelola tidak boleh kurang dari <b>Rp '+ accounting.formatNumber(min_jasa, 0, ".", ".") +'</b> atau <b>40%</b> dari total APBN.';
                     $('#alert-swakelola').show().html(alt);
                      $('#total-budget').removeClass('text-black').addClass('text-red').addClass('blinking-text');

               }else{
                      status_swakelola = true;
                     $('#alert-swakelola').hide().html('');
                     $('#total-budget').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
               }  



                    var periode_id = $('#periode_id').val();
                    if(periode_id)
                   {
                       if(status_jasa_konsultan == true && status_swakelola == true)
                       {
                           SendingData(form);
                       }  
                       
                    }else{
                        Swal.fire({
                         icon: 'info',
                         title: 'Peringatan',
                         text: 'Maaf, Periode Belum di pilih.',
                         confirmButtonColor: '#000',
                         showConfirmButton: true,
                         confirmButtonText: 'OK',
                         });
                    }     
   
                
               
              

          });

          $("#kirim").click( () => {

               

                                          
               var status_jasa_konsultan = false;
                var status_swakelola = false;
              
               
              var form = {
                    'status_laporan_id':14,
                    'type': 'kirim',
               };

               var total_jasa_konsultan = temp_total_identifikasi_budget + temp_total_pelaksanaan_budget + temp_total_penyusunan_budget;
                    var total_swakelola =  ''
                    const min_jasa = pagu_apbn * 60 / 100;                       
     
               if(min_jasa > total_jasa_konsultan) 
               {
                    status_jasa_konsultan = false;
                    var alt = '';
                    alt +='<h4>Info!</h4>'
                    alt += 'Anggaran jasa konsultan tidak boleh kurang dari <b>Rp'+ accounting.formatNumber(min_jasa, 0, ".", ".") +' </b> atau  <b>60%</b> dari total APBN.';
                     $('#alert-jasa-konsultasi').show().html(alt);
                     $('#total-budget').removeClass('text-black').addClass('text-red').addClass('blinking-text');
               } else {
                   $('#alert-jasa-konsultasi').hide().html('');  
                   $('#total-budget').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
                   status_jasa_konsultan = true;
               }  


               var total_sakelola = temp_total_swakelola_budget;
               const min_swakelola = pagu_apbn * 40 / 100;
               if (min_swakelola > total_sakelola) 
               {
                    status_swakelola = false;
                    var alt = '';
                     alt +='<h4>Info!</h4>';
                     alt += 'Anggaran swakelola tidak boleh kurang dari <b>Rp '+ accounting.formatNumber(min_jasa, 0, ".", ".") +'</b> atau <b>40%</b> dari total APBN.';
                     $('#alert-swakelola').show().html(alt);
                      $('#total-budget').removeClass('text-black').addClass('text-red').addClass('blinking-text');

               }else{
                      status_swakelola = true;
                     $('#alert-swakelola').hide().html('');
                     $('#total-budget').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
               }  



                    var periode_id = $('#periode_id').val();
                    if(periode_id)
                   {
                       if(status_swakelola == true && status_swakelola == true)
                       {
                           SendingData(form);
                       }  
                       
                    }else{
                        Swal.fire({
                         icon: 'info',
                         title: 'Peringatan',
                         text: 'Maaf, Periode Belum di pilih.',
                         confirmButtonColor: '#000',
                         showConfirmButton: true,
                         confirmButtonText: 'OK',
                         });
                    }   
   
             

          });

          }


          function calculateIdentifikasiBudget() {
               var total_identifikasi_budget = 0;
          
               $(".identifikasi-budget").each(function() {
                    total_identifikasi_budget += parseFloat($(this).val());
               });

                 

               var number = total_identifikasi_budget;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
               $("#total-budget-indentifikasi").text('Rp '+ formattedNumber);
               
               temp_total_identifikasi_budget = number;
               totalRencanaBudget();
          }

          function calculateIdentifikasiRealisasi() {
               var total_identifikasi_realisasi = 0;
          
               $(".identifikasi-realisasi").each(function() {
                    total_identifikasi_realisasi += parseFloat($(this).val());
               });

                 

               var number = total_identifikasi_realisasi;
            
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total-realisasi-identifikasi").text('Rp '+ formattedNumber);
               
               temp_total_identifikasi_realisasi = number;
               totalRencanaRealisasi();
          }

          function calculatePelaksanaanBudget() {
               var total_pelaksanaan_budget = 0;

               $(".pelaksanaan-budget").each(function() {
                    total_pelaksanaan_budget += parseFloat($(this).val());
               });

               var number = total_pelaksanaan_budget;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total-pelaksanaan-budget").text('Rp '+ formattedNumber);
     
               temp_total_pelaksanaan_budget = number;
               totalRencanaBudget();
          }

          function calculatePelaksanaanRealisasi() {
               var total_pelaksanaan_realisasi = 0;

               $(".pelaksanaan-realisasi").each(function() {
                    total_pelaksanaan_realisasi += parseFloat($(this).val());
               });

               var number = total_pelaksanaan_realisasi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total-pelaksanaan-realisasi").text('Rp '+ formattedNumber);
     
               temp_total_pelaksanaan_realisasi = number;
               totalRencanaRealisasi();
          }

          function calculatePenyusunanBudget() {
               var total_penyusunan_budget = 0;

               $(".penyusunan-budget").each(function() {
                    total_penyusunan_budget += parseFloat($(this).val());
               });

               var number = total_penyusunan_budget;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total-penyusunan-budget").text('Rp '+ formattedNumber);
     
               temp_total_penyusunan_budget = number;
               totalRencanaBudget();
          }

          function calculatePenyusunanRealisasi() {
               var total_penyusunan_realisasi = 0;

               $(".penyusunan-realisasi").each(function() {
                    total_penyusunan_realisasi += parseFloat($(this).val());
               });

               var number = total_penyusunan_realisasi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total-penyusunan-realisasi").text('Rp '+ formattedNumber);
     
               temp_total_penyusunan_realisasi = number;
               totalRencanaRealisasi();
          }


          function calculateSwakelolaBudget() {
               var total_swakelola_budget = 0;
          
               $(".swakelola-budget").each(function() {
                    total_swakelola_budget += parseFloat($(this).val());
               });

               temp_total_swakelola_budget = total_swakelola_budget;
               totalSwakelolaBudget();
          }

          function updateTotalPemetaanBudget() {
               var total_pagu_budget = 0;
               $(".pemetaan-budget").each(function() {
                    total_pagu_budget += parseInt($(this).val());
               });

               temp_total_budget = total_pagu_budget;
               totalRencanaBudget();
             
          }  

           function updateTotalPemetaanRealisasi() {
               var total_pagu_realisasi = 0;
               $(".pemetaan-realisasi").each(function() {
                    total_pagu_realisasi += parseInt($(this).val());
               });

               temp_total_realisasi = total_pagu_realisasi;
              
               totalRencanaRealisasi();
          }  


          function totalSwakelolaBudget(){
               var periode_id = $('#periode_id').val();
               if(periode_id)
               {
                   
                    var total_swakelola =  temp_total_swakelola_budget;
                    const min_swakelola = pagu_apbn * 40 / 100;                       
                    if (min_swakelola > total_swakelola) 
                    {
                    var alt = '';

                     
                       alt +='<h4>Info!</h4>';
                       alt += 'Anggaran swakelola tidak boleh kurang dari <b>Rp'+ accounting.formatNumber(min_swakelola, 0, ".", ".") +' </b> atau  <b>40%</b> dari total APBN.';
                       $('#alert-swakelola').show().html(alt);
                       $('#total-budget').removeClass('text-black').addClass('text-red').addClass('blinking-text');
                       $('#simpan').prop('disabled',true);

                    } else {
                           
                       $('#alert-swakelola').html('').hide();
                       $('#total-budget').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
                       $('#simpan').prop('disabled',false);
                    }


               } 

          }

          function totalRencanaBudget() {
               
               total_budget = temp_total_budget;
               var number = total_budget;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
               var periode_id = $('#periode_id').val();
              

               if(periode_id)
               {    
                   
                    var total_jasa_konsultan = temp_total_identifikasi_budget + temp_total_pelaksanaan_budget + temp_total_penyusunan_budget;
                    var total_swakelola =  ''
                    const min_jasa = pagu_apbn * 60 / 100;                       
     
                    if (min_jasa > total_jasa_konsultan) 
                    {
                    var alt = '';

                     
                       alt +='<h4>Info!</h4>';
                       alt += 'Anggaran jasa konsultan tidak boleh kurang dari <b>Rp'+ accounting.formatNumber(min_jasa, 0, ".", ".") +' </b> atau  <b>60%</b> dari total APBN.';
                       $('#alert-jasa-konsultasi').show().html(alt);
                       $('#total-budget').removeClass('text-black').addClass('text-red').addClass('blinking-text');
                       $('#simpan').prop('disabled',true);

                    } else {
                           
                       $('#alert-jasa-konsultasi').html('').hide();
                       $('#total-budget').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
                       $('#simpan').prop('disabled',false);
                    }
               }
               
               $('#total-budget').html('<b>Rp. '+formattedNumber+'</b>');
               // $('#total_rencana_sec').html('<b>Rp. '+formattedNumber+'</b>');
               // $('#total_rencana_inp').val(number);
          }

          function totalRencanaRealisasi() {
               
               total_realisasi = temp_total_realisasi;
               var number = total_realisasi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
               $('#total-realisasi').html('<b>Rp. '+formattedNumber+'</b>');
               
          }


          function getChecklistIdentifikasi(){

               $("#checklist-rk").on("input", function(e) {
                    const checkedCount =  $('.item-potensi:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-rk").val('true');
                         $('#startdate-potensi').prop("disabled", false);
                         $('#enddate-potensi').prop("disabled", false);
                         $('#budget-potensi').prop("disabled", false);
                         $('#realisasi-potensi').prop("disabled", false);
                         $('#file-potensi').prop("disabled", false);
                         
                    }else{
                        $("#checklist-rk").val('false'); 
                        $('#startdate-potensi').prop("disabled", true).val('');
                        $('#enddate-potensi').prop("disabled", true).val('');
                        $('#budget-potensi').prop("disabled", true).val('0');
                        $('#realisasi-potensi').prop("disabled", true).val('0');
                        $('#file-potensi').prop("disabled", true);
                    }  

                    calculateIdentifikasiBudget();
                    updateTotalPemetaanBudget();

                    calculateIdentifikasiRealisasi();
                    updateTotalPemetaanRealisasi();     
               }); 

               $("#checklist-sl").on("input", function(e) {
                    const checkedCount =  $('.item-potensi:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-sl").val('true');
                         $('#startdate-potensi').prop("disabled", false);
                         $('#enddate-potensi').prop("disabled", false);
                         $('#budget-potensi').prop("disabled", false);
                         $('#realisasi-potensi').prop("disabled", false);
                         $('#file-potensi').prop("disabled", false);
                        
                    }else{
                         $("#checklist-sl").val('false');
                         $('#startdate-potensi').prop("disabled", true).val('');
                         $('#enddate-potensi').prop("disabled", true).val('');
                         $('#budget-potensi').prop("disabled", true).val('0');
                         $('#realisasi-potensi').prop("disabled", true).val('0');
                         $('#file-potensi').prop("disabled", true); 
                    }

                    calculateIdentifikasiBudget();
                    updateTotalPemetaanBudget();
                    calculateIdentifikasiRealisasi();
                    updateTotalPemetaanRealisasi();      
               });  

               $("#checklist-kor").on("input", function(e) {
                    const checkedCount =  $('.item-potensi:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-kor").val('true');
                         $('#startdate-potensi').prop("disabled", false);
                         $('#enddate-potensi').prop("disabled", false);
                         $('#budget-potensi').prop("disabled", false);
                         $('#realisasi-potensi').prop("disabled", false);
                         $('#file-potensi').prop("disabled", false);
                         
                    }else{
                         $("#checklist-kor").val('false');
                         $('#startdate-potensi').prop("disabled", true).val('');
                         $('#enddate-potensi').prop("disabled", true).val('');
                         $('#budget-potensi').prop("disabled", true).val('0');
                         $('#realisasi-potensi').prop("disabled", true).val('0');
                         $('#file-potensi').prop("disabled", true);     
                    }  

                    calculateIdentifikasiBudget();
                    updateTotalPemetaanBudget();
                    calculateIdentifikasiRealisasi();
                    updateTotalPemetaanRealisasi();  
               }); 

               $("#checklist-ds").on("input", function(e) {
                    const checkedCount =  $('.item-potensi:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-ds").val('true');
                         $('#startdate-potensi').prop("disabled", false);
                         $('#enddate-potensi').prop("disabled", false);
                         $('#budget-potensi').prop("disabled", false);
                         $('#realisasi-potensi').prop("disabled", false);
                         $('#file-potensi').prop("disabled", false);
                        
                    }else{
                         $("#checklist-ds").val('false');
                         $('#startdate-potensi').prop("disabled", true).val('');
                         $('#enddate-potensi').prop("disabled", true).val('');
                         $('#budget-potensi').prop("disabled", true).val('0');
                         $('#realisasi-potensi').prop("disabled", true).val('0');
                         $('#file-potensi').prop("disabled", true);   
                    }

                    calculateIdentifikasiBudget();
                    updateTotalPemetaanBudget();
                    calculateIdentifikasiRealisasi();
                    updateTotalPemetaanRealisasi();     
               }); 

              

          }




          function getChecklistPelaksanaan(){

              


               $("#checklist-lq").on("input", function(e) {
                     const checkedCount =  $('.item-sektor:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-lq").val('true');
                         $('#startdate-sektor').prop("disabled", false);
                         $('#enddate-sektor').prop("disabled", false);
                         $('#budget-sektor').prop("disabled", false);
                         $('#realisasi-sektor').prop("disabled", false);
                         $('#file-sektor').prop("disabled", false);
                         
                         
                    }else{
                        $("#checklist-lq").val('false'); 
                        $('#startdate-sektor').prop("disabled", true).val('');
                        $('#enddate-sektor').prop("disabled", true).val('');
                        $('#budget-sektor').prop("disabled", true).val('0');
                        $('#realisasi-sektor').prop("disabled", true).val('0');
                        $('#file-sektor').prop("disabled", true);
                    }

                    calculatePelaksanaanBudget();
                    updateTotalPemetaanBudget();
                    calculatePelaksanaanRealisasi();
                    updateTotalPemetaanRealisasi();     
               }); 

               $("#checklist-shift-share").on("input", function(e) {
                     const checkedCount =  $('.item-sektor:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-shift-share").val('true');
                         $('#startdate-sektor').prop("disabled", false);
                         $('#enddate-sektor').prop("disabled", false);
                         $('#budget-sektor').prop("disabled", false);
                         $('#realisasi-sektor').prop("disabled", false);
                         $('#file-sektor').prop("disabled", false);
                        
                    }else{
                         $("#checklist-shift-share").val('false');
                         $('#startdate-sektor').prop("disabled", true).val('');
                         $('#enddate-sektor').prop("disabled", true).val('');
                         $('#budget-sektor').prop("disabled", true).val('0');
                         $('#realisasi-sektor').prop("disabled", true).val('0');
                         $('#file-sektor').prop("disabled", true); 
                    }
                    calculatePelaksanaanBudget();
                    updateTotalPemetaanBudget();
                    calculatePelaksanaanRealisasi();
                    updateTotalPemetaanRealisasi();     
               });  

               $("#checklist-tipologi-sektor").on("input", function(e) {
                     const checkedCount =  $('.item-sektor:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-tipologi-sektor").val('true');
                         $('#startdate-sektor').prop("disabled", false);
                         $('#enddate-sektor').prop("disabled", false);
                         $('#budget-sektor').prop("disabled", false);
                         $('#realisasi-sektor').prop("disabled", false);
                         $('#file-sektor').prop("disabled", false);
                    }else{
                         $("#checklist-tipologi-sektor").val('false');
                         $('#startdate-sektor').prop("disabled", true).val('');
                         $('#enddate-sektor').prop("disabled", true).val('');
                         $('#budget-sektor').prop("disabled", true).val('0');
                         $('#realisasi-sektor').prop("disabled", true).val('0');
                         $('#file-sektor').prop("disabled", true);
                    } 

                    calculatePelaksanaanBudget();
                    updateTotalPemetaanBudget();
                    calculatePelaksanaanRealisasi();
                    updateTotalPemetaanRealisasi();     
               }); 

               $("#checklist-klassen").on("input", function(e) {
                     const checkedCount =  $('.item-sektor:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-klassen").val('true');
                         $('#startdate-sektor').prop("disabled", false);
                         $('#enddate-sektor').prop("disabled", false);
                         $('#budget-sektor').prop("disabled", false);
                         $('#realisasi-sektor').prop("disabled", false);
                         $('#file-sektor').prop("disabled", false);
                    }else{
                         $("#checklist-klassen").val('false');
                         $('#startdate-sektor').prop("disabled", true).val('');
                         $('#enddate-sektor').prop("disabled", true).val('');
                         $('#budget-sektor').prop("disabled", true).val('0');
                         $('#realisasi-sektor').prop("disabled", true).val('0');
                         $('#file-sektor').prop("disabled", true);                  
                    }  
                    calculatePelaksanaanBudget();
                    updateTotalPemetaanBudget();
                    calculatePelaksanaanRealisasi();
                    updateTotalPemetaanRealisasi();    
               }); 

               

          }


          function getChecklistPetaInvenstasi(){

               $("#checklist-summary-sektor-unggulan").on("input", function(e) {
                    const checkedCount =  $('.item-penyusunan:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-summary-sektor-unggulan").val('true');
                         $("#startdate-penyusunan").prop("disabled", false);
                         $("#enddate-penyusunan").prop("disabled", false);
                         $('#budget-penyusunan').prop("disabled", false);
                         $('#realisasi-penyusunan').prop("disabled", false);
                         $('#file-penyusunan').prop("disabled", false);
                    }else{
                         $("#checklist-summary-sektor-unggulan").val('false'); 
                         $("#startdate-penyusunan").prop("disabled", true).val('');
                         $("#enddate-penyusunan").prop("disabled", true).val('');
                         $('#budget-penyusunan').prop("disabled", true).val('0');
                         $('#realisasi-penyusunan').prop("disabled", true).val('0');
                         $('#file-penyusunan').prop("disabled", true);
                        
                    }
                    calculatePenyusunanBudget();
                    updateTotalPemetaanBudget();
                    calculatePenyusunanRealisasi();
                    updateTotalPemetaanRealisasi();     
               }); 

               $("#checklist-sektor-unggulan").on("input", function(e) {
                     const checkedCount =  $('.item-penyusunan:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-sektor-unggulan").val('true');
                         $("#startdate-penyusunan").prop("disabled", false);
                         $("#enddate-penyusunan").prop("disabled", false);
                         $('#budget-penyusunan').prop("disabled", false);
                         $('#realisasi-penyusunan').prop("disabled", false);
                          $('#file-penyusunan').prop("disabled", false);
                         
                    }else{
                         $("#checklist-sektor-unggulan").val('false'); 
                         $("#startdate-penyusunan").prop("disabled", true).val('');
                         $("#enddate-penyusunan").prop("disabled", true).val('');
                         $('#budget-penyusunan').prop("disabled", true).val('0');
                         $('#realisasi-penyusunan').prop("disabled", true).val('0');
                         $('#file-penyusunan').prop("disabled", true);
                         
                    }
                    calculatePenyusunanBudget();
                    updateTotalPemetaanBudget();
                    calculatePenyusunanRealisasi();
                    updateTotalPemetaanRealisasi();     
               });  

               $("#checklist-potensi-pasar").on("input", function(e) {
                     const checkedCount =  $('.item-penyusunan:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-potensi-pasar").val('true');
                         $("#startdate-penyusunan").prop("disabled", false);
                         $("#enddate-penyusunan").prop("disabled", false);
                         $('#budget-penyusunan').prop("disabled", false);
                         $('#realisasi-penyusunan').prop("disabled", false);
                         $('#file-penyusunan').prop("disabled", false);
                         
                    }else{
                         $("#checklist-potensi-pasar").val('false');
                         $("#startdate-penyusunan").prop("disabled", true).val('');
                         $("#enddate-penyusunan").prop("disabled", true).val('');
                         $('#budget-penyusunan').prop("disabled", true).val('0');
                         $('#realisasi-penyusunan').prop("disabled", true).val('0');
                         $('#file-penyusunan').prop("disabled", true); 
                        
                    } 
                    calculatePenyusunanBudget(); 
                    updateTotalPemetaanBudget();
                    calculatePenyusunanRealisasi();
                    updateTotalPemetaanRealisasi();  
               }); 

               $("#checklist-parameter-sektor-unggulan").on("input", function(e) {
                     const checkedCount =  $('.item-penyusunan:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-parameter-sektor-unggulan").val('true');
                         $("#startdate-penyusunan").prop("disabled", false);
                         $("#enddate-penyusunan").prop("disabled", false);
                         $('#budget-penyusunan').prop("disabled", false);
                         $('#realisasi-penyusunan').prop("disabled", false);
                         $('#file-penyusunan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-parameter-sektor-unggulan").val('false');
                         $("#startdate-penyusunan").prop("disabled", true).val('');
                         $("#enddate-penyusunan").prop("disabled", true).val('');
                         $('#budget-penyusunan').prop("disabled", true).val('0');
                         $('#realisasi-penyusunan').prop("disabled", true).val('0');
                         $('#file-penyusunan').prop("disabled", true);    
                    }
                    calculatePenyusunanBudget(); 
                    updateTotalPemetaanBudget();
                    calculatePenyusunanRealisasi();
                    updateTotalPemetaanRealisasi();       
               }); 

                $("#checklist-subsektor-unggulan").on("input", function(e) {
                     const checkedCount =  $('.item-penyusunan:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-subsektor-unggulan").val('true');
                         $("#startdate-penyusunan").prop("disabled", false);
                         $("#enddate-penyusunan").prop("disabled", false);
                         $('#budget-penyusunan').prop("disabled", false);
                         $('#realisasi-penyusunan').prop("disabled", false);
                         $('#file-penyusunan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-subsektor-unggulan").val('false');
                         $("#startdate-penyusunan").prop("disabled", true).val('');
                         $("#enddate-penyusunan").prop("disabled", true).val('');
                         $('#budget-penyusunan').prop("disabled", true).val('0');
                         $('#realisasi-penyusunan').prop("disabled", true).val('0');
                         $('#file-penyusunan').prop("disabled", true); 
                         
                    }
                    calculatePenyusunanBudget(); 
                    updateTotalPemetaanBudget();
                    calculatePenyusunanRealisasi();
                    updateTotalPemetaanRealisasi();      
               });  

               $("#checklist-intensif-daerah").on("input", function(e) {
                     const checkedCount =  $('.item-penyusunan:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-intensif-daerah").val('true');
                         $("#startdate-penyusunan").prop("disabled", false);
                         $("#enddate-penyusunan").prop("disabled", false);
                         $('#budget-penyusunan').prop("disabled", false);
                         $('#realisasi-penyusunan').prop("disabled", false);
                         $('#file-penyusunan').prop("disabled", false); 
                        
                    }else{
                         $("#checklist-intensif-daerah").val('false');
                         $("#startdate-penyusunan").prop("disabled", true).val('');
                         $("#enddate-penyusunan").prop("disabled", true).val('');
                         $('#budget-penyusunan').prop("disabled", true).val('0');
                         $('#realisasi-penyusunan').prop("disabled", true).val('0');
                         $('#file-penyusunan').prop("disabled", true);   
                    }

                    calculatePenyusunanBudget();
                    updateTotalPemetaanBudget();
                     calculatePenyusunanRealisasi();
                    updateTotalPemetaanRealisasi();    
               }); 

               $("#checklist-potensi-lanjutan").on("input", function(e) {
                     const checkedCount =  $('.item-penyusunan:checked').length;
                    if(checkedCount > 0 || e.currentTarget.value == 'false')
                    {
                         $("#checklist-potensi-lanjutan").val('true');
                         $("#startdate-penyusunan").prop("disabled", false);
                         $("#enddate-penyusunan").prop("disabled", false);
                         $('#budget-penyusunan').prop("disabled", false);
                         $('#realisasi-penyusunan').prop("disabled", false);
                         $('#file-penyusunan').prop("disabled", false); 
                        
                    }else{
                         $("#checklist-potensi-lanjutan").val('false');
                         $("#startdate-penyusunan").prop("disabled", true).val('');
                         $("#enddate-penyusunan").prop("disabled", true).val('');
                         $('#budget-penyusunan').prop("disabled", true).val('0');
                         $('#realisasi-penyusunan').prop("disabled", true).val('0');
                         $('#file-penyusunan').prop("disabled", true);   
                    }
                    calculatePenyusunanBudget(); 
                    updateTotalPemetaanBudget();
                    calculatePenyusunanRealisasi();
                    updateTotalPemetaanRealisasi();      
               }); 

               
          }


          function updateTotalPemetaanBudget() {
               var total_pagu_budget = 0;
               $(".pemetaan-budget").each(function() {
                    total_pagu_budget += parseInt($(this).val());
               });

               var total_pagu_realisasi = 0;
               $(".pemetaan-realisasi").each(function() {
                    total_pagu_realisasi += parseInt($(this).val());
               });

               temp_total_budget = total_pagu_budget;
               temp_total_realisasi = total_pagu_realisasi;
               totalRencanaBudget();
          }  


          function UploadFilePotensi()
          {


               $("#file-potensi").click(()=> {
                 $("#desc-potensi").trigger("click");
               });

               $("#desc-potensi").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
                 
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;

                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-1a"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-1a" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-1a"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-potensi').html(row);
                         file_data_potensi = ReConvertFile(files[0].name,file);
                         btn_potensi = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-potensi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'1a');  
              });  

          }


          


           function UploadFilePersiapan()
          {


               $("#file-persiapan").click(()=> {
                 $("#desc-a-pro").trigger("click");
               });

               $("#desc-a-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-2a"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-2a" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-2a"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-persiapan').html(row);
                         file_fgd_persiapan =  ReConvertFile(files[0].name,file);
                         btn_fgd_persiapan = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-persiapan" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'2a');  
              });  

          }

           function UploadFileFGDIndentifikasi()
          {


               $("#file-fgd-identifikasi").click(()=> {
                 $("#desc-b-pro").trigger("click");
               });

               $("#desc-b-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-2b"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-2b" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-2b"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-fgd-identifikasi').html(row);
                         file_data_identifikasi= ReConvertFile(files[0].name,file);
                         btn_data_identifikasi = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   

               }        
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-fgd-identifikasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'2b');  
              });  

          }

          function UploadFileSektor()
          {


               $("#file-sektor").click(()=> {        
                 $("#keterangan-sektor").trigger("click");
               });

               $("#keterangan-sektor").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Pengolahan">';
                         row +='<div id="viewPdf" class="viewpdf group-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-2c"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-2c" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-2c"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-sektor').html(row);
                         file_data_sektor = ReConvertFile(files[0].name,file);
                         btn_data_sektor = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   

               }        
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-sektor" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'2c');  
              });  

          }


           function UploadFileFGDKlarifikasi()
          {


               $("#file-fgd-klarifikasi").click(()=> {
                 $("#desc-d-pro").trigger("click");
               });

               $("#desc-d-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  
                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-2d"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-2d" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-2d"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-fgd-klarifikasi').html(row);
                        file_data_klarifikasi = ReConvertFile(files[0].name,file);
                        btn_data_klarifikasi = 'true';
                        getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-fgd-klarifikasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'2d');  
              });  

          }

           function UploadFileFGDKonfirmasi()
          {


               $("#file-fgd-konfirmasi").click(()=> {
                 $("#desc-e-pro").trigger("click");
               });

               $("#desc-e-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  
                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-2e"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDFi</div>';

                         row +=`<div id="modal-view-2e" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-2e"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-fgd-konfirmasi').html(row);
                         file_data_finalisasi = ReConvertFile(files[0].name,file);
                         btn_data_finalisasi = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-fgd-konfirmasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'2e');  
              });  

          }


          function UploadFilePenyusunan()
          {


               $("#file-penyusunan").click(()=> {
                 $("#keterangan-penyusunan").trigger("click");
               });

               $("#keterangan-penyusunan").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  
                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Penyusunan">';
                         row +='<div id="viewPdf" class="viewpdf group-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-3a"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-3a" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-3a"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-penyusunan').html(row);
                         file_data_penyusunan = ReConvertFile(files[0].name,file);
                         btn_data_penyusunan = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-penyusunan" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'3a');   
              });  

          }

          function UploadFilePenyusunanInfoGrafis()
          {


               $("#file-info-grafis").click(()=> {
                 $("#desc-b-ppro").trigger("click");
               });

               $("#desc-b-ppro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
                 
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Penyusunan">';
                         row +='<div id="viewPdf" class="viewpdf group-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-3b"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-3b" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-3b"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-info-grafis').html(row);
                         file_penyusunan_infografis = ReConvertFile(files[0].name,file);
                         btn_penyusunan_infografis = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-info-grafis" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'3b');   
              });  

          }

          function UploadFileDokumentasiInfoGrafis()
          {


               $("#file-doc-info-grafis").click(()=> {
                 $("#desc-c-ppro").trigger("click");
               });

               $("#desc-c-ppro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
                 
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Penyusunan">';
                         row +='<div id="viewPdf" class="viewpdf group-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-3c"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-3c" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-3c"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-doc-info-grafis').html(row);
                         file_doc_info_grafis = ReConvertFile(files[0].name,file);
                         btn_doc_info_grafis = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-doc-info-grafis" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'3c');   
              });  

          }

          function ReConvertFile(name,file){

               var files = JSON.stringify({name:name.replace(/\s+/g, '-').toLowerCase().replace(/\.pdf$/, ''),'file':file});
               return files;
          }

          function EmbedFile(file,tmp){


                let row = ``;
                      row +=`<div class="modal-dialog">`;
                          row +=`<div class="modal-content">`;

                                     row +=`<div class="modal-header">`;
                                       row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
                                       row +=`<h4 class="modal-title">Lihat File PDF</h4>`;
                                     row +=`</div>`;

                                    
                                     row +=`<div class="modal-body">`;
                                      row +=`<embed src="`+file+`#page=1&zoom=65" width="575" height="500">`;
                                     row +=`</div>`;


                                   row +=`<div class="modal-footer">`;
                                           row +=`<button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>`;
                                   row +=`</div>`;
                         row +=`</div>`;
                       row +=`</div>`;   
                    $('#FormView-'+ tmp).html(row);  

          }

          function getperiode(){
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=POST&action=pemetaan',
                    success: function(data) {
                         var select =  $('#periode_id');
                           select.empty();
                         $.each(data.result, function(index, option) {

                             if(option.value > '2023')
                             {   
                                   select.append($('<option>', {
                                        value: option.value,
                                        text: option.text
                                   }));
                             }  
                         });
                        

                         
                         $('#periode_id').prop('disabled', data.selected);
                         select.selectpicker('refresh');
                         periode = data.result; 
                    },
                    error: function( error) {}
               });

               $('#periode_id').on('change', function() {
                    var index = $(this).val();
                    let find = periode.find(o => o.value === index); 

                    pagu_apbn = find.pagu_promosi; 
                    //isi pagu
                    var apbn = accounting.formatNumber(find.pagu_promosi, 0, ".", "."); 
                    $('#pagu-apbn').html('<b>Rp '+ apbn +'</b>');


                    var total_jasa_konsultan = temp_total_identifikasi_budget + temp_total_pelaksanaan_budget + temp_total_penyusunan_budget;
                    const min_jasa = pagu_apbn * 60 / 100;  

                     if (min_jasa > total_jasa_konsultan) 
                     {
                         var alt = '';
                          alt +='<h4>Info!</h4>';
                          alt += 'Anggaran jasa konsultan tidak boleh kurang dari <b>Rp '+ accounting.formatNumber(min_jasa, 0, ".", ".") +'</b> atau <b>60%</b> dari total APBN.';
                          $('#alert-jasa-konsultasi').show().html(alt);
                          $('#simpan').prop('disabled',true);

                     }else{
                          $('#alert-jasa-konsultasi').hide().html('');
                          $('#simpan').prop('disabled',false);
                     }
                      
                     var total_sakelola = temp_total_swakelola_budget;
                     const min_swakelola = pagu_apbn * 40 / 100;
                     if (min_swakelola > total_sakelola) 
                     {
                         var alt = '';
                          alt +='<h4>Info!</h4>';
                          alt += 'Anggaran swakelola tidak boleh kurang dari <b>Rp '+ accounting.formatNumber(min_jasa, 0, ".", ".") +'</b> atau <b>40%</b> dari total APBN.';
                          $('#alert-swakelola').show().html(alt);
                          $('#simpan').prop('disabled',true);

                     }else{
                          $('#alert-swakelola').hide().html('');
                          $('#simpan').prop('disabled',false);
                     }
               
                    //isi input
                    $("input").prop("disabled", false);
                    $(".file").prop("disabled", false);
                    // $("#simpan").prop("disabled", false);
                    // $("#kirim").prop("disabled", false);


                    $('#startdate-potensi').prop("disabled", true);
                    $('#enddate-potensi').prop("disabled", true); 
                    $('#budget-potensi').prop("disabled", true); 
                    $('#realisasi-potensi').prop("disabled", true);
                    $('#file-potensi').prop("disabled", true); 

                    $('#startdate-sektor').prop("disabled", true);
                    $('#enddate-sektor').prop("disabled", true); 
                    $('#budget-sektor').prop("disabled", true); 
                    $('#realisasi-sektor').prop("disabled", true); 
                    $('#file-sektor').prop("disabled", true);

 
                    $('#startdate-penyusunan').prop("disabled", true);
                    $('#enddate-penyusunan').prop("disabled", true); 
                    $('#budget-penyusunan').prop("disabled", true); 
                    $('#realisasi-penyusunan').prop("disabled", true); 
                   
                    $('#file-penyusunan').prop("disabled", true); 
                    
                   
               });
          }



          function SendingData(form) {
             
               var pesan = (form.type === 'kirim') ? 'Terkirim ke Pusat.' : 'Berhasil Simpan.';
               var periode_id = $('#periode_id').val(); 


               var checklist_rk = $('#checklist-rk').val();
               var checklist_sl = $('#checklist-sl').val();
               var checklist_kor = $('#checklist-kor').val();
               var checklist_ds = $('#checklist-ds').val();


               var checklist_lq = $('#checklist-lq').val();
               var checklist_shift_share = $('#checklist-shift-share').val();
               var checklist_tipologi_sektor = $('#checklist-tipologi-sektor').val();
               var checklist_klassen = $('#checklist-klassen').val();

               var checklist_summary_sektor_unggulan = $('#checklist-summary-sektor-unggulan').val();
               var checklist_sektor_unggulan = $('#checklist-sektor-unggulan').val();
               var checklist_potensi_pasar = $('#checklist-potensi-pasar').val();
               var checklist_parameter_sektor_unggulan = $('#checklist-parameter-sektor-unggulan').val();
               var checklist_subsektor_unggulan = $('#checklist-subsektor-unggulan').val();
               var checklist_intensif_daerah = $('#checklist-intensif-daerah').val();
               var checklist_potensi_lanjutan = $('#checklist-potensi-lanjutan').val();
              



               var arr = {
                    'periode_id':periode_id,
                    'status_laporan_id':form.status_laporan_id,

                    'checklist_rk':checklist_rk,
                    'checklist_sl':checklist_sl,
                    'checklist_kor':checklist_kor, 
                    'checklist_ds':checklist_ds, 

                    'type_potensi':'jasa-konsultan', 
                    'tgl_awal_potensi':$('#startdate-potensi').val(),
                    'tgl_ahir_potensi':$('#enddate-potensi').val(),
                    'budget_potensi':$('#budget-potensi').val(),
                    'realisasi_potensi':$('#realisasi-potensi').val(),
                    'keterangan_potensi':file_data_potensi,

                   
                    'type_fgd_persiapan':'swakelola', 
                    'tgl_awal_fgd_persiapan':$('#startdate-a-pro').val(),
                    'tgl_ahir_fgd_persiapan':$('#enddate-a-pro').val(),
                    'budget_fgd_persiapan':$('#budget-a-pro').val(),
                    'realisasi_fgd_persiapan':$('#realisasi-a-pro').val(),
                    'keterangan_fgd_persiapan':file_fgd_persiapan,


                    'type_fgd_identifikasi':'swakelola', 
                    'tgl_awal_fgd_identifikasi':$('#startdate-b-pro').val(),
                    'tgl_ahir_fgd_identifikasi':$('#enddate-b-pro').val(),
                    'budget_fgd_identifikasi':$('#budget-b-pro').val(),
                    'realisasi_fgd_identifikasi':$('#realisasi-b-pro').val(),
                    'keterangan_fgd_identifikasi':file_data_identifikasi,
                    
                    'checklist_lq':checklist_lq,
                    'checklist_shift_share':checklist_shift_share,
                    'checklist_tipologi_sektor':checklist_tipologi_sektor, 
                    'checklist_klassen':checklist_klassen, 
                    
                    'type_sektor':'jasa-konsultan', 
                    'tgl_awal_sektor':$('#startdate-sektor').val(),
                    'tgl_ahir_sektor':$('#enddate-sektor').val(),
                    'budget_sektor':$('#budget-sektor').val(),
                    'realisasi_sektor':$('#realisasi-sektor').val(),
                    'keterangan_sektor':file_data_sektor,

                    'type_fgd_klarifikasi':'swakelola',
                    'tgl_awal_fgd_klarifikasi':$('#startdate-d-pro').val(),
                    'tgl_ahir_fgd_klarifikasi':$('#enddate-d-pro').val(),
                    'budget_fgd_klarifikasi':$('#budget-d-pro').val(),
                    'realisasi_fgd_klarifikasi':$('#realisasi-d-pro').val(),
                    'keterangan_fgd_klarifikasi':file_data_klarifikasi,

                    'type_finalisasi':'swakelola', 
                    'tgl_awal_finalisasi':$('#startdate-e-pro').val(),
                    'tgl_ahir_finalisasi':$('#enddate-e-pro').val(),
                    'budget_finalisasi':$('#budget-e-pro').val(),
                    'realisasi_finalisasi':$('#realisasi-e-pro').val(),
                    'keterangan_finalisasi':file_data_finalisasi,
                    
                    'checklist_summary_sektor_unggulan':checklist_summary_sektor_unggulan,     
                    'checklist_sektor_unggulan':checklist_sektor_unggulan,
                    'checklist_potensi_pasar':checklist_potensi_pasar,
                    'checklist_parameter_sektor_unggulan':checklist_parameter_sektor_unggulan,
                    'checklist_subsektor_unggulan':checklist_subsektor_unggulan,
                    'checklist_intensif_daerah':checklist_intensif_daerah,
                    'checklist_potensi_lanjutan':checklist_potensi_lanjutan,
                    
                    'type_penyusunan':'jasa-konsultan', 
                    'tgl_awal_penyusunan':$('#startdate-penyusunan').val(),
                    'tgl_ahir_penyusunan':$('#enddate-penyusunan').val(),
                    'budget_penyusunan':$('#budget-penyusunan').val(),
                    'realisasi_penyusunan':$('#realisasi-penyusunan').val(),
                    'keterangan_penyusunan':file_data_penyusunan,

                    'type_info_grafis':'swakelola', 
                    'tgl_awal_info_grafis':$('#startdate-b-ppro').val(),
                    'tgl_ahir_info_grafis':$('#enddate-b-ppro').val(),
                    'budget_info_grafis':$('#budget-b-ppro').val(),
                    'realisasi_info_grafis':$('#realisasi-b-ppro').val(),
                    'keterangan_info_grafis':file_penyusunan_infografis,

                    'type_dokumentasi':'swakelola',
                    'tgl_awal_dokumentasi':$('#startdate-c-ppro').val(),
                    'tgl_ahir_dokumentasi':$('#enddate-c-ppro').val(),
                    'budget_dokumentasi':$('#budget-c-ppro').val(),
                    'realisasi_dokumentasi':$('#realisasi-c-ppro').val(),
                    'keterangan_dokumentasi':file_doc_info_grafis,
 
               };
               
              
              
          
               $.ajax({
                    type:"POST",
                    url: BASE_URL+'/api/pemetaan',
                    data:arr,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                         Swal.fire({
                              title: 'Sukses!',
                              text: pesan,
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/pemetaan');
                              }
                         });
                    },

                    error: (respons) => {

                         errors = respons.responseJSON;
                         
                         if(errors.messages.tgl_awal_potensi)
                         {
                              $('#startdate-potensi-alert').addClass('has-error');
                              $('#startdate-potensi-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_potensi +'</strong>');
                         } else {
                              $('#startdate-potensi-alert').removeClass('has-error');
                              $('#startdate-potensi-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_potensi)
                         {
                              $('#enddate-potensi-alert').addClass('has-error');
                              $('#enddate-potensi-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_potensi +'</strong>');
                         } else {
                              $('#enddate-potensi-alert').removeClass('has-error');
                              $('#enddate-potensi-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_potensi)
                         {
                              $('#budget-potensi-alert').addClass('has-error');
                              $('#budget-potensi-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_potensi +'</strong>');
                         } else {
                              $('#budget-potensi-alert').removeClass('has-error');
                              $('#budget-potensi-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.realisasi_potensi)
                         {
                              $('#realisasi-potensi-alert').addClass('has-error');
                              $('#realisasi-potensi-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_potensi +'</strong>');
                         } else {
                              $('#realisasi-potensi-alert').removeClass('has-error');
                              $('#realisasi-potensi-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.keterangan_potensi)
                         {
                              $('#desc-potensi-alert').addClass('has-error');
                              $('#desc-potensi-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_potensi +'</strong>');
                         } else {
                              $('#desc-potensi-alert').removeClass('has-error');
                              $('#desc-potensi-messages').removeClass('help-block').html('');
                         }



                         if(errors.messages.tgl_awal_fgd_persiapan)
                         {
                              $('#startdate-a-pro-alert').addClass('has-error');
                              $('#startdate-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_fgd_persiapan +'</strong>');
                         } else {
                              $('#startdate-a-pro-alert').removeClass('has-error');
                              $('#startdate-a-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_fgd_persiapan)
                         {
                              $('#enddate-a-pro-alert').addClass('has-error');
                              $('#enddate-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_fgd_persiapan +'</strong>');
                         } else {
                              $('#enddate-a-pro-alert').removeClass('has-error');
                              $('#enddate-a-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_fgd_persiapan)
                         {
                              $('#budget-a-pro-alert').addClass('has-error');
                              $('#budget-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_fgd_persiapan +'</strong>');
                         } else {
                              $('#budget-a-pro-alert').removeClass('has-error');
                              $('#budget-a-pro-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.realisasi_fgd_persiapan)
                         {
                              $('#realisasi-a-pro-alert').addClass('has-error');
                              $('#realisasi-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_fgd_persiapan +'</strong>');
                         } else {
                              $('#realisasi-a-pro-alert').removeClass('has-error');
                              $('#realisasi-a-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_fgd_persiapan)
                         {
                              $('#desc-a-pro-alert').addClass('has-error');
                              $('#desc-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_fgd_persiapan +'</strong>');
                         } else {
                              $('#desc-a-pro-alert').removeClass('has-error');
                              $('#desc-a-pro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.tgl_awal_fgd_identifikasi)
                         {
                              $('#startdate-b-pro-alert').addClass('has-error');
                              $('#startdate-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_fgd_identifikasi +'</strong>');
                         } else {
                              $('#startdate-b-pro-alert').removeClass('has-error');
                              $('#startdate-b-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_fgd_identifikasi)
                         {
                              $('#enddate-b-pro-alert').addClass('has-error');
                              $('#enddate-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_fgd_identifikasi +'</strong>');
                         } else {
                              $('#enddate-b-pro-alert').removeClass('has-error');
                              $('#enddate-b-pro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.budget_fgd_identifikasi)
                         {
                              $('#budget-b-pro-alert').addClass('has-error');
                              $('#budget-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_fgd_identifikasi +'</strong>');
                         } else {
                              $('#budget-b-pro-alert').removeClass('has-error');
                              $('#budget-b-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.realisasi_fgd_identifikasi)
                         {
                              $('#realisasi-b-pro-alert').addClass('has-error');
                              $('#realisasi-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_fgd_identifikasi +'</strong>');
                         } else {
                              $('#realisasi-b-pro-alert').removeClass('has-error');
                              $('#realisasi-b-pro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.keterangan_fgd_identifikasi)
                         {
                              $('#desc-b-pro-alert').addClass('has-error');
                              $('#desc-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_fgd_identifikasi +'</strong>');
                         } else {
                              $('#desc-b-pro-alert').removeClass('has-error');
                              $('#desc-b-pro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.tgl_awal_sektor)
                         {
                              $('#startdate-c-1-pro-alert').addClass('has-error');
                              $('#startdate-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_sektor +'</strong>');
                         } else {
                              $('#startdate-c-1-pro-alert').removeClass('has-error');
                              $('#startdate-c-1-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_sektor)
                         {
                              $('#enddate-c-1-pro-alert').addClass('has-error');
                              $('#enddate-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_sektor +'</strong>');
                         } else {
                              $('#enddate-c-1-pro-alert').removeClass('has-error');
                              $('#enddate-c-1-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.budget_sektor)
                         {
                              $('#budget-c-1-pro-alert').addClass('has-error');
                              $('#budget-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_sektor +'</strong>');
                         } else {
                              $('#budget-c-1-pro-alert').removeClass('has-error');
                              $('#budget-c-1-pro-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.realisasi_sektor)
                         {
                              $('#realisasi-c-1-pro-alert').addClass('has-error');
                              $('#realisasi-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_sektor +'</strong>');
                         } else {
                              $('#realisasi-c-1-pro-alert').removeClass('has-error');
                              $('#realisasi-c-1-pro-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.keterangan_pengolahan)
                         {
                              $('#desc-c-1-pro-alert').addClass('has-error');
                              $('#desc-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_pengolahan +'</strong>');
                         } else {
                              $('#desc-c-1-pro-alert').removeClass('has-error');
                              $('#desc-c-1-pro-messages').removeClass('help-block').html('');
                         }


                          


                  

  
                         if(errors.messages.tgl_awal_fgd_klarifikasi)
                         {
                              $('#startdate-d-pro-alert').addClass('has-error');
                              $('#startdate-d-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_fgd_klarifikasi +'</strong>');
                         } else {
                              $('#startdate-d-pro-alert').removeClass('has-error');
                              $('#startdate-d-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_fgd_klarifikasi)
                         {
                              $('#enddate-d-pro-alert').addClass('has-error');
                              $('#enddate-d-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_fgd_klarifikasi +'</strong>');
                         } else {
                              $('#enddate-d-pro-alert').removeClass('has-error');
                              $('#enddate-d-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.budget_fgd_klarifikasi)
                         {
                              $('#budget-d-pro-alert').addClass('has-error');
                              $('#budget-d-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_fgd_klarifikasi +'</strong>');
                         } else {
                              $('#budget-d-pro-alert').removeClass('has-error');
                              $('#budget-d-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.realisasi_fgd_klarifikasi)
                         {
                              $('#realisasi-d-pro-alert').addClass('has-error');
                              $('#realisasi-d-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_fgd_klarifikasi +'</strong>');
                         } else {
                              $('#realisasi-d-pro-alert').removeClass('has-error');
                              $('#realisasi-d-pro-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.keterangan_fgd_klarifikasi)
                         {
                              $('#desc-d-pro-alert').addClass('has-error');
                              $('#desc-d-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_fgd_klarifikasi +'</strong>');
                         } else {
                              $('#desc-d-pro-alert').removeClass('has-error');
                              $('#desc-d-pro-messages').removeClass('help-block').html('');
                         }



                          if(errors.messages.tgl_awal_finalisasi)
                         {
                              $('#startdate-e-pro-alert').addClass('has-error');
                              $('#startdate-e-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_finalisasi +'</strong>');
                         } else {
                              $('#startdate-e-pro-alert').removeClass('has-error');
                              $('#startdate-e-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_finalisasi)
                         {
                              $('#enddate-e-pro-alert').addClass('has-error');
                              $('#enddate-e-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_finalisasi +'</strong>');
                         } else {
                              $('#enddate-e-pro-alert').removeClass('has-error');
                              $('#enddate-e-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.budget_finalisasi)
                         {
                              $('#budget-e-pro-alert').addClass('has-error');
                              $('#budget-e-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_finalisasi +'</strong>');
                         } else {
                              $('#budget-e-pro-alert').removeClass('has-error');
                              $('#budget-e-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.realisasi_finalisasi)
                         {
                              $('#realisasi-e-pro-alert').addClass('has-error');
                              $('#realisasi-e-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_finalisasi +'</strong>');
                         } else {
                              $('#realisasi-e-pro-alert').removeClass('has-error');
                              $('#realisasi-e-pro-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.keterangan_finalisasi)
                         {
                              $('#desc-e-pro-alert').addClass('has-error');
                              $('#desc-e-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_finalisasi +'</strong>');
                         } else {
                              $('#desc-e-pro-alert').removeClass('has-error');
                              $('#desc-e-pro-messages').removeClass('help-block').html('');
                         }






                          if(errors.messages.tgl_awal_penyusunan)
                         {   
                              $('#startdate-a-ppro-alert').addClass('has-error');
                              $('#startdate-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_penyusunan +'</strong>');
                         } else {
                              $('#startdate-a-ppro-alert').removeClass('has-error');
                              $('#startdate-a-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_penyusunan)
                         {
                              $('#enddate-a-ppro-alert').addClass('has-error');
                              $('#enddate-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_penyusunan +'</strong>');
                         } else {
                              $('#enddate-a-ppro-alert').removeClass('has-error');
                              $('#enddate-a-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_penyusunan)
                         {
                              $('#budget-a-ppro-alert').addClass('has-error');
                              $('#budget-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_penyusunan +'</strong>');
                         } else {
                              $('#budget-a-ppro-alert').removeClass('has-error');
                              $('#budget-a-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.realisasi_penyusunan)
                         {
                              $('#realisasi-a-ppro-alert').addClass('has-error');
                              $('#realisasi-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_penyusunan +'</strong>');
                         } else {
                              $('#realisasi-a-ppro-alert').removeClass('has-error');
                              $('#realisasi-a-ppro-messages').removeClass('help-block').html('');
                         }



                          if(errors.messages.keterangan_penyusunan)
                         {
                              $('#desc-a-ppro-alert').addClass('has-error');
                              $('#desc-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_penyusunan +'</strong>');
                         } else {
                              $('#desc-a-ppro-alert').removeClass('has-error');
                              $('#desc-a-ppro-messages').removeClass('help-block').html('');
                         }


                 
                         if(errors.messages.tgl_awal_info_grafis)
                         {
                              $('#startdate-b-ppro-alert').addClass('has-error');
                              $('#startdate-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_info_grafis +'</strong>');
                         } else {
                              $('#startdate-b-ppro-alert').removeClass('has-error');
                              $('#startdate-b-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_info_grafis)
                         {
                              $('#enddate-b-ppro-alert').addClass('has-error');
                              $('#enddate-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_info_grafis +'</strong>');
                         } else {
                              $('#enddate-b-ppro-alert').removeClass('has-error');
                              $('#enddate-b-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_info_grafis)
                         {
                              $('#budget-b-ppro-alert').addClass('has-error');
                              $('#budget-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_info_grafis +'</strong>');
                         } else {
                              $('#budget-b-ppro-alert').removeClass('has-error');
                              $('#budget-b-ppro-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.realisasi_info_grafis)
                         {
                              $('#realisasi-b-ppro-alert').addClass('has-error');
                              $('#realisasi-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_info_grafis +'</strong>');
                         } else {
                              $('#realisasi-b-ppro-alert').removeClass('has-error');
                              $('#realisasi-b-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_info_grafis)
                         {
                              $('#desc-b-ppro-alert').addClass('has-error');
                              $('#desc-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_info_grafis +'</strong>');
                         } else {
                              $('#desc-b-ppro-alert').removeClass('has-error');
                              $('#desc-b-ppro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.tgl_awal_dokumentasi)
                         {
                              $('#startdate-c-ppro-alert').addClass('has-error');
                              $('#startdate-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_dokumentasi +'</strong>');
                         } else {
                              $('#startdate-c-ppro-alert').removeClass('has-error');
                              $('#startdate-c-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_dokumentasi)
                         {
                              $('#enddate-c-ppro-alert').addClass('has-error');
                              $('#enddate-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_dokumentasi +'</strong>');
                         } else {
                              $('#enddate-c-ppro-alert').removeClass('has-error');
                              $('#enddate-c-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_dokumentasi)
                         {
                              $('#budget-c-ppro-alert').addClass('has-error');
                              $('#budget-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_dokumentasi +'</strong>');
                         } else {
                              $('#budget-c-ppro-alert').removeClass('has-error');
                              $('#budget-c-ppro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.realisasi_dokumentasi)
                         {
                              $('#realisasi-c-ppro-alert').addClass('has-error');
                              $('#realisasi-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.realisasi_dokumentasi +'</strong>');
                         } else {
                              $('#realisasi-c-ppro-alert').removeClass('has-error');
                              $('#realisasi-c-ppro-messages').removeClass('help-block').html('');
                         }



                          if(errors.messages.keterangan_dokumentasi)
                         {
                              $('#desc-c-ppro-alert').addClass('has-error');
                              $('#desc-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_dokumentasi +'</strong>');
                         } else {
                              $('#desc-c-ppro-alert').removeClass('has-error');
                              $('#desc-c-ppro-messages').removeClass('help-block').html('');
                         }

                          
                    }
               });
          }
     });    

</script>
@stop