<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membermaster extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/member-master/member_list";
        $header="";  

        $result = [];
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addmember(){

$session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['memberId'] = 0;
        $result['memberEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['memberId'] = $this->uri->segment(3);

          $where = array('member_id'=>$result['memberId']);

          //$result['memberEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('account_group',$where);
           

       }

        $page = "dashboard/member-master/addeditmember";
        $header="";
 
        
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }


}




}
