<?php 
namespace Models\Admin;
 
use Core\Model;

class Taxes extends Model {
    
    /* Get All Taxes */
    public function getTaxes(){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."taxes
            ORDER BY 
                id_tax
			");
	}
    
    /* Add New Tax */
    public function insertTax($data){
		$this->db->insert(PREFIX."taxes",$data);
	}
    
    /* Delete Tax */
    public function deleteTax($where){
		$this->db->delete(PREFIX."taxes",$where);
	}

}