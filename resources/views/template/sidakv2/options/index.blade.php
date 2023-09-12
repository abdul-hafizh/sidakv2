@extends('template/sidakv2/layout.app')
@section('content')
<script src="{{ config('app.url').$template.'/js/sortable.js' }}"></script>
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
      
     <div id="viewRole" class="nav-tabs-custom">  	
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
      var menu = localStorage.getItem('root_menu');
      var temp =  JSON.parse(menu);  

     //menu
    $( "#ContentMenu" ).on( "click", "#Move-Menu", (e) => {
   		 let id = e.currentTarget.dataset.param_id;
   		 console.log(id)
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


    //role  

    function SelectRole(){
        
      $('#selectRole').html('<select id="role_id" class="selectpicker" data-style="btn-default" title="Pilih Role"></select>');
    	$.ajax({
            url: BASE_URL +'/api/select-role',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
            	role_list = data;
                // Populate SelectPicker options using received data
                var select =  $('#role_id')
                $.each(data, function(index, option) {
                    select.append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                });

               //
                
		       var selectedValue = 'admin';
		       let find = role_list.find(o => o.value === selectedValue);
		       roleid_old = find.id; 
		       roleid_new = find.id;
		       console.log(roleid_old)

		       select.val(selectedValue);

		        
                ViewTabMenu(find)
                GetMenu(find.id);


               // Refresh the SelectPicker to apply the new options
               select.selectpicker('refresh');
            },
            error: function(error) {
            console.error(error);
            }
        });


        $( "#viewRole" ).on( "click", "#Edit-Role", (e) => {
             let id = e.currentTarget.dataset.param_id;
             const item = role_list.find(o => o.id === id); 
            

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

				                    row +=`<div class="radio">`;
					                    row +=`<label>`;
					                    if(item.status_ori =='Y')
					                    {
					                        row +=`<input  type="radio" name="status" id="status`+ item.id +`" value="Y" checked>`;	
					                    }else{
					                    	row +=`<input  type="radio" name="status" id="status`+ item.id +`" value="Y" >`;
					                    } 	
					                 
					                      row +=`Aktif`;
					                    row +=`</label>`;
					                row +=`</div>`;
					                row +=`<div class="radio">`;
					                    row +=`<label>`;
					                      if(item.status_ori =='N')
					                    {
					                        row +=`<input   type="radio" name="status" id="status-N`+ item.id +`" value="N" checked>`;
					                    }else{
					                    	row +=`<input   type="radio" name="status" id="status-N`+ item.id +`" value="N" >`;
					                    } 

					                     
					                     row +=`Non Aktif`;
					                    row +=`</label>`;
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

    function UpdateRole(id){

        $( ".modal-content" ).on( "click", "#update-role", (e) => {
		         
	              var data = $("#FormSubmit-"+ id).serializeArray();
	              $("#update-role").hide();
	              $("#load-update-role").show();
	              
		          var form = {'name':data[0].value,'status':data[1].value};



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

    function ChangeRole(){
    	

    	$('#role_id').change(function() {
           selectedVal = $(this).find("option:selected").val();
           let find = role_list.find(o => o.value === selectedVal);
           roleid_new = find.id;
           var role_menu = [];
           GetMenu(find.id);
           ViewTabMenu(find);

        });

    }

    function ViewTabMenu(find){
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
            row +=`<div id="tabRole" class="tab-pane active">`;

            GetSettingRole(find.value);


            row +=`</div>`;	

			row +=`<div class="group-list-btn-save col-sm-12">`;
			row +=`<button disabled id="SaveRole" data-toggle="modal" type="button" class="btn btn-default" >Simpan Menu</button>`;
			row +=`</div> `;

        row +=`</div>`;



        row +=`<div id="modal-edit-${find.id}" class="modal fade" role="dialog">`;
        row +=`<div id="FormEdit-${find.id}"></div>`;
        row +=`</div>`;

        $('#viewRole').html(row);

       
        $('#SaveRole').on('click', function() {
             
    	     var menu = localStorage.getItem('root_menu');
       		 var temp =  JSON.parse(menu);
             
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
	             		let find = role_list.find(o => o.id === temp.role_id);
	             		GetMenu(find.id);
	             		GetSettingRole(find.value);
	             		$('#SaveRole').prop("disabled", true).text('Simpan Role').removeClass('btn-primary').addClass('btn-default');
	               }, 1000);  
	                  
	                   
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	                
	                
	            }
	          });  
	    });

	    $( "#tabRole" ).on( "click", "#Edit-Temp", (e) => {
               var menu = localStorage.getItem('root_menu');
       		   var temp =  JSON.parse(menu);

	           let index = e.currentTarget.dataset.param_id;
	           let item = temp.menu[index]; 
	          
			   formAction(index,item,temp.menu);  
	    });


	     $( "#tabRole" ).on( "click", "#Edit-Real", (e) => {
            let slug = e.currentTarget.dataset.param_id; 
            var menu = localStorage.getItem('root_menu');
       		var temp =  JSON.parse(menu);
            
            if(temp)
            {
	           let item = temp.menu.find(o => o.slug === slug);
			   formAction(slug,item,temp.menu);
            }else{
               let item = role_menu.find(o => o.slug === slug);   
		       formAction(slug,item,role_menu);
            }	
	  
        }); 

        $( "#tabRole" ).on( "click", "#Hapus-Real", (e) => {
            let slug = e.currentTarget.dataset.param_id;
            var menu = localStorage.getItem('root_menu');
       		var temp =  JSON.parse(menu);
            
            if(temp)
            {
	           let item = temp.menu.find(o => o.slug === slug);
			   DeleteSetting(slug,item,temp.menu);
            }else{
               let item = role_menu.find(o => o.slug === slug);   
		       DeleteSetting(slug,item,role_menu);
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
                        row +=`<div id="list-role" class="pull-left full">`; 
                        row +=`<div class="list-group">`;  
                          
                        row +=`<div class="form-group col-sm-12 grup-checkbox group-sub">`; 
                            row +=`<div class="row-checkbox">`; 
                                        row +=`<div class="pull-left checkbox-form">`; 
                                             row +=`<span class="black pull-left padding-05-05">`;
                                                row +=`<img width="20" src="${item.icon}">`;
                                             row +=`</span>`;
                                        row +=`</div>`;  

                                        row +=`<div class="pull-left checkbox-label">`; 
                                        row +=`<span class="pull-left text-bold font-16">${item.name}</span>`; 
                                        row +=` </div>`;  




                                row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`; 
                                            row +=`<span id="Edit-Temp" data-param_id="`+ index +`"   data-toggle="modal" data-target="#modal-edit-`+ index +`"  data-toggle="tooltip" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`; 
                                                row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                                row +=`<i class="border-right-white"></i>`; 
                                            row +=`</span>`;  


                                            row +=`<span id="Hapus-Real" data-param_id="${item.slug}" class="padding-05-05">`; 
                                            row +=`<i class="fa fa-trash"></i>`; 
                                            row +=`</span>`; 
                                row +=`</div>`; 

                                row +=`<div id="modal-edit-`+ index +`" class="modal fade" role="dialog">`;
							    row +=`<div id="FormEdit-`+ index +`"></div>`;
							    row +=`</div>`;


                            row +=`</div> `; 
                        row +=`</div>`; 

                        row +=`</div>`;   
                        row +=`</div>`;               
                 content.append(row);
            });

        }else{     

           GetDataRoleMenu(role)
        } 	
   	     
  
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
            result.forEach(function(item, index) {
 
                       var row = '';
                        row +=`<div id="list-role" class="pull-left full">`; 
                        row +=`<div class="list-group">`;  
                          
                        row +=`<div class="form-group col-sm-12 grup-checkbox group-sub">`; 
                            row +=`<div class="row-checkbox">`; 
                                        row +=`<div class="pull-left checkbox-form">`; 
                                             row +=`<span class="black pull-left padding-05-05">`;
                                                row +=`<img width="20" src="${item.icon}">`;
                                             row +=`</span>`;
                                        row +=`</div>`;  

                                        row +=`<div class="pull-left checkbox-label">`; 
                                        row +=`<span class="pull-left text-bold font-16">${item.name}</span>`; 
                                        row +=` </div>`;  




                                row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`; 
                                            row +=`<span id="Edit-Real" data-param_id="${item.slug}" data-toggle="modal" data-target="#modal-edit-${item.slug}"  data-toggle="tooltip" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`; 
                                                row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                                row +=`<i class="border-right-white"></i>`; 
                                            row +=`</span>`;  

											



                                            row +=`<span id="Hapus-Real" data-param_id="${item.slug}"   data-toggle="tooltip" data-placement="top" title="Hapus Setting" class="padding-05-05">`; 
                                            row +=`<i class="fa fa-trash"></i>`; 
                                            row +=`</span>`; 
                                row +=`</div>`; 


                            row +=`<div id="modal-edit-${item.slug}" class="modal fade" role="dialog">`;
							row +=`<div id="FormEdit-${item.slug}"></div>`;
							row +=`</div>`;

                            row +=`</div> `; 
                        row +=`</div>`; 

                        row +=`</div>`;   
                        row +=`</div>`;               
                 content.append(row);
            });
        }else{

            var row = '';
            row +=`<div id="role-null"  class="mt-20 ">`; 
                    row +=`<div class="list-group">`;
                            row +=`<div class="text-bold text-center">Data Kosong</div>`;
                    row +=`</div>`;   
                row +=`</div>`;
           content.append(row);

        }

       
 

           

   }

   function formAction(slug,item,role_menu){
       


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

						          row +=`<button id="update_action-`+ slug +`" data-param_id="`+ slug +`" type="button" class="btn btn-primary">Update</button>`;
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
		        let id = e.currentTarget.dataset.param_id;
	            var input = $("#FormSubmit-"+ id).serializeArray();
                $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
	             

                var result_input = [];
                var result_in = [];
                var result = [];
                var listnew = [];
                var listold = [];
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
                 
               
                listnew.push({
	                 'icon':item.icon,
	                 'name':item.name,
	                 'slug':item.slug,
	                 'tasks':[],
	                 'path_web':item.path_web,
	                 'option':result,
                });

                for(let x =0; x<role_menu.length; x++)
                {
              	   
              	    
                 if(listnew[0].slug != role_menu[x].slug)
                 {

                 	 listold.push({
	                     'icon':role_menu[x].icon,
	                     'tasks':[],
	                     'name':role_menu[x].name,
	                     'slug':role_menu[x].slug,
	                     'option':role_menu[x].option,
	                     'path_web':role_menu[x].path_web
	                    
	                  });
                  } 	

                }


                merge = [...listnew,...listold];
               
	            var role_id = $('#role_id').val();
	            let find = role_list.find(o => o.value === role_id); 

		   		var form = {
		           'menu':merge,
		           'role_id':find.id,
		        };

                loadingModal(id);
                $('#update_action-'+ id).hide();
                $('#load-action-'+ id).show();

                setTimeout(function() { 
	                localStorage.setItem('root_menu', JSON.stringify(form));
                    $('#modal-edit-'+ id).modal('toggle');  
	   			}, 1000);
		       
                
	        });       



   }


   function DeleteSetting(slug,item,role_menu){
            
            var listold = [];
             
            for(let x =0; x<role_menu.length; x++)
            {    
                if(slug != role_menu[x].slug)
                {

                 	 listold.push({
                 	 	 'id':role_menu[x].id,
	                     'icon':role_menu[x].icon,
	                     'tasks':[],
	                     'name':role_menu[x].name,
	                     'slug':role_menu[x].slug,
	                     'option':role_menu[x].option,
	                     'path_web':role_menu[x].path_web
	                    
	                  });
                   	

                }
            }

            var role_id = $('#role_id').val();
            let find = role_list.find(o => o.value === role_id); 

	   		var form = {
	           'menu':JSON.stringify(listold),
	           'role_id':find.id,
	        };
            
	       
	        if(listold.length >0)
	        {
	        	loadingRole();
	        	localStorage.removeItem('root_menu'); 
                UpdateListItem(form,find.id)
	        }else{
	        	localStorage.removeItem('root_menu'); 
	        	DeleteMenuRole(item,find.id);
	        } 	
 

       

   }

   function UpdateListItem(form,role_id){
                  

     
	          $.ajax({
	            type:"POST",
	            url: BASE_URL+'/api/menu/role/save',
	            data:form,
	            cache: false,
	            dataType: "json",
	            success: (respons) =>{

		            setTimeout(function() { 
		             	localStorage.removeItem('root_menu');
	             		let find = role_list.find(o => o.id === role_id);
	             		GetMenu(role_id);
	             		GetSettingRole(find.value);
	             		//location.reload();
	             		
	                }, 1000);  
	                     
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	            }
	          });

   }

   function DeleteMenuRole(item,role_id){
            console.log(item)
   	        $.ajax({
	            type:"DELETE",
	            url: BASE_URL+'/api/menu/role/'+ role_id,
	            cache: false,
	            dataType: "json",
	            success: (respons) =>{
	               
	                    
	             		localStorage.removeItem('root_menu');
	             		let find = role_list.find(o => o.id === role_id);
	             		GetSettingRole(find.value); 
	             		roleid_old = role_id;
                        roleid_new = role_id;
                        role_menu = [];
	             		

	             		var val = '';
				        val +='<i class="fa fa-arrow-left"></i>'; 
				        val +='<i class="border-right-white"></i>';
		                $('#Move-Disabled').attr("id", "Move-Menu").removeClass('disabled-span').html(val);
	                    $('#Move-Menu').attr("data-param_id", item.id);  
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	            }
	          });
   }

   function loadingModal(id){
          row = '';
          row +=`<div class="text-bold text-center margin-top-bottom-50 font-16">Loading ...</div>`; 
          $('#TableAction-' + id).html(row);
                               
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
	   	        			row +=`<img  width='20' src="${item.icon}" />`;
	   	        		row +=`</span>`;
	   	        		row +=`<div class="pull-left checkbox-label">`;
	   	        			row +=`<span class="text-bold font-16">${item.name}</span>`;
	   	        		row +=`</div>`;

	   	        		row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`;
                            
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

       

   	}

   	function MoveAction(item)
   	{ 
   		  
          var menu = localStorage.getItem('root_menu');
          var temp =  JSON.parse(menu);       
          var form = [];
          var merge = [];

          var role_id = $('#role_id').val();
          let find = role_list.find(o => o.value === role_id); 
   		  

          
          
          loadingRole();
          
          $('#list-role').hide();
          $('#role-null').hide();
          if(temp)
          {
	          	 form = [{
	          	  'id': item.id,	
	              'name':item.name,
	              'slug':item.slug,
	              'path_web':item.path_web,
	              'icon':item.icon,
	              'option':item.option,
	              'tasks':[],
	            }];
	             
	              //roleid_old = temp.role_id;  
	              merge = [...temp.menu,...form];
	             	
             
              
          }else{

          	 //roleid_old = find.role_id; 
          	 //isi baru
          	 merge = [{
          	  'id': item.id, 	
              'name':item.name,
              'slug':item.slug,
              'path_web':item.path_web,
              'icon':item.icon,
              'option':item.option,
              'tasks':[],
            }];
          } 	
           
         
            
	    setTimeout(function() { 
	            
	            $('#list-role').show();
	            
	            if(temp)
	            {
	            	console.log('temp')
                    var send = merge;
	            }else{
	            	
	            	console.log(roleid_old)
	            	console.log(roleid_new)
	            	if(roleid_old != roleid_new)
	                {
	                   console.log(role_menu)
	                   console.log('temp')
	                   var send = merge;
	                   	
	                   roleid_old = roleid_new;	
                       
	                }else{
	                    console.log('temp + reales')
	                    console.log(role_menu)	
	                   var send = [...role_menu,...merge];	
	                }		
	              	
	            } 	
	              		
	          	
	           
              var form = {
	           'menu':send,
	           'role_id':find.id,
	          };

		       localStorage.setItem('root_menu', JSON.stringify(form));
		       var val = '';
		       val +='<i class="fa fa-arrow-left"></i>'; 
		       val +='<i class="border-right-white"></i>';
               $('#Move-Menu').attr("id", "Move-Disabled").addClass('disabled-span').html(val);
               GetSettingRole(find.value);

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

   	function editMenuView(item)
   	{
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
				                  row +=`<input type="text" class="form-control" name="name" placeholder="Nama" value="`+ item.name +`">
				                  <span id="name-messages-`+ item.id +`"></span>`;
				                 row +=`</div>`;


				                  row +=`<div id="path-web-alert-`+ item.id +`" class="form-group has-feedback" >`;
					               row +=`<label>URL : </label>`;
					               row +=`<input type="text" class="form-control" name="url" placeholder="URL" value="`+ item.path_web +`">`;
					               row +=`<span id="path-web-messages-`+ item.id +`"></span>`;
					             row +=`</div>`;

					             row +=`<div id="icon-alert-`+ item.id +`" class="form-group has-feedback">`;
					                 row +=`<label>Icon :</label>`;
					                 row +=`<input id="AddFiles" type="file"  name="upload_photo" >`;
					                 row +=`<span id="icon-messages-`+ item.id +`"></span>`;
					             row +=`</div>`;

            					 row +=`<div class="form-group has-feedback user-photo"><img style="background:#000;" width="30" height="30"  src="`+ item.icon +`"></div>`;

				                    



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

            $("#AddFiles").change((event)=> {     
            
            const files = event.target.files
            let filename = files[0].name
            const fileReader = new FileReader()
            fileReader.addEventListener('load', () => {

                    if(files[0].name.toUpperCase().includes(".PNG"))
                    {
                        photo = fileReader.result;
                        $('.user-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ photo +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPEG")){
                        photo = fileReader.result;
                        $('.user-photo').html('<img style="background:#000;" width="30" height="30"  src="'+ photo +'">');
                    }else if(files[0].name.toUpperCase().includes(".JPG")){
                        photo = fileReader.result;
                        $('.user-photo').html('<img style="background:#000;" width="30" height="30" src="'+ photo +'">');
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
		              'path_web':data[1].value,
		              'icon':photo,
		             
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
   
   	localStorage.removeItem('root_menu');

   	SelectRole();
   	SearchMenu();
   	ChangeRole();
   
     
  });
</script> 

@stop

