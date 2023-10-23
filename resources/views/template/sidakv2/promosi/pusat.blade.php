@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div class="row margin-top-bottom-20">

    	    <div class="col-sm-2" style="margin-bottom: 9px;">
    	    	 <div id="selectPeriode" class="form-group margin-none"></div>
    	    </div>
            <div class="col-sm-4" style="margin-bottom: 9px;">
                <select id="daerah_id"  data-live-search="true" class="selectpicker" data-style="btn-default" title="Pilih Provinsi"></select>
            </div>

             <div class="col-sm-2 " style="margin-bottom: 9px;">
                <select id="status"  class="selectpicker" data-style="btn-default" title="Pilih Status">
                	<option value="req_edit">Request Edit</option>
                	<option value="approved">Approved</option>
                </select>
            </div>    

            <div class="col-sm-2" style="margin-bottom: 9px;">
                <input type="text" id="search-input" class="form-control border-radius-20" placeholder="Pencarian">
            </div>  

           <div class="col-sm-2" style="margin-bottom: 9px;">
                <div class="btn-group">
                    <button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
                    <button id="refresh" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
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
			<div id="ShowChecklist" style="display:none;" class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
					 Hapus
				</button>

			</div>

			<div  class="pull-left padding-9-0 margin-left-button">
				<button type="button" id="ExportButton"  class="btn btn-info border-radius-10">
					 Export
				</button>
			</div>

			<div id="ShowApproval" style="display:none;" class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled id="approve-selected" class="btn btn-danger border-radius-10">
					 Approval
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
							<th id="ShowChecklistAll" style="display:none;" ><input id="select-all" class="span-title" type="checkbox"></th>
							<th><div id="ShowChecklistAll" style="display:none;"  class="split-table"></div><span class="span-title">No</span>  </th>
							<th><div class="split-table"></div><span class="span-title"> Nama Daerah </span></th>
							
							<th><div class="split-table"></div><span class="span-title"> Pra Produksi </span></th>
							<th><div class="split-table"></div><span class="span-title"> Produksi </span></th>
							<th><div class="split-table"></div><span class="span-title"> Pasca Produksi </span></th>
							<th><div class="split-table"></div><span class="span-title"> Total Budget </span></th>

							<th><div class="split-table"></div><span class="span-title"> Status </span></th>
							<th><div class="split-table"></div><span class="span-title"> Request Edit </span></th>
							<th ><div class="split-table"></div><span class="span-title"> Aksi </span></th> 
							
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
   
     @include('template/sidakv2/promosi.export')
