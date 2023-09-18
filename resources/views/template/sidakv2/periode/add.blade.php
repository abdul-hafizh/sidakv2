    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close1" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Periode</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
         

            

            <div id="semester-alert" class="form-group has-feedback" >
              <label>Semester</label>
              <select id="semester" class="form-control selectpicker" data-style="btn-default"name="semester">
                  <option value="">Pilih Semester</option>
                  <option value="01">Semester 1</option>
                  <option value="02">Semester 2</option>
              </select>
              <span id="semester-messages" class="span-messages"></span>
            </div>

            <div id="year-alert" class="form-group has-feedback" >
              <label>Tahun</label>
              <input type="text" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="year" placeholder="Tahun" value="">
              <span id="year-messages"></span>
            </div>

            <div id="startdate-alert" class="form-group has-feedback" >
              <label>Tanggal Mulai</label>
              <input type="date" class="form-control" name="startdate" placeholder="Tanggal Mulai" value="">
              <span id="startdate-messages" class="span-messages"></span>
            </div>

            <div id="enddate-alert" class="form-group has-feedback" >
              <label>Tanggal Berahir</label>
              <input type="date" class="form-control" name="enddate" placeholder="Tanggal Berahir" value="">
              <span id="enddate-messages" class="span-messages"></span>
            </div>

         
            <div id="description-alert" class="form-group has-feedback" >
              <label>Keterangan</label>
              <textarea class="textarea-fixed-replay" name="description" placeholder="Tambahkan keterangan"> </textarea>
              <span id="description-messages" class="span-messages"></span>
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

   
     
  $("#simpan").click( () => {

          var data = $("#FormSubmit").serializeArray();
         
          var form = {
              
              'semester':data[0].value,
              'year':data[1].value,
              'startdate':data[2].value,
              'enddate':data[3].value,
              'description':data[4].value,
              'status':data[5].value,
             
          };


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/periode',
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
                            window.location.replace('/periode');
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

                if(errors.messages.semester)
                {
                     $('#semester-alert').addClass('has-error');
                     $('#semester-messages').addClass('help-block').html('<strong>'+ errors.messages.semester +'</strong>');
                }else{
                    $('#semester-alert').removeClass('has-error');
                    $('#semester-messages').removeClass('help-block').html('');
                }

                if(errors.messages.year)
                {
                     $('#year-alert').addClass('has-error');
                     $('#year-messages').addClass('help-block').html('<strong>'+ errors.messages.year +'</strong>');
                }else{
                    $('#year-alert').removeClass('has-error');
                    $('#year-messages').removeClass('help-block').html('');
                }

                if(errors.messages.startdate)
                {
                     $('#startdate-alert').addClass('has-error');
                     $('#startdate-messages').addClass('help-block').html('<strong>'+ errors.messages.startdate +'</strong>');
                }else{
                    $('#startdate-alert').removeClass('has-error');
                    $('#startdate-messages').removeClass('help-block').html('');
                }

                if(errors.messages.enddate)
                {
                     $('#enddate-alert').addClass('has-error');
                     $('#enddate-messages').addClass('help-block').html('<strong>'+ errors.messages.enddate +'</strong>');
                }else{
                    $('#enddate-alert').removeClass('has-error');
                    $('#enddate-messages').removeClass('help-block').html('');
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
 

</script>  

 


    
 
