@extends('template/sidakv2/layout.app')
@section('content')

<section class="content-header pd-left-right-15">
    <div  class="col-sm-4 pull-left padding-default full margin-top-bottom-20" >
        <div class="pull-right width-25">
            <div class="input-group input-group-sm border-radius-20">
				<input type="text" id="search-input" placeholder="Cari" class="form-control height-35 border-radius-left">
				<span class="input-group-btn">
				<button id="Search" type="button" class="btn btn-search btn-flat height-35 border-radius-right"><i class="fa fa-search"></i></button>
				</span>
			</div>
        </div> 	
    </div> 	

	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
			<div class="pull-left padding-9-0 margin-left-button">
				<select id="row_page" class="selectpicker" data-style="bg-navy" >
					<option value="10" selected>10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="all">All</option>
				</select>
            </div>
			<!-- <div id="ShowChecklist" style="display:none;"  class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
					 Hapus
				</button>

			</div> -->

			<div id="ShowExport" style="display:none;" class="pull-left padding-9-0 margin-left-button" >
                <button type="button" id="ExportButton"  class="btn btn-info border-radius-10">
                     Export
                </button>
            </div>

			
			<!-- <div id="ShowAdd" style="display:none;" class="pull-left padding-9-0">
                <button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
				 Tambah Data
				</button> 
		    </div> -->	

				
		</div> 

		<div  class="pull-right width-50">
			<ul id="pagination" class="pagination-table pagination"></ul>
		</div>
	</div>
</section>

<div class="content">
	<div class="clearfix"></div>
	<div class="clearfix"></div> 



	<div class="box box-solid box-primary">
		<div class="box-body">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<!-- <th id="ShowChecklistAll" style="display:none;"><input id="select-all" class="span-title" type="checkbox"></th> -->
							<th><span class="span-title">No</span></th>
							<th><div class="split-table"></div><span class="span-title">Kategori</span></th>
							<th><div class="split-table"></div><span class="span-title">Keterangan</span></th>
							<th id="ShowStatus" style="display:none;"><div class="split-table"></div><span class="span-title">Status</span></th>
							<th id="ShowCreated" style="display:none;"><div class="split-table"></div><span class="span-title">Dibuat</span></th>  
							<th id="ShowAction" style="display:none;"><div class="split-table"></div><span class="span-title">Aksi</span></th>
						</tr>
					</thead>

					<tbody id="content">
						
					
					 </tbody>
				</table>
			</div>
		</div>
	</div>


	<div class="pull-left full">
          <div id="total-data" class="pull-left width-25"></div> 	
	</div>
</div>
 <!--  @include('template/sidakv2/kendala.add')    --> 
  @include('template/sidakv2/kendala.exportKriteria')
