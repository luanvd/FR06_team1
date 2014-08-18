<meta charset="UTF-8" />
<?php
	class Brands extends CI_Controller{
		const USERS_PER_PAGE = 5;
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->model("brand_model");
			$this->load->library('pagination');
            $this->load->library('form_validation');
			$this->load->library('session');
		}
		
		public function index(){
            
			if ($this->input->post("submit")){
                $search = $this->input->post("search");
				if (empty($search) || $search==""){
					$data['no_query'] = "Enter search keywords";
					$this->session->unset_userdata("keywords");
					$this->session->unset_userdata("type");
				}
				else {
					$this->session->set_userdata('keywords',$this->input->post("search"));
					$this->session->set_userdata('type',$this->input->post("type")==1 ? "brand_name" : "brand_id");
				}
			}
			$keywords = $this->session->userdata("keywords");
			$type = $this->session->userdata("type");
			
			$page_number = $this->uri->segment(4);
			
			if(!$page_number) {
				$page_number = 1;
			}

			if(!is_numeric($page_number) || intval($page_number) <= 0){
				show_404();
			}

			$field = $this->uri->segment(5);
			
			if(!$field){
				$field = 'brand_id';
			}

			if(!in_array(strtolower($field), array('brand_id', 'brand_name'))){
				show_404();
			}

			$order = $this->uri->segment(6);
			
			if (!$order) {
				$order = 'asc';
			}
			
			if(!in_array(strtolower($order), array('asc', 'desc'))){
				show_404();
			}			
			
			$config = array();
			$config['base_url'] = base_url() . 'administrator/brands/index/';
			$config['per_page'] = self::USERS_PER_PAGE;
			$config['uri_segment'] = 4;
			$config['total_rows'] = $this->brand_model->totalRow($type,$keywords);
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
			$config['use_page_numbers'] =  TRUE;
            
			if ($config['total_rows'] == 0){
				$data["not_found"] = "No result";
			} else {
			 

    			if($page_number > ceil($config['total_rows'] / $config['per_page'])){
    				show_404();
    			}
    
    			$offset = ($page_number - 1) * $config['per_page'];
                
    			$data = array();
    			$this->pagination->initialize($config);
    			$data['field']       = $field;
    			$data['order']       = $order;
    			$data['page_number'] = $page_number;
    
    			$data['brandList']   = $this->brand_model->pagination_brand($offset, $config['per_page'], $type, $keywords);
    
    			foreach ($data['brandList'] as $key => $value) {
    				$sort_field[$key] = $value[$field];
    			}
    
    			if(strtolower($order) == 'desc'){
    				array_multisort($sort_field, SORT_DESC, $data['brandList']);			
    			} else {
    				array_multisort($sort_field, SORT_ASC, $data['brandList']);
    			}	
    
    			$data['pages'] 		 = $this->pagination->create_links();
			

            }

            $data['title']       = 'List Brands';
			$data['template'] = "brand/brand_view";
			$this->load->view("layout", $data);
		}
				
		public function search(){
			$brands = $this->brand_model->get_all_brand();
			$result = array();
			if ($this->input->post("submit")){
				$keywords = $this->input->post("search");
				$type = $this->input->post("type");
				
				if (!empty($keywords) || $keywords!=""){
					if ($type == 1) {
						foreach ($brands as $brand){
							if (preg_match("/$keywords/i",$brand['brand_name'])){
								$result['brand'][] = $brand;
							}
							else $result['not_found'] = "No result found";
						}
					}
					else if ($type == 0){
						foreach ($brands as $brand){
							if (preg_match("/\b$keywords\b/i",$brand['brand_id'])){
								$result['brand'][] = $brand;
							}
							$result['not_found'] = "No result found";
						}
					}
				}
				else {
					$result['no_query'] = "Enter a keyword to search";
				}
				$this->load->view("search_brand",$result);
			}
		}
		
        public function insert(){
            $data['title'] = "Insert brands";

			if($this->input->post('insert')){
				$this->form_validation->set_rules("brand_name","Tên Brand ","trim|required|is_unique[brands.brand_name]");
		
				$this->form_validation->set_message("required","%s không được bỏ trống");
                $this->form_validation->set_message("is_unique","%s đã tồn tại");
				$this->form_validation->set_error_delimiters("<span class='error'>","</span>");
				$ten=$this->input->post("brand_name");
				if($this->form_validation->run()){
				$dataBrand = array("brand_name"=>$this->input->post("brand_name"));
						$this->brand_model->insert($dataBrand, $id);
						redirect(base_url("administrator/brands/"),'refresh');
					}
			}
			$data['template'] = "brand/brand_insert";
			$this->load->view("layout", $data);
            
            //cancel insert
            if($this->input->post("cancel")) {
                redirect(base_url("administrator/brands/"),'refresh');
            }
        }
        
		//toannv
		public function update(){
            $data['title'] = "Update brands";
			$id = $this->uri->segment(4);
            
            //check url
            if(!is_numeric($id) || intval($id) <= 0){
                    show_404();
            }
            
            $all_brands = $this->brand_model->getAll();
            $all_id = array();
            if(!empty($all_brands)){  
                foreach($all_brands as $brand){
                    $all_id[] = $brand['brand_id'];
                }
            }
            
            if(!in_array($id, $all_id)){
                show_404();
            }
            //End check url
            
			
			$data['brandInfor']= $this->brand_model->detail($id);

			if($this->input->post('update')){
				$this->form_validation->set_rules("brand_name","Tên Brand ","trim|required");
		
				$this->form_validation->set_message("required","%s không được bỏ trống");
                $this->form_validation->set_message("is_unique","%s đã tồn tại");
				$this->form_validation->set_error_delimiters("<span class='error'>","</span>");
				$ten=$this->input->post("brand_name");
				if($this->form_validation->run()){
				$dataBrand = array("brand_name"=>$this->input->post("brand_name"));
						$this->brand_model->update($dataBrand, $id);
						redirect(base_url("administrator/brands/"),'refresh');
					}
			}
			$data['template'] = "brand/brand_update";
			$this->load->view("layout", $data);
            
            //cancel update
            if($this->input->post("cancel")) {
                redirect(base_url("administrator/brands/"),'refresh');
            }
		}
		
		//phongnd
		public function delete(){
			$id = $this->uri->segment(4);
			$this->brand_model->delete_one_brand($id);
			redirect(base_url("administrator/brands/"),'refresh');
		}
	}