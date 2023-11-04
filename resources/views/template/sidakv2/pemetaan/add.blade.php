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
                        <table class="table table-hover text-nowrap" >
                         <thead>
                              <tr>

                                   <th rowspan="3"  class=" font-bold">No</th>
                                   <th rowspan="3" colspan="3" class="text-center font-bold">
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
                          
                         <tr lass="pull-left full">
                            <td rowspan="5" class="font-bold text-center">1</td>
                            <td colspan="5" class="font-bold"> Identifikasi Pemetaan Potensi Investasi : </td>
                            <td><strong id="total_pra_produksi">Rp 0</td>
                            <td></td>
                         </tr>


                         <tr>
                         <td class="font-bold">A.</td>
                         <td class="-abjad font-bold" colspan="2">Rapat Teknis Membahas Rencana Kerja</td>
                         <td>
                              <div id="startdate-a-pra-alert" class="margin-none form-group"> 
                                   <input  type="date"  disabled id="startdate_a_pra" name="startdate_a_pra" class="form-control ">
                                   <span id="startdate-a-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-a-pra-alert" class="margin-none form-group"> 
                                        <input type="date"  disabled id="enddate_a_pra" name="enddate_a_pra" class="form-control">
                                 <span id="enddate-a-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-a-pra-alert" class="margin-none form-group">
                                        <input type="number" id="budget_a_pra" disabled   min="0" oninput="this.value = Math.abs(this.value)" placeholder="Budget" value="0" name="budget_a_pra" class="form-control pra_produksi">
                                 <span id="budget-a-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-a-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled id="desc_a_pra" name="desc_a_pra" class="form-control">
                                 <span id="desc-a-pra-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr>
                         <td class="font-bold">B.</td>
                         <td class="font-bold" colspan="2">Studi literatur</td>
                         <td>
                              <div id="startdate-b-pra-alert" class="margin-none form-group"> 
                                   <input type="date"  disabled name="startdate_b_pra" class="form-control">
                                   <span id="startdate-b-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-b-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_b_pra" class="form-control">
                                 <span id="enddate-b-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-b-pra-alert" class="margin-none form-group">
                                        <input id="budget_b_pra_alert"  placeholder="Budget" value="0"  type="number" min="0" disabled oninput="this.value = Math.abs(this.value)" name="budget_b_pra" class="form-control pra_produksi">
                                 <span id="budget-b-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-b-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_b_pra" class="form-control">
                                 <span id="desc-b-pra-messages"></span>
                            </div>

                              </td>
                       </tr>


                       <tr >
                         <td class="font-bold">C.</td>
                         <td class="font-bold" colspan="2">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>
                       <td>
                              <div id="startdate-c-pra-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_c_pra" class="form-control">
                                   <span id="startdate-c-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_c_pra" class="form-control">
                                 <span id="enddate-c-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-pra-alert" class="margin-none form-group">
                                        <input type="number" disabled min="0"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_c_pra" class="form-control pra_produksi">
                                 <span id="budget-c-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_c_pra" class="form-control">
                                 <span id="desc-c-pra-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr >
                         <td class="font-bold">D.</td>
                         <td class="font-bold" colspan="2">Pengumpulan data sekunder</td>
                         <td>
                              <div id="startdate-d-pra-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_d_pra" class="form-control">
                                   <span id="startdate-d-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-d-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_d_pra" class="form-control">
                                 <span id="enddate-d-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-d-pra-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_d_pra" class="form-control pra_produksi">
                                 <span id="budget-d-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-d-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_d_pra" class="form-control">
                                 <span id="desc-d-pra-messages"></span>
                            </div>

                              </td>
                         </tr>                        

                         <tr>
                            <td rowspan="11" class="font-bold text-center">2</td>
                            <td colspan="5" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : </td>
                             <td><strong id="total_pasca_produksi">Rp 0</td>
                            <td></td>
                            </tr>
                         <tr>

                         <tr>
                              <td class="font-bold">A.</td>
                              <td class="-abjad font-bold" colspan="2"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Persiapan antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                              <td>
                              <div id="startdate-a-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_a_pro" class="form-control">
                                   <span id="startdate-a-pro-messages"></span>
                              </div>
                             </td>
                              <td>
                            <div id="enddate-a-pro-alert" class="margin-none form-group"> 
                                 <input type="date" disabled name="enddate_a_pro" class="form-control">
                                 <span id="enddate-a-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-a-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0"  oninput="this.value = Math.abs(this.value)" name="budget_a_pro" class="form-control produksi">
                                 <span id="budget-a-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-a-pro-alert" class="margin-none form-group">
                                        <input type="text"  disabled name="desc_a_pro"  class="form-control">
                                 <span id="desc-a-pro-messages"></span>
                            </div>

                              </td>
                         </tr>     

                         <tr>
                              <td class="font-bold">B.</td>
                              <td class="-abjad font-bold" colspan="2"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                             <td>
                              <div id="startdate-b-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_f_pra" class="form-control pra-produksi">
                                   <span id="startdate-f-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-f-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_f_pra" class="form-control">
                                 <span id="enddate-f-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-f-pra-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_f_pra" class="form-control pra_produksi">
                                 <span id="budget-f-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-f-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_f_pra" class="form-control">
                                 <span id="desc-f-pra-messages"></span>
                            </div>

                              </td>
                         </tr>
                              


                         <tr>
                              <td class="font-bold" rowspan="5">C.</td>
                              <td class="-abjad font-bold" colspan="6">
                                   Pengolahan dan analisis data untuk menghasilkan potensi sektor dan subsektor unggulan daerah :
                              </td>
                             
                         </tr>


                         <tr>
                             
                              <td class="font-bold table-number" >
                                   1.
                              </td>
                              <td class="-abjad font-bold"> LQ</td>
                             <td>
                              <div id="startdate-c-1-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_c_1_pro" class="form-control">
                                   <span id="startdate-c-1-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-1-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_c_1_pro" class="form-control">
                                 <span id="enddate-c-1-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-1-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_c_1_pro" class="form-control pra_produksi">
                                 <span id="budget-c-1-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-1-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_c_1_pro" class="form-control">
                                 <span id="desc-c-1-pro-messages"></span>
                            </div>

                              </td>
                         </tr>


                         <tr>
                             
                              <td class="font-bold table-number" >
                                   2.
                              </td>
                              <td class="-abjad font-bold"> Shift Share</td>
                              <td>
                              <div id="startdate-c-2-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_shift_c_2_pro" class="form-control">
                                   <span id="startdate-c-2-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-2-pro-alert" class="margin-none form-group"> 
                                 <input type="date" disabled name="enddate_c_2_pro" class="form-control">
                                 <span id="enddate-c-2-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-2-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0"  oninput="this.value = Math.abs(this.value)" name="budget_c_2_pro" class="form-control produksi">
                                 <span id="budget-c-2-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-2-pro-alert" class="margin-none form-group">
                                        <input type="text"  disabled name="desc_c_2_pro"  class="form-control">
                                 <span id="desc-c-2-pro-messages"></span>
                            </div>

                              </td>
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   3.
                              </td>
                              <td class="-abjad font-bold"> Tipologi Sektor</td>
                               <td>
                              <div id="startdate-c-3-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_c_3_pro" class="form-control">
                                   <span id="startdate-c-3-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-tipologi-sektor-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_c_3_pro" class="form-control">
                                 <span id="enddate-c-3-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-3-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_c_3_pro" class="form-control produksi">
                                 <span id="budget-c-3-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-3-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_c_3_pro" class="form-control">
                                 <span id="desc-c-3-pro-messages"></span>
                            </div>

                              </td>
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   4.
                              </td>
                              <td class="-abjad font-bold"> Klassen</td>
                              <td>
                              <div id="startdate-c-4-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_c_4_pro" class="form-control">
                                   <span id="startdate-c-4-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-4-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_c_4_pro" class="form-control">
                                 <span id="enddate-c-4-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-4-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_c_4_pro" class="form-control produksi">
                                 <span id="budget-c-4-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-4-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_c_4_pro" class="form-control">
                                 <span id="desc-c-4-pro-messages"></span>
                            </div>

                              </td>
                         </tr>

                        
                         <tr>
                         <td class="font-bold">D.</td>
                         <td class="-abjad font-bold" colspan="2"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Klarifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                         <td>
                              <div id="startdate-d-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_d_pro" class="form-control">
                                   <span id="startdate-d-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-d-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_d_pro" class="form-control">
                                 <span id="enddate-d-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-d-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_d_pro" class="form-control produksi">
                                 <span id="budget-d-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-d-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_d_pro" class="form-control ">
                                 <span id="desc-d-pro-messages"></span>
                            </div>

                              </td>
                         </tr>
                         

                          


                        
                       <tr>
                         <td class="font-bold">E.</td>
                         <td class="-abjad font-bold" colspan="2"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>
                         <td>
                              <div id="startdate-e-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_c_pro" class="form-control">
                                   <span id="startdate-e-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-e-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_e_pro" class="form-control">
                                 <span id="enddate-e-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-e-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_e_pro" class="form-control produksi">
                                 <span id="budget-e-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-e-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_e_pro" class="form-control">
                                 <span id="desc-e-pro-messages"></span>
                            </div>

                              </td>
                         </tr>
                      
                         <tr>
                            <td rowspan="12" class="font-bold text-center">3</td>
                            <td colspan="5" class="font-bold"> Penyusunan Peta Potensi Investasi : </td>
                             <td><strong id="total_pasca_produksi">Rp 0</td>
                            <td></td>
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
                              <td>
                                   <div id="startdate-a-1-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="startdate_a_1_ppro" class="form-control">
                                        <span id="startdate-a-1-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-1-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled name="enddate_a_1_pro" class="form-control">
                                      <span id="enddate-a-1-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-1-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_1_ppro" class="form-control pasca_produksi">
                                      <span id="budget-a-1-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                   <div id="desc-a-1-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled name="desc_a_1_pro" class="form-control">
                                      <span id="desc-a-1-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>


                         <tr>
                             
                              <td class="font-bold table-number" >
                                   2.
                              </td>
                              <td class="-abjad font-bold"> Deskripsi sektor unggulan</td>
                              <td>
                                   <div id="startdate-a-2-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="startdate_a_2_ppro" class="form-control">
                                        <span id="startdate-a-2-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-2-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled name="enddate_a_2_pro" class="form-control">
                                      <span id="enddate-a-2-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-2-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_2_ppro" class="form-control pasca_produksi">
                                      <span id="budget-a-2-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                   <div id="desc-3-2-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled name="desc_3_2_pro" class="form-control">
                                      <span id="desc-3-2-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   3.
                              </td>
                              <td class="-abjad font-bold">  Potensi pasar</td>
                             
                              <td>
                                   <div id="startdate-a-3-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="startdate_a_3_ppro" class="form-control">
                                        <span id="startdate-a-3-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-3-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled name="enddate_a_3_pro" class="form-control">
                                      <span id="enddate-a-3-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-3-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_3_ppro" class="form-control pasca_produksi">
                                      <span id="budget-a-3-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                   <div id="desc-a-3-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled name="desc_a_3_pro" class="form-control">
                                      <span id="desc-a-3-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   4.
                              </td>
                              <td class="-abjad font-bold"> Parameter data sektor unggulan</td>
                              <td>
                                   <div id="startdate-a-4-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="startdate_a_4_ppro" class="form-control">
                                        <span id="startdate-a-4-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-4-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled name="enddate_a_4_pro" class="form-control">
                                      <span id="enddate-a-4-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-4-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_4_ppro" class="form-control pasca_produksi">
                                      <span id="budget-a-4-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                   <div id="desc-a-4-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled name="desc_a_4_pro" class="form-control">
                                      <span id="desc-a-4-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   5.
                              </td>
                              <td class="-abjad font-bold"> <textarea readonly class="textarea-table">Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</textarea></td>
                              <td>
                                   <div id="startdate-a-5-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="startdate_a_5_ppro" class="form-control">
                                        <span id="startdate-a-5-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-5-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled name="enddate_3_5_pro" class="form-control">
                                      <span id="enddate-a-5-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-5-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_5_ppro" class="form-control pasca_produksi">
                                      <span id="budget-a-5-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                   <div id="desc-a-5-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled name="desc_a_5_pro" class="form-control">
                                      <span id="desc-a-5-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>

                         <tr>
                             
                              <td class="font-bold table-number" >
                                   6.
                              </td>
                              <td class="-abjad font-bold"> Insentif daerah</td>
                              <td>
                                   <div id="startdate-a-6-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="startdate_a_6_ppro" class="form-control">
                                        <span id="startdate-a-6-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-6-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled name="enddate_a_6_pro" class="form-control">
                                      <span id="enddate-a-6-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-6-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_6_ppro" class="form-control pasca_produksi">
                                      <span id="budget-a-6-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                   <div id="desc-a-6-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled name="desc_a_6_pro" class="form-control">
                                      <span id="desc-a-6-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>

                          <tr>
                             
                              <td class="font-bold table-number" >
                                   7.
                              </td>
                              <td class="-abjad font-bold"> Potensi lanjutan komoditas sektor unggulan</td>
                              <td>
                                   <div id="startdate-a-7-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="startdate_a_7_ppro" class="form-control">
                                        <span id="startdate-a-7-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                 <div id="enddate-a-7-ppro-alert" class="margin-none form-group"> 
                                             <input type="date" disabled name="enddate_a_7_pro" class="form-control">
                                      <span id="enddate-a-7-ppro-messages"></span>
                                 </div>
                                   </td>
                                   <td>
                                 <div id="budget-a-7-ppro-alert" class="margin-none form-group">
                                             <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_7_ppro" class="form-control pasca_produksi">
                                      <span id="budget-a-7-ppro-messages"></span>
                                 </div>
                              </td>
                              <td>
                                   <div id="desc-a-7-ppro-alert" class="margin-none form-group">
                                             <input type="text" disabled name="desc_a_7_pro" class="form-control">
                                      <span id="desc-a-7-ppro-messages"></span>
                                   </div>

                              </td>
                         </tr>



                        <tr>

                         <td class="font-bold">B.</td>
                         <td class="-abjad font-bold" colspan="2"><textarea readonly class="textarea-table">Penyusunan Infografis Peta Potensi Investasi dalam 2 bahasa (bahasa indonesia dan bahasa inggris)</textarea></td>
                         <td>
                              <div id="startdate-b-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_b_ppro" class="form-control">
                                   <span id="startdate-b-ppro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-b-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_b_ppro" class="form-control">
                                 <span id="enddate-b-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-b-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_b_ppro" class="form-control pasca_produksi">
                                 <span id="budget-b-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-b-ppro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_b_ppro" class="form-control">
                                 <span id="desc-b-ppro-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr>
                         <td class="font-bold">C.</td>
                         <td class="font-bold" colspan="2"><textarea readonly class="textarea-table">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</textarea></td>
                         <td>
                              <div id="startdate-c-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_c_ppro" class="form-control">
                                   <span id="startdate-c-ppro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-c-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_c_ppro" class="form-control">
                                 <span id="enddate-c-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-c-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_c_ppro" class="form-control pasca_produksi">
                                 <span id="budget-c-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-c-ppro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_c_ppro" class="form-control pasca-produksi">
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
          var total_pra_produksi = 0;       
          var total_produksi = 0;
          var total_pasca_produksi = 0;
        
          var temp_total_pra_produksi = 0;
          var temp_total_produksi = 0;
          var temp_total_pasca_produksi = 0;

          $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>'); 
     
          $('#pagu_promosi').html('<b>Rp. 0</b>');           
          $('#total_promosi').html('<b>Rp. 0</b>');           
 
          
          getperiode();  


          $(".pra_produksi").on("input", function() {
               calculatePraProduksi();
              
          });          

          $(".produksi").on("input", function() {
               calculateProduksi();
          });

          $(".pasca_produksi").on("input", function() {
               calculatePascaProduksi();
          });

           
       

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
   
               //  
               
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



          function calculatePraProduksi() {
               var total_pra_produksi = 0;
          
               $(".pra_produksi").each(function() {
                    total_pra_produksi += parseFloat($(this).val());
               });

              

               var number = total_pra_produksi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_pra_produksi").text('Rp '+ formattedNumber);
              
               temp_total_pra_produksi = number;
               totalRencana();
          }

          function calculateProduksi() {
               var total_produksi = 0;

               $(".produksi").each(function() {
                    total_produksi += parseFloat($(this).val());
               });

               var number = total_produksi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_produksi").text('Rp '+ formattedNumber);
     
               temp_total_produksi = number;
               totalRencana();
          }

          function calculatePascaProduksi() {
               var total_pasca_produksi = 0;

               $(".pasca_produksi").each(function() {
                    total_pasca_produksi += parseFloat($(this).val());
               });

               var number = total_pasca_produksi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_pasca_produksi").text('Rp '+ formattedNumber);
     
               temp_total_pasca_produksi = number;
               totalRencana();
          }

          function totalRencana() {
               
               total_promosi = temp_total_pra_produksi + temp_total_produksi + temp_total_pasca_produksi;
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

          function getperiode(){
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=POST&action=pemetaan',
                    success: function(data) {
                         var select =  $('#periode_id');
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
                    $("#simpan").prop("disabled", false);
                    $("#kirim").prop("disabled", false);
                    
               });
          }



          function SendingData(form,data) {

               var pesan = (form.type === 'kirim') ? 'Terkirim ke Pusat.' : 'Berhasil Simpan.';
               var periode_id = $('#periode_id').val(); 
               var arr = {
                    'periode_id':periode_id,
                    'status_laporan_id':form.status_laporan_id,


                    'tgl_awal_rencana_kerja':data[0].value,
                    'tgl_ahir_rencana_kerja':data[1].value,
                    'budget_rencana_kerja':data[2].value,
                    'keterangan_rencana_kerja':data[3].value,

                    'tgl_awal_studi_literatur':data[4].value,
                    'tgl_ahir_studi_literatur':data[5].value,
                    'budget_studi_literatur':data[6].value,
                    'keterangan_studi_literatur':data[7].value,

                    'tgl_awal_rapat_kordinasi':data[8].value,
                    'tgl_ahir_rapat_kordinasi':data[9].value,
                    'budget_rapat_kordinasi':data[10].value,
                    'keterangan_rapat_kordinasi':data[11].value,

                    'tgl_awal_data_sekunder':data[12].value,
                    'tgl_ahir_data_sekunder':data[13].value,
                    'budget_data_sekunder':data[14].value,
                    'keterangan_data_sekunder':data[15].value,

                    'tgl_awal_fgd_persiapan':data[16].value,
                    'tgl_ahir_fgd_persiapan':data[17].value,
                    'budget_fgd_persiapan':data[18].value,
                    'keterangan_fgd_persiapan':data[19].value,

                    'tgl_awal_fgd_identifikasi':data[20].value,
                    'tgl_ahir_fgd_identifikasi':data[21].value,
                    'budget_fgd_identifikasi':data[22].value,
                    'keterangan_fgd_identifikasi':data[23].value,

                    'tgl_awal_lq':data[24].value,
                    'tgl_ahir_lq':data[25].value,
                    'budget_lq':data[26].value,
                    'keterangan_lq':data[27].value,

                    'tgl_awal_shift_share':data[28].value,
                    'tgl_ahir_shift_share':data[29].value,
                    'budget_shift_share':data[30].value,
                    'keterangan_shift_share':data[31].value,

                    'tgl_awal_tipologi_sektor':data[32].value,
                    'tgl_ahir_tipologi_sektor':data[33].value,
                    'budget_tipologi_sektor':data[34].value,
                    'keterangan_tipologi_sektor':data[35].value,


                    'tgl_awal_klassen':data[36].value,
                    'tgl_ahir_klassen':data[37].value,
                    'budget_klassen':data[38].value,
                    'keterangan_klassen':data[39].value,

                    'tgl_awal_fgd_klarifikasi':data[40].value,
                    'tgl_ahir_fgd_klarifikasi':data[41].value,
                    'budget_fgd_klarifikasi':data[42].value,
                    'keterangan_fgd_klarifikasi':data[43].value,

                    'tgl_awal_finalisasi':data[44].value,
                    'tgl_ahir_finalisasi':data[45].value,
                    'budget_finalisasi':data[46].value,
                    'keterangan_finalisasi':data[47].value,

                    'tgl_awal_summary_sektor_unggulan':data[48].value,
                    'tgl_ahir_summary_sektor_unggulan':data[49].value,
                    'budget_summary_sektor_unggulan':data[50].value,
                    'keterangan_summary_sektor_unggulan':data[51].value,

                    'tgl_awal_sektor_unggulan':data[52].value,
                    'tgl_ahir_sektor_unggulan':data[53].value,
                    'budget_sektor_unggulan':data[54].value,
                    'keterangan_sektor_unggulan':data[55].value,

                    'tgl_awal_potensi_pasar':data[56].value,
                    'tgl_ahir_potensi_pasar':data[57].value,
                    'budget_potensi_pasar':data[58].value,
                    'keterangan_potensi_pasar':data[59].value,

                    'tgl_awal_parameter_sektor_unggulan':data[60].value,
                    'tgl_ahir_parameter_sektor_unggulan':data[61].value,
                    'budget_parameter_sektor_unggulan':data[62].value,
                    'keterangan_parameter_sektor_unggulan':data[63].value,

                    'tgl_awal_subsektor_unggulan':data[64].value,
                    'tgl_ahir_subsektor_unggulan':data[65].value,
                    'budget_subsektor_unggulan':data[66].value,
                    'keterangan_subsektor_unggulan':data[67].value,

                    'tgl_awal_intensif_daerah':data[68].value,
                    'tgl_ahir_intensif_daerah':data[69].value,
                    'budget_intensif_daerah':data[70].value,
                    'keterangan_intensif_daerah':data[71].value,

                    'tgl_awal_potensi_lanjutan':data[72].value,
                    'tgl_ahir_potensi_lanjutan':data[73].value,
                    'budget_potensi_lanjutan':data[74].value,
                    'keterangan_potensi_lanjutan':data[75].value,

                    'tgl_awal_info_grafis':data[76].value,
                    'tgl_ahir_info_grafis':data[77].value,
                    'budget_info_grafis':data[78].value,
                    'keterangan_info_grafis':data[79].value,

                    'tgl_awal_dokumentasi':data[80].value,
                    'tgl_ahir_dokumentasi':data[81].value,
                    'budget_dokumentasi':data[82].value,
                    'keterangan_dokumentasi':data[83].value,
 


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

                          if(errors.messages.keterangan_lq)
                         {
                              $('#desc-c-1-pro-alert').addClass('has-error');
                              $('#desc-c-1-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_lq +'</strong>');
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

                          if(errors.messages.keterangan_shift_share)
                         {
                              $('#desc-c-2-pro-alert').addClass('has-error');
                              $('#desc-c-2-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_shift_share +'</strong>');
                         } else {
                              $('#desc-c-2-pro-alert').removeClass('has-error');
                              $('#desc-c-2-pro-messages').removeClass('help-block').html('');
                         }




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

                          if(errors.messages.keterangan_tipologi_sektor)
                         {
                              $('#desc-c-3-pro-alert').addClass('has-error');
                              $('#desc-c-3-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_tipologi_sektor +'</strong>');
                         } else {
                              $('#desc-c-3-pro-alert').removeClass('has-error');
                              $('#desc-c-3-pro-messages').removeClass('help-block').html('');
                         }

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

                          if(errors.messages.keterangan_klassen)
                         {
                              $('#desc-c-4-pro-alert').addClass('has-error');
                              $('#desc-c-4-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_klassen +'</strong>');
                         } else {
                              $('#desc-c-4-pro-alert').removeClass('has-error');
                              $('#desc-c-4-pro-messages').removeClass('help-block').html('');
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
                              $('#startdate-d-pro-alert').addClass('has-error');
                              $('#startdate-d-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_finalisasi +'</strong>');
                         } else {
                              $('#startdate-d-pro-alert').removeClass('has-error');
                              $('#startdate-d-pro-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.tgl_ahir_finalisasi)
                         {
                              $('#enddate-d-pro-alert').addClass('has-error');
                              $('#enddate-d-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_finalisasi +'</strong>');
                         } else {
                              $('#enddate-d-pro-alert').removeClass('has-error');
                              $('#enddate-d-pro-messages').removeClass('help-block').html('');
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


                          if(errors.messages.keterangan_summary_sektor_unggulan)
                         {
                              $('#desc-a-1-ppro-alert').addClass('has-error');
                              $('#desc-a-1-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_summary_sektor_unggulan +'</strong>');
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


                          if(errors.messages.keterangan_sektor_unggulan)
                         {
                              $('#desc-a-2-ppro-alert').addClass('has-error');
                              $('#desc-a-2-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_sektor_unggulan +'</strong>');
                         } else {
                              $('#desc-a-2-ppro-alert').removeClass('has-error');
                              $('#desc-a-2-ppro-messages').removeClass('help-block').html('');
                         }

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


                          if(errors.messages.keterangan_potensi_pasar)
                         {
                              $('#desc-a-3-ppro-alert').addClass('has-error');
                              $('#desc-a-3-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_potensi_pasar +'</strong>');
                         } else {
                              $('#desc-a-3-ppro-alert').removeClass('has-error');
                              $('#desc-a-3-ppro-messages').removeClass('help-block').html('');
                         }


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


                          if(errors.messages.keterangan_parameter_sektor_unggulan)
                         {
                              $('#desc-a-4-ppro-alert').addClass('has-error');
                              $('#desc-a-4-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_parameter_sektor_unggulan +'</strong>');
                         } else {
                              $('#desc-a-4-ppro-alert').removeClass('has-error');
                              $('#desc-a-4-ppro-messages').removeClass('help-block').html('');
                         }


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


                          if(errors.messages.keterangan_subsektor_unggulan)
                         {
                              $('#desc-a-5-ppro-alert').addClass('has-error');
                              $('#desc-a-5-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_subsektor_unggulan +'</strong>');
                         } else {
                              $('#desc-a-5-ppro-alert').removeClass('has-error');
                              $('#desc-a-5-ppro-messages').removeClass('help-block').html('');
                         }



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


                          if(errors.messages.keterangan_intensif_daerah)
                         {
                              $('#desc-a-6-ppro-alert').addClass('has-error');
                              $('#desc-a-6-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_intensif_daerah +'</strong>');
                         } else {
                              $('#desc-a-6-ppro-alert').removeClass('has-error');
                              $('#desc-a-6-ppro-messages').removeClass('help-block').html('');
                         }



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


                          if(errors.messages.keterangan_potensi_lanjutan)
                         {
                              $('#desc-a-7-ppro-alert').addClass('has-error');
                              $('#desc-a-7-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_potensi_lanjutan +'</strong>');
                         } else {
                              $('#desc-a-7-ppro-alert').removeClass('has-error');
                              $('#desc-a-7-ppro-messages').removeClass('help-block').html('');
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