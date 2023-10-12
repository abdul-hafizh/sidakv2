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
</style>

<div id="modal-add" class="modal fade in" role="dialog">
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
                  <input type="file" class="form-control" name="lap_profile" id="AddFilesProfile" accept=".pdf">
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
                <input type="file" class="form-control" name="lap_peserta" id="AddFilesPeserta" accept=".pdf">
                <div id="ShowPdfPeserta" style="margin-top:8px"></div>
                <span id="file-peserta-alert-messages"></span>
                <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_profile2-alert" class="form-group has-feedback col-md-12">
                <label>Profile Pelaku Usaha </label>
                <input type="file" class="form-control" name="lap_profile2" id="AddFilesProfile2" accept=".pdf">
                <div id="ShowPdfProfile2" style="margin-top:8px"></div>
                <span id="file-profile2-alert-messages"></span>
                <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_narasumber-alert" class="form-group has-feedback col-md-12">
                  <label>Daftar Narasumber </label>
                  <input type="file" class="form-control" name="lap_narasumber" id="AddFilesNarasumber" accept=".pdf">
                  <div id="ShowPdfNarasumber" style="margin-top:8px"></div>
                  <span id="file-narasumber-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="notula2-alert" class="form-group has-feedback col-md-12">
                  <label>Notula Kegiatan </label>
                  <input type="file" class="form-control" name="lap_notula2" id="AddFilesNotula2" accept=".pdf">
                  <div id="ShowPdfNotula2" style="margin-top:8px"></div>
                  <span id="file-notula2-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_lkpm-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan LKPM </label>
                  <input type="file" class="form-control" name="lap_lkpm" id="AddFilesLkpm" accept=".pdf">
                  <div id="ShowPdfLkpm" style="margin-top:8px"></div>
                  <span id="file-lkpm-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_document-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan Dokumentasi </label>
                  <input type="file" class="form-control" name="lap_document" id="AddFilesDoc" accept=".pdf">
                  <div id="ShowPdfDoc" style="margin-top:8px"></div>
                  <span id="file-doc-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
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
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
              </div>
            </div>
            <div class="row">
              <div id="lap_evaluasi-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan Hasil Evaluasi </label>
                  <input type="file" class="form-control" name="lap_evaluasi" id="AddFilesEvaluasi" accept=".pdf">
                  <div id="ShowPdfEvaluasi" style="margin-top:8px"></div>
                  <span id="file-evaluasi-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
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

<div id="modal-log" class="modal fade in" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Log Data</h4>
      </div>

      <div class="modal-body" style="height: 550px; overflow-y: auto;">        
        <div class="row">

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

