
<?php 
class Products extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('products_model');
        $this->load->model('category_model');
        $this->load->model("brand_model");
        $this->load->model("slider_model");
        
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library("form_validation");
        $this->load->library("upload");
		$this->load->helper('url');

	}


    
    /*
	* thực hiện config khong dat co đinh page mà minh lấy
	tai ham getpage()
	*/
	//---------------------------
	public function getPage()
	{
		return $this->products_model->getNumberPage();

	}
    
    
	//toannt2 + phong
	public function index() {
		$page_number = $this->uri->segment(4);

		if(!$page_number || $page_number <= 0) {
			$page_number = 1;
		}

		foreach ($this->getPage() as $value) {
			# code...
			$page = $value;
		}
        
		$config['base_url']         = base_url() . 'administrator/products/index/';
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment']      = 4;
		$config['per_page']         = $page; 
		$config['prev_link']        = 'Prev';
		$config['next_link']        = 'Next';


		$data['title']       = 'List Products';


		// acc05-toannt2 begin
		if($this->input->post('btnSearch')){
            
            $search = $this->input->post("txtKeyword");
			if(empty($search) || trim($search) == ""){
				$this->session->unset_userdata("pro_keyword");
				$this->session->unset_userdata("pro_field");
			} else {
				$this->session->set_userdata("pro_keyword", $this->input->post("txtKeyword"));
				$this->session->set_userdata("pro_field", $this->input->post("selField"));
			}
            
            if($page_number !== 1) {
                redirect(base_url() . "administrator/products/index/1");
            }
		}
        
        $offset = ($page_number - 1) * $config['per_page'];
		$data['page_number'] = $page_number;
        
		if($this->session->userdata("pro_keyword") && $this->session->userdata("pro_field")) {
			$keyword = $this->session->userdata("pro_keyword");
			$field = $this->session->userdata("pro_field");

			switch ($field) {
			    case 'pro_name':
					$data['products'] = $this->products_model->search_like($field, $keyword, $offset, $page);
					$config['total_rows'] = count($this->products_model->search_all_like($field, $keyword));
			    	break;

			    case 'pro_id':
			    	$data['products'] = $this->products_model->search_equal($field, $keyword, $offset, $page);
			    	$config['total_rows'] = count($this->products_model->search_all_equal($field, $keyword));
			    	break;

				case 'pro_country':
					$data['products'] = $this->products_model->search_equal($field, $keyword, $offset, $page);
					$config['total_rows'] = count($this->products_model->search_all_equal($field, $keyword));
					break;

			    case 'brand':
			    	$brand_id = $this->brand_model->has_brand_name($keyword);
			    	if( $brand_id === false){
			    		$data['products'] = null;
			    		$config['total_rows'] = 0;
			    	} else {
			    		$data['products'] = $this->products_model->search_equal('brand_id', $brand_id, $offset, $page);
			    		$config['total_rows'] = count($this->products_model->search_all_equal('brand_id', $keyword));
			    	}
			    	break;

			    default:
			    	break;
			}

		// acc05-toannt2 end	
		} else {
			$config['total_rows'] = count($this->products_model->get_all_joined_products());
			$data['products'] = $this->products_model->get_limit_products($offset, $page);
        }


		$this->pagination->initialize($config); 
        $data['order'] = $this->products_model->get_slider_order();
		$data['pages'] = $this->pagination->create_links();
        $data['template'] = "product/product_view";
		$this->load->view("layout", $data);
		
	}
    
    public function setSlider(){
		$slider = $_POST['slider'];
		
		if ($slider['img_order'] == "add"){
			$max = $this->slider_model->get_max_slider();
			$add_slider = array(
				"pro_id" => $slider['pro_id'],
				"img_link" => $slider['img_link'],
				"img_order" => $max[0]['img_order'] +1
			);
			$this->slider_model->add_slider($add_slider);
		}
		else {
			$this->slider_model->delete_slider($slider['pro_id']);
		}
	}
    
    //Function insert products
    public function insert() {
		$data ['template'] = "product/product_insert";
		$data ['title'] = 'Insert Products';
		$data ['brands'] = $this->brand_model->get_all_brand ();
		$data ['category'] = $this->category_model->get_all_category ();
		
		$upload_url = "public/images/products";
		$config['upload_path'] = $upload_url;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '50000';
		
		$this->upload->initialize($config);
				
		if ($this->input->post ( "insert" )) {
			$this->form_validation->set_rules ( "pro_name", "Product name", "trim|required|is_unique[products.pro_name]" );
			$this->form_validation->set_rules ( "pro_list_price", "Product list price ", "trim|required|numeric" );
			$this->form_validation->set_rules ( "pro_sale_price", "Product sale price ", "trim|required|numeric" );
			$this->form_validation->set_rules ( "pro_desc", "Product description", "trim|required" );
			$this->form_validation->set_rules ( "pro_country", "Product origin", "trim|required" );
			$this->form_validation->set_rules ( "feature", "Feature", "trim|required" );
			
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
            $this->form_validation->set_message ( "is_unique", "%s đã tồn tại" );
			$this->form_validation->set_message ( "min_length", "%s không được nhỏ hơn %d kí tự" );
			$this->form_validation->set_message("numeric","%s phải là số");
			$this->form_validation->set_error_delimiters ( "<span class='error product-error'>", "</span>" );
			if($this->uploadMainImage()) {
                    $dataInsert['pro_images'] = $this->uploadMainImage(); 
                }

			if ($this->form_validation->run ()) {
				$data['insert'] = array (
						"pro_name" => $this->input->post ( "pro_name" ),
						"pro_list_price" => $this->input->post ( "pro_list_price" ),
						"pro_sale_price" => $this->input->post ( "pro_sale_price" ),
                        "pro_images" => $dataInsert['pro_images'],
						"pro_desc" => $this->input->post ( "pro_desc" ),
						"pro_country" => $this->input->post ( "pro_country" ),
						"brand_id" => $this->input->post ( "pro_brand" ),
						"feature" => $this->input->post("feature")	
				);
				
				
				$insert_id = $this->products_model->insert_product($data['insert']);
				foreach ($this->input->post ( "pro_cate" ) as $t ){
					$data['pro_cate'][] = array(
							"pro_id" => $insert_id, // not modified
							"cate_id" => $t
					);
				}
				if($this->uploadMultilImages()) {
                    $dataThumb = $this->uploadMultilImages();
                    foreach ($dataThumb as  $value) {
                    	# code...
                    	$this->products_model->updateThumb($value,$insert_id);
                    }

                }
				$this->products_model->insert_pro_cate($data['pro_cate']);
				if (!empty($temp_image)) {
					foreach ($temp_image as $t){
						$data['img_id'][] = array(
							"pro_id" => $insert_id,
							"img_link" => $t,
							"status" => 0
						);
					}
					$this->products_model->insert_pro_image($data['img_id']);
					$data ['template'] = "product/product_choose_image";
					$this->session->set_userdata("new_insert", $insert_id);
					$data['new_insert_image'] = $this->products_model->get_pro_image($insert_id);
					$this->load->view ( "layout", $data );
				}
                redirect(base_url("administrator/products"), 'refresh');
			}
		}
		$this->load->view ( "layout", $data );
        
        //Cancel insert
        if($this->input->post("cancel")) {
            redirect(base_url("administrator/products/"),'refresh');
        }
    }

    
    
    
    
    /**
     * acc04-toanlv
     * function update products
     */
   	public function update(){
   	    $data['title'] = "Update Products";
		$id = $this->uri->segment(4	);
        
        //check url
        if(!is_numeric($id) || intval($id) <= 0){
                show_404();
        }
        
        $all_products = $this->products_model->getAll();
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
        
		$data['infoProduct']   = $this->products_model->getInforUpdate($id);
		$data['listCatergory'] = $this->category_model->get_all_category();
		$data['brand']         = $this->brand_model->getAll();
        
		$test[] = $this->products_model->getCateId($id); 
		$test2 =array();
		for($i=0; $i < count($test); $i++){
		foreach($test[$i] as $value) {
			# code...
			$test2[]=$value['cate_id'];
			}
		}
        
		$data['listCateid'] = $test2;
		$data['image']      = $this->products_model->getImages($id);
		$data['listThumb']  = $this->products_model->getImagesThumb($id);
        
		if($this->input->post('update')){
			$this->form_validation->set_rules("pro_name","Tên sản phẩm ","trim|required");
			$this->form_validation->set_rules("pro_list_price","Giá thành ","trim|required|numeric");
			$this->form_validation->set_rules("pro_sale_price","Giá khuyến mãi ","trim|numeric");
			
			$this->form_validation->set_message("required","%s không được bỏ trống");
			$this->form_validation->set_message("numeric","%s phải là số");
			$this->form_validation->set_error_delimiters("<span class='error' color='red'>","</span>");
	
			$dataCategory = $this->input->post("category");
			if($this->form_validation->run()){
				if($this->uploadMainImage()) {
                    $dataUpdate['pro_images'] = $this->uploadMainImage(); 
                }
                else
                {
                	$dataUpdate['pro_images'] = $data['infoProduct']['pro_images'];
                }
             	$dataThumb = $this->uploadMultilImages();
             	if($dataThumb[0]!='') {
                    $this->products_model->deleteThumb($id);
                    foreach ($dataThumb as  $value) {
                    	# code...
                    	$this->products_model->updateThumb($value,$id);
                    }
                }
                else
                {
                	$dataThumb=$data['listThumb'];
                }
                
				$dataPro = array(
					"pro_name" =>$this->input->post('pro_name'),
					"pro_list_price"=>$this->input->post('pro_list_price'),
					"pro_sale_price" =>$this->input->post('pro_sale_price'),
					"pro_images"=> $dataUpdate['pro_images'],
					"pro_desc" =>$this->input->post('pro_desc'),
					"pro_country"  =>$this->input->post('pro_country'),
					"brand_id" =>$this->input->post('brand_id'),

				);
			$this->products_model->update($dataPro,$id);
			
			
			$this->products_model->deleteCate($id);
			foreach ($dataCategory as $value) {
				$this->products_model->insertCate($value,$id);
			}
			redirect(base_url("administrator/products"), 'refresh');
		}
		
		}
		$data['template'] = 'product/product_update';
		$this->load->view("layout", $data);
        
        //Cancel update
        if($this->input->post("cancel")) {
            redirect(base_url("administrator/products/"),'refresh');
        }
	}

    
    private function uploadMainImage()
    {
        $fileName = "";
        $fileInfo = $_FILES['images'];
        if($fileInfo['name'] != null ) {
            $fileName = $fileInfo['name'];
            move_uploaded_file($fileInfo['tmp_name'],"public/images/products/".$fileName);   
        }
        return  $fileName;
    }
    
    private function uploadMultilImages()
    {
        $fileInfo = $_FILES['imgs'];
        $fileName = array();
        if(isset($fileInfo['name']) && $fileInfo['name'] != null) {
            for($i = 0; $i < count($fileInfo['name']); $i++ ){
                $nameFile = $fileInfo['name'][$i];
                $fileName[] = $nameFile;
                move_uploaded_file($fileInfo['tmp_name'][$i],"public/images/thumb/".$nameFile);
            }
        }
        return $fileName;
    }
    
	public function deleteThumb()
	{
		$id       = $this->uri->segment(4);
		$img_link = $this->uri->segment(5);
        
		$this->products_model->deleteImg($id,$img_link);
		redirect(base_url("administrator/products/update/{$id}"),'refresh');
	}
    
    
    public function setMainImage(){
		if ($this->input->post( "selected_img" )) {
			$img_id = $this->input->post('main_img');
			$id = $this->session->userdata('new_insert');
			$this->products_model->set_pro_main_image($id, $img_id);
		}
		redirect(base_url("administrator/products/index"),'refresh');
	}
    
    public function delete()
	{
		$id = $this->uri->segment(4);
		$this->products_model->delete_product($id);
		redirect(base_url("administrator/products/"),'refresh');
	}
    
	//acc05-toannt2
	public function search(){
		$data['title'] = "Advanced Search";

		$page_number = $this->uri->segment(4);

		if(!$page_number || $page_number <= 0) {
			$page_number = 1;
		}

		foreach ($this->getPage() as $value) {
			$page = $value;
		}

		$config['base_url']         = base_url() . 'administrator/products/search/';
		$config['use_page_numbers'] = TRUE;
		$config['uri_segment']      = 4;
		$config['per_page']         = $page; 
		$config['prev_link']        = 'Prev';
		$config['next_link']        = 'Next';


		$data['page_number'] = $page_number;

		if($this->input->post('btnSearch')){
			$this->session->set_userdata("srch_name", $this->input->post("txtName"));
			$this->session->set_userdata("srch_brand", $this->input->post("txtBrand"));
			$this->session->set_userdata("srch_country", $this->input->post("txtCountry"));
			$this->session->set_userdata("srch_prcMin", $this->input->post("prcMin"));
			$this->session->set_userdata("srch_prcMax", $this->input->post("prcMax"));

			if($page_number !== 1){
				redirect(base_url() . "administrator/products/search/1");
			}
		}

		$offset = ($page_number - 1) * $config['per_page'];

		$name    = $this->session->userdata("srch_name"); 
		$brand   = $this->session->userdata("srch_brand");
		$country = $this->session->userdata("srch_country");
		$prcMin  = $this->session->userdata("srch_prcMin");
		$prcMax  = $this->session->userdata("srch_prcMax");

		if(isset($name) && isset($brand) && isset($country) && isset($prcMin) && isset($prcMax)) {
			if($prcMin == "") {
				$prcMin = 0;
			}

			if($prcMax == "") {
				$prcMax = 10000000;
			}				

			$all_products = $this->products_model->get_all_joined_products();
			$list_price = array();
			foreach ($all_products as $product) {
				$list_price[] = $product['pro_list_price'];
			}

			if(count($list_price) > 0 ){
				$data['max_price'] = max($list_price);
			}

			$all_result = $this->products_model->advanced_search_all($name, $brand, $country, $prcMin, $prcMax);
			$config['total_rows'] = count($all_result);

			$data['products'] = $this->products_model->advanced_search_limit($name, $brand, $country, $prcMin, $prcMax, $offset, $config['per_page']);

		} 
		
		$this->pagination->initialize($config);
		$data['order'] = $this->products_model->get_slider_order();
		$data['pages'] = $this->pagination->create_links();
        $data['template'] = "product/product_search";
		$this->load->view("layout", $data);
	} // end acc05-toannt2 search function
    
    
}