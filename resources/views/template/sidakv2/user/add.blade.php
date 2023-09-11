<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="close1" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <form id="FormSubmit">
        <div class="modal-body">

          <div id="role-alert" class="form-group has-feedback">
            <label>Role </label>
            <select id="role_id"  data-style="btn-default" title="Pilih Role" class="selectpicker form-control" name="role_id">

            </select>
            <span id="role-messages"></span>
          </div>

          <div id="username-alert" class="form-group has-feedback">
            <label>Username</label>
            <input id="username-add" type="text" class="form-control" name="username" placeholder="Username" value="">
            <span id="username-messages"></span>
          </div>

          <div id="name-alert" class="form-group has-feedback">
            <label>Name</label>
            <input id="name-add" type="text" class="form-control" name="name" placeholder="Name" value="">
            <span id="name-messages"></span>
          </div>


          <div id="email-alert" class="form-group has-feedback">
            <label>Email</label>
            <input id="email-add" type="email" class="form-control" name="email" placeholder="email" value="">
            <span id="email-messages"></span>
          </div>

          <div id="phone-alert" class="form-group has-feedback">
            <label>Phone</label>
            <input id="phone-add" type="text" class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '');"  name="phone" placeholder="phone" value="">
            <span id="phone-messages"></span>
          </div>


          <div id="nip-alert" class="form-group has-feedback">
            <label>NIP</label>
            <input id="nip-add" type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" name="nip" placeholder="NIP" value="">
            <span id="nip-messages"></span>
          </div>

          <div id="leader-name-alert" class="form-group has-feedback">
            <label>Penanggung Jawab</label>
            <input id="leader-name-add" type="text" class="form-control" name="leader_name" placeholder="Penanggung Jawab " value="">
            <span id="leader-name-messages"></span>
          </div>

          <div id="leader-nip-alert" class="form-group has-feedback">
            <label>NIP Penanggung Jawab</label>
            <input id="leader-nip-add" type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" name="leader_nip" placeholder="NIP Penanggung Jawab" value="">
            <span id="leader-nip-messages"></span>
          </div>

         

          <div id="daerah-alert-add" class="form-group has-feedback">
           
          </div>

         

          <div id="password-alert" class="form-group has-feedback">
            <label>Password </label>
            <input id="password-add" type="password" class="form-control" name="password" placeholder="Password">
            <span id="password-messages"></span>


          </div>

          <div id="password-confirmation-alert" class="form-group has-feedback">
            <label>Konfirmasi Password </label>
            <input id="password-confirmation-add" type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password">
            <span id="password-confirmation-messages"></span>
          </div>


            <div  class="form-group has-feedback">
              <label>Photo </label>
              <div  class="user-photo camera_upload">
                <img id="user-photo" width="130" src="{{ url('template/sidakv2/img/user.png') }}" alt="admin sidak">
                <i id="addPhotos" class="icon fa fa-camera"></i>
                <input id="AddFiles" type="file" name="upload_photo" style="display:none">
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="close2" class="btn btn-default" data-dismiss="modal">Tutup</button>

          <button id="simpan" type="button" class="btn btn-primary">Simpan</button>
          <button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
        </div>
    </div>




    <script type="text/javascript">
      $(function() {
        var role_id = ''; 
       
        var photo = '';
           
        $("#close1").click(()=> {   
          DefaultNull();
        });

         $("#close2").click(()=> {   
          DefaultNull();
        });


      

        $('#daerah-alert-add').hide(); 
        $('#role_id').change(function() {
            selectedText = $(this).find("option:selected").text();
            role_id = $('#role_id').val(); 

            if(selectedText =='Admin' || selectedText =='Pusat')
            {
              $('#daerah-alert-add').hide();
            }else{
              $('#daerah-alert-add').show();
            }  
             
            selectDaerah();

        });

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
                    $('#user-photo').attr("src", photo);
                }else if(files[0].name.toUpperCase().includes(".JPEG")){
                    photo = fileReader.result;
                    $('#user-photo').attr("src", photo);
                }else if(files[0].name.toUpperCase().includes(".JPG")){
                    photo = fileReader.result;
                    $('#user-photo').attr("src", photo);
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

          
       
     

        
        $.ajax({
            url: BASE_URL +'/api/select-role',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate SelectPicker options using received data
                var select =  $('#role_id')
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


        


      $("#simpan").click(() => {
          $("#simpan").hide();
          $("#load-simpan").show();

          var data = $("#FormSubmit").serializeArray();
          
          if(data.length == 10)
          {
              var form = {
              'role_id': data[0].value,
              'username': data[1].value,
              'name': data[2].value,
              'email': data[3].value,
              'phone': data[4].value,
              'nip': data[5].value,
              'leader_name': data[6].value,
              'leader_nip': data[7].value,
              'daerah_id': data[8].value,
              'password_confirmation': data[9].value,
              'photo':photo,
            }; 

          }else{

             var form = {
            'role_id': data[0].value,
            'username': data[1].value,
            'name': data[2].value,
            'email': data[3].value,
            'phone': data[4].value,
            'nip': data[5].value,
            'leader_name': data[6].value,
            'leader_nip': data[7].value,
            'daerah_id': data[8].value,
            'password': data[9].value,
            'password_confirmation': data[10].value,
            'photo':photo,
          };

          }  
         
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/user',
            data: form,
            cache: false,
            dataType: "json",
            success: (respons) => {
              Swal.fire({
                title: 'Sukses!',
                text: 'Berhasil Disimpan',
                icon: 'success',
                confirmButtonText: 'OK'

              }).then((result) => {
                if (result.isConfirmed) {
                  // User clicked "Yes, proceed!" button
                  window.location.replace('/user');
                }
              });

              //
            },
            error: (respons) => {
              var errors = respons.responseJSON;
              $("#simpan").show();
              $("#load-simpan").hide();
              if (errors.messages.username) {
                $('#username-alert').addClass('has-error');
                $('#username-messages').addClass('help-block').html('<strong>' + errors.messages.username + '</strong>');
              } else {
                $('#username-alert').removeClass('has-error');
                $('#username-messages').removeClass('help-block').html('');
              }

              if (errors.messages.name) {
                $('#name-alert').addClass('has-error');
                $('#name-messages').addClass('help-block').html('<strong>' + errors.messages.name + '</strong>');
              } else {
                $('#name-alert').removeClass('has-error');
                $('#name-messages').removeClass('help-block').html('');
              }


              if (errors.messages.email) {
                $('#email-alert').addClass('has-error');
                $('#email-messages').addClass('help-block').html('<strong>' + errors.messages.email + '</strong>');
              } else {
                $('#email-alert').removeClass('has-error');
                $('#email-messages').removeClass('help-block').html('');
              }

              if (errors.messages.phone) {
                $('#phone-alert').addClass('has-error');
                $('#phone-messages').addClass('help-block').html('<strong>' + errors.messages.phone + '</strong>');
              } else {
                $('#phone-alert').removeClass('has-error');
                $('#phone-messages').removeClass('help-block').html('');
              }

              if (errors.messages.nip) {
                $('#nip-alert').addClass('has-error');
                $('#nip-messages').addClass('help-block').html('<strong>' + errors.messages.nip + '</strong>');
              } else {
                $('#nip-alert').removeClass('has-error');
                $('#nip-messages').removeClass('help-block').html('');
              }

              if (errors.messages.daerah_id) {
                
                $('#daerah-alert-add').addClass('has-error');
                $('#daerah-messages-add').addClass('help-block').html('<strong>' + errors.messages.daerah_id + '</strong>');
              } else {
                $('#daerah-alert-add').removeClass('has-error');
                $('#daerah-messages-add').removeClass('help-block').html('');
              }

              if (errors.messages.role_id) {
                $('#role-alert').addClass('has-error');
                $('#role-messages').addClass('help-block').html('<strong>' + errors.messages.role_id + '</strong>');
              } else {
                $('#role-alert').removeClass('has-error');
                $('#role-messages').removeClass('help-block').html('');
              }

              if (errors.messages.leader_name) {
                $('#leader-name-alert').addClass('has-error');
                $('#leader-name-messages').addClass('help-block').html('<strong>' + errors.messages.leader_name + '</strong>');
              } else {
                $('#leader-name-alert').removeClass('has-error');
                $('#leader-name-messages').removeClass('help-block').html('');
              }

              if (errors.messages.leader_nip) {
                $('#leader-nip-alert').addClass('has-error');
                $('#leader-nip-messages').addClass('help-block').html('<strong>' + errors.messages.leader_nip + '</strong>');
              } else {
                $('#leader-nip-alert').removeClass('has-error');
                $('#leader-nip-messages').removeClass('help-block').html('');
              }

              if (errors.messages.password) {
                $('#password-alert').addClass('has-error');
                $('#password-messages').addClass('help-block').html('<strong>' + errors.messages.password + '</strong>');
              } else {
                $('#password-alert').removeClass('has-error');
                $('#password-messages').removeClass('help-block').html('');
              }

              if (errors.messages.password_confirmation) {
                $('#password-confirmation-alert').addClass('has-error');
                $('#password-confirmation-messages').addClass('help-block').html('<strong>' + errors.messages.password_confirmation + '</strong>');
              } else {
                $('#password-confirmation-alert').removeClass('has-error');
                $('#password-confirmation-messages').removeClass('help-block').html('');
              }
            }
          });
        });




        function DefaultNull(){

           $('#daerah-alert-add').hide();
           $("input").val(null);
           $('#role_id').selectpicker('val', 'null');
           $('#kabupaten_id').selectpicker('val', 'null');
           $('#province_id').selectpicker('val', 'null');
           $('#modal-add').modal('toggle');

        }

        function selectDaerah(){
           
          if(role_id == 'province')
          { 
             
           
             val = '';
             val +='<label>Provinsi</label>';
             val +='<select id="province_id"  data-style="btn-default" title="Pilih Provinsi" class="selectpicker form-control" name="province_id"  data-live-search="true"></select>';
             val +='<span id="daerah-messages-add"></span>';
             $('#daerah-alert-add').html(val);
         
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
              

          }else{
             
             var text_label = '';
             val = '';
             val +='<label>Kabupaten / Kota</label>';
             val +='<select id="kabupaten_id"  data-style="btn-default" title="Kabupaten / Kota" class="selectpicker form-control" name="kabupaten_id"  data-live-search="true"></select>';
             val +='<span id="daerah-messages-add"></span>';
             $('#daerah-alert-add').html(val);

              $.ajax({
              url: BASE_URL +'/api/select-kabupaten',
              method: 'GET',
              dataType: 'json',
              success: function(data) {
                  // Populate SelectPicker options using received data
                  var select =  $('#kabupaten_id')
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

          }  

        }

      });
    </script>


   