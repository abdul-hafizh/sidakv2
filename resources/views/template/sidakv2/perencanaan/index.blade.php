@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
        <div class="pull-right width-25">
          
				<select id="periode_id" class="selectpicker" data-style="btn-primary" title="Pilih Periode"></select>
				



			
        </div> 	
    </div> 	





	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
            @if($access != 'daerah' || $access != 'province')
                <div class="pull-left padding-9-0 margin-left-button">
                    <button type="button" disabled id="delete-selected" class="btn btn-danger border-radius-10">
                         Hapus
                    </button>
                </div>
            @endif

            <div class="pull-left padding-9-0 margin-left-button">
                <button type="button"  id="refresh" class="btn btn-primary border-radius-10">
                     Refresh
                </button>
            </div>

            @if($access == 'daerah' || $access == 'province')
                <div class="pull-left padding-9-0">
                    <a href="{{ url('perencanaan/add') }}" class="btn btn-primary border-radius-10" >
                        Tambah Data
                    </a> 
                </div>		
            @endif
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
							<th class="th-checkbox"><input id="select-all" class="span-title" type="checkbox"></th>
							<th><div class="split-table"></div><span class="span-title">No</span></th>
							<th><div class="split-table"></div><span class="span-title">Periode </span></th>
							<th><div class="split-table"></div><span class="span-title">Status </span></th>
							<th><div class="split-table"></div><span class="span-title">Tanggal </span></th>
							<th><div class="split-table"></div> <span class="span-title"> Aksi </span> </th>
						</tr>
					</thead>

					<tbody id="content"></tbody>

                </table>
            </div>
        </div>
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

        $('.selectpicker').selectpicker();
        $.ajax({
            url: BASE_URL +'/api/perencanaan/periode',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate SelectPicker options using received data
                $.each(data, function(index, option) {
                    $('.selectpicker').append($('<option>', {
                      value: option.value,
                      text: option.text
                    }));
                });

                // Refresh the SelectPicker to apply the new options
                $('.selectpicker').selectpicker('refresh');
            },
            error: function(error) {
            console.error(error);
            }
        });

        // $.ajax({
        //     type: 'GET',
        //     url: BASE_URL +'/api/perencanaan/periode',
        //     success: function(response) {
        //         periode = response;
        //         onOptionSelect(response)
        //     },
        //     error: function( error) {
            
        //     }
        // });

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
            var nonDisabledCheckboxes = $('.item-checkbox:not(:disabled)');
            nonDisabledCheckboxes.prop('checked', $(this).is(':checked'));
            const checkedCount =  $('.item-checkbox:checked').length;
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

        function onOptionSelect(data) {
            const content = $('#periode_id');
            content.empty();
            let row = ``;
            row +=`<option value="">Pilih Periode</option>`;
            data.forEach(item => {
                
                row +=`<option value="${item.value}">${item.text}</option>`;
                content.html(row);
            });     
        } 

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
                    updateContent(response.data);
                    updatePagination(response.current_page, response.last_page);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function updateContent(data) {
            const content = $('#content');

            content.empty();
            data.forEach(item => {
                let row = ``;
                row +=`<tr>`;
                row +=`<td><input class="item-checkbox" data-id="${item.id}"  type="checkbox"></td></td>`;
                row +=`<td class="table-padding-second">${item.number}</td>`;
                row +=`<td class="table-padding-second">${item.periode}</td>`;
                row +=`<td class="table-padding-second">${item.status}</td>`;
                row +=`<td class="table-padding-second">${item.created_at}</td>`;
                row +=`<td>`; 
                    row +=`<div class="btn-group">`;

                    row +=`<button  id="Edit" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-pencil" ></i></button>`;

                    row +=`<button id="Destroy" data-param_id="${item.id}" type="button" class="btn btn-primary"><i class="fa fa-trash" ></i></button>`;

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
                 }else{
                   $('#delete-selected').prop("disabled", true);
                 }  
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

