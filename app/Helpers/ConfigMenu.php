<?php

namespace App\Helpers;
use Request;
use App\Models\Roles;
use App\Http\Request\RequestMenuRoles;

class ConfigMenu
{

    public static function MenuSidebarAdmin()
    {
        
        $data = array(
        [
            
            'name'=>'Dashboard',
            'slug'=>'dashboard',
            'icon'=>'icon-dashboard',
            'url'=>'/dashboard',
            'count'=>0,
            'active'=>true,
            'class'=>'dashboard treeview',
            'tasks'=>[], // dashboard
        ],
        [
            'name'=>'Manajemen Data',
            'slug'=>'manajemen-data',
            'icon'=>'icon-manajemen-data',
            'url'=>'',
            'count'=>6,
            'active'=>false,
            'class'=>'manajemen-data treeview',
            'tasks'=> array(
                [
                    'name'=>'Provinsi',
                    'slug'=>'provinsi',
                    'icon'=>'icon-provinsi',
                    'url'=>'/provinsi',
                    'active'=>false,
                    'class'=>'provinsi',
                    'tasks'=>[],  
               ],[

                    'name'=>'Kabupaten',
                    'slug'=>'kabupaten',
                    'icon'=>'icon-kabupaten',
                    'url'=>'/kabupaten',
                    'active'=>false,
                    'class'=>'kabupaten',
                    'tasks'=>[],
             
               ],[
                'name'=>'Kriteria Kendala',
                'slug'=>'kriteria-kendala',
                'icon'=>'icon-kriteria-kendala',
                'url'=>'/kriteria-kendala',
                'active'=>false,
                'class'=>'kriteria-kendala',
                'tasks'=>[],
               ],[
                'name'=>'Forum',
                'slug'=>'forum',
                'icon'=>'icon-forum',
                'url'=>'/forum',
                'active'=>false,
                'class'=>'forum',
                'tasks'=>[],
             ],[
                'name'=>'Status',
                'slug'=>'status',
                'icon'=>'icon-status',
                'url'=>'/',
                'active'=>false,
                'class'=>'status',
                'tasks'=>[],
            ],[
                'name'=>'Batas Periode',
                'slug'=>'batas-periode',
                'icon'=>'icon-batas-periode',
                'url'=>'/periode',
                'active'=>false,
                'class'=>'batas-periode',
                'tasks'=>[],
            ]

           ), // management data
                 
        ],
        [
            'name'=>'Manajemen User',
            'slug'=>'manajemen-user',
            'icon'=>'icon-manajemen-user',
            'url'=>'',
            'count'=>3,
            'active'=>false,
            'class'=>'manajemen-user treeview',
            'tasks'=> array(
                [
                    'name'=>'User',
                    'slug'=>'user',
                    'icon'=>'icon-user',
                    'url'=>'/user',
                    'active'=>false,
                    'class'=>'user',
                    'tasks'=>[],  
               ],[

                    'name'=>'Role',
                    'slug'=>'role',
                    'icon'=>'icon-role',
                    'url'=>'/options',
                    'active'=>false,
                    'class'=>'role',
                    'tasks'=>[],
             
               ],[
                'name'=>'Aksi',
                'slug'=>'aksi',
                'icon'=>'icon-aksi',
                'url'=>'/action',
                'active'=>false,
                'class'=>'aksi',
                'tasks'=>[],
               ]

           ), // management user
            
        ],
        [ 
            'name'=>'Pagu APBN',
            'slug'=>'pagu-apbn',
            'icon'=>'icon-pagu-apbn',
            'url'=>'/pagutarget',
            'count'=>0,
            'active'=>false,
            'class'=>'pagu-apbn treeview',
            'tasks'=>[], //pagu apbn

        ],
        [
            'name'=>'Monitoring',
            'slug'=>'monitoring',
            'icon'=>'icon-monitoring',
            'url'=>'',
            'count'=>7,
            'active'=>false,
            'class'=>'monitoring treeview',
            'tasks'=> array(
               [
                    'name'=>'Pagu APBN',
                    'slug'=>'pagu-apbn',
                    'icon'=>'icon-pagu-apbn',
                    'url'=>'/pagutarget',
                    'active'=>false,
                    'class'=>'pagu-apbn',
                    'tasks'=>[],  
               ],[

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false,
                    'class'=>'perencanaan',
                    'tasks'=>[],
             
               ],[
                'name'=>'Pengawasan',
                'slug'=>'pengawasan',
                'icon'=>'icon-pengawasan',
                'url'=>'/pengawasan',
                'active'=>false,
                'class'=>'pengawasan',
                'tasks'=>[],
               ],[
                'name'=>'Bimbingan/Sosialisasi',
                'slug'=>'bimsos',
                'icon'=>'icon-bimsos',
                'url'=>'/bimsos',
                'active'=>false,
                'class'=>'bimsos',
                'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah',
                'tasks'=>[],
            ],[
                'name'=>'Promosi',
                'slug'=>'promosi',
                'icon'=>'icon-promosi',
                'url'=>'/promosi',
                'active'=>false,
                'class'=>'promosi',
                'tasks'=>[],
            ],[
                'name'=>'Imap',
                'slug'=>'imap',
                'icon'=>'icon-imaps',
                'url'=>'/imap',
                'active'=>false,
                'class'=>'imap',
                'tasks'=>[],
            ]

           ), // monitoring
            
        ],
       
        [
            'name'=>'Tools',
            'slug'=>'tools',
            'icon'=>'icon-tools',
            'url'=>'',
            'count'=>3,
            'active'=>false,
            'class'=>'tools treeview',
            'tasks'=> array(
                [
                    'name'=>'Kendala',
                    'slug'=>'kendala',
                    'icon'=>'icon-kriteria-kendala',
                    'url'=>'/kendala',
                    'active'=>false,
                    'class'=>'kendala',
                    'tasks'=>[],  
               ],[

                    'name'=>'Forum',
                    'slug'=>'forum',
                    'icon'=>'icon-forum',
                    'url'=>'/forum',
                    'active'=>false,
                    'class'=>'forum',
                    'tasks'=>[],
             
               ]

           ), // tools
            
        ],
        [
            'name'=>'Pelaporan',
            'slug'=>'pelaporan',
            'icon'=>'icon-pelaporan',
            'url'=>'',
            'count'=>7,
            'active'=>false,
            'class'=>'pelaporan treeview',
            'tasks'=> array(
                [
                    'name'=>'Rekapitulasi',
                    'slug'=>'rekapitulasi',
                    'icon'=>'icon-rekap',
                    'url'=>'/rekapitulasi',
                    'active'=>false,
                    'class'=>'rekapitulasi',
                    'tasks'=>[],  
                ],
                [
                    'name'=>'Pagu APBN',
                    'slug'=>'pagu-apbn',
                    'icon'=>'icon-pagu-apbn',
                    'url'=>'/pagutarget',
                    'active'=>false,
                    'class'=>'pagu-apbn',
                    'tasks'=>[],  
               ],[

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false,
                    'class'=>'perencanaan',
                    'tasks'=>[],
             
               ],[
                    'name'=>'Pengawasan',
                    'slug'=>'pengawasan',
                    'icon'=>'icon-pengawasan',
                    'url'=>'/pengawasan',
                    'active'=>false,
                    'class'=>'pengawasan',
                    'tasks'=>[],
               ],[
                    'name'=>'Bimbingan/Sosialisasi',
                    'slug'=>'bimsos',
                    'icon'=>'icon-bimsos',
                    'url'=>'/bimsos',
                    'active'=>false,
                    'class'=>'bimsos',
                    'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah',
                'tasks'=>[],
            ],[
                'name'=>'Promosi',
                'slug'=>'promosi',
                'icon'=>'icon-promosi',
                'url'=>'/promosi',
                'active'=>false,
                'class'=>'promosi',
                'tasks'=>[],
            ],[
                'name'=>'Imap',
                'slug'=>'imap',
                'icon'=>'icon-imaps',
                'url'=>'/imap',
                'active'=>false,
                'class'=>'imap',
                'tasks'=>[],
            ]
            ,[
                'name'=>'Kendala',
                'slug'=>'kendala',
                'icon'=>'icon-kriteria-kendala',
                'url'=>'/kendala',
                'active'=>false,
                'class'=>'kendala',
                'tasks'=>[],
            ]

           ), // Pelaporan
            
        ],
        [
            
            'name'=>'Audit Log',
            'slug'=>'auditlog',
            'icon'=>'icon-auditlog',
            'url'=>'/auditlog',
            'count'=>0,
            'active'=>false,
            'class'=>'auditlog treeview',
            'tasks'=>[], 

        ], // auditlog


    );
    
     return json_decode(json_encode($data),true);

   }  
    public static function MenuSidebarPusat(){
        

       
        $data = array(
        [
            
            'name'=>'Dashboard',
            'slug'=>'dashboard',
            'icon'=>'icon-dashboard-hover',
            'url'=>'/dashboard',
            'count'=>0,
            'active'=>true,
            'class'=>'dashboard treeview',
            'tasks'=>[], // dashboard
        ],
        [ 
            'name'=>'Pagu APBN',
            'slug'=>'pagu-apbn',
            'icon'=>'icon-pagu-apbn',
            'url'=>'/pagutarget',
            'count'=>0,
            'active'=>false,
            'class'=>'pagu-apbn treeview',
            'tasks'=>[], //pagu apbn

        ],
        [
            'name'=>'Updating Data',
            'slug'=>'updating-data',
            'icon'=>'icon-updating-data',
            'url'=>'',
            'count'=>7,
            'active'=>false,
            'class'=>'updating-data treeview',
            'tasks'=> array(
               [
                    'name'=>'Pagu APBN',
                    'slug'=>'pagu-apbn',
                    'icon'=>'icon-pagu-apbn',
                    'url'=>'/pagutarget',
                    'active'=>false,
                    'class'=>'pagu-apbn',
                    'tasks'=>[],  
               ],[

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false,
                    'class'=>'perencanaan',
                    'tasks'=>[],
             
               ],[
                'name'=>'Pengawasan',
                'slug'=>'pengawasan',
                'icon'=>'icon-pengawasan',
                'url'=>'/pengawasan',
                'active'=>false,
                'class'=>'pengawasan',
                'tasks'=>[],
               ],[
                'name'=>'Bimbingan/Sosialisasi',
                'slug'=>'bimsos',
                'icon'=>'icon-bimsos',
                'url'=>'/bimsos',
                'active'=>false,
                'class'=>'bimsos',
                'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah',
                'tasks'=>[],
            ],[
                'name'=>'Promosi',
                'slug'=>'promosi',
                'icon'=>'icon-promosi',
                'url'=>'/promosi',
                'active'=>false,
                'class'=>'promosi',
                'tasks'=>[],
            ],[
                'name'=>'Imap',
                'slug'=>'imap',
                'icon'=>'icon-imaps',
                'url'=>'/imap',
                'active'=>false,
                'class'=>'imap',
                'tasks'=>[],
            ]

           ), // monitoring
            
        ],
       
        [
            'name'=>'Tools',
            'slug'=>'tools',
            'icon'=>'icon-tools',
            'url'=>'',
            'count'=>3,
            'active'=>false,
            'class'=>'tools treeview',
            'tasks'=> array(
                [
                    'name'=>'Kendala',
                    'slug'=>'kendala',
                    'icon'=>'icon-kriteria-kendala',
                    'url'=>'/kendala',
                    'active'=>false,
                    'class'=>'kendala',
                    'tasks'=>[],  
               ],[

                    'name'=>'Forum',
                    'slug'=>'forum',
                    'icon'=>'icon-forum',
                    'url'=>'/forum',
                    'active'=>false,
                    'class'=>'forum',
                    'tasks'=>[],
             
               ]

           ), // tools
            
        ],
        
        [
            'name'=>'Pelaporan',
            'slug'=>'pelaporan',
            'icon'=>'icon-pelaporan',
            'url'=>'',
            'count'=>7,
            'active'=>false,
            'class'=>'pelaporan treeview',
            'tasks'=> array(
                [
                    'name'=>'Rekapitulasi',
                    'slug'=>'rekapitulasi',
                    'icon'=>'icon-rekap',
                    'url'=>'/rekapitulasi',
                    'active'=>false,
                    'class'=>'rekapitulasi',
                    'tasks'=>[],  
                ],
                [
                    'name'=>'Pagu APBN',
                    'slug'=>'pagu-apbn',
                    'icon'=>'icon-pagu-apbn',
                    'url'=>'/pagutarget',
                    'active'=>false,
                    'class'=>'pagu-apbn',
                    'tasks'=>[],  
               ],[

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false,
                    'class'=>'perencanaan',
                    'tasks'=>[],
             
               ],[
                'name'=>'Pengawasan',
                'slug'=>'pengawasan',
                'icon'=>'icon-pengawasan',
                'url'=>'/pengawasan',
                'active'=>false,
                'class'=>'pengawasan',
                'tasks'=>[],
               ],[
                'name'=>'Bimbingan/Sosialisasi',
                'slug'=>'bimsos',
                'icon'=>'icon-bimsos',
                'url'=>'/bimsos',
                'active'=>false,
                'class'=>'bimsos',
                'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah',
                'tasks'=>[],
            ],[
                'name'=>'Promosi',
                'slug'=>'promosi',
                'icon'=>'icon-promosi',
                'url'=>'/promosi',
                'active'=>false,
                'class'=>'promosi',
                'tasks'=>[],
            ],[
                'name'=>'Imap',
                'slug'=>'imap',
                'icon'=>'icon-imaps',
                'url'=>'/imap',
                'active'=>false,
                 'class'=>'imap',
                'tasks'=>[],
            ]
            ,[
                'name'=>'Kendala',
                'slug'=>'kendala',
                'icon'=>'icon-kriteria-kendala',
                'url'=>'/kendala',
                'active'=>false,
                'class'=>'kendala',
                'tasks'=>[],
            ]

           ), // Pelaporan
            
        ],
        


    );

    return json_decode(json_encode($data),true);

   }

