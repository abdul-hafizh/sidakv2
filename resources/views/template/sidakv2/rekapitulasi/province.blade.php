@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">    
    <div class="row padding-default" style="margin-bottom: 20px">
       
  <div class="content">
    <div class="clearfix"></div>
    <div class="clearfix"></div> 
   
      <div class="box box-solid box-primary">
        <div class="box-body padding-default">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover" >
                    <thead class="bg-table">
                        <tr>
                             <th   class="text-center  font-bold bg-table-radius-left">
                                <span class="pd-top-12 ">Sub Menu</span>
                            </th>
                            <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th   class="text-center">
                                <span class="pd-top-12 width-daerah">Target Output</span>
                            </th>
                            <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>

                            <th   class="text-center">
                                <span class="pd-top-12 width-daerah">Pagu APBN</span>
                            </th>
                             <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>

                            <th   class="text-center">
                                <span class="pd-top-12 width-daerah">Realisasi Target Output</span>
                            </th>
                            <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>

                            <th   class="text-center font-bold bg-table-radius-right">
                                <span class="pd-top-12 width-daerah">Realisasi Pagu APBN</span>
                            </th>


                            
                        </tr>
                       
                        
                    </thead>

                     <tbody id="conheaderrekapitulasi">
                        
                    
                     </tbody>
                </table>
                
            </div>
        </div>
    </div>
       

    </div>
        
    </div>

    <div class="row margin-top-bottom-20">
           <div class="pull-left" style="margin-bottom: 9px;">
                <select id="row_page" class="selectpicker" data-style="bg-navy" >
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">All</option>
                </select>
            </div>

            <div   class="col-sm-2" style="margin-bottom: 9px;">
                <button type="button" id="ExportButton"  class="btn btn-info border-radius-10">
                     Export
                </button>
            </div>


        <div class="col-sm-2" style="margin-bottom: 9px;">
                 <div id="selectPeriode" class="form-group margin-none"></div>
        </div>

        <div class="col-sm-2" style="margin-bottom: 9px;">

                <select id="semester_id"  name="semester_id" class="selectpicker">
                    <option value="01">Semester 1</option>
                    <option value="02">Semester 2</option>
                </select>
        </div>


       
        
         
        <div class="col-lg-2">
            <div class="btn-group">
                <button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
                <button id="Reset" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
    </div>  


        <div  class="pull-right width-50">
            <ul id="pagination" class="pagination-table pagination"></ul>
        </div>
    
   
</section>


