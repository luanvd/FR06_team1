<?php 
class Users_model extends CI_Model{
	protected $_table = 'users';

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	// acc05-toannt2 method
	public function get_users($id = FALSE){
		if ($id === FALSE){

			$query = $this->db->get($this->_table);
			return $query->result_array();
		}

		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row_array();
	}

	// acc05-toannt2 method
	public function get_total_users(){
		return $this->db->count_all($this->_table);
	}

	// acc05-toannt2 method
	public function get_limit_users($offset, $limit){
		$query = $this->db->get($this->_table, $limit, $offset);
		return $query->result_array();
	}

	//acc05-toannt2 method
	public function get_limit_users_orderby($offset, $limit, $field, $order){
		//$this->db->from($this->_table);
		$this->db->order_by($field, $order);
		$query = $this->db->get($this->_table, $limit, $offset); 
		return $query->result_array();
	}
	
	//toanlv
	public function get_all_users(){
		return $this->db->get($this->_table)->result_array();
	}
	
	//toanlv
	public function delete_user($id)
	{
		$this->db->where("id", $id);
		$this->db->delete($this->_table);
	}
	
	//quynh
    public function getOne($id) {
        $this->db->select("*");
        $this->db->where("id", $id);
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
        
        return $query->result_array();
    }
    
	public function insert($data) {
		$this->db->insert($this->_table, $data);
	}
    
     public function update($data, $id) {
        $this->db->where("id", $id);
        $this->db->update($this->_table, $data);
    }
}