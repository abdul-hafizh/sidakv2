<?php

namespace App\Helpers;
use Request;
use App\Models\Roles;
use App\Http\Request\RequestMenuRoles;

class ConfigHeader
{

   
    public static function index()
    {
        $title = '';
        if(!empty($_COOKIE['access']))
        { 

             $access = Roles::where('slug',$_COOKIE['access'])->first();
             $role = RequestMenuRoles::Roles($access->id);
             $menu = RequestMenuRoles::PathVue($role);
             if($menu)
             {  
               $title = ConfigHeader::GetMenuTitle($menu);
             } 
            
              
        }else{
            if(Request::segment(1) =='register')
            {
               $title = 'Register'; 
            }else if(Request::segment(1) =='forgot'){
               $title = 'Lupa Password'; 
            }else{
               $title = 'Login'; 
            }    
          
        }      

        return $title; 

    } 

    public static function GetMenuTitle($data)
    {    
              $encode = json_encode($data);
              $data = json_decode($encode);
              
                foreach($data as $kuy =>$val)
                {
                    if(Request::segment(2) == $val->filename)
                    {
                       if(Request::segment(1) == $val->foldername)
                       {
                           return  $val->name;
                       } 
                          
                      
                    }else{
                        if(Request::segment(1) == $val->foldername)
                        {
                          if(!Request::segment(2))
                          {
                             return $val->name; 
                          }
                          
                        }   

                    }
                     
                   
                }  
         

    }


      public static function GetMenuSlug($data)
    {    
              $encode = json_encode($data);
              $data = json_decode($encode);
              
                foreach($data as $kuy =>$val)
                {
                    if(Request::segment(2) == $val->filename)
                    {
                      return  $val->slug;
                    }else{
                        if(Request::segment(1) == $val->foldername)
                        {
                          if(!Request::segment(2))
                          {
                             return $val->slug; 
                          }
                          
                        }   

                    }
                     
                   
                }  
         

    }

    
   


    

   

}