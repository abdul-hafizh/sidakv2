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
  <!-- <script src="http://sortablejs.github.io/Sortable/Sortable.js"></script>

  -->
    
<script>
   $( function() {
   	  var roleid_old ='';
   	  var roleid_new ='';
      var menu_list = [];
      var role_list = [];
      var role_menu = [];

     
   
      localStorage.removeItem('root_menu');
      var selectedValue = 'admin';  
      var menu = localStorage.getItem('root_menu');
      var temp =  JSON.parse(menu); 



   	  GetRole();
   	 
   	// SearchMenu();
   	 


    


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
        $('#selectRole').html('<select id="role_id"  class="selectpicker" data-style="bg-navy" title="Pilih Role"></select>');
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

    }


    function ViewTabFirst(data){
        let find = data.find(o => o.value === selectedValue);
        roleid_old = find.id; 
        roleid_new = find.id;
        console.log(roleid_old+' Role lama')

        ViewTabMenu(find)
        GetMenu(find.id); 

           //menu
	    $( "#ContentMenu" ).on( "click", "#Move-Menu", (e) => {
	   		 let id = e.currentTarget.dataset.param_id;
	   	     const item = menu_list.find(o => o.id === id);
	         MoveAction(item)
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
	            row +=`<div id="tabRole" class="nested-sortable">`;
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

	               }, 1000);  
	                  
	                   
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	                
	                
	            }
	          });  
	    });

	    $( "#tabRole" ).on( "click", "#Hapus-Temp", (e) => {
	   		 let index = e.currentTarget.dataset.param_id;

	   		  var menu = localStorage.getItem('root_menu');
       		  var temp =  JSON.parse(menu);
       		  let find = role.find(o => o.id === temp.role_id);
	          loadingRole();


              setTimeout(function() { 
	             	
			   	     if(temp.menu.length > 1)
			   	     {
                         temp.menu.splice(index, 1); 
                         var form = {'menu':temp.menu,'role_id':find.id};
                         localStorage.setItem('root_menu', JSON.stringify(form));
                         GetMenu(find.id);
			             GetSettingRole(find.value);

			   	     }else{
			   	     	 localStorage.removeItem('root_menu');
			   	     	 GetMenu(find.id);
			             GetSettingRole(find.value);
			   	     	   
			   	     } 	
             		

               }, 1000);     		

	   	}); 

	    //delete Role
        $( "#tabRole" ).on( "click", "#Hapus-Real", (e) => {
            let index = e.currentTarget.dataset.param_id;
         //    var menu = localStorage.getItem('root_menu');
       		// var temp =  JSON.parse(menu);

      //  		Swal.fire({
		    //   title: 'Apakah anda yakin hapus role '+ slug +'?',
		    
		    //   icon: 'warning',
		    //   showCancelButton: true,
		    //   confirmButtonColor: '#d33',
		    //   cancelButtonColor: '#3085d6',
		    //   confirmButtonText: 'Ya'
		    // }).then((result) => {
		    //   if (result.isConfirmed) {
		        
		                        
		           
		              // let item = role_menu.find(o => o.slug === slug);   
				       DeleteSetting(index,role);
		           

		        
		    //     Swal.fire(
		    //       'Deleted!',
		    //       'Data berhasil dihapus.',
		    //       'success'
		    //     );
		    //   }
		    // });
            
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
           	row +=`<div id="list-role" data-id="${item.slug}" class="list-group-item pull-left full" style="" draggable="false">`;
           	    
           	   row +=`<div class="list-group pointer margin-none">`; 
                    row +=`<div class="row-checkbox pull-left full">`; 
                   
                        row +=`<div class="checkbox-form pull-left">`; 
                             row +=`<span class="black pull-left padding-05-05">`;
                                row +=`<img width="20" src="${item.icon}">`;
                             row +=`</span>`;
                        row +=`</div>`;  

                        row +=`<div class="pull-left checkbox-label">`; 
                          row +=`${item.name}`; 
                        row +=`</div>`;

                        row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`;

                            row +=`<span id="Edit-Real" data-param_id="${item.slug}" data-toggle="modal" data-target="#modal-edit-${item.slug}"  data-toggle="tooltip" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`; 
                                        row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                        row +=`<i class="border-right-white"></i>`; 
                                    row +=`</span>`;  


                            row +=`<span id="Hapus-temp" data-param_id="${index}"   data-toggle="tooltip" data-placement="top" title="Hapus Setting" class="padding-05-05">`; 
                                    row +=`<i class="fa fa-trash"></i>`; 
                                    row +=`</span>`;          

                        row +=`</div>`;

                        
                    row +=`<div id="modal-edit-${item.slug}" class="modal fade" role="dialog">`;
					row +=`<div id="FormEdit-${item.slug}"></div>`;
					row +=`</div>`;

                    row +=`</div>`;

              row +=`</div>`;



               row +=`<div class="list-group pointer  nested-sortable"></div>`;
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
                   	row +=`<div id="list-role" data-id="${item.slug}" class="list-group-item pull-left full" style="" draggable="false">`;
                   	    
                   	   row +=`<div class="list-group pointer margin-none">`; 
                            row +=`<div class="row-checkbox pull-left full">`; 
	                       
                                row +=`<div class="checkbox-form pull-left">`; 
                                     row +=`<span class="black pull-left padding-05-05">`;
                                        row +=`<img width="20" src="${item.icon}">`;
                                     row +=`</span>`;
                                row +=`</div>`;  

		                        row +=`<div class="pull-left checkbox-label">`; 
		                          row +=`${item.name}`; 
		                        row +=`</div>`;

		                        row +=`<div class="pull-right padding-05-05 bg-list-menu-btn">`;

		                            row +=`<span id="Edit-Real" data-param_id="${item.slug}" data-toggle="modal" data-target="#modal-edit-${item.slug}"  data-toggle="tooltip" data-placement="top" title="Setting Aksi Menu" class="padding-05-05">`; 
                                                row +=`<i data-toggle="modal" data-target="#AddPages" class="fa fa-cog"></i>`; 
                                                row +=`<i class="border-right-white"></i>`; 
                                            row +=`</span>`;  


                                    row +=`<span id="Hapus-Real" data-param_id="${index}"   data-toggle="tooltip" data-placement="top" title="Hapus Setting" class="padding-05-05">`; 
                                            row +=`<i class="fa fa-trash"></i>`; 
                                            row +=`</span>`;          

                                row +=`</div>`;

                                
                            row +=`<div id="modal-edit-${item.slug}" class="modal fade" role="dialog">`;
							row +=`<div id="FormEdit-${item.slug}"></div>`;
							row +=`</div>`;

                            row +=`</div>`;

                      row +=`</div>`;



                       row +=`<div class="list-group pointer  nested-sortable"></div>`;
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

       
 //    var nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable'));
 //     const sortableContainer = document.getElementById('tabDrag');
	// // Loop through each nested sortable element
	// for (var i = 0; i < nestedSortables.length; i++) {
	// 	new Sortable(nestedSortables[i], {
	// 		group: 'nested',
	// 		animation: 500,
	// 		ghostClass: 'moving-card',
	// 		onEnd: function (evt) {
	//             // Callback when sorting is finished
	//             const sortedData = getSortedData(sortableContainer);
	//             console.log(sortedData);
 //           }
			
	// 	});
	// }

   
     // Function to collect sorted data
    // function getSortedData(container) {
    //     const sortedData = [];

    //     const lists = container.querySelectorAll('#tabRole');
    //     const items = [];
    //     const find = [];
    //     lists.forEach(function (list) {
    //         const listId = list.getAttribute('data-id');
    //         const listItems = list.querySelectorAll('#list-role');

    //         listItems.forEach(function (item, index) {
    //             const name = item.getAttribute('data-id');
       
    //             items.push({
    //                 name: name,
    //                 tasks: getNestedSortedData(item),
    //             });
    //         });

         
    //     });




    //     return items;
    // }

    // Function to collect nested sorted data
    // function getNestedSortedData(parentItem) {
    //     const nestedData = [];

    //     const nestedLists = parentItem.querySelectorAll('.nested-sortable');
    //     const items = [];

    //     nestedLists.forEach(function (list) {
    //         const listId = list.getAttribute('data-id');
           
    //         const listItems = list.querySelectorAll('#list-role');

    //         listItems.forEach(function (item, index) {

    //             const itemId = item.getAttribute('data-id');
    //             items.push({
    //                 name: itemId,
                   
    //             });
    //         });
    //     });

    //     return items;
    // }
    
           

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
	            	console.log('aktif temp')
	            	roleid_old = roleid_new; // update samakan role	
                    var send = merge;

	            }else{
	            	console.log('temp kosong')
	            
	            	if(roleid_old != roleid_new)
	                {
	                   //console.log(role_menu)
	                  
	                   var send = merge;
	
	                  
                       
	                }else{
	                    console.log('temp + reales')
	                    console.log(role_menu)	
	                   var send = [...role_menu,...merge];	
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


   	function DeleteSetting(index,role){
            
            loadingRole();

            setTimeout(function() { 
	             	
			   	     if(role_menu.length > 1)
			   	     {
			   	     	 localStorage.removeItem('root_menu');
                         role_menu.splice(index, 1); 
                         var form = {'menu':role_menu,'role_id':roleid_new};
                         UpdateListItem(form,role,roleid_new)

			   	     }else{
			   	     	 // localStorage.removeItem('root_menu');
			   	     	 // GetMenu(find.id);
			           //   GetSettingRole(find.value);
			   	     	   
			   	     } 	
             		

            }, 1000);  

     

            

	   
            
	       
	     //    if(listold.length >0)
	     //    {
	     //    	loadingRole();
	     //    	localStorage.removeItem('root_menu'); 
      //           UpdateListItem(form,roleid_new)
	     //    }else{
	     //    	localStorage.removeItem('root_menu'); 
	     //    	DeleteMenuRole(item,roleid_new);
	     //    } 	

	     //      $('#SaveRole').prop("disabled", false).removeClass('btn-default').addClass('btn-primary');
             

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
	             		
	             		
	                }, 1000);  
	                     
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	            }
	          });

   }


   function DeleteMenuRole(item,role_id){
           
   	        $.ajax({
	            type:"DELETE",
	            url: BASE_URL+'/api/menu/role/'+ role_id,
	            cache: false,
	            dataType: "json",
	            success: (respons) =>{
	               
	                    
             		localStorage.removeItem('root_menu');
             		GetSettingRole(roleid_new); 
             		GetMenu(roleid_new);	              		

	             		 
	            },
	            error: (respons)=>{
	                errors = respons.responseJSON;
	            }
	          });
   }

    
   
     
  });
</script> 

@stop

