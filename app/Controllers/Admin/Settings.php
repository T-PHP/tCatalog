<?php
/**
 * Admin Settings controller.
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
use Helpers\Csrf;

class Settings extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        if(!Session::get('loggedin')){
			Url::redirect(URL_ADMIN.'/login');
		}
        $this->languages = new \Models\Admin\Languages();
        $this->language->loadAdmin('Settings'); 
    }

    /**
     * Get Languages
     */
    public function getLanguages()
    {   
        $data['title'] = Language::showAdmin('Languages', 'Settings');
        $data['languages'] = $this->languages->getLanguages();
        $data['js'] = '
        <script language="Javascript" type="text/javascript">
		function delLanguage(id){
			if(confirm("Are you sure you want to delete this language ?")){
				window.location.href = "'.DIR.URL_ADMIN.'/settings/languages/del/" + id;
			}
		}
		</script>
        ';
        
        
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('settings/languages/languages', $data);
        View::renderTemplateAdmin('footer', $data);
       
    }
    
    /**
     * Add New Language
     */
    public function addLanguage()
    {   
        $data['title'] = Language::showAdmin('Add Language', 'Settings');
        $data['token'] = Csrf::makeToken();
        
        if(isset($_POST['addLanguage'])){
            $name = $_POST['name'];
			$iso = $_POST['iso'];
            
            if($name == ''){
				$error = Language::showAdmin('Name is required', 'Settings');
			}
            
            if($iso == ''){
				$error = Language::showAdmin('ISO is required', 'Settings');
			}

			if(!$error){
                //Insert Language
                $languageInfosData = array(
                    'name' => $name, 
                    'iso' => $iso, 
                );
                $this->languages->insertLanguage($languageInfosData);
                Session::set('message',Language::showAdmin('Language added', 'Settings'));
                Url::Redirect(DIR.URL_ADMIN.'/settings/languages', $fullpath = true);
            }
				
		}
        
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('settings/languages/add', $data);
        View::renderTemplateAdmin('footer', $data);  
    }
    
    /**
     * Delete Language
     */
    public function delLanguage($id_language){
        $this->languages->deleteLanguage(array('id_language' => $id_language));
		Session::set('message','Language Deleted');
        Url::Redirect(DIR.URL_ADMIN.'/settings/languages', $fullpath = true);
    }
    
}
