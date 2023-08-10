require('../../bootstrap');



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

        const list  = localStorage.getItem('root_vue'); 
        const Apps  = localStorage.getItem('apps');

        const path = JSON.parse(list);

        const AppsName = Apps+' | ';
        const BodyLogin = "login-page";
        const BodyDashboard1 = "skin-default";
        const BodyDashboard2 = "sidebar-mini";
        var data2 = [];
        if(path !=null)
        {
            console.log(path)
            for(var i=0; i< path.length; i++)
            {
                data2.push({
                   name:path[i].name,
                   path:path[i].path_vue,
                   props:{ Apps: AppsName + path[i].name,'Title':path[i].name,'URL_Segment':path[i].path_api },
                   component: require('./components/'+ path[i].foldername +'/'+ path[i].filename +'.vue').default 
                });

            }  
        }else{
            
          localStorage.removeItem('menu');
         
          localStorage.removeItem('menu_sidebar');
          localStorage.removeItem('user_sidebar');
          localStorage.removeItem('apps');
          document.cookie = 'token' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          document.cookie = 'access' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          window.location.href = BASE_URL+ '/login';

        }    
        
                 
        var data1 = 
        [
              {
                path: "/",
                redirect: "/dashboard",
                props: { BodyLogin:BodyLogin,BodyDashboard1:BodyDashboard1,BodyDashboard2:BodyDashboard2 },
                component: require('./components/layout/LayoutPrivate.vue').default,
                children: data2,
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



}else{
    
    const router = new VueRouter({
        mode:'history',
        routes: [
            {
                name: 'Login',
                path: '/login',
                props: { Apps:'Sidak | Login ',Body: 'login-page','URL_Segment':'login' },
                component: require('./components/auth/login.vue').default
            },
            {
                name: 'Register',
                path: '/register',
                props: { Apps:'Sidak | Register ',Body: 'register-page','URL_Segment':'register' },
                component: require('./components/auth/register.vue').default
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