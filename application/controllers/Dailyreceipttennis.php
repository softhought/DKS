<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dailyreceipttennis extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberreceiptmodel','memberreceiptmodel',TRUE);
        $this->load->model('dailyreceipttennismodel','dailyreceipttennismodel',TRUE); 
        $this->load->model('companymodel', '', TRUE);     
      
    }

public function index()
{
  
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/daily-receipt-register/daily_receipt_tennis_list";
        $header="";       
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=date('Y-m-d');
         $to_dt=date('Y-m-d');
         $mode='All';
        //  $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
        //  $result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
        
        $result['paymentmodelist'] = $this->commondatamodel->getAllRecordWhere('payment_mode_details',[]);

        $result['trantypelist'] = array('ORADMITM' => "Other Receipts", 'RCFM' => "Receivable From Member");
        
        

        $result['tennisReceiptList'] = $this->dailyreceipttennismodel->getTennisDailyReceiptList($from_dt,$to_dt,$mode,$company,$year);

     //   pre($result['tennisReceiptList'] );exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function getTennisReceiptListByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $company=$session['companyid'];
            $year=$session['yearid'];

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $payment_mode = $this->input->post('payment_mode');
           
           
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
         


          $result['tennisReceiptList'] = $this->dailyreceipttennismodel->getTennisDailyReceiptList($from_dt,$to_dt,$payment_mode,$company,$year);

       

         // pre($result['partyBillList']);exit;

         $page = "dashboard/daily-receipt-register/daily_receipt_tennis_list_partial_view"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }





 

 public function getDailyPaymentDetailstPrint(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $payment_mode = $this->input->post('payment_mode');
            $result['dailybalanceDate']='Daily Balance from '.$from_dt." to ".$to_dt;


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
         
        $result['tennisReceiptList'] = $this->dailyreceipttennismodel->getTennisDailyReceiptList($from_dt,$to_dt,$payment_mode,$company,$year);

        


            // load library
            $this->load->library('Pdf');
            $pdf = $this->pdf->load();
            ini_set('memory_limit', '256M'); 
            $page = "dashboard/daily-receipt-register/daily_receipt_tennis_pdf_list_view"; 
      
            // pre($result['billList']);exit;

           $html = $this->load->view($page, $result, true);
                // render the view into HTML
                $pdf->WriteHTML($html); 
                $output = 'testPdf' . date('Y_m_d_H_i_s') . '_.pdf'; 
                $pdf->Output("$output", 'I');
                exit();

         

         // $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }


}