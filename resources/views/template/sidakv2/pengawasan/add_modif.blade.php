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
<div id="modal-add" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" >Tambah Pengawasan</h4>
      </div>
      <form id="FormSubmit" enctype="multipart/form-data">

        
      </form>
    </div>

  </div>
</div>







 <script type="text/javascript">
      $(function() {
   
   
   
     getFormInput();
      
     
    

  })

  function getFormInput(){
       var row = ``;
       var textSelect = 'Analisa';
      row +=`<div class="modal-body" style="height: 550px; overflow-y: auto;">`;
          

          row +=`<div class="row">`;
            row +=`<div id="periode_id_mdl-alert" class="form-group has-feedback col-md-12">`;
              row +=`<label>Periode </label>`;
              row +=`<select class="form-control select-periode-mdl" name="periode_id_mdl" id="periode_id_mdl">`;
              row +=`</select>`;
              row +=`<span id="periode_id_mdl-messages"></span>`;
            row +=`</div>`;
          row +=`</div>`;

          row +=`<div class="row">`;
            row +=`<div id="sub_menu_slug-alert" class="form-group has-feedback col-md-12">`;
              row +=`<label>Jenis Pengawasan</label>`;
             
              row +=`<select class="form-control select-jenis" name="sub_menu_slug" id="sub_menu_slug">`;
                row +=`<option value="analisa">Analisa dan Verifikasi Data</option>`;
                 row +=`<option value="inspeksi">Inspeksi Lapangan</option>`;
                 row +=`<option value="evaluasi">Evaluasi Penilaian Kepatuhan Pelaksanaan Perizinan Berusaha</option>`;
             row +=`</select>`;
              row +=`<span id="sub_menu_slug-messages"></span>`;
            row +=`</div>`;
          row +=`</div>`;

          row +=`<div id="nama_kegiatan-alert" class="form-group has-feedback">`;
            row +=`<label>Nama Kegiatan</label>`;
            row +=`<input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan" value="">`;
            row +=`<span id="nama_kegiatan-messages"></span>`;
          row +=`</div>`;

          row +=`<div id="hasil_analisa-alert" class="form-group has-feedback">`;
            row +=`<label id="hasilAnalisaLabel">Hasil `+ textSelect +`</label>`;
            row +=`<textarea class="form-control textarea-fixed-replay" name="hasil_analisa" id="hasil_analisa" placeholder="Hasil `+ textSelect +`"></textarea>`;
            row +=`<span id="hasil_analisa-messages"></span>`;
          row +=`</div>`;

          row +=`<div id="tanggal_kegiatan-alert" class="form-group has-feedback">`;
            row +=`<label>Tanggal Kegiatan</label>`;
            row +=`<input type="date" class="form-control" name="tanggal_kegiatan" id="tanggal_kegiatan" placeholder="Tanggal Kegiatan">`;
            row +=`<span id="tanggal_kegiatan-messages"></span>`;
          row +=`</div>`;

          row +=`<div id="biaya-alert" class="form-group has-feedback">`;
            row +=`<label>Biaya (Rp.)</label>`;
            row +=`<input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya Kegiatan" value="" required>`;
            row +=`<span id="biaya-messages"></span>`;
          row +=`</div>`;
     

          
          row +=`<div id="lokasi-alert" class="form-group has-feedback">`;
             row +=`<label>Lokasi Kegiatan</label>`;
             row +=`<input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi Kegiatan" value="">`;
             row +=`<span id="lokasi-messages"></span>`;
          row +=`</div>`;


          row +=` <div id="lap_kegiatan-alert" class="form-group has-feedback">`;
             row +=`<label>Laporan</label>`;
             row +=`<a href="#" class="text-bold text-profile" id="modal-lap_kegiatan" style="display: none" style="margin-left: 5px"><img src="{{ asset('template/sidakv2/img/pdf-icon.png') }}" style="width: 30px; margin-bottom: 10px;" alt="PDF Laporan Kegiatan"></a>`;
             row +=`<input type="hidden" class="form-control" name="lap_kegiatan_file" id="lap_kegiatan_file" value="">`;
             row +=`<input type="file" class="form-control file-access" name="lap_kegiatan" id="lap_kegiatan" accept=".pdf">`;
             row +=`<span id="lap_kegiatan-messages"></span>`;
             row +=`<small class="text-red file-access">*file yang diupload harus pdf dan ukuran dibawah 2 MB</small>`;
           row +=`</div>`;
        row +=`</div>`;

        $('#FormSubmit').html(row);

        $('#sub_menu_slug').change(function() {
            selectedText = $(this).find("option:selected").val();
            console.log(selectedText)
            if(selectedText =='analisa')
            {
                textSelect = 'Analisa';
            }else if(selectedText =='inspeksi'){
                textSelect = 'Inspeksi';
            }else{
               textSelect = 'Evaluasi';
            }  
            
        }); 
      


  }
</script>