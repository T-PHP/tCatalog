<?php 
namespace Models\Front;
 
use Core\Model;

class Products extends Model {
    
    /* Get All Products */
    public function getProducts(){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."products p
            LEFT JOIN 
                ".PREFIX."products_infos pi ON (p.id_product = pi.id_product)
			");
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
    
    /* Get Product Images */
    public function getProductImages($id_product){
		return $this->db->select("
			SELECT
                * 
			FROM 
                ".PREFIX."products_images pi
            WHERE 
                pi.id_product = :id_product
            ORDER BY 
                pi.sort ASC
			"
        ,array(':id_product' => $id_product));
	}
    
    /* Get Product Informations */
    public function getProductsByCategory($id_category, $id_language, $limit){
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
                p.id_category = :id_category
            AND 
                pi.id_language = :id_language
            AND 
                p.status = 1 
            AND 
                pim.sort = 0
            ".$limit
        ,array(':id_category' => $id_category, ':id_language' => $id_language));
	}
    
    public function getProductsByCategoryTotal($id_category, $id_language){
		return $this->db->select("
			SELECT 
				p.id_product
			FROM 
                ".PREFIX."products p
            LEFT JOIN 
                ".PREFIX."products_infos pi ON (p.id_product = pi.id_product)
			WHERE
                p.id_category = :id_category
            AND 
                pi.id_language = :id_language
            AND 
                p.status = 1
			ORDER BY 
				p.id_product DESC 
            "
        ,array(':id_category' => $id_category, ':id_language' => $id_language));
	}
    
    /* Get Product Attributes = OK WORK PERFECTLY
    public function getProductAttributes($id_product, $id_language){
        $product_attributes_groups_data = array();
        
        $product_attribute_group_query = $this->db->select("
            SELECT
                ag.id_attribute_group, 
                agi.name as group_name 
            FROM 
                ".PREFIX."products_attributes pa
            LEFT JOIN 
                ".PREFIX."products p ON (pa.id_product = p.id_product)
            LEFT JOIN 
                ".PREFIX."attributes a ON (pa.id_attribute = a.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_infos ai ON (a.id_attribute = ai.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_groups ag ON (a.id_attribute_group = ag.id_attribute_group)
            LEFT JOIN 
                ".PREFIX."attributes_groups_infos agi ON (ag.id_attribute_group = agi.id_attribute_group)
            WHERE
				pa.id_product = :id_product
            AND 
                ai.id_language = :id_language
            AND 
                agi.id_language = :id_language
            GROUP BY 
                ag.id_attribute_group
            "
        ,array(':id_product' => $id_product, ':id_language' => $id_language));
        
        foreach ($product_attribute_group_query as $product_attributes_groups) {
            $product_attributes_data = array();
            
            $product_attribute_query = $this->db->select("
            SELECT
                a.id_attribute, 
                ai.name 
            FROM 
                ".PREFIX."products_attributes pa
            LEFT JOIN 
                ".PREFIX."products p ON (pa.id_product = p.id_product)
            LEFT JOIN 
                ".PREFIX."attributes a ON (pa.id_attribute = a.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_infos ai ON (a.id_attribute = ai.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_groups ag ON (a.id_attribute_group = ag.id_attribute_group)
            LEFT JOIN 
                ".PREFIX."attributes_groups_infos agi ON (ag.id_attribute_group = agi.id_attribute_group)
            WHERE
				pa.id_product = :id_product
            AND 
                a.id_attribute_group = $product_attributes_groups->id_attribute_group
            AND 
                ai.id_language = :id_language
            AND 
                agi.id_language = :id_language
            "
        ,array(':id_product' => $id_product, ':id_language' => $id_language));
        
            foreach ($product_attribute_query as $product_attribute) {
				$product_attributes_data[] = array(
					'id_attribute' => $product_attribute->id_attribute,
					'name'         => $product_attribute->name
				);
			}
            
            $product_attributes_groups_data[] = array(
				'id_attribute_group' => $product_attributes_groups->id_attribute_group,
				'group_name'               => $product_attributes_groups->group_name,
				'attribute'          => $product_attributes_data
			);
            
        }
        
        return $product_attributes_groups_data;
        
    }
    */
    
     public function getProductAttributes($id_product, $id_language){
        $product_attributes_groups_data = array();
        
        $product_attribute_group_query = $this->db->select("
            SELECT
                ag.id_attribute_group, 
                agi.name as group_name 
            FROM 
                ".PREFIX."products_attributes pa
            LEFT JOIN 
                ".PREFIX."products_attributes_combination pac ON (pa.id_product_attribute = pac.id_product_attribute)
            LEFT JOIN 
                ".PREFIX."products p ON (pa.id_product = p.id_product)
            LEFT JOIN 
                ".PREFIX."attributes a ON (pac.id_attribute = a.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_infos ai ON (a.id_attribute = ai.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_groups ag ON (a.id_attribute_group = ag.id_attribute_group)
            LEFT JOIN 
                ".PREFIX."attributes_groups_infos agi ON (ag.id_attribute_group = agi.id_attribute_group)
            WHERE
				pa.id_product = :id_product
            AND 
                ai.id_language = :id_language
            AND 
                agi.id_language = :id_language
            GROUP BY 
                ag.id_attribute_group
            "
        ,array(':id_product' => $id_product, ':id_language' => $id_language));
        
        foreach ($product_attribute_group_query as $product_attributes_groups) {
            $product_attributes_data = array();
            
            $product_attribute_query = $this->db->select("
            SELECT
                a.id_attribute, 
                ai.name, 
                pa.sku
            FROM 
                ".PREFIX."products_attributes pa
            LEFT JOIN 
                ".PREFIX."products_attributes_combination pac ON (pa.id_product_attribute = pac.id_product_attribute)
            LEFT JOIN 
                ".PREFIX."products p ON (pa.id_product = p.id_product)
            LEFT JOIN 
                ".PREFIX."attributes a ON (pac.id_attribute = a.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_infos ai ON (a.id_attribute = ai.id_attribute)
            LEFT JOIN 
                ".PREFIX."attributes_groups ag ON (a.id_attribute_group = ag.id_attribute_group)
            LEFT JOIN 
                ".PREFIX."attributes_groups_infos agi ON (ag.id_attribute_group = agi.id_attribute_group)
            WHERE
				pa.id_product = :id_product
            AND 
                a.id_attribute_group = $product_attributes_groups->id_attribute_group
            AND 
                ai.id_language = :id_language
            AND 
                agi.id_language = :id_language
            "
        ,array(':id_product' => $id_product, ':id_language' => $id_language));
        
            foreach ($product_attribute_query as $product_attribute) {
				$product_attributes_data[] = array(
					'id_attribute' => $product_attribute->id_attribute,
					'name'         => $product_attribute->name, 
                    'sku'         => $product_attribute->sku
				);
			}
            
            $product_attributes_groups_data[] = array(
				'id_attribute_group' => $product_attributes_groups->id_attribute_group,
				'group_name'               => $product_attributes_groups->group_name,
				'attribute'          => $product_attributes_data
			);
            
        }
        
        return $product_attributes_groups_data;
        
    }
    
    

}