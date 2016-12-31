<?php 
namespace Models\Admin;
 
use Core\Model;

class Categories extends Model {
    
    /* Get Category */
    public function getCategory($id_category, $id_language){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."categories c
            LEFT JOIN 
                ".PREFIX."categories_infos ci ON (c.id_category = ci.id_category)
            WHERE 
                c.id_category = :id_category
            AND
                ci.id_language = :id_language
			"
        ,array(':id_category' => $id_category, ':id_language' => $id_language));
	}
    
    /* Get All Categories */
    public function getCategories($id_language){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."categories c
            LEFT JOIN 
                ".PREFIX."categories_infos ci ON (c.id_category = ci.id_category)
            WHERE 
                c.id_parent_category = 0
            AND
                ci.id_language = :id_language
			"
        ,array(':id_language' => $id_language));
	}
    
    /* Get Sub-Category */
    public function getSubCategory($id_category, $id_language){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."categories c
            LEFT JOIN 
                ".PREFIX."categories_infos ci ON (c.id_category = ci.id_category)
            WHERE 
                c.id_category = :id_category
            AND
                ci.id_language = :id_language
			"
        ,array(':id_category' => $id_category, ':id_language' => $id_language));
	}
    
    /* Add New Category */
    public function insertCategory($data){
		$this->db->insert(PREFIX."categories",$data);
        
        return $this->db->lastInsertId('id_product');
	}
    
    public function insertCategoryInfos($data){
		$this->db->insert(PREFIX."categories_infos",$data);
	}
    
    /* Update Category */
    public function updateCategory($data,$where){
		$this->db->update(PREFIX."categories",$data, $where);
	}
    
    public function updateCategoryInfos($data,$where){
        $this->db->update(PREFIX."categories_infos",$data, $where);
    }
    
    /* Delete Category */
    public function deleteCategory($where){
		$this->db->delete(PREFIX."categories",$where);
        $this->db->delete(PREFIX."categories_infos",$where);
	}
    
    
    

}