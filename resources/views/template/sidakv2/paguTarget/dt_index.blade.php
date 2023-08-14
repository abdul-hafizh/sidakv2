@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
	<div class="col-sm-4 pull-left padding-default full">
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
		$('#datatable').DataTable({
			alert('asd');
			processing: true,
			serverSide: true,
			ajax: BASE_URL + '/api/pagutarget/datalist',
			dom: "<'row'<'col-sm-6'l><'col-sm-6'p>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i>>",
			columnDefs: [{
				targets: [0],
				orderable: false,
			}],
		});
	});
</script>
@endpush