<script type="text/javascript">
  $(function() {

    $('#tab_identifikasi').hide();
    $('#tab_penyelesaian').hide();
    $('#tab_evaluasi').hide();
    
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
      getAnggaran($('#periode_id_mdl').val(), $('#sub_menu_slug').val());  
    })    

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
      $('#simpan').show();
      $('#update').hide();
      $('#kirim').hide();
      $('#approve_edit').hide();
      $('#request_revision').hide();
      $('#request_edit').hide();
      $('#tab_identifikasi').hide();
      $('#tab_penyelesaian').hide();
      $('#tab_evaluasi').hide();
      $('#FormSubmit input').removeAttr('readonly');
      $('#FormSubmit select').removeAttr('disabled');
      $('#anggaran').html("");

      var form = [
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'tgl_kegiatan',
        'lokasi',
        'biaya',
        'jml_perusahaan'
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
        'jml_perusahaan'
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
          subMenu(data.sub_menu_slug);
          getPeriode(data.periode_id);
          getAnggaran(data.periode_id, data.sub_menu_slug);

          $('#sub_menu_slug').val(data.sub_menu_slug);
          $('#nama_kegiatan').val(data.nama_kegiatan);
          $('#tgl_kegiatan').val(data.tgl_kegiatan);
          $('#lokasi').val(data.lokasi);
          $('#biaya').val(data.biaya);
          $('#jml_perusahaan').val(data.jml_perusahaan);

          if(data.status_laporan_id == 13 && data.request_edit == 'reject') {    
            $('#alasan-view').show();
            $('#alasan-revisi-view').html('Alasan Perbaikan: ' + data.alasan_revisi);
          }

          if(data.status_laporan_id == 15 && data.request_edit == 'true') {            
            $('#alasan-view').show();
            $('#alasan-edit-view').html('Alasan Edit: ' + data.alasan_edit);
          }

          if (data.access == 'daerah' || data.access == 'province') {
            $('#approve_edit').hide();
            $('#request_revision').hide();
            if (data.status_laporan_id == 13) {
              $('#update').show();
              $('#kirim').show();
              $('#request_edit').hide();
              $('#FormSubmit input').removeAttr('readonly');
              $('#FormSubmit select').removeAttr('disabled');
            } else if (data.status_laporan_id == 15) {
              if (data.request_edit == 'false') {
                $('#update').show();
                $('#kirim').show();
                $('#FormSubmit input').removeAttr('readonly');
                $('#FormSubmit select').removeAttr('disabled');
              } else {
                $('#update').hide();
                $('#kirim').hide();
                $('#FormSubmit input').attr('readonly', 'readonly');
                $('#FormSubmit select').attr('disabled', 'true');
              }
              $('#request_edit').hide();
            } else {
              $('#update').hide();
              $('#kirim').hide();
              $('#request_edit').show();
              $('#FormSubmit input').attr('readonly', 'readonly');
              $('#FormSubmit select').attr('disabled', 'true');
            }
          } else {
            $('#FormSubmit input').attr('readonly', 'readonly');
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

      $("#update").click(() => {
        var data = $("#FormSubmit").serializeArray();
        var form = [
          'periode_id_mdl',
          'sub_menu_slug',
          'nama_kegiatan',
          'tgl_kegiatan',
          'lokasi',
          'biaya',
          'jml_perusahaan'
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
          'jml_perusahaan'
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
              text: 'Berhasil Terkirim Ke Pusat.',
              icon: 'success',
              confirmButtonText: 'OK'

            }).then((result) => {
              if (result.isConfirmed) {
                window.location.replace('/penyelesaian');
              }
            });
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
        const files_profile = event.target.files
        let filename_profile = files_profile[0].name
        const fileReaderProfile = new FileReader()
        fileReaderProfile.addEventListener('load', () => {
          if(files_profile[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_profile = fileReaderProfile.result;
            
            var ros_profile = '';
                  ros_profile +=`<a href="#" id="GetModalPdfProfile" data-param_id="`+file_pdf_profile+`" data-toggle="modal" data-target="#modal-show" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF">Lihat File Profile</a>`;
                  ros_profile +=`<div id="modal-show" class="modal fade" role="dialog">`;
                      ros_profile +=`<div id="ViewProfilePDF"></div>`;
                  ros_profile +=`</div>`;

            $('#ShowPdfProfile').html(ros_profile);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderProfile.readAsDataURL(files_profile[0])

    });

    $("#AddFilesNotula").change((event)=> {     
        const files_notula = event.target.files
        let filename_notula = files_notula[0].name
        const fileReaderNotula = new FileReader()
        fileReaderNotula.addEventListener('load', () => {
          if(files_notula[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_notula = fileReaderNotula.result;
            
            var ros_not = '';
                  ros_not +=`<a href="#" id="GetModalPdfNotula" data-param_id="`+file_pdf_notula+`" data-toggle="modal" data-target="#modal-show" data-toggle="tooltip" data-placement="top" title="Lihat File PDF">Lihat File Notula</a>`;
                  ros_not +=`<div id="modal-show" class="modal fade" role="dialog">`;
                      ros_not +=`<div id="ViewNotulaPDF"></div>`;
                  ros_not +=`</div>`;

            $('#ShowPdfNotula').html(ros_not);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderNotula.readAsDataURL(files_notula[0])

    });

    $("#AddFilesEvaluasi").change((event)=> {     
        const files_eval = event.target.files
        let filename_eval = files_eval[0].name
        const fileReaderEval = new FileReader()
        fileReaderEval.addEventListener('load', () => {
          if(files_eval[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_eval = fileReaderEval.result;
            
            var ros_eval = '';
                  ros_eval +=`<a href="#" id="GetModalPdfEvaluasi" data-param_id="`+file_pdf_eval+`" data-toggle="modal" data-target="#modal-show" data-toggle="tooltip" data-placement="top" title="Lihat File PDF">Lihat File Evaluasi</a>`;
                  ros_eval +=`<div id="modal-show" class="modal fade" role="dialog">`;
                      ros_eval +=`<div id="ViewEvaluasiPDF"></div>`;
                  ros_eval +=`</div>`;

            $('#ShowPdfEvaluasi').html(ros_eval);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderEval.readAsDataURL(files_eval[0])

    });

    $( "#ShowPdfProfile" ).on( "click", "#GetModalPdfProfile", (e) => {
        let file_profile = e.currentTarget.dataset.param_id;      
        let row_profile = ``;
          row_profile +=`<div class="modal-dialog">`;
              row_profile +=`<div class="modal-content">`;
                  row_profile +=`<div class="modal-header">`;
                        row_profile +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_profile +=`<h4 class="modal-title">Lihat File Profile</h4>`;
                  row_profile +=`</div>`;               
                  row_profile +=`<div class="modal-body">`; 
                  if(file_profile)
                  {  
                        row_profile +=`<embed src="`+file_profile+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_profile +=`</div>`;               
                  row_profile +=`<div class="modal-footer">`;
                        row_profile +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_profile +=`</div>`;                         
              row_profile +=`</div>`;
        row_profile +=`</div>`; 

        $('#ViewProfilePDF').html(row_profile);   

    });

    $( "#ShowPdfNotula" ).on( "click", "#GetModalPdfNotula", (e) => {
        let file_notula = e.currentTarget.dataset.param_id;      
        let row_notula = ``;
          row_notula +=`<div class="modal-dialog">`;
              row_notula +=`<div class="modal-content">`;
                  row_notula +=`<div class="modal-header">`;
                        row_notula +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_notula +=`<h4 class="modal-title">Lihat File Notula</h4>`;
                  row_notula +=`</div>`;               
                  row_notula +=`<div class="modal-body">`; 
                  if(file_notula)
                  {  
                        row_notula +=`<embed src="`+file_notula+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_notula +=`</div>`;               
                  row_notula +=`<div class="modal-footer">`;
                        row_notula +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_notula +=`</div>`;                         
              row_notula +=`</div>`;
        row_notula +=`</div>`; 

        $('#ViewNotulaPDF').html(row_notula);   

    });

    $( "#ShowPdfEvaluasi" ).on( "click", "#GetModalPdfEvaluasi", (e) => {
        let file_eval = e.currentTarget.dataset.param_id;      
        let row_eval = ``;
          row_eval +=`<div class="modal-dialog">`;
              row_eval +=`<div class="modal-content">`;
                  row_eval +=`<div class="modal-header">`;
                        row_eval +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_eval +=`<h4 class="modal-title">Lihat File Evaluasi</h4>`;
                  row_eval +=`</div>`;               
                  row_eval +=`<div class="modal-body">`; 
                  if(file_eval)
                  {  
                        row_eval +=`<embed src="`+file_eval+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_eval +=`</div>`;               
                  row_eval +=`<div class="modal-footer">`;
                        row_eval +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_eval +=`</div>`;                         
              row_eval +=`</div>`;
        row_eval +=`</div>`; 

        $('#ViewEvaluasiPDF').html(row_eval);   

    });

  });
</script>