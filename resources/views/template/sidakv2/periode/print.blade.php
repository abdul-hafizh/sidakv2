
<table id="myTable" style="display:none;">
  <thead>
   <tr>
		<th><b>No</b></th>
		<th><b>Nama Periode</b></th>
		<th><b>Slug</b></th>
		<th><b>Semester</b></th>
		<th><b>Tahun</b></th>
		<th><b>Tanggal Mulai</b></th>
		<th><b>Tanggal Berahir</b></th>
		<th><b>Status</b></th>
		<th><b>Dibuat</b></th>
   </tr>

  </thead>
  <tbody >
  	
  	@foreach($data as $item)

  	      <tr>
             <td>{{ $item->number }}</td>
             <td>{{ $item->name }}</td>
             <td>{{ $item->slug }}</td>
             <td>{{ $item->semester }}</td>
             <td>{{ $item->year }}</td>
             <td>{{ $item->startdate }}</td>
             <td>{{ $item->enddate }}</td>
             <td>{{ $item->status }}</td>
             <td>{{ $item->created_at }}</td>
           </tr>

   
@endforeach
  	
  </tbody> 
  
</table>