<div class="content">
    <div class="clearfix"></div>
    <div class="clearfix"></div> 


    <div class="box box-solid box-primary">
        <div class="box-body padding-default">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover" border="0">
                    <thead class="bg-table">
                        <tr>
                             <th rowspan="2"  class="text-center  font-bold bg-table-radius-left">
                                <span class="pd-top-12 ">No</span>
                            </th> 
                            <th  rowspan="2" class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th rowspan="2"  class="text-center">
                                <span class="pd-top-12 width-daerah">Nama Daerah</span>
                            </th>
                            <th  rowspan="2" class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                         
                            <th colspan="7" class="text-center font-bold border-bottom-th">  
                              <span class="pd-top-12">Pengawasan</span> 
                            </th>
                             <th  rowspan="2" class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                         
                            <th colspan="7" class="text-center font-bold " >
                              <span class="pd-top-12">Bimsos</span>
                            </th>
                             <th rowspan="2"  class="text-center font-bold " >
                              <div class="split-table-white"></div>
                            </th>
                             <th colspan="7" class="text-center font-bold " >
                              <span class="pd-top-12">Penyelesaian</span>
                            </th>
                            <th rowspan="2"  class="text-center font-bold " >
                              <div class="split-table-white"></div>
                            </th>
                         
                            <th colspan="7"  class="text-center  font-bold">
                                <span class="pd-top-12 ">Promosi</span>
                            </th>
                            <th  rowspan="2" class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                             <th colspan="3"  class="text-center  font-bold bg-table-radius-right-top">
                                <span class="pd-top-12 ">Total</span>
                            </th>
                       


                            
                        </tr>
                        <tr>
                            <th  class="text-center font-bold">   
                                <span class="pd-top-12">Target</span>
                            </th>
                             <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold">
                               <span class="span-title width-pagu">Pagu</span>
                            </th>
                              <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold">   
                                <span class="pd-top-12">Realisasi Target</span>
                            </th>
                             <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold">
                               <span class="span-title width-pagu">Realisasi Pagu</span>
                            </th>
                            
                            <th  class="text-center font-bold">   
                                <span class="pd-top-12">Target</span>
                            </th>
                             <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold">
                               <span class="span-title width-pagu">Pagu</span>
                            </th>
                            <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                             <th  class="text-center font-bold" >   
                                <span class="pd-top-12">Realisasi Target</span>
                            </th>
                             <th   class="text-center font-bold" >
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold " >
                               
                               <span class="span-title width-pagu">Realisasi Pagu</span>
                            </th>

                            <th  class="text-center font-bold">   
                                <span class="pd-top-12">Target</span>
                            </th>
                             <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold">
                               <span class="span-title width-pagu">Pagu</span>
                            </th>
                            <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                             <th  class="text-center font-bold " >   
                                <span class="pd-top-12">Realisasi Target</span>
                            </th>
                             <th   class="text-center font-bold " >
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold " >
                               
                               <span class="span-title width-pagu">Realisasi Pagu</span>
                            </th>

                            <th  class="text-center font-bold">   
                                <span class="pd-top-12">Target</span>
                            </th>
                             <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold">
                               <span class="span-title width-pagu">Pagu</span>
                            </th>
                            <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                             <th  class="text-center font-bold " >   
                                <span class="pd-top-12">Realisasi Target</span>
                            </th>
                             <th   class="text-center font-bold " >
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold " >
                               
                               <span class="span-title width-pagu">Realisasi Pagu</span>
                            </th>
                            
                            <th  class="text-center font-bold">   
                                <span class="pd-top-12">Total Target</span>
                            </th>
                             <th   class="text-center font-bold">
                              <div class="split-table-white"></div>
                            </th>
                            <th  class="text-center font-bold  bg-table-radius-right-bottom">
                               <span class="span-title width-pagu">Total Pagu</span>
                            </th>
                        </tr> 
                        
                    </thead>

                     <tbody id="conrekapitulasi" >
                        
                    
                     </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div> 
 @include('template/sidakv2/rekapitulasi.export')
 

