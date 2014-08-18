<?php
class product extends CI_Controller
{
    const PER_PAGE = 3; //TODO: config
    
    public function  __construct()
    {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("brand_model");
        $this->load->model("slider_model");
        $this->load->model("category_model");
        $this->load->model("feedback_model");
                
        $this->load->library("cart");
        $this->load->library('session');
        $this->load->library("form_validation");
        $this->load->library('pagination');
        $this->load->helper(array('form','url'));
        $this->load->helper('url');
        

    }
    
    
    //Function get number page
    public function getPage()
    {
        return $this->product_model->getNumberPage();

    }


    
    //Home page
    public function index(){
        $field = isset($_POST['sortBy']) ? $_POST['sortBy'] : 1;
    	$order = isset($_POST['sortDir']) ? $_POST['sortDir'] : "asc";
    	$low = isset($_POST['lowprice']) ? $_POST['lowprice'] : 0;
    	$high = isset($_POST['highprice']) ? $_POST['highprice'] : 200000000;
    	$brand = isset($_POST['brand']) ? $_POST['brand'] : [];
    	$cat = isset($_POST['cat']) ? $_POST['cat'] : ["0"];
        
        switch ($field){
    		case 1: {
    			$field = "pro_name";
    			break;
    		}
    		case 2:{
    			$field = "brand_id";
    			break;
    		}
    		case 3:{
    			$field = "pro_country";
    			break;
    		}
    		case 4: {
    			$field = "pro_sale_price";
    			break;
    		}
    		default: {
    			$field = "pro_name";
    			break;
    		}
    	}
        
        
        foreach ($this->getPage() as $value) {
            $page = $value;
        }

    	$config['base_url']         = base_url() . 'default/product/index/';
    	$config['total_rows']       = $this->product_model->get_total_products($low,$high,$cat,$brand);
    	$config['per_page']         = $page;
    	$config['is_ajax_paging']	= TRUE;
    	$config['uri_segment']		= 4;
    	$config ['prev_link']		= 'Prev';
		$config ['next_link'] 		= 'Next';
    	 
    	$this->pagination->initialize($config);
    	 
    	$page_number = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    	
    	$data['pages']       = $page_number;
    	$data['products'] = $this->product_model->get_limit_products($config['per_page'],$page_number,$field,$order,$low,$high,$cat,$brand);
    	$data['brands'] = $this->brand_model->get_all_brand();
    	$cat = $this->product_model->get_all_category();
    	$data['category'] = $this->listCat($cat);
    	
    	if ($this->input->post("ajax",true)){
    		echo json_encode(array(
    				"result" => $data['products'],
    				"pagination" => $this->pagination->create_links()
    		));
    		return;
    	}
        
        $data['img_slider']   = $this->slider_model->get_slider_order();
        $data['new_products'] = $this->product_model->get_product_new();
        
        
        $data['colleft']      = 'template/colleft';
        $data['colright']     = 'template/colright';
        $data['slider']       = 'template/slider';
        $data['list_new_products'] = 'template/list_new_products';
        $data['search']       = 'template/search';
        $data['template']     = 'product/productAll';
		$this->load->view("layout", $data);
        
        if($this->input->post('addCart')){
            $data2 = $this->cart->contents();
            $id = $this->input->post('pro_id');
            foreach ($data2 as  $value) {
                 if($id == $value['id']){
                    $return_rowid = $value['rowid'];
                    $return_qty   = $value['qty'];
                 }
            }
            if(isset($return_rowid)){
                $update['rowid'] = $return_rowid;
                $update['qty']   = $return_qty+1;
                $this->cart->update($update);
                redirect(base_url("/default/product/"), 'refresh');
            }
            else
            {
                $data = array(
                            'id'=>$this->input->post('pro_id'),
                            'name'=>$this->input->post('pro_name'),
                            'qty'=>$this->input->post('qty'),
                            'price'=>$this->input->post('pro_price'),
                            'option'=> array("pro_images" =>$this->input->post('pro_images'))
                        );
            
                $this->cart->insert($data);
                redirect(base_url("/default/product/"), 'refresh');
            }
        } 
    }
    
    
    //Function show detail product
    public function details() {
        $id = $this->uri->segment(4);
        
        //Add cart
        if($this->input->post('addCart')){
            $data2 = $this->cart->contents();
            $id = $this->input->post('pro_id');
            foreach ($data2 as  $value) {
                 if($id == $value['id']){
                    $return_rowid = $value['rowid'];
                    $return_qty   = $value['qty'];
                 }
            }
            if(isset($return_rowid)){
                $update['rowid'] = $return_rowid;
                $update['qty']   = $return_qty+1;
                $this->cart->update($update);
                redirect(base_url("/default/product/details/$id"), 'refresh');
            }
            else
            {
                $data = array(
                            'id'=>$this->input->post('pro_id'),
                            'name'=>$this->input->post('pro_name'),
                            'qty'=>$this->input->post('qty'),
                            'price'=>$this->input->post('pro_price'),
                            'option'=> array("pro_images" =>$this->input->post('pro_images'))
                        );
            
                $this->cart->insert($data);
                redirect(base_url("/default/product/details/$id"), 'refresh');
            }
        }
        //End add cart
          
        
        //Check url
        if(!is_numeric($id) || intval($id) <= 0){
                show_404();
        }   
    
        $all_products = $this->product_model->getAll();
        $all_id = array();
        if(!empty($all_products)){  
            foreach($all_products as $product){
                $all_id[] = $product['pro_id'];
            }
        }
        
        if(!in_array($id, $all_id)){
            show_404();
        }
        //End check url
        
        
        //Check validate comment                
        if($this->input->post("submit")){

            $this->form_validation->set_rules("name","Tên ","trim|required");
            $this->form_validation->set_rules("email","Email ","trim|required|valid_email");
            $this->form_validation->set_rules("title","Tiêu đề ","trim|required");
            $this->form_validation->set_rules("content","Nội dung nhận xét ","trim|required");

            $this->form_validation->set_message("required","%s không được bỏ trống");
            $this->form_validation->set_message("valid_email","%s không đúng định dạng");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");  

            $feed_name    = $this->input->post("name");
            $feed_email   = $this->input->post("email");
            $feed_rate    = $this->input->post("rating");
            $feed_title   = $this->input->post("title");
            $feed_content = $this->input->post("content");
            $pro_id = $id;

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $feed_time = $date = date('Y/m/d h:i:s', time());

            if($this->form_validation->run()){
                $this->feedback_model->insert($feed_name, $feed_email, $feed_title, $feed_content, $feed_rate, $feed_time, $pro_id);
            } else{
                $data['name']    = $feed_name;
                $data['email']   = $feed_email;
                $data['rating']  = $feed_rate;
                $data['title']   = $feed_title;
                $data['content'] = $feed_content;
            }
        }
        $cat = $this->product_model->get_all_category();
        $avg_rate = $this->feedback_model->avg_rate($id);
        
        $data['product']    = $this->product_model->detail_product($id);
        $data['feedback']   = $this->feedback_model->get_feedback_by_pro_id($id);
        $data['category']   = $this->listCat($cat);
        $data['count_rate'] = $avg_rate['count'];
        $data['avg_rate']   = $avg_rate['avg'];
        $data['template']   = 'product/product_details';

        $this->load->view("layout", $data);
    }
    //End function details
    
     
    