   public static function MenuSidebarProvinsi(){
        

       
        $data = array(
        [
            
            'name'=>'Dashboard',
            'slug'=>'dashboard',
            'icon'=>'icon-dashboard-hover',
            'url'=>'/dashboard',
            'count'=>0,
            'active'=>true,
            'class'=>'dashboard treeview',
            'tasks'=>[], // dashboard
        ],
       
        [
            'name'=>'Updating Data',
            'slug'=>'updating-data',
            'icon'=>'icon-updating-data',
            'url'=>'#',
            'count'=>7,
            'active'=>false,
            'class'=>'updating-data treeview',
            'tasks'=> array(
               [

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false,
                    'class'=>'perencanaan',
                    'tasks'=>[],
             
               ],[
                'name'=>'Pengawasan',
                'slug'=>'pengawasan',
                'icon'=>'icon-pengawasan',
                'url'=>'/pengawasan',
                'active'=>false,
                'class'=>'pengawasan',
                'tasks'=>[],
               ],[
                'name'=>'Bimbingan/Sosialisasi',
                'slug'=>'bimsos',
                'icon'=>'icon-bimsos',
                'url'=>'/bimsos',
                'active'=>false,
                'class'=>'bimsos',
                'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah',
                'tasks'=>[],
            ],[
                'name'=>'Promosi',
                'slug'=>'promosi',
                'icon'=>'icon-promosi',
                'url'=>'/promosi',
                'active'=>false,
                'class'=>'promosi',
                'tasks'=>[],
            ],[
                'name'=>'Imap',
                'slug'=>'imap',
                'icon'=>'icon-promosi',
                'url'=>'/imap',
                'active'=>false,
                'class'=>'imap',
                'tasks'=>[],
            ]

           ), //updating data
            
        ],
        [
            'name'=>'Tools',
            'slug'=>'tools',
            'icon'=>'icon-tools',
            'url'=>'',
            'count'=>3,
            'active'=>false,
            'class'=>'tools treeview',
            'tasks'=> array(
                [
                    'name'=>'Kendala',
                    'slug'=>'kendala',
                    'icon'=>'icon-kriteria-kendala',
                    'url'=>'/kendala',
                    'active'=>false, 
                    'class'=>'kendala',
                    'tasks'=>[],  
               ],[

                    'name'=>'Forum',
                    'slug'=>'forum',
                    'icon'=>'icon-forum',
                    'url'=>'/forum',
                    'active'=>false,
                    'class'=>'forum',
                    'tasks'=>[],
             
               ]

           ), // tools
            
        ],
        [
            'name'=>'Pelaporan',
            'slug'=>'pelaporan',
            'icon'=>'icon-pelaporan',
            'url'=>'',
            'count'=>7,
            'active'=>false,
            'class'=>'pelaporan treeview',
            'tasks'=> array(
                [
                    'name'=>'Rekapitulasi',
                    'slug'=>'rekapitulasi',
                    'icon'=>'icon-rekap',
                    'url'=>'/rekapitulasi',
                    'active'=>false, 
                    'class'=>'rekapitulasi',
                    'tasks'=>[],  
                ],
                [
                    'name'=>'Pagu APBN',
                    'slug'=>'pagu-apbn',
                    'icon'=>'icon-pagu-apbn',
                    'url'=>'/pagutarget',
                    'active'=>false,
                    'class'=>'pagu-apbn', 
                    'tasks'=>[],  
               ],[

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false, 
                    'class'=>'perencanaan', 
                    'tasks'=>[],
             
               ],[
                'name'=>'Pengawasan',
                'slug'=>'pengawasan',
                'icon'=>'icon-pengawasan',
                'url'=>'/pengawasan',
                'active'=>false,
                'class'=>'pengawasan',
                'tasks'=>[],
               ],[
                'name'=>'Bimbingan/Sosialisasi',
                'slug'=>'bimsos',
                'icon'=>'icon-bimsos',
                'url'=>'/bimsos',
                'active'=>false,
                'class'=>'bimsos',
                'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah', 
                'tasks'=>[],
            ],[
                'name'=>'Promosi',
                'slug'=>'promosi',
                'icon'=>'icon-promosi',
                'url'=>'/promosi',
                'active'=>false, 
                'class'=>'promosi',
                'tasks'=>[],
            ],[
                'name'=>'Imap',
                'slug'=>'imap',
                'icon'=>'icon-imaps',
                'url'=>'/imap',
                'active'=>false, 
                'class'=>'imap',
                'tasks'=>[],
            ]
            ,[
                'name'=>'Kendala',
                'slug'=>'kendala',
                'icon'=>'icon-kriteria-kendala',
                'url'=>'/kendala',
                'active'=>false, 
                'class'=>'kendala',
                'tasks'=>[],
            ]

           ), // Pelaporan
            
        ],
        

    );

    return json_decode(json_encode($data),true);

   }

