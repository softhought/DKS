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

        $company=$session['companyid'];
        $year=$session['yearid'];
        $page = "dashboard/receipt_register/receipt_register_list";
        $header=""; 

        $where = array('year_id' => $year);

         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;
         
         $tran_type='All';

        $result['paymentData'] = $this->receiptregistermodel->getPaymentDetails($from_dt,$to_dt,$tran_type);
       // pre($result['paymentData']); exit;      
                    
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
  }

  public function getallcorrectionbydate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $tran_type = $this->input->post('tran_type');
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



        

        $result['paymentData'] = $this->receiptregistermodel->getPaymentDetails($from_dt,$to_dt,$tran_type);
         $page = "dashboard/receipt_register/receipt_register_list_partial_view"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }






} // end of class