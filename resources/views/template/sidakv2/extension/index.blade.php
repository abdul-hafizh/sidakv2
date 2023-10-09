@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div  class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
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
							<th id="ShowChecklistAll" style="display:none;" ><input id="select-all" class="span-title" type="checkbox"></th>
							<th><div id="ShowChecklistAll" style="display:none;"  class="split-table"></div><span class="span-title">No</span>  </th>
							<th><div class="split-table"></div><span class="span-title"> extension </span></th>
							
							<th><div class="split-table"></div><span class="span-title"> Tanggal Berahir </span></th>
							<th><div class="split-table"></div><span class="span-title"> Pengajuan Perpanjangan </span></th>
							<th><div class="split-table"></div><span class="span-title"> Status </span></th>
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
              }); 

               row +=`<td>${item.number}</td>`;
               row +=`<td>${item.name}</td>`;
              
               row +=`<td>${item.startdate_convert}</td>`;
               row +=`<td>${item.enddate_convert}</td>`;
               row +=`<td>${item.status.status_convert}</td>`;
               row +=`<td>`; 
                row +=`<div class="btn-group">`;

                  row +=`<button id="Detail" data-param_id="`+ item.id +`" data-toggle="modal" data-target="#modal-edit-${item.id}" type="button" data-toggle="tooltip" data-placement="top" title="Detail Data"  class="btn btn-primary"><i class="fa fa-eye" ></i></button>`;


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
	         }else{
	           $('#delete-selected').prop("disabled", true);
	         } 	
   		});


   		$( "#content" ).on( "click", "#Detail", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id == id); 
           
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Detail extension</h4>`;
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

                                 row +=`<div id="startdate-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Tanggal Mulai</label>`;
				                  row +=`<input readonly type="date" class="form-control" name="startdate" placeholder="Tanggal Mulai" value="`+ item.startdate +`">
				                  <span id="startdate-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;


				                    row +=`<div id="enddate-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Tanggal Berahir</label>`;
				                  row +=`<input readonly type="date" class="form-control" name="enddate" placeholder="Tanggal Berahir" value="`+ item.enddate +`">
				                  <span id="enddate-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;


				                  row +=`<div id="description-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Keterangan</label>`;
				                  row +=`<textarea readonly type="text" name="description" class="form-control">`+ item.description +`</textarea>`;
				                  row +=`<span id="description-messages-`+ item.id +`"></span>`;
				                  row +=`</div>`;


			                    row +=`<div class="radio">`;
				                    row +=`<label>`;
				                    if(item.status.status_db =='Y')
				                    {
				                        row +=`<input disabled type="radio" name="status" id="status`+ item.id +`" value="Y" checked>`;	
				                    }else{
				                    	row +=`<input disabled type="radio" name="status" id="status`+ item.id +`" value="Y" >`;
				                    } 	
				                 
				                      row +=`Publish`;
				                    row +=`</label>`;
				                row +=`</div>`;
				                row +=`<div class="radio">`;
				                    row +=`<label>`;
				                      if(item.status.status_db =='N')
				                    {
				                        row +=`<input  disabled type="radio" name="status" id="status-N`+ item.id +`" value="N" checked>`;
				                    }else{
				                    	row +=`<input  disabled type="radio" name="status" id="status-N`+ item.id +`" value="N" >`;
				                    } 

				                     
				                     row +=`Draft`;
				                    row +=`</label>`;
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
        });

        $( "#content" ).on( "click", "#Edit", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            const item = list.find(o => o.id == id); 
           
            
            let row = ``;
            row +=`<div class="modal-dialog">`;
                row +=`<div class="modal-content">`;

				       row +=`<div class="modal-header">`;
				         row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
				         row +=`<h4 class="modal-title">Edit extension</h4>`;
				       row +=`</div>`;

				       row +=`<form   id="FormSubmit-`+ item.id +`">`;
					        row +=`<div class="modal-body">`;
                               
                                 
				                 

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
					              row +=`<input maxlength="4" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" class="form-control" name="year" placeholder="Year" value="`+ item.year +`">`;
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


				                  row +=`<div id="description-alert-`+ item.id +`" class="form-group has-feedback" >`;

				                  row +=`<label>Keterangan</label>`;
				                  row +=`<textarea type="text" name="description" class="form-control">`+ item.description +`</textarea>`;
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
						        row +=`<button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>`;

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
		          	     
		          	      'semester':data[0].value,
			              'year':data[1].value,
			              'startdate':data[2].value,
			              'enddate':data[3].value,
			              'description':data[4].value,
			              'status':data[5].value,

		          	    };



					$.ajax({
			            type:"PUT",
			            url: BASE_URL+'/api/extension/'+ id,
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
			                            window.location.replace('/extension');
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
            url:  BASE_URL +`/api/extension/selected`,
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

