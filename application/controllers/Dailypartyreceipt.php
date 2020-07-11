<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dailypartyreceipt extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');       
        $this->load->model('dailypartyreceiptmodel','dailypartyreceiptmodel',TRUE); 
        $this->load->model('companymodel', '', TRUE);     
      
    }

public function index()
{
  
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/daily-part-receipt/daily_party_receipt_list";
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
        $payment_id = '';   
      

        $result['PartyReceiptList'] = $this->dailypartyreceiptmodel->getPartyReceiptList($from_dt,$to_dt,$payment_id);

       // pre($result['memberReceiptList'] );exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function getPartyrReceiptListByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
          
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
             


         $result['partyReceiptList'] = $this->dailypartyreceiptmodel->getPartyReceiptList($from_dt,$to_dt,$payment_id);

       

         // pre($result['partyBillList']);exit;

         $page = "dashboard/daily-part-receipt/daily_party_receipt_list_partial_view"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }

}