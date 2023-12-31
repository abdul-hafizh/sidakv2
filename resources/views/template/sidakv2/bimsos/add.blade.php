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
    <h2>Progress</h2>
    <div id="progress-container">
      <div id="progress-bar">
        <div id="progress" style="width: 0%"></div>
      </div>
      <div id="progress-label">0%</div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="modal-add" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judulModalLabel">Tambah Data</h4>
      </div>
      <form id="FormSubmit" enctype="multipart/form-data">
        <div class="modal-body" style="height: 550px; overflow-y: auto;">
          <div class="row">
            <div id="alasan_req" class="form-group has-feedback col-md-12" style="display: none">
              <label>Alasan Request <div id="alasan_req-messages"></div></label>
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
              <label>Jenis </label>
              <input type="hidden" class="form-control" name="id_bimsos" id="id_bimsos" value="">
              <select class="form-control select-jenis" name="sub_menu_slug" id="sub_menu_slug">
                <option value="">-Pilih Tipe-</option>
                <option value="is_tenaga_pendamping">Tenaga Pendamping</option>
                <option value="is_bimtek_ipbbr">Bimtek Implementasi Perizinan Berusaha Berbasis Resiko</option>
                <option value="is_bimtek_ippbbr">Bimtek Implementasi Pengawasan Perizinan Berusaha Berbasis Resiko</option>
              </select>
              <span id="sub_menu_slug-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="nama_kegiatan-alert" class="form-group has-feedback col-md-12">
              <label>Nama Kegiatan </label>
              <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="nama kegiatan" value="">
              <span id="nama_kegiatan-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="tgl_bimtek-alert" class="form-group has-feedback col-md-12">
              <label>Tanggal Kegiatan </label>
              <input type="date" class="form-control" name="tgl_bimtek" id="tgl_bimtek" placeholder="Tanggal Kegiatan" value="">
              <span id="tgl_bimtek-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="lokasi_bimtek-alert" class="form-group has-feedback col-md-12">
              <label>Lokasi </label>
              <input type="text" class="form-control" name="lokasi_bimtek" id="lokasi_bimtek" placeholder="Lokasi" value="">
              <span id="lokasi_bimtek-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="biaya_kegiatan-alert" class="form-group has-feedback col-md-12">
              <label>Biaya </label>
              <input type="number" class="form-control" name="biaya_kegiatan" id="biaya_kegiatan" placeholder="Biaya " value="">
              <span id="biaya_kegiatan-messages"></span>
              <small class="text-red">*Biaya yang diinput sudah termasuk seluruh biaya yang digunakan untuk pelaksanaan bimtek</small>
            </div>
          </div>
          <div class="row">
            <div id="jml_peserta-alert" class="form-group has-feedback col-md-12" style="display: none">
              <label>Jumlah Peserta </label>
              <input type="number" class="form-control" name="jml_peserta" id="jml_peserta" placeholder="Jumlah peserta " value="">
              <span id="jml_peserta-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="ringkasan_kegiatan-alert" class="form-group has-feedback col-md-12">
              <label>Ringkasan kegiatan </label>
              <textarea id="ringkasan_kegiatan" name="ringkasan_kegiatan" rows="4" class="form-control"></textarea>
              <span id="ringkasan_kegiatan-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="lap_hadir-alert" class="form-group has-feedback col-md-12">
              <label>Daftar hadir</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_hadir" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Lap Hadir"></a>
              <input type="hidden" class="form-control" name="lap_hadir_file" id="lap_hadir_file" value="">
              <input type="file" class="form-control file-access" name="lap_hadir" id="lap_hadir" accept=".pdf">
              <span id="lap_hadir-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_pendamping-alert" class="form-group has-feedback col-md-12">
              <label>Laporan Tenaga Pendamping</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_pendamping" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Tenaga Pendamping"></a>
              <input type="hidden" class="form-control" name="lap_pendamping_file" id="lap_pendamping_file" value="">
              <input type="file" class="form-control file-access" name="lap_pendamping" id="lap_pendamping" accept=".pdf">
              <span id="lap_pendamping-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_notula-alert" class="form-group has-feedback col-md-12" style="display: none">
              <label>Notula Kegiatan</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_notula" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Notula Kegiatan"></a>
              <input type="hidden" class="form-control" name="lap_notula_file" id="lap_notula_file" value="">
              <input type="file" class="form-control file-access" name="lap_notula" id="lap_notula" accept=".pdf">
              <span id="lap_notula-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_survey-alert" class="form-group has-feedback col-md-12" style="display: none">
              <label>Hasil Survey</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_survey" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Hasil Survey"></a>
              <input type="hidden" class="form-control" name="lap_survey_file" id="lap_survey_file" value="">
              <input type="file" class="form-control file-access" name="lap_survey" id="lap_survey" accept=".pdf">
              <span id="lap_survey-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_narasumber-alert" class="form-group has-feedback col-md-12" style="display: none">
              <label>Daftar Narasumber</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_narasumber" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Daftar Narasumber"></a>
              <input type="hidden" class="form-control" name="lap_narasumber_file" id="lap_narasumber_file" value="">
              <input type="file" class="form-control file-access" name="lap_narasumber" id="lap_narasumber" accept=".pdf">
              <span id="lap_narasumber-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_materi-alert" class="form-group has-feedback col-md-12" style="display: none">
              <label>Materi</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_materi" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Materi"></a>
              <input type="hidden" class="form-control" name="lap_materi_file" id="lap_materi_file" value="">
              <input type="file" class="form-control file-access" name="lap_materi" id="lap_materi" accept=".pdf">
              <span id="lap_materi-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_document-alert" class="form-group has-feedback col-md-12" style="display: none">
              <label>Laporan Dokumentasi</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_document" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Laporan Dokumentasi"></a>
              <input type="hidden" class="form-control" name="lap_document_file" id="lap_document_file" value="">
              <input type="file" class="form-control file-access" name="lap_document" id="lap_document" accept=".pdf">
              <span id="lap_document-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>
        </div>
        <div class="modal-footer modal-add2">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="simpan" type="button" class="btn btn-primary">Simpan</button>
          <button id="kirim" type="button" class="btn btn-warning">Kirim</button>
        </div>
        <div class="modal-footer modal-edit">
        </div>
      </form>
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

