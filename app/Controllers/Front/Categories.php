<?php
/**
 * Categories controller.
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
use Helpers\Paginator;
use Helpers\Url;

class Categories extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->categories = new \Models\Front\Categories();
        $this->products = new \Models\Front\Products();
        $this->language->load('Categories');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE."'"); 
        
    }

    /**
     * Get Category Informations.
     */
    public function getCategory($id_category, $url)
    {   
        
        $data['js'] = "
        <script type='text/javascript'>
            $('.modal-quick-view').on('click', function(e){
                e.preventDefault();
                $('#modalProduct').modal('show').find('.modal-body').load($(this).attr('href'));
            });
        </script>
            ";
        //Paginator
        $pages = new Paginator(PRODUCTS_BY_PAGE,'p');
        
        //Get Category & Sub-Categories Informations
        $data['category'] = $this->categories->getCategory($id_category, $this->active_language[0]->id_language);
        $data['sub_categories'] = $this->categories->getSubCategories($id_category, $this->active_language[0]->id_language);
        
        //Get Products by Category (Listing)
        $data['products'] = $data['products'] = $this->products->getProductsByCategory($id_category, $this->active_language[0]->id_language, $pages->getLimit());
      //  var_dump($data['products']); exit;
        $data['products_total'] = count($this->products->getProductsByCategoryTotal($id_category, $this->active_language[0]->id_language));
        $pages->setTotal($data['products_total']);
        $data['pageLinks'] = $pages->pageLinks();
        
        
        //Define Var
        $title = $data['category'][0]->meta_title;
        $name = $data['category'][0]->name;
        $status = $data['category'][0]->status;
        $data['meta_description'] = $data['category'][0]->meta_description;
        
        //If Title is empty, we display category name in title
        if(!empty($title)):
            $data['title'] = $title;
        else:
            $data['title'] = $name;
        endif;
        
        //If category is Disable
        if($status == 0):
            View::renderTemplate('header', $data);
            View::render('categories/disable', $data);
            View::renderTemplate('footer', $data);
            exit;
        endif;
        
        //If URL is wrong, redirect to right url
        if($url != $data['category'][0]->url):
            Url::redirect(DIR.URL_CATEGORY.$id_category.'-'.$data['category'][0]->url.'.html', $fullpath = true);
        //Else we display category page     
        else:
            View::renderTemplate('header', $data);
            View::render('categories/category', $data);
            View::renderTemplate('footer', $data);
        endif;     
    }
    
}
