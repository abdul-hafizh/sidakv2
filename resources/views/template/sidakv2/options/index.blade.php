@extends('template/sidakv2/layout.app')
@section('content')
 
  
  <!-- Latest Sortable -->

<div class="content">
<div class="row">

      <div class="col-lg-7 ui-sortable ">
  	    <div class="pull-left padding-9-0 margin-left-button">
            <button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-role-add">
			 Tambah Role
			</button> 
	    </div>	
	    <!--  <div class="pull-left padding-9-0 margin-left-button">
            <button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-list-setting">
			 Setting
			</button> 
	    </div>	 -->
        <div id="selectRole" class="pull-right width-25 margin-0-0-20-0">
		    
        </div>
      </div> 	

   <section class="col-lg-7 connectedSortable ui-sortable margin-0-0-50-0 pull-left full">
      
     <div id="viewRole" class="nav-tabs-custom ">   
       <div class="tab-content pull-left full form-group border-radius-12">
       	   <div class="margin-view-role"> 
                <b>Loading ...</b>
       	   </div>

       </div>
     </div> 
     
  

   </section>

   <section class="col-lg-5 connectedSortable ui-sortable pull-left">
         <div class="box box-solid ">
                <div class="padding-06-10 box-header with-border ">
                  <h3 class="pull-left box-title padding-5-0">Data Menu </h3>

                  <div class="pull-left padding-0-10 width-70">
                  	<input id="Search" type="text" placeholder="Cari Menu" class="form-control padding-0-15 border-radius-16">
                  </div>

                  <div class="btn-group pull-right" data-toggle="btn-toggle">
                    <button type="button" data-toggle="modal" data-target="#modal-menu-add" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus" ></i>
                    </button>
                   
                  </div>

                </div>

                <div class="box-body-menu box-body ">
                   <div class="pull-left col-sm-12 padding-none">
                  	   <div id="ContentMenu" class="padding-menu">
                            <div class="margin-view-role"> 
				                <b>Loading ...</b>
				       	    </div>

                  	   </div>
                   </div>
                </div> 	
         </div>         
   </section>	
