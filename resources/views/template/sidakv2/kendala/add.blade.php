    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Kendala</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

               

            <div id="permasalahan-alert" class="form-group has-feedback" >
              <label>Pemasalahan</label>
              <input type="text" class="form-control" name="permasalahan" placeholder="Pemasalahan" value="">
              <span id="permasalahan-messages"></span>
            </div>


             <div id="permasalahan-alert" class="form-group has-feedback" >
              <label>Kriteria Kendala</label>
              <select id="kriteria_id" class="form-control" name="kriteria_id" title="Kriteria Kendala" data-live-search="true"></select>
              <span id="permasalahan-messages"></span>
            </div>


             <div id="messages-alert" class="form-group has-feedback" >
              <label>Pesan</label>
              <textarea class="form-control textarea-fixed" placeholder="Pesan Kendala" name="messages"></textarea>
              <span id="messages-messages"></span>
            </div>





       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan" type="button" class="btn btn-success" >Simpan</button>
        <button id="kirim" type="button" class="btn btn-primary" >Kirim</button>
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){

    $.ajax({
          url: BASE_URL +'/api/select-kriteria',
          method: 'GET',
          dataType: 'json',
          success: function(data) {
              // Populate SelectPicker options using received data
              var select =  $('#kriteria_id')
              $.each(data, function(index, option) {
                  select.append($('<option>', {
                    value: option.value,
                    text: option.text
                  }));
              });

             // Refresh the SelectPicker to apply the new options
             select.selectpicker('refresh');
          },
          error: function(error) {
          console.error(error);
          }
      });
     
  $("#simpan").click( () => {
          var data = $("#FormSubmit").serializeArray();
          var form = {
              'permasalahan':data[0].value,
              'kriteria_id':data[1].value,
              'messages':data[2].value,
              'status':'draft',
          };
        SendData(form);
  });

  $("#kirim").click( () => {
          var data = $("#FormSubmit").serializeArray();
          var form = {
              'permasalahan':data[0].value,
              'kriteria_id':data[1].value,
              'messages':data[2].value,
              'status':'sent',
          };
          SendData(form);
  });

  function SendData(form){
    
      if(form.status =='sent')
      {
        var status = 'Terkirim';
      }else{
        var status = 'Disimpan';
      }  
    $.ajax({
            type:"POST",
            url: BASE_URL+'/api/kendala',
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
                            window.location.replace('/kendala');
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
               

                if(errors.messages.permasalahan)
                {
                     $('#permasalahan-alert').addClass('has-error');
                     $('#permasalahan-messages').addClass('help-block').html('<strong>'+ errors.messages.permasalahan +'</strong>');
                }else{
                    $('#permasalahan-alert').removeClass('has-error');
                    $('#permasalahan-messages').removeClass('help-block').html('');
                }

                 if(errors.messages.messages)
                {
                     $('#messages-alert').addClass('has-error');
                     $('#messages-messages').addClass('help-block').html('<strong>'+ errors.messages.messages +'</strong>');
                }else{
                    $('#messages-alert').removeClass('has-error');
                    $('#messages-messages').removeClass('help-block').html('');
                }  

                
            }
    });
    

  }


});  
  </script>
 

</script>  

 


    
 
