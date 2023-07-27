<template>
<div class="register-box">
<div class="register-logo">
<a href="#"><img :src="logo" width="200"></a>
</div>
<div class="register-box-body">
<p class="login-box-msg">Register daerah untuk SIDAK</p>

<form action="" method="post">

<div class="form-group has-feedback">
    <input type="text" class="form-control" placeholder="Username">
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
    <input type="text" class="form-control" placeholder="Nama Lengkap">
    <span class="glyphicon glyphicon-star form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
    <input type="email" class="form-control" placeholder="Email">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
    <input type="text" class="form-control" placeholder="No Telp">
    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
    <input type="text" class="form-control" placeholder="NIP">
    <span class="glyphicon glyphicon-education form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
    <model-select class="form-control" v-model="daerah_id" :options="lists"  
             placeholder="Pilih Daerah">
    </model-select>
   
</div>

<div class="form-group has-feedback">
    <input type="password" class="form-control" placeholder="Password">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
<input type="password" class="form-control" placeholder="Retype password">
<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
</div>


<div class="row">
<div class="col-xs-8">
<div class="checkbox">
    <label>
       
            <input type="checkbox"> I agree to the <a href="#">terms</a>
    </label>
</div>
</div>

<div class="col-xs-4">
<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
</div>

</div>
</form>

<a @click="GetLogin()" class="text-center">Sudah Memiliki Akun</a>
</div>

</div>
</template>

<script>
   import { ModelSelect } from 'vue-search-select';
   import 'vue-search-select/dist/VueSearchSelect.css';
   export default {
        
        props:["Apps","Body","URL_Segment"],
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
                    },
                }, 
                btnSubmit:true,
                btnLoading:false,
                username:'admin',
                password:'D4lak2021',
              
                name:'',
                email:'',
                phone:'',
                nip:'',
                daerah_id:'',
                lists:[],
                logo:'template/adminlte/img/logo_sidak.png',
                
            }
        },
        
        mounted() {
           this.getDaerah();
        },
        created () {
           
            document.body.classList.add(this.Body);
            document.title = this.Apps;
           // this.getLogo();
           
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
          getDaerah(){

            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/'+ this.URL_Segment +'/daerah';   
            axios.get(listUrl).then((response) => {
                self.lists = response.data.result;
                
                
                
            }).catch((error) => {
                console.log(error);
               
            });
             
          },
          GetLogin(){
             this.$router.push({path:'/login'})
          },
          postData(){
                const self = this; 
                let urlBase="";
                let formData = new FormData();
                self.btnSubmit = false;
                self.btnLoading = true;
                formData.append('username', self.username);
                formData.append('password', self.password);
                urlBase = axios.post(BASE_URL+'/api/auth/login', formData);
                urlBase
                .then((response) => {
                    
                   if(response.data.status===true)
                   {
                            this.$cookies.set('access',response.data.access);
                            this.$cookies.set('token',response.data.token);
                           
                            window.location.href = BASE_URL+ '/dashboard'; 
                              

                                              
                           
                   }
                   
               
                
                }).catch((error) => {
                    //console.log(error)
                    self.errors = error.response.data;
                    self.btnSubmit = true;
                    self.btnLoading = false;
                });

          }

        }
    }
   
</script>
<style>
.register-box {
    width: 360px!important;
    margin: 7% auto!important;
}
.register-page {
    background: #dbdbdb!important;
}
.form-group {
     margin: 0px 0px 15px!important; 
    padding: 0px!important; 
}

</style>

