require('./../../bootstrap');



//require('dotenv').config({ path: require('./../bootstrap') })
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueSwal from 'vue-swal';
import Vuex from 'vuex';
import VueCookies from 'vue-cookies';
import ToggleButton from 'vue-js-toggle-button';
import excel from 'vue-excel-export'; 

import Role from './Role.js'; 

import PerfectScrollbar from 'vue2-perfect-scrollbar'
import 'vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css'

Vue.use(VueSwal);
Vue.use(VueCookies);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(ToggleButton);
Vue.use(excel);
Vue.use(PerfectScrollbar)

Vue.component('loading-block', require('./components/layout/LoadingBlock.vue').default);

const Roles = new Role();
const access = Roles.GetCookie('access');

  if(access !=null)
  {    
    let formData = new FormData();
    formData.append('access', access);
    axios.post('/api/role/check', formData).then((response) => {
     
   
            const AppsName = response.data.apps +' | ';
           
           
            const BodyDashboard1 = "skin-yellow";
            const BodyDashboard2 = "sidebar-mini";

            var list = response.data.result; 
            var data2 = [];
            var data3 = [];
            var data4 = [];

            for(var i=0; i< list.length; i++)
            {
                 
                  if(list[i].path_vue !='')
                  {
                        data2.push({
                           name:list[i].name,
                           path:list[i].path_vue,
                           props:{ Apps: AppsName + list[i].name,'Title':list[i].name,'URL_Segment':list[i].slug },
                           component: require('./components/'+ list[i].slug +'/'+ list[i].filename +'.vue').default 
                        });

                   }else{
                          for(var x=0; x< list[i].tasks.length; x++)
                          {
                              data3.push({
                                 name:list[i].tasks[x].name,
                                 path:list[i].tasks[x].path_vue,
                                 props:{ Apps: AppsName + list[i].tasks[x].name,'Title':list[i].tasks[x].name,'URL_Segment':list[i].tasks[x].slug},
                                 component: require('./components/'+ list[i].tasks[x].slug +'/'+ list[i].tasks[x].filename +'.vue').default,
                              });

                                if(list[i].tasks[x].tasks.length !=0)
                                {
                                    for(var y=0; y< list[i].tasks[x].tasks.length; y++)
                                    {
                                   
                                        data4.push({
                                             name:list[i].tasks[x].tasks[y].name,
                                             path:list[i].tasks[x].tasks[y].path_vue,
                                             props:{ Apps: AppsName + list[i].tasks[x].tasks[y].name,'Title':list[i].tasks[x].tasks[y].name,'URL_Segment':list[i].tasks[x].slug},
                                             component: require('./components/'+ list[i].tasks[x].slug +'/'+ list[i].tasks[x].tasks[y].filename +'.vue').default,
                                        });

                                    }

                                }    


                               
                          } 

                   }  

            }  

                //  var addRole = [{
                //     name: "Add Role",
                //     path: "/role/add",
                //     props: { Apps:AppsName +'Add Role','Title':'Add Role','URL_Segment':'role'},
                //     component: require('./../components/role/add.vue').default,
                // }];

                var merge = [...data2,...data3,...data4];
                
                var data1 = 
                [
                      {
                        path: "/",
                        redirect: "/dashboard",
                        props: { },
                        component: require('./components/layout/LayoutPrivate.vue').default,
                        children: merge,
                      }

                ];

           const data = { mode:'history',routes: data1 };
           const router = new VueRouter(data);
           new Vue({ 
                router,
                components : {},
                mounted() {},
                methods: {}
            }).$mount('#app');

     
       
    }).catch((error) => {
      
       return error.data;
    })

  }else{

        const router = new VueRouter({
            mode:'history',
            routes: [
                {
                    name: 'Login',
                    path: '/login',
                    props: { Apps:'Sidak | Login ',Body: '1-column blank-page' },
                    component: require('./components/auth/Login.vue').default
                },
 
            ],
        });


       new Vue({ 
            router,
            components : {},
            mounted() {},
            methods: {}
        }).$mount('#app');

  }


// const AppsName = 'Sidak | ';
// const Login = 'Login';
// const BodyLogin = "login-page";
// const BodyDashboard1 = "skin-yellow";
// const BodyDashboard2 = "sidebar-mini";
 
// const router = new VueRouter({
//     mode:'history',
//     routes: [
//         {
//             name: 'Login',
//             path: '/login',
//             props: { Apps:Login,Body:BodyLogin },
//             component: require('./components/auth/Login.vue').default
//         },
        
