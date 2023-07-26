<template>
<div>




<section class="content-header">
<div class="col-sm-4 pull-left padding-default full">

        <div class="width-50 pull-left">
         <div class="btn-group pull-left padding-9-0">
           
                <button type="button" @click="Refresh()" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</button>
                <button type="button"  @click="Add()" class="btn btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                <button type="button" class="btn btn-warning"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
       
         
          </div>
        </div>    

        <!-- <div class="width-50 pull-left">
            <div class="btn-group pull-right ">
             
                <form  enctype="multipart/form-data" method="post"  @submit.prevent="Search">
                <div class="input-group margin">
                    <input v-model="inputsearch" type="text" class="form-control">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search" aria-hidden="true" ></i> Search</button>
                        </span>
                  </div>   
                </form>
              
             </div>    
        </div> -->



</div>   

<div class="col-sm-4 pull-right padding-default" >

  
</div>



</section>

<div class="col-sm-12 pull-left" v-if="searchViews">

    <div class="alert alert-danger alert-dismissible"  >
     <i class="fa fa-search" aria-hidden="true"></i>    {{ search_text  }}
    </div>

</div>
    <div class="content">
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="box box-solid box-warning">
           
           
            <div class="box-body" >
                <div class="card-body table-responsive p-0" >
                            <table class="table table-hover text-nowrap" id="datatable">
                                <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Periode Text </th>
                                    <th> Slug </th>
                                    <th> Status  </th>                                  
                                    <th> Options </th> 
                                </tr>
                                </thead>
                                <tbody >
                                    <tr v-if="loading">
                                         <td colspan="10"> <loading-block class="loading-table"  /></td>
                                    </tr>
                                    <tr v-if="resultNull">
                                        <td colspan="10"> Data Kosong</td>
                                    </tr>
                                    <tr v-for="(list,index) in lists.result" v-bind:key="list.id"  v-if="views">
                                        
                                        <td> {{ list.number }}</td>
                                        <td> {{ list.name }}</td>
                                        <td> {{ list.slug }}</td>
                        
                                        <td> {{ list.status.status_convert }}</td>
                                       
                                      
                                        <td>
                                            <div class="btn-group">
                                           
                                              <router-link :to="{path: '/'+ URL_Segment +'/edit/'+list.id}" class="btn btn-warning">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                              </router-link>
                                              <button type="button" @click="Delete(list.id)" class="btn btn-warning"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </td>

                                       
                                    </tr>  
                                     
                                </tbody>
                            </table>

                            <Pagination v-if="viewsPage" @change="getData" v-model="halaman" :page-count="total" class="pagination-table"></Pagination>

                </div>
            </div>
        </div>

      
        
    </div>


</div>
</template>
<script>
   export default {
        props:["Apps","Title","URL_Segment"],
        data() {
            return {
               loading:true,
               views:false,
               viewsPage:false,
               searchViews:false,
               resultNull:false,
               inputsearch:'',
               lists:{},
               total: 10,
               halaman: 1,
               showModalSearch: false,
               isSearch: false,
               searchMessage: '',
               search_text:'',
            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
        },
        mounted() {
           this.getData();
        },
        computed: {
            base_url() {
                return BASE_URL;
            },  
        },
        components: {
           'Pagination': require('vue-plain-pagination'),
        },
        methods: {
          Refresh(){
             this.loading = true;
             this.views = false;
             this.inputsearch = '';
             this.searchViews = false;
             this.resultNull = false;
             this.getData();
          },
          getData(){

            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/'+ this.URL_Segment +'?page='+ self.halaman;    
            axios.get(listUrl).then((response) => {
                self.lists = response.data;
                self.loading = false;
                
                if(self.lists.total >0)
                {
                   
                    self.halaman = response.data.currentPage;
                    self.total = response.data.lastPage;  
                    self.views = true;
                    self.viewsPage = true;

                }else{
                    self.resultNull = true;
                    self.views = false;
                    self.viewsPage = false;

                }
            }).catch((error) => {
                console.log(error);
                self.loading = false;
                self.views = true;
                self.viewsPage = false;
            });
             
          },
          Add(){

            this.$router.push({path:'/'+ this.URL_Segment +'/add'})

          },
          Search(){
               const self = this;   
               
           
               if(self.inputsearch !="")
               {
                    self.loading = true;
                    self.views = false;
                    let urlBase="";
                    let formData = new FormData();
                    formData.append('search', self.inputsearch);
                    urlBase = axios.post(BASE_URL+'/api/'+ this.URL_Segment +'/search', formData);
                    urlBase
                    .then((response) => {
                       
                        self.lists = response.data;
                        self.loading = false;
                        self.searchViews = true;
                 
                        if(self.lists.total >0)
                        {
                           self.views = true;
                           self.search_text = self.lists.cari;
                           self.halaman = response.data.currentPage;
                           self.total = response.data.lastPage;
                           self.viewsPage = true;
                           self.resultNull = false;
                        }else{
                           self.search_text = 'Pencarian "'+ self.inputsearch +'" tidak ditemukan ';
                           self.halaman = 1;
                           self.total = 10;
                           self.viewsPage = false;
                           self.resultNull = true;
                           self.views = false;
                        }
                        
                    
                    }).catch((error) => {
                     
                        console.log(error);
                            
                    });
                }    
          },
          Delete(id){
             
                this.$swal({
                    buttons:true,
                    dangerMode:true,
                    title: "Apakah Anda Yakin Hapus ?",
                    icon: "warning",
                }).then((result) => {
                    if (result) {
                        
                        axios.delete(BASE_URL + '/api/'+ this.URL_Segment +'/'+id)
                        .then((response) => {
                            
                            if(response.data.messages == true){
                               
                                this.$swal({
                                    title: "Berhasil Di Hapus",
                                    icon: "success"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.getData();
                                    }
                                });
                            }else{
                               
                                this.$swal({
                                    title: "Gagal Di Hapus",
                                    icon: "error"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.getData();
                                    }
                                });
                            }
                        }).catch((error) => {
                            console.log(error);
                        });

                    }
                });
          },

        }
    }
   
</script>
