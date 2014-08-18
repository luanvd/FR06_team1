<?php
class Config extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model("config_model");
		$this->load->model("products_model");
		$this->load->library("session");
		$this->load->library("form_validation");
		$this->load->helper(array('form','url'));
	}

	public function index()
	{
		$this->insert_page();
	}

	public function insert_page(){

		$data['number_page']=$this->config_model->getNumberPage();
	
		if($this->input->post('update')){
			$this->form_validation->set_rules("number_page","Brand Name ","trim|required");
			$this->form_validation->set_message("required","%s khong duoc bo trong");
			
			$this->form_validation->set_error_delimiters("<span class='error' color='red'>","</span>");
			if(!isset($data['errorName'])){
				$dataNumberPage = $this->input->post('number_page');
				$this->config_model->update($dataNumberPage);
				redirect(base_url("administrator/products/"));
			}

		}
        $data['title'] = 'Set number item of page';
		$data['template'] = 'config/config_view';
		$this->load->view("layout", $data);
        
         //cancel insert
        if($this->input->post("cancel")) {
            redirect(base_url("administrator/products/"),'refresh');
        }
	}
}
