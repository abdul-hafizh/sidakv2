<?php

namespace App\Http\Request;
use Auth;
use App\Helpers\GeneralHelpers;
use App\Helpers\GeneralPaginate;
use App\Helpers\ConfigHeader;
use Illuminate\Support\Str;
use App\Models\RoleMenu;
use App\Models\SettingApps;
use App\Models\Roles;
use App\Models\Action;
use App\Models\Pages;
use App\Http\Request\RequestSettingApps;
use App\Http\Request\RequestAuth;

class RequestMenuRoles 
{
   
  

   public static function Roles($id)
   {

       $RoleMenus = RoleMenu::where('role_id',$id)->first();
       if($RoleMenus !=null)
       {
          $data = json_decode(json_encode($RoleMenus->menu_json), FALSE);
          
       }else{
          $data = [];
       } 
       return $data;
   }

    public static function RoleTasks($array)
    {
        $result = array();
        if (isset($array)) {
            foreach ($array as $a => $value) {


                if (!$value->tasks) {
                   if($value->type !='menu')
                   { 
                      $result[] = array('name'=>$value->name,'slug'=>$value->slug,'type'=>$value->type,'foldername'=>$value->foldername,'filename'=>$value->filename,'path_web' => $value->path_web,'path_vue'=>$value->path_vue,'path_api'=>$value->path_api);
                   } 

                } else if($value->path_web && $value->tasks){
                    $result[] = array('name'=>$value->name,'slug'=>$value->slug,'type'=>$value->type,'foldername'=>$value->foldername,'filename'=>$value->filename,'path_web' => $value->path_web,'path_vue'=>$value->path_vue,'path_api'=>$value->path_api);

                    $result = array_merge($result, RequestMenuRoles::RoleTasks($value->tasks));


                } else {
                    $result = array_merge($result, RequestMenuRoles::RoleTasks($value->tasks));
                }


            }
        }
              
        $data = json_decode(json_encode($result), FALSE);
        return $data;

   }

    public static function ConvertMenu($data){

           $objectMenu = json_decode($data);
           $arr = array();
            if (isset($objectMenu)) {
                foreach ($objectMenu as $key => $value) 
                {
                   if($key ==0)
                   {
                     $active = true; 
                   }else{
                     $active = false;
                   }

                   $arr[$key]['active'] = $active;
                   $arr[$key]['id'] = $value->id;
                   $arr[$key]['name'] = $value->name;
                   $arr[$key]['slug'] = $value->slug;  
                   $arr[$key]['path_web'] = $value->path_web;
                   $arr[$key]['class'] = $value->class;
                   $arr[$key]['icon'] = $value->icon;
                   $arr[$key]['icon_menu'] = '';
                   $arr[$key]['icon_hover'] =  $value->icon_hover;
                   $arr[$key]['option'] = $value->option;
                   $arr[$key]['tasks'] =  RequestMenuRoles::secondaryMenu($value->tasks) ;       
                       
                }
            }     

            $result =  json_encode($arr);
            return json_decode($result);

   }

   public static function CheckMenuRole($menu)
   {
         $res = array(); 
         $active = ConfigHeader::GetMenuSlug($menu);
         foreach($menu  as $key =>$value)
         {
            $res[$key]  = $value->slug;
         }

         if(in_array($active, $res))
         {
            return true;
         }else{
            return false;
         }


   }
   
