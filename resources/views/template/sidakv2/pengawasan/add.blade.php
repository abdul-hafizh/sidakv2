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

          <div class="is_analisa">
            <div id="lokasi-alert" class="form-group has-feedback">
              <label>Lokasi Kegiatan</label>
              <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi Kegiatan" value="">
              <span id="lokasi-messages"></span>
            </div>
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
                        <td colspan="2" style="padding: 2px;">
                          <div id="lokasi_perusahaan_0-alert" class=" has-feedback">
                            <input type="text" class="form-control" name="lokasi_perusahaan[0]" placeholder="Lokasi Kegiatan" value="">
                            <span id="lokasi_perusahaan_0-messages"></span>
                          </div>
                        </td>
                      </tr>
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


                      <tr>
                        <td colspan="2" style="padding: 2px;">
                          <label>File Laporan Perusahaan</label>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="lap_bap_0-alert" class="form-group has-feedback">
                            <label>Laporan BAP Pengawasan</label>
                            <a href="#" class="text-bold text-profile" id="modal-lap_bap" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan BAP Pengawasan)</small></a>
                            <input type="hidden" class="form-control" name="lap_bap_file" id="lap_bap_file" value="">
                            <input type="file" class="form-control file-access" name="lap_bap[0]" id="lap_bap" accept=".pdf">
                            <span id="lap_bap_0-messages"></span>
                            <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="lap_lkpm_0-alert" class="form-group has-feedback">
                            <label>Laporan LKPM</label>
                            <a href="#" class="text-bold text-profile" id="modal-lap_lkpm" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan LKPM)</small></a>
                            <input type="hidden" class="form-control" name="lap_lkpm_file" id="lap_lkpm_file" value="">
                            <input type="file" class="form-control file-access" name="lap_lkpm[0]" id="lap_lkpm" accept=".pdf">
                            <span id="lap_lkpm_0-messages"></span>
                            <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 2px;">
                          <div id="lap_evaluasi_0-alert" class="form-group has-feedback">
                            <label>Laporan Kepatuhan Pelaku Usaha</label>
                            <a href="#" class="text-bold text-profile" id="modal-lap_evaluasi" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Kepatuhan Pelaku Usaha)</small></a>
                            <input type="hidden" class="form-control" name="lap_evaluasi_file" id="lap_evaluasi_file" value="">
                            <input type="file" class="form-control file-access" name="lap_evaluasi[0]" id="lap_evaluasi" accept=".pdf">
                            <span id="lap_evaluasi_0-messages"></span>
                            <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
                          </div>
                        </td>
                        <td style="padding: 2px;">
                          <div id="lap_profile_0-alert" class="form-group has-feedback">
                            <label>Laporan Profile</label>
                            <a href="#" class="text-bold text-profile" id="modal-lap_profile" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Profile)</small></a>
                            <input type="hidden" class="form-control" name="lap_profile_file" id="lap_profile_file" value="">
                            <input type="file" class="form-control file-access" name="lap_profile[0]" id="lap_profile" accept=".pdf">
                            <span id="lap_profile_0-messages"></span>
                            <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>





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
          <td colspan="2" style="padding: 2px;">
            <div id="lokasi_perusahaan_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="lokasi_perusahaan[countArraynyaDigantiNanti]" placeholder="Lokasi Kegiatan" value="">
              <span id="lokasi_perusahaan_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="nib_countArraynyaDigantiNanti-alert" class="has-feedback">
              <input type="text" class="form-control" name="nib[countArraynyaDigantiNanti]" placeholder="Nomor Induk Berusaha" value="" >
              <span id="nib_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="tgl_nib_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="date" class="form-control" name="tgl_nib[countArraynyaDigantiNanti]" placeholder="Tanggal NIB" >
              <span id="tgl_nib_countArraynyaDigantiNanti-messages"></span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 2px;">
            <div id="nama_perusahaan_countArraynyaDigantiNanti-alert" class=" has-feedback">
              <input type="text" class="form-control" name="nama_perusahaan[countArraynyaDigantiNanti]" placeholder="Nama Perusahaan" value="" >
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

        
        <tr>
          <td colspan="2" style="padding: 2px;">
            <label>File Laporan Perusahaan</label>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="lap_bap_countArraynyaDigantiNanti-alert" class="form-group has-feedback">
              <label>Laporan BAP Pengawasan</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_bap" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan BAP Pengawasan)</small></a>
              <input type="hidden" class="form-control" name="lap_bap_file[countArraynyaDigantiNanti]" id="lap_bap_file" value="">
              <input type="file" class="form-control file-access" name="lap_bap[countArraynyaDigantiNanti]" id="lap_bap" accept=".pdf">
              <span id="lap_bap_countArraynyaDigantiNanti-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="lap_lkpm_countArraynyaDigantiNanti-alert" class="form-group has-feedback">
              <label>Laporan LKPM</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_lkpm" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan LKPM)</small></a>
              <input type="hidden" class="form-control" name="lap_lkpm_file[countArraynyaDigantiNanti]" id="lap_lkpm_file" value="">
              <input type="file" class="form-control file-access" name="lap_lkpm[countArraynyaDigantiNanti]" id="lap_lkpm" accept=".pdf">
              <span id="lap_lkpm_countArraynyaDigantiNanti-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="lap_evaluasi_countArraynyaDigantiNanti-alert" class="form-group has-feedback">
              <label>Laporan Kepatuhan Pelaku Usaha</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_evaluasi" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Kepatuhan Pelaku Usaha)</small></a>
              <input type="hidden" class="form-control" name="lap_evaluasi_file[countArraynyaDigantiNanti]" id="lap_evaluasi_file" value="">
              <input type="file" class="form-control file-access" name="lap_evaluasi[countArraynyaDigantiNanti]" id="lap_evaluasi" accept=".pdf">
              <span id="lap_evaluasi_countArraynyaDigantiNanti-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="lap_profile_countArraynyaDigantiNanti-alert" class="form-group has-feedback">
              <label>Laporan Profile</label>
              <a href="#" class="text-bold text-profile" id="modal-lap_profile" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Profile)</small></a>
              <input type="hidden" class="form-control" name="lap_profile_file[countArraynyaDigantiNanti]" id="lap_profile_file" value="">
              <input type="file" class="form-control file-access" name="lap_profile[countArraynyaDigantiNanti]" id="lap_profile" accept=".pdf">
              <span id="lap_profile_countArraynyaDigantiNanti-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  </script>
