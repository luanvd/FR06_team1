<?php
	class Brand_model extends CI_Model{
		protected $_table = "brands";
        
		public function __construct(){
			parent::__construct();
			
			$this->load->database();
		}
		
		
		public function get_all_brand(){
			$sql = "SELECT * FROM $this->_table";
            $query = $this->db->query($sql);
			return $query->result_array();
		}
}