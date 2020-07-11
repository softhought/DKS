<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useraudit extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('Userauditmodel','audit',TRUE);       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "usermanagement/useraudit";
        $header="";       
        $result['usersAuditList']=$this->audit->getAuditList($session['userid']);
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


}//end of class