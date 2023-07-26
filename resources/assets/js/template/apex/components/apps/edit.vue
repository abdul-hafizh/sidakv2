<template>
  <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
                       
                       <div class="form-group col-sm-12" :class="errors.messages.title ? 'has-error' : ''">
                             <label>Judul  :</label>
                             <input v-model="title" type="text" class="form-control">
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('title')">
                                <strong>{{ errors.messages.title }}</strong>
                             </span>
                        </div>


                        <div class="form-group col-sm-12" :class="errors.messages.about ? 'has-error' : ''">
                             <label>Tentang  :</label>
                             <textarea v-model="about" class="form-control"></textarea>    
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('about')">
                                <strong>{{ errors.messages.about }}</strong>
                             </span>
                        </div>

                        <div class="form-group col-sm-12" :class="errors.messages.contact ? 'has-error' : ''">
                             <label>Kontak  :</label>
                             <input v-model="contact" type="text" class="form-control">
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('contact')">
                                <strong>{{ errors.messages.contact }}</strong>
                             </span>
                        </div>

                        <div class="form-group col-sm-12" :class="errors.messages.address ? 'has-error' : ''">
                             <label>Alamat  :</label>
                             <textarea v-model="address" class="form-control"></textarea>    
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('address')">
                                <strong>{{ errors.messages.address }}</strong>
                             </span>
                        </div>

                        <div class="form-group col-sm-12" >
                             <label>Facebook  :</label>
                             <input v-model="facebook" type="text" class="form-control">
                            
                        </div>

                        <div class="form-group col-sm-12" >
                             <label>Instagram  :</label>
                             <input v-model="instagram" type="text" class="form-control">
                            
                        </div>

                        <div class="form-group col-sm-12" >
                             <label>Twitter  :</label>
                             <input v-model="twitter" type="text" class="form-control">
                            
                        </div>

                        

                        <div class="form-group col-sm-12" :class="errors.messages.logo ? 'has-error' : ''">
                             <label>Logo  :</label>
                             <input type="file" name="logo" @change="previewImage">
                             <span class="span-logo full">Ukuran Logo 300x37</span>
                             <div class="image-preview pull-left" >
                                <img class="preview mt15" :src="imageData" width="100%">
                             </div>
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('logo')">
                                <strong>{{ errors.messages.logo }}</strong>
                             </span>
                        </div>

                        

                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-warning">Update</button>
                             <router-link :to="{path: '/apps'}" class="btn btn-default">Cancel</router-link>
                          
                        </div>

                </form>
</template>
<script>
   export default {
        props:["Apps"],
        data() {
            return {
               errors: {
                    messages: {
                        title:'',
                        about:'',
                        contact:'',
                        address:'',
                        facebook:'',
                        instagram:'',
                        twitter:'',
                        logo:'',   
                    },
               },
               id:'',
               title:'',
               about:'',
               contact:'',
               address:'',
               facebook:'',
               instagram:'',
               twitter:'',
               logo:'',
               imageData:'',
               loading:true,
               views:false,
               viewsPage:false,
               lists:{},
              
              
            }
        },
        created() {  
           document.title = this.Apps;
        },
        mounted() {
           this.edit();
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
          previewImage: function(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                    this.logo = input.files[0];
                 
                }
            },
          edit(){

            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/setting-apps';    
            axios.get(listUrl).then((response) => {
                self.lists = response.data.result;
                self.loading = false;
                self.views = true;
                self.id = self.lists.id;
                self.title = self.lists.title;
                self.about = self.lists.about;
                self.contact = self.lists.contact;
                self.address = self.lists.address;
                self.facebook = self.lists.facebook;
                self.instagram = self.lists.instagram;
                self.twitter = self.lists.twitter;
                self.logo = self.lists.logo;
                self.imageData =  self.logo;

            }).catch((error) => {
                console.log(error);
                self.loading = false;
                self.views = false;
            
            });
             
          },
          RequestPost(){
             
            const self = this; 
            let urlBase="";
            let formData = new FormData();
           
            formData.append('title', self.title);
            formData.append('about', self.about);
            formData.append('contact', self.contact);
            formData.append('address', self.address);
            formData.append('facebook', self.facebook);
            formData.append('instagram', self.instagram);
            formData.append('twitter', self.twitter);
            formData.append('logo', self.logo);
            formData.append("_method", "put");  

           
            
            urlBase = axios.post(BASE_URL+'/api/setting-apps/'+ self.id, formData);
            urlBase
            .then((response) => {
                if(response.data.status == true){
                    self.$swal({
                        title: "Berhasil Diupdate",
                        icon: "success"
                    }).then((result) => {
                        if (result) {
                             this.$router.push({path:'/apps'});
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
