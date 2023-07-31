
<template>

  <draggable
    v-bind="dragOptions"
    tag="div"
    :list="list"
    :value="value"
    class="list-group"
    @input="emitter"
  >
   
    <div class="padding-5-15 form-group  col-sm-12 grup-checkbox group-sub" :key="el.id" v-for="(el,index) in realValue">

        <div class="row-checkbox">
            <span class="pull-left padding-05-05" v-if="el.type_icon == 'fa'">
                <i :class="el.icon"></i>
               
            </span>
            <span class="pull-left menu-left-icon" v-else>
                 <img class="menu-icon"  :src="el.icon" />
            </span>
            <div class="pull-left checkbox-label">
                 <span class="text-bold font-16">{{ el.name }} </span>
            </div>

            <div class="pull-right padding-05-05 bg-list-menu-btn" v-if="el.status =='unlock'" >
                    <span class="padding-05-05" @click="EditView(el.id)">
                      <i class="fa fa-pencil-square-o"  data-toggle="modal" data-target="#EditForm"  ></i> 
                      <i class="border-right-white"></i>
                    </span>
         
                    <span class="padding-05-05"><i class="fa fa-trash" @click="Delete(el.id,el.name)"></i></span>
            </div>

            <div v-else class="pull-right padding-05-05 bg-list-menu-btn">
                <span class="padding-05-05"><i class="fa fa-lock" ></i></span>
            </div>

           </div>                 
        </div>

    </div>

  </draggable>

  

  
</template>

<script>
import draggable from "vuedraggable";
export default {
  name: "nested-menu",

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
   
    Apps:{},
    URL_Segment:{},
  },
  data() {
    return { 
       group:'people',
       loading:false,
       

       
    }
  },
  created() {  
    
  },
  components: {
    draggable,
  },
  computed: {
    dragOptions() {
       this.group = 'people';
      return {
        animation: 200,
        group: this.group,
        disabled: false,
        ghostClass: "moving-card"
      };
         
    },
    // this.value when input = v-model
    // this.list  when input != v-model
    realValue() {
      return this.value ? this.value : this.list;
    }
  },  
  methods: {
    emitter(value) {
      this.group = 'people';
      this.$emit("input", value);
      // localStorage.setItem('menu', JSON.stringify(value));   
    },
    EditView(id){
       this.$emit("edit", id);
    },
   
    Delete(id,name){
            
                this.$swal({
                    buttons:true,
                    dangerMode:true,
                    title: "Apakah Anda Yakin Hapus "+ name +" ?",
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
                                        window.location.href = BASE_URL+ '/'+this.URL_Segment;
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
                                        window.location.href = BASE_URL+ '/'+this.URL_Segment;
                                    }
                                });
                            }
                        }).catch((error) => {
                            console.log(error);
                        });

                    }
                });
          },

  },
  
  
};
</script>
