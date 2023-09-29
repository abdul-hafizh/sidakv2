@extends('template/sidakv2/layout.app')
@section('content')
   <div class="wrapper">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <!--Login Page Starts-->
                    <section id="login" class="auth-height">
                        <div class="row full-height-vh m-0">
                            <div class="col-sm-12 d-flex align-items-center justify-content-center">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body auth-img">
                                            <div class="row m-0">
                                                <div class="col-lg-8 d-none d-lg-flex auth-img-bg width-732 pd-none">
                                                    <img src="/template/sidakv2/img/gedung_bkpm.png" alt="" class="img-fluid"  >
                                                </div>
                                                <div class="col-lg-4 col-12 px-4 py-3 width-365">
                                                    
                                                    <div class="pull-left full pd-top-40">
                                                      <div class="login-center-bkpm">  
                                                        <img src="/template/sidakv2/img/logo_bpkm.png" alt="" class="img-fluid"  >
                                                      </div>  
                                                    </div>

                                                    <div class="pull-left full pd-top-40">
                                                      <div class="login-center-sidak">  
                                                        <img src="/template/sidakv2/img/logo_sidak.png" alt="" class="img-fluid"  >
                                                      </div>  
                                                    </div>

                                                    <div class="pull-left full pd-bottom-10">
                                                       <h3 class="text-capitalize text-center text-bold">Selamat Datang</h3>
                                                    </div> 

                                                    <div  id="confirmation">
                                                    </div>

                                                     <div id="FormLogin">
                                                     </div>

                                                    <div class="pull-left full pd-copyright">
                                                                    <p class="text-center  color-grey-light  font-sm-1 text-bold-600">Copyright by BKPM</p>

                                                                    <p class="text-center color-grey  font-sm-0 text-bold-600">Version 2.0</p>
                                                    </div>
                                                    

                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Login Page Ends-->
                </div>
            </div>
            <!-- END : End Main Content-->
        </div>
    </div>


   


