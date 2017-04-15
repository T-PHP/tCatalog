<?php 
namespace Models\Front;
 
use Core\Model;

class Auth extends Model 
{
    function __construct(){
        parent::__construct();
    } 
    
	public function getHash($email){
		$data = $this->db->select('
            SELECT 
                password 
            FROM 
                '.PREFIX.'customers 
            WHERE email = :email
            '
        ,array(':email' => $email));
        
        return $data[0]->password;
	}
    
    public function getCustomerInfos($email){
		return $this->db->select('
            SELECT 
                id_customer 
            FROM 
                '.PREFIX.'customers 
            WHERE 
                email = :email
            '
        ,array(':email' => $email));
	}
}
