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
                                        <span>Total Budget Promosi</span>
                                        <h3 class="card-text" id="total_promosi"></h3>
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
                                        <span>Periode <span id="periode_selected" class="pd-top-bottom-5"></span></span>
                                        <h3 class="card-text" id="status-view"></h3>                                   
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

          <div class="col-sm-4 pull-left padding-default full">
               <div class="width-50 pull-left">
                                         
                 <div   class="pull-left padding-9-0">
                     <button type="button" id="Back" class="btn btn-primary border-radius-10">
                        <i class="fa fa-undo" aria-hidden="true"></i> Kembali
                     </button> 
                 </div>
               </div>
               
          </div>

          

          <div class="pull-left box box-solid box-primary">
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
                         <tbody id="content">
                                     
                         </tbody>
                         
                    </table>
                    </div>
               </div>
          </div>
          
          

         
     </form>
</div>

<script type="text/javascript">

     $(document).ready(function() {
    
          var periode =[];
          var periode_id = 0;
          var pagu_promosi = 0;
          var total_promosi = 0;
          var total_pra_produksi = 0;       
          var total_produksi = 0;
          var total_pasca_produksi = 0;
          var temp_total_budget = 0;
          var temp_total_pra_produksi = 0;
          var temp_total_produksi = 0;
          var temp_total_pasca_produksi = 0;

          var url = window.location.href; 
          var segments = url.split('/');  

          $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>'); 
     
          $('#pagu_promosi').html('<b>Rp. 0</b>');           
          $('#total_promosi').html('<b>Rp. 0</b>');           
 
          
         
          getPromosiDetail(); 


        $('#Back').click( () => {
             
         
            window.location.replace('/promosi'); 
           
          });
          

          function getPromosiDetail(){
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/promosi/'+ segments[5],
                    success: function(data) {
                         periode_id = data.periode_id;
                       
                         updateContent(data);
                       
                    },
                    error: function( error) {}
               });


          }

          function updateContent(item)
          {

            const content = $('#content');
           // Clear previous data
            content.empty();

     
               let row = ``;
            
                              row +=`<tr>`;
                            row +=`<td colspan="9" class="text-center font-bold">Proses Pengadaan Barang/Jasa</td>`;
                             row +=`</tr>`;  
                              row +=`<tr lass="pull-left full">`;
                            row +=`<td rowspan="9" class="font-bold text-center">1.</td>`;
                            row +=`<td colspan="4" class="font-bold"> Pra Produksi Meliputi : </td>`;
                              row +=`<td><strong id="total_pra_produksi">${item.total_pra_produksi }</td>`;
                             row +=`<td></td>`;
                            row +=`</tr>`;
                       row +=`<tr>`;
                         row +=`<td class="font-bold">A.</td>`;
                         row +=`<td class="-abjad font-bold">Rapat Teknis Membahas Rencana Kerja Antara Lain Menentukan Proyek/Peluang/Potensi Invenstasi Yang Akan Tampil Dalam Video</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-a-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input disabled type="date" id="startdate_a_pra" name="startdate_a_pra" value="${item.tgl_awal_peluang}" class="form-control">`;
                                   row +=`<span id="startdate-a-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-a-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" id="enddate_a_pra" name="enddate_a_pra"  value="${item.tgl_ahir_peluang}" class="form-control">`;
                                 row +=`<span id="enddate-a-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-a-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  id="budget_a_pra" type="number" name="budget_a_pra" value="${item.budget_peluang}" class="form-control promosi_inp pra_produksi">`;
                                 row +=`<span id="budget-a-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-a-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" id="desc_a_pra" name="desc_a_pra" value="${item.keterangan_peluang}" class="form-control">`;
                                 row +=`<span id="desc-a-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr>`;
                         row +=`<td class="font-bold">B.</td>`;
                         row +=`<td class="font-bold">Membuat Storyline</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-b-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input disabled  type="date" name="startdate_b_pra" value="${item.tgl_awal_storyline}" class="form-control">`;
                                   row +=`<span id="startdate-b-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-b-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" name="enddate_b_pra" value="${item.tgl_ahir_storyline}" class="form-control">`;
                                 row +=`<span id="enddate-b-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-b-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="number" name="budget_b_pra" value="${item.budget_storyline}" class="form-control pra_produksi promosi_inp">`;
                                 row +=`<span id="budget-b-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-b-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="desc_b_pra" value="${item.keterangan_storyline}" class="form-control">`;
                                 row +=`<span id="desc-b-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                         row +=`<td class="font-bold">C.</td>`;
                         row +=`<td class="font-bold">Membuat StoryBoard</td>`;
                       row +=`<td>`;
                              row +=`<div id="startdate-c-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input disabled  type="date" name="startdate_c_pra" value="${item.tgl_awal_storyboard}" class="form-control">`;
                                   row +=`<span id="startdate-c-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-c-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" name="enddate_c_pra" value="${item.tgl_ahir_storyboard}" class="form-control">`;
                                 row +=`<span id="enddate-c-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-c-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="number" name="budget_c_pra" value="${item.budget_storyboard}"  class="form-control pra_produksi promosi_inp">`;
                                 row +=`<span id="budget-c-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-c-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="desc_c_pra" value="${item.keterangan_storyboard}"  class="form-control">`;
                                 row +=`<span id="desc-c-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                         row +=`<td class="font-bold">D.</td>`;
                         row +=`<td class="font-bold">Penentuan Lokasi</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-d-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input disabled  type="date" name="startdate_d_pra" value="${item.tgl_awal_lokasi}"   class="form-control">`;
                                   row +=`<span id="startdate-d-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                           row +=`<div id="enddate-d-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" name="enddate_d_pra" value="${item.tgl_ahir_lokasi}"  class="form-control">`;
                                 row +=`<span id="enddate-d-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-d-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="number" name="budget_d_pra" value="${item.budget_lokasi}"  class="form-control pra_produksi promosi_inp">`;
                                 row +=`<span id="budget-d-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-d-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="desc_d_pra" value="${item.keterangan_lokasi}"  class="form-control">`;
                                 row +=`<span id="desc-d-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;
                        row +=`<tr>`;
                         row +=`<td class="font-bold">E.</td>`;
                         row +=`<td class="font-bold">Pemilihan Talent</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-e-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input disabled  type="date" name="startdate_e_pra" value="${item.tgl_awal_talent}" class="form-control">`;
                                   row +=`<span id="startdate-e-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-e-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" name="enddate_e_pra" value="${item.tgl_ahir_talent}" class="form-control">`;
                                 row +=`<span id="enddate-e-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-e-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="number" name="budget_e_pra" value="${item.budget_talent}" class="form-control pra_produksi promosi_inp">`;
                                 row +=`<span id="budget-e-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-e-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="desc_e_pra" value="${item.keterangan_talent}"   class="form-control">`;
                                 row +=`<span id="desc-e-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                         row +=`<td class="font-bold">F.</td>`;
                         row +=`<td class="font-bold">Pemilihan Pelaku Usaha Yang Memberikan Testimoni</td>`; 
                         row +=`<td>`;
                              row +=`<div id="startdate-f-pra-alert" class="margin-none form-group">`;
                                   row +=`<input disabled  type="date" name="startdate_f_pra" value="${item.tgl_awal_testimoni}"  class="form-control">`;
                                   row +=`<span id="startdate-f-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-f-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" name="enddate_f_pra" value="${item.tgl_ahir_testimoni}" class="form-control">`;
                                 row +=`<span id="enddate-f-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-f-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="number" name="budget_f_pra" value="${item.budget_testimoni}" class="form-control pra_produksi promosi_inp">`;
                                 row +=`<span id="budget-f-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-f-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="desc_f_pra" value="${item.keterangan_testimoni}"   class="form-control">`;
                                 row +=`<span id="desc-f-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr>`;
                         row +=`<td class="font-bold">G.</td>`;
                         row +=`<td class="font-bold">Pemilihan Element Audio Visual</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-g-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input disabled  type="date" name="startdate_g_pra_alert" value="${item.tgl_awal_audio}"  class="form-control">`;
                                   row +=`<span id="startdate-g-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-g-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" name="enddate_g_pra" value="${item.tgl_ahir_audio}" class="form-control">`;
                                 row +=`<span id="enddate-g-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-g-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="number" name="budget_g_pra" value="${item.budget_audio}" class="form-control pra_produksi promosi_inp">`;
                                 row +=`<span id="budget-g-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-g-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="desc_g_pra" value="${item.keterangan_audio}"   class="form-control">`;
                                 row +=`<span id="desc-g-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                         row +=`<td class="font-bold">H.</td>`;
                         row +=`<td class="font-bold">Pemilihan Video Editing Tools</td>`;
                       row +=`<td>`;
                              row +=`<div id="startdate-h-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input disabled  type="date" name="startdate_h_pra" value="${item.tgl_awal_editing}" class="form-control">`;
                                   row +=`<span id="startdate-h-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-h-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input disabled  type="date" name="enddate_h_pra" value="${item.tgl_ahir_editing}" class="form-control">`;
                                 row +=`<span id="enddate-h-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-h-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="budget_h_pra" value="${item.budget_editing}" class="form-control pra_produksi promosi_inp">`;
                                 row +=`<span id="budget-h-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-h-pra-alert" class="margin-none form-group">`;
                                        row +=`<input disabled  type="text" name="desc_h_pra" value="${item.keterangan_editing}"   class="form-control">`;
                                 row +=`<span id="desc-h-pra-messages"></span>`;
                            row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;

                             row +=`<tr >`;
                             row +=`<td rowspan="3" class="font-bold text-center">2.</td>`;
                             row +=`<td colspan="4" class="font-bold"> Produksi : </td>`;
                             row +=`<td><strong id="total_produksi">${item.total_produksi }</td>`;
                             row +=`<td></td>`;

                             row +=`</tr>`;
                              row +=`<tr>`;
                          row +=`<td class="font-bold">A.</td>`;
                          row +=`<td class="-abjad font-bold">Pengambilan Gambar Testimoni Pelaku Usaha</td>`;
                          row +=`<td>`;
                               row +=`<div id="startdate-a-pro-alert" class="margin-none form-group">`; 
                                    row +=`<input disabled  type="date" name="startdate_a_pro" value="${item.tgl_awal_gambar}"  class="form-control">`;
                                    row +=`<span id="startdate-a-pro-messages"></span>`;
                             row +=`</div>`;
                          row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="enddate-a-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled  type="date" name="enddate_a_pro" value="${item.tgl_ahir_gambar}" class="form-control">`;
                                  row +=`<span id="enddate-a-pro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="budget-a-pro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="number" name="budget_a_pro" value="${item.budget_gambar}" class="form-control produksi promosi_inp">`;
                                  row +=`<span id="budget-a-pro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                                    row +=`<div id="desc-a-pro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="text" name="desc_a_pro" value="${item.keterangan_gambar}"   class="form-control">`;
                                  row +=`<span id="desc-a-pro-messages"></span>`;
                             row +=`</div>`;

                               row +=`</td>`;
                        row +=`</tr>`;
                        row +=`<tr>`;
                          row +=`<td class="font-bold">B.</td>`;
                          row +=`<td class="-abjad font-bold">Pengambilan Gambar Di Lapangan Dan Pengumpulan Video</td>`;
                          row +=`<td>`;
                               row +=`<div id="startdate-b-pro-alert" class="margin-none form-group">`; 
                                    row +=`<input disabled  type="date" name="startdate_b_pro" value="${item.tgl_awal_video}" class="form-control">`;
                                    row +=`<span id="startdate-b-pro-messages"></span>`;
                             row +=`</div>`;
                          row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="enddate-b-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled  type="date" name="enddate_b_pro" value="${item.tgl_ahir_video}" class="form-control">`;
                                  row +=`<span id="enddate-b-pro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="budget-b-pro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="number" name="budget_b_pro " value="${item.budget_video}" class="form-control produksi promosi_inp">`;
                                  row +=`<span id="budget-b-pro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                              row +=`<td>`;
                                    row +=`<div id="desc-b-pro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="text" name="desc_b_pro" value="${item.keterangan_video}"   class="form-control">`;
                                  row +=`<span id="desc-b-pro-messages"></span>`;
                             row +=`</div>`;

                               row +=`</td>`;
                        row +=`</tr>`;
                            row +=`<tr>`;
                            row +=`<td rowspan="9" class="font-bold text-center">3.</td>`;
                            row +=`<td colspan="4" class="font-bold"> Pasca Produksi : </td>`;
                            row +=`<td><strong id="total_produksi">${item.total_pasca_produksi }</td>`;
                            row +=`<td></td>`;
                            row +=`</tr>`;
                             row +=`<tr>`;
                          row +=`<td class="font-bold">A.</td>`;
                          row +=`<td class="-abjad font-bold">Editing Video</td>`;
                          row +=`<td>`;
                               row +=`<div id="startdate-a-ppro-alert" class="margin-none form-group">`; 
                                    row +=`<input disabled  type="date" name="startdate_a_ppro" value="${item.tgl_awal_editvideo}" class="form-control">`;
                                    row +=`<span id="startdate-a-ppro-messages"></span>`;
                             row +=`</div>`;
                          row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="enddate-a-ppro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled  type="date" name="enddate_a_ppro"  value="${item.tgl_ahir_editvideo}" class="form-control">`;
                                  row +=`<span id="enddate-a-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="budget-a-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="number" name="budget_a_ppro" value="${item.budget_editvideo}" class="form-control pasca_produksi promosi_inp">`;
                                  row +=`<span id="budget-a-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                                    row +=`<div id="desc-a-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="text" name="desc_a_ppro" value="${item.keterangan_editvideo}"   class="form-control">`;
                                  row +=`<span id="desc-a-ppro-messages"></span>`;
                             row +=`</div>`;

                               row +=`</td>`;
                        row +=`</tr>`;
                        row +=`<tr>`;
                          row +=`<td class="font-bold">B.</td>`;
                          row +=`<td class="font-bold">Motion Grafik</td>`;
                          row +=`<td>`;
                               row +=`<div id="startdate-b-ppro-alert" class="margin-none form-group">`; 
                                    row +=`<input disabled  type="date" name="startdate_b_ppro" value="${item.tgl_awal_grafik}" class="form-control">`;
                                    row +=`<span id="startdate-b-ppro-messages"></span>`;
                             row +=`</div>`;
                          row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="enddate-b-ppro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled  type="date" name="enddate_b_ppro" value="${item.tgl_ahir_grafik}" class="form-control">`;
                                  row +=`<span id="enddate-b-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="budget-b-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="number" name="budget_b_ppro" value="${item.budget_grafik}" class="form-control pasca_produksi promosi_inp">`;
                                  row +=`<span id="budget-b-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                                    row +=`<div id="desc-b-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="text" name="desc_b_ppro" value="${item.keterangan_grafik}"   class="form-control">`;
                                  row +=`<span id="desc-b-ppro-messages"></span>`;
                             row +=`</div>`;

                               row +=`</td>`;
                       row +=` </tr>`;
                        row +=`<tr >`;
                          row +=`<td class="font-bold">C.</td>`;
                          row +=`<td class="font-bold">Music Compose Dan Mixing</td>`;
                        row +=`<td>`;
                               row +=`<div id="startdate-c-ppro-alert" class="margin-none form-group">`; 
                                    row +=`<input disabled  type="date" name="startdate_c_ppro" value="${item.tgl_awal_mixing}"  class="form-control">`;
                                    row +=`<span id="startdate-c-ppro-messages"></span>`;
                             row +=`</div>`;
                          row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="enddate-c-ppro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled  type="date" name="enddate_c_ppro" value="${item.tgl_ahir_mixing}" class="form-control">`;
                                  row +=`<span id="enddate-c-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="budget-c-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="number" name="budget_c_ppro" value="${item.budget_mixing}" class="form-control pasca_produksi promosi_inp">`;
                                  row +=`<span id="budget-c-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                                    row +=`<div id="desc-c-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="text" name="desc_c_ppro" value="${item.keterangan_mixing}"   class="form-control">`;
                                  row +=`<span id="desc-c-ppro-messages"></span>`;
                             row +=`</div>`;

                               row +=`</td>`;
                       row +=`</tr>`;
                        row +=`<tr >`;
                          row +=`<td class="font-bold">D.</td>`;
                          row +=`<td class="font-bold">Voice Over Talent</td>`;
                          row +=`<td>`;
                               row +=`<div id="startdate-d-ppro-alert" class="margin-none form-group">`; 
                                    row +=`<input disabled   type="date" name="startdate_d_ppro" value="${item.tgl_awal_voice}"  class="form-control">`;
                                    row +=`<span id="startdate-d-ppro-messages"></span>`;
                             row +=`</div>`;
                          row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="enddate-d-ppro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled  type="date" name="enddate_d_ppro" value="${item.tgl_ahir_voice}" class="form-control">`;
                                  row +=`<span id="enddate-d-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="budget-d-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="number" name="budget_d_ppro" value="${item.budget_voice}" class="form-control pasca_produksi promosi_inp">`;
                                  row +=`<span id="budget-d-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                                    row +=`<div id="desc-d-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="text" name="desc_d_ppro" value="${item.keterangan_voice}"   class="form-control">`;
                                  row +=`<span id="desc-d-ppro-messages"></span>`;
                             row +=`</div>`;

                               row +=`</td>`;
                        row +=`</tr>`;
                         row +=`<tr>`;
                          row +=`<td class="font-bold">E.</td>`;
                          row +=`<td class="font-bold">Subtitle</td>`;
                          row +=`<td>`;
                               row +=`<div id="startdate-e-ppro-alert" class="margin-none form-group">`; 
                                    row +=`<input disabled  type="date" name="startdate_e_ppro" value="${item.tgl_awal_subtitle}" class="form-control">`;
                                    row +=`<span id="startdate-e-ppro-messages"></span>`;
                             row +=`</div>`;
                          row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="enddate-e-ppro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled  type="date" name="enddate_d_ppro" value="${item.tgl_ahir_subtitle}"  class="form-control  ">`;
                                  row +=`<span id="enddate-e-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                             row +=`<div id="budget-e-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="number" name="budget_e_ppro" value="${item.budget_subtitle}" class="form-control pasca_produksi promosi_inp">`;
                                  row +=`<span id="budget-e-ppro-messages"></span>`;
                             row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td>`;
                                    row +=`<div id="desc-e-ppro-alert" class="margin-none form-group">`;
                                         row +=`<input disabled  type="text" name="desc_e_ppro" value="${item.keterangan_subtitle}"   class="form-control">`;
                                  row +=`<span id="desc-e-ppro-messages"></span>`;
                             row +=`</div>`;

                              row +=`</td>`;
                       row +=`</tr>`;        
                           //  BtnAction(item.id,item.status_laporan_id);

                       content.append(row);
                       pagu_promosi = item.pagu_promosi;
                       getperiode(item.periode_id); 
                       
                       $('#pagu_promosi').html('<b>'+item.pagu_promosi_convert+'</b>');
                       $('#total_promosi').html('<b>'+item.total_promosi_convert+'</b>');

                       if(item.request_edit == 'true')
                       {
                         $('#status-view').html('<b>Proses</b> (Waiting Request Edit)');
                       }else{
                         $('#status-view').html('<b>'+item.status.status_convert +'</b>'); 
                       } 
      
                   

 
         }

          function getperiode(periode_id){
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=PUT&action=promosi',
                    success: function(data) {
                         var select =  $('#periode_id');
                         $.each(data.result, function(index, option) {
                              select.append($('<option>', {
                                   value: option.value,
                                   text: option.text
                              }));
                         });
                         
                           
                        
                         select.val(periode_id);
                         select.prop('disabled',true);
                         select.selectpicker('refresh');
                         periode = data.result; 
                    },
                    error: function( error) {}
               });

               
          }



         
     });    

</script>
@stop