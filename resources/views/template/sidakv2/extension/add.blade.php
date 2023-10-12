    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button"  class="clear-input close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Perpanjangan Periode</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
         
            
            <div id="semester-alert" class="form-group has-feedback" >
              <label>Semester</label>
              <select id="semester" title="Pilih Semester" class="form-control selectpicker" data-style="btn-default"name="semester">
                
                  <option value="01">Semester 1</option>
                  <option value="02">Semester 2</option>
              </select>
              <span id="semester-messages" class="span-messages"></span>
            </div>

            <div id="year-alert" class="form-group has-feedback" >
              <label>Tahun</label>
               <select id="year" title="Pilih Tahun" disabled class="form-control selectpicker" data-style="btn-default"name="year">
                  
              </select>
              <span id="year-messages"></span>
            </div>
            
            <div  style="display:none;" id="confirm_expired" class="form-group has-feedback" >
              <label>Masa Berahir Periode</label>  
           
              <div class="confirm_expired text-bold alert alert-danger alert-dismissible"></div>

            </div>    
          

            <div id="extensiondate-alert" class="form-group has-feedback" >
              <label>Maksimal Tanggal Pengajuan </label>
              <input disabled type="date" id="extensiondate" class="form-control" name="extensiondate" placeholder="Maksimal Tanggal Pengajuan " value="">
              <span id="extensiondate-messages" class="span-messages"></span>
            </div>

           
         
            <div id="description-alert" class="form-group has-feedback" >
              <label>Alasan Pengajuan</label>
              <textarea class="textarea-fixed-replay" name="description" placeholder="Tambahkan keterangan"> </textarea>
              <span id="description-messages" class="span-messages"></span>
            </div>

          





       
      </div>
      <div class="modal-footer">
        <button type="button"  class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="simpan" type="button" class="btn btn-warning" >Simpan</button>
        <button id="kirim" type="button" class="btn btn-primary" >Kirim</button>
      </div>
    </form>
    </div>

  </div>
</div>




<script type="text/javascript">
 $(function(){
    var date_expired = '';


     
    $('#semester').on('change', function() {
       var value = $(this).val();          
        $.ajax({
            url: BASE_URL +'/api/select-year?semester='+ value,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate SelectPicker options using received data
                $.each(data, function(index, option) {
                    $('#year').append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                });

                $('#year').prop('disabled', false);
                $('#year').selectpicker('refresh');
                ChangeYear(data);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }); 

     

 
   function ChangeYear(data){
        

        $('#year').change(function() {
           selectedVal = $(this).find("option:selected").val();
           let find = data.find(o => o.value === selectedVal);
           date_expired = find.enddate;
           $('#extensiondate').prop('disabled', false);
           $('#confirm_expired').show();
           $('.confirm_expired').text(find.enddate_convert);
        });

        $('#extensiondate').on('change', function() {

           var value = $(this).val();          
           if(date_expired > value || date_expired == value)
           {
              $('#simpan').prop('disabled', true).removeClass('btn-primary').addClass('btn-default');
              $('#kirim').prop('disabled', true).removeClass('btn-warning').addClass('btn-default');
              $('#extensiondate-alert').addClass('has-error');
              $('#extensiondate-messages').addClass('help-block').html('<strong>Tanggal pengajuan maksimal lebih dari tanggal masa berahir '+ date_expired +'</strong>');
           }else{
              $('#simpan').prop('disabled', false).removeClass('btn-default').addClass('btn-warning');
              $('#kirim').prop('disabled', false).removeClass('btn-default').addClass('btn-primary');
              $('#extensiondate-alert').removeClass('has-error');
              $('#extensiondate-messages').removeClass('help-block').html('');
           }
        });

        InsertData();

    }

    function InsertData()
    {
         $("#simpan").click( () => {
            CreateData('N');
          
         });

         $("#kirim").click( () => {
            CreateData('Y');
          
         });

  
    }


    function CreateData(status){


        var data = $("#FormSubmit").serializeArray();
         
          var form = {
              
              'semester':data[0].value,
              'year':data[1].value,
              'expireddate':date_expired,
              'extensiondate':data[2].value,
              'description':data[3].value,
              'status':status,
             
             
          };

             if(status == 'Y')
             {
                var vstatus = 'Dikirim';
             }else{
                var vstatus = 'Disimpan';
             } 


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/extension',
            data:form,
            cache: false,
            dataType: "json",
            success: (respons) =>{
                   Swal.fire({
                        title: 'Sukses!',
                        text: 'Berhasil '+ vstatus,
                        icon: 'success',
                        confirmButtonText: 'OK'
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User clicked "Yes, proceed!" button
                            window.location.replace('/extension');
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
               

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

                if(errors.messages.extensiondate)
                {
                     $('#extensiondate-alert').addClass('has-error');
                     $('#extensiondate-messages').addClass('help-block').html('<strong>'+ errors.messages.extensiondate +'</strong>');
                }else{
                    $('#extensiondate-alert').removeClass('has-error');
                    $('#extensiondate-messages').removeClass('help-block').html('');
                }

               
                 if(errors.messages.description)
                {
                     $('#description-alert').addClass('has-error');
                     $('#description-messages').addClass('help-block').html('<strong>'+ errors.messages.description +'</strong>');
                }else{
                    $('#description-alert').removeClass('has-error');
                    $('#description-messages').removeClass('help-block').html('');
                }  

                
            }
          });

    }

  });  

</script>  

 


    
 
