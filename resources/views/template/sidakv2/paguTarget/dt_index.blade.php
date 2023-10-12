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
	<div class="row">
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="box box-solid box-primary ">
				<div class="box-body btn-primary border-radius-13">
					<div class="card-body table-responsive p-0">
						<div class="media">
							<div class="media-body text-left">
								<span>Pagu APBN</span>
								<h3 class="card-text" id="total_apbn"></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="box box-solid box-primary">
				<div class="box-body btn-primary border-radius-13">
					<div class="card-body table-responsive p-0">
						<div class="media">
							<div class="media-body text-left">
								<span>Pagu Promosi</span>
								<h3 class="card-text" id="total_promosi"></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12">
			<div class="box box-solid box-primary">
				<div class="box-body btn-primary border-radius-13">
					<div class="card-body table-responsive p-0">
						<div class="media">
							<div class="media-body text-left">
								<span>Pagu Total</span>
								<h3 class="card-text" id="total_all"></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-3">
			<label>Tipe</label>
			<select class="form-control" name="type_daerah2" id="type_daerah2">
				<option value="">-Pilih Tipe-</option>
				<option value="Provinsi">Provinsi</option>
				<option value="Kabupaten">Kabupaten</option>
			</select>
		</div>
		<div class="col-sm-3">
			<label>Daerah </label>
			<select id="daerah_id2" class="select-daerah2 form-control" name="daerah_id2" disabled>
				<option value="">Pilih</option>
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

				<select id="row_page" class="selectpicker" data-style="bg-navy">
					<option value="10" selected>10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="-1">All</option>
				</select>
			</div>
			<<<<<<< HEAD <div class="pull-left padding-9-0 margin-left-button">
				=======
				<div class="pull-left padding-9-0 margin-left-button">
					>>>>>>> 1149d26f9b0aeb88e0b57516f742751ac86fa517
					<button type="button" id="delete-selected" class="btn btn-danger border-radius-10">
						Hapus
					</button>
					<!-- <button type="button" class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-search"></i> Search
				</button> -->
					<button id="ShowAdd" style="display:none;" type="button" class="btn btn-primary border-radius-10 modal-add" data-toggle="modal" data-target="#modal-add">
						Tambah Data
					</button>
					<<<<<<< HEAD <button type="button" class="btn btn-warning border-radius-10" data-toggle="modal" data-target="#modal-import">
						IMPORT EXCEL
						</button>
						<button id="ShowExport" type="button" class="btn btn-info border-radius-10">

							=======
							<button type="button" class="btn btn-warning border-radius-10" data-toggle="modal" data-target="#modal-import">
								IMPORT EXCEL
							</button>
							<button id="ShowExport" type="button" class="btn btn-info border-radius-10">

								>>>>>>> 1149d26f9b0aeb88e0b57516f742751ac86fa517
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

							<th rowspan="2">
								<input type="checkbox" id="checkAll">

							</th>
							<th rowspan="2">
								<div class="split-table"></div> <span class="span-title">Nama Daerah </span>
							</th>
							<<<<<<< HEAD=======<th rowspan="2">
								<div class="split-table"></div> <span class="span-title">Nama Daerah </span> </th>
								>>>>>>> 1149d26f9b0aeb88e0b57516f742751ac86fa517
								<th rowspan="2"><span class="border-left-table">Type </span> </th>
								<th rowspan="2"><span class="border-left-table">Periode </span></th>
								<th colspan="3" class="dt-head-center">Pagu</th>
								<th colspan="4" class="dt-head-center border-left-table">Target</th>
								<th rowspan="2"><span class="border-left-table"> Aksi </span> </th>
						</tr>
						<tr>
							<th><span class="border-left-table"> APBN (Rp) </span> </th>
							<th><span class="border-left-table"> Promosi (Rp) </span> </th>
							<th><span class="border-left-table"> Dalak (Rp) </span> </th>
							<th class="border-left-table"> Pengawasan </th>
							<th><span class="border-left-table"> Penyelesaian Permasalahan </span> </th>
							<th><span class="border-left-table"> Bimbingan Teknis </span> </th>
							<th><span class="border-left-table"> Video Promosi </span> </th>
						</tr>

					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
