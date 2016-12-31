<?php 
namespace Modules\Categories\Models;

use Core\Model;

class Categories extends Model 
{
    
    /* List of Categories Top Level */
     public function get_categories(){
		return $this->db->select("
            SELECT 
                * 
            FROM 
                ".PREFIX."categories 
            ORDER BY 
                name
        ");
	}
    
    public function get_categories_by_id($id){
		return $this->db->select("
            SELECT 
                * 
            FROM 
                ".PREFIX."categories 
            WHERE 
                id_parent_category = :id
            ORDER BY 
                name
        ",array(':id' => $id));
	}
}