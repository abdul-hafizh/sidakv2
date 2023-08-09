@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
			<div class="btn-group pull-left padding-9-0">
				<button type="button" disabled="disabled" class="btn btn-primary">
					<i class="fa fa-trash"></i> Delete
				</button>

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
					<i aria-hidden="true" class="fa fa-plus"></i> Add
				</button>
				<button type="button" class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-search"></i> Search
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
							<th class=""><span class="border-left-table">No </span> </th>
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
			processing: true,
			serverSide: true,
			ajax: BASE_URL + '/api/pagutarget/datalist',
			columns: [{
					data: 'id',
					name: 'id'
				},
				{
					data: 'nama_daerah',
					name: 'nama_daerah'
				},
				{
					data: 'type_daerah',
					name: 'type_daerah'
				},
				{
					data: 'periode_id',
					name: 'periode_id'
				},
				{
					data: 'pagu_apbn',
					name: 'pagu_apbn'
				},
				{
					data: 'pagu_promosi',
					name: 'pagu_promosi'
				},
				{
					data: 'target_pengawasan',
					name: 'target_pengawasan'
				},
				{
					data: 'target_penyelesaian_permasalahan',
					name: 'target_penyelesaian_permasalahan'
				},
				{
					data: 'target_bimbingan_teknis',
					name: 'target_bimbingan_teknis'
				},
				{
					data: 'target_video_promosi',
					name: 'target_video_promosi'
				},
				{
					data: 'pagu_dalak',
					name: 'pagu_dalak'
				}
			]
		});
	});
</script>
@endpush