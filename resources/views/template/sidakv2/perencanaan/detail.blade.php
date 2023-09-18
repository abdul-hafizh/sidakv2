@extends('template/sidakv2/layout.app')
@section('content')

<style> tr.border-bottom td { border-bottom: 3pt solid #f4f4f4; } td { padding: 10px !important; } </style>

<div class="content">
     <div class="row">
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="box box-solid box-primary ">
				<div class="box-body bg-primary">
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
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="box box-solid box-primary">
				<div class="box-body bg-primary">
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
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="box box-solid box-primary">
				<div class="box-body bg-primary">
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

     <div class="box box-solid box-primary">
          <div class="box-body">
               <div class="card-body">
                    <div class="form-group col-lg-6">
                         <form method="post" action="/api/perencanaan/upload_laporan" enctype="multipart/form-data">                         
                              <div class="form-group">
                                   <label>Upload File : </label>
                                   <input type="file" class="form-control" name="lap_rencana">
                              </div>                         
                              <button type="submit" class="btn btn-primary">Upload</button>                              
                         </form>                              
                         <div class="form-group"> <br/>
                              <a class="btn btn-warning" href="/api/perencanaan/download_file">File Perencanaan PDF</a>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="box-footer">
          <div class="btn-group just-center">
               <button id="downloadPdf" type="button" class="btn btn-success col-md-2">Download</button>
               <button id="approve" type="button" class="btn btn-primary col-md-2">Approve</button>
               <button id="approve_edit" type="button" class="btn btn-primary col-md-2">Approve Request Edit</button>
               <button type="button" class="btn btn-danger col-md-2" data-toggle="modal" data-target="#modal-unapprove">Unapprove</button>
               <button type="button" class="btn btn-warning col-md-2" data-toggle="modal" data-target="#modal-reqedit">Request Edit</button>
          </div> 
     </div> 
</div>

@include('template/sidakv2/perencanaan.print')

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

<script type="text/javascript">
     $(document).ready(function() {          
          var periode =[];
          var pagu_apbn = 0;             
          var url = window.location.href; 
          var segments = url.split('/');  

          $("#downloadPdf").click(function() {       
               // const pdf = new jsPDF();
               // pdf.autoTable({ html: '#dataPrPdf' });
               // pdf.save('dataPrPdf.pdf');

               const doc = new jsPDF();

               doc.text("Hello world!");
               doc.save("SIDAK_Perencanaan_Tahun_2023.pdf");
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
   
          function getdataid(data)
          {
               $('#pagu_apbn').html('<b>'+data.pagu_apbn+'</b>');
               $('#total_rencana').html('<b>'+data.total_rencana+'</b>');
               $('#selectPeriode').html('<b>'+data.periode_id+'<b>');

               const status = data.status;
               const statusMap = {
                    13: { label: 'Draft', color: 'badge-info' },
                    14: { label: 'Terkirim/Waiting Approve', color: 'badge-warning' },
                    15: { label: 'Approved', color: 'badge-success' }
               };
               const statusInfo = statusMap[status];

               if (statusInfo) {
                    const badgeHtml = `<span>Status : ${statusInfo.label}</span>`;
                    $('#status-view').html('<b>'+badgeHtml+'</b>');
               }

               var row = '';
               var rows = '';

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
                    row+= '<td class="text-right">' + data.pagu_apbn + '</td>';
               row+= '</tr>';
               row+= '<tr>';
                    row+= '<td colspan="3">&nbsp;</td>';
                    row+= '<td class="text-right"><strong>Total Perencanaan :</strong></td>';
                    row+= '<td class="text-right">' + data.total_rencana + '</td>';
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
          }

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
                                   window.location.replace('/perencanaan/detail/' + segments[5]);
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
                         approveItem(segments[5]);
                         Swal.fire(
                              'Approved!',
                              'Data berhasil diapprove.',
                              'success'
                         ).then((act) => {
                              if (act.isConfirmed) {
                                   window.location.replace('/perencanaan/detail/' + segments[5]);
                              }
                         });
                    }
               });
          });

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
                                   window.location.replace('/perencanaan/detail/' + segments[5]);
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
                                   window.location.replace('/perencanaan/detail/' + segments[5]);
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
