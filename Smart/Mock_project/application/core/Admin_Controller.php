<?php
    class Admin_Controller extends CI_Controller {
        public function __construct(){
            parent::__construct();
            if ($this->session->userdata('logged_in')){
			     $username = $this->session->userdata('logged_in');
    		}
    		else {
    			redirect(base_url("authentication/login"),"refresh");
    		}
        }
    }