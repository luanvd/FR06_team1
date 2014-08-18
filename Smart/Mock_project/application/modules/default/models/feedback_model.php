<?php 
class Feedback_model extends CI_Model{
	protected $_table = "feedback";

	public function __construct(){
		parent::__construct();
			
		$this->load->database();
	}

	// acc05-toannt2
	public function get_feedback_by_pro_id($pro_id){
		$result = $this->db->get_where($this->_table, array('pro_id' => $pro_id));
		return $result->result_array();
	}

	// acc05-toannt2
	public function insert($feed_name, $feed_email, $feed_title, $feed_content, $feed_rate, $feed_time, $pro_id){
		$data = array(
			'feed_name'    => $feed_name,
			'feed_email'   => $feed_email,
			'feed_title'   => $feed_title,
			'feed_content' => $feed_content,
			'feed_rate'    => $feed_rate,
			'feed_time'	   => $feed_time,
			'pro_id'       => $pro_id
		);

		$this->db->insert($this->_table, $data); 
	}
    
	// acc05-toannt2
	public function avg_rate($pro_id){
		$sql = "SELECT count(pro_id) as count, avg(feed_rate) as avg FROM {$this->_table} WHERE pro_id = '$pro_id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}    
}