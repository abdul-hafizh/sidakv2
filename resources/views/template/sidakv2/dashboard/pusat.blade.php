@extends('template/sidakv2/layout.app')
@section('content')
<section class="content-header pd-left-right-15">    
    <div class="row padding-default" style="margin-bottom: 20px">
        <div class="col-lg-4 col-sm-12 margin-top-bottom-20">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                        <div class="media">
                            <div class="media-body text-left">
                                <span>Total Pagu APBN</span>
                                <h3 class="card-text" id="total-pagu"></h3>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 margin-top-bottom-20">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div class="media-body text-left">
                            <span>Total Perencanaan</span>
                            <h3 class="card-text" id="total-rencana"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 margin-top-bottom-20">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div class="media-body text-left">
                            <span>Total Pengawasan</span>
                            <h3 class="card-text" id="total-pengawasan"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 margin-top-bottom-20">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div class="media-body text-left">
                            <span>Total Bimsos</span>
                            <h3 class="card-text" id="total-bimsos"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 margin-top-bottom-20">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div class="media-body text-left">
                            <span>Total Penyelesain</span>
                            <h3 class="card-text" id="total-penyelesaian"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div   class="col-lg-4 col-sm-12 margin-top-bottom-20">
            <div class="box-body btn-primary border-radius-13">
                <div class="card-body table-responsive p-0">
                    <div class="media">
                        <div id="total-convert" class="media-body text-left">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row margin-top-bottom-20">
        <div class="col-sm-2" style="margin-bottom: 9px;">
                 <div id="selectPeriode" class="form-group margin-none"></div>
        </div>

        <div class="col-sm-2" style="margin-bottom: 9px;">

                <select id="semester_id"  name="semester_id" class="selectpicker">
                    <option value="01">Semester 1</option>
                    <option value="02">Semester 2</option>
                </select>
        </div>


         <div class="col-sm-2" style="margin-bottom: 9px;">
               <select id="daerah_id"  data-live-search="true" class="selectpicker" data-style="btn-default" title="Pilih Provinsi / Kabupaten"></select>
        </div>     
       
        
         
        <div class="col-lg-2">
            <div class="btn-group">
                <button id="Search" type="button" title="Cari" class="btn btn-info btn-group-radius-left"><i class="fa fa-filter"></i> Cari</button>
                <button id="Reset" type="button" title="Reset" class="btn btn-info btn-group-radius-right"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
    </div>  
    
   
</section>

<div class="col-sm-12">
     <h4>Pengawasan</h4>
</div>
<div class="content">
    <div class="clearfix"></div>
    <div class="clearfix"></div> 

   
    <div class="box box-solid box-primary">
        <div class="box-body">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead class="bg-table">
                        <tr >
                        
                       
                            <th>Sub Menu</th>
                            <th>Target Output</th>
                            <th>Pagu APBN</th>
                            <th>Realisasi Target Sem I</th>
                            <th>Realisasi Pagu Sem I</th>
                            <th class="semesterParamTarget" style="display:none;">Realisasi Target Sem II</th>
                            <th class="semesterParamPagu" style="display:none;">Realisasi Pagu Sem II</th>
                            <th class="semesterParamTarget" style="display:none;">Realisasi Target Sem I + II</th>
                            <th class="semesterParamPagu" style="display:none;">Realisasi Pagu Sem I + II</th>
                        </tr>
                    </thead>

                     <tbody id="conpengawasan" >
                        
                    
                     </tbody>
                    </table>
                </div>
            </div>
        </div>
</div> 


<div class="col-sm-12">
     <h4>Bimsos</h4>
</div>
<div class="content">
    <div class="clearfix"></div>
    <div class="clearfix"></div> 

   
    <div class="box box-solid box-primary">
        <div class="box-body">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead class="bg-table">
                        <tr >
                        
                       
                            <th>Sub Menu</th>
                            <th>Target Output</th>
                            <th>Pagu APBN</th>
                            <th>Realisasi Target Sem I</th>
                            <th>Realisasi Pagu Sem I</th>
                            <th class="semesterParamTarget" style="display:none;">Realisasi Target Sem II</th>
                            <th class="semesterParamPagu" style="display:none;">Realisasi Pagu Sem II</th>
                            <th class="semesterParamTarget" style="display:none;">Realisasi Target Sem I + II</th>
                            <th class="semesterParamPagu" style="display:none;">Realisasi Pagu Sem I + II</th>
                        </tr>
                    </thead>

                     <tbody id="conbimsos" >
                        
                    
                     </tbody>
                    </table>
                </div>
            </div>
        </div>
</div> 

<div class="col-sm-12">
     <h4>Penyelesaian</h4>
