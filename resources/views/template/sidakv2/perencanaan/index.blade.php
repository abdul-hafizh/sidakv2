@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
    <div class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
        <div class="pull-right width-25">
            <div class="input-group input-group-sm border-radius-20">
				<select id="periode_id" class="form-control height-35"></select>
				<span class="input-group-btn">
				    <button id="Search" type="button" class="btn btn-primary btn-flat height-35"><i class="fa fa-search"></i></button>
				</span>
			</div>
        </div> 	
    </div> 	

	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
            @if($access != 'daerah' && $access != 'province')
                <div class="pull-left padding-9-0 margin-left-button">
                    <button type="button" id="delete-selected" class="btn btn-danger border-radius-10">
                        Hapus
                    </button>
                </div>
            @endif

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
							<th><input id="select-all" type="checkbox"></th>
							<th><span class="border-left-table">No</span>  </th>
							<th><span class="border-left-table">Periode </span></th>
							<th><span class="border-left-table">Status </span></th>
							<th><span class="border-left-table">Tanggal </span></th>
							<th> Options </th>
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

        $.ajax({
            type: 'GET',
            url: BASE_URL +'/api/perencanaan/periode',
            success: function(response) {
                periode = response;
                onOptionSelect(response)
            },
            error: function( error) {
            
            }
        });

        $('#select-all').on('change', function() {
            $('.item-checkbox').prop('checked', $(this).is(':checked'));
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
            data.forEach(item => {
                let row = ``;
                row +=`<option value="${item.value}">${item.text}</option>`;
                content.append(row);
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

        $('#Search').click( () => {
            let search = $('#periode_id').val();            
            if(search)
            { 	                
                $.ajax({
                    url: BASE_URL + `/api/perencanaan/search?page=${page}&per_page=${itemsPerPage}`,
                    data:{'search':search},
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
        });

        function fetchData(page) {
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

