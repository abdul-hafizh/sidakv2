<template>
<div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">

                <img :src="logo" class="img-logo" />
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
               
                  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                  <div class="mt-10 mc-15">
                    <button type="button" @click="logout" class="btn btn-danger btn-flat"><i aria-hidden="true" class="fa fa-sign-out"></i> Logout</button>
                  </div>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
         <div is="Sidebar" :status="status" @refresh="Refresh"></div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
              <router-view @updateMenu="RefreshMenu"></router-view>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © {{ year }} <a color="yellow" href="#">Company</a>.</strong> All rights reserved.
        </footer>

    </div>
</template>
<script>
export default {
        props:["BodyLogin","BodyDashboard1","BodyDashboard2"], 
        data() {
            return {
 				year: new Date().getFullYear(),
                logo:'',
                status:false,
                update_menu:null,
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
                self.logo = response.data.result.logo;
                
              
            }).catch((error) => {
                console.log(error);
               
            });

          },
          logout(){
              
              document.cookie = 'token' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
              document.cookie = 'access' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
              window.location.href = BASE_URL+ '/login';
          }

        }
    }

</script>