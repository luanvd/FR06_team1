
<?php
    $this->load->view("template/top");
    
    if(isset($colleft)) {
        $this->load->view($colleft);
    }
    
    if(isset($colright)) {
        $this->load->view($colright);
    }
    
    if(isset($slider)){
        $this->load->view($slider);
    }
    
    if(isset($list_new_products)){
        $this->load->view($list_new_products);
    }
    
    if(isset($search)){
        $this->load->view($search);
    }
    
    $this->load->view($template);
    
    
    $this->load->view("template/footer");
?>