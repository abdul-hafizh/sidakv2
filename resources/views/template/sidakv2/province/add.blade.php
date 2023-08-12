    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Provinsi</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

               

            <div id="name-alert" class="form-group has-feedback" >
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Name" value="">
              <span id="name-messages"></span>
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
          console.log(data)
          var form = {
              'name':data[0].value
             
          };

           var errors = {
                  messages: {
                      name:'',  
                  },
              };


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/province',
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
                            window.location.replace('/province');
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

               

                
            }
          });
     });

  });
  </script>
 

</script>  

 


    
 
