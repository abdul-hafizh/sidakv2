    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button"  id="close1" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Kendala</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

               

            <div id="category-alert" class="form-group has-feedback" >
              <label>Kategori</label>
              <input type="text" class="form-control" name="category" placeholder="Kategori" value="">
              <span id="category-messages"></span>
            </div>


             <div id="description-alert" class="form-group has-feedback" >
              <label>Keterangan</label>
              <textarea class="form-control textarea-fixed" placeholder="Keterangan" name="description"></textarea>
              <span id="description-messages"></span>
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
        <button type="button" id="close2" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan" type="button" class="btn btn-primary" >Simpan</button>
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){

   $("#close1").click(()=> {  
      DefaultNull();
   });

   $("#close2").click(()=> {  
      DefaultNull();
   });
     
  $("#simpan").click( () => {

          var data = $("#FormSubmit").serializeArray();
          var form = {
              'category':data[0].value,
              'description':data[1].value,
              'status':data[2].value,
             
          };


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/kriteria',
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
                            window.location.replace('/kriteria-kendala');
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
               

                if(errors.messages.category)
                {
                     $('#category-alert').addClass('has-error');
                     $('#category-messages').addClass('help-block').html('<strong>'+ errors.messages.category +'</strong>');
                }else{
                    $('#category-alert').removeClass('has-error');
                    $('#category-messages').removeClass('help-block').html('');
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

   function DefaultNull()
       {
   
           $("input").val(null);
           $('#modal-add').modal('toggle');

        }

  });
  </script>
 

</script>  

 


    
 
