<template>
<div>    
<section class="content">
 <div class="row">


<section class="col-lg-7 connectedSortable ui-sortable margin-0-0-50-0 pull-left">
<div class="nav-tabs-custom" v-if="loading ==true">
    <loading-block  class="padding-80-0"  />
</div>
<div class="nav-tabs-custom" v-else> 
    <ul class="nav nav-tabs">
        <li v-for="(role,i) in role_list" :class="role.show">
            <a class="text-bold" :href="'#tab_'+i" @click="getloading()" data-toggle="tab" aria-expanded="true">{{ role.name }}</a>
        </li>
    </ul>
    <div class="tab-content pull-left full form-group">
     
        <div  class="tab-pane" v-for="(role,i) in role_list" :id="'tab_'+i" :class="role.show">
             <perfect-scrollbar class="mt-20">
               <div v-if="load_tab ==true"><loading-block  class="loading-table"  /> </div> 
           
               <nested-role  v-else  v-model="role.tasks"  :role="role.id" :Apps="Apps" :URL_Segment="URL_Segment" />

             </perfect-scrollbar>
           
            <div class="group-list-btn-save col-sm-12">
                 <button data-toggle="modal" data-target="#KeyForm" @click="KeyView(role.id,role.tasks)"  v-if="role.tasks.length !=0" type="button" class="btn" :class="btn_cond"  :disabled="btn_disable">Save</button> 
                 <button v-else type="button" class="btn btn-default" disabled>Save</button> 
            </div>
        </div>

    </div>

</div>    
      
</section>

<section class="col-lg-5 connectedSortable ui-sortable pull-left">
        <div class="box box-solid box-primary  ">
                <div class="box-header with-border">
                  <h3 class="pull-left box-title padding-5-0">Data {{ Title }} </h3>
                   
                  <div class="pull-left padding-0-10 width-70">
                      
                        <input type="text" placeholder="Search Menu" class="form-control padding-0-15 border-radius-16" v-model="inputsearch" @input="Search(inputsearch)">
                        
                       
                  </div> 

                  <div class="btn-group pull-right" data-toggle="btn-toggle">
                  
                   

                    <button type="button" class="btn btn-default btn-sm" @click="AddForm()"  >
                        <i class="fa fa-plus" ></i>
                    </button>
                   
                  </div>
                </div>
            
            <div class="box-body" >
                <div class="col-sm-12 pull-left" v-if="searchViews">

                    <div class="alert alert-danger alert-dismissible margin-none"  >
                     <i class="fa fa-search" aria-hidden="true"></i>    {{ search_text  }}
                    </div>

                </div>
                <perfect-scrollbar class="pull-left col-sm-12 padding-none">
                 <div class="box-body padding-10-0" >
  
                    <nested-menu  v-model="menu_list" :Apps="Apps" :URL_Segment="URL_Segment" @edit="ShowEditForm" />

                </div>

                </perfect-scrollbar>
 
            </div>
        </div>

</section>



      
    </div>

  </section>


</section>



<!-- Modal -->
<KeyForm  :Apps="Apps" :role_id="role_id" :tasks="tasks" :URL_Segment="URL_Segment" @saving="SaveMenu" @close="closeModal" v-if="v_key">
</KeyForm>

<AddForm :Apps="Apps" v-if="v_add" :Title="Title" :URL_Segment="URL_Segment" @close="closeModal" ></AddForm>

<UpdateForm :menu="menu" :Apps="Apps" :Title="Title" :URL_Segment="URL_Segment" v-if="v_edit" @close="closeModal"></UpdateForm>

