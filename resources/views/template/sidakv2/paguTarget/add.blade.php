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
            <div id="type_daerah-alert" class="form-group has-feedback col-md-6">
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
            <div id="daerah_id-alert" class="form-group has-feedback col-md-6">
              <label>Daerah </label>
              <select id="daerah_id" class="select-daerah form-control" name="daerah_id" disabled>
                <option value="">Pilih</option>
              </select>
              <span id="daerah_id-messages"></span>
              <input type="hidden" class="form-control" name="nama_daerah" id="nama_daerah" placeholder="APBN" value="">
            </div>

          </div>
          <div class="row">
            <div id="periode_id-alert" class="form-group has-feedback col-md-6">
              <label>Periode </label>
              <select id="periode_id" class="select-periode form-control" name="periode_id"></select>
              <span id="periode_id-messages"></span>
            </div>
          </div>

          <div class="row">
            <div id="pagu_apbn-alert" class="form-group has-feedback col-md-6">
              <label>Pagu APBN</label>
              <input type="text" class="form-control" name="pagu_apbn" placeholder="APBN" value="">
              <span id="pagu_apbn-messages"></span>
            </div>
            <div id="pagu_promosi-alert" class="form-group has-feedback col-md-6">
              <label>Pagu Promosi</label>
              <input type="text" class="form-control" name="pagu_promosi" placeholder="Promosi" value="">
              <span id="pagu_promosi-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="target_pengawasan-alert" class="form-group has-feedback col-md-6">
              <label>Target Pengawasan</label>
              <input type="text" class="form-control" name="target_pengawasan" placeholder="Pengawasan" value="">
              <span id="target_pengawasan-messages"></span>
            </div>
            <div id="target_penyelesaian_permasalahan-alert" class="form-group has-feedback col-md-6">
              <label>Target Penyelesaian Masalah</label>
              <input type="text" class="form-control" name="target_penyelesaian_permasalahan" placeholder="Penyelesaian Masalah" value="">
              <span id="target_penyelesaian_permasalahan-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="target_bimbingan_teknis-alert" class="form-group has-feedback col-md-6">
              <label>Target Bimbingan Teknis</label>
              <input type="text" class="form-control" name="target_bimbingan_teknis" placeholder="Bimbingan Teknis" value="">
              <span id="target_bimbingan_teknis-messages"></span>
            </div>
            <div id="target_video_promosi-alert" class="form-group has-feedback col-md-6">
              <label>Target Video Promosi</label>
              <input type="text" class="form-control" name="target_video_promosi" placeholder="Video Promosi" value="">
              <span id="target_video_promosi-messages"></span>
            </div>
          </div>
          <div class="row">
            <div id="pagu_dalak-alert" class="form-group has-feedback col-md-6">
              <label>Pagu Dalak</label>
              <input type="text" class="form-control" name="pagu_dalak" placeholder="Dalak" value="">
              <span id="pagu_dalak-messages"></span>
            </div>
          </div>








        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="simpan" type="button" class="btn btn-primary">Simpan</button>

        </div>
      </form>
    </div>

  </div>
</div>




<script type="text/javascript">
  $(function() {

    $("#datatable").on("click", ".modalUbah", function() {
      $('#judulModalLabel').html('Form Ubah')
      $('.modal-footer button[type=submit]').html('Ubah Data');

      const id = $(this).data('param_id');
      $.ajax({
        url: BASE_URL + '/api/pagutarget/edit',
        data: {
          id: id
        },
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          $('#nama_daerah').val(data.nama_daerah);

        }

      })
    });

    $('#type_daerah').on('change', function() {
      let type_daerah = $('#type_daerah').val();
      if (type_daerah == 'Provinsi')
        url = "select-province";
      else
        url = "select-daerah2";
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
          $('#daerah_id').html(jenis).removeAttr('disabled');;
        }
      })
      $('.select-daerah').select2();
    })



    $('.select-daerah').on('select2:select', function(e) {
      var selectedOption = e.params.data;
      $('#daerah_id').val(selectedOption.id);
      $('#nama_daerah').val(selectedOption.text);
    });

    $('.select-periode').select2({
      ajax: {
        url: BASE_URL + '/api/select-periode', // URL to your server-side endpoint
        dataType: 'json',
        delay: 250, // Delay before sending the request (milliseconds)
        processResults: function(data) {

          // Transform the data to match Select2's expected format
          return {
            results: data.map(function(item) {
              return {
                id: item.value,
                text: item.text
              };
            })
          };
        },
        cache: true // Cache the results to improve performance
      }
    });

    $('.select-periode').on('select2:select', function(e) {
      var selectedOption = e.params.data;
      $('#periode_id').val(selectedOption.id);
    });

    $("#simpan").click(() => {
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
        'target_video_promosi',
        'pagu_dalak',
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