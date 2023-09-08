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
				<div id="img_profile" class="mgn-center-img picture-mini camera_upload">
					
				</div>
			</div> 
			<div class="pull-left full info">
				<div class="text-center">
					<p>Selamat Datang {{ Cookie::get('access') }}</p>
					<p id="username" class="font-bold text-capitalize"></p>
				</div>
			</div>
		</div> 
		<div class="menus">
			<div data-widget="tree" class="sidebar-menu tree">
				<li class="header main-nav text-center">MENU</li>
				 @include('template/sidakv2/layout.menu')
				
			</div>
		</div>
	</section>
</aside>

<script type="text/javascript">
	 $(function(){
	 	var photo = '';
        const apps  = JSON.parse(localStorage.getItem('apps')); 
        const user_sidebar  = JSON.parse(localStorage.getItem('user_sidebar'));
        
         $("#logo").html('<img src="'+ apps.logo_lg +'" class="img-logo">');         
         var row = '';
             row +='<img class="img-circle" src="'+ user_sidebar.photo +'" alt="'+ user_sidebar.fullname +'">';
             row +='<i id="addPhoto" class="icon fa fa-camera"></i>';
             row +='<input id="AddFile" type="file" name="upload_photo" style="display:none">'; 
         $('#img_profile').html(row);

         $("#addPhoto").click(()=> {
	           $("#AddFile").trigger("click");
	     });

	    $("#AddFile").change((event)=> {     
	        
	          const files = event.target.files
              let filename = files[0].name
              const fileReader = new FileReader()
              fileReader.addEventListener('load', () => {

              	if(files[0].name.toUpperCase().includes(".PNG"))
                {
                	photo = fileReader.result;
                	UploadData(photo);
                }else if(files[0].name.toUpperCase().includes(".JPEG")){
                    photo = fileReader.result;
                    UploadData(photo);
                }else if(files[0].name.toUpperCase().includes(".JPG")){
                    photo = fileReader.result;
                    UploadData(photo);
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
          
        $('#username').html(user_sidebar.fullname);
           
        function UploadData(photo,fullname)
        {
              localStorage.removeItem('user_sidebar');
            var row = '';
             row +='<img class="img-circle" src="'+ photo +'" alt="'+ user_sidebar.fullname +'">';
             row +='<i id="addPhoto" class="icon fa fa-camera"></i>';
             row +='<input id="AddFile" type="file" name="upload_photo" style="display:none">'; 
             $('#img_profile').html(row);

             $("#addPhoto").click(()=> {
		         $("#AddFile").trigger("click");
		     });

           $.ajax({
            type:"POST",
            url: BASE_URL+'/api/user/photo',
            data:{'photo':photo},
            cache: false,
            dataType: "json",
            success: (respons) =>{
            	
            	 localStorage.setItem('user_sidebar', JSON.stringify(respons.user_sidebar));
                 //location.reload();   
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
            }
          });

        } 
       

	 }); 	

</script>