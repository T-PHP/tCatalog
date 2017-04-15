<?php
/**
 * Cart controller.
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
use Helpers\Paginator;
use Helpers\Url;
use Helpers\Session;
use Helpers\Password;

class Cart extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->cart = new \Models\Front\Cart();
        $this->products = new \Models\Front\Products();
        $this->auth = new \Models\Front\Auth();
        $this->customers = new \Models\Front\Customers();
        $this->language->load('Cart');
        
        //Get Active Language
        $db = Database::get();
        $this->active_language = $db->select("SELECT * FROM ".PREFIX."languages WHERE iso = '".LANGUAGE_CODE."'"); 
        
        //Define Session Cart
        if(!isset($_SESSION['cart'])):    
            $_SESSION['cart'] = array();
        endif;
        
        if(isset($_POST['cart']['qty'])):
            $this->recalculate();
        endif;
        
        if(isset($_GET['del'])): 
            $this->delProduct($_GET['del']);
        endif;
        
    }

    /**
     * Get Cart.
     */
    public function getCart()
    {   
        $data['title'] = Language::show('Cart', 'Cart');
        
        //unset($_SESSION['cart']);
        //unset($_SESSION['cart'][4]);
        
        if(empty($_SESSION['cart'])):
            View::renderTemplate('header', $data);
            View::render('cart/cart-empty', $data);
            View::renderTemplate('footer', $data);
        else:
            $data['products'] = $this->cart->getCartProducts($this->active_language[0]->id_language);
            $data['sub_total_cart'] = $this->cart->getSubTotalCart($this->active_language[0]->id_language);
            $data['total_quantity'] = $this->cart->getTotalQuantity();
            View::renderTemplate('header', $data);
            View::render('cart/cart', $data);
            View::renderTemplate('footer', $data);
        endif;
        
        
        if(isset($_GET['add'])):
            //Check if parameter is numeric
            if(is_numeric($_GET['add'])):
                $this->addProduct($_GET['add']);
            else:
                unset($_SESSION['cart'][$_GET['add']]);
            endif;
        endif;
        
    }
    
    public function addProduct($id_product)
    {   
        $data['title'] = '';
        $data['product'] = $this->products->getProduct($id_product, $this->active_language[0]->id_language);
        
        //If product is in Session, incremente qty
        if(isset($_SESSION['cart'][$id_product])):
            $_SESSION['cart'][$id_product]++;
        else:
            $_SESSION['cart'][$id_product] = 1;
        endif;
        
        Session::set('message',Language::show('Product added', 'Cart'));
        Url::Redirect(DIR.URL_CART, $fullpath = true);
    }
    
    public function recalculate()
    {
        foreach($_SESSION['cart'] as $id_product => $qty):
            if(isset($_POST['cart']['qty'][$id_product])):
                //If Qty < 1 OR Qty is empty : delete product in cart
                if($qty < 1 OR $qty == ''):
                    $this->delProduct($id_product);
                endif;
                $_SESSION['cart'][$id_product] = $_POST['cart']['qty'][$id_product];
            endif;
        endforeach;
    }
    
    public function delProduct($id_product)
    {   
        unset($_SESSION['cart'][$id_product]);
       
    }
    
    /**
     * Get Account Page.
     */
    public function account()
    {
        if(Session::get('customerLogin')){
			Url::redirect(DIR.URL_CART, $fullpath = true);
		}
        
        $data['title'] = Language::show('Account', 'Cart');
        
        //Post Form Login
        if(isset($_POST['login_customer'])){
			$email = $_POST['email'];
			$password = $_POST['password'];
            
            if (Password::verify($password, $this->auth->getHash($email)) == 0) {
				$error[] = Language::show('Wrong username of password', 'Cart');
			} else {
                $data['customer_infos'] = $this->auth->getCustomerInfos($email);
                Session::set('id_customer', $data['customer_infos'][0]->id_customer);
                Session::set('email', $email);
				Session::set('customerLogin',true);
				Url::Redirect(DIR.URL_CART, $fullpath = true);
			}
		}
        
        //Post Form New Customer
        if(isset($_POST['new_customer'])){
			$lastname = $_POST['lastname'];
			$firstname = $_POST['firstname'];
            $address1 = $_POST['address1'];
            $address2 = $_POST['address2'];
            $postal_code = $_POST['postal_code'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $mobile_phone = $_POST['mobile_phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $hash = Password::make($password);
            
            if($email == ''){
				$error = Language::show('Email is required', 'Cart');
			}

			if(!$error){
                //Insert New Customer
                $customerData = array(
                    'email' => $email, 
                    'password' => $hash, 
                    'status' => '1'
                );
                $data['lastId'] = $this->customers->insertCustomer($customerData);
                $customerAddressData = array(
                    'id_customer' => $data['lastId'],
                    'alias' => Language::show('My Address', 'Cart'), 
                    'lastname' => $lastname, 
                    'firstname' => $firstname, 
                    'address1' => $address1, 
                    'address2' => $address2, 
                    'postal_code' => $postal_code, 
                    'city' => $city, 
                    'phone' => $phone, 
                );
                $this->customers->insertCustomerAddress($customerAddressData);
                
                //Login User
                if (Password::verify($password, $this->auth->getHash($email)) == 0) {
                    $error[] = Language::show('Wrong username of password', 'Cart');
                } else {
                    $data['customer_infos'] = $this->auth->getCustomerInfos($email);
                    Session::set('id_customer', $data['customer_infos'][0]->id_customer);
                    Session::set('email', $email);
                    Session::set('customerLogin',true);
                }
                
                Url::Redirect(DIR.URL_CART, $fullpath = true);
            }
		}
        
        View::renderTemplate('header', $data);
        View::render('cart/account', $data, $error);
        View::renderTemplate('footer', $data);
    }
    
     /**
     * Get Address Page.
     */
    public function address()
    {
        
        if(!Session::get('customerLogin')){
			Url::redirect(DIR.URL_CART.'/account', $fullpath = true);
		}
        $data['title'] = Language::show('Address', 'Cart');
        
        $data['delivery_addresses'] = $this->customers->getAddressesByCustomer(Session::get('id_customer'), 1);
        $data['invoicing_addresses'] = $this->customers->getAddressesByCustomer(Session::get('id_customer'), 2);
        var_dump($data['invoicing_addresses']);
        View::renderTemplate('header', $data);
        View::render('cart/address', $data, $error);
        View::renderTemplate('footer', $data);
    }
    
    /**
     * Logout
     */
    public function logout()
    {
        Session::destroy('id_customer');
        Session::destroy('email');
        Session::destroy('customerLogin');
		Url::Redirect(DIR.URL_CART, $fullpath = true);
    }    
    
}
