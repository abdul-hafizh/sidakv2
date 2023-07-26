<template>
<div>
<section class="content-header">
        <h1>{{ Title }}</h1>
</section>
   
    <div class="content">
        <div class="row in-content">

            <section class="col-lg-7  connectedSortable ui-sortable ">
                
                <div class="box box-solid box-warning">
                      <div class="box-header with-border">
                        <h3 class="box-title">Pengawasan</h3>
                      </div>
                    <div class="box-body" >
                        <div class="row" v-if="loading">  
                            <div class="form-group col-sm-12">
                             <loading-block class="loading-table"  />
                            </div>
                          </div> 
                        <div class="row" v-if="views">
                            <div class="form-group col-sm-12">
                                <label>1. Pengawasan Penanaman Modal :</label>     
                            </div> 

                            <div class="form-group col-sm-12" >
                                <label>A. Analisa Dan Verifikasi Data, Profil Dan Informasi Kegiatan Usaha Dari Pelaku Usaha :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_analisa_target ? 'has-error' : ''">
                                 <label>Target :</label>
                                 <input v-model="pengawas_analisa_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_analisa_target')">
                                    <strong>{{ errors.messages.pengawas_analisa_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_analisa_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="pengawas_analisa_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_analisa_satuan')">
                                    <strong>{{ errors.messages.pengawas_analisa_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_analisa_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="pengawas_analisa_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_analisa_pagu')">
                                    <strong>{{ errors.messages.pengawas_analisa_pagu }}</strong>
                                 </span>
                            </div>



                            <div class="form-group col-sm-12" >
                                <label>B. Inspeksi Lapangan :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_inspeksi_target ? 'has-error' : ''">
                                 <label> Target :</label>
                                 <input v-model="pengawas_inspeksi_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_inspeksi_target')">
                                    <strong>{{ errors.messages.pengawas_inspeksi_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_inspeksi_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="pengawas_inspeksi_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_inspeksi_satuan')">
                                    <strong>{{ errors.messages.pengawas_analisa_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_inspeksi_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="pengawas_inspeksi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_inspeksi_pagu')">
                                    <strong>{{ errors.messages.pengawas_inspeksi_pagu }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-12" >
                                <label>C. Evaluasi penilaian kepatuhan pelaksanaan Perizinan Berusaha Para Pelaku Usaha :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_evaluasi_target ? 'has-error' : ''">
                                 <label>Target :</label>
                                 <input v-model="pengawas_evaluasi_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_evaluasi_target')">
                                    <strong>{{ errors.messages.pengawas_evaluasi_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_evaluasi_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="pengawas_evaluasi_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_evaluasi_satuan')">
                                    <strong>{{ errors.messages.pengawas_evaluasi_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_evaluasi_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="pengawas_evaluasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_evaluasi_pagu')">
                                    <strong>{{ errors.messages.pengawas_evaluasi_pagu }}</strong>
                                 </span>
                            </div>





                        </div>    
                    </div>   
                </div>

                <div class="box box-solid box-warning">
                      <div class="box-header with-border">
                        <h3 class="box-title">Bimbingan/Sosialisasi</h3>
                      </div>
                    <div class="box-body" >
                        <div class="row" v-if="loading">  
                            <div class="form-group col-sm-12">
                             <loading-block class="loading-table"  />
                            </div>
                          </div> 
                        <div class="row" v-if="views">
                            <div class="form-group col-sm-12">
                                <label>2. Bimbingan Teknis Kepada Pelaku Usaha :</label>     
                            </div> 

                            <div class="form-group col-sm-12" >
                                <label>A. Bimbingan Teknis/Sosialisasi Implementasi Perizinan Berusaha Berbasis Risiko :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.bimtek_perizinan_target ? 'has-error' : ''">
                                 <label>Target :</label>
                                 <input v-model="bimtek_perizinan_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('bimtek_perizinan_target')">
                                    <strong>{{ errors.messages.bimtek_perizinan_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_analisa_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="pengawas_analisa_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_analisa_satuan')">
                                    <strong>{{ errors.messages.pengawas_analisa_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_analisa_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="pengawas_analisa_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_analisa_pagu')">
                                    <strong>{{ errors.messages.pengawas_analisa_pagu }}</strong>
                                 </span>
                            </div>



                            <div class="form-group col-sm-12" >
                                <label>B. Bimbingan Teknis/Sosialisasi Implementasi Pengawasan Perizinan Berusaha Berbasis Risiko :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.bimtek_pengawasan_target ? 'has-error' : ''">
                                 <label> Target :</label>
                                 <input v-model="bimtek_pengawasan_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('bimtek_pengawasan_target')">
                                    <strong>{{ errors.messages.bimtek_pengawasan_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.bimtek_pengawasan_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="bimtek_pengawasan_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('bimtek_pengawasan_satuan')">
                                    <strong>{{ errors.messages.bimtek_pengawasan_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.bimtek_pengawasan_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="bimtek_pengawasan_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('bimtek_pengawasan_pagu')">
                                    <strong>{{ errors.messages.bimtek_pengawasan_pagu }}</strong>
                                 </span>
                            </div>


                            





                        </div>    
                    </div>   
                </div>


                <div class="box box-solid box-warning">
                      <div class="box-header with-border">
                        <h3 class="box-title">Penyelesaian</h3>
                      </div>
                    <div class="box-body" >
                        <div class="row" v-if="loading">  
                            <div class="form-group col-sm-12">
                             <loading-block class="loading-table"  />
                            </div>
                          </div> 
                        <div class="row" v-if="views">
                            <div class="form-group col-sm-12">
                                <label>3. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya :</label>     
                            </div> 

                            <div class="form-group col-sm-12" >
                                <label>A. Identifikasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_identifikasi_target ? 'has-error' : ''">
                                 <label>Target :</label>
                                 <input v-model="penyelesaian_identifikasi_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_identifikasi_target')">
                                    <strong>{{ errors.messages.penyelesaian_identifikasi_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_identifikasi_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="penyelesaian_identifikasi_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_identifikasi_satuan')">
                                    <strong>{{ errors.messages.penyelesaian_identifikasi_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_identifikasi_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="penyelesaian_identifikasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_identifikasi_pagu')">
                                    <strong>{{ errors.messages.penyelesaian_identifikasi_pagu }}</strong>
                                 </span>
                            </div>



                            <div class="form-group col-sm-12" >
                                <label>B. Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_realisasi_target ? 'has-error' : ''">
                                 <label> Target :</label>
                                 <input v-model="penyelesaian_realisasi_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_realisasi_target')">
                                    <strong>{{ errors.messages.penyelesaian_realisasi_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_realisasi_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="penyelesaian_realisasi_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_realisasi_satuan')">
                                    <strong>{{ errors.messages.penyelesaian_realisasi_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.pengawas_inspeksi_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="pengawas_inspeksi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('pengawas_inspeksi_pagu')">
                                    <strong>{{ errors.messages.pengawas_inspeksi_pagu }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-12" >
                                <label>C. Evaluasi Penyelesaian Permasalahan Dan Hambatan Yang Dihadapi Pelaku Usaha Dalam Merealisasikan Kegiatan Usahanya Perizinan Berusaha Para Pelaku Usaha :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_evaluasi_target ? 'has-error' : ''">
                                 <label>Target :</label>
                                 <input v-model="penyelesaian_evaluasi_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_evaluasi_target')">
                                    <strong>{{ errors.messages.penyelesaian_evaluasi_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_evaluasi_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="penyelesaian_evaluasi_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_evaluasi_satuan')">
                                    <strong>{{ errors.messages.penyelesaian_evaluasi_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.penyelesaian_evaluasi_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="penyelesaian_evaluasi_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('penyelesaian_evaluasi_pagu')">
                                    <strong>{{ errors.messages.penyelesaian_evaluasi_pagu }}</strong>
                                 </span>
                            </div>





                        </div>    
                    </div>   
                </div>


                <div class="box box-solid box-warning" v-if="access =='provinsi'">
                      <div class="box-header with-border">
                        <h3 class="box-title">Promosi</h3>
                      </div>
                    <div class="box-body" >
                        <div class="row" v-if="loading">  
                            <div class="form-group col-sm-12">
                             <loading-block class="loading-table"  />
                            </div>
                          </div> 
                        <div class="row" v-if="views">
                            <div class="form-group col-sm-12">
                                <label>4. Penyusunan Bahan Promosi Penanaman Modal :</label>     
                            </div> 

                            <div class="form-group col-sm-12" >
                                <label>A. Penyediaan Video Promosi Digital Sebagai Bahan Promosi Penanaman Modal :</label>
                            </div>

                            <div class="form-group col-sm-3" :class="errors.messages.promosi_pengadaan_target ? 'has-error' : ''">
                                 <label>Target :</label>
                                 <input v-model="promosi_pengadaan_target" type="number" class="form-control" placeholder="Target">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('promosi_pengadaan_target')">
                                    <strong>{{ errors.messages.promosi_pengadaan_target }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.promosi_pengadaan_satuan ? 'has-error' : ''">
                                 <label>Satuan :</label>
                                 <input v-model="promosi_pengadaan_satuan" type="text" class="form-control" placeholder="Satuan" disabled>
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('promosi_pengadaan_satuan')">
                                    <strong>{{ errors.messages.promosi_pengadaan_satuan }}</strong>
                                 </span>
                            </div>


                            <div class="form-group col-sm-3" :class="errors.messages.promosi_pengadaan_pagu ? 'has-error' : ''">
                                 <label>Pagu :</label>
                                 <input v-model="promosi_pengadaan_pagu" type="number" class="form-control" placeholder="Pagu">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('promosi_pengadaan_pagu')">
                                    <strong>{{ errors.messages.promosi_pengadaan_pagu }}</strong>
                                 </span>
                            </div>




                        </div>    
                    </div>   
                </div>

            </section> 

            <section  class="col-lg-5 connectedSortable ui-sortable">
             <vue-sticky-sidebar class="sidebar-inner z-index" v-bind="OptionsPagu" >
                <div class="box box-solid box-warning ">
                      <div class="box-header with-border">
                        <h3 class="box-title">Pagu & Total</h3>
                      </div>
               

                    <div class="box-body ">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>Pilih Periode :</label>
                                    <model-select class="pull-left full" v-model="periode_id" :options="lists" 
                                            @input="onChangeMenu($event)" 
                                             placeholder="Pilih SubMenu">
                                    </model-select>    
                            </div> 

                            <div class="form-group col-sm-12">
                                 <label>Pagu APBN :</label>
                                 {{ pagu_apbn }}
                            </div> 

                            <div class="form-group col-sm-12" v-if="access =='provinsi'">
                                <label>Pagu Promosi :</label>
                                    {{ pagu_promosi }}
                            </div>


                            <div class="form-group col-sm-12">
                                <label>Total Pagu :</label>
                                   {{ TotalPagu }}
                            </div> 

                           
                             <div class="form-group col-sm-12" >
                               <div class="col-sm-6"></div> 
                               <div class="col-sm-6">

                                   
                                  

                                   <button type="button" class="btn btn-warning pull-right"><i class="fa fa-cloud-upload"></i> Kirim</button>

                                    <button type="button" class="btn btn-default pull-right"><i class="fa fa-cloud-upload"></i> Draft</button>


                               </div>

                                    
                                   
                               
                            </div>  

                            
                        </div>
                    </div> 

                </div>
                </vue-sticky-sidebar>    

                <div class="box box-solid box-warning">
                      <div class="box-header with-border">
                        <h3 class="box-title">Pertanggung Jawaban</h3>
                      </div>
               

                    <div class="box-body" >
                        <div class="row">
                            <div class="form-group col-sm-12" :class="errors.messages.nama_pejabat ? 'has-error' : ''">
                                 <label>Nama Pejabat :</label>
                                 <input v-model="nama_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('nama_pejabat')">
                                    <strong>{{ errors.messages.nama_pejabat }}</strong>
                                 </span>
                            </div> 

                             <div class="form-group col-sm-12" :class="errors.messages.nip_pejabat ? 'has-error' : ''">
                                 <label>NIP Pejabat :</label>
                                 <input v-model="nip_pejabat" type="text" class="form-control" placeholder="Nama Pejabat">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('nip_pejabat')">
                                    <strong>{{ errors.messages.nip_pejabat }}</strong>
                                 </span>
                            </div> 

                            <div class="form-group col-sm-12" :class="errors.messages.tgl_tandatangan ? 'has-error' : ''">
                                 <label>Tanggal Ditandatangani :</label>
                                 <input v-model="tgl_tandatangan" type="date" class="form-control" placeholder="Tanggal Ditandatangani">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('tgl_tandatangan')">
                                    <strong>{{ errors.messages.tgl_tandatangan }}</strong>
                                 </span>
                            </div> 

                            <div class="form-group col-sm-12" :class="errors.messages.lokasi ? 'has-error' : ''">
                                 <label>Lokasi :</label>
                                 <input v-model="lokasi" type="text" class="form-control" placeholder="Lokasi">
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('lokasi')">
                                    <strong>{{ errors.messages.lokasi }}</strong>
                                 </span>
                            </div> 
                        </div>
                    </div> 

                </div> 

                <div class="box box-solid box-warning">
                      <div class="box-header with-border">
                        <h3 class="box-title">Upload File Pengesahan</h3>
                      </div>
               

                    <div class="box-body" >
                        <div class="row">
                            <div class=" col-sm-12" :class="errors.messages.nama_pejabat ? 'has-error' : ''">
                                <div class="dotted-upload">
                                 <div class="text-center margin-30-0">
                                     <button class="btn btn-default "  @click="choosePdf()">
                                        <i class="fa fa-file-pdf-o"></i> 
                                       Upload File</button>
                                        <input type="file" style="display: none" ref="filePdf" @change="onFilePdf"/>   
                                 </div> 
                                
                                 <span class="help-block" v-if="errors.messages.hasOwnProperty('nama_pejabat')">
                                    <strong>{{ errors.messages.nama_pejabat }}</strong>
                                 </span>
                                </div> 
                            </div> 

                          <!--   <div class="form-group col-sm-12">
                              
                                 <img src="/img/pdf-icon.png">
                           
                            </div>  -->

                            
                        </div>
                    </div> 

                </div>
                   
              
            </section>       
        </div>
    </div>
</div>
</template>
<script>
   import vueStickySidebar from "vue-sticky-sidebar"; 
   import { ModelSelect } from 'vue-search-select';
   import 'vue-search-select/dist/VueSearchSelect.css'; 
   export default {
        props:["Apps","Title","URL_Segment"],
        data() {
            return {
               errors: {
                    messages: {
                        name:'', 
                        status:'', 
                       
                            
                    },
               }, 
               loading:true,
               views:false,
               lists:[],
               daerah_id:'',
               periode_id:'',
               
               pengawas_analisa_target:0,
               pengawas_analisa_satuan:'Kegiatan Usaha',
               pengawas_analisa_pagu:0,

               pengawas_inspeksi_target:0,
               pengawas_inspeksi_satuan:'Kegiatan Usaha',
               pengawas_inspeksi_pagu:0,

               pengawas_evaluasi_target:0,
               pengawas_evaluasi_satuan:'Pelaku Usaha',
               pengawas_evaluasi_pagu:0,

               bimtek_perizinan_target:0,
               bimtek_perizinan_satuan:'Pelaku Usaha',
               bimtek_perizinan_pagu:0,

               bimtek_pengawasan_target:0,
               bimtek_pengawasan_satuan:'Pelaku Usaha',
               bimtek_pengawasan_pagu:0,

            
               penyelesaian_identifikasi_target:0,
               penyelesaian_identifikasi_satuan:'Kegiatan Usaha',
               penyelesaian_identifikasi_pagu:0,

               penyelesaian_realisasi_target:0,
               penyelesaian_realisasi_satuan:'Kegiatan Usaha',
               penyelesaian_realisasi_pagu:0,

               penyelesaian_evaluasi_target:0,
               penyelesaian_evaluasi_satuan:'Kegiatan Usaha',
               penyelesaian_evaluasi_pagu:0,

               promosi_pengadaan_target:1,
               promosi_pengadaan_satuan:'Video',
               promosi_pengadaan_pagu:0,
     
               target_bimtek_max:0,
               pagu_apbn_real:0,
               tgl_tandatangan:'',
               lokasi:'',
              
               lap_rencana:'',
               nama_pejabat:'',
               nip_pejabat:'',
               pagu_apbn:0,
            
               status_laporan_id:13,
               request_edit:'false',
               access : '',
               pagu_promosi:0,
               
               
            }
        },
        created() {  
           document.title = this.Apps;
           this.getCheckInsert();
           this.access = this.readCookie('access');
          
        },
        mounted() {
             this.loading = false;
             this.views = true; 

          

        },
        computed: {
             base_url() {
                return BASE_URL;
            }, 
            OptionsPagu() {
              return {
                topSpacing:20,
                containerSelector : '.in-content',
                innerWrapperSelector : '.sidebar-inner',
              };
                 
            },
            TotalPagu(){

                let count = 
                parseInt(this.pengawas_analisa_pagu) + 
                parseInt(this.pengawas_inspeksi_pagu) + 
                parseInt(this.pengawas_evaluasi_pagu) +
                parseInt(this.bimtek_perizinan_pagu) +
                parseInt(this.bimtek_pengawasan_pagu) +
                parseInt(this.penyelesaian_identifikasi_pagu) +
                parseInt(this.penyelesaian_realisasi_pagu);
                return count ;
            }
           
             
        },
        components: {
              ModelSelect,
              vueStickySidebar ,
              'TitleContent': require('../layout/Header-content.vue').default, 
        },
        methods: {

          onChangeMenu(index){
              let find = this.lists.find(o => o.value === index); 
              this.pagu_apbn =  find.pagu_apbn;
              this.pagu_promosi = find.pagu_promosi;
          },
          getCheckInsert(){
            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/periode/check';
            let formData = new FormData();
            formData.append('type', 'perencanaan');    
            axios.post(listUrl,formData).then((response) => {
                 self.lists = response.data.periode;
                
            }).catch((error) => {
                console.log(error)
            });

          },
          choosePdf(){
             this.$refs.filePdf.click()
          },
          onFilePdf(event){

              const files = event.target.files;
              let type = files[0].type;
               if(type !="application/pdf")
               {
                  this.$swal({
                    title: 'File harus format type PDF!!',
                    icon: "error"
                  }).then((result) => {
                    
                  }); 
               } 
             
              const fileReader = new FileReader()
              fileReader.addEventListener('load', () => {




                this.lap_rencana = fileReader.result;
                   
              })
              fileReader.readAsDataURL(files[0])


             
              
          },
          RequestPost(){
             
              const self = this; 
                let urlBase="";
                let formData = new FormData();
                formData.append('name', self.name);
                formData.append('status', self.status);
               
                
                
                urlBase = axios.post(BASE_URL+'/api/'+  this.URL_Segment +'', formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Simpan",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
                                   this.$router.push({path:'/'+ this.URL_Segment})
                            }
                        });
                    }
                
                }).catch((error) => {
                 
                    self.errors = error.response.data;
                                 
               
                });


          }, 
          readCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
           }

        }
    }
   
</script>