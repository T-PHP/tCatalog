<?php 
namespace Models\Front;

use Core\Model;

class Brands extends Model 
{
    
    /* Get All Active Brands */
    public function getBrands($id_language){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."brands b
            LEFT JOIN 
                ".PREFIX."brands_infos bi ON (b.id_brand = bi.id_brand)
            WHERE 
                bi.id_language = :id_language
            ORDER BY 
                b.sort ASC
			"
        ,array(':id_language' => $id_language));
	}
    
}