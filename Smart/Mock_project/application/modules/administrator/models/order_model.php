<meta charset="UTF-8" />
<?php
    class Order_model extends CI_Model{
        protected $_table = "orders";
        protected $tbl_orderDetail = "order_details";
        
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }
        
        public function get_all_order() {
            $this->db->select("*");
            $query = $this->db->get($this->_table);
            
            return $query->result_array();
        }
        
        public function get_order() {
            $this->db->select("*");
            $this->db->order_by("order_status ASC");            
            $query = $this->db->get($this->_table);
            
            return $query->result_array();
        }
        
        public function get_info_user($id) {
            $this->db->select("*");
            $this->db->where("order_id", $id);
            $query = $this->db->get($this->_table);
            
            return $query->result_array();
        }
        
        public function get_detail_order($id) {
            $sql = "SELECT * FROM $this->tbl_orderDetail AS d 
                    INNER JOIN $this->_table AS o 
                    ON d.order_id = o.order_id 
                    WHERE d.order_id = $id";
                           
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        
        public function delete($id) {
    		$this->db->where("order_id", $id);
            $this->db->delete($this->tbl_orderDetail);
            
            $this->db->where("order_id", $id);
    		$this->db->delete($this->_table);
	   }
       
       public function pay($id) {
        $data = array(
                'order_status'=>'1'
                );
        $this->db->where("order_id", $id);
        $this->db->update($this->_table, $data);
       }
    }
?>