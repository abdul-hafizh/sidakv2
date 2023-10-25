<!-- Modal -->
<div id="modal-import" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content pull-left full">
      <div class="modal-header bg-primary pull-left full">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judulModalLabel">Import Excel</h4>
      </div>
        <form method="post"  id="file-upload" enctype="multipart/form-data">
        <div class="modal-body pull-left full">

          <div id="template" class="form-group has-feedback margin-top-bottom-10 pull-left full" >

               <div class="col-md-3 padding-default">
                   <button id="template_data" type="button" class="btn btn-warning">Template Data</button>
                </div>
                <div class="col-md-9 padding-default">
                    <button id="data_wilayah" type="button" class="btn btn-info">Data Wilayah</button>
               </div> 
          </div>    

         <div id="file-alert" class="form-group has-feedback pull-left full" >
            <label>Pilih file excel</label>
            <input id="import_file" type="file" name="file" required="required">
            <span class="text-danger" id="file-input-error"></span>

         </div>

        
         <div id="loading-bar" style="display:none;" class="form-group has-feedback pull-left full" >
             <div id="ProgressBar"></div>   
         </div>
        </div>
        <div class="modal-footer pull-left full">
          <button class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button id="import" type="button" class="btn btn-primary">Import</button>
        </div>
      </form>
   
    </div>

  </div>
</div>




<script type="text/javascript">
  $(function() {

        $("#file-upload").click(() => {
               $('#file-alert').hide();
               $('#template').hide();
               $('#import').hide();
               $('#loading-bar').show();
               proggresbar();
              
               
         }); 

         $("#data_wilayah").click(() => {
           
             window.location.replace('/file/pagu_target/data_daerah.xlsx');        
         });
         $("#template_data").click(() => {
         
             window.location.replace('/file/pagu_target/template.xlsx');        
         });  

    
          function proggresbar(){ 
            var bgprogress = 'btn-danger';
            var persen = '';
            var size = 0; 
            var sProgress = {};

               
              var interval =  setInterval(() =>{
                  size = size + 1;
                  sProgress =  "width: "+size+"%";
                  persen = size+'%';
                  if(size >= 50 && size < 100){
                      bgprogress = 'btn-warning';
                  }else if(size>= 100){
                      clearInterval(interval);
                      bgprogress = 'btn-success';
                      persen = 'Done';
                      var sProgress;
                       $('#file-alert').show();
                       $('#template').show();
                       $('#import').show();
                       $('#loading-bar').hide();
                       $('#modal-import').modal('toggle');
                       ImportExcel();
                  }

                   var row = '';
              row +='<label><h4>Loading data ...</h4></label>';
              row +='<div class="progress loading-submit" >';
                  row +='<div class="progress-bar progress-bar-striped '+ bgprogress +'" style="'+ sProgress +'" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">';
                      row +='<span class="pa-count"> '+ persen +' </span>';

                  row +='</div>';
              row +='</div>';


              $('#ProgressBar').html(row);

              }, 1000);

          }

          function ImportExcel(){

              let fileInput =  $('#import_file')[0].files[0]; 
             
              $('#file-input-error').text('');
               var formData = new FormData(); // Create a FormData object

               formData.append('file', fileInput);
              $.ajax({
                type: 'POST',
                url: BASE_URL + '/api/pagutarget/import_excel',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                  window.location.replace('/paguapbn');
                },
                error: function(response) {
                  $('#file-input-error').text(response.responseJSON.errors.file);
                }
              });

          }
    

  });
</script>

