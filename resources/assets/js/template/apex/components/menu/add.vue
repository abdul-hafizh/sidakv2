<template>
 <!-- Modal content-->
<div class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
 <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" @click="$emit('close')">&times;</button>
        <h4 class="modal-title">Add {{Title}}</h4>
      </div>

      <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
       <perfect-scrollbar>
         <div class="modal-body">
        
            <div class="form-group" :class="errors.messages.name ? 'has-error' : ''">
                 <label>Name :</label>
                 <input v-model="name" type="text" class="form-control" >
                <span class="help-block" v-if="errors.messages.hasOwnProperty('name')">
                    <strong>{{ errors.messages.name }}</strong>
                </span>
            </div>

             <div class="form-group" :class="errors.messages.path_vue ? 'has-error' : ''">
                 <label>Path Vue :</label>
                 <input v-model="path_vue" type="text" class="form-control" >
                  
                   <span class="help-block">* Khusus untuk sub menu tambah dan edit vue js </span>
                    <span class="help-block">* contoh : "/role/edit/:id" </span>
                
                <span class="help-block" v-if="errors.messages.hasOwnProperty('path_vue')">
                    <strong>{{ errors.messages.path_vue }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.path_web ? 'has-error' : ''" >
                 <label>Path Web :</label>
                 <input v-model="path_web" type="text" class="form-control">

                   <span class="help-block">* Khusus untuk sub menu tambah dan edit Web </span>
                   <span class="help-block">* contoh : "/role/edit/{id}" </span>
                 


                <span class="help-block" v-if="errors.messages.hasOwnProperty('path_web')">
                    <strong>{{ errors.messages.path_web }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.filename ? 'has-error' : ''" >
                 <label>Filename :</label>
                 <input v-model="filename" type="text" class="form-control" @input="getFilename(filename)">
                <span class="help-block" v-if="errors.messages.hasOwnProperty('filename')">
                    <strong>{{ errors.messages.filename }}</strong>
                </span>
            </div>

            <div class="form-group">
                 <label>Type Icon :</label>
                  <div class="radio">
                    <label>
                      <input v-model="type_icon" type="radio" value="fa"  @change="getTypeIcon(type_icon)">
                      Icon Awesome
                    </label>
                  </div>
                  <div class="radio">
                  <label>
                      <input v-model="type_icon"  type="radio" value="file"  @change="getTypeIcon(type_icon)">
                     File
                    </label>
                  </div>
              
            </div>

           


            <div class="form-group" :class="errors.messages.icon ? 'has-error' : ''">
                <label>Icon :</label>
                
                <div v-if="type_icon == 'file'">
                        <button @click="chooseFiles()" class="btn btn-default " type="button"><i class="fa fa-picture-o"></i> Upload Icon</button>
                   
                        <input type="file" style="display: none" ref="fileInput" accept="image/*" @change="onFilePicked"/>
                </div>
                <div v-else>
                  <input  v-model="icon" type="text" class="form-control">  
                  <br>
                  <a target="_blank" href="https://fontawesome.com/v4/icons/">Lihat Icon Awesome</a>
                </div>
                

                <span class="help-block" v-if="errors.messages.hasOwnProperty('icon')">
                    <strong>{{ errors.messages.icon }}</strong>
                </span>
            </div>

            <div class="form-group " v-if="photoUrl !=''">
                 <img class="img-icon" :src="photoUrl">
            </div>

            <div class="form-group " v-if="photoUrl !=''">
                 <button class="btn btn-danger">Delete</button>
            </div>    

         </div>
      </perfect-scrollbar>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="$emit('close')">Close</button>
        <button type="submit" class="btn btn-warning" >Save</button>
      </div>
      </form>
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
                      
                        filename:'', 
                        icon:'',      
                    },
               }, 
               
               
               name:'',
               path_vue:'',
               path_web:'',
               type_icon:'fa',
               filename:'',
               type_text:'text',
               icon:'',
              
               photoUrl:'',

            }
        },
        created() {  
           document.title = this.Apps;
        },
        mounted() {

        },
        computed: {
             base_url() {
                return BASE_URL;
            }, 
             
        },
        components: {

        },
        methods: {
          
          getFilename(name){
            if(name !='')
            {   
                this.filename =  name.toLowerCase().replace(/ /g, "").replace(/[^\w-]+/g, "");   
            }else{
                this.filename = ''; 
            }     
          },
          getTypeIcon(type){
             if(type =='fa')
             {
                this.type_text = 'text';
                this.icon = 'fa fa-circle-o';
             }else{
                this.type_text = 'file';
                this.icon = '';
             }   
          },
          chooseFiles(){
              this.$refs.fileInput.click()

          },
          onFilePicked (event) {
              const files = event.target.files
              let filename = files[0].name
              const fileReader = new FileReader()
              fileReader.addEventListener('load', () => {
                this.photoUrl = fileReader.result;
                   
              })
              fileReader.readAsDataURL(files[0])
             
          },
          RequestPost(){
            
                const self = this; 
                let urlBase="";
                let formData = new FormData();
                let icon = self.icon ? self.icon : self.photoUrl;

                formData.append('name', self.name);
                formData.append('path_vue', self.path_vue);
                formData.append('path_web', self.path_web);
                formData.append('type_icon', self.type_icon);
                formData.append('filename', self.filename);
                formData.append('icon', icon);
               
                
                urlBase = axios.post(BASE_URL+'/api/' + self.URL_Segment, formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Simpan",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
                                localStorage.removeItem('menu');
                                window.location.href = BASE_URL+ '/menu';
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

