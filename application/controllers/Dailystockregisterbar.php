<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailystockregisterbar extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);   
        $this->load->model('dailystockregistermodel','dailystockregistermodel',TRUE);        
       
    }

    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {  
            $page = "dashboard/dailystock-register-bar/daily_stock_register_view";
            $header="";
            $where = array('year_id' =>$session['yearid']);
            $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);  
            
           
            //$result['allitemsmasterlist'] = $this->commondatamodel->getAllRecordOrderBy('item_master','item_id','desc');
            createbody_method($result, $page, $header, $session);
        }else{
            redirect('login','refresh');
        }
        
    }

    public function getstockregisterlistbydate(){

        $session = $this->session->userdata('user_detail');
            if($this->session->userdata('user_detail'))
            {
    
                $from_dt = $this->input->post('from_dt');
                $to_dt = $this->input->post('to_date');
                $yearid = $session['yearid'];             
               
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
               
                 $result['stockregisterlist'] = $this->dailystockregistermodel->geAllStockRegister($from_dt,$to_dt,$yearid);
                   // pre($result['allpurchasesalereport']);exit;
             
               
               $page = "dashboard/dailystock-register-bar/daily_stockreg_partial_view";
    
              $this->load->view($page,$result);
    
             
    
            }else{
                redirect('login','refresh');
            } 
    
        }

}