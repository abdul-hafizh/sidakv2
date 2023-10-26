@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">

	@if($access =='admin' || $access == 'pusat' )
       <div class="row margin-top-bottom-20">
            <div class="col-lg-3 pd-right">
                <select id="daerah_id"  data-live-search="true" class="selectpicker" data-style="btn-default" title="Pilih Provinsi / Kabupaten"></select>
            </div>   

            <div class="col-lg-3 pd-right ">
                <input type="date" id="search-input" class="form-control border-radius-20" placeholder="Cari Tanggal Pengajuan">
            </div>  

           <div class="col-lg-3 pd-right">
                <div class="btn-group">
                    <button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
                    <button id="refresh" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
                </div>
            </div>  

     </div> 
    @else

     <div  class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
        <div class="pull-right width-25">
            <div class="input-group input-group-sm border-radius-20">
				<input type="date" id="search-input" placeholder="Cari Tanggal Pengajuan" class="form-control height-35 border-radius-left">
				<span class="input-group-btn">
				<button id="Search" type="button" class="btn btn-search btn-flat height-35 border-radius-right"><i class="fa fa-search"></i></button>
				</span>
			</div>
        </div> 	
    </div>
     
      

    @endif	

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


			<div id="ShowApproval" style="display:none;" class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled id="approve-selected" class="btn btn-danger border-radius-10">
					 Approval
				</button>

			</div>

			<div  class="pull-left padding-9-0 margin-left-button">
				<button type="button" id="ExportButton"  class="btn btn-info border-radius-10">
					 Export
				</button>
			</div>

			

			<div id="ShowAdd" style="display:none;" class="pull-left padding-9-0">
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

							


                            <th id="ShowChecklistApproved" style="display:none;" ><input id="select-all" class="span-title" type="checkbox"></th>

							<th id="ShowChecklistAll" style="display:none;" ><input id="select-all" class="span-title" type="checkbox"></th>

							

							<th id="BorderAppoved" style="display:none;"><div class="split-table"></div><span class="span-title">No</span>  </th>
							<th id="BorderDeleted" style="display:none;"><div class="split-table"></div><span class="span-title">No</span>  </th>

							@if($access =='admin' || $access == 'pusat' )
							  @if($access =='admin')
							  	<th><div class="split-table"></div><span class="span-title">No</span>  </th>
                              @endif
							<th><div class="split-table"></div><span class="span-title"> Nama Daerah </span></th>
							@endif
							<th><div class="split-table"></div><span class="span-title"> Tanggal Berahir </span></th>
							<th><div class="split-table"></div><span class="span-title"> Pengajuan Perpanjangan </span></th>
							<th><div class="split-table"></div><span class="span-title"> Alasan </span></th>
							<th><div class="split-table"></div><span class="span-title"> Status </span></th>
							<th><div class="split-table"></div><span class="span-title"> Tanggal Dibuat </span></th>
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
     @include('template/sidakv2/extension.add')
     @include('template/sidakv2/extension.export')

     <div id="modal-detail" class="modal fade" role="dialog">
     
     </div>  	

