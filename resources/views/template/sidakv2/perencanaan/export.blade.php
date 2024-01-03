<table id="perencanaanTable" style="display:none;">
	<thead>
		<tr>			
			<th rowspan="2">No</th>							
			<th rowspan="2">Nama Daerah</th>
			<th rowspan="2">Periode </th>
			<th colspan="6">Pengawasan </th>
			<th colspan="4">Bimsos </th>
			<th colspan="6">Penyelesaian Masalah </th>
			@if (date('Y') > 2023)
				<th rowspan="2">Peta Potensi</th>
			@elseif (date('Y') < 2024)
				<th rowspan="2">Promosi</th>
			@endif
			<th rowspan="2">Total </th>
			<th rowspan="2">Status </th>
			<th rowspan="2">Update </th>
		</tr>
		<tr>							
			<th>Analisa </th>
			<th>Target </th>
			<th>Inspeksi </th>
			<th>Target </th>
			<th>Evaluasi </th>
			<th>Target </th>
			<th>Perizinan </th>
			<th>Target </th>
			<th>Pengawasan </th>
			<th>Target </th>
			<th>Identifikasi </th>
			<th>Target </th>
			<th>Realisasi </th>
			<th>Target </th>
			<th>Evaluasi </th>
			<th>Target </th>
		</tr>
	</thead>

	<tbody id="exportView"></tbody> 

</table>

