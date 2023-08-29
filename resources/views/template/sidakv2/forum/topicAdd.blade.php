    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Topik</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

               

            <div id="topic-alert" class="form-group has-feedback" >
              <label>Topik</label>
              <input type="text" class="form-control" name="topic" placeholder="Topik" value="">
              <span id="topic-messages"></span>
            </div>


            <div id="comment-alert" class="form-group has-feedback" >
              <label>Komentar</label>
              <textarea class="form-control textarea-fixed" placeholder="Komentar" name="comment"></textarea>
              <span id="comment-messages"></span>
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

    var url = window.location.href; // Get the current URL
    var segments = url.split('/');   // Split the URL by '/'
    var topic = segments[4]; // Index 4 corresponds to the second segment


     
  $("#simpan").click( () => {
          var data = $("#FormSubmit").serializeArray();
          var form = {
              'name':data[0].value,
              'forum_slug':topic,
              'comment':data[1].value,
              
          };
        SendData(form);
  });

 

  function SendData(form){
    
     
    $.ajax({
            type:"POST",
            url: BASE_URL+'/api/forum/topic',
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
                            window.location.replace('/forum/'+ topic);
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                

                if(errors.messages.topic)
                {
                     $('#topic-alert').addClass('has-error');
                     $('#topic-messages').addClass('help-block').html('<strong>'+ errors.messages.topic +'</strong>');
                }else{
                    $('#topic-alert').removeClass('has-error');
                    $('#topic-messages').removeClass('help-block').html('');
                }



                 if(errors.messages.comment)
                {
                     $('#comment-alert').addClass('has-error');
                     $('#comment-messages').addClass('help-block').html('<strong>'+ errors.messages.comment +'</strong>');
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

 


    
 
