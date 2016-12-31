<?php
/**
 * Admin Products controller.
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

class Products extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->products = new \Models\Admin\Products();
        $this->categories = new \Models\Admin\Categories();
        $this->brands = new \Models\Admin\Brands();
        $this->seo = new \Models\Admin\Seo();
        $this->language->loadAdmin('Products');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE_ADMIN."'"); 
    }

    /**
     * Get Products List
     */
    public function getProducts() {   
        $data['title'] = Language::showAdmin('Products', 'Products');
        $data['products'] = $this->products->getProducts($this->active_language[0]->id_language);
        
        $data['css'] = '<link href="'.Url::templateAdminPath().'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">';
        $data['js'] = '
        <script src="'.Url::templateAdminPath().'js/datatables/jquery.dataTables.min.js"></script>
        <script src="'.Url::templateAdminPath().'js/datatables/dataTables.bootstrap.min.js"></script>      
        <script>
        $( document ).ready(function() {
          $(function () {
            $("#products").DataTable({
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
        ';

        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('products/products', $data);
        View::renderTemplateAdmin('footer', $data);
    }
    
    public function addProduct(){
        $data['title'] = Language::showAdmin('Add product', 'Products');
        $data['token'] = Csrf::makeToken();
        $data['categories'] = $this->categories->getCategories($this->active_language[0]->id_language);
        $data['brands'] = $this->brands->getBrands($this->active_language[0]->id_language);
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
        
        if(isset($_POST['addProduct'])){
			$name = $_POST['name'];
            $id_category = $_POST['category'];
            $id_brand = $_POST['brand'];
            $sku = $_POST['sku'];
			$short_description = $_POST['short_description'];
            $long_description = $_POST['long_description'];
            $price = $_POST['price'];
            $meta_title = $_POST['meta_title'];
            $meta_description = $_POST['meta_description'];
            $meta_robots = $_POST['meta_robots'];
            $url = Url::generateUrl($name);
            
            if($name == ''){
				$error = 'Name is required';
			}

			if(!$error){
                $productData = array(
                    'id_category' => $id_category,
                    'id_brand' => $id_brand, 
                    'sku' => $sku,
                    'price' => $price, 
                );
                $data['lastId'] = $this->products->insertProduct($productData);
                $productInfosData = array(
                        'id_product' => $data['lastId'],
                        'id_language' => $this->active_language[0]->id_language,
                        'name' => $name, 
                        'short_description' => $short_description, 
                        'long_description' => $long_description, 
                        'meta_title' => $meta_title, 
                        'meta_description' => $meta_description, 
                        'meta_robots' => $meta_robots, 
                        'url' => Url::generateUrl($url), 

                    );
                $this->products->insertProductInfos($productInfosData);
                Session::set('message',Language::showAdmin('Categories', 'Products'));
            }
				
		}
        
        View::renderTemplateAdmin('header', $data);
        View::renderAdmin('products/add', $data, $error);
        View::renderTemplateAdmin('footer', $data);
    }
    
    public function editProduct($id_product){
		
		$data['title'] = Language::showAdmin('Edit product', 'Products');
        $data['token'] = Csrf::makeToken();
        
		//$data['row'] = $this->posts->get_post($id);
        //$data['posts'] = $this->posts->get_posts();
        $data['product'] = $this->products->getProduct($id_product, $this->active_language[0]->id_language);
        
        $data['categories'] = $this->categories->getCategories($this->active_language[0]->id_language);
        $data['brands'] = $this->brands->getBrands($this->active_language[0]->id_language);
        $data['meta_robots'] = $this->seo->getMetaRobots();
        $data['js'] = '<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        <script>
        $( document ).ready(function() {
          $(function () {
            CKEDITOR.replace("short_description",
            {
                 height: 150
            });
            CKEDITOR.replace("long_description",
            {
                 height: 150
            });
          });
        });
        </script>
        ';
        
		if(isset($_POST['editProduct'])){
            
            $name = $_POST['name'];
            $id_category = $_POST['category'];
            $id_brand = $_POST['brand'];
            $sku = $_POST['sku'];
			$short_description = $_POST['short_description'];
            $long_description = $_POST['long_description'];
            $price = $_POST['price'];
            $meta_title = $_POST['meta_title'];
            $meta_description = $_POST['meta_description'];
            $meta_robots = $_POST['meta_robots'];
            $url = $_POST['url'];
            
			if($name == ''){
				$error[] = 'Name is required';
			}

			if(!$error){
				$productData = array(
                    'id_category' => $id_category,
                    'id_brand' => $id_brand, 
                    'sku' => $sku,
                    'price' => $price, 
                );
                $where = array('id_product' => $id_product);
				$this->products->updateProduct($productData,$where);
                
                $productInfosData = array(
                        'id_product' => $data['lastId'],
                        'id_language' => $this->active_language[0]->id_language,
                        'name' => $name, 
                        'short_description' => $short_description, 
                        'long_description' => $long_description, 
                        'meta_title' => $meta_title, 
                        'meta_description' => $meta_description, 
                        'meta_robots' => $meta_robots, 
                        'url' => Url::generateUrl($url), 

                    );
                $where = array('id_product' => $id_product);
				$this->products->updateProductInfos($productInfosData,$where);
                
				Session::set('message','Post Updated');
				
			}

		}
        
        
       /* if(isset($_POST['image'])){
            
            if($_FILES['post_image']['size'] > 0){
                if (!is_dir('images/posts/'.$id.'')) {
                    mkdir('images/posts/'.$id.'');
                }

                $extension_img = substr($_FILES['post_image']['name'], -4);
                $name_without_extension = substr(($_FILES['post_image']['name']), 0, -4);   
                $image_name = Url::generateUrl($name_without_extension).$extension_img;
               //var_dump($_FILES['brand_image']['name']); exit;
                $file = 'images/posts/'.$id.'/'.$image_name;
                $file_mini = 'images/posts/'.$id.'/m-'.$image_name;

                move_uploaded_file($_FILES['post_image']['tmp_name'], $file);
                move_uploaded_file($_FILES['post_image']['tmp_name'], $file_mini);

                $img = new SimpleImage($file);
                $img->save($file, 70);

                $img_mini = new SimpleImage($file);
                $img_mini->load($file)->fit_to_width(850)->fit_to_height(355)->save($file_mini);

                $postdata = array(
                    'post_image' => $image_name, 
                    'post_modified' => (new \DateTime())->format('Y-m-d H:i:s')
                );

                $where = array('post_id' => $id);
                $this->posts->update_post($postdata,$where);

                Session::set('message','Image Updated');
                Url::redirect('admin/posts/edit/'.$id.'');
            }
		}*/

		View::renderTemplateAdmin('header',$data);
		View::renderAdmin('products/edit',$data,$error);
		View::renderTemplateAdmin('footer',$data);

	}
    
    
}
