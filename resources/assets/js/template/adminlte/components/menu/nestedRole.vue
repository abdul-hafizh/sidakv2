
<template>
  <draggable
    v-bind="dragOptions"
    tag="div"
    :list="list"
    :value="value"
    class="list-group"
    @input="emitter"
  >
   
    <div class="form-group col-sm-12 grup-checkbox group-sub" :key="el.id" v-for="(el,index) in realValue">
       <div class="row-checkbox" >
          <div class="pull-left checkbox-form" v-if="el.type_icon == 'fa'"> 
              <i class="padding-8-0 fa" :class="el.icon" ></i>
          </div>
           <div class="pull-left menu-left-icon-role" v-else> 
               <img class="menu-icon"  :src="el.icon" />
          </div>


          <div class="pull-left checkbox-label">
              <span class="pull-left text-bold font-16">
                {{ el.name }}  
               <!--  <i class="font-10 font-normal" v-if="el.pages == false">Create</i>
                <i class="font-10 font-normal" v-else>Active</i> -->
              </span>
          </div>

          <div v-if="el.status =='unlock'">

              <div class="pull-right padding-05-05 bg-list-menu-btn" v-if="el.edit == false" >

                <span class="padding-05-05" v-if="el.type !='menu'">
                  <i class="fa fa-eye" data-toggle="modal" data-target="#AddPages" @click="AddPages(el.id)"></i> 
                  <i class="border-right-white"></i>
                </span>
                
                <span class="padding-05-05">
                  <i class="fa fa-pencil-square-o" @click="EditShowForm(el.id)"></i> 
                  <i class="border-right-white"></i>
                </span>
             
                 <span class="padding-05-05"><i class="fa fa-trash" @click="Delete(role,el,index)"></i></span>
              </div>

              <div class="pull-right padding-05-05 bg-list-menu-btn" v-else>

                 <span class="padding-05-05" @click="EditHideForm(el.id)"><i class="fa fa-sort-up po-top"></i></span>
              </div>

          </div>

          <div v-else class="pull-right padding-05-05 bg-list-menu-btn">
             

                <span class="padding-05-05" v-if="el.type !='menu'">
                  <i class="fa fa-eye"  data-toggle="modal" data-target="#AddPages" @click="AddPages(el.id)"></i> 
                  <i class="border-right-white"></i>
                </span>
             
                <span class="padding-05-05">
                   <i class="fa fa-lock" ></i>
                </span>

          </div>

       </div>

       <!--  <div class="row-checkbox" v-else><loading-block class="loading-top" /> </div>  -->

        <div class="pull-left full edit-menu-form" v-show="el.edit">
            
            <div class="col-sm-3" >           
                 <input  v-model="el.name" type="text" class="form-control col-sm-2" placeholder="Name">
            </div> 

            <div class="col-sm-3" >        
                 <input v-model="el.path_web" type="text" class="form-control" placeholder="Path Web URL">
            </div> 

             <div class="col-sm-3" >        
                 <input v-model="el.path_vue" type="text" class="form-control" placeholder="Path Vue URL">
            </div> 

        </div>
      
        <nested-role  class="list-group" :list="el.tasks" :role="role" :Apps="Apps" :URL_Segment="URL_Segment"/>
        <DetailPages :Apps="Apps" :role="role" :URL_Segment="URL_Segment" :lists="pages" v-if="v_add" :Title="Title" @close="closeModal"></DetailPages>
    </div>
  
  </draggable>

  
</template>

<script>
import draggable from "vuedraggable";
export default {
  name: "nested-role",

  props: {
    value: {
      required: false,
      type: Array,
      default: null
    },
    list: {
      required: false,
      type: Array,
      default: null
    },
    role:{},
    Apps:{},
    URL_Segment:{},
  },
  data() {
    return { 
       group:'people',
       loading:false,
       v_add:false,
       v_edit:false,
       Title:'Pages',
       pages:[],
    }
  },
  created() {  
    
  },
  components: {
    draggable,
    'DetailPages': require('./detail.vue').default,
  },
  computed: {
    dragOptions() {
       this.group = 'people';
      return {
        animation: 500,
        group: this.group,
        disabled: false,
        ghostClass: "moving-card"
      };
         
    },
    // this.value when input = v-model
    // this.list  when input != v-model
    realValue() {
      var data = this.value ? this.value : this.list;
        
      return this.value ? this.value : this.list;
    }
  },  
  methods: {
    emitter(value) {
      this.group = 'description';
      this.$emit("input", value);
        
    },
    AddPages(index){
       let data = this.value ? this.value : this.list;
       let findrole = data.find(o => o.id === index); 
       this.pages = findrole;
       
       this.v_add = true;
    },
    closeModal(){
           
      this.v_add = false;  
      this.v_edit = false; 
    },
    EditShowForm(index){
          let data = this.value ? this.value : this.list;
          let findrole = data.find(o => o.id === index); 
        
          if(findrole.edit == false)
          {
               findrole.edit = true;
          }else{
              findrole.edit = false;
          }    
    },
    EditHideForm(index){
          let data = this.value ? this.value : this.list;
          let findrole = data.find(o => o.id === index); 
          if(findrole.edit == true)
          {
               findrole.edit = false;
          }else{
              findrole.edit = true;
          }  
    },
   
     Delete(role,el,index)
    {
        let data = this.value ? this.value : this.list;  
        
       this.$swal({
            buttons:true,
            dangerMode:true,
            title: "Apakah Anda Yakin Hapus Menu "+el.name+" ?",
            icon: "warning",
        }).then((result) => {
            if (result) {
 
                 if(data.length > 1)
                 {  
                    data.splice(index, 1); 
                 }else{

                    if(el.tasks.length ==0)
                    {
                      data.splice(el.tasks, 1);
                    }else{
                        axios.delete(BASE_URL + '/api/menus/role/'+ role)
                        .then((response) => {   
                           
                        }).catch((error) => {
                             console.log(error);
                        });
                    }  
                 }  

            }
        });  

    },

  },
  
  
};
</script>
