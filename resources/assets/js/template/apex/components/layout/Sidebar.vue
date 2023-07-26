<template>
<div>
<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img :src="user.photo" class="img-circle"
                     :alt="user.fullname"/>
            </div>
            <div class="pull-left info">
         
                    <!-- <p>{{ user.fullname }}</p> -->
                    <p>{{ user.daerah_name }}</p>
       
                <a href="#"><i class="fa fa-circle text-success"></i> {{ user.status }}</a>
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
</div>
</template>
<script>
export default {
        props:["status"],
        data() {
            return {
 				lists:{},
                user:{},
                menu:{},
            
            }
        },
        
        mounted() {
           
            this.GetSidebar();
           // this.status_refresh = this.status;
        },
        computed: {
            // status() {
            //    console.log(status)
                 
            // }, 
        },
        components: {
          'Menu': require('./Menu.vue').default,   
        },
        methods: {
          Refresh(){
            this.GetSidebar();
            this.$emit('refresh',false);
         
            
         
           
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