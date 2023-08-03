<template>
<div>
    <section class="content-header pd-left-right-15">
    <div class="col-sm-4 pull-left padding-default full">
            <div class="width-50 pull-left">
             <div class="btn-group pull-left padding-9-0" v-if="ShowSearch ==true">
                   
                    <button type="button"  @click="DelSelected()" class="btn btn-primary" :disabled="btn_delete"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button"  @click="Add()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                    <button type="button" @click="GetShowSearch(ShowSearch)"  class="btn btn-primary" ><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                   
              </div>
                <div class="input-group input-group-sm bg-search-table"  v-if="ShowSearch ==false">
                    <span class="input-group-btn">
                    <button type="button" @click="GetShowSearch(ShowSearch)" class="btn btn-default btn-flat"><i class="fa fa-times"></i></button>
                    </span>    
                    <input type="text" class="form-control" v-model="inputsearch" :placeholder="placeholder" @input="Search(inputsearch)">
                
                </div>

            </div> 

            <div class="pull-right width-50">
                  <Pagination v-if="viewsPage" @change="getData" v-model="halaman" :page-count="total" class="pagination-table"></Pagination>
            </div>   
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
        <div class="box box-solid box-primary">
           
           
            <div class="box-body" >
                <div class="card-body table-responsive p-0" >
                            <table class="table table-hover text-nowrap" id="datatable">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" @click="selectAll(allSelected)" v-model="allSelected" ></th>
                                    <th class="border-right-table"> No </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
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
                                        <td><input type="checkbox" v-model="dataIds" :value="list.id" number  @change="updateCheckall()"></td>
                                        <td> {{ list.number }}</td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td>
                                            <div class="btn-group">
                                           
                                             
                                              <button type="button" @click="Edit(list.id)" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                              <button type="button" @click="Delete(list.id)" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </td>

                                       
                                    </tr>  
                                     
                                </tbody>
                            </table>



                           

                </div>
            </div>
        </div>
    </div>

   
<InsertForm v-if="v_add"  :Apps="Apps" :Title="Title" @close="closeModal"></InsertForm>

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
               inputsearch:"",
               lists:[],
               total: 10,
               halaman: 1,
               showModalSearch: false,
               isSearch: false,
               searchMessage: "",
               search_text:"",
               allSelected: false,
               dataIds:[],
               btn_delete:true,
               ShowSearch:true,
               placeholder:"",
               v_add:false,
            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
           this.placeholder = "Search Data "+ this.Title;
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
           "Pagination": require("vue-plain-pagination"),
           "InsertForm": require("./add.vue").default,
        },
        methods: {
          GetShowSearch(status){
            if(status ==true)
            {
              this.ShowSearch = false;   
            }else{
               this.ShowSearch = true;     
            }    
             
          },
            
          selectAll: function(event) {
               this.dataIds = [];
                if(event ==true)
                {
                  this.allSelected = false;
                  this.btn_delete = true;
                }else{
                  this.allSelected = true;
                  this.btn_delete = false;   
                }    
             
                if (this.allSelected) {
                    for(var i=0; i<this.lists.result.length; i++)
                    {
                            
                        this.dataIds.push(this.lists.result[i].id);
                    }
                }

         }, 

         updateCheckall(){
               
                if(this.dataIds.length !=0)
                {
                   this.btn_delete = false;   
                }else{
                   this.btn_delete = true; 
                }    
                if(this.dataIds.length == this.lists.result.length){
                    this.allSelected = true;
                }else{
                    this.allSelected = false;
                }
            }, 

          DelSelected(){
            this.$swal({
                    buttons:true,
                    dangerMode:true,
                    title: "Apakah Anda Yakin Hapus ?",
                    icon: "warning",
                }).then((result) => {
                    if (result) {

                        var formData = {
                             data: this.dataIds
                        };

                        
                        axios.post(BASE_URL + "/api/"+ this.URL_Segment +"/selected",formData)
                        .then((response) => {
                            
                            if(response.data.messages == true){
                               
                                this.$swal({
                                    title: "Berhasil Di Hapus",
                                    icon: "success"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.dataIds = [];
                                        this.updateCheckall();
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
          Refresh(){
             this.loading = true;
             this.views = false;
             this.inputsearch = "";
             this.searchViews = false;
             this.resultNull = false;
             this.dataIds = [];
             this.getData();
          },
          getData(){

            const self = this;
            let listUrl = "";

            listUrl = BASE_URL + "/api/"+ this.URL_Segment +"?page="+ self.halaman;    
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
             this.v_add = true;
            //this.$router.push({path:"/"+ this.URL_Segment +"/add"})

          },
          closeModal(){
            this.v_add = false;
          },
          Edit(id){

            this.$router.push({path:"/"+ this.URL_Segment +"/edit/"+ id})

          },
          Search(input){
               const self = this;   
               
           
               if(self.inputsearch !="")
               {
                    self.loading = true;
                    self.views = false;
                    let urlBase="";
                    let formData = new FormData();
                    formData.append("search", input);
                    urlBase = axios.post(BASE_URL+"/api/"+ this.URL_Segment +"/search", formData);
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
                           self.search_text = "Pencarian "+ self.inputsearch +" tidak ditemukan ";
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
                        
                        axios.delete(BASE_URL + "/api/"+ this.URL_Segment +"/"+ id)
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