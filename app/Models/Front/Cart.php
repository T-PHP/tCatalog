<?php 
namespace Models\Front;
 
use Core\Model;
use Helpers\Session;

class Cart extends Model {
    
     
    /* Get Product Informations */
    public function getCartProducts($id_language){
        
        //Get id_product from Cart Session
        $ids = array_keys($_SESSION['cart']);
       
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
                bi.url as brand_url, 
                t.rate 
            FROM 
                ".PREFIX."products p
            LEFT JOIN 
                ".PREFIX."products_infos pi ON (p.id_product = pi.id_product)
            LEFT JOIN 
                ".PREFIX."brands_infos bi ON (p.id_brand = bi.id_brand)
            LEFT JOIN 
                ".PREFIX."taxes t ON (p.id_tax = t.id_tax)
            WHERE
                p.id_product IN (".implode(',',$ids).")
            AND 
                pi.id_language = :id_language
            "
           ,array(':id_language' => $id_language));
	}
    
    /* Get Nb Total of Product Quantity */
    public function getTotalQuantity(){
        return array_sum($_SESSION['cart']);
    }
    
    /* Get Total Cart */
    public function getSubTotalCart($id_language){
        
        $total = 0;
        //Get id_product from Cart Session
        $ids = array_keys($_SESSION['cart']);
       
		if(empty($ids)):
            $products = array();
        else:
            $products = $this->db->select("
            SELECT
                p.id_product, 
                p.price,
                t.rate 
            FROM 
                ".PREFIX."products p
            LEFT JOIN 
                ".PREFIX."products_infos pi ON (p.id_product = pi.id_product)
            LEFT JOIN 
                ".PREFIX."taxes t ON (p.id_tax = t.id_tax)
            WHERE
                p.id_product IN (".implode(',',$ids).")
            AND 
                pi.id_language = :id_language
            "
           ,array(':id_language' => $id_language));
       
        foreach($products as $product):
            $total += $product->price * $_SESSION['cart'][$product->id_product];
        endforeach;
        
        return $total;
        
        endif;
	}

}