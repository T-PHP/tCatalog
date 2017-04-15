<?php
/**
 * Admin Brands controller.
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
use Helpers\SimpleImage;
use Helpers\Csrf;

class Brands extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        if(!Session::get('loggedin')){
			Url::redirect(URL_ADMIN.'/login');
		}
        
        $this->brands = new \Models\Admin\Brands();
        $this->seo = new \Models\Admin\Seo();
        $this->language->loadAdmin('Brands');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE_ADMIN."'"); 
    }

    /**
     * Get Brands List
     */
    public function getBrands() {   
        $data['title'] = Language::showAdmin('Brands', 'Brands');
        $data['brands'] = $this->brands->getBrands($this->active_language[0]->id_language);
        
        $data['css'] = '<link href="'.Url::templateAdminPath().'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">';
        $data['js'] = '
        <script src="'.Url::templateAdminPath().'js/datatables/jquery.dataTables.min.js"></script>
        <script src="'.Url::templateAdminPath().'js/datatables/dataTables.bootstrap.min.js"></script>      
        <script>
        $( document ).ready(function() {
          $(function () {
            $("#brands").DataTable({
              "order": [[ 3, "asc" ]], 
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
		function delBrand(id){
			if(confirm("Are you sure you want to delete this brand ?")){
				window.location.href = "'.DIR.'admin/brands/del/" + id;
			}
		}
		</script>
        ';

        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('brands/brands', $data);
        View::renderTemplateAdmin('footer', $data);
    }
    
    /**
     * Add New Brand
     */
    public function addBrand(){
        $data['title'] = Language::showAdmin('Add brand', 'Brands');
        $data['token'] = Csrf::makeToken();
        $data['brands'] = $this->brands->getBrands(active_language[0]->id_language);
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
        
        if(isset($_POST['addBrand'])){
            $name = $_POST['name'];
			$short_description = $_POST['short_description'];
            $long_description = $_POST['long_description'];
            $meta_title = $_POST['meta_title'];
            $meta_description = $_POST['meta_description'];
            $meta_robots = $_POST['meta_robots'];
            $url = $_POST['url'];
            
            if(!empty($url)):
                $url = Url::generateUrl($url);
            else:
                $url = Url::generateUrl($name);
            endif;
            
            if($name == ''){
				$error = Language::showAdmin('Name is required', 'Brands');
			}

			if(!$error){
                
                //Insert Brand
                $brandData = array(
                    'status' => '', 
                );
                $data['lastId'] = $this->brands->insertBrand($brandData);
                $brandInfosData = array(
                    'id_brand' => $data['lastId'],
                    'id_language' => $this->active_language[0]->id_language,
                    'name' => $name, 
                    'short_description' => $short_description, 
                    'long_description' => $long_description, 
                    'meta_title' => $meta_title, 
                    'meta_description' => $meta_description, 
                    'meta_robots' => $meta_robots, 
                    'url' => $url, 

                );
                $this->brands->insertBrandInfos($brandInfosData);
                Session::set('message',Language::showAdmin('Brand added', 'Brands'));
                Url::Redirect(DIR.URL_ADMIN.'/brands', $fullpath = true);
            }
				
		}
        
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('brands/add', $data, $error);
        View::renderTemplateAdmin('footer', $data);
    }
    
    /**
     * Edit Brand
     */
    public function editBrand($id_brand){
		
		$data['title'] = Language::showAdmin('Edit brand', 'Brands');
        $data['token'] = Csrf::makeToken();
        $data['brand'] = $this->brands->getBrand($id_brand, $this->active_language[0]->id_language);
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
        
		if(isset($_POST['editBrand'])){
            $status = $_POST['status'];
            $name = $_POST['name'];
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
                
                //Image
                if($_FILES['image']['size'] > 0){
                    //Create Folder
                    if (!is_dir(URL_IMG_BRAND.$id_brand.'')) {
                        mkdir(URL_IMG_BRAND.$id_brand.'');
                    }
                    
                    $extension_img = substr($_FILES['image']['name'], -4);
                    $name_without_extension = substr(($_FILES['image']['name']), 0, -4);   
                    $image_name = Url::generateUrl($name_without_extension).$extension_img;
                
                    $file = URL_IMG_BRAND.$id_brand.'/'.$image_name;
                    $file_small = URL_IMG_BRAND.$id_brand.'/s-'.$image_name;
                    $file_medium = URL_IMG_BRAND.$id_brand.'/m-'.$image_name;
                    $file_large = URL_IMG_BRAND.$id_brand.'/l-'.$image_name;
                     
                    //Uploaded image
                    move_uploaded_file($_FILES['image']['tmp_name'], $file);
                    move_uploaded_file($_FILES['image']['tmp_name'], $file_small);
                    move_uploaded_file($_FILES['image']['tmp_name'], $file_medium);
                    move_uploaded_file($_FILES['image']['tmp_name'], $file_large);
                    
                    //Resize & Save images
                    $image = new SimpleImage($file);
                    $image->save($file);
                    
                    $img_small = new SimpleImage($file);
                    $img_small->maxareafill(300,300, 255, 255, 255);
                    $img_small->save($file_small);
                    
                    $img_medium = new SimpleImage($file);
                    $img_medium->maxareafill(600,600, 255, 255, 255);
                    $img_medium->save($file_medium);
                    
                    $img_large = new SimpleImage($file);
                    $img_large->maxareafill(1000,1000, 255, 255, 255);
                    $img_large->save($file_large);
                }    
                
                
                //Update Brand Data
				$brandData = array(
                    'image' => $image_name, 
                    'status' => $status,
                );
                $where = array('id_brand' => $id_brand);
				$this->brands->updateBrand($brandData,$where);
                
                $brandInfosData = array(
                    'id_brand' => $id_brand,
                    'name' => $name, 
                    'short_description' => $short_description, 
                    'long_description' => $long_description, 
                    'meta_title' => $meta_title, 
                    'meta_description' => $meta_description, 
                    'meta_robots' => $meta_robots,  
                    'url' => Url::generateUrl($url), 

                );
                $where = array('id_brand' => $id_brand, 'id_language' => $this->active_language[0]->id_language);
                $this->brands->updateBrandInfos($brandInfosData,$where);
				
                //Session message & Redirect
				Session::set('message',Language::showAdmin('Brand updated', 'Brands'));
                Url::Redirect(DIR.URL_ADMIN.'/brands/edit/'.$id_brand, $fullpath = true);
				
			}

		}

		View::renderTemplateAdmin('header',$data);
		View::renderAdmin('brands/edit',$data,$error);
		View::renderTemplateAdmin('footer',$data);

	}
    
    /**
     * Delete Brand
     */
    public function delCategory($id_brand){
        $this->brands->deleteBrand(array('id_brand' => $id_brand));
		Session::set('message','Brand Deleted');
        Url::redirect('admin/brands');
    }
    
    
}
