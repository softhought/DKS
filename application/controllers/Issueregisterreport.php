<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issueregisterreport extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');   
        $this->load->model('companymodel', '', TRUE);     
        
      
    }

public function index()
{
  
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
          $page = "dashboard/inventory_master/reports/issue-register";
        $header="";       
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $result['from_dt']=$result['accountingyear']->start_date;
         $result['to_dt']=$result['accountingyear']->end_date;
       
       // $result['venderList'] = $this->commondatamodel->getAllRecordWhereOrderBy('vendor_master',[],'vendor_name');
       $result['rowmaterialList'] = $this->commondatamodel->getAllRecordWhereOrderBy('raw_meterial_master',[],'name');

    

       // pre($result['memberReceiptList'] );exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function issueregistereport()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {            
       
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);
       

        $companyId = $session['companyid'];
        $yearid = $session['yearid'];

        $where = array('company_master.company_id' => $companyId);
        $company = $this->commondatamodel->getSingleRowByWhereCls('company_master',$where); 
       
        $fromdate = $this->uri->segment(3);
        $todate = $this->uri->segment(4);
        $dateRange=implode('/',explode('-',$fromdate)).' To '.implode('/',explode('-',$todate));
        $frmDate = date("Y-m-d",strtotime($fromdate));
        $toDt = date("Y-m-d",strtotime($todate)); 
        
       $arrayParameter=[
            'form_date'=>"'". $frmDate."'",
            'to_date'=>"'". $toDt."'",
            'row_material_id'=>urldecode($this->uri->segment(5)),
            'YearId'=>$yearid ,
            'company_id'=> $companyId,
            'CompanyName'=>strtoupper($company->full_name),
            'dateRange'=>  $dateRange       
           
        ];
            //pre($arrayParameter);exit;

        $file= APPPATH."views/dashboard/reports/issue-register-item-wise/IssueRegisterItemReport.jrxml";
        $this->load->library('jasperphp');
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
                       
      
       
        // $jasperphp->debugsql=true;
        $jasperphp->arrayParameter =  $arrayParameter;
        $jasperphp->load_xml_file($file); 
        $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
        $jasperphp->outpage('I','PurchaseOrder-'.$Date.'.pdf');   
        // pre($jasperphp);     
           
    }else{
        redirect('login','refresh');
    }
}

}