    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Kabupaten</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

               

            <div id="name-alert" class="form-group has-feedback" >
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Name" value="">
              <span id="name-messages"></span>
            </div>

             <div id="province-id-alert" class="form-group has-feedback">
                    <label>Provinsi </label>
                  <select id="province_id" class="select-add form-control"  name="province_id" ></select>
                  <span id="province-id-messages"></span>
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

  $('.select-add').select2({
        ajax: {
            url: BASE_URL+'/api/select-province', // URL to your server-side endpoint
            dataType: 'json',
            delay: 250, // Delay before sending the request (milliseconds)
            processResults: function(data) {
                
                // Transform the data to match Select2's expected format
                return {
                    results: data.map(function(item) {
                        return { id: item.value, text: item.text };
                    })
                };
            },
            cache: true // Cache the results to improve performance
        },
        minimumInputLength: 1 // Minimum number of characters required for a search
    });

    $('.select-add').on('select-add:select', function(e) {
        var selectedOption = e.params.data;
        $('#province_id').val(selectedOption.id);
    }); 
     
  $("#simpan").click( () => {

          var data = $("#FormSubmit").serializeArray();
          
          var form = {
              'name':data[0].value,
              'province_id':data[1].value,
              
             
          };


              var errors = {
                  messages: {
                      name:'',
                      province_id:'', 
                  },
              };

          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/regency',
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
                            window.location.replace('/regency');
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

                 if(errors.messages.province_id)
                {
                     $('#province-id-alert').addClass('has-error');
                     $('#province-id-messages').addClass('help-block').html('<strong>'+ errors.messages.province_id +'</strong>');
                }else{
                    $('#province-id-alert').removeClass('has-error');
                    $('#province-id-messages').removeClass('help-block').html('');
                }
                 
                
            }
          });
     });

  });
  </script>
 

</script>  

 


    
 
