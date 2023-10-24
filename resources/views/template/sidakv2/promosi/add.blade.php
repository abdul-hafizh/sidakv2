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
                                        <span>Pagu Promosi</span>
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
                                        <span>Total Promosi</span>
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
                        <table class="table table-hover text-nowrap">
                         <thead>
                              <tr>

                                   <th rowspan="3"  class=" font-bold">No</th>
                                   <th rowspan="3" colspan="2" class="text-center font-bold">
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
                                      <span class="span-title">Periode Akhir</span>

                                   </th> 
                             </tr>
                              
                         </thead>
                         <tbody>
                              <tr>
                            <td colspan="9" class="text-center font-bold">Proses Pengadaan Barang/Jasa</td>
                             </tr> 
                              <tr lass="pull-left full">
                            <td rowspan="9" class="font-bold text-center">1</td>
                            <td colspan="4" class="font-bold"> Pra Produksi Meliputi : </td>
                            <td><strong id="total_pra_produksi">Rp 0</td>
                            <td></td>
                            </tr>
                       <tr>
                         <td class="font-bold">A.</td>
                         <td class="-abjad font-bold">Rapat Teknis Membahas Rencana Kerja Antara Lain Menentukan Proyek/Peluang/Potensi Invenstasi Yang Akan Tampil Dalam Video</td>
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
                         <td class="font-bold">Membuat Storyline</td>
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
                         <td class="font-bold">Membuat StoryBoard</td>
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
                         <td class="font-bold">Penentuan Lokasi</td>
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
                         <td class="font-bold">E.</td>
                         <td class="font-bold">Pemilihan Talent</td>
                         <td>
                              <div id="startdate-e-pra-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_e_pra" class="form-control">
                                   <span id="startdate-e-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-e-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_e_pra" class="form-control">
                                 <span id="enddate-e-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-e-pra-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_e_pra" class="form-control pra_produksi">
                                 <span id="budget-e-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-e-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_e_pra" class="form-control">
                                 <span id="desc-e-pra-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr >
                         <td class="font-bold">F.</td>
                         <td class="font-bold">Pemilihan Pelaku Usaha Yang Memberikan Testimoni</td>     
                         <td>
                              <div id="startdate-f-pra-alert" class="margin-none form-group"> 
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
                         <td class="font-bold">G.</td>
                         <td class="font-bold">Pemilihan Element Audio Visual</td>
                         <td>
                              <div id="startdate-g-pra-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_g_pra_alert" class="form-control pra-produksi">
                                   <span id="startdate-g-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-g-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_g_pra" class="form-control">
                                 <span id="enddate-g-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-g-pra-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" oninput="this.value = Math.abs(this.value)" name="budget_g_pra"   placeholder="Budget" value="0" class="form-control pra_produksi">
                                 <span id="budget-g-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-g-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_g_pra"  class="form-control">
                                 <span id="desc-g-pra-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr >
                         <td class="font-bold">H.</td>
                         <td class="font-bold">Pemilihan Video Editing Tools</td>
                       <td>
                              <div id="startdate-h-pra-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_h_pra" class="form-control">
                                   <span id="startdate-h-pra-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-h-pra-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_h_pra" class="form-control">
                                 <span id="enddate-h-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-h-pra-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number"  placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_h_pra" class="form-control pra_produksi">
                                 <span id="budget-h-pra-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-h-pra-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_h_pra" class="form-control">
                                 <span id="desc-h-pra-messages"></span>
                            </div>

                              </td>
                       </tr>

                            <tr >
                            <td rowspan="3" class="font-bold text-center">2</td>
                            <td colspan="4" class="font-bold"> Produksi : </td>
                            <td><strong id="total_produksi">Rp 0</td>
                            <td></td> 

                            
                            </tr>
                             <tr>
                         <td class="font-bold">A.</td>
                         <td class="-abjad font-bold">Pengambilan Gambar Testimoni Pelaku Usaha</td>
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
                         <td class="-abjad font-bold">Pengambilan Gambar Di Lapangan Dan Pengumpulan Video</td>
                         <td>
                              <div id="startdate-b-pro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_b_pro" class="form-control">
                                   <span id="startdate-b-pro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-b-pro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_b_pro" class="form-control">
                                 <span id="enddate-b-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-b-pro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_b_pro" class="form-control produksi">
                                 <span id="budget-b-pro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-b-pro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_b_pro" class="form-control">
                                 <span id="desc-b-pro-messages"></span>
                            </div>

                              </td>
                       </tr>
                            <tr>
                            <td rowspan="9" class="font-bold text-center">3</td>
                            <td colspan="4" class="font-bold"> Pasca Produksi : </td>
                             <td><strong id="total_pasca_produksi">Rp 0</td>
                            <td></td>
                            </tr>
                            <tr>
                         <td class="font-bold">A.</td>
                         <td class="-abjad font-bold">Editing Video</td>
                         <td>
                              <div id="startdate-a-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_a_ppro" class="form-control">
                                   <span id="startdate-a-ppro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-a-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_a_ppro" class="form-control">
                                 <span id="enddate-a-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-a-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_a_ppro" class="form-control pasca_produksi">
                                 <span id="budget-a-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-a-ppro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_a_ppro" class="form-control">
                                 <span id="desc-a-ppro-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr>
                         <td class="font-bold">B.</td>
                         <td class="font-bold">Motion Grafik</td>
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
                                        <input type="text" disabled name="desc_b_ppro" class="form-control pasca-produksi">
                                 <span id="desc-b-ppro-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr >
                         <td class="font-bold">C.</td>
                         <td class="font-bold">Music Compose Dan Mixing</td>
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
                                        <input type="text" disabled name="desc_c_ppro" class="form-control">
                                 <span id="desc-c-ppro-messages"></span>
                            </div>

                              </td>
                       </tr>
                       <tr >
                         <td class="font-bold">D.</td>
                         <td class="font-bold">Voice Over Talent</td>
                         <td>
                              <div id="startdate-d-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" disabled name="startdate_d_ppro" class="form-control">
                                   <span id="startdate-d-ppro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-d-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled name="enddate_d_ppro" class="form-control">
                                 <span id="enddate-d-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-d-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_d_ppro" class="form-control pasca_produksi">
                                 <span id="budget-d-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-d-ppro-alert" class="margin-none form-group">
                                        <input type="text" disabled name="desc_d_ppro" class="form-control">
                                 <span id="desc-d-ppro-messages"></span>
                            </div>

                              </td>
                       </tr>
                        <tr>
                         <td class="font-bold">E.</td>
                         <td class="font-bold">Subtitle</td>
                         <td>
                              <div id="startdate-e-ppro-alert" class="margin-none form-group"> 
                                   <input type="date" id="tgl_awal_subtitle" disabled name="startdate_e_ppro" class="form-control">
                                   <span id="startdate-e-ppro-messages"></span>
                            </div>
                         </td>
                              <td>
                            <div id="enddate-e-ppro-alert" class="margin-none form-group"> 
                                        <input type="date" disabled id="tgl_ahir_subtitle" name="enddate_e_ppro" class="form-control">
                                 <span id="enddate-e-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                            <div id="budget-e-ppro-alert" class="margin-none form-group">
                                        <input min="0" disabled type="number" placeholder="Budget" value="0" oninput="this.value = Math.abs(this.value)" name="budget_e_ppro" id="budget_subtitle" class="form-control pasca_produksi">
                                 <span id="budget-e-ppro-messages"></span>
                            </div>
                              </td>
                              <td>
                                   <div id="desc-e-ppro-alert" class="margin-none form-group">
                                        <input type="text" id="keterangan_subtitle" disabled name="desc_e_ppro" class="form-control ">
                                 <span id="desc-e-ppro-messages"></span>
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
                    url: BASE_URL +'/api/select-periode?type=POST&action=promosi',
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
                    'tgl_awal_peluang':data[0].value,
                    'tgl_ahir_peluang':data[1].value,
                    'budget_peluang':data[2].value,
                    'keterangan_peluang':data[3].value,

                    'tgl_awal_storyline':data[4].value,
                    'tgl_ahir_storyline':data[5].value,
                    'budget_storyline':data[6].value,
                    'keterangan_storyline':data[7].value,

                    'tgl_awal_storyboard':data[8].value,
                    'tgl_ahir_storyboard':data[9].value,
                    'budget_storyboard':data[10].value,
                    'keterangan_storyboard':data[11].value,

                    'tgl_awal_lokasi':data[12].value,
                    'tgl_ahir_lokasi':data[13].value,
                    'budget_lokasi':data[14].value,
                    'keterangan_lokasi':data[15].value,

                    'tgl_awal_talent':data[16].value,
                    'tgl_ahir_talent':data[17].value,
                    'budget_talent':data[18].value,
                    'keterangan_talent':data[19].value,

                    'tgl_awal_testimoni':data[20].value,
                    'tgl_ahir_testimoni':data[21].value,
                    'budget_testimoni':data[22].value,
                    'keterangan_testimoni':data[23].value,

                    'tgl_awal_audio':data[24].value,
                    'tgl_ahir_audio':data[25].value,
                    'budget_audio':data[26].value,
                    'keterangan_audio':data[27].value,

                    'tgl_awal_editing':data[28].value,
                    'tgl_ahir_editing':data[29].value,
                    'budget_editing':data[30].value,
                    'keterangan_editing':data[31].value,

                    'tgl_awal_gambar':data[32].value,
                    'tgl_ahir_gambar':data[33].value,
                    'budget_gambar':data[34].value,
                    'keterangan_gambar':data[35].value,

                    'tgl_awal_video':data[36].value,
                    'tgl_ahir_video':data[37].value,
                    'budget_video':data[38].value,
                    'keterangan_video':data[39].value,

                    'tgl_awal_editvideo':data[40].value,
                    'tgl_ahir_editvideo':data[41].value,
                    'budget_editvideo':data[42].value,
                    'keterangan_editvideo':data[43].value,

                    'tgl_awal_grafik':data[44].value,
                    'tgl_ahir_grafik':data[45].value,
                    'budget_grafik':data[46].value,
                    'keterangan_grafik':data[47].value,

                    'tgl_awal_mixing':data[48].value,
                    'tgl_ahir_mixing':data[49].value,
                    'budget_mixing':data[50].value,
                    'keterangan_mixing':data[51].value,

                    'tgl_awal_voice':data[52].value,
                    'tgl_ahir_voice':data[53].value,
                    'budget_voice':data[54].value,
                    'keterangan_voice':data[55].value,

                    'tgl_awal_subtitle':data[56].value,
                    'tgl_ahir_subtitle':data[57].value,
                    'budget_subtitle':data[58].value,
                    'keterangan_subtitle':data[59].value,
               };
              
          
               $.ajax({
                    type:"POST",
                    url: BASE_URL+'/api/promosi',
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
                                   window.location.replace('/promosi');
                              }
                         });
                    },

                    error: (respons) => {

                         errors = respons.responseJSON;
                         
                         if(errors.messages.tgl_awal_peluang)
                         {
                              $('#startdate-a-pra-alert').addClass('has-error');
                              $('#startdate-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_peluang +'</strong>');
                         } else {
                              $('#startdate-a-pra-alert').removeClass('has-error');
                              $('#startdate-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_peluang)
                         {
                              $('#enddate-a-pra-alert').addClass('has-error');
                              $('#enddate-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_peluang +'</strong>');
                         } else {
                              $('#enddate-a-pra-alert').removeClass('has-error');
                              $('#enddate-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_peluang)
                         {
                              $('#budget-a-pra-alert').addClass('has-error');
                              $('#budget-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_peluang +'</strong>');
                         } else {
                              $('#budget-a-pra-alert').removeClass('has-error');
                              $('#budget-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_peluang)
                         {
                              $('#desc-a-pra-alert').addClass('has-error');
                              $('#desc-a-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_peluang +'</strong>');
                         } else {
                              $('#desc-a-pra-alert').removeClass('has-error');
                              $('#desc-a-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_storyline)
                         {
                              $('#startdate-b-pra-alert').addClass('has-error');
                              $('#startdate-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_storyline +'</strong>');
                         } else {
                              $('#startdate-b-pra-alert').removeClass('has-error');
                              $('#startdate-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_storyline)
                         {
                              $('#enddate-b-pra-alert').addClass('has-error');
                              $('#enddate-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_storyline +'</strong>');
                         } else {
                              $('#enddate-b-pra-alert').removeClass('has-error');
                              $('#enddate-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_storyline)
                         {
                              $('#budget-b-pra-alert').addClass('has-error');
                              $('#budget-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_storyline +'</strong>');
                         } else {
                              $('#budget-b-pra-alert').removeClass('has-error');
                              $('#budget-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_storyline)
                         {
                              $('#desc-b-pra-alert').addClass('has-error');
                              $('#desc-b-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_storyline +'</strong>');
                         } else {
                              $('#desc-b-pra-alert').removeClass('has-error');
                              $('#desc-b-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_storyboard)
                         {
                              $('#startdate-c-pra-alert').addClass('has-error');
                              $('#startdate-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_storyboard +'</strong>');
                         } else {
                              $('#startdate-c-pra-alert').removeClass('has-error');
                              $('#startdate-c-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_storyboard)
                         {
                              $('#enddate-c-pra-alert').addClass('has-error');
                              $('#enddate-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_storyboard +'</strong>');
                         } else {
                              $('#enddate-c-pra-alert').removeClass('has-error');
                              $('#enddate-c-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_storyboard)
                         {
                              $('#budget-c-pra-alert').addClass('has-error');
                              $('#budget-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_storyboard +'</strong>');
                         } else {
                              $('#budget-c-pra-alert').removeClass('has-error');
                              $('#budget-c-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_storyboard)
                         {
                              $('#desc-c-pra-alert').addClass('has-error');
                              $('#desc-c-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_storyboard +'</strong>');
                         } else {
                              $('#desc-c-pra-alert').removeClass('has-error');
                              $('#desc-c-pra-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.tgl_awal_lokasi)
                         {
                              $('#startdate-d-pra-alert').addClass('has-error');
                              $('#startdate-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_lokasi +'</strong>');
                         } else {
                              $('#startdate-d-pra-alert').removeClass('has-error');
                              $('#startdate-d-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_lokasi)
                         {
                              $('#enddate-d-pra-alert').addClass('has-error');
                              $('#enddate-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_lokasi +'</strong>');
                         } else {
                              $('#enddate-d-pra-alert').removeClass('has-error');
                              $('#enddate-d-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_lokasi)
                         {
                              $('#budget-d-pra-alert').addClass('has-error');
                              $('#budget-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_lokasi +'</strong>');
                         } else {
                              $('#budget-d-pra-alert').removeClass('has-error');
                              $('#budget-d-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_lokasi)
                         {
                              $('#desc-d-pra-alert').addClass('has-error');
                              $('#desc-d-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_lokasi +'</strong>');
                         } else {
                              $('#desc-d-pra-alert').removeClass('has-error');
                              $('#desc-d-pra-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.tgl_awal_talent)
                         {
                              $('#startdate-e-pra-alert').addClass('has-error');
                              $('#startdate-e-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_talent +'</strong>');
                         } else {
                              $('#startdate-e-pra-alert').removeClass('has-error');
                              $('#startdate-e-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_talent)
                         {
                              $('#enddate-e-pra-alert').addClass('has-error');
                              $('#enddate-e-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_talent +'</strong>');
                         } else {
                              $('#enddate-e-pra-alert').removeClass('has-error');
                              $('#enddate-e-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_talent)
                         {
                              $('#budget-e-pra-alert').addClass('has-error');
                              $('#budget-e-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_talent +'</strong>');
                         } else {
                              $('#budget-e-pra-alert').removeClass('has-error');
                              $('#budget-e-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_talent)
                         {
                              $('#desc-e-pra-alert').addClass('has-error');
                              $('#desc-e-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_talent +'</strong>');
                         } else {
                              $('#desc-e-pra-alert').removeClass('has-error');
                              $('#desc-e-pra-messages').removeClass('help-block').html('');
                         }

                          if(errors.messages.tgl_awal_testimoni)
                         {
                              $('#startdate-f-pra-alert').addClass('has-error');
                              $('#startdate-f-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_testimoni +'</strong>');
                         } else {
                              $('#startdate-f-pra-alert').removeClass('has-error');
                              $('#startdate-f-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_testimoni)
                         {
                              $('#enddate-f-pra-alert').addClass('has-error');
                              $('#enddate-f-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_testimoni +'</strong>');
                         } else {
                              $('#enddate-f-pra-alert').removeClass('has-error');
                              $('#enddate-f-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_testimoni)
                         {
                              $('#budget-f-pra-alert').addClass('has-error');
                              $('#budget-f-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_testimoni +'</strong>');
                         } else {
                              $('#budget-f-pra-alert').removeClass('has-error');
                              $('#budget-f-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_testimoni)
                         {
                              $('#desc-f-pra-alert').addClass('has-error');
                              $('#desc-f-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_testimoni +'</strong>');
                         } else {
                              $('#desc-f-pra-alert').removeClass('has-error');
                              $('#desc-f-pra-messages').removeClass('help-block').html('');
                         }


                           if(errors.messages.tgl_awal_audio)
                         {
                              $('#startdate-g-pra-alert').addClass('has-error');
                              $('#startdate-g-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_audio +'</strong>');
                         } else {
                              $('#startdate-g-pra-alert').removeClass('has-error');
                              $('#startdate-g-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_audio)
                         {
                              $('#enddate-g-pra-alert').addClass('has-error');
                              $('#enddate-g-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_audio +'</strong>');
                         } else {
                              $('#enddate-g-pra-alert').removeClass('has-error');
                              $('#enddate-g-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_audio)
                         {
                              $('#budget-g-pra-alert').addClass('has-error');
                              $('#budget-g-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_audio +'</strong>');
                         } else {
                              $('#budget-g-pra-alert').removeClass('has-error');
                              $('#budget-g-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_audio)
                         {
                              $('#desc-g-pra-alert').addClass('has-error');
                              $('#desc-g-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_audio +'</strong>');
                         } else {
                              $('#desc-g-pra-alert').removeClass('has-error');
                              $('#desc-g-pra-messages').removeClass('help-block').html('');
                         }


                           if(errors.messages.tgl_awal_editing)
                         {
                              $('#startdate-h-pra-alert').addClass('has-error');
                              $('#startdate-h-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_editing +'</strong>');
                         } else {
                              $('#startdate-h-pra-alert').removeClass('has-error');
                              $('#startdate-h-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_editing)
                         {
                              $('#enddate-h-pra-alert').addClass('has-error');
                              $('#enddate-h-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_editing +'</strong>');
                         } else {
                              $('#enddate-h-pra-alert').removeClass('has-error');
                              $('#enddate-h-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_editing)
                         {
                              $('#budget-h-pra-alert').addClass('has-error');
                              $('#budget-h-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_editing +'</strong>');
                         } else {
                              $('#budget-h-pra-alert').removeClass('has-error');
                              $('#budget-h-pra-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_editing)
                         {
                              $('#desc-h-pra-alert').addClass('has-error');
                              $('#desc-h-pra-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_editing +'</strong>');
                         } else {
                              $('#desc-h-pra-alert').removeClass('has-error');
                              $('#desc-h-pra-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.tgl_awal_gambar)
                         {
                              $('#startdate-a-pro-alert').addClass('has-error');
                              $('#startdate-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_gambar +'</strong>');
                         } else {
                              $('#startdate-a-pro-alert').removeClass('has-error');
                              $('#startdate-a-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_gambar)
                         {
                              $('#enddate-a-pro-alert').addClass('has-error');
                              $('#enddate-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_gambar +'</strong>');
                         } else {
                              $('#enddate-a-pro-alert').removeClass('has-error');
                              $('#enddate-a-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_gambar)
                         {
                              $('#budget-a-pro-alert').addClass('has-error');
                              $('#budget-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_gambar +'</strong>');
                         } else {
                              $('#budget-a-pro-alert').removeClass('has-error');
                              $('#budget-a-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_gambar)
                         {
                              $('#desc-a-pro-alert').addClass('has-error');
                              $('#desc-a-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_gambar +'</strong>');
                         } else {
                              $('#desc-a-pro-alert').removeClass('has-error');
                              $('#desc-a-pro-messages').removeClass('help-block').html('');
                         }


                         if(errors.messages.tgl_awal_video)
                         {
                              $('#startdate-b-pro-alert').addClass('has-error');
                              $('#startdate-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_video +'</strong>');
                         } else {
                              $('#startdate-b-pro-alert').removeClass('has-error');
                              $('#startdate-b-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_video)
                         {
                              $('#enddate-b-pro-alert').addClass('has-error');
                              $('#enddate-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_video +'</strong>');
                         } else {
                              $('#enddate-b-pro-alert').removeClass('has-error');
                              $('#enddate-b-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_video)
                         {
                              $('#budget-b-pro-alert').addClass('has-error');
                              $('#budget-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_video +'</strong>');
                         } else {
                              $('#budget-b-pro-alert').removeClass('has-error');
                              $('#budget-b-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_video)
                         {
                              $('#desc-b-pro-alert').addClass('has-error');
                              $('#desc-b-pro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_video +'</strong>');
                         } else {
                              $('#desc-b-pro-alert').removeClass('has-error');
                              $('#desc-b-pro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_editvideo)
                         {
                              $('#startdate-a-ppro-alert').addClass('has-error');
                              $('#startdate-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_editvideo +'</strong>');
                         } else {
                              $('#startdate-a-ppro-alert').removeClass('has-error');
                              $('#startdate-a-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_editvideo)
                         {
                              $('#enddate-a-ppro-alert').addClass('has-error');
                              $('#enddate-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_editvideo +'</strong>');
                         } else {
                              $('#enddate-a-ppro-alert').removeClass('has-error');
                              $('#enddate-a-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_editvideo)
                         {
                              $('#budget-a-ppro-alert').addClass('has-error');
                              $('#budget-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_editvideo +'</strong>');
                         } else {
                              $('#budget-a-ppro-alert').removeClass('has-error');
                              $('#budget-a-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_editvideo)
                         {
                              $('#desc-a-ppro-alert').addClass('has-error');
                              $('#desc-a-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_editvideo +'</strong>');
                         } else {
                              $('#desc-a-ppro-alert').removeClass('has-error');
                              $('#desc-a-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_awal_grafik)
                         {
                              $('#startdate-b-ppro-alert').addClass('has-error');
                              $('#startdate-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_grafik +'</strong>');
                         } else {
                              $('#startdate-b-ppro-alert').removeClass('has-error');
                              $('#startdate-b-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_grafik)
                         {
                              $('#enddate-b-ppro-alert').addClass('has-error');
                              $('#enddate-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_grafik +'</strong>');
                         } else {
                              $('#enddate-b-ppro-alert').removeClass('has-error');
                              $('#enddate-b-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_grafik)
                         {
                              $('#budget-b-ppro-alert').addClass('has-error');
                              $('#budget-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_grafik +'</strong>');
                         } else {
                              $('#budget-b-ppro-alert').removeClass('has-error');
                              $('#budget-b-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_grafik)
                         {
                              $('#desc-b-ppro-alert').addClass('has-error');
                              $('#desc-b-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_grafik +'</strong>');
                         } else {
                              $('#desc-b-ppro-alert').removeClass('has-error');
                              $('#desc-b-ppro-messages').removeClass('help-block').html('');
                         }

                           if(errors.messages.tgl_awal_mixing)
                         {
                              $('#startdate-c-ppro-alert').addClass('has-error');
                              $('#startdate-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_mixing +'</strong>');
                         } else {
                              $('#startdate-c-ppro-alert').removeClass('has-error');
                              $('#startdate-c-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_mixing)
                         {
                              $('#enddate-c-ppro-alert').addClass('has-error');
                              $('#enddate-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_mixing +'</strong>');
                         } else {
                              $('#enddate-c-ppro-alert').removeClass('has-error');
                              $('#enddate-c-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_mixing)
                         {
                              $('#budget-c-ppro-alert').addClass('has-error');
                              $('#budget-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_mixing +'</strong>');
                         } else {
                              $('#budget-c-ppro-alert').removeClass('has-error');
                              $('#budget-c-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_mixing)
                         {
                              $('#desc-c-ppro-alert').addClass('has-error');
                              $('#desc-c-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_mixing +'</strong>');
                         } else {
                              $('#desc-c-ppro-alert').removeClass('has-error');
                              $('#desc-c-ppro-messages').removeClass('help-block').html('');
                         }


                           if(errors.messages.tgl_awal_voice)
                         {
                              $('#startdate-d-ppro-alert').addClass('has-error');
                              $('#startdate-d-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_voice +'</strong>');
                         } else {
                              $('#startdate-d-ppro-alert').removeClass('has-error');
                              $('#startdate-d-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_voice)
                         {
                              $('#enddate-d-ppro-alert').addClass('has-error');
                              $('#enddate-d-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_voice +'</strong>');
                         } else {
                              $('#enddate-d-ppro-alert').removeClass('has-error');
                              $('#enddate-d-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_voice)
                         {
                              $('#budget-d-ppro-alert').addClass('has-error');
                              $('#budget-d-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_voice +'</strong>');
                         } else {
                              $('#budget-d-ppro-alert').removeClass('has-error');
                              $('#budget-d-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_voice)
                         {
                              $('#desc-d-ppro-alert').addClass('has-error');
                              $('#desc-d-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_voice +'</strong>');
                         } else {
                              $('#desc-d-ppro-alert').removeClass('has-error');
                              $('#desc-d-ppro-messages').removeClass('help-block').html('');
                         }


                           if(errors.messages.tgl_awal_subtitle)
                         {
                              $('#startdate-e-ppro-alert').addClass('has-error');
                              $('#startdate-e-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_awal_subtitle +'</strong>');
                         } else {
                              $('#startdate-e-ppro-alert').removeClass('has-error');
                              $('#startdate-e-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.tgl_ahir_subtitle)
                         {
                              $('#enddate-e-ppro-alert').addClass('has-error');
                              $('#enddate-e-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_ahir_subtitle +'</strong>');
                         } else {
                              $('#enddate-e-ppro-alert').removeClass('has-error');
                              $('#enddate-e-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.budget_subtitle)
                         {
                              $('#budget-e-ppro-alert').addClass('has-error');
                              $('#budget-e-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.budget_subtitle +'</strong>');
                         } else {
                              $('#budget-e-ppro-alert').removeClass('has-error');
                              $('#budget-e-ppro-messages').removeClass('help-block').html('');
                         }


                          if(errors.messages.keterangan_subtitle)
                         {
                              $('#desc-e-ppro-alert').addClass('has-error');
                              $('#desc-e-ppro-messages').addClass('help-block').html('<strong>'+ errors.messages.keterangan_subtitle +'</strong>');
                         } else {
                              $('#desc-e-ppro-alert').removeClass('has-error');
                              $('#desc-e-ppro-messages').removeClass('help-block').html('');
                         }

                          
                    }
               });
          }
     });    

</script>
@stop