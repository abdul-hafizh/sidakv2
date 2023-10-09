    
    
<!-- Modal -->
<div id="modal-menu-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close clear-input" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Menu</h4>
      </div>
      <form  id="FormSubmitMenu" >
      <div class="modal-body">
        
           

               

            <div id="name-alert" class="form-group has-feedback" >
              <label>Nama : </label>
              <input type="text" class="form-control" name="name" placeholder="Nama" value="">
              <span id="name-messages" class="span-messages"></span>
            </div>

            <div id="parent-alert" class="form-group has-feedback" >
              <label>Parent : </label>
              <select id="parent" data-style="btn-default" name="parent"  class="selectpicker form-control" title="Pilihan Menu">
                   <option value="menu">Jadikan Menu</option>
                   <option value="sub">Jadikan Sub Menu</option>
                 
              </select>
              <span id="parent-messages" class="span-messages"></span>
            </div>

            <div id="path-web-alert" style="display:none;" class="form-group has-feedback" >
              <label>URL : </label>
              <input type="text" class="form-control" name="url" placeholder="URL" value="#">
              <span id="path-web-messages" class="span-messages"></span>
            </div>

            <div id="icon-alert" class="form-group has-feedback">
                <label>Icon :</label>
                <input id="AddIcon" type="file" name="upload_photo" >
                <span id="icon-messages" class="span-messages"></span>
            </div>

            <div class="form-group has-feedback icon-photo"></div>


            <div id="icon-hover-alert" class="form-group has-feedback">
                <label>Icon Hover:</label>
                <input id="AddIconHover" type="file" name="upload_photo" >
                <span id="icon-hover-messages" class="span-messages"></span>
            </div>

            <div class="form-group has-feedback icon-hover-photo"></div>
              




       
      </div>
      <div class="modal-footer">
        <button  type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan-menu" type="button" class="btn btn-primary" >Simpan</button>
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){
    var icon = '';
    var icon_hover = '';
       
    $('#parent').change(function() {
        selectedVal = $(this).find("option:selected").val();
        if(selectedVal =='menu')
        {
          $('#path-web-alert').hide();
        }else{
          $('#path-web-alert').show();
        }  
        

    });
   

    $("#AddIcon").change((event)=> {     
            
            const files = event.target.files
            let filename = files[0].name
            const fileReader = new FileReader()
            fileReader.addEventListener('load', () => {

                    if(files[0].name.toUpperCase().includes(".PNG"))
                    {
                        icon = fileReader.result;
                        $('.icon-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ icon +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPEG")){
                        icon = fileReader.result;
                        $('.icon-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ icon +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPG")){
                        icon = fileReader.result;
                        $('.icon-photo').html('<img style="background:#000;" width="30" height="30" src="'+ icon +'">');
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

    $("#AddIconHover").change((event)=> {     
            
            const files = event.target.files
            let filename = files[0].name
            const fileReader = new FileReader()
            fileReader.addEventListener('load', () => {

                    if(files[0].name.toUpperCase().includes(".PNG"))
                    {
                        icon_hover = fileReader.result;
                        $('.icon-hover-photo').html('<img style="background:#fff;" width="30" height="30"  src="'+ icon_hover +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPEG")){
                        icon_hover = fileReader.result;
                        $('.icon-hover-photo').html('<img style="background:#fff;" width="30" height="30"  src="'+ icon_hover +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPG")){
                        icon_hover = fileReader.result;
                        $('.icon-hover-photo').html('<img style="background:#fff;" width="30" height="30" src="'+ icon_hover +'">');
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
              'parent':data[1].value,
              'path_web':data[2].value,
              'icon':icon,
              'icon_hover':icon_hover,
             
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
                
               

                if(errors.messages.parent)
                {
                     $('#name-alert').addClass('has-error');
                     $('#name-messages').addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
                }else{
                    $('#name-alert').removeClass('has-error');
                    $('#name-messages').removeClass('help-block').html('');
                }


                if(errors.messages.parent)
                {
                     $('#parent-alert').addClass('has-error');
                     $('#parent-messages').addClass('help-block').html('<strong>'+ errors.messages.parent +'</strong>');
                }else{
                    $('#parent-alert').removeClass('has-error');
                    $('#parent-messages').removeClass('help-block').html('');
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


                 if(errors.messages.icon_hover)
                {
                     $('#icon-hover-alert').addClass('has-error');
                     $('#icon-hover-messages').addClass('help-block').html('<strong>'+ errors.messages.icon +'</strong>');
                }else{
                    $('#icon-hover-alert').removeClass('has-error');
                    $('#icon-hover-messages').removeClass('help-block').html('');
                }

                //  if(errors.messages.status)
                // {
                //      $('#status-alert').addClass('has-error');
                //      $('#status-messages').addClass('help-block').html('<strong>'+ errors.messages.status +'</strong>');
                // }else{
                //     $('#status-alert').removeClass('has-error');
                //     $('#status-messages').removeClass('help-block').html('');
                // }  

                
            }
          });
     });

  });
  </script>
 



 


    
 
