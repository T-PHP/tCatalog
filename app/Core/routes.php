<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @modified Thibaut Lasserre
 * @date updated Dec 24, 2016
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;



/////// IMPORTANT
/////// A CORRIGER
/////// TROUVER SOLUTION POUR ARRAY CAR SI URL CONTIENT EN OU FR CA BUG
/////// Ex : c/10-ENglish-cat.html ou c/10/FRench-url.html

$lang_array = array('en', 'fr');
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
for($i=0; $i < count($lang_array); $i++) {
    if(strpos($actual_link,$lang_array[$i]) != false):
        define('LANGUAGE_CODE', $lang_array[$i]);
    endif;       
}

//If only 1 Langage, we don't display Iso Code in URL
if(count($lang_array) === 1):
    define('LANGUAGE_CODE', $lang_array[0]);
    
    Router::any(URL_ADMIN, 'Controllers\Admin\Products@getProducts');

    Router::any('p/(:num)-(:any).html', 'Controllers\Front\Products@getProduct');
    Router::any('c/(:num)-(:any).html', 'Controllers\Front\Categories@getCategory');
//Else If multi langages
else:
    define('URL_ADMIN', 'admin');
    define('URL_HOME', LANGUAGE_CODE.'');
    define('URL_PRODUCT', LANGUAGE_CODE.'/p/');
    define('URL_CATEGORY', LANGUAGE_CODE.'/c/');
    
    //Router::any(URL_ADMIN, 'Controllers\Admin\Home@index');
    Router::any(URL_ADMIN.'/categories', 'Controllers\Admin\Categories@getCategories');
    Router::any(URL_ADMIN.'/categories/add', 'Controllers\Admin\Categories@addCategory');
    Router::any(URL_ADMIN.'/categories/edit/(:num)', 'Controllers\Admin\Categories@editCategory');
    Router::any(URL_ADMIN.'/categories/del/(:num)', 'Controllers\Admin\Categories@delCategory');
    Router::any(URL_ADMIN.'/products', 'Controllers\Admin\Products@getProducts');
    Router::any(URL_ADMIN.'/products/add', 'Controllers\Admin\Products@addProduct');
    Router::any(URL_ADMIN.'/products/edit/(:num)', 'Controllers\Admin\Products@editProduct');
    Router::any(URL_ADMIN.'/brands', 'Controllers\Admin\Brands@getBrands');
    Router::any(URL_ADMIN.'/brands/add', 'Controllers\Admin\Brands@addBrand');
    Router::any(URL_ADMIN.'/brands/edit/(:num)', 'Controllers\Admin\Brands@editBrand');
    Router::any(URL_ADMIN.'/brands/del/(:num)', 'Controllers\Admin\Brands@delBrand');
    Router::any(URL_ADMIN.'/seo/meta-robots', 'Controllers\Admin\Seo@getMetaRobots');
    Router::any(URL_ADMIN.'/seo/meta-robots/del/(:num)', 'Controllers\Admin\Seo@delMetaRobots');
    Router::any(URL_ADMIN.'/seo/robots-txt', 'Controllers\Admin\Seo@getRobotsTxt');

    Router::any(URL_HOME, 'Controllers\Front\Home@index');
    Router::any(URL_PRODUCT.'(:num)-(:any).html', 'Controllers\Front\Products@getProduct');
    Router::any(URL_CATEGORY.'(:num)-(:any).html', 'Controllers\Front\Categories@getCategory');



    Router::any(URL_ADMIN, 'Controllers\Main@index');
    Router::any(URL_ADMIN.'/register', 'Controllers\Main@register');
    Router::any(URL_ADMIN.'/login', 'Controllers\Main@authenticate');
    Router::any(URL_ADMIN.'/logout', 'Controllers\Main@logout');
    Router::any(URL_ADMIN.'/secured', 'Controllers\Main@secured');
endif;

/* Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/* If no route found. */
Router::error('Core\Error@index');

/* Turn on old style routing. */
Router::$fallback = false;

/* Execute matched routes. */
Router::dispatch();
