<?php 
namespace Modules\LastProducts\Controllers;

use Core\Controller;
use Core\View;
use Core\Router;
use Helpers\Database;
use Helpers\Url;
use Helpers\Menu;

class LastProducts extends Controller 
{ 
    
	public function __construct(){
        
        parent::__construct();
        $this->lastproducts = new \Modules\LastProducts\Models\LastProducts();
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE."'");
	}

    /**
     * Display Last Products List
     */
    public function index()
    {
        $data['last_products'] = $this->lastproducts->getProducts($this->active_language[0]->id_language);
       
        View::renderModule('LastProducts/view/index', $data);
        
    }
    
    public function js()
    {
      echo "<script type='text/javascript'>
            $('.modal-quick-view').on('click', function(e){
                e.preventDefault();
                $('#modalProduct').modal('show').find('.modal-body').load($(this).attr('href'));
            });
      </script>";
         
    }

 }





