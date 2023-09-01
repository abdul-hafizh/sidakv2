@extends('template/sidakv2/layout.app')
@section('content')
<style>
     tr.border-bottom td {
          border-bottom: 3pt solid #f4f4f4;
     }
     td {
          padding: 10px !important;
     }
</style>
<div class="content">
     <form id="FormSubmit">
          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body">
                       <div class="row pd-top-bottom-15">  
                         <div class="col-sm-4">
                              <div class="form-group">
                                   <label  class="col-sm-3 label-header-box align-left">Pagu APBN :</label>
                                   <div class="col-sm-9">
                                      <div id="pagu_apbn" class="align-left pd-top-bottom-6" ></div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-sm-4">
                                <div class="form-group">
                                   <label  class="col-sm-4 label-header-box align-left">Total Rencana :</label>
                                   <div class="col-sm-8">
                                      <div id="total_rencana" class="align-left pd-top-bottom-6" ></div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-sm-4">
                              <div class="form-group">
                                   <label  class="col-sm-5 label-header-box align-right">Periode :</label>
                                   <div class="col-sm-7">
                                      <div id="periode_selected" class="align-left pd-top-bottom-6"></div>
                                   </div>
                              </div>
                         </div>
                        </div> 
                         <!--  -->
                    </div>
               </div>
          </div>


          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body table-responsive">
                         <table class="table table-hover text-nowrap">
                              <thead>
                                   <tr>
                                        <th><div></div><span class="span-title">No</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Kegiatan/Sub Kegiatan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Target</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Satuan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Pagu APBN (Rp)</span></th>
                                   </tr>
                              </thead>
                              <tbody id="ShowEdit">
                                   
                              </tbody>
                         </table>
                    </div>
               </div>

          </div>

               <div class="box box-solid box-primary">
                    <div class="box-body">
                         <div class="card-body">
                            <div id="Attr" class="row pd-top-bottom-15"> 
                                  

                             </div>

                         </div>
                    </div>
               </div>  

              
     </form>
</div>

