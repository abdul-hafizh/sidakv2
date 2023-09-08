    
    
<!-- Modal -->
<div id="modal-menu-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Menu</h4>
      </div>
      <form  id="FormSubmitMenu" >
      <div class="modal-body">
        
           

               

            <div id="name-alert" class="form-group has-feedback" >
              <label>Nama : </label>
              <input type="text" class="form-control" name="name" placeholder="Nama" value="">
              <span id="name-messages"></span>
            </div>

            <div id="path-web-alert" class="form-group has-feedback" >
              <label>URL : </label>
              <input type="text" class="form-control" name="url" placeholder="URL" value="#">
              <span id="path-web-messages"></span>
            </div>

            <div id="icon-alert" class="form-group has-feedback">
                <label>Icon :</label>
                <input id="AddFiles" type="file" name="upload_photo" >
                <span id="icon-messages"></span>
            </div>

            <div class="form-group has-feedback user-photo"></div>


           





       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan-menu" type="button" class="btn btn-primary" >Simpan</button>
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){
    var photo = '';

    $("#addPhotos").click(()=> {
        $("#AddFiles").trigger("click");
    });      

    $("#AddFiles").change((event)=> {     
            
            const files = event.target.files
            let filename = files[0].name
            const fileReader = new FileReader()
            fileReader.addEventListener('load', () => {

                    if(files[0].name.toUpperCase().includes(".PNG"))
                    {
                        photo = fileReader.result;
                        $('.user-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ photo +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPEG")){
                        photo = fileReader.result;
                        $('.user-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ photo +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPG")){
                        photo = fileReader.result;
                        $('.user-photo').html('<img style="background:#000;" width="30" height="30" src="'+ photo +'">');
                    }else{
                      Swal.fire({
                        icon: 'info',
                        title: 'Tipe file tidak diizinkan!',
                        confirmButtonColor: '#000',
                        confirmButtonText: 'OK'
                      });  
                    } 
                  
            })
            fileReader.readAsDataURL(files[0])

    }); 
   
     
  $("#simpan-menu").click( () => {

          var data = $("#FormSubmitMenu").serializeArray();
          
          var form = {
              'name':data[0].value,
              'path_web':data[1].value,
              'icon':photo,
             
          };


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/menu',
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
                            window.location.replace('/options');
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

                 if(errors.messages.path_web)
                {
                     $('#path-web-alert').addClass('has-error');
                     $('#path-web-messages').addClass('help-block').html('<strong>'+ errors.messages.path_web +'</strong>');
                }else{
                    $('#path-web-alert').removeClass('has-error');
                    $('#path-web-messages').removeClass('help-block').html('');
                }

                 if(errors.messages.icon)
                {
                     $('#icon-alert').addClass('has-error');
                     $('#icon-messages').addClass('help-block').html('<strong>'+ errors.messages.icon +'</strong>');
                }else{
                    $('#icon-alert').removeClass('has-error');
                    $('#icon-messages').removeClass('help-block').html('');
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
 



 


    
 
