<aside id="sidebar-wrapper" class="main-sidebar">
	<section class="sidebar">
		<div class="logo">
			<div class="pd-logo-sidebar pull-left">
				<a href="#"  id="logo">
					
				</a>
			</div> 
			<div class="toogle-menu pull-left d-sm-block ">
				<a href="#" data-toggle="push-menu" role="button" class="sidebar-toggle">
					<i class="fa fa-chevron-left"></i>
				</a>
			</div>
		</div> 
		<div class="user-panel">
			<div class="pull-left full pd-img-sidebar">
				<div id="img_profile" class="mgn-center-img picture-mini">
					
				</div>
			</div> 
			<div class="pull-left full info">
				<div class="text-center">
					<p>Welcome Back {{ Cookie::get('access') }}</p>
					<p id="username" class="font-bold text-capitalize"></p>
				</div>
			</div>
		</div> 
		<div class="menus">
			<div data-widget="tree" class="sidebar-menu tree">
				<li class="header main-nav">MAIN NAVIGATION</li>
				 @include('template/sidakv2/layout.menu')
				
			</div>
		</div>
	</section>
</aside>

<script type="text/javascript">
	 $(function(){
        const apps  = JSON.parse(localStorage.getItem('apps')); 
        const user_sidebar  = JSON.parse(localStorage.getItem('user_sidebar'));
        
         $("#logo").html('<img src="'+ apps.logo_lg +'" class="img-logo">');         
         $('#img_profile').html('<img class="img-circle" src="'+ user_sidebar.photo +'" alt="'+ user_sidebar.fullname +'">');
          
         $('#username').html(user_sidebar.fullname);
           

       

	 }); 	

</script>