
<table id="myTable" style="display:none;">
  <thead>
   <tr>
		<th><b>No</b></th>
		<th><b>Kode Kabupaten</b></th>
		<th><b>Nama Kabupaten</b></th>
    <th><b>Kode Provinsi</b></th>
    <th><b>Nama Provinsi</b></th>
		<th><b>Dibuat</b></th>
   </tr>

  </thead>
  <tbody >
  	
  	@foreach($data as $item)

  	      <tr>
             <td>{{ $item->number }}</td>
             <td>{{ $item->id }}</td>
             <td>{{ $item->name }}</td>
             <td>{{ $item->province_id }}</td>
             <td>{{ $item->province_name }}</td>
             <td>{{ $item->created_at }}</td>
           </tr>

   
    @endforeach
  	
  </tbody> 
  
</table>

