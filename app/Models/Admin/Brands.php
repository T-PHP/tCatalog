<?php 
namespace Models\Admin;
 
use Core\Model;

class Brands extends Model {
    
    /* Get Brand */
    public function getBrand($id_brand, $id_language){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."brands b
            LEFT JOIN 
                ".PREFIX."brands_infos bi ON (b.id_brand = bi.id_brand)
            WHERE 
                b.id_brand = :id_brand
            AND
                bi.id_language = :id_language
			"
        ,array(':id_brand' => $id_brand, ':id_language' => $id_language));
	}
    
    /* Get All Brands */
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

    /* Add New Brand */
    public function insertBrand($data){
		$this->db->insert(PREFIX."brands",$data);
        
        return $this->db->lastInsertId('id_brand');
	}
    
    public function insertBrandInfos($data){
		$this->db->insert(PREFIX."brands_infos",$data);
	}
    
    /* Update Brand */
    public function updateBrand($data,$where){
		$this->db->update(PREFIX."brands",$data, $where);
	}
    
    public function updateBrandInfos($data,$where){
        $this->db->update(PREFIX."brands_infos",$data, $where);
    }
    
    

}