    public static function MenuSidebar($array){
        
        $template = RequestSettingApps::AppsTemplate();
        foreach ($array as $key => $value) 
        {
            if($key ==0)
            {
             $active = true; 
            }else{
             $active = false;
            }

            if($value->icon =="")
            {
                $icon = url('/template/'.$template.'/img/user.png');
            }else{
                $icon = url('/images/menu/'.$value->icon);
            }  

            if($value->icon_hover =="")
            {
                $icon_hover = url('/template/'.$template.'/img/user.png');
            }else{
                $icon_hover = url('/images/menu/'.$value->icon_hover);
            }  

           $arr[$key]['active'] = $active;
           $arr[$key]['id'] = $value->id;
           $arr[$key]['name'] = $value->name;
           $arr[$key]['slug'] = $value->slug;  
           $arr[$key]['path_web'] = $value->path_web; 
           $arr[$key]['class'] = $value->class;
           $arr[$key]['icon'] =  $icon;
           if($active ==true)
           {
              $arr[$key]['icon_menu'] = $icon_hover;
           }else{
              $arr[$key]['icon_menu'] =  $icon;
           } 
          
           $arr[$key]['icon_hover'] =  $icon_hover;
           $arr[$key]['option'] = $value->option;
           if($value->tasks)
           {
              $arr[$key]['tasks'] =  RequestMenuRoles::secondaryMenu($value->tasks) ;  
           }else{
             $arr[$key]['tasks'] = [];
           } 
               
               
        }
 
       $result =  json_encode($arr);
       return json_decode($result);

       


   }

   


   

   public static function secondaryMenu($array){
        $template = RequestSettingApps::AppsTemplate();
        $result = array();
        if (isset($array)) {
            $no = 1;
            foreach ($array as $key => $value)
            {
                   
                    if($value->icon =="")
                    {
                        $icon = url('/template/'.$template.'/img/user.png');
                    }else{
                        $icon = url('/images/menu/'.$value->icon);
                    }  

                    if($value->icon_hover =="")
                    {
                        $icon_hover = url('/template/'.$template.'/img/user.png');
                    }else{
                        $icon_hover = url('/images/menu/'.$value->icon_hover);
                    }    
                   $result[$key]['active'] = $value->active;
                   $result[$key]['id'] = $value->id;
                   $result[$key]['name'] = $value->name;
                   $result[$key]['slug'] = $value->slug;  
                   $result[$key]['path_web'] = $value->path_web;
                   $result[$key]['class'] = $value->class;
                   $result[$key]['icon'] =  $icon;
                   $result[$key]['icon_menu'] = '';
                   $result[$key]['icon_hover'] =  $icon_hover;
                   $result[$key]['option'] = $value->option;
                   $result[$key]['tasks'] =  RequestMenuRoles::secondaryMenu($value->tasks) ; 
               
               $no ++;  
            }
        }
        return $result;

   }

   public static function ActionPage($slug)
   {
     $access = RequestAuth::AccessID();
     $res = array();
     $roleMenu = RoleMenu::where('role_id',$access)->first();
     if($roleMenu)
     {
           $result = json_decode($roleMenu->menu_json);
           if($result)
           {
              foreach($result as $key =>$val)
              {
                if($val->slug == $slug)
                {
                   $res = $val->option;
                }   

              }
           } 
           
     }

     if(!$res)
     {
        $res = RequestMenuRoles::DefaultChacked();
     }   
 
       
     return $res;

   }

   public static function DefaultChacked(){
      $result = array();
      $data = Action::select('name','slug')->get();
      foreach($data as $key =>$val)
      {
        $result[$key]['action'] =  $val->slug;
        $result[$key]['name'] =  $val->name;
        $result[$key]['checked'] =  false;
      } 

      return $result; 
   }

   public static function CreatePages($slug)
   {
        $pages = Pages::where('slug',$slug)->first();
        if($pages)
        { 
            $result = true;
        }else{
            $result = false;
        } 
         

        return  $result;
   }

   public static function Condition($path)
   {  
        $path =  json_encode($path);
        $path =  json_decode($path);
        $res = array();
        $result = array();
        foreach($path as $key =>$value)
        {
           $res[$key] = $value->slug;
        }

        if (in_array('menu', $res))
        {
            $result = true;
        }else{
           $result = false;
        }

        return $result; 

   }


