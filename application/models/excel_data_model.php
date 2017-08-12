<?php
class Excel_data_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
    }
	
	public function Add_User($data_user){
		$this->db->insert('thanhvien', $data_user);
   	}
  
	
}

?>