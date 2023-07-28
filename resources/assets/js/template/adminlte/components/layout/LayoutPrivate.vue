<template>
<div>
 <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
         
                <a href="#" class="logo">
                    
                   <span class="logo-mini">
                      <img :src="logo_sm" class="full" />
                   </span> 
                   <span class="logo-lg">
                       <img :src="logo_lg" class="full" /> 
                   </span> 
                </a>

          
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
               
                  <a href="#" class="sidebar-toggle pull-left" @click="getArrow(arrow)" data-toggle="push-menu" role="button">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </a>

                   <h3 class="pull-left padding-10-0 mgn-none">Data {{ title }}</h3>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                  <div class="mt-10 mc-15">
                    <button type="button" class="btn btn-primary margin-0-12-0-0 btn-flat border-radius-10"><i aria-hidden="true" class="fa fa-user"></i> Profile</button>

                    <button type="button" @click="logout" class="btn btn-danger btn-flat border-radius-10"><i aria-hidden="true" class="fa fa-sign-out"></i> Logout</button>
                  </div>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
         <div is="Sidebar" :status="status" :marrow="arrow" :logo="logo_lg"  @refresh="Refresh"></div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
              <router-view @updateMenu="RefreshMenu" @Title="GetTitle"></router-view>
        </div>

        <!-- Main Footer -->
       <!--  <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © {{ year }} <a color="yellow" href="#">Company</a>.</strong> All rights reserved.
        </footer> -->

    </div>
</div>
</template>
<script>
export default {
        props:["BodyLogin","BodyDashboard1","BodyDashboard2"], 
        data() {
            return {
 				year: new Date().getFullYear(),
                logo_lg:'',
                logo_sm:'',
                status:false,
                update_menu:null,
                arrow:true,
                title:'',
            }
        },
        created() {
           document.body.classList.remove(this.BodyLogin);
           document.body.classList.add(this.BodyDashboard1,this.BodyDashboard2);
           this.getLogo();
        },
        computed: {
           base_url() {
                return BASE_URL;
            },    
        },
        components: {
          'Sidebar': require('./Sidebar.vue').default,   
        },
        methods: {
          getArrow(){
                
            if(this.arrow ==true)
            {
               this.arrow = false;

            }else{
               this.arrow = true;
            }    
    
          },
          GetTitle(data){
            this.title = data;
          }, 
         
          RefreshMenu(data){
             this.status = data;
          },
          Refresh(data){
            this.status = false;
          },
          getLogo(){
            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + '/api/apps';    
            axios.get(listUrl).then((response) => {
                
                self.logo_lg = response.data.result.logo_lg;
                self.logo_sm = response.data.result.logo_sm;
        
              
            }).catch((error) => {
                console.log(error);
               
            });

          },
          logout(){
              localStorage.removeItem('menu');
              localStorage.removeItem('root_vue');
              localStorage.removeItem('menu_sidebar');
              localStorage.removeItem('user_sidebar');
              localStorage.removeItem('apps');
              document.cookie = 'token' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
              document.cookie = 'access' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
              window.location.href = BASE_URL+ '/login';
          }

        }
    }

</script>