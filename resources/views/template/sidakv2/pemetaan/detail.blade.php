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
                                        <span>Pagu Pemetaan</span>
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
                                        <span>Total Pemetaan</span>
                                        <h3 class="card-text" id="total_promosi"></h3>
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
                        <table class="table table-hover text-nowrap"  >
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

          $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>'); 
     
          $('#pagu_promosi').html('<b>Rp. 0</b>');           
          $('#total_promosi').html('<b>Rp. 0</b>');  
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
                         
                           
                        
                         select.val('2024');
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
                         pagu_promosi = data.pagu_promosi;
                         total_promosi = data.total_promosi;
                         
                          btn_rencana_kerja = data.btn_rencana_kerja;
                          btn_studi_literatur = data.btn_studi_literatur;
                          btn_rapat_kordinasi = data.btn_rapat_kordinasi;
                          btn_data_sekunder = data.btn_data_sekunder;


                          btn_fgd_persiapan = data.btn_fgd_persiapan;
                          btn_data_identifikasi = data.btn_fgd_identifikasi;
                          btn_data_pengolahan = data.btn_pengolahan;
                          btn_data_klarifikasi = data.btn_fgd_klarifikasi;
                          btn_data_finalisasi = data.btn_finalisasi;

                          btn_data_penyusunan = data.btn_penyusunan;
                          btn_penyusunan_infografis = data.btn_info_grafis;
                          btn_doc_info_grafis = data.btn_dokumentasi;

                         
                        
                       
                    },
                    error: function( error) {}
               });


          }

          function updateContent(item)
          {
                const content = $('#content');
      
                  let row = ``;
                    row +=`<tr>`;
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
                                   row +=`<input readonly  type="date"   id="startdate-a-pra" name="startdate_a_pra"  value="${item.tgl_awal_rencana_kerja }" class="form-control ">`; 
                                   row +=`<span id="startdate-a-pra-messages"></span>`;
                           row +=` </div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-a-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input readonly type="date"   id="enddate-a-pra" name="enddate_a_pra" value="${item.tgl_ahir_rencana_kerja }" class="form-control">`;
                                 row +=`<span id="enddate-a-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-a-pra-alert" class="margin-none form-group">`;
                                        row +=`<input readonly type="number" id="budget-a-pra"    min="0" oninput="this.value = Math.abs(this.value)" placeholder="Budget" value="${item.budget_rencana_kerja }" name="budget_a_pra" class="form-control identifikasi pemetaan_inp">`;
                                 row +=`<span id="budget-a-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                  
                                      row +=`<div id="desc-a-pra-alert" class="pdf-btn-center">`;
                                        
                                       
                                         row +=`<div id="img-file-rapat-teknis">`;
                                         if(item.keterangan_rencana_kerja)
                                         { 
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_rencana_kerja }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                         }
                                         row +=`</div>`;
                                       
                                         row +=`<input type="file" style="display:none;" id="desc-a-pra" name="desc_a_pra" class="form-control" value="">`;
                                         row +=`<span id="desc-a-pra-messages"></span>`;
                                   row +=` </div>`;


                              row +=`</td>`;
                    row +=`</tr>`;
                    row +=`<tr>`;
                         row +=`<td class="font-bold">B.</td>`;
                         row +=`<td class="font-bold" colspan="3">Studi literatur</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-b-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input readonly type="date" id="startdate-b-pra"  name="startdate_b_pra"  value="${item.tgl_awal_studi_literatur }" class="form-control">`;
                                   row +=`<span id="startdate-b-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-b-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input readonly type="date" id="enddate-b-pra"  name="enddate_b_pra"  value="${item.tgl_ahir_studi_literatur }" class="form-control">`;
                                 row +=`<span id="enddate-b-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-b-pra-alert" class="margin-none form-group">`;
                                        row +=`<input readonly id="budget-b-pra"  placeholder="Budget" value="${item.budget_studi_literatur }"  type="number" min="0"  oninput="this.value = Math.abs(this.value)" name="budget_b_pra" class="form-control identifikasi pemetaan_inp">`;
                                 row +=`<span id="budget-b-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                              

                              row +=`<div id="desc-b-pra-alert" class="pdf-btn-center">`;

                                     
                                    
                                       
                                        row +=`<div id="img-file-studi-literatur">`;
                                         if(item.keterangan_studi_literatur)
                                         {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_studi_literatur }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;
                                    

                                        row +=`<input type="file"  style="display:none;"   name="desc_b_pra" id="desc-b-pra" value="" class="form-control">`;
                                 row +=`<span id="desc-b-pra-messages"></span>`;
                              row +=`</div>`;



                              row +=`</td>`;
                    row +=`</tr>`;


                    row +=`<tr >`;
                         row +=`<td class="font-bold">C.</td>`;
                         row +=`<td class="font-bold" colspan="3">Rapat Koordinasi dan Korespondensi dengan Instansi Terkait</td>`;
                       row +=`<td>`;
                              row +=`<div id="startdate-c-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input readonly type="date" id="startdate-c-pra"  name="startdate_c_pra" value="${item.tgl_awal_rapat_kordinasi }" class="form-control">`;
                                   row +=`<span id="startdate-c-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-c-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input readonly type="date" id="enddate-c-pra"  name="enddate_c_pra" value="${item.tgl_ahir_rapat_kordinasi }" class="form-control">`;
                                 row +=`<span id="enddate-c-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-c-pra-alert" class="margin-none form-group">`;
                                        row +=`<input readonly type="number" id="budget-c-pra"  min="0"  placeholder="Budget" value="${item.budget_rapat_kordinasi }" oninput="this.value = Math.abs(this.value)" name="budget_c_pra" class="form-control identifikasi pemetaan_inp">`;
                                 row +=`<span id="budget-c-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-c-pra-alert" class="pdf-btn-center">`;
                                  
                                   
                                        
                                        row +=`<div id="img-file-rapat-kordinasi">`;
                                          if(item.keterangan_rapat_kordinasi)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_rapat_kordinasi }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;
                                   
                                        row +=`<input type="file" style="display:none;"   id="desc-c-pra" name="desc_c_pra" value="" class="form-control">`;
                                 row +=`<span id="desc-c-pra-messages"></span>`;
                            row +=`</div>`;

                         

                              row +=`</td>`;
                    row +=`</tr>`;
                    row +=`<tr>`;
                         row +=`<td class="font-bold">D.</td>`;
                         row +=`<td class="font-bold" colspan="3">Pengumpulan data sekunder</td>`;
                         row +=`<td>`;
                              row +=`<div id="startdate-d-pra-alert" class="margin-none form-group">`; 
                                   row +=`<input readonly type="date" id="startdate-d-pra"  name="startdate_d_pra" value="${item.tgl_awal_data_sekunder }"  class="form-control">`;
                                   row +=`<span id="startdate-d-pra-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-d-pra-alert" class="margin-none form-group">`; 
                                        row +=`<input readonly type="date" id="enddate-d-pra"  name="enddate_d_pra" value="${item.tgl_ahir_data_sekunder }"  class="form-control">`;
                                 row +=`<span id="enddate-d-pra-messages"></span>`;
                            row +=`</div>`;
                             row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-d-pra-alert" class="margin-none form-group">`;
                                        row +=`<input readonly min="0"  type="number" id="budget-d-pra"  placeholder="Budget" value="${item.budget_data_sekunder }" oninput="this.value = Math.abs(this.value)" name="budget_d_pra" class="form-control identifikasi pemetaan_inp">`;
                                 row +=`<span id="budget-d-pra-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-d-pra-alert" class="pdf-btn-center">`;
                                         
                                       
                                       
                                        row +=`<div id="img-file-sekunder">`;
                                          if(item.keterangan_data_sekunder)
                                          { 
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_data_sekunder }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;

                                     

                                        row +=`<input type="file" style="display:none;"  name="desc_d_pra" id="desc-d-pra" value="" class="form-control">`;
                                 row +=`<span id="desc-d-pra-messages"></span>`;
                            row +=`</div>`;
  

                              row +=`</td>`;
                    row +=`</tr>`;                        

                    row +=`<tr>`;
                            row +=`<td rowspan="11" class="font-bold text-center">2</td>`;
                            row +=`<td colspan="6" class="font-bold"> Perumusan dan Pelaksanaan Pemetaan Potensi Investasi : </td>`;
                             row +=`<td><strong id="total_pelaksanaan">${item.total_pelaksanaan }</strong></td>`;
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
                                   row +=`<input readonly type="date" id="startdate-a-pro"  name="startdate_a_pro" value="${item.tgl_awal_fgd_persiapan }" class="form-control">`;
                                   row +=`<span id="startdate-a-pro-messages"></span>`;
                              row +=`</div>`;
                             row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-a-pro-alert" class="margin-none form-group">`; 
                                 row +=`<input readonly type="date" id="enddate-a-pro" name="enddate_a_pro" value="${item.tgl_ahir_fgd_persiapan }" class="form-control">`;
                                 row +=`<span id="enddate-a-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="budget-a-pro-alert" class="margin-none form-group">`;
                                        row +=`<input readonly min="0"  type="number" id="budget-a-pro" placeholder="Budget" value="${item.budget_fgd_persiapan }"  oninput="this.value = Math.abs(this.value)" name="budget_a_pro" class="form-control pelaksanaan pemetaan_inp">`;
                                 row +=`<span id="budget-a-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                              row +=`<td>`;
                                   row +=`<div id="desc-a-pro-alert" class="pdf-btn-center">`;

                                        
                                        
                                        row +=`<div id="img-file-persiapan">`;
                                          if(item.keterangan_fgd_persiapan)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_fgd_persiapan }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;
                                   


                                        row +=`<input type="file"  style="display:none;"  name="desc_a_pro" id="desc-a-pro" value=""   class="form-control">`;
                                        row +=`<span id="desc-a-pro-messages"></span>`;
                                   row +=`</div>`;


                              

                              row +=`</td>`;
                    row +=`</tr>`;     

                    row +=`<tr>`;
                              row +=`<td class="font-bold">B.</td>`;
                              row +=`<td></td>`;
                              row +=`<td></td>`;
                              row +=`<td class="-abjad font-bold"><textarea readonly class="textarea-table">Melaksanakan Focus Group Discussion (FGD) terkait Identifikasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>`;
                             row +=`<td>`;
                              row +=`<div id="startdate-b-pro-alert" class="margin-none form-group">`; 
                                   row +=`<input readonly type="date" id="startdate-b-pro" name="startdate-b-pro" value="${item.tgl_awal_fgd_identifikasi }" class="form-control ">`;
                                   row +=`<span id="startdate-b-pro-messages"></span>`;
                            row +=`</div>`;
                         row +=`</td>`;
                              row +=`<td>`;
                            row +=`<div id="enddate-b-pro-alert" class="margin-none form-group">`; 
                                        row +=`<input readonly type="date" id="enddate-b-pro"  name="enddate_b_pro" value="${item.tgl_ahir_fgd_identifikasi }" class="form-control">`;
                                 row +=`<span id="enddate-b-pro-messages"></span>`;
                            row +=`</div>`;
                              row +=`</td>`;
                             row +=`<td>`;
                            row +=`<div id="budget-b-pro-alert" class="margin-none form-group">`;
                                         row +=`<input readonly min="0" id="budget-b-pro"  type="number"  placeholder="Budget" value="${item.budget_fgd_identifikasi }" oninput="this.value = Math.abs(this.value)" name="budget_b_pro" class="form-control pelaksanaan pemetaan_inp">`;
                                  row +=`<span id="budget-b-pro-messages"></span>`;
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                              
                                   row +=`<div id="desc-b-pro-alert" class="pdf-btn-center">`; 
                                             
                                             
                                       
                                        
                                        row +=`<div id="img-file-fgd-identifikasi">`;
                                           if(item.keterangan_fgd_identifikasi)
                                           {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_fgd_identifikasi }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                           }
                                        row +=`</div>`;
                                    
                                             row +=`<input type="file" style="display:none;" name="desc_b_pra" id="desc-b-pro" value="" class="form-control">`;
                                             row +=`<span id="desc-b-pro-messages"></span>`; 
                                  row +=`</div>`; 


                                   
                               row +=`</td>`; 
                    row +=`</tr>`; 
                              
                    row +=`<tr>`; 
                               row +=`<td class="font-bold" rowspan="5">C.</td>`; 
                               row +=`<td id="pengolahan-alert" class="-abjad font-bold" colspan="7">`; 
                                   row +=`<div >Pengolahan dan analisis data untuk menghasilkan potensi sektor dan subsektor unggulan daerah :</div>`;
                                  row +=`<span id="pengolahan-messages"></span>`;    
                               row +=`</td>`;    
                    row +=`</tr>`; 

                    row +=` <tr>`; 
                            if(item.checklist_lq == 'true')
                            {
                                row +=`<td><input disabled id="checklist-lq" class="checkbox-pengolahan"  type="checkbox" checked name="checklist_lq" value="${item.checklist_lq }"></td>`;   
                            } else{
                                row +=`<td><input disabled id="checklist-lq" class="checkbox-pengolahan"  type="checkbox" name="checklist_lq" value="${item.checklist_lq }"></td>`;  
                            } 
                                
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=` 1.`; 
                               row +=`</td>`; 

                               row +=`<td class="-abjad font-bold"> LQ</td>`; 
                              row +=`<td>`; 
                              row +=`<div id="startdate-c-1-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input disabled type="date" id="startdate-lq"  name="startdate_c_1_pro"  value="${item.tgl_awal_lq }"  class="form-control">`; 
                                    row +=`<span id="startdate-c-1-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-1-pro-alert"  class="margin-none form-group">`;  
                                         row +=`<input disabled type="date" id="enddate-lq"   name="enddate_c_1_pro"  value="${item.tgl_ahir_lq }"  class="form-control">`; 
                                  row +=`<span id="enddate-c-1-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-1-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled min="0" id="budget-lq"   type="number"  placeholder="Budget" value="${item.budget_lq }" oninput="this.value = Math.abs(this.value)" name="budget_c_1_pro" class="form-control pelaksanaan pemetaan_inp">`; 
                                  row +=`<span id="budget-c-1-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td rowspan="4">`; 
                                   row +=`<div id="desc-c-1-pro-alert" class="potensi-sektor">`;

                                      
                                     
                                       
                                        row +=`<div id="img-file-pengolahan">`;
                                          if(item.keterangan_pengolahan)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_pengolahan }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;
                                    
                                        row +=`<input type="file" style="display:none" id="keterangan-pengolahan" value="" name="keterangan_pengolahan">`; 
                                   row +=`<span id="desc-c-1-pro-messages"></span>`; 
                                   row +=`</div>`; 

                               row +=`</td>`; 

                    row +=`</tr>`; 


                          row +=`<tr>`; 
                            if(item.checklist_shift_share == 'true')
                            {
                                row +=`<td><input disabled id="checklist-shift-share" class="checkbox-pengolahan" type="checkbox" checked name="checklist_shift_share" value="${item.checklist_shift_share }"></td>`;   
                            } else{
                                row +=`<td><input disabled id="checklist-shift-share" class="checkbox-pengolahan"  type="checkbox" name="checklist_shift_share" value="${item.checklist_shift_share }"></td>`;  
                            } 
                            
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=` 2.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Shift Share</td>`; 
                               row +=`<td>`; 
                               row +=`<div id="startdate-c-2-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input disabled id="startdate-shift-share" type="date"  name="startdate_shift_c_2_pro" value="${item.tgl_awal_shift_share }" class="form-control">`; 
                                   row +=` <span id="startdate-c-2-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-2-pro-alert" class="margin-none form-group"> `; 
                                  row +=`<input disabled type="date" id="enddate-shift-share"  name="enddate_c_2_pro" value="${item.tgl_ahir_shift_share }" class="form-control">`; 
                                  row +=`<span id="enddate-c-2-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-2-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled min="0" id="budget-shift-share"  type="number" placeholder="Budget" value="${item.budget_shift_share }"  oninput="this.value = Math.abs(this.value)" name="budget_c_2_pro" class="form-control pelaksanaan pemetaan_inp">`; 
                                  row +=`<span id="budget-c-2-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                           
                          row +=`</tr>`; 

                          row +=`<tr>`; 
                            if(item.checklist_tipologi_sektor == 'true')
                            {
                                row +=`<td><input disabled id="checklist-tipologi-sektor" class="checkbox-pengolahan"  type="checkbox" checked name="checklist_tipologi_sektor" value="${item.checklist_tipologi_sektor }"></td>`;   
                            } else{
                                row +=`<td><input disabled  id="checklist-tipologi-sektor" class="checkbox-pengolahan"  type="checkbox" name="checklist_tipologi_sektor" value="${item.checklist_tipologi_sektor }"></td>`;  
                            } 
                                 
                               row +=`<td class="font-bold table-number" >`; 
                                   row +=` 3.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Tipologi Sektor</td>`; 
                                row +=`<td>`; 
                               row +=`<div id="startdate-c-3-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input disabled type="date" id="startdate-tipologi-sektor"  name="startdate_c_3_pro" value="${item.tgl_awal_tipologi_sektor }"  class="form-control">`; 
                                    row +=`<span id="startdate-c-3-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-tipologi-sektor-pro-alert" class="margin-none form-group"> `; 
                                         row +=`<input disabled type="date" id="enddate-tipologi-sektor"  name="enddate_c_3_pro" value="${item.tgl_ahir_tipologi_sektor }"  class="form-control">`; 
                                 row +=` <span id="enddate-c-3-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-3-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input min="0" id="budget-tipologi-sektor"   type="number" disabled placeholder="Budget" value="${item.budget_tipologi_sektor }"  oninput="this.value = Math.abs(this.value)" name="budget_c_3_pro" class="form-control pelaksanaan pemetaan_inp">`; 
                                  row +=`<span id="budget-c-3-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                            
                          row +=`</tr>`; 

                          row +=`<tr>`; 
                           if(item.checklist_klassen == 'true')
                            {
                                row +=`<td><input disabled id="checklist-klassen" class="checkbox-pengolahan"  type="checkbox" checked name="checklist_klassen" value="${item.checklist_klassen }"></td>`;   
                            } else{
                                row +=`<td><input disabled id="checklist-klassen" class="checkbox-pengolahan"  type="checkbox" name="checklist_klassen" value="${item.checklist_klassen }"></td>`;  
                            } 
                              
                              row +=` <td class="font-bold table-number" >`; 
                                   row +=` 4.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Klassen</td>`; 
                               row +=`<td>`; 
                               row +=`<div id="startdate-c-4-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input disabled type="date" id="startdate-klassen"  name="startdate_c_4_pro" value="${item.tgl_awal_klassen }" class="form-control">`; 
                                   row +=` <span id="startdate-c-4-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-4-pro-alert"   class="margin-none form-group"> `; 
                                row +=`<input type="date" disabled  name="enddate-c-4-pro" value="${item.tgl_ahir_klassen }" id="enddate-klassen" class="form-control">`; 
                                  row +=`<span id="enddate-c-4-pro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                               row +=`<td>`; 
                             row +=`<div id="budget-c-4-pro-alert" class="margin-none form-group">`; 
                                         row +=`<input disabled min="0" id="budget-klassen" type="number" placeholder="Budget" value="${item.budget_klassen }" oninput="this.value = Math.abs(this.value)" name="budget_c_4_pro" class="form-control pelaksanaan pemetaan_inp">`; 
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
                                    row +=`<input readonly type="date" id="startdate-d-pro"  name="startdate_d_pro" value="${item.tgl_awal_fgd_klarifikasi }" class="form-control">`; 
                                   row +=` <span id="startdate-d-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                              row +=` <td>`; 
                             row +=`<div id="enddate-d-pro-alert" class="margin-none form-group"> `; 
                                       row +=`  <input readonly type="date" id="enddate-d-pro"  name="enddate_d_pro" value="${item.tgl_ahir_fgd_klarifikasi }" class="form-control">`; 
                                 row +=` <span id="enddate-d-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-d-pro-alert" class="margin-none form-group">`; 
                                        row +=` <input readonly min="0"  id="budget-d-pro" type="number" placeholder="Budget" value="${item.budget_fgd_klarifikasi }" oninput="this.value = Math.abs(this.value)" name="budget_d_pro" class="form-control pelaksanaan pemetaan_inp">`; 
                                  row +=`<span id="budget-d-pro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="desc-d-pro-alert" class="pdf-btn-center">`;
                                        

                                      
                                        
                                        row +=`<div id="img-file-fgd-klarifikasi">`;
                                          if(item.keterangan_fgd_klarifikasi)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_fgd_klarifikasi }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;

                                     
                                        row +=`<input type="file" style="display:none;" id="desc-d-pro" name="desc_d_pro" value="${item.keterangan_fgd_klarifikasi }" class="form-control ">`; 
                                  row +=`<span id="desc-d-pro-messages"></span>`; 
                            row +=` </div>`; 

                               row +=`</td>`; 
                         row +=` </tr>`; 
                         

                          


                        
                        row +=`<tr>`; 
                          row +=`<td class="font-bold">E.</td>`; 
                          row +=`<td></td>`;
                          row +=`<td></td>`;
                          row +=`<td class="-abjad font-bold"><textarea readonly class="textarea-table">Melaksanakan Rapat Koordinasi Finalisasi antara DPMPTSP Provinsi dengan dinas/stakeholder terkait dalam rangka konfirmasi dan pelengkapan data dalam rangka penetapan sektor dan subsektor unggulan hasil analisis</textarea></td>`; 
                          row +=`<td>`; 
                               row +=`<div id="startdate-e-pro-alert" class="margin-none form-group"> `; 
                                    row +=`<input readonly type="date" id="startdate-e-pro"  name="startdate_e_pro" value="${item.tgl_awal_finalisasi }"  class="form-control">`; 
                                    row +=`<span id="startdate-e-pro-messages"></span>`; 
                             row +=`</div>`; 
                          row +=`</td>`; 
                              row +=` <td>`; 
                            row +=` <div id="enddate-e-pro-alert" class="margin-none form-group"> `; 
                                       row +=` <input readonly type="date" id="enddate-e-pro"  name="enddate_e_pro" value="${item.tgl_ahir_finalisasi }"  class="form-control">`; 
                                  row +=`<span id="enddate-e-pro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-e-pro-alert" class="margin-none form-group">`; 
                                        row +=` <input readonly min="0" id="budget-e-pro"  type="number" placeholder="Budget"  oninput="this.value = Math.abs(this.value)" name="budget_e_pro" value="${item.budget_finalisasi }" class="form-control pelaksanaan pemetaan_inp">`; 
                                  row +=`<span id="budget-e-pro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="desc-e-pro-alert" class="pdf-btn-center">`;

                                        
                                        
                                        row +=`<div id="img-file-fgd-konfirmasi">`;
                                          if(item.keterangan_finalisasi)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_finalisasi }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;
                                   

                                        row +=` <input type="file" style="display:none;"  id="desc-e-pro" name="desc_e_pro" value=""  class="form-control">`; 
                                  row +=`<span id="desc-e-pro-messages"></span>`; 
                             row +=`</div>`; 

                               row +=`</td>`; 
                         row +=` </tr>`; 
                      
                         row +=`<tr>`; 
                           row +=` <td rowspan="12" class="font-bold text-center">3</td>`; 
                            row +=`<td colspan="6" class="font-bold"> Penyusunan Peta Potensi Investasi : </td>`; 
                             row +=`<td><strong id="total_penyusunan">${item.total_penyusunan } </td>`; 
                            row +=`<td></td>`; 
                            row +=`</tr>`; 
                         row +=`<tr>`; 


                         row +=`<tr>`; 
                             row +=` <td class="font-bold" rowspan="8">A.</td>`; 
                             row +=` <td id="penyusunan-alert" class="-abjad font-bold" colspan="7">`; 
                                   row +=`<div >Menyusun hasil identifikasi, pengolahan, dan analisis data dalam bentuk dokumen</div>`;
                                   row +=`<span id="penyusunan-messages"></span>`;  
                              row +=`</td>`; 
                         row +=`</tr>`; 

                      


                         row +=`<tr>`; 
                            if(item.checklist_summary_sektor_unggulan == 'true')
                            {
                                row +=`<td><input disabled id="checklist-summary-sektor-unggulan"  type="checkbox" class="checkbox-penyusunan" checked name="checklist_summary_sektor_unggulan" value="${item.checklist_summary_sektor_unggulan }"></td>`;   
                            } else{
                                row +=`<td><input disabled id="checklist-summary-sektor-unggulan" class="checkbox-penyusunan"  type="checkbox" name="checklist_summary_sektor_unggulan" value="${item.checklist_summary_sektor_unggulan }"></td>`;  
                            }  
                             row +=` <td class="font-bold table-number" >`; 
                                  row +=` 1.`; 
                             row +=` </td>`; 
                              row +=`<td class="-abjad font-bold"> Deskripsi singkat sektor unggulan</td>`; 
                              row +=`<td>`; 
                                   row +=`<div id="startdate-a-1-ppro-alert"  class="margin-none form-group"> `; 
                                       row +=` <input disabled type="date" id="startdate-summary-sektor-unggulan"  name="startdate_a_1_ppro" value="${item.tgl_awal_summary_sektor_unggulan }"   class="form-control">`; 
                                       row +=` <span id="startdate-a-1-ppro-messages"></span>`; 
                                row +=` </div>`; 
                              row +=`</td>`; 
                              row +=`<td>`; 
                                 row +=`<div id="enddate-a-1-ppro-alert" class="margin-none form-group"> `; 
                                             row +=`<input disabled id="enddate-summary-sektor-unggulan"  type="date"  name="enddate_a_1_pro" value="${item.tgl_ahir_summary_sektor_unggulan }"  class="form-control" >`; 
                                      row +=`<span id="enddate-a-1-ppro-messages"></span>`; 
                                row +=` </div>`; 
                                   row +=`</td>`; 
                                  row +=` <td>`; 
                                 row +=`<div id="budget-a-1-ppro-alert" class="margin-none form-group">`; 
                                            row +=` <input disabled min="0" id="budget-summary-sektor-unggulan"  type="number" placeholder="Budget" value="${item.budget_summary_sektor_unggulan }" oninput="this.value = Math.abs(this.value)" name="budget_a_1_ppro" class="form-control penyusunan pemetaan_inp">`; 
                                     row +=` <span id="budget-a-1-ppro-messages"></span>`; 
                                 row +=`</div>`; 
                             row +=` </td>`; 
                             row +=` <td rowspan="7">`; 
                                    row +=`<div id="desc-a-1-ppro-alert" class="penyusunan-peta">`; 

                                    
                                        
                                        row +=`<div id="img-file-penyusunan">`;
                                          if(item.keterangan_penyusunan)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_penyusunan }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                           }
                                        row +=`</div>`;

                                    
                                             row +=` <input type="file" style="display:none" id="keterangan-penyusunan" name="keterangan_penyusunan" value="${item.keterangan_penyusunan }" class="form-control">`; 
                                      row +=` <span id="desc-a-1-ppro-messages"></span>`; 
                                    row +=`</div>`; 

                               row +=`</td>`; 

                         
                    row +=`</tr>`; 

                    row +=`<tr>`; 
                                 if(item.checklist_sektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled id="checklist-sektor-unggulan" class="checkbox-penyusunan"  type="checkbox" checked name="checklist_sektor_unggulan" value="${item.checklist_sektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled id="checklist-sektor-unggulan" class="checkbox-penyusunan"  type="checkbox" name="checklist_sektor_unggulan" value="${item.checklist_sektor_unggulan }"></td>`;  
                                 }
                              row +=` <td class="font-bold table-number" >`; 
                                  row +=`2.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Deskripsi sektor unggulan</td>`; 
                               row +=`<td>`; 
                                   row +=` <div id="startdate-a-2-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input disabled type="date" id="startdate-sektor-unggulan"  name="startdate_a_2_ppro" value="${item.tgl_awal_sektor_unggulan }" class="form-control">`; 
                                         row +=`<span id="startdate-a-2-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                  row +=`<div id="enddate-a-2-ppro-alert" class="margin-none form-group"> `; 
                                             row +=` <input disabled type="date" id="enddate-sektor-unggulan"  name="enddate_a_2_pro" value="${item.tgl_ahir_sektor_unggulan }" class="form-control">`; 
                                       row +=`<span id="enddate-a-2-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                                   row +=` </td>`; 
                                   row +=` <td>`; 
                                  row +=`<div id="budget-a-2-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input min="0" id="budget-sektor-unggulan" type="number" disabled placeholder="Budget" value="${item.budget_sektor_unggulan }" oninput="this.value = Math.abs(this.value)" name="budget_a_2_ppro" class="form-control penyusunan pemetaan_inp">`; 
                                       row +=`<span id="budget-a-2-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                               row +=`</td>`; 
                            
                    row +=`</tr>`; 

                    row +=`<tr>`; 
                                  if(item.checklist_potensi_pasar == 'true')
                                 {
                                     row +=`<td><input disabled id="checklist-potensi-pasar" class="checkbox-penyusunan"  type="checkbox" checked name="checklist_potensi_pasar" value="${item.checklist_potensi_pasar }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled id="checklist-potensi-pasar" class="checkbox-penyusunan" type="checkbox" name="checklist_potensi_pasar" value="${item.checklist_potensi_pasar }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=`3.`; 
                              row +=`</td>`; 
                               row +=`<td class="-abjad font-bold">  Potensi pasar</td>`; 
                             
                               row +=`<td>`; 
                                   row +=` <div id="startdate-a-3-ppro-alert" class="margin-none form-group"> `; 
                                       row +=`  <input disabled type="date" id="startdate-potensi-pasar"  name="startdate_a_3_ppro" value="${item.tgl_awal_potensi_pasar }"  class="form-control">`; 
                                        row +=` <span id="startdate-a-3-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                              row +=`</td>`; 
                               row +=`<td>`; 
                                  row +=`<div id="enddate-a-3-ppro-alert" class="margin-none form-group"> `; 
                                             row +=` <input disabled type="date" id="enddate-potensi-pasar"  name="enddate_a_3_pro" value="${item.tgl_ahir_potensi_pasar }" class="form-control">`; 
                                       row +=`<span id="enddate-a-3-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                                   row +=` </td>`; 
                                    row +=`<td>`; 
                                 row +=` <div id="budget-a-3-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input min="0" id="budget-potensi-pasar" type="number" disabled placeholder="Budget" value="${item.budget_potensi_pasar }"  oninput="this.value = Math.abs(this.value)" name="budget_a_3_ppro" class="form-control penyusunan pemetaan_inp">`; 
                                       row +=`<span id="budget-a-3-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                           
                          row +=`</tr>`; 

                          row +=`<tr>`; 
                                 if(item.checklist_parameter_sektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled id="checklist-parameter-sektor-unggulan" type="checkbox" class="checkbox-penyusunan" checked name="checklist_parameter_sektor_unggulan" value="${item.checklist_parameter_sektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled id="checklist-parameter-sektor-unggulan"  type="checkbox" class="checkbox-penyusunan" name="checklist_parameter_sektor_unggulan" value="${item.checklist_parameter_sektor_unggulan }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                    row +=`4.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Parameter data sektor unggulan</td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="startdate-a-4-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input disabled type="date" id="startdate-parameter-sektor-unggulan" name="startdate_a_4_ppro" value="${item.tgl_awal_parameter_sektor_unggulan }"  class="form-control">`; 
                                         row +=`<span id="startdate-a-4-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                               row +=`</td>`; 
                              row +=` <td>`; 
                                 row +=` <div id="enddate-a-4-ppro-alert" class="margin-none form-group"> `; 
                                           row +=`   <input disabled type="date" id="enddate-parameter-sektor-unggulan"  name="enddate_a_4_pro" value="${item.tgl_ahir_parameter_sektor_unggulan }"  class="form-control">`; 
                                      row +=` <span id="enddate-a-4-ppro-messages"></span>`; 
                                row +=`  </div>`; 
                                   row +=` </td>`; 
                                   row +=` <td>`; 
                                  row +=`<div id="budget-a-4-ppro-alert" class="margin-none form-group">`; 
                                              row +=`<input disabled min="0" id="budget-parameter-sektor-unggulan" type="number" placeholder="Budget" value="${item.budget_parameter_sektor_unggulan }"  oninput="this.value = Math.abs(this.value)" name="budget_a_4_ppro" class="form-control penyusunan pemetaan_inp">`; 
                                       row +=`<span id="budget-a-4-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                             
                         row +=` </tr>`; 

                          row +=`<tr>`; 
                                 if(item.checklist_subsektor_unggulan == 'true')
                                 {
                                     row +=`<td><input disabled id="checklist-subsektor-unggulan" class="checkbox-penyusunan"  type="checkbox" checked name="checklist_subsektor_unggulan" value="${item.checklist_subsektor_unggulan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled id="checklist-subsektor-unggulan"   class="checkbox-penyusunan" type="checkbox" name="checklist_subsektor_unggulan" value="${item.checklist_subsektor_unggulan }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                  row +=`5.`; 
                              row +=` </td>`; 
                              
                               row +=`<td class="-abjad font-bold"> <textarea readonly class="textarea-table">Subsektor unggulan dan komoditas unggulan yang berisi deskripsi dan parameter (mencakup data produksi, luas lahan, pelaku usaha, peluang usaha dan data terkait lainnya)</textarea></td>`; 
                              row +=` <td>`; 
                                   row +=` <div id="startdate-a-5-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input disabled type="date" id="startdate-subsektor-unggulan" name="startdate_a_5_ppro" value="${item.tgl_awal_subsektor_unggulan }"   class="form-control">`; 
                                        row +=` <span id="startdate-a-5-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                 row +=` <div id="enddate-a-5-ppro-alert" class="margin-none form-group"> `; 
                                            row +=`  <input disabled type="date" id="enddate-subsektor-unggulan"  name="enddate_3_5_pro" value="${item.tgl_ahir_subsektor_unggulan }"   class="form-control">`; 
                                      row +=` <span id="enddate-a-5-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                                    row +=`</td>`; 
                                    row +=`<td>`; 
                                 row +=`<div id="budget-a-5-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input disabled min="0" id="budget-subsektor-unggulan"  type="number" placeholder="Budget" value="${item.budget_subsektor_unggulan }"   oninput="this.value = Math.abs(this.value)" name="budget_a_5_ppro" class="form-control penyusunan pemetaan_inp">`; 
                                      row +=` <span id="budget-a-5-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                              
                          row +=`</tr>`; 

                         row +=` <tr>`; 
                                 if(item.checklist_intensif_daerah == 'true')
                                 {
                                     row +=`<td><input disabled id="checklist-intensif-daerah" class="checkbox-penyusunan"  type="checkbox" checked name="checklist_intensif_daerah" value="${item.checklist_intensif_daerah }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled id="checklist-intensif-daerah" class="checkbox-penyusunan"  type="checkbox" name="checklist_intensif_daerah" value="${item.checklist_intensif_daerah }"></td>`;  
                                 }
                               row +=`<td class="font-bold table-number" >`; 
                                   row +=`6.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Insentif daerah</td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="startdate-a-6-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input disabled type="date" id="startdate-intensif-daerah"  name="startdate_a_6_ppro"  value="${item.tgl_awal_intensif_daerah }"  class="form-control">`; 
                                        row +=` <span id="startdate-a-6-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                 row +=` <div id="enddate-a-6-ppro-alert" class="margin-none form-group"> `; 
                                            row +=`  <input disabled type="date" id="enddate-intensif-daerah" name="enddate_a_6_pro"  value="${item.tgl_ahir_intensif_daerah }"   class="form-control">`; 
                                      row +=` <span id="enddate-a-6-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                                    row +=`</td>`; 
                                    row +=`<td>`; 
                                  row +=`<div id="budget-a-6-ppro-alert" class="margin-none form-group">`; 
                                              row +=`<input disabled min="0" id="budget-intensif-daerah"  type="number" placeholder="Budget"  value="${item.budget_intensif_daerah }"  oninput="this.value = Math.abs(this.value)" name="budget_a_6_ppro" class="form-control penyusunan pemetaan_inp">`; 
                                      row +=` <span id="budget-a-6-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                               row +=`</td>`; 
                          
                          row +=`</tr>`; 

                           row +=`<tr>`; 
                                  if(item.checklist_potensi_lanjutan == 'true')
                                 {
                                     row +=`<td><input disabled id="checklist-potensi-lanjutan" class="checkbox-penyusunan" type="checkbox" checked name="checklist_potensi_lanjutan" value="${item.checklist_potensi_lanjutan }"></td>`;   
                                 } else{
                                     row +=`<td><input disabled id="checklist-potensi-lanjutan" class="checkbox-penyusunan"  type="checkbox" name="checklist_potensi_lanjutan" value="${item.checklist_potensi_lanjutan }"></td>`;  
                                 } 
                               row +=`<td class="font-bold table-number" >`; 
                                   row +=`7.`; 
                               row +=`</td>`; 
                               row +=`<td class="-abjad font-bold"> Potensi lanjutan komoditas sektor unggulan</td>`; 
                               row +=`<td>`; 
                                    row +=`<div id="startdate-a-7-ppro-alert" class="margin-none form-group"> `; 
                                        row +=`<input disabled type="date" id="startdate-potensi-lanjutan" name="startdate_a_7_ppro" value="${item.tgl_awal_potensi_lanjutan }"  class="form-control">`; 
                                         row +=`<span id="startdate-a-7-ppro-messages"></span>`; 
                                 row +=` </div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                  row +=`<div id="enddate-a-7-ppro-alert" class="margin-none form-group"> `; 
                                              row +=`<input disabled type="date" id="enddate-potensi-lanjutan"  name="enddate_a_7_pro" value="${item.tgl_ahir_potensi_lanjutan }" class="form-control">`; 
                                       row +=`<span id="enddate-a-7-ppro-messages"></span>`; 
                                  row +=`</div>`; 
                                    row +=`</td>`; 
                                    row +=`<td>`; 
                                  row +=`<div id="budget-a-7-ppro-alert" class="margin-none form-group">`; 
                                             row +=` <input disabled min="0" id="budget-potensi-lanjutan"  type="number" placeholder="Budget" value="${item.budget_potensi_lanjutan }" oninput="this.value = Math.abs(this.value)" name="budget_a_7_ppro" class="form-control penyusunan pemetaan_inp">`; 
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
                                    row +=`<input readonly type="date" id="startdate-b-ppro"  name="startdate_b_ppro" value="${item.tgl_awal_info_grafis }"  class="form-control">`; 
                                   row +=` <span id="startdate-b-ppro-messages"></span>`; 
                             row +=`</div>`; 
                         row +=` </td>`; 
                              row +=` <td>`; 
                            row +=` <div id="enddate-b-ppro-alert" class="margin-none form-group"> `; 
                                        row +=` <input readonly type="date" id="enddate-b-ppro"  name="enddate_b_ppro" value="${item.tgl_ahir_info_grafis }"  class="form-control">`; 
                                  row +=`<span id="enddate-b-ppro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=` </td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-b-ppro-alert" class="margin-none form-group">`; 
                                        row +=` <input readonly min="0"  type="number" id="budget-b-ppro" placeholder="Budget" value="${item.budget_info_grafis }"  oninput="this.value = Math.abs(this.value)" name="budget_b_ppro" class="form-control penyusunan pemetaan_inp">`; 
                                  row +=`<span id="budget-b-ppro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                               row +=`<td>`; 
                                   row +=` <div id="desc-b-ppro-alert" class="pdf-btn-center">`; 

                                      
                                        
                                        row +=`<div id="img-file-info-grafis">`;
                                          if(item.keterangan_info_grafis)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_info_grafis }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                          }
                                        row +=`</div>`;
                                   
                                     
                                        row +=` <input type="file" style="display:none;" id="desc-b-ppro" name="desc_b_ppro" value="${item.keterangan_info_grafis }"   class="form-control">`; 
                                        row +=`<span id="desc-b-ppro-messages"></span>`; 
                                   row +=`</div>`; 

                               row +=`</td>`; 
                        row +=`</tr>`; 
                        row +=`<tr>`; 
                          row +=`<td class="font-bold">C.</td>`; 
                          row +=`<td></td>`;
                          row +=`<td></td>`;
                          row +=`<td class="font-bold" ><textarea readonly class="textarea-table">Mendokumentasikan peta potensi investasi secara elektronik dalam bentuk infografis yang didigitalisasi dan ditampilkan pada portal PIR</textarea></td>`; 
                          row +=`<td>`; 
                              row +=` <div id="startdate-c-ppro-alert" class="margin-none form-group">`;  
                                    row +=`<input readonly type="date" id="startdate-c-ppro" name="startdate_c_ppro" value="${item.tgl_awal_dokumentasi }"  class="form-control">`; 
                                    row +=`<span id="startdate-c-ppro-messages"></span>`; 
                             row +=`</div>`; 
                         row +=` </td>`; 
                               row +=`<td>`; 
                             row +=`<div id="enddate-c-ppro-alert" class="margin-none form-group"> `; 
                                         row +=`<input readonly type="date" id="enddate-c-ppro"  name="enddate_c_ppro" value="${item.tgl_ahir_dokumentasi }"  class="form-control">`; 
                                  row +=`<span id="enddate-c-ppro-messages"></span>`; 
                             row +=`</div>`; 
                               row +=`</td>`; 
                              row +=` <td>`; 
                             row +=`<div id="budget-c-ppro-alert" class="margin-none form-group">`; 
                                         row +=`<input readonly min="0"  type="number" id="budget-c-ppro" placeholder="Budget"  oninput="this.value = Math.abs(this.value)" name="budget_c_ppro" value="${item.budget_dokumentasi }"  class="form-control penyusunan pemetaan_inp">`; 
                                  row +=`<span id="budget-c-ppro-messages"></span>`; 
                             row +=`</div>`; 
                              row +=`</td>`; 
                               row +=`<td>`; 
                                   row +=` <div id="desc-c-ppro-alert" class="pdf-btn-center">`; 
                                         
                                        
                                        row +=`<div id="img-file-doc-info-grafis">`;
                                          if(item.keterangan_dokumentasi)
                                          {
                                             row +=`<div id="viewPdf" class="viewpdf normal-pdf" data-param_file="${item.keterangan_dokumentasi }" 
                                             data-toggle="modal" data-target="#modal-view-${item.id }"  data-toggle="tooltip" data-placement="top" title="View Data">Lihat PDF</div>`;

                                              row +=`<div id="modal-view-${item.id }" class="modal fade" role="dialog">`;
                                                   row +=`<div id="FormView-${item.id }"></div>`;
                                             row +=`</div>`;
                                           } 
                                        row +=`</div>`;
                                    
                                  

                                        row +=` <input type="file" style="display:none;" id="desc-c-ppro" name="desc_c_ppro" value="${item.keterangan_dokumentasi }"  class="form-control pasca-produksi">`; 
                                        row +=` <span id="desc-c-ppro-messages"></span>`; 
                            row +=` </div>`; 

                            

                               row +=`</td>`; 
                    row +=`</tr>`; 
       
                   
                    content.append(row);
                    getperiode(item.periode_id);  
                    $('#pagu_promosi').html('<b>'+item.pagu_promosi_convert+'</b>');
                    $('#total_promosi').html('<b>'+item.total_promosi_convert+'</b>');
                    $(".pemetaan_inp").on("input", updateTotalPemetaan);
                 
                   
                    

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