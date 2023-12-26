@extends('template/sidakv2/layout.app')
@section('content')

<style>    
     tr.border-bottom td { border-bottom: 3pt solid #f4f4f4; } td { padding: 10px !important; }
     .modal-loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 99999;
    }
    .modal-content2 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 4px;
        text-align: center;
    }
    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }
    #progress-container {
        text-align: center;
    }
    #progress-bar {
        width: 100%;
        background-color: #ccc;
        border-radius: 4px;
    }
    #progress {
        height: 20px;
        background-color: #4caf50;
        border-radius: 4px;
        transition: width 0.3s ease-in-out;
    }
    #progress-label {
        margin-top: 10px;
        font-weight: bold;
    }
</style>

<!-- Modal loading -->
<div id="progressModal" class="modal-loading" style="display: none;">
  <div class="modal-content2">
    <span class="close" id="closeProgressModal">&times;</span>
    <h2>Upload Dokumen</h2>
    <div id="progress-container">
      <div id="progress-bar">
        <div id="progress" style="width: 0%"></div>
      </div>
      <div id="progress-label">0%</div>
    </div>
  </div>
</div>

<div class="content">
     <form id="FormSubmit">
          <div class="row" style="margin-bottom: 20px">
               <div id="header-conclusion"></div>     
          </div>

          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body">
                         <div class="row pd-top-bottom-15">                                
                              <div class="col-lg-12">
                                   <div id="periode-alert" class="form-group">
                                        <label class="col-lg-2 label-header-box form-group margin-none">Periode Perencanaan :</label>
                                        <div class="col-sm-2">
                                             <div id="selectPeriode" class="form-group margin-none"></div>
                                             <span id="periode-id-messages"></span>
                                             <input type="hidden" id="pagu_apbn_inp">
                                             <input type="hidden" id="total_target_bimtek_inp">
                                             <input type="hidden" id="total_rencana_inp">
                                        </div>
                                   </div>
                              </div>
                         </div>                          
                    </div>
               </div>
          </div>

          <div class="box box-solid box-primary" id="div-edit">
               <div class="box-body">
                    <div class="card-body">
                         <div class="row pd-top-bottom-15">                                
                              <div class="col-lg-12">
                                   <div id="periode-alert" class="form-group">
                                        <span id="alasan-unuapprove-view"></span>
                                        <span id="alasan-unuapprove-doc-view"></span>
                                        <span id="alasan-revisi-view"></span>
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
                                        <th><div></div><span class="span-title">No</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Kegiatan/Sub Kegiatan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Target</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Satuan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Pagu APBN (Rp)</span></th>
                                   </tr>
                              </thead>
                              <tbody id="ShowEdit"></tbody>
                         </table>
                    </div>
               </div>
          </div>

          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body">
                         <div id="Attr" class="row pd-top-bottom-15"></div>
                    </div>
               </div>
          </div>  

          <div class="box-footer">
               <div class="btn-group just-center">
                    <button id="update" type="button" class="btn btn-warning col-md-2"><i class="fa fa-send"></i> Update</button>
                    <button id="kirim" type="button" class="btn btn-primary col-md-2"><i class="fa fa-upload"></i> Kirim</button>
               </div>
          </div>
     </form>
</div>

