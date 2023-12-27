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
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judulModalLabel">Tambah Pagu Target</h4>
      </div>
      <form id="FormSubmit">
        <div class="modal-body">

          <div class="row">
            <div id="type_daerah-alert" class="form-group has-feedback col-md-12">
              <label>Tipe </label>
              <select class="form-control" name="type_daerah" id="type_daerah">
                <option value="">-Pilih Tipe-</option>
                <option value="Provinsi">Provinsi</option>
                <option value="Kabupaten">Kabupaten</option>
              </select>
              <span id="type_daerah-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="daerah_id-alert" class="form-group has-feedback col-md-12">
              <label>Daerah </label>
              <select id="daerah_id" class="select-daerah form-control" name="daerah_id" disabled>
                <option value="">Pilih</option>
              </select>
              <span id="daerah_id-messages"></span>
              <input type="hidden" class="form-control" name="nama_daerah" id="nama_daerah" placeholder="APBN" value="">
            </div>

          </div>
          <div class="row">
            <div id="periode_id-alert" class="form-group has-feedback col-md-12">
              <label>Periode </label>
              <select id="periode_id" class="select-periode form-control" name="periode_id"></select>
              <span id="periode_id-messages"></span>
            </div>
          </div>

          <div class="row">
            <div id="pagu_pengawasan-alert" class="form-group has-feedback col-md-6">
              <label>Pagu Pengawasan</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="pagu_pengawasan" id="pagu_pengawasan" placeholder="Pagu Pengawasan" value="">
              <span id="pagu_pengawasan-messages"></span>
            </div>
            <div id="target_pengawasan-alert" class="form-group has-feedback col-md-6">
              <label>Target Pengawasan</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_pengawasan" id="target_pengawasan" placeholder="Pengawasan" value="">
              <span id="target_pengawasan-messages"></span>
            </div>
          </div>

          <div class="row">
            <div id="pagu_penyelesaian_permasalahan-alert" class="form-group has-feedback col-md-6">
              <label>Pagu Penyelesaian Masalah</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="pagu_penyelesaian_permasalahan" id="pagu_penyelesaian_permasalahan" placeholder="Pagu Penyelesaian Masalah" value="">
              <span id="pagu_penyelesaian_permasalahan-messages"></span>
            </div>
            <div id="target_penyelesaian_permasalahan-alert" class="form-group has-feedback col-md-6">
              <label>Target Penyelesaian Masalah</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_penyelesaian_permasalahan" id="target_penyelesaian_permasalahan" placeholder="Penyelesaian Masalah" value="">
              <span id="target_penyelesaian_permasalahan-messages"></span>
            </div>
          </div>

          <div class="row">
            <div id="pagu_bimbingan_teknis-alert" class="form-group has-feedback col-md-6">
              <label>Pagu Bimbingan Teknis</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="pagu_bimbingan_teknis" id="pagu_bimbingan_teknis" placeholder="Pagu Bimbingan Teknis" value="">
              <span id="pagu_bimbingan_teknis-messages"></span>
            </div>
            <div id="target_bimbingan_teknis-alert" class="form-group has-feedback col-md-6">
              <label>Target Bimbingan Teknis</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_bimbingan_teknis" id="target_bimbingan_teknis" placeholder="Bimbingan Teknis" value="">
              <span id="target_bimbingan_teknis-messages"></span>
            </div>
          </div>

          <div class="row">
            <div id="pagu_promosi-alert" class="form-group has-feedback col-md-6" style="display: none;">
              <label id="judulPaguPromosi">Pagu Promosi</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="pagu_promosi" id="pagu_promosi" placeholder="Promosi" value="">
              <span id="pagu_promosi-messages"></span>
            </div>
            <div id="target_video_promosi-alert" class="form-group has-feedback col-md-6" style="display: none">
              <label id="judulTargetPromosi">Target Video Promosi</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_video_promosi" id="target_video_promosi" placeholder="Video Promosi" value="" readonly>
              <span id="target_video_promosi-messages"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button id="simpan" type="button" class="btn btn-primary" style="display: none;">Simpan</button>
          <button id="update" type="button" class="btn btn-primary" style="display: none;">Ubah</button>

        </div>
      </form>
    </div>

  </div>
