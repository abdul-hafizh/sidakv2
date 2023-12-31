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
<div id="modal-detail" class="modal fade" role="dialog">
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
            <div id="lap_hadir-alert" class="form-group has-feedback">
              <div class="col-md-3 col-5">
                <label>Daftar hadir </label>
              </div>
              <div class="col-md-9 col-7">
                <input type="file" name="lap_hadir" id="lap_hadir" accept=".pdf">
                <span id="lap_hadir-messages"></span>
              </div>
              <small class="text-muted">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_pendamping-alert" class="form-group has-feedback">
              <div class="col-md-3 col-5">
                <label>Laporan Tenaga Pendamping </label>
              </div>
              <div class="col-md-9 col-7">
                <input type="file" name="lap_pendamping" accept=".pdf">
                <span id="lap_pendamping-messages"></span>
              </div>
              <small class="text-muted">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_notula-alert" class="form-group has-feedback" style="display: none">
              <div class="col-md-3 col-5">
                <label>Notula Kegiatan </label>
              </div>
              <div class="col-md-9 col-7">
                <input type="file" name="lap_notula" accept=".pdf">
                <span id="lap_notula-messages"></span>
              </div>
              <small class="text-muted">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_survey-alert" class="form-group has-feedback" style="display: none">
              <div class="col-md-3 col-5">
                <label>Hasil Survey </label>
              </div>
              <div class="col-md-9 col-7">
                <input type="file" name="lap_survey" accept=".pdf">
                <span id="lap_survey-messages"></span>
              </div>
              <small class="text-muted">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_narasumber-alert" class="form-group has-feedback" style="display: none">
              <div class="col-md-3 col-5">
                <label>Daftar Narasumber </label>
              </div>
              <div class="col-md-9 col-7">
                <input type="file" name="lap_narasumber" accept=".pdf">
                <span id="lap_narasumber-messages"></span>
              </div>
              <small class="text-muted">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_materi-alert" class="form-group has-feedback" style="display: none">
              <div class="col-md-3 col-5">
                <label>Materi </label>
              </div>
              <div class="col-md-9 col-7">
                <input type="file" name="lap_materi" accept=".pdf">
                <span id="lap_materi-messages"></span>
              </div>
              <small class="text-muted">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
            </div>
          </div>
          <div class="row">
            <div id="lap_document-alert" class="form-group has-feedback" style="display: none">
              <div class="col-md-3 col-5">
                <label>Laporan Dokumentasi </label>
              </div>
              <div class="col-md-9 col-7">
                <input type="file" name="lap_document" accept=".pdf">
                <span id="lap_document-messages"></span>
              </div>
              <small class="text-muted">*file yang diupload harus pdf dan ukuran dibawah 1.3 MB</small>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="simpan" type="button" class="btn btn-primary" style="display: none;">Simpan</button>
          <button id="update" type="button" class="btn btn-info" style="display: none;">Ubah</button>
          <button id="kirim" type="button" class="btn btn-warning" style="display: none;">Kirim</button>
          <button id="request_revision" type="button" class="btn btn-warning" style="display: none;">Mengajukan Revisi</button>
          <button id="request_edit" type="button" class="btn btn-warning" style="display: none;">Mengajukan Edit</button>

        </div>
      </form>
    </div>

  </div>
</div>




<script type="text/javascript">
  $(function() {

    $("#datatable").on("click", ".modalDetail", function() {
      $('.modal-title').html('Form Detail');
      //  $('.modal-footer button[type=button]').html('Ubah Data');
      $('#simpan').hide();
      $('#update').show();
      $('#kirim').show();
      $('#periode_id_mdl-alert').removeClass('has-error');
      $('#periode_id_mdl-messages').removeClass('help-block').html('');


      const id = $(this).data('param_id');
      $.ajax({
        url: BASE_URL + '/api/bimsos/edit/' + id,
        method: 'GET',
        success: function(data) {
          $('#sub_menu_slug').val(data.sub_menu_slug);
          $('#nama_kegiatan').val(data.nama_kegiatan);
          $('#tgl_bimtek').val(data.tgl_bimtek);
          $('#lokasi_bimtek').val(data.lokasi_bimtek);
          $('#biaya_kegiatan').val(data.biaya_kegiatan);
          $('#jml_peserta').val(data.jml_peserta);
          $('#ringkasan_kegiatan').val(data.ringkasan_kegiatan);
          $('#is_skpd_sesuai').val(data.is_skpd_sesuai);
          getPeriode(data.periode_id);
          subMenu(data.sub_menu_slug);
        }

      })

      function subMenu(sub_menu_slug) {
        if (sub_menu_slug == 'is_tenaga_pendamping') {
          $('#jml_peserta-alert').hide();
          $('#lap_notula-alert').hide();
          $('#lap_survei-alert').hide();
          $('#lap_narasumber-alert').hide();
          $('#lap_materi-alert').hide();
          $('#lap_document-alert').hide();
          $('#lap_pendamping-alert').show();
        } else if (sub_menu_slug == 'is_bimtek_ipbbr') {
          $('#jml_peserta-alert').show();
          $('#lap_notula-alert').show();
          $('#lap_survei-alert').show();
          $('#lap_narasumber-alert').show();
          $('#lap_materi-alert').show();
          $('#lap_document-alert').show();
          $('#lap_pendamping-alert').hide();
        } else {
          $('#jml_peserta-alert').show();
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

      $("#update").click(() => {
        var data = $("#FormSubmit").serializeArray();
        var form = [
          'periode_id_mdl',
          'sub_menu_slug',
          'nama_kegiatan',
          'tgl_bimtek',
          'lokasi_bimtek',
          'biaya_kegiatan',
          'jml_peserta',
          'ringkasan_kegiatan'
        ];
        data.push({
          name: 'status',
          value: '13'
        });
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/bimsos/' + id,
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
                // User clicked "Yes, proceed!" button
                window.location.replace('/bimsos');
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
          'tgl_bimtek',
          'lokasi_bimtek',
          'biaya_kegiatan',
          'jml_peserta',
          'ringkasan_kegiatan'
        ];
        data.push({
          name: 'status',
          value: '14'
        });
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/bimsos/' + id,
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
                // User clicked "Yes, proceed!" button
                window.location.replace('/bimsos');
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


    });

  });
</script>