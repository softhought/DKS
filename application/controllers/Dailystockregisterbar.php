<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailystockregisterbar extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);   
        $this->load->model('dailystockregistermodel','dailystockregistermodel',TRUE);  
        $this->load->model('companymodel', '', TRUE);      
       
       
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
                $where = array('year_id' =>$session['yearid']);
                $fiscalstartdate = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where)->start_date; 
                $from_dt = $this->input->post('from_dt');
                $to_dt = $this->input->post('to_date');
              
               
                
               
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

                 $compnyid = $yearid = $session['companyid']; 
                 $yearid = $session['yearid'];  
                
               
                 $result['stockregisterlist'] = $this->dailystockregistermodel->geAllStockRegister($compnyid,$yearid,$from_dt,$to_dt,$fiscalstartdate);
                
             
               
               $page = "dashboard/dailystock-register-bar/daily_stockreg_partial_view";
    
              $this->load->view($page,$result);
    
             
    
            }else{
                redirect('login','refresh');
            } 
    
        }

           /** trail report using Jasper */
    
    public function barstockJasper()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {      
            $file= APPPATH."views/dashboard/dailystock-register-bar/JasperReports/BarStockGroupLedger.jrxml";
           
            $this->load->library('jasperphp');
            $jasperphp = $this->jasperphp->jasper();

            $dbdriver="mysql";
            // $server="localhost";
            // $db="teasamrat";
            // $user="root";
            // $pass="";
            
            $this->load->database();
            $server=$this->db->hostname;
            $user=$this->db->username;
            $pass=$this->db->password;
            $db=$this->db->database;

            $companyId = $session['companyid'];
            $yearid = $session['yearid'];
         
            $fromdate = $this->uri->segment(3);
            $todate = $this->uri->segment(4);

            $frmDate = date("Y-m-d",strtotime($fromdate));
            $toDate = date("Y-m-d",strtotime($todate));            
            $fiscalStartDt= $this->dailystockregistermodel->getFiscalStartDt($yearid);
            $company=  $this->companymodel->getCompanyNameById($companyId);
            $companylocation=  $this->companymodel->getCompanyAddressById($companyId); 
            
            $dateRange='('.$fromdate.' To '.$todate.')';
            $printDate=date("d-m-Y");
            // pre($frmDate);      
            // pre($toDate);
            // pre($fiscalStartDt);
            // pre($company);
            // pre($companylocation);
            // pre($dateRange);
            // pre($printDate);
            // exit;      
             //$jasperphp->debugsql=true;
            $jasperphp->arrayParameter = array('companyId'=>$companyId,'yearId'=>$yearid,'fromDate'=>"'".$frmDate."'",'toDate'=>"'".$toDate."'",'fiscalstartdate'=>"'".$fiscalStartDt."'",'CompanyName'=>$company,'CompanyAddress'=>$companylocation,'printDate'=>$printDate,'dateRange'=>$dateRange);
            $jasperphp->load_xml_file($file); 
            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
           $jasperphp->outpage('I','Bar Stock Group Leadger-'.date('d_m_Y-His'));  
            // pre($jasperphp);     
    

            // $page = 'trial_balance/trailWithJasper.php';
            // $this->load->view($page, $result, TRUE);

        } else {
            redirect('login', 'refresh');
        }
    }

}