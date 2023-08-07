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

		<div class="pull-right width-50">
			{!! $paginate !!}
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
							<th><input type="checkbox"></th>
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
							<th> Options </th>
						</tr>
					</thead>

					<tbody>
						@foreach($result as $index => $item)
						<tr>
							<td><input type="checkbox" number="" value="4"></td>
							<td>{{ $item->number }}</td>
							<td>{{ $item->nama_daerah }}</td>
							<td>{{ $item->type_daerah }}</td>
							<td>{{ $item->periode_id }}</td>
							<td>{{ $item->pagu_apbn }}</td>
							<td>{{ $item->pagu_promosi }}</td>
							<td>{{ $item->target_pengawasan }}</td>
							<td>{{ $item->target_penyelesaian_permasalahan }}</td>
							<td>{{ $item->target_bimbingan_teknis }}</td>
							<td>{{ $item->target_video_promosi }}</td>
							<td>{{ $item->pagu_dalak }}</td>
							<td>
								<div class="btn-group">
									<button type="button" data-toggle="modal" data-target="#modal-edit-{{ $index }}" class="btn btn-primary">
										<i aria-hidden="true" class="fa fa-pencil"></i>
									</button>

									<button type="button" class="btn btn-primary">
										<i aria-hidden="true" class="fa fa-trash"></i>
									</button>
								</div>
							</td>
						</tr>

						@endforeach


					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('template/sidakv2/paguTarget.add')

@stop