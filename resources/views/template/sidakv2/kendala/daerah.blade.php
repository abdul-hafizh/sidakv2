@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
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
				<select id="row_page" class="selectpicker" data-style="btn-default" >
					<option value="10" selected>10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="all">All</option>
				</select>
            </div>
			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
					 Hapus
				</button>

			</div>

			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button"  id="refresh" class="btn btn-primary border-radius-10">
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
							<th><input id="select-all" class="span-title" type="checkbox"></th>
							<th><div class="split-table"></div><span class="span-title">No</span>  </th>
							<th><div class="split-table"></div><span class="span-title">Permasalahan</span></th>
							<th><div class="split-table"></div><span class="span-title"> Pesan Kendala</span></th>
							<th><div class="split-table"></div><span class="span-title"> Status </span></th> 
							<th><div class="split-table"></div><span class="span-title"> Aksi </span></th>
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
     @include('template/sidakv2/kendala.add')

<script type="text/javascript">

 $(document).ready(function() {

 	
    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    const total = 0;

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
                        updateContent(response.data);
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
	            url: BASE_URL + `/api/kendala/search?page=${page}&per_page=${itemsPerPage}`,
	            data:{'search':search},
	            method: 'POST',
	            success: function(response) {
	            	list = response.data;
                    resultTotal(response.total);
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
        if(data.length>0)
        { 	
	        // Populate content with new data
	        data.forEach(function(item, index) {
	           	let row = ``;
	             row +=`<tr>`;
	              if(item.showdelete == true)
	              { 
	                row +=`<td><input  class="item-checkbox" data-id="${item.id}"  type="checkbox"></td>`;
	              }else{
	              	row +=`<td><input disabled  type="checkbox"></td>`;
	              } 
	               row +=`<td>${item.number}</td>`;
	               row +=`<td>${item.permasalahan}</td>`;
	               row +=`<td>${item.messages}</td>`;
	               row +=`<td>${item.status}</td>`;
	               row +=`<td>`; 
	               row +=`<div class="btn-group">`;
	              
	              if(item.showedit == true){  

	                row +=`<button id="Edit"  data-param_id="`+ index +`" data-toggle="modal" data-target="#modal-edit-${item.id}" data-toggle="tooltip" data-placement="top" title="Edit Data" type="button" class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;
	              }else{
	              	 row +=`<button disabled  data-toggle="tooltip" data-placement="top" title="Edit Data" type="button" class="btn btn-danger"><i class="fa fa-pencil" ></i></button>`;
	              }
	               
	                row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
	                row +=`<div id="FormEdit-${item.id}"></div>`;
	                row +=`</div>`;


	              if(item.showdelete == true)
	              {  

	                row +=`<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;
	              }else{
	              	 row +=`<button  data-placement="top"  data-toggle="tooltip" title="Hapus Data"  type="button" disabled class="btn btn-danger"><i class="fa fa-trash" ></i></button>`;
	              }

	                row +=`</div>`;
	                row +=`</td>`;
	              row +=`</tr>`; 

	            content.append(row);

	        });
	    }else{
            
             	let row = ``;
	             row +=`<tr>`;
	             row +=`<td colspan="6" align="center">Data Kosong</td>`;
                 row +=`</tr>`;
                 content.append(row);

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
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Kendala</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
				                 row +=`<div id="permasalahan-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Permasalahan :</label>`;
				                  row +=`<input type="text" class="form-control" name="permasalahan" placeholder="Permasalahan" value="`+ item.permasalahan +`">
				                  <span id="permasalahan-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;

				                  
                                  
					             row +=`<div id="messages-alert-`+ item.id +`" class="form-group has-feedback" >`;
					              row +=`<label>Pesan :</label>`;
					              row +=`<textarea class="form-control textarea-fixed" placeholder="Pesan Kendala" name="messages">`+ item.messages +`</textarea>`;
					              row +=`<span id="messages-messages-`+ item.id +`"></span>`;
					            row +=`</div>`;
					



                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update" data-param_id="`+ item.id +`" type="button" class="btn btn-success" >Update </button>`;
						           row +=`<button id="kirim" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Kirim </button>`;
						            row +=`<button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
     						</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ item.id).html(row); 
                

            $( ".modal-content" ).on( "click", "#update", (e) => {
		          let id = e.currentTarget.dataset.param_id;
	              var data = $("#FormSubmit-"+ id).serializeArray();
	              $("#update").hide();
	              $("#load-simpan").show();
	              
		          var form = {
		              'permasalahan':data[0].value,
		              'messages':data[1].value,
		              'status':'draft',
		          };

		          SendData(form,id);
		        
	        }); 

	        $( ".modal-content" ).on( "click", "#kirim", (e) => {
		          let id = e.currentTarget.dataset.param_id;
	              var data = $("#FormSubmit-"+ id).serializeArray();
	              $("#kirim").hide();
	              $("#load-simpan").show();
	              
		          var form = {
		              'permasalahan':data[0].value,
		              'messages':data[1].value,
		              'status':'sent',
		          };

		          SendData(form,id);
		        
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

    function SendData(form,id){
          if(form.status =='sent')
	      {
	        var status = 'Terkirim';
	      }else{
	        var status = 'Diupdate';
	      }  
    	 $.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/kendala/'+ id,
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{
			                   Swal.fire({
			                        title: 'Sukses!',
			                        text: 'Berhasil '+ status,
			                        icon: 'success',
			                        confirmButtonText: 'OK'
			                        
			                    }).then((result) => {
			                        if (result.isConfirmed) {
			                            // User clicked "Yes, proceed!" button
			                            window.location.replace('/kendala');
			                        }
			                    });

			                   //
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                $("#update").show();
			                $("#kirim").show();
			                $("#load-simpan").hide();
                             
                             if(errors.messages.permasalahan)
			                {
			                     $('#permasalahan-alert-'+id).addClass('has-error');
			                     $('#permasalahan-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.permasalahan +'</strong>');
			                }else{
			                    $('#permasalahan-alert-'+id).removeClass('has-error');
			                    $('#permasalahan-messages-'+id).removeClass('help-block').html('');
			                }

			                if(errors.messages.messages)
			                {
			                     $('#messages-alert-'+id).addClass('has-error');
			                     $('#messages-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.messages +'</strong>');
			                }else{
			                    $('#messages-alert-'+id).removeClass('has-error');
			                    $('#messages-messages-'+id).removeClass('help-block').html('');
			                }

			               
 
			                
			            }
		 });

    }

    function resultTotal(total){
       $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
    }

    // Function to delete items
    function deleteItems(ids) {
        // Send the selected IDs for deletion using AJAX

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
			         deleteMultiple(ids)
			        
			        Swal.fire(
			          'Deleted!',
			          'Data berhasil dihapus.',
			          'success'
			        );
			      }
			    });
       
      
    }

    function deleteMultiple(ids){


    	  $.ajax({
            url:  BASE_URL +`/api/kendala/selected`,
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

