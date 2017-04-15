<?php
/**
 * Admin Categories controller.
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

class Categories extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        if(!Session::get('loggedin')){
			Url::redirect(URL_ADMIN.'/login');
		}
        
        $this->categories = new \Models\Admin\Categories();
        $this->seo = new \Models\Admin\Seo();
        $this->language->loadAdmin('Categories');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE_ADMIN."'"); 
    }

    /**
     * Get Categories List
     */
    public function getCategories() {   
        $data['title'] = Language::showAdmin('Categories', 'Categories');
        $data['categories'] = $this->categories->getCategories($this->active_language[0]->id_language);
        
        $data['css'] = '<link href="'.Url::templateAdminPath().'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">';
        $data['js'] = '
        <script src="'.Url::templateAdminPath().'js/datatables/jquery.dataTables.min.js"></script>
        <script src="'.Url::templateAdminPath().'js/datatables/dataTables.bootstrap.min.js"></script>      
        <script>
        $( document ).ready(function() {
          $(function () {
            $("#categories").DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false
            });
          });
        });
        </script>
        
        <script language="Javascript" type="text/javascript">
		function delCategory(id){
			if(confirm("Are you sure you want to delete this category ?")){
				window.location.href = "'.DIR.'admin/categories/del/" + id;
			}
		}
		</script>
        ';

        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('categories/categories', $data);
        View::renderTemplateAdmin('footer', $data);
    }
    
    /**
     * Add New Product
     */
    public function addCategory(){
        $data['title'] = Language::showAdmin('Add category', 'Categories');
        $data['token'] = Csrf::makeToken();
        $data['categories'] = $this->categories->getCategories($this->active_language[0]->id_language);
        $data['meta_robots'] = $this->seo->getMetaRobots();
        $data['js'] = '<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        <script>
        $( document ).ready(function() {
          $(function () {
            CKEDITOR.replace("short_description");
            CKEDITOR.replace("long_description");
          });
        });
        </script>
        ';
        
        if(isset($_POST['addCategory'])){
			$name = $_POST['name'];
            $id_parent_category = $_POST['id_parent_category'];
			$short_description = $_POST['short_description'];
            $long_description = $_POST['long_description'];
            $meta_title = $_POST['meta_title'];
            $meta_description = $_POST['meta_description'];
            $meta_robots = $_POST['meta_robots'];
            $url = Url::generateUrl($name);
            
            if($name == ''){
				$error = Language::showAdmin('Name is required', 'Categories');
			}

			if(!$error){
                $categoryData = array(
                    'id_parent_category' => $id_parent_category,
                );
                $data['lastId'] = $this->categories->insertCategory($categoryData);
                $categoryInfosData = array(
                        'id_category' => $data['lastId'],
                        'id_language' => $this->active_language[0]->id_language,
                        'name' => $name, 
                        'short_description' => $short_description, 
                        'long_description' => $long_description, 
                        'meta_title' => $meta_title, 
                        'meta_description' => $meta_description, 
                        'meta_robots' => $meta_robots, 
                        'url' => Url::generateUrl($url), 

                    );
                $this->categories->insertCategoryInfos($categoryInfosData);
                Session::set('message',Language::showAdmin('Category added', 'Categories'));
                Url::Redirect(DIR.URL_ADMIN.'/categories', $fullpath = true);
            }
				
		}
        
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('categories/add', $data, $error);
        View::renderTemplateAdmin('footer', $data);
    }
    
    /**
     * Edit Category
     */
    public function editCategory($id_category){
		
		$data['title'] = Language::showAdmin('Edit category', 'Categories');
        $data['token'] = Csrf::makeToken();
        
        $data['category'] = $this->categories->getCategory($id_category, $this->active_language[0]->id_language);
        
        $data['categories'] = $this->categories->getCategories($this->active_language[0]->id_language);
        $data['meta_robots'] = $this->seo->getMetaRobots();
        $data['js'] = '<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        <script>
        $( document ).ready(function() {
          $(function () {
            CKEDITOR.replace("short_description");
            CKEDITOR.replace("long_description");
          });
        });
        </script>
        ';
        
		if(isset($_POST['editCategory'])){
            $status = $_POST['status'];
            $name = $_POST['name'];
            $id_parent_category = $_POST['id_parent_category'];
			$short_description = $_POST['short_description'];
            $long_description = $_POST['long_description'];
            $meta_title = $_POST['meta_title'];
            $meta_description = $_POST['meta_description'];
            $meta_robots = $_POST['meta_robots'];
            $url = $_POST['url'];
            
			if($name == ''){
				$error[] = 'Name is required';
			}

			if(!$error){
				$categoryData = array(
                    'id_parent_category' => $id_parent_category, 
                    'status' => $status, 
                );
                $where = array('id_category' => $id_category);
				$this->categories->updateCategory($categoryData,$where);
                
                $categoryInfosData = array(
                        'id_category' => $id_category,
                        'name' => $name, 
                        'short_description' => $short_description, 
                        'long_description' => $long_description, 
                        'meta_title' => $meta_title, 
                        'meta_description' => $meta_description, 
                        'meta_robots' => $meta_robots,  
                        'url' => Url::generateUrl($url), 

                    );
                $where = array('id_category' => $id_category, 'id_language' => $this->active_language[0]->id_language);
				$this->categories->updateCategoryInfos($categoryInfosData,$where);
                
				Session::set('message',Language::showAdmin('Category updated', 'Categories'));
                Url::Redirect(DIR.URL_ADMIN.'/categories/edit/'.$id_category, $fullpath = true);
				
			}

		}

		View::renderTemplateAdmin('header',$data);
		View::renderAdmin('categories/edit',$data,$error);
		View::renderTemplateAdmin('footer',$data);

	}
    
    /**
     * Delete Category
     */
    public function delCategory($id_category){
        $this->categories->deleteCategory(array('id_category' => $id_category));
		Session::set('message','Category Deleted');
        Url::redirect('admin/categories');
    }
    
    
}
