@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">
	<div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
			<div class="btn-group pull-left padding-9-0">
				<button type="button" disabled="disabled" class="btn btn-primary">
					<i class="fa fa-trash"></i> Hapus
				</button>	
				<a href="{{ url('perencanaan/create') }}"  class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-plus"></i> Tambah
				</a> 
				<button type="button" class="btn btn-primary">
					<i aria-hidden="true" class="fa fa-search"></i> Cari
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
							<th class="border-right-table "> Periode </th>
							<th class="border-right-table "> Daerah </th>
							<th class="border-right-table "> Status </th> 
							<th class="border-right-table "> Tanggal </th>
							<th> Options </th>
						</tr>
					</thead>

					<tbody>
						@foreach($result as $index => $item)
						<tr>
							<td><input type="checkbox" number="" value="4"></td>
							<td>{{ $item->number }}</td> 
							<td>{{ $item->periode_id }}</td>
							<td>{{ $item->daerah_id }}</td>
							<td>{{ $item->status }}</td>
							<td>{{ $item->created_at }}</td>
							<td>
								<div class="btn-group">
									<a href="{!! route('perencanaan.edit', [$item->id]) !!}" class="btn btn-primary">
										<i aria-hidden="true" class="fa fa-pencil"></i>
									</a>
									<form method="post" action="{!! route('perencanaan.destroy',$item->id) !!}">	
										@csrf
                                		@method('DELETE')									
										<button type="submit" class="btn btn-danger"><i aria-hidden="true" class="fa fa-trash"></i></button>
									</form>
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

@stop