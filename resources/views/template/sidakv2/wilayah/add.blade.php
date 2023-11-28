    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Wilayah</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

               

            <div id="name-alert" class="form-group has-feedback" >
              <label>Nama</label>
              <input type="text" class="form-control" name="name" placeholder="Nama" value="">
              <span id="name-messages"></span>
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
              'status':data[1].value,
             
          };


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/wilayah',
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
                            window.location.replace('/wilayah');
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

 


    
 