<script type="text/javascript">
$(function(){
   var url = window.location.href; 
   var currentDomain = window.location.hostname;
   var segments = url.split('/'); 
   if(segments[3])
   {
     var token = segments[3].split('?req='); 
     if(token[0] == 'forgot')
     {
      checkEncrypt(token[1]); 
     }  
   }  
   


   function checkEncrypt(token){
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
         $.ajax({
            url: BASE_URL +'/forgot/checkexpired',
            method: 'POST',
            data:{token:token,'_token':csrfToken,},
            dataType: 'json',
            success: function(response) {

              if(response.status ==true)
              {
                InputNewPassword(response.data);
              } 
               
             

            },
            error: function(error) {
                

                var response = error.responseJSON;
                var row = '';
                  row +='<div class="confirmation alert pull-left full alert-danger alert-dismissible">';
                 row +='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                 row +=''+ response.messages +'';
                   row +='</div>';
                                                  
                 $('#confirmation').html(row);


                 ViewBtnBack()
            }
        });
   }


   function ViewBtnBack(){
                var rows = '';
                rows +='<div  class="pull-left full  mgn-top-bottom-10">';
                       

                          rows +='<button id="Kembali" type="button" class="btn bg-navy btn-block btn-flat border-radius-20">Kembali Login</button>';
                                                           
                rows +='</div> ';
            

       $('#FormLogin').html(rows);

       $("#Kembali").click( () => {
          window.location.href = BASE_URL+ '/login';
       });

   }

   function InputNewPassword(email){


     var row = '';
         $('#token-alert').removeClass('has-error');
         $('#token-messages').removeClass('help-block').html('');
       
            //       row +='<div class="pull-left full form-group has-feedback">';
            //    row +='<div id="countdown">02:00</div>';
            // row +='</div>';
                                                          
                row +='<div id="password-alert" class="pull-left full form-group has-feedback">';    
                    row +='<label class="text-capitalize color-dark-blue font-label-login font-12">Password </label>';
                    row +='<input id="password" name="password" type="password" class="form-control mb-3 border-radius-10 font-12" placeholder="Password">';
                    row +='<span id="password-messages"></span>';
                row +='</div>';

                row +='<div id="password-confirmation-alert" class="pull-left full form-group has-feedback">';    
                    row +='<label class="text-capitalize color-dark-blue font-label-login font-12">Konfirmasi Password </label>';
                    row +='<input id="password-confirmation" name="password-confirmation" type="password" class="form-control mb-3 border-radius-10 font-12" placeholder="Konfirmasi Password">';
                    row +='<span id="password-confirmation-messages"></span>';
                row +='</div>';
      
        
                row +='<div class="pull-left full form-group has-feedback">';
                    row +='<div  class="pull-left full  mgn-top-bottom-10">';
                            row +='<button id="UpdateSubmit"  type="button"   class="btn btn-primary btn-block btn-flat border-radius-20">Update</button>';

                            row +='<button style="display:none;" id="Updateloading" disabled type="button"   class="btn btn-default btn-block btn-flat border-radius-20"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>';

                                                               
                    row +='</div> ';
                row +='</div> ';

       $('#FormLogin').html(row);

      

       ActionUpdatePassword(email)
    
  }


   function Countdown(token){

        var countdownDuration = 2 * 60 * 1000; // 2 minutes * 60 seconds * 1000 milliseconds
        // Calculate the target date and time
        var targetDate = new Date().getTime() + countdownDuration;

        // Update the countdown every 1 second
        var countdownInterval = setInterval(function () {
            var currentDate = new Date().getTime();
            var timeLeft = targetDate - currentDate;

            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
               $('#countdown').html('Countdown expired!');
               checkEncrypt(token);
            } else {
                var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                // Format the time as MM:SS
                var formattedTime = ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

                // Display the formatted time in the countdown element
                $('#countdown').html(formattedTime);
                checkEncrypt(token);
            }
        }, 1000);
    }




   function ActionUpdatePassword(email){
     
       $("#UpdateSubmit").click( () => {
          $('.confirmation').remove();
        
          var password = $('#password').val();
          var passwordConfirmation = $('#password-confirmation').val();
          var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $("#UpdateSubmit").hide(); 
          $("#Updateloading").show();
           $('.confirmation').remove(); 
          
          var form = {
              '_token':csrfToken,
              'email':email,
              'password':password,
              'password_confirmation':passwordConfirmation,
          } 


          $.ajax({
            type:"POST",
            url: BASE_URL+'/updatepassword',
            data:form,
            cache: false,
            dataType: "json",
            success: (respons) =>{
                 
                

                 var row = '';
                  row +='<div class="confirmation alert pull-left full alert-success alert-dismissible">';
                 row +='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                 row +=''+ respons.messages +'';
                   row +='</div>';
                                                  
                 $('#confirmation').html(row);
                  window.location.href = BASE_URL+ '/login';

            },
            error: (respons)=>{

               $("#UpdateSubmit").show(); 
               $("#Updateloading").hide();  

                $('.confirmation').remove(); 
               
              var  errors = respons.responseJSON;
              
                if(errors.messages.password)
                {
                     $('#password-alert').addClass('has-error');
                     $('#password-messages').addClass('help-block').html('<strong>'+ errors.messages.password +'</strong>');
                }else{
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

  }

});



</script>
<style>
.wrapper {
    position: relative;
    top: 0;
    height: 100%;
    overflow: hidden;
    margin:inherit!important;
    min-height: calc(100vh - 3.98rem);
}

.wrapper .main-panel {
    margin: 0;
    padding: 0;
}

.wrapper .main-panel .main-content {
    padding: 0 !important;
    margin: 0;
}

.wrapper .content-overlay {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: calc(100% + 54px);
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    cursor: pointer;
    transition: all 0.7s;
    z-index: -1;
    visibility: visible;
}
.wrapper .main-panel .main-content .content-wrapper {
    padding: 0;
    margin-left: inherit!important;
    z-index:inherit!important;
    background-color: inherit!important;
}

.auth-height {
    overflow: auto;
}

.full-height-vh {
    height: 100vh !important;
    height: calc(var(--vh, 1vh) * 100) !important;
}
.m-0 {
    margin: 0 !important;
}
.align-items-center {
    align-items: center !important;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.justify-content-center {
    justify-content: center !important;
}

.width-732{
    width: 732px!important;
}

.width-365{
    width: 365px!important;
}

.card {
    margin: 15px 0;
    box-shadow: -8px 8px 14px 0 rgba(25, 42, 70, 0.11);
}
.overflow-hidden {
    overflow: hidden !important;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, 0.125);
    border-radius:0px;
}
.auth-page .auth-img {
    padding: 0;
}
.card-body {
    flex: 1 1 auto;
    min-height: 1px;
   
}


.auth-page .auth-img .auth-img-bg {
    background-color: #f5f5f5;
}
.p-3 {
    padding: 1.5rem !important;
}
.img-fluid {
    width: 100%;
    height: 100%;
}

.pl-4, .px-4 {
    padding-left: 2.25rem !important;
}
.pr-4, .px-4 {
    padding-right: 2.25rem !important;
}
.pb-3, .py-3 {
    padding-bottom: 1.5rem !important;
}
.pt-3, .py-3 {
    padding-top: 1.5rem !important;
}


.mb-2, .my-2 {
    margin-bottom: 0.75rem !important;
}

.mb-3, .my-3 {
    margin-bottom: 1.5rem !important;
}


.login-center-bkpm{
    margin: 0px auto;
    width: 27%;
}
.login-center-sidak {
    margin: 0px auto;
    width: 45%;
}
.pd-top-40 {
    padding: 40px 0px 0px;
}
.pd-bottom-10 {
    padding: 0px 0px 10px;
}
.pd-top-bottom-20 {
    padding: 20px 0px;
}

.form-group{
    margin: 0px!important;
    padding: 0px 30px;
}
.mgn-top-bottom-10{
  margin: 10px 0px!important;
}

.pd-copyright{
    padding: 125px 0px 0px;
}
.color-grey-light{
    color: #616060;
}
.font-sm-0 {
    font-size: 0.9rem ;
}
.font-sm-1 {
    font-size: 1rem ;
}
.text-bold-600{
    font-weight: 600;
}
</style>
@stop