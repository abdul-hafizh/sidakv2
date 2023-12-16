@extends('template/sidakv2/layout.app')
@section('content')
<style>
	.inner {
		max-height: 200px !important;
	}

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

<section class="content-header pd-left-right-15">

	<div class="row">
		<div class="col-md-12" id="header">
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4" style="margin-bottom: 9px;">
			<select class="form-control height-35 border-radius-13" data-style="btn-default" name="periode_id2" id="periode_id2" title="Pilih Periode" data-live-search="true">
				<option value="">Pilih Periode</option>
			</select>
		</div>
		@if($access =='admin' || $access == 'pusat' )
		<div class="col-sm-3" id="daerah-search" style="margin-bottom: 9px;">
			<select class="selectpicker" data-style="btn-default" name="daerah_id" id="daerah_id" title="Pilih Provinsi/Kabupaten" data-live-search="true">
				<option value="">Pilih Daerah</option>
			</select>
		</div>
		@else
		<input type="hidden" class="form-control" name="daerah_id" id="daerah_id" value="">
		@endif
		<div class="col-sm-3" style="margin-bottom: 9px;">
			<select class="selectpicker" data-style="btn-default" name="jenis_sub" id="jenis_sub">
				<option value="">Pilih Jenis Kegiatan</option>
				<option value="identifikasi">Identifikasi Penyelesaian</option>
				<option value="penyelesaian">Penyelesaian Masalah</option>
				<option value="evaluasi">Evaluasi Penyelesaian</option>
			</select>
		</div>
		<div class="col-sm-2" style="margin-bottom: 9px;">
			<select class="selectpicker" name="search_status" id="search_status">
				<option value="">Pilih Status</option>
				<option value="13">Draft</option>
				<option value="15">Request Edit</option>
				<option value="14">Terkirim</option>
				<option value="13">Perlu Perbaikan</option>
			</select>
		</div>
		<div class="col-sm-2" style="margin-bottom: 9px;">
			<input type="text" id="search-input" placeholder="Cari" class="form-control border-radius-13">
		</div>
		<div class="col-lg-2">
			<div class="btn-group">
				<button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
				<button id="Clear" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
			</div>
		</div>
	</div>

	<div class="col-sm-4 pull-left padding-default full dataTables_wrapper">
		<div class="width-50 pull-left">
			<div class="pull-left padding-9-0 margin-left-button">
				<select id="row_page" class="selectpicker" data-style="btn-default bg-navy">
					<option value="10" selected>10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="-1">All</option>
				</select>
			</div>
			<div class="pull-left padding-9-0 margin-left-button">
				@if($access =='daerah' || $access == 'province' )
				<button type="button" id="delete-selected" class="btn btn-danger border-radius-10">
					Hapus
				</button>
				<button id="tambah" style="display:none;" type="button" class="btn btn-primary border-radius-10 modal-add" data-toggle="modal" data-target="#modal-add">
					Tambah Data
				</button>
				@endif
				<button type="button" class="btn btn-info border-radius-10" id="exportData"></button>
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
				<table id="datatable" class="table-hover" style="height: auto">
					<thead>
						<tr>
							<th><input type="checkbox" id="checkAll"></th>
							<th><span class="border-left-table">Nama Daerah </span> </th>
							<th><span class="border-left-table">Nama Kegiatan </span> </th>
							<th><span class="border-left-table">Sub Kegiatan </span> </th>
							<th><span class="border-left-table">Tanggal Kegiatan </span></th>
							<th><span class="border-left-table">Lokasi </span></th>
							<th><span class="border-left-table">Biaya </span></th>
							<th><span class="border-left-table">Status </span></th>
							<th><span class="border-left-table">Aksi </span> </th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

@include('template/sidakv2/penyelesaian.add')
@stop
@push('scripts')

