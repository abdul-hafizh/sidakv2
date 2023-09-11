    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close1" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Provinsi</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           
              <div id="kode-alert-add" class="form-group has-feedback" >
              <label>Kode Provinsi</label>
              <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '');"  name="id" placeholder="Kode Provinsi" value="">
              <span id="kode-messages-add"></span>
            </div> 
               

            <div id="name-alert-add" class="form-group has-feedback" >
              <label>Nama Provinsi</label>
              <input type="text" class="form-control" name="name" placeholder="Nama" value="">
              <span id="name-messages-add"></span>
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
              'id':data[0].value,
              'name':data[1].value
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
                            window.location.replace('/provinsi');
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
                if(errors.messages.id)
                {
                     $('#kode-alert-add').addClass('has-error');
                     $('#kode-messages-add').addClass('help-block').html('<strong>'+ errors.messages.id +'</strong>');
                }else{
                    $('#kode-alert-add').removeClass('has-error');
                    $('#kode-messages-add').removeClass('help-block').html('');
                }

                if(errors.messages.name)
                {
                     $('#name-alert-add').addClass('has-error');
                     $('#name-messages-add').addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
                }else{
                    $('#name-alert-add').removeClass('has-error');
                    $('#name-messages-add').removeClass('help-block').html('');
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
 



 


    
 