//         {
//             path: "/",
//             redirect: "/dashboard",
//             props: { },
//             component: require('./components/layout/LayoutPrivate.vue').default,
//             children: [
//                 {
//                     name: "Dashboard",
//                     path: "/dashboard",
//                     props: { Apps: AppsName + 'Dashboard'},
//                     component: require('./components/dashboard/index.vue').default,
//                 },
//                 {
//                     name: "Role",
//                     path: "/role",
//                     props: { Apps: AppsName + 'Role','Title':'Role','URL_Segment':'role'},
//                     component: require('./components/role/index.vue').default,
//                 },
//                 {
//                     name: "Add Role",
//                     path: "/role/add",
//                     props: { Apps:AppsName +'Add Role','Title':'Add Role','URL_Segment':'role'},
//                     component: require('./components/role/add.vue').default,
//                 },
//                 {
//                     name: "Edit Role",
//                     path: "/role/edit/:id",
//                     props: { Apps:AppsName +'Edit Role','Title':'Edit Role','URL_Segment':'role'},
//                     component: require('./components/role/edit.vue').default,
//                 },

//                 {
//                     name: "Setting Apps",
//                     path: "/apps",
//                     props: { Apps:AppsName +'Setting Apps','Title':'Apps','URL_Segment':'setting-apps'},
//                     component: require('./components/apps/index.vue').default,
//                 },
                
//                 {
//                     name: "Menu",
//                     path: "/menu",
//                     props: { Apps:AppsName +'Menu','Title':'Menu','URL_Segment':'menu'},
//                     component: require('./components/menu/index.vue').default,
//                 },
               

//                 {
//                     name: "Periode",
//                     path: "/periode",
//                     props: { Apps:AppsName +'Periode','Title':'Periode','URL_Segment':'periode'},
//                     component: require('./components/periode/index.vue').default,
//                 },

//                 {
//                     name: "Add Periode",
//                     path: "/periode/add",
//                     props: { Apps:AppsName +'Add Periode','Title':'Add Periode','URL_Segment':'periode'},
//                     component: require('./components/periode/add.vue').default,
//                 },
//                 {
//                     name: "Edit Periode",
//                     path: "/periode/edit/:id",
//                     props: { Apps:AppsName +'Edit Periode','Title':'Edit Periode','URL_Segment':'periode'},
//                     component: require('./components/periode/edit.vue').default,
//                 },

//                 {
//                     name: "Perencanaan",
//                     path: "/perencanaan",
//                     props: { Apps:AppsName +'Perencanaan','Title':'Perencanaan','URL_Segment':'perencanaan'},
//                     component: require('./components/perencanaan/index.vue').default,
//                 },

//                 {
//                     name: "Add Perencanaan",
//                     path: "/perencanaan/add",
//                     props: { Apps:AppsName +'Add Perencanaan','Title':'Add Perencanaan','URL_Segment':'perencanaan'},
//                     component: require('./components/perencanaan/add.vue').default,
//                 },
//                 {
//                     name: "Edit Perencanaan",
//                     path: "/perencanaan/edit/:id",
//                     props: { Apps:AppsName +'Edit Perencanaan','Title':'Edit Perencanaan','URL_Segment':'perencanaan'},
//                     component: require('./components/periode/edit.vue').default,
//                 },


//                  {
//                     name: "Pengawasan",
//                     path: "/pengawasan",
//                     props: { Apps:AppsName +'Pengawasan','Title':'Pengawasan','URL_Segment':'pengawasan'},
//                     component: require('./components/pengawasan/index.vue').default,
//                 },

//                 {
//                     name: "Add Pengawasan",
//                     path: "/pengawasan/add",
//                     props: { Apps:AppsName +'Add Pengawasan','Title':'Add Pengawasan','URL_Segment':'pengawasan'},
//                     component: require('./components/pengawasan/add.vue').default,
//                 },
//                 {
//                     name: "Edit Pengawasan",
//                     path: "/pengawasan/edit/:id",
//                     props: { Apps:AppsName +'Edit Pengawasan','Title':'Edit Pengawasan','URL_Segment':'pengawasan'},
//                     component: require('./components/pengawasan/edit.vue').default,
//                 },


//             ],
            
//         },

       
       
//     ],
// });



// new Vue({
//     router,
//     components : {
        
//     },
//     mounted() {
//     },
//     methods: {
//     }
// }).$mount('#app');
