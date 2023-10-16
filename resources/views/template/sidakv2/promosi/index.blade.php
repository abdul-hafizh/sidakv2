@extends('template/sidakv2/layout.app')
@section('content')

<div class="content">

	<div class="row padding-default" style="margin-bottom: 20px">
        <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="box-body btn-primary border-radius-13">
                    <div class="card-body table-responsive p-0">
                         <div class="media">
                              <div class="media-body text-left">
                                   <span>Pagu APBN</span>
                                   <h3 class="card-text" id="pagu_apbn"><b>Rp 50.000.000</b></h3>
                              </div>
                         </div>
                    </div>
               </div>
		</div>

    </div>


	<div class="clearfix"></div>
	<div class="clearfix"></div>



	<div class="box box-solid box-primary">
		<div class="box-body">
			<div class="card-body table-responsive p-0" >
				<table class="table table-hover text-nowrap" border="1">
					<thead>
						<tr>
							<th rowspan="3"  class="text-center font-bold">No</th>
							<th rowspan="3" colspan="2" class="text-center font-bold">Proses Kegiatan</th>
							<th colspan="2"  class="text-center font-bold">Periode Pelaksanaan</th>
							<th rowspan="3"  class="text-center font-bold">Budget (Rp)</th>
							<th rowspan="3"  class="text-center font-bold">Keterangan</th>
						</tr>
						<tr>
							 <th  class="text-center font-bold">Periode Mulai</th>
							 <th  class="text-center font-bold">Periode Akhir</th> 
					    </tr>
					 	
					</thead>
					<tbody>
					     <tr>
                            <td colspan="9" class="text-center font-bold">Proses Pengadaan Barang/Jasa</td>
					    </tr>	
						<tr lass="pull-left full">
                            <td rowspan="9" class="font-bold text-center">1</td>
                            <td colspan="6" class="font-bold"> Pra Produksi Meliputi : </td>
					   </tr>
                       <tr>
                       	<td class="font-bold">A.</td>
                       	<td class="-abjad font-bold">Rapat Teknis Membahas Rencana Kerja Antara Lain Menentukan Proyek/Peluang/Potensi Invenstasi Yang Akan Tampil Dalam Video</td>
                       	<td>
                       		<div id="startdate-a-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-a-pra-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-a-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-a-pra-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-a-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-a-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-a-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-a-pra-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr>
                       	<td class="font-bold">B.</td>
                       	<td class="font-bold">Membuat Storyline</td>
                       	<td>
                       		<div id="startdate-b-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-b-pra-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-b-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-b-pra-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-b-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-b-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-b-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-b-pra-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr >
                       	<td class="font-bold">C.</td>
                       	<td class="font-bold">Membuat StoryBoard</td>
                       <td>
                       		<div id="startdate-c-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-c-pra-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-c-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-c-pra-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-c-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-c-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-c-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-c-pra-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr >
                       	<td class="font-bold">D.</td>
                       	<td class="font-bold">Penentuan Lokasi</td>
                       	<td>
                       		<div id="startdate-d-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-d-pra-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-d-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-d-pra-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-d-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-d-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-d-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-d-pra-messages"></span>
                            </div>

       					</td>
                       </tr>
                        <tr>
                       	<td class="font-bold">E.</td>
                       	<td class="font-bold">Pemilihan Talent</td>
                       	<td>
                       		<div id="startdate-e-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-e-pra-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-e-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-e-pra-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-e-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-e-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-e-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-e-pra-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr >
                       	<td class="font-bold">F.</td>
                       	<td class="font-bold">Pemilihan Pelaku Usaha Yang Memberikan Testimoni</td>	
                       	<td>
                       		<div id="startdate-f-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-f-pra-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-f-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-f-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-f-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-f-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-f-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-f-pra-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr>
                       	<td class="font-bold">G.</td>
                       	<td class="font-bold">Pemilihan Element Audio Visual</td>
                       	<td>
                       		<div id="startdate-g-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-g-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-g-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-g-pra-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-g-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-g-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-g-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-g-pra-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr >
                       	<td class="font-bold">H.</td>
                       	<td class="font-bold">Pemilihan Video Editing Tools</td>
                       <td>
                       		<div id="startdate-h-pra-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-h-pra-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-h-pra-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-h-pra-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-h-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-h-pra-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-h-pra-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-h-pra-messages"></span>
                            </div>

       					</td>
                       </tr>

					   <tr >
                            <td rowspan="3" class="font-bold text-center">2</td>
                            <td colspan="6" class="font-bold"> Produksi : </td>
					   </tr>
					    <tr>
                       	<td class="font-bold">A.</td>
                       	<td class="-abjad font-bold">Pengambilan Gambar Testimoni Pelaku Usaha</td>
                       	<td>
                       		<div id="startdate-a-pro-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-a-pro-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-a-pro-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-a-pro-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-a-pro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-a-pro-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-a-pro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-a-pro-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr>
                       	<td class="font-bold">B.</td>
                       	<td class="-abjad font-bold">Pengambilan Gambar Di Lapangan Dan Pengumpulan Video</td>
                       	<td>
                       		<div id="startdate-b-pro-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-b-pro-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-b-pro-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-b-pro-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-b-pro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-b-pro-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-b-pro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-b-pro-messages"></span>
                            </div>

       					</td>
                       </tr>
					   <tr>
                            <td rowspan="9" class="font-bold text-center">3</td>
                            <td colspan="6" class="font-bold"> Pasca Produksi : </td>
					   </tr>
					   <tr>
                       	<td class="font-bold">A.</td>
                       	<td class="-abjad font-bold">Editing Video</td>
                       	<td>
                       		<div id="startdate-a-ppro-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-a-ppro-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-a-ppro-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-a-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-a-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-a-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-a-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-a-ppro-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr>
                       	<td class="font-bold">B.</td>
                       	<td class="font-bold">Motion Grafik</td>
                       	<td>
                       		<div id="startdate-b-ppro-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-b-ppro-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-b-ppro-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-b-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-b-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-b-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-b-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-b-ppro-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr >
                       	<td class="font-bold">C.</td>
                       	<td class="font-bold">Music Compose Dan Mixing</td>
                       <td>
                       		<div id="startdate-c-ppro-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-c-ppro-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-c-ppro-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-c-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-c-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-c-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-c-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-c-ppro-messages"></span>
                            </div>

       					</td>
                       </tr>
                       <tr >
                       	<td class="font-bold">D.</td>
                       	<td class="font-bold">Voice Over Talent</td>
                       	<td>
                       		<div id="startdate-d-ppro-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-d-ppro-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-d-ppro-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-d-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-d-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-d-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-d-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-d-ppro-messages"></span>
                            </div>

       					</td>
                       </tr>
                        <tr>
                       	<td class="font-bold">E.</td>
                       	<td class="font-bold">Subtitle</td>
                       	<td>
                       		<div id="startdate-e-ppro-alert" class="margin-none form-group"> 
                       			<input type="date" name="" class="form-control">
                       			<span id="startdate-e-ppro-messages"></span>
                            </div>
                       	</td>
       					<td>
                            <div id="enddate-e-ppro-alert" class="margin-none form-group"> 
	       						<input type="date" name="" class="form-control">
	                            <span id="enddate-e-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
                            <div id="budget-e-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="budget-e-ppro-messages"></span>
                            </div>
       					</td>
       					<td>
       						<div id="desc-e-ppro-alert" class="margin-none form-group">
	       						<input type="text" name="" class="form-control">
	                            <span id="desc-e-ppro-messages"></span>
                            </div>

       					</td>
                       </tr>		
					</tbody>
					
				</table>
			</div>
		</div>
	</div>

	<div class="btn-footer">
		<div class="box-footer">
			<div class="btn-group just-center">
				<a href="" class="btn btn-danger col-md-2" target="_blank">
					<i class="fa fa-download"></i> Download PDF
				</a>
				<button type="button" disabled="" class="btn btn-warning col-md-2">
					<i class="fa fa-pencil"></i> Request Edit</button>
				</div>
		</div>
	</div>
</div>



@stop