<script>
	$(function() {

		var search = '';
		hasil_header(search);

		function hasil_header(search) {
			if (search !== "")
				var filter = JSON.stringify(search);
			$.ajax({
				url: BASE_URL + '/api/penyelesaian/header',
				method: 'POST',
				data: {
					data: filter
				},
				dataType: 'json',
				success: function(result) {
					if (result.user == 'daerah' || result.user == 'province') {
						if (result.semester == '01') {
							var table_header = `<table class="table box box-solid box-primary">
						<thead>
							<tr>
								<th rowspan="2">Sub Kegiatan</th>
								<th colspan="2" style="text-align: center">Perencanaan Tahun ${result.tahun}</th>
								<th colspan="2" style="text-align: center">Realisasi Semester 1</th>
							</tr>
							<tr>
								<th style="text-align: center">Target</th>
								<th style="text-align: center">Nilai</th>
								<th style="text-align: center">Target</th>
								<th style="text-align: center">Nilai</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Identifikasi</td>
								<td style="text-align: center"><span >${result.data[0].identifikasi_rencana_target_peserta}</span></td>
								<td style="text-align: right"><span >${formatRupiah(result.data[0].identifikasi_rencana)}</span></td>
								<td style="text-align: center"><span >${result.data[0].identifikasi_realisasi_target_peserta}</span></td>
								<td style="text-align: right"><span >${formatRupiah(result.data[0].identifikasi_realisasi)}</span></td>
							</tr>
							<tr>
								<td>Penyelesaian Masalah</td>
								<td style="text-align: center"><span>${result.data[0].penyelesaian_rencana_target_peserta}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].penyelesaian_realisasi_rencana)}</span></td>
								<td style="text-align: center"><span>${result.data[0].penyelesaian_realisasi_target_peserta}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].realisasi_realisasi)}</span></td>
							</tr>
							<tr>
								<td>Evaluasi</td>
								<td style="text-align: center"><span>${result.data[0].evaluasi_rencanan_target}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].evaluasi_rencana)}</span></td>
								<td style="text-align: center"><span>${result.data[0].evaluasi_realisasi_target}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].evaluasi_realisasi)}</span></td>
							</tr>
							<tr>
								<th>Total</th>
								<th style="text-align: center"><span>${result.data[0].identifikasi_rencana_target_peserta+result.data[0].penyelesaian_rencana_target_peserta+result.data[0].evaluasi_rencanan_target}</span></th>
								<th style="text-align: right"><span>${formatRupiah(result.data[0].identifikasi_rencana+result.data[0].penyelesaian_realisasi_rencana+result.data[0].evaluasi_rencana)}</span></th>
								<th style="text-align: center"><span>${result.data[0].identifikasi_realisasi_target_peserta+result.data[0].penyelesaian_realisasi_target_peserta+result.data[0].evaluasi_realisasi_target}</span></th>
								<th style="text-align: right"><span>${formatRupiah(result.data[0].identifikasi_realisasi+result.data[0].realisasi_realisasi+result.data[0].evaluasi_realisasi)}</span></th>
							</tr>
						</tbody>
					</table>`;
						} else {
							var table_header = `<table class="table box box-solid box-primary">
						<thead>
							<tr>
								<th rowspan="2">Sub Kegiatan</th>
								<th colspan="2" style="text-align: center">Perencanaan Tahun ${result.tahun}</th>
								<th colspan="2" style="text-align: center">Realisasi Semester 1</th>
								<th colspan="2" style="text-align: center">Realisasi Semester 2</th>
								<th colspan="2" style="text-align: center">Total Realisasi</th>
							</tr>
							<tr>
								<th style="text-align: center">Target</th>
								<th style="text-align: center">Nilai</th>
								<th style="text-align: center">Target</th>
								<th style="text-align: center">Nilai</th>
								<th style="text-align: center">Target</th>
								<th style="text-align: center">Nilai</th>
								<th style="text-align: center">Target</th>
								<th style="text-align: center">Nilai</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Identifikasi</td>
								<td style="text-align: center"><span >${result.data[0].identifikasi_rencana_target_peserta}</span></td>
								<td style="text-align: right"><span >${formatRupiah(result.data[0].identifikasi_rencana)}</span></td>
								<td style="text-align: center"><span >${result.data[0].identifikasi_realisasi_target_peserta}</span></td>
								<td style="text-align: right"><span >${formatRupiah(result.data[0].identifikasi_realisasi)}</span></td>
								<td style="text-align: center">${result.data[0].identifikasi_realisasi_target_peserta_2}</td>
								<td style="text-align: right">${formatRupiah(result.data[0].identifikasi_realisasi_2)}</td>
								<td style="text-align: center"><span >${result.data[0].identifikasi_realisasi_target_peserta_total}</span></td>
								<td style="text-align: right"><span >${formatRupiah(result.data[0].identifikasi_realisasi_2_total)}</span></td>
							</tr>
							<tr>
								<td>Penyelesaian Masalah</td>
								<td style="text-align: center"><span>${result.data[0].penyelesaian_rencana_target_peserta}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].penyelesaian_realisasi_rencana)}</span></td>
								<td style="text-align: center"><span>${result.data[0].penyelesaian_realisasi_target_peserta}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].realisasi_realisasi)}</span></td>
								<td style="text-align: center">${result.data[0].penyelesaian_realisasi_target_peserta_2}</td>
								<td style="text-align: right">${formatRupiah(result.data[0].realisasi_realisasi_2)}</td>
								<td style="text-align: center"><span>${result.data[0].penyelesaian_realisasi_target_peserta_total}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].realisasi_realisasi_total)}</span></td>
							</tr>
							<tr>
								<td>Evaluasi</td>
								<td style="text-align: center"><span>${result.data[0].evaluasi_rencanan_target}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].evaluasi_rencana)}</span></td>
								<td style="text-align: center"><span>${result.data[0].evaluasi_realisasi_target}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].evaluasi_realisasi)}</span></td>
								<td style="text-align: center">${result.data[0].evaluasi_realisasi_target_2}</td>
								<td style="text-align: right">${formatRupiah(result.data[0].evaluasi_realisasi_2)}</td>
								<td style="text-align: center"><span>${result.data[0].evaluasi_realisasi_target_total}</span></td>
								<td style="text-align: right"><span>${formatRupiah(result.data[0].evaluasi_realisasi_total)}</span></td>
							</tr>
							<tr>
								<th>Total</th>
								<th style="text-align: center"><span>${result.data[0].identifikasi_rencana_target_peserta+result.data[0].penyelesaian_rencana_target_peserta+result.data[0].evaluasi_rencanan_target}</span></th>
								<th style="text-align: right"><span>${formatRupiah(result.data[0].identifikasi_rencana+result.data[0].penyelesaian_realisasi_rencana+result.data[0].evaluasi_rencana)}</span></th>
								<th style="text-align: center"><span>${result.data[0].identifikasi_realisasi_target_peserta+result.data[0].penyelesaian_realisasi_target_peserta+result.data[0].evaluasi_realisasi_target}</span></th>
								<th style="text-align: right"><span>${formatRupiah(result.data[0].identifikasi_realisasi+result.data[0].realisasi_realisasi+result.data[0].evaluasi_realisasi)}</span></th>
								<th style="text-align: center">${result.data[0].identifikasi_realisasi_target_peserta_2+result.data[0].penyelesaian_realisasi_target_peserta_2+result.data[0].evaluasi_realisasi_target_2}</th>
								<th style="text-align: right">${formatRupiah(result.data[0].identifikasi_realisasi_2+result.data[0].realisasi_realisasi_2+result.data[0].evaluasi_realisasi_2)}</th>
								<th style="text-align: center"><span>${result.data[0].identifikasi_realisasi_target_peserta_total+result.data[0].penyelesaian_realisasi_target_peserta_total+result.data[0].evaluasi_realisasi_target_total}</span></th>
								<th style="text-align: right"><span>${formatRupiah(result.data[0].identifikasi_realisasi_2_total+result.data[0].realisasi_realisasi_total+result.data[0].evaluasi_realisasi_total)}</span></th>
							</tr>
						</tbody>
					</table>`;
						}

						$('#header').html(table_header);
					}
				},
				error: function(error) {
					console.error(error);
				}
			});
		}

		function formatRupiah(data) {
			var new_data = accounting.formatNumber(data, 0, ".", ".");
			return 'Rp ' + new_data;

		}

		$('.semester2').hide();

		var year = new Date().getFullYear();
		var month = new Date().getMonth() + 1;

		$.ajax({
			url: BASE_URL + '/api/select-daerah',
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				$.each(data, function(index, option) {
					$('#daerah_id').append($('<option>', {
						value: option.value,
						text: option.text
					}));
				});
				$('#daerah_id').selectpicker('refresh');
			},
			error: function(error) {
				console.error(error);
			}
		})

		$.ajax({
			url: BASE_URL + '/api/select-periode-semester',
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				if (month) {

				}
				periode = '<option value="">Pilih Periode</option>';
				$.each(data.periode, function(key, val) {
					var select = '';
					if (data.tahunSemester == val.value) {
						select = 'selected';
					}
					periode += '<option value="' + val.value + '" ' + select + '>' + val.text + '</option>';

				});
				$('#periode_id2').html(periode);
			}
		})


		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: BASE_URL + '/api/penyelesaian/datalist',
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
				text: 'Export Excel',
				exportOptions: {
					format: {
						body: function(data, row, column, node) {
							return reformatNumber(data, row, column, node);
						}
					},
					columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
						if (full[7] == 'Terkirim') {
							return '<input disabled type="checkbox">'
						} else {
							return '<input type="checkbox" class="item-checkbox" name="idsData" data-id="' + $('<div/>').text(data).html() + '" value="' + $('<div/>').text(data).html() + '">';
						}
					}
				},
				{
					targets: [6],
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
				listOptions(json.options);
			}
		});

		function listOptions(data) {

			data.forEach(function(item, index) {
				if (item.action == 'create') {
					if (item.checked == true) {
						$('#tambah').show();

					} else {
						$('#tambah').hide();

					}
				}

			});
		}

		function reformatNumber(data, row, column, node) {
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

		$('.select-periode-mdl').select2(
			$.ajax({
				url: BASE_URL + '/api/select-periode-semester',
				method: 'GET',
				dataType: 'json',
				success: function(data) {
					periode = '<option value="">Pilih Periode</option>';
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
				daerah_id: $("#daerah_id").val(),
				search_status: $("#search_status").val(),
				search_status_text: $("#search_status option:selected").text(),
				periode_id: $("#periode_id2").val()
			}, ];
			hasil_header(filter);
			table.search(this.value).draw();
		}, 1000));

		$("#Search").on("click", function() {
			var filter = [{
				search_input: $("#search-input").val(),
				jenis_sub: $("#jenis_sub").val(),
				daerah_id: $("#daerah_id").val(),
				search_status: $("#search_status").val(),
				search_status_text: $("#search_status option:selected").text(),
				periode_id: $("#periode_id2").val()
			}, ];
			hasil_header(filter);
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
				url: BASE_URL + `/api/penyelesaian/` + id,
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
				url: BASE_URL + `/api/penyelesaian/selected`,
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
			$("#daerah_id").val("").trigger("change");
			$("#search_status").val("").trigger("change");
			$("#periode_id2").val("").trigger("change");
			$("#search-input").val("");
			hasil_header(filter);
			table.search("").columns().search("").draw();
		});

		$('#row_page').on('change', function() {
			table.page.len(this.value).draw();
		});

		$("#checkAll").click(function() {
			var nonDisabledCheckboxes = $('.item-checkbox:not(:disabled)');
			nonDisabledCheckboxes.prop('checked', $(this).is(':checked'));
		});

		$('#datatable tbody').on('change', 'input[type="checkbox"]', function() {
			if (!this.checked) {
				var el = $('#checkAll').get(0);
				if (el && el.checked && ('indeterminate' in el)) {
					el.indeterminate = true;
				}
			}
		});
	});
</script>
@endpush