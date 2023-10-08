<style>
  .modal-loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
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

<div id="progressModal" class="modal-loading" style="display:none;position:relative;z-index:9999999">
  <div class="modal-content2">
    <span class="close" id="closeProgressModal">&times;</span>
    <h2>Upload Progress</h2>
    <div id="progress-container">
      <div id="progress-bar">
        <div id="progress" style="width: 0%"></div>
      </div>
      <div id="progress-label">0%</div>
    </div>
  </div>
</div>

<div id="modal-add" class="modal fade in" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judulModalLabel">Tambah Data</h4>
      </div>
      <form id="FormSubmit" enctype="multipart/form-data">
        <div class="modal-body" style="height: 550px; overflow-y: auto;">
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
              <label>Biaya Kegiatan</label>
              <input type="number" class="form-control" name="biaya" id="biaya" placeholder="Biaya Kegiatan" value="">
              <span id="biaya-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="jml_perusahaan-alert" class="form-group has-feedback col-md-12">
              <label>Jumlah Perusahaan </label>
              <input type="number" class="form-control" name="jml_perusahaan" id="jml_perusahaan" placeholder="Jumlah Perusahaan " value="">
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
                  <input type="file" class="form-control" name="lap_profile" id="AddFilesProfile" accept=".pdf">
                  <div id="ShowPdfProfile" style="margin-top:8px"></div>
                  <span id="file-profile-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
          </div>

          <div id="tab_penyelesaian">
            <div class="row">
              <div id="lap_peserta-alert" class="form-group has-feedback col-md-12">
                <label>Daftar Hadir </label>
                <input type="file" class="form-control" name="lap_peserta" id="AddFilesPeserta" accept=".pdf">
                <div id="ShowPdfPeserta" style="margin-top:8px"></div>
                <span id="file-peserta-alert-messages"></span>
                <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_profile2-alert" class="form-group has-feedback col-md-12">
                <label>Profile Pelaku Usaha </label>
                <input type="file" class="form-control" name="lap_profile2" id="AddFilesProfile2" accept=".pdf">
                <div id="ShowPdfProfile2" style="margin-top:8px"></div>
                <span id="file-profile2-alert-messages"></span>
                <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_narasumber-alert" class="form-group has-feedback col-md-12">
                  <label>Daftar Narasumber </label>
                  <input type="file" class="form-control" name="lap_narasumber" id="AddFilesNarasumber" accept=".pdf">
                  <div id="ShowPdfNarasumber" style="margin-top:8px"></div>
                  <span id="file-narasumber-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="notula2-alert" class="form-group has-feedback col-md-12">
                  <label>Notula Kegiatan </label>
                  <input type="file" class="form-control" name="lap_notula2" id="AddFilesNotula2" accept=".pdf">
                  <div id="ShowPdfNotula2" style="margin-top:8px"></div>
                  <span id="file-notula2-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_lkpm-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan LKPM </label>
                  <input type="file" class="form-control" name="lap_lkpm" id="AddFilesLkpm" accept=".pdf">
                  <div id="ShowPdfLkpm" style="margin-top:8px"></div>
                  <span id="file-lkpm-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_document-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan Dokumentasi </label>
                  <input type="file" class="form-control" name="lap_document" id="AddFilesDoc" accept=".pdf">
                  <div id="ShowPdfDoc" style="margin-top:8px"></div>
                  <span id="file-doc-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
          </div>

          <div id="tab_evaluasi">
            <div class="row">
              <div id="notula-alert" class="form-group has-feedback col-md-12">
                  <label>Notula Rapat </label>
                  <input type="file" class="form-control" name="lap_notula" id="AddFilesNotula" accept=".pdf">
                  <div id="ShowPdfNotula" style="margin-top:8px"></div>
                  <span id="file-notula-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_evaluasi-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan Hasil Evaluasi </label>
                  <input type="file" class="form-control" name="lap_evaluasi" id="AddFilesEvaluasi" accept=".pdf">
                  <div id="ShowPdfEvaluasi" style="margin-top:8px"></div>
                  <span id="file-evaluasi-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button id="simpan" type="button" class="btn btn-primary" style="display: none;">Simpan</button>
          <button id="update" type="button" class="btn btn-info" style="display: none;">Ubah</button>
          <button id="kirim" type="button" class="btn btn-warning" style="display: none;">Kirim</button>
          <button id="approve_edit" type="button" class="btn btn-warning" style="display: none;">Approve Edit</button>
          <button id="request_edit" type="button" class="btn btn-warning" data-toggle="modal" style="display: none;" data-target="#modal-req-edit">Mengajukan Edit</button>
          <button id="request_revision" type="button" class="btn btn-warning" data-toggle="modal" style="display: none;" data-target="#modal-req-revision">Mengajukan Revisi</button>
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