   public static function MenuSidebarKabupaten(){
        

       
        $data = array(
       [
            
            'name'=>'Dashboard',
            'slug'=>'dashboard',
            'icon'=>'icon-dashboard-hover',
            'url'=>'/dashboard',
            'count'=>0,
            'active'=>true,
            'class'=>'dashboard treeview',
            'tasks'=>[], // dashboard
        ],
        [
            'name'=>'Updating Data',
            'slug'=>'updating-data',
            'icon'=>'icon-updating-data',
            'url'=>'',
            'count'=>7,
            'active'=>false,
            'class'=>'treeview',
            'tasks'=> array(
                       [

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false,
                    'class'=>'perencanaan',
                    'tasks'=>[],
             
               ],[
                'name'=>'Pengawasan',
                'slug'=>'pengawasan',
                'icon'=>'icon-pengawasan',
                'url'=>'/pengawasan',
                'active'=>false,
                'class'=>'pengawasan',
                'tasks'=>[],
               ],[
                'name'=>'Bimbingan/Sosialisasi',
                'slug'=>'bimsos',
                'icon'=>'icon-bimsos',
                'url'=>'/bimsos',
                'active'=>false, 
                'class'=>'bimsos',  
                'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah', 
                'tasks'=>[],
            ]
           ), // updating data
            
        ],
        [
            'name'=>'Tools',
            'slug'=>'tools',
            'icon'=>'icon-tools',
            'url'=>'',
            'count'=>3,
            'active'=>false,
            'class'=>'tools treeview',
            'tasks'=> array(
                [
                    'name'=>'Kendala',
                    'slug'=>'kendala',
                    'icon'=>'icon-kriteria-kendala',
                    'url'=>'/kendala',
                    'active'=>false,
                    'class'=>'kendala',
                    'tasks'=>[],  
               ],[

                    'name'=>'Forum',
                    'slug'=>'forum',
                    'icon'=>'icon-forum',
                    'url'=>'/forum',
                    'active'=>false,
                    'class'=>'forum', 
                    'tasks'=>[],
             
               ]

           ), // tools
            
        ],
        [
            'name'=>'Pelaporan',
            'slug'=>'pelaporan',
            'icon'=>'icon-pelaporan',
            'url'=>'',
            'count'=>7,
            'active'=>false,
            'class'=>'pelaporan treeview',
            'tasks'=> array(
                [
                    'name'=>'Rekapitulasi',
                    'slug'=>'rekapitulasi',
                    'icon'=>'icon-rekap',
                    'url'=>'/rekapitulasi',
                    'active'=>false, 
                    'class'=>'rekapitulasi', 
                    'tasks'=>[],  
                ],
                [
                    'name'=>'Pagu APBN',
                    'slug'=>'pagu-apbn',
                    'icon'=>'icon-pagu-apbn',
                    'url'=>'/pagutarget',
                    'active'=>false,
                    'class'=>'pagu-apbn', 
                    'tasks'=>[],  
               ],[

                    'name'=>'Perencanaan',
                    'slug'=>'perencanaan',
                    'icon'=>'icon-perencanaan',
                    'url'=>'/perencanaan',
                    'active'=>false,
                    'class'=>'perencanaan',  
                    'tasks'=>[],
             
               ],[
                'name'=>'Pengawasan',
                'slug'=>'pengawasan',
                'icon'=>'icon-pengawasan',
                'url'=>'/pengawasan',
                'active'=>false,  
                'class'=>'pengawasan',  
                'tasks'=>[],
               ],[
                'name'=>'Bimbingan/Sosialisasi',
                'slug'=>'bimsos',
                'icon'=>'icon-bimsos',
                'url'=>'/bimsos',
                'active'=>false,  
                'class'=>'bimsos',  
                'tasks'=>[],
             ],[
                'name'=>'Penyelesaian Masalah',
                'slug'=>'penyelesaian-masalah',
                'icon'=>'icon-penyelesaian',
                'url'=>'/',
                'active'=>false,
                'class'=>'penyelesaian-masalah',  
                'tasks'=>[],
            ]
            ,[
                'name'=>'Kendala',
                'slug'=>'kendala',
                'icon'=>'icon-kriteria-kendala',
                'url'=>'/kendala',
                'active'=>false,
                'class'=>'kendala',  
                'tasks'=>[],
            ]

           ), // Pelaporan
            
        ],
        


    );

    return json_decode(json_encode($data),true);

   }


    

   

}