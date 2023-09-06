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
				<button type="button" id="printButton"  class="btn btn-info border-radius-10">
					 Print
				</button>
			</div>

			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button"  id="refresh" class="btn btn-success border-radius-10">
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
							<th><div class="split-table"></div><span class="span-title"> Nama </span></th>
							<th><div class="split-table"></div><span class="span-title"> Semester </span></th>
							<th><div class="split-table"></div><span class="span-title"> Tahun </span></th>
							<th><div class="split-table"></div><span class="span-title"> Tanggal Mulai </span></th>
							<th><div class="split-table"></div><span class="span-title"> Tanggal Berahir </span></th>
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
     @include('template/sidakv2/periode.add')
     @include('template/sidakv2/periode.print', $data)
<script type="text/javascript">

 $(document).ready(function() {

 	
    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    const total = 0;

     $("#printButton").click(function() {
	    PrintData();
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
                  	var url = BASE_URL + `/api/periode/search?page=${page}&per_page=${value}`;
                  	var method = 'POST';
                  }else{
                    var url = BASE_URL + `/api/periode?page=${page}&per_page=${value}`;
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
	            url: BASE_URL + `/api/periode/search?page=${page}&per_page=${itemsPerPage}`,
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
            url: BASE_URL+ `/api/periode?page=${page}&per_page=${itemsPerPage}`,
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
             if(item.deleted == true)
             {
             	 row +=`<td><input  class="item-checkbox"  data-id="${item.id}"  type="checkbox"></td></td>`;
             }else{
             	 row +=`<td><input  disabled    type="checkbox"></td></td>`;
             } 	
              
               row +=`<td>${item.number}</td>`;
               row +=`<td>${item.name}</td>`;
               row +=`<td>${item.semester}</td>`;
               row +=`<td>${item.year}</td>`;
               row +=`<td>${item.startdate_convert}</td>`;
               row +=`<td>${item.enddate_convert}</td>`;
               row +=`<td>${item.status.status_convert}</td>`;
               row +=`<td>`; 
                row +=`<div class="btn-group">`;

                row +=`<button  id="Edit"  data-param_id="${item.id}" data-toggle="modal" data-target="#modal-edit-${item.id}" data-toggle="tooltip" data-placement="top" title="Edit Data" type="button" class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;

               
                row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
                row +=`<div id="FormEdit-${item.id}"></div>`;
                row +=`</div>`;


                if(item.deleted == true)
                {   

                	row +=`<button  id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;

	            }else{
                   row +=`<button disabled  data-placement="top"  data-toggle="tooltip" title="Hapus Data"  type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;
	            }

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
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id === id); 
           
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Periode</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
				                 row +=`<div id="name-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Nama</label>`;
				                  row +=`<input type="text" class="form-control" name="name" placeholder="Nama" value="`+ item.name +`">
				                  <span id="name-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;

				                  row +=`<div id="semester-alert-`+ item.id +`" class="form-group has-feedback" >`;
					              row +=`<label>Semester</label>`;
					              row +=`<select id="semester-`+ item.id +`" class="selectpicker form-control" name="semester">`;
					                  row +=`<option value="">Pilih Semester</option>`;
                                      row +=`<option value="01" >Semester 01</option>`;
                                      row +=`<option value="02">Semester 02</option>`;
					                     
					              row +=`</select>`;
					              row +=`<span id="semester-messages-`+ item.id +`"></span>`;
					            row +=`</div>`;

					            row +=`<div id="year-alert-`+ item.id +`" class="form-group has-feedback" >`;
					              row +=`<label>Tahun</label>`;
					              row +=`<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="year" placeholder="Year" value="`+ item.year +`">`;
					              row +=`<span id="year-messages-`+ item.id +`"></span>`;
					            row +=`</div>`;

                                 row +=`<div id="startdate-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Tanggal Mulai</label>`;
				                  row +=`<input type="date" class="form-control" name="startdate" placeholder="Tanggal Mulai" value="`+ item.startdate +`">
				                  <span id="startdate-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;


				                    row +=`<div id="enddate-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Tanggal Berahir</label>`;
				                  row +=`<input type="date" class="form-control" name="enddate" placeholder="Tanggal Berahir" value="`+ item.enddate +`">
				                  <span id="enddate-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;


				                 


			                    row +=`<div class="radio">`;
				                    row +=`<label>`;
				                    if(item.status.status_db =='Y')
				                    {
				                        row +=`<input  type="radio" name="status" id="status`+ item.id +`" value="Y" checked>`;	
				                    }else{
				                    	row +=`<input  type="radio" name="status" id="status`+ item.id +`" value="Y" >`;
				                    } 	
				                 
				                      row +=`Publish`;
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

				                     
				                     row +=`Draft`;
				                    row +=`</label>`;
				                row +=`</div>`;

                            row +=`</div>`;


                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update" data-param_id="`+ item.id +`" type="button" class="btn btn-primary" >Update</button>`;
						            row +=`<button id="load-simpan" type="button" disabled class="btn btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
     						</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ item.id).html(row); 

            // Set a specific option as selected
               let select = $('#semester-'+ item.id);
		       var selectedValue = item.semester;
		       select.val(selectedValue);
		       // Refresh the SelectPicker
		       select.selectpicker('refresh');
                

            $( ".modal-content" ).on( "click", "#update", (e) => {
		          let id = e.currentTarget.dataset.param_id;
	              var data = $("#FormSubmit-"+ id).serializeArray();
	              $("#update").hide();
	              $("#load-simpan").show();
	              
		          var form = {
		          	     'name':data[0].value,
		          	     'semester':data[1].value,
		          	     'year':data[2].value,
		          	     'startdate':data[3].value,
		          	     'enddate':data[4].value,
		          	     'status':data[5].value
		          	    };



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/periode/'+ id,
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
			                            window.location.replace('/periode');
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

			                if(errors.messages.semester)
			                {
			                     $('#semester-alert-'+id).addClass('has-error');
			                     $('#semester-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.semester +'</strong>');
			                }else{
			                    $('#semester-alert-'+id).removeClass('has-error');
			                    $('#semester-messages-'+id).removeClass('help-block').html('');
			                }

			                if(errors.messages.year)
			                {
			                     $('#year-alert-'+id).addClass('has-error');
			                     $('#year-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.year +'</strong>');
			                }else{
			                    $('#year-alert-'+id).removeClass('has-error');
			                    $('#year-messages-'+id).removeClass('help-block').html('');
			                }

			                if(errors.messages.startdate)
			                {
			                     $('#startdate-alert-'+id).addClass('has-error');
			                     $('#startdate-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.startdate +'</strong>');
			                }else{
			                    $('#startdate-alert-'+id).removeClass('has-error');
			                    $('#startdate-messages-'+id).removeClass('help-block').html('');
			                }

			                if(errors.messages.enddate)
			                {
			                     $('#enddate-alert-'+id).addClass('has-error');
			                     $('#enddate-messages-'+id).addClass('help-block').html('<strong>'+ errors.messages.enddate +'</strong>');
			                }else{
			                    $('#enddate-alert-'+id).removeClass('has-error');
			                    $('#enddate-messages-'+id).removeClass('help-block').html('');
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

     function resultTotal(total){
       $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
    }

    // Function to delete items
    function deleteItems(ids) {
        // Send the selected IDs for deletion using AJAX
       
        $.ajax({
            url:  BASE_URL +`/api/periode/selected`,
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
		    url:  BASE_URL +`/api/periode/`+ id,
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

     function PrintData()
    {
    	var dt = new Date();
       var time =  dt.getDate() + "-"
                + (dt.getMonth()+1)  + "-" 
                + dt.getFullYear();

	  var table = document.getElementById("myTable");
	  var ws = XLSX.utils.table_to_sheet(table);
	  var wb = XLSX.utils.book_new();
	  XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
	  XLSX.writeFile(wb, "Repot-data-periode-"+ time +".xlsx");

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

