<?php
namespace Controllers\Admin;

use Helpers\Password;
use Helpers\Session;
use Helpers\Url;
use Core\View;
use Core\Controller;

class Auth extends Controller {

	public function login(){

		if(Session::get('loggedin')){
			Url::redirect(URL_ADMIN);
		}

		$model = new \Models\Admin\Auth();

		$data['title'] = 'Login';
        
		if(isset($_POST['submit'])){

			$email = $_POST['email'];
			$password = $_POST['password'];
            
            if (Password::verify($password, $model->getHash($email)) == 0) {
				$error[] = 'Wrong username of password';
			} else {
                $data['user_infos'] = $model->getUserAdminInfos($email);
                Session::set('id_user_admin', $data['user_infos'][0]->id_user_admin);
                Session::set('email', $email);
                Session::set('password', ''.$password.'');
				Session::set('loggedin',true);
				Url::redirect(URL_ADMIN.'/brands');
			}

		}

		View::renderTemplateAdmin('header-login',$data);
		View::renderAdmin('/login/index',$data,$error);
		View::renderTemplateAdmin('footer-login',$data);
	}

	public function logout(){

		Session::destroy();
		Url::redirect('admin/login');

	}

}