<script type="text/javascript">

 $(document).ready(function() {

 	
    const itemsPerPage = 10; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    const total = 0;
    var year_id = [];
    var date_expired = '';
    var daerah_id = '';
    var search = '';

    var url = window.location.href; 
	var currentDomain = window.location.hostname;
	var segments = url.split('/'); 

	

    SelectDaerah();
    ChangeDaerah();
    
    	
  

     $("#ExportButton").click(function() {
	     $.ajax({
            url: BASE_URL+ `/api/extension?page=${page}&per_page=all`,
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
                  	var url = BASE_URL + `/api/extension/search?page=${page}&per_page=${value}`;
                  	var method = 'POST';
                  }else{
                    var url = BASE_URL + `/api/extension?page=${page}&per_page=${value}`;
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


      
    // keyup search  
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
	            url: BASE_URL + `/api/extension/search?page=${page}&per_page=${itemsPerPage}`,
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
	            url: BASE_URL + `/api/extension/search?page=${page}&per_page=${itemsPerPage}`,
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

    function SelectDaerah(){

	    $.ajax({
	        url: BASE_URL +'/api/select-daerah',
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

    function ChangeDaerah(){

    	 $('#daerah_id').on('change', function() {
       var value = $(this).val();         
            if(value)
            {   
                 var per_page = $('#row_page').val();
                 const content = $('#content');
                 content.empty();
                 let row = ``;
                 row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                  content.append(row);
                  daerah_id = $('#daerah_id').val();

                  if(daerah_id !='')
                  {
                    var url = BASE_URL + `/api/extension/search?page=${page}&per_page=${per_page}`;
                    var method = 'POST';
                  } 

                $.ajax({
                    url: url,
                    method: method,
                    data:{'search':search,'daerah_id':daerah_id},
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

    }

    // Function to fetch data from the API
    function fetchData(page) {
    	  
		const content = $('#content');
		content.empty();

		let row = ``;
		row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
		content.append(row);

        $.ajax({
            url: BASE_URL+ `/api/extension?page=${page}&per_page=${itemsPerPage}`,
            method: 'GET',
            success: function(response) {
            	list = response.data;	
            	NotifDetail();
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
                        row +=ChecklistTable(item);
                    }
                 }

                 if(opt.action == 'approval')
                 {
                    if(opt.checked == true)
                    {
                          row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
           
                    }
                 }        
              }); 

               row +=`<td>${item.number}</td>`;
               if(item.access =='admin' || item.access =='pusat')
               {
               	row +=`<td>${item.daerah_name}</td>`;
               }	
               row +=`<td>${item.expireddate.expired_convert}</td>`;
               row +=`<td>${item.extensiondate.extension_convert}</td>`;
               row +=`<td>${item.description.desc_convert}</td>`;
               if(item.status.status_db =='Y')
               {
	               	if(item.checklist == 'Approved')
	                {
	                   row +=`<td><small class="label pull-right  bg-green">${item.checklist}</small> </td>`;
	                }else{
	                	row +=`<td><small class="label pull-right bg-yellow">${item.checklist}</small> </td>`;
	                }		
               	 
               }else{
               	  row +=`<td>${item.status.status_convert}  </td>`;
               }	
               
               row +=`<td>${item.created_at}</td>`;
               row +=`<td>`; 

                if(item.access =='admin' || item.access =='pusat')
               {
                 row +=`<div class="btn-group pull-left ">`;
               }else{
                  row +=`<div class="btn-group pull-left list-menu-table-periode">`;
               }

               if(item.access =='admin' || item.access =='pusat')
               {

               	 if(item.status.status_db =='Y')
                {
               
	                if(item.checklist == 'Proses')
	                {
	                   row +=`<div id="Approved" data-param_type="approved" data-param_id="`+ item.id +`"   data-toggle="tooltip" data-placement="top" title="Approved Data"  class="pointer btn-padding-action pull-left"><i class="fa-icon icon-active"></i></div>`;
	                }else{
	                   
	                   row +=`<div id="Approved" data-param_type="not_approved" data-param_id="`+ item.id +`"   data-toggle="tooltip" data-placement="top" title="Batalkan Approved Data"  class="pointer btn-padding-action pull-left"><i class="fa-icon icon-ban"></i></div>`;

	                }

	             }   
	            }     



	          

                  row +=`<div id="Detail" data-param_id="`+ item.id +`" data-toggle="modal" data-target="#modal-edit-${item.id}"  data-toggle="tooltip" data-placement="top" title="Detail Data"  class="pointer btn-padding-action pull-left"><i class="fa-icon icon-detail" ></i></div>`;


                   options.forEach(function(opt, arr) 
                  {
                        if(opt.action == 'update')
                        {
                           if(opt.checked == true)
                           { 
                                
                                row += BtnTableEdit(item);
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


   		$( "#content" ).on( "click", "#Detail", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            GetDetailModal(id);
        });

        $( "#content" ).on( "click", "#Edit", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id == id);
         
            
           
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit Pengajuan Periode</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
				                 

				                  row +=`<div id="semester-alert-`+ item.id +`" class="form-group has-feedback" >`;
					              row +=`<label>Semester</label>`;
					              row +=`<select id="semester-`+ item.id +`"  class="selectpicker form-control" name="semester">`;
					                
                                      row +=`<option value="01" >Semester 01</option>`;
                                      row +=`<option value="02">Semester 02</option>`;
					                     
					              row +=`</select>`;
					              row +=`<span id="semester-messages-`+ item.id +`"></span>`;
					            row +=`</div>`;

					            row +=`<div id="year-alert-`+ item.id +`" class="form-group has-feedback" >`;
					              row +=`<label>Tahun</label>`;
					              
					               row +=`<select id="year-`+ item.id +`" class="form-control selectpicker" data-style="btn-default" name="year">`;
					                  
					              row +=`</select>`;
					              row +=`<span id="year-messages-`+ item.id +`"></span>`;
					            row +=`</div>`;

                                 
				                row +=`<div id="expireddate-alert-`+ item.id +`" class="form-group has-feedback" >`;
					              row +=`<label>Tanggal Berahir</label>`;

					             
					              row +=`<div id="confirm_expired-`+ item.id +`" class="confirm_expired-`+ item.id +` text-bold alert alert-danger alert-dismissible"></div>`;
					              row +=`<span id="expireddate-messages-`+ item.id +`"> </span>`;
					            row +=`</div>`;


				                row +=`<div id="extensiondate-alert-`+ item.id +`" class="form-group has-feedback" >`;
					              row +=`<label>Pengajuan Perpanjangan</label>`;
					              row +=`<input id="extensiondate-`+ item.id +`"  type="date" class="form-control" name="extensiondate" value="`+ item.extensiondate.extension_db +`">`;
					              row +=`<span id="extensiondate-messages-`+ item.id +`"></span>`;
					            row +=`</div>`;
 


				                  row +=`<div id="description-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Keterangan</label>`;
				                  row +=`<textarea type="text" name="description" class="form-control">`+ item.description.desc_db +`</textarea>`;
				                  row +=`<span id="description-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;


			                    

                            row +=`</div>`;


                            row +=`<div class="modal-footer">`;
						        row +=`<button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>`;

						          row +=`<button id="update-`+ item.id +`" data-param_id="`+ item.id +`" type="button" class="btn color-white btn-warning" >Update</button>`;
						            row +=`<button id="kirim-`+ item.id +`" type="button" class="btn btn-primary color-white" >Kirim</button>`; 
						            row +=`<button id="load-update" type="button" disabled class="btn  btn-default" style="display:none;"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>`;



     						row +`</div>`;
						    row +=`</div>`;


					    row +=`</form>`;     
                row +=`</div>`;
            row +=`</div>`   

            $('#FormEdit-'+ item.id).html(row); 

            // Set a specific option as selected
               let select_semester = $('#semester-'+ item.id);
		       var selectedSemester = item.semester;
		       select_semester.val(selectedSemester);
		       // Refresh the SelectPicker
		       select_semester.selectpicker('refresh');

                   
		       
		   
		       getYearSelected(item.year,selectedSemester,item);
		      

		       $('#semester-'+ item.id).on('change', function() {
			       var value = $(this).val();  
			     
			          $('#year-'+ item.id).empty();
                      $('#year-'+ item.id).attr('title','Pilih Tahun') 
                      var selected = '';
			          getYearSelected(selected,value,item);

			    }); 


                ChangeYear(item);
                AlertExtentionFirst(item); 
                   
                ExtensionChange(item)
    
            
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
     function NotifDetail(){
       const item = list.find(o => o.id == segments[5]); 
       if(item)
       {    
	       if(segments[5])
	       {  
			 var row = '';
	          row += `<div id="FormEdit-`+ segments[5] +`"></div>`;
	          $('#modal-detail').html(row);
	            GetDetailModal(segments[5])  
	          $('#modal-detail').modal('show');
	       }
       } 
     }
   	

     function GetDetailModal(id){

        const item = list.find(o => o.id == id); 
        if(item)
        { 	
        
        let row = ``;
        row +=`<div class="modal-dialog">`;
            row +=`<div class="modal-content">`;

			       row +=`<div class="modal-header">`;
			         row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
			         row +=`<h4 class="modal-title">Detail Perpanjangan Periode</h4>`;
			       row +=`</div>`;

			       row +=`<form   id="FormSubmit-`+ item.id +`">`;
				        row +=`<div class="modal-body">`;
                           
                             
			                


			                  row +=`<div id="semester-alert-`+ item.id +`" class="form-group has-feedback" >`;
				              row +=`<label>Semester</label>`;
				              row +=`<select  id="semester-`+ item.id +`" class="selectpicker form-control" name="semester">`;
				                  row +=`<option value="">Pilih Semester</option>`;
                                  row +=`<option value="01" >Semester 01</option>`;
                                  row +=`<option value="02">Semester 02</option>`;
				                     
				              row +=`</select>`;
				              row +=`<span id="semester-messages-`+ item.id +`"></span>`;
				            row +=`</div>`;

				            row +=`<div id="year-alert-`+ item.id +`" class="form-group has-feedback" >`;
				              row +=`<label>Tahun</label>`;
				              row +=`<input readonly maxlength="4" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="year" placeholder="Year" value="`+ item.year +`">`;
				              row +=`<span id="year-messages-`+ item.id +`"></span>`;
				            row +=`</div>`;


			                row +=`<div id="expireddate-alert-`+ item.id +`" class="form-group has-feedback" >`;
				              row +=`<label>Tanggal Berahir</label>`;
				              row +=`<input readonly type="text" class="form-control" value="`+ item.expireddate.expired_db +`">`;
				              row +=`<span id="expireddate-messages-`+ item.id +`"></span>`;
				            row +=`</div>`;


			                row +=`<div id="extensiondate-alert-`+ item.id +`" class="form-group has-feedback" >`;
				              row +=`<label>Pengajuan Perpanjangan</label>`;
				              row +=`<input readonly type="text" class="form-control" value="`+ item.extensiondate.extension_db +`">`;
				              row +=`<span id="extensiondate-messages-`+ item.id +`"></span>`;
				            row +=`</div>`;


                             


			                  row +=`<div id="description-alert-`+ item.id +`" class="form-group has-feedback" >`;

			                  row +=`<label>Keterangan</label>`;
			                  row +=`<textarea readonly type="text" name="description" class="form-control">`+ item.description.desc_db +`</textarea>`;
			                  row +=`<span id="description-messages-`+ item.id +`"></span>`;
			                  row +=`</div>`;


		                    

                        row +=`</div>`;


                        row +=`<div class="modal-footer">`;
					        row +=`<button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>`;

					         
 						row +=`</div>`;
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
	       select.prop('disabled', true); 
	       select.selectpicker('refresh');
        }
     }

      function getYearSelected(selected,value,item){
        year_id = [];
        $.ajax({
            url: BASE_URL +'/api/select-year?semester='+ value,
            method: 'GET',
            dataType: 'json',
            success: function(data) {

                // Populate SelectPicker options using received data
                $.each(data, function(index, option) {
                    $('#year-'+ item.id).append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                });
                year_id = data; 
            
                 if(selected)
                 {
                 	$('#year-'+ item.id).val(selected);
                 	let find = data.find(o => o.value === selected);
                    $('.confirm_expired-'+ item.id).text(find.enddate_convert);
                 } 	
                 	
                 $('#year-'+ item.id).selectpicker('refresh');
               
               
                
                
            },
            error: function(error) {
                console.error(error);
            }
        });

      }

      function ChangeYear(item){
       
      
        $('#year-'+ item.id).change(function() {
           selectedVal = $(this).find("option:selected").val();
           let find = year_id.find(o => o.value === selectedVal);
            
           date_expired = find.enddate;
         
           $('.confirm_expired-'+ item.id).text(find.enddate_convert);
          
           ChangeAlert(item,find.enddate)
         
        });

        

        EditData(item.id);

    }

    function ExtensionChange(item){
           
    	 $('#extensiondate-'+ item.id).on('change', function() {
           var value = $(this).val();          
           ChangeAlert(item,value)
        });

    }

    function AlertExtentionFirst(item){
           
      		if(item.expireddate.expired_db > item.extensiondate.extension_db || item.expireddate.expired_db == item.extensiondate.extension_db)
           {
              $('#update-'+ item.id).prop('disabled', true).removeClass('btn-primary').addClass('btn-default');
              $('#kirim-'+ item.id).prop('disabled', true).removeClass('btn-warning').addClass('btn-default');


              $('#extensiondate-alert-'+ item.id).addClass('has-error');
              $('#extensiondate-messages-'+ item.id).addClass('help-block').html('<strong>Tanggal pengajuan maksimal lebih dari tanggal masa berahir '+ item.expireddate.expired_db +'</strong>');
           }else{
             
              $('#extensiondate-alert-'+ item.id).removeClass('has-error');
              $('#extensiondate-messages-'+ item.id).removeClass('help-block').html('');
           }

    }

    function ChangeAlert(item,value){

  
            var extensiondate = $('#extensiondate-'+ item.id).val();
            if(value > extensiondate  || extensiondate == value)
           {
              $('#update-'+ item.id).prop('disabled', true).removeClass('btn-primary').addClass('btn-default');
              $('#kirim-'+ item.id).prop('disabled', true).removeClass('btn-warning').addClass('btn-default');
              $('#extensiondate-alert-'+ item.id).addClass('has-error');
              $('#extensiondate-messages-'+ item.id).addClass('help-block').html('<strong>Tanggal pengajuan maksimal lebih dari tanggal masa berahir '+ value +'</strong>');
           }else{
              $('#update-'+ item.id).prop('disabled', false).removeClass('btn-default').addClass('btn-warning');
              $('#kirim-'+ item.id).prop('disabled', false).removeClass('btn-default').addClass('btn-primary'); 
              $('#extensiondate-alert-'+ item.id).removeClass('has-error');
              $('#extensiondate-messages-'+ item.id).removeClass('help-block').html('');
           }

     

    }

     function EditData(id)
    {
         $("#update-"+ id).click( () => {
            UpdateData('N',id);
          
         });

         $("#kirim-"+ id).click( () => {
            UpdateData('Y',id);
          
         });

  
    }

    function UpdateData(status,id){

    
		        
	              var data = $("#FormSubmit-"+ id).serializeArray();
	            
	              $("#update-"+id).hide();
	              $("#kirim-"+id).hide();
	              $("#load-update").show();
	               var form = {
		              
		              'semester':data[0].value,
		              'year':data[1].value,
		              'expireddate':date_expired,
		              'extensiondate':data[2].value,
		              'description':data[3].value,
		              'status':status,
		             
		             
		          };
                     if(status == 'Y')
                     {
                     	var vstatus = 'Dikirim';
                     }else{
                     	var vstatus = 'Disimpan';
                     } 	


					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/extension/'+ id,
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{
			                   Swal.fire({
			                        title: 'Sukses!',
			                        text: 'Berhasil '+vstatus,
			                        icon: 'success',
			                        confirmButtonText: 'OK'
			                        
			                    }).then((result) => {
			                        if (result.isConfirmed) {
			                            // User clicked "Yes, proceed!" button
			                            window.location.replace('/extension');
			                        }
			                    });

			                   //
			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                $("#update-"+ id).show();
			                $("#kirim-"+ id).show();
			                $("#load-update").hide();
 
			                if(errors.messages.semester)
			                {
			                     $('#semester-alert').addClass('has-error');
			                     $('#semester-messages').addClass('help-block').html('<strong>'+ errors.messages.semester +'</strong>');
			                }else{
			                    $('#semester-alert').removeClass('has-error');
			                    $('#semester-messages').removeClass('help-block').html('');
			                }

			                if(errors.messages.year)
			                {
			                     $('#year-alert').addClass('has-error');
			                     $('#year-messages').addClass('help-block').html('<strong>'+ errors.messages.year +'</strong>');
			                }else{
			                    $('#year-alert').removeClass('has-error');
			                    $('#year-messages').removeClass('help-block').html('');
			                }

			                if(errors.messages.extensiondate)
			                {
			                     $('#extensiondate-alert').addClass('has-error');
			                     $('#extensiondate-messages').addClass('help-block').html('<strong>'+ errors.messages.extensiondate +'</strong>');
			                }else{
			                    $('#extensiondate-alert').removeClass('has-error');
			                    $('#extensiondate-messages').removeClass('help-block').html('');
			                }

			               
			                 if(errors.messages.description)
			                {
			                     $('#description-alert').addClass('has-error');
			                     $('#description-messages').addClass('help-block').html('<strong>'+ errors.messages.description +'</strong>');
			                }else{
			                    $('#description-alert').removeClass('has-error');
			                    $('#description-messages').removeClass('help-block').html('');
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
       
        $.ajax({
            url:  BASE_URL +`/api/extension/selected?type=deleted`,
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


    // Function to delete items
    function ApprovedItems(ids) {
        // Send the selected IDs for deletion using AJAX
       
        $.ajax({
            url:  BASE_URL +`/api/extension/selected?type=approved`,
            method: 'POST',
            data: { data: ids },
            success: function(response) {
                // Handle success (e.g., remove deleted items from the list)
                fetchData(page);
                $('#approve-selected').prop("disabled", true);
            },
            error: function(error) {
                console.error('Error deleting items:', error);
            }
        });
    }

    


    function deleteItem(id){

		$.ajax({
		    url:  BASE_URL +`/api/extension/`+ id,
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

    function approvedItem(id,type){
       
       $.ajax({
		    url:  BASE_URL +`/api/extension/`+ type +`/`+ id,
		    method: 'PUT',
		    success: function(response) {
		        // Handle success (e.g., remove deleted items from the list)
		        fetchData(page);
		    },
		    error: function(error) {
		        console.error('Error deleting items:', error);
		    }
		});

    }

    function ChecklistTable(item){
         
           var row = '';
           if(item.deleted == true)
           {
               row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
           }else{
               row +=`<td><input disabled  type="checkbox"></td></td>`;  
             
           }   

           return row;
    }

   function BtnTableEdit(item){
   
      var row = ''; 
       if(item.deleted == true)
       {  

       	  if(item.status.status_db == 'Y')
       	  {
                row +=`<div disabled  data-toggle="tooltip" title="Edit Data"   class="pointer btn-padding-action pull-left"><i class="fa-icon icon-edit-disabled" ></i></div>`; 
       	  }else{
       	  	  row +=`<div id="Edit" data-param_id="`+ item.id +`" data-toggle="modal" data-target="#modal-edit-${item.id}"  data-toggle="tooltip" data-placement="top" title="Edit Data"  class="pointer btn-padding-action pull-left"><i class="fa-icon icon-edit" ></i></div>`;
       	  }	

        
        }else{
             row +=`<div disabled  data-toggle="tooltip" title="Edit Data" class="pointer btn-padding-action pull-left"><i class="fa-icon icon-edit-disabled" ></i></div>`; 


        } 

        return row;

   } 

   function BtnTableDelete(item){
        
       var row = ''; 
       if(item.deleted == true)
       {
       	  if(item.status.status_db == 'Y')
       	  {
              row +=`<div disabled  data-toggle="tooltip" title="Hapus Data"  class="pointer btn-padding-action pull-left"><i class="fa-icon icon-destroy-disabled" ></i></div>`; 
       	  }else{
              
              row +=`<div id="Destroy" data-placement="top"  data-toggle="tooltip" title="Hapus Data" data-param_id="${item.id}" class="pointer btn-padding-action pull-left"><i class="fa-icon icon-destroy" ></i></div>`; 
       	  }	
            
       }else{
            row +=`<div disabled  data-toggle="tooltip" title="Hapus Data" class="pointer btn-padding-action pull-left"><i class="fa-icon icon-destroy-disabled" ></i></div>`; 
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
                   $('#ShowApproval').show();
                   $('#ShowChecklistApproved').show(); 
                   $('#ShowChecklistApproved').show();
                   $('#BorderAppoved').show();
               }else{
                   $('#ShowApproval').hide();
                   $('#ShowChecklistApproved').hide();
                   $('#ShowChecklistApproved').hide();
                   $('#BorderAppoved').hide();
               } 
            }




            if(item.action =='delete')
            {
               if(item.checked ==true)
               {
                   $('#ShowChecklist').show();
                   $('#ShowChecklistAll').show();
                   $('#BorderDeleted').show();
                   
               }else{
                   $('#ShowChecklist').hide();
                   $('#ShowChecklistAll').hide();
                   $('#BorderDeleted').hide();
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
                   row +=`<td class="padding-text-table">${item.semester}</td>`;
                   row +=`<td class="padding-text-table">${item.year}</td>`;
                   row +=`<td class="padding-text-table">${item.startdate_format}</td>`;
                   row +=`<td class="padding-text-table">${item.enddate_format}</td>`;
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
	  XLSX.writeFile(wb, "Repot-data-extension-"+ time +".xlsx");

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

