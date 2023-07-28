<?php

namespace App\Helpers;

class GeneralPaginate
{

    /**
     * build child menu
     * @param $child
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function limit() 
    {   
        $paginate = env('PAGINATE', '10');
        return $paginate;
    }

    public static function uploadPhotoFolder() 
    {   
        $img = env('URL_FILE', '/profile/');
        return $img;
    }

     public static function uploadApps() 
    {   
        $img = env('URL_FILE', 'images/');
        return $img;
    }

    public static function uploadFileFolder() 
    {   
        $img = env('URL_FILE', 'file/');
        return $img;
    }

  


}