    public static function fieldsData($request)
    {
        $uuid = Str::uuid()->toString();
        $fields = [  
            'id'=> $uuid,
            'role_id'  => $request->role_id,
            'menu_json'  =>  $request->menu,
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        return $fields;
    }

    public static function fieldsPages($request){

       $uuid = Str::uuid()->toString();
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $fields = [  
            'id'=> $uuid,
            'name' => $request->name,
            'slug' => $slug,
            'role_id'  => $request->role_id,
            'foldername'  => $request->foldername,
            'filename'  => $request->filename,
            'type'  => $request->type,
            'label_list'  =>  json_encode($request->label_list),
            'action_list'  => json_encode($request->action_list),
            'limit_table' =>$request->limit_table,
            'path_api'  => $request->path_api,
            'search'  => $request->search,
            'paginate'  => $request->paginate,
            'created_by' => Auth::User()->username,
            'created_at' => date('Y-m-d H:i:s'),
        ];

       $result =  json_encode($fields);
       return json_decode($result);
       

    }


    public static function getMenuAllSave($data)
    {
        $result = RequestMenuRoles::RoleTasks($data);
        return RequestMenuRoles::createDirectory($result);
       
    }

    

     public static function createDirectory($data) 
    {   

        
        $temp = RequestSettingApps::AppsTemplate();

        foreach($data as $key =>$val)
        {
            
            if($val->type =='table')
            {
              $sampleTable = RequestMenuRoles::sampleTable();  
            }else if($val->type =='form'){
              $sampleTable = RequestMenuRoles::sampleForm();   
            }else if($val->type =='view'){
              $sampleView = RequestMenuRoles::sampleView();   
            }     
            $path = resource_path() . '/assets/js/template/'.$temp.'/components/' . $val->foldername;
            if (!file_exists($path)) 
            {
                mkdir($path, 0777, true);
                if(!file_exists($path.'/'.$val->filename.'.vue'))
                {
                   $filepath = fopen($path.'/'.$val->filename.'.vue', 'w') or die('Unable to open file!');
                    
                    fwrite($filepath, $sampleTable);   
                }    
                
               
            }else{

                if(!file_exists($path.'/'.$val->filename.'.vue'))
                {
                    $filepath = fopen($path.'/'.$val->filename.'.vue', 'w') or die('Unable to open file!');
                    
                    fwrite($filepath, $sampleTable);   
                }  

            }


        }    

       
        
    }

     public static function createDirectorySingle($data) 
    {  
            $template = GeneralPaginate::Template();
            if($data->type =='table')
            {
              $sample = RequestMenuRoles::sampleTable();  
            }    
            
            $path = resource_path() . '/assets/js/template/'.$template.'/components/' . $data->foldername;
            if (!file_exists($path)) 
            {
                mkdir($path, 0777, true);
                if(!file_exists($path.'/'.$data->filename.'.vue'))
                {
                   $filepath = fopen($path.'/'.$data->filename.'.vue', 'w') or die('Unable to open file!');
                    
                    fwrite($filepath, $sample);   
                }    
                
               
            }else{

                if(!file_exists($path.'/'.$data->filename.'.vue'))
                {
                    $filepath = fopen($path.'/'.$data->filename.'.vue', 'w') or die('Unable to open file!');
                    
                    fwrite($filepath, $sample);   
                }  

            }


     
       
        
    }

    public static function sampleTable(){
          $sample = '<template>
<div>
    <section class="content-header pd-left-right-15">
    <div class="col-sm-4 pull-left padding-default full">
            <div class="width-50 pull-left">
             <div class="btn-group pull-left padding-9-0" v-if="ShowSearch ==true">
                   
                    <button type="button"  @click="DelSelected()" class="btn btn-primary" :disabled="btn_delete"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button"  @click="Add()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                    <button type="button" @click="GetShowSearch(ShowSearch)"  class="btn btn-primary" ><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                   
              </div>
                <div class="input-group input-group-sm bg-search-table"  v-if="ShowSearch ==false">
                    <span class="input-group-btn">
                    <button type="button" @click="GetShowSearch(ShowSearch)" class="btn btn-default btn-flat"><i class="fa fa-times"></i></button>
                    </span>    
                    <input type="text" class="form-control" v-model="inputsearch" :placeholder="placeholder" @input="Search(inputsearch)">
                
                </div>

            </div> 

            <div class="pull-right width-50">
                  <Pagination v-if="viewsPage" @change="getData" v-model="halaman" :page-count="total" class="pagination-table"></Pagination>
            </div>   
    </div>   
    </section>

    <div class="col-sm-12 pull-left" v-if="searchViews">

        <div class="alert alert-danger alert-dismissible"  >
         <i class="fa fa-search" aria-hidden="true"></i>    {{ search_text  }}
        </div>

    </div>
    <div class="content">
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="box box-solid box-primary">
           
           
            <div class="box-body" >
                <div class="card-body table-responsive p-0" >
                            <table class="table table-hover text-nowrap" id="datatable">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" @click="selectAll(allSelected)" v-model="allSelected" ></th>
                                    <th class="border-right-table"> No </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
                                     <th class="border-right-table"> Sample </th>
                                    <th> Options </th> 
                                </tr>
                                </thead>
                                <tbody >
                                    <tr v-if="loading">
                                         <td colspan="10"> <loading-block class="loading-table"  /></td>
                                    </tr>
                                    <tr v-if="resultNull">
                                        <td colspan="10"> Data Kosong</td>
                                    </tr>
                                    <tr v-for="(list,index) in lists.result" v-bind:key="list.id"  v-if="views">
                                        <td><input type="checkbox" v-model="dataIds" :value="list.id" number  @change="updateCheckall()"></td>
                                        <td> {{ list.number }}</td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td> Sample </td>
                                        <td>
                                            <div class="btn-group">
                                           
                                             
                                              <button type="button" @click="Edit(list.id)" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                              <button type="button" @click="Delete(list.id)" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </div>
                                        </td>

                                       
                                    </tr>  
                                     
                                </tbody>
                            </table>



                           

                </div>
            </div>
        </div>
    </div>

   


</div>
</template>
<script>
   export default {
        props:["Apps","Title","URL_Segment"],
        data() {
            return {
               loading:true,
               views:false,
               viewsPage:false,
               searchViews:false,
               resultNull:false,
               inputsearch:"",
               lists:[],
               total: 10,
               halaman: 1,
               showModalSearch: false,
               isSearch: false,
               searchMessage: "",
               search_text:"",
               allSelected: false,
               dataIds:[],
               btn_delete:true,
               ShowSearch:true,
               placeholder:"",
            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
           this.placeholder = "Search Data "+ this.Title;
        },
        mounted() {
           this.getData();
        },
        computed: {
            base_url() {
                return BASE_URL;
            },  
        },
        components: {
           "Pagination": require("vue-plain-pagination"),
          
        },
        methods: {
          GetShowSearch(status){
            if(status ==true)
            {
              this.ShowSearch = false;   
            }else{
               this.ShowSearch = true;     
            }    
             
          },
            
          selectAll: function(event) {
               this.dataIds = [];
                if(event ==true)
                {
                  this.allSelected = false;
                  this.btn_delete = true;
                }else{
                  this.allSelected = true;
                  this.btn_delete = false;   
                }    
             
                if (this.allSelected) {
                    for(var i=0; i<this.lists.result.length; i++)
                    {
                            
                        this.dataIds.push(this.lists.result[i].id);
                    }
                }

         }, 

         updateCheckall(){
               
                if(this.dataIds.length !=0)
                {
                   this.btn_delete = false;   
                }else{
                   this.btn_delete = true; 
                }    
                if(this.dataIds.length == this.lists.result.length){
                    this.allSelected = true;
                }else{
                    this.allSelected = false;
                }
            }, 

          DelSelected(){
            this.$swal({
                    buttons:true,
                    dangerMode:true,
                    title: "Apakah Anda Yakin Hapus ?",
                    icon: "warning",
                }).then((result) => {
                    if (result) {

                        var formData = {
                             data: this.dataIds
                        };

                        
                        axios.post(BASE_URL + "/api/"+ this.URL_Segment +"/selected",formData)
                        .then((response) => {
                            
                            if(response.data.messages == true){
                               
                                this.$swal({
                                    title: "Berhasil Di Hapus",
                                    icon: "success"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.dataIds = [];
                                        this.updateCheckall();
                                        this.getData();
                                    }
                                });
                            }else{
                               
                                this.$swal({
                                    title: "Gagal Di Hapus",
                                    icon: "error"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.getData();
                                    }
                                });
                            }
                        }).catch((error) => {
                            console.log(error);
                        });

                    }
                }); 
          },
          Refresh(){
             this.loading = true;
             this.views = false;
             this.inputsearch = "";
             this.searchViews = false;
             this.resultNull = false;
             this.dataIds = [];
             this.getData();
          },
          getData(){

            const self = this;
            let listUrl = "";

            listUrl = BASE_URL + "/api/"+ this.URL_Segment +"?page="+ self.halaman;    
            axios.get(listUrl).then((response) => {
                self.lists = response.data;
                self.loading = false;
                
                if(self.lists.total >0)
                {
                   
                    self.halaman = response.data.currentPage;
                    self.total = response.data.lastPage;  
                    self.views = true;
                    self.viewsPage = true;

                }else{
                    self.resultNull = true;
                    self.views = false;
                    self.viewsPage = false;

                }
            }).catch((error) => {
                console.log(error);
                self.loading = false;
                self.views = true;
                self.viewsPage = false;
            });
             
          },
          Add(){

            this.$router.push({path:"/"+ this.URL_Segment +"/add"})

          },
          Edit(id){

            this.$router.push({path:"/"+ this.URL_Segment +"/edit/"+ id})

          },
          Search(input){
               const self = this;   
               
           
               if(self.inputsearch !="")
               {
                    self.loading = true;
                    self.views = false;
                    let urlBase="";
                    let formData = new FormData();
                    formData.append("search", input);
                    urlBase = axios.post(BASE_URL+"/api/"+ this.URL_Segment +"/search", formData);
                    urlBase
                    .then((response) => {
                       
                        self.lists = response.data;
                        self.loading = false;
                        self.searchViews = true;
                 
                        if(self.lists.total >0)
                        {
                           self.views = true;
                           self.search_text = self.lists.cari;
                           self.halaman = response.data.currentPage;
                           self.total = response.data.lastPage;
                           self.viewsPage = true;
                           self.resultNull = false;
                        }else{
                           self.search_text = "Pencarian "+ self.inputsearch +" tidak ditemukan ";
                           self.halaman = 1;
                           self.total = 10;
                           self.viewsPage = false;
                           self.resultNull = true;
                           self.views = false;
                        }
                        
                    
                    }).catch((error) => {
                     
                        console.log(error);
                            
                    });
                }    
          },

          Delete(id){
             
                this.$swal({
                    buttons:true,
                    dangerMode:true,
                    title: "Apakah Anda Yakin Hapus ?",
                    icon: "warning",
                }).then((result) => {
                    if (result) {
                        
                        axios.delete(BASE_URL + "/api/"+ this.URL_Segment +"/"+ id)
                        .then((response) => {
                            
                            if(response.data.messages == true){
                               
                                this.$swal({
                                    title: "Berhasil Di Hapus",
                                    icon: "success"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.getData();
                                    }
                                });
                            }else{
                               
                                this.$swal({
                                    title: "Gagal Di Hapus",
                                    icon: "error"
                                }).then((results) => {
                                    if (results) {
                                        this.views = false;
                                        this.loading = true;
                                        this.getData();
                                    }
                                });
                            }
                        }).catch((error) => {
                            console.log(error);
                        });

                    }
                });
          },

        }
    }
   
</script>';


    