<script type="text/javascript">

 $(document).ready(function() {

 	
    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    const total = 0;

    $("#ExportButton").click(function() {    
        $.ajax({
            url: BASE_URL+ `/api/kendala?page=${page}&per_page=all`,
            method: 'GET',
            success: function(response) {
            	
            	 exportData(response.data);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });

    });

    $('#row_page').on('change', function() {
            var value = $(this).val();         
            if(value)
            {   
                 const content = $('#content');
                 content.empty();
                 let row = ``;
                 row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                  content.append(row);
                  let search = $('#search-input').val();
                  if(search !='')
                  {
                  	var url = BASE_URL + `/api/kendala/search?page=${page}&per_page=${value}`;
                  	var method = 'POST';
                  }else{
                    var url = BASE_URL + `/api/kendala?page=${page}&per_page=${value}`;
                    var method = 'GET';
                  } 	

                $.ajax({
                    url: url,
                    method: method,
                    data:{'search':search},
                    success: function(response) {
                    	list = response.data;
                        resultTotal(response.total);
                        listOptions(response.options);
                        updateContent(response.data,response.options);
                        updatePagination(response.current_page, response.last_page);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }    
    // Perform other actions based on the selected value
    });

     // "Select All" checkbox
    $('#select-all').on('change', function() {
        $('.item-checkbox').prop('checked', $(this).is(':checked'));

         const checkedCount = $('.item-checkbox:checked').length;
         if(checkedCount >0)
         {
         	$('#delete-selected').prop("disabled", false);
         }else{
         	$('#delete-selected').prop("disabled", true);
         } 

    });

     // Refresh selected button
    $('#refresh').on('click', function() {
    	
        fetchData(page);
        $('#search-input').val('');
    });

    // Delete selected button
    $('#delete-selected').on('click', function() {
        const selectedIds = [];
        $('.item-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });


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
		        // Send selected IDs for deletion (e.g., via AJAX)
   				 deleteItems(selectedIds);
		        
		        Swal.fire(
		          'Deleted!',
		          'Data berhasil dihapus.',
		          'success'
		        );
		      }
		    });
       
    });

    // Individual item checkboxes
    $('.item-checkbox').on('change', function() {
        const allChecked = $('.item-checkbox:checked').length === $('.item-checkbox').length;
        $('.select-all').prop('checked', allChecked);
    });

    // search btn
    $('#Search').click( () => {
 		 let search = $('#search-input').val();
 		 
 		 if(search)
 		 { 	
	 		 const content = $('#content');
        	 content.empty();
    	 	 let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
	         $.ajax({
	            url: BASE_URL + `/api/kendala/search?page=${page}&per_page=${itemsPerPage}`,
	            data:{'search':search},
	            method: 'POST',
	            success: function(response) {
	            	list = response.data;
                    resultTotal(response.total);
	                listOptions(response.options);
                    updateContent(response.data,response.options);
	                updatePagination(response.current_page, response.last_page);
	            },
	            error: function(error) {
	                console.error('Error fetching data:', error);
	            }
	        });
	     }    
    });

     // search keyup
    $('#search-input').keyup( () => {
 		 let search = $('#search-input').val();
 		 
 		 if(search)
 		 { 	
	 		 const content = $('#content');
        	 content.empty();
    	 	 let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
	         $.ajax({
	            url: BASE_URL + `/api/kendala/search?page=${page}&per_page=${itemsPerPage}`,
	            data:{'search':search},
	            method: 'POST',
	            success: function(response) {
	            	list = response.data;
                    resultTotal(response.total);
	                listOptions(response.options);
                    updateContent(response.data,response.options);
	                updatePagination(response.current_page, response.last_page);
	            },
	            error: function(error) {
	                console.error('Error fetching data:', error);
	            }
	        });
	     }    
    });

    // Function to fetch data from the API
    function fetchData(page) {
    	  
		const content = $('#content');
		content.empty();

		let row = ``;
		row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
		content.append(row);

        $.ajax({
            url: BASE_URL+ `/api/kendala?page=${page}&per_page=${itemsPerPage}`,
            method: 'GET',
            success: function(response) {
            	list = response.data;
                resultTotal(response.total);
                listOptions(response.options);
                updateContent(response.data,response.options);
                updatePagination(response.current_page, response.last_page);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Function to update the content area with data
    function updateContent(data,options) {
       
        // const edited = options.find(o => o.action === 'edit');
        // const deleted = options.find(o => o.action === 'delete');
        const detail = options.find(o => o.action === 'detail');
        // const checklist = options.find(o => o.action === 'checklist');
        const created = options.find(o => o.action === 'dibuat');
        const status = options.find(o => o.action === 'status');
        // Clear previous data
        const content = $('#content');
        content.empty();
        if(data.length>0)
        { 
	        // Populate content with new data
	        data.forEach(function(item, index) {
	           	let row = ``;
	             row +=`<tr>`;
	              // if(checklist.checked == true)
               //    {
	              //  row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
	              //  } 
	               row +=`<td>${item.number}</td>`;
	               row +=`<td>${item.category }</td>`;
	               
	               row +=`<td>${item.description}</td>`;
	            if(status.checked == true){
	            	 row +=`<td>${item.status.status_convert}</td>`;
	            } 

	            if(created.checked == true){
	            	  row +=`<td>${item.created_at}</td>`;
	            }
		          
		          
	               row +=`<td>`; 
	               row +=`<div class="btn-group">`;

	               // row +=`<button id="Export"  data-param_id="`+ index +`" data-toggle="modal" data-target="#modal-edit-${item.id}" data-toggle="tooltip" data-placement="top" title="Export Data" type="button" class="btn btn-primary"><i class="fa fa-file-excel-o" ></i></button>`;
                if(detail.checked ==true)
                {
                	row +=`<button id="Detail"  data-param_id="${item.id}"  data-toggle="tooltip" data-placement="top" title="Lihat ${item.category }" type="button" class="btn btn-primary"><i class="fa fa-eye" ></i></button>`;	
                } 	
	                

	            // if(edited.checked == true)
             //    {  
    
	            //     row +=`<button id="Edit"  data-param_id="`+ index +`" data-toggle="modal" data-target="#modal-edit-${item.id}" data-toggle="tooltip" data-placement="top" title="Edit Data" type="button" class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;	

	            //     row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
	            //     row +=`<div id="FormEdit-${item.id}"></div>`;
	            //     row +=`</div>`;

	            // }     


             //    if(deleted.checked == true) 
             //    {
	            //     row +=`<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;
	            // }    

	                row +=`</div>`;
	                row +=`</td>`;
	              row +=`</tr>`; 

	            content.append(row);

	         });

        }else{
            
             	let row = ``;
	             row +=`<tr>`;
	             row +=`<td colspan="7" align="center">Data Kosong</td>`;
                 row +=`</tr>`;
                 content.html(row);

	    }  

        $('.item-checkbox').on('click', function() {
	         const checkedCount = $('.item-checkbox:checked').length;
	         if(checkedCount>0)
	         {
	           $('#delete-selected').prop("disabled", false);
	         }else{
	           $('#delete-selected').prop("disabled", true);
	         } 	
   		});


        $( "#content" ).on( "click", "#Edit", (e) => {
             
            let index = e.currentTarget.dataset.param_id;
            const item = list[index];
            
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content ">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" id="close1" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Forum</h4>`;
				       row +=`</div>`;

				       row +=`<form  id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                    
                           row +=`<div id="category-alert-`+ item.id +`" class="form-group has-feedback" >`;
			               row +=`<label>Kategori :</label>`;
			               row +=`<input name="category" class="form-control" value="`+ item.category +`"  type="text">`;
			               row +=`<span id="category-messages-`+ item.id +`"></span>`;
			               row +=`</div>`;
                                 

			               row +=`<div id="description-alert-`+ item.id +`" class="form-group has-feedback " >`;
			               row +=`<label>Keterangan :</label>`;
			               row +=`<textarea id="description"  class="form-control textarea-fixed-replay" placeholder="Keterangan" name="description">`+ item.description +`</textarea>`;
			               row +=`<span id="description-messages-`+ item.id +`"></span>`;
			               row +=`</div>`;


			                row +=`<div class="radio">`;
				                    row +=`<label>`;
				                    if(item.status.status_db =='Y')
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
				                      if(item.status.status_db =='N')
				                    {
				                        row +=`<input   type="radio" name="status" id="status-N`+ item.id +`" value="N" checked>`;
				                    }else{
				                    	row +=`<input   type="radio" name="status" id="status-N`+ item.id +`" value="N" >`;
				                    } 

				                     
				                     row +=`Non Aktif`;
				                    row +=`</label>`;
				                row +=`</div>`;




                            row +=`</div>`;

                            row +=`<div class="modal-footer">`;
						        row +=`<button id="close2" type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="simpan" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
						           
     						 row +=`</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ item.id).html(row); 

  
                

            $( ".modal-content" ).on( "click", "#simpan", (e) => {
		          let id = e.currentTarget.dataset.param_id;
		          const item = list.find(o => o.id === id);
		         
	              var data = $("#FormSubmit-"+ item.id).serializeArray();
	              $("#simpan").hide();
	              $("#load-simpan").show();
	              
			        var form = {
			        	'category':data[0].value,
			        	'description':data[1].value,
			        	'status':data[2].value,
			        };



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/kendala/'+ item.id,
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
			                            window.location.replace('/kendala');
			                        }
			                    });
			                   
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                $("#simpan").show();
			                $("#load-simpan").hide();
 
			                if(errors.messages.category)
			                {
			                     $('#category-alert-'+id).addClass('has-error');
			                     $('#category-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.category +'</strong>');
			                }else{
			                    $('#category-alert-'+id).removeClass('has-error');
			                    $('#category-messages-'+id).removeClass('help-block').html('');
			                }


			                 if(errors.messages.description)
			                {
			                     $('#description-alert-'+id).addClass('has-error');
			                     $('#description-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.description +'</strong>');
			                }else{
			                    $('#description-alert-'+id).removeClass('has-error');
			                    $('#description-messages-'+id).removeClass('help-block').html('');
			                }


			                 if(errors.status.messages)
			                {
			                     $('#status-alert-'+id).addClass('has-error');
			                     $('#status-messages-'+id).addClass('help-block').html('<strong>'+ errors.status.messages +'</strong>');
			                }else{
			                    $('#status-alert-'+id).removeClass('has-error');
			                    $('#status-messages-'+id).removeClass('help-block').html('');
			                }

			                
			            }
			          });
 
		        
	        });  
            
        });


        //list chat
         $( "#content" ).on( "click", "#Detail", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id === id);
            window.location.replace('/kendala/'+ item.slug); 

            
        });
    


        $( "#content" ).on( "click", "#Destroy", (e) => {
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
			        deleteItem(id);
			        
			        Swal.fire(
			          'Deleted!',
			          'Data berhasil dihapus.',
			          'success'
			        );
			      }
			    });

        }); 



       
        
    }

   

    function getlistforum(data,item){
       
       let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content pull-left full">`;

				       row +=`<div class="modal-header pull-left full">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Forum `+ item.category +`</h4>`;
				       row +=`</div>`;

				       row +=`<form  id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body pull-left full">`;

					         row +=`<div id="succes"></div>`;
                                
                             row +=`<div id="slimScrollDiv" style="height: 200px; overflow: auto;background: #fafafa;">`;

                            

                             
									
                             row +=`<div id="replayNew" ></div>`;

 							data.forEach(function(items, index) {
                                  
									row +=`<div id="list-${index}" class="form-group pull-left full border-list">`;		
										row +=`<div class="col-sm-2">`;
										row +=`<img class="chat-img" src="${items.photo}" alt="${items.username}" class="offline">`;	
	                                           
	                                    row +=`</div>`;	
										row +=`<div class="margin-top-7 col-sm-9">`;
                                               row +=`<input class="text-username" disabled type="text" value="${items.username}">`;
													row +=`<textarea disabled class="form-control textarea-fixed-replay text-message resize-hide">${items.messages}</textarea>`;
										row +=`</div>`;	
										if(items.deleted == false)
									    {		
	                                        row +=`<div class="margin-top-32 btn-delete-chat padding-none ">`;
	                                         row +=`<button  disabled type="button" class="btn btn-danger pull-right"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
	                                        row +=`</div>`;	
                                        }else{
                                        	row +=`<div  class="margin-top-32 btn-delete-chat padding-none ">`;
	                                         row +=`<button id="deleted" data-param_index="`+ index +`" data-param_id="`+ items.id +`" type="button" class="btn btn-danger pull-right"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
	                                        row +=`</div>`;
                                        }

									row +=`</div>`;
				           
                            });

                          
                           
                            row +=`</div>`; 



                            row +=`<div class="form-group has-feedback pull-left full" >`;
					              row +=`<label>Balas :</label>`;
					              row +=`<textarea id="replay" class="form-control textarea-fixed-replay" placeholder="Balas Pesan" name="messages"></textarea>`;
					              row +=`<span id="messages-messages"></span>`;
					        row +=`</div>`;



                             
                         

                             row +=`</div>`;        
                                  
                             
                            row +=`<div class="pull-left full modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="balas" disabled data-param_id="`+ item.id +`" type="button" class="btn btn-default">Kirim</button>`;
						            row +=`<button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button></div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormDetail-'+ item.id).html(row); 
             
            $('#replay').on('input', function() {
              $('#balas').removeClass('btn-default').addClass('btn-primary');	
		      var charCount = $(this).val().length;
		         if(charCount >0)
		         {
		         	$('#balas').prop("disabled", false);
		         	$('#balas').removeClass('btn-default').addClass('btn-primary');	
		         }else{
		         	$('#balas').prop("disabled", true);
		         	$('#balas').removeClass('btn-primary').addClass('btn-default');
		         } 
		        
		    });

            
	        $( ".modal-content" ).on( "click", "#deleted", (e) => {
		          let id = e.currentTarget.dataset.param_id; 
		          let index = e.currentTarget.dataset.param_index; 

                $.ajax({
				    url:  BASE_URL +`/api/kendala/delete-replay/`+ id,
				    method: 'DELETE',
				    success: function(response) {
				        
				         data.splice(index, 1);
		                  $('#list-'+index).remove();

		                    var al = '';
		                    al +=`<div class="alert alert-success alert-dismissible">`;
								al +=`<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>`;
								al +=`<i class="icon fa fa-check"></i>`;
								al +=`Sukses menghapus forum`;
							al +=`</div>`;
							$('#succes').append(al);

						    setTimeout(function() {
						      $('#succes').html('');
						    }, 3000); // 3000 milliseconds (3 seconds)	

				    },
				    error: function(error) {
				        console.error('Error deleting items:', error);
				    }
				});



		         		


             });
             
            $( ".modal-content" ).on( "click", "#balas", (e) => {
		          let id = e.currentTarget.dataset.param_id;
		          const item = list.find(o => o.id === id);

		          var data = $("#FormSubmit-"+ item.id).serializeArray();
	             
	              
			        var form = {
			        	'messages':data[0].value,
			        	'forum_id':item.id,
			        	'permasalahan':item.permasalahan,
			        	'sender':item.username,
			        	'status':'sent',
			        };



					$.ajax({
			            type:"POST",
			            url: BASE_URL+'/api/masalah/comment',
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{



			               $('#replay').val('');

                            var row = '';
                            row +=`<div class="form-group pull-left full border-list">`;
			            	row +=`<div class="col-sm-2">`;
							row +=`<img class="chat-img" src="`+respons.data.photo+`" alt="`+respons.data.username+`" class="offline">`;	
	                                           
                            row +=`</div>`;	
							row +=`<div class="margin-top-7 col-sm-10">`;
                                   row +=`<input class="text-username" disabled type="text" value="`+respons.data.username+`">`;
										row +=`<textarea disabled class="form-control textarea-fixed-replay text-message resize-hide">`+respons.data.messages+`</textarea>`;
							row +=`</div>`;		
			                row +=`</div>`;	   
                          $('#replayNew').append(row);
                          
                          var al = '';
                           al +=`<div class="alert alert-success alert-dismissible">`;
								al +=`<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>`;
								al +=`<i class="icon fa fa-check"></i>`;
								al +=`Sukses membalas forum`;
							al +=`</div>`;
							$('#succes').append(al);

							$('#balas').prop("disabled", true);
		         	        $('#balas').removeClass('btn-primary').addClass('btn-default');

							setTimeout(function() {
						      $('#succes').html('');
						    }, 3000); // 3000 milliseconds (3 seconds)
			                   
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                

			                

			                
			            }
			          });
                
		    });      




    }

     function resultTotal(total){
       $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
    }

    // Function to delete items
    function deleteItems(ids) {
        // Send the selected IDs for deletion using AJAX
       
        $.ajax({
            url:  BASE_URL +`/api/kendala/selected`,
            method: 'POST',
            data: { data: ids },
            success: function(response) {
                // Handle success (e.g., remove deleted items from the list)
                fetchData(page);
                $('#delete-selected').prop("disabled", true);
            },
            error: function(error) {
                console.error('Error deleting items:', error);
            }
        });
    }


    function deleteItem(id){

		$.ajax({
		    url:  BASE_URL +`/api/kendala/`+ id,
		    method: 'DELETE',
		    success: function(response) {
		        // Handle success (e.g., remove deleted items from the list)
		        fetchData(page);
		    },
		    error: function(error) {
		        console.error('Error deleting items:', error);
		    }
		});

    }

    

    function listOptions(data){
           
       data.forEach(function(item, index) 
       {
           if(item.action =='add')
           {
               if(item.checked ==true)
               {
                   $('#ShowAdd').show();
               }else{
                  $('#ShowAdd').hide();
               }    
           }

          



            if(item.action =='export')
           {
               if(item.checked ==true)
               {
                   $('#ShowExport').show();
               }else{
                  $('#ShowExport').hide();
               }    
           }     

           

       

            if(item.action =='status')
           {
               if(item.checked ==true)
               {
                   $('#ShowStatus').show();
               }else{
                  $('#ShowStatus').hide();
               }    
           }    

            if(item.action =='dibuat')
           {
               if(item.checked ==true)
               {
                   $('#ShowCreated').show();
               }else{
                  $('#ShowCreated').hide();
               }    
           }    

            if(item.action =='checklist')
            {
               if(item.checked ==true)
               {
                   $('#ShowChecklist').show();
                   $('#ShowChecklistAll').show();
               }else{
                   $('#ShowChecklist').hide();
                   $('#ShowChecklistAll').hide();
               } 
            }

             if(item.action =='edit' && item.action =='delete')
            {
               if(item.checked ==false)
               {
                   $('#ShowAction').hide();
               }else{
                   $('#ShowAction').show();
               }  
            } 
  

           

       });
    }

    function exportData(data){
          
          const content = $('#exportView');
        
         content.empty();
         if(data.length>0)
         {
            // Populate content with new data
            data.forEach(function(item, index) {
                let row = ``;
                 row +=`<tr>`;

                   row +=`<td class="padding-text-table">${item.number}</td>`;
                   row +=`<td class="padding-text-table">${item.category}</td>`;
                   row +=`<td class="padding-text-table">${item.description}</td>`;
                   row +=`<td class="padding-text-table">${item.created_at_format}</td>`;
                 row +=`</tr>`;

               content.append(row);
             });     

         }  

         ExportExel();      
         
    }

     function ExportExel()
    {
        var dt = new Date();
        var time =  dt.getDate() + "-"
                + (dt.getMonth()+1)  + "-" 
                + dt.getFullYear();

       var table = document.getElementById("myTable");
       var ws = XLSX.utils.table_to_sheet(table);
       var wb = XLSX.utils.book_new();
       XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
       XLSX.writeFile(wb, "Repot-data-kriteria-kendala-"+ time +".xlsx");

         

    }



    // Function to update pagination controls
    function updatePagination(currentPage, totalPages) {
        const pagination = $('#pagination');

        // Clear previous pagination
        pagination.empty();

        // Calculate start and end page for visible links
        let startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
        let endPage = Math.min(totalPages, startPage + visiblePages - 1);

        //Create "First Page" button
        if (currentPage > 1) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="1">«</button></li>`);

        }else{
        	 pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable">«</button></li>`);
        }

         // Create "Back" button
        if (currentPage > 1) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage - 1}">‹</button></li>`);
        }else{
        	//back disable
        	pagination.append(`<li class="pagination-item "><button class="pagination-link pagination-disable" >‹</button></li>`);
        }

        // Create pagination links
        for (let i = startPage; i <= endPage; i++) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link${i === currentPage ? ' pagination-link--active' : ''}" data-page="${i}">${i}</button></li>`);
        }

          // Create "Next" button
        if (currentPage < totalPages) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage + 1}">›</button></li>`);
        }else{
        	pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >›</button></li>`);
        }

         // Create "Last Page" button
        if (currentPage < totalPages) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${totalPages}">»</button></li>`);

        }else{
        	  pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >»</button></li>`);
        }



        // Add click event to pagination links
        pagination.find('.page-link').on('click', function() {
            currentPage = parseInt($(this).data('page'));
            fetchData(currentPage);
        });
    }

    // Initial data fetch
    fetchData(currentPage);
});
     </script>

@stop

