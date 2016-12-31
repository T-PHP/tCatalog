<?php 
namespace Models\Admin;
 
use Core\Model;

class Products extends Model {
    
    /* Get All Products */
    public function getProducts($id_language){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."products p
            LEFT JOIN 
                ".PREFIX."products_infos pi ON (p.id_product = pi.id_product)
            WHERE 
                pi.id_language = :id_language
			"
        ,array(':id_language' => $id_language));
	}
    
    /* Get Product Informations */
    public function getProduct($id_product, $id_language){
		return $this->db->select("
            SELECT
                p.id_product, 
                p.id_brand, 
                p.status,  
                p.sku, 
                p.price,
                pi.id_language, 
                pi.short_description, 
                pi.long_description, 
                pi.name, 
                pi.url, 
                pi.meta_title, 
                pi.meta_description, 
                pi.meta_robots,
                bi.id_brand, 
                bi.name as brand_name, 
                bi.url as brand_url 
            FROM 
                ".PREFIX."products p
            LEFT JOIN 
                ".PREFIX."products_infos pi ON (p.id_product = pi.id_product)
            LEFT JOIN 
                ".PREFIX."brands_infos bi ON (p.id_brand = bi.id_brand)
            WHERE
				p.id_product = :id_product
            AND 
                pi.id_language = :id_language
            "
        ,array(':id_product' => $id_product, ':id_language' => $id_language));
	}
    
    /* Add New Product */
    public function insertProduct($data){
		$this->db->insert(PREFIX."products",$data);
        
        return $this->db->lastInsertId('id_product');
	}
    
    public function insertProductInfos($data){
		$this->db->insert(PREFIX."products_infos",$data);
	}
    
    
    

}