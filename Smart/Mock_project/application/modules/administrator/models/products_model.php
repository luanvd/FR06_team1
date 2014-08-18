<?php 
class Products_model extends CI_Model{
	protected $_table = "products";
    protected $_cate = "pro_cate";
	protected $_image = "images";
    protected $_slider = "sliders";
    protected $tbl_category = "categories";
    protected $_config = 'config';

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    
    public function getAll() {
        $this->db->select("*");
        $query = $this->db->get($this->_table);
        
        return $query->result_array();
    }
    
    public function get_all_category(){
        $this->db->select("*");
		$query = $this->db->get($this->tbl_category);
        
		return $query->result_array();
	}

	// acc01-phong
	public function get_total_products(){
		return $this->db->count_all($this->_table);
	}
    
    public function get_all_product() {
		return $this->db->get($this->_table)->result_array();	
	}

	public function get_limit_products($offset, $limit){
		$this->db->from($this->_table);
		$this->db->select("products.pro_id, products.pro_name, products.pro_list_price, products.pro_sale_price, products.pro_desc, products.pro_country,products.pro_images, brands.brand_name, products.feature");
		$this->db->join("brands","brands.brand_id = products.brand_id");
		$this->db->limit($limit,$offset);
		return $this->db->get()->result_array();
	}
    
    public function get_product_image(){
		return $this->db->get("images")->result_array();
	}
	
	public function insert_product($data){
		$this->db->insert($this->_table,$data);
		return $this->db->insert_id();
	}
	
	public function insert_pro_cate($data){
		$this->db->insert_batch($this->_cate,$data);
	}
	
	public function insert_pro_image($data){
		$this->db->insert_batch($this->_image,$data);
	}
	
	public function set_pro_main_image($id, $img_id){
		$data = array("status" => 1);
		$data2 = array("img_id" => $img_id);
		$this->db->update($this->_table,$data2,"pro_id = $id");
		$this->db->update($this->_image,$data,"img_id = $img_id");
	}
	
	public function get_pro_image($id){
		$this->db->where("pro_id",$id);
		return $this->db->get($this->_image)->result_array();
	}
    //End acc01
    
    
    //acc02-quynh
    public function delete_product($id)
	{       
		$this->db->where("pro_id", $id);
        $this->db->delete($this->_cate);
        
        $this->db->where("pro_id", $id);
        $this->db->delete($this->_image);
        
        $this->db->where("pro_id", $id);
        $this->db->delete($this->_table);
	}
    //End acc02
    
    
    //acc04-toanlv
    public function getInforUpdate($id){
        $this->db->select("*");
        $this->db->where("pro_id", $id);
		$query= $this->db->get($this->_table);
        
		return $query->row_array();
	}

	public function getCateId($id){
	    $this->db->select("cate_id");
        $this->db->where("pro_id", $id);
        $query = $this->db->get($this->_cate);
        
		return $query->result_array();
	}

	public function getImagesThumb($id){
	    $this->db->select("*");
        $this->db->where("pro_id", $id);
        $query = $this->db->get($this->_image);
        
		return $query->result_array();
	}
	
	public function getImages($id){
	    $data = array(
                'pro_id'=>$id,
                'status'=>'1'
                );
        $this->db->where($data);
        $query = $this->db->get($this->_image);
        
		return $query->row_array();
	}

	public function update($data,$id){
		$this->db->where("pro_id = $id");
		$this->db->update($this->_table,$data);
	}
    
    public function updateMainImage($image, $id){
        $data = array(
                'img_link'=>$image
                );
        $where = array(
                'pro_id'=>$id,
                'status'=>'1'
                );
        $this->db->where($where);
        $this->db->update($this->_image, $data);
	}
    
	public function deleteCate($id){
	    $this->db->where("pro_id", $id);
        $this->db->delete($this->_cate);
	}
    
	public function insertCate($value, $id){
	    $data = array(
                    'pro_id'=>$id,
                    'cate_id'=>$value
                    );
        $this->db->insert($this->_cate, $data);
	}
    
    
    public function deleteThumb($id){
        $this->db->where("pro_id", $id);
        $this->db->delete($this->_image);
	}
    
	public function updateThumb($value,$id){
		$sql="INSERT INTO images (img_id,pro_id,img_link,status) VALUES ('','".$id."', '".$value."','1')";
		$this->db->query($sql);
	}
    
