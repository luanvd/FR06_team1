<?php
class config_model extends CI_Model
{
	protected $_table = "config";
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getNumberPage()
	{
	    $this->db->select("*");
		$query= $this->db->get($this->_table);
        
		return $query->row_array();
	}

	public function update($data){
	    $data_update = array(
                        'number_page'=>$data
                        );
        $this->db->update($this->_table, $data_update);
	}
}