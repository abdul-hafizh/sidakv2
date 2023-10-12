@extends('template/sidakv2/layout.app')
@section('content')

<style>
	.dataTables_wrapper .dataTables_paginate .paginate_button {
		border: 1px solid #1f3897;
		display: inline;
		padding: 0.5em 0.8em;
		color: #1f3897;
		border-radius: 10px;
		font-weight: bold;
		cursor: pointer;
		height: 35px;
		width: 33px;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button.previous {
		border: 1px solid #1f3897;
		color: #1f3897;
		border-radius: 10px;
		font-weight: bold;
		cursor: pointer;
		height: 35px;
		width: 33px;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button.next {
		border: 1px solid #1f3897;
		color: #1f3897;
		border-radius: 10px;
		font-weight: bold;
		cursor: pointer;
		height: 35px;
		width: 33px;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button.current {
		background: #0e298f;
		border-color: #0e298f;
		color: #fff !important;
	}



	tbody td.dt-body-second {
		padding: 9px 0px 9px 30px !important;
	}

	thead th.dt-head-second {
		padding: 9px 0px 9px 30px !important;
	}

	table.dataTable thead th,
	table.dataTable thead td {
		padding: 10px 18px;
		border-bottom: 2px solid #f4f4f4;

	}

	table.dataTable tbody th,
	table.dataTable tbody td {
		border-bottom: 1px solid #f4f4f4;

	}
</style>
</script>


<section class="content-header pd-left-right-15">
	<div class="form-group row">
		<div class="col-sm-3">
			<label>Jenis </label>
			<select class="form-control" name="jenis_sub" id="jenis_sub">
				<option value="">-Pilih Tipe-</option>
				<option value="is_tenaga_pendamping">Tenaga Pendamping</option>
				<option value="is_bimtek_ipbbr">Bimtek Implementasi Perizinan Berusaha Berbasis Resiko</option>
				<option value="is_bimtek_ippbbr">Bimtek Implementasi Pengawasan Perizinan Berusaha Berbasis Resiko</option>
			</select>
		</div>
		<div class="col-sm-3">
			<label>Periode </label>
			<select id="periode_id2" class="select-periode2 form-control" name="periode_id2"></select>
		</div>
		<div class="col-sm-3">
			<label>Search</label>
			<div class="input-group input-group-sm border-radius-20">
				<input type="text" id="search-input" placeholder="Cari" class="form-control height-35 border-radius-left">
				<span class="input-group-btn">
					<button id="Search" type="button" class="btn btn-search btn-flat height-35"><i class="fa fa-search"></i></button>
					<button id="Clear" type="button" class="btn btn-search btn-flat height-35 border-radius-right"><i class="fa fa-times-circle"></i></button>
				</span>

			</div>
		</div>
	</div>
	<div class="col-sm-4 pull-left padding-default full dataTables_wrapper">
		<div class="width-50 pull-left">
			<div class="pull-left padding-9-0 margin-left-button">

				<select id="row_page" class="selectpicker" data-style="btn-default">
					<option value="10" selected>10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="-1">All</option>
				</select>
			</div>
			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button" id="delete-selected" class="btn btn-danger border-radius-10">
					Hapus
				</button>
				<!-- <button type="button" class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-search"></i> Search
				</button> -->
				<button id="tambah" type="button" class="btn btn-primary border-radius-10 modal-add" data-toggle="modal" data-target="#modal-add">
					Tambah Data
				</button>
				<button type="button" class="btn btn-info border-radius-10" id="exportData">
				</button>
			</div>


		</div>
		<div class="pull-right width-50 ">
			<div id="datatable_paginate" class="dataTables_paginate paging_simple_numbers"></div>
		</div>
	</div>
</section>

<div class="content">
	<div class="clearfix"></div>
	<div class="clearfix"></div>

	<div class="box box-solid box-primary">
		<div class="box-body">
			<div class="card-body table-responsive p-0">
				<table id="datatable" class="table-hover text-nowrap">
					<thead>
						<tr>
							<th><input type="checkbox" id="checkAll"></th>
							<th><span class="border-left-table">Nama Kegiatan </span> </th>
							<th><span class="border-left-table">Sub Menu </span> </th>
							<th><span class="border-left-table">Tanggal Kegiatan </span></th>
							<th><span class="border-left-table">Lokasi </span></th>
							<th><span class="border-left-table">Biaya </span></th>
							<th><span class="border-left-table">Status </span></th>
							<th><span class="border-left-table"> Aksi </span> </th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('template/sidakv2/bimsos.add')
<!-- Import Excel -->

@stop

@push('scripts')
<script>
	var search = '';
	hasil_sum(search);

	function hasil_sum(search) {
		if (search !== "")
			var filter = JSON.stringify(search);
		$.ajax({
			url: BASE_URL + '/api/pagutarget/total_pagu',
			method: 'POST',
			data: {
				data: filter
			},
			dataType: 'json',
			success: function(result) {
				$('#total_apbn').html(result.total_apbn);
				$('#total_promosi').html(result.total_promosi);
				$('#total_all').html(result.total_all);
			},
			error: function(error) {
				console.error(error);
			}
		});
	}

	$(function() {

		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: BASE_URL + '/api/bimsos/datalist',
			fixedHeader: {
				header: true,
				footer: true
			},
			language: {
				'paginate': {
					'previous': '<span >«</span>',
					'next': '<span >»</span>'
				}
			},
			buttons: [{
				extend: 'excel',
				text: 'Export excel',
				exportOptions: {
					format: {
						body: function(data, row, column, node) {
							return reformatNumber(data, row, column, node);
						}
					}
				}
			}],
			dom: 'Bprti',
			scrollCollapse: true,
			scrollX: true,
			scrollY: 500,
			columnDefs: [{
					'targets': 0,
					'searchable': false,
					'orderable': false,
					'className': 'dt-body-center',
					'render': function(data, type, full, meta) {
						return '<input type="checkbox" class="item-checkbox" name="idsData" data-id="' + $('<div/>').text(data).html() + '" value="' + $('<div/>').text(data).html() + '">';
					}
				},
				{
					targets: [5],
					className: 'dt-body-right'
				},
				{
					targets: [3],
					className: 'dt-body-center'
				}
			],
			order: [
				[1, 'asc']
			],
			initComplete: (settings, json) => {
				$('.dataTables_paginate').appendTo('#datatable_paginate');
			}
		});

		function reformatNumber(data, row, column, node) {
			// replace spaces with nothing; replace commas with points.
			if (column == 4 || column == 5 || column == 6) {
				var newData = data.replace('Rp ', '').replaceAll('.', '');
				return newData;
			} else if (column != 0 && column != 11) {
				return data;
			}
		}

		table.buttons(0, null).containers().appendTo('#exportData');

		function delay(callback, ms) {
			var timer = 0;
			return function() {
				var context = this,
					args = arguments;
				clearTimeout(timer);
				timer = setTimeout(function() {
					callback.apply(context, args);
				}, ms || 0);
			};
		}

		$('.select-periode2').select2(
			$.ajax({
				url: BASE_URL + '/api/select-periode-semester',
				method: 'get',
				dataType: 'json',
				success: function(data) {
					periode = '<option value="">- Pilih -</option>';
					$.each(data.periode, function(key, val) {
						var select = '';
						if (data.tahunSemester == val.value)
							select = 'selected';
						periode += '<option value="' + val.value + '" ' + select + '>' + val.text + '</option>';

					});
					$('#periode_id2').html(periode);
				}
			})
		);

		$('.select-periode-mdl').select2(
			$.ajax({
				url: BASE_URL + '/api/select-periode-semester',
				method: 'get',
				dataType: 'json',
				success: function(data) {
					periode = '<option value="">- Pilih -</option>';
					$.each(data.periode, function(key, val) {
						var select = '';
						if (data.tahunSemester == val.value)
							select = 'selected';
						periode += '<option value="' + val.value + '" ' + select + '>' + val.text + '</option>';

					});
					$('#periode_id_mdl').html(periode);
				}
			})
		);

		$('#search-input').keyup(delay(function(e) {
			var filter = [{
				search_input: $("#search-input").val(),
				jenis_sub: $("#jenis_sub").val(),
				periode_id: $("#periode_id2").val()
			}, ];
			table.search(this.value).draw();
			hasil_sum(filter);
		}, 1000));

		$("#Search").on("click", function() {
			var filter = [{
				search_input: $("#search-input").val(),
				jenis_sub: $("#jenis_sub").val(),
				periode_id: $("#periode_id2").val()
			}, ];

			//var email = $("#email").val();
			//filter = filter[0];
			hasil_sum(filter);
			table.column(0).search(JSON.stringify(filter), true, true);
			table.draw();
		});


		$("#datatable").on("click", "#Destroy", (e) => {
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

		function deleteItem(id) {
			$.ajax({
				url: BASE_URL + `/api/bimsos/` + id,
				method: 'DELETE',
				success: function(response) {
					table.search("").columns().search("").draw();
				},
				error: function(error) {
					console.error('Error deleting items:', error);
				}
			});
		}

		$('#delete-selected').on('click', function() {
			const selectedIds = [];
			Swal.fire({
				title: 'Apakah anda yakin hapus?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya'
			}).then((result) => {
				if (result.isConfirmed) {
					$('.item-checkbox:checked').each(function() {
						selectedIds.push($(this).data('id'));
					});
					deleteItems(selectedIds);
					Swal.fire(
						'Deleted!',
						'Data berhasil dihapus.',
						'success'
					);
				}
			});
		});

		function deleteItems(ids) {
			$.ajax({
				url: BASE_URL + `/api/bimsos/selected`,
				method: 'POST',
				data: {
					data: ids
				},
				success: function(response) {
					table.search("").columns().search("").draw();
				},
				error: function(error) {
					console.error('Error deleting items:', error);
				}
			});
		}

		$("#Clear").on("click", function() {

			var filter = '';
			$("#jenis_sub").val("").trigger("change");
			$("#periode_id2").val("").trigger("change");
			$("#search-input").val("");

			hasil_sum(filter);
			table.search("").columns().search("").draw();
		});

		$('#row_page').on('change', function() {
			table.page.len(this.value).draw();
		});


		$("#checkAll").click(function() {
			$('input:checkbox').not(this).prop('checked', this.checked);
		});

		// Handle click on checkbox to set state of "Select all" control
		$('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
			// If checkbox is not checked
			if (!this.checked) {
				var el = $('#checkAll').get(0);
				// If "Select all" control is checked and has 'indeterminate' property
				if (el && el.checked && ('indeterminate' in el)) {
					// Set visual state of "Select all" control
					// as 'indeterminate'
					el.indeterminate = true;
				}
			}
		});

	});
</script>
@endpush