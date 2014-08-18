
<?php
	class Orders extends CI_Controller{
		const USERS_PER_PAGE = 5;
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library('pagination');
            $this->load->library('form_validation');
			$this->load->library('session');
            $this->load->model('order_model');
		}
        
        public function index() {
            $data['title'] = "List Orders";
            
            $data['info'] = $this->order_model->get_order();
            
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
            
            
            
            $data['template'] = "order/order_view";
            $this->load->view("layout", $data);
        }
        
        public function search(){
			$orders = $this->order_model->get_all_order();
			$result = array();
			if ($this->input->post("submit")){
				$keywords = $this->input->post("search");
				$type = $this->input->post("type");
				
				if (!empty($keywords) || $keywords!=""){
					if ($type == 1) {
						foreach ($orders as $value){
							if (preg_match("/$keywords/i",$value['order_name'])){
								$result['order'][] = $value;
							}
							else $result['not_found'] = "No result found";
						}
					}
					else if ($type == 2){
						foreach ($orders as $value){
							if (preg_match("/\b$keywords\b/i",$value['address'])){
								$result['order'][] = $value;
							}
							$result['not_found'] = "No result found";
						}
					}
                    else if ($type == 3){
						foreach ($orders as $value){
							if (preg_match("/\b$keywords\b/i",$value['order_time'])){
								$result['order'][] = $value;
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
        
        public function detail() {
            $id = $this->uri->segment(4);
            $data['title'] = 'Order Detail';
            
            $data['infoUser']   = $this->order_model->get_info_user($id);
            $data['infoDetail'] = $this->order_model->get_detail_order($id);
            $data['template']   = "order/order_detail";
            $this->load->view("layout", $data);
        }
        
        public function pay($id){
            $id = $this->uri->segment(4);
            $this->order_model->pay($id);
            
            redirect(base_url("administrator/orders/"), 'refresh');
        }
        
        public function delete() {
            $id = $this->uri->segment(4);
            	
            $this->order_model->delete($id);
            redirect(base_url("administrator/orders/"), 'refresh');
        }
}