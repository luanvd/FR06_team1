<?php 
class Report_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		
		$this->load->database();
	}

	public function top_product_all($fromDate, $toDate){

		$sql = 
		"SELECT p.pro_id, COUNT(p.pro_id) as count, p.pro_name
		FROM (
			(SELECT * FROM orders WHERE order_time >= '$fromDate' AND order_time <= '$toDate' AND order_status = 1) AS o	
			LEFT JOIN order_details AS od ON od.order_id = o.order_id
            INNER JOIN products AS p ON od.pro_id = p.pro_id
		) GROUP BY od.pro_id ORDER BY count DESC
		";

		$query = $this->db->query($sql);
		return $query->result_array();		
	}

	public function top_product_limit($fromDate, $toDate, $offset, $limit){

		$sql = 
		"SELECT p.pro_id, COUNT(p.pro_id) as count, p.pro_name
		FROM (
			(SELECT * FROM orders WHERE order_time >= '$fromDate' AND order_time <= '$toDate' AND order_status = 1) AS o
			LEFT JOIN order_details AS od ON od.order_id = o.order_id
            INNER JOIN products AS p ON od.pro_id = p.pro_id            
		) GROUP BY od.pro_id ORDER BY count DESC LIMIT $offset, $limit
		";

		$query = $this->db->query($sql);
		return $query->result_array();		
	}

	public function top_category_all($fromDate, $toDate){
		$sql = 
		"SELECT cate.cate_id, count(cate.cate_id) as count, cate.cate_name, cate.parent_id
		FROM (
			(SELECT * FROM orders WHERE order_time >= '$fromDate' AND order_time <= '$toDate' AND order_status = 1) AS o
			LEFT JOIN order_details AS od ON od.order_id = o.order_id
			INNER JOIN pro_cate AS pc ON od.pro_id = pc.pro_id
			LEFT JOIN categories as cate ON pc.cate_id = cate.cate_id
		) GROUP BY cate.cate_id ORDER BY count DESC
		";

		$query = $this->db->query($sql);
		return $query->result_array();	
	}
}