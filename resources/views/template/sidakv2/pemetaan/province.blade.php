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
                                        <h3 class="card-text" id="pagu-apbn"></h3>
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
                                        <span>Total Budget Pemetaan</span>
                                        <h3 class="card-text" id="total-budget"></h3>
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
                                        <span>Total Realisasi Pemetaan</span>
                                        <h3 class="card-text" id="total-realisasi"></h3>                                   
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
                <a href="{{ url('pemetaan/add') }}" class="btn btn-primary border-radius-10">
                    Tambah Data
                </a> 
            </div>
		</div>
		
	</div>


	<div class="clearfix"></div>
	<div class="clearfix"></div>



	<div class="box box-solid box-primary">
		<div class="box-body">
			<div  class="card-body table-responsive p-0" >
				 <table class="table table-hover text-nowrap" >
              
					  <div class="card-body table-responsive">
                        <table class="table table-hover text-nowrap" border="0" >
                         <thead>
                              <tr>

                                   <th rowspan="3"  class=" font-bold">No</th>
                                   
                                   <th rowspan="3" class="text-center font-bold">
                                        <div class="split-table"></div>
                                   </th>
                                   <th rowspan="3" colspan="8" class="text-center font-bold">
                                     <span class="padding-top-bottom-12 ">Proses Kegiatan</span>
                                   </th>
                                     <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                                    <th rowspan="3" colspan="2" class="text-center font-bold">
                                     <span class="padding-top-bottom-12 ">Jenis Pekerjaan</span>
                                   </th>
                                   <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                                   <th colspan="3" class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Periode Pelaksanaan</span>
                                   </th>
                                   <th rowspan="3" ><div class="split-table padding-none"></div> </th>

                                   <th rowspan="3"  class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Budget (Rp)</span>
                                   </th>
                                   <th rowspan="3" ><div class="split-table padding-none"></div> </th>

                                   <th rowspan="3"  class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Realisasi (Rp)</span>
                                   </th>
                                  <th rowspan="3" ><div class="split-table padding-none"></div> </th>
                                  <th rowspan="3" class="text-center font-bold">
                                     <span class="padding-top-bottom-12">Keterangan</span>
                                  </th>

                                   
                              </tr>
                             <tr>
                                   <th  class="text-center font-bold">
                                        
                                        <span class="padding-top-bottom-12">Periode Mulai</span>
                                   </th>
                                   <th ><div class="split-table  padding-none"></div> </th>
                                   <th  class="text-center font-bold">
                                       
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

    


    $('#pagu-apbn').html('<b>Rp 0</b>');           
    $('#total-budget').html('<b>Rp 0</b>'); 
    $('#total-realisasi').html('<b>Rp 0</b>');
    

  
    
   
    fetchData(page,year);
    getperiode(year);

	$('#periode_id').on('change', function() {
		var index = $(this).val();
		let find = periode.find(o => o.value === index);
         
		var promosi = accounting.formatNumber(find.pagu_promosi, 0, ".", "."); 
		// $('#pagu_promosi').html('<b>Rp '+ promosi +'</b>');
	 //     $('#periode_selected').html('<b>'+ find.value +'</b>'); 
         fetchData(page,find.value);
      
	});



    // $("#add").click( () => {
    //      window.location.replace('/pemetaan/add/'); 
    // });

       // Function to fetch data from the API
    function fetchData(page,periode_id) {
    	   const content = $('#content');
           content.empty();
    	  
    	 	let row = ``;
             row +=`<tr><td colspan="23" align="center"> <b>Loading ...</b></td></tr>`;
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

                $('#pagu-apbn').html('<b>'+response.pagu_pemetaan+'</b>');
                $('#total-budget').html('<b>'+response.total_budget_pemetaan+'</b>');
                $('#total-realisasi').html('<b>'+response.total_realisasi_pemetaan+'</b>');
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
                            row +=`<td  class="font-bold text-center">1</td>`;
                            row +=`<td></td>`;
                            row +=`<td colspan="16" class="font-bold"> Identifikasi Pemetaan Potensi Investasi : </td>`;
                            row +=`<td align="right"><strong id="total-budget-indentifikasi">${item.total_budget_potensi }</td>`;
                            row +=`<td></td>`;
                            row +=`<td align="right"><strong id="total-realisasi-identifikasi">${item.total_realisasi_potensi }</td>`;
                            row +=`<td></td>`;
                           row +=` <td></td>`;       
                    row +=`</tr>`;


                     row +=`<tr>`;
                           row +=`<td></td>`;
                           row +=`<td></td>`;      

                             if(item.checklist_rk == 'true')
                            {
                                row +=`<td><input disabled name="checklist_rk" checked id="checklist-rk" value="${item.checklist_rk}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td>`;  
                            } else{
                                row +=`<td><input disabled name="checklist_rk" id="checklist-rk" value="${item.checklist_rk}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td>`;   
                            } 
                             
                           row +=`<td class="font-bold">A.</td>`;

                       
                           row +=`<td colspan="6" class="-abjad font-bold" >Rapat Teknis Membahas Rencana Kerja</td>`;
                           row +=`<td></td> `;
                           row +=`<td rowspan="4" colspan="2" class="text-center font-bold"><div class="potensi-sektor">Jasa Konsultan</div></td> `;
                           row +=`<td rowspan="4"></td>`; 
                           row +=`<td rowspan="4">`;
                               row +=`<div id="startdate-potensi-alert" class="margin-none form-group input-text-pilihan"> `;
                                    row +=`<input  type="date"   id="startdate-potensi" name="startdate_potensi" class="form-control" value="${item.tgl_awal_potensi }" disabled>`;
                                    row +=`<span id="startdate-potensi-messages"></span>`;
                             row +=`</div>`;
                           row +=`</td>`;
                           row +=`<td rowspan="4"></td> `;
                           row +=`<td rowspan="4">`;
                             row +=`<div id="enddate-potensi-alert" class="margin-none form-group input-text-pilihan"> `;
                                         row +=`<input type="date"   id="enddate-potensi" name="enddate_potensi" class="form-control" value="${item.tgl_ahir_potensi }" disabled>`;
                                  row +=`<span id="enddate-potensi-messages"></span>`;
                             row +=`</div>`;
                           row +=`</td>`;
                           row +=`<td rowspan="4"></td>`; 
                           row +=`<td rowspan="4">`;
                            row +=` <div id="budget-potensi-alert" class="margin-none form-group input-text-pilihan">`;
                                         row +=`<input type="number" id="budget-potensi" disabled   min="0" oninput="this.value = Math.abs(this.value)" placeholder="Budget" value="${item.budget_potensi }" name="budget_potensi" class="form-control identifikasi-budget pemetaan-budget text-right">`;
                                  row +=`<span id="budget-potensi-messages"></span>`;
                             row +=`</div>`;
                           row +=`</td>`;
                           row +=`<td rowspan="4"></td> `;
                           row +=`<td rowspan="4">`;
                               row +=`<div id="realisasi-potensi-alert" class="margin-none form-group input-text-pilihan">`;
                                         row +=`<input type="number" id="realisasi-potensi" disabled   min="0" oninput="this.value = Math.abs(this.value)" placeholder="Realisasi" value="${item.realisasi_potensi }" name="realisasi_potensi" class="form-control identifikasi-realisasi pemetaan-realisasi text-right">`;
                                  row +=`<span id="realisasi-potensi-messages"></span>`;
                               row +=`</div>`;
                           row +=`</td>`;
                           row +=`<td rowspan="4"></td> `
                           row +=`<td rowspan="4">`;
                                    
                                    if(item.keterangan_potensi)
                                   {     
                                        row +=`<div>`;
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf input-text-pilihan" data-param_file="${item.keterangan_potensi }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
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
                            row +=`<td></td>`;
                            row +=`<td></td> `;  
                            if(item.checklist_sl == 'true')
                            {
                                row +=`<td><input disabled name="checklist_sl" checked id="checklist-sl" value="${item.checklist_sl}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td>`;  
                            } else{
                                  
                                row +=`<td><input disabled name="checklist_sl" id="checklist-sl" value="${item.checklist_sl}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td> `;   
                            } 

                            row +=`<td class="font-bold">B.</td>`;
                            row +=`<td class="font-bold" colspan="6">Studi literatur</td>`;

                        row +=`</tr>`;


                        row +=`<tr>`;
                           row +=`<td></td>`;
                           row +=`<td></td>`;

                            if(item.checklist_kor == 'true')
                            {
                                row +=`<td><input disabled name="checklist_kor" checked id="checklist-kor" value="${item.checklist_kor}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td>`;  
                            } else{
                                  
                               row +=`<td><input disabled name="checklist_kor" id="checklist-kor" value="${item.checklist_kor}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td>`;   
                            } 

                           
                          row +=`<td class="font-bold">C.</td>`;
                       
                          row +=`<td class="font-bold" colspan="6">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>`;
                        
                        
                        row +=`</tr>`;
                        row +=`<tr >`;
                            row +=`<td></td>  <td></td>`;

                            if(item.checklist_ds == 'true')
                            {
                                row +=`<td><input disabled name="checklist_kor" checked id="checklist-ds" value="${item.checklist_ds}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td>`;  
                            } else{
                                  
                              row +=`<td><input disabled name="checklist_ds" id="checklist-ds" value="${item.checklist_ds}" type="checkbox" class="checkbox-pemetaan-potensi item-potensi"></td> `;  
                            } 

                           
                          row +=`<td class="font-bold">D.</td>`;
                        
                          row +=`<td class="font-bold" colspan="6">Pengumpulan data sekunder</td>`;
                         
                              
                         row +=`</tr> `;

                         row +=`<tr>`;
                            row +=`<td  class="font-bold text-center">2</td>`;
                            row +=`<td></td>`;
                            row +=`<td colspan="16" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi :  </td>`;
                            row +=`<td align="right"><strong id="total-pelaksanaan-budget">${item.total_budget_pelaksanaan }</td>`;
                              row +=`<td></td>`;
                              row +=`<td align="right"><strong id="total-pelaksanaan-realisasi">${item.total_realisasi_pelaksanaan }</td>`;
                             row +=`<td></td>`;
                             row +=`<td></td>`;       
                         row +=`</tr>`;  

                          row +=`<tr>`;
                               row +=`<td></td>`;
                               row +=`<td></td>`;
                               row +=`<td class="font-bold">A.</td>`;

                               row +=`<td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Persiapan antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>`;
                               row +=`<td></td>`;

                             
                               row +=`<td  colspan="2" class="text-center font-bold">`;
                                    row +=`<div >Swakelola</div>`;
                               row +=`</td>`;
                               row +=`<td></td>`;
                               row +=`<td>`;   
                                    row +=`<div id="startdate-a-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input type="date" disabled id="startdate-a-pro" name="startdate_a_pro" value="${item.tgl_awal_fgd_persiapan }" class="form-control">`;
                                         row +=`<span id="startdate-a-pro-messages"></span>`;
                                    row +=`</div>`;      
                             row +=` </td>`;
                              row +=`<td></td>`;
                               row +=`<td>`;
                                    row +=`<div id="enddate-a-pro-alert" class="margin-none form-group"> `;
                                       row +=`<input type="date" disabled="" id="enddate-a-pro" name="enddate_a_pro" value="${item.tgl_ahir_fgd_persiapan }" class="form-control">`;
                                       row +=`<span id="enddate-a-pro-messages"></span>`;
                                    row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td></td>`;
                               row +=`<td >`;
                                  row +=`<div id="budget-a-pro-alert" class="margin-none form-group">`;
                                              row +=`<input align="right" min="0" disabled type="number"  placeholder="Budget" value="${item.budget_fgd_persiapan }"  oninput="this.value = Math.abs(this.value)" id="budget-a-pro" name="budget_a_pro" class="form-control pelaksanaan-budget pemetaan-budget swakelola-budget text-right">`;
                                       row +=`<span id="budget-a-pro-messages"></span>`;
                                  row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td></td>`;
                               row +=`<td>`;
                                   row +=`<div id="realisasi-a-pro-alert" class="margin-none form-group">`;
                                         row +=`<input min="0" disabled type="number" placeholder="Realisasi" value="${item.realisasi_fgd_persiapan }" oninput="this.value = Math.abs(this.value)" id="realisasi-a-pro" name="realisasi_a_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi text-right">`;
                                         row +=`<span id="realisasi-a-pro-messages"></span>`;
                                    row +=`</div>`;
                               row +=`</td>`;
                               row +=`<td></td>`;
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
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td class="font-bold">B.</td>`;

                              row +=`<td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea>`;
                              row +=`</td>`;
                              row +=`<td></td>`;

                             row +=`<td  colspan="2" class="text-center font-bold">`;
                                   row +=`<div >Swakelola</div>`;
                              row +=`</td>`;
                             
                              row +=`<td></td>`;
                              row +=`<td>`;      
                                     
                              row +=`<div id="startdate-b-pro-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date" disabled id="startdate-b-pro" name="startdate_b_pro" class="form-control" value="${item.tgl_awal_fgd_identifikasi }">`;
                                   row +=`<span id="startdate-b-pro-messages"></span>`;
                              row +=`</div>`;
                             row +=`</td>`;
                             row +=`<td></td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-b-pro-alert" class="margin-none form-group">`; 
                                 row +=`<input type="date" disabled id="enddate-b-pro" name="enddate_b_pro" class="form-control" value${item.tgl_ahir_fgd_identifikasi }>`;
                                 row +=`<span id="enddate-b-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
                              row +=`<td>`;
                                 row +=`<div id="budget-b-pro-alert" class="margin-none form-group">`;
                                             row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_fgd_identifikasi }"  oninput="this.value = Math.abs(this.value)" id="budget-b-pro" name="budget_b_pro" class="form-control pelaksanaan-budget pemetaan-budget text-right swakelola-budget">`;
                                      row +=`<span id="budget-b-pro-messages"></span>`;
                                 row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
                              row +=`<td>`;
                                 row +=`<div id="realisasi-b-pro-alert" class="margin-none form-group">`;
                                             row +=`<input min="0" disabled type="number" placeholder="Realisasi" value="${item.realisasi_fgd_identifikasi }"  oninput="this.value = Math.abs(this.value)" id="realisasi-b-pro" name="realisasi_b_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi text-right">`;
                                      row +=`<span id="realisasi-b-pro-messages"></span>`;
                                 row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
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
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td class="font-bold">C.</td>`;

                              row +=`<td class="-abjad font-bold" colspan="20">`;
                                   row +=`<div> Pengolahan dan analisis data untuk menghasilkan potensi sektor dan subsektor unggulan daerah : </div>`;
                                  row +=`<span id="pengolahan-messages"></span>`;
                              row +=`</td>`;   
                             
                         row +=`</tr>`;


                         row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;

                                 if(item.checklist_lq == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_lq" value="${item.checklist_lq }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_lq" value="${item.checklist_lq }"></td>`;  
                                 } 

                              row +=`<td  class="font-bold table-number">`;
                                   row +=`1.`;
                              row +=`</td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> LQ</td>`;
                             
                              row +=`<td rowspan="4"></td>`;
                              row +=`<td  colspan="2"  rowspan="4" class="text-center font-bold">
                                   <div class="potensi-sektor">Jasa Konsultan</div>`;
                              row +=`</td>`;
                              row +=`<td rowspan="4"></td>`;
                              row +=`<td  rowspan="4">`;
                              row +=`<div id="startdate-c-1-pro-alert" class="margin-none form-group input-text-pilihan">`; 
                                   row +=`<input type="date" disabled name="startdate_sektor" id="startdate-sektor" value="${item.tgl_awal_sektor }" class="form-control">`;
                                   row +=`<span id="startdate-c-1-pro-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                         row +=`<td rowspan="4"></td>`;
                              row +=`<td  rowspan="4">`;
                            row +=`<div id="enddate-c-1-pro-alert" class="margin-none form-group input-text-pilihan">`; 
                                        row +=`<input type="date" disabled name="enddate_sektor" id="enddate-sektor" class="form-control" value="${item.tgl_ahir_sektor }">`;
                                row +=`<span id="enddate-c-1-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                            row +=`<td rowspan="4"></td>`;  
                              row +=`<td  rowspan="4">`;
                            row +=`<div id="budget-c-1-pro-alert" class="margin-none form-group input-text-pilihan">`;
                                        row +=`<input min="0" disabled type="number" id="budget-sektor" placeholder="Budget" value="${item.budget_sektor }" oninput="this.value = Math.abs(this.value)" name="budget_sektor" class="form-control pelaksanaan-budget pemetaan-budget text-right">`;
                                 row +=`<span id="budget-c-1-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                             row +=`<td rowspan="4"></td>`;
                             row +=`<td  rowspan="4">`;
                            row +=`<div id="realisasi-c-1-pro-alert" class="margin-none form-group input-text-pilihan">`;
                                        row +=`<input min="0" disabled type="number" id="realisasi-sektor" placeholder="Relalisasi" value="${item.realisasi_sektor }" oninput="this.value = Math.abs(this.value)" name="realisasi_sektor" class="form-control pelaksanaan-realisasi pemetaan-realisasi text-right">`;
                                 row +=`<span id="realisasi-c-1-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td rowspan="4"></td>`;
                              row +=`<td rowspan="4">`;
                                  if(item.keterangan_sektor)
                                  {    
                                        row +=`<div class="potensi-sektor">`;
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_sektor }" data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;
                                          row +=`</div>`;

                                            row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                        row +=`</div>`;
                                   }else{  
                                      row +=`<div class="font-bold text-center"> ... </div>`;
                                   } 

                                 
                              row +=`</td>`;  
                           
                         row +=`</tr> `;

                          row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;

                                 if(item.checklist_shift_share == 'true')
                                 {
                                     row +=`<td><input checked disabled name="checklist_shift_share" id="checklist-shift-share"  type="checkbox" class="checkbox-pengolahan item-sektor" value="${item.checklist_shift_share }"></td>`;
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_shift_share" value="${item.checklist_shift_share }"></td>`;  
                                 } 

                            
                              row +=`<td  class="font-bold table-number">`;
                                 row +=`2.`;
                              row +=`</td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> Shift Share</td>`;
                             
         
                           
                         row +=`</tr>`; 

                          row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td><input disabled name="checklist_tipologi_sektor" id="checklist-tipologi-sektor" value="false" type="checkbox" class="checkbox-pengolahan item-sektor"></td>`;
                              row +=`<td  class="font-bold table-number">`;
                                    row +=`3.`;
                              row +=`</td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> Tipologi Sektor</td>`;
                             
                        
                           
                         row +=`</tr>`; 

                          row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td><input disabled name="checklist_klassen" id="checklist-klassen" value="false" type="checkbox" class="checkbox-pengolahan item-sektor"></td>`;
                              row +=`<td  class="font-bold table-number">`;
                                   row +=` 4.`;
                              row +=`</td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> Klassen</td>`;
                             
                           
                         row +=`</tr>`; 

                         row +=`<tr>`; 
                              row +=`<td></td>`; 
                              row +=`<td></td>`; 
                              row +=`<td class="font-bold">D.</td>`; 

                              row +=`<td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Klarifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 

                             row +=`<td  colspan="2" class="text-center font-bold">`; 
                                   row +=`<div >Swakelola</div>`; 
                              row +=`</td>`; 
                             
                              row +=`<td></td>`; 
                              row +=`<td>`;              
                              
                                   row +=`<div id="startdate-d-pro-alert" class="margin-none form-group">`;  
                                        row +=`<input type="date" disabled value="${item.tgl_awal_fgd_klarifikasi }" id="startdate-d-pro" name="startdate_d_pro" class="form-control">`; 
                                        row +=`<span id="startdate-d-pro-messages"></span>`; 
                                   row +=`</div>`; 
                             row +=`</td>`; 
                             row +=`<td></td>`; 
                              row +=`<td>`; 
                                   row +=`<div id="enddate-d-pro-alert" class="margin-none form-group">`;  
                                        row +=`<input type="date" disabled value="${item.tgl_ahir_fgd_klarifikasi }" id="enddate-d-pro" name="enddate_d_pro" class="form-control">`; 
                                        row +=`<span id="enddate-d-pro-messages"></span>`; 
                                   row +=`</div>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 
                              row +=`<td>`; 
                                row +=`<div id="budget-d-pro-alert" class="margin-none form-group">`; 
                                        row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_fgd_klarifikasi }" oninput="this.value = Math.abs(this.value)" id="budget-d-pro" name="budget_d_pro" class="form-control pelaksanaan-budget pemetaan-budget swakelola-budget text-right">`; 
                                 row +=`<span id="budget-d-pro-messages"></span>`; 
                                 row +=`</div>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 
                              row +=`<td>`; 
                                  row +=`<div id="realisasi-d-pro-alert" class="margin-none form-group">`; 
                                        row +=`<input min="0" disabled="" type="number" placeholder="Realisasi" value="${item.realisasi_fgd_klarifikasi }" oninput="this.value = Math.abs(this.value)" id="realisasi-d-pro" name="realisasi_d_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi text-right">`; 
                                 row +=`<span id="realisasi-d-pro-messages"></span>`; 
                                 row +=`</div>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 
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
                         row +=`</tr>`; 

                         row +=`<tr>`; 
                              row +=`<td></td>`; 
                              row +=`<td></td>`; 
                              row +=`<td class="font-bold">E.</td>`; 

                              row +=`<td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 

                             row +=`<td  colspan="2" class="text-center font-bold">`; 
                                   row +=`<div >Swakelola</div>`; 
                              row +=`</td>`; 
                             
                              row +=`<td></td>`; 
                              row +=`<td>`;       
                                     
                                row +=`<div id="startdate-e-pro-alert" class="margin-none form-group">`;  
                                   row +=`<input type="date" disabled value="${item.tgl_awal_finalisasi }" id="startdate-e-pro" name="startdate_e_pro" class="form-control">`; 
                                   row +=`<span id="startdate-e-pro-messages"></span>`; 
                                row +=`</div>`; 
                             row +=`</td>`; 
                             row +=`<td></td>`; 
                              row +=`<td>`; 
                                   row +=`<div id="enddate-e-pro-alert" class="margin-none form-group">`;  
                                        row +=`<input type="date" disabled value="${item.tgl_ahir_finalisasi }"  id="enddate-e-pro" name="enddate_e_pro" class="form-control">`; 
                                     row +=`<span id="enddate-e-pro-messages"></span>`; 
                                   row +=`</div>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 
                              row +=`<td>`; 
                                row +=`<div id="budget-e-pro-alert" class="margin-none form-group">`; 
                                        row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_finalisasi }" oninput="this.value = Math.abs(this.value)" id="budget-e-pro" name="budget_e_pro" class="form-control pelaksanaan-budget pemetaan-budget swakelola-budget text-right">`; 
                                 row +=`<span id="budget-e-pro-messages"></span>`; 
                                row +=`</div>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 
                              row +=`<td>`; 
                                 row +=`<div id="realisasi-e-pro-alert" class="margin-none form-group">`; 
                                        row +=`<input min="0" disabled type="number" placeholder="Realisasi" value="${item.realisasi_finalisasi }" oninput="this.value = Math.abs(this.value)" id="realisasi-e-pro" name="realisasi_e_pro" class="form-control pelaksanaan-realisasi pemetaan-realisasi text-right">`; 
                                 row +=`<span id="realisasi-e-pro-messages"></span>`; 
                                row +=`</div>`; 
                              row +=`</td>`; 
                              row +=`<td></td>`; 
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
                         row +=`</tr> `;

                           row +=`<tr>`;
                             row +=`<td class="font-bold text-center">3</td>`;
                             row +=`<td></td>`;
                             row +=`<td colspan="16" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : Investasi : </td>`;
                             row +=`<td align="right"><strong id="total-penyusunan-budget">${item.total_budget_penyusunan }</strong></td>`;
                               row +=`<td></td>`;
                               row +=`<td align="right"><strong id="total-penyusunan-realisasi">${item.total_realisasi_penyusunan }</strong></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td> `;      
                          row +=`</tr> `;

                          row +=`<tr> `;
                              row +=`<td></td> `;
                              row +=`<td></td> `;
                              row +=`<td class="font-bold">A.</td> `;

                              row +=`<td class="-abjad font-bold" colspan="20"> `;
                                   row +=`<div > Menyusun hasil identifikasi, pengolahan, dan analisis data dalam bentuk dokumen : </div> `;
                                  row +=`<span id="pengolahan-messages"></span> `;
                              row +=`</td>   `; 
                             
                        row +=`</tr>  `;

                        row +=`<tr> `;
                              row +=`<td></td> `;
                              row +=`<td></td> `;
                              row +=`<td></td> `;

                                 if(item.checklist_summary_sektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_summary_sektor_unggulan" value="${item.checklist_summary_sektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_summary_sektor_unggulan" value="${item.checklist_summary_sektor_unggulan }"></td>`;  
                                 }  

                             

                              row +=`</td> `;
                              row +=`<td  class="font-bold table-number"> `;
                                 row +=` 1. `;
                              row +=`</td> `;
                              row +=`<td class="-abjad font-bold" colspan="5"> Deskripsi singkat sektor unggulan</td> `;
                             
                              row +=`<td rowspan="7"></td> `;
                              row +=`<td  colspan="2"  rowspan="7" class="text-center font-bold"> `;
                                   row +=`<div class="penyusunan-peta">Jasa Konsultan</div> `;
                              row +=`</td> `;
                              row +=`<td rowspan="7"></td> `;
                              row +=`<td  rowspan="7"> `;
                              row +=`<div id="startdate-a-ppro-alert" class="margin-none form-group penyusunan-peta"> `; 
                                  row +=`<input type="date" disabled="" id="startdate-penyusunan" name="startdate_penyusunan" value="${item.tgl_awal_penyusunan }" class="form-control"> `;
                                   row +=`<span id="startdate-a-ppro-messages"></span> `;
                            row +=`</div> `;
                        row +=` </td> `;
                         row +=`<td rowspan="7"></td> `;
                              row +=`<td  rowspan="7"> `;
                            row +=`<div id="enddate-a-ppro-alert" class="margin-none form-group penyusunan-peta">  `;
                                      row +=`<input type="date" disabled id="enddate-penyusunan" name="enddate_penyusunan" value="${item.tgl_ahir_penyusunan }" class="form-control"> `;
                                 row +=`<span id="enddate-a-ppro-messages"></span> `;
                            row +=`</div> `;
                             row +=`</td> `;
                            row +=`<td rowspan="7"></td>  `; 
                              row +=`<td  rowspan="7"> `;
                            row +=`<div id="budget-a-ppro-alert" class="margin-none form-group penyusunan-peta"> `;
                                        row +=`<input min="0" disabled type="number" placeholder="Budget" value="${item.budget_penyusunan }" oninput="this.value = Math.abs(this.value)" id="budget-penyusunan" name="budget_penyusunan" class="form-control penyusunan-budget pemetaan-budget text-right"> `;
                                 row +=`<span id="budget-a-ppro-messages"></span> `;
                            row +=`</div> `;
                              row +=`</td> `;
                             row +=`<td rowspan="7"></td> `;
                             row +=`<td  rowspan="7"> `;
                            row +=`<div id="realisasi-a-ppro-alert" class="margin-none form-group penyusunan-peta"> `;
                                       row +=`<input min="0" disabled="" type="number" placeholder="Budget" value="${item.realisasi_penyusunan }" oninput="this.value = Math.abs(this.value)" id="realisasi-penyusunan" name="realisasi_penyusunan" class="form-control penyusunan-realisasi pemetaan-realisasi text-right"> `;
                                 row +=`<span id="realisasi-a-ppro-messages"></span> `;
                            row +=`</div> `;
                              row +=`</td> `;
                              row +=`<td rowspan="7"></td> `;
                              row +=`<td rowspan="7"> `;
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
                                 
                              row +=`</td> `;  
                           
                         row +=`</tr> `; 

                          row +=`<tr> `;
                             row +=`<td></td> `;
                              row +=`<td></td> `;
                              row +=`<td></td> `;

                                 if(item.checklist_sektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_sektor_unggulan" value="${item.checklist_sektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_sektor_unggulan" value="${item.checklist_sektor_unggulan }"></td>`;  
                                 } 

                              
                              row +=`<td  class="font-bold table-number"> `;
                                 row +=`  2. `;
                              row +=`</td> `;
                              row +=`<td class="-abjad font-bold" colspan="5"> Deskripsi sektor unggulan</td> `;
                             
         
                           
                         row +=`</tr> `;

                          row +=`<tr>`;
                              row +=`<td></td>`;
                             row +=`<td></td>`;
                              row +=`<td></td>`;

                                 if(item.checklist_potensi_pasar == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_potensi_pasar" value="${item.checklist_potensi_pasar }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_potensi_pasar" value="${item.checklist_potensi_pasar }"></td>`;  
                                 } 

                            
                              row +=`<td  class="font-bold table-number">`;
                                 row +=` 3.`;
                              row +=`</td>`;
                               row +=`<td class="-abjad font-bold" colspan="5"> Potensi pasar</td>`;
                         row +=`</tr> `;

                          row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;

                                 if(item.checklist_parameter_sektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_parameter_sektor_unggulan" value="${item.checklist_parameter_sektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_parameter_sektor_unggulan" value="${item.checklist_parameter_sektor_unggulan }"></td>`;  
                                 } 

                              row +=`<td  class="font-bold table-number">`;
                                row +=`4.`;
                              row +=`</td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> Parameter data sektor unggulan</td>`;
                         row +=`</tr> `;

                         row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                                 if(item.checklist_subsektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_subsektor_unggulan" value="${item.checklist_subsektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_subsektor_unggulan" value="${item.checklist_subsektor_unggulan }"></td>`;  
                                 } 

                             
                              row +=`<td  class="font-bold table-number">`;
                                 row +=` 5.`;
                             row +=` </td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</td>`;
                             
                           
                         row +=`</tr>`; 

                         

                          row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;

                                 if(item.checklist_intensif_daerah == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_intensif_daerah" value="${item.checklist_intensif_daerah }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_intensif_daerah" value="${item.checklist_intensif_daerah }"></td>`;  
                                 } 

                              row +=`<td  class="font-bold table-number" >`;
                                 row +=` 6. `;
                              row +=`</td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> Insentif daerah</td>`;
                             
         
                           
                        row +=` </tr>`; 

                          row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;

                                 if(item.checklist_potensi_lanjutan == 'true')
                                 {
                                     row +=`<td><input disabled type="checkbox" checked name="checklist_potensi_lanjutan" value="${item.checklist_potensi_lanjutan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled type="checkbox" name="checklist_potensi_lanjutan" value="${item.checklist_potensi_lanjutan }"></td>`;  
                                 } 

                              row +=`<td  class="font-bold table-number">`;
                                 row +=` 7. `;
                              row +=`</td>`;
                              row +=`<td class="-abjad font-bold" colspan="5"> Potensi lanjutan komoditas sektor unggulan</td>`;

                         row +=`</tr>`;

                         row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td class="font-bold">B.</td>`;

                              row +=`<td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Penyusunan Infografis Peta Potensi Investasi dalam 2 bahasa (bahasa indonesia dan bahasa inggris)</textarea></td>`;
                              row +=`<td></td>`;

                             row +=`<td  colspan="2" class="text-center font-bold">`;
                                   row +=`<div >Swakelola</div>`;
                              row +=`</td>`;
                             
                              row +=`<td></td>`;
                              row +=`<td>`;      
                                  row +=`<div id="startdate-b-ppro-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date" disabled id="startdate-b-ppro" name="startdate_b_ppro" value="${item.tgl_awal_info_grafis }" class="form-control">`;
                                   row +=`<span id="startdate-b-ppro-messages"></span>`;
                                  row +=`</div>`;
                             row +=`</td>`;
                             row +=`<td></td>`;
                              row +=`<td>`;
                                  row +=`<div id="enddate-b-ppro-alert" class="margin-none form-group"> `;
                                        row +=`<input type="date" disabled value="${item.tgl_ahir_info_grafis }" id="enddate-b-ppro" name="enddate_b_ppro" class="form-control">`;
                                    row +=`<span id="enddate-b-ppro-messages"></span>`;
                                  row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
                              row +=`<td>`;
                               row +=` <div id="budget-b-ppro-alert" class="margin-none form-group">`;
                                        row +=`<input min="0" disabled="" type="number" placeholder="Budget" value="${item.budget_info_grafis }" oninput="this.value = Math.abs(this.value)" id="budget-b-ppro" name="budget_b_ppro" class="form-control penyusunan-budget pemetaan-budget swakelola-budget text-right">`;
                                 row +=`<span id="budget-b-ppro-messages"></span>`;
                                 row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
                              row +=`<td>`;
                                 row +=`<div id="realisasi-b-ppro-alert" class="margin-none form-group">`;
                                        row +=`<input min="0" disabled="" type="number" placeholder="Realisasi" value="${item.realisasi_info_grafis }" oninput="this.value = Math.abs(this.value)" id="realisasi-b-ppro" name="realisasi_b_ppro" class="form-control penyusunan-realisasi pemetaan-realisasi text-right">`;
                                 row +=`<span id="realisasi-b-ppro-messages"></span>`;
                                 row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
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
                        row +=`</tr> `;

                        row +=`<tr>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td class="font-bold">C.</td>`;

                              row +=`<td class="-abjad font-bold" colspan="7"><textarea readonly class="textarea-table">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</textarea></td>`;
                              row +=`<td></td>`;

                             row +=`<td  colspan="2" class="text-center font-bold">`;
                                    row +=`<div >Swakelola</div>`;
                              row +=`</td>`;
                             
                              row +=`<td></td>`;
                              row +=`<td>`;   
                                 row +=`<div id="startdate-c-ppro-alert" class="margin-none form-group">`; 
                                   row +=`<input type="date" disabled value="${item.tgl_awal_dokumentasi }" id="startdate-c-ppro" name="startdate_c_ppro" class="form-control">`;
                                   row +=`<span id="startdate-c-ppro-messages"></span>`;
                                 row +=`</div> `;   
                                 
                             row +=`</td>`;
                             row +=`<td></td>`;
                              row +=`<td>`;
                                 row +=`<div id="enddate-c-ppro-alert" class="margin-none form-group"> `;
                                             row +=`<input type="date" disabled id="enddate-c-ppro" name="enddate_c_ppro" value="${item.tgl_ahir_dokumentasi }" class="form-control">`;
                                      row +=`<span id="enddate-c-ppro-messages"></span>`;
                                 row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
                              row +=`<td>`;
                                 row +=`<div id="budget-c-ppro-alert" class="margin-none form-group">`;
                                        row +=`<input min="0" disabled="" type="number" placeholder="Budget" value="${item.budget_dokumentasi }" oninput="this.value = Math.abs(this.value)" id="budget-c-ppro" name="budget_c_ppro" class="form-control penyusunan-budget pemetaan-budget swakelola-budget text-right">`;
                                   row +=`<span id="budget-c-ppro-messages"></span>`;
                                   row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
                              row +=`<td>`;
                                   row +=`<div id="realisasi-c-ppro-alert" class="margin-none form-group">`;
                                        row +=`<input min="0" disabled="" type="number" placeholder="Realisasi" value="${item.realisasi_dokumentasi }" oninput="this.value = Math.abs(this.value)" id="realisasi-c-ppro" name="realisasi_c_ppro" class="form-control penyusunan-realisasi pemetaan-realisasi text-right">`;
                                   row +=`<span id="realisasi-c-ppro-messages"></span>`;
                                   row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td></td>`;
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
                         row +=`</tr> `;
       
				   
                  if(item.access == 'province'){
                  	 BtnAction(item);
                  }	
				   
			        if(item.request_edit == 'true')
                        { 
                          $('#div-edit').show();
                          $('#status-view').html('<b>Proses</b> (Waiting Request Edit)');
                          if(item.request_edit_by =="member")
                          {
                            $('#alasan-edit-view').html('<b>Alasan Edit : '+item.alasan+'</b>').addClass('col-lg-12 text-red');
                          }else{
                             $('#alasan-edit-view').html('<b>Permintaan Request edit dari PUSAT  : '+item.alasan+'</b>').addClass('col-lg-12 text-red');   
                          }   
                         
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
             row +=`<td colspan="23" align="center">Data Kosong</td>`;
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
      

                let row = ``;
                      row +=`<div class="modal-dialog">`;
                          row +=`<div class="modal-content">`;

                                     row +=`<div class="modal-header">`;
                                       row +=`<button type="button" class="clear-input close" data-dismiss="modal">&times;</button>`;
                                       row +=`<h4 class="modal-title">Lihat File PDF</h4>`;
                                     row +=`</div>`;

                                    
                                     row +=`<div class="modal-body">`;
                                      row +=`<embed src="`+file+`#page=1&zoom=65" width="575" height="500">`;
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
         $('#selectPeriode').html('<select  id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>');
          $.ajax({
               type: 'GET',
               dataType: 'json',
               url: BASE_URL +'/api/select-periode?type=GET&action=pemetaan',
               success: function(data) {

                   getperiodeList(data);
                   // if(periode_id > '2023')
                   // {
                      $('#periode_id').prop('disabled', false).val(periode_id).selectpicker('refresh');
                   // }else{
                   //    $('#periode_id').prop('disabled', true).val(periode_id).selectpicker('refresh');
                   // } 
                   
                   
                   
               },
               error: function( error) {}
          });

         
      }


      function getperiodeList(data){

                var select =  $('#periode_id');
                 select.empty();
                 $.each(data.result, function(index, option) {
                      select.append($('<option>', {
                           value: option.value,
                           text: option.text
                      }));
                 });
                  select.selectpicker('refresh'); 
                  periode = data.result;          
        }
 });
</script>
@stop

