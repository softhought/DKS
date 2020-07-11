<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salarypayslip extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
        $this->load->model('salarypayslipmodel','salarypayslipmodel',TRUE);
        $this->load->model('companymodel', '', TRUE);
	}
	
	public function index()
	{
		$session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
			$page = "dashboard/payroll/reports/salary-payslip/salary_payslip_view";
			$header=""; 
			
            $result['monthlist'] = $this->commondatamodel->getAllRecordOrderBy('month_master','display_serial','asc');  

            $result['departmentList'] = $this->commondatamodel->getAllRecordOrderBy('department_master','dept_name','asc');	         
            		
			$result['employeeList'] = $this->commondatamodel->getAllRecordOrderBy('employee_master','name','asc');		
            //pre($result['departmentList']); exit;  

       
			    
						
			createbody_method($result, $page, $header, $session);
		}else{
			redirect('login','refresh');
		}
	}

	public function getSalaryregisterlist(){

		$session = $this->session->userdata('user_detail');
			if($this->session->userdata('user_detail'))
			{
	
				$company=$session['companyid'];
				$year=$session['yearid'];
			   
				$month_id = $this->input->post('month_id');
				$dept_id = $this->input->post('dept_id');
				$emp_id = $this->input->post('emp_id');
				
	        
	
			
			$result['salaryregisterList'] = $this->salarypayslipmodel->getsalaryregisterlist($month_id,$dept_id,$emp_id,$company,$year);
			
			
		  
		  // pre($result['salaryregisterList']);exit;
			
			$page = "dashboard/payroll/reports/salary-payslip/salary_payslip_partial_view"; 
	
			  $this->load->view($page,$result);
	
			  
	
			}else{
				redirect('login','refresh');
			} 
}

public function salarysliprintJasper()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {      
        $file= APPPATH."views/dashboard/reports/salary-payslip/SalaryPaySlip.jrxml";
       
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
        $yearId =  $session['yearid'];
        $monthid = $this->uri->segment(3);  
        $deptid = $this->uri->segment(4);  
        $empid = $this->uri->segment(5);  
       
         $company=  $this->companymodel->getCompanyNameById($companyId);
         $companylocation=  $this->companymodel->getCompanyAddressById($companyId);  
         $phone =    $this->companymodel->getCompanyById($companyId)->phone; 
                  
        
       // pre($printDate);exit;            
         //$jasperphp->debugsql=true;
        $jasperphp->arrayParameter = array('CompanyName'=>$company,'CompanyAddress'=>$companylocation,'monthid'=>$monthid,'deptid'=>$deptid,'empid'=>$empid,'phone'=>$phone,'company_id'=>$companyId,'yearid'=>$yearId);
       // pre($jasperphp->arrayParameter);exit;
        $jasperphp->load_xml_file($file); 
        $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
        ob_end_clean();
        $jasperphp->outpage('I','Salary Payslip-'.date('d_m_Y-His').'.pdf');  
        // pre($jasperphp);     


        // $page = 'trial_balance/trailWithJasper.php';
        // $this->load->view($page, $result, TRUE);

    } else {
        redirect('login', 'refresh');
    }
}



}