<script type="text/javascript">

     $(document).ready(function() {
          
          var periode =[];
          var pagu_apbn = 0;             
          var url = window.location.href; 
          var segments = url.split('/');  


          $.ajax({
               type: 'GET',
               url: BASE_URL +'/api/perencanaan/edit/' + segments[5],
               success: function(response) {
                    list = response;  
                    $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>');    
                    getdataid(list);              
               },
               error: function( error) { }
          });

          

          $("#kirim").click( () => {

               var data = $("#FormSubmit").serializeArray();
               var periode_id = $('#periode_id').val();
             
               var form = {
                    "pengawas_analisa_target":data[0].value,
                    "pengawas_analisa_pagu":data[1].value,
                    "pengawas_inspeksi_target":data[2].value,
                    "pengawas_inspeksi_pagu":data[3].value,
                    "pengawas_evaluasi_target":data[4].value,
                    "pengawas_evaluasi_pagu":data[5].value,
                    "bimtek_perizinan_target":data[6].value,
                    "bimtek_perizinan_pagu":data[7].value,
                    "bimtek_pengawasan_target":data[8].value,
                    "bimtek_pengawasan_pagu":data[9].value,
                    "penyelesaian_identifikasi_target":data[10].value,
                    "penyelesaian_identifikasi_pagu":data[11].value,
                    "penyelesaian_realisasi_target":data[12].value,
                    "penyelesaian_realisasi_pagu":data[13].value,
                    "penyelesaian_evaluasi_target":data[14].value,
                    "penyelesaian_evaluasi_pagu":data[15].value,
                    "lokasi":data[16].value,
                    "tgl_tandatangan":data[17].value,
                    "nama_pejabat":data[18].value,
                    "nip_pejabat":data[19].value,
                    "periode_id":periode_id,
                    "type":'kirim',
                    "param":'update',
               };
                    
               SendingData(form);

              
               
          });

       
      function SendingData(form) {

               var pesan = '';

               if (form.type == 'kirim') {
                    pesan = 'Terkirim ke Pusat.';
               } else {
                    pesan = 'Berhasil Diupdate.';
               }

               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/' + segments[5],
                    data:form,
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
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },

                    error: (respons) => {

                         errors = respons.responseJSON;
                         
                         if(errors.messages.pengawas_analisa_target)
                         {
                              $('#pengawas-analisa-target-alert').addClass('has-error');
                              $('#pengawas-analisa-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_analisa_target +'</strong>');
                         } else {
                              $('#pengawas-analisa-target-alert').removeClass('has-error');
                              $('#pengawas-analisa-target-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.pengawas_analisa_pagu)
                         {
                              $('#pengawas-analisa-pagu-alert').addClass('has-error');
                              $('#pengawas-analisa-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_analisa_pagu +'</strong>');
                         } else {
                              $('#pengawas-analisa-pagu-alert').removeClass('has-error');
                              $('#pengawas-analisa-pagu-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.pengawas_inspeksi_target)
                         {
                              $('#pengawas-inspeksi-target-alert').addClass('has-error');
                              $('#pengawas-inspeksi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_inspeksi_target +'</strong>');
                         } else {
                              $('#pengawas-inspeksi-target-alert').removeClass('has-error');
                              $('#pengawas-inspeksi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.pengawas_inspeksi_pagu)
                         {
                              $('#pengawas-inspeksi-pagu-alert').addClass('has-error');
                              $('#pengawas-inspeksi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_inspeksi_pagu +'</strong>');
                         } else {
                              $('#pengawas-inspeksi-pagu-alert').removeClass('has-error');
                              $('#pengawas-inspeksi-pagu-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.pengawas_evaluasi_target)
                         {
                              $('#pengawas-evaluasi-target-alert').addClass('has-error');
                              $('#pengawas-evaluasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_evaluasi_target +'</strong>');
                         } else {
                              $('#pengawas-evaluasi-target-alert').removeClass('has-error');
                              $('#pengawas-evaluasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.pengawas_evaluasi_pagu)
                         {
                              $('#pengawas-evaluasi-pagu-alert').addClass('has-error');
                              $('#pengawas-evaluasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_evaluasi_pagu +'</strong>');
                         } else {
                              $('#pengawas-evaluasi-pagu-alert').removeClass('has-error');
                              $('#pengawas-evaluasi-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.bimtek_perizinan_target)
                         {
                              $('#bimtek-perizinan-target-alert').addClass('has-error');
                              $('#bimtek-perizinan-target-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_perizinan_target +'</strong>');
                         } else {
                              $('#bimtek-perizinan-target-alert').removeClass('has-error');
                              $('#bimtek-perizinan-target-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.bimtek_perizinan_pagu)
                         {
                              $('#bimtek-perizinan-pagu-alert').addClass('has-error');
                              $('#bimtek-perizinan-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_perizinan_pagu +'</strong>');
                         } else {
                              $('#bimtek-perizinan-pagu-alert').removeClass('has-error');
                              $('#bimtek-perizinan-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.bimtek_pengawasan_target)
                         {
                              $('#bimtek-pengawasan-target-alert').addClass('has-error');
                              $('#bimtek-pengawasan-target-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_pengawasan_target +'</strong>');
                         } else {
                              $('#bimtek-pengawasan-target-alert').removeClass('has-error');
                              $('#bimtek-pengawasan-target-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.bimtek_pengawasan_pagu)
                         {
                              $('#bimtek-pengawasan-pagu-alert').addClass('has-error');
                              $('#bimtek-pengawasan-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_pengawasan_pagu +'</strong>');
                         } else {
                              $('#bimtek-pengawasan-pagu-alert').removeClass('has-error');
                              $('#bimtek-pengawasan-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_identifikasi_target)
                         {
                              $('#penyelesaian-identifikasi-target-alert').addClass('has-error');
                              $('#penyelesaian-identifikasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_identifikasi_target +'</strong>');
                         } else {
                              $('#penyelesaian-identifikasi-target-alert').removeClass('has-error');
                              $('#penyelesaian-identifikasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_identifikasi_pagu)
                         {
                              $('#penyelesaian-identifikasi-pagu-alert').addClass('has-error');
                              $('#penyelesaian-identifikasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_identifikasi_pagu +'</strong>');
                         } else {
                              $('#penyelesaian-identifikasi-pagu-alert').removeClass('has-error');
                              $('#penyelesaian-identifikasi-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_realisasi_target)
                         {
                              $('#penyelesaian-realisasi-target-alert').addClass('has-error');
                              $('#penyelesaian-realisasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_realisasi_target +'</strong>');
                         } else {
                              $('#penyelesaian-realisasi-target-alert').removeClass('has-error');
                              $('#penyelesaian-realisasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_realisasi_pagu)
                         {
                              $('#penyelesaian-realisasi-pagu-alert').addClass('has-error');
                              $('#penyelesaian-realisasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_realisasi_pagu +'</strong>');
                         } else {
                              $('#penyelesaian-realisasi-pagu-alert').removeClass('has-error');
                              $('#penyelesaian-realisasi-pagu-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.penyelesaian_evaluasi_target)
                         {
                              $('#penyelesaian-evaluasi-target-alert').addClass('has-error');
                              $('#penyelesaian-evaluasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_evaluasi_target +'</strong>');
                         } else {
                              $('#penyelesaian-evaluasi-target-alert').removeClass('has-error');
                              $('#penyelesaian-evaluasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_evaluasi_pagu)
                         {
                              $('#penyelesaian-evaluasi-pagu-alert').addClass('has-error');
                              $('#penyelesaian-evaluasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_evaluasi_pagu +'</strong>');
                         } else {
                              $('#penyelesaian-evaluasi-pagu-alert').removeClass('has-error');
                              $('#penyelesaian-evaluasi-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.periode_id)
                         {
                              $('#periode-id-alert').addClass('has-error');
                              $('#periode-id-messages').addClass('help-block').html('<strong>'+ errors.messages.periode_id +'</strong>');
                         } else {
                              $('#periode-id-alert').removeClass('has-error');
                              $('#periode-id-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.nama_pejabat)
                         {
                              $('#nama-pejabat-alert').addClass('has-error');
                              $('#nama-pejabat-messages').addClass('help-block').html('<strong>'+ errors.messages.nama_pejabat +'</strong>');
                         } else {
                              $('#nama-pejabat-alert').removeClass('has-error');
                              $('#nama-pejabat-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.nip_pejabat)
                         {
                              $('#nip-pejabat-alert').addClass('has-error');
                              $('#nip-pejabat-messages').addClass('help-block').html('<strong>'+ errors.messages.nip_pejabat +'</strong>');
                         } else {
                              $('#nip-pejabat-alert').removeClass('has-error');
                              $('#nip-pejabat-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.tgl_tandatangan)
                         {
                              $('#tgl-tandatangan-alert').addClass('has-error');
                              $('#tgl-tandatangan-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_tandatangan +'</strong>');
                         } else {
                              $('#tgl-tandatangan-alert').removeClass('has-error');
                              $('#tgl-tandatangan-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.lokasi)
                         {
                              $('#lokasi-alert').addClass('has-error');
                              $('#lokasi-messages').addClass('help-block').html('<strong>'+ errors.messages.lokasi +'</strong>');
                         } else {
                              $('#lokasi-alert').removeClass('has-error');
                              $('#lokasi-messages').removeClass('help-block').html('');
                         }  
                    }
               });
          }
   
     function getdataid(data)
     {
           
               $('#pagu_apbn').html('<b>'+data.pagu_apbn+'</b>');
               $('#total_rencana').html('<b>'+data.total_rencana+'</b>');
               $('#periode_selected').html('<b>'+data.periode_name+'</b>');
               
               var row = '';
               var rows = '';
               row+= '<tr>';
                    row+= '<td><strong>1</strong></td>';
                    row+= '<td class="text-left"><strong>Pengawasan Penanaman Modal</strong></td>';
                    row+= '<td class="text-center"><strong id="total_pengawasan_target">'+data.total_target_pengawasan +'</strong></td>';
                    row+= '<td class="text-center"><strong>Kegiatan Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_pengawasan_pagu">'+data.total_pagu_pengawasan +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_analisa_target" name="pengawas_analisa_target" type="number" min="0" class="form-control pengawasan_nilai_target" value="'+ data.pengawas_analisa_target +'" placeholder="Target">';
                         row+= '<span id="pengawas-analisa-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_analisa_pagu" name="pengawas_analisa_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_analisa_pagu +'">';
                         row+= '<span id="pengawas-analisa-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>B. Inspeksi Lapangan</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_inspeksi_target" name="pengawas_inspeksi_target" type="number" min="0" class="form-control pengawasan_nilai_target" placeholder="Target" value="'+ data.pengawas_inspeksi_target +'">';
                         row+= '<span id="pengawas-inspeksi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_inspeksi_pagu" name="pengawas_inspeksi_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_inspeksi_pagu +'">';                                      
                         row+= '<span id="pengawas-inspeksi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>C. Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_evaluasi_target" name="pengawas_evaluasi_target" type="number" min="0" class="form-control pengawasan_nilai_target" value="'+ data.pengawas_evaluasi_target +'" placeholder="Target">';
                         row+= '<span id="pengawas-evaluasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_evaluasi_pagu" name="pengawas_evaluasi_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_evaluasi_pagu +'">';
                         row+= '<span id="pengawas-evaluasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';


               row+= '<tr>';
                    row+= '<td><strong>2</strong></td>';
                    row+= '<td class="text-left"><strong>Bimbingan Teknis Kepada Pelaku Usaha</strong></td>';
                    row+= '<td class="text-center"><strong id="total_bimtek_target">'+data.total_target_bimtek +'</strong></td>';
                    row+= '<td class="text-center"><strong>Pelaku Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_bimtek_pagu">'+ data.total_pagu_bimtek +'</strong></td>';
               row+= '</tr>';
               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko</td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_perizinan_target" name="bimtek_perizinan_target" type="number" min="0" class="form-control bimtek_nilai_target" value="'+ data.bimtek_perizinan_target +'" placeholder="Target">';
                         row+= '<span id="bimtek-perizinan-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_perizinan_pagu" name="bimtek_perizinan_pagu" type="number" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_perizinan_pagu +'">';
                         row+= '<span id="bimtek-perizinan-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';
               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>B. Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko</td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_pengawasan_target" name="bimtek_pengawasan_target" type="number" min="0" class="form-control bimtek_nilai_target" value="'+ data.bimtek_pengawasan_target +'" placeholder="Target">';
                         row+= '<span id="bimtek-pengawasan-target-messages"></span> ';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_pengawasan_pagu" name="bimtek_pengawasan_pagu" type="number" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_pengawasan_pagu +'">';
                         row+= '<span id="bimtek-pengawasan-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';


               row+= '<tr>';
                    row+= '<td><strong>3</strong></td>';
                    row+= '<td class="text-left"><strong>Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</strong></td>';
                    row+= '<td class="text-center"><strong id="total_penyelesaian_target">'+ data.total_target_penyelesaian +'</strong></td>';
                    row+= '<td class="text-center"><strong>Kegiatan Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_penyelesaian_pagu">'+ data.total_pagu_penyelesaian +'</strong></td>';
               row+= '</tr>';
               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Identifikasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_identifikasi_target" name="penyelesaian_identifikasi_target" value="'+ data.penyelesaian_identifikasi_target+'" type="number" class="form-control penyelesaian_nilai_target" placeholder="Target">';
                         row+= '<span id="penyelesaian-identifikasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_identifikasi_pagu" name="penyelesaian_identifikasi_pagu" type="number" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_identifikasi_pagu +'">';
                         row+= '<span id="penyelesaian-identifikasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';
               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>B. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_realisasi_target" name="penyelesaian_realisasi_target" value="'+ data.penyelesaian_realisasi_target +'" type="number" class="form-control penyelesaian_nilai_target" placeholder="Target">';
                         row+= '<span id="penyelesaian-realisasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_realisasi_pagu" name="penyelesaian_realisasi_pagu" type="number" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_realisasi_pagu +'">';
                         row+= '<span id="penyelesaian-realisasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';
               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>C. Evaluasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya Perizinan <br/> Berusaha Para Pelaku Usaha</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_evaluasi_target" name="penyelesaian_evaluasi_target" value="'+ data.penyelesaian_evaluasi_target +'" type="number" class="form-control penyelesaian_nilai_target" placeholder="Target">';
                         row+= '<span id="penyelesaian-evaluasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Satuan" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_evaluasi_pagu" name="penyelesaian_evaluasi_pagu" type="number" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_evaluasi_pagu +'">';
                         row+= '<span id="penyelesaian-evaluasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';
               $('#ShowEdit').html(row);

                

               rows+= '<div class="col-sm-3">';
                   rows+= '<div  id="lokasi-alert" class="form-group">';
                         rows+= '<label>Lokasi :</label>';
                         rows+= '<input disabled id="lokasi" value="'+data.lokasi+'" name="lokasi" type="text" class="form-control" placeholder="Lokasi">';
                         rows+= '<span id="lokasi-messages"></span>';
                    rows+= '</div>'; 
               rows+= '</div>';

               rows+= '<div class="col-sm-3">';
                   rows+= '<div id="tgl-tandatangan-alert" class="form-group">';
                         rows+= '<label>Tanggal Ditandatangani :</label>';
                         rows+= '<input disabled id="tgl_tandatangan" value="'+data.tgl_tandatangan+'" name="tgl_tandatangan" type="date" class="form-control" placeholder="Tanggal Ditandatangani">';
                         rows+= '<span id="tgl-tandatangan-messages"></span>';
                    rows+= '</div>'; 
               rows+= '</div>';

               rows+= '<div class="col-sm-3">';
                   rows+= '<div id="nama-pejabat-alert"  class="form-group">';
                         rows+= '<label>Nama Pejabat :</label>';
                         rows+= '<input disabled id="nama_pejabat" value="'+data.nama_pejabat+'" name="nama_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">';
                         rows+= '<span id="nama-pejabat-messages"></span>';
                    rows+= '</div> ';
               rows+= '</div>';

               rows+= '<div class="col-sm-3">';
                   rows+= '<div id="nip-pejabat-alert" class="form-group">';
                         rows+= '<label>NIP Pejabat :</label>';
                         rows+= '<input disabled id="nip_pejabat" value="'+data.nip_pejabat+'"  name="nip_pejabat" type="text" class="form-control" placeholder="NIP Pejabat">';
                          rows+= '<span id="nip-pejabat-messages"></span>';
                    rows+= '</div>'; 
               rows+= '</div>';
             $('#Attr').html(rows);
             getperiode(data.periode_id);

            $(".pengawasan_nilai_target").on("input", function() {
               calculatePengawasanTarget();
            });  

            $(".pengawasan_nilai_pagu").on("input", function() {
               calculatePengawasanPagu();
            });

            $(".bimtek_nilai_target").on("input", function() {
               calculateBimtekTarget();
            });

            $(".bimtek_nilai_pagu").on("input", function() {
               calculateBimtekPagu();
            });

            $(".penyelesaian_nilai_target").on("input", function() {
               calculatePenyelesaianTarget();
            });

            $(".penyelesaian_nilai_pagu").on("input", function() {
               calculatePenyelesaianPagu();
            });
     }

     function calculatePengawasanTarget() {
          var total_pengawasan_target = 0;
          $(".pengawasan_nilai_target").each(function() {
               total_pengawasan_target += parseFloat($(this).val());
          });
          $("#total_pengawasan_target").text(total_pengawasan_target);
     }

     function calculatePengawasanPagu() {
          var total_pengawasan_pagu = 0;
          $(".pengawasan_nilai_pagu").each(function() {
               total_pengawasan_pagu += parseFloat($(this).val());
          });
          var number = total_pengawasan_pagu;
          var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
          $("#total_pengawasan_pagu").text('Rp '+ formattedNumber);
     }

      function calculateBimtekTarget() {
          var total_bimtek_target = 0;
          $(".bimtek_nilai_target").each(function() {
               total_bimtek_target += parseFloat($(this).val());
          });
          $("#total_bimtek_target").text(total_bimtek_target);
     }

      function calculateBimtekPagu() {
          var total_bimtek_pagu = 0;
          $(".bimtek_nilai_pagu").each(function() {
               total_bimtek_pagu += parseFloat($(this).val());
          });
          var number = total_bimtek_pagu;
          var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
          $("#total_bimtek_pagu").text('Rp '+ formattedNumber);
     }

     function calculatePenyelesaianTarget() {
          var total_penyelesaian_target = 0;
          $(".penyelesaian_nilai_target").each(function() {
               total_penyelesaian_target += parseFloat($(this).val());
          });
          $("#total_penyelesaian_target").text(total_penyelesaian_target);
     }

     function calculatePenyelesaianPagu() {
          var total_penyelesaian_pagu = 0;
          $(".penyelesaian_nilai_pagu").each(function() {
               total_penyelesaian_pagu += parseFloat($(this).val());
          });
          var number = total_penyelesaian_pagu;
          var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
          $("#total_penyelesaian_pagu").text('Rp '+ formattedNumber);
     }

     function getperiode(periode){
           
          $.ajax({
               type: 'POST',
               data:{'type':'edit'},
               dataType: 'json',
               url: BASE_URL +'/api/select-periode',
               success: function(data) {
                     // 
                     var select =  $('#periode_id');
                     // Populate options from the received data
                     $.each(data, function(index, option) {
                       select.append($('<option>', {
                         value: option.value,
                         text: option.text
                       }));
                     });

                    // Set a specific option as selected
                      var selectedValue = periode;
                      select.val(selectedValue);
                     // Refresh the SelectPicker
                     select.selectpicker('refresh');
                     periode = data; 
               },
               error: function( error) {}
          });

          $('#periode_id').on('change', function() {
               var index = $(this).val();
               let find = periode.find(o => o.value === index); 
               
               $('#pagu_apbn').html('<b>'+find.pagu_apbn+'</b>');
          });

     }



     
 });
</script>
@stop