<script type="text/javascript">
  $(function() {

    $('#tab_identifikasi').hide();
    $('#tab_penyelesaian').hide();
    $('#tab_evaluasi').hide();

    $('#sub_menu_slug').on('change', function() {
      
      let sub_menu_slug = $('#sub_menu_slug').val();

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

    $('#tambah').on('click', function() {
      $('#judulModalLabel').html('Tambah Data')
      $('#simpan').show();
      $('#update').hide();
      $('#kirim').hide();
      $('#approve_edit').hide();
      $('#request_revision').hide();
      $('#request_edit').hide();
      $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
      $('#FormSubmit select').removeAttr('disabled');
      var form = [
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_kegiatan',
        'lokasi',
        'biaya',
        'jml_perusahaan',
        'ringkasan_kegiatan'
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
        'jml_perusahaan'
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
          Swal.fire({
            title: 'Sukses!',
            text: 'Berhasil Disimpan',
            icon: 'success',
            confirmButtonText: 'OK'

          }).then((result) => {
            if (result.isConfirmed) {
              window.location.replace('/penyelesaian');
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

    $("#datatable").on("click", ".modalUbah", function() {
      $('#judulModalLabel').html('Ubah Data');
      $('#simpan').hide();
      var form = [
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_kegiatan',
        'lokasi',
        'biaya',
        'jml_perusahaan',
        'ringkasan_kegiatan'
      ];
      for (let i = 0; i < form.length; i++) {
        const field = form[i];
        $('#' + field).val('');
        $('#' + field + '-alert').removeClass('has-error');
        $('#' + field + '-messages').removeClass('help-block').html('');
      }

      const id = $(this).data('param_id');
      $.ajax({
        url: BASE_URL + '/api/penyelesaian/edit/' + id,
        method: 'GET',
        success: function(data) {
          $('#sub_menu_slug').val(data.sub_menu_slug);
          $('#nama_kegiatan').val(data.nama_kegiatan);
          $('#tgl_kegiatan').val(data.tgl_kegiatan);
          $('#lokasi').val(data.lokasi);
          $('#biaya').val(data.biaya);
          $('#jml_perusahaan').val(data.jml_perusahaan);
          $('#ringkasan_kegiatan').val(data.ringkasan_kegiatan);
          $('#is_skpd_sesuai').val(data.is_skpd_sesuai);
          getPeriode(data.periode_id);
          subMenu(data.sub_menu_slug);
          if (data.access == 'daerah' || data.access == 'province') {
            $('#approve_edit').hide();
            $('#request_revision').hide();
            if (data.status_laporan_id == 13) {
              $('#update').show();
              $('#kirim').show();
              $('#request_edit').hide();
              $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
              $('#FormSubmit select').removeAttr('disabled');
            } else if (data.status_laporan_id == 15) {
              if (data.request_edit == 'false') {
                $('#update').show();
                $('#kirim').show();
                $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
                $('#FormSubmit select').removeAttr('disabled');
              } else {
                $('#update').hide();
                $('#kirim').hide();
                $('#FormSubmit input,#FormSubmit textarea').attr('readonly', 'readonly');
                $('#FormSubmit select').attr('disabled', 'true');
              }
              $('#request_edit').hide();
            } else {
              $('#update').hide();
              $('#kirim').hide();
              $('#request_edit').show();
              $('#FormSubmit input,#FormSubmit textarea').attr('readonly', 'readonly');
              $('#FormSubmit select').attr('disabled', 'true');
            }
          } else {
            $('#FormSubmit input,#FormSubmit textarea').attr('readonly', 'readonly');
            $('#FormSubmit select').attr('disabled', 'true');
            $('#request_edit').hide();
            if (data.status_laporan_id == 13) {
              $('#update').hide();
              $('#kirim').hide();
              $('#request_revision').hide();

            } else if (data.status_laporan_id == 15) {
              if (data.request_edit == 'false') {
                $('#update').hide();
                $('#kirim').hide();
                $('#approve_edit').hide();
              } else {
                $('#approve_edit').show();
                $('#update').hide();
                $('#kirim').hide();
              }
              $('#request_revision').hide();
            } else {
              $('#update').hide();
              $('#kirim').hide();
              $('#request_revision').show();
            }
          }
        }

      })

      function subMenu(sub_menu_slug) {
        if (sub_menu_slug == 'is_tenaga_pendamping') {
          $('#jml_perusahaan-alert').hide();
          $('#lap_notula-alert').hide();
          $('#lap_survei-alert').hide();
          $('#lap_narasumber-alert').hide();
          $('#lap_materi-alert').hide();
          $('#lap_document-alert').hide();
          $('#lap_pendamping-alert').show();
        } else if (sub_menu_slug == 'is_bimtek_ipbbr') {
          $('#jml_perusahaan-alert').show();
          $('#lap_notula-alert').show();
          $('#lap_survei-alert').show();
          $('#lap_narasumber-alert').show();
          $('#lap_materi-alert').show();
          $('#lap_document-alert').show();
          $('#lap_pendamping-alert').hide();
        } else {
          $('#jml_perusahaan-alert').show();
          $('#lap_notula-alert').show();
          $('#lap_survei-alert').show();
          $('#lap_narasumber-alert').show();
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

      $("#update").click(() => {
        var data = $("#FormSubmit").serializeArray();
        var form = [
          'periode_id_mdl',
          'sub_menu_slug',
          'nama_kegiatan',
          'tgl_kegiatan',
          'lokasi',
          'biaya',
          'jml_perusahaan',
          'ringkasan_kegiatan'
        ];
        data.push({
          name: 'status',
          value: '13'
        });
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/penyelesaian/' + id,
          data: data,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil Disimpan',
              icon: 'success',
              confirmButtonText: 'OK'

            }).then((result) => {
              if (result.isConfirmed) {
                window.location.replace('/penyelesaian');
              }
            });

            //
          },
          error: (respons) => {
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

      $("#kirim").click(() => {
        var data = $("#FormSubmit").serializeArray();
        var form = [
          'periode_id_mdl',
          'sub_menu_slug',
          'nama_kegiatan',
          'tgl_kegiatan',
          'lokasi',
          'biaya',
          'jml_perusahaan',
          'ringkasan_kegiatan'
        ];
        data.push({
          name: 'status',
          value: '14'
        });
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/penyelesaian/' + id,
          data: data,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil Disimpan',
              icon: 'success',
              confirmButtonText: 'OK'

            }).then((result) => {
              if (result.isConfirmed) {
                window.location.replace('/penyelesaian');
              }
            });

            //
          },
          error: (respons) => {
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

      $("#approve_edit").click(() => {
        var data = {
          "status": 13,
          "request_edit": "false",
        };
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/penyelesaian/approve_edit/' + id,
          data: data,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil Disimpan',
              icon: 'success',
              confirmButtonText: 'OK'

            }).then((result) => {
              if (result.isConfirmed) {
                window.location.replace('/penyelesaian');
              }
            });

            //
          }
        });
      });

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
              "alasan_edit": $("#alasan_edit").val()
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
          url: BASE_URL + '/api/penyelesaian/request_edit/' + id,
          data: form,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil mengajukan edit.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.replace('/penyelesaian');
              }
            });
          },
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
              "alasan_revisi": $("#alasan_revisi").val()
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
          url: BASE_URL + '/api/penyelesaian/request_revisi/' + id,
          data: form,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: 'Berhasil mengajukan revisi.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.replace('/penyelesaian');
              }
            });
          },
        });
      }

    });

    $("#AddFilesProfile").change((event)=> {     
            
        const files = event.target.files
        let filename = files[0].name
        const fileReader = new FileReader()
        fileReader.addEventListener('load', () => {
              if(files[0].name.toUpperCase().includes(".PDF"))
              {
                  file_pdf = fileReader.result;
                  
                  var ros = '';
                        ros +=`<a href="#" id="GetModalPdfProfile" data-param_id="`+file_pdf+`" data-toggle="modal" data-target="#modal-show" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF">Lihat File Profile</a>`;
                        ros +=`<div id="modal-show" class="modal fade" role="dialog">`;
                            ros +=`<div id="ViewProfilePDF"></div>`;
                        ros +=`</div>`;

                  $('#ShowPdfProfile').html(ros);
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

    $( "#ShowPdfProfile" ).on( "click", "#GetModalPdfProfile", (e) => {
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

        $('#ViewProfilePDF').html(row);   

    });

  });
</script>