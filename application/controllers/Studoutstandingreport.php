<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Studoutstandingreport extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);       
        $this->load->model('studentoutstandingmodel','studentoutstandingmodel',TRUE);       
        $this->load->model('companymodel', '', TRUE);        
        $this->load->model('Billgeneratetennismodel','billgenmodel',TRUE); 
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{ 
        $year=$session['yearid'];
        $page = "dashboard/student-outstanding-list-report/stud_outstanding_list";
        $header="";   
       
        $result['billtype'] = array('M'=>'Monthly','Q'=>'Quarterly');

        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);
        								
        $result['quartermonthList'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');

        $where_year = array('financialyear.year_id' => $year);
        $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;    
       
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function getpartiallist(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $result['billing_style'] = $this->input->post('billing_style');
            $QM = $this->input->post('QM');
            $student_id = $this->input->post('student_id');
            $yearid = $session['yearid'];
           
            $result['studsoutstandinglist'] = $this->studentoutstandingmodel->getstudentoutstandinglist( $result['billing_style'],$QM,$yearid,$student_id);
         
            
            
           $page = "dashboard/student-outstanding-list-report/student_outstanding_partial_list";

          $this->load->view($page,$result);

         

        }else{
            redirect('login','refresh');
        } 

    }

    public function resetStudentList()
  {
      if($this->session->userdata('user_detail'))
      {
        
       $billing_style = $this->input->post('billing_style');     
       $result['studentList'] = $this->billgenmodel->studentListbyBillStyle($billing_style);

        ?>
           <select class="form-control select2" name="studid" id="studid" >
             <option value="0">Select</option>
                          <?php 
                         foreach ($result['studentList'] as $studentlist) {  ?>
                         <option value="<?php echo $studentlist->admission_id;?>"  
                          ><?php echo $studentlist->student_code;?></option>
                          <?php     } ?>                              
          </select> 
        <?php

      }
      else
      {
          redirect('login','refresh');
      }
  } 


public function studotstandingreport()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {      
        $file= APPPATH."views/dashboard/reports/student-outstanding-report/StudentoutStandingReport.jrxml";
        
       
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
         $yearid = $session['yearid'];
     
        $printDate=date("d-m-Y");            
         //$jasperphp->debugsql=true;
        $jasperphp->arrayParameter = array('CompanyName'=>strtoupper($company),
                        'CompanyAddress'=>$companylocation,
                        'CompanyPhone'=>$phone,
                        'BillingStyle'=>"'".$this->uri->segment(3)."'",
                        'QuarterMonth'=>$this->uri->segment(4),                
                        'YearId'=>$yearid,
                        'printDate'=>$printDate,
                        'student_id'=>$this->uri->segment(5) );
        //pre($jasperphp->arrayParameter);exit;
        $jasperphp->load_xml_file($file); 
        $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
        $jasperphp->outpage('I','StudentOtstandingReport-'.date('d_m_Y-His').'.pdf');  
         //pre($jasperphp); exit;    


        // $page = 'trial_balance/trailWithJasper.php';
        // $this->load->view($page, $result, TRUE);

    } else {
        redirect('login', 'refresh');
    }
}




}