<?php
class category_model extends CI_Model{
	protected $_table = "categories";
    protected $_cate_id = "cate_id";
    
	public function __construct(){
		parent::__construct();
			
		$this->load->database();
	}
    
    public function get_all_category(){
		$query = $this->db->query("SELECT * FROM $this->_table");
		return $query->result_array();
	}
    
	public function getCategoryOderby() {
        $sql = "SELECT * FROM $this->_table ORDER BY cate_orderby ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getParentCategory() {
        $sql = "SELECT * FROM $this->_table 
                WHERE parent_id = 0
                ORDER BY cate_orderby ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
	//acc05-toannt2
	public function get_relationship(){
		$sql = "SELECT cate_id, parent_id FROM categories";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	//acc05-toannt2
	public function get_name_by_id($cate_id){
		$this->db->select('cate_name');
		$query = $this->db->get_where($this->_table, array('cate_id' => $cate_id));
		return $query->row_array();
	}    
}