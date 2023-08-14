    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Periode</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
         

            <div id="name-alert" class="form-group has-feedback" >
              <label>Nama</label>
              <input type="text" class="form-control" name="name" placeholder="Nama" value="">
              <span id="name-messages"></span>
            </div>

            <div id="semester-alert" class="form-group has-feedback" >
              <label>Semester</label>
              <select id="semester" class="form-control" name="semester">
                  <option value="">Pilih Semester</option>
                  <option value="01">Semester 1</option>
                  <option value="02">Semester 2</option>
              </select>
              <span id="semester-messages"></span>
            </div>

            <div id="year-alert" class="form-group has-feedback" >
              <label>Tahun</label>
              <input type="text" class="form-control" name="year" placeholder="Year" value="">
              <span id="year-messages"></span>
            </div>

         

            <div  id="status-alert" class="form-group has-feedback" >
               <label>Status  :</label>
                <div class="radio">
                    <label>
                      <input  type="radio" name="status" id="" value="Y"   checked>
                      Aktif
                    </label>
                </div>
                <div class="radio">
                    <label>
                      <input   type="radio" name="status" id="" value="N" >
                     Non Aktif
                    </label>
                </div>
                <span id="status-messages"></span>
            
            </div>





       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan" type="button" class="btn btn-primary" >Simpan</button>
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){

   
     
  $("#simpan").click( () => {

          var data = $("#FormSubmit").serializeArray();
          var form = {
              'name':data[0].value,
              'semester':data[1].value,
              'year':data[2].value,
              'status':data[3].value,
             
          };


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/periode',
            data:form,
            cache: false,
            dataType: "json",
            success: (respons) =>{
                   Swal.fire({
                        title: 'Sukses!',
                        text: 'Berhasil Disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User clicked "Yes, proceed!" button
                            window.location.replace('/periode');
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
               

                if(errors.messages.name)
                {
                     $('#name-alert').addClass('has-error');
                     $('#name-messages').addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
                }else{
                    $('#name-alert').removeClass('has-error');
                    $('#name-messages').removeClass('help-block').html('');
                }

                if(errors.messages.semester)
                {
                     $('#semester-alert').addClass('has-error');
                     $('#semester-messages').addClass('help-block').html('<strong>'+ errors.messages.semester +'</strong>');
                }else{
                    $('#semester-alert').removeClass('has-error');
                    $('#semester-messages').removeClass('help-block').html('');
                }

                if(errors.messages.year)
                {
                     $('#year-alert').addClass('has-error');
                     $('#year-messages').addClass('help-block').html('<strong>'+ errors.messages.year +'</strong>');
                }else{
                    $('#year-alert').removeClass('has-error');
                    $('#year-messages').removeClass('help-block').html('');
                }

                 if(errors.messages.status)
                {
                     $('#status-alert').addClass('has-error');
                     $('#status-messages').addClass('help-block').html('<strong>'+ errors.messages.status +'</strong>');
                }else{
                    $('#status-alert').removeClass('has-error');
                    $('#status-messages').removeClass('help-block').html('');
                }  

                
            }
          });
     });

  });
  </script>
 

</script>  

 


    
 
