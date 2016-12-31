<?php
/**
 * Products controller.
 *
 * @author Thibaut LASSERRE
 *
 * @version 1.0
 * @date Dec 23, 2016
 * @date updated Dec 23, 2016
 */
namespace Controllers\Front;
use Core\Language;
use Core\Controller;
use Core\View;
use Helpers\Database;
use Helpers\Url;

class Products extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->products = new \Models\Front\Products();
        $this->language->load('Products');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE."'"); 
    }

    /**
     * Get Product Informations.
     */
    public function getProduct($id_product, $url)
    {   
        //Product Informations
        $data['product'] = $this->products->getProduct($id_product, $this->active_language[0]->id_language);
        $data['attributes_groups'] = $this->products->getProductAttributes($id_product, $this->active_language[0]->id_language);
       
        //Var
        $title = $data['product'][0]->meta_title;
        $name = $data['product'][0]->name;
        $status = $data['product'][0]->status;
        $data['meta_description'] = $data['product'][0]->meta_description;
        
        //If Title is empty, we display product name in title
        if(!empty($title)):
            $data['title'] = $title;
        else:
            $data['title'] = $name;
        endif;
        
        //If product is Disable
        if($status == 0):
            View::renderTemplate('header', $data);
            View::render('products/disable', $data);
            View::renderTemplate('footer', $data);
            exit;
        endif;
        
        //If URL is wrong, redirect to right url
        if($url != $data['product'][0]->url):
            Url::redirect(DIR.URL_PRODUCT.$id_product.'-'.$data['product'][0]->url.'.html', $fullpath = true);
        //Else we display product page     
        else:
            //Display Quick View Modal
            if($_GET['quick-view'] == 1):
                View::render('products/quick-view', $data);
            else:
                View::renderTemplate('header', $data);
                View::render('products/product', $data);
                View::renderTemplate('footer', $data);
            endif;
        endif;     
    }
    
}