</div> 	
</div>
@include('template/sidakv2/options.menu-add')
@include('template/sidakv2/options.role-add')
 


    
<script>
   $( function() {
   	  var roleid_old ='';
   	  var roleid_new ='';
      var menu_list = [];
      var role_list = [];
      var role_menu = [];
      var submenu_real = ''; 
      var sort = [];  
      var base_asset = window.location.origin+'/images/menu/';
   
      localStorage.removeItem('root_menu');
      var selectedValue = 'admin';  
      var menu = localStorage.getItem('root_menu');
      var temp =  JSON.parse(menu); 
    


   	  GetRole();
   	  SearchMenu();
   	 

    //role  
    function GetRole(){

    	$.ajax({
            url: BASE_URL +'/api/select-role',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
              
               SelectRole(data);
               ViewTabFirst(data);

            },
            error: function(error) {
            console.error(error);
            }
        });

        


    }

    function SelectRole(data){
        $('#selectRole').html('<select id="role_id"  class="selectpicker" data-style="bg-navy" ></select>');
        var select =  $('#role_id');
        $.each(data, function(index, option) {
            select.append($('<option>', {
              value: option.value,
              text: option.text
            }));
        });
       select.val(selectedValue);
       select.selectpicker('refresh');

       ChangeRole(data); 
       
       $( "#viewRole" ).on( "click", "#Edit-Role", (e) => {
             let id = e.currentTarget.dataset.param_id;
             const item = data.find(o => o.id === id); 
            

            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Role</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
				                 row +=`<div id="name-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Nama</label>`;

				                  row +=`<input type="text" class="form-control" name="name" placeholder="Nama" value="`+ item.text +`">`;
				                  row +=`<span id="name-messages-`+ item.id +`"></span>`;

				                 row +=`</div>`;

				                
                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update-role" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
						            row +=`<button id="load-update-role" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
     						</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ item.id).html(row); 
				
            UpdateRole(item.id) 
                          
        }); 

        $( "#viewRole" ).on( "click", "#DestroyRole", (e) => {
	        let id = e.currentTarget.dataset.param_id;
             

	        Swal.fire({
			      title: 'Apakah anda yakin hapus?',
			    
			      icon: 'warning',
			      showCancelButton: true,
			      confirmButtonColor: '#d33',
			      cancelButtonColor: '#3085d6',
			      confirmButtonText: 'Ya'
			    }).then((result) => {
			      if (result.isConfirmed) {
			        // Perform the delete action here, e.g., using an AJAX request
			        // You can use the itemId to identify the item to be deleted
			        deleteItemRole(id);
			        
			        
			      }
			    });

        });

    }

     function UpdateRole(id){

        $( ".modal-content" ).on( "click", "#update-role", (e) => {
		         
	              var data = $("#FormSubmit-"+ id).serializeArray();
	              $("#update-role").hide();
	              $("#load-update-role").show();
	              
		          var form = {'name':data[0].value,'status':'Y'};



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/role/'+ id,
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{
			                   Swal.fire({
			                        title: 'Sukses!',
			                        text: 'Berhasil Diupdate',
			                        icon: 'success',
			                        confirmButtonText: 'OK'
			                        
			                    }).then((result) => {
			                        if (result.isConfirmed) {
			                            // User clicked "Yes, proceed!" button
			                            window.location.replace('/options');
			                        }
			                    });

			                   //
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                $("#update-role").show();
			                $("#load-update-role").hide();
 
			                if(errors.messages.name)
			                {
			                     $('#name-alert-'+id).addClass('has-error');
			                     $('#name-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
			                }else{
			                    $('#name-alert-'+id).removeClass('has-error');
			                    $('#name-messages-'+id).removeClass('help-block').html('');
			                }

			                

			               

			                
			            }
			          });
 
		        
	        });  

    }

     function deleteItemRole(id){

		$.ajax({
		    url:  BASE_URL +`/api/role/`+ id,
		    method: 'DELETE',
		    success: function(response) {
		        // Handle success (e.g., remove deleted items from the list)
		        location.reload();
		    },
		    error: function(error) {
		        console.error('Error deleting items:', error);
		    }
		});

    }


    function ViewTabFirst(data){
        let find = data.find(o => o.value === selectedValue);
        roleid_old = find.id; 
        roleid_new = find.id;
        console.log(roleid_old+' Role lama')

        ViewTabMenu(find,data)
        GetMenu(find.id); 
        RoleNested();
           //menu
	    $( "#ContentMenu" ).on( "click", "#Move-Menu", (e) => {
	   		 let id = e.currentTarget.dataset.param_id;
	   	     const item = menu_list.find(o => o.id === id);
	         MoveAction(item)
	   	}); 

	   	$( "#ContentMenu" ).on( "click", "#Edit-Menu", (e) => {
		   	let id = e.currentTarget.dataset.param_id;
		   	const item = menu_list.find(o => o.id === id);
	        editMenuView(item)
	    });

	    $( "#ContentMenu" ).on( "click", "#Destroy", (e) => {
	        let id = e.currentTarget.dataset.param_id;


	        Swal.fire({
			      title: 'Apakah anda yakin hapus?',
			    
			      icon: 'warning',
			      showCancelButton: true,
			      confirmButtonColor: '#d33',
			      cancelButtonColor: '#3085d6',
			      confirmButtonText: 'Ya'
			    }).then((result) => {
			      if (result.isConfirmed) {
			        // Perform the delete action here, e.g., using an AJAX request
			        // You can use the itemId to identify the item to be deleted
			        deleteItemMenu(id);
			        
			        Swal.fire(
			          'Deleted!',
			          'Data berhasil dihapus.',
			          'success'
			        );
			      }
			    });

    }); 

	   	   

    }

    function ChangeRole(data){
    	

    	$('#role_id').change(function() {
           selectedVal = $(this).find("option:selected").val();
           let find = data.find(o => o.value === selectedVal);
           roleid_new = find.id;
       
           console.log(roleid_new+' Role baru')
           var role_menu = [];
           GetMenu(find.id);
           ViewTabMenu(find,data);
           RoleNested();
        });

    }

     function ViewTabMenu(find,role){
          var row = ``; 

        
    	 row +=`<ul class="nav nav-tabs">`;
        	 row +=`<li class="active">`;
        		 row +=`<a href="#tabRole" data-toggle="tab" aria-expanded="true" class="text-bold">`;


        		       row +=`<span class="tab-text-role"> Role `+ find.text +`</span>`; 

        		            row +=`<div id="action-role" class="pull-right padding-05-05 bg-list-menu-btn">`;
                       

                        if(find.deleted ==true)
                        { 
	        		         		row +=`<span id="Edit-Role" data-param_id="`+ find.id +`" data-toggle="modal" data-target="#modal-edit-${find.id}" data-placement="top"  data-toggle="tooltip" title="Edit Data" class="padding-05-05 pointer">`;
	        		            		row +=`<i data-toggle="modal" data-target="#EditForm" class="fa fa-pencil-square-o"></i>`;
	        		              		row +=`<i class="border-right-white"></i>`;
	        		              	row +=`</span>`;

	        		                row +=`<span id="DestroyRole" data-placement="top"  data-toggle="tooltip" title="Hapus Data"  data-param_id="${find.id}" class="padding-05-05 pointer">`;
	        		              		row +=`<i class="fa fa-trash"></i>`;
	        		                row +=`</span>`;

	        		    }else{

                                    row +=`<span    data-placement="top"  data-toggle="tooltip" title="Edit Data" class="padding-05-05 pointer disabled-span ">`;
	        		            		row +=`<i class="fa fa-pencil-square-o"></i>`;
	        		              		row +=`<i class="border-right-white"></i>`;
	        		              	row +=`</span>`;

	        		                row +=`<span   data-placement="top"  data-toggle="tooltip" title="Hapus Data"   class="padding-05-05 pointer disabled-span ">`;
	        		              		row +=`<i class="fa fa-trash"></i>`;
	        		                row +=`</span>`;

	        		    }            
        		            row +=`</div>`;


        		           
        		          

        		row +=`</a>`;
        	 row +=`</li>`;
           row +=`</ul>`;

        row +=`<div class="tab-content pull-left full form-group">`;
            row +=`<div id="tabDrag"  class="tab-pane active">`;
	            row +=`<div id="tabRole" class="nested-sortable padding-bottom-30">`;
	            GetSettingRole(find.value);
               
	            row +=`</div>`;	
            row +=`</div>`;	

			row +=`<div class="group-list-btn-save col-sm-12">`;
			row +=`<button disabled id="SaveRole" data-toggle="modal" type="button" class="btn btn-default" >Simpan Menu</button>`;
			row +=`</div> `;

        row +=`</div>`;
        row +=`<div id="modal-edit-${find.id}" class="modal fade" role="dialog">`;
        row +=`<div id="FormEdit-${find.id}"></div>`;
        row +=`</div>`;

        $('#viewRole').html(row);

       
        
        //save Role
        $('#SaveRole').on('click', function() {
             
    	     var menu = localStorage.getItem('root_menu');
       		 var temp =  JSON.parse(menu);
       		 console.log(temp)
             
	   		 var form = {
	           'menu':JSON.stringify(temp.menu),
	           'role_id':temp.role_id,
	         };
             
              loadingRole();
            
	 
	          $.ajax({
	            type:"POST",
	            url: BASE_URL+'/api/menu/role/save',
	            data:form,
	            cache: false,
	            dataType: "json",
	            success: (respons) =>{



	            	

		             setTimeout(function() { 
		             	localStorage.removeItem('root_menu');
	             		let find = role.find(o => o.id === temp.role_id);
	             		GetMenu(find.id);
	             		GetSettingRole(find.value);
	             		$('#SaveRole').prop("disabled", true).text('Simpan Role').removeClass('btn-primary').addClass('btn-default');

	             		Swal.fire({
                            title: 'Sukses!',
                            text: 'Role Berhasil Di Simpan.',
                            icon: 'success',
                            confirmButtonText: 'OK'

                          }).then((result) => {
                            if (result.isConfirmed) {
                              // User clicked "Yes, proceed!" button
                             // window.location.replace('/user');
                            }
                          });

	               }, 500);  
	                  
	                   
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	                
	                
	            }
	          });  
	    });

	    $( "#tabRole" ).on( "click", "#Edit-Real", (e) => {
            let slug = e.currentTarget.dataset.param_id; 
            var menu = localStorage.getItem('root_menu');
       		var temp =  JSON.parse(menu);
            if(temp)
            {
	           let item = temp.menu.find(o => o.slug === slug);
			   formAction(slug,role,item,temp.menu);
            }else{

               let item = role_menu.find(o => o.slug === slug); 
		       formAction(slug,role,item,role_menu);
            }	
	  
        }); 


        

	    

	   

	    //delete Role
        $( "#tabRole" ).on( "click", "#Hapus-Real", (e) => {
            let index = e.currentTarget.dataset.param_id; 
            let p_menu = e.currentTarget.dataset.param_menu;
            var menu = localStorage.getItem('root_menu');
       		var temp =  JSON.parse(menu);
            
       		Swal.fire({
		      title: 'Apakah anda yakin hapus ?',
		    
		      icon: 'warning',
		      showCancelButton: true,
		      confirmButtonColor: '#d33',
		      cancelButtonColor: '#3085d6',
		      confirmButtonText: 'Ya'
		    }).then((result) => {
		      if (result.isConfirmed) {
                 
                 if(temp)
                 {
                 	 let find = role.find(o => o.id === temp.role_id);
                     var listMenu = menu_list.find(o => o.slug === p_menu);
    			     listMenu.move = true;
			   	     if(temp.menu.length > 1)
			   	     {
                         loadingRole();  
                         temp.menu.splice(index, 1); 
                         var form = {'menu':temp.menu,'role_id':find.id};
                         localStorage.setItem('root_menu', JSON.stringify(form));
                         

			   	     }else{
			   	     	 localStorage.removeItem('root_menu');
			   	     	
			   	     	   
			   	     } 

			   	     contentMenu(menu_list); 
			         GetSettingRole(find.value);	

                 }else{
                 	DeleteSetting(p_menu,index,role);
                 }  	

       		 
                   
				   

		        Swal.fire(
		          'Deleted!',
		          'Data berhasil dihapus.',
		          'success'
		        );
		      }
		    });
            
        }); 


        

        $( "#tabRole" ).on( "click", "#Setting-Menu", (e) => {
             let p_menu = e.currentTarget.dataset.param_menu;
             let p_sub = e.currentTarget.dataset.param_sub; 
             let index = e.currentTarget.dataset.param_index;  
             var menu = localStorage.getItem('root_menu');
       		 var temp =  JSON.parse(menu);

       		if(temp)
            {
            	 let findmenu = temp.menu.find(o => o.slug === p_menu);
            	 let findsub = temp.menu.find(o => o.slug === p_sub);
            	 if(findmenu.tasks.length >0)
	             {
                    var arr = [findsub];
	             	var merge = [...arr,...findmenu.tasks];
	             	findmenu.tasks = merge;

	             }else{
                    
                    var arr = [findsub];
	                findmenu.tasks  =  arr;
	             } 	

	              temp.menu.splice(index, 1);
	              var form = {'menu':temp.menu,'role_id':roleid_new};

            }else{	


	             let findmenu = role_menu.find(o => o.slug === p_menu);
	             let findsub = role_menu.find(o => o.slug === p_sub);

	             if(findmenu.tasks.length >0)
	             {
	             	var arr = [findsub];
	             	var merge = [...arr,...findmenu.tasks];
	             	findmenu.tasks = merge;
	             }else{
	             	var arr = [findsub];
	                findmenu.tasks  =  arr;
	             } 	
	             
	             role_menu.splice(index, 1);
	             var form = {'menu':role_menu,'role_id':roleid_new};

            }

		     localStorage.setItem('root_menu', JSON.stringify(form));

		     GetSettingRole(roleid_new);
           
             $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
             

        }); 


         $( "#tabRole" ).on( "click", "#View-Real", (e) => {
         	
            let slug = e.currentTarget.dataset.param_id; 
            var menu = localStorage.getItem('root_menu');
       		var temp =  JSON.parse(menu);
            if(temp)
            {
	           let item = temp.menu.find(o => o.slug === slug);
			   formDetailSub(slug,role,item,temp.menu);
            }else{

               let item = role_menu.find(o => o.slug === slug); 
		       formDetailSub(slug,role,item,role_menu);
            }	

        });


    }

    
   function GetSettingRole(role){
   	   
       var menu = localStorage.getItem('root_menu');
       var temp =  JSON.parse(menu);  
       const content = $('#tabRole');
       content.empty();
       if(temp)
       { 
       	 
            temp.menu.forEach(function(item, index) {
            	
            var row = '';
           	row +=`<div id="list-role" data-sortable-id="${item.slug}" class="list-group-item pull-left full" style="" draggable="false">`;
           	    
           	   row +=`<div class="list-group pointer margin-none">`; 
                    row +=`<div class="row-checkbox pull-left full">`; 
                   
                        row +=`<div class="checkbox-form pull-left">`; 
                             row +=`<span class="black pull-left padding-05-05">`;
                                row +=`<img width="20" src="${ base_asset+item.icon}">`;
                                    if(item.tasks.length > 0)
					                {
			                            row +=`<small class="submenu-count label pull-right bg-yellow">${item.tasks.length} </small>`;
			                        }
                             row +=`</span>`;
                        row +=`</div>`;  

                        row +=`<div class="pull-left checkbox-label text-bold font-16">`; 
                          row +=`${item.name}`; 
                        row +=`</div>`;




                        row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`;

                                if(item.tasks.length > 0)
		                        {


                                     row +=`<span id="View-Real" data-param_id="${item.slug}" data-toggle="modal" data-target="#modal-edit-${item.slug}"    data-toggle="tooltip" data-placement="top" title="Lihat Sub Menu"  class="padding-05-05 dropdown-toggle">`; 
			                           row +=`<i class="fa fa-eye"></i>`; 
			                           row +=`<i class="border-right-white"></i>`;
			                        row +=`</span>`;

		                        } 	


 								if(item.parent =='sub')
		                        { 	

	                                row +=`<span  data-toggle="dropdown" aria-expanded="false"  class="padding-05-05 dropdown-toggle">`; 
			                           row +=`<i class="fa fa-window-restore"></i>`; 
			                           row +=`<i class="border-right-white"></i>`;
			                        row +=`</span>`;

			                         row +=`<ul class="dropdown-menu dropMove">`;

			                          for(let i =0; i<temp.menu.length; i++)
			                          {
			                          	if(temp.menu[i].parent == 'menu')
			                            {
			                            	 row +=`<li><a  id="Setting-Menu" data-param_menu="${temp.menu[i].slug}" data-param_sub="${item.slug}" data-param_index="${index}">`;
			                            	 row +=`<img width="20" src="`+ base_asset+temp.menu[i].icon +`">`;
			                            	 row +=` `+ temp.menu[i].name +``;
			                            	 row +=`</a></li>`;
			                            }		
			                          	
			                          }	
										 
										
									row +=`</ul>`;

		                        }

                                if(item.parent !='menu')
		                        { 
		                            row +=`<span id="Edit-Real" data-param_id="${item.slug}" data-toggle="modal" data-target="#modal-edit-${item.slug}"  data-toggle="tooltip" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`; 
                                        row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                        row +=`<i class="border-right-white"></i>`; 
                                    row +=`</span>`;  
                                }

                             


                            row +=`<span id="Hapus-Real" data-param_menu="${item.slug}"  data-param_id="${index}"   data-toggle="tooltip" data-placement="top" title="Hapus Setting" class="padding-05-05">`; 
                                    row +=`<i class="fa fa-trash"></i>`; 
                                    row +=`</span>`;          

                        row +=`</div>`;

                        
                    row +=`<div id="modal-edit-${item.slug}" class="modal fade" role="dialog">`;
					row +=`<div id="FormEdit-${item.slug}"></div>`;
					row +=`</div>`;

                    row +=`</div>`;

              row +=`</div>`;

              row +=`<div class="list-group pointer nested-sortable"></div>`;
                   	
               
            row +=`</div>`;
                                  
            content.append(row);
            });

            //RoleNested();

        }else{     

           GetDataRoleMenu(role)
        } 	
        
     

   }

   function formAction(slug,role,item,menu){
       
   	 let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Aksi `+ item.name +`</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ slug +`">`;
					        row +=`<div id="TableAction-`+ slug +`" class="modal-body">`;
                               
                                 
							 row +=`<table class="table table-bordered">`;
							 row +=`<tbody>`;
								 row +=`<tr>`;
									 row +=`<th style="width: 10px">#</th>`;
									 row +=`<th>Aksi</th>`;
								 row +=`</tr>`;

								 for(let i=0; i<item.option.length; i++)
								 { 	

								 	if(item.option[i].checked == true)
								    {		
							 	 
								 	 row +=`<tr>`;
										 row +=`<td><input id="action-`+ i +`" type="checkbox" checked  name="status" id="status" value="`+ item.option[i].action +`" ></td>`;
										 row +=`<td>`+ item.option[i].name +`</td>`;
									 row +=`</tr>`;

									}else{
                                      
                                      row +=`<tr>`;
										 row +=`<td><input  type="checkbox"  name="status" id="status" value="`+ item.option[i].action +`" ></td>`;
										 row +=`<td>`+ item.option[i].name +`</td>`;
									 row +=`</tr>`; 

									} 

								}


							 row +=`</tbody>`;
							  row +=`</table> `;

				           
                             
                            row +=`</div>`; 

                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update_action-`+ slug +`" type="button" class="btn btn-primary">OK</button>`;
						            row +=`<button id="load-action-`+ slug +`" type="button" disabled class="btn btn-default" style="display:none;">`;
						             row +=`<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>`;
     						 row +=`</div>`;
						   


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ slug).html(row); 


            $(".modal-content").on( "click", "#update_action-"+ slug, (e) => {
		         var menu = localStorage.getItem('root_menu');
       		     var temp =  JSON.parse(menu);
		        
                 var input = $("#FormSubmit-"+ slug).serializeArray();
		         

                var result_input = [];
                var result_in = [];
                var result = [];
                var merge = []; 


                for(let i =0; i<input.length; i++)
	            {
                    result_input.push(input[i].value);
	            } 

	            for(let i =0; i<item.option.length; i++)
	            {
                    result_in.push(item.option[i].action);
	            } 

                var bool = $.map(result_in, function(element1) {
				    return $.inArray(element1, result_input) !== -1;
				});

                for(let i =0; i<item.option.length; i++)
	            {
                    result.push({
                  	  'action':item.option[i].action,
                  	  'name':item.option[i].name,
                  	  'checked':bool[i]
                    })

	            }	


                var ListReal = role_menu.find(o => o.slug === item.slug);
                if(ListReal)
                {
                	ListReal.option = result;
                }else{
                   var ListTemp = temp.menu.find(o => o.slug === item.slug);
                   ListTemp.option = result;
                   role_menu = temp.menu;
                } 	

              
	            var role_id = $('#role_id').val();
	            let find = role.find(o => o.value === role_id);
                 
		   		var form = {
		           'menu':role_menu,
		           'role_id':find.id,
		        };
		        localStorage.setItem('root_menu', JSON.stringify(form));

                $('#modal-edit-'+ slug).modal('toggle');  
                $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
                 
	        });       

   }


   function formDetailSub(slug,role,item,menu){
    
   	 let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content pull-left full">`;

				       row +=`<div class="modal-header pull-left full">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Detail Sub Menu `+ item.name +`</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ slug +`">`;
					        row +=`<div id="TableAction-`+ slug +`" class="modal-body margin-bottom pull-left full">`;
                               
                                  
                            row += formSubList(item.tasks,slug);

				           
                             
                            row +=`</div>`; 

                            row +=`<div class="modal-footer pull-left full">`;
                               row +=`<button type="button" id="Back-List" style="display:none;" class="pull-left btn bg-navy" >Kembali Ke Submenu</button>`;

						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update-role-`+ slug +`"  type="button" class="btn btn-primary">OK</button>`;
						            row +=`<button id="load-action-`+ slug +`" type="button" disabled class="btn btn-default" style="display:none;">`;
						             row +=`<i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>`;
     						 row +=`</div>`;
						   


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ slug).html(row); 

            RoleNestedSub(item.slug);

            $(".modal-content").on( "click", "#update-role-"+ slug, (e) => {
		          
		        
                 var menu = localStorage.getItem('root_menu');
	  			 var temp =  JSON.parse(menu);
		          var input = $("#FormSubmit-"+ slug).serializeArray();
		           var role_id = $('#role_id').val();
			       var find = role.find(o => o.value === role_id);

			    
			       
			      	
		           if(input.length>0)
		          {

		          	    var result_input = [];
		                var result_in = [];
		                var result = [];
		                var merge = []; 


		                for(let i =0; i<input.length; i++)
			            {
		                    result_input.push(input[i].value);
			            } 

			            for(let i =0; i<item.option.length; i++)
			            {
		                    result_in.push(item.option[i].action);
			            } 

		                var bool = $.map(result_in, function(element1) {
						    return $.inArray(element1, result_input) !== -1;
						});

		                for(let i =0; i<item.option.length; i++)
			            {
		                    result.push({
		                  	  'action':item.option[i].action,
		                  	  'name':item.option[i].name,
		                  	  'checked':bool[i]
		                    })

			            }	


			            if(temp)
			            {

			               var ListTemp = temp.menu.find(o => o.slug === item.slug);
		                   var i_sub =  ListTemp.tasks.find(o => o.slug === submenu_real);
		                   i_sub.option = result;
			                var form = {
					           'menu':temp.menu,
					           'role_id':find.id,
					        };

			            }else{

                           var ListReal = role_menu.find(o => o.slug === item.slug);
                           var i_sub =  ListReal.tasks.find(o => o.slug === submenu_real);
		                	 i_sub.option = result;

		                	 var form = {
					           'menu':role_menu,
					           'role_id':find.id,
					        };      
			            }  	



				   		
				        localStorage.setItem('root_menu', JSON.stringify(form));
                    
		          }

                  $('#modal-edit-'+ slug).modal('toggle');
		        if(temp)
		        {
                 
                    if(sort.length>0)
                    {
                    	var form = {
				           'menu':sort,
				           'role_id':find.id,
				        };
				        sort = []; 
                        localStorage.setItem('root_menu', JSON.stringify(form));

						setTimeout(function() { loadingRole() }, 500); 
                        setTimeout(function() { GetSettingRole(find.id) }, 800); 
							

                    }else{
                       
                    	var form = {
				           'menu':temp.menu,
				           'role_id':find.id,
				        };
				        localStorage.setItem('root_menu', JSON.stringify(form)); 
                    } 
		         	


		        }else{
                        
                      if(sort.length>0)
                     {
                    	var form = {
				           'menu':sort,
				           'role_id':find.id,
				        };
				        sort = []; 
				        console.log(sort) 
                        localStorage.setItem('root_menu', JSON.stringify(form));
                          
					  
						setTimeout(function() { loadingRole() }, 500); 
                        setTimeout(function() { GetSettingRole(find.id) }, 800); 
							

                    }else{
                       
                    	var form = {
				           'menu':role_menu,
				           'role_id':find.id,
				        };
				        localStorage.setItem('root_menu', JSON.stringify(form)); 
                    }   
		        }
		          

                
                $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');			
	        }); 

	        $(".modal-content").on( "click", "#Back-Menu-"+ slug, (e) => {
		         let p_menu = e.currentTarget.dataset.param_menu;
                 let p_sub = e.currentTarget.dataset.param_sub;
                 let index = e.currentTarget.dataset.param_index;

                 
                 var menu = localStorage.getItem('root_menu');
	  			 var temp =  JSON.parse(menu);
	  			 loadingRoleSub();  
	  			 if(temp)
	  			 {
                   
	  			 	var ListData = temp.menu.find(o => o.slug === p_menu);
    			    var SubMenu = ListData.tasks;
    			    var ListSub = SubMenu.find(o => o.slug === p_sub);
    			    var convert = [ListSub]; 
    			    temp.menu =  [...convert,...temp.menu];
    			    sort = temp.menu;
    			      if(SubMenu.length < 2)
                      {  
                       $('#modal-edit-'+ slug).modal('toggle'); 

                      }

	  			 }else{

                    var ListData = role_menu.find(o => o.slug === p_menu);
    			    var SubMenu = ListData.tasks;
    			    var ListSub = SubMenu.find(o => o.slug === p_sub);
    			    var convert = [ListSub]; 
    			    role_menu =  [...convert,...role_menu];
                    sort = role_menu;
                    console.log(sort)  
	  			 } 	

    			SubMenu.splice(index, 1);
                setTimeout(function() { 
                
	            if(temp)
	  			{
                     
	                 formDetailSub(p_menu,role,ListData,temp.menu);
		              
                      
                      if(SubMenu.length ==0)
                      {	
                      	    var form = {
					           'menu':temp.menu,
					           'role_id':roleid_new,
					           };

		                     localStorage.setItem('root_menu', JSON.stringify(form));
	                       loadingRole();
	                       setTimeout(function() { 
	                       		GetSettingRole(roleid_new);

	                       }, 500);
                      }
                     
                }else{ 
                   formDetailSub(p_menu,role,ListData,role_menu);
	            //    var form = {
		           // 'menu':role_menu,
		           // 'role_id':roleid_new,
		           // }; 
             //       localStorage.setItem('root_menu', JSON.stringify(form));
                }	

		           
	    		}, 600);
	        });

            $(".modal-content").on( "click", "#Edit-Menu-"+ slug, (e) => {
		         let p_menu = e.currentTarget.dataset.param_menu;
                 let p_sub = e.currentTarget.dataset.param_sub;
                 submenu_real = p_sub;
                 var ListData = '';

                 var menu = localStorage.getItem('root_menu');
	  			 var temp =  JSON.parse(menu);
	  			 if(temp)
	  			 {

                     ListData = temp.menu.find(o => o.slug === p_menu);
	  			 }else{

                    ListData = role_menu.find(o => o.slug === p_menu);
    			 

	  			 } 	
                
                 var SubMenu = ListData.option;
    			 var sub = ListData.tasks.find(o => o.slug === p_sub);

    			 loadingRoleSub(); 

    			 setTimeout(function() { 
                    formSubAction(sub,slug,sub.name);
    			 }, 500);  
	        });

            $(".modal-content").on( "click", "#Back-List", (e) => { 
            	$('.table').remove();

            	 var row = '';

            	 row +=`<div id="tabDragSub">`; 
        			row +=`<div id="tabRoleSub" class="nested-sortable-sub padding-bottom-30">`;

        		    row +=`</div>`; 
        		 row +=`</div>`; 
                  $('#TableAction-'+ slug).html(row); 

                 loadingRoleSub(); 

    			 setTimeout(function() { 
    			 	 $('.modal-title').text('Detail Sub Menu '+ item.name)
    			 	  $('#tabDragSub').remove();
                      var rows = formSubList(item.tasks,slug);
                      $('#Back-List').hide();
                      $('#TableAction-'+ slug).html(rows);
    			 }, 500);
            }); 	
	        
	        $(".modal-content").on( "click", "#Hapus-Menu-"+ slug, (e) => {
		         let p_menu = e.currentTarget.dataset.param_menu;
                 let p_sub = e.currentTarget.dataset.param_sub;
                 let index = e.currentTarget.dataset.param_index;
                 var  ListData = '';
                 var menu = localStorage.getItem('root_menu');
	  			 var temp =  JSON.parse(menu);
	  			 if(temp)
	  			 {
                     ListData = temp.menu.find(o => o.slug === p_menu);
	  			 }else{
                     ListData = role_menu.find(o => o.slug === p_menu);
	  			 } 	
                  
	  			 loadingRoleSub();  
                  var listMenu = menu_list.find(o => o.slug === p_sub);
    			  listMenu.move = true;   	
	  			 if(ListData.tasks.length > 1)
	  			 {
                    
	  			 	 var SubMenu = ListData.tasks;
	    			 var ListSub = SubMenu.find(o => o.slug === p_sub);
	    			 var convert = [ListSub];
	    			 SubMenu.splice(index, 1);
                     sort = ListData;
                     $('#count-'+ slug).text(SubMenu.length);
                        
                  
                     

	  			 }else{

                    ListData.tasks = [];
                    $('#modal-edit-'+ slug).modal('toggle');

	  			 }

	  			 contentMenu(menu_list); 	

                setTimeout(function() { 
	             if(temp)
	  			 {
	               formDetailSub(p_menu,role,ListData,temp.menu);
	               var form = {
		           'menu':temp.menu,
		           'role_id':roleid_new,
		           };
                   
		            if(ListData.tasks.length ==0)
		            {
		               localStorage.setItem('root_menu', JSON.stringify(form));	
                       loadingRole();
                       setTimeout(function() { 
                       		GetSettingRole(roleid_new);

                       }, 500);		
		            }else{

                       sort = temp.menu;
                       console.log(sort)
		            }
                    
		            
	             }else{
	               formDetailSub(p_menu,role,ListData,role_menu);
	               var form = {
		           'menu':role_menu,
		           'role_id':roleid_new,
		           };

		            localStorage.setItem('root_menu', JSON.stringify(form));
	             }  
	               
		          
             
	    		}, 500);
	        }); 

	        $('#tabRoleSub').slimScroll({
	            height: '400px',
	            railVisible: true,
	            alwaysVisible: true,
	            railOpacity: 0.4
	        });  
                 
   }


   function formSubAction(items,slug,name){
     $('#tabDragSub').remove();
     $('#Back-List').show();
     $('.modal-title').text('Edit Aksi '+ name);
     var row = '';

				row +=`<table class="table table-bordered">`;
			 row +=`<tbody>`;
				 row +=`<tr>`;
					 row +=`<th style="width: 10px">#</th>`;
					 row +=`<th>Aksi</th>`;
				 row +=`</tr>`;

				  

				 for(let i=0; i<items.option.length; i++)
				 { 	
                   
				 	if(items.option[i].checked == true)
				    {		
			 	 
				 	 row +=`<tr>`;
						 row +=`<td><input id="action-`+ i +`" type="checkbox" checked  name="status" id="status" value="`+ items.option[i].action +`" ></td>`;
						 row +=`<td>`+ items.option[i].name +`</td>`;
					 row +=`</tr>`;

					}else{
                      
                      row +=`<tr>`;
						 row +=`<td><input  type="checkbox"  name="status" id="status" value="`+ items.option[i].action +`" ></td>`;
						 row +=`<td>`+ items.option[i].name +`</td>`;
					 row +=`</tr>`; 

					} 

				}


			 row +=`</tbody>`;
			  row +=`</table> `;


   	    $('#TableAction-'+ slug).html(row);
   }

   function formSubList(tasks,slug)
   {

   	  var row = '';

   	  row +=`<div id="tabDragSub">`; 
        row +=`<div id="tabRoleSub" class="nested-sortable-sub padding-bottom-30">`;             
						tasks.forEach(function(items, index) 
						{
                  
		                   row +=`<div id="list-role" data-sortable-id="${items.slug}" class="list-group-item pull-left full" style="" draggable="false">`;

		                     row +=`<div class="list-group pointer margin-none">`;
                               row +=`<div class="row-checkbox pull-left full">`;
                             
						            row +=`<div class="checkbox-form pull-left">`;
							            row +=`<span class="black pull-left padding-05-05">`;
							           		row +=`<img width="20" src="${ base_asset+items.icon}">`;
							           	row +=`</span>`;
						           	row +=`</div>`;

						           	row +=`<div class="pull-left checkbox-label">${items.name}</div>`;
                                    
                                    row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`;
                                       

                                       row +=`<span id="Back-Menu-${slug}" data-param_menu="${slug}" data-param_sub="${items.slug}" data-param_index="${index}"   class="padding-05-05" data-placement="top" title="Kembali Ke Menu Utama">`;
                                         row +=`<i class="fa fa-undo"></i>`;
                                         row +=`<i class="border-right-white"></i>`;
                                       row +=`</span>`;

                                       
                                       row +=`<span id="Edit-Menu-${slug}" data-param_menu="${slug}" data-param_sub="${items.slug}" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`;
                                       row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`;
                                       row +=`<i class="border-right-white"></i>`;
                                       row +=`</span>`;


                                       row +=`<span id="Hapus-Menu-${slug}" data-param_menu="${slug}" data-param_sub="${items.slug}" data-param_index="${index}" data-param_id="0" data-toggle="tooltip" data-placement="top" title="Hapus Setting" class="padding-05-05">`;
                                       		row +=`<i class="fa fa-trash"></i>`;
                                       row +=`</span>`;



                                    row +=`</div>`;

                                 row +=`</div>`;
                               row +=`</div>`; 
                            row +=`</div>`; 

                             
					     });
           row +=`</div>`; 
        row +=`</div>`; 

                        return row;
   }


   function GetDataRoleMenu(role){

        $.ajax({
	        url: BASE_URL +'/api/menu/role',
	        method: 'GET',
	        dataType: 'json',
	        success: function(data) {
	           
               let findtask = data.find(o => o.name === role);
           	   listMenuRole(findtask)
              
	        },
	        error: function(error) {
	            console.error(error);
	        }
        });

   }

   function listMenuRole(data)
   {
           const content = $('#tabRole');
           content.empty();
            
            

          if(data) 
          { 	
          	var result = JSON.parse(data.tasks);
          	role_menu = result;
          	console.log(role_menu)
            result.forEach(function(item, index) {
 
                    var row = '';
                   	row +=`<div id="list-role" data-sortable-id="${item.slug}" class="list-group-item pull-left full" style="" draggable="false">`;
                   	    
                   	   row +=`<div class="list-group pointer margin-none">`; 
                            row +=`<div class="row-checkbox pull-left full">`; 
	                       
                                row +=`<div class="checkbox-form pull-left">`; 
                                     row +=`<span class="black pull-left padding-05-05">`;
                                        row +=`<img width="20" src="${base_asset+item.icon}">`;
                                        if(item.tasks.length > 0)
						                {
				                            row +=`<small id="count-${item.slug}" class="submenu-count label pull-right bg-yellow">${item.tasks.length} </small>`;
				                        }
                                     row +=`</span>`;
                                row +=`</div>`;  

		                        row +=`<div class="pull-left checkbox-label text-bold font-16">`; 
		                          row +=`${item.name}`; 
		                        row +=`</div>`;
		                       
			                    row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`;

			                    if(item.tasks.length > 0)
		                        {
                                     row +=`<span id="View-Real" data-param_id="${item.slug}" data-toggle="modal" data-target="#modal-edit-${item.slug}"    data-toggle="tooltip" data-placement="top" title="Lihat Sub Menu"  class="padding-05-05 dropdown-toggle">`; 
			                           row +=`<i class="fa fa-eye"></i>`; 
			                           row +=`<i class="border-right-white"></i>`;
			                        row +=`</span>`;

		                        } 	


 								if(item.parent =='sub')
		                        { 	

	                                row +=`<span  data-toggle="dropdown" aria-expanded="false"  class="padding-05-05 dropdown-toggle">`; 
			                           row +=`<i class="fa fa-window-restore"></i>`; 
			                           row +=`<i class="border-right-white"></i>`;
			                        row +=`</span>`;

			                         row +=`<ul class="dropdown-menu dropMove">`;

			                          for(let i =0; i<role_menu.length; i++)
			                          {
			                          	if(role_menu[i].parent == 'menu')
			                            {
			                            	 row +=`<li><a  id="Setting-Menu" data-param_menu="${role_menu[i].slug}" data-param_sub="${item.slug}" data-param_index="${index}">`;
			                            	 row +=`<img width="20" src="`+ base_asset+role_menu[i].icon +`">`;
			                            	 row +=` `+ role_menu[i].name +``;
			                            	 row +=`</a></li>`;
			                            }		
			                          	
			                          }	
										 
										
									row +=`</ul>`;

		                        }

                                if(item.parent !='menu')
		                        { 
		                            row +=`<span id="Edit-Real" data-param_id="${item.slug}" data-toggle="modal" data-target="#modal-edit-${item.slug}"  data-toggle="tooltip" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`; 
                                                row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                                row +=`<i class="border-right-white"></i>`; 
                                    row +=`</span>`;  
                                }

                                    row +=`<span id="Hapus-Real" data-param_menu="${item.slug}" data-param_id="${index}"   data-toggle="tooltip" data-placement="top" title="Hapus Setting" class="padding-05-05">`; 
                                            row +=`<i class="fa fa-trash"></i>`; 
                                            row +=`</span>`;          

                                row +=`</div>`;

                                
                            row +=`<div id="modal-edit-${item.slug}" class="modal fade" role="dialog">`;
								row +=`<div id="FormEdit-${item.slug}"></div>`;
							row +=`</div>`;

                            row +=`</div>`;

                      row +=`</div>`;

  
		            row +=`</div>`;

                 content.append(row);
            });
       }else{
           role_menu = [];
           var row = '';
           row +=`<div id="role-null"  class="mt-20 ">`; 
                   row +=`<div class="list-group">`;
                           row +=`<div class="text-bold text-center">Data Kosong</div>`;
                   row +=`</div>`;   
               row +=`</div>`;
          content.append(row);

       }

   
      // RoleNested();

   }


    

    function GetMenu(id){

   		
        $.ajax({
	        url: BASE_URL +'/api/menu?role='+ id,
	        method: 'GET',
	        dataType: 'json',
	        success: function(data) {
	           // getMenu(data.menu)
               menu_list = data.result;
               contentMenu(data.result);
               
	        },
	        error: function(error) {
	            console.error(error);
	        }
        });



   	}

   	function SearchMenu(){

    	$('#Search').keyup(function(){
 		 let search = $('#Search').val();
 		 var method = '';
 		 var url = '';
 		 if(search)
 		 { 
           method = 'POST';
           url  = BASE_URL + '/api/menu/search'; 
 		 }else{
            method = 'GET';
            url  = BASE_URL + '/api/menu';

 		 }	
	 		 const content = $('#content');
        	 content.empty();
    	 	 let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
	         $.ajax({
	         	method: method,
	            url: url,

	            data:{'search':search},
	           
	            success: function(response) {
	            	 menu_list = response.result;
                     contentMenu(response.result);
	            	
	            },
	            error: function(error) {
	                console.error('Error fetching data:', error);
	            }
	        });
	         
        });
    }

   	function contentMenu(data){
          
        const content = $('#ContentMenu');

        // Clear previous data
        content.empty();
    if(data.length>0)
    { 
        data.forEach(function(item, index) {
            var row = ``;
		    row +=`<div class="full pull-left">`;
	   	        row +=`<div class="padding-5-0 form-group  col-sm-12 grup-checkbox">`;
	   	        	row +=`<div class="row-checkbox">`;
	   	        		row +=`<span class="black pull-left padding-05-05">`;
	   	        			row +=`<img  width='20' src="${base_asset+item.icon}" />`;
	   	        		row +=`</span>`;
	   	        		row +=`<div class="pull-left checkbox-label">`;
	   	        			row +=`<span class="text-bold font-16">${item.name}</span>`;
	   	        		row +=`</div>`;

	   	        		row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`;
                            
                          row +=``+GetBtnMoveMenu(item)+``;
	   	        			
	   	        			row +=`<span id="Edit-Menu" data-toggle="modal" data-target="#modal-edit-${item.id}" class="padding-05-05" data-toggle="tooltip" data-placement="top" title="Edit Data Menu" data-toggle="modal"   data-param_id="${item.id}" >`;
	   	        				row +=`<i   class="fa fa-pencil-square-o"></i> `;
	   	        				row +=`<i class="border-right-white"></i>`;
	   	        			row +=`</span>`;

	   	        			


	   	        			row +=`<span id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data"  data-param_id="${item.id}" class="padding-05-05">`;
	   	        				row +=`<i class="fa fa-trash"></i>`;
	   	        			row +=`</span>`;
	   	        		row +=`</div>`;

	   	        		    row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
			                		row +=`<div id="FormEdit-${item.id}"></div>`;
			                row +=`</div>`;
	   	        	row +=`</div>`;
	   	        row +=`</div>`;
	   	    row +=`</div>`;

	   	     content.append(row);
        });
	   	    
      }else{
         let row = ``;
         row +=`<div class="full pull-left">`;
         row +=`<div class="padding-5-0 form-group  col-sm-12 grup-checkbox text-center text-bold">Data Kosong</div>`;
         row +=`</div>`;
         content.append(row);
    }  

        $('#ContentMenu').slimScroll({
            height: '400px',
            railVisible: true,
            alwaysVisible: true,
            railOpacity: 0.4
        });

        $('#tabDrag').slimScroll({
            height: '400px',
            railVisible: true,
            alwaysVisible: true,
            railOpacity: 0.4
        });

        

    
   	}

   	function GetBtnMoveMenu(item){

            var row = '';
            if(item.move == true)
            {  
	            row +=`<span id="Move-Menu" class="padding-05-05" data-toggle="tooltip" data-placement="top" title="Pindah Ke Menu Setting" data-toggle="modal"   data-param_id="${item.id}" >`;
	    				row +=`<i   class="fa fa-arrow-left"></i> `;
	    				row +=`<i class="border-right-white"></i>`;
	    			row +=`</span>`;
	    	}else{

	    	      	row +=`<span id="Move-Disabled"  class="padding-05-05 disabled-span" data-toggle="tooltip" data-placement="top" title="Pindah Ke Menu Setting" data-toggle="modal"    >`;
	    				row +=`<i   class="fa fa-arrow-left"></i> `;
	    				row +=`<i class="border-right-white"></i>`;
	    			row +=`</span>`;
	    	 }		

    	      return row;

   	}

   	function MoveAction(item)
   	{ 
   		  
          var menu = localStorage.getItem('root_menu');
          var temp =  JSON.parse(menu);       
          var form = [];
          var merge = [];
   		  var iclass = '';
          loadingRole();
          
          $('#list-role').hide();
          $('#role-null').hide();
          if(temp)
          {
          	 if(item.parent == 'menu')
          	 {
                iclass = item.slug+ ' treeview';
          	 }else{
                iclass = item.slug;
          	 } 	
	          	 form = [{
	          	  'id': item.id,	
	              'name':item.name,
	              'parent':item.parent,
	              'class': iclass,
	              'slug':item.slug,
	              'active':false,
	              'path_web':item.path_web,
	              'icon':item.icon,
	              'icon_hover':item.icon_hover,
	              'option':item.option,
	              'tasks':[],
	            }];
	             
	              //roleid_old = temp.role_id;  
	              merge = [...form,...temp.menu];
	             	
             
              
          }else{
            
            if(item.parent == 'menu')
          	 {
                iclass = item.slug+ ' treeview';
          	 }else{
                iclass = item.slug;
          	 }
          	 //roleid_old = find.role_id; 
          	 //isi baru
          	 merge = [{
      	 	  'id': item.id,	
              'name':item.name,
              'parent':item.parent,
              'class':iclass,
              'slug':item.slug,
              'active':false, 
              'path_web':item.path_web,
              'icon':item.icon,
              'icon_hover':item.icon_hover,
              'option':item.option,
              'tasks':[],
            }];
          } 	
           
         
            
	    setTimeout(function() { 
	            
	            $('#list-role').show();
	            
	            if(temp)
	            {
	            	console.log('aktif temp')
	            	roleid_old = roleid_new; // update samakan role	
                    var send = merge;

	            }else{
	            	console.log('temp kosong')
	            
	            	if(roleid_old != roleid_new)
	                {
	                   console.log(role_menu)
	                   if(!role_menu)
	                   {
	                   	  var send = merge;
	                   }else{
	                   	   var send = [...merge,...role_menu];
	                   }	
	                      
                       
	                }else{
	                    console.log('temp + reales')
	                    console.log(role_menu)	
	                    var send = [...merge,...role_menu];	
	                    
	                }		
	              	
	            } 	
	              		
	          	
	           
              var form = {'menu':send,'role_id':roleid_new};

		       localStorage.setItem('root_menu', JSON.stringify(form));
               GetSettingRole(roleid_new);
               let find = menu_list.find(o => o.id === item.id);
               find.move = false;
               contentMenu(menu_list);
               $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
             
	    }, 500);
         
   	}

   	function loadingRole(){

   	 var val = '';
	 val +=`<div id="loading-role"  class="mt-20 ">`; 
	        val +=`<div class="list-group">`;
	                 val +=`<div class="text-bold text-center">Loading ...</div>`;
	         val +=`</div>`;   
     	val +=`</div>`;
    $('#tabRole').html(val);

   	}

   	function loadingRoleSub(){

   	 var val = '';
	 val +=`<div id="loading-role"  class="mt-20 ">`; 
	        val +=`<div class="list-group">`;
	                 val +=`<div class="text-bold text-center">Loading ...</div>`;
	         val +=`</div>`;   
     	val +=`</div>`;
    $('#tabRoleSub').html(val);

   	}


    function DeleteSetting(p_menu,index,role){
            
             loadingRole();
             var RoleData =[];
	   	     if(role_menu.length > 1)
	   	     {
	   	     	
	   	     	if(p_menu !='')
	   	        {
	   	        	    localStorage.removeItem('root_menu');
                        var ListReal = role_menu.find(o => o.slug === p_menu);
            			var SubMenu = ListReal.tasks;
            			
            			if(SubMenu.length > 0)
	   	                {

	   	                	var datasub =  SubMenu.find(o => o.slug === p_menu);
	   	                	if(datasub)
	   	                    {
                               SubMenu.splice(index, 1);
            			       ListReal.tasks =  SubMenu;
            			       RoleData = role_menu;   
	   	                    }else{
                               role_menu.splice(index, 1);
            			       RoleData = role_menu;  
	   	                    }		
	   	            

	                	}else{

	                		role_menu.splice(index, 1);
                            RoleData = role_menu;
	                	}

	              	

	                
	   	        }else{

                        localStorage.removeItem('root_menu');
                        role_menu.splice(index, 1);
                        RoleData = role_menu;
                         
	   	        }


	   	                var form = {'menu': JSON.stringify(RoleData),'role_id':roleid_new}; 
		                UpdateListItem(form,role,roleid_new)		
	   	     	 
	             
	   	     }else{
               
	   	     	if(p_menu !='')
	   	        {
	   	        	    localStorage.removeItem('root_menu');
                        var ListReal = role_menu.find(o => o.slug === p_menu);
            			var SubMenu = ListReal.tasks;
            			SubMenu.splice(index, 1);

            			if(SubMenu.length > 0)
	   	                {
            			     ListReal.tasks =  SubMenu;   
		                     var form = {'menu': JSON.stringify(role_menu),'role_id':roleid_new}; 
		                     UpdateListItem(form,role,roleid_new)

	                	}else{
                           
		                    localStorage.removeItem('root_menu');
	   	     	            DeleteMenuRole(role,roleid_new)
	                	}

	   	        }else{

                        localStorage.removeItem('root_menu');
	   	     	        DeleteMenuRole(role,roleid_new)
	   	        }	

	   	     	
	   	     	   
	   	     } 	
             		

   }

    function UpdateListItem(form,role,role_id){
                  
             
	          $.ajax({
	            type:"POST",
	            url: BASE_URL+'/api/menu/role/save',
	            data:form,
	            cache: false,
	            dataType: "json",
	            success: (respons) =>{

		            setTimeout(function() { 
		               
	             		let find = role.find(o => o.id === role_id);
	             		GetMenu(role_id);
	             		GetSettingRole(find.value);
	             		
	             		
	                }, 500);  
	                     
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	            }
	          });

   }

   function editMenuView(item)
   	{

   		var icon = '';
   		var icon_hover = '';
        var photo = '';
   		let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Menu</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
				                 row +=`<div id="name-alert-`+ item.id +`" class="form-group has-feedback" >`;
				                  row +=`<label>Nama</label>`;
				                  row +=`<input type="text" class="form-control" name="name" placeholder="Nama" value="`+ item.name +`">`;
				                  row +=`<span id="name-messages-`+ item.id +`"></span>`;
				                 row +=`</div>`;

				                  row +=`<div id="parent-alert-`+ item.id +`" class="form-group has-feedback" >`;
				                  row +=`<label>Parent</label>`;

				                      row +=`<select id="parent-`+ item.id +`" data-style="btn-default" name="parent"  class="selectpicker form-control" title="Pilihan Menu">
							                   <option value="menu">Jadikan Menu</option>
							                   <option value="sub">Jadikan Sub Menu</option>
							                   
							              </select>`;

				                  row +=`<span id="parent-messages-`+ item.id +`"></span>`;
				                 row +=`</div>`;


				                  row +=`<div id="path-web-alert-`+ item.id +`" class="form-group has-feedback" >`;
					               row +=`<label>URL : </label>`;
					               row +=`<input type="text" class="form-control" name="url" placeholder="URL" value="`+ item.path_web +`">`;
					               row +=`<span id="path-web-messages-`+ item.id +`"></span>`;
					             row +=`</div>`;

					             row +=`<div id="icon-alert-`+ item.id +`" class="form-group has-feedback">`;
					                 row +=`<label>Icon :</label>`;
					                 row +=`<input id="AddIcon" type="file"  name="upload_photo" >`;
					                 row +=`<span id="icon-messages-`+ item.id +`"></span>`;
					             row +=`</div>`;

            					 row +=`<div class="form-group has-feedback icon-photo"><img style="background:#000;" width="30" height="30"  src=" `+ base_asset +``+ item.icon +`"></div>`;

            					 row +=`<div id="icon-hover-alert-`+ item.id +`" class="form-group has-feedback">`;
					                 row +=`<label>Icon Hover:</label>`;
					                 row +=`<input id="AddIconHover" type="file"  name="upload_photo" >`;
					                 row +=`<span id="icon-hover-messages-`+ item.id +`"></span>`;
					             row +=`</div>`;

            					 row +=`<div class="form-group has-feedback icon-hover-photo"><img style="background:#fff;" width="30" height="30"  src="`+base_asset +``+ item.icon_hover +`"></div>`;

				                    



                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update-menu" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
						            row +=`<button id="load-update-menu" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
     						</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`;   



            $('#FormEdit-'+ item.id).html(row); 

            SelectParent(item);

            $('#parent').change(function() {
		        selectedVal = $(this).find("option:selected").val();
		        if(selectedVal =='menu')
		        {
		          $('#path-web-alert').hide();
		        }else{
		          $('#path-web-alert').show();
		        }  
		        

		    });

            
            $("#AddIcon").change((event)=> {     
            
            const files = event.target.files
            let filename = files[0].name
            const fileReader = new FileReader()
            fileReader.addEventListener('load', () => {

                    if(files[0].name.toUpperCase().includes(".PNG"))
                    {
                        icon = fileReader.result;
                        $('.icon-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ icon +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPEG")){
                        icon = fileReader.result;
                        $('.icon-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ icon +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPG")){
                        icon = fileReader.result;
                        $('.icon-photo').html('<img style="background:#000;" width="30" height="30" src="'+ icon +'">');
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

        $("#AddIconHover").change((event)=> {     
            
            const files = event.target.files
            let filename = files[0].name
            const fileReader = new FileReader()
            fileReader.addEventListener('load', () => {

                    if(files[0].name.toUpperCase().includes(".PNG"))
                    {
                        icon_hover = fileReader.result;
                        $('.icon-hover-photo').html('<img style="background:#fff;" width="30" height="30"  src="'+ icon_hover +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPEG")){
                        icon_hover = fileReader.result;
                        $('.icon-hover-photo').html('<img style="background:#fff;" width="30" height="30"  src="'+ icon_hover +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPG")){
                        icon_hover = fileReader.result;
                        $('.icon-hover-photo').html('<img style="background:#fff;" width="30" height="30" src="'+ icon_hover +'">');
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
   

    $( "#ContentMenu" ).on( "click", "#update-menu", (e) => {
		          let id = e.currentTarget.dataset.param_id;
	              var data = $("#FormSubmit-"+ id).serializeArray();
	              $("#update-menu").hide();
	              $("#load-update-menu").show();
	              
		          var form = {
		              'name':data[0].value,
		              'parent':data[1].value,
		              'path_web':data[2].value,
		              'icon':icon,
		              'icon_hover':icon_hover,
		             
		          };



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/menu/'+ id,
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{
			                   Swal.fire({
			                        title: 'Sukses!',
			                        text: 'Berhasil Diupdate',
			                        icon: 'success',
			                        confirmButtonText: 'OK'
			                        
			                    }).then((result) => {
			                        if (result.isConfirmed) {
			                            // User clicked "Yes, proceed!" button
			                            window.location.replace('/options');
			                        }
			                    });

			                   //
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                $("#update").show();
			                $("#load-simpan").hide();
 
			                if(errors.messages.name)
			                {
			                     $('#name-alert-'+id).addClass('has-error');
			                     $('#name-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
			                }else{
			                    $('#name-alert-'+id).removeClass('has-error');
			                    $('#name-messages-'+id).removeClass('help-block').html('');
			                }

			                

			               

			                
			            }
			          });
 
		        
	});      

	        

   	}


   	function SelectParent(item){
          console.log(item)
          
          var select =  $('#parent-'+item.id);
          select.selectpicker('val', item.parent);
          select.selectpicker('refresh');

          if(item.parent =='menu')
          {
          	$('#path-web-alert-'+ item.id).hide();
          }else{
          	$('#path-web-alert-'+ item.id).show();
          } 

          $('#parent-'+item.id).change(function() {
		        selectedVal = $(this).find("option:selected").val();
		        if(selectedVal =='menu')
		        {
		            $('#path-web-alert-'+ item.id).hide();
		        }else{
		          	$('#path-web-alert-'+ item.id).show();
		        }  
		        

		    });	


    }



   	function deleteItemMenu(id){

		$.ajax({
		    url:  BASE_URL +`/api/menu/`+ id,
		    method: 'DELETE',
		    success: function(response) {
		        // Handle success (e.g., remove deleted items from the list)
		        location.reload();
		    },
		    error: function(error) {
		        console.error('Error deleting items:', error);
		    }
		});

    }


   function DeleteMenuRole(role,role_id){
           
   	        $.ajax({
	            type:"DELETE",
	            url: BASE_URL+'/api/menu/role/'+ role_id,
	            cache: false,
	            dataType: "json",
	            success: (respons) =>{
	                
	                let find = role.find(o => o.id === role_id); 

             		localStorage.removeItem('root_menu');
             		GetMenu(find.id);
	                GetSettingRole(find.value);              		

	             		 
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	            }
	          });
   }


  function RoleNested(){

     var nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable'));
     const sortableContainer = document.getElementById('tabDrag');
	// Loop through each nested sortable element
	for (var i = 0; i < nestedSortables.length; i++) {
		new Sortable(nestedSortables[i], {
			group: 'nested',
			animation: 1000,
			ghostClass: 'moving-card',
			onEnd: function (evt) {
	            // Callback when sorting is finished
	            const sortedData = getSortedData(sortableContainer);
	            console.log(sortedData);

		   		var form = {
		           'menu':sortedData,
		           'role_id':roleid_new,
		        };
		        localStorage.setItem('root_menu', JSON.stringify(form));
                $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
                 
               
           }
			
		});
	}
	
  }
    // Function to collect sorted data
    function getSortedData(container)
    {
        
      const root = document.getElementById('tabRole');
      return serialize(root);
   
    }

   function serialize(sortable) {
   	  const nestedQuery = '.nested-sortable';
	  const slug = 'sortableId';
	  var serialized = [];
	  var children = [].slice.call(sortable.children);
      var menu = localStorage.getItem('root_menu');
      var temp =  JSON.parse(menu);
	 
      var find = []; 

	  for (var i in children)
	  {
		    var nested = children[i].querySelector(nestedQuery);
		    var param =  children[i].dataset[slug];
	        
	        if(temp)
	        { 
	          find = temp.menu.find(o => o.slug == param); 
	        }else{
	       	  find = role_menu.find(o => o.slug === param);
	        }	

		    serialized.push({
		      id: find.id,
		      name:find.name,
		      parent:find.parent,
		      active:find.active,
		      class:find.class,	
		      slug: find.slug,
		      icon:find.icon,
		      icon_hover:find.icon_hover,
		      option:find.option,
		      path_web:find.path_web,
		      tasks: find.tasks
		    });

	  }

	  return serialized;
	 
  }


  // function serializeSub(sortable)
  // {
  //  	  const nestedQuery = '.nested-sortable';
	 //  const slug = 'sortableId';
	 //  var serialized = [];
	 //  var children = [].slice.call(sortable.children);
	 //  var menu = localStorage.getItem('root_menu');
  //     var temp =  JSON.parse(menu);
  //     var find = [];
	 //  for (var i in children) 
	 //  {
	 //      var nested = children[i].querySelector(nestedQuery);
	 //      var param =  children[i].dataset[slug];
	 //      if(temp)
	 //      { 
	 //         find = temp.menu.find(o => o.slug === param);
	         
	 //      }else{
	 //         find = role_menu.find(o => o.slug === param);
	        
	 //      }	
             
  //          serialized.push({
		//       id: find.id,
		//       name:find.name,
		//       parent:find.parent,
		//       active:find.active,
		//       class:find.class,	
		//       slug: find.slug,
		//       icon:find.icon,
		//       icon_hover:find.icon_hover,
		//       option:find.option,
		//       path_web:find.path_web,
		//       tasks: nested ? serializeSub(nested) : []
		//     });

	 //  }
	 //  return serialized
  // }


   function RoleNestedSub(menus){
      
     var nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable-sub'));
     const sortableContainer = document.getElementById('tabDragSub');
	// Loop through each nested sortable element
	for (var i = 0; i < nestedSortables.length; i++) {
		new Sortable(nestedSortables[i], {
			group: 'nested',
			animation: 1000,
			ghostClass: 'moving-card',
			onEnd: function (evt) {

				var menu = localStorage.getItem('root_menu');
	 			var temp =  JSON.parse(menu);
				  
	            const sortedData = getSortedDataSub(sortableContainer,menus);
	       		if(temp)
	            {
                    let find = temp.menu.find(o => o.slug == menus);
                    find.tasks = sortedData;
                    var form = {
			           'menu':temp.menu,
			           'role_id':roleid_new,
			        };
	            }else{
                   
                    let find = role_menu.find(o => o.slug == menus);
                    find.tasks = sortedData;
			   		var form = {
			           'menu':role_menu,
			           'role_id':roleid_new,
			        };

	            } 	

		        localStorage.setItem('root_menu', JSON.stringify(form));

           }
			
		});
	}
	
  }

   function getSortedDataSub(container,menus)
   {
        
      const root = document.getElementById('tabRoleSub');
      return serializeDetail(root,menus);
   
    }

   function serializeDetail(sortable,menus) {
   	  const nestedQuery = '.nested-sortable-sub';
	  const slug = 'sortableId';
	  var serialized = [];
	  var children = [].slice.call(sortable.children);
      var menu = localStorage.getItem('root_menu');
	  var temp =  JSON.parse(menu);
	 
      var find = []; 

	  for (var i in children)
	  {
		    var nested = children[i].querySelector(nestedQuery);
		    var param =  children[i].dataset[slug];
	        
	        if(temp)
	        { 
	           let item = temp.menu.find(o => o.slug == menus);
	           find =  item.tasks.find(o => o.slug == param);
	       
	        }else{
	       	  let item = role_menu.find(o => o.slug === menus);
	       	  find =   item.tasks.find(o => o.slug == param);
	        }	

		    serialized.push({
		      id: find.id,
		      name:find.name,
		      parent:find.parent,
		      active:find.active,
		      class:find.class,	
		      slug: find.slug,
		      icon:find.icon,
		      icon_hover:find.icon_hover,
		      option:find.option,
		      path_web:find.path_web,
		      tasks:[]
		      // tasks: nested ? serializeDetail(nested) : []
		    });

	  }

	  return serialized;
	 
  }



     
  });
</script> 

@stop

