<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receiptregister extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
      
        $this->load->model('receiptregistermodel','receiptregistermodel',TRUE);
       
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/receipt_register/receipt_register_list";
        $header=""; 
        $result[''] = $this->commondatamodel->getAllDropdownData('admission_register');
        //pre($result['studentcodelist']); exit;      
                    
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
  }







} // end of class