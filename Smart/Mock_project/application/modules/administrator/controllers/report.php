<?php
// acc05-toannt2
class Report extends CI_Controller{

	const PER_PAGE = 6;

	public function __construct(){

		parent::__construct();
		$this->load->library('session');
		$this->load->library("form_validation");
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->model("report_model");
		$this->load->model("category_model");
	}

	public function product(){

		$data = array();

		$page_number = $this->uri->segment(4);

		if(!$page_number || $page_number <= 0) {
			$page_number = 1;
		}

		$config['base_url']         = base_url() . 'administrator/report/product';
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment']      = 4;

		$config['per_page']         = self::PER_PAGE; 
		$config['prev_link']        = 'Prev';
		$config['next_link']        = 'Next';

		$offset = ($page_number - 1) * $config['per_page'];


		if($this->input->post("submit")){

			$data['press_report'] = true;

			$fromDate = $this->input->post("fromDate");
			$toDate   = $this->input->post("toDate");

			if(!isset($fromDate) || !isset($toDate) || empty($fromDate) || empty($toDate)){
				$this->session->unset_userdata('fromDate');
				$this->session->unset_userdata('toDate');
				$this->session->unset_userdata('thu_tu');
			} else {
				$this->session->set_userdata('fromDate', $fromDate);
				$this->session->set_userdata('toDate', $toDate);
				$this->session->set_userdata('thu_tu', $offset);
			}

			if($page_number !== 1){
				redirect(base_url() . "administrator/report/product/1");
			}
		}

		if($this->session->userdata('fromDate') && $this->session->userdata('toDate')){
			$this->session->set_userdata('thu_tu', $offset);
			$fromDate = $this->session->userdata('fromDate') . " 00:00:00";
			$toDate = $this->session->userdata('toDate') . " 23:59:59";

			$config['total_rows'] = count($this->report_model->top_product_all($fromDate, $toDate));
			$this->pagination->initialize($config);
			$data['pages'] = $this->pagination->create_links();

			$top_products = $this->report_model->top_product_limit($fromDate, $toDate, $offset, $config['per_page']);

			$data['products'] = $top_products;
		}
		$data['title'] = "Report Product";
		$data['template'] = 'report/report_product';
		$this->load->view("layout", $data);
	}

	public function category(){
		$data = array();
		$page_number = $this->uri->segment(4);

		if(!$page_number || $page_number <= 0) {
			$page_number = 1;
		}

		$config['base_url']         = base_url() . 'administrator/report/category';
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment']      = 4;

		$config['per_page']         = self::PER_PAGE; 
		$config['prev_link']        = 'Prev';
		$config['next_link']        = 'Next';

		$offset = ($page_number - 1) * $config['per_page'];


		if($this->input->post("submit")){

			$data['press_report'] = true;

			$fromDate = $this->input->post("fromDate");
			$toDate   = $this->input->post("toDate");

			if(!isset($fromDate) || !isset($toDate) || empty($fromDate) || empty($toDate)){
				$this->session->unset_userdata('fromDate');
				$this->session->unset_userdata('toDate');
				$this->session->unset_userdata('thu_tu');
			} else {
				$this->session->set_userdata('fromDate', $fromDate);
				$this->session->set_userdata('toDate', $toDate);
				$this->session->set_userdata('thu_tu', $offset);
			}

			if($page_number !== 1){
				redirect(base_url() . "administrator/report/category/1");
			}
		}

		if($this->session->userdata('fromDate') && $this->session->userdata('toDate')){
			$this->session->set_userdata('thu_tu', $offset);
			$fromDate = $this->session->userdata('fromDate') . " 00:00:00";
			$toDate = $this->session->userdata('toDate') . " 23:59:59";

			$cates = $this->report_model->top_category_all($fromDate, $toDate);

			if(count($cates) <= 0) {
				$data['not_found'] = true;
			} else {
				$data['not_found'] = false;

				$top_cates_id = array();

				foreach ($cates as &$top_cate) {
					$top_cates_id[] = $top_cate['cate_id'];
					$top_cate['direct_pro'] = $top_cate['count'];
				}


				$result_all_cates = $this->category_model->get_all_category();
				foreach ($result_all_cates as $cate) {

					if(!in_array($cate['cate_id'], $top_cates_id) ){
						$cates[] = array('cate_name' => $cate['cate_name'],
				 	                     'count'     => 0,
				 	                     'cate_id'   => $cate['cate_id'],
				 	                     'parent_id' => $cate['parent_id'],
				 	                     'direct_pro' => 0
				 	                     );
					}
				}

				foreach($cates as &$cate) {

					$cate['count'] += $this->dequy($cate['cate_id'], $cates);
				}

				foreach ($cates as &$cate) {

				    $count[$cate['cate_id']]  = $cate['count'];

				}

				$config['total_rows'] = count($cates);
				$this->pagination->initialize($config);
				$data['pages'] = $this->pagination->create_links();

				array_multisort($count, SORT_DESC, $cates);

				$data['cates'] = array_slice($cates, $offset, $config['per_page']);
			}
		}

		$data['title'] = "Report Category";
		$data['template'] = 'report/report_category';
		$this->load->view("layout", $data);			
	}


	private function dequy($parent_id, $cates){
		$count = 0;
		foreach ($cates as $cate) {
			if($cate['parent_id'] == $parent_id){
				if($cate['count'] == $cate['direct_pro']){
				$count += $cate['count'] + $this->dequy($cate['cate_id'], $cates);
				} else {
					$count += $cate['count'];
				}
			}
		}
		return $count;
	}

}
