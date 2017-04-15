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
use Helpers\Data;
use Helpers\Database;
use Helpers\Url;

class Home extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->language->load('Home');
        $this->brands = new \Models\Front\Brands();
        
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
        $data['brands'] = $this->brands->getBrands($this->active_language[0]->id_language);
        //Data::vd($data['brands']);
        $data['css']  = '<link href="'.Url::templatePath().'css/jquery-bxslider-4.2.5/jquery.bxslider.css" rel="stylesheet" type="text/css">';
        
        $data['js']  = '
        <script src="'.Url::templatePath().'js/jquery-bxslider-4.2.5/jquery.bxslider.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(".bxslider").bxSlider({
              minSlides: 3,
              maxSlides: 4,
              slideWidth: 200,
              slideMargin: 10
            });
        </script>
        ';
        
        
        View::renderTemplate('header', $data);
        View::render('home/home', $data);
        View::renderTemplate('footer', $data);
       
    }
    
}
