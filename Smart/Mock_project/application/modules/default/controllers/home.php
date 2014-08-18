<?php
class home extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("product_model");
    }
    public function index()
    {
       $data['listProduct'] = $this->product_model->listProduct();
       $data['template'] = "product/default";
       $this->load->view("home/layout",$data);
    }
    public function detail()
    {
        $idProduct = $this->uri->segment(4);
        $data['infoProduct'] = $this->product_model->detailProduct($idProduct);
        $data['template'] = "product/detail";
        $this->load->view("home/layout",$data);
    }
    public function count()
    {
        echo $this->product_model->countTable();
    }
    public function insert()
    {
        $dataInsert = array(
                            'pro_name'=>'Sony Experia Z2 00000',
                            'pro_price'=>1500,
                            'pro_price_sale'=>1000,
                            'pro_desc'=>'Sony Experia Z2 00000',
                            'pro_info'=>'Sony Experia Z2 00000Sony Experia Z2 00000Sony Experia Z2 00000'
                      );
        $this->product_model->insertProduct($dataInsert);
    }
    public function update()
    {
        $dataUpdate = array(
                            'pro_name'=>'Sony Experia Z1 (update)',
                            'pro_price'=>1500,
                            'pro_price_sale'=>1000,
                            'pro_desc'=>'Sony Experia Z1 update',
                            'pro_info'=>'Sony Experia Z1 update'
                      );
        $this->product_model->updateProduct($dataUpdate,$id=7);
    }
    public function delete()
    {
        $this->product_model->deleteProduct($id=7);
    }
    public function createLibrary()
    {
        $data = array("username","email","address");
        $this->load->library("test");
        $this->test->debug($data);
    }
    
    
    
    
    
}