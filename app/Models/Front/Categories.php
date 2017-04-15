<?php 
namespace Models\Front;
 
use Core\Model;

class Categories extends Model {
    
    /* Get All Categories */
    public function getCategories(){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."categories c
            LEFT JOIN 
                ".PREFIX."categories_infos ci ON (c.id_category = ci.id_category)
			");
	}
    
    /* Get category Informations */
    public function getCategory($id_category, $id_language){
		return $this->db->select("
            SELECT
                c.id_category, 
                c.id_parent_category, 
                c.status, 
                ci.id_language, 
                ci.short_description, 
                ci.long_description, 
                ci.name, 
                ci.url, 
                ci.meta_title, 
                ci.meta_description, 
                ci.meta_robots 
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
    
    /* Get Sub-Categories Informations */
    public function getSubCategories($id_parent_category, $id_language){
		return $this->db->select("
            SELECT
                c.id_category, 
                c.id_parent_category, 
                c.status, 
                ci.id_language, 
                ci.short_description, 
                ci.long_description, 
                ci.name, 
                ci.url, 
                ci.meta_title, 
                ci.meta_description, 
                ci.meta_robots 
            FROM 
                ".PREFIX."categories c
            LEFT JOIN 
                ".PREFIX."categories_infos ci ON (c.id_category = ci.id_category)
            WHERE
				c.id_parent_category = :id_parent_category
            AND 
                ci.id_language = :id_language
            AND 
                c.status = 1
            "
        ,array(':id_parent_category' => $id_parent_category, ':id_language' => $id_language));
	}
    
    
	
 

}