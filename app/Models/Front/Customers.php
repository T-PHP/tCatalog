<?php 
namespace Models\Front;
 
use Core\Model;

class Customers extends Model 
{
    function __construct(){
        parent::__construct();
    }
    
    public function getAddressesByCustomer($id_customer, $type){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."customers_addresses ca
            WHERE 
                ca.id_customer = :id_customer
            AND 
                ca.type = :type
            ORDER BY 
                ca.alias ASC
			"
        ,array(':id_customer' => $id_customer, ':type' => $type));
	}
    
    /* Add New Customer */
    public function insertCustomer($data){
		$this->db->insert(PREFIX."customers",$data);
        
        return $this->db->lastInsertId('id_customer');
	}
    
    public function insertCustomerAddress($data){
		$this->db->insert(PREFIX."customers_addresses",$data);
	}
}
