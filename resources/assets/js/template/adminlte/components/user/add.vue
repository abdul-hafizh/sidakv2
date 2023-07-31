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

        <div class="form-group has-feedback" :class="errors.messages.username ? 'has-error' : ''">
            <input type="text" class="form-control" placeholder="Username" v-model="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="help-block" v-if="errors.messages.hasOwnProperty('username')">
                <strong>{{ errors.messages.username }}</strong>
            </span>
        </div>


        <div class="form-group has-feedback" :class="errors.messages.name ? 'has-error' : ''">
            <input type="text" class="form-control" placeholder="Username" v-model="name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="help-block" v-if="errors.messages.hasOwnProperty('name')">
                <strong>{{ errors.messages.name }}</strong>
            </span>
        </div>

         <div class="form-group has-feedback" :class="errors.messages.phone ? 'has-error' : ''">
            <input type="text" class="form-control" placeholder="Username" v-model="phone">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="help-block" v-if="errors.messages.hasOwnProperty('phone')">
                <strong>{{ errors.messages.phone }}</strong>
            </span>
        </div>
            
         </div>
      </perfect-scrollbar>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="$emit('close')">Close</button>
        <button type="submit" class="btn btn-primary" >Save</button>
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
                        username:'',
                        name:'',
                        email:'',
                        phone:'',
                        nip:'',
                        daerah_id:'',
                        password:'',
                        password_confirmation:'', 
                        leader_name:'',
                        leader_nip:'', 
                        agree:'',     
                    },
                }, 
                btnSubmit:true,
                btnLoading:false,
                username:'',
                password:'',
                password_confirmation:'',
                name:'',
                email:'',
                phone:'',
                nip:'',
                daerah_id:'',
                leader_name:'',
                leader_nip:'',
                loading:true,
                views:false,
               name:"",
               status:"Y", 
               
            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
        },
        mounted() {
             this.loading = false;
             this.views = true; 
        },
        computed: {
             base_url() {
                return BASE_URL;
            }, 
             
        },
        components: {
          
        },
        methods: {
          Cancel(){
             this.$router.push({path:"/"+ this.URL_Segment})
          },
          RequestPost(){
             
              const self = this; 
                let urlBase="";
                let formData = new FormData();
                formData.append("name", self.name);
                formData.append("status", self.status);
               
                
                
                urlBase = axios.post(BASE_URL+"/api/"+  self.URL_Segment +"/add", formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Simpan",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
                                   self.$router.push({path:"/"+ this.URL_Segment})
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
   