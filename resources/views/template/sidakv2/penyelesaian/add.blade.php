<style>
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

  /* Styling untuk progress bar */
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

<div id="modal-add" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judulModalLabel">Tambah Data</h4>
      </div>
      <form id="FormSubmit" enctype="multipart/form-data">
        <div class="modal-body" style="height: 650px; overflow-y: auto;">
          <div class="row" id="alasan-view" style="display: none">
            <div class="form-group has-feedback col-md-12">
              <strong class="text-red" id="alasan-edit-view"></strong>
              <strong class="text-red" id="alasan-revisi-view"></strong>
            </div>
          </div>
          <div class="row">
            <div id="periode_id_mdl-alert" class="form-group has-feedback col-md-12">
              <label>Periode </label>
              <select class="form-control select-periode-mdl" name="periode_id_mdl" id="periode_id_mdl">
              </select>
              <span id="periode_id_mdl-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="sub_menu_slug-alert" class="form-group has-feedback col-md-12">
              <label>Jenis Kegiatan </label>
              <select class="form-control select-jenis" name="sub_menu_slug" id="sub_menu_slug">
                <option value="">Pilih Jenis Kegiatan</option>
                <option value="identifikasi">Identifikasi Penyelesaian</option>
                <option value="penyelesaian">Penyelesaian Masalah</option>
                <option value="evaluasi">Evaluasi Penyelesaian</option>
              </select>
              <span id="sub_menu_slug-messages"></span>
            </div>
          </div>          
          <div class="row">
            <div id="nama_kegiatan-alert" class="form-group has-feedback col-md-12">
              <label>Nama Kegiatan </label>
              <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama kegiatan" value="">
              <span id="nama_kegiatan-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="tgl_kegiatan-alert" class="form-group has-feedback col-md-12">
              <label>Tanggal Kegiatan </label>
              <input type="date" class="form-control" name="tgl_kegiatan" id="tgl_kegiatan" placeholder="Tanggal Kegiatan" value="">
              <span id="tgl_kegiatan-messages"></span>
            </div>
          </div>          
          <div class="row">
            <div id="biaya-alert" class="form-group has-feedback col-md-12">
              <label>Biaya Kegiatan</label> <small class="text-red" id="anggaran"></small>
              <input type="number" class="form-control" name="biaya" id="biaya" placeholder="Biaya Kegiatan" value="">
              <span id="biaya-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="jml_perusahaan-alert" class="form-group has-feedback col-md-12">
              <label>Jumlah Perusahaan </label>
              <input type="number" class="form-control" min="0" max="500" name="jml_perusahaan" id="jml_perusahaan" placeholder="Jumlah Perusahaan " value="">
              <span id="jml_perusahaan-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="lokasi-alert" class="form-group has-feedback col-md-12">
              <label>Lokasi </label>
              <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="">
              <span id="lokasi-messages"></span>
            </div>
          </div>

          <div id="tab_identifikasi">
            <div class="row">
              <div id="lap_profile-alert" class="form-group has-feedback col-md-12">
                  <label>Profile Pelaku Usaha </label>
                  <a href="#" class="text-bold text-profile" id="modal-profile" data-target="Profile" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Profile"></a>
                  <input type="file" class="form-control file-access" name="lap_profile" id="AddFilesProfile" accept=".pdf">
                  <input type="hidden" name="lap_profile_file" id="lap_profile_file" value="">
                  <div id="ShowPdfProfile" style="margin-top:8px"></div>
                  <span id="file-profile-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
              </div>
            </div>
          </div>

          <div id="tab_penyelesaian">
            <div class="row">
              <div id="lap_peserta-alert" class="form-group has-feedback col-md-12">
                <label>Daftar Hadir </label>
                <a href="#" class="text-bold text-peserta" id="modal-peserta" data-target="Peserta" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Peserta"></a>
                <input type="file" class="form-control file-access" name="lap_peserta" id="AddFilesPeserta" accept=".pdf">
                <input type="hidden" name="lap_peserta_file" id="lap_peserta_file" value="">
                <div id="ShowPdfPeserta" style="margin-top:8px"></div>
                <span id="file-peserta-alert-messages"></span>
              </div>
            </div>
            <div class="row">
              <div id="lap_profile2-alert" class="form-group has-feedback col-md-12">
                <label>Profile Pelaku Usaha </label>
                <a href="#" class="text-bold text-profile2" id="modal-profile2" data-target="Profile2" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Profile"></a>
                <input type="file" class="form-control file-access" name="lap_profile2" id="AddFilesProfile2" accept=".pdf">
                <input type="hidden" name="lap_profile2_file" id="lap_profile2_file" value="">
                <div id="ShowPdfProfile2" style="margin-top:8px"></div>
                <span id="file-profile2-alert-messages"></span>                
              </div>
            </div>
            <div class="row">
              <div id="lap_narasumber-alert" class="form-group has-feedback col-md-12">
                <label>Daftar Narasumber </label>
                <a href="#" class="text-bold text-narasumber" id="modal-narasumber" data-target="Narasumber" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Narasumber"></a>
                <input type="file" class="form-control file-access" name="lap_narasumber" id="AddFilesNarasumber" accept=".pdf">
                <input type="hidden" name="lap_narasumber_file" id="lap_narasumber_file" value="">
                <div id="ShowPdfNarasumber" style="margin-top:8px"></div>
                <span id="file-narasumber-alert-messages"></span>                
              </div>
            </div>
            <div class="row">
              <div id="lap_notula2-alert" class="form-group has-feedback col-md-12">
                <label>Notula Kegiatan </label>
                <a href="#" class="text-bold text-notula2" id="modal-notula2" data-target="Notula2" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Notula"></a>
                <input type="file" class="form-control file-access" name="lap_notula2" id="AddFilesNotula2" accept=".pdf">
                <input type="hidden" name="lap_notula2_file" id="lap_notula2_file" value="">
                <div id="ShowPdfNotula2" style="margin-top:8px"></div>
                <span id="file-notula2-alert-messages"></span>                
              </div>
            </div>
            <div class="row">
              <div id="lap_lkpm-alert" class="form-group has-feedback col-md-12">
                <label>Laporan LKPM </label>
                <a href="#" class="text-bold text-lkpm" id="modal-lkpm" data-target="Lkpm" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF LKPM"></a>
                <input type="file" class="form-control file-access" name="lap_lkpm" id="AddFilesLkpm" accept=".pdf">
                <input type="hidden" name="lap_lkpm_file" id="lap_lkpm_file" value="">
                <div id="ShowPdfLkpm" style="margin-top:8px"></div>
                <span id="file-lkpm-alert-messages"></span>                
              </div>
            </div>
            <div class="row">
              <div id="lap_document-alert" class="form-group has-feedback col-md-12">
                <label>Laporan Dokumentasi </label>
                <a href="#" class="text-bold text-doc" id="modal-doc" data-target="Doc" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Dokumen"></a>
                <input type="file" class="form-control file-access" name="lap_document" id="AddFilesDoc" accept=".pdf">
                <input type="hidden" name="lap_document_file" id="lap_document_file" value="">
                <div id="ShowPdfDoc" style="margin-top:8px"></div>
                <span id="file-doc-alert-messages"></span>
                <small class="text-red">*semua file yang diupload harus pdf dan ukuran dibawah 2 MB</small>                
              </div>
            </div>
          </div>

          <div id="tab_evaluasi">
            <div class="row">
              <div id="lap_notula-alert" class="form-group has-feedback col-md-12">
                  <label>Notula Rapat </label>
                  <a href="#" class="text-bold text-notula" id="modal-notula" data-target="Notula" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Notula"></a>
                  <input type="file" class="form-control file-access" name="lap_notula" id="AddFilesNotula" accept=".pdf">
                  <input type="hidden" name="lap_notula_file" id="lap_notula_file" value="">
                  <div id="ShowPdfNotula" style="margin-top:8px"></div>
                  <span id="file-notula-alert-messages"></span>                  
              </div>
            </div>
            <div class="row">
              <div id="lap_evaluasi-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan Hasil Evaluasi </label>
                  <a href="#" class="text-bold text-eval" id="modal-eval" data-target="Evaluasi" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Evaluasi"></a>
                  <input type="file" class="form-control file-access" name="lap_evaluasi" id="AddFilesEvaluasi" accept=".pdf">
                  <input type="hidden" name="lap_evaluasi_file" id="lap_evaluasi_file" value="">
                  <div id="ShowPdfEvaluasi" style="margin-top:8px"></div>
                  <span id="file-evaluasi-alert-messages"></span>
                  <small class="text-red">*semua file yang diupload harus pdf dan ukuran dibawah 2 MB</small>                  
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer modal-add2">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="simpan" type="button" class="btn btn-primary">Simpan</button>
          <button id="kirim" type="button" class="btn btn-warning">Kirim</button>
        </div>

        <div class="modal-footer modal-edit"></div>

      </form>
    </div>
  </div>
