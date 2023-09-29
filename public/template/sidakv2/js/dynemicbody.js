
$(function () {
            var currentUrl = window.location.href;
            let segments = currentUrl.split( '/' );
           
            if(segments[3] =='login')
            {
                $('body').addClass('login-page ');
            }else{

                 let request = segments[3].split( '?' );
                 if(request)
                 {
                     if(request[0] === 'forgot')
                     {
                        $('body').addClass('login-page ');   
                     }else{
                        $('body').addClass('skin-blue sidebar-mini');    
                     }    
                    
                 }else{
                    $('body').addClass('skin-blue sidebar-mini');  
                 }    
                 
            }   
});