@extends('template/sidakv2/layout.app')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

<style>    
     tr.border-bottom td { border-bottom: 3pt solid #f4f4f4; } td { padding: 10px !important; }
     ol { padding-inline-start: 20px !important; }
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
     <div class="row" style="margin-bottom: 20px">
          <div id="header-conclusion"></div>     
     </div>

     <div class="box box-solid box-primary" id="div-edit">
          <div class="box-body">
               <div class="card-body">
                    <div class="row pd-top-bottom-15">
                         <div class="col-lg-12">
                              <div id="periode-alert" class="form-group">
                                   <span id="alasan-edit-view"></span>
                              </div>
                         </div>
                    </div>                          
               </div>
          </div>
     </div>
     
     <div class="box box-solid box-primary" id='div-generate'>
          <div class="box-body">
               <div class="card-body">
                    <div class="row pd-top-bottom-15">
                         <div class="col-lg-12">
                              <div id="generate_pdf"></div>
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
                                   <th><span class="span-title">No</span></th>
                                   <th class="padding-none"><div class="split-table"></div></th>
                                   <th><span class="span-title">Kegiatan/Sub Kegiatan</span></th>
                                   <th class="padding-none"><div class="split-table"></div></th>
                                   <th><span class="span-title">Target</span></th>
                                   <th class="padding-none"><div class="split-table"></div></th>
                                   <th><span class="span-title">Satuan</span></th>
                                   <th class="padding-none"><div class="split-table"></div></th>
                                   <th><span class="span-title">Pagu APBN (Rp)</span></th>
                              </tr>
                         </thead>
                         <tbody id="showDetail"></tbody>
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

     <div class="btn-request-doc"></div> 

     <div class="btn-footer"></div> 

</div>

<div id="modal-unapprove" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Unapprove Perencanaan</h4>
               </div>
               <div class="modal-body">
                    <div class="form-group">
                         <label>Alasan Unapprove</label>
                         <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_unapprove_inp" name="alasan_unapprove" placeholder="Alasan Unapprove"></textarea>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" id="unapprove" class="btn btn-danger">Unapprove</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
               </div>
          </div>
     </div>
</div>

<div id="modal-unapprove-doc" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Unapprove Dokumen PDF Perencanaan</h4>
               </div>
               <div class="modal-body">
                    <div class="form-group">
                         <label>Alasan Unapprove Dokumen</label>
                         <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_unapprove_doc_inp" name="alasan_unapprove_doc" placeholder="Alasan Unapprove Dokumen"></textarea>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" id="unapprove_doc" class="btn btn-danger">Unapprove</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
               </div>
          </div>
     </div>
</div>

<div id="modal-reqedit" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Request Edit Perencanaan</h4>
               </div>
               <div class="modal-body">
                    <div class="form-group">
                         <label>Alasan Permintaan Edit Data</label>
                         <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_edit_inp" name="alasan_edit" placeholder="Alasan Edit"></textarea>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" id="reqedit" class="btn btn-warning">Request Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
               </div>
          </div>
     </div>
</div>

<div id="modal-reqrevisi" class="modal fade" role="dialog">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Request Edit Perencanaan</h4>
               </div>
               <div class="modal-body">
                    <div class="form-group">
                         <label>Alasan Permintaan Edit Data</label>
                         <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_revisi_inp" name="alasan_revisi" placeholder="Alasan Edit"></textarea>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" id="reqrevisi" class="btn btn-warning">Request Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
               </div>
          </div>
     </div>
</div>

<script type="text/javascript">
     $(document).ready(function() {          
          var periode =[];
          var pagu_apbn = 0;             
          var file_pdf = '';             
          var url = window.location.href; 
          var currentDomain = window.location.hostname;
          var segments = url.split('/'); 

          $('#div-generate').hide();

          ShowDetailPerencanaan()

          $("#generate-pdf").click(function() {
              exportData(list);
          });

          function exportData(data)
          {
               var row = '';
               row+='<tr style="border-bottom: 1px solid #000;">';
               row+='<td rowspan="4" style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">1.</td>';
               row+='<td colspan="2" style="text-align: left;padding: 5px 5px;border-left: 1px solid #000;">Pengawasan Penanaman Modal</td>';
               row+='<td style="text-align: center;padding: 5px 5px;border-left: 1px solid #000;">'+ data.pengawas_analisa_target +'</td>';
               row+='<td width="110" style="text-align: center;padding: 10px 0px;border-left: 1px solid #000;">';
               row+='<td style="text-align: right;padding: 5px 0px;border-left: 1px solid #000;">Kegiatan Usaha </td>';
               row+='<td style="text-align: right;padding: cpx 0px;border-right: 1px solid #000;">'+ data.pengawas_analisa_pagu +'</td>';
               row+='</tr>';

               $('#exportView').html(row);                
          }

          function ShowDetailPerencanaan()
          {
               $.ajax({
                    type: 'GET',
                    url: BASE_URL +'/api/perencanaan/edit/' + segments[5],
                    success: function(response) {
                         list = response;  
                         getdataid(list);              
                    },
                    error: function( error) { }
               });
          }
   
          function getdataid(data)
          {               
               if(data.status_code == 15 && data.request_edit == 'true' && data.alasan_edit != null) {
                    $('#div-edit').show();     
                    $('#alasan-edit-view').html('<b>Alasan Edit : '+data.alasan_edit+'</b>').addClass('col-lg-12 text-red');
               } else {
                    $('#div-edit').hide();
                    $('#alasan-edit-view').removeClass('col-lg-12 text-red');
               }
               
               var download_link = '<a href="'+BASE_URL+'/laporan/rencana/' + data.lap_rencana + '" class="btn btn-danger col-md-2" target="_blank"><i class="fa fa-download"></i> Download PDF</a>';
               var generate_pdf = '<a href="'+BASE_URL+'/perencanaan/generate_pdf/'+ data.id + '" class="btn btn-success blink-text col-md-2" target="_blank">Download PDF</a>';         

               var header_row = '';
               var row = '';
               var rows = '';
               var rows_btn = '';
               var rows_doc = '';

               var data_label = [
                    { label: 'Pagu APBN', id: 'pagu_apbn' },
                    { label: 'Total Perencanaan', id: 'total_rencana' },
                    { label: 'Status', id: 'status-view' }
               ];

               if (data.total_pagu_peta_potensi > 0) {
                    if(data.periode_id > 2023) {
                         data_label.splice(1, 0, { label: 'Total Peta Potensi', id: 'pagu_promosi_header' });
                    } else {
                         data_label.splice(1, 0, { label: 'Total Promosi', id: 'pagu_promosi_header' });
                    }
               }

               $.each(data_label, function (index, item) {
                    header_row += '<div class="col-lg-' + (data.total_pagu_peta_potensi > 0 ? '3' : '4') + ' col-md-6 col-sm-12">';
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
               $('#pagu_promosi_header').html('<b>'+data.total_pagu_pengawasan_convert+'</b>');
               $('#total_rencana').html('<b>'+data.total_rencana+'</b>');
               $('#selectPeriode').html('<b>'+data.periode_id+'<b>');
               $('#status-view').html('<b>'+data.status+'</b>');

               row+= '<tr>';
                    row+= '<td><strong>1</strong></td>';
                    row+= '<td rowspan="4"></td>';
                    row+= '<td class="text-left"><strong>Pengawasan Penanaman Modal</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center"><strong id="total_pengawasan_target">' + data.target_pengawasan +'</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center"><strong>'+ data.pengawas_analisa_satuan +'</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"><strong id="total_pengawasan_pagu">' + data.total_pagu_pengawasan_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td><ol type="a"><li>Perencanaan Inspeksi Lapangan Tahunan</li></ol></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center">';
                         row+= '<input disabled id="pengawas_analisa_target" name="pengawas_analisa_target" type="number" min="0" class="form-control text-center pengawasan_nilai_target" value="'+ data.pengawas_analisa_target +'" placeholder="Target">';
                         row+= '<span id="pengawas-analisa-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" value="'+ data.pengawas_analisa_satuan +'" disabled>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_analisa_pagu" name="pengawas_analisa_pagu" type="text" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_analisa_pagu_convert +'">';
                         row+= '<span id="pengawas-analisa-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td><ol type="a" start="2"><li>Pelaksanaan Inspeksi Lapangan</li></ol></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center">';
                         row+= '<input disabled id="pengawas_inspeksi_target" name="pengawas_inspeksi_target" type="number" min="0" class="form-control text-center pengawasan_nilai_target" placeholder="Target" value="'+ data.pengawas_inspeksi_target +'">';
                         row+= '<span id="pengawas-inspeksi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" value="'+ data.pengawas_inspeksi_satuan +'" disabled>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_inspeksi_pagu" name="pengawas_inspeksi_pagu" type="text" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_inspeksi_pagu_convert +'">';                       
                         row+= '<span id="pengawas-inspeksi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td><ol type="a" start="3"><li>Penilaian Kepatuhan Pelaksanaan Perizinan Berusaha</li></ol></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center">';
                         row+= '<input disabled id="pengawas_evaluasi_target" name="pengawas_evaluasi_target" type="number" min="0" class="form-control text-center pengawasan_nilai_target" value="'+ data.pengawas_evaluasi_target +'" placeholder="Target">';
                         row+= '<span id="pengawas-evaluasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" value="'+ data.pengawas_evaluasi_satuan +'" disabled>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_evaluasi_pagu" name="pengawas_evaluasi_pagu" type="text" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_evaluasi_pagu_convert +'">';
                         row+= '<span id="pengawas-evaluasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td><strong>2</strong></td>';
                    row+= '<td rowspan="3"></td>';
                    row+= '<td class="text-left"><strong>Bimbingan Teknis Kepada Pelaku Usaha</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center"><strong id="total_bimtek_target">'+data.target_bimtek +'</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center"><strong>'+ data.bimtek_perizinan_satuan +'</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"><strong id="total_bimtek_pagu">'+ data.total_pagu_bimtek_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td><ol type="a"><li>Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko <br/> dan Pengawasan Perizinan Berusaha Berbasis Risiko</li></ol></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center">';
                         row+= '<input disabled id="bimtek_perizinan_target" name="bimtek_perizinan_target" type="number" min="0" class="form-control text-center bimtek_nilai_target" value="'+ data.bimtek_perizinan_target +'" placeholder="Target">';
                         row+= '<span id="bimtek-perizinan-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" value="'+ data.bimtek_perizinan_satuan +'" disabled>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_perizinan_pagu" name="bimtek_perizinan_pagu" type="text" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_perizinan_pagu_convert +'">';
                         row+= '<span id="bimtek-perizinan-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr class="border-bottom">';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td><ol type="a" start="2"><li>Bimbingan Teknis/Sosialisasi Laporan Kegiatan Penanaman Modal</li></ol></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center">';
                         row+= '<input disabled id="bimtek_pengawasan_target" name="bimtek_pengawasan_target" type="number" min="0" class="form-control text-center bimtek_nilai_target" value="'+ data.bimtek_pengawasan_target +'" placeholder="Target">';
                         row+= '<span id="bimtek-pengawasan-target-messages"></span> ';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" value="'+ data.bimtek_pengawasan_satuan +'" disabled>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_pengawasan_pagu" name="bimtek_pengawasan_pagu" type="text" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_pengawasan_pagu_convert +'">';
                         row+= '<span id="bimtek-pengawasan-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td><strong>3</strong></td>';
                    if (data.periode_id > 2023) {
                         row+= '<td rowspan="3"></td>';
                    } else {
                         row+= '<td rowspan="4"></td>';
                    }
                    row+= '<td class="text-left"><strong>Penyelesaian Permasalahan dan Hambatan yang Dihadapi Pelaku Usaha <br/> dalam Merealisasikan Kegiatan Usahanya</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center"><strong id="total_penyelesaian_target">'+ data.target_penyelesaian +'</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center"><strong>'+ data.penyelesaian_identifikasi_satuan +'</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"><strong id="total_penyelesaian_pagu">'+ data.total_pagu_penyelesaian_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td><ol type="a"><li>Identifikasi Permasalahan dan Hambatan yang Dihadapi Pelaku Usaha <br/> dalam Merealisasikan Kegiatan Usahanya</li></ol></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center">';
                         row+= '<input disabled id="penyelesaian_identifikasi_target" name="penyelesaian_identifikasi_target" value="'+ data.penyelesaian_identifikasi_target+'" type="number" class="form-control text-center penyelesaian_nilai_target" placeholder="Target">';
                         row+= '<span id="penyelesaian-identifikasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" value="'+ data.penyelesaian_identifikasi_satuan +'" disabled>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_identifikasi_pagu" name="penyelesaian_identifikasi_pagu" type="text" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_identifikasi_pagu_convert +'">';
                         row+= '<span id="penyelesaian-identifikasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td><ol type="a" start="2"><li>Penyelesaian Permasalahan dan Hambatan yang Dihadapi Pelaku Usaha <br/> dalam Merealisasikan Kegiatan Usahanya</li></ol></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-center">';
                         row+= '<input disabled id="penyelesaian_realisasi_target" name="penyelesaian_realisasi_target" value="'+ data.penyelesaian_realisasi_target +'" type="number" class="form-control text-center penyelesaian_nilai_target" placeholder="Target">';
                         row+= '<span id="penyelesaian-realisasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" value="'+ data.penyelesaian_realisasi_satuan +'" disabled>';
                    row+= '</td>';
                    row+= '<td></td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_realisasi_pagu" name="penyelesaian_realisasi_pagu" type="text" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_realisasi_pagu_convert +'">';
                         row+= '<span id="penyelesaian-realisasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               if (data.periode_id < 2024) {
                    row+= '<tr class="border-bottom">';
                         row+= '<td>&nbsp;</td>';
                         row+= '<td><ol type="a" start="3"><li>Evaluasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya Perizinan <br/> Berusaha Para Pelaku Usaha</li></ol></td>';
                         row+= '<td></td>';
                         row+= '<td class="text-center">';
                              row+= '<input disabled id="penyelesaian_evaluasi_target" name="penyelesaian_evaluasi_target" value="'+ data.penyelesaian_evaluasi_target +'" type="number" class="form-control text-center penyelesaian_nilai_target" placeholder="Target">';
                              row+= '<span id="penyelesaian-evaluasi-target-messages"></span>';
                         row+= '</td>';
                         row+= '<td></td>';
                         row+= '<td>';
                              row+= '<input type="text" class="form-control" value="'+ data.penyelesaian_evaluasi_satuan +'" disabled>';
                         row+= '</td>';
                         row+= '<td></td>';
                         row+= '<td>';
                              row+= '<input disabled id="penyelesaian_evaluasi_pagu" name="penyelesaian_evaluasi_pagu" type="text" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_evaluasi_pagu_convert +'">';
                              row+= '<span id="penyelesaian-evaluasi-pagu-messages"></span>';
                         row+= '</td>';
                    row+= '</tr>';
               }

               if (data.total_pagu_peta_potensi > 0) {
                    if (data.periode_id > 2023) {
                         row+= '<tr>';
                              row+= '<td><strong>4</strong></td>';
                              row+= '<td rowspan="4"></td>';                     
                              row+= '<td class="text-left"><strong>Penyusunan Peta Potensi Investasi Provinsi</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-center"><strong>1</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-center"><strong>Dokumen Peta Potensi <br/> Investasi Provinsi</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"><strong>' + data.total_pagu_peta_potensi_convert + '</strong></td>';                         
                         row+= '</tr>';
          
                         row+= '<tr class="border-bottom">';
                              row+= '<td>&nbsp;</td>';
                              row+= '<td><ol type="a"><li>Identifikasi Pemetaan Potensi Investasi Provinsi</li></ol></td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input type="text" class="form-control text-center" value="-" readonly>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input type="text" class="form-control text-center" value="-" readonly>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input name="identifikasi_peta_potensi" type="text" class="form-control text-right" placeholder="Pagu" value="'+ data.identifikasi_peta_potensi_convert +'" readonly>';								
                              row+= '</td>';
                         row+= '</tr>';

                         row+= '<tr class="border-bottom">';
                              row+= '<td>&nbsp;</td>';
                              row+= '<td><ol type="a" start="2"><li>Perumusan dan Pelaksanaan Pemetaan Potensi Investasi Provinsi</li></ol></td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input type="text" class="form-control text-center" value="-" readonly>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input type="text" class="form-control text-center" value="-" readonly>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<div class="margin-none form-group">';
                                        row+= '<input name="perumusan_peta_potensi" type="text" class="form-control text-right" placeholder="Pagu" value="'+ data.perumusan_peta_potensi_convert +'" readonly>';
                                   row+= '</div>';
                              row+= '</td>';
                         row+= '</tr>';

                         row+= '<tr class="border-bottom">';
                              row+= '<td>&nbsp;</td>';
                              row+= '<td><ol type="a" start="3"><li>Penyusunan Peta Potensi Investasi Provinsi</li></ol></td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input name="promosi_pengadaan_target" type="number" class="form-control text-center" placeholder="Target" value="1" readonly>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input name="promosi_pengadaan_satuan" type="text" class="form-control" value="' + data.promosi_pengadaan_satuan + '" readonly>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<div class="margin-none form-group">';
                                        row+= '<input name="promosi_pengadaan_pagu" type="text" class="form-control text-right" placeholder="Pagu" value="'+ data.pagu_promosi +'" readonly>';
                                   row+= '</div>';
                              row+= '</td>';
                         row+= '</tr>';
                         
                         row+= '<tr>';
                              row+= '<td colspan="3">&nbsp;</td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"><strong>Total Peta Potensi :</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"><strong>' + data.total_pagu_peta_potensi_convert + '</strong></td>';
                         row+= '</tr>';
                    } else { 
                         var label_judul = 'Penyusunan Bahan Promosi Penanaman Modal';
                         var label_sub = 'a. Penyediaan Video Promosi Digital sebagai Bahan Promosi Penanaman Modal';

                         row+= '<tr>';
                              row+= '<td><strong>4</strong></td>';
                              row+= '<td rowspan="2"></td>';                     
                              row+= '<td class="text-left"><strong>'+ label_judul + '</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-center"><strong>1</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-center"><strong>' + data.promosi_pengadaan_satuan + '</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"><strong>' + data.pagu_promosi + '</strong></td>';                         
                         row+= '</tr>';
          
                         row+= '<tr class="border-bottom">';
                              row+= '<td>&nbsp;</td>';
                              row+= '<td>' + label_sub + '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<div class="margin-none form-group">';
                                        row+= '<input name="promosi_pengadaan_target" type="number" class="form-control text-center" placeholder="Target" value="1" readonly>';
                                   row+= '</div>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<input name="promosi_pengadaan_satuan" type="text" class="form-control" value="' + data.promosi_pengadaan_satuan + '" readonly>';
                              row+= '</td>';
                              row+= '<td></td>';
                              row+= '<td>';
                                   row+= '<div class="margin-none form-group">';
                                        row+= '<input name="promosi_pengadaan_pagu" type="text" class="form-control text-right" placeholder="Pagu" value="'+ data.pagu_promosi +'" readonly>';
                                   row+= '</div>';
                              row+= '</td>';
                         row+= '</tr>';
                         
                         row+= '<tr>';
                              row+= '<td colspan="3">&nbsp;</td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"><strong>Total Promosi :</strong></td>';
                              row+= '<td></td>';
                              row+= '<td class="text-right"><strong>' + data.pagu_promosi + '</strong></td>';
                         row+= '</tr>';
                    }					
               }

               row+= '<tr>';
                    row+= '<td colspan="3">&nbsp;</td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"><strong>Total PAGU :</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"><strong>' + data.pagu_apbn + '</strong></td>';
               row+= '</tr>';
               row+= '<tr>';
                    row+= '<td colspan="3">&nbsp;</td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"><strong>Total Perencanaan :</strong></td>';
                    row+= '<td></td>';
                    row+= '<td class="text-right"><strong>' + data.total_rencana + '</strong></td>';
               row+= '</tr>';

               $('#showDetail').html(row);

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

               if(data.access == 'daerah' && data.status_code == 15 && data.request_edit == 'request_doc') {
                    rows_doc+= '<div class="box box-solid box-primary">';
                         rows_doc+= '<div class="box-body">';
                              rows_doc+= '<div class="card-body">';
                                   rows_doc+= '<div class="form-group col-lg-4">';
                                        rows_doc+= '<div id="file-pdf-alert" class="form-group">';
                                             rows_doc+= '<input type="file" id="AddFiles" class="form-control" name="lap_rencana" accept=".pdf">';
                                             rows_doc+= '<span id="file-pdf-alert-messages"></span>';
                                        rows_doc+= '</div>';
                                        rows_doc+= '<div class="btn-group">';
                                             rows_doc+= '<div id="ShowPDF"></div>';
                                             rows_doc+= '<button id="upload_file" class="btn btn-primary" style="margin-top: 10px;">Upload PDF</button>';
                                        rows_doc+= '</div>';
                                        rows_doc+='<button id="load-update" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>';
                                   rows_doc+= '</div>';
                              rows_doc+= '</div>';
                         rows_doc+= '</div>';
                    rows_doc+= '</div>';
               }

               $('.btn-request-doc').html(rows_doc);

               if(data.access == 'pusat') {
                    if(data.status_code != 13) {
                         rows_btn+= '<div class="box-footer">';
                         rows_btn+= '<div class="btn-group just-center">';
                              rows_btn += '<a href="{{ url('/perencanaan') }}" class="btn btn-info col-md-2"><i class="fa fa-arrow-left"></i> Kembali</a>';
                              if(data.lap_rencana != '') {                                   
                                   rows_btn+= download_link;
                              }
                              if(data.status_code == 15 && data.request_edit == 'false') {
                                   rows_btn+= '<button id="req_doc" type="button" class="btn btn-primary col-md-2"><i class="fa fa-check"></i> Approve</button>';
                                   rows_btn+= '<button type="button" class="btn btn-danger col-md-2" data-toggle="modal" data-target="#modal-unapprove"><i class="fa fa-ban"></i> Unapprove</button>';
                              }
                              if(data.status_code == 14 && data.request_edit == 'false') {
                                   rows_btn+= '<button id="approve" type="button" class="btn btn-primary col-md-2"><i class="fa fa-check"></i> Approve</button>';
                                   rows_btn+= '<button type="button" class="btn btn-danger col-md-2" data-toggle="modal" data-target="#modal-unapprove-doc"><i class="fa fa-ban"></i> Unapprove</button>';
                              }
                              if(data.status_code == 15 && data.request_edit == 'true') {
                                   rows_btn+= '<button id="approve_edit" type="button" class="btn btn-primary col-md-2"><i class="fa fa-check"></i> Approve Request Edit</button>';
                              }
                              if(data.status_code == 16 && data.request_edit == 'false') {                                   
                                   rows_btn+= '<button type="button" class="btn btn-warning col-md-2" data-toggle="modal" data-target="#modal-reqrevisi"><i class="fa fa-pencil"></i> Request Edit</button>';
                              }                              
                         rows_btn+= '</div>';
                         rows_btn+= '</div>';
                    } else {
                         rows_btn+= '<div class="box-footer">';
                         rows_btn+= '<div class="btn-group just-center">';
                         rows_btn += '<a href="{{ url('/perencanaan') }}" class="btn btn-info col-md-2"><i class="fa fa-arrow-left"></i> Kembali</a>';                                              
                         rows_btn+= '</div>';
                         rows_btn+= '</div>';
                    }
               }               

               if(data.access == 'daerah') {
                    if(([14, 15, 16].includes(data.status_code) && data.request_edit === 'false') || (data.status_code === 14 && data.request_edit === 'request_doc')) {
                         rows_btn+= '<div class="box-footer">';
                         rows_btn+= '<div class="btn-group just-center">';                              

                              if(data.lap_rencana != '') {
                                   rows_btn+= download_link;
                              }
                              
                              data.options.forEach(function(item, index) 
                              {
                                   if(item.action == 'update')
                                   {
                                        if(item.checked == true) {
                                             rows_btn+= '<button type="button" class="btn btn-warning col-md-2" data-toggle="modal" data-target="#modal-reqedit"><i class="fa fa-pencil"></i> Request Edit</button>';
                                        } else {
                                             rows_btn+= '<button type="button" disabled class="btn btn-warning col-md-2"><i class="fa fa-pencil"></i> Request Edit</button>';
                                        }
                                   }
                                   
                              });

                         rows_btn+= '</div>';
                         rows_btn+= '</div>';

                    } else {
                         if(data.status_code == 15 && data.request_edit == 'request_doc') {
                              $('#div-generate').show();
                              $('#generate_pdf').html(generate_pdf);
                         }
                    }
               }

               $('.btn-footer').html(rows_btn);

               $("#req_doc").click( () => {
                    Swal.fire({
                         title: 'Apakah Anda Yakin Request Dokumen Perencanaan Ini?',			    
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Ya'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              reqdocItem(segments[5]);
                              Swal.fire(
                                   'Approved.',
                                   'Dokumen Approved.',
                                   'success'
                              ).then((act) => {
                                   if (act.isConfirmed) {
                                        window.location.replace('/perencanaan');
                                   } else {
                                        window.location.replace('/perencanaan');
                                   }
                              });
                         }
                    });
               });

               $("#approve").click( () => {
                    Swal.fire({
                         title: 'Apakah Anda Yakin Approve Perencanaan Ini?',			    
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Ya'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              approveItem(segments[5]);
                              Swal.fire(
                                   'Approved!',
                                   'Data berhasil diapprove.',
                                   'success'
                              ).then((act) => {
                                   if (act.isConfirmed) {
                                        window.location.replace('/perencanaan');
                                   } else {
                                        window.location.replace('/perencanaan');
                                   }
                              });
                         }
                    });
               });

               $("#unapprove").click( () => {
                    Swal.fire({
                         title: 'Apakah Anda Yakin Unapprove Perencanaan Ini?',			    
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Ya'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              var form = {
                                   "alasan": $("#alasan_unapprove_inp").val(),
                                   "jenis_kegiatan": "Perencanaan",
                                   "type": "unapprove"
                              };
                              if($("#alasan_unapprove_inp").val() != '') {  
                                   unapproveItem(form);
                              } else {
                                   Swal.fire(
                                        'Gagal.',
                                        'Alasan belum diisi.',
                                        'error'
                                   );
                              }
                         }
                    });
               });

               $("#unapprove_doc").click( () => {
                    Swal.fire({
                         title: 'Apakah Anda Yakin Unapprove Perencanaan Ini?',			    
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Ya'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              var form = {
                                   "alasan": $("#alasan_unapprove_doc_inp").val(),
                                   "jenis_kegiatan": "Perencanaan",
                                   "type": "unapprove_doc"
                              };
                              if($("#alasan_unapprove_doc_inp").val() != '') {  
                                   unapproveDocItem(form);
                              } else {
                                   Swal.fire(
                                        'Gagal.',
                                        'Alasan belum diisi.',
                                        'error'
                                   );
                              }
                         }
                    });
               });

               $("#reqedit").click( () => {
                    Swal.fire({
                         title: 'Apakah Anda Yakin Request Edit Perencanaan Ini?',			    
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Ya'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              var form = {
                                   "alasan": $("#alasan_edit_inp").val(),
                                   "jenis_kegiatan": "Perencanaan",
                                   "type": "request_edit"
                              };
                              if($("#alasan_edit_inp").val() != '') {  
                                   reqeditItem(form);
                              } else {
                                   Swal.fire(
                                        'Gagal.',
                                        'Alasan belum diisi.',
                                        'error'
                                   );
                              }
                         }
                    });
               });
               
               $("#reqrevisi").click( () => {
                    Swal.fire({
                         title: 'Apakah Anda Yakin Request Edit Perencanaan Ini?',			    
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Ya'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              var form = {
                                   "alasan": $("#alasan_revisi_inp").val(),
                                   "jenis_kegiatan": "Perencanaan",
                                   "type": "revisi"
                              };
                              if($("#alasan_revisi_inp").val() != '') {  
                                   reqrevisiItem(form);
                              } else {
                                   Swal.fire(
                                        'Gagal.',
                                        'Alasan belum diisi.',
                                        'error'
                                   );
                              }
                         }
                    });
               });

               $("#approve_edit").click( () => {
                    Swal.fire({
                         title: 'Apakah Anda Yakin Approve Request Edit?',			    
                         icon: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d33',
                         cancelButtonColor: '#3085d6',
                         confirmButtonText: 'Ya'
                    }).then((result) => {
                         if (result.isConfirmed) {
                              approveEditItem(segments[5]);
                              Swal.fire(
                                   'Approved!',
                                   'Data berhasil diapprove.',
                                   'success'
                              ).then((act) => {
                                   if (act.isConfirmed) {
                                        window.location.replace('/perencanaan');
                                   } else {
                                        window.location.replace('/perencanaan');
                                   }
                              });
                         }
                    });
               });

               $("#AddFiles").change((event)=> {     
                    const files = event.target.files
                    let filename = files[0].name
                    const fileReader = new FileReader()
                    fileReader.addEventListener('load', () => {
                         if(files[0].name.toUpperCase().includes(".PDF"))
                         {
                              file_pdf = fileReader.result;
                              
                              var ros = '';
                                   ros +=`<button id="GetModalPdf" data-param_id="`+file_pdf+`" data-toggle="modal" data-target="#modal-show" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF" type="button" class="btn btn-secondary" >Lihat File PDF</button>`;
                                   ros +=`<div id="modal-show" class="modal fade" role="dialog">`;
                                        ros +=`<div id="ViewPerencanaanPDF"></div>`;
                                   ros +=`</div>`;

                              $('#ShowPDF').html(ros);
                         } else {
                              Swal.fire({
                                   icon: 'info',
                                   title: 'Hanya File PDF Yang Diizinkan.',
                                   confirmButtonColor: '#000',
                                   confirmButtonText: 'OK'
                              });  
                         }
                    })

                    fileReader.readAsDataURL(files[0])

               });

               $("#ShowPDF").on("click", "#GetModalPdf", (e) => {
                    let file = e.currentTarget.dataset.param_id;      
                    let row = ``;
                     row +=`<div class="modal-dialog">`;
                          row +=`<div class="modal-content">`;
                              row +=`<div class="modal-header">`;
                                   row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                                   row +=`<h4 class="modal-title">Lihat Dokumen Perencanaan</h4>`;
                              row +=`</div>`;               
                              row +=`<div class="modal-body">`; 
                              if(file)
                              {  
                                   row +=`<embed src="`+file+`#page=1&zoom=65" width="575" height="500">`;
                              }     
                              row +=`</div>`;               
                              row +=`<div class="modal-footer">`;
                                   row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                              row +=`</div>`;                         
                         row +=`</div>`;
                    row +=`</div>`; 

                    $('#ViewPerencanaanPDF').html(row);   

               });

               $("#upload_file").click( () => {
                    let id = data.id;      
                    
                    $("#upload_file").hide();
                    $("#load-update").show();
                    
                    var form = {                         
                         'lap_rencana':file_pdf, 
                         'id_perencanaan':id
                    };

                    $.ajax({
                         type:"PUT",
                         url: BASE_URL+'/api/perencanaan/upload_laporan/'+ id,
                         data:form,
                         cache: false,
                         dataType: "json",
                         success: (respons) =>{
                              Swal.fire({
                                   title: 'Sukses!',
                                   text: 'Berhasil upload data.',
                                   icon: 'success',
                                   confirmButtonText: 'OK'
                                   
                              }).then((result) => {
                                   if (result.isConfirmed) {
                                        window.location.replace('/perencanaan');
                                   } else {
                                        window.location.replace('/perencanaan');
                                   }
                              });
                         },
                         error: (respons)=>{
                              
                              errors = respons.responseJSON;

                              $("#upload_file").show();
                              $("#load-update").hide();

                              if(errors.messages.lap_rencana)
                              {
                                   $('#file-pdf-alert').addClass('has-error');
                                   $('#file-pdf-alert-messages').addClass('help-block').html('<strong>'+ errors.messages.lap_rencana +'</strong>');
                              } else {
                                   $('#file-pdf-alert').removeClass('has-error');
                                   $('#file-pdf-alert-messages').removeClass('help-block').html('');
                              }
                         }
                    });     
               });
          }

          function reqdocItem(id) {
               $('#progressModal').show();
               $.ajax({
                    url:  BASE_URL +`/api/perencanaan/request_doc/`+ id,
                    method: 'PUT',
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
                    success: function(response) {
                         $('#progressModal').hide();
                    },
                    error: function(error) {
                         $('#progressModal').hide();
                         console.error('Error request data:', error);
                    }                
               });
          }

          function approveItem(id) {
               $('#progressModal').show();
               $.ajax({
                    url:  BASE_URL +`/api/perencanaan/approve/`+ id,
                    method: 'PUT',
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
                    success: function(response) {
                         $('#progressModal').hide();
                    },
                    error: function(error) {
                         $('#progressModal').hide();
                         console.error('Error approving data:', error);
                    }                
               });
          }

          function unapproveItem(form) {
               $('#progressModal').show();
               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/unapprove/' + segments[5],
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
                              text: 'Berhasil Unapprove Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              } else {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
                    error: function(error) {
                         $('#progressModal').hide();
                         console.error('Error unapproving data:', error);
                    }
               });
          }

          function unapproveDocItem(form) {
               $('#progressModal').show();
               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/unapprove_doc/' + segments[5],
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
                              text: 'Berhasil Unapprove Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              } else {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
                    error: function(error) {
                         $('#progressModal').hide();
                         console.error('Error unapproving data:', error);
                    }
               });
          }

          function reqeditItem(form) {
               $('#progressModal').show();
               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/reqedit/' + segments[5],
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
                              text: 'Berhasil Request Edit Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              } else {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
                    error: function(error) {
                         $('#progressModal').hide();
                         console.error('Error request data:', error);
                    }
               });
          }

          function reqrevisiItem(form) {
               $('#progressModal').show();
               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/reqrevisi/' + segments[5],
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
                              text: 'Berhasil Request Edit Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              } else {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
                    error: function(error) {
                         $('#progressModal').hide();
                         console.error('Error request data:', error);
                    }
               });
          }
          
          function approveEditItem(id) {
               $('#progressModal').show();
               $.ajax({
                    url:  BASE_URL +`/api/perencanaan/approve_edit/`+ id,
                    method: 'PUT',
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
                    success: function(response) {
                         $('#progressModal').hide();
                    },
                    error: function(error) {
                         $('#progressModal').hide();
                         console.error('Error approving data:', error);
                    }
               });
          }
     });

</script>

@stop
