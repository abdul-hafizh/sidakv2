<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judulModalLabel">Tambah Pengawasan</h4>
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
              <label>Jenis Pengawasan</label>
              <input type="hidden" class="form-control" name="id_pengawasan" id="id_pengawasan" value="">
              <select class="form-control select-jenis" name="sub_menu_slug" id="sub_menu_slug">
                <option value="">-Pilih Tipe-</option>
                <option value="analisa">Analisa dan Verifikasi Data</option>
                <option value="inspeksi">Inspeksi Lapangan</option>
                <option value="evaluasi">Evaluasi Penilaian Kepatuhan Pelaksanaan Perizinan Berusaha</option>
              </select>
              <span id="sub_menu_slug-messages"></span>
            </div>
          </div>

          <div id="nama_kegiatan-alert" class="form-group has-feedback">
            <label>Nama Kegiatan</label>
            <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan" value="">
            <span id="nama_kegiatan-messages"></span>
          </div>

          <div id="hasil_analisa-alert" class="form-group has-feedback">
            <label id="hasilAnalisaLabel">Hasil Analisa</label>
            <textarea class="form-control" name="hasil_analisa" id="hasil_analisa" rows="4" placeholder="Hasil Analisa"></textarea>
            <span id="hasil_analisa-messages"></span>
          </div>

          <div id="tanggal_kegiatan-alert" class="form-group has-feedback">
            <label>Tanggal Kegiatan</label>
            <input type="date" class="form-control" name="tanggal_kegiatan" id="tanggal_kegiatan" placeholder="Tanggal Kegiatan">
            <span id="tanggal_kegiatan-messages"></span>
          </div>

          <div id="biaya-alert" class="form-group has-feedback">
            <label>Biaya (Rp.)</label>
            <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya Kegiatan" value="">
            <span id="biaya-messages"></span>
          </div>

          <div id="lokasi-alert" class="form-group has-feedback">
            <label>Lokasi Kegiatan</label>
            <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi Kegiatan" value="">
            <span id="lokasi-messages"></span>
          </div>

          <div class="is_analisa">
            <div id="lap_kegiatan-alert" class="form-group has-feedback">
              <label>Laporan</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_kegiatan" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Kegiatan)</small></a>
              <input type="hidden" class="form-control" name="lap_kegiatan_file" id="lap_kegiatan_file" value="">
              <input type="file" class="form-control file-access" name="lap_kegiatan" id="lap_kegiatan" accept=".pdf">
              <span id="lap_kegiatan-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
          </div>

          <div class="is_inspeksi">
            <input type="hidden" id="countArray" value="1">
            <table class="table table-hover text-nowrap" id="tablePerusahaan">
              <tbody id="tbody-row">
                <tr>
                  <td>
                    <label>Data Perusahaan</label>
                    <button type="button" class="btn btn-info" style="float: right;" id="btn-add-row"><i class="fa fa-plus"></i></button>
                    <table class="table table-hover text-nowrap">
                      <tr>
                        <td style="padding: 2px;">
                          <div id="nib_0-alert" class="has-feedback">
                            <input type="text" class="form-control" name="nib[0]" placeholder="Nomor Induk Berusaha" value="">
                            <span id="nib_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="tgl_nib_0-alert" class=" has-feedback">
                            <input type="date" class="form-control" name="tgl_nib[0]" placeholder="Tanggal NIB">
                            <span id="tgl_nib_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" style="padding: 2px;">
                          <div id="nama_perusahaan_0-alert" class=" has-feedback">
                            <input type="text" class="form-control" name="nama_perusahaan[0]" placeholder="Nama Perusahaan" value="">
                            <span id="nama_perusahaan_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" style="padding: 2px;">
                          <div id="kontak_0-alert" class=" has-feedback">
                            <input type="text" class="form-control" name="kontak[0]" placeholder="Kontak" value="">
                            <span id="kontak_0-messages"></span>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2" style="padding: 2px;">
                          <label>Perizinan</label>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="no_izin_lokasi_0-alert" class=" has-feedback">
                            <input type="text" class="form-control" name="no_izin_lokasi[0]" placeholder="Nomor Izin Lokasi" value="">
                            <span id="no_izin_lokasi_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="tgl_izin_lokasi_0-alert" class=" has-feedback">
                            <input type="date" class="form-control" name="tgl_izin_lokasi[0]" placeholder="Tanggal Izin Lokasi">
                            <span id="tgl_izin_lokasi_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="no_izin_amdal_0-alert" class=" has-feedback">
                            <input type="text" class="form-control" name="no_izin_amdal[0]" placeholder="Nomor Izin Amdal" value="">
                            <span id="no_izin_amdal_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="tgl_izin_amdal_0-alert" class=" has-feedback">
                            <input type="date" class="form-control" name="tgl_izin_amdal[0]" placeholder="Tanggal Izin Amdal">
                            <span id="tgl_izin_amdal_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="no_izin_lingkungan_0-alert" class=" has-feedback">
                            <input type="text" class="form-control" name="no_izin_lingkungan[0]" placeholder="Nomor Izin Lingkungan" value="">
                            <span id="no_izin_lingkungan_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="tgl_izin_lingkungan_0-alert" class=" has-feedback">
                            <input type="date" class="form-control" name="tgl_izin_lingkungan[0]" placeholder="Tanggal Izin Lingkungan">
                            <span id="tgl_izin_lingkungan_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="no_imb_0-alert" class=" has-feedback">
                            <input type="text" class="form-control" name="no_imb[0]" placeholder="Nomor IMB" value="">
                            <span id="no_imb_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="tgl_imb_0-alert" class=" has-feedback">
                            <input type="date" class="form-control" name="tgl_imb[0]" placeholder="Tanggal IMB">
                            <span id="tgl_imb_0-messages"></span>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2" style="padding: 2px;">
                          <label>Investasi dan Tenaga Kerja</label>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="total_rencana_inv_0-alert" class=" has-feedback">
                            <input type="number" class="form-control" name="total_rencana_inv[0]" placeholder="Total Rencana Inventaris" value="">
                            <span id="total_rencana_inv_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="total_realisasi_inv_0-alert" class=" has-feedback">
                            <input type="number" class="form-control" name="total_realisasi_inv[0]" placeholder="Total Realisasi Inventaris">
                            <span id="total_realisasi_inv_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="rencana_tki_0-alert" class=" has-feedback">
                            <input type="number" class="form-control" name="rencana_tki[0]" placeholder="Total Rencana TKI" value="">
                            <span id="rencana_tki_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="realisasi_tki_0-alert" class=" has-feedback">
                            <input type="number" class="form-control" name="realisasi_tki[0]" placeholder="Total Realisasi TKI">
                            <span id="realisasi_tki_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="rencana_tka_0-alert" class=" has-feedback">
                            <input type="number" class="form-control" name="rencana_tka[0]" placeholder="Total Rencana TKA" value="">
                            <span id="rencana_tka_0-messages"></span>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="realisasi_tka_0-alert" class=" has-feedback">
                            <input type="number" class="form-control" name="realisasi_tka[0]" placeholder="Total Realisasi TKA">
                            <span id="realisasi_tka_0-messages"></span>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>

            <div id="lap_bap-alert" class="form-group has-feedback">
              <label>Laporan BAP Pengawasan</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_bap" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan BAP Pengawasan)</small></a>
              <input type="hidden" class="form-control" name="lap_bap_file" id="lap_bap_file" value="">
              <input type="file" class="form-control file-access" name="lap_bap" id="lap_bap" accept=".pdf">
              <span id="lap_bap-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
            <div id="lap_bap-alert" class="form-group has-feedback">
              <label>Laporan LKPM</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_lkpm" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan LKPM)</small></a>
              <input type="hidden" class="form-control" name="lap_lkpm_file" id="lap_lkpm_file" value="">
              <input type="file" class="form-control file-access" name="lap_lkpm" id="lap_lkpm" accept=".pdf">
              <span id="lap_lkpm-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
            <div id="lap_bap-alert" class="form-group has-feedback">
              <label>Laporan Kepatuhan Pelaku Usaha</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_evaluasi" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Kepatuhan Pelaku Usaha)</small></a>
              <input type="hidden" class="form-control" name="lap_evaluasi_file" id="lap_evaluasi_file" value="">
              <input type="file" class="form-control file-access" name="lap_evaluasi" id="lap_evaluasi" accept=".pdf">
              <span id="lap_evaluasi-messages"></span>
              <small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>
            </div>
            <div id="lap_bap-alert" class="form-group has-feedback">
              <label>Laporan Profile</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_profile" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Profile)</small></a>
              <input type="hidden" class="form-control" name="lap_profile_file" id="lap_profile_file" value="">
              <input type="file" class="form-control file-access" name="lap_profile" id="lap_profile" accept=".pdf">
              <span id="lap_profile-messages"></span>
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

