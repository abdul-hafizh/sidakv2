@extends('template/sidakv2/layout.app')
@section('content')

<style> tr.border-bottom td { border-bottom: 3pt solid #f4f4f4; } td { padding: 10px !important; } </style>

<div class="content">
     <form id="FormSubmit">
          <div class="row padding-default" style="margin-bottom: 20px">
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

          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body table-responsive">
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
          
          

          <div class="box-footer">
               <div id="btn-submit" class="btn-group just-center">
                   
               </div> 
          </div> 
     </form>
</div>

<script type="text/javascript">

     $(document).ready(function() {

          var periode =[];
          var pagu_promosi = 0;
          var total_promosi = 0;
          var total_identifikasi = 0;       
          var total_pelaksanaan = 0;
          var total_penyusunan = 0;
        
          var temp_total_identifikasi = 0;
          var temp_total_pelaksanaan = 0;
          var temp_total_penyusunan = 0;
          var temp_total_budget = 0;

          var file_rencana_kerja = '';
          var file_studi_literatur = '';
          var file_rapat_kordinasi = '';
          var file_data_sekunder = '';


          var file_fgd_persiapan = '';
          var file_data_identifikasi = '';
          var file_data_pengolahan = '';
          var file_data_klarifikasi = '';
          var file_data_finalisasi = '';
          var file_data_penyusunan = '';
          var file_penyusunan_infografis = '';
          var file_doc_info_grafis = '';


          var btn_rencana_kerja = '';
          var btn_studi_literatur = '';
          var btn_rapat_kordinasi = '';
          var btn_data_sekunder = '';


          var btn_fgd_persiapan = '';
          var btn_data_identifikasi = '';
          var btn_data_pengolahan = '';
          var btn_data_klarifikasi = '';
          var btn_data_finalisasi = '';

          var btn_data_penyusunan = '';
          var btn_penyusunan_infografis = '';
          var btn_doc_info_grafis = '';

       
     
          $('#total-budget').html('<b>Rp. 0</b>');           
          $('#total_realisasi').html('<b>Rp. 0</b>');  
          var url = window.location.href; 
          var segments = url.split('/');  

        
          
        
          getPemetaanDetail(); 


       
          function calculateIdentifikasi() {
               var total_identifikasi = 0;
          
               $(".identifikasi").each(function() {
                    total_identifikasi += parseFloat($(this).val());
               });

              

               var number = total_identifikasi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_identifikasi").text('Rp '+ formattedNumber);
              
               temp_total_identifikasi = number;
               totalRencana();
          }

          function calculatePelaksanaan() {
               var total_pelaksanaan = 0;

               $(".pelaksanaan").each(function() {
                    total_pelaksanaan += parseFloat($(this).val());
               });

               var number = total_pelaksanaan;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_pelaksanaan").text('Rp '+ formattedNumber);
     
               temp_total_pelaksanaan = number;
               totalRencana();
          }

          function calculatePenyusunan() {
               var total_penyusunan = 0;

               $(".penyusunan").each(function() {
                    total_penyusunan += parseFloat($(this).val());
               });

               var number = total_penyusunan;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_penyusunan").text('Rp '+ formattedNumber);
     
               temp_total_penyusunan = number;
               totalRencana();
          }

           function updateTotalPemetaan() {
               var total_pagu_inp = 0;
               $(".pemetaan_inp").each(function() {
                    total_pagu_inp += parseInt($(this).val());
               });

               temp_total_budget = total_pagu_inp;
               totalRencana();
          }  

          function totalRencana() {
               
               total_promosi = temp_total_budget;
               var number = total_promosi;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
               var periode_id = $('#periode_id').val();
              

               if(periode_id)
               {    
                   
                    if(pagu_promosi < total_promosi) {
                         Swal.fire({
                              icon: 'info',
                              title: 'Peringatan',
                              text:'Total Promosi Melebihi PAGU yang Diizinkan : Rp. ' + accounting.formatNumber(pagu_promosi, 0, ".", "."),
                              confirmButtonColor: '#000',
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                         });  
                         
                         $('#total_promosi').removeClass('text-black').addClass('text-red').addClass('blinking-text');
                         

                    } else {

                         $('#total_promosi').removeClass('text-red').removeClass('blinking-text').addClass('text-white');
                      
                    }
               }
               
               $('#total_promosi').html('<b>Rp. '+formattedNumber+'</b>');
               // $('#total_rencana_sec').html('<b>Rp. '+formattedNumber+'</b>');
               // $('#total_rencana_inp').val(number);
          }

          function getChecklistPelaksanaan(){

              


               $("#checklist-lq").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-lq").val('true');
                         $('#startdate-lq').prop("disabled", false);
                         $('#enddate-lq').prop("disabled", false);
                         $('#budget-lq').prop("disabled", false);
                         
                    }else{
                        $("#checklist-lq").val('false'); 
                        $('#startdate-lq').prop("disabled", true).val('');
                        $('#enddate-lq').prop("disabled", true).val('');
                        $('#budget-lq').prop("disabled", true).val('0');
                      
                        calculatePelaksanaan();
                        updateTotalPemetaan();
                    }     
               }); 

               $("#checklist-shift-share").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-shift-share").val('true');
                         $('#startdate-shift-share').prop("disabled", false);
                         $('#enddate-shift-share').prop("disabled", false);
                         $('#budget-shift-share').prop("disabled", false);
                        
                    }else{
                         $("#checklist-shift-share").val('false');
                         $('#startdate-shift-share').prop("disabled", true).val('');
                         $('#enddate-shift-share').prop("disabled", true).val('');
                         $('#budget-shift-share').prop("disabled", true).val('0');
                       
                         calculatePelaksanaan();
                         updateTotalPemetaan(); 
                    }     
               });  

               $("#checklist-tipologi-sektor").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-tipologi-sektor").val('true');
                         $('#startdate-tipologi-sektor').prop("disabled", false);
                         $('#enddate-tipologi-sektor').prop("disabled", false);
                         $('#budget-tipologi-sektor').prop("disabled", false);
                        
                    }else{
                         $("#checklist-tipologi-sektor").val('false');
                         $('#startdate-tipologi-sektor').prop("disabled", true).val('');
                         $('#enddate-tipologi-sektor').prop("disabled", true).val('');
                         $('#budget-tipologi-sektor').prop("disabled", true).val('0');
                        
                         calculatePelaksanaan();
                         updateTotalPemetaan();
                    }     
               }); 

               $("#checklist-klassen").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-klassen").val('true');
                         $('#startdate-klassen').prop("disabled", false);
                         $('#enddate-klassen').prop("disabled", false);
                         $('#budget-klassen').prop("disabled", false);
                        
                    }else{
                         $("#checklist-klassen").val('false');
                         $('#startdate-klassen').prop("disabled", true).val('');
                         $('#enddate-klassen').prop("disabled", true).val('');
                         $('#budget-klassen').prop("disabled", true).val('0');
                         
                         calculatePelaksanaan();
                         updateTotalPemetaan(); 
                    }     
               }); 

               $('.checkbox-pengolahan').on('click', function() {
                   const checkedCount = $('.checkbox-pengolahan:checked').length;
                   if(checkedCount>0)
                   {
                      $('#file-pengolahan').prop("disabled", false);
                   }else{
                     $('#file-pengolahan').prop("disabled", true); 
                   }     
               });



          }


          function getChecklistPetaInvenstasi(){

               $("#checklist-summary-sektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-summary-sektor-unggulan").val('true');
                         $("#startdate-summary-sektor-unggulan").prop("disabled", false);
                         $("#enddate-summary-sektor-unggulan").prop("disabled", false);
                         $('#budget-summary-sektor-unggulan').prop("disabled", false);
                         
                    }else{
                         $("#checklist-summary-sektor-unggulan").val('false'); 
                         $("#startdate-summary-sektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-summary-sektor-unggulan").prop("disabled", true).val('');
                         $('#budget-summary-sektor-unggulan').prop("disabled", true).val('0');;
                        
                         calculatePenyusunan();
                         updateTotalPemetaan();
                    }     
               }); 

               $("#checklist-sektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-sektor-unggulan").val('true');
                         $("#startdate-sektor-unggulan").prop("disabled", false);
                         $("#enddate-sektor-unggulan").prop("disabled", false);
                         $('#budget-sektor-unggulan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-sektor-unggulan").val('false'); 
                         $("#startdate-sektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-sektor-unggulan").prop("disabled", true).val('');
                         $('#budget-sektor-unggulan').prop("disabled", true).val('0');;
                         
                         calculatePenyusunan();
                         updateTotalPemetaan();
                    }     
               });  

               $("#checklist-potensi-pasar").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-potensi-pasar").val('true');
                         $("#startdate-potensi-pasar").prop("disabled", false);
                         $("#enddate-potensi-pasar").prop("disabled", false);
                         $('#budget-potensi-pasar').prop("disabled", false);
                        
                    }else{
                         $("#checklist-potensi-pasar").val('false');
                         $("#startdate-potensi-pasar").prop("disabled", true).val('');
                         $("#enddate-potensi-pasar").prop("disabled", true).val('');
                         $('#budget-potensi-pasar').prop("disabled", true).val('0');;
                        
                         calculatePenyusunan();
                         updateTotalPemetaan();
                    }     
               }); 

               $("#checklist-parameter-sektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-parameter-sektor-unggulan").val('true');
                         $("#startdate-parameter-sektor-unggulan").prop("disabled", false);
                         $("#enddate-parameter-sektor-unggulan").prop("disabled", false);
                         $('#budget-parameter-sektor-unggulan').prop("disabled", false);
                         
                    }else{
                         $("#checklist-parameter-sektor-unggulan").val('false');
                         $("#startdate-parameter-sektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-parameter-sektor-unggulan").prop("disabled", true).val('');
                         $('#budget-parameter-sektor-unggulan').prop("disabled", true).val('0');;
                        
                         calculatePenyusunan();
                         updateTotalPemetaan();
                    }     
               }); 

                $("#checklist-subsektor-unggulan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-subsektor-unggulan").val('true');
                         $("#startdate-subsektor-unggulan").prop("disabled", false);
                         $("#enddate-subsektor-unggulan").prop("disabled", false);
                         $('#budget-subsektor-unggulan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-subsektor-unggulan").val('false');
                         $("#startdate-subsektor-unggulan").prop("disabled", true).val('');
                         $("#enddate-subsektor-unggulan").prop("disabled", true).val('');
                         $('#budget-subsektor-unggulan').prop("disabled", true).val('0');;
                        
                         calculatePenyusunan();
                         updateTotalPemetaan();
                    }     
               });  

               $("#checklist-intensif-daerah").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-intensif-daerah").val('true');
                         $("#startdate-intensif-daerah").prop("disabled", false);
                         $("#enddate-intensif-daerah").prop("disabled", false);
                         $('#budget-intensif-daerah').prop("disabled", false);
                       
                    }else{
                         $("#checklist-intensif-daerah").val('false');
                         $("#startdate-intensif-daerah").prop("disabled", true).val('');
                         $("#enddate-intensif-daerah").prop("disabled", true).val('');
                         $('#budget-intensif-daerah').prop("disabled", true).val('0');;
                       
                         calculatePenyusunan();
                         updateTotalPemetaan();
                    }     
               }); 

               $("#checklist-potensi-lanjutan").on("input", function(e) {
                    if(e.currentTarget.value == 'false')
                    {
                         $("#checklist-potensi-lanjutan").val('true');
                         $("#startdate-potensi-lanjutan").prop("disabled", false);
                         $("#enddate-potensi-lanjutan").prop("disabled", false);
                         $('#budget-potensi-lanjutan').prop("disabled", false);
                        
                    }else{
                         $("#checklist-potensi-lanjutan").val('false');
                         $("#startdate-potensi-lanjutan").prop("disabled", true).val('');
                         $("#enddate-potensi-lanjutan").prop("disabled", true).val('');
                         $('#budget-potensi-lanjutan').prop("disabled", true).val('0');;
                        
                         calculatePenyusunan();
                         updateTotalPemetaan();   
                    }     
               }); 

                $('.checkbox-penyusunan').on('click', function() {
                   const checkedCount = $('.checkbox-penyusunan:checked').length;
                   if(checkedCount>0)
                   {
                       $('#file-penyusunan').prop("disabled", false);
                   }else{
                        $('#file-penyusunan').prop("disabled", true);
                   }     
               });
          }

           function UploadFileRapatTeknis(id)
          {


               $("#file-rapat-teknis").click(()=> {
                 $("#desc-a-pra").trigger("click");
               });

               $("#desc-a-pra").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {

              if (files[0].size > 1363149) 
              {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;

                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-rapat-teknis').html(row);
                         file_rencana_kerja = file;
                         btn_rencana_kerja = 'true';
                         getbutton();
                    
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   

               }     
                   })
                   fileReader.readAsDataURL(files[0])
              
              });


              $( "#img-file-rapat-teknis" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file; 
               //    let id = e.currentTarget.dataset.param_id;
                  
                   EmbedFile(file,id);  
              });  

          }


           function UploadFileStudiLiteratur(id)
          {


               $("#file-studi-literatur").click(()=> {
                 $("#desc-b-pra").trigger("click");
               });

               $("#desc-b-pra").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
                 
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  
                
                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                         file_studi_literatur = file;
                         btn_studi_literatur = 'true';
                         getbutton();
                         $('#img-file-studi-literatur').html(row);
                    
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-studi-literatur" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }

           function UploadFileKordinasi(id)
          {


               $("#file-rapat-kordinasi").click(()=> {
                 $("#desc-c-pra").trigger("click");
               });

               $("#desc-c-pra").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               

               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-rapat-kordinasi').html(row);
                         file_rapat_kordinasi = file;
                         btn_rapat_kordinasi = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-rapat-kordinasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }

           function UploadFileDataSekunder(id)
          {


               $("#file-sekunder").click(()=> {
                 $("#desc-d-pra").trigger("click");
               });

               $("#desc-d-pra").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-sekunder').html(row);4
                         file_data_sekunder = file;
                         btn_data_sekunder = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-sekunder" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }


           function UploadFilePersiapan(id)
          {


               $("#file-persiapan").click(()=> {
                 $("#desc-a-pro").trigger("click");
               });

               $("#desc-a-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
              
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-persiapan').html(row);
                         file_fgd_persiapan = file;
                         btn_fgd_persiapan = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-persiapan" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }

           function UploadFileFGDIndentifikasi(id)
          {


               $("#file-fgd-identifikasi").click(()=> {
                 $("#desc-b-pro").trigger("click");
               });

               $("#desc-b-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-fgd-identifikasi').html(row);
                         file_data_identifikasi= file;
                         btn_data_identifikasi = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-fgd-identifikasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }

          function UploadFilePengolahan(id)
          {


               $("#file-pengolahan").click(()=> {
                 $("#keterangan-pengolahan").trigger("click");
               });

               $("#keterangan-pengolahan").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Pengolahan">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-pengolahan').html(row);
                         file_data_pengolahan = file;
                         btn_data_pengolahan = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-pengolahan" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }


           function UploadFileFGDKlarifikasi(id)
          {


               $("#file-fgd-klarifikasi").click(()=> {
                 $("#desc-d-pro").trigger("click");
               });

               $("#desc-d-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-fgd-klarifikasi').html(row);
                        file_data_klarifikasi = file;
                        btn_data_klarifikasi = 'true';
                        getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-fgd-klarifikasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }

           function UploadFileFGDKonfirmasi(id)
          {


               $("#file-fgd-konfirmasi").click(()=> {
                 $("#desc-e-pro").trigger("click");
               });

               $("#desc-e-pro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Rencana Kerja">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-fgd-konfirmasi').html(row);
                         file_data_finalisasi = file;
                         btn_data_finalisasi = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-fgd-konfirmasi" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);  
              });  

          }


          function UploadFilePenyusunan(id)
          {


               $("#file-penyusunan").click(()=> {
                 $("#keterangan-penyusunan").trigger("click");
               });

               $("#keterangan-penyusunan").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Penyusunan">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-penyusunan').html(row);
                         file_data_penyusunan = file;
                         btn_data_penyusunan = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
                 }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-penyusunan" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);   
              });  

          }

          function UploadFilePenyusunanInfoGrafis(id)
          {


               $("#file-info-grafis").click(()=> {
                 $("#desc-b-ppro").trigger("click");
               });

               $("#desc-b-ppro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
                
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Penyusunan">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-info-grafis').html(row);
                         file_penyusunan_infografis = file;
                         btn_penyusunan_infografis = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-info-grafis" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);   
              });  

          }

          function UploadFileDokumentasiInfoGrafis(id)
          {


               $("#file-doc-info-grafis").click(()=> {
                 $("#desc-c-ppro").trigger("click");
               });

               $("#desc-c-ppro").change((event)=> {     
                  
                   const files = event.target.files
                   let filename = files[0].name
                   const fileReader = new FileReader()
                   fileReader.addEventListener('load', () => {
               
               if (files[0].size > 1363149) 
               {
                         Swal.fire({
                               icon: 'info',
                               title: 'file PDF Maksimal 2MB!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  


              }else{  

                    if(files[0].name.toUpperCase().includes(".PDF"))
                    {
                         file = fileReader.result;
                         var row = '';
                         // row +='<img class="file-c" src="'+ BASE_URL +'/template/sidakv2/img/pdf-icon.png" alt="file Penyusunan">';
                         row +='<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="'+ file +'" data-toggle="modal" data-target="#modal-view-'+ id +'"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>';

                         row +=`<div id="modal-view-`+ id +`" class="modal fade" role="dialog">`;
                               row +=`<div id="FormView-`+ id +`"></div>`;
                         row +=`</div>`;
                     
                         $('#img-file-doc-info-grafis').html(row);
                         file_doc_info_grafis = file;
                         btn_doc_info_grafis = 'true';
                         getbutton();
                     }else{
                         Swal.fire({
                               icon: 'info',
                               title: 'Tipe file tidak diizinkan!',
                               confirmButtonColor: '#000',
                               confirmButtonText: 'OK'
                           });  
                     }   
               }
                       
                   })
                   fileReader.readAsDataURL(files[0])

              });


              $( "#img-file-doc-info-grafis" ).on( "click", "#viewPdf", (e) => {
                   let file = e.currentTarget.dataset.param_file;  
                   EmbedFile(file,id);   
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

          function getperiode(periode_id){
                  $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>'); 
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=PUT&action=pemetaan',
                    success: function(data) {
                         var select =  $('#periode_id');
                           select.empty();
                         $.each(data.result, function(index, option) {
                              select.append($('<option>', {
                                   value: option.value,
                                   text: option.text
                              }));
                         });
                         
                           
                        
                         select.val(periode_id).prop('disabled',true);
                         select.selectpicker('refresh');
                         periode = data.result; 
                    },
                    error: function( error) {}
               });

               $('#periode_id').on('change', function() {
                    var index = $(this).val();
                    let find = periode.find(o => o.value === index); 
                   
                    pagu_promosi = find.pagu_promosi; 

                    //isi pagu
                    var promosi = accounting.formatNumber(find.pagu_promosi, 0, ".", "."); 
                    $('#pagu_promosi').html('<b>Rp '+ promosi +'</b>');
               
                    
                    
                    
               });
          }


          function getPemetaanDetail(){

               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/pemetaan/'+ segments[5],
                    success: function(data) {
                       
                         updateContent(data);
                         total_budget = data.total_budget_pemetaan.convert;
                         total_realisasi = data.total_realisasi_pemetaan.convert;
                         
                          btn_potensi = data.btn_potensi;
                         


                          btn_fgd_persiapan = data.btn_fgd_persiapan;
                          btn_data_identifikasi = data.btn_fgd_identifikasi;
                          btn_data_sektor = data.btn_sektor;
                          btn_data_klarifikasi = data.btn_fgd_klarifikasi;
                          btn_data_finalisasi = data.btn_finalisasi;

                          btn_data_penyusunan = data.btn_penyusunan;
                          btn_penyusunan_infografis = data.btn_info_grafis;
                          btn_doc_info_grafis = data.btn_dokumentasi;

                            getperiode(data.periode_id);
                        
                       
                    },
                    error: function( error) {}
               });


          }

          function updateContent(item)
          {
                const content = $('#content');
      
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
                   
                    content.append(row);
                    
                    $('#total-budget').html('<b>'+item.total_budget_pemetaan.convert+'</b>');
                    $('#total-realisasi').html('<b>'+item.total_realisasi_pemetaan.convert+'</b>');
                    $(".pemetaan_inp").on("input", updateTotalPemetaan);
                 
                      content.on( "click", "#viewPdf", (e) => {
                        let file = e.currentTarget.dataset.param_file;  
                        EmbedFile(file,item.id);  
                   });
                    

                    UploadFileRapatTeknis(item.id);
                    UploadFileStudiLiteratur(item.id);
                    UploadFileKordinasi(item.id);
                    UploadFileDataSekunder(item.id);

                    UploadFilePersiapan(item.id);
                    UploadFileFGDKlarifikasi(item.id);
                    UploadFilePengolahan(item.id);
                    UploadFileFGDKonfirmasi(item.id);
                    UploadFileFGDIndentifikasi(item.id); 
          
                    UploadFilePenyusunan(item.id);
                    UploadFilePenyusunanInfoGrafis(item.id); 
                    UploadFileDokumentasiInfoGrafis(item.id); 


                   

                 
                   
 
          }


          

         

          
     });    

</script>
@stop