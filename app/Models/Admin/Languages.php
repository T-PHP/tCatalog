<?php 
namespace Models\Admin;
 
use Core\Model;

class Languages extends Model {
    
    /* Get Language */
    public function getLanguage($id_language){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."languages l
            WHERE 
                l.id_language = :id_language
			"
        ,array(':id_language' => $id_language));
	}
    
    /* Get All Languages */
    public function getLanguages(){
		return $this->db->select("
			SELECT
                * 
			FROM 
				".PREFIX."languages l
            ORDER BY 
                l.id_language ASC
			"
        ,array(':id_language' => $id_language));
	}

    /* Add New Language */
    public function insertLanguage($data){
		$this->db->insert(PREFIX."languages",$data);
	}
    
    /* Update Language */
    public function updateLanguage($data,$where){
		$this->db->update(PREFIX."languages",$data, $where);
	}
    
    /* Delete Language */
    public function deleteLanguage($where){
		$this->db->delete(PREFIX."languages",$where);
	}
    
   
}