</div>

<div id="modal-log" class="modal fade in" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Log Data Perbaikan/Request Edit</h4>
      </div>

      <div class="modal-body" style="height: 500px; overflow-y: auto;">        
        <div class="row">
          <div class="card-body table-responsive">
            <table id="dataLog" class="table table-hover text-nowrap" style="margin: 20px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis</th>
                  <th>Alasan</th>
                  <th>Dibuat Oleh</th>
                  <th>Tanggal Dibuat</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

<div id="modal-req-edit" class="modal fade in" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mengajukan Edit</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Alasan Edit</label>
          <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_edit" name="alasan_edit" placeholder="Alasan Edit"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="modal_edit" class="btn btn-danger">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div id="modal-req-revision" class="modal fade in" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mengajukan Revisi</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Alasan Revisi</label>
          <textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_revisi" name="alasan_revisi" placeholder="Alasan Revisi"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="modal_revisi" class="btn btn-danger">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div id="modalPDF" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="$('#modalPDF').modal('hide');">&times;</button>
        <h5 class="modal-title">File PDF</h5>
      </div>
      <div class="modal-body">
        <iframe id="framePDF" src="" frameborder="0" width="100%" height="500"></iframe>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function() {

    $('#tab_identifikasi').hide();
    $('#tab_penyelesaian').hide();
    $('#tab_evaluasi').hide();
    $('.text-peserta').hide();
    $('.text-profile').hide();
    $('.text-profile2').hide();
    $('.text-notula').hide();
    $('.text-notula2').hide();
    $('.text-narasumber').hide();
    $('.text-lkpm').hide();
    $('.text-doc').hide();
    $('.text-eval').hide();
    
    $('#sub_menu_slug').on('change', function() {
      
      let sub_menu_slug = $('#sub_menu_slug').val();

      getAnggaran($('#periode_id_mdl').val(), sub_menu_slug);

      if (sub_menu_slug == 'identifikasi') {
        $('#tab_identifikasi').show();
        $('#tab_penyelesaian').hide();
        $('#tab_evaluasi').hide();
      } else if (sub_menu_slug == 'penyelesaian') {
        $('#tab_identifikasi').hide();
        $('#tab_penyelesaian').show();
        $('#tab_evaluasi').hide();
      } else if (sub_menu_slug == 'evaluasi') {
        $('#tab_identifikasi').hide();
        $('#tab_penyelesaian').hide();
        $('#tab_evaluasi').show();
      }
    })    

    $('#periode_id_mdl').on('change', function() {

      var val_periode = $('#periode_id_mdl').val();
      getAnggaran(val_periode, $('#sub_menu_slug').val());  
    
      $.ajax({
        url: BASE_URL + '/api/penyelesaian/cekPeriode/' + val_periode,
        method: 'GET',
        success: function(res) {
          if (res.status != 'Y') {
              $('#simpan').hide();
              $('#kirim').hide();
              Swal.fire({
                title: 'Periode Input Data Sudah Habis.',
                text: 'Periksa kembali periode input data.',
                icon: 'error',
                confirmButtonText: 'OK'
              }).then((result) => {});
          } else {
            $('#simpan').show(); 
            $('#kirim').show();             
          }
        },
        error: function() {
          Swal.fire({
            title: 'Data tidak ditemukan.',          
            icon: 'error',
            confirmButtonText: 'OK'
          }).then((result) => {});
        }
      });
    }); 

    function getAnggaran(periode_id, jenis) {
      $.ajax({
        url: BASE_URL + '/api/select-anggaran/' + periode_id,
        method: 'get',
        dataType: 'json',
        success: function(data) {
          if (jenis == 'identifikasi') {
            $('#anggaran').html('Anggaran/Tahun: ' + data.penyelesaian_identifikasi_pagu_convert)
          } else if (jenis == 'penyelesaian') {
            $('#anggaran').html('Anggaran/Tahun: ' + data.penyelesaian_realisasi_pagu_convert)
          } else if (jenis == 'evaluasi') {
            $('#anggaran').html('Anggaran/Tahun: ' + data.penyelesaian_evaluasi_pagu_convert)
          }
        }
      })        
    }

    $('#tambah').on('click', function() {
      $('#judulModalLabel').html('Tambah Data')
      $('.modal-edit').hide();
      $('.modal-add2').show();
      $('#alasan-view').hide();
      $('#approve_edit').hide();
      $('#request_revision').hide();
      $('#request_edit').hide();
      $('#tab_identifikasi').hide();
      $('#tab_penyelesaian').hide();
      $('#tab_evaluasi').hide();
      $('#FormSubmit input').removeAttr('readonly');
      $('#FormSubmit select').removeAttr('disabled');
      $('#anggaran').html("");      

      $('.file-access').show();

      $('.text-peserta').hide();
      $('.text-profile').hide();
      $('.text-profile2').hide();
      $('.text-notula').hide();
      $('.text-notula2').hide();
      $('.text-narasumber').hide();
      $('.text-lkpm').hide();
      $('.text-doc').hide();
      $('.text-eval').hide();
      
      $('#ShowPdfProfile').empty();
      $('#ShowPdfProfile2').empty();
      $('#ShowPdfNotula').empty();
      $('#ShowPdfNotula2').empty();
      $('#ShowPdfNarasumber').empty();
      $('#ShowPdfPeserta').empty();
      $('#ShowPdfLkpm').empty();
      $('#ShowPdfDoc').empty();
      $('#ShowPdfEvaluasi').empty();

      $('#AddFilesProfile').val('');
      $('#AddFilesProfile2').val('');
      $('#AddFilesNotula').val('');
      $('#AddFilesNotula2').val('');
      $('#AddFilesNarasumber').val('');
      $('#AddFilesPeserta').val('');
      $('#AddFilesLkpm').val('');
      $('#AddFilesDoc').val('');
      $('#AddFilesEvaluasi').val('');

      var form = [
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_kegiatan',
        'lokasi',
        'biaya',
        'jml_perusahaan',
        'lap_peserta',
        'lap_profile',
        'lap_profile2',
        'lap_notula',
        'lap_notula2',
        'lap_narasumber',
        'lap_lkpm',
        'lap_document',
        'lap_evaluasi'
      ];
      for (let i = 0; i < form.length; i++) {
        const field = form[i];
        $('#' + field).val('');
        $('#' + field + '-alert').removeClass('has-error');
        $('#' + field + '-messages').removeClass('help-block').html('');
      }
    })

    $('#simpan').on('click', function() {
      var formData = new FormData($('#FormSubmit')[0]);
      var form = [
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_kegiatan',
        'lokasi',
        'biaya',
        'jml_perusahaan',
        'lap_peserta',
        'lap_profile',
        'lap_profile2',
        'lap_notula',
        'lap_notula2',
        'lap_narasumber',
        'lap_lkpm',
        'lap_document',
        'lap_evaluasi'
      ];      
      $('#progressModal').show();
      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/penyelesaian',
        data: formData,
        processData: false,
        contentType: false,
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
        success: (respons) => {
          $('#progressModal').hide();
          if(respons.status) {
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil Disimpan',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              } else {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          } else {
            Swal.fire({
              title: 'Gagal Simpan!',
              text: respons.message,
              icon: 'error',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              } else {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          }
        },
        error: (respons) => {
          $('#progressModal').hide();
          errors = respons.responseJSON;
          for (let i = 0; i < form.length; i++) {
            const field = form[i];
            if (errors.messages[field]) {
              $('#' + field + '-alert').addClass('has-error');
              $('#' + field + '-messages').addClass('help-block').html('<strong>' + errors.messages[field] + '</strong>');
            } else {
              $('#' + field + '-alert').removeClass('has-error');
              $('#' + field + '-messages').removeClass('help-block').html('');
            }
          }
        }
      });
    });

    $('#kirim').on('click', function() {
      var formData = new FormData($('#FormSubmit')[0]);
      var form = [
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_kegiatan',
        'lokasi',
        'biaya',
        'jml_perusahaan',
        'lap_peserta',
        'lap_profile',
        'lap_profile2',
        'lap_notula',
        'lap_notula2',
        'lap_narasumber',
        'lap_lkpm',
        'lap_document',
        'lap_evaluasi'
      ];      

      formData.append("status", 14);
      formData.append("type", "kirim");
      $('#progressModal').show();

      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/penyelesaian',
        data: formData,
        processData: false,
        contentType: false,
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
        success: (respons) => {
          $('#progressModal').hide();
          if(respons.status) {
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil Kirim ke Pusat',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              } else {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          } else {
            Swal.fire({
              title: 'Gagal Kirim ke Pusat!',
              text: respons.message,
              icon: 'error',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              } else {
                $('#modal-add').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          }
        },
        error: (respons) => {
          $('#progressModal').hide();
          errors = respons.responseJSON;
          for (let i = 0; i < form.length; i++) {
            const field = form[i];
            if (errors.messages[field]) {
              $('#' + field + '-alert').addClass('has-error');
              $('#' + field + '-messages').addClass('help-block').html('<strong>' + errors.messages[field] + '</strong>');
            } else {
              $('#' + field + '-alert').removeClass('has-error');
              $('#' + field + '-messages').removeClass('help-block').html('');
            }
          }
          Swal.fire({
            title: 'Periksa kembali data anda.',
            icon: 'error',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then((result) => {});
        }
      });
    });

    $("#datatable").on("click", ".modalUbah", function(e) {
      $('#judulModalLabel').html('Ubah Data');
      $('.modal-add2').hide();
      $('#simpan').hide();

      $('#ShowPdfProfile').empty();
      $('#ShowPdfProfile2').empty();
      $('#ShowPdfNotula').empty();
      $('#ShowPdfNotula2').empty();
      $('#ShowPdfNarasumber').empty();
      $('#ShowPdfPeserta').empty();
      $('#ShowPdfLkpm').empty();
      $('#ShowPdfDoc').empty();
      $('#ShowPdfEvaluasi').empty();

      $('#AddFilesProfile').val('');
      $('#AddFilesProfile2').val('');
      $('#AddFilesNotula').val('');
      $('#AddFilesNotula2').val('');
      $('#AddFilesNarasumber').val('');
      $('#AddFilesPeserta').val('');
      $('#AddFilesLkpm').val('');
      $('#AddFilesDoc').val('');
      $('#AddFilesEvaluasi').val('');

      var form = [
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_kegiatan',
        'lokasi',
        'biaya',
        'jml_perusahaan',
        'lap_peserta',
        'lap_profile',
        'lap_profile2',
        'lap_notula',
        'lap_notula2',
        'lap_narasumber',
        'lap_lkpm',
        'lap_document',
        'lap_evaluasi',
      ];
      for (let i = 0; i < form.length; i++) {
        const field = form[i];
        $('#' + field).val('');
        $('#' + field + '-alert').removeClass('has-error');
        $('#' + field + '-messages').removeClass('help-block').html('');
      }

      const id = e.currentTarget.dataset.param_id;
      $.ajax({
        url: BASE_URL + '/api/penyelesaian/edit/' + id,
        method: 'GET',
        success: function(data) {               
          footer_modal(id);     
          subMenu(data.sub_menu_slug);
          getPeriode(data.periode_id);
          getAnggaran(data.periode_id, data.sub_menu_slug);    
          
          $('.modal-edit').show();          
          
          if (data.lap_peserta) {
            $('#modal-peserta').show();
            $('#lap_peserta_file').val(data.lap_peserta);
            $('#modal-peserta').click(function() {
              tampilkanModal(data.lap_peserta);
            });
          } else {
            $('#modal-peserta').hide();
            $('#lap_peserta_file').val('');
          }

          if (data.lap_profile) {
            $('#modal-profile').show();
            $('#lap_profile_file').val(data.lap_profile);
            $('#modal-profile').click(function() {
              tampilkanModal(data.lap_profile);
            });
          } else {
            $('#modal-profile').hide();
            $('#lap_profile_file').val('');
          }

          if (data.lap_profile2) {
            $('#modal-profile2').show();
            $('#lap_profile2_file').val(data.lap_profile2);
            $('#modal-profile2').click(function() {
              tampilkanModal(data.lap_profile2);
            });
          } else {
            $('#modal-profile2').hide();
            $('#lap_profile2_file').val('');
          }

          if (data.lap_narasumber) {
            $('#modal-narasumber').show();
            $('#lap_narasumber_file').val(data.lap_narasumber);
            $('#modal-narasumber').click(function() {
              tampilkanModal(data.lap_narasumber);
            });
          } else {
            $('#modal-narasumber').hide();
            $('#lap_narasumber_file').val('');
          }

          if (data.lap_notula) {
            $('#modal-notula').show();
            $('#lap_notula_file').val(data.lap_notula);
            $('#modal-notula').click(function() {
              tampilkanModal(data.lap_notula);
            });
          } else {
            $('#modal-notula').hide();
            $('#lap_notula_file').val('');
          }
          
          if (data.lap_notula2) {
            $('#modal-notula2').show();
            $('#lap_notula2_file').val(data.lap_notula2);
            $('#modal-notula2').click(function() {
              tampilkanModal(data.lap_notula2);
            });
          } else {
            $('#modal-notula2').hide();
            $('#lap_notula2_file').val('');
          }

          if (data.lap_lkpm) {
            $('#modal-lkpm').show();
            $('#lap_lkpm_file').val(data.lap_lkpm);
            $('#modal-lkpm').click(function() {
              tampilkanModal(data.lap_lkpm);
            });
          } else {
            $('#modal-lkpm').hide();
            $('#lap_lkpm_file').val('');
          }

          if (data.lap_document) {
            $('#modal-doc').show();
            $('#lap_doc_file').val(data.lap_document);
            $('#modal-doc').click(function() {
              tampilkanModal(data.lap_document);
            });
          } else {
            $('#modal-doc').hide();
            $('#lap_doc_file').val('');
          }

          if (data.lap_evaluasi) {
            $('#modal-eval').show();
            $('#lap_eval_file').val(data.lap_evaluasi);
            $('#modal-eval').click(function() {
              tampilkanModal(data.lap_evaluasi);
            });
          } else {
            $('#modal-eval').hide();
            $('#lap_eval_file').val('');
          }
          
          $('#sub_menu_slug').val(data.sub_menu_slug);
          $('#nama_kegiatan').val(data.nama_kegiatan);
          $('#tgl_kegiatan').val(data.tgl_kegiatan);
          $('#lokasi').val(data.lokasi);
          $('#biaya').val(data.biaya);
          $('#jml_perusahaan').val(data.jml_perusahaan);

          if (data.status_laporan_id == 13 && data.request_edit == 'reject') {
              $('#alasan-view').show();
              $('#alasan-revisi-view').html('Alasan Perbaikan: ' + data.alasan_revisi);
          } else if (data.status_laporan_id == 15 && data.request_edit == 'true') {
              $('#alasan-view').show();
              $('#alasan-edit-view').html('Alasan Edit: ' + data.alasan_edit);
          } else {
              $('#alasan-view').hide();
          }

          if (data.access == 'daerah' || data.access == 'province') {
            $('#approve_edit-' + id).hide();
            $('#request_revision-' + id).hide();
            if (data.status_laporan_id == 13) {
              $('.file-access').show();
              $('#update-' + id).show();
              $('#kirim-' + id).show();
              $('#request_edit-' + id).hide();
              $('#FormSubmit input').removeAttr('readonly');
              $('#FormSubmit select').removeAttr('disabled');
            } else if (data.status_laporan_id == 15) {
              if (data.request_edit == 'false') {
                $('.file-access').show();
                $('#update-' + id).show();
                $('#kirim-' + id).show();
                $('#FormSubmit input').removeAttr('readonly');
                $('#FormSubmit select').removeAttr('disabled');
              } else {
                $('.file-access').hide();
                $('#update-' + id).hide();
                $('#kirim-' + id).hide();
                $('#FormSubmit input').attr('readonly', 'readonly');
                $('#FormSubmit select').attr('disabled', 'true');
              }
              $('#request_edit-' + id).hide();
            } else {
              $('#update-' + id).hide();
              $('#kirim-' + id).hide();
              $('#request_edit-' + id).show();
              $('.file-access').hide();
              $('#FormSubmit input').attr('readonly', 'readonly');
              $('#FormSubmit select').attr('disabled', 'true');
            }
          } else {
            $('.file-access').hide();
            $('#FormSubmit input').attr('readonly', 'readonly');
            $('#FormSubmit select').attr('disabled', 'true');            
            $('#request_edit-' + id).hide();
            if (data.status_laporan_id == 13) {
              $('#update-' + id).hide();
              $('#kirim-' + id).hide();
              $('#request_revision-' + id).hide();

            } else if (data.status_laporan_id == 15) {
              if (data.request_edit == 'false') {
                $('#update-' + id).hide();
                $('#kirim-' + id).hide();
                $('#approve_edit-' + id).hide();
              } else {
                $('#approve_edit-' + id).show();
                $('#update-' + id).hide();
                $('#kirim-' + id).hide();
              }
              $('#request_revision').hide();
            } else {
              $('#update-' + id).hide();
              $('#kirim-' + id).hide();
              $('#request_revision-' + id).show();
            }
          }          
        }
      })

      function subMenu(sub_menu_slug) {
        if (sub_menu_slug == 'identifikasi') {
          $('#tab_identifikasi').show();
          $('#tab_penyelesaian').hide();
          $('#tab_evaluasi').hide();
        } else if (sub_menu_slug == 'penyelesaian') {
          $('#tab_identifikasi').hide();
          $('#tab_penyelesaian').show();
          $('#tab_evaluasi').hide();
        } else if (sub_menu_slug == 'evaluasi') {
          $('#tab_identifikasi').hide();
          $('#tab_penyelesaian').hide();
          $('#tab_evaluasi').show();
        }
      }

      function getPeriode(periode_id) {   
        $.ajax({
          url: BASE_URL + '/api/select-periode-semester',
          method: 'get',
          dataType: 'json',
          success: function(data) {
            periode = '<option value="">Pilih Periode</option>';
            $.each(data.periode, function(key, val) {
              var select = '';
              if (val.value == periode_id)
                select = 'selected';
              periode += '<option value="' + val.value + '" ' + select + '>' + val.text + '</option>';
            });
            $('#periode_id_mdl').html(periode)
          }
        })
        $('.select-periode-mdl').select2();        
      }       

      $("#modal_edit").click(() => {
        Swal.fire({
          title: 'Apakah Anda Yakin Mengubah Data Ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = {
              "alasan": $("#alasan_edit").val(),
              "jenis_kegiatan": "Penyelesaian",
              "type": "request_edit"
            };
            if ($("#alasan_edit").val() != '') {
              req_edit(form);
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

      function req_edit(form) {
        $('#progressModal').show();
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/penyelesaian/request_edit/' + id,
          data: form,
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
          success: (respons) => {
            $('#progressModal').hide();
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil mengajukan edit.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('#modal-req-edit').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              } else {
                $('#modal-add').hide();
                $('#modal-req-edit').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          },
          error: function(error) {
            $('#progressModal').hide();
            console.error('Error process data:', error);
          }
        });
      }

      $("#modal_revisi").click(() => {
        Swal.fire({
          title: 'Apakah Anda Yakin Revisi Data Ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = {
              "alasan": $("#alasan_revisi").val(),
              "jenis_kegiatan": "Penyelesaian",
              "type": "revisi"
            };
            if ($("#alasan_revisi").val() != '') {
              req_revisi(form);
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

      function req_revisi(form) {
        $('#progressModal').show();
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/penyelesaian/request_revisi/' + id,
          data: form,
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
          success: (respons) => {
            $('#progressModal').hide();
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil mengajukan revisi.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('#modal-req-revision').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              } else {
                $('#modal-add').hide();
                $('#modal-req-revision').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          },
          error: function(error) {
            $('#progressModal').hide();
            console.error('Error process data:', error);
          }
        });
      }

      function footer_modal(id_modal) {
        let row = ``;
        row += `<button class="btn btn-default" data-dismiss="modal">Close</button>`;
        row += `<button id="simpan" type="button" class="btn btn-primary" style="display: none;">Simpan</button>`;

        row += `<button id="update-` + id_modal + `" type="button" class="btn btn-info" style="display: none;">Ubah</button>`;
        row += `<button id="kirim-` + id_modal + `" type="button" class="btn btn-warning" style="display: none;">Kirim</button>`;
        row += `<button id="approve_edit-` + id_modal + `" type="button" class="btn btn-warning" style="display: none;">Approve Edit</button>`;
        row += `<button id="request_edit-` + id_modal + `" type="button" class="btn btn-warning" data-toggle="modal" style="display: none;" data-target="#modal-req-edit">Mengajukan Edit</button>`;
        row += `<button id="request_revision-` + id_modal + `" type="button" class="btn btn-warning" data-toggle="modal" style="display: none;" data-target="#modal-req-revision">Mengajukan Revisi</button>`;
        $('.modal-edit').html(row);

        $('#update-' + id_modal).on('click', function() {
          var formData = new FormData($('#FormSubmit')[0]);
          var form = [
            'periode_id_mdl',
            'sub_menu_slug',
            'nama_kegiatan',
            'tgl_kegiatan',
            'lokasi',
            'biaya',
            'jml_perusahaan',
            'lap_peserta',
            'lap_profile',
            'lap_profile2',
            'lap_notula',
            'lap_notula2',
            'lap_narasumber',
            'lap_lkpm',
            'lap_document',
            'lap_evaluasi'
          ];
          formData.append("status", 13);
          $('#progressModal').show();
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/penyelesaian/update/' + id_modal,
            data: formData,
            processData: false,
            contentType: false,    
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
            success: (respons) => {
              $('#progressModal').hide();
              Swal.fire({
                title: 'Sukses!',
                text: 'Berhasil Disimpan',
                icon: 'success',
                confirmButtonText: 'OK'

              }).then((result) => {
                if (result.isConfirmed) {
                  $('#modal-add').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#datatable').DataTable().ajax.reload();
                } else {
                  $('#modal-add').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#datatable').DataTable().ajax.reload();
                }
              });
            },
            error: (respons) => {
              $('#progressModal').hide();
              errors = respons.responseJSON;
              for (let i = 0; i < form.length; i++) {
                const field = form[i];
                if (errors.messages[field]) {
                  $('#' + field + '-alert').addClass('has-error');
                  $('#' + field + '-messages').addClass('help-block').html('<strong>' + errors.messages[field] + '</strong>');
                } else {
                  $('#' + field + '-alert').removeClass('has-error');
                  $('#' + field + '-messages').removeClass('help-block').html('');
                }
              }
            }
          });
        });

        $('#kirim-' + id_modal).on('click', function() {
          var formData = new FormData($('#FormSubmit')[0]);
          var form = [
            'periode_id_mdl',
            'sub_menu_slug',
            'nama_kegiatan',
            'tgl_kegiatan',
            'lokasi',
            'biaya',
            'jml_perusahaan',
            'lap_peserta',
            'lap_profile',
            'lap_profile2',
            'lap_notula',
            'lap_notula2',
            'lap_narasumber',
            'lap_lkpm',
            'lap_document',
            'lap_evaluasi'
          ];
          formData.append("status", 14);
          formData.append("type", "kirim");
          $('#progressModal').show();
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/penyelesaian/kirim/' + id_modal,
            data: formData,
            processData: false,
            contentType: false,
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
            success: (respons) => {
              $('#progressModal').hide();
              if(respons.status) {
                Swal.fire({
                  title: 'Sukses!',
                  text: 'Berhasil Kirim ke Pusat',
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $('#modal-add').hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#datatable').DataTable().ajax.reload();
                  } else {
                    $('#modal-add').hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#datatable').DataTable().ajax.reload();
                  }
                });
              } else {
                Swal.fire({
                  title: 'Gagal Kirim ke Pusat. Periksa Kembali Data Anda.',
                  text: respons.message,
                  icon: 'error',
                  confirmButtonText: 'OK'
                }).then((result) => {});
              }
            },
            error: (respons) => {
              $('#progressModal').hide();
              errors = respons.responseJSON;
              for (let i = 0; i < form.length; i++) {
                const field = form[i];
                if (errors.messages[field]) {
                  $('#' + field + '-alert').addClass('has-error');
                  $('#' + field + '-messages').addClass('help-block').html('<strong>' + errors.messages[field] + '</strong>');
                } else {
                  $('#' + field + '-alert').removeClass('has-error');
                  $('#' + field + '-messages').removeClass('help-block').html('');
                }
              }
              Swal.fire({
                title: 'Periksa kembali data anda.',
                icon: 'error',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false
              }).then((result) => {});
            }
          });
        });

        $("#approve_edit-" + id_modal).click(() => {
          var data = {
            "status": 13,
            "request_edit": "true"
          };
          $('#progressModal').show();
          $.ajax({
            type: "PUT",
            url: BASE_URL + '/api/penyelesaian/approve_edit/' + id_modal,
            data: data,
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
            success: (respons) => {
              $('#progressModal').hide();
              Swal.fire({
                title: 'Sukses!',
                text: 'Berhasil Diapprove.',
                icon: 'success',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  $('#modal-add').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#datatable').DataTable().ajax.reload();
                } else {
                  $('#modal-add').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#datatable').DataTable().ajax.reload();
                }
              });
            },
            error: (respons) => {
              $('#progressModal').hide();
              $('#modal-add').hide();
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
              $('#datatable').DataTable().ajax.reload();
            }
          });
        });
      }
    });

    $("#datatable").on("click", ".modalLog", function() {      
      const id = $(this).data('param_id');
      $.ajax({
        url: BASE_URL + '/api/penyelesaian/log/' + id,
        method: 'GET',
        success: function(data_log) {             
          dataLogRequset(data_log);
        },
        error: function() {
          alert('Gagal mengambil data.');
        }
      })

      function dataLogRequset(data_log) {        
        var tableBody = $('#dataLog tbody');
        tableBody.empty();

        $.each(data_log, function(index, val) {          

          var date = new Date(val.created_at);

          var row = '<tr>' +
            '<td>' + (index + 1) + '</td>' +
            '<td>' + val.type + '</td>' +
            '<td>' + val.alasan_request + '</td>' +
            '<td>' + val.created_by + '</td>' +
            '<td>' + date.toLocaleDateString() + '</td>' +
            '</tr>';

          tableBody.append(row);
        });
      }
    });

    function tampilkanModal(url) {
      $.ajax({
        url: url,
        method: 'GET',
        xhrFields: {
          responseType: 'blob'
        },
        success: function(data) {
          var blobUrl = URL.createObjectURL(data);
          $('#framePDF').attr('src', blobUrl);
          $('#modalPDF').modal('show');
        },
        error: function() {
          alert('Gagal mengambil file PDF.');
        }
      });
    }

    function showSwalMessage(message) {
      Swal.fire({
        icon: 'info',
        title: message,
        confirmButtonColor: '#000',
        confirmButtonText: 'OK'
      });
    }

    function showPdfLinkInDiv(pdfData, targetDivId, modalId) {
      let rosContent = '';
      rosContent += `<a href="#" id="GetModalPdf" data-param_id="${pdfData}" data-toggle="modal" data-target="${modalId}" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF">Lihat File</a>`;
      rosContent += `<div id="${modalId.replace('#', '')}" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">`;
      rosContent += `<div id="${targetDivId}""></div>`;
      rosContent += `</div>`;
      $(targetDivId).html(rosContent);      
    }

    function showPdfInModal(pdfId, modalId) {
      $(pdfId).on("click", "#GetModalPdf", (e) => {
        let file = e.currentTarget.dataset.param_id;
        let modalContent = '';
        
        modalContent += `<div class="modal-dialog">`;
        modalContent += `<div class="modal-content">`;
        modalContent += `<div class="modal-header test">`;
        modalContent += `<button type="button" class="close" id="${modalId.replace('#', '')}">&times;</button>`;
        modalContent += `<h4 class="modal-title">Lihat File</h4>`;
        modalContent += `</div>`;
        modalContent += `<div class="modal-body">`;
        if (file) {
          modalContent += `<embed src="${file}#page=1&zoom=65" width="575" height="500">`;
        }
        modalContent += `</div>`;
        modalContent += `</div>`;
        modalContent += `</div>`;
        
        $(modalId).html(modalContent);

        $(modalId).on('click', function () {
          $(modalId).modal('hide');
        });
      });
    }

    function handleFileChange(inputId, targetDivId, modalId) {
      $(inputId).change((event) => {
        const files = event.target.files;
        const fileReader = new FileReader();

        fileReader.addEventListener('load', () => {
          if (files[0].name.toUpperCase().includes(".PDF")) {
            const fileData = fileReader.result;
            showPdfLinkInDiv(fileData, targetDivId, modalId);
          } else {
            showSwalMessage('Hanya File PDF Yang Diizinkan.');
          }
        });

        fileReader.readAsDataURL(files[0]);
      });
    }    

    handleFileChange("#AddFilesProfile", "#ShowPdfProfile", "#modal-show-profile");
    handleFileChange("#AddFilesProfile2", "#ShowPdfProfile2", "#modal-show-profile2");
    handleFileChange("#AddFilesNotula", "#ShowPdfNotula", "#modal-show-notula");
    handleFileChange("#AddFilesNotula2", "#ShowPdfNotula2", "#modal-show-notula2");
    handleFileChange("#AddFilesNarasumber", "#ShowPdfNarasumber", "#modal-show-narasumber");
    handleFileChange("#AddFilesPeserta", "#ShowPdfPeserta", "#modal-show-peserta");
    handleFileChange("#AddFilesLkpm", "#ShowPdfLkpm", "#modal-show-lkpm");
    handleFileChange("#AddFilesDoc", "#ShowPdfDoc", "#modal-show-doc");
    handleFileChange("#AddFilesEvaluasi", "#ShowPdfEvaluasi", "#modal-show-eval");        

    showPdfInModal("#ShowPdfProfile", "#modal-show-profile");
    showPdfInModal("#ShowPdfProfile2", "#modal-show-profile2");
    showPdfInModal("#ShowPdfNotula", "#modal-show-notula");
    showPdfInModal("#ShowPdfNotula2", "#modal-show-notula2");
    showPdfInModal("#ShowPdfNarasumber", "#modal-show-narasumber");
    showPdfInModal("#ShowPdfPeserta", "#modal-show-peserta");
    showPdfInModal("#ShowPdfLkpm", "#modal-show-lkpm");
    showPdfInModal("#ShowPdfDoc", "#modal-show-doc");
    showPdfInModal("#ShowPdfEvaluasi", "#modal-show-eval");

  });
</script>