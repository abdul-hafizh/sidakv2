@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div class="col-sm-4 pull-left padding-default full margin-top-bottom-20" id="ShowSearch" style="display:none;">
        <div class="pull-right width-25">
		    <select id="periode_id" class="selectpicker" data-style="btn-default" title="Pilih Periode"></select>
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

            <div id="ShowChecklist" style="display:none;" class="pull-left padding-9-0 margin-left-button">
                <button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
                     Hapus
                </button>
            </div>

             <div id="ShowExport" class="pull-left padding-9-0 margin-left-button" style="display:none;">
                <button type="button" id="printButton"  class="btn btn-info border-radius-10">
                     Export
                </button>
            </div>
         
           

            <div id="ShowAdd" style="display:none;" class="pull-left padding-9-0">
                <a href="{{ url('perencanaan/add') }}" class="btn btn-primary border-radius-10" >
                    Tambah Data
                </a> 
            </div>		
          
		</div> 

		<div id="ShowPagination" class="pull-right width-50">
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
							<th id="ShowChecklistAll" style="display:none;"  class="th-checkbox"><input id="select-all" class="span-title" type="checkbox"></th>
							<th><div id="ShowChecklistAll" style="display:none;"  class="split-table"></div><span class="span-title">No</span></th>
							
							<th><div class="split-table"></div><span class="span-title">Periode </span></th>
							<th><div class="split-table"></div><span class="span-title">Status </span></th>
							<th><div class="split-table"></div><span class="span-title">Tanggal </span></th>
							<th id="ShowAction" style="display:none;"><div class="split-table"></div><span class="span-title"> Aksi </span> </th>
						</tr>
					</thead>

					<tbody id="content"></tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="pull-left full">
      <div id="total-data" class="pull-left width-25"></div>    
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        const itemsPerPage = 10;
        let currentPage = 1; 
        let previousPage = 1; 
        const visiblePages = 5; 
        let page = 1;
        var periode = [];
        var list = [];

        $('#row_page').on('change', function() {
            var value = $(this).val();         
            if(value)
            {   
                 const content = $('#content');
                 content.empty();
                 let row = ``;
                 row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                  content.append(row);
                  let search = $('#periode_id').val();
                  if(search !='')
                  {
                    var url = BASE_URL + `/api/perencanaan/search?page=${page}&per_page=${value}`;
                    var method = 'POST';
                  }else{
                    var url = BASE_URL + `/api/perencanaan?page=${page}&per_page=${value}`;
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
        });

        $.ajax({
            url: BASE_URL +'/api/select-periode?type=GET',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $.each(data.result, function(index, option) {
                    $('#periode_id').append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                });

                $('#periode_id').selectpicker('refresh');
            },
            error: function(error) {
                console.error(error);
            }
        });

        $('#periode_id').on('change', function() {
            var value = $(this).val();         
            if(value)
            {   
                 const content = $('#content');
                 content.empty();
                 let row = ``;
                 row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                  content.append(row);

                $.ajax({
                    url: BASE_URL + `/api/perencanaan/search?page=${page}&per_page=${itemsPerPage}`,
                    data:{'search':value},
                    method: 'POST',
                    success: function(response) {
                        resultTotal(response.total);
                        updateContent(response.data);
                        updatePagination(response.current_page, response.last_page);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }    
        });

        $('#select-all').on('change', function() {
            var nonDisabledCheckboxes = $('.item-checkbox:not(:disabled)');
            nonDisabledCheckboxes.prop('checked', $(this).is(':checked'));
            const checkedCount =  $('.item-checkbox:checked').length;
            if(checkedCount >0)
            {
                $('#delete-selected').prop("disabled", false);
            } else {
                $('#delete-selected').prop("disabled", true);
            }
        });

        $('#refresh').on('click', function() {
            fetchData(page);
            $('#search-input').val('');
        });

        $('#delete-selected').on('click', function() {
            const selectedIds = [];
            $('.item-checkbox:checked').each(function() {
                selectedIds.push($(this).data('id'));
            });

            deleteItems(selectedIds);
        });

        $('.item-checkbox').on('change', function() {
            const allChecked = $('.item-checkbox:checked').length === $('.item-checkbox').length;
            $('.select-all').prop('checked', allChecked);
        });

        function deleteItems(ids) {        
            $.ajax({
                url:  BASE_URL +`/api/perencanaan/selected`,
                method: 'POST',
                data: { data: ids },
                success: function(response) {
                    fetchData(page);
                },
                error: function(error) {
                    console.error('Error deleting items:', error);
                }
            });
        }

        function fetchData(page) {
            const content = $('#content');
            content.empty();
          
            let row = ``;
                row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                content.append(row);

            $.ajax({
                url: BASE_URL+ `/api/perencanaan?page=${page}&per_page=${itemsPerPage}`,
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

        function updateContent(data,options) {
            const content = $('#content');
            const edited = options.find(o => o.action === 'edit');
            const deleted = options.find(o => o.action === 'delete');
            const checklist = options.find(o => o.action === 'checklist');
            const detailed = options.find(o => o.action === 'detail');
            
            content.empty();
            data.forEach(function(item, index) {
                let row = ``;
                row +=`<tr>`;
                if(item.deleted == false)
               {
                  if(checklist.checked == true)
                  {
                     row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
                  }
                  
               }else{
                  if(checklist.checked == true)
                  {
                  row +=`<td><input disabled  type="checkbox"></td></td>`;  
                  }
               }   
                row +=`<td class="table-padding-second">${item.number}</td>`;
                row +=`<td class="table-padding-second">${item.periode}</td>`;
                row +=`<td class="table-padding-second">${item.status}</td>`;
                row +=`<td class="table-padding-second">${item.created_at}</td>`;
                row +=`<td>`; 
                    row +=`<div class="btn-group">`;
                    if(item.deleted == false)
                    {
                         if(detailed.checked == true)
                         {  
                           row +=`<button id="Detail" data-param_id="${item.id}" type="button" class="btn btn-primary" title="Detail Data"><i class="fa fa-eye"></i></button>`;

                         }   
                         if(edited.checked == true)
                         { 
                            row +=`<button id="Edit" data-param_id="${item.id}" type="button" class="btn btn-primary" title="Edit Data"><i class="fa fa-pencil"></i></button>`;
                         }


                         if(deleted.checked == true)
                         {
                            row +=`<button id="Destroy" data-param_id="${item.id}" type="button" class="btn btn-primary" title="Hapus Data"><i class="fa fa-trash"></i></button>`; 
                         }

                    } else {

                       if(detailed.checked == true)
                       {   
                          row +=`<button id="Detail" data-param_id="${item.id}" type="button" class="btn btn-primary" title="Detail Data"><i class="fa fa-eye"></i></button>`;
                       }

                       if(edited.checked == true)
                       { 
                          
                          row +=`<button disabled type="button" class="btn btn-primary" title="Edit Data"><i class="fa fa-pencil"></i></button>`;
                       }
                       
                       if(deleted.checked == true)
                       { 
                           row +=`<button disabled type="button" class="btn btn-primary" title="Hapus Data"><i class="fa fa-trash"></i></button>`;
                       } 
                    }  
                    row +=`</div>`;
                    row +=`</td>`;
                row +=`</tr>`; 
                content.append(row);
            });

            $('.item-checkbox').on('click', function() {
                const checkedCount = $('.item-checkbox:checked').length;
                if(checkedCount>0)
                {
                    $('#delete-selected').prop("disabled", false);
                } else {
                    $('#delete-selected').prop("disabled", true);
                }  
            });

            $( "#content" ).on( "click", "#Approve", (e) => {
             
                let id = e.currentTarget.dataset.param_id;
                
                Swal.fire({
			      title: 'Apakah Anda Yakin Approve Perencanaan Ini?',			    
			      icon: 'warning',
			      showCancelButton: true,
			      confirmButtonColor: '#d33',
			      cancelButtonColor: '#3085d6',
			      confirmButtonText: 'Ya'
			    }).then((result) => {
			        if (result.isConfirmed) {
                        approveItem(id);
                        Swal.fire(
                            'Approved!',
                            'Data berhasil diapprove.',
                            'success'
                        );
			        }
			    });
            });

            $( "#content" ).on( "click", "#Detail", (e) => {
                let id = e.currentTarget.dataset.param_id;
                window.location.replace('/perencanaan/detail/'+ id);   
            });

            $( "#content" ).on( "click", "#Edit", (e) => {
                let id = e.currentTarget.dataset.param_id;
                window.location.replace('/perencanaan/edit/'+ id);   
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
                url:  BASE_URL +`/api/perencanaan/`+ id,
                method: 'DELETE',
                success: function(response) {
                    fetchData(page);
                },
                error: function(error) {
                    console.error('Error deleting items:', error);
                }
            });
        }

        function resultTotal(total){
           $('#total-data').html('<span><b>Total Data : '+ total +'</b></span>');
        }

        function listOptions(data){
        const edited = data.find(o => o.action === 'edit');
        const deleted = data.find(o => o.action === 'delete');
        const detail = data.find(o => o.action === 'delete');
         const checklist = data.find(o => o.action === 'checklist');

         if(checklist.action =='checklist')
           {
               if(checklist.checked ==true)
               {
                   $('#ShowChecklist').show();
                   $('#ShowChecklistAll').show();
                   
                  
               }else{
                   $('#ShowChecklist').hide();
                   $('#ShowChecklistAll').hide();
               }    
           }
       
        if(edited.checked == false && deleted.checked == false && detail.checked == false)
        {
            $('#ShowAction').hide();
        }else{
             $('#ShowAction').show();
        }    
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

            if(item.action =='search')
           {
               if(item.checked ==true)
               {
                   $('#ShowSearch').show();
               }else{
                  $('#ShowSearch').hide();
               }    
           }   

            if(item.action =='perpage')
           {
               if(item.checked ==true)
               {
                   $('#ShowPagination').show();
               }else{
                  $('#ShowPagination').hide();
               }    
           }     

           

       });
    }

        function updatePagination(currentPage, totalPages) {
            const pagination = $('#pagination');

            pagination.empty();

            let startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
            let endPage = Math.min(totalPages, startPage + visiblePages - 1);

            if (currentPage > 1) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="1">«</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable">«</button></li>`);
            }

            if (currentPage > 1) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage - 1}">‹</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item "><button class="pagination-link pagination-disable">‹</button></li>`);
            }

            for (let i = startPage; i <= endPage; i++) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link${i === currentPage ? ' pagination-link--active' : ''}" data-page="${i}">${i}</button></li>`);
            }

            if (currentPage < totalPages) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage + 1}">›</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >›</button></li>`);
            }

            if (currentPage < totalPages) {
                pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${totalPages}">»</button></li>`);
            } else {
                pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >»</button></li>`);
            }

            pagination.find('.page-link').on('click', function() {
                currentPage = parseInt($(this).data('page'));
                fetchData(currentPage);
            });
        }

        fetchData(currentPage);

    });

</script>

@stop

