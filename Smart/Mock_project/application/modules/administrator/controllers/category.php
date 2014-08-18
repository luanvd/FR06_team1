<meta charset="UTF-8" />

<?php
	class Category extends CI_Controller{
		public function __construct(){
    		parent::__construct();
    		$this->load->library('pagination');
    		$this->load->library('session');		
    		$this->load->helper(array('form','url'));
    		$this->load->model("category_model");
    		$this->load->library('form_validation');
		}
		
        //acc02-quynh
		public function index() {
            $data = array();
            $categories = array();
            $data['title'] = "List Category";
            
            $result['listitem'] = $this->category_model->get_all_category();
			
			$data['info'] = $this->get_category($result['listitem']);
            
            $parent = $this->category_model->getParentCategory();  
            
            //$data['category'] = $this->getNameCategory($categories);
            $data['template'] = 'category/category_view';
            $this->load->view("layout", $data);
        }
		//End acc02
        
        
        public function get_category($data, $parent = 0, $lvl = 1){
			$ret = "<ol class='dd-list'>";
			
			$temp = array();
			
			foreach ($data as $d){
				foreach ($d as $key => $value){
					if (!isset($temp[$key])){
						$temp[$key] = array();
					}
					$temp[$key][] = $value;
				}
			}
			$orderby = "cate_orderby";
			
			array_multisort($temp[$orderby], SORT_ASC,$data);
			
			foreach ($data as $key=>$value){
				if ($parent == $value['parent_id']){
					$ret .= "<li class='dd-item' data-id='".$value['cate_id']."'><div class='dd-handle'>".$value['cate_name'] . "<a href='". base_url() . "administrator/category/delete/". $value['cate_id'] ."' onclick='if(checkDelete() == false) return false'>Delete</a><a href='". base_url() . "administrator/category/update/". $value['cate_id'] ."'>Update</a></div>";
					$sub = $this->get_category($data,$value['cate_id'],$lvl+1);
					if ($sub != "<ol class='dd-list'></ol>"){
						$ret .= $sub;
					}
					$ret .= "</li>";
				}
			}
			return $ret. "</ol>";
		}
        
        
		
		// acc05-toannt2 method
    	public function insert(){
    		$cate_name = '';
    
    		if($this->input->post("insert")){
    			$this->form_validation->set_rules("cate_name","Tên của category","trim|required|is_unique[categories.cate_name]");
                
    			$this->form_validation->set_message("required","%s không được để trống");
    			$this->form_validation->set_message("is_unique","%s đã tồn tại");
                $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
    
    			if ($this->form_validation->run()) {
    
    				$cate_name = $this->input->post("cate_name");
    				$parent_id = $this->input->post("parent_id");
    
    				$orderby = array();
    				$all_orders = $this->category_model->get_all_orderby();
    				foreach ($all_orders as $orders) {
    					$orderby[] = $orders["cate_orderby"];
    				}
    				$cate_orderby = max($orderby) + 1;
    				$this->category_model->insert_category($cate_name, $parent_id, $cate_orderby);
    				redirect(base_url("administrator/category/"),'refresh');
    			}
    		}
    
    		$data['title']        = 'Insert Category';
    		$data['name']         = $cate_name;
    		$data['parent_cates'] = $this->category_model->get_category();
    
    		$data['template'] = 'category/category_insert';
            $this->load->view("layout", $data);
            
            //cancel insert
            if($this->input->post("cancel")) {
                redirect(base_url("administrator/category/"),'refresh');
            }
	   }
       //End acc05
       
       //acc01-phong
       public function move(){
			if ($this->input->post("submit")){
				$data = $_POST['data'];
				$result['datasent'] = json_decode($data);
			}
			$result['info'] = $this->category_model->get_all_category();
			
			$result['listitem'] = $this->listCat($result['info']);
			$result['title'] = "Move categories";
            $result['template'] = "category/category_move";
            $this->load->view("layout", $result);
		}
		
		public function listCat($data, $parent = 0, $lvl = 1){
			$ret = "<ol class='dd-list'>";
			
			$temp = array();
			
			foreach ($data as $d){
				foreach ($d as $key => $value){
					if (!isset($temp[$key])){
						$temp[$key] = array();
					}
					$temp[$key][] = $value;
				}
			}
			$orderby = "cate_orderby";
			
			array_multisort($temp[$orderby], SORT_ASC,$data);
			
			foreach ($data as $key=>$value){
				if ($parent == $value['parent_id']){
					$ret .= "<li class='dd-item' data-id='".$value['cate_id']."'><div class='dd-handle'>".$value['cate_name'] . "</div>";
					$sub = $this->listCat($data,$value['cate_id'],$lvl+1);
					if ($sub != "<ol class='dd-list'></ol>"){
						$ret .= $sub;
					}
					$ret .= "</li>";
				}
			}
			return $ret. "</ol>";
		}
		
		public function move_process(){
			$all = $this->category_model->get_all_category();
			$update = $_POST['data'];
			$o = 1;
			$order = array();
			$parent = array();
			foreach ($update as $key => $value){
				foreach ($all as $a => $b){
					$key = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
					if ($key == $b['cate_id']){
						if ($value != $b['parent_id']){
							$parent[] = array(
									"cate_id" => $key,
									"parent_id" => $value
							);
						}
						$order[] = array(
								"cate_id" => $key,
								"cate_orderby" => $o++
						);
						continue;
					}
				}
			}	
			print_r($update);
			
			$this->category_model->move_category($parent);
			$this->category_model->set_order($order);
		}
        //End ac01
        
        //acc04-toanlv
        public function update(){
            $data['title'] = "Update Categories";
    		$id = $this->uri->segment(4	);
            
            //check url
            if(!is_numeric($id) || intval($id) <= 0){
                    show_404();
            }
            
            $all_categories = $this->category_model->get_all_category();
            $all_id = array();
            if(!empty($all_categories)){  
                foreach($all_categories as $category){
                    $all_id[] = $category['cate_id'];
                }
            }
            
            if(!in_array($id, $all_id)){
                show_404();
            }
            //End check url
            
    		$data['cateInfor']= $this->category_model->detail($id);
    		$data['cateAll']=$this->category_model->get_all_category();
            
    	
    		if($this->input->post('update')){
    			$this->form_validation->set_rules("cate_name","Tên category ","trim|required|is_unique[categories.cate_name]");
    
    			$this->form_validation->set_message("required","%s không được bỏ trống");
                $this->form_validation->set_message("is_unique","%s đã tồn tại");
    
    			$this->form_validation->set_error_delimiters("<span class='error'>","</span>");
    			if($this->form_validation->run()){
    				$dataCate = array(
                                    "cate_name"=>$this->input->post("cate_name")
                                    );
    				$this->category_model->update($dataCate,$id);
    				redirect(base_url("administrator/category"));
    			}
    		}
            
    		$data['template'] = 'category/category_update';
            $this->load->view("layout", $data);
            
            //cancel insert
            if($this->input->post("cancel")) {
                redirect(base_url("administrator/category/"),'refresh');
            }
	   }
        //End acc04
        
        public function delete() {
            $id = $this->uri->segment(4);
            
            if(!is_numeric($id) || $id <= 0){
                show_404();
            }
            
            $all_cate = $this->category_model->get_all_category();
            
            $all_cate_id = array();
            
            foreach($all_cate as $cate){
                $all_cate_id[] = $cate['cate_id'];
            }
            
            if(!in_array($id, $all_cate_id)){
                show_404();
            }
            
            $parent_id = $this->category_model->detail($id)['parent_id'];
            
            if(!isset($parent_id) || $parent_id == null){
                show_404();
            }
            else {
                $this->category_model->update_parent(array("parent_id" => $parent_id), $id);
                $this->category_model->delete_category($id);
            }
            
            redirect(base_url("administrator/category/"),'refresh');
	   }
}