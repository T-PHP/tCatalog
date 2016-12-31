<?php 
namespace Models\Admin;
 
use Core\Model;

class Seo extends Model {
    
    /* Get All Meta Robots */
    public function getMetaRobots(){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."seo_meta_robots
            ORDER BY 
                id_meta_robots
			");
	}
    
    /* Add New Meta Robots */
    public function insertMetaRobots($data){
		$this->db->insert(PREFIX."seo_meta_robots",$data);
	}
    
    /* Delete Meta Robots */
    public function deleteMetaRobots($where){
		$this->db->delete(PREFIX."seo_meta_robots",$where);
	}

}