	public function deleteImg($id,$img){
	    $where = array(
                        'pro_id'=>$id,
                        'img_link'=>$img
                        );
	    $this->db->where($where);
        $this->db->delete($this->_image);
	}

    //End acc04
    
    
    // acc05-toannt2
    public function get_all_joined_products(){
		$sql = "SELECT *
				FROM products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
    
	public function search_all_like($_field, $_keyword){

		$field = mysql_real_escape_string($_field);
		$keyword = mysql_real_escape_string($_keyword);

		$sql = "SELECT *
				FROM products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id	
				WHERE p.$field LIKE '%$keyword%'";

		$query = $this->db->query($sql);
		return $query->result_array();		
	}
    
	public function search_all_equal($_field, $_keyword){

		$field = mysql_real_escape_string($_field);
		$keyword = mysql_real_escape_string($_keyword);

		$sql = "SELECT *
				FROM products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id
				WHERE p.$field = '$keyword'";

		$query = $this->db->query($sql);
		return $query->result_array();	
	}
    
	public function search_like($_field, $_keyword, $offset, $limit){

		$field = mysql_real_escape_string($_field);
		$keyword = mysql_real_escape_string($_keyword);

		$sql = "SELECT p.pro_id, p.pro_name, p.pro_list_price, p.pro_sale_price, p.pro_desc, p.pro_images, p.pro_country, b.brand_name, 
                IF( p.feature =1,  'YES',  'NO' ) AS feature
				FROM products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id	
				WHERE $field LIKE '%$keyword%'
				LIMIT $offset,$limit";

		$query = $this->db->query($sql);
		return $query->result_array();
	}
    
	public function search_equal($_field, $_keyword, $offset, $limit){

		$field = mysql_real_escape_string($_field);
		$keyword = mysql_real_escape_string($_keyword);

		$sql = "SELECT p.pro_id, p.pro_name, p.pro_list_price, p.pro_sale_price, p.pro_desc, p.pro_images, p.pro_country, b.brand_name, IF( p.feature =1,  'YES',  'NO' ) AS feature
				FROM products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id
				WHERE p.$field = '$keyword'
				LIMIT $offset,$limit";

		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// acc05-toannt2
	public function advanced_search_limit($_name, $_brand, $_country, $prcMin, $prcMax, $offset, $limit){

		$name = mysql_real_escape_string($_name);
		$brand = mysql_real_escape_string($_brand);
		$country = mysql_real_escape_string($_country);

		$sql = "SELECT p.pro_id, p.pro_name, p.pro_list_price, p.pro_sale_price, p.pro_desc,  p.pro_images, p.pro_country, b.brand_name, IF( p.feature =1,  'YES',  'NO' ) AS feature
				FROM (products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id)	
				WHERE ((p.pro_name LIKE '%$name%') AND (p.pro_country LIKE '%$country%') 
					AND (p.pro_list_price >= $prcMin) AND (p.pro_list_price <= $prcMax)
					AND (b.brand_name LIKE '%$brand%'))
				LIMIT $offset,$limit";

		$query = $this->db->query($sql);
		return $query->result_array();		
	}


	// acc05-toannt2
	public function advanced_search_all($_name, $_brand, $_country, $prcMin, $prcMax){

		$name = mysql_real_escape_string($_name);
		$brand = mysql_real_escape_string($_brand);
		$country = mysql_real_escape_string($_country);

		$sql = "SELECT *
				FROM (products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id)	
				WHERE ((p.pro_name LIKE '%$name%') AND (p.pro_country LIKE '%$country%') 
					AND (p.pro_list_price >= $prcMin) AND (p.pro_list_price <= $prcMax)
					AND (b.brand_name LIKE '%$brand%')
					)";

		$query = $this->db->query($sql);
		return $query->result_array();		
	}

    //End acc05
    
    
    public function get_slider_order(){
		$this->db->select("sliders.pro_id,products.pro_name,sliders.img_link,sliders.img_order");
		$this->db->join("products","products.pro_id = sliders.pro_id");
		$this->db->order_by("img_order asc");
		return $this->db->get($this->_slider)->result_array();
	}
    
    public function getNumberPage()
	{
	    $this->db->select("number_page");
        $query = $this->db->get($this->_config);
        
        return $query->row_array();
	}
}