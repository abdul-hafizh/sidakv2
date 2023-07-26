<template>
<div>
<section class="content-header">
        <h1>
            Edit Roles
        </h1>
    </section>
    <div class="content">
       
        <div class="box box-primary">

            <div class="box-body">
                 <div class="row" v-if="loading">  
                    <div class="form-group col-sm-12">
                     <loading-block class="loading-table"  />
                    </div>
                  </div> 
                <div class="row" v-if="views">
                <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestUpdate">
                       
                        <div class="form-group col-sm-6" :class="errors.messages.name ? 'has-error' : ''">
                             <label>Name :</label>
                             <input v-model="name" type="text" class="form-control" placeholder="Role Name">
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('name')">
                                <strong>{{ errors.messages.name }}</strong>
                             </span>
                        </div>

                         <div  class="form-group col-sm-6" :class="errors.messages.status ? 'has-error' : ''">
                           <label>Status  :</label>
                              <div class="radio">
                                <label>
                                  <input  v-model="status" type="radio" name="status" id="" value="Y">
                                  Aktif
                                </label>
                              </div>
                          <div class="radio">
                            <label>
                              <input v-model="status"  type="radio" name="status" id="" value="N">
                             Non Aktif
                            </label>
                            
                          </div>
                          <span class="help-block" v-if="errors.messages.hasOwnProperty('status')">
                                <strong>{{ errors.messages.status }}</strong>
                             </span>
                        
                        </div>

                      

                        
   

                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-warning">Update</button>
                             <router-link :to="{path: '/'+ URL_Segment }" class="btn btn-default">Cancel</router-link>
                          
                        </div>

                </form>
                    

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
                errors: {
                    messages: {
                        name:'', 
                        status:'',
                        
                    },
               }, 
               loading:true,
               views:false,

               id:'',
               name:'',
               status:'', 
               
            }
        },
        created() {  
           document.title = this.Apps;
        },
        mounted() {
             this.id = this.$route.params.id;
             this.edit(this.id);
        },
        computed: {
             base_url() {
                return BASE_URL;
            }, 
             
        },
        components: {
         
        },
        methods: {
          
          edit(id){
            const self = this;
                let listUrl = "";
                listUrl = BASE_URL + '/api/'+ self.URL_Segment +'/edit/'+id;    
                axios.get(listUrl).then((response) => {
                    self.lists = response.data;
                   
                    self.name = self.lists.name;
                    self.status = self.lists.status;
                   
                  

                    self.loading = false;
                    self.views = true;
                }).catch((error) => {
                    console.log(error);
                   
                });

          },

          
          RequestUpdate(){
             

              const self = this; 
                let urlBase="";
                let formData = new FormData();
                self.id = self.$route.params.id;
                formData.append('name', self.name);
                formData.append('status', self.status);
                formData.append("_method", "put");  
                
                urlBase = axios.post(BASE_URL+'/api/'+ self.URL_Segment +'/'+ self.id, formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Update",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
                                self.$router.push({path:'/'+ self.URL_Segment})
                            }
                        });
                    }
                
                }).catch((error) => {
                 
                    self.errors = error.response.data;
                    

                });


          }, 

        }
    }
   
</script>