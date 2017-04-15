<?php
/**
 * Admin Home controller.
 *
 * @author Thibaut LASSERRE
 *
 * @version 1.0
 * @date Dec 23, 2016
 * @date updated Dec 23, 2016
 */
namespace Controllers\Admin;
use Core\Language;
use Core\Controller;
use Core\View;
use Helpers\Database;
use Helpers\Session;
use Helpers\Url;

class Home extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        if(!Session::get('loggedin')){
			Url::redirect(URL_ADMIN.'/login');
		}
        
        $this->language->loadAdmin('Home');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE_ADMIN."'"); 
    }

    /**
     * Get Home Index
     */
    public function index()
    {   
        $data['title'] = "Admin";
            
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('home/index', $data);
        View::renderTemplateAdmin('footer', $data);
       
    }
    
}
