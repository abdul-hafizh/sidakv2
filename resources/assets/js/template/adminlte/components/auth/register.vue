<template>
<div class="register-box">
<div class="register-logo">
<a href="#"><img :src="logo" width="200"></a>
</div>
<div class="register-box-body">
<p class="login-box-msg">Register daerah untuk SIDAK</p>

<form  method="post" @submit.prevent="postData">

<div class="form-group has-feedback" :class="errors.messages.username ? 'has-error' : ''">
    <input type="text" class="form-control" placeholder="Username" v-model="username">
    <span class="glyphicon glyphicon-user form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('username')">
        <strong>{{ errors.messages.username }}</strong>
    </span>

</div>

<div class="form-group has-feedback" :class="errors.messages.name ? 'has-error' : ''">
    <input type="text" class="form-control" placeholder="Nama Lengkap" v-model="name">
    <span class="glyphicon glyphicon-star form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('name')">
        <strong>{{ errors.messages.name }}</strong>
    </span>

</div>

<div class="form-group has-feedback" :class="errors.messages.nip ? 'has-error' : ''">
    <input type="text" class="form-control" placeholder="NIP" v-model="nip">
    <span class="glyphicon glyphicon-education form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('nip')">
        <strong>{{ errors.messages.nip }}</strong>
    </span>

</div>

<div class="form-group has-feedback" :class="errors.messages.email ? 'has-error' : ''">
    <input type="email" class="form-control" placeholder="Email" v-model="email">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('email')">
        <strong>{{ errors.messages.email }}</strong>
    </span>

</div>

<div class="form-group has-feedback" :class="errors.messages.phone ? 'has-error' : ''">
    <input type="text" class="form-control" placeholder="No Telp" v-model="phone">
    <span class="glyphicon glyphicon-phone form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('phone')">
        <strong>{{ errors.messages.phone }}</strong>
    </span>

</div>

<div class="form-group has-feedback" :class="errors.messages.leader_name ? 'has-error' : ''">
    <input type="text" class="form-control" placeholder="Penanggung Jawab" v-model="leader_name">
    <span class="glyphicon glyphicon-user form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('leader_name')">
        <strong>{{ errors.messages.leader_name }}</strong>
    </span>
</div>

<div class="form-group has-feedback" :class="errors.messages.leader_nip ? 'has-error' : ''">
    <input type="text" class="form-control" placeholder="NIP Penanggung Jawab" v-model="leader_nip">
    <span class="glyphicon glyphicon-education form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('leader_nip')">
        <strong>{{ errors.messages.leader_nip }}</strong>
    </span>

</div>

<div class="form-group has-feedback" :class="errors.messages.daerah_id ? 'has-error' : ''">
    <model-select class="form-control" v-model="daerah_id" :options="lists"  
             placeholder="Pilih Daerah">
    </model-select>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('daerah_id')">
        <strong>{{ errors.messages.daerah_id }}</strong>
    </span>
   
</div>

<div class="form-group has-feedback" :class="errors.messages.password ? 'has-error' : ''">
    <input type="password" class="form-control" placeholder="Password" v-model="password">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

    <span class="help-block" v-if="errors.messages.hasOwnProperty('password')">
        <strong>{{ errors.messages.password }}</strong>
    </span>
</div>

<div class="form-group has-feedback" :class="errors.messages.password_confirmation ? 'has-error' : ''">
<input type="password" class="form-control" placeholder="Retype password" v-model="password_confirmation">
<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
<span class="help-block" v-if="errors.messages.hasOwnProperty('password_confirmation')">
        <strong>{{ errors.messages.password_confirmation }}</strong>
    </span>
</div>


<div class="row">
<div class="col-xs-8">
<div class="checkbox icheck">
    <label>
       
            <input id="register" type="checkbox" v-model="agree" value=""> I agree to the <a href="#">terms</a>
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
                agree:false,  
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
                formData.append('name', self.name);
                formData.append('nip', self.nip);
                formData.append('email', self.email);
                formData.append('phone', self.phone);
                formData.append('leader_name', self.leader_name);
                formData.append('leader_nip', self.leader_nip);
                formData.append('daerah_id', self.daerah_id);
                formData.append('password', self.password);
                formData.append('password_confirmation', self.password_confirmation);

                urlBase = axios.post(BASE_URL+'/api/' + this.URL_Segment, formData);
                urlBase
                .then((response) => {
                    

                
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



