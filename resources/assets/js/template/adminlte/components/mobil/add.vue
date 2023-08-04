
    <template>

<div class="content">
   
    <div class="box box-primary">

        <div class="box-body">
             <div class="row" v-if="loading">  
                <div class="form-group col-sm-12">
                 <loading-block class="loading-table"  />
                </div>
              </div> 
            <div class="row" v-if="views">
            <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
                   

                <div class="form-group col-sm-6" :class="errors.messages.merk ? 'has-error' : ''">
                         <label>Merk :</label>
                         <input v-model="merk" type="text" class="form-control" placeholder="Sample merk">
                         <span class="help-block" v-if="errors.messages.hasOwnProperty('merk')">
                            <strong>{{ errors.messages.merk }}</strong>
                         </span>
                    </div>
                    <div class="form-group col-sm-6" :class="errors.messages.type ? 'has-error' : ''">
                         <label>Type :</label>
                         <input v-model="type" type="text" class="form-control" placeholder="Sample type">
                         <span class="help-block" v-if="errors.messages.hasOwnProperty('type')">
                            <strong>{{ errors.messages.type }}</strong>
                         </span>
                    </div>

                     

                     

                   
                    <div class="form-group col-sm-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" @click="Cancel">Cancel</button>

                      
                    </div>

            </form>
                

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
                        merk:"", 
                        type:"", 
                       
                            
                    },
               }, 
               loading:true,
               views:false,
               merk:"",
               type:"", 
               
            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
        },
        mounted() {
             this.loading = false;
             this.views = true; 
        },
        computed: {
             base_url() {
                return BASE_URL;
            }, 
             
        },
        components: {
          
        },
        methods: {
          Cancel(){
             this.$router.push({path:"/"+ this.URL_Segment})
          },
          RequestPost(){
             
              const self = this; 
                let urlBase="";
                let formData = new FormData();
                formData.append("merk", self.merk);
                formData.append("type", self.type);
               
                
                
                urlBase = axios.post(BASE_URL+"/api/"+  self.URL_Segment , formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Simpan",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
                                   self.$router.push({path:"/"+ this.URL_Segment})
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
   