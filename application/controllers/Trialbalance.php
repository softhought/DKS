<?php

//we need to call PHP's session object to access it through CI
class Trialbalance extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->library('session');   
        $this->load->library('jasperphp');
        $this->load->model('trialbalancemodel', '', TRUE);
        $this->load->model('companymodel', '', TRUE);
        
 }

    public function index() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 	
			$yearid = $session['yearid'];
			$fiscalStartDt = $this->trialbalancemodel->getFiscalStartDt($yearid);
			$AccountingPeriod = $this->trialbalancemodel->getAccountingPeriod($yearid);
			$result['fiscalStartDt'] = date("d/m/Y", strtotime($fiscalStartDt));			
			$result['AccountingStart_date'] = date("d/m/Y", strtotime($AccountingPeriod['start_date']));			
			$result['AccountingEtart_date'] = date("d/m/Y", strtotime($AccountingPeriod['end_date']));			
            $page = 'dashboard/reports/trial_balance';
            $header = '';
            createbody_method($result, $page, $header, $session);    
        } else {
            redirect('login', 'refresh');
        }
    }


    /** trail report using Jasper */
    
    public function trailJasper()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {      
            $file= APPPATH."views/dashboard/reports/JasperReports/TrailBalanceJasper.jrxml";
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
            $fiscalStartDt= $this->trialbalancemodel->getFiscalStartDt($yearid);
            $company=  $this->companymodel->getCompanyNameById($companyId);
            $companylocation=  $this->companymodel->getCompanyAddressById($companyId); 
            
            $dateRange='('.$fromdate.' To '.$todate.')';
            $printDate=date("d-m-Y");


            // $jasperphp->debugsql=true;
            $jasperphp->arrayParameter = array('CompanyId'=>$companyId,'YearId'=>$yearid,'fromDate'=>"'".$frmDate."'",'toDate'=>"'".$toDate."'",'fiscalstartdate'=>"'".$fiscalStartDt."'",'CompanyName'=>$company,'CompanyAddress'=>$companylocation,'printDate'=>$printDate,'dateRange'=>$dateRange);
            $jasperphp->load_xml_file($file); 
            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
            $jasperphp->outpage('I','Trial Balance-'.date('d_m_Y-His'));  
            // pre($jasperphp);       
    

            // $page = 'trial_balance/trailWithJasper.php';
            // $this->load->view($page, $result, TRUE);

        } else {
            redirect('login', 'refresh');
        }
    }
       
 
}
?>