<script type="text/javascript">

     $(document).ready(function() {
          
          var periode =[];
          var pengawasan = 0;
          var total_pengawasan_pagu = 0;
          var bimtek = 0;
          var total_bimtek_pagu = 0;
          var penyelesaian = 0;
          var total_penyelesaian_pagu = 0;     
          
          var temp_total_pengawasan = 0;
          var temp_total_bimtek = 0;
          var temp_total_penyelesaian = 0;
          var temp_total_pagu_inp = 0;

          var url = window.location.href; 
          var segments = url.split('/');        
                    
          getperiode(); 

          $.ajax({
               type: 'GET',
               url: BASE_URL +'/api/perencanaan/edit/' + segments[5],
               success: function(response) {
                    list = response;  
                    $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker" disabled></select>');    
                    getdataid(list);
               },
               error: function( error) { }
          });

          $("#kirim").click( () => {

               var periode_id = $('#periode_id').val();
               var paguApbn = parseFloat($('#pagu_apbn_inp').val());
               var totalBimtek = parseInt($('#total_target_bimtek_inp').val());
               var total_target_bimtek = parseInt($("#bimtek_perizinan_target").val()) + parseInt($("#bimtek_pengawasan_target").val());
               var totalPaguRencana = parseInt($("#pengawas_analisa_pagu").val()) + parseInt($("#pengawas_inspeksi_pagu").val()) + parseInt($("#pengawas_evaluasi_pagu").val()) + parseInt($("#bimtek_perizinan_pagu").val()) + parseInt($("#bimtek_pengawasan_pagu").val()) + parseInt($("#penyelesaian_identifikasi_pagu").val()) + parseInt($("#penyelesaian_realisasi_pagu").val()) + parseInt($("#penyelesaian_evaluasi_pagu").val());

               var form = {
                    "pengawas_analisa_target": $("#pengawas_analisa_target").val(),
                    "pengawas_analisa_pagu": $("#pengawas_analisa_pagu").val(),
                    "pengawas_inspeksi_target": $("#pengawas_inspeksi_target").val(),
                    "pengawas_inspeksi_pagu": $("#pengawas_inspeksi_pagu").val(),
                    "pengawas_evaluasi_target": $("#pengawas_evaluasi_target").val(),
                    "pengawas_evaluasi_pagu": $("#pengawas_evaluasi_pagu").val(),

                    "bimtek_perizinan_target": $("#bimtek_perizinan_target").val(),
                    "bimtek_perizinan_pagu": $("#bimtek_perizinan_pagu").val(),
                    "bimtek_pengawasan_target": $("#bimtek_pengawasan_target").val(),
                    "bimtek_pengawasan_pagu": $("#bimtek_pengawasan_pagu").val(),

                    "penyelesaian_identifikasi_target": $("#penyelesaian_identifikasi_target").val(),
                    "penyelesaian_identifikasi_pagu": $("#penyelesaian_identifikasi_pagu").val(),
                    "penyelesaian_realisasi_target": $("#penyelesaian_realisasi_target").val(),
                    "penyelesaian_realisasi_pagu": $("#penyelesaian_realisasi_pagu").val(),
                    "penyelesaian_evaluasi_target": $("#penyelesaian_evaluasi_target").val(),
                    "penyelesaian_evaluasi_pagu": $("#penyelesaian_evaluasi_pagu").val(),

                    "promosi_pengadaan_target": $("#promosi_pengadaan_target").val(),
                    "promosi_pengadaan_satuan": $("#promosi_pengadaan_satuan").val(),
                    "promosi_pengadaan_pagu": $("#promosi_pengadaan_pagu").val(),

                    "lokasi": $("#lokasi").val(),
                    "tgl_tandatangan": $("#tgl_tandatangan").val(),
                    "nama_pejabat": $("#nama_pejabat").val(),
                    "nip_pejabat": $("#nip_pejabat").val(),
                    "periode_id": periode_id,
                    "type": "kirim",
                    "status": 15,
                    "param": "update"
               };
                    
               if (totalPaguRencana != paguApbn) {
                    Swal.fire({
                         icon: 'info',
                         title: 'Peringatan',
                         text: 'Maaf, Total Perencanaan Tidak Sama Dengan PAGU.',
                         confirmButtonColor: '#000',
                         showConfirmButton: true,
                         confirmButtonText: 'OK',
                    });
               } else {
                    if (totalBimtek != total_target_bimtek) {
                         Swal.fire({
                              icon: 'info',
                              title: 'Peringatan',
                              text: 'Maaf, Total Target Bimtek Belum Sesuai.',
                              confirmButtonColor: '#000',
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                         });
                    } else {

                         SendingData(form);
                    }
               }

          });

          $("#update").click( () => {

               var periode_id = $('#periode_id').val(); 
               var paguApbn = parseFloat($('#pagu_apbn_inp').val());
               var totalBimtek = parseInt($('#total_target_bimtek_inp').val());
               var total_target_bimtek = parseInt($("#bimtek_perizinan_target").val()) + parseInt($("#bimtek_pengawasan_target").val());
               var totalPaguRencana = parseInt($("#pengawas_analisa_pagu").val()) + parseInt($("#pengawas_inspeksi_pagu").val()) + parseInt($("#pengawas_evaluasi_pagu").val()) + parseInt($("#bimtek_perizinan_pagu").val()) + parseInt($("#bimtek_pengawasan_pagu").val()) + parseInt($("#penyelesaian_identifikasi_pagu").val()) + parseInt($("#penyelesaian_realisasi_pagu").val()) + parseInt($("#penyelesaian_evaluasi_pagu").val());

               var form = {
                    "pengawas_analisa_target": $("#pengawas_analisa_target").val(),
                    "pengawas_analisa_pagu": $("#pengawas_analisa_pagu").val(),
                    "pengawas_inspeksi_target": $("#pengawas_inspeksi_target").val(),
                    "pengawas_inspeksi_pagu": $("#pengawas_inspeksi_pagu").val(),
                    "pengawas_evaluasi_target": $("#pengawas_evaluasi_target").val(),
                    "pengawas_evaluasi_pagu": $("#pengawas_evaluasi_pagu").val(),

                    "bimtek_perizinan_target": $("#bimtek_perizinan_target").val(),
                    "bimtek_perizinan_pagu": $("#bimtek_perizinan_pagu").val(),
                    "bimtek_pengawasan_target": $("#bimtek_pengawasan_target").val(),
                    "bimtek_pengawasan_pagu": $("#bimtek_pengawasan_pagu").val(),

                    "penyelesaian_identifikasi_target": $("#penyelesaian_identifikasi_target").val(),
                    "penyelesaian_identifikasi_pagu": $("#penyelesaian_identifikasi_pagu").val(),
                    "penyelesaian_realisasi_target": $("#penyelesaian_realisasi_target").val(),
                    "penyelesaian_realisasi_pagu": $("#penyelesaian_realisasi_pagu").val(),
                    "penyelesaian_evaluasi_target": $("#penyelesaian_evaluasi_target").val(),
                    "penyelesaian_evaluasi_pagu": $("#penyelesaian_evaluasi_pagu").val(),
                    
                    "promosi_pengadaan_target": $("#promosi_pengadaan_target").val(),
                    "promosi_pengadaan_satuan": $("#promosi_pengadaan_satuan").val(),
                    "promosi_pengadaan_pagu": $("#promosi_pengadaan_pagu").val(),

                    "lokasi": $("#lokasi").val(),
                    "tgl_tandatangan": $("#tgl_tandatangan").val(),
                    "nama_pejabat": $("#nama_pejabat").val(),
                    "nip_pejabat": $("#nip_pejabat").val(),
                    "periode_id": periode_id,
                    "type": "draft",
                    "status": 13,
                    "param": "update"
               };                    

               if (totalPaguRencana != paguApbn) {
                    Swal.fire({
                         icon: 'info',
                         title: 'Peringatan',
                         text: 'Maaf, Total Perencanaan Tidak Sama Dengan PAGU.',
                         confirmButtonColor: '#000',
                         showConfirmButton: true,
                         confirmButtonText: 'OK',
                    });
               } else {
                    
                    if (totalBimtek != total_target_bimtek) {
                         Swal.fire({
                              icon: 'info',
                              title: 'Peringatan',
                              text: 'Maaf, Total Target Bimtek Belum Sesuai.',
                              confirmButtonColor: '#000',
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                         });
                    } else {

                         SendingData(form);
                    }
               }

          });
     
          function getdataid(data)
          {               
               total_pengawasan_pagu = data.total_pagu_pengawasan;
               total_bimtek_pagu = data.total_pagu_bimtek;
               total_penyelesaian_pagu = data.total_pagu_penyelesaian;

               pengawasan = data.target_pengawasan;
               bimtek = data.target_bimtek;
               penyelesaian = data.target_penyelesaian;     

               var header_row = '';
               var row = '';
               var rows = '';
               var unapprove = '';
               var revisi = '';

               var data_label = [
                    { label: 'Pagu APBN', id: 'pagu_apbn' },
                    { label: 'Total Perencanaan', id: 'total_rencana' },
                    { label: 'Status', id: 'status-view' }
               ];

               if (data.pagu_promosi_cek > 0) {
                    if(data.periode_id > 2023) {
                         data_label.splice(1, 0, { label: 'Pagu Peta Potensi', id: 'pagu_promosi_header' });
                    } else {
                         data_label.splice(1, 0, { label: 'Pagu Promosi', id: 'pagu_promosi_header' });
                    }
               }

               $.each(data_label, function (index, item) {
                    header_row += '<div class="col-lg-' + (data.pagu_promosi_cek > 0 ? '3' : '4') + ' col-md-6 col-sm-12">';
                    header_row += '<div class="box-body btn-primary border-radius-13">';
                    header_row += '<div class="card-body table-responsive p-0">';
                    header_row += '<div class="media">';
                    header_row += '<div class="media-body text-left">';
                    header_row += '<span>' + item.label + '</span>';
                    header_row += '<h3 class="card-text" id="' + item.id + '"></h3>';
                    header_row += '</div>';
                    header_row += '</div>';
                    header_row += '</div>';
                    header_row += '</div>';
                    header_row += '</div>';
               });

               $('#header-conclusion').html(header_row);

               $('#pagu_apbn').html('<b>'+data.pagu_apbn+'</b>');
               $('#pagu_promosi_header').html('<b>'+data.pagu_promosi+'</b>');
               $('#total_rencana').html('<b>'+data.total_rencana+'</b>');
               $('#total_rencana_sec').html('<b>'+data.total_rencana+'</b>');
               $('#pagu_apbn_inp').val(data.pagu_apbn.replace(/[^0-9]/g, ''));
               $('#total_target_bimtek_inp').val(data.target_bimtek);
               $('#status-view').html('<b>'+data.status+'</b>');

               row+= '<tr>';
                    row+= '<td><strong>1</strong></td>';
                    row+= '<td class="text-left"><strong>Pengawasan Penanaman Modal</strong></td>';
                    row+= '<td class="text-center"><strong id="total_pengawasan_target">'+ pengawasan +'</strong></td>';
                    row+= '<td class="text-center"><strong>Kegiatan Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_pengawasan_pagu">'+ data.total_pagu_pengawasan_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="pengawas_analisa_target" name="pengawas_analisa_target" type="number" min="0" class="form-control text-center pengawasan_nilai_target" value="'+ data.pengawas_analisa_target +'" placeholder="Target" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="pengawas-analisa-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="pengawas_analisa_pagu" name="pengawas_analisa_pagu" type="number" min="0" class="form-control rencana_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_analisa_pagu +'" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="pengawas-analisa-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>B. Inspeksi Lapangan</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="pengawas_inspeksi_target" name="pengawas_inspeksi_target" type="number" min="0" class="form-control text-center pengawasan_nilai_target" placeholder="Target" value="'+ data.pengawas_inspeksi_target +'" oninput="this.value = Math.abs(this.value)" disabled>';
                         row+= '<span id="pengawas-inspeksi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="pengawas_inspeksi_pagu" name="pengawas_inspeksi_pagu" type="number" min="0" class="form-control rencana_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_inspeksi_pagu +'" oninput="this.value = Math.abs(this.value)">';                            
                         row+= '<span id="pengawas-inspeksi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>C. Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="pengawas_evaluasi_target" name="pengawas_evaluasi_target" type="number" min="0" class="form-control text-center pengawasan_nilai_target" value="'+ data.pengawas_evaluasi_target +'" placeholder="Target" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="pengawas-evaluasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="pengawas_evaluasi_pagu" name="pengawas_evaluasi_pagu" type="number" min="0" class="form-control rencana_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_evaluasi_pagu +'" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="pengawas-evaluasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td><strong>2</strong></td>';
                    row+= '<td class="text-left"><strong>Bimbingan Teknis Kepada Pelaku Usaha</strong></td>';
                    row+= '<td class="text-center"><strong id="total_bimtek_target">'+ bimtek +'</strong></td>';
                    row+= '<td class="text-center"><strong>Pelaku Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_bimtek_pagu">'+ data.total_pagu_bimtek_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="bimtek_perizinan_target" name="bimtek_perizinan_target" type="number" min="0" class="form-control text-center bimtek_nilai_target" value="'+ data.bimtek_perizinan_target +'" placeholder="Target" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="bimtek-perizinan-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Pelaku Usaha" value="Pelaku Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="bimtek_perizinan_pagu" name="bimtek_perizinan_pagu" type="number" min="0" class="form-control rencana_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_perizinan_pagu +'" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="bimtek-perizinan-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>B. Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="bimtek_pengawasan_target" name="bimtek_pengawasan_target" type="number" min="0" class="form-control text-center bimtek_nilai_target" value="'+ data.bimtek_pengawasan_target +'" placeholder="Target" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="bimtek-pengawasan-target-messages"></span> ';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Pelaku Usaha" value="Pelaku Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="bimtek_pengawasan_pagu" name="bimtek_pengawasan_pagu" type="number" min="0" class="form-control rencana_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_pengawasan_pagu +'" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="bimtek-pengawasan-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td><strong>3</strong></td>';
                    row+= '<td class="text-left"><strong>Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</strong></td>';
                    row+= '<td class="text-center"><strong id="total_penyelesaian_target">'+ penyelesaian +'</strong></td>';
                    row+= '<td class="text-center"><strong>Kegiatan Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_penyelesaian_pagu">'+ data.total_pagu_penyelesaian_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Identifikasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="penyelesaian_identifikasi_target" name="penyelesaian_identifikasi_target" value="'+ data.penyelesaian_identifikasi_target+'" min="0" type="number" class="form-control text-center penyelesaian_nilai_target" placeholder="Target" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="penyelesaian-identifikasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="penyelesaian_identifikasi_pagu" name="penyelesaian_identifikasi_pagu" type="number" min="0" class="form-control rencana_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_identifikasi_pagu +'" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="penyelesaian-identifikasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>B. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="penyelesaian_realisasi_target" name="penyelesaian_realisasi_target" value="'+ data.penyelesaian_realisasi_target +'" type="number" min="0" class="form-control text-center penyelesaian_nilai_target" placeholder="Target" oninput="this.value = Math.abs(this.value)" disabled>';
                         row+= '<span id="penyelesaian-realisasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="penyelesaian_realisasi_pagu" name="penyelesaian_realisasi_pagu" type="number" min="0" class="form-control rencana_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_realisasi_pagu +'" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="penyelesaian-realisasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>C. Evaluasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya Perizinan <br/> Berusaha Para Pelaku Usaha</td>';
                    row+= '<td class="text-center">';
                         row+= '<input id="penyelesaian_evaluasi_target" name="penyelesaian_evaluasi_target" value="'+ data.penyelesaian_evaluasi_target +'" type="number" min="0" class="form-control text-center penyelesaian_nilai_target" placeholder="Target" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="penyelesaian-evaluasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input id="penyelesaian_evaluasi_pagu" name="penyelesaian_evaluasi_pagu" type="number" min="0" class="form-control rencana_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_evaluasi_pagu +'" oninput="this.value = Math.abs(this.value)">';
                         row+= '<span id="penyelesaian-evaluasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               if (data.pagu_promosi_cek > 0) {
                    if (data.periode_id > 2023) {
                         var label_judul = 'Penyusunan Bahan Peta Potensi Penanaman Modal';
                         var label_satuan = 'File PDF';
                         var label_sub = 'A. Penyediaan File sebagai Bahan Peta Potensi Penanaman Modal';
                         var label_total = 'Total Peta Potensi';
                    } else { 
                         var label_judul = 'Penyusunan Bahan Promosi Penanaman Modal';
                         var label_satuan = 'Video';
                         var label_sub = 'A. Penyediaan Video Promosi Digital sebagai Bahan Promosi Penanaman Modal';
                         var label_total = 'Total Promosi';
                    }
                    row+= '<tr>';
                         row+= '<td><strong>4</strong></td>';                         
                         row+= '<td class="text-left"><strong>'+ label_judul + '</strong></td>';
                         row+= '<td class="text-center"><strong>1</strong></td>';
                         row+= '<td class="text-center"><strong>' + label_satuan + '</strong></td>';
                         row+= '<td class="text-right"><strong>' + data.pagu_promosi + '</strong></td>';                         
                    row+= '</tr>';
     
                    row+= '<tr class="border-bottom">';
                         row+= '<td>&nbsp;</td>';
                         row+= '<td>' + label_sub + '</td>';
                         row+= '<td class="text-center">';
                              row+= '<div class="margin-none form-group">';
                                   row+= '<input id="promosi_pengadaan_target" name="promosi_pengadaan_target" type="number" class="form-control text-center" placeholder="Target" value="1">';
                              row+= '</div>';
                         row+= '</td>';
                         row+= '<td>';
                              row+= '<input id="promosi_pengadaan_satuan" name="promosi_pengadaan_satuan" type="text" class="form-control" value="' + label_satuan + '">';
                         row+= '</td>';
                         row+= '<td>';
                              row+= '<div class="margin-none form-group">';
                                   row+= '<input id="promosi_pengadaan_pagu" name="promosi_pengadaan_pagu" type="hidden" value="'+ data.pagu_promosi.replace(/[^0-9]/g, '') +'">';
                                   row+= '<input name="promosi_pengadaan_pagu_convert" type="text" class="form-control text-right" placeholder="Pagu" value="'+ data.pagu_promosi +'" readonly>';
                              row+= '</div>';
                         row+= '</td>';
                    row+= '</tr>';
                    
                    row+= '<tr>';
                         row+= '<td colspan="3">&nbsp;</td>';
                         row+= '<td class="text-right"><strong>' + label_total + ' :</strong></td>';
                         row+= '<td class="text-right"><strong>' + data.pagu_promosi + '</strong></td>';
                    row+= '</tr>';
               } else {
                    row+= '<input id="promosi_pengadaan_target" name="promosi_pengadaan_target" type="hidden" value="0">';
                    row+= '<input id="promosi_pengadaan_satuan" name="promosi_pengadaan_satuan" type="hidden" value="">';
                    row+= '<input id="promosi_pengadaan_pagu" name="promosi_pengadaan_pagu" type="hidden" value="0">';
               }

               row+= '<tr>';
                    row+= '<td colspan="3">&nbsp;</td>';
                    row+= '<td class="text-right"><strong>Total PAGU :</strong></td>';
                    row+= '<td class="text-right"><strong>' + data.pagu_apbn + '</strong></td>';
               row+= '</tr>';
               row+= '<tr>';
                    row+= '<td colspan="3">&nbsp;</td>';
                    row+= '<td class="text-right"><strong>Total Perencanaan :</strong></td>';
                    row+= '<td class="text-right"><strong><span id="total_rencana_sec">' + data.total_rencana + '</span></strong></td>';
               row+= '</tr>';
               
               $('#ShowEdit').html(row);

               rows+= '<div class="col-sm-3">';
                   rows+= '<div  id="lokasi-alert" class="form-group">';
                         rows+= '<label>Lokasi :</label>';
                         rows+= '<input id="lokasi" value="'+data.lokasi+'" name="lokasi" type="text" class="form-control" placeholder="Lokasi">';
                         rows+= '<span id="lokasi-messages"></span>';
                    rows+= '</div>'; 
               rows+= '</div>';

               rows+= '<div class="col-sm-3">';
                   rows+= '<div id="tgl-tandatangan-alert" class="form-group">';
                         rows+= '<label>Tanggal Ditandatangani :</label>';
                         rows+= '<input id="tgl_tandatangan" value="'+data.tgl_tandatangan+'" name="tgl_tandatangan" type="date" class="form-control" placeholder="Tanggal Ditandatangani">';
                         rows+= '<span id="tgl-tandatangan-messages"></span>';
                    rows+= '</div>'; 
               rows+= '</div>';

               rows+= '<div class="col-sm-3">';
                   rows+= '<div id="nama-pejabat-alert" class="form-group">';
                         rows+= '<label>Nama Pejabat :</label>';
                         rows+= '<input id="nama_pejabat" value="'+data.nama_pejabat+'" name="nama_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">';
                         rows+= '<span id="nama-pejabat-messages"></span>';
                    rows+= '</div> ';
               rows+= '</div>';

               rows+= '<div class="col-sm-3">';
                   rows+= '<div id="nip-pejabat-alert" class="form-group">';
                         rows+= '<label>NIP Pejabat :</label>';
                         rows+= '<input id="nip_pejabat" value="'+data.nip_pejabat+'" name="nip_pejabat" type="number" class="form-control" placeholder="NIP Pejabat">';
                          rows+= '<span id="nip-pejabat-messages"></span>';
                    rows+= '</div>'; 
               rows+= '</div>';

               $('#Attr').html(rows);

               if (data.status_code == 13) {
                    $('#div-edit').show();
                    
                    if (data.request_edit == 'reject') {
                         $('#alasan-unuapprove-view').html('<b>Alasan Tidak Disetujui : ' + data.alasan_unapprove + '</b>').addClass('col-lg-12 text-red');
                         $('#alasan-unuapprove-doc-view').removeClass('col-lg-12 text-red');
                         $('#alasan-revisi-view').removeClass('col-lg-12 text-red');
                    } else if (data.request_edit == 'reject_doc') {
                         $('#alasan-unuapprove-doc-view').html('<b>Alasan Tidak Disetujui : ' + data.alasan_unapprove_doc + '</b>').addClass('col-lg-12 text-red');
                         $('#alasan-unuapprove-view').removeClass('col-lg-12 text-red');
                         $('#alasan-revisi-view').removeClass('col-lg-12 text-red');
                    } else if (data.request_edit == 'revisi') {
                         $('#alasan-revisi-view').html('<b>Alasan Revisi : ' + data.alasan_revisi + '</b>').addClass('col-lg-12 text-red');
                         $('#alasan-unuapprove-view').removeClass('col-lg-12 text-red');
                         $('#alasan-unuapprove-doc-view').removeClass('col-lg-12 text-red');
                    } else {
                         $('#div-edit').hide();
                         $('#alasan-unuapprove-view, #alasan-unuapprove-doc-view, #alasan-revisi-view').removeClass('col-lg-12 text-red');
                    }

               } else {
                    $('#div-edit').hide();
                    $('#alasan-unuapprove-view, #alasan-unuapprove-doc-view, #alasan-revisi-view').removeClass('col-lg-12 text-red');
               }

               
               getperiode(data.periode_id);

               $(".rencana_inp").on("input", updateTotalPaguRencana);

               $(".pengawasan_nilai_pagu").on("input", calculatePengawasanPagu);

               $(".bimtek_nilai_target").on("input", calculateBimtekTarget);

               $(".bimtek_nilai_pagu").on("input", calculateBimtekPagu);

               $(".penyelesaian_nilai_pagu").on("input", calculatePenyelesaianPagu);
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

               var periode_id = $('#periode_id').val();

               if(periode_id)
               {    
                    if(total_bimtek_target > bimtek)
                    {
                         Swal.fire({
                              icon: 'info',
                              title: 'Peringatan',
                              text:'Target bimtek melebihi pagu target!! maksimal total target bimtek yg di izinkan : ' + bimtek,
                              confirmButtonColor: '#000',
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                         });  
                    }
               }
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

          function calculatePenyelesaianPagu() {
               var total_penyelesaian_pagu = 0;

               $(".penyelesaian_nilai_pagu").each(function() {
                    total_penyelesaian_pagu += parseFloat($(this).val());
               });

               var number = total_penyelesaian_pagu;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_penyelesaian_pagu").text('Rp '+ formattedNumber);
          }

          function getperiode(periode) {
               
               $.ajax({
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=get&action=perencanaan',
                    type: 'GET',
                    success: function(data) {
                         var select =  $('#periode_id');
                         $.each(data.result, function(index, option) {
                              select.append($('<option>', {
                                   value: option.value,
                                   text: option.text
                              }));
                         });

                         var selectedValue = periode;
                         select.val(selectedValue);
                         select.selectpicker('refresh');

                         periode = data.result; 
                    },

                    error: function( error) {}
               });
          }

          function updateTotalPaguRencana() {
               var total_pagu_inp = 0;
               $(".rencana_inp").each(function() {
                    total_pagu_inp += parseInt($(this).val());
               });

               temp_total_pagu_inp = total_pagu_inp;
               totalRencana();
          }              

          function totalRencana() {
               
               var total_rencana = temp_total_pagu_inp;
               var number = total_rencana;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
               var periode_id = $('#periode_id').val();
               var pagu_apbn = $('#pagu_apbn_inp').val();

               if(periode_id)
               {    
                    if(pagu_apbn < total_rencana) {
                         Swal.fire({
                              icon: 'info',
                              title: 'Peringatan',
                              text:'Total Perencanaan Melebihi PAGU yang Diizinkan : Rp. ' + accounting.formatNumber(pagu_apbn, 0, ".", "."),
                              confirmButtonColor: '#000',
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                         });  
                         
                         $('#total_rencana').removeClass('text-black').addClass('text-red').addClass('blinking-text');
                         $('#total_rencana_sec').removeClass('text-black').addClass('text-red').addClass('blinking-text');

                    } else {

                         $('#total_rencana').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
                         $('#total_rencana_sec').removeClass('text-red').removeClass('blinking-text').addClass('text-black');
                    }
               }
               
               $('#total_rencana').html('<b>Rp. '+formattedNumber+'</b>');
               $('#total_rencana_sec').html('<b>Rp. '+formattedNumber+'</b>');
               $('#total_rencana_inp').val(number);
          }

          updateTotalPaguRencana();

          function SendingData(form) {

               var pesan = (form.type === 'kirim') ? 'Terkirim ke Pusat.' : 'Berhasil Simpan.';

               $('#progressModal').show();

               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/' + segments[5],
                    data:form,
                    cache: false,
                    dataType: "json",
                    xhr: function() {
                         var xhr = new window.XMLHttpRequest();
                         xhr.upload.addEventListener("progress", function(evt) {
                              if (evt.lengthComputable) {
                                   var percentComplete = (evt.loaded / evt.total) * 100;
                                   $('#progress').css('width', percentComplete + '%');
                                   $('#progress-label').text(percentComplete.toFixed(2) + '%');
                              }
                         }, false);
                         return xhr;
                    },
                    success: (respons) =>{
                         $('#progressModal').hide();
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
                         $('#progressModal').hide();
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
                              $('#selectPeriode').addClass('has-error');
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

</script>
@stop