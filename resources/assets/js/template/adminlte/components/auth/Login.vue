<template>
 <div class="wrapper">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <!--Login Page Starts-->
                    <section id="login" class="auth-height">
                        <div class="row full-height-vh m-0">
                            <div class="col-sm-12 d-flex align-items-center justify-content-center">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body auth-img">
                                            <div class="row m-0">
                                                <div class="col-lg-8 d-none d-lg-flex auth-img-bg width-732 pd-none">
                                                    <img src="/template/adminlte/img/gedung_bkpm.png" alt="" class="img-fluid"  >
                                                </div>
                                                <div class="col-lg-4 col-12 px-4 py-3 width-365">
                                                    
                                                    <div class="pull-left full pd-top-40">
                                                      <div class="login-center-bkpm">  
                                                        <img src="/template/adminlte/img/logo_bpkm.png" alt="" class="img-fluid"  >
                                                      </div>  
                                                    </div>

                                                    <div class="pull-left full pd-top-40">
                                                      <div class="login-center-sidak">  
                                                        <img src="/template/adminlte/img/logo_sidak.png" alt="" class="img-fluid"  >
                                                      </div>  
                                                    </div>

                                                    <div class="pull-left full pd-bottom-10">
                                                       <h3 class="text-capitalize text-center text-bold">Selamat Datang</h3>
                                                    </div> 

                                                    <form role="form"  method="post"  @submit.prevent="postData"> 

                                                        <div class="pull-left full form-group has-feedback " :class="errors.messages.username ? 'has-error' : ''">
                                                            <label class="text-capitalize color-dark-blue">Username </label>
                                                            <input type="text" class="form-control mb-3 border-radius-10" v-model="username" placeholder="Username">

                                                            <span class="help-block" v-if="errors.messages.hasOwnProperty('username')">
                                                                <strong>{{ errors.messages.username }}</strong>
                                                            </span>
                                                        </div>

                                                        <div class=" pull-left full form-group has-feedback"  :class="errors.messages.password ? 'has-error' : ''">

                                                            <label class="text-capitalize color-dark-blue">Password </label> 
                                                            <input type="password"  v-model="password" class="form-control mb-2 border-radius-10" placeholder="Password">
                                                            
                                                            <span class="help-block" v-if="errors.messages.hasOwnProperty('password')">
                                                                <strong>{{ errors.messages.password }}</strong>
                                                            </span>
                                                        </div>

                                                        <div class="pull-left full form-group">
                                                            <a href="#" class="pull-right">Lupa Password?</a>
                                                        </div> 

                                                        <div class="pull-left full form-group mgn-top-bottom-10">
                                                            <button type="submit" v-show="btnSubmit"  class="btn btn-primary btn-block btn-flat border-radius-20">Masuk</button>
                                                            <button v-show="btnLoading" type="button" class="btn btn-default btn-block btn-flat border-radius-20"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Proses</button>
                                                        </div> 

                                                    </form>

                                                    <div class="pull-left full pd-copyright">
                                                                    <p class="text-center  color-grey-light  font-sm-1 text-bold-600">Copyright by BKPM</p>

                                                                    <p class="text-center color-grey  font-sm-0 text-bold-600">Version 2.0</p>
                                                    </div>
                                                    

                                                 
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
            <!-- END : End Main Content-->
        </div>
    </div>
</template>

<script>

   export default {
        
        props:["Apps","Body","URL_Segment"],
        data() {
            return {
                errors: {
                    messages: {
                        username:'',
                        password:'',        
                    },
                }, 
                btnSubmit:true,
                btnLoading:false,
                username:'admin',
                password:'D4lak2021',
                logo:'images/profile/511522-20211006052626.png',
                
            }
        },
        
        mounted() {
          
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
                urlBase = axios.post(BASE_URL+'/api/'+ self.URL_Segment +'/auth', formData);
                urlBase
                .then((response) => {
                    
                   if(response.data.status===true)
                   {
                            this.$cookies.set('access',response.data.access);
                            this.$cookies.set('token',response.data.token);
                            localStorage.setItem('apps', response.data.apps);  
                            localStorage.setItem('root_vue', JSON.stringify(response.data.path));
                            localStorage.setItem('menu_sidebar', JSON.stringify(response.data.menu_sidebar));
                            localStorage.setItem('user_sidebar', JSON.stringify(response.data.user_sidebar));
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
.wrapper {
    position: relative;
    top: 0;
    height: 100%;
    overflow: hidden;
    margin:inherit!important;
    min-height: calc(100vh - 3.98rem);
}

.wrapper .main-panel {
    margin: 0;
    padding: 0;
}

.wrapper .main-panel .main-content {
    padding: 0 !important;
    margin: 0;
}

.wrapper .content-overlay {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: calc(100% + 54px);
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    cursor: pointer;
    transition: all 0.7s;
    z-index: -1;
    visibility: visible;
}
.wrapper .main-panel .main-content .content-wrapper {
    padding: 0;
    margin-left: inherit!important;
    z-index:inherit!important;
    background-color: inherit!important;
}

.auth-height {
    overflow: auto;
}

.full-height-vh {
    height: 100vh !important;
    height: calc(var(--vh, 1vh) * 100) !important;
}
.m-0 {
    margin: 0 !important;
}
.align-items-center {
    align-items: center !important;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.justify-content-center {
    justify-content: center !important;
}

.width-732{
    width: 732px!important;
}

.width-365{
    width: 365px!important;
}

.card {
    margin: 15px 0;
    box-shadow: -8px 8px 14px 0 rgba(25, 42, 70, 0.11);
}
.overflow-hidden {
    overflow: hidden !important;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, 0.125);
    border-radius:0px;
}
.auth-page .auth-img {
    padding: 0;
}
.card-body {
    flex: 1 1 auto;
    min-height: 1px;
   
}


.auth-page .auth-img .auth-img-bg {
    background-color: #f5f5f5;
}
.p-3 {
    padding: 1.5rem !important;
}
.img-fluid {
    width: 100%;
    height: 100%;
}

.pl-4, .px-4 {
    padding-left: 2.25rem !important;
}
.pr-4, .px-4 {
    padding-right: 2.25rem !important;
}
.pb-3, .py-3 {
    padding-bottom: 1.5rem !important;
}
.pt-3, .py-3 {
    padding-top: 1.5rem !important;
}


.mb-2, .my-2 {
    margin-bottom: 0.75rem !important;
}

.mb-3, .my-3 {
    margin-bottom: 1.5rem !important;
}


.login-center-bkpm{
    margin: 0px auto;
    width: 27%;
}
.login-center-sidak {
    margin: 0px auto;
    width: 45%;
}
.pd-top-40 {
    padding: 40px 0px 0px;
}
.pd-bottom-10 {
    padding: 0px 0px 10px;
}
.pd-top-bottom-20 {
    padding: 20px 0px;
}

.form-group{
    margin: 0px!important;
    padding: 0px 30px;
}
.mgn-top-bottom-10{
  margin: 10px 0px!important;
}

.pd-copyright{
    padding: 125px 0px 0px;
}
.color-grey-light{
    color: #616060;
}
.font-sm-0 {
    font-size: 0.9rem ;
}
.font-sm-1 {
    font-size: 1rem ;
}
.text-bold-600{
    font-weight: 600;
}
</style>

