<?php
class Category_model extends CI_Model{
	protected $_table = "categories";
    protected $_cate_id = "cate_id";
    
	public function __construct(){
		parent::__construct();
			
		$this->load->database();
	}

	public function get_all_category(){
	    $this->db->select("*");
        $query = $this->db->get($this->_table);
        
		return $query->result_array();
	}
	
    public function getCategoryOderby() {
        $this->db->select("*");
        $this->db->order_by("cate_orderby ASC");
        $query = $this->db->get($this->_table);
        
        return $query->result_array();
    }
    
    public function getParentCategory() {
        $this->db->select("*");
        $this->db->where("parent_id", 0);
        $this->db->order_by("cate_orderby ASC");
        $query = $this->db->get($this->_table);
        
        return $query->result_array();
    }
    
    public function getChildCategory($parent_id) {
        $this->db->select("*");
        $this->db->where("parent_id", $parent_id);
        $this->db->order_by("cate_orderby ASC");
        $query = $this->db->get($this->_table);
        
        return $query->result_array();
    }
    
    //acc01-phong
	public function move_category($data){
		if (!empty($data)){
			$this->db->update_batch($this->_table,$data,$this->_cate_id);
		}
	}
    
    
    public function set_order($data){
		if (!empty($data)){
			$this->db->update_batch($this->_table,$data,$this->_cate_id);
		}
	}
    //End acc01
    
    
    // acc05-toannt2 method
	public function get_category($cate_id = FALSE){
		if ($cate_id === FALSE){		
			$query = $this->db->get($this->_table);
			return $query->result_array();
		}

		$query = $this->db->get_where($this->_table, array('cate_id' => $cate_id));
		return $query->row_array();
	}

	// acc05-toannt2 method
	public function insert_category($cate_name, $parent_id, $cate_orderby = 0){
		$data = array(
			'cate_name'  => $cate_name,
			'parent_id'  => $parent_id,
			'cate_orderby' => $cate_orderby
		);

		return $this->db->insert($this->_table, $data);
	}	

	public function get_all_orderby(){
	    $this->db->select("cate_orderby");
		$query = $this->db->get($this->_table);
        
		return $query->result_array();		
	}
    
    //acc04-toanlv
    public function detail($id){
		$this->db->where("cate_id = $id");
		return $this->db->get($this->_table)->row_array();
	}
    
	public function update($data,$id){
		$this->db->where("cate_id = $id");

		$this->db->update($this->_table,$data);
		
	}
    //End acc04
    
    public function delete_category($id){
		$this->db->where($this->_cate_id,$id);
		$this->db->delete($this->_table);
        
        $this->db->where($this->_cate_id,$id);
		$this->db->delete("pro_cate");
	}
    
    public function update_parent($data, $parent_id){
        $this->db->where("parent_id = $parent_id");
        $this->db->update($this->_table, $data); 
    }
}