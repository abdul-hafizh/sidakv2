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
                         <div id="periode-id-alert" class="form-group col-sm-2 pull-right"> <br/>
                              <select id="periode_id" name="periode_id" class="form-control"></select>
                              <span id="periode-id-messages"></span>
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
                                        <th><div></div><span class="span-title">No</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Kegiatan/Sub Kegiatan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Target</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Satuan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Pagu APBN (Rp)</span></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td><strong>1</strong></td>
                                        <td class="text-left"><strong>Pengawasan Penanaman Modal</strong></td>
                                        <td class="text-center"><strong>0</strong></td>
                                        <td class="text-center"><strong>Kegiatan Usaha</strong></td>
                                        <td class="text-right"><strong id="total_pengawasan">Rp. 0</strong></td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha</td>
                                        <td>
                                             <input id="pengawas_analisa_target" name="pengawas_analisa_target" type="number" min="0" class="form-control" placeholder="Target">
                                             <span id="pengawas-analisa-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="pengawas_analisa_pagu" name="pengawas_analisa_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_inp text-right" placeholder="Pagu" value="0">
                                             <span id="pengawas-analisa-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>B. Inspeksi Lapangan</td>
                                        <td>
                                             <input id="pengawas_inspeksi_target" name="pengawas_inspeksi_target" type="number" min="0" class="form-control" placeholder="Target">
                                             <span id="pengawas-inspeksi-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="pengawas_inspeksi_pagu" name="pengawas_inspeksi_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_inp text-right" placeholder="Pagu" value="0">                                        
                                             <span id="pengawas-inspeksi-pagu-messages"></span>
                                        </td>
                                   </tr>        
                                   <tr class="border-bottom">
                                        <td>&nbsp;</td>
                                        <td>C. Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha</td>
                                        <td>
                                             <input id="pengawas_evaluasi_target" name="pengawas_evaluasi_target" type="number" min="0" class="form-control" placeholder="Target">
                                             <span id="pengawas-evaluasi-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="pengawas_evaluasi_pagu" name="pengawas_evaluasi_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_inp text-right" placeholder="Pagu" value="0">
                                             <span id="pengawas-evaluasi-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td><strong>2</strong></td>
                                        <td class="text-left"><strong>Bimbingan Teknis Kepada Pelaku Usaha</strong></td>
                                        <td class="text-center"><strong>0</strong></td>
                                        <td class="text-center"><strong>Pelaku Usaha</strong></td>
                                        <td class="text-right"><strong id="total_bimsos">Rp. 0</strong></td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>A. Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko</td>
                                        <td>
                                             <input id="bimtek_perizinan_target" name="bimtek_perizinan_target" type="number" min="0" class="form-control" placeholder="Target">
                                             <span id="bimtek-perizinan-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="bimtek_perizinan_pagu" name="bimtek_perizinan_pagu" type="number" min="0" class="form-control nilai_inp bimsos_nilai_inp text-right" placeholder="Pagu" value="0">
                                             <span id="bimtek-perizinan-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr class="border-bottom">
                                        <td>&nbsp;</td>
                                        <td>B. Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko</td>
                                        <td>
                                             <input id="bimtek_pengawasan_target" name="bimtek_pengawasan_target" type="number" min="0" class="form-control" placeholder="Target">
                                             <span id="bimtek-pengawasan-target-messages"></span> 
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="bimtek_pengawasan_pagu" name="bimtek_pengawasan_pagu" type="number" min="0" class="form-control nilai_inp bimsos_nilai_inp text-right" placeholder="Pagu" value="0">
                                             <span id="bimtek-pengawasan-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td><strong>3</strong></td>
                                        <td class="text-left"><strong>Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</strong></td>
                                        <td class="text-center"><strong>0</strong></td>
                                        <td class="text-center"><strong>Kegiatan Usaha</strong></td>
                                        <td class="text-right"><strong id="total_masalah">Rp. 0</strong></td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>A. Identifikasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya</td>
                                        <td>
                                             <input id="penyelesaian_identifikasi_target" name="penyelesaian_identifikasi_target" type="number" class="form-control" placeholder="Target">
                                             <span id="penyelesaian-identifikasi-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="penyelesaian_identifikasi_pagu" name="penyelesaian_identifikasi_pagu" type="number" class="form-control nilai_inp masalah_nilai_inp text-right" placeholder="Pagu" value="0">
                                             <span id="penyelesaian-identifikasi-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>B. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</td>
                                        <td>
                                             <input id="penyelesaian_realisasi_target" name="penyelesaian_realisasi_target" type="number" class="form-control" placeholder="Target">
                                             <span id="penyelesaian-realisasi-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="penyelesaian_realisasi_pagu" name="penyelesaian_realisasi_pagu" type="number" class="form-control nilai_inp masalah_nilai_inp text-right" placeholder="Pagu" value="0">
                                             <span id="penyelesaian-realisasi-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr class="border-bottom">
                                        <td>&nbsp;</td>
                                        <td>C. Evaluasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya Perizinan <br/> Berusaha Para Pelaku Usaha</td>
                                        <td>
                                             <input id="penyelesaian_evaluasi_target" name="penyelesaian_evaluasi_target" type="number" class="form-control" placeholder="Target">
                                             <span id="penyelesaian-evaluasi-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Satuan" disabled>
                                        </td>
                                        <td>
                                             <input id="penyelesaian_evaluasi_pagu" name="penyelesaian_evaluasi_pagu" type="number" class="form-control nilai_inp masalah_nilai_inp text-right" placeholder="Pagu" value="0">
                                             <span id="penyelesaian-evaluasi-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td colspan="3">&nbsp;</td>
                                        <th>Total Rencana : </th>
                                        <th><input type="text" id="total_apbn" class="form-control text-right" value="Rp. 0" disabled></th>
                                   </tr>
                                   <tr>
                                        <td colspan="3">&nbsp;</td>
                                        <th>Pagu APBN : </th>
                                        <th><input type="text" id="pagu_apbn" class="form-control text-right" disabled></th>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div>
               <div style="margin-top: 1%">
                    <div id="lokasi-alert" class="form-group col-sm-3">
                         <label>Lokasi :</label>
                         <input id="lokasi" name="lokasi" type="text" class="form-control" placeholder="Lokasi">
                         <span id="lokasi-messages"></span>
                    </div>
                    <div id="tgl-tandatangan-alert" class="form-group col-sm-3">
                         <label>Tanggal Ditandatangani :</label>
                         <input id="tgl_tandatangan" name="tgl_tandatangan" type="date" class="form-control" placeholder="Tanggal Ditandatangani">
                         <span id="tgl-tandatangan-messages"></span>
                    </div> 
                    <div id="nama-pejabat-alert" class="form-group col-sm-3">
                         <label>Nama Pejabat :</label>
                         <input id="nama_pejabat" name="nama_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">
                         <span id="nama-pejabat-messages"></span>
                    </div> 
                    <div id="nip-pejabat-alert" class="form-group col-sm-3">
                         <label>NIP Pejabat :</label>
                         <input id="nip_pejabat" name="nip_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">
                         <span id="nip-pejabat-messages"></span>
                    </div> 
                    <div class="form-group col-sm-12">
                         <div class="btn-group pull-right">
                              <button id="kirim" type="button" class="btn btn-primary pull-right"><i class="fa fa-cloud-upload"></i> Kirim</button>
                              <button id="simpan" type="button" class="btn btn-warning pull-left"><i class="fa fa-cloud-upload"></i> Simpan</button>
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

          $('#pagu_apbn').val('Rp. '+pagu_apbn+'');

          const user_sidebar  = JSON.parse(localStorage.getItem('user_sidebar'));
          $('#lokasi').val(user_sidebar.daerah_name);

          $(".nilai_inp").on("input", function() {
               calculateTotal();
          });

          $(".pengawasan_nilai_inp").on("input", function() {
               calculatePengawasan();
          });

          $(".bimsos_nilai_inp").on("input", function() {
               calculateBimsos();
          });

          $(".masalah_nilai_inp").on("input", function() {
               calculateMasalah();
          });          

          $.ajax({
               type: 'GET',
               url: BASE_URL +'/api/perencanaan/edit/' + segments[5],
               success: function(response) {
                    list = response;      
                    getdataid(list);              
               },
               error: function( error) { }
          });

          $.ajax({
               type: 'GET',
               url: BASE_URL +'/api/select-periode',
               success: function(response) {
                    periode = response;
                    onOptionSelect(response)
               },
               error: function( error) {}
          });

          $('#periode_id').on('change', function() {
               var index = $(this).val();
               let find = periode.find(o => o.value === index); 
               $('#pagu_apbn').val(find.pagu_apbn);
          });

          function onOptionSelect(data) {
               const content = $('#periode_id');
               content.empty();
               data.forEach(item => {
                    let row = ``;
                    row +=`<option value="">Pilih Tahun</option>`;
                    row +=`<option value="${item.value}">${item.text}</option>`;
                    content.append(row);
               });     
          } 

          $("#kirim").click( () => {

               var data = $("#FormSubmit").serializeArray();

               if (data.length == 20) {

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
                         "periode_id":data[16].value,
                         "nama_pejabat":data[17].value,
                         "nip_pejabat":data[18].value,
                         "tgl_tandatangan":data[19].value,
                         "lokasi":data[20].value,
                         "type":"kirim",
                    };
                    
                    SendingData(form);

               } else alert("Tidak ada tahun yang dipilih.");
               
          });

          $("#simpan").click( () => {

               var data = $("#FormSubmit").serializeArray();       
               
               if (data.length == 20) {

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
                         "periode_id":data[16].value,
                         "nama_pejabat":data[17].value,
                         "nip_pejabat":data[18].value,
                         "tgl_tandatangan":data[19].value,
                         "lokasi":data[20].value,
                         "type":"draft",
                    };

                    SendingData(form);

               } else alert("Tidak ada tahun yang dipilih.");
               
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
     });    

     function calculateTotal() {
          var total = 0;
          
          $(".nilai_inp").each(function() {
               total += parseFloat($(this).val());
          });

          $("#total_apbn").val('Rp. '+total);
     }

     function calculatePengawasan() {
          var total_pengawasan = 0;
          
          $(".pengawasan_nilai_inp").each(function() {
               total_pengawasan += parseFloat($(this).val());
          });

          $("#total_pengawasan").text('Rp. '+total_pengawasan);
     }
     function calculateBimsos() {
          var total_bimsos = 0;
          
          $(".bimsos_nilai_inp").each(function() {
               total_bimsos += parseFloat($(this).val());
          });

          $("#total_bimsos").text('Rp. '+total_bimsos);
     }

     function calculateMasalah() {
          var total_masalah = 0;
          
          $(".masalah_nilai_inp").each(function() {
               total_masalah += parseFloat($(this).val());
          });

          $("#total_masalah").text('Rp. '+total_masalah);
     }

     function getdataid(data)
     {
          $("#pengawas_analisa_target").val(data.pengawas_analisa_target);
          $("#pengawas_analisa_pagu").val(data.pengawas_analisa_pagu);
          $("#pengawas_inspeksi_target").val(data.pengawas_inspeksi_target);
          $("#pengawas_inspeksi_pagu").val(data.pengawas_inspeksi_pagu);
          $("#pengawas_evaluasi_target").val(data.pengawas_evaluasi_target);
          $("#pengawas_evaluasi_pagu").val(data.pengawas_evaluasi_pagu);
          $("#bimtek_perizinan_target").val(data.bimtek_perizinan_target);
          $("#bimtek_perizinan_pagu").val(data.bimtek_perizinan_pagu);
          $("#bimtek_pengawasan_target").val(data.bimtek_pengawasan_target);
          $("#penyelesaian_identifikasi_target").val(data.penyelesaian_identifikasi_target);
          $("#penyelesaian_identifikasi_pagu").val(data.penyelesaian_identifikasi_pagu);
          $("#penyelesaian_realisasi_target").val(data.penyelesaian_realisasi_target);
          $("#penyelesaian_realisasi_pagu").val(data.penyelesaian_realisasi_pagu);
          $("#penyelesaian_evaluasi_target").val(data.penyelesaian_evaluasi_target);
          $("#penyelesaian_evaluasi_pagu").val(data.penyelesaian_evaluasi_pagu);
          $("#nama_pejabat").val(data.nama_pejabat);
          $("#nip_pejabat").val(data.nip_pejabat);
          $("#tgl_tandatangan").val(data.tgl_tandatangan);
          $("#lokasi").val(data.lokasi);
     }

</script>
@stop