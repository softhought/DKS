<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Specialmember extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('membermastermodel','membermastermodel',TRUE);
       
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/special-member/special_member_list";
        $header="";  
        
        

        $result['specialmemberlist'] = $this->membermastermodel->getallspecialmemberlist();
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

}