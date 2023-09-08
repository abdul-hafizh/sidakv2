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
</style>
</script>
<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form method="post" action="/api/pagutarget/import_excel" id="file-upload" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
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
</div>

<section class="content-header pd-left-right-15">
	<div class="width-50 pull-left">
		<div class="box box-solid box-primary">
			<div class="box-body">
				<div class="card-body table-responsive p-0">
					<table id="table_sum" class="table-hover text-nowrap ">
						<thead>
							<tr>
								<th class="dt-head-second"><span class="border-left-table">Pagu APBN </span> </th>
								<th class="dt-head-second"><span class="border-left-table">Pagu Promosi </span> </th>
								<th class="dt-head-second"><span class="border-left-table">Pagu Total </span> </th>
							</tr>
						</thead>
						<tbody id="hasil_sum">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="pull-right width-25">
		<div class="col-sm-4 pull-left padding-default full margin-top-bottom-20">
			<div class="input-group input-group-sm border-radius-20">
				<input type="text" id="search-input" placeholder="Cari" class="form-control height-35 border-radius-left">
				<span class="input-group-btn">
					<button id="Search" type="button" class="btn btn-search btn-flat height-35 border-radius-right"><i class="fa fa-search"></i></button>
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
				<button type="button" disabled="disabled" class="btn btn-danger border-radius-10">
					Hapus
				</button>
				<!-- <button type="button" class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-search"></i> Search
				</button> -->
				<button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
					Tambah Data
				</button>
				<button type="button" class="btn btn-warning border-radius-10" data-toggle="modal" data-target="#importExcel">
					IMPORT EXCEL
				</button>
			</div>
			<div class="pull-left padding-9-0">
				<div id="exportData"></div>
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
							<th rowspan="2"><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
							<th rowspan="2"><span class="border-left-table">Nama Daerah </span> </th>
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

@stop

@push('scripts')
<script>
	var search = '';
	hasil_sum(search);

	function hasil_sum(search) {
		$.ajax({
			url: BASE_URL + '/api/pagutarget/total_pagu',
			method: 'POST',
			data: {
				data: search
			},
			dataType: 'json',
			success: function(result) {
				var data = '';
				data += '<tr><td class="dt-body-second" align="right">' + result.total_apbn + ' </td><td class="dt-body-second" align="right">' + result.total_promosi + '</td><td class="dt-body-second" align="right">' + result.total_all + ' </td></tr>'
				$('#hasil_sum').html(data);
			},
			error: function(error) {
				console.error(error);
			}
		});
	}

	$('#file-upload').submit(function(e) {
		e.preventDefault();
		let formData = new FormData(this);
		$('#file-input-error').text('');

		$.ajax({
			type: 'POST',
			url: BASE_URL + '/api/pagutarget/import_excel',
			data: formData,
			contentType: false,
			processData: false,
			success: (response) => {
				Swal.fire({
					title: 'Sukses!',
					text: 'Berhasil Disimpan',
					icon: 'success',
					confirmButtonText: 'OK'

				}).then((result) => {
					if (result.isConfirmed) {
						// User clicked "Yes, proceed!" button
						window.location.replace('/pagutarget');
					}
				});
			},
			error: function(response) {
				$('#file-input-error').text(response.responseJSON.errors.file);
			}
		});
	});

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
				text: 'Export excel',
				className: 'btn btn-info border-radius-10'
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
						return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
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
			}
		});

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

		$('#search-input').keyup(delay(function(e) {
			table.search(this.value).draw();
			hasil_sum(this.value);
		}, 1000));

		$('#row_page').on('change', function() {
			table.page.len(this.value).draw();
		});
		// Handle click on "Select all" control
		$('#example-select-all').on('click', function() {
			// Get all rows with search applied
			var rows = table.rows({
				'search': 'applied'
			}).nodes();
			// Check/uncheck checkboxes for all rows in the table
			$('input[type="checkbox"]', rows).prop('checked', this.checked);
		});

		// Handle click on checkbox to set state of "Select all" control
		$('#example tbody').on('change', 'input[type="checkbox"]', function() {
			// If checkbox is not checked
			if (!this.checked) {
				var el = $('#example-select-all').get(0);
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