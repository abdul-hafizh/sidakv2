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
				<button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
					 Hapus
				</button>
			</div>

			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button"  id="refresh" class="btn btn-default border-radius-10">
					 Refresh
				</button>
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
 

 $(document).ready(function() {

 	

    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];


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

     // Delete selected button
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
        // Send selected IDs for deletion (e.g., via AJAX)
        deleteItems(selectedIds);
    });

    // Individual item checkboxes
    $('.item-checkbox').on('change', function() {
        const allChecked = $('.item-checkbox:checked').length === $('.item-checkbox').length;
        $('.select-all').prop('checked', allChecked);
    });

   


   



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

    // Function to fetch data from the API
    function fetchData(page) {
    	   const content = $('#content');
           content.empty();
    	  
    	 	let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);

        $.ajax({
            url: BASE_URL+ `/api/user?page=${page}&per_page=${itemsPerPage}`,
            method: 'GET',
            success: function(response) {
            	list = response.data;
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
        data.forEach(function(item, index) {
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

                row +=`<button id="Edit" data-param_id="`+ index +`" data-toggle="modal" data-target="#modal-edit-${item.id}" type="button" class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;

                row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
                row +=`<div id="FormEdit-${item.id}"></div>`;
                row +=`</div>`;

       

                row +=`<button id="Destroy" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;

                row +=`</div>`;
                row +=`</td>`;
              row +=`</tr>`; 

            content.append(row);




        });

        	

        $('.item-checkbox').on('click', function() {
         const checkedCount = $('.item-checkbox:checked').length;
         if(checkedCount ==true)
         {
           $('#delete-selected').prop("disabled", false);
         }else{
           $('#delete-selected').prop("disabled", true);
         } 	
   		});


        

 		$( "#content" ).on( "click", "#Edit", (e) => {
             
            let index = e.currentTarget.dataset.param_id;
            const item = list[index];

		    // Event handler when an item is selected
		    $('.select-edit').on('select-edit:select', function(e) {
		        var selectedOption = e.params.data;
		        $('#daerah_id').val(selectedOption.id);
		    });
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit User</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                row +=`<div class="form-group has-feedback" >`;
				                  row +=`<label>Username</label>`;
				                  row +=`<input type="text" class="form-control" name="username" placeholder="Username" value="`+ item.username +`" disabled>`;
				                row +=`</div>`;

				                 row +=`<div id="name-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Name</label>`;

				                  row +=`<input type="text" class="form-control" name="name" placeholder="Name" value="`+ item.name +`">
				                  <span id="name-messages-`+ item.id +`"></span>`;

				                 row +=`</div>`;



				                 row +=`<div id="email-alert-`+ item.id +`" class="form-group has-feedback">`;

				                   row +=`<label>Email</label>`;

				                   row +=`<input type="email" class="form-control" name="email" placeholder="email" value="`+ item.email +`">`;

				                   row +=`<span id="email-messages-`+ item.id +`"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="phone-alert-`+ item.id +`" class="form-group has-feedback">`;

				                   row +=`<label>Phone</label>`;

				                   row +=`<input type="text" class="form-control" name="phone" placeholder="phone" value="`+ item.phone +`">`;

				                   row +=`<span id="phone-messages-`+ item.id +`"></span>`;

				                 row +=`</div>`;



				                 row +=`<div id="nip-alert-`+ item.id +`" class="form-group has-feedback">`;

				                   row +=`<label>NIP</label>`;

				                   row +=`<input type="text" class="form-control" name="nip" placeholder="NIP" value="`+ item.nip +`">`;

				                   row +=`<span id="nip-messages-`+ item.id +`"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="leader-name-alert-`+ item.id +`" class="form-group has-feedback">`;

				                   row +=`<label>Penanggung Jawab</label>`;

				                   row +=`<input type="text" class="form-control" name="leader_name" placeholder="Penanggung Jawab " value="`+ item.leader_name +`">`;

				                   row +=`<span id="leader-name-messages-`+ item.id +`"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="leader-nip-alert-`+ item.id +`" class="form-group has-feedback">`;

				                   row +=`<label>NIP Penanggung Jawab</label>`;

				                   row +=`<input type="text" class="form-control" name="leader_nip" placeholder="NIP Penanggung Jawab" value="`+ item.leader_nip +`">`;
				                    row +=`<span id="leader-nip-messages-`+ item.id +`"></span>`;

				                 row +=`</div>`;


				                 row +=`<div id="daerah-alert-`+ item.id +`" class="form-group has-feedback">`;

				                     row +=`<label>Daerah </label>`;

				                   row +=`<select id="daerah_id-`+ item.id +`" class="select-edit form-control"  name="daerah_id" ></select>`;

				                   row +=`<span id="daerah-messages-`+ item.id +`"></span>`;
				                 row +=`</div>`;


					        row +=`</div>`;

                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>`;

						          row +=`<button id="update" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
						            row +=`<button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
     						</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`;


          

            $('#FormEdit-'+ item.id).html(row);
           
            $('.select-edit').select2({
		        data: [{ id: '', text: '' }],
		        placeholder: 'Pilih Daerah',
		        ajax: {
		            url: BASE_URL+'/api/select-daerah', // URL to your server-side endpoint
		            dataType: 'json',
		            //delay: 250, // Delay before sending the request (milliseconds)
		            processResults: function(data) {
		                
		                // Transform the data to match Select2's expected format
		                return {
		                    results: data.map(function(item) {
		                        return { id: item.value, text: item.text };
		                    })
		                };
		            },
		            cache: true // Cache the results to improve performance
		        },
		        minimumInputLength: 1 // Minimum number of characters required for a search
		    });	

            $('#daerah_id-'+item.id).append(new Option(item.daerah_name, item.daerah_id, true, true)); 

            $( ".modal-content" ).on( "click", "#update", (e) => {
		          let id = e.currentTarget.dataset.param_id;
	              var data = $("#FormSubmit-"+ id).serializeArray();
	              $("#update").hide();
	              $("#load-simpan").show();
	              
		          var form = {
		              
		              'name':data[0].value,
		              'email':data[1].value,
		              'phone':data[2].value,
		              'nip':data[3].value,
		              'leader_name':data[4].value,
		              'leader_nip':data[5].value,
		              'daerah_id':data[6].value,
		            
		          };



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/user/'+ id,
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
			                            window.location.replace('/user');
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

			                 if(errors.messages.email)
			                {
			                     $('#email-alert-'+id).addClass('has-error');
			                     $('#email-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.email +'</strong>');
			                }else{
			                    $('#email-alert-'+id).removeClass('has-error');
			                    $('#email-messages-'+id).removeClass('help-block').html('');
			                }  

			                if(errors.messages.phone)
			                {
			                     $('#phone-alert-'+id).addClass('has-error');
			                     $('#phone-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.phone +'</strong>');
			                }else{
			                    $('#phone-alert-'+id).removeClass('has-error');
			                    $('#phone-messages-'+id).removeClass('help-block').html('');
			                }

			                if(errors.messages.nip)
			                {
			                     $('#nip-alert-'+id).addClass('has-error');
			                     $('#nip-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.nip +'</strong>');
			                }else{
			                    $('#nip-alert-'+id).removeClass('has-error');
			                    $('#nip-messages-'+id).removeClass('help-block').html('');
			                }  

			                if(errors.messages.daerah_id)
			                {
			                     $('#daerah-alert-'+id).addClass('has-error');
			                     $('#daerah-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.daerah_id +'</strong>');
			                }else{
			                    $('#daerah-alert-'+id).removeClass('has-error');
			                    $('#daerah-messages-'+id).removeClass('help-block').html('');
			                }  

			                if(errors.messages.leader_name)
			                {
			                     $('#leader-name-alert-'+id).addClass('has-error');
			                     $('#leader-name-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.leader_name +'</strong>');
			                }else{
			                    $('#leader-name-alert-'+id).removeClass('has-error');
			                    $('#leader-name-messages-'+id).removeClass('help-block').html('');
			                } 

			                 if(errors.messages.leader_nip)
			                {
			                     $('#leader-nip-alert-'+id).addClass('has-error');
			                     $('#leader-nip-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.leader_nip +'</strong>');
			                }else{
			                    $('#leader-nip-alert-'+id).removeClass('has-error');
			                    $('#leader-nip-messages-'+id).removeClass('help-block').html('');
			                }  

			                
			            }
			          });
 
		        
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
             const content = $('#content');
             content.empty();
            fetchData(currentPage);
        });
    }

    // Initial data fetch
    fetchData(currentPage);
});
     </script>

@stop

