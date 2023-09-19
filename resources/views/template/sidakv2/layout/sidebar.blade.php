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
			<div id="menu-sidebar" data-widget="tree" class="sidebar-menu tree">
				<!-- <li class="header main-nav text-center">MENU</li> -->
				<!--  @include('template/sidakv2/layout.menu') -->
				
			</div>
		</div>
	</section>
</aside>

<script type="text/javascript">
	 $(function(){
	 	var photo = '';
        const apps  = JSON.parse(localStorage.getItem('apps')); 
        const user_sidebar  = JSON.parse(localStorage.getItem('user_sidebar'));

        let sidebar = localStorage.getItem('menu_sidebar');
        let action =  JSON.parse(sidebar);
         getMenuSidebar(action);
        
       
 
        
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

        function getMenuSidebar(data){
             const content = $('#menu-sidebar');
             content.empty();
             content.append('<li class="header main-nav text-center">MENU</li>'); 
		    // Clear previous data
		    
		    if(data.length>0)
		    {
		        // Populate content with new data
		        data.forEach(function(item, index) {
		           	let row = ``;

			        if(item.count>0)
					{
			           
			            row +=`<li id="class-menu" data-param_id="${item.slug}" class="${item.class}" style="height: auto;">`;
			            row +=`<a href="#">`;
			         }else{
	                     
	                    row +=`<li id="class-menu" class="${item.class}" data-param_id="${item.slug}">`;
	                    row +=`<a href="${item.url}">`;

			         }
		          		            
		            
						    row +=`<i class="fa-icon ${item.icon}"></i>`;
						        row +=`<span class="title-menu" > ${item.name}</span>`;
						   
						   if(item.count>0)
						   {	
						        row +=`<span class="pull-right-container ">`;
						          row +=`<i class="fa fa-angle-left pull-right"></i>`;
						        row +=`</span>`;
						    }    
						row +=`</a>`;
                    if(item.active ==true)
				    {
						row +=`<ul  class="treeview-menu" style="display: block;">`; 
				    }else{
				    	row +=`<ul  class="treeview-menu" style="display: none;">`; 
				    }		
                             for(let i=0; i<item.tasks.length; i++)
							 {   
							    row +=`<li >`;
							        row +=`<a href="`+ item.tasks[i].url +`">`;
							            row +=`<i class="po-top-menu fa-icon `+ item.tasks[i].icon +`"></i>`; 
							             row +=`<span class="title-menu" > `+ item.tasks[i].name +`</span>`;
							        row +=`</a>`;
							    row +=`</li>`;

                            } 


					    row +=`</ul>`;
								               
		             row +=`</li>`;
		            content.append(row);

		        });

		    }  


		    $( "#menu-sidebar" ).on( "click", "#class-menu", (e) => {
		        let slug = e.currentTarget.dataset.param_id;
                const find = data.find(o => o.slug === slug);
                const items = [];

                if(find.count ==0)
                {
                  window.location.replace(find.url);  
                }
               
                    

		        
                for(let i =0; i<data.length; i++)
                 {
                    if(data[i].slug != slug)
                    {
                      items.push({
                      	 name:data[i].name,
                      	 slug:data[i].slug,
                      	 icon:data[i].icon,
                      	 url:data[i].url,
                      	 count:data[i].count,
                      	 active:false,
                      	 class:'treeview',
                      	 tasks:data[i].tasks
                      })
                    }else{

                    	
		                           
	                      items.push({
	                      	 name:data[i].name,
	                      	 slug:data[i].slug,
	                      	 icon:data[i].icon,
	                      	 url:data[i].url,
	                      	 count:data[i].count,
	                      	 active:true,
	                      	 class:'treeview menu-open active',
	                      	 tasks:data[i].tasks
	                      })

                       

                    }	
                } 	

            

		        localStorage.setItem('menu_sidebar', JSON.stringify(items));
		        //getMenuSidebar(items);
		    });


        }
       

	 }); 	

</script>