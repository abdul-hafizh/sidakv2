<aside id="sidebar-wrapper" class="main-sidebar">
	<section class="sidebar">
		<div class="logo">
			<div class="pd-logo-sidebar pull-left">
				<a href="#">
					<img src="{{ $sidebar->logo_lg  }}" class="img-logo">
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
				<div class="mgn-center-img picture-mini">
					<img class="img-circle " src="/template/sidakv2/img/user.png" alt="admin sidak">
				</div>
			</div> 
			<div class="pull-left full info">
				<div class="text-center">
					<p>Welcome Back</p>
					<p class="font-bold">{{ Auth::user()->username }}</p>
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
          $(function(){
           $.ajax({
            type:"GET",
            url: BASE_URL+'/api/user/menu',
            cache: false,
            dataType: "json",
            success: (respons) =>{
                  console.log(respons)
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
               
            }
          });

         });

	 }); 	

</script>