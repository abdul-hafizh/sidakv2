
$(function () {
            var currentUrl = window.location.href;
            let segments = currentUrl.split( '/' );
            if(segments[3] =='login')
            {
                $('body').addClass('login-page');
            }else{
                 $('body').addClass('skin-default sidebar-mini'); 
            }   
});