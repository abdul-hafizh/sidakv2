<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Pengawasan</h4>
      </div>
      <div class="modal-body">

        <div id="periode-alert" class="form-group has-feedback" >
          <label>Periode</label>
          <select class="form-control" name="periode_inp">
            <option>Pilih Periode</option>
            <option>Semester I - 2021</option>
            <option>Semester II - 2021</option>
            <option>Semester I - 2022</option>
            <option>Semester II - 2022</option>
            <option>Semester I - 2023</option>
            <option>Semester II - 2023</option>
          </select>
          <span id="periode-messages"></span>
        </div>

        <div id="jenis-alert" class="form-group has-feedback" >
          <label>Jenis Pengawasan</label>
          <select class="form-control" id="jenis_inp" name="jenis_inp">
            <option>Pilih Jenis</option>
            <option value="1">Analisa dan Verifikasi Data</option>
            <option value="2">Inspeksi Lapangan</option>
            <option value="3">Evaluasi Penilaian Kepatuhan Pelaksanaan Perizinan Berusaha</option>
          </select>
          <span id="jenis-messages"></span>
        </div>

        <div class="is_analisa">
          <div id="namakegiatan-alert" class="form-group has-feedback" >
            <label>Nama Kegiatan</label>
            <input type="text" class="form-control" name="nama_kegiatan" placeholder="Nama Kegiatan" value="">
            <span id="namakegiatan-messages"></span>
          </div>

          <div id="hasilanalisa-alert" class="form-group has-feedback" >
            <label>Hasil Analisa</label>
            <textarea class="form-control" name="hasil_analisa" placeholder="Hasil Analisa"></textarea>
            <span id="hasilanalisa-messages"></span>
          </div>

          <div id="tanggalkegiatan-alert" class="form-group has-feedback" >
            <label>Tanggal Kegiatan</label>
            <input type="date" class="form-control" name="tanggal_kegiatan" placeholder="Tanggal Kegiatan">
            <span id="tanggalkegiatan-messages"></span>
          </div>

          <div id="biaya-alert" class="form-group has-feedback" >
            <label>Biaya (Rp.)</label>
            <input type="text" class="form-control" name="biaya" placeholder="Biaya Kegiatan" value="">
            <span id="biaya-messages"></span>
          </div>

          <div id="lokasi-alert" class="form-group has-feedback" >
            <label>Lokasi Kegiatan</label>
            <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Kegiatan" value="">
            <span id="lokasi-messages"></span>
          </div>

          <div id="laporan-alert" class="form-group has-feedback" >
            <label>Laporan</label>
            <input type="file" class="form-control" name="laporan" placeholder="Laporan Kegiatan" value="">
            <span id="laporan-messages"></span>
            <span class="text-danger"><i>* File yang diunggah harus PDF dan ukuran dibawah 1.3 MB</i></span>
          </div>
        </div>
        
        <div class="is_inspeksi">
          <div id="perusahaan-alert" class="form-group has-feedback" >
            <label>Nama Perusahaan</label>
            <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" value="">
            <span id="perusahaan-messages"></span>
          </div>
        </div>      

        <div class="is_evaluasi">
          <div id="namakegiatan-alert" class="form-group has-feedback" >
            <label>Nama Kegiatan Evaluasi</label>
            <input type="text" class="form-control" name="nama_kegiatan" placeholder="Nama Kegiatan" value="">
            <span id="namakegiatan-messages"></span>
          </div>

          <div id="hasilevaluasi-alert" class="form-group has-feedback" >
            <label>Hasil Evaluasi</label>
            <textarea class="form-control" name="hasil_evaluasi" placeholder="Hasil Evaluasi"></textarea>
            <span id="hasilevaluasi-messages"></span>
          </div>
        </div>          

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>

  </div>
</div>