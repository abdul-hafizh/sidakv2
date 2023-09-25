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
            <div id="pagu_apbn-alert" class="form-group has-feedback col-md-12">
              <label>Pagu APBN</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="pagu_apbn" id="pagu_apbn" placeholder="APBN" value="">
              <span id="pagu_apbn-messages"></span>
            </div>
            <div id="pagu_promosi-alert" class="form-group has-feedback col-md-12" style="display: none;">
              <label>Pagu Promosi</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="pagu_promosi" id="pagu_promosi" placeholder="Promosi" value="">
              <span id="pagu_promosi-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="target_pengawasan-alert" class="form-group has-feedback col-md-12">
              <label>Target Pengawasan</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_pengawasan" id="target_pengawasan" placeholder="Pengawasan" value="">
              <span id="target_pengawasan-messages"></span>
            </div>
            <div id="target_penyelesaian_permasalahan-alert" class="form-group has-feedback col-md-12">
              <label>Target Penyelesaian Masalah</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_penyelesaian_permasalahan" id="target_penyelesaian_permasalahan" placeholder="Penyelesaian Masalah" value="">
              <span id="target_penyelesaian_permasalahan-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="target_bimbingan_teknis-alert" class="form-group has-feedback col-md-12">
              <label>Target Bimbingan Teknis</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_bimbingan_teknis" id="target_bimbingan_teknis" placeholder="Bimbingan Teknis" value="">
              <span id="target_bimbingan_teknis-messages"></span>
            </div>
            <div id="target_video_promosi-alert" class="form-group has-feedback col-md-12" style="display: none">
              <label>Target Video Promosi</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="target_video_promosi" id="target_video_promosi" placeholder="Video Promosi" value="" readonly>
              <span id="target_video_promosi-messages"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button id="simpan" type="button" class="btn btn-primary" style="display: none;">Simpan</button>
          <button id="update" type="button" class="btn btn-info" style="display: none;">Ubah</button>

        </div>
      </form>
    </div>

  </div>
</div>




<script type="text/javascript">
  $(function() {

    $('#tambah').on('click', function() {
      $('#judulModalLabel').html('Tambah Pagu Target')

      var form = [
        'periode_id',
        'daerah_id',
        'nama_daerah',
        'pagu_apbn',
        'pagu_promosi',
        'type_daerah',
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
          $('#pagu_apbn').val(data.pagu_apbn);
          $('#pagu_promosi').val(data.pagu_promosi);
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
          url: BASE_URL + '/api/select-periode2',
          method: 'get',
          dataType: 'json',
          success: function(data) {
            periode = '<option value="">- Pilih -</option>';
            $.each(data, function(key, val) {
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
          'pagu_apbn',
          'pagu_promosi',
          'type_daerah',
          'target_pengawasan',
          'target_penyelesaian_permasalahan',
          'target_bimbingan_teknis',
          'target_video_promosi'
        ];

        $.ajax({
          type: "PUT",
          url: BASE_URL + '/api/pagutarget/' + id,
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
                window.location.replace('/pagutarget');
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



    $('.select-daerah').on('select2:select', function(e) {
      var selectedOption = e.params.data;
      $('#daerah_id').val(selectedOption.id);
      $('#nama_daerah').val(selectedOption.text);
    });


    $('.select-periode').select2(
      $.ajax({
        url: BASE_URL + '/api/select-periode2',
        method: 'get',
        dataType: 'json',
        success: function(data) {
          periode = '<option value="">- Pilih -</option>';
          $.each(data, function(key, val) {
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
        'pagu_apbn',
        'pagu_promosi',
        'type_daerah',
        'target_pengawasan',
        'target_penyelesaian_permasalahan',
        'target_bimbingan_teknis',
        'target_video_promosi'
      ];

      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/pagutarget',
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
              window.location.replace('/pagutarget');
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
</script>