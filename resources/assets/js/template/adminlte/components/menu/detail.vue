<template>
 <!-- Modal content-->
<div class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
 <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" @click="$emit('close')">&times;</button>
        <h4 class="modal-title">Create {{Title}}</h4>
      </div>

      <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
       <perfect-scrollbar>
         <div class="modal-body">
        
            <div class="form-group" >
                 <label>Name :</label>
                 <input v-model="name" type="text" class="form-control" disabled>
                
            </div>


            <div class="form-group"  >
                 <label>Route Api :</label>
                 <input v-model="path_api" type="text" class="form-control" disabled>               

               
            </div>


            <div class="form-group"  >
                 <label>Foldername :</label>
                 <input v-model="foldername" type="text" class="form-control" disabled>               

               
            </div>



            <div class="form-group" >
                 <label>Filename :</label>
                 <input v-model="filename" type="text" class="form-control" @input="getFilename(filename)" disabled>
               
            </div>

            <div class="form-group"  >
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

               
            </div>

            <div class="form-group"  :class="errors.messages.table_name ? 'has-error' : ''">
                 <label>Table Name :</label>
                  <input v-model="table_name" type="text" class="form-control" > 
                   <span class="help-block" v-if="errors.messages.hasOwnProperty('table_name')">
                    <strong>{{ errors.messages.table_name }}</strong>
                </span>          
            </div>

            <div class="form-group"  v-if="type =='table'" :class="errors.messages.order_by ? 'has-error' : ''" >
                 <label>Table Sort :</label>
                     <div class="radio">
                        <label>
                            <input type="radio" value="asc" v-model="order_by" >
                           Ascending
                        </label>
                     </div>

                     <div class="radio">
                        <label>
                            <input type="radio" value="desc" v-model="order_by" >
                           Descending
                        </label>
                     </div>

                    
                <span class="help-block" v-if="errors.messages.hasOwnProperty('order_by')">
                    <strong>{{ errors.messages.order_by }}</strong>
                </span>          
               
            </div>

            <div class="form-group"  v-if="type =='table'">
                 <label>Limit Table :</label>
                 <model-select class="form-control" v-model="limit_table" :options="list_limit" placeholder="Pilih limit table">
                     </model-select>
               
            </div>

            <div class="form-group pull-left full" v-if="type =='table' || type =='form' " :class="errors.messages.label_list ? 'has-error' : ''">
                <label>Label & Column</label>
                <div class="col-sm-12 pd-none"  v-for="(item, index) in label_list">
                   <div class=" mgn-bottom-20">
                        <input type="text" class="form-control" placeholder="Label" v-model="item.label" @input="updateLabel(index,item.label,'label')">
                   </div>
                   <div class=" mgn-bottom-20">

                       <input type="text" class="form-control text-height-115" placeholder="Column" v-model="item.label" @input="updateLabel(index,item.column,'column')">

                     

                       
                   </div>
                    <div class=" mgn-bottom-20 pull-right">
                          <button type="button" @click="deleteLabel(index)" class="btn btn-danger ">
                                    Delete     
                         </button>
                    </div>  
                  
                    <span class="help-block" v-if="errors.messages.hasOwnProperty('label_list')" >
                        <strong>{{ errors.messages.label_list }}</strong>
                    </span>

                </div>
                <div class="col-sm-12 pd-none">    
	                <button type="button" @click="addLabel()" class="btn btn-primary pull-left">
	                                    Add Label  
	                </button> 
                </div>
 
            </div>


            <div class="form-group pull-left full" v-if="type =='table' " :class="errors.messages.action_list ? 'has-error' : ''">
                <label>Action Table</label>
                <div class="col-sm-12 pd-none"  v-for="(item, index) in action_list">
                   <div class=" mgn-bottom-20">
                        <input type="text" class="form-control" placeholder="Label" v-model="item.label" @input="updateLabel(index,item.label,'label')">
                   </div>
                   <div class=" mgn-bottom-20">

                       <input type="text" class="form-control text-height-115" placeholder="Column" v-model="item.label" @input="updateLabel(index,item.column,'column')">

                     

                       
                   </div>
                    <div class=" mgn-bottom-20 pull-right">
                          <button type="button" @click="deleteAction(index)" class="btn btn-danger ">
                                    Delete     
                         </button>
                    </div>  
                  
                    <span class="help-block" v-if="errors.messages.hasOwnProperty('action_list')" >
                        <strong>{{ errors.messages.action_list }}</strong>
                    </span>

                </div>
                <div class="col-sm-12 pd-none">    
                    <button type="button" @click="addAction()" class="btn btn-primary pull-left">
                                        Add Action  
                    </button> 
                </div>
 
            </div>


         <!--    <div class="form-group pull-left full" :class="errors.messages.action_list ? 'has-error' : ''">
                 <label>Action Table</label>
                    <div class="col-sm-12 pd-none"  v-for="(item, index) in action_list">
                        <div class="input-group form-group" >
                            <input type="text" class="form-control" v-model="item.fitur" @input="updateAction(index,item.fitur)">
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-danger btn-flat" @click="deleteAction(index)"><i class="fa fa-trash" ></i></button>
                            </span>

                          

                        </div> 

                          <span class="help-block" v-if="errors.messages.hasOwnProperty('action_list')" >
                            <strong>{{ errors.messages.action_list }}</strong>
                            </span>

                    </div>
                    <div class="col-sm-12 pd-none form-group"> 
                        <button type="button" @click="addAction()" class="btn btn-primary pull-right">
                                    Add Action
                        </button>
                    </div>  

            </div>
 -->

                 
               
            <div class="form-group"  v-if="type =='table'">
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

              
            </div> 
                

            <div class="form-group"  v-if="type =='table'">
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

               
            </div> 
             

         </div>
      </perfect-scrollbar>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="$emit('close')">Close</button>
        <button type="submit" class="btn btn-primary" >Create File</button>
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
        props:["Apps","Title","role","lists","URL_Segment"],
        
        data() {
            return {
                errors: {
                    messages: {
                        label_list:'',
               			action_list:'',
                        table_name:'',
                        order_by:'',    
                    },
               }, 
               menu_id:'',
               name:'',
               path_api:'',
               foldername:'',
               filename:'',
               type:'',
               list_limit:[{'value':'5','text':'5'},{'value':'10','text':'10'},{'value':'15','text':'15'},{'value':'20','text':'20'}],
               table_name:'',
               order_by:'',
               limit_table:'10',
               search:true,
               paginate:true,
               label_list:[],
               list_table:[],
               action_list: [{fitur: 'add'}, {fitur: 'edit'},{fitur: 'detail'}],
               // btnDelete:true,
              

            }
        },
       
        created() {  
            document.title = this.Apps;
            this.menu_id = this.lists.id;
            this.name = this.lists.name;
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
           ModelSelect,
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
                        textinput = text.toLowerCase();
                    }else{
                        textinput = this.label_list[i].column.toLowerCase();
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
          addAction() {
              this.action_list.push({});
          },
          updateAction(index,text) {
              
            var jml = this.action_list.length; 
            var data = [];
            for(var i=0; i<jml; i++)
            {
                data.push({
                  'fitur':this.action_list[i].fitur
                }); 
                
            }  
            this.action_list = data;

          },
          deleteAction(index) {
              this.action_list.splice(index, 1);
              
          },
          RequestPost(){
            
                const self = this; 
                let urlBase="";
             //    let formData = {
               
             //      role_id:self.role,
             //      name:self.name,
             //      path_api:self.path_api,
             //      foldername:self.foldername,
             //      filename:self.filename,
             //      type:self.type,
             //      table_name:self.table_name,
             //      order_by:self.order_by,
             //      label_list:self.label_list,
             //      action_list:self.action_list,
             //      limit_table:self.limit_table,
             //      search:self.search,
             //      paginate:self.paginate,

             //    }

             //    const forms = {
	            //    menu: formData
	            // }

                let formData = new FormData();
               
                formData.append('name', self.name);
                formData.append('role_id', self.role);
                formData.append('path_api', self.path_api);
                formData.append('foldername', self.foldername);
                formData.append('filename', self.filename);
                formData.append('type', self.type);
                formData.append('table_name', self.table_name);
                formData.append('order_by', self.order_by);
                formData.append('label_list', self.label_list);
                formData.append('action_list', self.action_list);
                formData.append('limit_table', self.limit_table);
                formData.append('search', self.search);
                formData.append('paginate', self.paginate);
               

                urlBase = axios.post(BASE_URL+'/api/' + self.URL_Segment+'/pages/save', formData);
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
                    self.addLabel();
                    if(this.action_list.length ==0)
                    {
                       self.addAction();   
                    }    
                   
                    self.errors = error.response.data;
                   
                    
                });


          }, 

        }
    }
   
</script>

