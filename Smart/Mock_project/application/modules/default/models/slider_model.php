<?php
	class slider_model extends CI_Model{
		protected $_table = "sliders";
		public function __construct(){
			parent::__construct();
				
			$this->load->database();
		}
		
		public function get_slider_order(){
			$this->db->select("sliders.pro_id,products.pro_name,products.pro_desc,sliders.img_link,sliders.img_order");
			$this->db->join("products","products.pro_id = sliders.pro_id");
			$this->db->order_by("img_order asc");
			return $this->db->get($this->_table)->result_array();
		}
		
		public function update_slider($data){
			$this->db->empty_table($this->_table);
			$this->db->insert_batch($this->_table,$data);
		}
		
		public function delete_slider($id){
			$this->db->where("pro_id",$id);
			$this->db->delete($this->_table);
		}
		
		public function add_slider($data){
			$this->db->insert($this->_table, $data);
		}
        		
		public function get_max_slider(){
			$this->db->select_max("img_order");
			return $this->db->get($this->_table)->result_array();
		}
	}