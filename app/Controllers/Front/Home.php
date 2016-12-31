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

class Home extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->language->load('Home');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE."'"); 
    }

    /**
     * Get Homepage
     */
    public function index()
    {   
        $data['title'] = Language::show('title', 'Home');;
        
        View::renderTemplate('header', $data);
        View::render('home/home', $data);
        View::renderTemplate('footer', $data);
       
    }
    
}