<script type="text/javascript">
  $(document).ready(function() {

    //$(".is_inspeksi").hide();

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
      $('#countArray').val(1);
      $('.modal-add2').show();
      $('.modal-edit').hide();
      $('.text-profile').hide();
      $('.file-access').show();
      $('#alasan_req').hide();
      $(".is_inspeksi").hide();
      $('#FormSubmit input,#FormSubmit textarea').removeAttr('readonly');
      $('#FormSubmit select').removeAttr('disabled');
      $(".hapus_row").remove();
      $('#tablePerusahaan').find('input').each(function() {
        var defaultVal = $(this).data('default');
        $(this).val('');
      });
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
      $('#progressModal').show();
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
      $('#progressModal').show();
      $.ajax({
        type: "POST",
        url: BASE_URL + '/api/pengawasan',
        data: formData,
        processData: false,
        contentType: false,
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
        'biaya_kegiatan',
        'jml_target',
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
          $('#countArray').val(data.count_perusahaan);
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



          getPeriode(data.periode_id);
          subMenu(data.sub_menu_slug);
          timpa(data.perusahaan);
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

      function timpa(perusahaan) {

        let row = `<tbody id="tbody-row">`;
        $.each(perusahaan, function(index, option) {
          if (index == 0)
            row += `<tr>`;
          else
            row += `<tr class="hapus_row">`;
          row += `<td>`;
          row += `<label>Data Perusahaan</label>`;
          if (index == 0)
            row += `<button type="button" class="btn btn-info" style="float: right;" id="btn-edit-row"><i class="fa fa-plus"></i></button>`;
          else
            row += `<button class="btn btn-danger btn-sm" type="button" style="float: right;" onclick="if($('#tbody-row tr').length > 1) { $(this).closest('tr').remove() }"><i class="fa fa-trash"></i></button>`;
          row += `<table class="table table-hover text-nowrap">`;

          row += `<tr>
                    <td colspan="2" style="padding: 2px;">
                      <div id="lokasi_perusahaan${index}-alert" class=" has-feedback">
                        <input type="text" class="form-control" name="lokasi_perusahaan[${index}]" placeholder="Lokasi Kegiatan" value="` + option.lokasi_kegiatan + `">
                        <span id="lokasi_perusahaan_${index}-messages"></span>
                      </div>
                    </td>
                  </tr>`;

          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="nib_${index}-alert" class="has-feedback">`;
          row += `<input type="text" class="form-control" name="nib[${index}]" placeholder="Nomor Induk Berusaha" value="` + option.nib + `" >`;
          row += `<span id="nib_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;

          row += `<td style="padding: 2px;">`;
          row += `<div id="tgl_nib_${index}-alert" class=" has-feedback">`;
          row += `<input type="date" class="form-control" name="tgl_nib[${index}]" placeholder="Tanggal NIB" value="` + option.tgl_nib + `" >`;
          row += `<span id="tgl_nib_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td colspan="2" style="padding: 2px;">`;
          row += `<div id="nama_perusahaan_${index}-alert" class=" has-feedback">`;
          row += `<input type="text" class="form-control" name="nama_perusahaan[${index}]" placeholder="Nama Perusahaan" value="` + option.nama_perusahaan + `" >`;
          row += `<span id="nama_perusahaan_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td colspan="2" style="padding: 2px;">`;
          row += `<div id="kontak_${index}-alert" class=" has-feedback">`;
          row += `<input type="text" class="form-control" name="kontak[${index}]" placeholder="Kontak" value="` + option.kontak + `">`;
          row += `<span id="kontak_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;

          row += `<tr>`;
          row += `<td colspan="2" style="padding: 2px;">`;
          row += `<label>Perizinan</label>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="no_izin_lokasi_${index}-alert" class=" has-feedback">`;
          row += `<input type="text" class="form-control" name="no_izin_lokasi[${index}]" placeholder="Nomor Izin Lokasi" value="` + option.no_izin_lokasi + `">`;
          row += `<span id="no_izin_lokasi_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="tgl_izin_lokasi_${index}-alert" class=" has-feedback">`;
          row += `<input type="date" class="form-control" name="tgl_izin_lokasi[${index}]" placeholder="Tanggal Izin Lokasi" value="` + option.tgl_izin_lokasi + `">`;
          row += `<span id="tgl_izin_lokasi_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="no_izin_amdal_${index}-alert" class=" has-feedback">`;
          row += `<input type="text" class="form-control" name="no_izin_amdal[${index}]" placeholder="Nomor Izin Amdal" value="` + option.no_izin_amdal + `">`;
          row += `<span id="no_izin_amdal_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="tgl_izin_amdal_${index}-alert" class=" has-feedback">`;
          row += `<input type="date" class="form-control" name="tgl_izin_amdal[${index}]" placeholder="Tanggal Izin Amdal" value="` + option.tgl_izin_amdal + `">`;
          row += `<span id="tgl_izin_amdal_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="no_izin_lingkungan_${index}-alert" class=" has-feedback">`;
          row += `<input type="text" class="form-control" name="no_izin_lingkungan[${index}]" placeholder="Nomor Izin Lingkungan" value="` + option.no_izin_lingkungan + `">`;
          row += `<span id="no_izin_lingkungan_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="tgl_izin_lingkungan_${index}-alert" class=" has-feedback">`;
          row += `<input type="date" class="form-control" name="tgl_izin_lingkungan[${index}]" placeholder="Tanggal Izin Lingkungan" value="` + option.tgl_izin_lingkungan + `">`;
          row += `<span id="tgl_izin_lingkungan_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="no_imb_${index}-alert" class=" has-feedback">`;
          row += `<input type="text" class="form-control" name="no_imb[${index}]" placeholder="Nomor IMB" value="` + option.no_imb + `">`;
          row += `<span id="no_imb_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="tgl_imb_${index}-alert" class=" has-feedback">`;
          row += `<input type="date" class="form-control" name="tgl_imb[${index}]" placeholder="Tanggal IMB" value="` + option.tgl_imb + `">`;
          row += `<span id="tgl_imb_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;

          row += `<tr>`;
          row += `<td colspan="2" style="padding: 2px;">`;
          row += `<label>Investasi dan Tenaga Kerja</label>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="total_rencana_inv_${index}-alert" class=" has-feedback">`;
          row += `<input type="number" class="form-control" name="total_rencana_inv[${index}]" placeholder="Total Rencana Inventaris" value="` + option.total_rencana_inv + `">`;
          row += `<span id="total_rencana_inv_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="total_realisasi_inv_${index}-alert" class=" has-feedback">`;
          row += `<input type="number" class="form-control" name="total_realisasi_inv[${index}]" placeholder="Total Realisasi Inventaris" value="` + option.total_realisasi_inv + `">`;
          row += `<span id="total_realisasi_inv_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="rencana_tki_${index}-alert" class=" has-feedback">`;
          row += `<input type="number" class="form-control" name="rencana_tki[${index}]" placeholder="Total Rencana TKI" value="` + option.rencana_tki + `">`;
          row += `<span id="rencana_tki_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="realisasi_tki_${index}-alert" class=" has-feedback">`;
          row += `<input type="number" class="form-control" name="realisasi_tki[${index}]" placeholder="Total Realisasi TKI" value="` + option.realisasi_tki + `">`;
          row += `<span id="realisasi_tki_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;
          row += `<tr>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="rencana_tka_${index}-alert" class=" has-feedback">`;
          row += `<input type="number" class="form-control" name="rencana_tka[${index}]" placeholder="Total Rencana TKA" value="` + option.rencana_tka + `">`;
          row += `<span id="rencana_tka_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `<td style="padding: 2px;">`;
          row += `<div id="realisasi_tka_${index}-alert" class=" has-feedback">`;
          row += `<input type="number" class="form-control" name="realisasi_tka[${index}]" placeholder="Total Realisasi TKA" value="` + option.realisasi_tka + `">`;
          row += `<span id="realisasi_tka_${index}-messages"></span>`;
          row += `</div>`;
          row += `</td>`;
          row += `</tr>`;

          row += `<tr>
          <td colspan="2" style="padding: 2px;">
            <label>File Laporan Perusahaan</label>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="lap_bap_${index}-alert" class="form-group has-feedback">
              <label>Laporan BAP Pengawasan</label></br>
              <a href="#" class="text-bold text-profile" id="modal-lap_bap${index}" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan BAP Pengawasan)</small></a>
              <input type="hidden" class="form-control" name="lap_bap_file[${index}]" id="lap_bap_file${index}" value="">
              <input type="file" class="form-control file-access" name="lap_bap[${index}]" id="lap_bap" accept=".pdf">
              <span id="lap_bap_${index}-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="lap_lkpm_${index}-alert" class="form-group has-feedback">
              <label>Laporan LKPM</label></br>
              <a href="#" class="text-bold text-profile" id="modal-lap_lkpm${index}" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan LKPM)</small></a>
              <input type="hidden" class="form-control" name="lap_lkpm_file[${index}]" id="lap_lkpm_file${index}" value="">
              <input type="file" class="form-control file-access" name="lap_lkpm[${index}]" id="lap_lkpm" accept=".pdf">
              <span id="lap_lkpm_${index}-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 2px;">
            <div id="lap_evaluasi_${index}-alert" class="form-group has-feedback">
              <label>Laporan Kepatuhan Pelaku Usaha</label></br>
              <a href="#" class="text-bold text-profile" id="modal-lap_evaluasi${index}" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Kepatuhan Pelaku Usaha)</small></a>
              <input type="hidden" class="form-control" name="lap_evaluasi_file[${index}]" id="lap_evaluasi_file${index}" value="">
              <input type="file" class="form-control file-access" name="lap_evaluasi[${index}]" id="lap_evaluasi" accept=".pdf">
              <span id="lap_evaluasi_${index}-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
          <td style="padding: 2px;">
            <div id="lap_profile_${index}-alert" class="form-group has-feedback">
              <label>Laporan Profile</label></br>
              <a href="#" class="text-bold text-profile" id="modal-lap_profile${index}" style="display: none" style="margin-left: 5px"><small>(Tampilkan Laporan Profile)</small></a>
              <input type="hidden" class="form-control" name="lap_profile_file[${index}]" id="lap_profile_file${index}" value="">
              <input type="file" class="form-control file-access" name="lap_profile[${index}]" id="lap_profile" accept=".pdf">
              <span id="lap_profile_${index}-messages"></span>
              <small class="text-red file-access">*file harus pdf dan Maksimal 2 MB</small>
            </div>
          </td>
        </tr>`;
          row += `</table>`;
          row += `</td>`;
          row += `</tr>`;

        });

        row += `</tbody>`;
        if (perusahaan != '') {
          $('#tablePerusahaan').html(row);

          $.each(perusahaan, function(index, option) {
            if (option.lap_profile) {
              $('#modal-lap_profile' + index).show();
              $('#lap_profile_file' + index).val(option.lap_profile);
              $('#modal-lap_profile' + index).click(function() {
                tampilkanModal(option.lap_profile);
              });
            } else {
              $('#modal-lap_profile' + index).hide();
              $('#lap_profile_file' + index).val('');
            }

            if (option.lap_lkpm) {
              $('#modal-lap_lkpm' + index).show();
              $('#lap_lkpm_file' + index).val(option.lap_lkpm);
              $('#modal-lap_lkpm' + index).click(function() {
                tampilkanModal(option.lap_lkpm);
              });
            } else {
              $('#modal-lap_lkpm' + index).hide();
              $('#lap_lkpm_file' + index).val('');
            }
            if (option.lap_evaluasi) {
              $('#modal-lap_evaluasi' + index).show();
              $('#lap_evaluasi_file' + index).val(option.lap_evaluasi);
              $('#modal-lap_evaluasi' + index).click(function() {
                tampilkanModal(option.lap_evaluasi);
              });
            } else {
              $('#modal-lap_evaluasi' + index).hide();
              $('#lap_evaluasi_file' + index).val('');
            }
            if (option.lap_bap) {
              $('#modal-lap_bap' + index).show();
              $('#lap_bap_file' + index).val(option.lap_bap);
              $('#modal-lap_bap' + index).click(function() {
                tampilkanModal(option.lap_bap);
              });
            } else {
              $('#modal-lap_bap' + index).hide();
              $('#lap_bap_file' + index).val('');
            }

          });

          countArray2 = $("#countArray").val();

          $("#btn-edit-row").on("click", function() {
            var row = $("#template-row-product").html();
            row = row.replace(/countArraynyaDigantiNanti/g, countArray2);
            $row = $(row);
            console.log($row);

            countArray2++;
            $("#tbody-row").append($row);
          });
        }
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

                  // window.location.replace('/pengawasan');

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

        $('#kirim-' + id_modal).on('click', function() {
          var formData = new FormData($('#FormSubmit')[0]);
          var form = [
            'id_pengawasan',
            'periode_id_mdl',
            'sub_menu_slug',
            'nama_kegiatan',
            'hasil_analisa',
            'tanggal_kegiatan',
            'biaya_kegiatan',
            'jml_target',
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
          $('#progressModal').show();
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/pengawasan/kirim/' + id_modal,
            data: formData,
            processData: false,
            contentType: false,
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
          $('#progressModal').show();
          $.ajax({
            type: "PUT",
            url: BASE_URL + '/api/pengawasan/approve_edit/' + id_modal,
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

  })
</script>