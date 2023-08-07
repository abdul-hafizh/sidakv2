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
							<th class="border-right-table "> Nama Role</th>						
							<th> Options </th>
						</tr>
					</thead>

					<tbody>
						<tr>
					
					    </tr>
					 </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript">
 		$(function(){
           $.ajax({
            type:"GET",
            url: BASE_URL+'/api/role',
            cache: false,
            dataType: "json",
            success: (respons) =>{
                  console.log(respons)
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
               
            }
          });

         });
</script>	
   

@stop

