
<table id="myTable">
  <thead>
   <tr>
		<th><b>No</b></th>
		<th><b>Username</b></th>
		<th><b>Nama Lengkap</b></th>
		<th><b>Email</b></th>
		<th><b>No Telp</b></th>
		<th><b>Nip</b></th>
		<th><b>Nama Pejabat</b></th>
		<th><b>Nip Pejabat</b></th>
		<th><b>Daerah</b></th>
		<th><b>Role</b></th>
		<th><b>Status</b></th>
		<th><b>Dibuat</b></th>
   </tr>

  </thead>
  <tbody >
  	
  	@foreach($data as $item)

  	      <tr>
             <td>{{ $item->number }}</td>
             <td>{{ $item->username }}</td>
             <td>{{ $item->name }}</td>
             <td>{{ $item->email }}</td>
             <td>{{ $item->phone }}</td>
             <td>{{ $item->nip }}</td>
             <td>{{ $item->leader_name }}</td>
             <td>{{ $item->leader_nip }}</td>
             <td>{{ $item->daerah_name }}</td>
             <td>{{ $item->role }}</td>
             <td>{{ $item->status }}</td>
             <td>{{ $item->created_at }}</td>
           </tr>

   
@endforeach
  	
  </tbody> 
  
</table>

