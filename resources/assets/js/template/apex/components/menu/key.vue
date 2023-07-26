<template>
 <!-- Modal content-->
<div class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" @click="$emit('close')">&times;</button>
        <h4 class="modal-title">Save Role Menu</h4>
      </div>

      <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
      <div class="modal-body">
        
            <div class="form-group" :class="errors.messages.password ? 'has-error' : ''">
                 <label>Password Access:</label>
                 <input v-model="password" type="password" class="form-control" >
                <span class="help-block" v-if="errors.messages.hasOwnProperty('password')">
                    <strong>{{ errors.messages.password }}</strong>
                </span>
            </div>
 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" @click="$emit('close')">Close</button>
        <button type="submit" class="btn btn-warning">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
</template>
<script>
   export default {
        props:["Apps","role_id","tasks","URL_Segment"],
        
        data() {
            return {
                errors: {
                    messages: {
                        password:'',
                             
                    },
               }, 
               
               
               password:'D4lak2021',
              
               

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
          
         
          RequestPost(){
            
                const self = this; 
                let urlBase="";
                let formData = new FormData();
                formData.append('password', self.password);
              
                urlBase = axios.post(BASE_URL+'/api/'+ self.URL_Segment +'/role/keys', formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true)
                    {
                       let data = { id:this.role_id,tasks:this.tasks };
                       this.$emit('saving',data);
                       this.$emit('close');
                    }    
                   
                
                }).catch((error) => {
                   
                    self.errors = error.response.data;
                     console.log( self.errors)
                    
                });


          }, 

        }
    }
   
</script>