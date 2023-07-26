<template>
<!-- Modal content-->
<div class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" @click="$emit('close')">&times;</button>
        <h4 class="modal-title">Edit {{ Title }}</h4>
      </div>

      <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestUpdate">
      <perfect-scrollbar>  
      <div class="modal-body">
        
            <div class="form-group" :class="errors.messages.name ? 'has-error' : ''">
                 <label>Name :</label>
                 <input v-model="name" type="text" class="form-control" >
                <span class="help-block" v-if="errors.messages.hasOwnProperty('name')">
                    <strong>{{ errors.messages.name }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.type ? 'has-error' : ''" >
                <label>Type :</label>
                
                   <model-select  v-model="type" placeholder="Pilih Type" :options="type_list"   @input="getEventType($event)">
                     </model-select>



                <span class="help-block" v-if="errors.messages.hasOwnProperty('type')">
                    <strong>{{ errors.messages.type }}</strong>
                </span>
            </div>

             <div class="form-group" :class="errors.messages.path_vue ? 'has-error' : ''" v-show="inputShow">
                 <label>Path Vue :</label>
                 <input v-model="path_vue" type="text" class="form-control" >
                 <span class="help-block" v-if="errors.messages.hasOwnProperty('path_vue')">
                    <strong>{{ errors.messages.path_vue }}</strong>
                 </span>

                 <span class="help-block">* Khusus untuk sub menu tambah dan edit vue js </span>
                 <span class="help-block">* contoh : "/role/edit/:id" </span>

            </div>

            <div class="form-group" :class="errors.messages.path_web ? 'has-error' : ''" v-show="inputShow">
                 <label>Path Web:</label>
                 <input v-model="path_web" type="text" class="form-control">
                <span class="help-block" v-if="errors.messages.hasOwnProperty('path_web')">
                    <strong>{{ errors.messages.path_web }}</strong>
                </span>

                  <span class="help-block">* Khusus untuk sub menu tambah dan edit Web </span>
                  <span class="help-block">* contoh : "/role/edit/{id}" </span>
            </div>

            <div class="form-group" :class="errors.messages.path_api ? 'has-error' : ''" v-show="inputShow">
                 <label>Route Api :</label>
                 <input v-model="path_api" type="text" class="form-control">               

                <span class="help-block" v-if="errors.messages.hasOwnProperty('path_api')">
                    <strong>{{ errors.messages.path_api }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.foldername ? 'has-error' : ''" v-show="inputShow">
                 <label>Foldername :</label>
                 <input v-model="foldername" type="text" class="form-control">               

                <span class="help-block" v-if="errors.messages.hasOwnProperty('foldername')">
                    <strong>{{ errors.messages.foldername }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.filename ? 'has-error' : ''" v-show="inputShow">
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
                 <button class="btn btn-danger" @click="deleteIcon();">Delete</button>
            </div>    

      </div>
      </perfect-scrollbar>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="$emit('close')">Close</button>
        <button type="submit" class="btn btn-primary" >Update</button>
      </div>
      </form>
    </div>
  </div>   
</div>
</template>
<script>
   import { ModelSelect } from 'vue-search-select';
   import 'vue-search-select/dist/VueSearchSelect.css'; 
   export default {
        props:["Apps","menu","Title","URL_Segment"], 
        data() {
            return {
                errors: {
                    messages: {
                        name:'',
                        path_vue:'',
                        path_web:'',
                        path_api:'',
                        type:'',
                        foldername:'',
                        filename:'', 
                        icon:'',      
                    },
               }, 
               type_list:[{'text':'Menu','value':'menu'},{'text':'Table','value':'table'},{'text':'Form','value':'form'},{'text':'View','value':'view'}],
               name:'',
               path_vue:'/',
               path_web:'/',
               path_api:'',
               type:'',
               foldername:'',
               filename:'', 
               type_icon:'fa',
               type_text:'text',
               icon:'',
               inputShow:false,
               photoUrl:'',
               

            }
        },
        created() {  
           document.title = this.Apps;
          
           this.name = this.menu.name;
           this.path_vue = this.menu.path_vue;
           this.path_web = this.menu.path_web;
           this.path_api = this.menu.path_api;
           this.foldername = this.menu.foldername;
           this.filename = this.menu.filename;
           this.type = this.menu.type;
           this.type_icon= this.menu.type_icon;
           this.icon = this.menu.icon;
           if(this.type !='menu')
           {
               this.inputShow = true;
           }else{
              this.inputShow = false;
           } 

           if(this.menu.type_icon =='file')
           {
                this.photoUrl = this.menu.icon;
           }else{
               this.photoUrl = '';
           } 
          
        },
        mounted() {
             
        },
        computed: {
             base_url() {
                return BASE_URL;
            },
            
             
        },
        components: {
            ModelSelect,
        },
        methods: {
           getEventType(event){
              if(event =='menu')
              {
                this.inputShow = false;
              }else{
                this.inputShow = true;
              }  
          },
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
          deleteIcon(){
            this.photoUrl = '';

          },
          RequestUpdate(){
             

                const self = this;
                let urlBase="";
                let formData = new FormData();

                if(self.type_icon =='file')
                {
                    if(self.photoUrl !=''){ var icon =  self.photoUrl; }else{ var icon = '';}    
                }else{
                   var icon =  self.icon;  
                }    
                 
                formData.append('name', self.name);
                formData.append('path_vue', self.path_vue);
                formData.append('path_web', self.path_web);
                formData.append('path_api', self.path_api);
                formData.append('type', self.type);
                formData.append('foldername', self.foldername);
                formData.append('filename', self.filename);
                formData.append('icon', icon);
                 formData.append('type_icon', self.type_icon);
                formData.append("_method", "put");  
                urlBase = axios.post(BASE_URL+'/api/' + self.URL_Segment +'/'+ self.menu.id, formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Update",
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