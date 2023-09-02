<!-- Modal -->
<div id="modal-profile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Profile</h4>
      </div>
      <form id="FormSubmit">
        <div id="listProfile" class="modal-body" >



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button id="simpan" type="button" class="btn btn-primary">Update</button>
          <button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
        </div>
    </div>




    <script type="text/javascript">
      $(function() {
        

       $.ajax({
            url: BASE_URL +'/api/user/profile',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
               
               GetFormModal(response.data);
            },
            error: function(error) {
            console.error(error);
            }
        });
        
        $("#simpan").click(() => {
          $("#simpan").hide();
          $("#load-simpan").show();

          var data = $("#FormSubmit").serializeArray();
         
          var form = {
           
            'name': data[0].value,
            'email': data[1].value,
            'phone': data[2].value,
            'nip': data[3].value,
            'leader_name': data[4].value,
            'leader_nip': data[5].value,
            
          };
          $.ajax({
            type: "POST",
            url: BASE_URL + '/api/user/update',
            data: form,
            cache: false,
            dataType: "json",
            success: (respons) => {
              Swal.fire({
                title: 'Sukses!',
                text: 'Berhasil Diupdate',
                icon: 'success',
                confirmButtonText: 'OK'

              }).then((result) => {
                if (result.isConfirmed) {
                  // User clicked "Yes, proceed!" button
                  location.reload();   
                }
              });

              //
            },
            error: (respons) => {
              var errors = respons.responseJSON;
              $("#simpan").show();
              $("#load-simpan").hide();
              

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

             
            }
          });
        });


        function GetFormModal(data)
        {
          var row ='';
 
            

              row +='<div id="username-alert" class="form-group has-feedback">';
             row +='<label>Username</label>';
             row +='<input type="text" disabled class="form-control" name="username" placeholder="Username" value="'+ data.username +'">';
             row +='<span id="username-messages"></span>';
           row +='</div>';

           row +='<div id="name-alert" class="form-group has-feedback">';
             row +='<label>Name</label>';
             row +='<input type="text" class="form-control" name="name" placeholder="Name" value="'+ data.name +'">';
             row +='<span id="name-messages"></span>';
           row +='</div>';


           row +='<div id="email-alert" class="form-group has-feedback">';
             row +='<label>Email</label>';
             row +='<input type="email" class="form-control" name="email" placeholder="email" value="'+ data.email +'">';
             row +='<span id="email-messages"></span>';
           row +='</div>';

           row +='<div id="phone-alert" class="form-group has-feedback">';
             row +='<label>Phone</label>';
             row +='<input type="text" class="form-control" name="phone" placeholder="phone" value="'+ data.phone +'">';
             row +='<span id="phone-messages"></span>';
           row +='</div>';


           row +='<div id="nip-alert" class="form-group has-feedback">';
             row +='<label>NIP</label>';
             row +='<input type="text" class="form-control" name="nip" placeholder="NIP" value="'+ data.nip +'">';
             row +='<span id="nip-messages"></span>';
           row +='</div>';

           row +='<div id="leader-name-alert" class="form-group has-feedback">';
             row +='<label>Penanggung Jawab</label>';
             row +='<input type="text" class="form-control" name="leader_name" placeholder="Penanggung Jawab " value="'+ data.leader_name +'">';
             row +='<span id="leader-name-messages"></span>';
           row +='</div>';

           row +='<div id="leader-nip-alert" class="form-group has-feedback">';
             row +='<label>NIP Penanggung Jawab</label>';
             row +='<input type="text" class="form-control" name="leader_nip" placeholder="NIP Penanggung Jawab" value="'+ data.leader_nip +'">';
             row +='<span id="leader-nip-messages"></span>';
           row +='</div>';

           $('#listProfile').html(row);


        }

      });

    </script>