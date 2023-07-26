<template>
<div class="wrapper">
    <div class="main-panel">    
        <div class="main-content">
                    <div class="content-overlay"></div>
                    <div class="content-wrapper">
                        <!--Login Page Starts-->
                           <section id="login" class="auth-height">
                            <div class="row full-height-vh m-0">
                                <div class="col-12 d-flex align-items-center justify-content-center">
                                    <div class="card overflow-hidden">
                                        <div class="card-content">
                                            <div class="card-body auth-img pd-none">
                                                <div class="row m-0">

                                                    <div class="col-lg-8 d-none d-lg-flex align-items-center auth-img-bg pd-none">
                                                        <img src="/template/apex/img/bkpm/gedung_bkpm.png" alt="" class="img-fluid" width="700" height="">
                                                    </div>
                                                    <div class="col-lg-4 col-12  px-4 py-3 pd-none">
                                                    
                                                    <form role="form" class="pd-input-login"  method="post"  @submit.prevent="postData">   
                                                        <div class="pd-module-login">
                                                            <div class="ps-12">
                                                            
                                                                <div class="mb-2 pd-top-bottom-39 card-title">
                                                                     <div class="login-center-bkpm">
                                                                       <img src="/template/apex/img/bkpm/logo_bpkm.png" alt="" class="logo-bkpm-login" >
                                                                     </div>
                                                                </div>
                                                                
                                                                <span class="mb-2  pd-top-bottom-20 card-title">
                                                                   <div class="login-center-sidak"> 
                                                                     <img src="/template/apex/img/bkpm/logo_sidak.png" alt="" class="logo-sidak-login" >
                                                                   </div>  
                                                                </span>

                                                                <h4 class="mb-2 font-medium-5 card-title text-center text-bold-800 pd-bottom-20">Selamat Datang</h4>

                                                                <label class="text-capitalize color-dark-blue">Username </label>
                                                                <input type="text" class="form-control mb-3 border-radius-10" v-model="username" name="username" value="" placeholder="Username">
                                                                
                                                                <label class="text-capitalize color-dark-blue">Password </label>
                                                                <input type="password" class="form-control mb-2 border-radius-10" v-model="password" placeholder="Password" name="password">

                                                                <div class="d-sm-flex justify-content-between mb-3 font-small-2">
                                                            
                                                                     <span></span>
                                                                     <a href="#" class="float-right">Lupa Password?</a>
                                                                </div>

                                                                <div class="d-flex justify-content-between flex-column btn-mobile">
                                                           

                                                                    <button type="submit" v-show="btnSubmit"  class="btn btn-primary btn-large text-bold-500 border-radius-20">Masuk</button>
                                                                    <button v-show="btnLoading" type="button" class="btn btn-primary btn-large border-radius-20 "><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>

                                                                    
                                                                </div>

                                                                <span class="mb-2  pd-copyright card-title  float-left">
                                                                    <p class="text-center mgn-none color-grey-light  font-sm-1 text-bold-600">Copyright by BKPM</p>

                                                                    <p class="text-center color-grey mgn-none font-sm-0 text-bold-600">Version 2.0</p>
                                                                </span>

                                                               
                                                            </div>
                                                            
                                                        </div>   
                                                             
                                                    </form>   
                                                           
                                                          
                                                       
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--Login Page Ends-->
                    </div>
        </div>
    </div>  
</div>         
</template>

<script>

   export default {
        
        props:["Apps","Body"],
        data() {
            return {
                errors: {
                    messages: {
                        identity:'',
                        password:'',        
                    },
                }, 
                btnSubmit:true,
                btnLoading:false,
                username:'admin',
                password:'D4lak2021',
               
                
            }
        },
        
        mounted() {
         
        },
        created () {
           
           // document.body.classList.add(this.Body);
            document.title = this.Apps;
           // this.getLogo();
           
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
             
        },
        components: {
          
        },
        methods: {
          
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

