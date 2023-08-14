@extends('template/sidakv2/layout.app')
@section('content')
<div class="content">
     <div class="row in-content">
          <form  id="FormSubmit" >
               <section class="col-lg-7  connectedSortable ui-sortable ">
                    <div class="box box-solid box-primary ">
                          <div class="box-header with-border border-radius-top">
                             <h3 class="box-title">Pengawasan</h3>
                           </div>
                           <div class="box-body" >
                              <div class="row">

                                 <div class="form-group col-sm-12" >
                                     <label>1. Pengawasan Penanaman Modal :</label>     
                                 </div>

                                 <div class="form-group col-sm-12" >
                                     <label>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha :</label>
                                 </div>

                                 <div id="pengawas-analisa-target-alert" class="form-group col-sm-3" >
                                      <label>Target :</label>
                                      <input id="pengawas_analisa_target" type="number" class="form-control" placeholder="Target"  name="pengawas_analisa_target">
                                      <span id="pengawas-analisa-target-messages"></span>
                                 </div>

                                 <div class="form-group col-sm-3" >
                                      <label>Satuan :</label>
                                      <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                     
                                 </div>


                                 <div id="pengawas-analisa-pagu-alert" class="form-group col-sm-3">
                                      <label>Pagu :</label>
                                      <input id="pengawas_analisa_pagu" type="number" class="form-control" placeholder="Pagu" name="pengawas_analisa_pagu">
                                      <span id="pengawas-analisa-pagu-messages"></span>
                                   
                                 </div>


                                 <div class="form-group col-sm-12" >
                                        <label>B. Inspeksi Lapangan :</label>
                                 </div>

                                 <div id="pengawas-inspeksi-target-alert" class="form-group col-sm-3" >
                                      <label> Target :</label>
                                      <input id="pengawas_inspeksi_target" name="pengawas_inspeksi_target" type="number" class="form-control" placeholder="Target">
                                      <span id="pengawas-inspeksi-target-messages"></span>
                                 </div>


                                 <div class="form-group col-sm-3" >
                                      <label>Satuan :</label>
                                      <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                      
                                 </div>


                                 <div id="pengawas-inspeksi-pagu-alert" class="form-group col-sm-3" >
                                      <label>Pagu :</label>
                                      <input id="pengawas_inspeksi_pagu" name="pengawas_inspeksi_pagu" type="number" class="form-control" placeholder="Pagu">
                                      <span id="pengawas-inspeksi-pagu-messages"></span>
                                 </div>


                                 <div class="form-group col-sm-12" >
                                     <label>C. Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha :</label>
                                 </div>

                                 <div id="pengawas-evaluasi-target-alert" class="form-group col-sm-3" >
                                      <label>Target :</label>
                                      <input id="pengawas_evaluasi_target" name="pengawas_evaluasi_target" type="number" class="form-control" placeholder="Target">
                                      <span id="pengawas-evaluasi-target-messages"></span>
                                 </div>


                                 <div class="form-group col-sm-3" >
                                      <label>Satuan :</label>
                                      <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                     
                                 </div>


                                 <div id="pengawas-evaluasi-pagu-alert" class="form-group col-sm-3" >
                                      <label>Pagu :</label>
                                      <input id="pengawas_evaluasi_pagu" name="pengawas_evaluasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                      <span id="pengawas-evaluasi-pagu-messages"></span>
                                 </div>
                              </div>

                          </div>  
                    </div> 

                    <div class="box box-solid box-primary ">
                         <div class="box-header with-border border-radius-top">
                            <h3 class="box-title">Bimbingan/Sosialisasi</h3>
                         </div>

                         <div class="box-body" >
                      
                              <div class="row" >
                                 <div class="form-group col-sm-12">
                                     <label>2. Bimbingan Teknis Kepada Pelaku Usaha :</label>     
                                 </div> 

                                 <div class="form-group col-sm-12" >
                                     <label>A. Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko :</label>
                                 </div>

                                 <div id="bimtek-perizinan-target-alert" class="form-group col-sm-3" >
                                      <label>Target :</label>
                                      <input id="bimtek_perizinan_target" name="bimtek_perizinan_target" type="number" class="form-control" placeholder="Target">
                                      <span id="bimtek-perizinan-target-messages"></span>
                                 </div>


                                 <div class="form-group col-sm-3" >
                                      <label>Satuan :</label>
                                      <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                     
                                 </div>


                                 <div id="bimtek-perizinan-pagu-alert" class="form-group col-sm-3" >
                                      <label>Pagu :</label>
                                      <input id="bimtek_perizinan_pagu" name="bimtek_perizinan_pagu" type="number" class="form-control" placeholder="Pagu">
                                      <span id="bimtek-perizinan-pagu-messages"></span>
                                 </div>

                                 <div class="form-group col-sm-12" >
                                     <label>B. Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko :</label>
                                 </div>

                                 <div id="bimtek-pengawasan-target-alert" class="form-group col-sm-3" >
                                      <label> Target :</label>
                                      <input id="bimtek_pengawasan_target" name="bimtek_pengawasan_target" type="number" class="form-control" placeholder="Target">
                                      <span id="bimtek-pengawasan-target-messages"></span> 
                                 </div>


                                 <div class="form-group col-sm-3" >
                                      <label>Satuan :</label>
                                      <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                     
                                 </div>


                                 <div id="bimtek-pengawasan-pagu-alert" class="form-group col-sm-3" >
                                      <label>Pagu :</label>
                                      <input id="bimtek_pengawasan_pagu" name="bimtek_pengawasan_target" type="number" class="form-control" placeholder="Pagu">
                                      <span id="bimtek-pengawasan-pagu-messages"></span>
                                 </div>

                              </div>    
                         </div>   
                    </div>

                    <div class="box box-solid box-primary ">
                      <div class="box-header with-border border-radius-top">
                        <h3 class="box-title">Penyelesaian</h3>
                      </div>
                    <div class="box-body" >
                       
                        <div class="row" >
                            <div class="form-group col-sm-12">
                                <label>3. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya :</label>     
                            </div> 

                            <div class="form-group col-sm-12" >
                                <label>A. Identifikasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya :</label>
                            </div>

                            <div id="penyelesaian-identifikasi-target-alert" class="form-group col-sm-3" >
                                 <label>Target :</label>
                                 <input id="penyelesaian_identifikasi_target" name="penyelesaian_identifikasi_target" type="number" class="form-control" placeholder="Target">
                                 <span id="penyelesaian-identifikasi-target-messages"></span>
                            </div>


                            <div  class="form-group col-sm-3" >
                                 <label>Satuan :</label>
                                 <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                
                            </div>


                            <div id="penyelesaian-identifikasi-pagu-alert" class="form-group col-sm-3" >
                                 <label>Pagu :</label>
                                 <input id="penyelesaian_identifikasi_pagu" name="penyelesaian_identifikasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span id="penyelesaian-identifikasi-pagu-messages"></span>
                            </div>



                            <div class="form-group col-sm-12" >
                                <label>B. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya :</label>
                            </div>

                            <div id="penyelesaian-realisasi-target-alert" class="form-group col-sm-3" >
                                 <label> Target :</label>
                                 <input id="penyelesaian_realisasi_target" name="penyelesaian_realisasi_target" type="number" class="form-control" placeholder="Target">
                                 <span id="penyelesaian-realisasi-target-messages"></span>
                            </div>


                            <div class="form-group col-sm-3" >
                                 <label>Satuan :</label>
                                 <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                 
                            </div>


                            <div id="penyelesaian-realisasi-pagu-alert" class="form-group col-sm-3" >
                                 <label>Pagu :</label>
                                 <input id="penyelesaian_realisasi_pagu" name="penyelesaian_realisasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span id="penyelesaian-realisasi-pagu-messages"></span>
                            </div>


                            <div class="form-group col-sm-12" >
                                <label>C. Evaluasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya Perizinan Berusaha Para Pelaku Usaha :</label>
                            </div>

                            <div id="penyelesaian-evaluasi-target-alert" class="form-group col-sm-3" >
                                 <label>Target :</label>
                                 <input id="penyelesaian_evaluasi_target" name="penyelesaian_evaluasi_target" type="number" class="form-control" placeholder="Target">
                                 <span id="penyelesaian-evaluasi-target-messages"></span>
                            </div>


                            <div class="form-group col-sm-3" >
                                 <label>Satuan :</label>
                                 <input  type="text" class="form-control" placeholder="Satuan" disabled>
                                
                            </div>


                            <div id="penyelesaian-evaluasi-pagu-alert" class="form-group col-sm-3" >
                                 <label>Pagu :</label>
                                 <input id="penyelesaian_evaluasi_pagu" name="penyelesaian_evaluasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span id="penyelesaian-evaluasi-pagu-messages"></span>
                            </div>





                        </div>    
                    </div>   
                </div>

               </section>
                 


               <section  class="col-lg-5 connectedSortable ui-sortable">
                    <div class="box box-solid box-primary ">
                      <div class="box-header with-border border-radius-top">
                        <h3 class="box-title">Pagu & Total</h3>
                      </div>

                         <div class="box-body ">
                             <div class="row">
                                   <div id="periode-id-alert" class="form-group col-sm-12">
                                       <label>Pilih Periode :</label>
                                       <select id="periode_id" class="select-add form-control"  name="periode_id" >   
                                       </select>
                                       <span id="periode-id-messages"></span>
                                   </div>

                                   <div class="form-group col-sm-12">
                                      <label>Pagu APBN :</label></br>
                                      <input type="text" id="pagu_apbn" class="form-control" disabled>
                                   </div> 


                                   <div id="nama-pejabat-alert" class="form-group col-sm-12" >
                                      <label>Nama Pejabat :</label>
                                      <input id="nama_pejabat" name="nama_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">
                                     <span id="nama-pejabat-messages"></span>
                                   </div> 

                                  <div id="nip-pejabat-alert" class="form-group col-sm-12" >
                                      <label>NIP Pejabat :</label>
                                      <input id="nip_pejabat" name="nip_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">
                                      <span id="nip-pejabat-messages"></span>
                                   </div> 

                                 <div id="tgl-tandatangan-alert" class="form-group col-sm-12" >
                                      <label>Tanggal Ditandatangani :</label>
                                      <input id="tgl_tandatangan" name="tgl_tandatangan" type="date" class="form-control" placeholder="Tanggal Ditandatangani">
                                      <span id="tgl-tandatangan-messages"></span>
                                 </div> 

                                 <div id="lokasi-alert" class="form-group col-sm-12" >
                                      <label>Lokasi :</label>
                                      <input id="lokasi" name="lokasi" type="text" class="form-control" placeholder="Lokasi">
                                      <span id="lokasi-messages"></span>
                                 </div> 

                                   <div  class="form-group col-sm-12" >
                                        <div class="col-sm-6"></div> 
                                        <div class="group-btn-rencana">
                                             <button id="simpan" type="button" class="btn btn-primary pull-right "><i class="fa fa-cloud-upload"></i> Kirim</button>

                                              <button id="draft" type="button" class="btn btn-default pull-left"><i class="fa fa-cloud-upload"></i> Draft</button>
                                        </div>
                                   </div>  

                             </div>
                         </div>         


                    </div>  
               </section> 

          </form>      

     </div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
    var list = []; 
    var periode =[];
    var pagu_apbn = 0;
    $('#pagu_apbn').val('Rp '+pagu_apbn+'');
    const user_sidebar  = JSON.parse(localStorage.getItem('user_sidebar'));
    $('#lokasi').val(user_sidebar.daerah_name);

       $.ajax({
        type: 'GET',
        url: BASE_URL +'/api/perencanaan/edit/',
        success: function(response) {
           list = response;
          
        },
        error: function( error) {
         
        }
      });
     
      $.ajax({
        type: 'GET',
        url: BASE_URL +'/api/periode/check',
        success: function(response) {
           periode = response;
           onOptionSelect(response)
        },
        error: function( error) {
         
        }
      });

       $('#periode_id').on('change', function() {
          var index = $(this).val();
          let find = periode.find(o => o.value === index); 
          
          $('#pagu_apbn').val(find.pagu_apbn);

       });


      // Function to update the content area with data
     function onOptionSelect(data) {
          const content = $('#periode_id');
          content.empty();
          data.forEach(item => {
              let row = ``;
               row +=`<option value="${item.value}">${item.text}</option>`;
             content.append(row);
          });     
    } 


    $("#simpan").click( () => {

          var data = $("#FormSubmit").serializeArray();
             
          var form = {
              "pengawas_analisa_target":data[0].value,
              "pengawas_analisa_pagu":data[1].value,
              "pengawas_inspeksi_target":data[2].value,
              "pengawas_inspeksi_pagu":data[3].value,
              "pengawas_evaluasi_target":data[4].value,
              "pengawas_evaluasi_pagu":data[5].value,
              "bimtek_perizinan_target":data[6].value,
              "bimtek_perizinan_pagu":data[7].value,
              "bimtek_pengawasan_target":data[8].value,
              "bimtek_pengawasan_pagu":data[9].value,
              "penyelesaian_identifikasi_target":data[10].value,
              "penyelesaian_identifikasi_pagu":data[11].value,
              "penyelesaian_realisasi_target":data[12].value,
              "penyelesaian_realisasi_pagu":data[13].value,
              "penyelesaian_evaluasi_target":data[14].value,
              "penyelesaian_evaluasi_pagu":data[15].value,
              "periode_id":data[16].value,
              "nama_pejabat":data[17].value,
              "nip_pejabat":data[18].value,
              "tgl_tandatangan":data[19].value,
              "lokasi":data[20].value,
              "type":"kirim",
          };

            SendingData(form);
          
     });

    $("#draft").click( () => {

          var data = $("#FormSubmit").serializeArray();
             
          var form = {
              "pengawas_analisa_target":data[0].value,
              "pengawas_analisa_pagu":data[1].value,
              "pengawas_inspeksi_target":data[2].value,
              "pengawas_inspeksi_pagu":data[3].value,
              "pengawas_evaluasi_target":data[4].value,
              "pengawas_evaluasi_pagu":data[5].value,
              "bimtek_perizinan_target":data[6].value,
              "bimtek_perizinan_pagu":data[7].value,
              "bimtek_pengawasan_target":data[8].value,
              "bimtek_pengawasan_pagu":data[9].value,
              "penyelesaian_identifikasi_target":data[10].value,
              "penyelesaian_identifikasi_pagu":data[11].value,
              "penyelesaian_realisasi_target":data[12].value,
              "penyelesaian_realisasi_pagu":data[13].value,
              "penyelesaian_evaluasi_target":data[14].value,
              "penyelesaian_evaluasi_pagu":data[15].value,
              "periode_id":data[16].value,
              "nama_pejabat":data[17].value,
              "nip_pejabat":data[18].value,
              "tgl_tandatangan":data[19].value,
              "lokasi":data[20].value,
              "type":"draft",
          };

            SendingData(form);
          
     });


    function SendingData(form){

       $.ajax({
            type:"POST",
            url: BASE_URL+'/api/perencanaan',
            data:form,
            cache: false,
            dataType: "json",
            success: (respons) =>{
                   Swal.fire({
                        title: 'Sukses!',
                        text: 'Berhasil Disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User clicked "Yes, proceed!" button
                            window.location.replace('/perencanaan');
                        }
                    });

                   //
            },
            error: (respons)=>{
                errors = respons.responseJSON;
                
                if(errors.messages.pengawas_analisa_target)
                {
                     $('#pengawas-analisa-target-alert').addClass('has-error');
                     $('#pengawas-analisa-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_analisa_target +'</strong>');
                }else{
                    $('#pengawas-analisa-target-alert').removeClass('has-error');
                    $('#pengawas-analisa-target-messages').removeClass('help-block').html('');
                }

                if(errors.messages.pengawas_analisa_pagu)
                {
                     $('#pengawas-analisa-pagu-alert').addClass('has-error');
                     $('#pengawas-analisa-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_analisa_pagu +'</strong>');
                }else{
                     $('#pengawas-analisa-pagu-alert').removeClass('has-error');
                     $('#pengawas-analisa-pagu-messages').removeClass('help-block').html('');
                }

                 if(errors.messages.pengawas_inspeksi_target)
                {
                     $('#pengawas-inspeksi-target-alert').addClass('has-error');
                     $('#pengawas-inspeksi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_inspeksi_target +'</strong>');
                }else{
                    $('#pengawas-inspeksi-target-alert').removeClass('has-error');
                    $('#pengawas-inspeksi-target-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.pengawas_inspeksi_pagu)
                {
                     $('#pengawas-inspeksi-pagu-alert').addClass('has-error');
                     $('#pengawas-inspeksi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_inspeksi_pagu +'</strong>');
                }else{
                     $('#pengawas-inspeksi-pagu-alert').removeClass('has-error');
                     $('#pengawas-inspeksi-pagu-messages').removeClass('help-block').html('');
                }

                if(errors.messages.pengawas_evaluasi_target)
                {
                     $('#pengawas-evaluasi-target-alert').addClass('has-error');
                     $('#pengawas-evaluasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_evaluasi_target +'</strong>');
                }else{
                    $('#pengawas-evaluasi-target-alert').removeClass('has-error');
                    $('#pengawas-evaluasi-target-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.pengawas_evaluasi_pagu)
                {
                     $('#pengawas-evaluasi-pagu-alert').addClass('has-error');
                     $('#pengawas-evaluasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_evaluasi_pagu +'</strong>');
                }else{
                    $('#pengawas-evaluasi-pagu-alert').removeClass('has-error');
                    $('#pengawas-evaluasi-pagu-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.bimtek_perizinan_target)
                {
                     $('#bimtek-perizinan-target-alert').addClass('has-error');
                     $('#bimtek-perizinan-target-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_perizinan_target +'</strong>');
                }else{
                    $('#bimtek-perizinan-target-alert').removeClass('has-error');
                    $('#bimtek-perizinan-target-messages').removeClass('help-block').html('');
                } 

                 if(errors.messages.bimtek_perizinan_pagu)
                {
                     $('#bimtek-perizinan-pagu-alert').addClass('has-error');
                     $('#bimtek-perizinan-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_perizinan_pagu +'</strong>');
                }else{
                    $('#bimtek-perizinan-pagu-alert').removeClass('has-error');
                    $('#bimtek-perizinan-pagu-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.bimtek_pengawasan_target)
                {
                     $('#bimtek-pengawasan-target-alert').addClass('has-error');
                     $('#bimtek-pengawasan-target-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_pengawasan_target +'</strong>');
                }else{
                    $('#bimtek-pengawasan-target-alert').removeClass('has-error');
                    $('#bimtek-pengawasan-target-messages').removeClass('help-block').html('');
                } 

                 if(errors.messages.bimtek_pengawasan_pagu)
                {
                     $('#bimtek-pengawasan-pagu-alert').addClass('has-error');
                     $('#bimtek-pengawasan-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_pengawasan_pagu +'</strong>');
                }else{
                    $('#bimtek-pengawasan-pagu-alert').removeClass('has-error');
                    $('#bimtek-pengawasan-pagu-messages').removeClass('help-block').html('');
                }  




                if(errors.messages.penyelesaian_identifikasi_target)
                {
                     $('#penyelesaian-identifikasi-target-alert').addClass('has-error');
                     $('#penyelesaian-identifikasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_identifikasi_target +'</strong>');
                }else{
                    $('#penyelesaian-identifikasi-target-alert').removeClass('has-error');
                    $('#penyelesaian-identifikasi-target-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.penyelesaian_identifikasi_pagu)
                {
                     $('#penyelesaian-identifikasi-pagu-alert').addClass('has-error');
                     $('#penyelesaian-identifikasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_identifikasi_pagu +'</strong>');
                }else{
                    $('#penyelesaian-identifikasi-pagu-alert').removeClass('has-error');
                    $('#penyelesaian-identifikasi-pagu-messages').removeClass('help-block').html('');
                }  



                if(errors.messages.penyelesaian_realisasi_target)
                {
                     $('#penyelesaian-realisasi-target-alert').addClass('has-error');
                     $('#penyelesaian-realisasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_realisasi_target +'</strong>');
                }else{
                    $('#penyelesaian-realisasi-target-alert').removeClass('has-error');
                    $('#penyelesaian-realisasi-target-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.penyelesaian_realisasi_pagu)
                {
                     $('#penyelesaian-realisasi-pagu-alert').addClass('has-error');
                     $('#penyelesaian-realisasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_realisasi_pagu +'</strong>');
                }else{
                    $('#penyelesaian-realisasi-pagu-alert').removeClass('has-error');
                    $('#penyelesaian-realisasi-pagu-messages').removeClass('help-block').html('');
                } 


                if(errors.messages.penyelesaian_evaluasi_target)
                {
                     $('#penyelesaian-evaluasi-target-alert').addClass('has-error');
                     $('#penyelesaian-evaluasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_evaluasi_target +'</strong>');
                }else{
                    $('#penyelesaian-evaluasi-target-alert').removeClass('has-error');
                    $('#penyelesaian-evaluasi-target-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.penyelesaian_evaluasi_pagu)
                {
                     $('#penyelesaian-evaluasi-pagu-alert').addClass('has-error');
                     $('#penyelesaian-evaluasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_evaluasi_pagu +'</strong>');
                }else{
                    $('#penyelesaian-evaluasi-pagu-alert').removeClass('has-error');
                    $('#penyelesaian-evaluasi-pagu-messages').removeClass('help-block').html('');
                }  


                if(errors.messages.periode_id)
                {
                     $('#periode-id-alert').addClass('has-error');
                     $('#periode-id-messages').addClass('help-block').html('<strong>'+ errors.messages.periode_id +'</strong>');
                }else{
                    $('#periode-id-alert').removeClass('has-error');
                    $('#periode-id-messages').removeClass('help-block').html('');
                }  

                if(errors.messages.nama_pejabat)
                {
                     $('#nama-pejabat-alert').addClass('has-error');
                     $('#nama-pejabat-messages').addClass('help-block').html('<strong>'+ errors.messages.nama_pejabat +'</strong>');
                }else{
                    $('#nama-pejabat-alert').removeClass('has-error');
                    $('#nama-pejabat-messages').removeClass('help-block').html('');
                } 

                if(errors.messages.nip_pejabat)
                {
                     $('#nip-pejabat-alert').addClass('has-error');
                     $('#nip-pejabat-messages').addClass('help-block').html('<strong>'+ errors.messages.nip_pejabat +'</strong>');
                }else{
                    $('#nip-pejabat-alert').removeClass('has-error');
                    $('#nip-pejabat-messages').removeClass('help-block').html('');
                }  


                if(errors.messages.tgl_tandatangan)
                {
                     $('#tgl-tandatangan-alert').addClass('has-error');
                     $('#tgl-tandatangan-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_tandatangan +'</strong>');
                }else{
                    $('#tgl-tandatangan-alert').removeClass('has-error');
                    $('#tgl-tandatangan-messages').removeClass('help-block').html('');
                }  

                 if(errors.messages.lokasi)
                {
                     $('#lokasi-alert').addClass('has-error');
                     $('#lokasi-messages').addClass('help-block').html('<strong>'+ errors.messages.lokasi +'</strong>');
                }else{
                    $('#lokasi-alert').removeClass('has-error');
                    $('#lokasi-messages').removeClass('help-block').html('');
                }  

            }
          });
    }


    

 });    
</script>
@stop