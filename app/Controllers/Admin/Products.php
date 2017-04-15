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
use Helpers\Data;
use Helpers\Database;
use Helpers\Session;
use Helpers\Url;
use Helpers\SimpleImage;
use Helpers\Csrf;

class Products extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        if(!Session::get('loggedin')){
			Url::redirect(URL_ADMIN.'/login');
		}
        
        $this->products = new \Models\Admin\Products();
        $this->categories = new \Models\Admin\Categories();
        $this->taxes = new \Models\Admin\Taxes();
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
        $data['product'] = $this->products->getProduct($id_product, $this->active_language[0]->id_language);
        $data['images'] = $this->products->getProductImages($id_product);
        $data['attributes_groups'] = $this->products->DEV_getProductAttributes($id_product, $this->active_language[0]->id_language);
       // Data::vd($data['attributes_groups']); exit;
        $data['taxes'] = $this->taxes->getTaxes();
        $data['categories'] = $this->categories->getCategories($this->active_language[0]->id_language);
        $data['brands'] = $this->brands->getBrands($this->active_language[0]->id_language);
        $data['meta_robots'] = $this->seo->getMetaRobots();
        $data['css'] = '
        <style>
        ul.sortable {overflow-x: hidden; width: 100%; float: left; margin: 20px 0; list-style: none; position: relative !important;} ul.sortable li {height: 200px; float: left; margin: 0 7px 7px 0; border: 2px solid #fff; cursor: move;} ul.sortable li img {height: 100%; float: left;} ul.sortable li.ui-sortable-helper {border-color: #3498db;} ul.sortable li.placeholder {width: 200px; height: 200px; float: left; background: #eee; border: 2px dashed #bbb; display: block; opacity: 0.6; border-radius: 2px; -moz-border-radius: 2px; -webkit-border-radius: 2px; }
  </style>
        <link rel="stylesheet" href="'.Url::templateAdminPath().'/css/jquery-ui-1.12.1/jquery-ui.min.css">';
        
        $data['js'] = '<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        <script type="text/javascript" src="'.Url::templateAdminPath().'js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
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
        <script>
        $(document).ready(
            function() {
                $("#sortme").sortable({
                    update : function () {
                        serial = $("#sortme").sortable("toArray");
                        serial = $("#sortme").sortable("serialize");
                        $.ajax({
                            url: "'.DIR.URL_ADMIN.'/products/edit/'.$id_product.'",
                            type: "get",
                            data: serial,
                            error: function(){
                            alert("theres an error with AJAX");
                            }
                             
                        });
                        $("#success-save-image").show();
                        $("#success-save-image").fadeOut(5000);
                    },
                    revert: 200,
                    delay: 100, 
			        placeholder: "placeholder",
                    helper: "clone", 
                });
                $("#sortme").disableSelection();
               
            });
        </script>
        <script>
            $(document).ready(
                function() {
                   var price = parseFloat($("#price").val());
                   var tax =  parseFloat($("#price_tax").find(":selected").data("tax-rate"));
                   var percent = (price*tax)/100;
                   var price_with_taxes = (price+percent);
                   $("#price_with_taxes").val(price_with_taxes);
                   
                   $("#price_tax").change(function () {
                   var price = parseFloat($("#price").val());
                    var tax = parseFloat($(this).find(":selected").data("tax-rate"));
                    var percent = (price*tax)/100;
                    var price_with_taxes = (price+percent);
                    $("#price_with_taxes").val(price_with_taxes);
                   });
                   
                   
                   $("#price").on("keyup",function (){
                    var price = parseFloat($("#price").val());
                    var tax =  parseFloat($("#price_tax").find(":selected").data("tax-rate"));
                    var percent = (price*tax)/100;
                    var price_with_taxes = (price+percent);
                       $("#price_with_taxes").val(price_with_taxes);
                    });
                   
                   
                }
            );
        </script>
        ';
        
       
        
		if(isset($_POST['editProduct'])){
            
            $status = $_POST['status'];
            $name = $_POST['name'];
            $id_category = $_POST['category'];
            $id_brand = $_POST['brand'];
            $id_tax = $_POST['price_tax'];
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
                
                
                //Update Product
				$productData = array(
                    'id_category' => $id_category,
                    'id_brand' => $id_brand, 
                    'id_tax' => $id_tax, 
                    'sku' => $sku,
                    'price' => $price, 
                    'status' => $status,
                );
                $where = array('id_product' => $id_product);
				$this->products->updateProduct($productData,$where);
                
                $productInfosData = array(
                        'id_language' => $this->active_language[0]->id_language,
                        'name' => $name, 
                        'short_description' => $short_description, 
                        'long_description' => $long_description, 
                        'meta_title' => $meta_title, 
                        'meta_description' => $meta_description, 
                        'meta_robots' => $meta_robots, 
                        'url' => Url::generateUrl($url), 

                    );
                $where = array('id_product' => $id_product, 'id_language' => $this->active_language[0]->id_language);
				$this->products->updateProductInfos($productInfosData,$where);
                
                //Session message & Redirect
				Session::set('message','Product updated');
				Url::Redirect(DIR.URL_ADMIN.'/products/edit/'.$id_product, $fullpath = true);
			}

		}
        
        if(isset($_POST['editProductImages'])){
            
            if($_FILES['images']['size'] > 0){
                //Create folder
                if (!is_dir(URL_IMG_PRODUCT.$id_product.'')) {
                    mkdir(URL_IMG_PRODUCT.$id_product.'');
                }
                //Define autorized extensions 
                $extension = array("jpeg","jpg","png","gif");
                
                $i = 0;
                foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name) {
                    $file_name=$_FILES["images"]["name"][$key];
                    $file_tmp=$_FILES["images"]["tmp_name"][$key];
                    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                    $extension_img = substr($_FILES['images']['name'][$key], -4);
                    $name_without_extension = substr(($_FILES['images']['name'][$key]), 0, -4);   
                    $image_name = Url::generateUrl($name_without_extension).$extension_img;
                
                    $file = URL_IMG_PRODUCT.$id_product.'/'.$image_name;
                    $file_small = URL_IMG_PRODUCT.$id_product.'/s-'.$image_name;
                    $file_medium = URL_IMG_PRODUCT.$id_product.'/m-'.$image_name;
                    $file_large = URL_IMG_PRODUCT.$id_product.'/l-'.$image_name;
                    
                    $i++;
                    
                    if(in_array($ext,$extension))
                    {
                        //Uploaded image
                        move_uploaded_file($file_tmp=$_FILES["images"]["tmp_name"][$key],$file);
                        move_uploaded_file($_FILES['images']['tmp_name'][$key], $file_small);
                        move_uploaded_file($_FILES['images']['tmp_name'][$key], $file_medium);
                        move_uploaded_file($_FILES['images']['tmp_name'][$key], $file_large);
                        
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
                        
                        
                        //Update Product
                        $productImagesData = array(
                            'id_product' => $id_product,
                            'image' => $image_name, 
                            'sort' => $i,
                        );
                        $this->products->insertProductImages($productImagesData);
                        
                    }
                    else
                    {
                        echo "error. non autorized extensil file";
                    }
                }
                //Session message & Redirect
				Session::set('message','Images Updated');
				Url::Redirect(DIR.URL_ADMIN.'/products/edit/'.$id_product, $fullpath = true);
            }
            
        }
   
        
        if(isset($_GET['orderImage'])){
            foreach ($_GET['orderImage'] as $position => $item) {
                $productImagesData = array(
                    'sort' => $position,
                );
                $where = array('id_product_image' => $item);
                $this->products->updateProductImages($productImagesData, $where);
            }      
        }

		View::renderTemplateAdmin('header',$data);
		View::renderAdmin('products/edit',$data,$error);
		View::renderTemplateAdmin('footer',$data);

	}
    
    
}
