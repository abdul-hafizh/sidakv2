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
</style>
</script>
<section class="content-header pd-left-right-15">
	<div class="col-sm-4 pull-left padding-default full dataTables_wrapper">
		<div class="width-50 pull-left">
			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled="disabled" class="btn btn-danger border-radius-10">
					Hapus
				</button>


				<!-- <button type="button" class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-search"></i> Search
				</button> -->
			</div>

			<div class="pull-left padding-9-0">
				<button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
					Tambah Data
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
							<th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
							<th class=""><span class="border-left-table">Nama Daerah </span> </th>
							<th class=""><span class="border-left-table">Type </span> </th>
							<th class=""><span class="border-left-table">Periode </span> </th>
							<th class=""><span class="border-left-table">Pagu APBN (Rp) </span> </th>
							<th class=""><span class="border-left-table">Pagu Promosi (Rp) </span> </th>
							<th class=""><span class="border-left-table">Target Pengawasan </span> </th>
							<th class=""><span class="border-left-table">Target Penyelesaian Permasalahan </span> </th>
							<th class=""><span class="border-left-table">Target Bimbingan Teknis </span> </th>
							<th class=""><span class="border-left-table">Target Video Promosi </span> </th>
							<th class=""><span class="border-left-table">Pagu Dalak </span> </th>
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
					targets: "_all",
					className: 'dt-body-second'
				}
			],
			order: [
				[1, 'asc']
			],
			initComplete: (settings, json) => {
				$('.dataTables_paginate').appendTo('#datatable_paginate');
			}
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