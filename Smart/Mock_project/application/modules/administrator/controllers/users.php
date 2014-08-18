<meta charset="UTF-8" />
<?php 
class Users extends CI_Controller {

	const USERS_PER_PAGE = 5;

	public function __construct() {
		parent::__construct();
		$this->load->model('users_model');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library("form_validation");
		$this->load->helper('url');

	}




	/**
    * acc05-toannt2 display & pagination
    */
	public function index() {
        
        
		$page_number = $this->uri->segment(4);
		if(!$page_number) {
			$page_number = 1;
		}

		if(!is_numeric($page_number) || intval($page_number) <= 0){
			show_404();
		}
        
		$field = $this->uri->segment(5);
		if(!$field){
			$field = 'id';
		}

		if(!in_array(strtolower($field), array('id', 'username', 'email', 'address', 'phone', 'gender', 'level'))){
			show_404();
		}
        
		$order = $this->uri->segment(6);
		if (!$order) {
			$order = 'asc';
		}

		if(!in_array(strtolower($order), array('asc', 'desc'))){
			show_404();
		}

		$config['base_url']         = base_url() . 'administrator/users/index/';
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment']      = 4;
		$config['total_rows']       = $this->users_model->get_total_users();
		$config['per_page']         = self::USERS_PER_PAGE;
		$config['prev_link']        = 'Prev';
		$config['next_link']        = 'Next';

		if($page_number > ceil($config['total_rows'] / $config['per_page'])){
			show_404();
		}

		$offset = ($page_number - 1) * $config['per_page'];

		$this->pagination->initialize($config); 

		$data['field']       = $field;
		$data['order']       = $order;
		$data['title']       = 'List Users';
		$data['pages']       = $this->pagination->create_links();
		$data['page_number'] = $page_number;
		$data['users']       = $this->users_model->get_limit_users($offset, $config['per_page']);

		$sort_field = array();

		foreach ($data['users'] as $key => $value) {
			$sort_field[$key] = $value[$field];
		}

		if(strtolower($order) == 'desc'){
			array_multisort($sort_field, SORT_DESC, $data['users']);			
		} else {
			array_multisort($sort_field, SORT_ASC, $data['users']);
		}	

        $data['template'] = 'user/user_view';
		$this->load->view("layout", $data);
	}
	/**
    * End acc05
    * ---------
    */
       
    
    
    
	/**
    * acc02-quynh function insert + update
    * 
    * function insert
    */
	public function insert()
	{
		$data['title'] = "Insert Users";
		if($this->input->post("insert")){
			$this->form_validation->set_rules("name","Tên ","trim|required|is_unique[users.username]|valid_name");
			$this->form_validation->set_rules("password","Mật khẩu ","trim|required");
			$this->form_validation->set_rules("email","Email ","trim|required|valid_email|is_unique[users.email]");
			$this->form_validation->set_rules("address","Địa chỉ ","trim|required");
			$this->form_validation->set_rules("phone","Số điện thoại ","trim|required|numeric|min_length[10]|max_length[11]");
			$this->form_validation->set_rules("gender", "Giới tính ", "trim|required");
            $this->form_validation->set_rules("level", "Cấp độ user", "trim|required");
	
			$this->form_validation->set_message("required","%s không được bỏ trống");
            $this->form_validation->set_message("is_unique","%s đã tồn tại");
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
            $this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message("valid_name","%s không đúng định dạng");
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là số");
			$this->form_validation->set_error_delimiters("<span class='error'>","</span>");
	
			if($this->form_validation->run()){
				$dataUser = array(
						"username"=>$this->input->post("name"),
						"password"=>$this->input->post("password"),
						"email"=>$this->input->post("email"),
						"address"=>$this->input->post("address"),
						"phone"=>$this->input->post("phone"),
						"gender"=>$this->input->post("gender"),
                        "level"=>$this->input->post("level")
				);
                
				$this->users_model->insert($dataUser);
				redirect(base_url("administrator/users/"),'refresh');
			}
		}
		$data['template'] = 'user/user_insert';
		$this->load->view("layout", $data);
        
        //cancel insert
        if($this->input->post("cancel")) {
            redirect(base_url("administrator/users/"),'refresh');
        }
	}
	
    /**
     * function update user
     */
    public function update() {
        $data['title'] = "Update Users";
        $id = $this->uri->segment(4);
        
        //check url
        if(!is_numeric($id) || intval($id) <= 0){
                show_404();
        }
        
        $all_users = $this->users_model->get_all_users();
        $all_id = array();
        if(!empty($all_users)){  
            foreach($all_users as $user){
                $all_id[] = $user['id'];
            }
        }
        
        if(!in_array($id, $all_id)){
            show_404();
        }
        //End check url
        
        $data['userInfo'] = $this->users_model->getOne($id);       
        
        if($this->input->post("update")){
			$this->form_validation->set_rules("email","Email ","trim|required|valid_email");
			$this->form_validation->set_rules("address","Địa chỉ ","trim|required");
			$this->form_validation->set_rules("phone","Số điện thoại ","trim|required|numeric|min_length[10]|max_length[11]");
			$this->form_validation->set_rules("gender", "Giới tính ", "trim|required");
            $this->form_validation->set_rules("level", "Cấp độ user", "trim|required");
	
			$this->form_validation->set_message("required","%s không được bỏ trống");
            $this->form_validation->set_message("is_unique","%s đã tồn tại");
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
            $this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là số");
			$this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            
            if($this->form_validation->run()){
                $dataUser = array(
                                "email"=>$this->input->post("email"),
                                "address"=>$this->input->post("address"),
                                "phone"=>$this->input->post("phone"),
                                "gender"=>$this->input->post("gender"),
                                "level"=>$this->input->post("level")
                            );                   
                $this->users_model->update($dataUser, $id);
                redirect(base_url("administrator/users/"),'refresh');
            }
        }
        $data['template'] = 'user/user_update';
		$this->load->view("layout", $data);
        
        //cancel update
        if($this->input->post("cancel")) {
            redirect(base_url("administrator/users/"),'refresh');
        }
    }
    
    public function check_validation() {
        $this->form_validation->set_message("required","%s không được bỏ trống");
        $this->form_validation->set_message("is_unique","%s đã tồn tại");
		$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
        $this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
		$this->form_validation->set_message("valid_name","%s không đúng định dạng");
		$this->form_validation->set_message("valid_email","%s không đúng định dạng");
		$this->form_validation->set_message("numeric","%s phải là số");
    }
    /**
    * End acc02
    * ---------
    */
    
    
    
    
    /**
     * acc04-toanlv function delete
     */
	public function delete()
	{	
        $id = $this->uri->segment(4);
        $this->users_model->delete_user($id);
        redirect(base_url("administrator/users/"), 'refresh');
    }

    /**
     * End acc04
     * ---------
     */
}