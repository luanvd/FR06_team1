<?php
	class brand_model extends CI_Model{
		protected $_table = "brands";
		public function __construct(){
			parent::__construct();
			
			$this->load->database();
		}
		
		public function get_one_brand($id){
            $this->db->select("*");
            $this->db->where("brand_id", $id);
			$query = $this->db->get($this->_table);
			
			return $query->result();
		}
		
		public function delete_one_brand($id){
		    $this->db->where("brand_id", $id);
            $this->db->delete($this->_table);
		}
		
		public function get_all_brand(){
		    $this->db->select("*");
			$query = $this->db->get($this->_table);
			
			$result = array();
			
			foreach ($query->result_array() as $value){
				$result[] = array(
					"brand_id" => $value['brand_id'],
					"brand_name" => $value['brand_name']
				);
			}
			return $result;
		}
		
        
		//acc02-quynh 
		public function totalRow($type="",$keyword="") {
			if (!empty($keyword) && $keyword!=""){
				$sql = "select count(*) as total from $this->_table where $type like '%$keyword%'";
			}
			else $sql = "select count(*) as total from $this->_table";
			$query = $this->db->query($sql)->result_array();
			
			return $query[0]['total'];
		}
		
		public function pagination_brand($start, $limit, $type="", $keyword="") {
			if (!empty($keyword) || $keyword!=""){
				$this->db->like($type,$keyword);
			}
			$this->db->from($this->_table);
			$this->db->limit($limit,$start);
			return $this->db->get()->result_array();
		}
        
		public function getAll() {
		    $this->db->select("*");
			$query = $this->db->get($this->_table);
            
			return $query->result_array();
		}
		
        public function insert($data) {
            $this->db->insert($this->_table, $data);
        }
        
        
		//acc04-toannv
		public function update($data,$id){
			$this->db->where("brand_id",$id);
			$this->db->update($this->_table,$data);
		}
		
		public function detail($id){
			//$this->db->query("SELECT * FROM brands WHERE brand_id=$id");
			$this->db->where("brand_id = $id");
			return $this->db->get($this->_table)->row_array();
		}
        
        // acc05-toannt2
		// kiem tra 1 brand co ton tai hay khong
		// tra ve false neu khong ton tai
		// tra ve brand_id neu ton tai
		public function has_brand_name($brand_name){
			$this->db->where('brand_name', $brand_name);
			$this->db->from($this->_table);
			$count = $this->db->count_all_results();
			if ($count == 0) {
				return false;
			} else {
				$result = $this->db->get_where($this->_table,  array('brand_name' => $brand_name));
				return ($result->row_array()['brand_id']);
			}
		}
	}