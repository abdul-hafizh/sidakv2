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
                                        <h3 class="card-text" id="pagu_promosi"></h3>
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
                                        <span>Total Pemetaan</span>
                                        <h3 class="card-text" id="total_promosi"></h3>
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

          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-nowrap"  >
                         <thead>
                              <tr>

                                   <th rowspan="3"  class=" font-bold">No</th>
                                   <th rowspan="3" colspan="4" class="text-center font-bold">
                                     <div class="split-table"></div>
                                     <span class="padding-top-bottom-12 ">Proses Kegiatan</span>
                              <div class="split-table-right"></div>
                                  </th>
                                  <th colspan="2" class="text-center font-bold">
                                     
                                     <span class="padding-top-bottom-12">Periode Pelaksanaan</span>
                             
                                  </th>
                                  <th rowspan="3"  class="text-center font-bold">
                                     <div class="split-table"></div>
                                     <span class="padding-top-bottom-12">Budget (Rp)</span>
                                  </th>
                                  <th rowspan="3" class="text-center font-bold">
                                     <div class="split-table"></div><span class="padding-top-bottom-12">Keterangan</span>
                                  </th>

                                   
                              </tr>
                             <tr>
                                   <th  class="text-center font-bold">
                                        
                                        <span class="padding-top-bottom-12">Periode Mulai</span>
                                   </th>
                                   <th  class="text-center font-bold">
                                       <div class="split-table"></div>
                                      <span class="position-top-10">Periode Akhir</span>
                                   </th>
                             </tr>
                              
                         </thead>
                         <tbody>
                          
                        <tr>
                            <td rowspan="5" class="font-bold text-center">1</td>
                            <td colspan="6" class="font-bold"> Identifikasi Pemetaan Potensi Investasi : </td>
                            <td><strong id="total_identifikasi">Rp 0</td>
                            <td></td>
                         </tr>


                         <tr>
                         <td class="font-bold">A.</td>
                       
                         <td colspan="3" class="-abjad font-bold" >Rapat Teknis Membahas Rencana Kerja</td>
                         <td>
                              <div id="startdate-a-pra-alert" class="margin-none form-group"> 
                                   <input  type="date"  disabled id="startdate-a-pra" name="startdate_a_pra" class="form-control ">
                                   <span id="startdate-a-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-a-pra-alert" class="margin-none form-group"> 
                                        <input type="date"  disabled id="enddate-a-pra" name="enddate_a_pra" class="form-control">
                                 <span id="enddate-a-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-a-pra-alert" class="margin-none form-group">
                                        <input type="number" id="budget-a-pra" disabled   min="0" oninput="this.value = Math.abs(this.value)" placeholder="Budget" value="0" name="budget_a_pra" class="form-control identifikasi">
                                 <span id="budget-a-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-a-pra-alert" class="pdf-btn-center">
                                        <button id="file-rapat-teknis" disabled type="button" class="file btn btn-default "> Upload File</button>
                                     
                                        <div id="img-file-rapat-teknis"></div>
                                        <input type="file" style="display:none;" disabled id="desc-a-pra" name="desc_a_pra" class="form-control">
                                        <span id="desc-a-pra-messages"></span>
                                   </div>

                              </td>
                       </tr>
                       <tr>
                         <td class="font-bold">B.</td>
                        
                         <td class="font-bold" colspan="3">Studi literatur</td>
                         <td>
                              <div id="startdate-b-pra-alert" class="margin-none form-group"> 
                                   <input type="date" id="startdate-b-pra"  disabled name="startdate_b_pra" class="form-control">
                                   <span id="startdate-b-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-b-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-b-pra" name="enddate_b_pra" class="form-control">
                                 <span id="enddate-b-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-b-pra-alert" class="margin-none form-group">
                                        <input id="budget-b-pra"  placeholder="Budget" value="0"  type="number" min="0" disabled oninput="this.value = Math.abs(this.value)" name="budget_b_pra" class="form-control identifikasi">
                                 <span id="budget-b-pra-messages"></span>
                            </div>
                              </td>
                              <td>

                                  

                                   <div id="desc-b-pra-alert" class="pdf-btn-center">
                                         <button id="file-studi-literatur" disabled type="button" class="file btn btn-default "> Upload File</button>
                                      
                                        <div id="img-file-studi-literatur"></div>
                                        <input type="file" style="display:none;" id="desc-b-pra" disabled name="desc_b_pra" class="form-control">
                                        <span id="desc-b-pra-messages"></span>
                                   </div>

                              </td>
                       </tr>


                       <tr >
                         <td class="font-bold">C.</td>
                       
                         <td class="font-bold" colspan="3">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>
                       <td>
                              <div id="startdate-c-pra-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-c-pra" name="startdate_c_pra" class="form-control">
                                   <span id="startdate-c-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-c-pra" name="enddate_c_pra" class="form-control">
                                 <span id="enddate-c-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-pra-alert" class="margin-none form-group">
                                        <input type="number" disabled min="0"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-c-pra" name="budget_c_pra" class="form-control identifikasi">
                                 <span id="budget-c-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-pra-alert" class="pdf-btn-center">
                                        <button id="file-rapat-kordinasi" disabled type="button" class="file btn btn-default "> Upload File</button>
                                       
                                        <div id="img-file-rapat-kordinasi"></div>

                                        <input type="file" style="display:none;" disabled name="desc_c_pra" id="desc-c-pra" class="form-control">
                                    <span id="desc-c-pra-messages"></span>
                                  </div>

                              </td>
                       </tr>
                       <tr >
                         <td class="font-bold">D.</td>
                        
                         <td class="font-bold" colspan="3">Pengumpulan data sekunder</td>
                         <td>
                              <div id="startdate-d-pra-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-d-pra" name="startdate_d_pra" class="form-control">
                                   <span id="startdate-d-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-d-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-d-pra" name="enddate_d_pra" class="form-control">
                                 <span id="enddate-d-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-d-pra-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number"  placeholder="Budget" value="0" id="budget-d-pra" oninput="this.value = Math.abs(this.value)" name="budget_d_pra" class="form-control identifikasi">
                                 <span id="budget-d-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-d-pra-alert" class="pdf-btn-center">
                                        <button id="file-sekunder" disabled type="button" class="file btn btn-default "> Upload File</button>
                                       
                                        <div id="img-file-sekunder"></div>

                                        <input style="display:none;" type="file" disabled name="desc_d_pra" id="desc-d-pra" class="form-control">
                                   <span id="desc-d-pra-messages"></span>
                            </div>

                              </td>
                         </tr>                      

                         <tr>
                            <td rowspan="11" class="font-bold text-center">2</td>
                            <td colspan="6" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : </td>
                             <td><strong id="total_pelaksanaan">Rp 0</td>
                            <td></td>
                            </tr>
                         <tr>

                         <tr>
                              <td class="font-bold">A.</td>
                              <td class="-abjad font-bold" colspan="3"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Persiapan antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                              <td>
                              <div id="startdate-a-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-a-pro" name="startdate_a_pro" class="form-control">
                                   <span id="startdate-a-pro-messages"></span>
                              </div>
                             </td>
                              <td>
                            <div id="enddate-a-pro-alert" class="margin-none form-group"> 
                                 <input type="date" disabled id="enddate-a-pro" name="enddate_a_pro" class="form-control">
                                 <span id="enddate-a-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-a-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0"  oninput="this.value = Math.abs(this.value)" id="budget-a-pro" name="budget_a_pro" class="form-control pelaksanaan">
                                 <span id="budget-a-pro-messages"></span>
                            </div>
                              </td>
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
                              <td class="font-bold">B.</td>
                              <td class="-abjad font-bold" colspan="3"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                             <td>
                              <div id="startdate-b-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-b-pro" name="startdate_b_pro" class="form-control ">
                                   <span id="startdate-b-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-b-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-b-pro" name="enddate_b_pro" class="form-control">
                                 <span id="enddate-b-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-b-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-b-pro" name="budget_b_pro" class="form-control pelaksanaan">
                                 <span id="budget-f-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-b-pro-alert" class="pdf-btn-center">
                                          <button id="file-fgd-identifikasi" disabled type="button" class="file btn btn-default "> Upload File</button>
                                       
                                        <div id="img-file-fgd-identifikasi"></div>
                                        <input type="file" style="display:none;" disabled id="desc-b-pro" name="desc_b_pro" class="form-control">
                                        <span id="desc-b-pro-messages"></span>
                                   </div>

                              </td>
                         </tr>
                              


                         <tr>
                              <td class="font-bold" rowspan="5">C.</td>
                              <td id="pengolahan-alert" class="-abjad font-bold" colspan="7">
                                  <div > Pengolahan dan analisis data untuk menghasilkan potensi sektor dan subsektor unggulan daerah : </div>
                                  <span id="pengolahan-messages"></span>
                              </td>
                             
                         </tr>


                         <tr>
                              <td ><input disabled name="checklist_lq" id="checklist-lq" value="false" type="checkbox" class="checkbox-pengolahan" ></td>
                              <td  class="font-bold table-number" >
                                   1.
                              </td>
                              <td class="-abjad font-bold"> LQ</td>
                             <td >
                              <div id="startdate-c-1-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_lq"  id="startdate-lq" class="form-control">
                                   <span id="startdate-c-1-pro-messages"></span>
                            </div>
                         </td>
                              <td >
                            <div id="enddate-c-1-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_lq" id="enddate-lq" class="form-control">
                                 <span id="enddate-c-1-pro-messages"></span>
                            </div>
                              </td>
                              <td >
                            <div id="budget-c-1-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" id="budget-lq"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_lq" class="form-control pelaksanaan">
                                 <span id="budget-c-1-pro-messages"></span>
                            </div>
                              </td>

                              <td rowspan="4">
                                  <div id="desc-c-1-pro-alert" class="potensi-sektor">
                                  <button id="file-pengolahan" disabled type="button" class="file btn btn-default"> Upload File</button>
                                   
                                    <div id="img-file-pengolahan"></div>
                                    <span id="desc-c-1-pro-messages"></span>
                                  </div>
                                  <input type="file" style="display:none" id="keterangan-pengolahan" name="keterangan_pengolahan">

                                 
                              </td>  
                                 
                             <!--  <td >
                                    <div id="desc-c-1-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_lq" id="desc-lq" class="form-control">
                                 <span id="desc-c-1-pro-messages"></span>
                            </div> 

                              </td> -->
                         </tr>


                         <tr>
                              <td ><input disabled name="checklist_shift_share" id="checklist-shift-share"  class="checkbox-pengolahan" type="checkbox" value="false" ></td>
                              <td class="font-bold table-number" >
                                   2.
                              </td>
                              <td class="-abjad font-bold"> Shift Share</td>
                              <td>
                              <div id="startdate-c-2-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_shift_share" id="startdate-shift-share" class="form-control">
                                   <span id="startdate-c-2-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-2-pro-alert" class="margin-none form-group"> 
                                 <input type="date" disabled name="enddate_shift_share" id="enddate-shift-share" class="form-control">
                                 <span id="enddate-c-2-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-2-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0"  oninput="this.value = Math.abs(this.value)" name="budget_shift_share" id="budget-shift-share" class="form-control pelaksanaan">
                                 <span id="budget-c-2-pro-messages"></span>
                            </div>
                              </td>
                              <!--  <td>
                                   <div id="desc-c-2-pro-alert" class="margin-none form-group">
                                        <input type="text" id="desc-shift-share"  disabled name="desc_shift_share"  class="form-control">
                                 <span id="desc-c-2-pro-messages"></span>
                            </div> 

                              </td> -->
                         </tr>

                         <tr>
                              <td ><input disabled name="checklist_tipologi_sektor" id="checklist-tipologi-sektor"  class="checkbox-pengolahan" value="false" type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   3.
                              </td>
                              <td class="-abjad font-bold"> Tipologi Sektor</td>
                               <td>
                              <div id="startdate-c-3-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_tipologi_sektor" id="startdate-tipologi-sektor" class="form-control">
                                   <span id="startdate-c-3-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-3-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_tipologi_sektor" id="enddate-tipologi-sektor" class="form-control">
                                 <span id="enddate-c-3-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-3-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_tipologi_sektor" id="budget-tipologi-sektor" class="form-control pelaksanaan">
                                 <span id="budget-c-3-pro-messages"></span>
                            </div>
                              </td>
                            <!--   <td>
                                    <div id="desc-c-3-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_tipologi_sektor" id="desc-tipologi-sektor" class="form-control">
                                 <span id="desc-c-3-pro-messages"></span>
                            </div> 

                              </td> -->
                         </tr>

                         <tr>
                             <td ><input disabled name="checklist_klassen" id="checklist-klassen"  class="checkbox-pengolahan" value="false"  type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   4.
                              </td>
                              <td class="-abjad font-bold"> Klassen</td>
                              <td>
                              <div id="startdate-c-4-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_klassen" id="startdate-klassen" class="form-control">
                                   <span id="startdate-c-4-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-4-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_klassen" id="enddate-klassen" class="form-control">
                                 <span id="enddate-c-4-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-4-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_klassen" id="budget-klassen" class="form-control pelaksanaan">
                                 <span id="budget-c-4-pro-messages"></span>
                            </div>
                              </td>
                            <!--   <td>
                                    <div id="desc-c-4-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_klassen" id="desc-klassen" class="form-control">
                                 <span id="desc-c-4-pro-messages"></span>
                            </div> 

                              </td> -->
                         </tr>

                        
                         <tr>



                         <td class="font-bold">D.</td>
                        
                         <td class="-abjad font-bold" colspan="3" ><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Klarifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                         <td>
                              <div id="startdate-d-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-d-pro" name="startdate_d_pro" class="form-control">
                                   <span id="startdate-d-pro-messages"></span>
                             </div>
                         </td>
                              <td>
                            <div id="enddate-d-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-d-pro" name="enddate_d_pro" class="form-control">
                                 <span id="enddate-d-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-d-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-d-pro" name="budget_d_pro" class="form-control pelaksanaan">
                                 <span id="budget-d-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-d-pro-alert" class="pdf-btn-center">
                                         <button id="file-fgd-klarifikasi" disabled type="button" class="file btn btn-default"> Upload File</button>
                                   
                                         <div id="img-file-fgd-klarifikasi"></div>
                                        <input type="file" style="display:none;" disabled id="desc-d-pro" name="desc_d_pro" class="form-control ">
                                        <span id="desc-d-pro-messages"></span>
                                   </div>

                              </td>
                         </tr>
                         

                          


                        
                       <tr>
                         <td class="font-bold">E.</td>
                         
                         <td class="-abjad font-bold" colspan="3" ><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                         <td>
                              <div id="startdate-e-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-e-pro" name="startdate_e_pro" class="form-control">
                                   <span id="startdate-e-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-e-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-e-pro" name="enddate_e_pro" class="form-control">
                                 <span id="enddate-e-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-e-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-e-pro" name="budget_e_pro" class="form-control pelaksanaan">
                                 <span id="budget-e-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-e-pro-alert" class="pdf-btn-center">
                                        <button id="file-fgd-konfirmasi" disabled type="button" class="file btn btn-default"> Upload File</button>
                                   
                                         <div id="img-file-fgd-konfirmasi"></div>
                                        <input type="file" style="display:none;" disabled id="desc-e-pro" name="desc_e_pro" class="form-control">
                                 <span id="desc-e-pro-messages"></span>
                            </div>

                              </td>
                         </tr> 
                      
                         <tr>
                            <td  rowspan="13" class="font-bold text-center">3</td>
                            <td colspan="6" class="font-bold"> Penyusunan Peta Potensi Investasi : </td>
                             <td><strong id="total_penyusunan">Rp 0</td>
                            <td></td>
                            </tr>
                         <tr>


                          <tr>
                              <td class="font-bold" rowspan="8">A.</td>
                              <td id="penyusunan-alert" class="-abjad font-bold" colspan="7">
                                  <div > Menyusun hasil identifikasi, pengolahan, dan analisis data dalam bentuk dokumen </div>
                                  <span id="penyusunan-messages"></span>
                              </td>
                         </tr>


                        <tr>
                              <td ><input disabled  name="checklist_summary_sektor_unggulan" id="checklist-summary-sektor-unggulan" class="checkbox-penyusunan" value="false"  type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   1.
                              </td>
                              <td class="-abjad font-bold"> Deskripsi singkat sektor unggulan</td>
                              <td>
                                   <div id="startdate-a-1-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="startdate-summary-sektor-unggulan" name="startdate_summary_sektor_unggulan" class="form-control">
                                        <span id="startdate-a-1-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-1-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled id="enddate-summary-sektor-unggulan" name="enddate_summary_sektor_unggulan" class="form-control">
                                      <span id="enddate-a-1-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-1-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-summary-sektor-unggulan" name="budget_summary_sektor_unggulan" class="form-control penyusunan">
                                      <span id="budget-a-1-ppro-messages"></span>
                                 </div>
                              </td>
                             <!--  <td>
                                   <div id="desc-a-1-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled id="desc-summary-sektor-unggulan" name="desc_summary_sektor_unggulan" class="form-control">
                                      <span id="desc-a-1-ppro-messages"></span>
                                   </div>

                              </td> -->

                               <td rowspan="7">
                                  <div id="desc-a-1-ppro-alert" class="penyusunan-peta">
                                  <button id="file-penyusunan"  type="button" disabled class="file btn btn-default"> Upload File</button>
                                 
                                  <div id="img-file-penyusunan"></div>
                                   <span id="desc-a-1-ppro-messages"></span>
                                  </div>
                                  <input type="file" style="display:none" id="keterangan-penyusunan" name="keterangan_penyusunan">

                                 
                                   
                              </td>  


                         </tr>


                          <tr>
                              <td ><input  disabled name="checklist_sektor_unggulan" id="checklist-sektor-unggulan" class="checkbox-penyusunan" value="false" type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   2.
                              </td>
                              <td class="-abjad font-bold"> Deskripsi sektor unggulan</td>
                              <td>
                                   <div id="startdate-a-2-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id=
                                        "startdate-sektor-unggulan" name="startdate_sektor_unggulan" class="form-control">
                                        <span id="startdate-a-2-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-2-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" id="enddate-sektor-unggulan" disabled name="enddate_sektor_unggulan" class="form-control">
                                      <span id="enddate-a-2-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-2-ppro-alert" class="margin-none form-group">
                                             <input min="0" id="budget-sektor-unggulan" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_sektor_unggulan" class="form-control penyusunan">
                                      <span id="budget-a-2-ppro-messages"></span>
                                 </div>
                              </td>
                              <!-- <td>
                                   <div id="desc-a-2-ppro-alert" class="margin-none form-group">
                                             <input type="text" id="desc-sektor-unggulan" disabled name="desc_sektor_unggulan" class="form-control">
                                      <span id="desc-a-2-ppro-messages"></span>
                                   </div>

                              </td> -->
                         </tr>

                         <tr>
                              <td ><input disabled  name="checklist_potensi_pasar" id="checklist-potensi-pasar" class="checkbox-penyusunan" value="false" type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   3.
                              </td>
                              <td class="-abjad font-bold">  Potensi pasar</td>
                             
                              <td>
                                   <div id="startdate-a-3-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="startdate-potensi-pasar" name="startdate_potensi_pasar" class="form-control">
                                        <span id="startdate-a-3-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-3-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled id="enddate-potensi-pasar" name="enddate_potensi_pasar" class="form-control">
                                      <span id="enddate-a-3-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-3-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" id="budget-potensi-pasar" oninput="this.value = Math.abs(this.value)" name="budget_potensi_pasar" class="form-control penyusunan">
                                      <span id="budget-a-3-ppro-messages"></span>
                                 </div>
                              </td>
                              <!-- <td>
                                   <div id="desc-a-3-ppro-alert" class="margin-none form-group">
                                             <input type="text" id="desc-potensi-pasar" disabled name="desc_potensi_pasar" class="form-control">
                                      <span id="desc-a-3-ppro-messages"></span>
                                   </div>

                              </td> -->
                         </tr>

                         <tr>
                             <td ><input disabled  name="checklist_parameter_sektor_unggulan" type="checkbox" id="checklist-parameter-sektor-unggulan" class="checkbox-penyusunan" value="false"></td>
                              <td class="font-bold table-number" >
                                   4.
                              </td>
                              <td class="-abjad font-bold"> Parameter data sektor unggulan</td>
                              <td>
                                   <div id="startdate-a-4-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="startdate-parameter-sektor-unggulan" name="startdate_parameter_sektor_unggulan" class="form-control">
                                        <span id="startdate-a-4-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-4-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled id="enddate-parameter-sektor-unggulan" name="enddate_parameter_sektor_unggulan" class="form-control">
                                      <span id="enddate-a-4-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-4-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-parameter-sektor-unggulan" name="budget_parameter_sektor_unggulan" class="form-control penyusunan">
                                      <span id="budget-a-4-ppro-messages"></span>
                                 </div>
                              </td>
                             <!--  <td>
                                   <div id="desc-a-4-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled id="desc-parameter-sektor-unggulan" name="desc_parameter_sektor_unggulan" class="form-control">
                                      <span id="desc-a-4-ppro-messages"></span>
                                   </div>

                              </td> -->
                         </tr>

                         <tr>
                              <td ><input disabled name="checklist_subsektor_unggulan" id="checklist-subsektor-unggulan" value="false" class="checkbox-penyusunan" type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   5.
                              </td>
                              <td class="-abjad font-bold"> <textarea readonly class="textarea-table">Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</textarea></td>
                              <td>
                                   <div id="startdate-a-5-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="startdate-subsektor-unggulan" name="startdate_subsektor_unggulan" class="form-control">
                                        <span id="startdate-a-5-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-5-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled id="enddate-subsektor-unggulan" name="enddate_subsektor_unggulan" class="form-control">
                                      <span id="enddate-a-5-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-5-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-subsektor-unggulan" name="budget_subsektor_unggulan" class="form-control penyusunan">
                                      <span id="budget-a-5-ppro-messages"></span>
                                 </div>
                              </td>
                              <!-- <td>
                                   <div id="desc-a-5-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled id="desc-subsektor-unggulan" name="desc_subsektor_unggulan" class="form-control">
                                      <span id="desc-a-5-ppro-messages"></span>
                                   </div>

                              </td> -->
                         </tr>

                         <tr>
                             <td ><input disabled name="checklist_intensif_daerah" id="checklist-intensif-daerah" class="checkbox-penyusunan" value="false" type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   6.
                              </td>
                              <td class="-abjad font-bold"> Insentif daerah</td>
                              <td>
                                   <div id="startdate-a-6-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="startdate-intensif-daerah" name="startdate_intensif_daerah" class="form-control">
                                        <span id="startdate-a-6-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-6-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled id="enddate-intensif-daerah" name="enddate_intensif_daerah" class="form-control">
                                      <span id="enddate-a-6-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-6-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-intensif-daerah" name="budget_intensif_daerah" class="form-control penyusunan">
                                      <span id="budget-a-6-ppro-messages"></span>
                                 </div>
                              </td>
                             <!--  <td>
                                   <div id="desc-a-6-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled id="desc-intensif-daerah" name="desc_intensif_daerah" class="form-control">
                                      <span id="desc-a-6-ppro-messages"></span>
                                   </div>

                              </td> -->
                         </tr>

                          <tr>
                              <td ><input disabled name="checklist_potensi_lanjutan" id="checklist-potensi-lanjutan" value="false" type="checkbox" ></td>
                              <td class="font-bold table-number" >
                                   7.
                              </td>
                              <td class="-abjad font-bold"> Potensi lanjutan komoditas sektor unggulan</td>
                              <td>
                                   <div id="startdate-a-7-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="startdate-potensi-lanjutan" name="startdate_potensi_lanjutan" class="form-control">
                                        <span id="startdate-a-7-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-7-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled id="enddate-potensi-lanjutan" name="enddate_potensi_lanjutan" class="form-control">
                                      <span id="enddate-a-7-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-7-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-potensi-lanjutan" name="budget_potensi_lanjutan" class="form-control penyusunan">
                                      <span id="budget-a-7-ppro-messages"></span>
                                 </div>
                              </td>
                              <!-- <td>
                                   <div id="desc-a-7-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled id="desc-potensi-lanjutan" name="desc_potensi_lanjutan" class="form-control">
                                      <span id="desc-a-7-ppro-messages"></span>
                                   </div>

                              </td> -->
                         </tr>



                       <tr>

                         <td class="font-bold">B.</td>
                         <td class="-abjad font-bold" colspan="3"><textarea readonly class="textarea-table">Penyusunan Infografis Peta Potensi Investasi dalam 2 bahasa (bahasa indonesia dan bahasa inggris)</textarea></td>
                         <td>
                              <div id="startdate-b-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-b-ppro" name="startdate_b_ppro" class="form-control">
                                   <span id="startdate-b-ppro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-b-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-b-ppro" name="enddate_b_ppro" class="form-control">
                                 <span id="enddate-b-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-b-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-b-ppro" name="budget_b_ppro" class="form-control penyusunan">
                                 <span id="budget-b-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-b-ppro-alert" class="pdf-btn-center">
                                        <button id="file-info-grafis" type="button" disabled class="file btn btn-default"> Upload File</button>
                                 
                                        <div id="img-file-info-grafis"></div>
                                        <input type="file" style="display:none;" disabled id="desc-b-ppro" name="desc_b_ppro" class="form-control">
                                        <span id="desc-b-ppro-messages"></span>
                                   </div>

                              </td>
                       </tr>
                       <tr>
                         <td class="font-bold">C.</td>
                         <td class="font-bold" colspan="3"><textarea readonly class="textarea-table">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</textarea></td>
                         <td>
                              <div id="startdate-c-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled id="startdate-c-ppro" name="startdate_c_ppro" class="form-control">
                                   <span id="startdate-c-ppro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="enddate-c-ppro" name="enddate_c_ppro" class="form-control">
                                 <span id="enddate-c-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" id="budget-c-ppro" name="budget_c_ppro" class="form-control penyusunan">
                                 <span id="budget-c-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-ppro-alert" class="pdf-btn-center">
                                         <button id="file-doc-info-grafis" type="button" disabled class="file btn btn-default"> Upload File</button>
                                          <div id="img-file-doc-info-grafis"></div>
                                        <input type="file" style="display:none;"  disabled id="desc-c-ppro" name="desc_c_ppro" class="form-control pasca-produksi">
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
               <div class="btn-group just-center">
                    <button id="simpan" disabled type="button" class="btn btn-warning col-md-2"><i class="fa fa-send"></i> SIMPAN</button>
                    <button id="kirim" disabled type="button" class="btn btn-primary col-md-2"><i class="fa fa-upload"></i> KIRIM</button>
               </div> 
          </div> 
     </form>