@include('template/sidakv2/paguTarget.add')
@include('template/sidakv2/paguTarget.import')
<!-- Import Excel -->
<!-- <div id="importExcel" class="modal fade" role="dialog">

	<div class="modal-dialog" role="document">
		<form method="post" action="/api/pagutarget/import_excel" id="file-upload" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
				</div>
				<div class="modal-body">

					{{ csrf_field() }}

					<label>Pilih file excel</label>
					<div class="form-group">
						<input type="file" name="file" required="required">
						<span class="text-danger" id="file-input-error"></span>
					</div>
					<a class="btn btn-warning" href="/api/pagutarget/download_file">Template data</a>
					<a class="btn btn-info" href="/api/pagutarget/download_daerah">data wilayah</a>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Import</button>
				</div>
				<div class="form-group">
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div> -->
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

	// $('#file-upload').submit(function(e) {
	// 	e.preventDefault();
	// 	let formData = new FormData(this);
	// 	$('#file-input-error').text('');

	// 	$.ajax({
	// 		type: 'POST',
	// 		url: BASE_URL + '/api/pagutarget/import_excel',
	// 		data: formData,
	// 		contentType: false,
	// 		processData: false,
	// 		success: (response) => {
	// 			Swal.fire({
	// 				title: 'Sukses!',
	// 				text: 'Berhasil Disimpan',
	// 				icon: 'success',
	// 				confirmButtonText: 'OK'

	// 			}).then((result) => {
	// 				if (result.isConfirmed) {
	// 					// User clicked "Yes, proceed!" button
	// 					window.location.replace('/pagutarget');
	// 				}
	// 			});
	// 		},
	// 		error: function(response) {
	// 			$('#file-input-error').text(response.responseJSON.errors.file);
	// 		}
	// 	});
	// });

	$(function() {

		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: BASE_URL + '/api/pagutarget/datalist',
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
				text: 'EXPORT EXCEL',
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
					targets: [4, 5, 6],
					className: 'dt-body-right'
				},
				{
					targets: [2, 3, 7, 8, 9, 10],
					className: 'dt-body-center'
				}
			],
			order: [
				[1, 'asc']
			],
			initComplete: (settings, json) => {

				$('.dataTables_paginate').appendTo('#datatable_paginate');
				listOptions(json.options);
			}
		});

		<<
		<< << < HEAD

		function listOptions(data) {

			data.forEach(function(item, index) {
				if (item.action == 'create') {
					if (item.checked == true) {
						$('#ShowAdd').show();
						$('#ShowImport').show();
					} else {
						$('#ShowAdd').hide();
						$('#ShowImport').hide();
					}
				}







			});
		} ===
		=== =
		function listOptions(data) {

			data.forEach(function(item, index) {
				if (item.action == 'create') {
					if (item.checked == true) {
						$('#ShowAdd').show();
						$('#ShowImport').show();
					} else {
						$('#ShowAdd').hide();
						$('#ShowImport').hide();
					}
				}







			});
		} >>>
		>>> > 1149 d26f9b0aeb88e0b57516f742751ac86fa517

		function reformatNumber(data, row, column, node) {
			// replace spaces with nothing; replace commas with points.
			if (column == 4 || column == 5 || column == 6) {
				var newData = data.replace('Rp ', '').replaceAll('.', '');
				return newData;
			} else if (column != 0 && column != 11) {
				return data;
			}
		}

		table.buttons(0, null).containers().appendTo('#ShowExport');

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

		$('#type_daerah2').on('change', function() {
			let type_daerah = $('#type_daerah2').val();
			if (type_daerah == 'Provinsi') {
				url = "select-province";
			} else {
				url = "select-kabupaten";
			}
			$.ajax({
				url: BASE_URL + '/api/' + url,
				method: 'get',
				dataType: 'json',
				success: function(data) {
					jenis = '<option value="">- Pilih -</option>';
					$.each(data, function(key, val) {
						jenis += '<option value="' + val.value + '">' + val.text + '</option>';
					});
					$('#daerah_id2').html(jenis).removeAttr('disabled');
				}
			})
			$('.select-daerah2').select2();
		})

		$('.select-periode2').select2(
			$.ajax({
				url: BASE_URL + '/api/select-periode?type=GET&action=pagu',
				method: 'get',
				dataType: 'json',
				success: function(data) {
					periode = '<option value="">- Pilih -</option>';
					$.each(data.result, function(key, val) {
						periode += '<option value="' + val.value + '" >' + val.text + '</option>';

					});
					$('#periode_id2').html(periode);
				}
			})
		);

		$('#search-input').keyup(delay(function(e) {
			var filter = [{
				search_input: $("#search-input").val(),
				type_daerah: $("#type_daerah2").val(),
				daerah_id: $("#daerah_id2").val(),
				periode_id: $("#periode_id2").val()
			}, ];
			table.search(this.value).draw();
			hasil_sum(filter);
		}, 1000));

		$("#Search").on("click", function() {
			var filter = [{
				search_input: $("#search-input").val(),
				type_daerah: $("#type_daerah2").val(),
				daerah_id: $("#daerah_id2").val(),
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
				url: BASE_URL + `/api/pagutarget/` + id,
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
				url: BASE_URL + `/api/pagutarget/selected`,
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
			$("#type_daerah2").val("").trigger("change");
			$("#daerah_id2").val("").trigger("change");
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