<template>
<div>

<div class="content">
    <div class="box box-primary">

            <div class="box-body">
                 <div class="row" v-if="loading">  
                    <div class="form-group col-sm-12">
                     <loading-block class="loading-table"  />
                    </div>
                  </div> 
                <div class="row" v-show="views_info">
               
                       <div class="form-group col-sm-12" >
                             <label>Judul  :</label>
                             <p>{{ title }}</p>
                            
                        </div>


                        <div class="form-group col-sm-12" >
                             <label>Tentang  :</label>
                             <p>{{ about }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Kontak  :</label>
                             <p>{{ contact }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Alamat  :</label>
                             <p>{{ address }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Facebook  :</label>
                             <p>{{ facebook }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Instagram  :</label>
                             <p>{{ instagram }}</p>
                        </div>

                         <div class="form-group col-sm-12" >
                             <label>Twitter  :</label>
                             <p>{{ twitter }}</p>
                        </div>

                        <div class="form-group col-sm-12" >
                             <label>Logo  :</label>
                           
                            
                             <div class="image-preview" v-if="logo.length > 0">
                                <img class="preview mt15" :src="logo" width="100%">
                             </div>
                            
                        </div>

                        

                        <div class="form-group col-sm-12">
                          
                             <button @click="GetEdit()" class="btn btn-warning">Edit</button>
                          
                        </div>
                </div>

                <EditForm class="row" v-show="views_form" :Apps="Apps">
                

                </EditForm>
            </div>
        </div>
  
    
</div>

</div>
</template>
<script>
   export default {
        props:["Apps"],
        data() {
            return {
               title:'',
               about:'',
               contact:'',
               address:'',
               facebook:'',
               instagram:'',
               twitter:'',
               logo:'', 
               loading:true,
               views_info:false,
               views_form:false,
               viewsPage:false,
               lists:{},
              
              
            }
        },
        created() {  
           document.title = this.Apps;
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
           'EditForm': require('./edit.vue').default,
        },
        methods: {
          previewImage: function(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.logo = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                    this.logo = input.files[0];
                 
                }
            },
          GetEdit(){
              this.views_info = false;
              this.views_form = true;

          }, 
          getData(){

            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/setting-apps';    
            axios.get(listUrl).then((response) => {
                self.lists = response.data.result;
                self.loading = false;
                self.views_info = true;
                self.title = self.lists.title;
                self.about = self.lists.about;
                self.contact = self.lists.contact;
                self.address = self.lists.address;
                self.facebook = self.lists.facebook;
                self.instagram = self.lists.instagram;
                self.twitter = self.lists.twitter;
                self.logo = self.lists.logo;


            }).catch((error) => {
                console.log(error);
                self.loading = false;
                self.views_info = false;
            
            });
             
          },
       

        }
    }
   
</script>
