<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Membermonthalybill extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberbillmodel','memberbillmodel',TRUE);
        $this->load->model('companymodel', '', TRUE);   
       
    }

public function index()
{

  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/member-mothaly-billdetail/member_bill_list.php";
        $header="";  
        $company=$session['companyid'];
        $year=$session['yearid'];
      
        $member_id='';
        //$month=ltrim(date('m'),'0');
          $month='4';
        $category = '';      
        $result['billList'] = $this->memberbillmodel->getMemberBillMasterData($member_id,$category,$month,$year,$company);
        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);
       

      //  $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
        $result['memberList'] = $this->memberbillmodel->getallmemberlist();
         
       // pre($result['billList']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function getBillingdataByMonth(){

  $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $company=$session['companyid'];
          $year=$session['yearid'];
          $sel_member = $this->input->post('sel_member');
          $category = '';
          $month = $this->input->post('month');

     
      $result['billList'] = $this->memberbillmodel->getMemberBillMasterData($sel_member,$category,$month,$year,$company);
    

       $page = "dashboard/member-mothaly-billdetail/member_bill_list_partial_view.php"; 

        $this->load->view($page,$result);

        

      }else{
          redirect('login','refresh');
      } 

  }

}