<div class="modal fade" id="modalPDF" role="dialog" data-backdrop="static" data-keyboard="false">
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

    $('#sub_menu_slug').on('change', function() {
      let sub_menu_slug = $('#sub_menu_slug').val();
      if (sub_menu_slug == 'is_tenaga_pendamping') {
        $('#jml_peserta-alert').hide();
        $('#lap_notula-alert').hide();
        $('#lap_survei-alert').hide();
        $('#lap_narasumber-alert').hide();
        $('#lap_survey-alert').hide();
        $('#lap_materi-alert').hide();
        $('#lap_document-alert').hide();
        $('#lap_pendamping-alert').show();
      } else if (sub_menu_slug == 'is_bimtek_ipbbr') {
        $('#jml_peserta-alert').show();
        $('#lap_notula-alert').show();
        $('#lap_survei-alert').show();
        $('#lap_narasumber-alert').show();
        $('#lap_survey-alert').show();
        $('#lap_materi-alert').show();
        $('#lap_document-alert').show();
        $('#lap_pendamping-alert').hide();
      } else {
        $('#jml_peserta-alert').show();
        $('#lap_notula-alert').show();
        $('#lap_survei-alert').show();
        $('#lap_narasumber-alert').show();
        $('#lap_survey-alert').show();
        $('#lap_materi-alert').show();
        $('#lap_document-alert').show();
        $('#lap_pendamping-alert').hide();
      }
    })

    $('#tambah').on('click', function() {
      $('#judulModalLabel').html('Tambah Data')
      $('.modal-add2').show();
      $('.modal-edit').hide();
      $('#alasan_req').hide();
      $('.text-profile').hide();
      $('.file-access').show();
      $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
      $('#FormSubmit select').removeAttr('disabled');
      var form = [
        'id_bimsos',
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_bimtek',
        'lokasi_bimtek',
        'biaya_kegiatan',
        'jml_peserta',
        'ringkasan_kegiatan',
        'lap_hadir',
        'lap_pendamping',
        'lap_notula',
        'lap_survey',
        'lap_narasumber',
        'lap_materi',
        'lap_document'
      ];
      for (let i = 0; i < form.length; i++) {
        const field = form[i];
        $('#' + field).val('');
        $('#' + field + '-alert').removeClass('has-error');
        $('#' + field + '-messages').removeClass('help-block').html('');
      }
    })

    $('#periode_id_mdl').on('change', function() {

      var val_periode = $('#periode_id_mdl').val();

      $.ajax({
        url: BASE_URL + '/api/penyelesaian/cekPeriode/' + val_periode,
        method: 'GET',
        success: function(res) {
          if (res.status != 'Y') {
            $('#simpan').hide();
            Swal.fire({
              title: 'Periode Input Data Sudah Habis.',
              text: 'Periksa kembali periode input data.',
              icon: 'error',
              confirmButtonText: 'OK',
              allowOutsideClick: false,
              allowEscapeKey: false
            }).then((result) => {});
          } else {
            $('#simpan').show();
          }
        },
        error: function() {
          Swal.fire({
            title: 'Data tidak ditemukan.',
            icon: 'error',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then((result) => {});
        }
      });
    });

    $('#simpan').on('click', function() {
      var formData = new FormData($('#FormSubmit')[0]);
      console.log(formData);
      var form = [
        'id_bimsos',
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_bimtek',
        'lokasi_bimtek',
        'biaya_kegiatan',
        'jml_peserta',
        'ringkasan_kegiatan'
      ];
      formData.append("status", 13);
      $('#progressModal').show();
      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/bimsos',
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
              // Place upload progress bar visibility code here
            }
          }, false);

          return xhr;
        },
        success: (respons) => {
          $('#progressModal').hide();
          Swal.fire({
            title: 'Sukses!',
            text: respons.message,
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false

          }).then((result) => {
            if (result.isConfirmed) {
              // User clicked "Yes, proceed!" button
              $('#modal-add').hide();
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
              $('#datatable').DataTable().ajax.reload();
            }
          });
          //
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
    $('#kirim').on('click', function() {
      var formData = new FormData($('#FormSubmit')[0]);
      console.log(formData);
      var form = [
        'id_bimsos',
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_bimtek',
        'lokasi_bimtek',
        'biaya_kegiatan',
        'jml_peserta',
        'ringkasan_kegiatan',
        'lap_hadir',
        'lap_pendamping',
        'lap_notula',
        'lap_survey',
        'lap_narasumber',
        'lap_materi',
        'lap_document'
      ];
      formData.append("status", 14);
      $('#progressModal').show();
      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/bimsos',
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
              // Place upload progress bar visibility code here
            }
          }, false);

          return xhr;
        },
        success: (respons) => {
          $('#progressModal').hide();
          Swal.fire({
            title: 'Sukses!',
            text: respons.message,
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false

          }).then((result) => {
            if (result.isConfirmed) {
              // User clicked "Yes, proceed!" button
              $('#modal-add').hide();
              $('body').removeClass('modal-open');
              $('.modal-backdrop').remove();
              $('#datatable').DataTable().ajax.reload();
            }
          });
          //
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
      $('#judulModalLabel').html('Form Ubah');
      //  $('.modal-footer button[type=button]').html('Ubah Data');
      $('.modal-add2').hide();
      var form = [
        'id_bimsos',
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_bimtek',
        'lokasi_bimtek',
        'biaya_kegiatan',
        'jml_peserta',
        'ringkasan_kegiatan',
        'lap_hadir',
        'lap_pendamping',
        'lap_notula',
        'lap_survey',
        'lap_narasumber',
        'lap_materi',
        'lap_document'
      ];
      for (let i = 0; i < form.length; i++) {
        const field = form[i];
        $('#' + field).val('');
        $('#' + field + '-alert').removeClass('has-error');
        $('#' + field + '-messages').removeClass('help-block').html('');
      }

      const id = e.currentTarget.dataset.param_id;
      //document.getElementById('FormSubmit').id = 'FormSubmit' + id;
      $.ajax({
        url: BASE_URL + '/api/bimsos/edit/' + id,
        method: 'GET',
        success: function(data) {
          $('#id_bimsos').val(data.id);
          $('#sub_menu_slug').val(data.sub_menu_slug);
          $('#nama_kegiatan').val(data.nama_kegiatan);
          $('#tgl_bimtek').val(data.tgl_bimtek);
          $('#lokasi_bimtek').val(data.lokasi_bimtek);
          $('#biaya_kegiatan').val(data.biaya_kegiatan);
          $('#jml_peserta').val(data.jml_peserta);
          $('#ringkasan_kegiatan').val(data.ringkasan_kegiatan);
          $('#is_skpd_sesuai').val(data.is_skpd_sesuai);
          $('.modal-edit').show();
          if (data.lap_hadir) {
            $('#modal-lap_hadir').show();
            $('#lap_hadir_file').val(data.lap_hadir);
            $('#modal-lap_hadir').click(function() {
              tampilkanModal(data.lap_hadir);
            });
          } else {
            $('#modal-lap_hadir').hide();
            $('#lap_hadir_file').val('');
          }
          if (data.lap_pendamping) {
            $('#modal-lap_pendamping').show();
            $('#lap_pendamping_file').val(data.lap_pendamping);
            $('#modal-lap_pendamping').click(function() {
              tampilkanModal(data.lap_pendamping);
            });
          } else {
            $('#modal-lap_pendamping').hide();
            $('#lap_pendamping_file').val('');
          }
          if (data.lap_notula) {
            $('#modal-lap_notula').show();
            $('#lap_notula_file').val(data.lap_notula);
            $('#modal-lap_notula').click(function() {
              tampilkanModal(data.lap_notula);
            });
          } else {
            $('#modal-lap_notula').hide();
            $('#lap_notula_file').val('');
          }
          if (data.lap_survey) {
            $('#modal-lap_survey').show();
            $('#lap_survey_file').val(data.lap_survey);
            $('#modal-lap_survey').click(function() {
              tampilkanModal(data.lap_survey);
            });
          } else {
            $('#modal-lap_survey').hide();
            $('#lap_survey_file').val('');
          }
          if (data.lap_narasumber) {
            $('#modal-lap_narasumber').show();
            $('#lap_narasumber_file').val(data.lap_narasumber);
            $('#modal-lap_narasumber').click(function() {
              tampilkanModal(data.lap_narasumber);
            });
          } else {
            $('#modal-lap_narasumber').hide();
            $('#lap_narasumber_file').val('');
          }
          if (data.lap_materi) {
            $('#modal-lap_materi').show();
            $('#lap_materi_file').val(data.lap_materi);
            $('#modal-lap_materi').click(function() {
              tampilkanModal(data.lap_materi);
            });
          } else {
            $('#modal-lap_materi').hide();
            $('#lap_materi_file').val('');
          }
          if (data.lap_document) {
            $('#modal-lap_document').show();
            $('#lap_document_file').val(data.lap_document);
            $('#modal-lap_document').click(function() {
              tampilkanModal(data.lap_document);
            });
          } else {
            $('#modal-lap_document').hide();
            $('#lap_document_file').val('');
          }

          getPeriode(data.periode_id);
          subMenu(data.sub_menu_slug);
          footer_modal(id);
          if (data.access == 'daerah' || data.access == 'province') {
            $('#approve_edit-' + id).hide();
            $('#request_revision-' + id).hide();
            if (data.status_laporan_id == 13) {
              $('.file-access').show();
              $('#update-' + id).show();
              $('#kirim-' + id).show();
              $('#request_edit-' + id).hide();
              $('#alasan_req').hide();
              $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
              $('#FormSubmit select').removeAttr('disabled');
            } else if (data.status_laporan_id == 15) {
              if (data.request_edit == 'false') {
                $('#update-' + id).show();
                $('#kirim-' + id).show();
                $('.file-access').show();
                $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
                $('#FormSubmit select').removeAttr('disabled');
              } else {
                $('#update-' + id).hide();
                $('#kirim-' + id).hide();
                $('.file-access').hide();
                $('#FormSubmit input,#FormSubmit textarea').attr('readonly', 'readonly');
                $('#FormSubmit select').attr('disabled', 'true');
              }
              $('#request_edit-' + id).hide();
              if (data.alasan_edit) {
                $('#alasan_req').show();
                $('#alasan_req-messages').addClass('text-red').html('<strong>' + data.alasan_edit + '</strong>');
              } else {
                $('#alasan_req').hide();
              }
            } else {
              $('#update-' + id).hide();
              $('#kirim-' + id).hide();
              $('#request_edit-' + id).show();
              $('#alasan_req').hide();
              $('.file-access').hide();
              $('#FormSubmit input,#FormSubmit textarea').attr('readonly', 'readonly');
              $('#FormSubmit select').attr('disabled', 'true');
            }
          } else {
            $('#FormSubmit input,#FormSubmit textarea').attr('readonly', 'readonly');
            $('#FormSubmit select').attr('disabled', 'true');
            $('#FormSubmit file').removeAttr("disabled");
            $('#request_edit-' + id).hide();
            $('.file-access').hide();
            if (data.status_laporan_id == 13) {
              $('#update-' + id).hide();
              $('#kirim-' + id).hide();
              $('#request_revision-' + id).hide();
              $('#alasan_req').hide();
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
              $('#request_revision-' + id).hide();
              if (data.alasan_edit) {
                $('#alasan_req').show();
                $('#alasan_req-messages').addClass('text-red').html('<strong>' + data.alasan_edit + '</strong>');
              } else {
                $('#alasan_req').hide();
              }
            } else {
              $('#update-' + id).hide();
              $('#kirim-' + id).hide();
              $('#alasan_req').hide();
              $('#request_revision-' + id).show();
            }
          }
        }

      })

      function tampilkanModal(url) {

        $.ajax({
          url: 'laporan/bimtek/' + url,
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

      function subMenu(sub_menu_slug) {
        if (sub_menu_slug == 'is_tenaga_pendamping') {
          $('#jml_peserta-alert').hide();
          $('#lap_notula-alert').hide();
          $('#lap_survei-alert').hide();
          $('#lap_narasumber-alert').hide();
          $('#lap_survey-alert').hide();
          $('#lap_materi-alert').hide();
          $('#lap_document-alert').hide();
          $('#lap_pendamping-alert').show();
        } else if (sub_menu_slug == 'is_bimtek_ipbbr') {
          $('#jml_peserta-alert').show();
          $('#lap_notula-alert').show();
          $('#lap_survei-alert').show();
          $('#lap_narasumber-alert').show();
          $('#lap_survey-alert').show();
          $('#lap_materi-alert').show();
          $('#lap_document-alert').show();
          $('#lap_pendamping-alert').hide();
        } else {
          $('#jml_peserta-alert').show();
          $('#lap_notula-alert').show();
          $('#lap_survei-alert').show();
          $('#lap_narasumber-alert').show();
          $('#lap_survey-alert').show();
          $('#lap_materi-alert').show();
          $('#lap_document-alert').show();
          $('#lap_pendamping-alert').hide();
        }
      }

      function getPeriode(periode_id) {
        $.ajax({
          url: BASE_URL + '/api/select-periode-semester',
          method: 'get',
          dataType: 'json',
          success: function(data) {
            periode = '<option value="">- Pilih -</option>';
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
          title: 'Apakah Anda Yakin Mengedit Bimsos Ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = {
              "alasan": $("#alasan_edit").val(),
              "jenis_kegiatan": "Bimsos",
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

        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/bimsos/request_edit/' + id,
          data: form,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: respons.message,
              icon: 'success',
              confirmButtonText: 'OK',
              allowOutsideClick: false,
              allowEscapeKey: false
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('#modal-req-edit').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          },
        });
      }

      $("#modal_revisi").click(() => {
        Swal.fire({
          title: 'Apakah Anda Yakin Revisi Bimsos Ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = {
              "alasan": $("#alasan_revisi").val(),
              "jenis_kegiatan": "Bimsos",
              "type": "request_revision"
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

        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/bimsos/request_revisi/' + id,
          data: form,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: respons.message,
              icon: 'success',
              confirmButtonText: 'OK',
              allowOutsideClick: false,
              allowEscapeKey: false
            }).then((result) => {
              if (result.isConfirmed) {
                $('#modal-add').hide();
                $('#modal-req-revision').hide();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('#datatable').DataTable().ajax.reload();
              }
            });
          },
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
            'id_bimsos',
            'periode_id_mdl',
            'sub_menu_slug',
            'nama_kegiatan',
            'tgl_bimtek',
            'lokasi_bimtek',
            'biaya_kegiatan',
            'jml_peserta',
            'ringkasan_kegiatan',
            'lap_hadir',
            'lap_pendamping',
            'lap_notula',
            'lap_survey',
            'lap_narasumber',
            'lap_materi',
            'lap_document'
          ];
          formData.append("status", 13);
          $('#progressModal').show();
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/bimsos/update/' + id_modal,
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
                  // Place upload progress bar visibility code here
                }
              }, false);

              return xhr;
            },
            success: (respons) => {
              $('#progressModal').hide();
              Swal.fire({
                title: 'Sukses!',
                text: respons.message,
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false

              }).then((result) => {
                if (result.isConfirmed) {
                  // User clicked "Yes, proceed!" button
                  $('#modal-add').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#datatable').DataTable().ajax.reload();

                }
              });

              //
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
          console.log(id_modal);
          var formData = new FormData($('#FormSubmit')[0]);
          var form = [
            'periode_id_mdl',
            'sub_menu_slug',
            'nama_kegiatan',
            'tgl_bimtek',
            'lokasi_bimtek',
            'biaya_kegiatan',
            'jml_peserta',
            'ringkasan_kegiatan',
            'lap_hadir',
            'lap_pendamping',
            'lap_notula',
            'lap_survey',
            'lap_narasumber',
            'lap_materi',
            'lap_document'
          ];
          formData.append("status", 14);
          $('#progressModal').show();
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/bimsos/kirim/' + id_modal,
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
                  // Place upload progress bar visibility code here
                }
              }, false);

              return xhr;
            },
            success: (respons) => {
              $('#progressModal').hide();
              Swal.fire({
                title: 'Sukses!',
                text: respons.message,
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false

              }).then((result) => {
                if (result.isConfirmed) {
                  // User clicked "Yes, proceed!" button
                  $('#modal-add').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#datatable').DataTable().ajax.reload();
                }
              });

              //
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
            "request_edit": "false",
          };
          $('#progressModal').hide();
          $.ajax({
            type: "PUT",
            url: BASE_URL + '/api/bimsos/approve_edit/' + id_modal,
            data: data,
            cache: false,
            dataType: "json",
            success: (respons) => {
              $('#progressModal').hide();
              Swal.fire({
                title: 'Sukses!',
                text: respons.message,
                icon: 'success',
                confirmButtonText: 'OK',
                allowOutsideClick: false,
                allowEscapeKey: false

              }).then((result) => {
                if (result.isConfirmed) {
                  // User clicked "Yes, proceed!" button
                  $('#modal-add').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#datatable').DataTable().ajax.reload();
                }
              });

              //
            }
          });
        });
      }

    });


  });
</script>