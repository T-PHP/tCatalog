<?php
/**
 * Admin Seo controller.
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

class Seo extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->seo = new \Models\Admin\Seo();
        $this->language->loadAdmin('Seo');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE_ADMIN."'"); 
    }

    /**
     * Meta Robots
     */
    public function getMetaRobots() {   
        $data['title'] = Language::showAdmin('Meta Robots', 'Seo');
        $data['token'] = Csrf::makeToken();
        $data['meta_robots'] = $this->seo->getMetaRobots();
        
        $data['js'] = '<script language="Javascript" type="text/javascript">
		function delMetaRobots(id){
			if(confirm("Are you sure you want to delete this Meta Robots ?")){
				window.location.href = "'.DIR.'admin/seo/meta-robots/del/" + id;
			}
		}
		</script>
        ';
        
        if(isset($_POST['addMetaRobots'])){
			$content = $_POST['content'];
            
            if($content == ''){
				$error[] = Language::showAdmin('Content is required', 'Seo');
			}

			if(!$error){
                $metaRobotsData = array(
                    'content' => $content,
                );
                $this->seo->insertMetaRobots($metaRobotsData);
                
                Session::set('message',Language::showAdmin('Meta Robots added', 'Seo'));
                Url::Redirect(DIR.URL_ADMIN.'/seo/meta-robots', $fullpath = true);
            }	
		}
        
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('seo/meta-robots', $data, $error);
        View::renderTemplateAdmin('footer', $data);
    }
 
    /**
     * Delete Meta Robots
     */
    public function delMetaRobots($id_meta_robots){
        $this->seo->deleteMetaRobots(array('id_meta_robots' => $id_meta_robots));
		Session::set('message',Language::showAdmin('Meta Robots deleted', 'Seo'));
        Url::redirect(DIR.URL_ADMIN.'/seo/meta-robots', $fullpath = true);
    }
    
    public function getRobotsTxt() {   
        $data['title'] = Language::showAdmin('Robots.txt File', 'Seo');
        $data['token'] = Csrf::makeToken();
        
        $file = DIR.'robots.txt';
        $data['content'] = file_get_contents($file);
        
        
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('seo/robots-txt', $data, $error);
        View::renderTemplateAdmin('footer', $data);
    }
    
    
}
