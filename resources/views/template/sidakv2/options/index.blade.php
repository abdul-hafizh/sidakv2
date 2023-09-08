@extends('template/sidakv2/layout.app')
@section('content')

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
      var menu_list = [];
      var role_list = [];
      var role_menu = [];
      var menu = localStorage.getItem('root_menu');
      var temp =  JSON.parse(menu);  

     

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

               let find = role_list.find(o => o.value === 'admin'); 
                
		       var selectedValue = find.value;
		       select.val(selectedValue);

		        
                ViewTabMenu(find)

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
          
           ViewTabMenu(find)

          



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

            

            row +=`</div>`;	

			row +=`<div class="group-list-btn-save col-sm-12">`;
			row +=`<button disabled id="SaveRole" data-toggle="modal" type="button" class="btn btn-default" >Simpan Role</button>`;
			row +=`</div> `;

        row +=`</div>`;



        row +=`<div id="modal-edit-${find.id}" class="modal fade" role="dialog">`;
        row +=`<div id="FormEdit-${find.id}"></div>`;
        row +=`</div>`;

        $('#viewRole').html(row);

       GetSettingRole(find.value);

        $('#SaveRole').on('click', function() {
          
    	     var menu = localStorage.getItem('root_menu');
       		 var temp =  JSON.parse(menu);
             var role_id = $('#role_id').val();
             let find = role_list.find(o => o.value === role_id); 
                
	   		 var form = {
	           'menu':temp.menu,
	           'role_id':find.id,
	         };


          $.ajax({
            type:"POST",
            url: BASE_URL+'/api/menu/role/save',
            data:form,
            cache: false,
            dataType: "json",
            success: (respons) =>{
                  
                   $('#SaveRole').prop("disabled", true).text('Simpan Role').removeClass('btn-primary').addClass('btn-default');

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
                
            }
          });
	       
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
                                            row +=`<span class="padding-05-05">`; 
                                                row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                                row +=`<i class="border-right-white"></i>`; 
                                            row +=`</span>`;  


                                            row +=`<span class="padding-05-05">`; 
                                            row +=`<i class="fa fa-lock"></i>`; 
                                            row +=`</span>`; 
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
	           
               let find = data.find(o => o.name === role);
           	   listMenuRole(find)
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
                                            row +=`<span id="Edit" data-param_id="`+ index +`" data-toggle="modal" data-target="#modal-edit-`+ index +`"  data-toggle="tooltip" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`; 
                                                row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                                row +=`<i class="border-right-white"></i>`; 
                                            row +=`</span>`;  

											



                                            row +=`<span class="padding-05-05">`; 
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

            var row = '';
            row +=`<div id="role-null"  class="mt-20 ">`; 
                    row +=`<div class="list-group">`;
                            row +=`<div class="text-bold text-center">Data Kosong</div>`;
                    row +=`</div>`;   
                row +=`</div>`;
           content.append(row);

        }

        $( "#tabRole" ).on( "click", "#Edit", (e) => {
             
            let index = e.currentTarget.dataset.param_id;
            let item = role_menu[index];
            
            $.ajax({
		        url: BASE_URL +'/api/menu/action',
		        method: 'GET',
		        dataType: 'json',
		        success: function(data) {
		           formAction(index,item,data)
	              
		        },
		        error: function(error) {
		            console.error(error);
		        }
	        });
              


        });    

   }

   function formAction(index,item,data){


   	 let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Aksi `+ item.name +`</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ index +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
							 row +=`<table class="table table-bordered">`;
							 row +=`<tbody>`;
								 row +=`<tr>`;
									 row +=`<th style="width: 10px">#</th>`;
									 row +=`<th>Aksi</th>`;
								 row +=`</tr>`;

								 for(let i=0; i<data.length; i++)
								 { 	
							 	 
								 	 row +=`<tr>`;
										 row +=`<td><input  type="checkbox" name="status" id="status" value="`+ data[i].slug +`" ></td>`;
										 row +=`<td>`+ data[i].name +`</td>`;
									 row +=`</tr>`;

								}


							 row +=`</tbody>`;
							  row +=`</table> `;

				               



                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update" data-param_id="`+ index +`" type="button" class="btn btn-primary" >Update</button>`;
						            row +=`<button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
     						</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ index).html(row); 


            $(".modal-content").on( "click", "#update", (e) => {
		          let id = e.currentTarget.dataset.param_id;
	              var data = $("#FormSubmit-"+ id).serializeArray();
                  var result = [];

	              for(let i =0; i<data.length; i++)
	              {
                      result.push({
                         'action':data[i].value,
                         'access':true,
                      });
                      
	              } 

	              console.log(item)
                   
                
	        });       



   }

   	function GetMenu(){
        $.ajax({
	        url: BASE_URL +'/api/menu',
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
                            
                            row +=`<span id="Move-Menu" class="padding-05-05" data-toggle="tooltip" data-placement="top" title="Pindah Ke Menu Setting" data-toggle="modal"   data-param_id="${item.id}" >`;
	   	        				row +=`<i   class="fa fa-arrow-left"></i> `;
	   	        				row +=`<i class="border-right-white"></i>`;
	   	        			row +=`</span>`;
	   	        			
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

   	function MoveAction(item)
   	{ 
          var menu = localStorage.getItem('root_menu');
          var temp =  JSON.parse(menu);       
          var form = [];
          var merge = [];
          loadingRole();
          $('#loading-role').show();
          $('#list-role').hide();
          $('#role-null').hide();
          if(temp)
          {
          	 form = [{
              'name':item.name,
              'path_web':item.path_web,
              'icon':item.icon,
              'tasks':[],
            }];

              merge = [...temp.menu,...form];
          }else{
          	 merge = [{
              'name':item.name,
              'path_web':item.path_web,
              'icon':item.icon,
              'tasks':[],
            }];
          } 	

         
            
	    setTimeout(function() { 
	           $('#loading-role').hide();

	           $('#list-role').show();
	           var send = {'menu':merge};
               localStorage.setItem('root_menu', JSON.stringify(send));
               GetSettingRole();
               $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
             //  ViewTabMenu(item)
	    }, 500);
         
   	}

   	function loadingRole(){

   	 var val = '';
	 val +=`<div id="loading-role" style="display:none;" class="mt-20 ">`; 
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
					                 row +=`<input id="AddFiles" type="file" name="upload_photo" >`;
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
    GetMenu();
     
  });
</script> 

@stop

