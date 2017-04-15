<?php 
namespace Models\Admin;
 
use Core\Model;

class Auth extends Model 
{
    function __construct(){
        parent::__construct();
    } 
    
	public function getHash($email){
		$data = $this->db->select('SELECT password FROM '.PREFIX.'users_admin WHERE email = :email',array(':email' => $email));
        return $data[0]->password;
	}
    
    public function getUserAdminInfos($email){
		return $this->db->select('SELECT id_user_admin FROM '.PREFIX.'users_admin WHERE email = :email',array(':email' => $email));
        
	}
}
