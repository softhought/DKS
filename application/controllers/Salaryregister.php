<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salaryregister extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
        $this->load->model('salaryregistermodel','salaryregistermodel',TRUE);
        $this->load->model('companymodel', '', TRUE);
	}
	
	public function index()
	{
		$session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
			$page = "dashboard/payroll/reports/salary-register/salary_register_view";
			$header=""; 
			
			$result = [];
            $category='CAT';
            
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
				
	
	
			
			$result['salaryregisterList'] = $this->salaryregistermodel->getsalaryregisterlist($month_id,$dept_id,$emp_id,$company,$year);
			
			
		  
		   //pre($result['salaryregisterList']);exit;
			
			$page = "dashboard/payroll/reports/salary-register/salary_register_partial_view"; 
	
			  $this->load->view($page,$result);
	
			  
	
			}else{
				redirect('login','refresh');
			} 
}

public function print_salaryregister(){
	if($this->session->userdata('user_detail'))
	 {
		 $session = $this->session->userdata('user_detail');
		 $company=$session['companyid'];
		 $year=$session['yearid'];

		 $month_id = $this->input->post('month_id');
		 $dept_id = $this->input->post('dept_id');
		 $emp_id = $this->input->post('emp_id');
		
	
		 $result['salaryregisterList'] = $this->salaryregistermodel->getsalaryregisterlist($month_id,$dept_id,$emp_id,$company,$year);
	

		 // load library
		 $this->load->library('Pdf');
		 $pdf = $this->pdf->load();
		 ini_set('memory_limit', '256M'); 

		 $page = "dashboard/payroll/reports/salary-register/salary_register_pdf_view"; 

			// $html = $this->load->view($page, $result, true);
			
		   //  $html="Hello";
				  $html = $this->load->view($page, $result, true);
			 // render the view into HTML
			 $pdf->WriteHTML($html); 
			 $output = 'salaryregisterPdf' . date('Y_m_d_H_i_s') . '_.pdf'; 
			 $pdf->Output("$output", 'I');
			 exit();
	  }
	  else {
		 redirect('login', 'refresh');
	 }
}



}