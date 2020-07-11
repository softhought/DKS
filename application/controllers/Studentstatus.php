<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Studentstatus extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('companymodel', '', TRUE);        
       
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{ 
        $year=$session['yearid'];
        $page = "dashboard/student-status/student_status_list";
        $header="";   
       
        $result['studentcategory'] = $this->commondatamodel->getAllDropdownData('student_category');
        $result['studentstatus'] = array('ACTIVE STUDENT','RESIGNED','TEMPORARY TERMINATED');    
       //pre( $result['studentstatus']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function getpartiallist(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $category= $this->input->post('category');
            $status = $this->input->post('status');
           
            $where = array("category"=>$category,"status"=>$status);
           
            $result['studstatuslist'] = $this->commondatamodel->getAllRecordWhere('admission_register', $where);

            
         
           // pre($diff->y);exit;
            
           $page = "dashboard/student-status/student_status_partial_list";

          $this->load->view($page,$result);

         

        }else{
            redirect('login','refresh');
        } 

    }

    public function studentstatusreport()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {      
        $file= APPPATH."views/dashboard/reports/student-status/StudentoutStatusReport.jrxml";
        
       
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
     
      
        
         $company=  $this->companymodel->getCompanyNameById($companyId);
         $companylocation=  $this->companymodel->getCompanyAddressById($companyId);  
         $phone =    $this->companymodel->getCompanyById($companyId)->phone; 
         
     
        $printDate=date("d-m-Y");            
         //$jasperphp->debugsql=true;
        $jasperphp->arrayParameter = array('CompanyName'=>strtoupper($company),
                        'CompanyAddress'=>$companylocation,
                        'CompanyPhone'=>$phone,
                        'category'=>"'".str_replace("%20"," ",$this->uri->segment(3))."'",
                        'status'=>"'".str_replace("%20"," ",$this->uri->segment(4))."'",                        
                        'printDate'=>$printDate,
                        'status2'=>str_replace("%20"," ",$this->uri->segment(4)),
                        );
       // pre($jasperphp->arrayParameter);exit;
        $jasperphp->load_xml_file($file); 
        $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
        $jasperphp->outpage('I','StudentStatusReport-'.date('d_m_Y-His').'.pdf');  
         //pre($jasperphp); exit;    


        // $page = 'trial_balance/trailWithJasper.php';
        // $this->load->view($page, $result, TRUE);

    } else {
        redirect('login', 'refresh');
    }
}

}