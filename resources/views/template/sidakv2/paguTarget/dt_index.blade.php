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
							<th class="border-right-table "> No </th>
							<th class="border-right-table "> Nama Daerah </th>
							<th class="border-right-table "> Type </th>
							<th class="border-right-table "> Periode </th>
							<th class="border-right-table "> Pagu APBN (Rp) </th>
							<th class="border-right-table "> Pagu Promosi (Rp) </th>
							<th class="border-right-table "> Target Pengawasan </th>
							<th class="border-right-table "> Target Penyelesaian Permasalahan </th>
							<th class="border-right-table "> Target Bimbingan Teknis </th>
							<th class="border-right-table "> Target Video Promosi </th>
							<th class="border-right-table "> Pagu Dalak </th>
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