</div>
</template>
<script>

   import NestedRole from "./nestedRole";
   import NestedMenu from "./nestedMenu";
   import { ModelSelect } from 'vue-search-select';
   import 'vue-search-select/dist/VueSearchSelect.css'; 
   import draggable from "vuedraggable";
   export default {
        props:["Apps","Title","URL_Segment"],
        
        data() {
            return {
               loading:true,
               load_tab:true,
               lists:[],
               v_add:false,  
               v_edit:false,
               v_key:false,
               menu:[],
               menu_list:[],
               role_list:[],      
               role_id:null,
               tasks:[],
               group:'people',
               btn_cond:'btn-default',
               btn_disable:false,
               inputsearch:'',
               search_text:'',
               loading_menu:true,
               views_menu:false,
               searchViews:false,
               resultNull:false,
               total_menu:0,

            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
           
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
           draggable,
           NestedRole,
           NestedMenu,
           ModelSelect,
           'KeyForm': require('./key.vue').default,
           'AddForm': require('./add.vue').default,
           'UpdateForm': require('./edit.vue').default,
        },
        methods: {

          AddForm(){
             this.v_add = true; 
          },
          ShowEditForm(id){
               this.v_edit = true; 
               let findrole = this.menu_list.find(o => o.id === id);
               this.menu = findrole;
               
          },
          closeModal(){
              this.v_key = false;
              this.v_add = false;  
              this.v_edit = false; 
          },
          Search(input){
               const self = this;   
               if(input !="")
               {
                   
                    let urlBase="";
                    let formData = new FormData();
                    formData.append('search', input);
                    urlBase = axios.post(BASE_URL+'/api/'+ this.URL_Segment +'/search', formData);
                    urlBase
                    .then((response) => {
                        

                        self.menu_list = response.data.result; 
                        self.loading_menu = false;
                        self.searchViews = true;
                 
                        if(response.data.total >0)
                        {
                          
                           self.views_menu = true;
                           self.search_text = response.data.cari;
                           self.total_menu = response.data.total;
                           self.resultNull = false;
                        }else{
                           self.search_text = 'Pencarian "'+ self.inputsearch +'" tidak ditemukan ';
                           self.total_menu = 0;
                           self.resultNull = true;
                           self.views_menu = false;
                        }
                    
                    }).catch((error) => {
                     
                        console.log(error);
                            
                    });
                }else{
                 self.searchViews = false;   
                 self.loadMenu();
                }   

          },
          
          DeleteMenu(data,id){
            
             axios.delete(BASE_URL + '/api/'+ this.URL_Segment +'/role/'+ id)
              .then((response) => {   
                  data.splice(index, 1);
              }).catch((error) => {
                  console.log(error);
              });


          },
         
          KeyView(id,tasks){
             this.v_key = true; 
             this.role_id = id;
             this.tasks = tasks;

          },
         
          getView(index){
           
                let findrole = this.role_list.find(o => o.name === index);  
                if(findrole.show == false)
                {
                     findrole.show = true;
                }else{
                    findrole.show = false;
                }    

          },
          loadMenu(){
             let menu = localStorage.getItem('menu');
             this.menu_list =  JSON.parse(menu);
          }, 
          log(evt) {
             
             this.loadMenu();
            
          }, 
          Refresh(){
             this.loading = true;
             this.views = false;
             this.inputsearch = '';
             this.searchViews = false;
             this.resultNull = false;
             this.getData();
          },
         
          getData(){

            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/'+ this.URL_Segment;    
            axios.get(listUrl).then((response) => {
                self.loading = false; 
                self.load_tab = false;
                self.btn_cond = 'btn-primary';
               
                self.lists = response.data;
                self.getMenu(self.lists.menu)
                self.getRole(self.lists.role);
 
            }).catch((error) => {
                //console.log(error);
                self.loading = true;
                self.views = false;
                self.viewsPage = false;
            });
             
          },

          getMenu(data){

             let menu  = localStorage.getItem('menu'); 
             if(menu ==null || JSON.parse(menu).length ==0)
             {
              localStorage.setItem('menu', JSON.stringify(data.result)); 
             } 
             let data_menu  = localStorage.getItem('menu'); 
             this.menu_list =  JSON.parse(data_menu);
          },
          getRole(data){
            var res = [];
            var role = [];
            for(var i=0; i<data.length; i++)
            {
                if(data[i].tasks.length !=0)
                {
                  role = JSON.parse(data[i].tasks);
                }else{
                  role = [];
                }    
                 res.push({
                   'id':data[i].id,
                   'name':data[i].name,
                   'slug':data[i].slug,
                   'show':data[i].show,
                   'edit':data[i].edit,
                   'tasks': role, 
                });
             }      
                 
            this.role_list = res;
                  
          },
          getloading(){
           
              this.load_tab = true; 
              
              setTimeout(() => this.load_tab = false, 500);

            
    
          },
          SaveMenu(data){
            this.load_tab = true;
            this.btn_cond = 'btn-default';
            this.btn_disable = true;
            let urlBase="";
           
            const log = { role_id:data.id }
            const forms = {
                ...log, menu: data.tasks
            }

            urlBase = axios.post(BASE_URL+'/api/'+ this.URL_Segment +'/role/save', forms);
            urlBase
            .then((response) => {
                if(response.data.condition == true)
                {
                  localStorage.removeItem('root_vue');
                  localStorage.removeItem('menu_sidebar');  
                }    
             
              setTimeout(() => {
                 this.load_tab = false;
                 this.btn_cond = 'btn-primary';
                 this.btn_disable = false;

                if(response.data.condition == true)
                {

                 localStorage.setItem('root_vue', JSON.stringify(response.data.path));
                 localStorage.setItem('menu_sidebar', JSON.stringify(response.data.menu_sidebar));

                }

                 }, 500);



                this.$emit('updateMenu',true);
 
            }).catch((error) => {
             
                console.log(error);
                    
            });

          },

          
         

        }
    }
   
</script>
