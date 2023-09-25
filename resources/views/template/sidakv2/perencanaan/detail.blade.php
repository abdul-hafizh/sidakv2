@extends('template/sidakv2/layout.app')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

<style> tr.border-bottom td { border-bottom: 3pt solid #f4f4f4; } td { padding: 10px !important; } </style>

<div class="content">
     <div class="row padding-default" style="margin-bottom: 20px">
		<div class="col-lg-4 col-md-6 col-sm-12">
               <div class="box-body btn-primary border-radius-13">
                    <div class="card-body table-responsive p-0">
                         <div class="media">
                              <div class="media-body text-left">
                                   <span>Pagu APBN</span>
                                   <h3 class="card-text" id="pagu_apbn"></h3>
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
                                   <span>Total Perencanaan</span>
                                   <h3 class="card-text" id="total_rencana"></h3>
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
                                   <span>Periode <span id="selectPeriode" class="pd-top-bottom-5"></span></span>
                                   <h3 class="card-text" id="status-view"></h3>                                   
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

     <div class="btn-requset-doc"></div> 

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
               $('#pagu_apbn').html('<b>'+data.pagu_apbn+'</b>');
               $('#total_rencana').html('<b>'+data.total_rencana+'</b>');
               $('#selectPeriode').html('<b>'+data.periode_id+'<b>');
               $('#status-view').html('<b>'+data.status+'</b>');    

               if(data.status_code == 15 && data.request_edit == 'true' && data.alasan_edit != null) {
                    $('#div-edit').show();     
                    $('#alasan-edit-view').html('<b>Alasan Edit : '+data.alasan_edit+'</b>').addClass('col-lg-12 text-red');
               } else {
                    $('#div-edit').hide();
                    $('#alasan-edit-view').removeClass('col-lg-12 text-red');
               }
               
               var download_link = '<a href="'+BASE_URL+'/file/perencanaan/' + data.lap_rencana + '" class="btn btn-danger col-md-2" target="_blank"><i class="fa fa-download"></i> Download PDF</a>';
               var generate_pdf = '<a href="'+BASE_URL+'/perencanaan/generate_pdf" class="btn btn-success blink-text col-md-2" target="_blank">Generate PDF</a>';         

               var row = '';
               var rows = '';
               var rows_btn = '';
               var rows_doc = '';

               row+= '<tr>';
                    row+= '<td><strong>1</strong></td>';
                    row+= '<td class="text-left"><strong>Pengawasan Penanaman Modal</strong></td>';
                    row+= '<td class="text-center"><strong id="total_pengawasan_target">' + data.target_pengawasan +'</strong></td>';
                    row+= '<td class="text-center"><strong>Kegiatan Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_pengawasan_pagu">' + data.total_pagu_pengawasan_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_analisa_target" name="pengawas_analisa_target" type="number" min="0" class="form-control pengawasan_nilai_target" value="'+ data.pengawas_analisa_target +'" placeholder="Target">';
                         row+= '<span id="pengawas-analisa-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_analisa_pagu" name="pengawas_analisa_pagu" type="text" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_analisa_pagu_convert +'">';
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
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_inspeksi_pagu" name="pengawas_inspeksi_pagu" type="text" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_inspeksi_pagu_convert +'">';                       
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
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="pengawas_evaluasi_pagu" name="pengawas_evaluasi_pagu" type="text" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="'+ data.pengawas_evaluasi_pagu_convert +'">';
                         row+= '<span id="pengawas-evaluasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td><strong>2</strong></td>';
                    row+= '<td class="text-left"><strong>Bimbingan Teknis Kepada Pelaku Usaha</strong></td>';
                    row+= '<td class="text-center"><strong id="total_bimtek_target">'+data.target_bimtek +'</strong></td>';
                    row+= '<td class="text-center"><strong>Pelaku Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_bimtek_pagu">'+ data.total_pagu_bimtek_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko</td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_perizinan_target" name="bimtek_perizinan_target" type="number" min="0" class="form-control bimtek_nilai_target" value="'+ data.bimtek_perizinan_target +'" placeholder="Target">';
                         row+= '<span id="bimtek-perizinan-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Pelaku Usaha" value="Pelaku Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_perizinan_pagu" name="bimtek_perizinan_pagu" type="text" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_perizinan_pagu_convert +'">';
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
                         row+= '<input type="text" class="form-control" placeholder="Pelaku Usaha" value="Pelaku Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="bimtek_pengawasan_pagu" name="bimtek_pengawasan_pagu" type="text" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="'+ data.bimtek_pengawasan_pagu_convert +'">';
                         row+= '<span id="bimtek-pengawasan-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td><strong>3</strong></td>';
                    row+= '<td class="text-left"><strong>Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</strong></td>';
                    row+= '<td class="text-center"><strong id="total_penyelesaian_target">'+ data.target_penyelesaian +'</strong></td>';
                    row+= '<td class="text-center"><strong>Kegiatan Usaha</strong></td>';
                    row+= '<td class="text-right"><strong id="total_penyelesaian_pagu">'+ data.total_pagu_penyelesaian_convert +'</strong></td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td>&nbsp;</td>';
                    row+= '<td>A. Identifikasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_identifikasi_target" name="penyelesaian_identifikasi_target" value="'+ data.penyelesaian_identifikasi_target+'" type="number" class="form-control penyelesaian_nilai_target" placeholder="Target">';
                         row+= '<span id="penyelesaian-identifikasi-target-messages"></span>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_identifikasi_pagu" name="penyelesaian_identifikasi_pagu" type="text" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_identifikasi_pagu_convert +'">';
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
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_realisasi_pagu" name="penyelesaian_realisasi_pagu" type="text" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_realisasi_pagu_convert +'">';
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
                         row+= '<input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>';
                    row+= '</td>';
                    row+= '<td>';
                         row+= '<input disabled id="penyelesaian_evaluasi_pagu" name="penyelesaian_evaluasi_pagu" type="text" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="'+ data.penyelesaian_evaluasi_pagu_convert +'">';
                         row+= '<span id="penyelesaian-evaluasi-pagu-messages"></span>';
                    row+= '</td>';
               row+= '</tr>';

               row+= '<tr>';
                    row+= '<td colspan="3">&nbsp;</td>';
                    row+= '<td class="text-right"><strong>Total PAGU :</strong></td>';
                    row+= '<td class="text-right"><strong>' + data.pagu_apbn + '</strong></td>';
               row+= '</tr>';
               row+= '<tr>';
                    row+= '<td colspan="3">&nbsp;</td>';
                    row+= '<td class="text-right"><strong>Total Perencanaan :</strong></td>';
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

               $('.btn-requset-doc').html(rows_doc);

               if(data.access == 'pusat') {
                    if(data.status_code != 13) {
                         rows_btn+= '<div class="box-footer">';
                         rows_btn+= '<div class="btn-group just-center">';
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
                    }
               }               

               if(data.access == 'daerah') {
                    if(([14, 15, 16].includes(data.status_code) && data.request_edit === 'false') || (data.status_code === 14 && data.request_edit === 'request_doc')) {
                         rows_btn+= '<div class="box-footer">';
                         rows_btn+= '<div class="btn-group just-center">';
                              if(data.lap_rencana != '') {
                                   rows_btn+= download_link;
                              }
                              rows_btn+= '<button type="button" class="btn btn-warning col-md-2" data-toggle="modal" data-target="#modal-reqedit"><i class="fa fa-pencil"></i> Request Edit</button>';
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
                                   "alasan_unapprove": $("#alasan_unapprove_inp").val()
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
                                   "alasan_unapprove_doc": $("#alasan_unapprove_doc_inp").val()
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
                                   "alasan_edit": $("#alasan_edit_inp").val()
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
                                   "alasan_revisi": $("#alasan_revisi_inp").val()
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

               $( "#ShowPDF" ).on( "click", "#GetModalPdf", (e) => {
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
                                   text: 'Berhasil Diupdate',
                                   icon: 'success',
                                   confirmButtonText: 'OK'
                                   
                              }).then((result) => {
                                   if (result.isConfirmed) {
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
               $.ajax({
                    url:  BASE_URL +`/api/perencanaan/request_doc/`+ id,
                    method: 'PUT',
                    success: function(response) {
                         fetchData(page);
                    },
                    error: function(error) {
                         console.error('Error request data:', error);
                    }                
               });
          }

          function approveItem(id) {
               $.ajax({
                    url:  BASE_URL +`/api/perencanaan/approve/`+ id,
                    method: 'PUT',
                    success: function(response) {
                         fetchData(page);
                    },
                    error: function(error) {
                         console.error('Error approving data:', error);
                    }                
               });
          }

          function unapproveItem(form) {

               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/unapprove/' + segments[5],
                    data:form,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                         Swal.fire({
                              title: 'Sukses!',
                              text: 'Berhasil Unapprove Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
               });
          }

          function unapproveDocItem(form) {

               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/unapprove_doc/' + segments[5],
                    data:form,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                         Swal.fire({
                              title: 'Sukses!',
                              text: 'Berhasil Unapprove Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
               });
          }

          function reqeditItem(form) {

               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/reqedit/' + segments[5],
                    data:form,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                         Swal.fire({
                              title: 'Sukses!',
                              text: 'Berhasil Request Edit Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
               });
          }

          function reqrevisiItem(form) {

               $.ajax({
                    type:"PUT",
                    url: BASE_URL+'/api/perencanaan/reqrevisi/' + segments[5],
                    data:form,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                         Swal.fire({
                              title: 'Sukses!',
                              text: 'Berhasil Request Edit Data Perencanaan.',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },
               });
          }
          
          function approveEditItem(id) {
               $.ajax({
                    url:  BASE_URL +`/api/perencanaan/approve_edit/`+ id,
                    method: 'PUT',
                    success: function(response) {
                         fetchData(page);
                    },
                    error: function(error) {
                         console.error('Error approving data:', error);
                    }                
               });
          }
     });

</script>

@stop
