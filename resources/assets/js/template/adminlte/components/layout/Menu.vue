<template>
<div>
  <li class="header main-nav">MAIN NAVIGATION</li>
  
 <!--  <li class="treeview" v-for="(menu,index) in menus" :key="menu.slug" @click="ShowActive(menu.slug)" :class="active_menu === menu.status ? 'active' : ''"  v-if="menu.path_web !=''">
   <router-link :to="{path: menu.path_web }" >
    <i v-if="menu.type_icon != 'file'" :class="menu.icon" ></i>
    <img class="sidebar-icon" v-else :src="menu.icon">
    <span>{{ menu.name }}</span>
    <span class="pull-right-container" v-if="menu.tasks.length !=0">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
   </router-link>

  </li>

  <li v-else class="treeview" @click="ShowSubMenu(menu.slug)" :class="active_menu === menu.status ? 'active ' +  menuopen  : ''">
     <router-link to="" >
      <i v-if="menu.type_icon != 'file'" :class="menu.icon" ></i>
      <img class="sidebar-icon" v-else :src="menu.icon">
      <span>{{ menu.name }}</span>
      <span class="pull-right-container" v-if="menu.tasks.length !=0">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
    </router-link>

    <ul class="treeview-menu" :style="{
        display: submenu ? 'block' : 'none',
       
      }">
      <li v-for="mns in menu.tasks" :key="mns.id">
        <router-link :to="{path: mns.path_web }" >
          <i v-if="mns.type_icon != 'file'" :class="mns.icon"></i>
          <img class="sidebar-icon" v-else :src="mns.icon">
           {{ mns.name }}
        </router-link>
      </li>
    </ul>

  </li>  
   -->

  <li class="treeview" v-for="menu in menus" :key="menu.id"   :class="activemenu === menu.no ? 'menu-open active' : ''" >
    <router-link :to="{path: menu.path_vue }" >
    <i :class="menu.icon"></i>
    <span>{{ menu.name }}</span>
    <span class="pull-right-container" v-if="menu.count !=''">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
    </router-link>

    <ul class="treeview-menu" :class="submenu === menu.no ? 'd-block' : ''">
      <li v-for="mns in menu.tasks" :key="mns.id">
        <router-link :to="{path: mns.path_vue }" >
          <i :class="mns.icon"></i> {{ mns.name }}</router-link>
      </li>
    </ul>

  </li>



  


</div>
</template>
<script>
    
    export default {
        props:["menus"],
        
        data() {
            return {
                submenu:'',
                activemenu:'',
            }
        },
          mounted() {
             
           
        },
       
        components: {
        },
        methods: {
         
           ShowActive(no){

                 let find = this.menus.find(o => o.no == no); 
                 this.activemenu = find.no;
                 if(find.count>0)
                 {
                   //this.submenu = find.no;
                 }   
                
                 
           }
            
           
        }
    }

</script>