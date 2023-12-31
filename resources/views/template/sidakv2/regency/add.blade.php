    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="clear-input close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Kabupaten</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
            <div id="kode-alert" class="form-group has-feedback" >
              <label>Kode Kabupaten</label>
              <input type="text" maxlength="4" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '');"  name="id" placeholder="Kode Kabupaten" value="">
              <span id="kode-messages" class="span-messages"></span>
            </div>

            <div id="name-alert" class="form-group has-feedback" >
              <label>Nama</label>
              <input type="text" class="form-control" name="name" placeholder="Nama" value="">
              <span id="name-messages" class="span-messages"></span>
            </div>

            <div id="province-id-alert" class="form-group has-feedback">
                    <label>Provinsi </label>
                  <select id="province_id" class="selectpicker form-control" data-live-search="true" title="Pilih Provinsi"  name="province_id" ></select>
                  <span id="province-id-messages" class="span-messages"></span>
            </div>
            
       
      </div>
      <div class="modal-footer">
        <button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan" type="button" class="btn btn-primary" >Simpan</button>
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){


   

        $.ajax({
          url: BASE_URL +'/api/select-province',
          method: 'GET',
          dataType: 'json',
          success: function(data) {
              // Populate SelectPicker options using received data
              var select =  $('#province_id')
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

    $('#province_id').on('select:select', function(e) {
        var selectedOption = e.params.data;
        $('#province_id').val(selectedOption.id);
    });
     
  $("#simpan").click( () => {

          var data = $("#FormSubmit").serializeArray();
          
          var form = {
              'id':data[0].value,
              'name':data[1].value,
              'province_id':data[2].value,
              
             
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
                            window.location.replace('/kabupaten');
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
                if(errors.messages.id)
                {
                     $('#kode-alert').addClass('has-error');
                     $('#kode-messages').addClass('help-block').html('<strong>'+ errors.messages.id +'</strong>');
                }else{
                    $('#kode-alert').removeClass('has-error');
                    $('#kode-messages').removeClass('help-block').html('');
                }

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
 



 


    
 
