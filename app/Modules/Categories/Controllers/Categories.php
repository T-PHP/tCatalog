<?php 
namespace Modules\Categories\Controllers;

use Core\Controller;
use Core\View;
use Core\Router;
use Helpers\Url;
use Helpers\Menu;

class Categories extends Controller 
{ 
    
	public function __construct(){
        
        parent::__construct();
        $this->categories = new \Modules\Categories\Models\Categories();
        //$this->language->load('ModuleCategories');
	}

    /**
     * Display Categories List
     */
    public function index()
    {
        
        $pages = $this->categories->get_categories();
        
        //$pages = $this->model->getPages();
        $data['menu'] = Menu::getList($pages, $id = 'id_category', $title = 'name', $slug = 'url', $parent = 'id_parent_category');

        View::renderModule('Categories/view/index', $data);
        
    }

 }