</div>

<script type="text/javascript">

     $(document).ready(function() {

          var periode =[];
          var pagu_promosi = 0;
          var total_promosi = 0;
          var total_identifikasi = 0;       
          var total_pelaksanaan = 0;
          var total_penyusunan = 0;
        
          var temp_total_identifikasi = 0;
          var temp_total_pelaksanaan = 0;
          var temp_total_penyusunan = 0;

          var file_rencana_kerja = '';
          var file_studi_literatur = '';
          var file_rapat_kordinasi = '';
          var file_data_sekunder = '';


          var file_fgd_persiapan = '';
          var file_data_identifikasi = '';
          var file_data_pengolahan = '';
          var file_data_klarifikasi = '';
          var file_data_konfrimasi = '';
          var file_data_penyusunan = '';
          var file_penyusunan_infografis = '';
          var file_doc_info_grafis = '';

          $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>'); 
     
          $('#pagu_promosi').html('<b>Rp. 0</b>');           
          $('#total_promosi').html('<b>Rp. 0</b>'); 

           

          getChecklistPelaksanaan();      
          getChecklistPetaInvenstasi();
          
          getperiode();  


          $(".identifikasi").on("input", function() {
               calculateIdentifikasi();
              
          });          

          $(".pelaksanaan").on("input", function() {
               calculatePelaksanaan();
          });

          $(".penyusunan").on("input", function() {
               calculatePenyusunan();
          });
          
          UploadFileRapatTeknis();
          UploadFileStudiLiteratur();
          UploadFileKordinasi();
          UploadFileDataSekunder();

          UploadFilePersiapan();
          UploadFileFGDKlarifikasi();
          UploadFilePengolahan();
          UploadFileFGDKonfirmasi();
          UploadFileFGDIndentifikasi(); 
         


          UploadFilePenyusunan();
          UploadFilePenyusunanInfoGrafis(); 
          UploadFileDokumentasiInfoGrafis(); 

          $("#simpan").click( () => {

              
               var data = $("#FormSubmit").serializeArray();  
               var form = {
                    'status_laporan_id':13,
                    'type': 'draft',
               };

                                         

               if (total_promosi != pagu_promosi) {
                    Swal.fire({
                         icon: 'info',
                         title: 'Peringatan',
                         text: 'Maaf, Total Promosi Tidak Sama Dengan Pagu Promosi.',
                         confirmButtonColor: '#000',
                         showConfirmButton: true,
                         confirmButtonText: 'OK',
                    });
               } else {
                    if(data.length >0)
                   {
                        SendingData(form,data);
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
   
                
               
               }

          });

           $("#kirim").click( () => {

               
               var data = $("#FormSubmit").serializeArray();  
                
               var form = {
                    'status_laporan_id':14,
                    'type': 'kirim',
               };

                                          

               if (total_promosi != pagu_promosi) {
                    Swal.fire({
                         icon: 'info',
                         title: 'Peringatan',
                         text: 'Maaf, Total Promosi Tidak Sama Dengan Pagu Promosi.',
                         confirmButtonColor: '#000',
                         showConfirmButton: true,
                         confirmButtonText: 'OK',
                    });
               } else {
   
                    if(data.length >0)
                    {
                        SendingData(form,data);
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
               
              }

          });



          function calculateIdentifikasi() {
               var total_identifikasi = 0;
          
               $(".identifikasi").each(function() {
                    total_identifikasi += parseFloat($(this).val());
               });

              

               var number = total_identifikasi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_identifikasi").text('Rp '+ formattedNumber);
              
               temp_total_identifikasi = number;
               totalRencana();
          }

          function calculatePelaksanaan() {
               var total_pelaksanaan = 0;

               $(".pelaksanaan").each(function() {
                    total_pelaksanaan += parseFloat($(this).val());
               });

               var number = total_pelaksanaan;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_pelaksanaan").text('Rp '+ formattedNumber);
     
               temp_total_pelaksanaan = number;
               totalRencana();
          }

          function calculatePenyusunan() {
               var total_penyusunan = 0;

               $(".penyusunan").each(function() {
                    total_penyusunan += parseFloat($(this).val());
               });

               var number = total_penyusunan;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_penyusunan").text('Rp '+ formattedNumber);
     
               temp_total_penyusunan = number;
               totalRencana();
          }

          function totalRencana() {
               
               total_promosi = temp_total_identifikasi + temp_total_pelaksanaan + temp_total_penyusunan;
               var number = total_promosi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
               var periode_id = $('#periode_id').val();
              

               if(periode_id)
               {    
                   
                    if(pagu_promosi < total_promosi) {
                         Swal.fire({
                              icon: 'info',
                              title: 'Peringatan',
                              text:'Total Promosi Melebihi PAGU yang Diizinkan : Rp. ' + accounting.formatNumber(pagu_promosi, 0, ".", "."),
                              confirmButtonColor: '#000',
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                         });  
                         
                         $('#total_promosi').removeClass('text-black').addClass('text-red').addClass('blinking-text');
                         

                    } else {

                         $('#total_promosi').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
                      
                    }
               }
               
               $('#total_promosi').html('<b>Rp. '+formattedNumber+'</b>');
               // $('#total_rencana_sec').html('<b>Rp. '+formattedNumber+'</b>');
               // $('#total_rencana_inp').val(number);
          }

          function getChecklistPelaksanaan(){

              


               $("#checklist-lq").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-lq").val('true');
                         $('#startdate-lq').prop("disabled", false);
                         $('#enddate-lq').prop("disabled", false);
                         $('#budget-lq').prop("disabled", false);
                         
                    }else{
                        $("#checklist-lq").val('false'); 
                        $('#startdate-lq').prop("disabled", true).val('');
                        $('#enddate-lq').prop("disabled", true).val('');
                        $('#budget-lq').prop("disabled", true).val('0');
                      
                        calculatePelaksanaan();
                    }     
               }); 

               $("#checklist-shift-share").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-shift-share").val('true');
                         $('#startdate-shift-share').prop("disabled", false);
                         $('#enddate-shift-share').prop("disabled", false);
                         $('#budget-shift-share').prop("disabled", false);
                        
                    }else{
                         $("#checklist-shift-share").val('false');
                         $('#startdate-shift-share').prop("disabled", true).val('');
                         $('#enddate-shift-share').prop("disabled", true).val('');
                         $('#budget-shift-share').prop("disabled", true).val('0');
                       
                         calculatePelaksanaan();
                    }     
               });  

               $("#checklist-tipologi-sektor").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-tipologi-sektor").val('true');
                         $('#startdate-tipologi-sektor').prop("disabled", false);
                         $('#enddate-tipologi-sektor').prop("disabled", false);
                         $('#budget-tipologi-sektor').prop("disabled", false);
                         
                    }else{
                         $("#checklist-tipologi-sektor").val('false');
                         $('#startdate-tipologi-sektor').prop("disabled", true).val('');
                         $('#enddate-tipologi-sektor').prop("disabled", true).val('');
                         $('#budget-tipologi-sektor').prop("disabled", true).val('0');
                          
                         calculatePelaksanaan();
                    }     
               }); 

               $("#checklist-klassen").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-klassen").val('true');
                         $('#startdate-klassen').prop("disabled", false);
                         $('#enddate-klassen').prop("disabled", false);
                         $('#budget-klassen').prop("disabled", false);
                        
                    }else{
                         $("#checklist-klassen").val('false');
                         $('#startdate-klassen').prop("disabled", true).val('');
                         $('#enddate-klassen').prop("disabled", true).val('');
                         $('#budget-klassen').prop("disabled", true).val('0');
                         
                         calculatePelaksanaan();
                    }     
               }); 

               $('.checkbox-pengolahan').on('click', function() {
                   const checkedCount = $('.checkbox-pengolahan:checked').length;
                   if(checkedCount>0)
                   {
                      $('#file-pengolahan').prop("disabled", false);
                   }else{
                     $('#file-pengolahan').prop("disabled", true); 
                   }     
               });

             

          }


          function getChecklistPetaInvenstasi(){

               $("#checklist-summary-sektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-summary-sektor-unggulan").val('true');
                         $("#startdate-summary-sektor-unggulan").prop("disabled", false);
                         $("#enddate-summary-sektor-unggulan").prop("disabled", false);
                         $('#budget-summary-sektor-unggulan').prop("disabled", false);
                         
                    }else{
                         $("#checklist-summary-sektor-unggulan").val('false'); 
                         $("#startdate-summary-sektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-summary-sektor-unggulan").prop("disabled", true).val('');
                         $('#budget-summary-sektor-unggulan').prop("disabled", true).val('0');;
                         
                         calculatePenyusunan();
                    }     
               }); 

               $("#checklist-sektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-sektor-unggulan").val('true');
                         $("#startdate-sektor-unggulan").prop("disabled", false);
                         $("#enddate-sektor-unggulan").prop("disabled", false);
                         $('#budget-sektor-unggulan').prop("disabled", false);
                         
                    }else{
                         $("#checklist-sektor-unggulan").val('false'); 
                         $("#startdate-sektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-sektor-unggulan").prop("disabled", true).val('');
                         $('#budget-sektor-unggulan').prop("disabled", true).val('0');;
                         
                         calculatePenyusunan();
                    }     
               });  

               $("#checklist-potensi-pasar").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-potensi-pasar").val('true');
                         $("#startdate-potensi-pasar").prop("disabled", false);
                         $("#enddate-potensi-pasar").prop("disabled", false);
                         $('#budget-potensi-pasar').prop("disabled", false);
                         
                    }else{
                         $("#checklist-potensi-pasar").val('false');
                         $("#startdate-potensi-pasar").prop("disabled", true).val('');
                         $("#enddate-potensi-pasar").prop("disabled", true).val('');
                         $('#budget-potensi-pasar').prop("disabled", true).val('0');;
                        
                         calculatePenyusunan(); 
                    }     
               }); 

               $("#checklist-parameter-sektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-parameter-sektor-unggulan").val('true');
                         $("#startdate-parameter-sektor-unggulan").prop("disabled", false);
                         $("#enddate-parameter-sektor-unggulan").prop("disabled", false);
                         $('#budget-parameter-sektor-unggulan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-parameter-sektor-unggulan").val('false');
                         $("#startdate-parameter-sektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-parameter-sektor-unggulan").prop("disabled", true).val('');
                         $('#budget-parameter-sektor-unggulan').prop("disabled", true).val('0');;
                         
                         calculatePenyusunan(); 
                    }     
               }); 

                $("#checklist-subsektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-subsektor-unggulan").val('true');
                         $("#startdate-subsektor-unggulan").prop("disabled", false);
                         $("#enddate-subsektor-unggulan").prop("disabled", false);
                         $('#budget-subsektor-unggulan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-subsektor-unggulan").val('false');
                         $("#startdate-subsektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-subsektor-unggulan").prop("disabled", true).val('');
                         $('#budget-subsektor-unggulan').prop("disabled", true).val('0');;
                         
                         calculatePenyusunan(); 
                    }     
               });  

               $("#checklist-intensif-daerah").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-intensif-daerah").val('true');
                         $("#startdate-intensif-daerah").prop("disabled", false);
                         $("#enddate-intensif-daerah").prop("disabled", false);
                         $('#budget-intensif-daerah').prop("disabled", false);
                        
                    }else{
                         $("#checklist-intensif-daerah").val('false');
                         $("#startdate-intensif-daerah").prop("disabled", true).val('');
                         $("#enddate-intensif-daerah").prop("disabled", true).val('');
                         $('#budget-intensif-daerah').prop("disabled", true).val('0');;
                        
                         calculatePenyusunan();  
                    }     
               }); 

               $("#checklist-potensi-lanjutan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-potensi-lanjutan").val('true');
                         $("#startdate-potensi-lanjutan").prop("disabled", false);
                         $("#enddate-potensi-lanjutan").prop("disabled", false);
                         $('#budget-potensi-lanjutan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-potensi-lanjutan").val('false');
                         $("#startdate-potensi-lanjutan").prop("disabled", true).val('');
                         $("#enddate-potensi-lanjutan").prop("disabled", true).val('');
                         $('#budget-potensi-lanjutan').prop("disabled", true).val('0');;
                      
                         calculatePenyusunan();  
                    }     
               }); 

               $('.checkbox-penyusunan').on('click', function() {
                   const checkedCount = $('.checkbox-penyusunan:checked').length;
                   if(checkedCount>0)
                   {
                       $('#file-penyusunan').prop("disabled", false);
                   }else{
                        $('#file-penyusunan').prop("disabled", true);
                   }     
               });
          }

           function UploadFileRapatTeknis()
          {


               $("#file-rapat-teknis").click(()=> {
                 $("#desc-a-pra").trigger("click");
               });

               $("#desc-a-pra").change((event)=> {     
                  
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
                     
                         $('#img-file-rapat-teknis').html(row);
                         file_rencana_kerja = file;
                    
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


              $( "#img-file-rapat-teknis" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'1a');  
              });  

          }


           function UploadFileStudiLiteratur()
          {


               $("#file-studi-literatur").click(()=> {
                 $("#desc-b-pra").trigger("click");
               });

               $("#desc-b-pra").change((event)=> {     
                  
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
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-1b"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-1b" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-1b"></div>`;
                         row +=`</div>`;
                         file_studi_literatur = file;
                     
                         $('#img-file-studi-literatur').html(row);
                    
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


              $( "#img-file-studi-literatur" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'1b');  
              });  

          }

           function UploadFileKordinasi()
          {


               $("#file-rapat-kordinasi").click(()=> {
                 $("#desc-c-pra").trigger("click");
               });

               $("#desc-c-pra").change((event)=> {     
                  
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
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-1c"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-1c" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-1c"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-rapat-kordinasi').html(row);
                         file_rapat_kordinasi = file;
                    
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


              $( "#img-file-rapat-kordinasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'1c');  
              });  

          }

           function UploadFileDataSekunder()
          {


               $("#file-sekunder").click(()=> {
                 $("#desc-d-pra").trigger("click");
               });

               $("#desc-d-pra").change((event)=> {     
                  
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
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-1d"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-1d" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-1d"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-sekunder').html(row);4
                         file_data_sekunder = file;
                    
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


              $( "#img-file-sekunder" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,'1d');  
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
                         file_fgd_persiapan = file;
                    
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
                         file_data_identifikasi= file;
                    
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

          function UploadFilePengolahan()
          {


               $("#file-pengolahan").click(()=> {
                 $("#keterangan-pengolahan").trigger("click");
               });

               $("#keterangan-pengolahan").change((event)=> {     
                  
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
                     
                         $('#img-file-pengolahan').html(row);
                         file_data_pengolahan = file
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


              $( "#img-file-pengolahan" ).on( "click", "#viewPdf", (e) => {
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
                        file_data_klarifikasi = file;
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
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-2e"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-2e" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-2e"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-fgd-konfirmasi').html(row);
                         file_data_konfrimasi = file
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
                         file_data_penyusunan = file;
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
                         file_penyusunan_infografis = file;
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
                         file_doc_info_grafis = file;
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
                              select.append($('<option>', {
                                   value: option.value,
                                   text: option.text
                              }));
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

                    pagu_promosi = find.pagu_promosi; 
                    //isi pagu
                    var promosi = accounting.formatNumber(find.pagu_promosi, 0, ".", "."); 
                    $('#pagu_promosi').html('<b>Rp '+ promosi +'</b>');
               
                    //isi input
                    $("input").prop("disabled", false);
                    $(".file").prop("disabled", false);
                    $("#simpan").prop("disabled", false);
                    $("#kirim").prop("disabled", false);

                    $('#startdate-lq').prop("disabled", true);
                    $('#enddate-lq').prop("disabled", true);
                    $('#budget-lq').prop("disabled", true);

                    $('#startdate-shift-share').prop("disabled", true);
                    $('#enddate-shift-share').prop("disabled", true);
                    $('#budget-shift-share').prop("disabled", true);

                    $('#startdate-tipologi-sektor').prop("disabled", true);
                    $('#enddate-tipologi-sektor').prop("disabled", true);
                    $('#budget-tipologi-sektor').prop("disabled", true);

                    $('#startdate-klassen').prop("disabled", true);
                    $('#enddate-klassen').prop("disabled", true);
                    $('#budget-klassen').prop("disabled", true);

                    $('#file-pengolahan').prop("disabled", true);

                    $('#startdate-summary-sektor-unggulan').prop("disabled", true);
                    $('#enddate-summary-sektor-unggulan').prop("disabled", true);
                    $('#budget-summary-sektor-unggulan').prop("disabled", true);

                    $('#startdate-sektor-unggulan').prop("disabled", true);
                    $('#enddate-sektor-unggulan').prop("disabled", true);
                    $('#budget-sektor-unggulan').prop("disabled", true);

                    $('#startdate-potensi-pasar').prop("disabled", true);
                    $('#enddate-potensi-pasar').prop("disabled", true);
                    $('#budget-potensi-pasar').prop("disabled", true);

                    $('#startdate-parameter-sektor-unggulan').prop("disabled", true);
                    $('#enddate-parameter-sektor-unggulan').prop("disabled", true);
                    $('#budget-parameter-sektor-unggulan').prop("disabled", true);

                    $('#startdate-subsektor-unggulan').prop("disabled", true);
                    $('#enddate-subsektor-unggulan').prop("disabled", true);
                    $('#budget-subsektor-unggulan').prop("disabled", true);

                    $('#startdate-intensif-daerah').prop("disabled", true);
                    $('#enddate-intensif-daerah').prop("disabled", true);
                    $('#budget-intensif-daerah').prop("disabled", true);

                    $('#startdate-potensi-lanjutan').prop("disabled", true);
                    $('#enddate-potensi-lanjutan').prop("disabled", true);
                    $('#budget-potensi-lanjutan').prop("disabled", true);
                    
                  
                    $('#file-penyusunan').prop("disabled", true); 
                    
                   
               });
          }



          function SendingData(form,data) {
             
               var pesan = (form.type === 'kirim') ? 'Terkirim ke Pusat.' : 'Berhasil Simpan.';
               var periode_id = $('#periode_id').val(); 


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


                    'tgl_awal_rencana_kerja':$('#startdate-a-pra').val(),
                    'tgl_ahir_rencana_kerja':$('#enddate-a-pra').val(),
                    'budget_rencana_kerja':$('#budget-a-pra').val(),
                    'keterangan_rencana_kerja':file_rencana_kerja,

                    'tgl_awal_studi_literatur':$('#startdate-b-pra').val(),
                    'tgl_ahir_studi_literatur':$('#enddate-b-pra').val(),
                    'budget_studi_literatur':$('#budget-b-pra').val(),
                    'keterangan_studi_literatur':file_studi_literatur,

                    'tgl_awal_rapat_kordinasi':$('#startdate-c-pra').val(),
                    'tgl_ahir_rapat_kordinasi':$('#enddate-c-pra').val(),
                    'budget_rapat_kordinasi':$('#budget-c-pra').val(),
                    'keterangan_rapat_kordinasi':file_rapat_kordinasi,

                    'tgl_awal_data_sekunder':$('#startdate-d-pra').val(),
                    'tgl_ahir_data_sekunder':$('#enddate-d-pra').val(),
                    'budget_data_sekunder':$('#budget-d-pra').val(),
                    'keterangan_data_sekunder':file_data_sekunder,

                    'tgl_awal_fgd_persiapan':$('#startdate-a-pro').val(),
                    'tgl_ahir_fgd_persiapan':$('#enddate-a-pro').val(),
                    'budget_fgd_persiapan':$('#budget-a-pro').val(),
                    'keterangan_fgd_persiapan':file_fgd_persiapan,

                    'tgl_awal_fgd_identifikasi':$('#startdate-b-pro').val(),
                    'tgl_ahir_fgd_identifikasi':$('#enddate-b-pro').val(),
                    'budget_fgd_identifikasi':$('#budget-b-pro').val(),
                    'keterangan_fgd_identifikasi':file_data_identifikasi,
                    
                    'checklist_lq':checklist_lq,
                    'tgl_awal_lq':$('#startdate-lq').val(),
                    'tgl_ahir_lq':$('#enddate-lq').val(),
                    'budget_lq':$('#budget-lq').val(),
                    // 'keterangan_lq':$('#desc-lq').val(),
               
                    'checklist_shift_share':checklist_shift_share,
                    'tgl_awal_shift_share':$('#startdate-shift-share').val(),
                    'tgl_ahir_shift_share':$('#enddate-shift-share').val(),
                    'budget_shift_share':$('#budget-shift-share').val(),
                    // 'keterangan_shift_share':$('#desc-shift-share').val(),
                     
                    'checklist_tipologi_sektor':checklist_tipologi_sektor, 
                    'tgl_awal_tipologi_sektor':$('#startdate-tipologi-sektor').val(),
                    'tgl_ahir_tipologi_sektor':$('#enddate-tipologi-sektor').val(),
                    'budget_tipologi_sektor':$('#budget-tipologi-sektor').val(),
                    // 'keterangan_tipologi_sektor':$('#desc-tipologi-sektor').val(),

                    'checklist_klassen':checklist_klassen, 
                    'tgl_awal_klassen':$('#startdate-klassen').val(),
                    'tgl_ahir_klassen':$('#enddate-klassen').val(),
                    'budget_klassen':$('#budget-klassen').val(),
                    // 'keterangan_klassen':$('#desc-klassen').val(),

                    'keterangan_pengolahan':file_data_pengolahan,

                    'tgl_awal_fgd_klarifikasi':$('#startdate-d-pro').val(),
                    'tgl_ahir_fgd_klarifikasi':$('#enddate-d-pro').val(),
                    'budget_fgd_klarifikasi':$('#budget-d-pro').val(),
                    'keterangan_fgd_klarifikasi':file_data_klarifikasi,

                    'tgl_awal_finalisasi':$('#startdate-e-pro').val(),
                    'tgl_ahir_finalisasi':$('#enddate-e-pro').val(),
                    'budget_finalisasi':$('#budget-e-pro').val(),
                    'keterangan_finalisasi':file_data_konfrimasi,
                    
                    'checklist_summary_sektor_unggulan':checklist_summary_sektor_unggulan,     
                    'tgl_awal_summary_sektor_unggulan':$('#startdate-summary-sektor-unggulan').val(),
                    'tgl_ahir_summary_sektor_unggulan':$('#enddate-summary-sektor-unggulan').val(),
                    'budget_summary_sektor_unggulan':$('#budget-summary-sektor-unggulan').val(),
                    // 'keterangan_summary_sektor_unggulan':$('#desc-summary-sektor-unggulan').val(),
                   
                    'checklist_sektor_unggulan':checklist_sektor_unggulan,
                    'tgl_awal_sektor_unggulan':$('#startdate-sektor-unggulan').val(),
                    'tgl_ahir_sektor_unggulan':$('#enddate-sektor-unggulan').val(),
                    'budget_sektor_unggulan':$('#budget-sektor-unggulan').val(),
                    // 'keterangan_sektor_unggulan':$('#desc-sektor-unggulan').val(),
                
                    'checklist_potensi_pasar':checklist_potensi_pasar,
                    'tgl_awal_potensi_pasar':$('#startdate-potensi-pasar').val(),
                    'tgl_ahir_potensi_pasar':$('#enddate-potensi-pasar').val(),
                    'budget_potensi_pasar':$('#budget-potensi-pasar').val(),
                    // 'keterangan_potensi_pasar':$('#desc-potensi-pasar').val(),
                    
                    'checklist_parameter_sektor_unggulan':checklist_parameter_sektor_unggulan,
                    'tgl_awal_parameter_sektor_unggulan':$('#startdate-parameter-sektor-unggulan').val(),
                    'tgl_ahir_parameter_sektor_unggulan':$('#enddate-parameter-sektor-unggulan').val(),
                    'budget_parameter_sektor_unggulan':$('#budget-parameter-sektor-unggulan').val(),
                    // 'keterangan_parameter_sektor_unggulan':$('#desc-parameter-sektor-unggulan').val(),
                    
                    'checklist_subsektor_unggulan':checklist_subsektor_unggulan,
                    'tgl_awal_subsektor_unggulan':$('#startdate-subsektor-unggulan').val(),
                    'tgl_ahir_subsektor_unggulan':$('#enddate-subsektor-unggulan').val(),
                    'budget_subsektor_unggulan':$('#budget-subsektor-unggulan').val(),
                    // 'keterangan_subsektor_unggulan':$('#desc-subsektor-unggulan').val(),
                    
                    'checklist_intensif_daerah':checklist_intensif_daerah,
                    'tgl_awal_intensif_daerah':$('#startdate-intensif-daerah').val(),
                    'tgl_ahir_intensif_daerah':$('#enddate-intensif-daerah').val(),
                    'budget_intensif_daerah':$('#budget-intensif-daerah').val(),
                    // 'keterangan_intensif_daerah':$('#desc-intensif-daerah').val(),
                   
                    'checklist_potensi_lanjutan':checklist_potensi_lanjutan,
                    'tgl_awal_potensi_lanjutan':$('#startdate-potensi-lanjutan').val(),
                    'tgl_ahir_potensi_lanjutan':$('#enddate-potensi-lanjutan').val(),
                    'budget_potensi_lanjutan':$('#budget-potensi-lanjutan').val(),
                    // 'keterangan_potensi_lanjutan':$('#desc-potensi-lanjutan').val(),
                    'keterangan_penyusunan':file_data_penyusunan,

                    'tgl_awal_info_grafis':$('#startdate-b-ppro').val(),
                    'tgl_ahir_info_grafis':$('#enddate-b-ppro').val(),
                    'budget_info_grafis':$('#budget-b-ppro').val(),
                    'keterangan_info_grafis':file_penyusunan_infografis,

                    'tgl_awal_dokumentasi':$('#startdate-c-ppro').val(),
                    'tgl_ahir_dokumentasi':$('#enddate-c-ppro').val(),
                    'budget_dokumentasi':$('#budget-c-ppro').val(),
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
                         
                         if(errors.messages.tgl_awal_rencana_kerja)
                         {
                              $('#startdate-a-pra-alert').addClass('has-error');
                              $('#startdate-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_rencana_kerja +'</strong>');
                         } else {
                              $('#startdate-a-pra-alert').removeClass('has-error');
                              $('#startdate-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_rencana_kerja)
                         {
                              $('#enddate-a-pra-alert').addClass('has-error');
                              $('#enddate-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_rencana_kerja +'</strong>');
                         } else {
                              $('#enddate-a-pra-alert').removeClass('has-error');
                              $('#enddate-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_rencana_kerja)
                         {
                              $('#budget-a-pra-alert').addClass('has-error');
                              $('#budget-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_rencana_kerja +'</strong>');
                         } else {
                              $('#budget-a-pra-alert').removeClass('has-error');
                              $('#budget-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_rencana_kerja)
                         {
                              $('#desc-a-pra-alert').addClass('has-error');
                              $('#desc-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_rencana_kerja +'</strong>');
                         } else {
                              $('#desc-a-pra-alert').removeClass('has-error');
                              $('#desc-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_studi_literatur)
                         {
                              $('#startdate-b-pra-alert').addClass('has-error');
                              $('#startdate-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_studi_literatur +'</strong>');
                         } else {
                              $('#startdate-b-pra-alert').removeClass('has-error');
                              $('#startdate-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_studi_literatur)
                         {
                              $('#enddate-b-pra-alert').addClass('has-error');
                              $('#enddate-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_studi_literatur +'</strong>');
                         } else {
                              $('#enddate-b-pra-alert').removeClass('has-error');
                              $('#enddate-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_studi_literatur)
                         {
                              $('#budget-b-pra-alert').addClass('has-error');
                              $('#budget-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_studi_literatur +'</strong>');
                         } else {
                              $('#budget-b-pra-alert').removeClass('has-error');
                              $('#budget-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_studi_literatur)
                         {
                              $('#desc-b-pra-alert').addClass('has-error');
                              $('#desc-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_studi_literatur +'</strong>');
                         } else {
                              $('#desc-b-pra-alert').removeClass('has-error');
                              $('#desc-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_rapat_kordinasi)
                         {
                              $('#startdate-c-pra-alert').addClass('has-error');
                              $('#startdate-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_rapat_kordinasi +'</strong>');
                         } else {
                              $('#startdate-c-pra-alert').removeClass('has-error');
                              $('#startdate-c-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_rapat_kordinasi)
                         {
                              $('#enddate-c-pra-alert').addClass('has-error');
                              $('#enddate-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_rapat_kordinasi +'</strong>');
                         } else {
                              $('#enddate-c-pra-alert').removeClass('has-error');
                              $('#enddate-c-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_rapat_kordinasi)
                         {
                              $('#budget-c-pra-alert').addClass('has-error');
                              $('#budget-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_rapat_kordinasi +'</strong>');
                         } else {
                              $('#budget-c-pra-alert').removeClass('has-error');
                              $('#budget-c-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_rapat_kordinasi)
                         {
                              $('#desc-c-pra-alert').addClass('has-error');
                              $('#desc-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_rapat_kordinasi +'</strong>');
                         } else {
                              $('#desc-c-pra-alert').removeClass('has-error');
                              $('#desc-c-pra-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.tgl_awal_data_sekunder)
                         {
                              $('#startdate-d-pra-alert').addClass('has-error');
                              $('#startdate-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_data_sekunder +'</strong>');
                         } else {
                              $('#startdate-d-pra-alert').removeClass('has-error');
                              $('#startdate-d-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_data_sekunder)
                         {
                              $('#enddate-d-pra-alert').addClass('has-error');
                              $('#enddate-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_data_sekunder +'</strong>');
                         } else {
                              $('#enddate-d-pra-alert').removeClass('has-error');
                              $('#enddate-d-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_data_sekunder)
                         {
                              $('#budget-d-pra-alert').addClass('has-error');
                              $('#budget-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_data_sekunder +'</strong>');
                         } else {
                              $('#budget-d-pra-alert').removeClass('has-error');
                              $('#budget-d-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_data_sekunder)
                         {
                              $('#desc-d-pra-alert').addClass('has-error');
                              $('#desc-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_data_sekunder +'</strong>');
                         } else {
                              $('#desc-d-pra-alert').removeClass('has-error');
                              $('#desc-d-pra-messages').removeClass('help-block').html('');
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


                         if(errors.messages.keterangan_fgd_identifikasi)
                         {
                              $('#desc-b-pro-alert').addClass('has-error');
                              $('#desc-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_fgd_identifikasi +'</strong>');
                         } else {
                              $('#desc-b-pro-alert').removeClass('has-error');
                              $('#desc-b-pro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.tgl_awal_lq)
                         {
                              $('#startdate-c-1-pro-alert').addClass('has-error');
                              $('#startdate-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_lq +'</strong>');
                         } else {
                              $('#startdate-c-1-pro-alert').removeClass('has-error');
                              $('#startdate-c-1-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_lq)
                         {
                              $('#enddate-c-1-pro-alert').addClass('has-error');
                              $('#enddate-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_lq +'</strong>');
                         } else {
                              $('#enddate-c-1-pro-alert').removeClass('has-error');
                              $('#enddate-c-1-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.budget_lq)
                         {
                              $('#budget-c-1-pro-alert').addClass('has-error');
                              $('#budget-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_lq +'</strong>');
                         } else {
                              $('#budget-c-1-pro-alert').removeClass('has-error');
                              $('#budget-c-1-pro-messages').removeClass('help-block').html('');
                         }

                         //  if(errors.messages.keterangan_lq)
                         // {
                         //      $('#desc-c-1-pro-alert').addClass('has-error');
                         //      $('#desc-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_lq +'</strong>');
                         // } else {
                         //      $('#desc-c-1-pro-alert').removeClass('has-error');
                         //      $('#desc-c-1-pro-messages').removeClass('help-block').html('');
                         // }

                          if(errors.messages.keterangan_pengolahan)
                         {
                              $('#desc-c-1-pro-alert').addClass('has-error');
                              $('#desc-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_pengolahan +'</strong>');
                         } else {
                              $('#desc-c-1-pro-alert').removeClass('has-error');
                              $('#desc-c-1-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_shift_share)
                         {
                              $('#startdate-c-2-pro-alert').addClass('has-error');
                              $('#startdate-c-2-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_shift_share +'</strong>');
                         } else {
                              $('#startdate-c-2-pro-alert').removeClass('has-error');
                              $('#startdate-c-2-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_shift_share)
                         {
                              $('#enddate-c-2-pro-alert').addClass('has-error');
                              $('#enddate-c-2-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_shift_share +'</strong>');
                         } else {
                              $('#enddate-c-2-pro-alert').removeClass('has-error');
                              $('#enddate-c-2-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.budget_shift_share)
                         {
                              $('#budget-c-2-pro-alert').addClass('has-error');
                              $('#budget-c-2-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_shift_share +'</strong>');
                         } else {
                              $('#budget-c-2-pro-alert').removeClass('has-error');
                              $('#budget-c-2-pro-messages').removeClass('help-block').html('');
                         }

                         //  if(errors.messages.keterangan_shift_share)
                         // {
                         //      $('#desc-c-2-pro-alert').addClass('has-error');
                         //      $('#desc-c-2-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_shift_share +'</strong>');
                         // } else {
                         //      $('#desc-c-2-pro-alert').removeClass('has-error');
                         //      $('#desc-c-2-pro-messages').removeClass('help-block').html('');
                         // }




                         if(errors.messages.tgl_awal_tipologi_sektor)
                         {
                              $('#startdate-c-3-pro-alert').addClass('has-error');
                              $('#startdate-c-3-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_tipologi_sektor +'</strong>');
                         } else {
                              $('#startdate-c-3-pro-alert').removeClass('has-error');
                              $('#startdate-c-3-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_tipologi_sektor)
                         {
                              $('#enddate-c-3-pro-alert').addClass('has-error');
                              $('#enddate-c-3-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_tipologi_sektor +'</strong>');
                         } else {
                              $('#enddate-c-3-pro-alert').removeClass('has-error');
                              $('#enddate-c-3-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.budget_tipologi_sektor)
                         {
                              $('#budget-c-3-pro-alert').addClass('has-error');
                              $('#budget-c-3-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_tipologi_sektor +'</strong>');
                         } else {
                              $('#budget-c-3-pro-alert').removeClass('has-error');
                              $('#budget-c-3-pro-messages').removeClass('help-block').html('');
                         }

                         //  if(errors.messages.keterangan_tipologi_sektor)
                         // {
                         //      $('#desc-c-3-pro-alert').addClass('has-error');
                         //      $('#desc-c-3-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_tipologi_sektor +'</strong>');
                         // } else {
                         //      $('#desc-c-3-pro-alert').removeClass('has-error');
                         //      $('#desc-c-3-pro-messages').removeClass('help-block').html('');
                         // }

                         if(errors.messages.tgl_awal_klassen)
                         {
                              $('#startdate-c-4-pro-alert').addClass('has-error');
                              $('#startdate-c-4-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_klassen +'</strong>');
                         } else {
                              $('#startdate-c-4-pro-alert').removeClass('has-error');
                              $('#startdate-c-4-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_klassen)
                         {
                              $('#enddate-c-4-pro-alert').addClass('has-error');
                              $('#enddate-c-4-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_klassen +'</strong>');
                         } else {
                              $('#enddate-c-4-pro-alert').removeClass('has-error');
                              $('#enddate-c-4-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.budget_klassen)
                         {
                              $('#budget-c-4-pro-alert').addClass('has-error');
                              $('#budget-c-4-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_klassen +'</strong>');
                         } else {
                              $('#budget-c-4-pro-alert').removeClass('has-error');
                              $('#budget-c-4-pro-messages').removeClass('help-block').html('');
                         }

                           if(errors.messages.pengolahan)
                         {
                              $('#pengolahan-alert').addClass('hash-checkbox-alert');
                              $('#pengolahan-messages').addClass('help-checkbox-msg').html('<strong>'+ errors.messages.pengolahan +'</strong>');
                         } else {
                              $('#pengolahan-alert').removeClass('has-checkbox-alert');
                              $('#pengolahan-messages').removeClass('help-checkbox-msg').html('');
                         }


                         if(errors.messages.penyusunan)
                         {
                              $('#penyusunan-alert').addClass('hash-checkbox-alert');
                              $('#penyusunan-messages').addClass('help-checkbox-msg').html('<strong>'+ errors.messages.penyusunan +'</strong>');
                         } else {
                              $('#penyusunan-alert').removeClass('hash-checkbox-alert');
                              $('#penyusunan-messages').removeClass('help-checkbox-msg').html('');
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

                          if(errors.messages.keterangan_finalisasi)
                         {
                              $('#desc-e-pro-alert').addClass('has-error');
                              $('#desc-e-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_finalisasi +'</strong>');
                         } else {
                              $('#desc-e-pro-alert').removeClass('has-error');
                              $('#desc-e-pro-messages').removeClass('help-block').html('');
                         }






                          if(errors.messages.tgl_awal_summary_sektor_unggulan)
                         {
                              $('#startdate-a-1-ppro-alert').addClass('has-error');
                              $('#startdate-a-1-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_summary_sektor_unggulan +'</strong>');
                         } else {
                              $('#startdate-a-1-ppro-alert').removeClass('has-error');
                              $('#startdate-a-1-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_summary_sektor_unggulan)
                         {
                              $('#enddate-a-1-ppro-alert').addClass('has-error');
                              $('#enddate-a-1-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_summary_sektor_unggulan +'</strong>');
                         } else {
                              $('#enddate-a-1-ppro-alert').removeClass('has-error');
                              $('#enddate-a-1-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_summary_sektor_unggulan)
                         {
                              $('#budget-a-1-ppro-alert').addClass('has-error');
                              $('#budget-a-1-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_summary_sektor_unggulan +'</strong>');
                         } else {
                              $('#budget-a-1-ppro-alert').removeClass('has-error');
                              $('#budget-a-1-ppro-messages').removeClass('help-block').html('');
                         }


                         //  if(errors.messages.keterangan_summary_sektor_unggulan)
                         // {
                         //      $('#desc-a-1-ppro-alert').addClass('has-error');
                         //      $('#desc-a-1-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_summary_sektor_unggulan +'</strong>');
                         // } else {
                         //      $('#desc-a-1-ppro-alert').removeClass('has-error');
                         //      $('#desc-a-1-ppro-messages').removeClass('help-block').html('');
                         // }

                          if(errors.messages.keterangan_penyusunan)
                         {
                              $('#desc-a-1-ppro-alert').addClass('has-error');
                              $('#desc-a-1-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_penyusunan +'</strong>');
                         } else {
                              $('#desc-a-1-ppro-alert').removeClass('has-error');
                              $('#desc-a-1-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_sektor_unggulan)
                         {
                              $('#startdate-a-2-ppro-alert').addClass('has-error');
                              $('#startdate-a-2-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_sektor_unggulan +'</strong>');
                         } else {
                              $('#startdate-a-2-ppro-alert').removeClass('has-error');
                              $('#startdate-a-2-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_sektor_unggulan)
                         {
                              $('#enddate-a-2-ppro-alert').addClass('has-error');
                              $('#enddate-a-2-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_sektor_unggulan +'</strong>');
                         } else {
                              $('#enddate-a-2-ppro-alert').removeClass('has-error');
                              $('#enddate-a-2-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_sektor_unggulan)
                         {
                              $('#budget-a-2-ppro-alert').addClass('has-error');
                              $('#budget-a-2-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_sektor_unggulan +'</strong>');
                         } else {
                              $('#budget-a-2-ppro-alert').removeClass('has-error');
                              $('#budget-a-2-ppro-messages').removeClass('help-block').html('');
                         }


                         //  if(errors.messages.keterangan_sektor_unggulan)
                         // {
                         //      $('#desc-a-2-ppro-alert').addClass('has-error');
                         //      $('#desc-a-2-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_sektor_unggulan +'</strong>');
                         // } else {
                         //      $('#desc-a-2-ppro-alert').removeClass('has-error');
                         //      $('#desc-a-2-ppro-messages').removeClass('help-block').html('');
                         // }

                           if(errors.messages.tgl_awal_potensi_pasar)
                         {
                              $('#startdate-a-3-ppro-alert').addClass('has-error');
                              $('#startdate-a-3-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_potensi_pasar +'</strong>');
                         } else {
                              $('#startdate-a-3-ppro-alert').removeClass('has-error');
                              $('#startdate-a-3-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_potensi_pasar)
                         {
                              $('#enddate-a-3-ppro-alert').addClass('has-error');
                              $('#enddate-a-3-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_potensi_pasar +'</strong>');
                         } else {
                              $('#enddate-a-3-ppro-alert').removeClass('has-error');
                              $('#enddate-a-3-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_potensi_pasar)
                         {
                              $('#budget-a-3-ppro-alert').addClass('has-error');
                              $('#budget-a-3-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_potensi_pasar +'</strong>');
                         } else {
                              $('#budget-a-3-ppro-alert').removeClass('has-error');
                              $('#budget-a-3-ppro-messages').removeClass('help-block').html('');
                         }


                         //  if(errors.messages.keterangan_potensi_pasar)
                         // {
                         //      $('#desc-a-3-ppro-alert').addClass('has-error');
                         //      $('#desc-a-3-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_potensi_pasar +'</strong>');
                         // } else {
                         //      $('#desc-a-3-ppro-alert').removeClass('has-error');
                         //      $('#desc-a-3-ppro-messages').removeClass('help-block').html('');
                         // }


                           if(errors.messages.tgl_awal_parameter_sektor_unggulan)
                         {
                              $('#startdate-a-4-ppro-alert').addClass('has-error');
                              $('#startdate-a-4-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_parameter_sektor_unggulan +'</strong>');
                         } else {
                              $('#startdate-a-4-ppro-alert').removeClass('has-error');
                              $('#startdate-a-4-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_parameter_sektor_unggulan)
                         {
                              $('#enddate-a-4-ppro-alert').addClass('has-error');
                              $('#enddate-a-4-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_parameter_sektor_unggulan +'</strong>');
                         } else {
                              $('#enddate-a-4-ppro-alert').removeClass('has-error');
                              $('#enddate-a-4-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_parameter_sektor_unggulan)
                         {
                              $('#budget-a-4-ppro-alert').addClass('has-error');
                              $('#budget-a-4-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_parameter_sektor_unggulan +'</strong>');
                         } else {
                              $('#budget-a-4-ppro-alert').removeClass('has-error');
                              $('#budget-a-4-ppro-messages').removeClass('help-block').html('');
                         }


                         //  if(errors.messages.keterangan_parameter_sektor_unggulan)
                         // {
                         //      $('#desc-a-4-ppro-alert').addClass('has-error');
                         //      $('#desc-a-4-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_parameter_sektor_unggulan +'</strong>');
                         // } else {
                         //      $('#desc-a-4-ppro-alert').removeClass('has-error');
                         //      $('#desc-a-4-ppro-messages').removeClass('help-block').html('');
                         // }


                           if(errors.messages.tgl_awal_subsektor_unggulan)
                         {
                              $('#startdate-a-5-ppro-alert').addClass('has-error');
                              $('#startdate-a-5-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_subsektor_unggulan +'</strong>');
                         } else {
                              $('#startdate-a-5-ppro-alert').removeClass('has-error');
                              $('#startdate-a-5-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_subsektor_unggulan)
                         {
                              $('#enddate-a-5-ppro-alert').addClass('has-error');
                              $('#enddate-a-5-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_subsektor_unggulan +'</strong>');
                         } else {
                              $('#enddate-a-5-ppro-alert').removeClass('has-error');
                              $('#enddate-a-5-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_subsektor_unggulan)
                         {
                              $('#budget-a-5-ppro-alert').addClass('has-error');
                              $('#budget-a-5-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_subsektor_unggulan +'</strong>');
                         } else {
                              $('#budget-a-5-ppro-alert').removeClass('has-error');
                              $('#budget-a-5-ppro-messages').removeClass('help-block').html('');
                         }


                         //  if(errors.messages.keterangan_subsektor_unggulan)
                         // {
                         //      $('#desc-a-5-ppro-alert').addClass('has-error');
                         //      $('#desc-a-5-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_subsektor_unggulan +'</strong>');
                         // } else {
                         //      $('#desc-a-5-ppro-alert').removeClass('has-error');
                         //      $('#desc-a-5-ppro-messages').removeClass('help-block').html('');
                         // }



                           if(errors.messages.tgl_awal_intensif_daerah)
                         {
                              $('#startdate-a-6-ppro-alert').addClass('has-error');
                              $('#startdate-a-6-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_intensif_daerah +'</strong>');
                         } else {
                              $('#startdate-a-6-ppro-alert').removeClass('has-error');
                              $('#startdate-a-6-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_intensif_daerah)
                         {
                              $('#enddate-a-6-ppro-alert').addClass('has-error');
                              $('#enddate-a-6-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_intensif_daerah +'</strong>');
                         } else {
                              $('#enddate-a-6-ppro-alert').removeClass('has-error');
                              $('#enddate-a-6-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_intensif_daerah)
                         {
                              $('#budget-a-6-ppro-alert').addClass('has-error');
                              $('#budget-a-6-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_intensif_daerah +'</strong>');
                         } else {
                              $('#budget-a-6-ppro-alert').removeClass('has-error');
                              $('#budget-a-6-ppro-messages').removeClass('help-block').html('');
                         }


                         //  if(errors.messages.keterangan_intensif_daerah)
                         // {
                         //      $('#desc-a-6-ppro-alert').addClass('has-error');
                         //      $('#desc-a-6-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_intensif_daerah +'</strong>');
                         // } else {
                         //      $('#desc-a-6-ppro-alert').removeClass('has-error');
                         //      $('#desc-a-6-ppro-messages').removeClass('help-block').html('');
                         // }



                            if(errors.messages.tgl_awal_potensi_lanjutan)
                         {
                              $('#startdate-a-7-ppro-alert').addClass('has-error');
                              $('#startdate-a-7-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_potensi_lanjutan +'</strong>');
                         } else {
                              $('#startdate-a-7-ppro-alert').removeClass('has-error');
                              $('#startdate-a-7-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_potensi_lanjutan)
                         {
                              $('#enddate-a-7-ppro-alert').addClass('has-error');
                              $('#enddate-a-7-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_potensi_lanjutan +'</strong>');
                         } else {
                              $('#enddate-a-7-ppro-alert').removeClass('has-error');
                              $('#enddate-a-7-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_potensi_lanjutan)
                         {
                              $('#budget-a-7-ppro-alert').addClass('has-error');
                              $('#budget-a-7-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_potensi_lanjutan +'</strong>');
                         } else {
                              $('#budget-a-7-ppro-alert').removeClass('has-error');
                              $('#budget-a-7-ppro-messages').removeClass('help-block').html('');
                         }


                         //  if(errors.messages.keterangan_potensi_lanjutan)
                         // {
                         //      $('#desc-a-7-ppro-alert').addClass('has-error');
                         //      $('#desc-a-7-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_potensi_lanjutan +'</strong>');
                         // } else {
                         //      $('#desc-a-7-ppro-alert').removeClass('has-error');
                         //      $('#desc-a-7-ppro-messages').removeClass('help-block').html('');
                         // }


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