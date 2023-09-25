    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button"  class="clear-input close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Kendala</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

               

            <div id="topic-alert" class="form-group has-feedback" >
              <label>Kendala Permasalahan</label>
              <input type="text" class="form-control" name="name" placeholder="Kendala Permasalahan" value="">
              <span id="topic-messages" class="span-messages"></span>
            </div>


            <div id="comment-alert" class="form-group has-feedback" >
              <label>Pesan</label>
              <textarea class="form-control textarea-fixed" placeholder="Pesan" name="comment"></textarea>
              <span id="comment-messages" class="span-messages"></span>
            </div>

             


       
      </div>
      <div class="modal-footer">
        <button type="button"  class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan" type="button" class="btn btn-primary" >Simpan</button>
     
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){

    var url = window.location.href; // Get the current URL
    var segments = url.split('/');   // Split the URL by '/'
    var kriteria = segments[4]; // Index 4 corresponds to the second segment

  
    
     
  $("#simpan").click( () => {
          var data = $("#FormSubmit").serializeArray();
          var form = {
              'permasalahan':data[0].value,
              'kriteria_slug':kriteria,
              'messages':data[1].value,
              
          };
        SendData(form);
  });

 

  function SendData(form){
    
     
    $.ajax({
            type:"POST",
            url: BASE_URL+'/api/masalah',
            data:form,
            cache: false,
            dataType: "json",
            success: (respons) =>{
                   Swal.fire({
                        title: 'Sukses!',
                        text: 'Berhasil '+ status,
                        icon: 'success',
                        confirmButtonText: 'OK'
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User clicked "Yes, proceed!" button
                            window.location.replace('/kendala/'+ kriteria);
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                

                if(errors.messages.permasalahan)
                {
                     $('#topic-alert').addClass('has-error');
                     $('#topic-messages').addClass('help-block').html('<strong>'+ errors.messages.permasalahan +'</strong>');
                }else{
                    $('#topic-alert').removeClass('has-error');
                    $('#topic-messages').removeClass('help-block').html('');
                }



                 if(errors.messages.messages)
                {
                     $('#comment-alert').addClass('has-error');
                     $('#comment-messages').addClass('help-block').html('<strong>'+ errors.messages.messages +'</strong>');
                }else{
                    $('#comment-alert').removeClass('has-error');
                    $('#comment-messages').removeClass('help-block').html('');
                }  


                
            }
    });
    

  }


});  
  </script>
 

</script>  

 


    
 
