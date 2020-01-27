<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Billprint extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');   
        $this->load->library('jasperphp');
        $this->load->model('Billgeneratetennismodel','billgenmodel',TRUE);
    }


    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {    
    
           $year=$session['yearid'];
    
           if($this->uri->segment(3) == NULL){
    
            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['btnTextLoader'] = "Saving...";
            $result['paymodeId'] = 0;
            $result['paymentmodeEditdata'] = [];
    
           }else{
    
              $result['mode'] = "EDIT";
              $result['btnText'] = "Update";
              $result['btnTextLoader'] = "Updating...";
              $result['paymodeId'] = $this->uri->segment(3);
           }
    
            $result['billtype'] = array('M'=>'Monthly','Q'=>'Quarterly');    
            $orderby='display_serial';
            $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);                                            
            $result['quartermonthList'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');    
            $where_year = array('financialyear.year_id' => $year);
            $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;    
            $result['studentlist'] = [];
    
          //  pre($result['studentlist']);exit;
            $page = "dashboard/reports/bill-print";
            $header="";    
            createbody_method($result, $page, $header, $session);
        }else{
            redirect('login','refresh');
        }
    }

    public function billPrintPdf()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {            
           
            // $companyId = $session['companyid'];
            $yearid = $session['yearid'];
           $arrayParameter=[
                'BillingStyle'=>"'".$this->uri->segment(3)."'",
                'QuarterMonth'=>$this->uri->segment(4),
                'StudentId'=>'"'.urldecode($this->uri->segment(5)).'"',
                'YearId'=>$yearid 
            ];
            //    pre($arrayParameter);exit;

            $file= APPPATH."views/dashboard/reports/JasperReports/BillPrint.jrxml";
            
            $jasperphp = $this->jasperphp->jasper();
           
            $dbdriver="mysql";
            // $server="localhost";
            // $db="dks";
            // $user="root";
            // $pass="";
            
            $this->load->database();
            $server=$this->db->hostname;
            $user=$this->db->username;
            $pass=$this->db->password;
            $db=$this->db->database;
                           
            $dateRange='('.$fromdate.' To '.$todate.')';
            $printDate=date("d-m-Y");

            // $jasperphp->debugsql=true;
            $jasperphp->arrayParameter =  $arrayParameter;
            $jasperphp->load_xml_file($file); 
            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
            $jasperphp->outpage('I');   
            // pre($jasperphp);     
               
        }else{
            redirect('login','refresh');
        }
    }


}// end of class