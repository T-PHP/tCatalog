<?php 
namespace Modules\LastProducts\Models;

use Core\Model;

class LastProducts extends Model 
{
    
    /* Get All Products */
    public function getProducts($id_language){
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
                pim.image 
            FROM 
                ".PREFIX."products p
            LEFT JOIN 
                ".PREFIX."products_infos pi ON (p.id_product = pi.id_product)
            LEFT JOIN 
                ".PREFIX."products_images pim ON (p.id_product = pim.id_product)
            WHERE 
                pi.id_language = :id_language
            AND 
                p.status = 1 
            AND 
                pim.sort = 0
            ORDER BY 
                p.id_product DESC 
            LIMIT 
                0, 10
            "
        ,array(':id_language' => $id_language));
	}
    
}