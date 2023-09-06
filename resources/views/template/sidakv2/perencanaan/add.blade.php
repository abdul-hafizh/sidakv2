@extends('template/sidakv2/layout.app')
@section('content')

<style> tr.border-bottom td { border-bottom: 3pt solid #f4f4f4; } td { padding: 10px !important; } .just-center { display: flex; justify-content: center; } </style>

<div class="content">
     <form id="FormSubmit">
          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body">
                         <div class="row pd-top-bottom-15">  
                              <div class="col-sm-4">
                                   <div class="form-group">
                                        <label  class="col-sm-3 label-header-box align-left">Pagu APBN :</label>
                                        <div class="col-sm-9">
                                             <div id="pagu_apbn" class="align-left pd-top-bottom-5"></div>
                                             <input type="hidden" id="pagu_apbn_inp">
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-4">
                                        <div class="form-group">
                                        <label  class="col-sm-4 label-header-box align-left">Total Rencana :</label>
                                        <div class="col-sm-8">
                                             <div id="total_rencana" class="align-left pd-top-bottom-5"></div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-sm-4">
                                   <div id="periode-alert" class="form-group">
                                        <label  class="col-sm-5 label-header-box align-right form-group margin-none">Pilih Periode :</label>
                                        <div class="col-sm-7">
                                             <div id="selectPeriode" class="form-group margin-none"></div>
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
                         <table class="table table-hover text-nowrap">
                              <thead>
                                   <tr>
                                        <th><div></div><span class="span-title">No</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Kegiatan/Sub Kegiatan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Target</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Satuan</span></th>
                                        <th><div class="split-table"></div><span class="span-title">Pagu APBN (Rp)</span></th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td><strong>1</strong></td>
                                        <td class="text-left"><strong>Pengawasan Penanaman Modal</strong></td>
                                        <td class="text-center"><strong id="total_pengawasan_target">0</strong></td>
                                        <td class="text-center"><strong>Kegiatan Usaha</strong></td>
                                        <td class="text-right"><strong id="total_pengawasan_pagu">Rp 0</strong></td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha</td>
                                        <td>
                                           <div id="pengawas-analisa-target-alert" class="margin-none form-group " >  
                                             <input id="pengawas_analisa_target" name="pengawas_analisa_target" type="number" min="0" class="form-control pengawasan_nilai_target"  placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="pengawas-analisa-target-messages"></span>
                                           </div>  
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>
                                        </td>
                                        <td>
                                          <div id="pengawas-analisa-pagu-alert" class="margin-none form-group" >   
                                             <input id="pengawas_analisa_pagu" name="pengawas_analisa_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="pengawas-analisa-pagu-messages"></span>
                                          </div>   
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>B. Inspeksi Lapangan</td>
                                        <td>
                                           <div id="pengawas-inspeksi-target-alert" class="margin-none form-group" >  
                                             <input id="pengawas_inspeksi_target" name="pengawas_inspeksi_target" type="number" min="0" class="form-control pengawasan_nilai_target target_pengawasan" placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="pengawas-inspeksi-target-messages"></span>
                                          </div>   
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>
                                        </td>
                                        <td>
                                           <div id="pengawas-inspeksi-pagu-alert" class="margin-none form-group" >  
                                             <input id="pengawas_inspeksi_pagu" name="pengawas_inspeksi_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="pengawas-inspeksi-pagu-messages"></span>
                                           </div>  
                                        </td>
                                   </tr>        
                                   <tr class="border-bottom">
                                        <td>&nbsp;</td>
                                        <td>C. Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha</td>
                                        <td>
                                          <div id="pengawas-evaluasi-target-alert" class="margin-none form-group" >   
                                             <input id="pengawas_evaluasi_target" name="pengawas_evaluasi_target" type="number" min="0" class="form-control pengawasan_nilai_target" placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="pengawas-evaluasi-target-messages"></span>
                                          </div>   
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>
                                        </td>
                                        <td>
                                           <div id="pengawas-evaluasi-pagu-alert" class="margin-none form-group" >   
                                             <input id="pengawas_evaluasi_pagu" name="pengawas_evaluasi_pagu" type="number" min="0" class="form-control nilai_inp pengawasan_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="pengawas-evaluasi-pagu-messages"></span>
                                           </div>  
                                        </td>
                                   </tr>
                                   <tr>
                                        <td><strong>2</strong></td>
                                        <td class="text-left"><strong>Bimbingan Teknis Kepada Pelaku Usaha</strong></td>
                                        <td class="text-center"><strong id="total_bimtek_target">0</strong></td>
                                        <td class="text-center"><strong>Pelaku Usaha</strong></td>
                                        <td class="text-right"><strong id="total_bimtek_pagu">Rp 0</strong></td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>A. Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko</td>
                                        <td>
                                             <input id="bimtek_perizinan_target" name="bimtek_perizinan_target" type="number" min="0" class="form-control bimtek_perizinan_target bimtek_nilai_target" placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="bimtek-perizinan-target-messages"></span>
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Pelaku Usaha" value="Pelaku Usaha" disabled >
                                        </td>
                                        <td>
                                             <input id="bimtek_perizinan_pagu" name="bimtek_perizinan_pagu" type="number" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="bimtek-perizinan-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr class="border-bottom">
                                        <td>&nbsp;</td>
                                        <td>B. Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko</td>
                                        <td>
                                             <input id="bimtek_pengawasan_target" name="bimtek_pengawasan_target" type="number" min="0" class="form-control bimtek_pengawasan_target bimtek_nilai_target" placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="bimtek-pengawasan-target-messages"></span> 
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Pelaku Usaha" value="Pelaku Usaha" disabled>
                                        </td>
                                        <td>
                                             <input id="bimtek_pengawasan_pagu" name="bimtek_pengawasan_pagu" type="number" min="0" class="form-control nilai_inp bimtek_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="bimtek-pengawasan-pagu-messages"></span>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td><strong>3</strong></td>
                                        <td class="text-left"><strong>Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</strong></td>
                                        <td class="text-center"><strong id="total_penyelesaian_target">0</strong></td>
                                        <td class="text-center"><strong>Kegiatan Usaha</strong></td>
                                        <td class="text-right"><strong id="total_penyelesaian_pagu">Rp 0</strong></td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>A. Identifikasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya</td>
                                        <td>
                                          <div id="penyelesaian-identifikasi-target-alert" class="margin-none form-group" >    
                                             <input id="penyelesaian_identifikasi_target" name="penyelesaian_identifikasi_target" type="number" class="form-control penyelesaian_nilai_target" placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="penyelesaian-identifikasi-target-messages"></span>
                                           </div>  
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>
                                        </td>
                                        <td>
                                           <div id="penyelesaian-identifikasi-pagu-alert" class="margin-none form-group" >    
                                             <input id="penyelesaian_identifikasi_pagu" name="penyelesaian_identifikasi_pagu" type="number" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="penyelesaian-identifikasi-pagu-messages"></span>
                                           </div>  
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>&nbsp;</td>
                                        <td>B. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha <br/> Dalam Merealisasikan Kegiatan Usahanya</td>
                                        <td>
                                           <div id="penyelesaian-realisasi-target-alert" class="margin-none form-group" >      
                                             <input id="penyelesaian_realisasi_target" name="penyelesaian_realisasi_target" type="number" class="form-control penyelesaian_nilai_target target_penyelesaian" placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="penyelesaian-realisasi-target-messages"></span>
                                           </div>  
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>
                                        </td>
                                        <td>
                                           <div id="penyelesaian-realisasi-pagu-alert" class="margin-none form-group" >     
                                             <input id="penyelesaian_realisasi_pagu" name="penyelesaian_realisasi_pagu" type="number" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="penyelesaian-realisasi-pagu-messages"></span>
                                           </div>  
                                        </td>
                                   </tr>
                                   <tr class="border-bottom">
                                        <td>&nbsp;</td>
                                        <td>C. Evaluasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi <br/> Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya Perizinan <br/> Berusaha Para Pelaku Usaha</td>
                                        <td>
                                           <div id="penyelesaian-evaluasi-target-alert" class="margin-none form-group" >     
                                             <input id="penyelesaian_evaluasi_target" name="penyelesaian_evaluasi_target" type="number" class="form-control penyelesaian_nilai_target" placeholder="Target" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="penyelesaian-evaluasi-target-messages"></span>
                                           </div>  
                                        </td>
                                        <td>
                                             <input type="text" class="form-control" placeholder="Kegiatan Usaha" value="Kegiatan Usaha" disabled>
                                        </td>
                                        <td>
                                          <div id="penyelesaian-evaluasi-pagu-alert" class="margin-none form-group" >    
                                             <input id="penyelesaian_evaluasi_pagu" name="penyelesaian_evaluasi_pagu" type="number" class="form-control nilai_inp penyelesaian_nilai_pagu text-right" placeholder="Pagu" value="0" disabled oninput="this.value = Math.abs(this.value)">
                                             <span id="penyelesaian-evaluasi-pagu-messages"></span>
                                          </div>   
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>

          <div class="box box-solid box-primary">
               <div class="box-body">
                    <div class="card-body">
                       <div  class="row pd-top-bottom-15"> 
                              <div class="col-sm-3">
                                   <div id="lokasi-alert" class="margin-none form-group">
                                        <label>Lokasi :</label>
                                        <input id="lokasi" value="" name="lokasi" type="text" class="form-control" placeholder="Lokasi">
                                        <span id="lokasi-messages"></span>
                                   </div>
                              </div>

                              <div class="col-sm-3">
                                   <div id="tgl-tandatangan-alert" class="margin-none form-group">
                                        <label>Tanggal Ditandatangani :</label>
                                        <input id="tgl_tandatangan" value="" name="tgl_tandatangan" type="date" class="form-control" placeholder="Tanggal Ditandatangani">
                                        <span id="tgl-tandatangan-messages"></span>
                                   </div>
                              </div>

                              <div class="col-sm-3">
                                   <div id="nama-pejabat-alert" class="margin-none form-group">
                                        <label>Nama Pejabat :</label>
                                        <input id="nama_pejabat" value="" name="nama_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">
                                        <span id="nama-pejabat-messages"></span>
                                   </div>
                              </div>

                              <div class="col-sm-3">
                                   <div id="nip-pejabat-alert" class="margin-none form-group">
                                        <label>NIP Pejabat :</label>
                                        <input id="nip_pejabat" value="" name="nip_pejabat" type="text" class="form-control" placeholder="NIP Pejabat">
                                        <span id="nip-pejabat-messages"></span>
                                   </div>
                              </div>   
                        </div>
                    </div>
               </div>
          </div> 

          <div class="box-footer">
               <div class="btn-group just-center">
                    <button id="simpan" type="button" class="btn btn-warning col-md-2" disabled>SIMPAN</button>
                    <button id="kirim" type="button" class="btn btn-primary col-md-2" disabled>KIRIM</button>
               </div> 
          </div> 
     </form>
</div>

<script type="text/javascript">

     $(document).ready(function() {

          var periode =[];
          var pengawasan = 0;
          var total_pengawasan_pagu = 0;
          var bimtek = 0;
          var total_bimtek_pagu = 0;
          var penyelesaian = 0;
          var total_penyelesaian_pagu = 0;

          var val_pengawasan_target = false;
          var val_bimtek_target = false;
          var val_penyelesaian_target = false;

          var val_pengawasan_pagu = false;
          var val_bimtek_pagu = false;
          var val_penyelesaian_pagu = false;

          var temp_total_pengawasan = 0;
          var temp_total_bimtek = 0;
          var temp_total_penyelesaian = 0;

          $('#selectPeriode').html('<select id="periode_id" title="Pilih Periode" class="form-control selectpicker"></select>'); 
         
          const user_sidebar  = JSON.parse(localStorage.getItem('user_sidebar'));

          $('#lokasi').val(user_sidebar.daerah_name);
          $('#total_rencana').html('<b>Rp 0</b>');
          
          getperiode();
            
          $(".pengawasan_nilai_target").on("input", function() {
               calculatePengawasanTarget();
          });  

          $(".pengawasan_nilai_pagu").on("input", function() {
               calculatePengawasanPagu();
          });

          $(".bimtek_nilai_target").on("input", function() {
               calculateBimtekTarget();
          });

          $(".bimtek_nilai_pagu").on("input", function() {
               calculateBimtekPagu();
          });

          $(".penyelesaian_nilai_target").on("input", function() {
               calculatePenyelesaianTarget();
          });

          $(".penyelesaian_nilai_pagu").on("input", function() {
               calculatePenyelesaianPagu();
          });

          $("#kirim").click( () => {

               var data = $("#FormSubmit").serializeArray();
               var periode_id = $('#periode_id').val();
               console.log(data);
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
                    "lokasi":data[16].value,
                    "tgl_tandatangan":data[17].value,
                    "nama_pejabat":data[18].value,
                    "nip_pejabat":data[19].value,
                    "periode_id":periode_id,
                    "type":"kirim",
                    "param":"insert",
               };
               
               SendingData(form);
               
          });

          $("#simpan").click( () => {

               var data = $("#FormSubmit").serializeArray();       
               var periode_id = $('#periode_id').val(); 
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
                    "lokasi":data[16].value,
                    "tgl_tandatangan":data[17].value,
                    "nama_pejabat":data[18].value,
                    "nip_pejabat":data[19].value,
                    "periode_id":periode_id,
                    "type":"draft",
                    "param":"insert",
               };

               SendingData(form);
               
          });

          function calculatePengawasanTarget() {
               var total_pengawasan_target = 0;
               
               $(".pengawasan_nilai_target").each(function() {
                    total_pengawasan_target += parseFloat($(this).val());
               });
          }

          function calculatePengawasanPagu() {
               var total_pengawasan_pagu = 0;
       
               $(".pengawasan_nilai_pagu").each(function() {
                    total_pengawasan_pagu += parseFloat($(this).val());
               });

               var number = total_pengawasan_pagu;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               if(total_pengawasan_pagu !=0)
               {
                  val_pengawasan_pagu = true;
                  ActionButtonEnable(); 
               } else {
                  val_pengawasan_pagu = false;
                  ActionButtonEnable();   
               }     

               $("#total_pengawasan_pagu").text('Rp '+ formattedNumber);
               
               temp_total_pengawasan = number;
               totalRencana();
          }

          function calculateBimtekTarget() {
               var total_bimtek_target = 0;

               $(".bimtek_nilai_target").each(function() {
                    total_bimtek_target += parseFloat($(this).val());
               });

               var periode_id = $('#periode_id').val();

               if(periode_id)
               {    
                    if(total_bimtek_target > bimtek)
                    {
                         val_bimtek_target = false;
                         ActionButtonEnable();
                              Swal.fire({
                                   icon: 'info',
                                   title: 'Peringatan',
                                   text:'Target bimtek melebihi pagu target!! maksimal total target bimtek yg di izinkan : ' + bimtek,
                                   confirmButtonColor: '#000',
                                   showConfirmButton: true,
                                   confirmButtonText: 'OK',
                              });  
                    } else {
                         val_bimtek_target = true;
                         ActionButtonEnable();
                    }
                
               }
          }

          function calculateBimtekPagu() {
               var total_bimtek_pagu = 0;
          
               $(".bimtek_nilai_pagu").each(function() {
                    total_bimtek_pagu += parseFloat($(this).val());
               });

               var number = total_bimtek_pagu;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_bimtek_pagu").text('Rp '+ formattedNumber);
               
               if(total_bimtek_pagu !=0)
               {
                  val_bimtek_pagu = true;
                  ActionButtonEnable();
               } else {
                  val_bimtek_pagu = false;
                  ActionButtonEnable(); 
               }   
              
               temp_total_bimtek = number;
               totalRencana();
          }

          function calculatePenyelesaianTarget() {
               var total_penyelesaian_target = 0;

               $(".penyelesaian_nilai_target").each(function() {
                    total_penyelesaian_target += parseFloat($(this).val());
               });
          }

          function calculatePenyelesaianPagu() {
               var total_penyelesaian_pagu = 0;

               $(".penyelesaian_nilai_pagu").each(function() {
                    total_penyelesaian_pagu += parseFloat($(this).val());
               });

               var number = total_penyelesaian_pagu;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");

               $("#total_penyelesaian_pagu").text('Rp '+ formattedNumber);

               if(total_penyelesaian_pagu !=0)
               {
                    val_penyelesaian_pagu = true; 
                    ActionButtonEnable(); 
               } else {
                    val_penyelesaian_pagu = false;
                    ActionButtonEnable();  
               }  
     
               temp_total_penyelesaian = number;
               totalRencana();
          }

          function totalRencana() {
               
               var total_rencana = temp_total_pengawasan + temp_total_bimtek + temp_total_penyelesaian;
               var number = total_rencana;
               var formattedNumber = accounting.formatNumber(number, 0, ".", ".");
               var periode_id = $('#periode_id').val();
               var pagu_apbn = $('#pagu_apbn_inp').val();

               if(periode_id)
               {    
                    if(pagu_apbn < total_rencana) {
                         Swal.fire({
                              icon: 'info',
                              title: 'Peringatan',
                              text:'Total Perencanaan Melebihi PAGU yang Diizinkan : Rp. ' + accounting.formatNumber(pagu_apbn, 0, ".", "."),
                              confirmButtonColor: '#000',
                              showConfirmButton: true,
                              confirmButtonText: 'OK',
                         });  
                         
                         $('#total_rencana').removeClass('text-black').addClass('text-red');

                    } else $('#total_rencana').removeClass('text-red').addClass('text-black');
               }
               
               $('#total_rencana').html('<b>Rp. '+formattedNumber+'</b>');
          }

          function ActionButtonEnable() {               
               var isAllValid = val_pengawasan_target && val_bimtek_target && val_penyelesaian_target && val_pengawasan_pagu && val_bimtek_pagu && val_penyelesaian_pagu;
               $('#simpan, #kirim').prop("disabled", isAllValid);
          }

          function getperiode(){
               $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: BASE_URL +'/api/select-periode?type=POST',
                    success: function(data) {
                         var select =  $('#periode_id');
                         $.each(data.result, function(index, option) {
                              select.append($('<option>', {
                                   value: option.value,
                                   text: option.text
                              }));
                         });
                         
                         $('#periode_id').prop('disabled', data.selected);
                         select.selectpicker('refresh');
                         periode = data.result; 
                    },
                    error: function( error) {}
               });

               $('#periode_id').on('change', function() {
                    var index = $(this).val();
                    let find = periode.find(o => o.value === index); 

                    //isi pagu
                    $('#pagu_apbn').html('<b>'+find.pagu_apbn+'</b>');
                    $('#pagu_apbn_inp').val(find.pagu_apbn.replace(/[^0-9]/g, ''));
                    
                    //isi target pengawasan
                    pengawasan = find.target_pengawasan;
                    $(".pengawasan_nilai_target").prop("disabled", false);
                    $(".pengawasan_nilai_pagu").prop("disabled", false);
                    $('.target_pengawasan').val(pengawasan);
                    $(".target_pengawasan").prop("disabled", true);
                    $("#total_pengawasan_target").text(pengawasan);
                    
                    //isi target bimtek
                    bimtek = find.target_bimtek;
                    $(".bimtek_nilai_target").prop("disabled", false);
                    $(".bimtek_nilai_pagu").prop("disabled", false);
                    $("#total_bimtek_target").text(bimtek);

                    if (bimtek % 2 === 0) {
                         $(".bimtek_perizinan_target").val(bimtek/2);
                         $(".bimtek_pengawasan_target").val(bimtek/2);
                    } else {
                         $(".bimtek_perizinan_target").val(Math.floor(bimtek / 2) + 1);
                         $(".bimtek_pengawasan_target").val(Math.floor(bimtek / 2));
                    }
                    
                    //isi target penyelesaian
                    penyelesaian = find.target_penyelesaian;
                    $(".penyelesaian_nilai_target").prop("disabled", false);
                    $(".penyelesaian_nilai_pagu").prop("disabled", false);
                    $('.target_penyelesaian').val(penyelesaian);
                    $(".target_penyelesaian").prop("disabled", true);
                    $("#total_penyelesaian_target").text(penyelesaian);
               });
          }

          function SendingData(form) {

               var pesan = (form.type === 'kirim') ? 'Terkirim ke Pusat.' : 'Berhasil Simpan.';

               $.ajax({
                    type:"POST",
                    url: BASE_URL+'/api/perencanaan',
                    data:form,
                    cache: false,
                    dataType: "json",
                    success: (respons) =>{
                         Swal.fire({
                              title: 'Sukses!',
                              text: pesan,
                              icon: 'success',
                              confirmButtonText: 'OK'                        
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   window.location.replace('/perencanaan');
                              }
                         });
                    },

                    error: (respons) => {

                         errors = respons.responseJSON;
                         
                         if(errors.messages.pengawas_analisa_target)
                         {
                              $('#pengawas-analisa-target-alert').addClass('has-error');
                              $('#pengawas-analisa-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_analisa_target +'</strong>');
                         } else {
                              $('#pengawas-analisa-target-alert').removeClass('has-error');
                              $('#pengawas-analisa-target-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.pengawas_analisa_pagu)
                         {
                              $('#pengawas-analisa-pagu-alert').addClass('has-error');
                              $('#pengawas-analisa-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_analisa_pagu +'</strong>');
                         } else {
                              $('#pengawas-analisa-pagu-alert').removeClass('has-error');
                              $('#pengawas-analisa-pagu-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.pengawas_inspeksi_target)
                         {
                              $('#pengawas-inspeksi-target-alert').addClass('has-error');
                              $('#pengawas-inspeksi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_inspeksi_target +'</strong>');
                         } else {
                              $('#pengawas-inspeksi-target-alert').removeClass('has-error');
                              $('#pengawas-inspeksi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.pengawas_inspeksi_pagu)
                         {
                              $('#pengawas-inspeksi-pagu-alert').addClass('has-error');
                              $('#pengawas-inspeksi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_inspeksi_pagu +'</strong>');
                         } else {
                              $('#pengawas-inspeksi-pagu-alert').removeClass('has-error');
                              $('#pengawas-inspeksi-pagu-messages').removeClass('help-block').html('');
                         }

                         if(errors.messages.pengawas_evaluasi_target)
                         {
                              $('#pengawas-evaluasi-target-alert').addClass('has-error');
                              $('#pengawas-evaluasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_evaluasi_target +'</strong>');
                         } else {
                              $('#pengawas-evaluasi-target-alert').removeClass('has-error');
                              $('#pengawas-evaluasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.pengawas_evaluasi_pagu)
                         {
                              $('#pengawas-evaluasi-pagu-alert').addClass('has-error');
                              $('#pengawas-evaluasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.pengawas_evaluasi_pagu +'</strong>');
                         } else {
                              $('#pengawas-evaluasi-pagu-alert').removeClass('has-error');
                              $('#pengawas-evaluasi-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.bimtek_perizinan_target)
                         {
                              $('#bimtek-perizinan-target-alert').addClass('has-error');
                              $('#bimtek-perizinan-target-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_perizinan_target +'</strong>');
                         } else {
                              $('#bimtek-perizinan-target-alert').removeClass('has-error');
                              $('#bimtek-perizinan-target-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.bimtek_perizinan_pagu)
                         {
                              $('#bimtek-perizinan-pagu-alert').addClass('has-error');
                              $('#bimtek-perizinan-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_perizinan_pagu +'</strong>');
                         } else {
                              $('#bimtek-perizinan-pagu-alert').removeClass('has-error');
                              $('#bimtek-perizinan-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.bimtek_pengawasan_target)
                         {
                              $('#bimtek-pengawasan-target-alert').addClass('has-error');
                              $('#bimtek-pengawasan-target-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_pengawasan_target +'</strong>');
                         } else {
                              $('#bimtek-pengawasan-target-alert').removeClass('has-error');
                              $('#bimtek-pengawasan-target-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.bimtek_pengawasan_pagu)
                         {
                              $('#bimtek-pengawasan-pagu-alert').addClass('has-error');
                              $('#bimtek-pengawasan-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.bimtek_pengawasan_pagu +'</strong>');
                         } else {
                              $('#bimtek-pengawasan-pagu-alert').removeClass('has-error');
                              $('#bimtek-pengawasan-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_identifikasi_target)
                         {
                              $('#penyelesaian-identifikasi-target-alert').addClass('has-error');
                              $('#penyelesaian-identifikasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_identifikasi_target +'</strong>');
                         } else {
                              $('#penyelesaian-identifikasi-target-alert').removeClass('has-error');
                              $('#penyelesaian-identifikasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_identifikasi_pagu)
                         {
                              $('#penyelesaian-identifikasi-pagu-alert').addClass('has-error');
                              $('#penyelesaian-identifikasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_identifikasi_pagu +'</strong>');
                         } else {
                              $('#penyelesaian-identifikasi-pagu-alert').removeClass('has-error');
                              $('#penyelesaian-identifikasi-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_realisasi_target)
                         {
                              $('#penyelesaian-realisasi-target-alert').addClass('has-error');
                              $('#penyelesaian-realisasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_realisasi_target +'</strong>');
                         } else {
                              $('#penyelesaian-realisasi-target-alert').removeClass('has-error');
                              $('#penyelesaian-realisasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_realisasi_pagu)
                         {
                              $('#penyelesaian-realisasi-pagu-alert').addClass('has-error');
                              $('#penyelesaian-realisasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_realisasi_pagu +'</strong>');
                         } else {
                              $('#penyelesaian-realisasi-pagu-alert').removeClass('has-error');
                              $('#penyelesaian-realisasi-pagu-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.penyelesaian_evaluasi_target)
                         {
                              $('#penyelesaian-evaluasi-target-alert').addClass('has-error');
                              $('#penyelesaian-evaluasi-target-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_evaluasi_target +'</strong>');
                         } else {
                              $('#penyelesaian-evaluasi-target-alert').removeClass('has-error');
                              $('#penyelesaian-evaluasi-target-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.penyelesaian_evaluasi_pagu)
                         {
                              $('#penyelesaian-evaluasi-pagu-alert').addClass('has-error');
                              $('#penyelesaian-evaluasi-pagu-messages').addClass('help-block').html('<strong>'+ errors.messages.penyelesaian_evaluasi_pagu +'</strong>');
                         } else {
                              $('#penyelesaian-evaluasi-pagu-alert').removeClass('has-error');
                              $('#penyelesaian-evaluasi-pagu-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.periode_id)
                         {
                              $('#periode-alert').addClass('has-error');
                              $('#selectPeriode').addClass('has-error');
                              $('#periode-id-messages').addClass('help-block').html('<strong>'+ errors.messages.periode_id +'</strong>');
                         } else {
                              $('#periode-id-alert').removeClass('has-error');
                              $('#periode-id-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.nama_pejabat)
                         {
                              $('#nama-pejabat-alert').addClass('has-error');
                              $('#nama-pejabat-messages').addClass('help-block').html('<strong>'+ errors.messages.nama_pejabat +'</strong>');
                         } else {
                              $('#nama-pejabat-alert').removeClass('has-error');
                              $('#nama-pejabat-messages').removeClass('help-block').html('');
                         } 

                         if(errors.messages.nip_pejabat)
                         {
                              $('#nip-pejabat-alert').addClass('has-error');
                              $('#nip-pejabat-messages').addClass('help-block').html('<strong>'+ errors.messages.nip_pejabat +'</strong>');
                         } else {
                              $('#nip-pejabat-alert').removeClass('has-error');
                              $('#nip-pejabat-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.tgl_tandatangan)
                         {
                              $('#tgl-tandatangan-alert').addClass('has-error');
                              $('#tgl-tandatangan-messages').addClass('help-block').html('<strong>'+ errors.messages.tgl_tandatangan +'</strong>');
                         } else {
                              $('#tgl-tandatangan-alert').removeClass('has-error');
                              $('#tgl-tandatangan-messages').removeClass('help-block').html('');
                         }  

                         if(errors.messages.lokasi)
                         {
                              $('#lokasi-alert').addClass('has-error');
                              $('#lokasi-messages').addClass('help-block').html('<strong>'+ errors.messages.lokasi +'</strong>');
                         } else {
                              $('#lokasi-alert').removeClass('has-error');
                              $('#lokasi-messages').removeClass('help-block').html('');
                         }  
                    }
               });
          }
     });    

</script>
@stop