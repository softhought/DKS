<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailypursalreport extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);   
        $this->load->model('dailypursalereportmodel','dailypursalereportmodel',TRUE);        
       
    }

    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {  
            $page = "dashboard/pursale-report/daily_pursale_report";
            $header="";
            $where = array('year_id' =>$session['yearid']);
            $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);  
            $result['modelist'] = array('PURCHASE','SALE');
           
            //$result['allitemsmasterlist'] = $this->commondatamodel->getAllRecordOrderBy('item_master','item_id','desc');
            createbody_method($result, $page, $header, $session);
        }else{
            redirect('login','refresh');
        }
        
    }

    public function getreportlistbydate(){

        $session = $this->session->userdata('user_detail');
            if($this->session->userdata('user_detail'))
            {
    
                $from_dt = $this->input->post('from_dt');
                $to_dt = $this->input->post('to_date');
                $selmode = $this->input->post('selmode');
               
               
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
                if($selmode == 'PURCHASE'){
                   $table = 'purchase_entry_receive';
                    $result['allpurchasesalereport'] = $this->dailypursalereportmodel->getpurchasesalereport($from_dt,$to_dt,$table);
                   // pre($result['allpurchasesalereport']);exit;
                }else{
                    $table = 'sale_entry_issue';
                    $result['allpurchasesalereport'] = $this->dailypursalereportmodel->getpurchasesalereport($from_dt,$to_dt,$table);
                }
                $result['selmode']=$selmode;
               $page = "dashboard/pursale-report/daily_pursale_partial_view";
    
              $this->load->view($page,$result);
    
             
    
            }else{
                redirect('login','refresh');
            } 
    
        }
}