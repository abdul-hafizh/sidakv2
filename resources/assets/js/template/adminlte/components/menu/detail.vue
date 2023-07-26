<template>
 <!-- Modal content-->
<div class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
 <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" @click="$emit('close')">&times;</button>
        <h4 class="modal-title">Detail {{Title}}</h4>
      </div>

      <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
       <perfect-scrollbar>
         <div class="modal-body">
        
            <div class="form-group" :class="errors.messages.name ? 'has-error' : ''">
                 <label>Name :</label>
                 <input v-model="name" type="text" class="form-control" disabled>
                <span class="help-block" v-if="errors.messages.hasOwnProperty('name')">
                    <strong>{{ errors.messages.name }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.path_vue ? 'has-error' : ''">
                <label>Route Vue :</label>
                <input v-model="path_vue" type="text" class="form-control" disabled>
                
                <span class="help-block" v-if="errors.messages.hasOwnProperty('path_vue')">
                    <strong>{{ errors.messages.path_vue }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.path_web ? 'has-error' : ''" >
                <label>Route Web :</label>
                <input v-model="path_web" type="text" class="form-control" disabled>

                <span class="help-block" v-if="errors.messages.hasOwnProperty('path_web')">
                    <strong>{{ errors.messages.path_web }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.path_api ? 'has-error' : ''" >
                 <label>Route Api :</label>
                 <input v-model="path_api" type="text" class="form-control" disabled>               

                <span class="help-block" v-if="errors.messages.hasOwnProperty('path_api')">
                    <strong>{{ errors.messages.path_api }}</strong>
                </span>
            </div>


            <div class="form-group" :class="errors.messages.foldername ? 'has-error' : ''" >
                 <label>Foldername :</label>
                 <input v-model="foldername" type="text" class="form-control" disabled>               

                <span class="help-block" v-if="errors.messages.hasOwnProperty('foldername')">
                    <strong>{{ errors.messages.foldername }}</strong>
                </span>
            </div>



            <div class="form-group" :class="errors.messages.filename ? 'has-error' : ''" >
                 <label>Filename :</label>
                 <input v-model="filename" type="text" class="form-control" @input="getFilename(filename)">
                <span class="help-block" v-if="errors.messages.hasOwnProperty('filename')" disabled>
                    <strong>{{ errors.messages.filename }}</strong>
                </span>
            </div>

            <div class="form-group" :class="errors.messages.type ? 'has-error' : ''" >
                 <label>Type :</label>
	                 <div class="radio">
						<label>
							<input type="radio" value="table" v-model="type" disabled>
						   Table
						</label>
					 </div>

					 <div class="radio">
						<label>
							<input type="radio" value="form" v-model="type" disabled>
						   Form
						</label>
					 </div>

					 <div class="radio">
						<label>
							<input type="radio" value="view" v-model="type" disabled>
						   View
						</label>
					 </div>

                <span class="help-block" v-if="errors.messages.hasOwnProperty('type')">
                    <strong>{{ errors.messages.type }}</strong>
                </span>
            </div>



            <!-- <div class="form-group">
                <label>Label & Column</label>
                <div class="col-sm-12 pd-none"  v-for="(item, index) in label_list">
                   <div class=" mgn-bottom-20">
                        <input type="text" class="form-control" placeholder="Label" v-model="item.label" @input="updateTestimoni(index,item.label,'label')">
                   </div>
                   <div class=" mgn-bottom-20">
                        <input class="form-control text-height-115" placeholder="Column" v-model="item.column" @input="updateLabel(index,item.column,'column')">
                   </div>
                    <div class=" mgn-bottom-20">
                          <button type="button" @click="deleteLabel(index)" class="btn btn-default ">
                                    Delete     
                         </button>
                    </div>  


                </div>
                <div class="col-sm-12 pd-none">    
	                <button type="button" @click="addLabel()" class="btn btn-primary pull-left">
	                                    Add Label  
	                </button> 
                </div>
 
            </div>
               
            <div class="form-group" :class="errors.messages.search ? 'has-error' : ''" >
                 <label>Search :</label>
	                 <div class="radio">
						<label>
							<input type="radio" value="true" v-model="search">
						   Yes
						</label>
					 </div>

					 <div class="radio">
						<label>
							<input type="radio" value="false" v-model="search">
						   No
						</label>
					 </div>

                <span class="help-block" v-if="errors.messages.hasOwnProperty('search')">
                    <strong>{{ errors.messages.search }}</strong>
                </span>
            </div> 
                

            <div class="form-group" :class="errors.messages.paginate ? 'has-error' : ''" >
                 <label>Pagination :</label>
	                 <div class="radio">
						<label>
							<input type="radio" value="true" v-model="paginate">
						   Yes
						</label>
					 </div>

					 <div class="radio">
						<label>
							<input type="radio" value="false" v-model="paginate">
						   No
						</label>
					 </div>

                <span class="help-block" v-if="errors.messages.hasOwnProperty('paginate')">
                    <strong>{{ errors.messages.paginate }}</strong>
                </span>
            </div> 
              -->

         </div>
      </perfect-scrollbar>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="$emit('close')">Close</button>
       <!--  <button type="submit" class="btn btn-primary" >Create File</button> -->
      </div>
      </form>
    </div>
 </div>
</div> 
</template>
<script>
   export default {
        props:["Apps","Title","role","lists","URL_Segment"],
        
        data() {
            return {
                errors: {
                    messages: {
                        name:'',
                        path_vue:'',
               			path_web:'',
               			path_api:'',
                        filename:'',
                        foldername:'',
                        // type:'',
                        // search:'',
                        // paginate:'',
                            
                    },
               }, 
               menu_id:'',

               name:'',
               path_vue:'',
               path_web:'',
               path_api:'',
               foldername:'',
               filename:'',
               type:'',
               // search:true,
               // paginate:true,
               // label_list:[],
               // btnDelete:true,
              

            }
        },
       
        created() {  
            document.title = this.Apps;
            this.menu_id = this.lists.id;
            this.name = this.lists.name;
            this.path_vue = this.lists.path_vue;
            this.path_web = this.lists.path_web;
            this.path_api =  this.lists.path_api;
            this.foldername = this.lists.foldername;
            this.filename = this.lists.filename;
            this.type = this.lists.type;
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
          
         
          addLabel(){

             if(this.label_list.length ==1)
             {
                 this.label_list.push({});
             }else  if(this.label_list.length >1){
                 this.label_list.push({});
                 //this.btnDelete = false;
             }else{
                 this.label_list = [{label:'',pesan:''}];
                 //this.btnDelete = false;
             }    
              
          },
          updateLabel(index,text,type) {
              
            var jml = this.label_list.length; 
            var data = [];
            var textinput  ='';

            for(var i=0; i<jml; i++)
            {

                if(type =='label')
                {

                    if(this.label_list[i].label == text)
                    {
                        textinput = text;
                    }else{
                        textinput = this.label_list[i].label;
                    }

                    data.push({
                      'label':textinput,
                      'column':this.label_list[i].column,            
                    });

                }else{

                    if(this.label_list[i].column == text)
                    {
                        textinput = text;
                    }else{
                        textinput = this.label_list[i].column;
                    }

                    data.push({
                      'label':this.label_list[i].label,
                      'column':textinput, 
                    });

                }    
                
                
            }  
            this.label_list = data;
            
          },

          deleteLabel(index) {
          	  if(index >0)
          	  {
          	  	 this.label_list.splice(index, 1);
          	  } 	
              

          },
          RequestPost(){
            
                const self = this; 
                let urlBase="";
                let formData = {
                  menu_id:self.menu_id,
                  role_id:self.role,
                  name:self.name,
                  path_api:self.path_api,
                  foldername:self.foldername,
                  filename:self.filename,
                  type:self.type,
                  // label_list:self.label_list,
                  // search:self.search,
                  // paginate:self.paginate,
                }

                const forms = {
	               menu: formData
	            }
               
                
                urlBase = axios.post(BASE_URL+'/api/' + self.URL_Segment+'/pages/save', forms);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Simpan",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
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

