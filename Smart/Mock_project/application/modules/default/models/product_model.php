<?php
class product_model extends CI_Model
{
    protected $_table = "products";
    protected $_order = "orders";
    protected $_config = "config";
    protected $_orderDetails='order_details';
    
    public function __construct()
    {
        parent::__construct();
         $this->load->database();   
    }
    
    public function getAll() {
        $sql = "SELECT * FROM $this->_table";
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }
    
    public function getNumberPage()
	{
		$sql="SELECT number_page FROM $this->_config";
		$back = $this->db->query($sql);
        return $back->row_array();
	}

    
    public function get_total_products($low, $high, $cat=[], $brand=[]){
    	
    	if ($cat['0'] == 0){
    		//do nothing
    	}
    	else if (count($cat)==1){
    		$this->db->join("pro_cate", "pro_cate.pro_id = products.pro_id");
    		$this->db->where("pro_cate.cate_id",$cat[0]);
    	}
    	else if (count($cat)>1){
    		$this->db->join("pro_cate", "pro_cate.pro_id = products.pro_id");
    		$sql = "(pro_cate.cate_id = " . $cat[0];
    		array_shift($cat);
    		foreach ($cat as $c){
    			$sql .= " or pro_cate.cate_id = " . $c;
    		}
    		$sql .= ")";
    		$this->db->where($sql);
    	}
    	
    	if (count($brand)==1){
        	$this->db->where("brand_id",$brand[0]);
        }
        else if (count($brand)>1){
        	$sql2 = "(brand_id = " . $brand[0];
        	array_shift($brand);
        	foreach ($brand as $b){
        		$sql2 .= " or brand_id = " . $b ;
        	}
    		$sql2 .= ")";
    		$this->db->where($sql2);
        }
        
    	$this->db->where("pro_sale_price >= ", $low);
    	$this->db->where("pro_sale_price <= ", $high);
        return $this->db->count_all_results($this->_table);
    }
    
    
    public function get_limit_products($limit,$start,$field,$order,$low,$high,$cat,$brand){
        $this->db->limit($limit,$start);
        $this->db->order_by($field,$order);
        if ($cat[0] == 0){
        	//do nothing
        }
        else if (count($cat)==1){
        	$this->db->join("pro_cate", "pro_cate.pro_id = products.pro_id");
        	$this->db->where("pro_cate.cate_id",$cat[0]);
        }
        else if (count($cat)>1){
        	$this->db->join("pro_cate", "pro_cate.pro_id = products.pro_id");
    		$sql = "(pro_cate.cate_id = " . $cat[0];
    		array_shift($cat);
    		foreach ($cat as $c){
    			$sql .= " or pro_cate.cate_id = " . $c;
    		}
    		$sql .= ")";
    		$this->db->where($sql);
        }
        
    	if (count($brand)==1){
        	$this->db->where("brand_id",$brand[0]);
        }
        else if (count($brand)>1){
        	$sql2 = "(brand_id = " . $brand[0];
        	array_shift($brand);
        	foreach ($brand as $b){
        		$sql2 .= " or brand_id = " . $b ;
        	}
    		$sql2 .= ")";
    		$this->db->where($sql2);
        }
        $this->db->where("pro_sale_price >= ", $low);
        $this->db->where("pro_sale_price <= ", $high);
        $query = $this->db->get($this->_table);
        return ($query->num_rows() > 0)  ? $query->result() : FALSE;
    }
    
    
    public function get_product_new(){
        $sql = "SELECT * FROM $this->_table ORDER BY pro_id DESC LIMIT 3";
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    
    public function get_all_category(){
    	$this->db->order_by("cate_orderby","asc");
    	return $this->db->get("categories")->result_array();
    }
    
    public function listProduct()
    {  
        return $this->db->get($this->_table)->result_array();    
    }
    
    public function detail_product($id)
    {
        $sql = "SELECT p.pro_id, p.pro_name, p.pro_list_price, p.pro_sale_price, p.pro_images, p.pro_desc, p.pro_country, b.brand_name, i.img_link
				FROM products AS p
				INNER JOIN brands AS b ON b.brand_id = p.brand_id
                INNER JOIN images AS i ON p.pro_id = i.pro_id
                WHERE p.pro_id = $id";
        
        $query = $this->db->query($sql);
		return $query->result_array();
    }
    
    public function get_comment($id){
        $sql = "SELECT * FROM feedback WHERE pro_id = $id";
        
        $quey = $this->db->query($sql);
        return $quey->result_array();
    }
    
    public function sort_product($field, $order, $offset, $limit){
        $sql = "SELECT * FROM $this->_table 
                ORDER BY $field $order 
                LIMIT $offset,$limit";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function sort_product_brand($field, $order, $offset, $limit){
        $sql = "SELECT * FROM $this->_table AS p 
                INNER JOIN brands AS b
                ORDER BY b.$field $order
                LIMIT $offset,$limit";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
   function insertOrder($data){
        $this->db->insert($this->_order, $data);
        
        return $this->db->insert_id();
   }
   
   function insertOrderDetails($data){
        $this->db->insert($this->_orderDetails, $data);
   }
    
    // acc05-toannt2
    public function list_by_cate($cate_id){

        $sql = 
        "SELECT p.pro_id, p.pro_name, p.pro_desc, p.pro_list_price, p.pro_sale_price, p.pro_images FROM
        pro_cate AS pc
        LEFT JOIN products AS p ON pc.pro_id = p.pro_id
        WHERE pc.cate_id = $cate_id 
        ";
        $query = $this->db->query($sql);
        return $query->result_array();          
    }

    //acc05-toannt2
    public function get_name_by_id($pro_id){
        $this->db->select('pro_name');
        $query = $this->db->get_where($this->_table, array('pro_id' => $pro_id));
        return $query->row_array();
    }    
}