<script type="text/javascript">
    $(document).ready(function() { 
       var date = new Date(); 
       var year = date.getFullYear();
       var mounth = date.getMonth() + 1;
       var periode_val = year;
       var semester_val = '';
       var periode = [];
       var daerah_id = '';


         const itemsPerPage = 10; // Number of items to display per page
        let currentPage = 1; // Current page number
        let previousPage = 1; // Previous page number
        const visiblePages = 5; // Number of visible page links in pagination
        let page = 1;
        var list = [];
        const total = 0;

       if(mounth >6)
       {
          semester_val = '02';
         
       }else{
          semester_val = '01';
          
       } 
       
       
       
       if(year > '2023')
       {
          $('#total-convert').html('<span>Total Peta Potensi </span><h3 class="card-text" id="total-promosi"></h3>');
       }else{
          $('#total-convert').html('<span>Total Promosi </span><h3 class="card-text" id="total-promosi"></h3>');
       } 

        $("#ExportButton").click(function() {
         
            $.ajax({
                url: BASE_URL+ `/api/rekapitulasi?page=${page}&per_page=all&periode_id=${periode_val}&semester_id=${semester_val}`,
                method: 'GET',
                success: function(response) {
                    
                     exportData(response.data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });

            
          });
  
    

       getperiode(year);
       getsemester(semester_val);
       getdaerah();
       getRekapitulasi();


        $('#row_page').on('change', function() {
            var value = $(this).val();         
            if(value)
            {   

                const content2 = $('#conheaderrekapitulasi');
                content2.empty();
                let row2 = ``;
                row2 +=`<tr><td colspan="10" align="center"> <b>Loading ...</b></td></tr>`;
                content2.append(row2);

                 const content = $('#conrekapitulasi');
                
                 let row = ``;
                 row +=`<tr><td colspan="17" align="center"> <b>Loading ...</b></td></tr>`;
                 content.append(row);
                 content.empty();
                  let search = $('#search-input').val();
                  // if(search !='')
                  // {
                  //   var url = BASE_URL + `/api/rekapitulasi/search?page=${page}&per_page=${value}&periode_id=${periode_val}&semester_id=${semester_val}`;
                  //   var method = 'POST';
                  // }else{
                    var url = BASE_URL + `/api/rekapitulasi?page=${page}&per_page=${value}&periode_id=${periode_val}&semester_id=${semester_val}`;
                    var method = 'GET';
                  //}     
                  
                $.ajax({
                    url: url,
                    method: method,
                    data:{'search':search},
                    success: function(response) {
                        list = response.rekapitulasi.data;
                        ShowHeader(response.header)
                        ShowData(response.rekapitulasi.data)
                        updatePagination(response.rekapitulasi.current_page, response.rekapitulasi.last_page);

                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }    
    // Perform other actions based on the selected value
    });


       $('#Search').click( () => {
         let periode_id = $('#periode_id').val();
         let semester_id = $('#semester_id').val();
         let daerah_id = $('#daerah_id').val();
             
                const content1 = $('#conrekapitulasi');
                content1.empty();
                let row1 = ``;
                row1 +=`<tr><td colspan="17" align="center"> <b>Loading ...</b></td></tr>`;
                content1.append(row1);

                const content2 = $('#conheaderrekapitulasi');
                content2.empty();
                let row2 = ``;
                row2 +=`<tr><td colspan="10" align="center"> <b>Loading ...</b></td></tr>`;
                content2.append(row2);

              

                if(periode_id > '2023')
                {
                  $('#total-convert').html('<span>Total Peta Potensi </span><h3 class="card-text" id="total-promosi"></h3>');
                }else{
                  $('#total-convert').html('<span>Total Promosi </span><h3 class="card-text" id="total-promosi"></h3>');
                } 
  

            
             $.ajax({
                url: BASE_URL +'/api/rekapitulasi?periode_id='+ periode_id +'&semester_id='+ semester_id +'&daerah_id='+ daerah_id +'',
                method: 'GET',
                success: function(response) {
                   
                        list = response.rekapitulasi.data;
                        ShowHeader(response.header)
                        ShowData(response.rekapitulasi.data)
                        updatePagination(response.rekapitulasi.current_page, response.rekapitulasi.last_page);

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
             
    });
  

        
        function getperiode(periode_id){
               $('#selectPeriode').html('<select id="periode_id"  name="periode_id" title="Pilih Periode"   class="selectpicker"></select>');
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=GET&action=dashboard',
                    success: function(data) {
                         getperiodeList(data);

                        
                         $('#periode_id').val(periode_id).selectpicker('refresh');
                       
                              
                            
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
        }



        function  getsemester(semester_val)
        {
         
          
           $('#semester_id').val(semester_val);
           $('#semester_id').selectpicker('refresh');

        } 

        function getdaerah(){

           $.ajax({
                url: BASE_URL +'/api/select-daerah',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate SelectPicker options using received data
                    $.each(data, function(index, option) {
                        $('#daerah_id').append($('<option>', {
                          value: option.value,
                          text: option.text
                        }));
                    });

                    // Refresh the SelectPicker to apply the new options
                    $('#daerah_id').selectpicker('refresh');
                },
                error: function(error) {
                    console.error(error);
                }
            });

        } 

        function getRekapitulasi(){

                const content1 = $('#conrekapitulasi');
                content1.empty();
                let row1 = ``;
                row1 +=`<tr><td colspan="29" align="center"> <b>Loading ...</b></td></tr>`;
                content1.append(row1);


                const content2 = $('#conheaderrekapitulasi');
                content2.empty();
                let row2 = ``;
                row2 +=`<tr><td colspan="10" align="center"> <b>Loading ...</b></td></tr>`;
                content2.append(row2);

                

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +`/api/rekapitulasi?page=${page}&per_page=${itemsPerPage}&periode_id=${periode_val}&semester_id=${semester_val}`,
                    success: function(response) {

                       header = response.header;
                       list = response.rekapitulasi.data;
                       ShowHeader(response.header)
                       ShowData(response.rekapitulasi.data)
                       updatePagination(response.rekapitulasi.current_page, response.rekapitulasi.last_page);
                    },
                    error: function( error) {}
               });

        }

         function ShowHeader(data){
             const content = $('#conheaderrekapitulasi');
               content.empty();
            if(data.length>0)
            {
                data.forEach(function(item, index) {
                let row = ``;
                      row +=`<tr>`;
                      row +=`<td><b>${item.sub_menu}</b></td>`;
                      row +=`<td></td>`;
                      row +=`<td align="center">${item.target}</td>`;
                      row +=`<td></td>`;
                      row +=`<td align="right"><b>${item.pagu.convert}</b></td>`;
                      row +=`<td></td>`;
                       row +=`<td align="center">${item.realisasi_target}</td>`;
                      row +=`<td></td>`; 
                      row +=`<td align="right"><b>${item.realisasi_apbn.convert}</b></td>`;
                   
                      row +=`</tr>`;
                      content.append(row);
                });
            }else{

                 let row = ``;
             row +=`<tr>`;
             row +=`<td colspan="10" align="center">Data Kosong</td>`;
             row +=`</tr>`;
             content.append(row);

            }    
           
        }

        function ShowData(data){
           
            contentData(data)
           
        }

        function ExportExel()
    {
        var dt = new Date();
       var time =  dt.getDate() + "-"
                + (dt.getMonth()+1)  + "-" 
                + dt.getFullYear();

      var table = document.getElementById("myTable");
      var ws = XLSX.utils.table_to_sheet(table);
      var wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
      XLSX.writeFile(wb, "Rekap-Mon-DAK-"+ time +".xlsx");

    }
        function contentData(data){
 
            const content = $('#conrekapitulasi');
            var semester =  $('#semester_id').val();
             if(semester == "02")
             {
              semester_val = '02';
              $('.semesterParamTarget').show();
              $('.semesterParamPagu').show();
             }else{
              semester_val = '01';
               $('.semesterParamTarget').hide();
              $('.semesterParamPagu').hide();
            } 



            content.empty();
            if(data.length>0)
            {
                data.forEach(function(item, index) {
                let row = ``;
                row +=`<tr>`;
                 row +=`<td>${item.number}</td>`;
                   row +=`<td></td>`;
                 row +=`<td>${item.fullname}</td>`;
                 row +=`<td></td>`;
                 row +=`<td align="center">${item.pengawas_target}</td>`;
                 row +=`<td></td>`;
                 row +=`<td align="right">${item.pengawas_pagu_convert}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="center">${item.pengawas_realisasi_target}</td>`;  
                 row +=`<td></td>`;
                 row +=`<td  align="right">${item.pengawas_realisasi_apbn_convert}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="center">${item.bimsos_target}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="right">${item.bimsos_pagu_convert}</td>`;
                 row +=`<td></td>`
                 row +=`<td  align="center">${item.bimsos_realisasi_target}</td>`;  
                 row +=`<td></td>`;
                 row +=`<td  align="right">${item.bimsos_realisasi_apbn_convert}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="center">${item.penyelesain_target}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="right">${item.penyelesain_pagu_convert}</td>`;
                 row +=`<td></td>`
                 row +=`<td  align="center">${item.penyelesain_realisasi_target}</td>`;  
                 row +=`<td></td>`;
                 row +=`<td  align="right">${item.penyelesain_realisasi_apbn_convert}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="center">${item.promosi_target}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="right">${item.promosi_pagu_convert}</td>`;
                 row +=`<td></td>`
                 row +=`<td  align="center">${item.promosi_realisasi_target}</td>`;  
                 row +=`<td></td>`;
                 row +=`<td  align="right">${item.promosi_realisasi_apbn_convert}</td>`;
                 row +=`<td></td>`;
                 row +=`<td  align="center">${item.total_target}</td>`;  
                 row +=`<td></td>`;
                 row +=`<td  align="center">${item.total_pagu_convert}</td>`;      
                row +=`</tr>`;
                content.append(row);
                }); 
            }else{

             let row = ``;
             row +=`<tr>`;
             row +=`<td colspan="16" align="center">Data Kosong</td>`;
             row +=`</tr>`;
             content.append(row);
            
            }
        }

       function exportData(data){

         const content = $('#exportView');
         content.empty();
         if(data.length>0)
         {
            // Populate content with new data
            data.forEach(function(item, index) {
                let row = ``;
                 row +=`<tr>`;

                   row +=`<td>${item.number}</td>`;
                 row +=`<td>${item.fullname}</td>`;
                 row +=`<td align="center">${item.pengawas_target}</td>`;
                 row +=`<td align="right">${item.pengawas_pagu}</td>`;
                 row +=`<td  align="center">${item.pengawas_realisasi_target}</td>`;  
                 row +=`<td  align="right">${item.pengawas_realisasi_apbn}</td>`;
                 row +=`<td  align="center">${item.bimsos_target}</td>`;
                 row +=`<td  align="right">${item.bimsos_pagu}</td>`;
                 row +=`<td  align="center">${item.bimsos_realisasi_target}</td>`;  
                 row +=`<td  align="right">${item.bimsos_realisasi_apbn}</td>`;
                 row +=`<td  align="center">${item.penyelesain_target}</td>`;
                 row +=`<td  align="right">${item.penyelesain_pagu}</td>`;
                 row +=`<td  align="center">${item.penyelesain_realisasi_target}</td>`;  
                 row +=`<td  align="right">${item.penyelesain_realisasi_apbn}</td>`;
                 row +=`<td  align="center">${item.promosi_target}</td>`;
                 row +=`<td  align="right">${item.promosi_pagu}</td>`;
                 row +=`<td  align="center">${item.promosi_realisasi_target}</td>`;  
                 row +=`<td  align="right">${item.promosi_realisasi_apbn}</td>`;
                 row +=`<td  align="center">${item.total_target}</td>`;  
                 row +=`<td  align="center">${item.total_pagu}</td>`;
                 row +=`</tr>`;

               content.append(row);
             });     

         }     

         ExportExel();   
          
    }

    // Function to update pagination controls
    function updatePagination(currentPage, totalPages) {
        const pagination = $('#pagination');

        // Clear previous pagination
        pagination.empty();

        // Calculate start and end page for visible links
        let startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
        let endPage = Math.min(totalPages, startPage + visiblePages - 1);

        //Create "First Page" button
        if (currentPage > 1) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="1">«</button></li>`);

        }else{
             pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable">«</button></li>`);
        }

         // Create "Back" button
        if (currentPage > 1) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage - 1}">‹</button></li>`);
        }else{
            //back disable
            pagination.append(`<li class="pagination-item "><button class="pagination-link pagination-disable" >‹</button></li>`);
        }

        // Create pagination links
        for (let i = startPage; i <= endPage; i++) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link${i === currentPage ? ' pagination-link--active' : ''}" data-page="${i}">${i}</button></li>`);
        }

          // Create "Next" button
        if (currentPage < totalPages) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage + 1}">›</button></li>`);
        }else{
            pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >›</button></li>`);
        }

         // Create "Last Page" button
        if (currentPage < totalPages) {
            pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${totalPages}">»</button></li>`);

        }else{
              pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >»</button></li>`);
        }



        // Add click event to pagination links
        pagination.find('.page-link').on('click', function() {
            currentPage = parseInt($(this).data('page'));
            fetchData(currentPage);
        });
    }

      });     
</script>

<style type="text/css">
 .table>thead>tr>th {
    border-bottom: none!important;
}
</style>

@stop