</div>




<script type="text/javascript">
  $(function() {

    $('#ShowAdd').on('click', function() {
      $('#judulModalLabel').html('Tambah Pagu Target')

      var form = [
        'periode_id',
        'daerah_id',
        'nama_daerah',
        'pagu_promosi',
        'type_daerah',
        'pagu_pengawasan',
        'pagu_penyelesaian_permasalahan',
        'pagu_bimbingan_teknis',
        'target_pengawasan',
        'target_penyelesaian_permasalahan',
        'target_bimbingan_teknis',
        'target_video_promosi'
      ];
      for (let i = 0; i < form.length; i++) {
        const field = form[i];
        if (field == 'daerah_id')
          $('#daerah_id').val("").trigger("change").prop('disabled', true);
        else if (field == 'periode_id')
          $('#periode_id').val("").trigger("change");
        else
          $('#' + field).val('');
        $('#' + field + '-alert').removeClass('has-error');
        $('#' + field + '-messages').removeClass('help-block').html('');
      }
      $('#simpan').show();
      $('#update').hide();
      $('#target_video_promosi-alert').hide();
    })

    $("#datatable").on("click", ".modalUbah", function() {
      $('#judulModalLabel').html('Form Ubah');
      //  $('.modal-footer button[type=button]').html('Ubah Data');
      $('#simpan').hide();
      $('#update').show();
      $('#periode_id-alert').removeClass('has-error');
      $('#periode_id-messages').removeClass('help-block').html('');


      const id = $(this).data('param_id');
      $.ajax({
        url: BASE_URL + '/api/pagutarget/edit/' + id,
        method: 'GET',
        success: function(data) {
          $('#type_daerah').val(data.type_daerah);
          $('#daerah_id').val(data.daerah_id);
          $('#nama_daerah').val(data.nama_daerah);
          $('#periode_id').val(data.periode_id);
          $('#pagu_promosi').val(data.pagu_promosi);
          $('#pagu_pengawasan').val(data.pagu_pengawasan);
          $('#pagu_penyelesaian_permasalahan').val(data.pagu_penyelesaian_permasalahan);
          $('#pagu_bimbingan_teknis').val(data.pagu_bimbingan_teknis);
          $('#target_pengawasan').val(data.target_pengawasan);
          $('#target_penyelesaian_permasalahan').val(data.target_penyelesaian_permasalahan);
          $('#target_bimbingan_teknis').val(data.target_bimbingan_teknis);
          $('#target_video_promosi').val(data.target_video_promosi);
          getPeriode(data.periode_id);
          getDaerah(data.type_daerah, data.daerah_id);
        }

      })

      function getPeriode(periode_id) {
        $.ajax({
          url: BASE_URL + '/api/select-periode?type=POST&action=pagu',
          method: 'get',
          dataType: 'json',
          success: function(data) {
            periode = '<option value="">- Pilih -</option>';
            $.each(data.result, function(key, val) {
              var select = '';
              if (val.value == periode_id)
                select = 'selected';
              periode += '<option value="' + val.value + '" ' + select + '>' + val.text + '</option>';
            });
            $('#periode_id').html(periode)
          }
        })
        $('.select-periode').select2();
      }

      function getDaerah(type_daerah, daerah_id) {
        if (type_daerah == 'Provinsi') {
          url = "select-province";
          $('#pagu_promosi-alert').show();
          $('#target_video_promosi-alert').show();
        } else {
          url = "select-kabupaten";
          $('#pagu_promosi-alert').hide();
          $('#target_video_promosi-alert').hide();
        }
        $.ajax({
          url: BASE_URL + '/api/' + url,
          method: 'get',
          dataType: 'json',
          success: function(data) {
            daerah = '<option value="">- Pilih -</option>';
            $.each(data, function(key, val) {
              var select = '';
              if (val.value == daerah_id)
                select = 'selected';
              daerah += '<option value="' + val.value + '" ' + select + '>' + val.text + '</option>';
            });
            $('#daerah_id').html(daerah).removeAttr('disabled');
          }
        })
        $('.select-daerah').select2();
      }


      $("#update").click(() => {
        var data = $("#FormSubmit").serializeArray();
        var form = [
          'periode_id',
          'daerah_id',
          'nama_daerah',
          'pagu_promosi',
          'type_daerah',
          'pagu_pengawasan',
          'pagu_penyelesaian_permasalahan',
          'pagu_bimbingan_teknis',
          'target_pengawasan',
          'target_penyelesaian_permasalahan',
          'target_bimbingan_teknis',
          'target_video_promosi'
        ];

        $('#progressModal').show();
        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/pagutarget/' + id,
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
                hasil_sum();
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


    });

    $('#type_daerah').on('change', function() {
      let type_daerah = $('#type_daerah').val();
      if (type_daerah == 'Provinsi') {
        url = "select-province";
        $('#target_video_promosi').val(1);
        $('#pagu_promosi-alert').show();
        $('#target_video_promosi-alert').show();
      } else if (type_daerah == 'Kabupaten') {
        url = "select-kabupaten";
        $('#target_video_promosi').val(0);
        $('#pagu_promosi-alert').hide();
        $('#target_video_promosi-alert').hide();
      } else {
        url = "";
        $('#target_video_promosi').val(0);
        $('#pagu_promosi-alert').hide();
        $('#target_video_promosi-alert').hide();
        $('#daerah_id').val("").trigger("change").prop('disabled', true);
      }
      $.ajax({
        url: BASE_URL + '/api/' + url,
        method: 'get',
        dataType: 'json',
        success: function(data) {
          console.log(data);
          jenis = '<option value="">- Pilih -</option>';
          $.each(data, function(key, val) {
            jenis += '<option value="' + val.value + '">' + val.text + '</option>';
          });
          $('#daerah_id').html(jenis).removeAttr('disabled');
        }
      })
      $('.select-daerah').select2();
    })

    $('#periode_id').on('change', function() {
      let periode = $('#periode_id').val();
      if (periode > 2023) {
        $('#judulPaguPromosi').html('Pagu Peta Potensi')
        $('#judulTargetPromosi').html('Target Peta Potensi')
      } else {
        $('#judulPaguPromosi').html('Pagu Promosi')
        $('#judulTargetPromosi').html('Target Video Promosi')
      }
    })



    $('.select-daerah').on('select2:select', function(e) {
      var selectedOption = e.params.data;
      $('#daerah_id').val(selectedOption.id);
      $('#nama_daerah').val(selectedOption.text);
    });


    $('.select-periode').select2(
      $.ajax({
        url: BASE_URL + '/api/select-periode?type=POST&action=pagu',
        method: 'get',
        dataType: 'json',
        success: function(data) {
          periode = '<option value="">- Pilih -</option>';
          $.each(data.result, function(key, val) {
            periode += '<option value="' + val.value + '" >' + val.text + '</option>';

          });
          $('#periode_id').html(periode);
        }
      })
    );


    $("#simpan").click(() => {
      // alert(id);
      var data = $("#FormSubmit").serializeArray();
      var form = [
        'periode_id',
        'daerah_id',
        'nama_daerah',
        'pagu_promosi',
        'type_daerah',
        'pagu_pengawasan',
        'pagu_penyelesaian_permasalahan',
        'pagu_bimbingan_teknis',
        'target_pengawasan',
        'target_penyelesaian_permasalahan',
        'target_bimbingan_teknis',
        'target_video_promosi'
      ];
      $('#progressModal').show();
      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/pagutarget',
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
              hasil_sum();
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

  });
</script>