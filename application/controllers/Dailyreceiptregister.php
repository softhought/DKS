<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dailyreceiptregister extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberreceiptmodel','memberreceiptmodel',TRUE);
        $this->load->model('dailyreceiptregistermodel','dailyreceiptregistermodel',TRUE); 
        $this->load->model('companymodel', '', TRUE);     
      
    }

public function index()
{
  
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/daily-receipt-register/daily_receipt_register_list";
        $header="";       
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=date('Y-m-d');
         $to_dt=date('Y-m-d');
        //  $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
        //  $result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
        $result['paymentmodelist'] = $this->commondatamodel->getAllRecordWhere('payment_mode_details',[]);

        $result['trantypelist'] = array('ORADMITM' => "Other Receipts", 'RCFM' => "Receivable From Member");
        
         $member_id='All';

        $result['memberReceiptList'] = $this->dailyreceiptregistermodel->getMemberReceiptList($from_dt,$to_dt,$member_id);

       // pre($result['memberReceiptList'] );exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function getMemberReceiptListByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $tran_type = $this->input->post('tran_type');
            $payment_id = $this->input->post('payment_id');
           
            if($from_dt!=""){
                $from_dt = str_replace('/', '-', $from_dt);
                $from_dt = date("Y-m-d",strtotime($from_dt));
             }
             else{
                 $from_dt = NULL;
             }

            if($to_dt!=""){
                $to_dt = str_replace('/', '-', $to_dt);
                $to_dt = date("Y-m-d",strtotime($to_dt));
             }
             else{
                 $to_dt = NULL;
             }
             if($tran_type == 'ORADMITM'){
                 $trn = array('ORADM','ORITM');
             }else if($tran_type == 'RCFM'){
                $trn = array('RCFM');
             }else{
                $trn = array('ORADM','ORITM','RCFM');
             }


         $result['memberReceiptList'] = $this->dailyreceiptregistermodel->getdatebyMemberReceiptList($from_dt,$to_dt,$trn,$payment_id);

       

         // pre($result['partyBillList']);exit;

         $page = "dashboard/daily-receipt-register/daily_receipt_register_list_partial_view"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }

}