<script type="text/javascript">

 $(document).ready(function() {

 	
    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    const total = 0;
    var year = new Date().getFullYear();
    var search = '';
     var status = '';

	$('#periode_id').on('change', function() {
		var index = $(this).val();
		let find = periode.find(o => o.value === index);
		year = find.value;
        fetchData(page,find.value);
      
	});

     $("#ExportButton").click(function() {
	     $.ajax({
            url: BASE_URL+ `/api/promosi?page=${page}&per_page=all&periode_id=${year}`,
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
                  search = $('#search-input').val();
                  if(search !='')
                  {
                  	var url = BASE_URL + `/api/promosi/search?page=${page}&per_page=${value}&periode_id=${periode_id}`;
                  	var method = 'POST';
                  }else{
                    var url = BASE_URL + `/api/promosi?page=${page}&per_page=${value}&periode_id=${year}`;
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
         	$('#approve-selected').prop("disabled", false);
         }else{
         	$('#delete-selected').prop("disabled", true);
            $('#approve-selected').prop("disabled", true);	
         } 

    });



     // Refresh selected button
    $('#refresh').on('click', function() {
    	
        fetchData(page,year);
  
        $('#search-input').val('');
    });

    // $('#daerah_id').on('change', function() {
    //    var value = $(this).val();         
    //         if(value)
    //         {   
    //         	 var per_page = $('#row_page').val();
    //              const content = $('#content');
    //              content.empty();
    //              let row = ``;
    //              row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
    //               content.append(row);
    //               daerah_id = $('#daerah_id').val();
    //               periode_id = $('#periode_id').val();


    //               if(daerah_id !='')
    //               {
    //               	var url = BASE_URL + `/api/promosi/search?page=${page}&per_page=${per_page}&periode_id=${periode_id}`;
    //               	var method = 'POST';
    //               }	

    //             $.ajax({
    //                 url: url,
    //                 method: method,
    //                 data:{'search':search,'daerah_id':daerah_id},
    //                 success: function(response) {
    //                 	list = response.data;
    //                     resultTotal(response.total);
    //                     listOptions(response.options);
    //                     updateContent(response.data,response.options);
    //                     updatePagination(response.current_page, response.last_page);
    //                 },
    //                 error: function(error) {
    //                     console.error('Error fetching data:', error);
    //                 }
    //             });
    //         }


    // }); 

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

    // Approve selected button
    $('#approve-selected').on('click', function() {
        const selectedIds = [];
        $('.item-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });

         Swal.fire({
		      title: 'Apakah anda yakin Approved?',
		    
		      icon: 'warning',
		      showCancelButton: true,
		      confirmButtonColor: '#d33',
		      cancelButtonColor: '#3085d6',
		      confirmButtonText: 'Ya'
		    }).then((result) => {
		      if (result.isConfirmed) {
		        // Perform the delete action here, e.g., using an AJAX request
		        // Send selected IDs for deletion (e.g., via AJAX)
   				 ApprovedItems(selectedIds);
		        
		        Swal.fire(
		          'Approved!',
		          'Data berhasil diapprove.',
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
      
    // keyup search  
    // $('#search-input').keyup( () => {
 		 // search = $('#search-input').val();
 		 //  periode_id = $('#periode_id').val();
 		 // if(search)
 		 // { 	
	 		//  const content = $('#content');
    //     	 content.empty();
    // 	 	 let row = ``;
    //          row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
    //           content.append(row);
	   //       $.ajax({
	   //          url: BASE_URL + `/api/promosi/search?page=${page}&per_page=${itemsPerPage}&periode_id=${periode_id}`,
	   //          data:{'search':search},
	   //          method: 'POST',
	   //          success: function(response) {
	   //          	list = response.data;
    //                 resultTotal(response.total);
	   //              listOptions(response.options);
    //                 updateContent(response.data,response.options);
	   //              updatePagination(response.current_page, response.last_page);
	   //          },
	   //          error: function(error) {
	   //              console.error('Error fetching data:', error);
	   //          }
	   //      });
	   //   }    
    // });

   

    //btn search 
    $('#Search').click( () => {
 		 search = $('#search-input').val();
 		 periode_id = $('#periode_id').val();
 		 daerah_id = $('#daerah_id').val();
 		 status = $('#status').val();
 		 // if(search)
 		 // { 	
	 		 const content = $('#content');
        	 content.empty();
    	 	 let row = ``;
             row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
	         $.ajax({
	            url: BASE_URL + `/api/promosi/search?page=${page}&per_page=${itemsPerPage}&periode_id=${periode_id}`,
	            data:{'search':search,'daerah_id':daerah_id,'status':status},
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
	     //}    
    });


    function getperiode(periode_id){
      
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=GET&action=promosi',
                    success: function(data) {
                         selectedPeriode(data.result,periode_id)
                         year = periode_id;
                         periode = data.result; 
                    },
                    error: function( error) {}
               });

              
    }

    function getdaerah(){

    	$.ajax({
        url: BASE_URL +'/api/select-province',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate SelectPicker options using received data
            $.each(data, function(index, option) {
                $('#daerah_id').append($('<option>', {
                  value: option.value,
                  text: option.text
                }));
            });

            // Refresh the SelectPicker to apply the new options
            $('#daerah_id').selectpicker('refresh');
	        },
	        error: function(error) {
	            console.error(error);
	        }
	    });

    }

    function selectedPeriode(data,periode_id){


            
                $('#selectPeriode').html('<select id="periode_id"  class="selectpicker"  ></select>');
		        var select =  $('#periode_id');
		        $.each(data, function(index, option) {
		            select.append($('<option>', {
		              value: option.value,
		              text: option.text
		            }));
		        });


		        if(periode_id ==0)
                {
                 	 select.prop('disabled', true);
                 	
                }else{
                 	select.val(periode_id);
                 	select.prop('disabled', false);
                } 	
		       select.selectpicker('refresh');
                
                

    }



    // Function to fetch data from the API
    function fetchData(page,periode_id) {
    	  
		const content = $('#content');
		content.empty();

		let row = ``;
		row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
		content.append(row);

        $.ajax({
            url: BASE_URL+ `/api/promosi?page=${page}&per_page=${itemsPerPage}&periode_id=${periode_id}`,
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
        
   
        // Clear previous data
        content.empty();
    if(data.length>0)
    {
        // Populate content with new data
        data.forEach(function(item, index) {
           	let row = ``;
             row +=`<tr>`;
             
               options.forEach(function(opt, arr) 
              {
                 if(opt.action == 'delete')
                 {
                    if(opt.checked == true)
                    {
                        row +=ChecklistTable(item,'delete');
                    }
                 }  

                 if(opt.action == 'approval')
                 {
                    if(opt.checked == true)
                    {
                        row +=ChecklistTable(item,'approve');
                    }
                 }        
              }); 

               row +=`<td>${item.number}</td>`;
               row +=`<td>${item.daerah_name}</td>`;
              
               row +=`<td align="right">${item.total_pra_produksi}</td>`;
               row +=`<td align="right">${item.total_produksi}</td>`;
               row +=`<td align="right">${item.total_pasca_produksi}</td>`;
               row +=`<td align="right">${item.total_budget}</td>`;
               
               	  row +=`<td>${item.status.status_convert}  </td>`;
               	
             

               
	               	if(item.request_edit == 'true')
	                {
	                    row +=`<td>Permintaan Request Edit </td>`;
	                }else{
	                	if(item.checklist =='not_approved')
	                    {
                              row +=`<td>${item.alasan} <small class="label pull-right  bg-green">Proses </small></td>`;
	                    }else if(item.checklist =='approved'){
	                      if(item.alasan == '')
	                      {
                              row +=`<td></td>`;
	                      }else{
	                      	  row +=`<td>${item.alasan} <small class="label pull-right  bg-green">Approved</small> </td>`;
	                      }	
                            

                         }else{
                             row +=`<td> </td>`
                         }     
	                    		
	                }		
               	 
            
               row +=`<td>`; 
                row +=`<div class="btn-group">`;

                  row +=`<button id="Detail" data-param_id="`+ item.id +`" data-toggle="modal" data-target="#modal-edit-${item.id}" type="button" data-toggle="tooltip" data-placement="top" title="Detail Data"  class="btn btn-primary"><i class="fa fa-eye" ></i></button>`;


               if(item.access =='admin' || item.access =='pusat')
               {

               	 if(item.status.status_db =='14')
                {
               
	                if(item.checklist == 'proses')
	                {
	                   row +=`<button id="Approved" data-param_type="approved" data-param_id="`+ item.id +`"  type="button" data-toggle="tooltip" data-placement="top" title="Approved Data"  class="btn btn-primary"><i class="fa fa-check"></i></button>`;
	                }else if(item.checklist == 'approved'){

	                   
	                   row +=`<button id="Approved" data-param_type="not_approved" data-param_id="`+ item.id +`"  type="button" data-toggle="tooltip" data-placement="top" title="Batalkan Approved Data"  class="btn btn-primary"><i class="fa fa-ban"></i></button>`;

	                }else{
                        

                        row +=`<button disabled  type="button" data-toggle="tooltip" data-placement="top" title="Batalkan Approved Data"  class="btn btn-primary"><i class="fa fa-ban"></i></button>`;

	                }

	             }   
	            }    


                   options.forEach(function(opt, arr) 
                  {
                        if(opt.action == 'update')
                        {
                           if(opt.checked == true)
                           { 
                                row +=`<button id="Edit" data-param_id="`+ item.id +`" data-toggle="modal" data-target="#modal-edit-${item.id}" type="button" data-toggle="tooltip" data-placement="top" title="Edit Data"  class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;
                              
                            }    

                        } 

                        if(opt.action == 'delete')
                        {
                           if(opt.checked == true)
                           {
                             
                            row += BtnTableDelete(item);

                           } 
                        }   


                  });

                  row +=`<div id="modal-edit-${item.id}" class="modal fade" role="dialog">`;
                     row +=`<div id="FormEdit-${item.id}"></div>`;
                  row +=`</div>`;


              

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
	           $('#approve-selected').prop("disabled", false);
	         }else{
	           $('#delete-selected').prop("disabled", true);
	           $('#approve-selected').prop("disabled", true);
	         } 	
   		});


   		$( "#content" ).on( "click", "#Detail", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id == id); 
           
           
       });


        // Approve selected button
    
 
    


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


        $("#content").on( "click", "#Approved", (e) => {
             
                let id = e.currentTarget.dataset.param_id;
                let type = e.currentTarget.dataset.param_type;

                if(type == 'approved')
                {
                   var item = 'Approved';
                }else{
                    var item = 'Batalkan Approved'; 
                } 	

		        Swal.fire({
				      title: 'Apakah anda yakin '+ item +'?',
				      icon: 'warning',
				      showCancelButton: true,
				      confirmButtonColor: '#d33',
				      cancelButtonColor: '#3085d6',
				      confirmButtonText: 'Ya'
				    }).then((result) => {
				      if (result.isConfirmed) {
				        // Perform the delete action here, e.g., using an AJAX request
				        // You can use the itemId to identify the item to be deleted
				        approvedItem(id,type);
				        
				        Swal.fire(
				          'Appoved!',
				          'Data berhasil diapprove.',
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
            url:  BASE_URL +`/api/promosi/selected`,
            method: 'POST',
            data: { data: ids },
            success: function(response) {
                // Handle success (e.g., remove deleted items from the list)
                fetchData(page,year);
              
                $('#delete-selected').prop("disabled", true);
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
		        fetchData(page,year);
		       
		    },
		    error: function(error) {
		        console.error('Error deleting items:', error);
		    }
		});

    }


     function approvedItem(id,type){
      
       $.ajax({
		    url:  BASE_URL +`/api/promosi/`+ type +`/`+ id,
		    method: 'PUT',
		    success: function(response) {
		        // Handle success (e.g., remove deleted items from the list)
		        fetchData(page,year);
		        
		    },
		    error: function(error) {
		        console.error('Error deleting items:', error);
		    }
		});

    }

    // Function to delete items
    function ApprovedItems(ids) {
        // Send the selected IDs for deletion using AJAX
       
        $.ajax({
            url:  BASE_URL +`/api/promosi/selected?type=approved`,
            method: 'POST',
            data: { data: ids },
            success: function(response) {
                // Handle success (e.g., remove deleted items from the list)
                fetchData(page,year);
               
                $('#approve-selected').prop("disabled", true);
            },
            error: function(error) {
                console.error('Error deleting items:', error);
            }
        });
    }

    function ChecklistTable(item,type){
         
           var row = '';
           if(item.deleted == true)
           {
                row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
           }else{


           	        if(item.checklist == 'proses')
	                {
	                    row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
	                }else{
                       row +=`<td><input disabled  type="checkbox"></td></td>`;

	                }


           	 	
               
             
           }   

           return row;
    }

   function BtnTableDelete(item){
        
       var row = ''; 
        if(item.deleted == true)
       {
            row +=`<button id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`; 
       }else{
            row +=`<button disabled  data-toggle="tooltip" title="Hapus Data"  type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`; 
       }


       return row;


    }

    

    function listOptions(data){
         
       data.forEach(function(item, index) 
       {
           if(item.action =='create')
           {
               if(item.checked ==true)
               {
                   $('#ShowAdd').show();
                   $('#ShowImport').show();
               }else{
                  $('#ShowAdd').hide();
                  $('#ShowImport').hide();
               }    
           }


           

             if(item.action =='approval')
            {
               if(item.checked ==true)
               {
                   // $('#ShowChecklist').show();
                   $('#ShowChecklistAll').show();
                   $('#ShowApproval').show();
               }else{
                   // $('#ShowChecklist').hide();
                   $('#ShowChecklistAll').hide();
                   $('#ShowApproval').hide();
               } 
            }


            if(item.action =='delete')
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
                   row +=`<td class="padding-text-table">${item.daerah_name}</td>`;
                   row +=`<td class="padding-text-table">${item.total_pra_produksi}</td>`;
                   row +=`<td class="padding-text-table">${item.total_produksi}</td>`;
                   row +=`<td class="padding-text-table">${item.total_pasca_produksi}</td>`;
                   row +=`<td class="padding-text-table">${item.total_budget}</td>`;
                   row +=`<td class="padding-text-table">${item.status.status_convert}</td>`;
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
	  XLSX.writeFile(wb, "Repot-data-promosi-"+ time +".xlsx");

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
            fetchData(currentPage,year);
        });
    }

    // Initial data fetch
    fetchData(currentPage,year);
    getperiode(year);
    getdaerah();
});
     </script>

@stop
