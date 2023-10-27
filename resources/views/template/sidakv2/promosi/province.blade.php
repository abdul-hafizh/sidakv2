@extends('template/sidakv2/layout.app')
@section('content')

<div class="content">

	<div class="row padding-default" style="margin-bottom: 20px">
               <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-body btn-primary border-radius-13">
                         <div class="card-body table-responsive p-0">
                              <div class="media">
                                   <div class="media-body text-left">
                                        <span>Pagu Promosi</span>
                                        <h3 class="card-text" id="pagu_promosi"></h3>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-body btn-primary border-radius-13">     
                         <div class="card-body table-responsive p-0">
                              <div class="media">
                                   <div class="media-body text-left">
                                        <span>Total Promosi</span>
                                        <h3 class="card-text" id="total_promosi"></h3>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-body btn-primary border-radius-13">		
                         <div class="card-body table-responsive p-0">
                              <div class="media">
                                   <div class="media-body text-left">
                                        <span>Periode <span id="periode_selected" class="pd-top-bottom-5"></span></span>
                                        <h3 class="card-text" id="status-view"></h3>                                   
                                   </div>
                              </div>
                         </div>			
     			</div>
			</div>

          </div>
          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body">
                         <div class="row pd-top-bottom-15">                                
                              <div class="col-lg-4">
                                   <div id="periode-alert" class="form-group">
                                        <label class="col-sm-5 label-header-box form-group margin-none">Pilih Periode :</label>
                                        <div class="col-sm-7">
                                             <div id="selectPeriode" class="form-group margin-none"></div>
                                             <span id="periode-id-messages"></span>
                                             
                                        </div>
                                   </div>
                              </div>
                         </div>                          
                    </div>
               </div>
          </div>

          <div class="box box-solid box-primary" id="div-edit">
               <div class="box-body">
                    <div class="card-body">
                         <div class="row pd-top-bottom-15">
                              <div class="col-lg-12">
                                   <div id="periode-alert" class="form-group">
                                        <span id="alasan-edit-view"></span>
                                   </div>
                              </div>
                         </div>                          
                    </div>
               </div>
          </div>


     <div class="col-sm-4 pull-left padding-default full">
		<div class="width-50 pull-left">
            
            
                                 
            <div  id="ShowAdd" style="display:none;" class="pull-left padding-9-0">
                <button type="button" id="add" class="btn btn-primary border-radius-10">
                    Tambah Data
                </button> 
            </div>
		</div>
		
	</div>


	<div class="clearfix"></div>
	<div class="clearfix"></div>



	<div class="box box-solid box-primary">
		<div class="box-body">
			<div  class="card-body table-responsive p-0" >
				 <table class="table table-hover text-nowrap">
              
					<thead>
						<tr>

							<th rowspan="3"  class=" font-bold">No</th>
							<th rowspan="3" colspan="2" class="text-center font-bold">
							  <div class="split-table"></div>
							  <span class="padding-top-bottom-12 ">Proses Kegiatan</span>
                              <div class="split-table-right"></div>
						    </th>
						    <th colspan="2" class="text-center font-bold">
							  
							  <span class="padding-top-bottom-12">Periode Pelaksanaan</span>
                             
						    </th>
						    <th rowspan="3"  class="text-center font-bold">
							  <div class="split-table"></div>
							  <span class="padding-top-bottom-12">Budget (Rp)</span>
						    </th>
						    <th rowspan="3" class="text-center font-bold">
							  <div class="split-table"></div>
							  <span class="padding-top-bottom-12">Keterangan</span>
						    </th>

							
						</tr>
						<tr>
							<th  class="text-center font-bold">
							 	
							 	<span class="padding-top-bottom-12">Periode Mulai</span>
							</th>
							<th  class="text-center font-bold">
							    <div class="split-table"></div>
							   <span class="position-top-10">Periode Akhir</span>
							</th>
					    </tr>
					 	
					</thead>
				    <tbody id="content">
			        </tbody>
			    </table>		
			</div>
		</div>
	</div>

	<div class="btn-footer" id="btn-action">	
	</div>
</div>
<div id="modal-reqedit" class="modal fade" role="dialog">

</div>


