@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
        <div class="pull-right width-25">
            <div class="input-group input-group-sm border-radius-20">
				<input type="text" id="search-input" placeholder="Cari ..." class="form-control height-35 border-radius-left">
				<span class="input-group-btn">
				<button id="Search" type="button" class="btn btn-primary btn-flat height-35 border-radius-right"><i class="fa fa-search"></i></button>
				</span>
			</div>
        </div> 	
    </div> 	

	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button" id="delete-selected" class="btn btn-danger border-radius-10">
					 Hapus
				</button>
	
				
				<!-- <button type="button" class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-search"></i> Search
				</button> -->
			</div>

			<div class="pull-left padding-9-0">
                <button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
				 Tambah Data
				</button> 
		    </div>		
		</div> 

		<div class="pull-right width-50">
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
							<th><input id="select-all" type="checkbox"></th>
							<th><span class="border-left-table">No</span>  </th>
							<th><span class="border-left-table"> Nama </span></th>
							 <th><span class="border-left-table"> Provinsi </span></th>
							<th> Options </th>
						</tr>
					</thead>

					<tbody id="content">
						
					
					 </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
     @include('template/sidakv2/regency.add')

<script type="text/javascript">

 $(document).ready(function() {

 	

    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;



     // "Select All" checkbox
    $('#select-all').on('change', function() {
        $('.item-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Delete selected button
    $('#delete-selected').on('click', function() {
        const selectedIds = [];
        $('.item-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });

        // Send selected IDs for deletion (e.g., via AJAX)
        deleteItems(selectedIds);
    });

    // Individual item checkboxes
    $('.item-checkbox').on('change', function() {
        const allChecked = $('.item-checkbox:checked').length === $('.item-checkbox').length;
        $('.select-all').prop('checked', allChecked);
    });

    // Function to delete items
    function deleteItems(ids) {
        // Send the selected IDs for deletion using AJAX
       
        $.ajax({
            url:  BASE_URL +`/api/regency/selected`,
            method: 'POST',
            data: { data: ids },
            success: function(response) {
                // Handle success (e.g., remove deleted items from the list)
                fetchData(page);
            },
            error: function(error) {
                console.error('Error deleting items:', error);
            }
        });
    }


   



    $('#Search').click( () => {
 		 let search = $('#search-input').val();
 		 
 		 if(search)
 		 { 	
	 		 
	         $.ajax({
	            url: BASE_URL + `/api/regency/search?page=${page}&per_page=${itemsPerPage}`,
	            data:{'search':search},
	            method: 'POST',
	            success: function(response) {
	                // Update content area with fetched data
	                updateContent(response.data);

	                // Update pagination controls
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
        $.ajax({
            url: BASE_URL+ `/api/regency?page=${page}&per_page=${itemsPerPage}`,
            method: 'GET',
            success: function(response) {
                // Update content area with fetched data
                updateContent(response.data);

                // Update pagination controls
                updatePagination(response.current_page, response.last_page);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Function to update the content area with data
    function updateContent(data) {
        const content = $('#content');

        // Clear previous data
        content.empty();

        // Populate content with new data
        data.forEach(item => {
           	let row = ``;
             row +=`<tr>`;
               row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
               row +=`<td>${item.number}</td>`;
               row +=`<td>${item.name}</td>`;
               row +=`<td>${item.province_name}</td>`;
               row +=`<td>`; 
                row +=`<div class="btn-group">`;

                row +=`<button id="Edit" data-param_id="${item.id}" data-toggle="modal" data-target="#modal-edit-${item.id}" type="button" class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;

                row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
                row +=``+ GetFormEdit(item) +``;
                row +=`</div>`;

       

                row +=`<button id="Destroy" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;

                row +=`</div>`;
                row +=`</td>`;
              row +=`</tr>`; 

            content.append(row);




        });



        $( ".modal-content" ).on( "click", "#update", (e) => {
		          let id = e.currentTarget.dataset.param_id;
	              var data = $("#FormSubmit-"+ id).serializeArray();
	             
		          var form = {
		              
		              'name':data[0].value,
		              'province_id':data[1].value
		              
		            
		            
		          };



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/regency/'+ id,
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
			                            window.location.replace('/regency');
			                        }
			                    });

			                   //
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                
			               

			                if(errors.messages.name)
			                {
			                     $('#name-alert').addClass('has-error');
			                     $('#name-messages').addClass('help-block').html('<strong>'+ errors.messages.name +'</strong>');
			                }else{
			                    $('#name-alert').removeClass('has-error');
			                    $('#name-messages').removeClass('help-block').html('');
			                }


			                if(errors.messages.province_id)
			                {
			                     $('#province-id-alert').addClass('has-error');
			                     $('#province-id-messages').addClass('help-block').html('<strong>'+ errors.messages.province_id +'</strong>');
			                }else{
			                    $('#province-id-alert').removeClass('has-error');
			                    $('#province-id-messages').removeClass('help-block').html('');
			                }


			                
			            }
			          });
 
		        
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


    function deleteItem(id){

		$.ajax({
		    url:  BASE_URL +`/api/role/`+ id,
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


    function GetFormEdit(item)
    {
	   	    	
                   
			



        	let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Provinsi</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                

				                 row +=`<div id="name-alert" class="form-group has-feedback" >`;

				                  row +=`<label>Name</label>`;

				                  row +=`<input type="text" class="form-control" name="name" placeholder="Name" value="`+ item.name +`">
				                  <span id="name-messages"></span>`;

				                 row +=`</div>`;



				                 row +=`<div id="status-alert" class="form-group has-feedback">`;

				                   row +=`<label>Status</label>`;
                                
                                if(item.status_ori === 'Y')
                                { 	
				                    row +=`<div class="radio">`;
					                    row +=`<label>`;
					                      row +=`<input  type="radio" name="status" id="status" value="Y"  checked>`;
					                      row +=`Aktif`;
					                    row +=`</label>`;
					                row +=`</div>`;
					                row +=`<div class="radio">`;
					                    row +=`<label>`;
					                      row +=`<input   type="radio" name="status" id="status" value="N">`;
					                     row +=`Non Aktif`;
					                    row +=`</label>`;
					                row +=`</div>`;

					            }else{

                                     row +=`<div class="radio">`;
					                    row +=`<label>`;
					                      row +=`<input  type="radio" name="status" id="status" value="Y"  >`;
					                      row +=`Aktif`;
					                    row +=`</label>`;
					                row +=`</div>`;
					                row +=`<div class="radio">`;
					                    row +=`<label>`;
					                      row +=`<input   type="radio" name="status" id="status" value="N" checked>`;
					                     row +=`Non Aktif`;
					                    row +=`</label>`;
					                row +=`</div>`;


					            }    

				                   row +=`<span id="status-messages"></span>`;

				                 row +=`</div>`;


					        row +=`</div>`;

                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>`;

						          row +=`<button id="update" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`;

        return row;

       
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