    return  $sample;


  }

    
  public static function sampleForm(){
  
   $sample ='
    <template>

<div class="content">
   
    <div class="box box-primary">

        <div class="box-body">
             <div class="row" v-if="loading">  
                <div class="form-group col-sm-12">
                 <loading-block class="loading-table"  />
                </div>
              </div> 
            <div class="row" v-if="views">
            <form  enctype="multipart/form-data" method="post"  @submit.prevent="RequestPost">
                   

                   <div class="form-group col-sm-6" >
                         <label>Sample :</label>
                         <input v-model="name" type="text" class="form-control" placeholder="Sample Name">
                       
                    </div>

                     

                     

                   
                    <div class="form-group col-sm-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" @click="Cancel">Cancel</button>

                      
                    </div>

            </form>
                

            </div>
        </div>
    </div>
</div>

</template>
<script>
   export default {
        props:["Apps","Title","URL_Segment"],
        data() {
            return {
               errors: {
                    messages: {
                        name:"", 
                        status:"", 
                       
                            
                    },
               }, 
               loading:true,
               views:false,
               name:"",
               status:"Y", 
               
            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
        },
        mounted() {
             this.loading = false;
             this.views = true; 
        },
        computed: {
             base_url() {
                return BASE_URL;
            }, 
             
        },
        components: {
          
        },
        methods: {
          Cancel(){
             this.$router.push({path:"/"+ this.URL_Segment})
          },
          RequestPost(){
             
              const self = this; 
                let urlBase="";
                let formData = new FormData();
                formData.append("name", self.name);
                formData.append("status", self.status);
               
                
                
                urlBase = axios.post(BASE_URL+"/api/"+  self.URL_Segment , formData);
                urlBase
                .then((response) => {
                    if(response.data.status == true){
                        self.$swal({
                            title: "Berhasil Di Simpan",
                            icon: "success"
                        }).then((result) => {
                            if (result) {
                                   self.$router.push({path:"/"+ this.URL_Segment})
                            }
                        });
                    }
                
                }).catch((error) => {
                 
                    self.errors = error.response.data;
                                 
               
                });


          }, 

        }
    }
   
</script>
   ';


   return $sample;
   

  } 

  public static function sampleView(){

    $sample ='<template>
<div>

<div class="content">
    <div class="box box-primary">

            <div class="box-body">
                 <div class="row" v-if="loading">  
                    <div class="form-group col-sm-12">
                     <loading-block class="loading-table"  />
                    </div>
                  </div> 
                <div class="row" v-show="views_info">
               
                       <div class="form-group col-sm-12" >
                             <label>Sample  :</label>
                             <p>Sample</p>
                            
                        </div>


                        <div class="form-group col-sm-12" >
                             <label>Sample  :</label>
                             <p>Sample</p>
                            
                        </div>

                        <div class="form-group col-sm-12" >
                             <label>Sample  :</label>
                             <p>Sample</p>
                            
                        </div>

                         

                        

                        <div class="form-group col-sm-12">
                          
                             <button  class="btn btn-default">Close</button>
                          
                        </div>
                </div>

               
                

                </EditForm>
            </div>
        </div>
  
    
</div>

</div>
</template>
<script>
   export default {
        props:["Apps","Title","URL_Segment"],
        data() {
            return {
               
               lists:{},
              
              
            }
        },
        created() {  
           document.title = this.Apps;
           this.$emit("Title",this.Title);
        },
        mounted() {
           this.getData();
        },
        computed: {
            base_url() {
                return BASE_URL;
            },  
        },
        components: {
           
        },
        methods: {
          
          getData(){

            const self = this;
            let listUrl = "";
            listUrl = BASE_URL + "/api/"+  self.URL_Segment +"";    
            axios.get(listUrl).then((response) => {
                self.lists = response.data.result;
               
                self.loading = false;
                self.views_info = true;
               

            }).catch((error) => {
                console.log(error);
                self.loading = false;
                self.views_info = false;
            
            });
             
          },
       

        }
    }
   
</script>
';


    return $sample;
  }

}