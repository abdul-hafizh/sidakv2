<template>

<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
            <div class="logo">
              <div class="pd-logo-sidebar pull-left">  
                    <a href="#"><img :src="logo" class="img-logo" /></a>
              </div>

              <div class="toogle-menu pull-left d-sm-block ">
                 <a href="#"  class="sidebar-toggle" data-toggle="push-menu" role="button"><i class="fa fa-chevron-left" ></i></a>
              </div>  

            </div>

          
               
           

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left full pd-img-sidebar">
                <div class="mgn-center-img" :class="picture">
                        <img :src="user.photo" class="img-circle "
                         :alt="user.fullname"/>
                </div>  
               
            </div>
            <div class="pull-left full info">
         
                <div class="text-center">
                    <p>Welcome Back</p>
                    <p class="font-bold">{{ user.daerah_name }}</p>
                </div>
               
            </div>
        </div>

      
        
        <!-- Sidebar Menu -->
        <div class="menus">
         <ul is="Menu" :menus="menu"  class="sidebar-menu tree" data-widget="tree">
         </ul>
         <i class="icon fa fa-refresh" v-if="status == true" @click="Refresh()"></i>
        </div>


       
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

</template>
<script>
export default {
        props:["status","marrow","logo"],
        data() {
            return {
 				lists:{},
                user:{},
                menu:{},
                picture:'picture-mini',
                
            }
        },
        
        mounted() {
           
            this.GetSidebar();

           // this.status_refresh = this.status;
        },
        watch: { 
            marrow: function(newVal) { // watch it
               if(newVal == true)
               {
                this.picture = 'picture-mini';
               }else{
                 this.picture = 'picture-lg';
               } 
               
            }
        },
        computed: {
           
        },
        components: {
          'Menu': require('./Menu.vue').default,   
        },
        methods: {
          Refresh(){
            this.GetSidebar();
            this.$emit('refresh',false);
         
          },
          getArrow(arrow){
            if(arrow !='fa-chevron-right')
            {
               this.arrow = 'fa-chevron-right';
            }else{
               this.arrow = 'fa-chevron-left';
            }    
            
          },
          GetSidebar(){
            const self = this;
           // const config = {
                      //  headers: { 'Authorization': 'bearer '+ this.cookie }
               // }
            let listUrl = "";
            listUrl = BASE_URL + '/api/user/menu';    
            axios.get(listUrl).then((response) => {
                self.lists = response.data;
                self.user = self.lists.user;
                self.menu = self.lists.menu;

                // var data = [];
                // data =  JSON.parse(self.menu);

                // self.menu = data;

                 
            }).catch((error) => {
               // console.log(error);
               // $cookies.remove('token');
               // window.location.href = BASE_URL+ '/login';
                self.loading = false;
            });

          },
        }
    }

</script>