<script type="template" id="template-row-product">
  <tr>
    <td>
      <label>Data Perusahaan</label>
      <button class="btn btn-danger btn-sm" type="button" style="float: right;" onclick="if($('#tbody-row tr').length > 1) { $(this).closest('tr').remove() }"><i class="fa fa-trash"></i></button>
      <table class="table table-hover text-nowrap">
        <tr>
          <td style="padding: 2px;">
            <div id="nib_countArraynyaDigantiNanti-alert" class="has-feedback">
              <input type="text" class="form-control" name="nib[countArraynyaDigantiNanti]" placeholder="Nomor Induk Berusaha" value="">
              <span id="nib_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="tgl_nib_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="date" class="form-control" name="tgl_nib[countArraynyaDigantiNanti]" placeholder="Tanggal NIB">
              <span id="tgl_nib_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 2px;">
            <div id="nama_perusahaan_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="nama_perusahaan[countArraynyaDigantiNanti]" placeholder="Nama Perusahaan" value="">
              <span id="nama_perusahaan_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 2px;">
            <div id="kontak_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="kontak[countArraynyaDigantiNanti]" placeholder="Kontak" value="">
              <span id="kontak_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 2px;">
            <label>Perizinan</label>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="no_izin_lokasi_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="no_izin_lokasi[countArraynyaDigantiNanti]" placeholder="Nomor Izin Lokasi" value="">
              <span id="no_izin_lokasi_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="tgl_izin_lokasi_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="date" class="form-control" name="tgl_izin_lokasi[countArraynyaDigantiNanti]" placeholder="Tanggal Izin Lokasi">
              <span id="tgl_izin_lokasi_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="no_izin_amdal_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="no_izin_amdal[countArraynyaDigantiNanti]" placeholder="Nomor Izin Amdal" value="">
              <span id="no_izin_amdal_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="tgl_izin_amdal_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="date" class="form-control" name="tgl_izin_amdal[countArraynyaDigantiNanti]" placeholder="Tanggal Izin Amdal">
              <span id="tgl_izin_amdal_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="no_izin_lingkungan_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="no_izin_lingkungan[countArraynyaDigantiNanti]" placeholder="Nomor Izin Lingkungan" value="">
              <span id="no_izin_lingkungan_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="tgl_izin_lingkungan_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="date" class="form-control" name="tgl_izin_lingkungan[countArraynyaDigantiNanti]" placeholder="Tanggal Izin Lingkungan">
              <span id="tgl_izin_lingkungan_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="no_imb_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="no_imb[countArraynyaDigantiNanti]" placeholder="Nomor IMB" value="">
              <span id="no_imb_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="tgl_imb_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="date" class="form-control" name="tgl_imb[countArraynyaDigantiNanti]" placeholder="Tanggal IMB">
              <span id="tgl_imb_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="2" style="padding: 2px;">
            <label>Investasi dan Tenaga Kerja</label>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="total_rencana_inv_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="number" class="form-control" name="total_rencana_inv[countArraynyaDigantiNanti]" placeholder="Total Rencana Inventaris" value="">
              <span id="total_rencana_inv_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="total_realisasi_inv_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="number" class="form-control" name="total_realisasi_inv[countArraynyaDigantiNanti]" placeholder="Total Realisasi Inventaris">
              <span id="total_realisasi_inv_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="rencana_tki_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="number" class="form-control" name="rencana_tki[countArraynyaDigantiNanti]" placeholder="Total Rencana TKI" value="">
              <span id="rencana_tki_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="realisasi_tki_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="number" class="form-control" name="realisasi_tki[countArraynyaDigantiNanti]" placeholder="Total Realisasi TKI">
              <span id="realisasi_tki_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="rencana_tka_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="number" class="form-control" name="rencana_tka[countArraynyaDigantiNanti]" placeholder="Total Rencana TKA" value="">
              <span id="rencana_tka_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="realisasi_tka_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="number" class="form-control" name="realisasi_tka[countArraynyaDigantiNanti]" placeholder="Total Realisasi TKA">
              <span id="realisasi_tka_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  </script>