    //Function list categories
    public function listCat($data,$parent=0,$lvl=1){
    	$ret = "<ul class='cat_menu'>";
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
    			$ret .= "<li class='cate_li' catename='".$value['cate_name']."' cateid='".$value['cate_id']."'>".$value['cate_name'];
    			$sub  = $this->listCat($data,$value['cate_id'],$lvl+1);
    			if ($sub != "<ul class='cat_menu'></ul>"){
    				$ret .= $sub;
    			}
    			$ret .= "</li>";
    		}
    	}
    	return $ret. "</ul>";
    }
    
    
    
    //Function shopping cart
    public function cart(){
        $data['products']=$this->cart->contents();
        if($this->input->post('update-cart')){
            $data1=$this->input->post('quantity');
            $number_member = count($data1);
            for($i = 0 ; $i < $number_member ; $i++) {
                $stt = 0;
                foreach ($data['products'] as $key => $value) {
                    if($stt ==$i){
                        $data['products'][$key]['qty'] = $data1[$i];
                        $rowid=$data['products'][$key]; 
                        $rowid['qty']=$data1[$i];
                        $update['rowid']=$key;
                        $update['qty']=$data1[$i];
                        $this->cart->update($update);
                        break;
                    }
                    $stt++;
                }
            }
            redirect(base_url("default/product/cart"), "refresh");
        }
        
        $data['template'] = 'product/cart';
        $data['categories'] = $this->category_model->get_all_category();
        $this->load->view("layout", $data);

    }
    
    
    //Function check out
    public function checkout(){
        $data['products']=$this->cart->contents();
        if($this->input->post("checkout")){
            $this->form_validation->set_rules("name","Tên ","trim|required|");
            $this->form_validation->set_rules("email","Email ","trim|required|valid_email");
            $this->form_validation->set_rules("address","Địa chỉ ","trim|required");
            $this->form_validation->set_rules("phone","Số điện thoại ","trim|required|numeric|min_length[10]|max_length[11]");
    
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
                        'order_id'=>"",
                        "name"=>$this->input->post("name"),
                        "email"=>$this->input->post("email"),
                        "address"=>$this->input->post("address"),
                        "phone"=>$this->input->post("phone"),
                        'order_status'=>"0"
                );
                $order_id = $this->product_model->insertOrder($dataUser);
                $data1    = $data['products'];
                foreach ($data1 as  $value) {
                    $dataDetails = array(
                            "orderdetail_id"=>"",
                            "pro_name"=>$value['name'],
                            "order_price"=>$value['price'],
                            "quantity"=>$value['qty'],
                            "order_id"=>$order_id,
                            "pro_id"=>$value['id']
                        );
                    $this->product_model->insertOrderDetails($dataDetails);
                }
                $this->clear();
            }
        } 
        $data['template'] = "product/checkout";
        $this->load->view("layout", $data);
        
        //Cancel checkout
        if($this->input->post("cancel")) {
            redirect(base_url("default/product/cart"),'refresh');
        }
    }
    
    
    //Function delete product in shopping cart
    public function delete(){
       $id = $this->uri->segment(4);
       $data=$this->cart->contents();
       foreach($data as $item){
            if($item['id'] == $id){
                $item['qty'] = 0;
                $delOne = array("rowid" => $item['rowid'], "qty" => $item['qty']);
            }
        }
        if($this->cart->update($delOne));
      redirect(base_url("default/product/cart"), 'refresh');

    }
    
    
    //Function delete all products in shopping cart
    public function deleteAll(){
        $this->cart->destroy();
        unset($data);
        redirect(base_url("default/product/cart"), 'refresh');
    }
    
    
    //Function clear shopping cart
    public function clear(){
        ?>
        <script>
                alert("Thank you !");
        </script>
        <?php
        $this->cart->destroy();
        unset($data);
        redirect(base_url("default/product/index"), 'refresh');
    }
    
   
    

    // acc05-toannt2
    public function list_by_cate(){

        $selected_cate = $this->uri->segment(4);

        if(!$selected_cate){
            $selected_cate = '1';
        }

        $page_number = $this->uri->segment(5);

        if(!$page_number || $page_number <= 0){
            $page_number = '1';
        }

        $config['base_url']         = base_url() . 'default/product/list_by_cate/' . $selected_cate;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']      = 5;
        $config['per_page']         = self::PER_PAGE; 
        $config['prev_link']        = 'Prev';
        $config['next_link']        = 'Next';

        $data = array();
        $selected_cate_name = $this->category_model->get_name_by_id($selected_cate);
        if(isset($selected_cate_name['cate_name'])){
            $data['cate_name'] = $selected_cate_name['cate_name'];
        }

        $all_cates = $this->category_model->get_relationship();
        $cate_chain = array_merge(array($selected_cate), $this->dequy($selected_cate, $all_cates));
        
        $data['products'] = array();
        foreach ($cate_chain as $cate) {
            $data['products'] = array_merge($data['products'], $this->product_model->list_by_cate($cate));
        }

        $config['total_rows'] = count($data['products']);

        $offset = ($page_number - 1) * $config['per_page'];

        $data['products'] = array_slice($data['products'], $offset, $config['per_page']);
        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $data['search']       = 'template/search';
        $data['template'] = '/product/product_by_cate';
        $this->load->view("layout", $data);
    }

    // acc05-toannt2
    private function dequy($parent_id, $all_cates){
        $chain = array();
        foreach ($all_cates as $cate) {
            if($cate['parent_id'] == $parent_id) {

                array_push($chain, $cate['cate_id']);

                $chain = array_merge($chain, $this->dequy($cate['cate_id'], $all_cates));
            }
        }
        return $chain;
    }
    
    public function sort_list() {
        if(isset($_POST['sort_field'])){
            $sort_field = $_POST['sort_field'];
        }
        else 
            $sort_field = 'pro_name';
            
        if(isset($_POST['sort_type'])) {
            $sort_type = $_POST['sort_type'];
        }
        else
            $sort_type = 'ASC';
            
        $config['per_page'] = 6;
        $start = 0;
        
        $data = $this->product_model->get_limit_products($sort_field, $sort_type, $start, $config['per_page']);
        echo json_encode($data);
    }
    
    
    
    //Contact us
    function contact(){
        $data['template'] = "template/contact_us";
        $this->load->view('layout', $data);
    }
    
    
    //About us
    function about(){
        $this->load->view("template/about_us");
    }

}