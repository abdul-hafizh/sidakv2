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
                  <a href="#" class="text-bold text-profile" id="modal-profile" data-target="Profile" style="margin-left: 5px"><small>(Tampilkan Profile)</small></a>
                  <input type="file" class="form-control" name="lap_profile" id="AddFilesProfile" accept=".pdf">
                  <div id="ShowPdfProfile" style="margin-top:8px"></div>
                  <span id="file-profile-alert-messages"></span>
                  <small class="text-red">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
                  <div class="modal fade" id="pdfProfile" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">File PDF Profile Pelaku Usaha</h5>
                        </div>
                        <div class="modal-body">
                            <iframe id="frameProfile" src="" frameborder="0" width="100%" height="500"></iframe>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div> 
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>

          <div id="tab_penyelesaian">
            <div class="row">
              <div id="lap_peserta-alert" class="form-group has-feedback col-md-12">
                <label>Daftar Hadir </label>
                <a href="#" class="text-bold text-peserta" id="modal-peserta" data-target="Peserta" style="margin-left: 5px"><small>(Tampilkan Daftar Hadir)</small></a>
                <input type="file" class="form-control" name="lap_peserta" id="AddFilesPeserta" accept=".pdf">
                <div id="ShowPdfPeserta" style="margin-top:8px"></div>
                <span id="file-peserta-alert-messages"></span>                
                <div class="modal fade" id="pdfPeserta" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">File PDF Daftar Hadir</h5>
                      </div>
                      <div class="modal-body">
                          <iframe id="framePeserta" src="" frameborder="0" width="100%" height="500"></iframe>
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div id="lap_profile2-alert" class="form-group has-feedback col-md-12">
                <label>Profile Pelaku Usaha </label>
                <a href="#" class="text-bold text-profile2" id="modal-profile2" data-target="Profile2" style="margin-left: 5px"><small>(Tampilkan Profile)</small></a>
                <input type="file" class="form-control" name="lap_profile2" id="AddFilesProfile2" accept=".pdf">
                <div id="ShowPdfProfile2" style="margin-top:8px"></div>
                <span id="file-profile2-alert-messages"></span>
                <div class="modal fade" id="pdfProfile2" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">File PDF Profile Pelaku Usaha</h5>
                      </div>
                      <div class="modal-body">
                          <iframe id="frameProfile2" src="" frameborder="0" width="100%" height="500"></iframe>
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div id="lap_narasumber-alert" class="form-group has-feedback col-md-12">
                <label>Daftar Narasumber </label>
                <a href="#" class="text-bold text-narasumber" id="modal-narasumber" data-target="Narasumber" style="margin-left: 5px"><small>(Tampilkan Narasumber)</small></a>
                <input type="file" class="form-control" name="lap_narasumber" id="AddFilesNarasumber" accept=".pdf">
                <div id="ShowPdfNarasumber" style="margin-top:8px"></div>
                <span id="file-narasumber-alert-messages"></span>
                <div class="modal fade" id="pdfNarasumber" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">File PDF Narasumber</h5>
                      </div>
                      <div class="modal-body">
                        <iframe id="frameNarasumber" src="" frameborder="0" width="100%" height="500"></iframe>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div id="notula2-alert" class="form-group has-feedback col-md-12">
                <label>Notula Kegiatan </label>
                <a href="#" class="text-bold text-notula2" id="modal-notula2" data-target="Notula2" style="margin-left: 5px"><small>(Tampilkan Notula)</small></a>
                <input type="file" class="form-control" name="lap_notula2" id="AddFilesNotula2" accept=".pdf">
                <div id="ShowPdfNotula2" style="margin-top:8px"></div>
                <span id="file-notula2-alert-messages"></span>
                <div class="modal fade" id="pdfNotula2" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">File PDF Notula</h5>
                      </div>
                      <div class="modal-body">
                          <iframe id="frameNotula2" src="" frameborder="0" width="100%" height="500"></iframe>
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div id="lap_lkpm-alert" class="form-group has-feedback col-md-12">
                <label>Laporan LKPM </label>
                <a href="#" class="text-bold text-lkpm" id="modal-lkpm" data-target="Lkpm" style="margin-left: 5px"><small>(Tampilkan LKPM)</small></a>
                <input type="file" class="form-control" name="lap_lkpm" id="AddFilesLkpm" accept=".pdf">
                <div id="ShowPdfLkpm" style="margin-top:8px"></div>
                <span id="file-lkpm-alert-messages"></span>
                <div class="modal fade" id="pdfLkpm" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">File PDF LKPM</h5>
                      </div>
                      <div class="modal-body">
                          <iframe id="frameLkpm" src="" frameborder="0" width="100%" height="500"></iframe>
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div id="lap_document-alert" class="form-group has-feedback col-md-12">
                <label>Laporan Dokumentasi </label>
                <a href="#" class="text-bold text-doc" id="modal-doc" data-target="Doc" style="margin-left: 5px"><small>(Tampilkan Dokumentasi)</small></a>
                <input type="file" class="form-control" name="lap_document" id="AddFilesDoc" accept=".pdf">
                <div id="ShowPdfDoc" style="margin-top:8px"></div>
                <span id="file-doc-alert-messages"></span>
                <small class="text-red">*semua file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
                <div class="modal fade" id="pdfDoc" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">File PDF Dokumentasi</h5>
                      </div>
                      <div class="modal-body">
                          <iframe id="frameDoc" src="" frameborder="0" width="100%" height="500"></iframe>
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="tab_evaluasi">
            <div class="row">
              <div id="notula-alert" class="form-group has-feedback col-md-12">
                  <label>Notula Rapat </label>
                  <a href="#" class="text-bold text-notula" id="modal-notula" data-target="Notula" style="margin-left: 5px"><small>(Tampilkan File Notula)</small></a>
                  <input type="file" class="form-control" name="lap_notula" id="AddFilesNotula" accept=".pdf">
                  <div id="ShowPdfNotula" style="margin-top:8px"></div>
                  <span id="file-notula-alert-messages"></span>                  
                  <div class="modal fade" id="pdfNotula" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">File PDF Notula</h5>
                        </div>
                        <div class="modal-body">
                            <iframe id="frameNotula" src="" frameborder="0" width="100%" height="500"></iframe>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div> 
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="row">
              <div id="lap_evaluasi-alert" class="form-group has-feedback col-md-12">
                  <label>Laporan Hasil Evaluasi </label>
                  <a href="#" class="text-bold text-eval" id="modal-eval" data-target="Evaluasi" style="margin-left: 5px"><small>(Tampilkan File Evaluasi)</small></a>
                  <input type="file" class="form-control" name="lap_evaluasi" id="AddFilesEvaluasi" accept=".pdf">
                  <div id="ShowPdfEvaluasi" style="margin-top:8px"></div>
                  <span id="file-evaluasi-alert-messages"></span>
                  <small class="text-red">*semua file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
                  <div class="modal fade" id="pdfEvaluasi" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">File PDF Evaluasi</h5>
                        </div>
                        <div class="modal-body">
                            <iframe id="frameEvaluasi" src="" frameborder="0" width="100%" height="500"></iframe>
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div> 
                      </div>
                    </div>
                  </div>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Log Data</h4>
      </div>

      <div class="modal-body" style="height: 500px; overflow-y: auto;">        
        <div class="row">
          <div class="card-body table-responsive">
            <table id="dataLog" class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kegiatan</th>
                  <th>Sub Kegiatan</th>
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
        success: function(data_ext) {
          if (data_ext.checklist != 'approved') {
            $('#simpan').hide();
            Swal.fire({
              title: 'Waktu Pengisian Sudah Habis.',
              text: 'Periksa kembali jadwal input data.',
              icon: 'error',
              confirmButtonText: 'OK'
  
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.replace('/penyelesaian');
              }
            });
          }
        },
        error: function() {
          alert('Gagal mengambil data.');
        }
      })      

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
          
          var data_file = {
            peserta: data.lap_peserta,
            profile: data.lap_profile,
            profile2: data.lap_profile2,
            notula: data.lap_notula, 
            notula2: data.lap_notula2,
            narasumber: data.lap_narasumber,
            lkpm: data.lap_lkpm,
            doc: data.lap_document,
            eval: data.lap_evaluasi 
          };

          $.each(data_file, function (key, value) {            
            if (value && value.length > 0) {
              $('.text-' + key).show();
            }
          });

          $('#modal-peserta').click(function() {
            tampilkanModalPdf(data.lap_peserta, 'Peserta');
          });

          $('#modal-profile').click(function() {
            tampilkanModalPdf(data.lap_profile, 'Profile');
          });

          $('#modal-profile2').click(function() {
            tampilkanModalPdf(data.lap_profile, 'Profile2');
          });

          $('#modal-narasumber').click(function() {
            tampilkanModalPdf(data.lap_narasumber, 'Narasumber');
          });

          $('#modal-notula').click(function() {
            tampilkanModalPdf(data.lap_notula, 'Notula');
          });

          $('#modal-notula2').click(function() {
            tampilkanModalPdf(data.lap_notula, 'Notula2');
          });

          $('#modal-lkpm').click(function() {
            tampilkanModalPdf(data.lap_lkpm, 'Lkpm');
          });

          $('#modal-doc').click(function() {
            tampilkanModalPdf(data.lap_document, 'Doc');
          });

          $('#modal-eval').click(function() {
            tampilkanModalPdf(data.lap_evaluasi, 'Evaluasi');
          });

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

      function tampilkanModalPdf(url, textId) {
        $.ajax({
            url: BASE_URL + '/' + url,
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            async: true,
            success: function(data) {
                var blobUrl = URL.createObjectURL(data);
                $('#frame' + textId).attr('src', blobUrl);
                $('#pdf' + textId).modal('show');
            },
            error: function() {
                alert('Gagal mengambil file PDF.');
            }
        });
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
          var row = '<tr>' +
            '<td>' + (index + 1) + '</td>' +
            '<td>' + val.nama_kegiatan + '</td>' +
            '<td>' + val.sub_menu + '</td>' +
            '<td>' + val.alasan_request + '</td>' +
            '<td>' + val.created_by + '</td>' +
            '<td>' + val.created_at + '</td>' +
            '</tr>';

          tableBody.append(row);
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
                  ros_profile +=`<a href="#" id="GetModalPdfProfile" data-param_id="`+file_pdf_profile+`" data-toggle="modal" data-target="#modal-show-profile" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF">Lihat File Profile</a>`;
                  ros_profile +=`<div id="modal-show-profile" class="modal fade" role="dialog">`;
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

    $("#AddFilesProfile2").change((event)=> {
        const files_profile2 = event.target.files
        let filename_profile2 = files_profile2[0].name
        const fileReaderProfile2 = new FileReader()
        fileReaderProfile2.addEventListener('load', () => {
          if(files_profile2[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_profile2 = fileReaderProfile2.result;
            
            var ros_profile2 = '';
                  ros_profile2 +=`<a href="#" id="GetModalPdfProfile2" data-param_id="`+file_pdf_profile2+`" data-toggle="modal" data-target="#modal-show-profile2" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF">Lihat File Profile</a>`;
                  ros_profile2 +=`<div id="modal-show-profile2" class="modal fade" role="dialog">`;
                      ros_profile2 +=`<div id="ViewProfile2PDF"></div>`;
                  ros_profile2 +=`</div>`;

            $('#ShowPdfProfile2').html(ros_profile2);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderProfile2.readAsDataURL(files_profile2[0])

    });

    $("#AddFilesNarasumber").change((event)=> {
        const files_narasumber = event.target.files
        let filename_narasumber = files_narasumber[0].name
        const fileReaderNarasumber = new FileReader()
        fileReaderNarasumber.addEventListener('load', () => {
          if(files_narasumber[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_narasumber = fileReaderNarasumber.result;
            
            var ros_narasumber = '';
              ros_narasumber +=`<a href="#" id="GetModalPdfNarasumber" data-param_id="`+file_pdf_narasumber+`" data-toggle="modal" data-target="#modal-show-narasumber" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF">Lihat File Narasumber</a>`;
                  ros_narasumber +=`<div id="modal-show-narasumber" class="modal fade" role="dialog">`;
                      ros_narasumber +=`<div id="ViewNarasumberPDF"></div>`;
                  ros_narasumber +=`</div>`;

            $('#ShowPdfNarasumber').html(ros_narasumber);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderNarasumber.readAsDataURL(files_narasumber[0])

    });

    $("#AddFilesPeserta").change((event)=> {
        const files_peserta = event.target.files
        let filename_peserta = files_peserta[0].name
        const fileReaderPeserta = new FileReader()
        fileReaderPeserta.addEventListener('load', () => {
          if(files_peserta[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_peserta = fileReaderPeserta.result;
            
            var ros_profile = '';
                  ros_profile +=`<a href="#" id="GetModalPdfPeserta" data-param_id="`+file_pdf_peserta+`" data-toggle="modal" data-target="#modal-show-peserta" data-toggle="tooltip" data-placement="top" title="Lihat Data PDF">Lihat File Peserta</a>`;
                  ros_profile +=`<div id="modal-show-peserta" class="modal fade" role="dialog">`;
                      ros_profile +=`<div id="ViewPesertaPDF"></div>`;
                  ros_profile +=`</div>`;

            $('#ShowPdfPeserta').html(ros_profile);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderPeserta.readAsDataURL(files_peserta[0])

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
                  ros_not +=`<a href="#" id="GetModalPdfNotula" data-param_id="`+file_pdf_notula+`" data-toggle="modal" data-target="#modal-show-notula" data-toggle="tooltip" data-placement="top" title="Lihat File PDF">Lihat File Notula</a>`;
                  ros_not +=`<div id="modal-show-notula" class="modal fade" role="dialog">`;
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

    $("#AddFilesNotula2").change((event)=> {
        const files_notula2 = event.target.files
        let filename_notula2 = files_notula2[0].name
        const fileReaderNotula2 = new FileReader()
        fileReaderNotula2.addEventListener('load', () => {
          if(files_notula2[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_notula2 = fileReaderNotula2.result;
            
            var ros_not2 = '';
                  ros_not2 +=`<a href="#" id="GetModalPdfNotula2" data-param_id="`+file_pdf_notula2+`" data-toggle="modal" data-target="#modal-show-notula2" data-toggle="tooltip" data-placement="top" title="Lihat File PDF">Lihat File Notula</a>`;
                  ros_not2 +=`<div id="modal-show-notula2" class="modal fade" role="dialog">`;
                      ros_not2 +=`<div id="ViewNotula2PDF"></div>`;
                  ros_not2 +=`</div>`;

            $('#ShowPdfNotula2').html(ros_not2);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderNotula2.readAsDataURL(files_notula2[0])

    });

    $("#AddFilesLkpm").change((event)=> {
        const files_lkpm = event.target.files
        let filename_lkpm = files_lkpm[0].name
        const fileReaderLkpm = new FileReader()
        fileReaderLkpm.addEventListener('load', () => {
          if(files_lkpm[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_lkpm = fileReaderLkpm.result;
            
            var ros_lkpm = '';
                  ros_lkpm +=`<a href="#" id="GetModalPdfLkpm" data-param_id="`+file_pdf_lkpm+`" data-toggle="modal" data-target="#modal-show-lkpm" data-toggle="tooltip" data-placement="top" title="Lihat File PDF">Lihat File LKPM</a>`;
                  ros_lkpm +=`<div id="modal-show-lkpm" class="modal fade" role="dialog">`;
                      ros_lkpm +=`<div id="ViewLkpmPDF"></div>`;
                  ros_lkpm +=`</div>`;

            $('#ShowPdfLkpm').html(ros_lkpm);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderLkpm.readAsDataURL(files_lkpm[0])

    });

    $("#AddFilesDoc").change((event)=> {
        const files_doc = event.target.files
        let filename_doc = files_doc[0].name
        const fileReaderDoc = new FileReader()
        fileReaderDoc.addEventListener('load', () => {
          if(files_doc[0].name.toUpperCase().includes(".PDF"))
          {
            file_pdf_doc = fileReaderDoc.result;
            
            var ros_doc = '';
                  ros_doc +=`<a href="#" id="GetModalPdfDoc" data-param_id="`+file_pdf_doc+`" data-toggle="modal" data-target="#modal-show-doc" data-toggle="tooltip" data-placement="top" title="Lihat File PDF">Lihat File Dokumen</a>`;
                  ros_doc +=`<div id="modal-show-doc" class="modal fade" role="dialog">`;
                      ros_doc +=`<div id="ViewDocPDF"></div>`;
                  ros_doc +=`</div>`;

            $('#ShowPdfDoc').html(ros_doc);
          } else {
              Swal.fire({
                    icon: 'info',
                    title: 'Hanya File PDF Yang Diizinkan.',
                    confirmButtonColor: '#000',
                    confirmButtonText: 'OK'
              });  
          }
        })

        fileReaderDoc.readAsDataURL(files_doc[0])

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
                  ros_eval +=`<a href="#" id="GetModalPdfEvaluasi" data-param_id="`+file_pdf_eval+`" data-toggle="modal" data-target="#modal-show-eval" data-toggle="tooltip" data-placement="top" title="Lihat File PDF">Lihat File Evaluasi</a>`;
                  ros_eval +=`<div id="modal-show-eval" class="modal fade" role="dialog">`;
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

    $("#ShowPdfPeserta").on("click", "#GetModalPdfPeserta", (e) => {
        let file_peserta = e.currentTarget.dataset.param_id;      
        let row_peserta = ``;
          row_peserta +=`<div class="modal-dialog">`;
              row_peserta +=`<div class="modal-content">`;
                  row_peserta +=`<div class="modal-header">`;
                        row_peserta +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_peserta +=`<h4 class="modal-title">Lihat File Daftar Hadir</h4>`;
                  row_peserta +=`</div>`;   
                  row_peserta +=`<div class="modal-body">`; 
                  if(file_peserta)
                  {  
                    row_peserta +=`<embed src="`+file_peserta+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_peserta +=`</div>`;   
                  row_peserta +=`<div class="modal-footer">`;
                        row_peserta +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_peserta +=`</div>`;             
              row_peserta +=`</div>`;
        row_peserta +=`</div>`; 

        $('#ViewPesertaPDF').html(row_peserta);   

    });

    $("#ShowPdfProfile").on("click", "#GetModalPdfProfile", (e) => {
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

    $("#ShowPdfProfile2").on("click", "#GetModalPdfProfile2", (e) => {
        let file_profile2 = e.currentTarget.dataset.param_id;      
        let row_profile2 = ``;
          row_profile2 +=`<div class="modal-dialog">`;
              row_profile2 +=`<div class="modal-content">`;
                  row_profile2 +=`<div class="modal-header">`;
                        row_profile2 +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_profile2 +=`<h4 class="modal-title">Lihat File Profile</h4>`;
                  row_profile2 +=`</div>`;   
                  row_profile2 +=`<div class="modal-body">`; 
                  if(file_profile2)
                  {  
                    row_profile2 +=`<embed src="`+file_profile2+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_profile2 +=`</div>`;   
                  row_profile2 +=`<div class="modal-footer">`;
                        row_profile2 +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_profile2 +=`</div>`;             
              row_profile2 +=`</div>`;
        row_profile2 +=`</div>`; 

        $('#ViewProfile2PDF').html(row_profile2);   

    });

    $("#ShowPdfNarasumber").on("click", "#GetModalPdfNarasumber", (e) => {
        let file_nara = e.currentTarget.dataset.param_id;      
        let row_nara = ``;
          row_nara +=`<div class="modal-dialog">`;
              row_nara +=`<div class="modal-content">`;
                  row_nara +=`<div class="modal-header">`;
                        row_nara +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_nara +=`<h4 class="modal-title">Lihat File Narasumber</h4>`;
                  row_nara +=`</div>`;   
                  row_nara +=`<div class="modal-body">`; 
                  if(file_nara)
                  {  
                    row_nara +=`<embed src="`+file_nara+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_nara +=`</div>`;   
                  row_nara +=`<div class="modal-footer">`;
                        row_nara +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_nara +=`</div>`;             
              row_nara +=`</div>`;
        row_nara +=`</div>`; 

        $('#ViewNarasumberPDF').html(row_nara);   

    });

    $("#ShowPdfNotula").on("click", "#GetModalPdfNotula", (e) => {
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

    $("#ShowPdfNotula2").on("click", "#GetModalPdfNotula2", (e) => {
        let file_notula2 = e.currentTarget.dataset.param_id;      
        let row_notula2 = ``;
          row_notula2 +=`<div class="modal-dialog">`;
              row_notula2 +=`<div class="modal-content">`;
                  row_notula2 +=`<div class="modal-header">`;
                        row_notula2 +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_notula2 +=`<h4 class="modal-title">Lihat File Notula</h4>`;
                  row_notula2 +=`</div>`;   
                  row_notula2 +=`<div class="modal-body">`; 
                  if(file_notula2)
                  {  
                    row_notula2 +=`<embed src="`+file_notula2+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_notula2 +=`</div>`;   
                  row_notula2 +=`<div class="modal-footer">`;
                        row_notula2 +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_notula2 +=`</div>`;             
              row_notula2 +=`</div>`;
        row_notula2 +=`</div>`; 

        $('#ViewNotula2PDF').html(row_notula2);   

    });

    $("#ShowPdfLkpm").on("click", "#GetModalPdfLkpm", (e) => {
        let file_lkpm = e.currentTarget.dataset.param_id;      
        let row_lkpm = ``;
          row_lkpm +=`<div class="modal-dialog">`;
              row_lkpm +=`<div class="modal-content">`;
                  row_lkpm +=`<div class="modal-header">`;
                        row_lkpm +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_lkpm +=`<h4 class="modal-title">Lihat File LKPM</h4>`;
                  row_lkpm +=`</div>`;   
                  row_lkpm +=`<div class="modal-body">`; 
                  if(file_lkpm)
                  {  
                    row_lkpm +=`<embed src="`+file_lkpm+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_lkpm +=`</div>`;   
                  row_lkpm +=`<div class="modal-footer">`;
                        row_lkpm +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_lkpm +=`</div>`;             
              row_lkpm +=`</div>`;
        row_lkpm +=`</div>`; 

        $('#ViewLkpmPDF').html(row_lkpm);   

    });

    $("#ShowPdfDoc").on("click", "#GetModalPdfDoc", (e) => {
        let file_doc = e.currentTarget.dataset.param_id;      
        let row_doc = ``;
          row_doc +=`<div class="modal-dialog">`;
              row_doc +=`<div class="modal-content">`;
                  row_doc +=`<div class="modal-header">`;
                        row_doc +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
                        row_doc +=`<h4 class="modal-title">Lihat File Dokumen</h4>`;
                  row_doc +=`</div>`;   
                  row_doc +=`<div class="modal-body">`; 
                  if(file_doc)
                  {  
                    row_doc +=`<embed src="`+file_doc+`#page=1&zoom=65" width="575" height="500">`;
                  }     
                  row_doc +=`</div>`;   
                  row_doc +=`<div class="modal-footer">`;
                        row_doc +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
                  row_doc +=`</div>`;             
              row_doc +=`</div>`;
        row_doc +=`</div>`; 

        $('#ViewDocPDF').html(row_doc);   

    });

    $("#ShowPdfEvaluasi").on("click", "#GetModalPdfEvaluasi", (e) => {
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