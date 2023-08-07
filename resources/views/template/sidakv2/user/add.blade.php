    
    
<!-- Modal -->
<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <form  id="FormSubmit" >
      <div class="modal-body">
        
           

                <div id="username-alert" class="form-group has-feedback" >
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Username" value="">
                  <span id="username-messages"></span>
                </div>

                <div id="name-alert" class="form-group has-feedback" >
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Name" value="">
                  <span id="name-messages"></span>
                </div>


                <div id="email-alert" class="form-group has-feedback">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="email" value="">
                  <span id="email-messages"></span>
                </div>

                <div id="phone-alert" class="form-group has-feedback">
                  <label>Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="phone" value="">
                  <span id="phone-messages"></span>
                </div>


                <div id="nip-alert" class="form-group has-feedback">
                  <label>NIP</label>
                  <input type="text" class="form-control" name="nip" placeholder="NIP" value="">
                  <span id="nip-messages"></span>
                </div>

                <div id="leader-name-alert" class="form-group has-feedback">
                  <label>Penanggung Jawab</label>
                  <input type="text" class="form-control" name="leader_name" placeholder="Penanggung Jawab " value="">
                  <span id="leader-name-messages"></span>
                </div>

                <div id="leader-nip-alert" class="form-group has-feedback">
                  <label>NIP Penanggung Jawab</label>
                  <input type="text" class="form-control" name="leader_nip" placeholder="NIP Penanggung Jawab" value="">
                   <span id="leader-nip-messages"></span>
                </div>

                <div id="daerah-alert" class="form-group has-feedback">
                    <label>Daerah </label>
                  <select class="js-example-basic-single form-control" name="daerah_id" >
                      <option value="">Pilih Daerah</option>
                      @foreach($daerah as $index => $item)
                     
                        <option value="{{ $item->value }}">{{ $item->text }}</option>
                      @endforeach
                    </select>
                  <span id="daerah-messages"></span>
                </div>

                <div id="password-alert" class="form-group has-feedback" >
                   <label>Password </label>
                    <input type="password" class="form-control" name="password" placeholder="Password" >
                    <span id="password-messages"></span>

                   
                </div>

                <div id="password-confirmation-alert" class="form-group has-feedback">
                  <label>Konfirmasi Password </label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password" >
                <span id="password-confirmation-messages"></span>
                </div>


       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
              'username':data[0].value,
              'name':data[1].value,
              'email':data[2].value,
              'phone':data[3].value,
              'nip':data[4].value,
              'leader_name':data[5].value,
              'leader_nip':data[6].value,
              'daerah_id':data[7].value,
              'password':data[8].value,
              'password_confirmation':data[9].value,
          };

              var errors = {
                  messages: {
                      username:'',
                      name:'',
                      email:'',
                      phone:'',
                      nip:'',
                      daerah_id:'',
                      password:'',
                      password_confirmation:'', 
                      leader_name:'',
                      leader_nip:'', 
                        
                  },
              };

          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/user',
            data:form,
            cache: false,
            dataType: "json",
            success: (respons) =>{
                   // Swal.fire({
                   //      title: 'Sukses!',
                   //      text: 'Berhasil Disimpan',
                   //      icon: 'success',
                   //      confirmButtonText: 'OK'
                        
                   //  });
                   // window.location.replace(BASE_URL+'/user');
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
                if(errors.messages.username)
                {
                     $('#username-alert').addClass('has-error');
                     $('#username-messages').addClass('help-block').html('<strong>'+ errors.messages.username +'</strong>');
                }else{
                    $('#username-alert').removeClass('has-error');
                    $('#username-messages').removeClass('help-block').html('');
                }

                if(errors.messages.name)
                {
                     $('#name-alert').addClass('has-error');
                     $('#name-messages').addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
                }else{
                    $('#name-alert').removeClass('has-error');
                    $('#name-messages').removeClass('help-block').html('');
                }

                 if(errors.messages.email)
                {
                     $('#email-alert').addClass('has-error');
                     $('#email-messages').addClass('help-block').html('<strong>'+ errors.messages.email +'</strong>');
                }else{
                    $('#email-alert').removeClass('has-error');
                    $('#email-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.phone)
                {
                     $('#phone-alert').addClass('has-error');
                     $('#phone-messages').addClass('help-block').html('<strong>'+ errors.messages.phone +'</strong>');
                }else{
                    $('#phone-alert').removeClass('has-error');
                    $('#phone-messages').removeClass('help-block').html('');
                }

                if(errors.messages.nip)
                {
                     $('#nip-alert').addClass('has-error');
                     $('#nip-messages').addClass('help-block').html('<strong>'+ errors.messages.nip +'</strong>');
                }else{
                    $('#nip-alert').removeClass('has-error');
                    $('#nip-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.daerah_id)
                {
                     $('#daerah-alert').addClass('has-error');
                     $('#daerah-messages').addClass('help-block').html('<strong>'+ errors.messages.daerah_id +'</strong>');
                }else{
                    $('#daerah-alert').removeClass('has-error');
                    $('#daerah-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.leader_name)
                {
                     $('#leader-name-alert').addClass('has-error');
                     $('#leader-name-messages').addClass('help-block').html('<strong>'+ errors.messages.leader_name +'</strong>');
                }else{
                    $('#leader-name-alert').removeClass('has-error');
                    $('#leader-name-messages').removeClass('help-block').html('');
                } 

                 if(errors.messages.leader_nip)
                {
                     $('#leader-nip-alert').addClass('has-error');
                     $('#leader-nip-messages').addClass('help-block').html('<strong>'+ errors.messages.leader_nip +'</strong>');
                }else{
                    $('#leader-nip-alert').removeClass('has-error');
                    $('#leader-nip-messages').removeClass('help-block').html('');
                }  

                 if(errors.messages.password)
                {
                     $('#password-alert').addClass('has-error');
                     $('#password-messages').addClass('help-block').html('<strong>'+ errors.messages.password +'</strong>');
                }else{
                    $('#password-alert').removeClass('has-error');
                    $('#password-messages').removeClass('help-block').html('');
                }  

                 if(errors.messages.password_confirmation)
                {
                     $('#password-confirmation-alert').addClass('has-error');
                     $('#password-confirmation-messages').addClass('help-block').html('<strong>'+ errors.messages.password_confirmation +'</strong>');
                }else{
                    $('#password-confirmation-alert').removeClass('has-error');
                    $('#password-confirmation-messages').removeClass('help-block').html('');
                }  
            }
          });
     });

  });
  </script>
 

</script>  

 


    
 
