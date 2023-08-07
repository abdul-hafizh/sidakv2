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
							<th class=""><span class="border-left-table">No</span>  </th>
							<th class=""><span class="border-left-table"> Username </span></th>
							<th class=""><span class="border-left-table"> Nama </span></th>
							<th class=" "><span class="border-left-table"> Email </span></th>
							<th class=""><span class="border-left-table"> Phone </span></th>
							<th class=""><span class="border-left-table"> Status </span></th> 
							<th> Options </th>
						</tr>
					</thead>

					<tbody>
						@foreach($result as $index => $item)
					<tr>
					 	<td><input type="checkbox" number="" value="4"></td>
					 	<td>{{ $item->number }}</td> 
					 	<td>{{ $item->username }}</td>
					 	<td>{{ $item->name }}</td>
					 	<td>{{ $item->email }}</td>
					 	<td>{{ $item->phone }}</td>
					 	<td>{{ $item->status }}</td>
					 	<td>
					 		<div class="btn-group">
					 			<button type="button" data-toggle="modal" data-target="#modal-edit-{{ $index }}" class="btn btn-primary">
					 				<i aria-hidden="true" class="fa fa-pencil"></i>
					 			</button>

                                    @include('template/sidakv2/user.edit',['index'=>$index,'data'=>$result[$index]])
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
     @include('template/sidakv2/user.add',['daerah'=>$daerah])

@stop