</div>
<div class="content">
    <div class="clearfix"></div>
    <div class="clearfix"></div> 

   
    <div class="box box-solid box-primary">
        <div class="box-body">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead class="bg-table">
                        <tr >
                        
                       
                            <th>Sub Menu</th>
                            <th>Target Output</th>
                            <th>Pagu APBN</th>
                            <th>Realisasi Target Sem I</th>
                            <th>Realisasi Pagu Sem I</th>
                            <th class="semesterParamTarget" style="display:none;">Realisasi Target Sem II</th>
                            <th class="semesterParamPagu" style="display:none;">Realisasi Pagu Sem II</th>
                            <th class="semesterParamTarget" style="display:none;">Realisasi Target Sem I + II</th>
                            <th class="semesterParamPagu" style="display:none;">Realisasi Pagu Sem I + II</th>
                        </tr>
                    </thead>

                     <tbody id="conpenyelesaian" >
                        
                    
                     </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>       

<script type="text/javascript">
    $(document).ready(function() { 
       var date = new Date(); 
       var year = date.getFullYear();
       var mounth = date.getMonth() + 1;
       var periode_val = year;
       var semester_val = '';
       var periode = [];
       var daerah_id = '';
       if(mounth >6)
       {
          semester_val = '02';
          $('.semesterParamTarget').show();
          $('.semesterParamPagu').show();
       }else{
          semester_val = '01';
           $('.semesterParamTarget').hide();
          $('.semesterParamPagu').hide();
       } 
       
       
       
       if(year > '2023')
       {
          $('#total-convert').html('<span>Total Peta Potensi </span><h3 class="card-text" id="total-promosi"></h3>');
       }else{
          $('#total-convert').html('<span>Total Promosi </span><h3 class="card-text" id="total-promosi"></h3>');
       } 
  
    

       getperiode(year);
       getsemester(semester_val);
       getdaerah();
       getDashboard();


       $('#Search').click( () => {
         let periode_id = $('#periode_id').val();
         let semester_id = $('#semester_id').val();
         let daerah_id = $('#daerah_id').val();
             
                const content1 = $('#conpengawasan');
                content1.empty();
                let row1 = ``;
                row1 +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
                content1.append(row1);

                const content2 = $('#conbimsos');
                content2.empty();
                let row2 = ``;
                row2 +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
                content2.append(row2);

                const content3 = $('#conpenyelesaian');
                content3.empty();
                let row3 = ``;
                row3 +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
                content3.append(row3);

                if(periode_id > '2023')
                {
                  $('#total-convert').html('<span>Total Peta Potensi </span><h3 class="card-text" id="total-promosi"></h3>');
                }else{
                  $('#total-convert').html('<span>Total Promosi </span><h3 class="card-text" id="total-promosi"></h3>');
                } 
  

            
             $.ajax({
                url: BASE_URL +'/api/dashboard?periode_id='+ periode_id +'&semester_id='+ semester_id +'&daerah_id='+ daerah_id +'',
                method: 'GET',
                success: function(response) {
                   
                     ShowData(response)
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
             
    });
  

        function getperiode(periode_id){
               $('#selectPeriode').html('<select id="periode_id" name="periode_id"   class="selectpicker"></select>');
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=GET&action=dashboard',
                    success: function(data) {
                         var select =  $('#periode_id');
                         select.empty();
                         $.each(data.result, function(index, option) {
                              select.append($('<option>', {
                                   value: option.value,
                                   text: option.text
                              }));
                         });

                        
                             select.val(periode_id);
                           
                            
                            
                        
                             select.selectpicker('refresh');
                             periode = data.result; 
                            
                    },
                    error: function( error) {}
               });

              
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

        function getDashboard(){

                const content1 = $('#conpengawasan');
                content1.empty();
                let row1 = ``;
                row1 +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
                content1.append(row1);

                const content2 = $('#conbimsos');
                content2.empty();
                let row2 = ``;
                row2 +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
                content2.append(row2);

                const content3 = $('#conpenyelesaian');
                content3.empty();
                let row3 = ``;
                row3 +=`<tr><td colspan="9" align="center"> <b>Loading ...</b></td></tr>`;
                content3.append(row3);

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/dashboard?periode_id='+ periode_val +'&semester_id='+ semester_val +'&daerah_id='+ daerah_id +'',
                    success: function(response) {
                       
                       ShowData(response)

                    },
                    error: function( error) {}
               });

        }

        function ShowData(data){
           
            $('#total-pagu').html('<b> '+data.total.pagu_apbn+'</b>');
            $('#total-rencana').html('<b> '+data.total.perencanaan+'</b>');
            $('#total-pengawasan').html('<b> '+data.total.pengawasan+'</b>');
            $('#total-bimsos').html('<b> '+data.total.bimsos+'</b>');
            $('#total-penyelesaian').html('<b> '+data.total.penyelesaian+'</b>');
            $('#total-promosi').html('<b> '+data.total.promosi+'</b>');
            if(data.access =='province')
            {
               $('#showProvince').show();
               let periode_id = $('#periode_id').val();
               if(periode_id > '2023')
               {
                  $('#total-convert').html('<span>Total Peta Potensi </span><h3 class="card-text" id="total-promosi"></h3>');
                  $('#total-promosi').html('<b> '+data.total.peta_potensi+'</b>');  
               }else{
                  $('#total-convert').html('<span>Total Promosi </span><h3 class="card-text" id="total-promosi"></h3>');
                  $('#total-promosi').html('<b> '+data.total.promosi+'</b>');  
               } 
            }else{
               $('#showProvince').hide();  
            }    


            contentPengawasan(data.pengawasan)
            contentBimsos(data.bimsos)
            contentPenyelesaian(data.penyelesaian)
        }
        function contentPengawasan(data){
 
            const content = $('#conpengawasan');
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

                 row +=`<td ><b>${item.sub_menu}</td></b>`;
                 row +=`<td align="center">${item.target}</td>`;
                 row +=`<td align="right"><b>${item.pagu}</b></td>`;
                 row +=`<td align="center">${item.realisasi_target_sem_1}</td>`;
                 row +=`<td  align="right"><b>${item.realisasi_apbn_sem_1}</b></td>`;
                 if(semester =="02")
                 {
                     row +=`<td align="center">${item.realisasi_target_sem_2}</td>`;
                     row +=`<td  align="right"><b>${item.realisasi_apbn_sem_2}</b></td>`;
                     row +=`<td align="center">${item.realisasi_target}</td>`;
                     row +=`<td align="right"><b>${item.realisasi_apbn}</b></td>`;
                 }   
               
                row +=`</tr>`;
                content.append(row);
                }); 
            }else{

             let row = ``;
             row +=`<tr>`;
             row +=`<td colspan="11" align="center">Data Kosong</td>`;
             row +=`</tr>`;
             content.append(row);
            
            }
        }

        function contentBimsos(data){
 
            const content = $('#conbimsos');
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

                 row +=`<td ><b>${item.sub_menu}</td></b>`;
                 row +=`<td align="center">${item.target}</td>`;
                 row +=`<td align="right"><b>${item.pagu}</b></td>`;
                 row +=`<td align="center">${item.realisasi_target_sem_1}</td>`;
                 row +=`<td  align="right"><b>${item.realisasi_apbn_sem_1}</b></td>`;
                 if(semester =="02")
                 {
                     row +=`<td align="center">${item.realisasi_target_sem_2}</td>`;
                     row +=`<td  align="right"><b>${item.realisasi_apbn_sem_2}</b></td>`;
                     row +=`<td align="center">${item.realisasi_target}</td>`;
                     row +=`<td align="right"><b>${item.realisasi_apbn}</b></td>`;
                 }   
               
                row +=`</tr>`;
                content.append(row);
                }); 
            }else{

             let row = ``;
             row +=`<tr>`;
             row +=`<td colspan="11" align="center">Data Kosong</td>`;
             row +=`</tr>`;
             content.append(row);
            
            }
        }

        function contentPenyelesaian(data){
 
            const content = $('#conpenyelesaian');
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

                 row +=`<td ><b>${item.sub_menu}</td></b>`;
                 row +=`<td align="center">${item.target}</td>`;
                 row +=`<td align="right"><b>${item.pagu}</b></td>`;
                 row +=`<td align="center">${item.realisasi_target_sem_1}</td>`;
                 row +=`<td  align="right"><b>${item.realisasi_apbn_sem_1}</b></td>`;
                 if(semester =="02")
                 {
                     row +=`<td align="center">${item.realisasi_target_sem_2}</td>`;
                     row +=`<td  align="right"><b>${item.realisasi_apbn_sem_2}</b></td>`;
                     row +=`<td align="center">${item.realisasi_target}</td>`;
                     row +=`<td align="right"><b>${item.realisasi_apbn}</b></td>`;
                 }   
               
                row +=`</tr>`;
                content.append(row);
                }); 
             }else{

             let row = ``;
             row +=`<tr>`;
             row +=`<td colspan="11" align="center">Data Kosong</td>`;
             row +=`</tr>`;
             content.append(row);
            
            }
        }

      });     
</script>

<style type="text/css">
 .table>thead>tr>th {
    border-bottom: none!important;
}
</style>

@stop