<script type="text/javascript">
  $(document).ready(function() {

    $(".is_inspeksi").hide();

    $('#sub_menu_slug').change(function() {
      var value = $(this).val();
      if (value == 'analisa') {
        $(".is_analisa").show();
        $(".is_inspeksi").hide();
        $("#hasil_analisa").attr('placeholder', 'Hasil Analisa');
        $('#hasilAnalisaLabel').text("Hasil Analisa")
      } else if (value == 'inspeksi') {
        $(".is_analisa").hide();
        $(".is_inspeksi").show();
        $("#hasil_analisa").attr('placeholder', 'Hasil Inspeksi');
        $('#hasilAnalisaLabel').text("Hasil Inspeksi")
      } else if (value == 'evaluasi') {
        $(".is_analisa").show();
        $(".is_inspeksi").hide();
        $("#hasil_analisa").attr('placeholder', 'Hasil Evaluasi');
        $('#hasilAnalisaLabel').text('Hasil Evaluasi');
      } else {
        $(".is_analisa").hide();
        $(".is_inspeksi").hide();
      }
    });

    $('#tambah').on('click', function() {
      $('#judulModalLabel').html('Tambah Data')
      $('.modal-add2').show();
      $('.modal-edit').hide();
      $('.text-profile').hide();
      $('.file-access').show();
      $('#alasan_req').hide();
      $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
      $('#FormSubmit select').removeAttr('disabled');
      var form = [
        'id_pengawasan',
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'hasil_analisa',
        'tanggal_kegiatan',
        'biaya',
        'lokasi',
        'lap_kegiatan'
      ];
      for (let i = 0; i < form.length; i++) {
        const field = form[i];
        $('#' + field).val('');
        $('#' + field + '-alert').removeClass('has-error');
        $('#' + field + '-messages').removeClass('help-block').html('');
      }
    })

    countArray = $("#countArray").val();

    $("#btn-add-row").on("click", function() {
      var row = $("#template-row-product").html();
      row = row.replace(/countArraynyaDigantiNanti/g, countArray);
      $row = $(row);
      console.log($row);

      countArray++;
      $("#tbody-row").append($row);
    });

    $('#simpan').on('click', function() {
      var formData = new FormData($('#FormSubmit')[0]);
      var form = [
        'id_pengawasan',
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'hasil_analisa',
        'tanggal_kegiatan',
        'biaya',
        'lokasi'
      ];
      formData.append("status", 13);
      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/pengawasan',
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
          Swal.fire({
            title: 'Sukses!',
            text: respons.message,
            icon: 'success',
            confirmButtonText: 'OK'

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
            confirmButtonText: 'OK'
          }).then((result) => {});
        }
      });
    });

    $("#datatable").on("click", ".modalUbah", function(e) {
      $('#judulModalLabel').html('Ubah Pengawasan');
      //  $('.modal-footer button[type=button]').html('Ubah Data');
      $('.modal-add2').hide();
      var form = [
        'id_pengawasan',
        'periode_id_mdl',
        'sub_menu_slug',
        'nama_kegiatan',
        'hasil_analisa',
        'tanggal_kegiatan',
        'biaya',
        'lokasi',
        'lap_kegiatan',
        'lap_evaluasi',
        'lap_lkpm',
        'lap_bap',
        'lap_profile'
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
        url: BASE_URL + '/api/pengawasan/edit/' + id,
        method: 'GET',
        success: function(data) {
          $('#id_pengawasan').val(data.id);
          $('#sub_menu_slug').val(data.sub_menu_slug);
          $('#nama_kegiatan').val(data.nama_kegiatan);
          $('#tanggal_kegiatan').val(data.tgl_kegiatan);
          $('#hasil_analisa').val(data.rencana_kegiatan);
          $('#biaya').val(data.biaya_kegiatan);
          $('#lokasi').val(data.lokasi_kegiatan);
          $('#is_skpd_sesuai').val(data.is_skpd_sesuai);
          $('.modal-edit').show();
          if (data.lap_kegiatan) {
            $('#modal-lap_kegiatan').show();
            $('#lap_kegiatan_file').val(data.lap_kegiatan);
            $('#modal-lap_kegiatan').click(function() {
              tampilkanModal(data.lap_kegiatan);
            });
          } else {
            $('#modal-lap_kegiatan').hide();
            $('#lap_kegiatan_file').val('');
          }
          if (data.lap_lkpm) {
            $('#modal-lap_lkpm').show();
            $('#lap_lkpm_file').val(data.lap_lkpm);
            $('#modal-lap_lkpm').click(function() {
              tampilkanModal(data.lap_lkpm);
            });
          } else {
            $('#modal-lap_lkpm').hide();
            $('#lap_lkpm_file').val('');
          }
          if (data.lap_evaluasi) {
            $('#modal-lap_evaluasi').show();
            $('#lap_evaluasi_file').val(data.lap_evaluasi);
            $('#modal-lap_evaluasi').click(function() {
              tampilkanModal(data.lap_evaluasi);
            });
          } else {
            $('#modal-lap_evaluasi').hide();
            $('#lap_evaluasi_file').val('');
          }
          if (data.lap_bap) {
            $('#modal-lap_bap').show();
            $('#lap_bap_file').val(data.lap_bap);
            $('#modal-lap_bap').click(function() {
              tampilkanModal(data.lap_bap);
            });
          } else {
            $('#modal-lap_bap').hide();
            $('#lap_bap_file').val('');
          }
          if (data.lap_profile) {
            $('#modal-lap_profile').show();
            $('#lap_profile_file').val(data.lap_profile);
            $('#modal-lap_profile').click(function() {
              tampilkanModal(data.lap_profile);
            });
          } else {
            $('#modal-lap_profile').hide();
            $('#lap_profile_file').val('');
          }


          getPeriode(data.periode_id);
          subMenu(data.sub_menu_slug);
          timpa();
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

      function timpa() {
        var test = 'asd'
        $('#tablePerusahaan').html(test);
      }

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

      function subMenu(sub_menu_slug) {
        if (sub_menu_slug == 'analisa') {
          $(".is_analisa").show();
          $(".is_inspeksi").hide();
          $("#hasil_analisa").attr('placeholder', 'Hasil Analisa');
          $('#hasilAnalisaLabel').text("Hasil Analisa");
        } else if (sub_menu_slug == 'inspeksi') {
          $(".is_analisa").hide();
          $(".is_inspeksi").show();
          $("#hasil_analisa").attr('placeholder', 'Hasil Inspeksi');
          $('#hasilAnalisaLabel').text("Hasil Inspeksi");
        } else if (sub_menu_slug == 'evaluasi') {
          $(".is_analisa").show();
          $(".is_inspeksi").hide();
          $("#hasil_analisa").attr('placeholder', 'Hasil Evaluasi');
          $('#hasilAnalisaLabel').text('Hasil Evaluasi');
        } else {
          $(".is_analisa").hide();
          $(".is_inspeksi").hide();
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
          title: 'Apakah Anda Yakin Mengedit Pengawasan  Ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = {
              "alasan": $("#alasan_edit").val(),
              "jenis_kegiatan": "Pengawasan ",
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
          url: BASE_URL + '/api/pengawasan/request_edit/' + id,
          data: form,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: respons.message,
              icon: 'success',
              confirmButtonText: 'OK'
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
          title: 'Apakah Anda Yakin Revisi Pengawasan  Ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.isConfirmed) {
            var form = {
              "alasan": $("#alasan_revisi").val(),
              "jenis_kegiatan": "Pengawasan ",
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
          url: BASE_URL + '/api/pengawasan/request_revisi/' + id,
          data: form,
          cache: false,
          dataType: "json",
          success: (respons) => {
            Swal.fire({
              title: 'Sukses!',
              text: respons.message,
              icon: 'success',
              confirmButtonText: 'OK'
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
            'id_pengawasan',
            'periode_id_mdl',
            'sub_menu_slug',
            'nama_kegiatan',
            'hasil_analisa',
            'tanggal_kegiatan',
            'biaya',
            'lokasi',
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
            url: BASE_URL + '/api/pengawasan/update/' + id_modal,
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
                confirmButtonText: 'OK'

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
            'id_pengawasan',
            'periode_id_mdl',
            'sub_menu_slug',
            'nama_kegiatan',
            'hasil_analisa',
            'tanggal_kegiatan',
            'biaya',
            'lokasi',
            'lap_kegiatan',
            'lap_pendamping',
            'lap_notula',
            'lap_survey',
            'lap_narasumber',
            'lap_materi',
            'lap_document'
          ];
          formData.append("status", 14);
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/pengawasan/kirim/' + id_modal,
            data: formData,
            processData: false,
            contentType: false,
            success: (respons) => {
              Swal.fire({
                title: 'Sukses!',
                text: respons.message,
                icon: 'success',
                confirmButtonText: 'OK'

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
                confirmButtonText: 'OK'
              }).then((result) => {});
            }
          });
        });

        $("#approve_edit-" + id_modal).click(() => {
          var data = {
            "status": 13,
            "request_edit": "false",
          };
          $.ajax({
            type: "PUT",
            url: BASE_URL + '/api/pengawasan/approve_edit/' + id_modal,
            data: data,
            cache: false,
            dataType: "json",
            success: (respons) => {
              Swal.fire({
                title: 'Sukses!',
                text: respons.message,
                icon: 'success',
                confirmButtonText: 'OK'

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

  })
</script>