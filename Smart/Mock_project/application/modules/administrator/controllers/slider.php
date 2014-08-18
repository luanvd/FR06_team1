<?php
	class Slider extends CI_Controller {
		public function __construct() {
			parent::__construct ();
			$this->load->model ( 'slider_model' );
			$this->load->helper ( 'url' );
			$this->load->library ( 'session' );
		}
		public function index() {
			$data ['title'] = 'Choose slider';
			$data ['template'] = 'slider/slider_select';
			$data['order'] = $this->slider_model->get_slider_order();
			$this->load->view ( "layout", $data );
		}
		
		public function setOrder(){
			$update = $_POST['data'];
			$this->slider_model->update_slider($update);
		}
	}