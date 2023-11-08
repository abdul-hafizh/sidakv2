@extends('template/sidakv2/layout.app')
@section('content')

<div class="content">

	<div class="row padding-default" style="margin-bottom: 20px">
               <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box-body btn-primary border-radius-13">
                         <div class="card-body table-responsive p-0">
                              <div class="media">
                                   <div class="media-body text-left">
                                        <span>Pagu Pemetaan Potensi</span>
                                        <h3 class="card-text" id="pagu_pemetaan"></h3>
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
                                        <span>Total Potensi</span>
                                        <h3 class="card-text" id="total_pemetaan"></h3>
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

          <div class="box box-solid box-primary" id="div-edit" style="display:none;">
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
				 <table class="table table-hover text-nowrap" >
              
					<thead>
                              <tr>

                                   <th rowspan="3"  class=" font-bold">No</th>
                                   <th rowspan="3" colspan="4" class="text-center font-bold">
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
                                     <div class="split-table"></div><span class="padding-top-bottom-12">Keterangan</span>
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

    


    $('#pagu_pemetaan').html('<b>Rp 0</b>');           
    $('#total_pemetaan').html('<b>Rp 0</b>'); 
    $('#periode_selected').html('<b>'+ year +'</b>'); 
    

  
    $('#selectPeriode').html('<select  id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>');
   
    fetchData(page,year);
    getperiode(year);

	$('#periode_id').on('change', function() {
		var index = $(this).val();
		let find = periode.find(o => o.value === index);
          console.log(find.pagu_promosi)
		var promosi = accounting.formatNumber(find.pagu_promosi, 0, ".", "."); 
		// $('#pagu_promosi').html('<b>Rp '+ promosi +'</b>');
	 //     $('#periode_selected').html('<b>'+ find.value +'</b>'); 
         fetchData(page,find.value);
      
	});



    $("#add").click( () => {
         window.location.replace('/pemetaan/add/'); 
    });

       // Function to fetch data from the API
    function fetchData(page,periode_id) {
    	   const content = $('#content');
           content.empty();
    	  
    	 	let row = ``;
             row +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
              content.append(row);
 
        var url = BASE_URL+ `/api/pemetaan?page=${page}&per_page=${itemsPerPage}&periode_id=${periode_id}`;
        var method = 'GET';
          	 
        $.ajax({
            url: url,
            method: method,
            success: function(response) {
            	list = response.data;
            	
            	
                listOptions(response.options);
                updateContent(response.data,response.options);
                $('#pagu_pemetaan').html('<b>'+response.pagu_pemetaan+'</b>');
                $('#total_pemetaan').html('<b>'+response.total_pemetaan+'</b>');
                
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


                    row +=`<tr lass="pull-left full">`;
                            row +=`<td rowspan="5" class="font-bold text-center">1</td>`;
                            row +=`<td colspan="6" class="font-bold"> Identifikasi Pemetaan Potensi Investasi : </td>`;
                            row +=`<td><strong id="total_identifikasi">${item.total_identifikasi }</strong></td>`;
                            row +=`<td></td>`;
                    row +=`</tr>`;


                         row +=`<tr>`;
                         row +=`<td class="font-bold">A.</td>`;
                         row +=`<td class="-abjad font-bold" colspan="3">Rapat Teknis Membahas Rencana Kerja</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-a-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input  type="date"  disabled id="startdate_a_pra" name="startdate_a_pra"  value="${item.tgl_awal_rencana_kerja }" class="form-control ">`; 
                                   row +=`<span id="startdate-a-pra-messages"></span>`;
                           row +=` </div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-a-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input type="date"  disabled id="enddate_a_pra" name="enddate_a_pra" value="${item.tgl_ahir_rencana_kerja }" class="form-control">`;
                                 row +=`<span id="enddate-a-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-a-pra-alert" class="margin-none form-group">`;
                                        row +=`<input type="number" id="budget_a_pra" disabled   min="0" oninput="this.value = Math.abs(this.value)" placeholder="Budget" value="${item.budget_rencana_kerja }" name="budget_a_pra" 
                                           
                                        class="form-control pra_produksi">`;
                                 row +=`<span id="budget-a-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                  
                              if(item.keterangan_rencana_kerja)
                              {     
                                   row +=`<div>`;
                                        row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_rencana_kerja }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                     row +=`</div>`;

                                       row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                              row +=`<div id="FormView-${item.id }"></div>`;
                                        row +=`</div>`;
                                   row +=`</div>`;
                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              }

                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr>`;
                         row +=`<td class="font-bold">B.</td>`;
                         row +=`<td class="font-bold" colspan="3">Studi literatur</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-b-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date"  disabled name="startdate_b_pra"  value="${item.tgl_awal_studi_literatur }" class="form-control">`;
                                   row +=`<span id="startdate-b-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-b-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input type="date" disabled name="enddate_b_pra"  value="${item.tgl_ahir_studi_literatur }" class="form-control">`;
                                 row +=`<span id="enddate-b-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-b-pra-alert" class="margin-none form-group">`;
                                        row +=`<input id="budget_b_pra_alert"  placeholder="Budget" value="${item.budget_studi_literatur }"  type="number" min="0" disabled oninput="this.value = Math.abs(this.value)" name="budget_b_pra" class="form-control pra_produksi">`;
                                 row +=`<span id="budget-b-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            
                            if(item.keterangan_studi_literatur)
                            {  
                
                                  row +=`<div >`;
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_studi_literatur }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                          row +=`</div>`;

                                            row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;


                                     
                                 row +=`</div>`;

                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              }
                              row +=`</td>`;
                       row +=`</tr>`;


                       row +=`<tr >`;
                         row +=`<td class="font-bold">C.</td>`;
                         row +=`<td class="font-bold" colspan="3">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>`;
                       row +=`<td>`;
                              row +=`<div id="startdate-c-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date" disabled name="startdate_c_pra" value="${item.tgl_awal_rapat_kordinasi }" class="form-control">`;
                                   row +=`<span id="startdate-c-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-c-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input type="date" disabled name="enddate_c_pra" value="${item.tgl_ahir_rapat_kordinasi }" class="form-control">`;
                                 row +=`<span id="enddate-c-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-c-pra-alert" class="margin-none form-group">`;
                                        row +=`<input type="number" disabled min="0"  placeholder="Budget" value="${item.budget_rapat_kordinasi }" oninput="this.value = Math.abs(this.value)" name="budget_c_pra" class="form-control pra_produksi">`;
                                 row +=`<span id="budget-c-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;

                              if(item.keterangan_rapat_kordinasi)
                              {     
                           
                               row +=`<div >`;
                                        row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_rapat_kordinasi }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                     row +=`</div>`;

                                       row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                              row +=`<div id="FormView-${item.id }"></div>`;
                                        row +=`</div>`;


                                
                               row +=`</div>`;
                             }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                             }    
                              row +=`</td>`;
                       row +=`</tr>`;
                       row +=`<tr >`;
                         row +=`<td class="font-bold">D.</td>`;
                         row +=`<td class="font-bold" colspan="3">Pengumpulan data sekunder</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-d-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date" disabled name="startdate_d_pra" value="${item.tgl_awal_data_sekunder }"  class="form-control">`;
                                   row +=`<span id="startdate-d-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-d-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input type="date" disabled name="enddate_d_pra" value="${item.tgl_ahir_data_sekunder }"  class="form-control">`;
                                 row +=`<span id="enddate-d-pra-messages"></span>`;
                            row +=`</div>`;
                             row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-d-pra-alert" class="margin-none form-group">`;
                                        row +=`<input min="0" disabled type="number"  placeholder="Budget" value="${item.budget_data_sekunder }" oninput="this.value = Math.abs(this.value)" name="budget_d_pra" class="form-control pra_produksi">`;
                                 row +=`<span id="budget-d-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                          

                               if(item.keterangan_data_sekunder)
                               {    

                                    row +=`<div >`;
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_data_sekunder }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                          row +=`</div>`;

                                            row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;


                                   
                                  row +=`</div>`;
                             }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                             } 
                              row +=`</td>`;
                         row +=`</tr>`;                        

                         row +=`<tr>`;
                            row +=`<td rowspan="11" class="font-bold text-center">2</td>`;
                            row +=`<td colspan="6" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : </td>`;
                             row +=`<td><strong id="total_pelaksanaan">${item.total_pelaksanaan }</td>`;
                            row +=`<td></td>`;
                            row +=`</tr>`;
                         row +=`<tr>`;

                         row +=`<tr>`;
                              row +=`<td class="font-bold">A.</td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td class="-abjad font-bold" ><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Persiapan antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>`;
                              row +=`<td>`;
                              row +=`<div id="startdate-a-pro-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date" disabled name="startdate_a_pro" value="${item.tgl_awal_fgd_persiapan }" class="form-control">`;
                                   row +=`<span id="startdate-a-pro-messages"></span>`;
                              row +=`</div>`;
                             row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-a-pro-alert" class="margin-none form-group">`; 
                                 row +=`<input type="date" disabled name="enddate_a_pro" value="${item.tgl_ahir_fgd_persiapan }" class="form-control">`;
                                 row +=`<span id="enddate-a-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-a-pro-alert" class="margin-none form-group">`;
                                        row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_fgd_persiapan }"  oninput="this.value = Math.abs(this.value)" name="budget_a_pro" class="form-control produksi">`;
                                 row +=`<span id="budget-a-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                              
                              if(item.keterangan_fgd_persiapan)
                              {     

                                   row +=`<div >`;
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_fgd_persiapan }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                          row +=`</div>`;

                                            row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;


                                     
                                   row +=`</div>`;
                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              }    
                              row +=`</td>`;
                         row +=`</tr>`;     

                         row +=`<tr>`;
                              row +=`<td class="font-bold">B.</td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td class="-abjad font-bold"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>`;
                             row +=`<td>`;
                              row +=`<div id="startdate-b-pro-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date" disabled name="startdate_f_pra" value="${item.tgl_awal_fgd_identifikasi }" class="form-control pra-produksi">`;
                                   row +=`<span id="startdate-f-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-f-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input type="date" disabled name="enddate_f_pra" value="${item.tgl_ahir_fgd_identifikasi }" class="form-control">`;
                                 row +=`<span id="enddate-f-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                             row +=`<td>`;
                            row +=`<div id="budget-f-pra-alert" class="margin-none form-group">`;
                                         row +=`<input min="0" disabled type="number"  placeholder="Budget" value="${item.budget_fgd_identifikasi }" oninput="this.value = Math.abs(this.value)" name="budget_f_pra" class="form-control pra_produksi">`;
                                  row +=`<span id="budget-f-pra-messages"></span>`;
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                          
                               if(item.keterangan_fgd_identifikasi)
                               {    
                                   row +=`<div>`;
                                        row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_fgd_identifikasi }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                     row +=`</div>`;

                                       row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                              row +=`<div id="FormView-${item.id }"></div>`;
                                        row +=`</div>`;
                                   row +=`</div>`;
                                }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                                }     
                               row +=`</td>`; 
                          row +=`</tr>`; 
                              


                          row +=`<tr>`; 
                               row +=`<td class="font-bold" rowspan="5">C.</td>`; 
                               row +=`<td class="-abjad font-bold" colspan="7">`; 
                                   row +=`Pengolahan dan analisis data untuk menghasilkan potensi sektor dan subsektor unggulan daerah :`;
                               row +=`</td>`; 
                             
                          row +=`</tr>`; 


                         row +=` <tr>`; 
                            if(item.checklist_lq == 'true')
                            {
                                row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_lq }"></td>`;   
                            } else{
                                row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_lq }"></td>`;  
                            } 
                                
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=` 1.`; 
                               row +=`</td>`; 

                               row +=`<td class="-abjad font-bold"> LQ</td>`; 
                              row +=`<td>`; 
                              row +=`<div id="startdate-c-1-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input type="date" disabled name="startdate_c_1_pro"  value="${item.tgl_awal_lq }"  class="form-control">`; 
                                    row +=`<span id="startdate-c-1-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-1-pro-alert" class="margin-none form-group">`;  
                                         row +=`<input type="date" disabled name="enddate_c_1_pro"  value="${item.tgl_ahir_lq }"  class="form-control">`; 
                                  row +=`<span id="enddate-c-1-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-1-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input min="0" disabled type="number"  placeholder="Budget" value="${item.budget_lq }" oninput="this.value = Math.abs(this.value)" name="budget_c_1_pro" class="form-control pra_produksi">`; 
                                  row +=`<span id="budget-c-1-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                             
                             row +=`<td rowspan="4">`; 
                               if(item.keterangan_pengolahan)
                               {    
                                   row +=`<div class="potensi-sektor">`;
                                        row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_pengolahan }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                     row +=`</div>`;

                                       row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                              row +=`<div id="FormView-${item.id }"></div>`;
                                        row +=`</div>`;
                                   row +=`</div>`;
                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              } 
                             row +=`</td>`; 
                          row +=`</tr>`; 


                          row +=`<tr>`; 
                            if(item.checklist_shift_share == 'true')
                            {
                                row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_shift_share }"></td>`;   
                            } else{
                                row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_shift_share }"></td>`;  
                            } 
                            
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=` 2.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Shift Share</td>`; 
                               row +=`<td>`; 
                               row +=`<div id="startdate-c-2-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input type="date" disabled name="startdate_shift_c_2_pro" value="${item.tgl_awal_shift_share }" class="form-control">`; 
                                   row +=` <span id="startdate-c-2-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-2-pro-alert" class="margin-none form-group"> `; 
                                  row +=`<input type="date" disabled name="enddate_c_2_pro" value="${item.tgl_ahir_shift_share }" class="form-control">`; 
                                  row +=`<span id="enddate-c-2-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-2-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_shift_share }"  oninput="this.value = Math.abs(this.value)" name="budget_c_2_pro" class="form-control produksi">`; 
                                  row +=`<span id="budget-c-2-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                          
                          row +=`</tr>`; 

                          row +=`<tr>`; 
                            if(item.checklist_tipologi_sektor == 'true')
                            {
                                row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_tipologi_sektor }"></td>`;   
                            } else{
                                row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_tipologi_sektor }"></td>`;  
                            } 
                                 
                               row +=`<td class="font-bold table-number" >`; 
                                   row +=` 3.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Tipologi Sektor</td>`; 
                                row +=`<td>`; 
                               row +=`<div id="startdate-c-3-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input type="date" disabled name="startdate_c_3_pro" value="${item.tgl_awal_tipologi_sektor }"  class="form-control">`; 
                                    row +=`<span id="startdate-c-3-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-tipologi-sektor-pro-alert" class="margin-none form-group"> `; 
                                         row +=`<input type="date" disabled name="enddate_c_3_pro" value="${item.tgl_ahir_tipologi_sektor }"  class="form-control">`; 
                                 row +=` <span id="enddate-c-3-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-3-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_tipologi_sektor }"  oninput="this.value = Math.abs(this.value)" name="budget_c_3_pro" class="form-control produksi">`; 
                                  row +=`<span id="budget-c-3-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                             
                          row +=`</tr>`; 

                          row +=`<tr>`; 
                           if(item.checklist_klassen == 'true')
                            {
                                row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_klassen }"></td>`;   
                            } else{
                                row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_klassen }"></td>`;  
                            } 
                              
                              row +=` <td class="font-bold table-number" >`; 
                                   row +=` 4.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Klassen</td>`; 
                               row +=`<td>`; 
                               row +=`<div id="startdate-c-4-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input type="date" disabled name="startdate_c_4_pro" value="${item.tgl_awal_klassen }" class="form-control">`; 
                                   row +=` <span id="startdate-c-4-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-4-pro-alert" class="margin-none form-group"> `; 
                                         row +=`<input type="date" disabled name="enddate_c_4_pro" value="${item.tgl_ahir_klassen }" class="form-control">`; 
                                  row +=`<span id="enddate-c-4-pro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-4-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_klassen }" oninput="this.value = Math.abs(this.value)" name="budget_c_4_pro" class="form-control produksi">`; 
                                  row +=`<span id="budget-c-4-pro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                           
                          row +=`</tr>`; 

                        
                          row +=`<tr>`; 
                          row +=`<td class="font-bold">D.</td>`; 
                          row +=`<td></td>`;
                          row +=`<td></td>`;
                          row +=`<td class="-abjad font-bold"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Klarifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>`; 
                          row +=`<td>`; 
                              row +=` <div id="startdate-d-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input type="date" disabled name="startdate_d_pro" value="${item.tgl_awal_fgd_klarifikasi }" class="form-control">`; 
                                   row +=` <span id="startdate-d-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                              row +=` <td>`; 
                             row +=`<div id="enddate-d-pro-alert" class="margin-none form-group"> `; 
                                       row +=`  <input type="date" disabled name="enddate_d_pro" value="${item.tgl_ahir_fgd_klarifikasi }" class="form-control">`; 
                                 row +=` <span id="enddate-d-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-d-pro-alert" class="margin-none form-group">`; 
                                        row +=` <input min="0" disabled type="number" placeholder="Budget" value="${item.budget_fgd_klarifikasi }" oninput="this.value = Math.abs(this.value)" name="budget_d_pro" class="form-control produksi">`; 
                                  row +=`<span id="budget-d-pro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                               row +=`<td>`; 
                            
                              if(item.keterangan_fgd_klarifikasi)
                              {     

                               row +=`<div >`;
                                        row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_fgd_klarifikasi }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                     row +=`</div>`;

                                       row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                              row +=`<div id="FormView-${item.id }"></div>`;
                                        row +=`</div>`;


                                
                               row +=`</div>`;
                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              } 
                               row +=`</td>`; 
                         row +=` </tr>`; 
                         

                          


                        
                        row +=`<tr>`; 
                          row +=`<td class="font-bold">E.</td>`; 
                          row +=`<td></td>`;
                          row +=`<td></td>`;
                          row +=`<td class="-abjad font-bold"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>`; 
                          row +=`<td>`; 
                               row +=`<div id="startdate-e-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input type="date" disabled name="startdate_c_pro" value="${item.tgl_awal_finalisasi }"  class="form-control">`; 
                                    row +=`<span id="startdate-e-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                              row +=` <td>`; 
                            row +=` <div id="enddate-e-pro-alert" class="margin-none form-group"> `; 
                                       row +=` <input type="date" disabled name="enddate_e_pro" value="${item.tgl_ahir_finalisasi }"  class="form-control">`; 
                                  row +=`<span id="enddate-e-pro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-e-pro-alert" class="margin-none form-group">`; 
                                        row +=` <input min="0" disabled type="number" placeholder="Budget"  oninput="this.value = Math.abs(this.value)" name="budget_e_pro" value="${item.budget_finalisasi }" class="form-control produksi">`; 
                                  row +=`<span id="budget-e-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                
                                if(item.keterangan_finalisasi)
                                {   

                                   row +=`<div >`;
                                        row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_finalisasi }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                     row +=`</div>`;

                                       row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                              row +=`<div id="FormView-${item.id }"></div>`;
                                        row +=`</div>`;
                                   row +=`</div>`;
                                 }else{  
                                   row +=`<div class="font-bold text-center"> ... </div>`;
                                 }      

                               row +=`</td>`; 
                         row +=` </tr>`; 
                      
                         row +=`<tr>`; 
                           row +=` <td rowspan="12" class="font-bold text-center">3</td>`; 
                            row +=`<td colspan="6" class="font-bold"> Penyusunan Peta Potensi Investasi : </td>`; 
                             row +=`<td><strong id="total_penyusunan">${item.total_penyusunan } </strong></td>`; 
                            row +=`<td></td>`; 
                            row +=`</tr>`; 
                         row +=`<tr>`; 


                         row +=`<tr>`; 
                             row +=` <td class="font-bold" rowspan="8">A.</td>`; 
                             row +=` <td class="-abjad font-bold" colspan="7">`; 
                                   row +=`Menyusun hasil identifikasi, pengolahan, dan analisis data dalam bentuk dokumen`; 
                              row +=`</td>`; 
                         row +=`</tr>`; 


                         row +=`<tr>`; 
                            if(item.checklist_summary_sektor_unggulan == 'true')
                            {
                                row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_summary_sektor_unggulan }"></td>`;   
                            } else{
                                row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_summary_sektor_unggulan }"></td>`;  
                            }  
                             row +=` <td class="font-bold table-number" >`; 
                                  row +=` 1.`; 
                             row +=` </td>`; 
                              row +=`<td class="-abjad font-bold"> Deskripsi singkat sektor unggulan</td>`; 
                              row +=`<td>`; 
                                   row +=`<div id="startdate-a-1-ppro-alert"  class="margin-none form-group"> `; 
                                       row +=` <input type="date" disabled name="startdate_a_1_ppro" value="${item.tgl_awal_summary_sektor_unggulan }"   class="form-control">`; 
                                       row +=` <span id="startdate-a-1-ppro-messages"></span>`; 
                                row +=` </div>`; 
                              row +=`</td>`; 
                              row +=`<td>`; 
                                 row +=`<div id="enddate-a-1-ppro-alert" class="margin-none form-group"> `; 
                                             row +=`<input type="date" disabled name="enddate_a_1_pro" value="${item.tgl_ahir_summary_sektor_unggulan }"  class="form-control" >`; 
                                      row +=`<span id="enddate-a-1-ppro-messages"></span>`; 
                                row +=` </div>`; 
                                   row +=`</td>`; 
                                  row +=` <td>`; 
                                 row +=`<div id="budget-a-1-ppro-alert" class="margin-none form-group">`; 
                                            row +=` <input min="0" disabled type="number" placeholder="Budget" value="${item.budget_summary_sektor_unggulan }" oninput="this.value = Math.abs(this.value)" name="budget_a_1_ppro" class="form-control pasca_produksi">`; 
                                     row +=` <span id="budget-a-1-ppro-messages"></span>`; 
                                 row +=`</div>`; 
                             row +=` </td>`; 
                             

                             row +=` <td rowspan="7">`;
                             if(item.keterangan_penyusunan)
                              { 
                                     row +=`<div class="penyusunan-peta">`; 
                                         row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_penyusunan }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                     row +=`</div>`;

                                       row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                              row +=`<div id="FormView-${item.id }"></div>`;
                                        row +=`</div>`

                                     row +=`</div>`;
                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              }         
                              row +=`</td>`; 

                          row +=`</tr>`; 


                          row +=`<tr>`; 
                                 if(item.checklist_sektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_sektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_sektor_unggulan }"></td>`;  
                                 }
                              row +=` <td class="font-bold table-number" >`; 
                                  row +=`2.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Deskripsi sektor unggulan</td>`; 
                               row +=`<td>`; 
                                   row +=` <div id="startdate-a-2-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input type="date" disabled name="startdate_a_2_ppro" value="${item.tgl_awal_sektor_unggulan }" class="form-control">`; 
                                         row +=`<span id="startdate-a-2-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                  row +=`<div id="enddate-a-2-ppro-alert" class="margin-none form-group"> `; 
                                             row +=` <input type="date" disabled name="enddate_a_2_pro" value="${item.tgl_ahir_sektor_unggulan }" class="form-control">`; 
                                       row +=`<span id="enddate-a-2-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                                   row +=` </td>`; 
                                   row +=` <td>`; 
                                  row +=`<div id="budget-a-2-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input min="0" disabled type="number" placeholder="Budget" value="${item.budget_sektor_unggulan }" oninput="this.value = Math.abs(this.value)" name="budget_a_2_ppro" class="form-control pasca_produksi">`; 
                                       row +=`<span id="budget-a-2-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                               row +=`</td>`; 
                               
                          row +=`</tr>`; 

                          row +=`<tr>`; 
                                  if(item.checklist_potensi_pasar == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_potensi_pasar }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_potensi_pasar }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=`3.`; 
                              row +=`</td>`; 
                               row +=`<td class="-abjad font-bold">  Potensi pasar</td>`; 
                             
                               row +=`<td>`; 
                                   row +=` <div id="startdate-a-3-ppro-alert" class="margin-none form-group"> `; 
                                       row +=`  <input type="date" disabled name="startdate_a_3_ppro" value="${item.tgl_awal_potensi_pasar }"  class="form-control">`; 
                                        row +=` <span id="startdate-a-3-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                              row +=`</td>`; 
                               row +=`<td>`; 
                                  row +=`<div id="enddate-a-3-ppro-alert" class="margin-none form-group"> `; 
                                             row +=` <input type="date" disabled name="enddate_a_3_pro" value="${item.tgl_ahir_potensi_pasar }" class="form-control">`; 
                                       row +=`<span id="enddate-a-3-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                                   row +=` </td>`; 
                                    row +=`<td>`; 
                                 row +=` <div id="budget-a-3-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input min="0" disabled type="number" placeholder="Budget" value="${item.budget_potensi_pasar }"  oninput="this.value = Math.abs(this.value)" name="budget_a_3_ppro" class="form-control pasca_produksi">`; 
                                       row +=`<span id="budget-a-3-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                            
                          row +=`</tr>`; 

                          row +=`<tr>`; 
                                 if(item.checklist_parameter_sektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_parameter_sektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_parameter_sektor_unggulan }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                    row +=`4.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Parameter data sektor unggulan</td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="startdate-a-4-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input type="date" disabled name="startdate_a_4_ppro" value="${item.tgl_awal_parameter_sektor_unggulan }"  class="form-control">`; 
                                         row +=`<span id="startdate-a-4-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                               row +=`</td>`; 
                              row +=` <td>`; 
                                 row +=` <div id="enddate-a-4-ppro-alert" class="margin-none form-group"> `; 
                                           row +=`   <input type="date" disabled name="enddate_a_4_pro" value="${item.tgl_ahir_parameter_sektor_unggulan }"  class="form-control">`; 
                                      row +=` <span id="enddate-a-4-ppro-messages"></span>`; 
                                row +=`  </div>`; 
                                   row +=` </td>`; 
                                   row +=` <td>`; 
                                  row +=`<div id="budget-a-4-ppro-alert" class="margin-none form-group">`; 
                                              row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_parameter_sektor_unggulan }"  oninput="this.value = Math.abs(this.value)" name="budget_a_4_ppro" class="form-control pasca_produksi">`; 
                                       row +=`<span id="budget-a-4-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               
                         row +=` </tr>`; 

                          row +=`<tr>`; 
                                 if(item.checklist_subsektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_subsektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_subsektor_unggulan }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=`5.`; 
                              row +=` </td>`; 
                              
                               row +=`<td class="-abjad font-bold"> <textarea readonly class="textarea-table">Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</textarea></td>`; 
                              row +=` <td>`; 
                                   row +=` <div id="startdate-a-5-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input type="date" disabled name="startdate_a_5_ppro" value="${item.tgl_awal_subsektor_unggulan }"   class="form-control">`; 
                                        row +=` <span id="startdate-a-5-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                 row +=` <div id="enddate-a-5-ppro-alert" class="margin-none form-group"> `; 
                                            row +=`  <input type="date" disabled name="enddate_3_5_pro" value="${item.tgl_ahir_subsektor_unggulan }"   class="form-control">`; 
                                      row +=` <span id="enddate-a-5-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                                    row +=`</td>`; 
                                    row +=`<td>`; 
                                 row +=`<div id="budget-a-5-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input min="0" disabled type="number" placeholder="Budget" value="${item.budget_subsektor_unggulan }"   oninput="this.value = Math.abs(this.value)" name="budget_a_5_ppro" class="form-control pasca_produksi">`; 
                                      row +=` <span id="budget-a-5-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                            
                          row +=`</tr>`; 

                         row +=` <tr>`; 
                                 if(item.checklist_intensif_daerah == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_intensif_daerah }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_intensif_daerah }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                   row +=`6.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Insentif daerah</td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="startdate-a-6-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input type="date" disabled name="startdate_a_6_ppro"  value="${item.tgl_awal_intensif_daerah }"  class="form-control">`; 
                                        row +=` <span id="startdate-a-6-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                 row +=` <div id="enddate-a-6-ppro-alert" class="margin-none form-group"> `; 
                                            row +=`  <input type="date" disabled name="enddate_a_6_pro"  value="${item.tgl_ahir_intensif_daerah }"   class="form-control">`; 
                                      row +=` <span id="enddate-a-6-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                                    row +=`</td>`; 
                                    row +=`<td>`; 
                                  row +=`<div id="budget-a-6-ppro-alert" class="margin-none form-group">`; 
                                              row +=`<input min="0" disabled type="number" placeholder="Budget"  value="${item.budget_intensif_daerah }"  oninput="this.value = Math.abs(this.value)" name="budget_a_6_ppro" class="form-control pasca_produksi">`; 
                                      row +=` <span id="budget-a-6-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               
                          row +=`</tr>`; 

                           row +=`<tr>`; 
                                  if(item.checklist_potensi_lanjutan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_potensi_lanjutan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_potensi_lanjutan }"></td>`;  
                                 } 
                               row +=`<td class="font-bold table-number" >`; 
                                   row +=`7.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Potensi lanjutan komoditas sektor unggulan</td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="startdate-a-7-ppro-alert" class="margin-none form-group"> `; 
                                        row +=`<input type="date" disabled name="startdate_a_7_ppro" value="${item.tgl_awal_potensi_lanjutan }"  class="form-control">`; 
                                         row +=`<span id="startdate-a-7-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                  row +=`<div id="enddate-a-7-ppro-alert" class="margin-none form-group"> `; 
                                              row +=`<input type="date" disabled name="enddate_a_7_pro" value="${item.tgl_ahir_potensi_lanjutan }" class="form-control">`; 
                                       row +=`<span id="enddate-a-7-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                                    row +=`</td>`; 
                                    row +=`<td>`; 
                                  row +=`<div id="budget-a-7-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input min="0" disabled type="number" placeholder="Budget" value="${item.budget_potensi_lanjutan }" oninput="this.value = Math.abs(this.value)" name="budget_a_7_ppro" class="form-control pasca_produksi">`; 
                                       row +=`<span id="budget-a-7-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                              
                         row +=` </tr>`; 



                         row +=`<tr>`; 

                         row +=`<td class="font-bold">B.</td>`;
                         row +=`<td></td>`;
                         row +=`<td></td>`; 
                          row +=`<td class="-abjad font-bold" ><textarea readonly class="textarea-table">Penyusunan Infografis Peta Potensi Investasi dalam 2 bahasa (bahasa indonesia dan bahasa inggris)</textarea></td>`; 
                          row +=`<td>`; 
                               row +=`<div id="startdate-b-ppro-alert" class="margin-none form-group"> `; 
                                    row +=`<input type="date" disabled name="startdate_b_ppro" value="${item.tgl_awal_info_grafis }"  class="form-control">`; 
                                   row +=` <span id="startdate-b-ppro-messages"></span>`; 
                             row +=`</div>`; 
                         row +=` </td>`; 
                              row +=` <td>`; 
                            row +=` <div id="enddate-b-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input type="date" disabled name="enddate_b_ppro" value="${item.tgl_ahir_info_grafis }"  class="form-control">`; 
                                  row +=`<span id="enddate-b-ppro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-b-ppro-alert" class="margin-none form-group">`; 
                                        row +=` <input min="0" disabled type="number" placeholder="Budget" value="${item.budget_info_grafis }"  oninput="this.value = Math.abs(this.value)" name="budget_b_ppro" class="form-control pasca_produksi">`; 
                                  row +=`<span id="budget-b-ppro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                               
                              if(item.keterangan_info_grafis)
                              {     

                                   row +=`<div >`;
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_info_grafis }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                          row +=`</div>`;

                                            row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                   row +=`</div>`;

                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              } 
                               row +=`</td>`; 
                        row +=`</tr>`; 
                        row +=`<tr>`; 
                          row +=`<td class="font-bold">C.</td>`; 
                          row +=`<td></td>`;
                          row +=`<td></td>`;
                          row +=`<td class="font-bold" ><textarea readonly class="textarea-table">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</textarea></td>`; 
                          row +=`<td>`; 
                              row +=` <div id="startdate-c-ppro-alert" class="margin-none form-group">`;  
                                    row +=`<input type="date" disabled name="startdate_c_ppro" value="${item.tgl_awal_dokumentasi }"  class="form-control">`; 
                                    row +=`<span id="startdate-c-ppro-messages"></span>`; 
                             row +=`</div>`; 
                         row +=` </td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-ppro-alert" class="margin-none form-group"> `; 
                                         row +=`<input type="date" disabled name="enddate_c_ppro" value="${item.tgl_ahir_dokumentasi }"  class="form-control">`; 
                                  row +=`<span id="enddate-c-ppro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-c-ppro-alert" class="margin-none form-group">`; 
                                         row +=`<input min="0" disabled type="number" placeholder="Budget"  oninput="this.value = Math.abs(this.value)" name="budget_c_ppro" value="${item.budget_dokumentasi }"  class="form-control pasca_produksi">`; 
                                  row +=`<span id="budget-c-ppro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=`</td>`; 
                               row +=`<td>`; 
                            
                              if(item.keterangan_dokumentasi)
                              {     
                                  row +=`<div >`;
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_dokumentasi }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                          row +=`</div>`;

                                            row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                   row +=`</div>`;
                              }else{  
                                 row +=`<div class="font-bold text-center"> ... </div>`;
                              } 
                               row +=`</td>`; 
                        row +=`</tr>`; 
       
				   
                  if(item.access == 'province'){
                  	 BtnAction(item);
                  }	
				   
			    if(item.request_edit == 'true')
			    { 
                    $('#div-edit').show();
                     $('#status-view').html('<b>Proses</b> (Waiting Request Edit)');
                     $('#alasan-edit-view').html('<b>Alasan Edit : '+item.alasan+'</b>').addClass('col-lg-12 text-red');
			    }else{
			    	$('#status-view').html('<b>'+item.status.status_convert +'</b>'); 
                    $('#div-edit').remove();
			    } 	


                   content.on( "click", "#viewPdf", (e) => {
                        let file = e.currentTarget.dataset.param_file;  
                        EmbedFile(file,item.id);  
                   });



                       

                       
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

    function EmbedFile(file,tmp){
        // console.log(BASE_URL+'/laporan/pemetaan/'+file)

                let row = ``;
                      row +=`<div class="modal-dialog">`;
                          row +=`<div class="modal-content">`;

                                     row +=`<div class="modal-header">`;
                                       row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
                                       row +=`<h4 class="modal-title">Lihat File PDF</h4>`;
                                     row +=`</div>`;

                                    
                                     row +=`<div class="modal-body">`;
                                      row +=`<embed src="`+ BASE_URL+`/laporan/pemetaan/`+file+`#page=1&zoom=65" width="575" height="500">`;
                                     row +=`</div>`;


                                   row +=`<div class="modal-footer">`;
                                           row +=`<button type="button" class="clear-input btn btn-default" data-dismiss="modal">Tutup</button>`;
                                   row +=`</div>`;
                         row +=`</div>`;
                       row +=`</div>`;   
                    $('#FormView-'+ tmp).html(row);  

          }


    function BtnAction(item){
       var row = '';
          row +=`<div class="box-footer">`;
			 row +=`<div  class="btn-group just-center">`;
        row +=`<a href="`+ BASE_URL +`/pemetaan/download/`+ item.id +`" class="btn btn-danger col-md-2" target="_blank">`;
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
            window.location.replace('/pemetaan/edit/'+ id);   
            
        });

        $( "#btn-action" ).on( "click", "#RequestEdit", (e) => {
             
            let id = e.currentTarget.dataset.param_id;
         



            $("#reqedit").click( () => {    
                var alasan =  $('#alasan_edit_inp').val();
              
                  var form = {'alasan':alasan};
                    $.ajax({
			            type:"POST",
			            url: BASE_URL+'/api/pemetaan/requestedit/'+ item.id,
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
	                                   window.location.replace('/pemetaan');
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
		                    row +=`<h4 class="modal-title">Request Edit Peta Potensi</h4>`;
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
              url:  BASE_URL +`/api/pemetaan/`+ id,
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
                    url: BASE_URL +'/api/select-periode?type=GET&action=pemetaan',
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

