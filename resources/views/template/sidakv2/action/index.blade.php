@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div  class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
        <div  class="pull-right width-25">
            <div class="input-group input-group-sm border-radius-20">
				<input type="text" id="search-input" placeholder="Cari ..." class="form-control height-35 border-radius-left">
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
			<div id="ShowChecklist" style="display:none;"  class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
					 Hapus
				</button>

			</div>

			 
			<div id="ShowExport" style="display:none;" class="pull-left padding-9-0 margin-left-button" >
                <button type="button" id="ExportButton"  class="btn btn-info border-radius-10">
                     Export
                </button>
            </div>

			<div id="ShowAdd"  class="pull-left padding-9-0">
                <button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
				 Tambah Data
				</button> 
		    </div>		
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
							<th id="ShowChecklistAll" style="display:none;"><input id="select-all" class="span-title" type="checkbox"></th>
							<th><div id="ShowChecklistAll" style="display:none;"  class="split-table"></div><span class="span-title">No</span></th>
							<th><div class="split-table"></div> <span class="span-title"> Nama </span></th>
							<th><div class="split-table"></div> <span class="span-title"> Status </span></th>
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
    @include('template/sidakv2/action.add')
    @include('template/sidakv2/action.export')

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
            url: BASE_URL+ `/api/action?page=${page}&per_page=all`,
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
                  	var url = BASE_URL + `/api/action/search?page=${page}&per_page=${value}`;
                  	var method = 'POST';
                  }else{
                    var url = BASE_URL + `/api/action?page=${page}&per_page=${value}`;
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

    //keyup search
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
	            url: BASE_URL + `/api/action/search?page=${page}&per_page=${itemsPerPage}`,
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

    //btn search
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
	            url: BASE_URL + `/api/action/search?page=${page}&per_page=${itemsPerPage}`,
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

    // Function to delete items
    function deleteItems(ids) {
        // Send the selected IDs for deletion using AJAX
       
        $.ajax({
            url:  BASE_URL +`/api/action/selected`,
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

    function resultTotal(total){
       $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
    }

    // Function to fetch data from the API
    function fetchData(page) {
    	 const content = $('#content');
           content.empty();
    	  
    	 	let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
        $.ajax({
            url: BASE_URL+ `/api/action?page=${page}&per_page=${itemsPerPage}`,
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
        const content = $('#content');
        const edited = options.find(o => o.action === 'edit');
        const deleted = options.find(o => o.action === 'delete');
        const checklist = options.find(o => o.action === 'checklist');
        // Clear previous data
        content.empty();
	    if(data.length>0)
	    { 
	        // Populate content with new data
	        data.forEach(function(item, index) {
	           	let row = ``;
	             row +=`<tr>`;
	             if(item.deleted ==true)
	             {
	             	if(checklist.checked == true)
                    {
	                  row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
	                }  	
	             }else{
	             	if(checklist.checked == true)
                    {
	             	   row +=`<td><input disabled type="checkbox"></td></td>`;
	             	}   
	             }
	               
	               row +=`<td class="padding-text-table">${item.number}</td>`;
	               row +=`<td class="padding-text-table">${item.name}</td>`;
	               row +=`<td class="padding-text-table">${item.status}</td>`;
	               row +=`<td>`; 
	                row +=`<div class="btn-group">`;

	              if(item.deleted ==true)
	              {  
	                    if(edited.checked == true)
	                    {
		                  row +=`<button id="ShowEdit" data-param_id="`+ item.id +`" data-toggle="modal" data-target="#modal-edit-${item.id}"  data-toggle="tooltip" data-placement="top" title="Edit Data"  type="button" class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;
		                }  
	                }else{

	                   if(edited.checked == true)
	                   {
	                    	
	                      row +=`<button disabled data-toggle="tooltip" data-placement="top" title="Edit Data"  type="button" class="btn btn-default"><i class="fa fa-pencil" ></i></button>`;
	                    }

	                }
	               
	                row +=`<div id="modal-edit-${item.id}" class="modal fade" action="dialog">`;
	                row +=`<div id="FormEdit-${item.id}"></div>`;
	                row +=`</div>`;


	                if(item.deleted ==true)
	                {
                       if(deleted.checked == true)
	                   {
	                       row +=`<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data"  data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;
	                   }    

	                 }else{

	                   if(deleted.checked == true)
	                   {	

	                      row +=`<button disabled  data-placement="top"  data-toggle="tooltip" title="Hapus Data"   type="button" class="btn btn-default"><i class="fa fa-trash" ></i></button>`; 
	                   }   

	                 } 	

	                row +=`</div>`;
	                row +=`</td>`;
	              row +=`</tr>`; 

	            content.append(row);
	        });

	    }else{
	         let row = ``;
	         row +=`<tr>`;
	         row +=`<td colspan="5" align="center">Data Kosong</td>`;
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


        $( "#content" ).on( "click", "#ShowEdit", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id === id); 
              
		  
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Aksi</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
				                 row +=`<div id="name-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Nama</label>`;

				                  row +=`<input type="text" class="form-control" name="name" placeholder="Nama" value="`+ item.name +`">`;
				                  row +=`<span id="name-messages-`+ item.id +`" class="span-messages"></span>`;

				                 row +=`</div>`;

				                  row +=`<div  id="status-alert" class="form-group has-feedback" >`;

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
                                    row +=`</label>`;

                                   row +=`<span id="status-messages" class="span-messages"></span>`;
					                row +=`</div>`;



                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
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
	              
		          var form = {'name':data[0].value,'status':data[1].value};



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/action/'+ id,
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
			                            window.location.replace('/action');
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
		    url:  BASE_URL +`/api/action/`+ id,
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

           if(item.action =='edit')
           {
           	   if(item.checked ==true)
           	   {
                   $('#ShowEdit').show();
           	   }else{
                  $('#ShowEdit').hide();
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
                   row +=`<td class="padding-text-table">${item.name}</td>`;
                   row +=`<td class="padding-text-table">${item.status}</td>`;
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
       XLSX.writeFile(wb, "Repot-data-forum-"+ time +".xlsx");

         

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

