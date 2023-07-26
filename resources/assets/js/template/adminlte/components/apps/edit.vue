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

                        

                        <div class="form-group col-sm-12" :class="errors.messages.logo_lg ? 'has-error' : ''">
                             <label>Logo  :</label>
                             <input type="file" name="logo" @change="previewImage">
                             <span class="span-logo full">Ukuran Logo 300x37</span>
                             <div class="image-preview pull-left" v-if="logo_lg">
                                <img class="preview mt15" :src="logo_lg" width="100%">
                             </div>
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('logo')">
                                <strong>{{ errors.messages.logo }}</strong>
                             </span>
                        </div>

                        <div class="form-group col-sm-12" :class="errors.messages.logo_sm? 'has-error' : ''">
                             <label>Icon  :</label>
                             <input type="file" name="logo" @change="previewIcon">
                             <span class="span-logo full">Ukuran Icon 300x37</span>
                             <div class="image-preview-icon pull-left" v-if="logo_sm">
                                <img class="preview mt15" :src="logo_sm" width="100%">
                             </div>
                             <span class="help-block" v-if="errors.messages.hasOwnProperty('logo_sm')">
                                <strong>{{ errors.messages.logo_sm }}</strong>
                             </span>
                        </div>

                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                             <router-link :to="{path: '/apps'}" class="btn btn-default">Cancel</router-link>
                          
                        </div>

                </form>
</template>
<script>
   export default {
        props:["Apps","lists"],
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
                        logo_lg:'', 
                        logo_sm:'',  
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
               logo_lg:'',
               logo_sm:'', 
               imageData:'',
               loading:true,
               views:false,
               viewsPage:false,
              
              
              
            }
        },
        created() {  
           document.title = this.Apps;
         
           
            
        },
        watch: { 
          lists:function(data){
                this.id = data.id;
                this.title = data.title;
                this.about = data.about;
                this.contact = data.contact;
                this.address = data.address;
                this.facebook = data.facebook;
                this.instagram = data.instagram;
                this.twitter = data.twitter;
                this.logo_lg = data.logo_lg;
                this.logo_sm = data.logo_sm;
          },
        },
        mounted() {
           //this.edit();

             
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
                        this.logo_lg = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                    this.logo_lg = input.files[0];
                 
                }
            },

            previewIcon: function(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.logo_sm = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                    this.logo_sm = input.files[0];
                 
                }
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
            formData.append('logo_lg', self.logo_lg);
            formData.append('logo_sm', self.logo_sm);
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