<script type="text/javascript">
 $(document).ready(function() {
    var periode =[];
    var pagu_promosi = 0;
    var total_promosi = 0;
    const itemsPerPage = 1; // Number of items to display per page
    let currentPage = 1; // Current page number
    let previousPage = 1; // Previous page number
    const visiblePages = 5; // Number of visible page links in pagination
    let page = 1;
    var list = [];
    var year = new Date().getFullYear();

    


    $('#pagu_promosi').html('<b>Rp 0</b>');           
    $('#total_promosi').html('<b>Rp 0</b>'); 
    $('#periode_selected').html('<b>'+ year +'</b>'); 
    

  
    $('#selectPeriode').html('<select  id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>');
   
    fetchData(page,year);
    getperiode(year);

	$('#periode_id').on('change', function() {
		var index = $(this).val();
		let find = periode.find(o => o.value === index);
          console.log(find.pagu_promosi)
		var promosi = accounting.formatNumber(find.pagu_promosi, 0, ".", "."); 
		$('#pagu_promosi').html('<b>Rp '+ promosi +'</b>');
	    $('#periode_selected').html('<b>'+ find.value +'</b>'); 
        fetchData(page,find.value);
      
	});



    $("#add").click( () => {
         window.location.replace('/promosi/add/'); 
    });

       // Function to fetch data from the API
    function fetchData(page,periode_id) {
    	   const content = $('#content');
           content.empty();
    	  
    	 	let row = ``;
             row +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
 
        var url = BASE_URL+ `/api/promosi?page=${page}&per_page=${itemsPerPage}&periode_id=${periode_id}`;
        var method = 'GET';
          	 
        $.ajax({
            url: url,
            method: method,
            success: function(response) {
            	list = response.data;
            	
            	
                listOptions(response.options);
                updateContent(response.data,response.options);
                $('#pagu_promosi').html('<b>'+response.pagu_promosi+'</b>');
                $('#total_promosi').html('<b>'+response.total_promosi+'</b>');
                
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }


    // Function to update the content area with data
    function updateContent(data,options)
    {
        const content = $('#content');
        // Clear previous data
        content.empty();

        if(data.length>0)
        {  	

        // Populate content with new data
        data.forEach(function(item, index) {
           	let row = ``;
            
					     row +=`<tr>`;
                            row +=`<td colspan="9" class="text-center font-bold">Proses Pengadaan Barang/Jasa</td>`;
					    row +=`</tr>`;	
						row +=`<tr lass="pull-left full">`;
                            row +=`<td rowspan="9" class="font-bold text-center">1.</td>`;
                            row +=`<td colspan="4" class="font-bold"> Pra Produksi Meliputi : </td>`;
                              row +=`<td><strong id="total_pra_produksi">${item.total_pra_produksi }</td>`;
                             row +=`<td></td>`;
					   row +=`</tr>`;
                       row +=`<tr>`;
                       	row +=`<td class="font-bold">A.</td>`;
                       	row +=`<td class="-abjad font-bold">Rapat Teknis Membahas Rencana Kerja Antara Lain Menentukan Proyek/Peluang/Potensi Invenstasi Yang Akan Tampil Dalam Video</td>`;
                       	row +=`<td>`;
                       		row +=`<div id="startdate-a-pra-alert" class="margin-none form-group">`; 
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_peluang}" class="form-control">`;
                       			row +=`<span id="startdate-a-pra-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="enddate-a-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_peluang}" class="form-control">`;
	                            row +=`<span id="enddate-a-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-a-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_peluang}" class="form-control text-right">`;
	                            row +=`<span id="budget-a-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-a-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_peluang}" class="form-control">`;
	                            row +=`<span id="desc-a-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr>`;
                       	row +=`<td class="font-bold">B.</td>`;
                       	row +=`<td class="font-bold">Membuat Storyline</td>`;
                       	row +=`<td>`;
                       		row +=`<div id="startdate-b-pra-alert" class="margin-none form-group">`; 
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_storyline}" class="form-control">`;
                       			row +=`<span id="startdate-b-pra-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="enddate-b-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_storyline}" class="form-control">`;
	                            row +=`<span id="enddate-b-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-b-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_storyline}" class="form-control text-right">`;
	                            row +=`<span id="budget-b-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-b-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_storyline}" class="form-control">`;
	                            row +=`<span id="desc-b-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                       	row +=`<td class="font-bold">C.</td>`;
                       	row +=`<td class="font-bold">Membuat StoryBoard</td>`;
                       row +=`<td>`;
                       		row +=`<div id="startdate-c-pra-alert" class="margin-none form-group">`; 
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_storyboard}" class="form-control">`;
                       			row +=`<span id="startdate-c-pra-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="enddate-c-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_storyboard}" class="form-control">`;
	                            row +=`<span id="enddate-c-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-c-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_storyboard}"  class="form-control text-right">`;
	                            row +=`<span id="budget-c-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-c-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_storyboard}"  class="form-control">`;
	                            row +=`<span id="desc-c-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                       	row +=`<td class="font-bold">D.</td>`;
                       	row +=`<td class="font-bold">Penentuan Lokasi</td>`;
                       	row +=`<td>`;
                       		row +=`<div id="startdate-d-pra-alert" class="margin-none form-group">`; 
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_lokasi}"   class="form-control">`;
                       			row +=`<span id="startdate-d-pra-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                           row +=`<div id="enddate-d-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_lokasi}"  class="form-control">`;
	                            row +=`<span id="enddate-d-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-d-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_lokasi}"  class="form-control text-right">`;
	                            row +=`<span id="budget-d-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-d-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_lokasi}"  class="form-control">`;
	                            row +=`<span id="desc-d-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;
                        row +=`<tr>`;
                       	row +=`<td class="font-bold">E.</td>`;
                       	row +=`<td class="font-bold">Pemilihan Talent</td>`;
                       	row +=`<td>`;
                       		row +=`<div id="startdate-e-pra-alert" class="margin-none form-group">`; 
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_talent}" class="form-control">`;
                       			row +=`<span id="startdate-e-pra-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="enddate-e-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_talent}" class="form-control">`;
	                            row +=`<span id="enddate-e-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-e-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_talent}" class="form-control text-right">`;
	                            row +=`<span id="budget-e-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-e-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_talent}"   class="form-control">`;
	                            row +=`<span id="desc-e-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                       	row +=`<td class="font-bold">F.</td>`;
                       	row +=`<td class="font-bold">Pemilihan Pelaku Usaha Yang Memberikan Testimoni</td>`;	
                       	row +=`<td>`;
                       		row +=`<div id="startdate-f-pra-alert" class="margin-none form-group">`;
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_testimoni}"  class="form-control">`;
                       			row +=`<span id="startdate-f-pra-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="enddate-f-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_testimoni}" class="form-control">`;
	                            row +=`<span id="enddate-f-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-f-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_testimoni}" class="form-control text-right">`;
	                            row +=`<span id="budget-f-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-f-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_testimoni}"   class="form-control">`;
	                            row +=`<span id="desc-f-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr>`;
                       	row +=`<td class="font-bold">G.</td>`;
                       	row +=`<td class="font-bold">Pemilihan Element Audio Visual</td>`;
                       	row +=`<td>`;
                       		row +=`<div id="startdate-g-pra-alert" class="margin-none form-group">`; 
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_audio}"  class="form-control">`;
                       			row +=`<span id="startdate-g-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="enddate-g-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_audio}" class="form-control">`;
	                            row +=`<span id="enddate-g-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-g-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_audio}" class="form-control text-right">`;
	                            row +=`<span id="budget-g-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-g-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_audio}"   class="form-control">`;
	                            row +=`<span id="desc-g-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                       	row +=`<td class="font-bold">H.</td>`;
                       	row +=`<td class="font-bold">Pemilihan Video Editing Tools</td>`;
                       row +=`<td>`;
                       		row +=`<div id="startdate-h-pra-alert" class="margin-none form-group">`; 
                       			row +=`<input readonly type="date" name="" value="${item.tgl_awal_editing}" class="form-control">`;
                       			row +=`<span id="startdate-h-pra-messages"></span>`;
                            row +=`</div>`;
                       	row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="enddate-h-pra-alert" class="margin-none form-group">`; 
	       						row +=`<input readonly type="date" name="" value="${item.tgl_ahir_editing}" class="form-control">`;
	                            row +=`<span id="enddate-h-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
                            row +=`<div id="budget-h-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.budget_editing}" class="form-control text-right">`;
	                            row +=`<span id="budget-h-pra-messages"></span>`;
                            row +=`</div>`;
       					row +=`</td>`;
       					row +=`<td>`;
       						row +=`<div id="desc-h-pra-alert" class="margin-none form-group">`;
	       						row +=`<input readonly type="text" name="" value="${item.keterangan_editing}"   class="form-control">`;
	                            row +=`<span id="desc-h-pra-messages"></span>`;
                            row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;

					    row +=`<tr >`;
                             row +=`<td rowspan="3" class="font-bold text-center">2.</td>`;
                             row +=`<td colspan="4" class="font-bold"> Produksi : </td>`;
                             row +=`<td><strong id="total_produksi">${item.total_produksi }</td>`;
                             row +=`<td></td>`;

					    row +=`</tr>`;
					     row +=`<tr>`;
                       	 row +=`<td class="font-bold">A.</td>`;
                       	 row +=`<td class="-abjad font-bold">Pengambilan Gambar Testimoni Pelaku Usaha</td>`;
                       	 row +=`<td>`;
                       		 row +=`<div id="startdate-a-pro-alert" class="margin-none form-group">`; 
                       			 row +=`<input readonly type="date" name="" value="${item.tgl_awal_gambar}"  class="form-control">`;
                       			 row +=`<span id="startdate-a-pro-messages"></span>`;
                             row +=`</div>`;
                       	 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="enddate-a-pro-alert" class="margin-none form-group">`; 
	       						 row +=`<input readonly type="date" name="" value="${item.tgl_ahir_gambar}" class="form-control">`;
	                             row +=`<span id="enddate-a-pro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="budget-a-pro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.budget_gambar}" class="form-control text-right">`;
	                             row +=`<span id="budget-a-pro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
       						 row +=`<div id="desc-a-pro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.keterangan_gambar}"   class="form-control">`;
	                             row +=`<span id="desc-a-pro-messages"></span>`;
                             row +=`</div>`;

       					 row +=`</td>`;
                        row +=`</tr>`;
                        row +=`<tr>`;
                       	 row +=`<td class="font-bold">B.</td>`;
                       	 row +=`<td class="-abjad font-bold">Pengambilan Gambar Di Lapangan Dan Pengumpulan Video</td>`;
                       	 row +=`<td>`;
                       		 row +=`<div id="startdate-b-pro-alert" class="margin-none form-group">`; 
                       			 row +=`<input readonly type="date" name="" value="${item.tgl_awal_video}" class="form-control">`;
                       			 row +=`<span id="startdate-b-pro-messages"></span>`;
                             row +=`</div>`;
                       	 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="enddate-b-pro-alert" class="margin-none form-group">`; 
	       						 row +=`<input readonly type="date" name="" value="${item.tgl_ahir_video}" class="form-control">`;
	                             row +=`<span id="enddate-b-pro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="budget-b-pro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.budget_video}" class="form-control text-right">`;
	                             row +=`<span id="budget-b-pro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					row +=`<td>`;
       						 row +=`<div id="desc-b-pro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.keterangan_video}"   class="form-control">`;
	                             row +=`<span id="desc-b-pro-messages"></span>`;
                             row +=`</div>`;

       					 row +=`</td>`;
                        row +=`</tr>`;
					   row +=`<tr>`;
                            row +=`<td rowspan="9" class="font-bold text-center">3.</td>`;
                            row +=`<td colspan="4" class="font-bold"> Pasca Produksi : </td>`;
                            row +=`<td><strong id="total_produksi">${item.total_pasca_produksi }</td>`;
                            row +=`<td></td>`;
					   row +=`</tr>`;
					    row +=`<tr>`;
                       	 row +=`<td class="font-bold">A.</td>`;
                       	 row +=`<td class="-abjad font-bold">Editing Video</td>`;
                       	 row +=`<td>`;
                       		 row +=`<div id="startdate-a-ppro-alert" class="margin-none form-group">`; 
                       			 row +=`<input readonly type="date" name="" value="${item.tgl_awal_editvideo}" class="form-control">`;
                       			 row +=`<span id="startdate-a-ppro-messages"></span>`;
                             row +=`</div>`;
                       	 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="enddate-a-ppro-alert" class="margin-none form-group">`; 
	       						 row +=`<input readonly type="date" name=""  value="${item.tgl_ahir_editvideo}" class="form-control">`;
	                             row +=`<span id="enddate-a-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="budget-a-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.budget_editvideo}" class="form-control text-right">`;
	                             row +=`<span id="budget-a-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
       						 row +=`<div id="desc-a-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.keterangan_editvideo}"   class="form-control">`;
	                             row +=`<span id="desc-a-ppro-messages"></span>`;
                             row +=`</div>`;

       					 row +=`</td>`;
                        row +=`</tr>`;
                        row +=`<tr>`;
                       	 row +=`<td class="font-bold">B.</td>`;
                       	 row +=`<td class="font-bold">Motion Grafik</td>`;
                       	 row +=`<td>`;
                       		 row +=`<div id="startdate-b-ppro-alert" class="margin-none form-group">`; 
                       			 row +=`<input readonly type="date" name="" value="${item.tgl_awal_grafik}" class="form-control">`;
                       			 row +=`<span id="startdate-b-ppro-messages"></span>`;
                             row +=`</div>`;
                       	 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="enddate-b-ppro-alert" class="margin-none form-group">`; 
	       						 row +=`<input readonly type="date" name="" value="${item.tgl_ahir_grafik}" class="form-control">`;
	                             row +=`<span id="enddate-b-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="budget-b-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.budget_grafik}" class="form-control text-right">`;
	                             row +=`<span id="budget-b-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
       						 row +=`<div id="desc-b-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.keterangan_grafik}"   class="form-control">`;
	                             row +=`<span id="desc-b-ppro-messages"></span>`;
                             row +=`</div>`;

       					 row +=`</td>`;
                       row +=` </tr>`;
                        row +=`<tr >`;
                       	 row +=`<td class="font-bold">C.</td>`;
                       	 row +=`<td class="font-bold">Music Compose Dan Mixing</td>`;
                        row +=`<td>`;
                       		 row +=`<div id="startdate-c-ppro-alert" class="margin-none form-group">`; 
                       			 row +=`<input readonly type="date" name="" value="${item.tgl_awal_mixing}"  class="form-control">`;
                       			 row +=`<span id="startdate-c-ppro-messages"></span>`;
                             row +=`</div>`;
                       	 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="enddate-c-ppro-alert" class="margin-none form-group">`; 
	       						 row +=`<input readonly type="date" name="" value="${item.tgl_ahir_mixing}" class="form-control">`;
	                             row +=`<span id="enddate-c-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="budget-c-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.budget_mixing}" class="form-control text-right">`;
	                             row +=`<span id="budget-c-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
       						 row +=`<div id="desc-c-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.keterangan_mixing}"   class="form-control">`;
	                             row +=`<span id="desc-c-ppro-messages"></span>`;
                             row +=`</div>`;

       					 row +=`</td>`;
                       row +=`</tr>`;
                        row +=`<tr >`;
                       	 row +=`<td class="font-bold">D.</td>`;
                       	 row +=`<td class="font-bold">Voice Over Talent</td>`;
                       	 row +=`<td>`;
                       		 row +=`<div id="startdate-d-ppro-alert" class="margin-none form-group">`; 
                       			 row +=`<input readonly type="date" name="" value="${item.tgl_awal_voice}"  class="form-control">`;
                       			 row +=`<span id="startdate-d-ppro-messages"></span>`;
                             row +=`</div>`;
                       	 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="enddate-d-ppro-alert" class="margin-none form-group">`; 
	       						 row +=`<input readonly type="date" name="" value="${item.tgl_ahir_voice}" class="form-control">`;
	                             row +=`<span id="enddate-d-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="budget-d-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.budget_voice}" class="form-control text-right">`;
	                             row +=`<span id="budget-d-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
       						 row +=`<div id="desc-d-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.keterangan_voice}"   class="form-control">`;
	                             row +=`<span id="desc-d-ppro-messages"></span>`;
                             row +=`</div>`;

       					 row +=`</td>`;
                        row +=`</tr>`;
                         row +=`<tr>`;
                       	 row +=`<td class="font-bold">E.</td>`;
                       	 row +=`<td class="font-bold">Subtitle</td>`;
                       	 row +=`<td>`;
                       		 row +=`<div id="startdate-e-ppro-alert" class="margin-none form-group">`; 
                       			 row +=`<input readonly type="date" name="" value="${item.tgl_awal_subtitle}" class="form-control">`;
                       			 row +=`<span id="startdate-e-ppro-messages"></span>`;
                             row +=`</div>`;
                       	 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="enddate-e-ppro-alert" class="margin-none form-group">`; 
	       						 row +=`<input readonly type="date" name="" value="${item.tgl_ahir_subtitle}"  class="form-control">`;
	                             row +=`<span id="enddate-e-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
                             row +=`<div id="budget-e-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.budget_subtitle}" class="form-control text-right">`;
	                             row +=`<span id="budget-e-ppro-messages"></span>`;
                             row +=`</div>`;
       					 row +=`</td>`;
       					 row +=`<td>`;
       						 row +=`<div id="desc-e-ppro-alert" class="margin-none form-group">`;
	       						 row +=`<input readonly type="text" name="" value="${item.keterangan_subtitle}"   class="form-control">`;
	                             row +=`<span id="desc-e-ppro-messages"></span>`;
                             row +=`</div>`;

       					row +=`</td>`;
                       row +=`</tr>`;	
                       if(item.access == 'province'){
                       	 BtnAction(item);
                       }	
					   
				    if(item.request_edit == 'true')
				    { 
                          $('#status-view').html('<b>Proses</b> (Waiting Request Edit)');
                          $('#alasan-edit-view').html('<b>Alasan Edit : '+item.alasan+'</b>').addClass('col-lg-12 text-red');
				    }else{
				    	$('#status-view').html('<b>'+item.status.status_convert +'</b>'); 
                         $('#div-edit').remove();
				    } 	

                       

                       
            content.append(row);

        });

	    }else{

	    	 let row = ``;
             row +=`<tr>`;
             row +=`<td colspan="9" align="center">Data .Kosong</td>`;
             row +=`</tr>`;
             content.append(row);
             $('#btn-action').html('');
             $('#status-view').html('<b>Kosong</b>');
	    }


	   

       


       $( "#content" ).on( "click", "#Detail", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
             
            
        });    


 		

  

       


        $( "#content" ).on( "click", "#Destroy", (e) => {
	        let id = e.currentTarget.dataset.param_id;


	        Swal.fire({
			      title: 'Apakah anda yakin hapus?',
			    
			      icon: 'warning',
			      showCancelButton: true,
			      confirmButtonColor: '#d33',
			      cancelButtonColor: '#3085d6',
			      confirmButtonText: 'Ya'
			    }).then((result) => {
			      if (result.isConfirmed) {
			        // Perform the delete action here, e.g., using an AJAX request
			        // You can use the itemId to identify the item to be deleted
			        deleteItem(id);
			        
			        Swal.fire(
			          'Deleted!',
			          'Data berhasil dihapus.',
			          'success'
			        );
			      }
			    });

	        
        }); 
 
    }


    function BtnAction(item){
       var row = '';
          row +=`<div class="box-footer">`;
			 row +=`<div  class="btn-group just-center">`;
        row +=`<a href="`+ BASE_URL +`/promosi/download/`+ item.id +`" class="btn btn-danger col-md-2" target="_blank">`;
			row +=`<i class="fa fa-download"></i> Download PDF`;
		row +=`</a>`;

      if(item.status_laporan_id =='14')
      {

      	    if(item.request_edit == 'true')
			{

				row +=`<button type="button"  disabled  class="btn btn-warning col-md-2">`;
				row +=`<i class="fa fa-pencil"></i> Request Edit</button>`;

		    }else{		
            
				row +=`<button type="button"  data-toggle="modal" data-target="#modal-reqedit" id="RequestEdit" data-param_id="`+ item.id +`"  class="btn btn-warning col-md-2">`;
				row +=`<i class="fa fa-pencil"></i> Request Edit</button>`;
		    }		

      }else{
               row +=`<button type="button" id="Edit" data-param_id="`+ item.id +`" class="btn btn-warning col-md-2">`;
				row +=`<i class="fa fa-pencil"></i> Edit</button>`;


              row +=`<button type="button" id="Destroy" data-param_id="`+ item.id +`" class="btn bg-navy col-md-2">`;
                    row +=`<i class="fa fa-trash"></i> Delete</button>`;      


      }	

        	row +=`</div>`;
         row +=`</div>`;
	    $('#btn-action').html(row);

	    $( "#btn-action" ).on( "click", "#Edit", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
            window.location.replace('/promosi/edit/'+ id);   
            
        });

        $( "#btn-action" ).on( "click", "#RequestEdit", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
         



            $("#reqedit").click( () => {    
                var alasan =  $('#alasan_edit_inp').val();
              
                  var form = {'alasan':alasan};
                    $.ajax({
			            type:"POST",
			            url: BASE_URL+'/api/promosi/requestedit/'+ item.id,
			            data:form,
			            cache: false,
			            dataType: "json",
			            success: (respons) =>{
			                      
                              Swal.fire({
                              title: 'Sukses!',
                              text: 'Berhasil mengirim alasan request edit ',
                              icon: 'success',
                              confirmButtonText: 'OK'                        
	                         }).then((result) => {
	                              if (result.isConfirmed) {
	                                   window.location.replace('/promosi');
	                              }
	                         });

			            },
			            error: (respons)=>{
			                errors = respons.responseJSON;
			                

			                
			            }
			        });

            
            });
            
        });

         $( "#btn-action" ).on( "click", "#Destroy", (e) => {
             let id = e.currentTarget.dataset.param_id;


             Swal.fire({
                     title: 'Apakah anda yakin hapus?',
                   
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#d33',
                     cancelButtonColor: '#3085d6',
                     confirmButtonText: 'Ya'
                   }).then((result) => {
                     if (result.isConfirmed) {
                       // Perform the delete action here, e.g., using an AJAX request
                       // You can use the itemId to identify the item to be deleted
                       deleteItem(id);
                       
                       Swal.fire(
                         'Deleted!',
                         'Data berhasil dihapus.',
                         'success'
                       );
                     }
                   });

        }); 

        ModalRequestEdit(item.id)


 
        
    	
    }


    function ModalRequestEdit(id){
       
        var row = '';

    	
		     row +=`<div class="modal-dialog">`;
		          row +=`<div class="modal-content">`;
		               row +=`<div class="modal-header">`;
		                    row +=`<button type="button" class="close" data-dismiss="modal">&times;</button>`;
		                    row +=`<h4 class="modal-title">Request Edit Promosi</h4>`;
		               row +=`</div>`;
		               row +=`<div class="modal-body">`;
		                    row +=`<div class="form-group">`;
		                         row +=`<label>Alasan Permintaan Edit Data</label>`;
		                         row +=`<textarea rows="4" cols="50" class="form-control textarea-fixed-replay" id="alasan_edit_inp" name="alasan_edit" placeholder="Alasan Edit"></textarea>`;
		                    row +=`</div>`;
		               row +=`</div>`;
		               row +=`<div class="modal-footer">`;
		                    row +=`<button type="button" disabled id="reqedit" class="btn btn-default">Request Edit</button>`;
		                    row +=`<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>`;
		               row +=`</div>`;
		          row +=`</div>`;
		     row +=`</div>`;
		

            $('#modal-reqedit').html(row);

    
        $('#alasan_edit_inp').on('input', function() {
                 $('#reqedit').removeClass('btn-default').addClass('btn-warning');	
		         var charCount = $(this).val().length;
		         if(charCount >0)
		         {
		         	$('#reqedit').prop("disabled", false);
		         	$('#reqedit').removeClass('btn-default').addClass('btn-warning');	
		         }else{
		         	$('#reqedit').prop("disabled", true);
		         	$('#reqedit').removeClass('btn-warning').addClass('btn-default');
		         } 
		        
		    });


    }


    function listOptions(data){
          
       data.forEach(function(item, index) 
       {
           if(item.action =='create')
           {
               if(item.checked ==true)
               {
                   $('#ShowAdd').show();
                   $('#ShowImport').show();
               }else{
                  $('#ShowAdd').hide();
                  $('#ShowImport').hide();
               }    
           }




            // if(item.action =='delete')
            // {
            //    if(item.checked ==true)
            //    {
            //        $('#ShowChecklist').show();
            //        $('#ShowChecklistAll').show();
            //    }else{
            //        $('#ShowChecklist').hide();
            //        $('#ShowChecklistAll').hide();
            //    } 
            // }

       
       });
    }

     function deleteItem(id){

          $.ajax({
              url:  BASE_URL +`/api/promosi/`+ id,
              method: 'DELETE',
              success: function(response) {
                  // Handle success (e.g., remove deleted items from the list)
                  fetchData(page,year);
              },
              error: function(error) {
                  console.error('Error deleting items:', error);
              }
          });

    }

      function getperiode(periode_id){
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=GET&action=promosi',
                    success: function(data) {
                         var select =  $('#periode_id');
                          select.empty();
                         $.each(data.result, function(index, option) {
                              select.append($('<option>', {
                                   value: option.value,
                                   text: option.text
                              }));
                         });

                         if(periode_id ==0)
                         {
                         	 select.prop('disabled', true);
                         	
                         }else{
                         	select.val(periode_id);
                         	select.prop('disabled', false);
                         } 	
                         
                        
                        
                         select.selectpicker('refresh');
                         periode = data.result; 
                    },
                    error: function( error) {}
               });

              
           }
 });
</script>
@stop

