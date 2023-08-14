@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
			<div class="pull-left padding-9-0 margin-left-button">
				<button type="button" disabled="disabled" class="btn btn-danger border-radius-10">
					Hapus
				</button>
			</div>
			<div class="pull-left padding-9-0">
				<button type="button" class="btn btn-primary border-radius-10" data-toggle="modal" data-target="#modal-add">
					Tambah Data
				</button>
			</div>
		</div>
	</div>
</section>

<div class="content">
	<div class="clearfix"></div>
	<div class="clearfix"></div>

	<div class="box box-solid box-primary">
		<div class="box-body">
			<div class="card-body table-responsive p-0">
				<table id="datatable" class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th class="">No </th>
							<th class=""><span class="border-left-table">Nama Perusahaan </span> </th>
							<th class=""><span class="border-left-table">kontak </span> </th>
							<th class=""><span class="border-left-table">Periode </span> </th>
							<th class=""><span class="border-left-table">NIB </span> </th>
							<th class=""><span class="border-left-table">Tanggal NIB </span> </th>
							<th class=""><span class="border-left-table">No Izin Lokasi </span> </th>
							<th class=""><span class="border-left-table">Tanggal Izin Lokasi </span> </th>
							<th class=""><span class="border-left-table">Total Rencana </span> </th>
							<th class=""><span class="border-left-table">Total Realisasi </span> </th>
							<th class=""><span class="border-left-table">Nama Kegiatan </span> </th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

@include('template/sidakv2/pengawasan.add')

@stop

@push('scripts')
<script>
	$(function() {
		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: BASE_URL + '/api/pengawasan/datalist',
			dom: "<'row'<'col-sm-6'l><'col-sm-6'p>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i>>",
			columnDefs: [{
				targets: [0],
				orderable: false,
			}],
		});
	});

    $(document).ready(function () {   
		
		$(".is_analisa").hide();
		$(".is_inspeksi").hide();
		$(".is_evaluasi").hide();

		$('#jenis_inp').change(function(){ 
			var value = $(this).val();
			if(value == 1) {
				$(".is_analisa").show();
				$(".is_inspeksi").hide();
				$(".is_evaluasi").hide();
			} else if (value == 2) {
				$(".is_analisa").hide();
				$(".is_inspeksi").show();
				$(".is_evaluasi").hide();
			} else if (value == 3) {
				$(".is_analisa").hide();
				$(".is_inspeksi").hide();
				$(".is_evaluasi").show();
			} else {
				$(".is_analisa").hide();
				$(".is_inspeksi").hide();
				$(".is_evaluasi").hide();
			}
		});
        
    })
</script>
@endpush