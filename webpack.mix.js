const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


    mix.js('resources/assets/js/template/adminlte/index.js', 'public/vue/js').vue({ version: 2 });  
    mix.styles([

       'public/template/adminlte/css/bootstrap.min.css',
       'public/template/adminlte/css/font-awesome.min.css',
       'public/template/adminlte/css/ionicons.min.css',
       'public/template/adminlte/css/AdminLTE.min.css',
       'public/template/adminlte/css/_all-skins.min.css', 
       'public/template/adminlte/css/_all.css', 
       'public/template/adminlte/css/style.css',
       'public/template/adminlte/css/pagination.css', 
    ], 'public/vue/css/bundle.css').vue({ version: 2 });
    mix.scripts([
        'public/template/adminlte/js/jquery.min.js',
        'public/template/adminlte/js/adminlte.min.js',
        'public/template/adminlte/js/bootstrap.min.js',
        'public/template/adminlte/js/icheck.min.js',
        'public/template/adminlte/js/icheck.js',
    ], 'public/vue/js/bundle.js').vue({ version: 2 });


   // mix.js('resources/assets/js/template/apex/index.js', 'public/vue/js').vue({ version: 2 });
    // mix.styles([

    //    'public/template/apex/css/bootstrap.css',
    //    'public/template/apex/css/bootstrap-extended.css',
    //    'public/template/apex/fonts/feather/style.min.css',
    //    'public/template/apex/fonts/simple-line-icons/style.css',
    //    'public/template/apex/fonts/font-awesome/css/font-awesome.min.css',
    //    'public/template/apex/vendors/css/perfect-scrollbar.min.css',
    //    'public/template/apex/vendors/css/prism.min.css',
    //    'public/template/apex/vendors/css/switchery.min.css',
    //    'public/template/apex/vendors/css/chartist.min.css',
    //    'public/template/apex/css/colors.css',
    //    'public/template/apex/css/components.css',
    //    'public/template/apex/css/themes/layout-dark.css',
    //    'public/template/apex/css/plugins/switchery.css',
    //    'public/template/apex/css/pages/authentication.css',
    //    'public/template/apex/css/pages/dashboard1.css',
    //    'public/template/apex/css/style.css',
    // ], 'public/vue/css/bundle.css').vue({ version: 2 });
    // mix.scripts([
      
        
    //     'public/template/apex/vendors.min.js',
    //     'public/template/apex/vendors/js/chartist.min.js',
    //     'public/template/apex/js/switchery.min.js',
    //     'public/template/apex/js/core/app-menu.min.js',
    //     // 'public/template/apex/js/core/app.js',
    //     'public/template/apex/js/notification-sidebar.js',
    //     'public/template/apex/js/customizer.js',
    //     'public/template/apex/js/scroll-top.js',
    //     'public/template/apex/js/dashboard1.js',
    //     'public/template/apex/js/scripts.js',
    // ],  'public/vue/js/bundle.js').vue({ version: 2 });




//mix.js('resources/js/app.js', 'public/js').sourceMaps();
