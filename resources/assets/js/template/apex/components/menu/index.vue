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
        <li v-for="(role,i) in lists.role" :class="role.show">
            <a :href="'#tab_'+i" @click="getloading()" data-toggle="tab" aria-expanded="true">{{ role.name }}</a>
        </li>
    </ul>
    <div class="tab-content pull-left full form-group">
     
        <div  class="tab-pane" v-for="(role,i) in lists.role" :id="'tab_'+i" :class="role.show">
          <perfect-scrollbar class="mt-20">
            <div v-if="load_tab ==true"><loading-block  class="loading-table"  /> </div> 
           
            <nested-test  v-else  v-model="role.tasks"  :role="role.id" />

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
        <div class="box box-solid box-warning  ">
                <div class="box-header with-border">
                  <h3 class="box-title padding-5-0">Data {{ Title }} </h3>
                  <div class="btn-group pull-right" data-toggle="btn-toggle">
                  
                    <button type="button" class="btn btn-danger btn-sm" @click="AddForm()"  >
                        <i class="fa fa-plus" ></i>
                    </button>
                   
                  </div>
                </div>
            
            <div class="box-body" >
               <perfect-scrollbar>
                 <div class="box-body" >

                        <draggable class="list-group" :list="lists.menu" :group="group" @change="log" itemKey="name">
                            <div class="form-group col-sm-12 grup-checkbox group-menu"  v-for="(element,index) in lists.menu">
                              <div class="row-checkbox">
                                <span class="pull-left padding-05-05" v-if="element.type_icon == 'fa'">
                                    <i :class="element.icon"></i>
                                   
                                </span>
                                <span class="pull-left menu-left-icon" v-else>
                                     <img class="menu-icon"  :src="element.icon" />
                                </span>
                                <div class="pull-left checkbox-label">
                                     <span class="">{{ element.name }} </span>
                                </div>

                                <div class="pull-right padding-05-05 bg-list-menu-btn" v-if="element.status =='unlock'" >
                                        <span class="padding-05-05" @click="EditView(element.id)">
                                          <i class="fa fa-pencil-square-o"  data-toggle="modal" data-target="#EditForm"  ></i> 
                                          <i class="border-right-white"></i>
                                        </span>
                             
                                        <span class="padding-05-05"><i class="fa fa-trash" @click="Delete(element.id)"></i></span>
                                </div>

                                <div v-else class="pull-right padding-05-05 bg-list-menu-btn">
                                    <span class="padding-05-05"><i class="fa fa-lock" ></i></span>
                                </div>

                               </div>                 
                            </div>
                        </draggable>

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

   import NestedTest from "./nested";
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
               menu:{},      
               role_id:null,
               tasks:[],
               group:'people',
               btn_cond:'btn-default',
               btn_disable:false,
 
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
           draggable,
           NestedTest,
           ModelSelect,
           'KeyForm': require('../menu/key.vue').default,
           'AddForm': require('../menu/add.vue').default,
           'UpdateForm': require('../menu/edit.vue').default,
        },
        methods: {

          AddForm(){
             this.v_add = true; 
          },  
          closeModal(){
            this.v_key = false;
            this.v_add = false;  
            this.v_edit = false; 
          },
          DeleteMenu(data,id){
            
             axios.delete(BASE_URL + '/api/menus/role/'+ id)
              .then((response) => {   
                  data.splice(index, 1);
              }).catch((error) => {
                  console.log(error);
              });


          },
          EditView(id){
             this.v_edit = true; 
             let findrole = this.lists.menu.find(o => o.id === id); 
            
             this.menu = findrole;

          },
          KeyView(id,tasks){
             this.v_key = true; 
             this.role_id = id;
             this.tasks = tasks;

          },
         
          getView(index){
           
                let findrole = this.lists.role.find(o => o.name === index);  
                if(findrole.show == false)
                {
                     findrole.show = true;
                }else{
                    findrole.show = false;
                }    

          },
         
          log(evt) {
             
             let menu = localStorage.getItem('menu');
             this.lists.menu =  JSON.parse(menu);
            
             //
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
                self.btn_cond = 'btn-warning';
               
                self.lists = response.data;
                let menu  = localStorage.getItem('menu'); 
               
                if(menu ==null || JSON.parse(menu).length ==0)
                {

                   localStorage.setItem('menu', JSON.stringify(self.lists.menu)); 
                } 
                  
                    var data = [];
                    var role = [];
                    for(var i=0; i<this.lists.role.length; i++)
                    {
                        if(this.lists.role[i].tasks.length !=0)
                        {
                          role = JSON.parse(this.lists.role[i].tasks);
                        }else{
                            role = [];
                        }    
                         data.push({
                           'id':this.lists.role[i].id,
                           'name':this.lists.role[i].name,
                           'slug':this.lists.role[i].slug,
                           'show':this.lists.role[i].show,
                           'edit':this.lists.role[i].edit,
                           'tasks': role, 
                        });
                     } 
      
                    
                 
                 
                  self.lists.role = data;
                  
               
               
            }).catch((error) => {
                //console.log(error);
                self.loading = true;
                self.views = false;
                self.viewsPage = false;
            });
             
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

              setTimeout(() => {
                 this.load_tab = false;
                 this.btn_cond = 'btn-warning';
                 this.btn_disable = false; 
                 }, 500);

                this.$emit('updateMenu',true);
 
            }).catch((error) => {
             
                console.log(error);
                    
            });

          },

          
          Delete(id){
             console.log(id)
                this.$swal({
                    buttons:true,
                    dangerMode:true,
                    title: "Apakah Anda Yakin Hapus ?",
                    icon: "warning",
                }).then((result) => {
                    if (result) {
                        
                        axios.delete(BASE_URL + '/api/'+ this.URL_Segment +'/'+ id)
                        .then((response) => {
                            
                            if(response.data.messages == true){
                               
                                this.$swal({
                                    title: "Berhasil Di Hapus",
                                    icon: "success"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        localStorage.removeItem('menu');
                                        this.getData();
                                    }
                                });
                            }else{
                               
                                this.$swal({
                                    title: "Gagal Di Hapus",
                                    icon: "error"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.getData();
                                    }
                                });
                            }
                        }).catch((error) => {
                            console.log(error);
                        });

                    }
                });
          },

        }
    }
   
</script>

