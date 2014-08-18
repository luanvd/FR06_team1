<?php
	class Login_model extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		function login($username,$password){
			$query = $this->db->query("SELECT id, username,password 
										FROM users
										WHERE username='$username' AND
											  password='$password' AND 
											  level = 1");
			
			if ($query->num_rows() == 1){
				$return = array_shift($query->result_array());
				return $return;
			}
			else {
				return false;
			}
		}
	}