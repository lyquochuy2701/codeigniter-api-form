<?php
	class Muser extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function listUser(){
			$this->db->select("username, password , level");
			$query = $this->db->get("user");
			return $query->result_array();
		}
		public function countAll(){
			 return $this->db->count_all("user"); 
		}
	}