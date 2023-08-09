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
							<th><span class="border-left-table"> Username </span></th>
							<th><span class="border-left-table"> Nama </span></th>
							<th><span class="border-left-table"> Email </span></th>
							<th><span class="border-left-table"> Phone </span></th>
							<th><span class="border-left-table"> Status </span></th> 
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
     @include('template/sidakv2/user.add')

     <script type="text/javascript">
 //     	$(function() {
 //           $.ajax({
 //            type:"GET",
 //            url: BASE_URL+'/api/user',
 //            cache: false,
 //            dataType: "json",
 //            success: (respons) =>{
 //            	let row = '';
                  

 //                   for(let i = 0; i < respons.length; i++)
 //                   {
 //                   	   row +='<tr>'; 
 //                   	   row +='<td><input type="checkbox"></td>';
 //                       row +='<td>'+ respons[i].number +'</td>';
 //                       row +='<td>'+ respons[i].username +'</td>';
 //                       row +='<td>'+ respons[i].name +'</td>';
 //                       row +='<td>'+ respons[i].email +'</td>';
 //                       row +='<td>'+ respons[i].phone +'</td>';
 //                       row +='<td>'+ respons[i].status +'</td>';
 //                       row +='</tr>'; 
 //                   }	

                   
 //                  $("tbody").html(row);
 //            },
 //            error: (respons)=>{
 //                errors = respons.responseJSON;
                
               
 //            }
 //          });


	// 	$('#datatable').DataTable({
           
	// 		processing: true,
	// 		serverSide: true,
	// 		ajax: BASE_URL + '/api/user/',
	// 		dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
	// 			"<'row'<'col-sm-12'tr>>" +
	// 			"<'row'<'col-sm-5'i>>",

	// 		columns: [

	// 		    {
	// 				data: 'number',
	// 				name: 'number'
	// 			},
	// 			{
	// 				data: 'username',
	// 				name: 'username'
	// 			},
	// 			{
	// 				data: 'name',
	// 				name: 'name'
	// 			},
	// 			{
	// 				data: 'email',
	// 				name: 'email'
	// 			},
	// 			{
	// 				data: 'phone',
	// 				name: 'phone'
	// 			},
	// 			{
	// 				data: 'daerah_id',
	// 				name: 'daerah_id'
	// 			},
	// 		]
	// 	});
	// });







 $(document).ready(function() {

 	

    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;

     // "Select All" checkbox
    $('.select-all').on('change', function() {
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
            url:  BASE_URL +`/api/user/selected`,
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
	            url: BASE_URL + `/api/user/search?page=${page}&per_page=${itemsPerPage}`,
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
            url: BASE_URL+ `/api/user?page=${page}&per_page=${itemsPerPage}`,
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
               row +=`<td>${item.username}</td>`;
               row +=`<td>${item.name}</td>`;
               row +=`<td>${item.email}</td>`;
               row +=`<td>${item.phone}</td>`;
               row +=`<td>${item.status}</td>`;
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

        $( "#content" ).on( "click", "#Destroy", (e) => {
	        let id = e.currentTarget.dataset.param_id;

	         $.ajax({
	            url:  BASE_URL +`/api/user/`+ id,
	            method: 'DELETE',
	            success: function(response) {
	                // Handle success (e.g., remove deleted items from the list)
	                fetchData(page);
	            },
	            error: function(error) {
	                console.error('Error deleting items:', error);
	            }
	        });
	        
        }); 

        $( "#content" ).on( "click", "#Edit", (e) => {
	        let id = e.currentTarget.dataset.param_id;

	         
	        
        }); 

        
    }


    function GetFormEdit(item)
    {
        	let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit User</h4>`;
				       row +=`</div>`;

				       row +=`<form  method="post">`;
					        row +=`<div class="modal-body">`;
                               
                                row +=`<div class="form-group has-feedback" >`;
				                  row +=`<label>Username</label>`;
				                  row +=`<input type="text" class="form-control" name="username" placeholder="Username" value="`+ item.username +`">`;
				                row +=`</div>`;

				                 row +=`<div id="name-alert" class="form-group has-feedback" >`;

				                  row +=`<label>Name</label>`;

				                  row +=`<input type="text" class="form-control" name="name" placeholder="Name" value="`+ item.name +`">
				                  <span id="name-messages"></span>`;

				                 row +=`</div>`;



				                 row +=`<div id="email-alert" class="form-group has-feedback">`;

				                   row +=`<label>Email</label>`;

				                   row +=`<input type="email" class="form-control" name="email" placeholder="email" value="`+ item.email +`">`;

				                   row +=`<span id="email-messages"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="phone-alert" class="form-group has-feedback">`;

				                   row +=`<label>Phone</label>`;

				                   row +=`<input type="text" class="form-control" name="phone" placeholder="phone" value="`+ item.phone +`">`;

				                   row +=`<span id="phone-messages"></span>`;

				                 row +=`</div>`;



				                 row +=`<div id="nip-alert" class="form-group has-feedback">`;

				                   row +=`<label>NIP</label>`;

				                   row +=`<input type="text" class="form-control" name="nip" placeholder="NIP" value="`+ item.nip +`">`;

				                   row +=`<span id="nip-messages"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="leader-name-alert" class="form-group has-feedback">`;

				                   row +=`<label>Penanggung Jawab</label>`;

				                   row +=`<input type="text" class="form-control" name="leader_name" placeholder="Penanggung Jawab " value="`+ item.leader_name +`">`;

				                   row +=`<span id="leader-name-messages"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="leader-nip-alert" class="form-group has-feedback">`;

				                   row +=`<label>NIP Penanggung Jawab</label>`;

				                   row +=`<input type="text" class="form-control" name="leader_nip" placeholder="NIP Penanggung Jawab" value="`+ item.leader_nip +`">`;
				                    row +=`<span id="leader-nip-messages"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="daerah-alert" class="form-group has-feedback">`;

				                     row +=`<label>Daerah </label>`;

				                   row +=`<select id="daerah_id" class="select2 form-control"  name="daerah_id" ></select>`;

				                   row +=`<span id="daerah-messages"></span>`;
				                 row +=`</div>`;

				                 row +=`<div id="password-alert" class="form-group has-feedback" >`;
				                    row +=`<label>Password </label>`;
				                     row +=`<input type="password" class="form-control" name="password" placeholder="Password" value="`+ item.password +`" >`;
				                     row +=`<span id="password-messages"></span>`;

				                   
				                 row +=`</div>`;

				                 row +=`<div id="password-confirmation-alert" class="form-group has-feedback">`;
				                   row +=`<label>Konfirmasi Password </label>`;
				                 row +=`<input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi password" value="`+ item.password_confirmation +`">`;
				                 row +=`<span id="password-confirmation-messages"></span>`;
				                 row +=`</div>`;


					        row +=`</div>`;

                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>`;
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

