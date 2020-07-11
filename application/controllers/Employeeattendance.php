<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employeeattendance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('memberfacilitymodel','memberfacilitymodel',TRUE);
        $this->load->model('employeemodel','employeemodel',TRUE);   
        
         ini_set('max_input_vars', 10000);
       
    }


public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{   $company=$session['companyid'];
        $year=$session['yearid'];

        $member_code = '';
        $cat_id = '';
        $month_id = '';
     
       
          $page = "dashboard/employee_attendance/employee_attendance_list_view";
        $header="";  

        //$result['employeeList'] =  $this->employeemodel->getallemployeeAttendancelist();
        $result['employeeList'] =  [];

        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

       // pre($result['benvolentfundList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}




public function addAttendance(){

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    

       $year=$session['yearid'];
       $company=$session['companyid'];

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
                                        
     $result['employeeList'] =  $this->employeemodel->getallemployeelist();

       //  pre($result['studentlist']);exit;

        $page = "dashboard/employee_attendance/employee_attendance_add_edit";
        $header="";
 
       
       
       

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}



public function attendanceAction() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $activity_description="";
            $company=$session['companyid'];
            $year=$session['yearid'];
            

               $month=$dataArry['month'];
               $attendance_days=$dataArry['attendance_days'];
    
		           $del_where = array(
		                 							'month_id' => $month,
                                                    'year_id' => $year,
		                 							'company_id' => $company,
		                 						   );

		          $this->commondatamodel->deleteTableData('employee_attendance',$del_where);

              $result['employeeList'] =  $this->employeemodel->getallemployeelist();

              foreach($result['employeeList'] as $employeelist){
               
              $attendance_array = array(
                                                'employee_id' => $employeelist->empl_id,
                                                'attendance_days' => $attendance_days,
                                                'month_id' => $month,
                                                'year_id' => $year,
                                                'company_id' => $company,
                                                );

               $insert = $this->commondatamodel->insertSingleTableData('employee_attendance',$attendance_array);

     
            }
                if($insert){

                       $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Applied successfully",
                            
                        );

                }else{
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while applying ...Please try again."
                        );
                } 


        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 



          }
        else{
            redirect('login','refresh');
        }



    }



public function lastDayOfmonth() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            
            $month = $this->input->post('month');
            $year=$session['yearid'];

            $where = array('financialyear.year_id' =>  $year);
            $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

          
            $years=explode(" ",$result['financialyear']->year);
           
            if ($month==1 || $month==2 || $month==3) {

                if($month<10){$month="0".$month;}
              $firstdate=$years[2]."-".$month."-01";

            }else{

              if($month<10){$month="0".$month;}
              $firstdate=$years[0]."-".$month."-01";

            }

         

         $lastdate = date("d", strtotime($this->last_day_of_the_month($firstdate)));

         $json_response = array(
                            "lastdate" => $lastdate 
                          );

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


           
            

        }else
        {
            redirect('login','refresh');
        }


}

public function last_day_of_the_month($date = '')
{
    $month  = date('m', strtotime($date));
    $year   = date('Y', strtotime($date));
    $result = strtotime("{$year}-{$month}-01");
    $result = strtotime('-1 second', strtotime('+1 month', $result));

    return date('Y-m-d', $result);
}



public function EmployeeAttendanceListview()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            
            $year=$session['yearid'];
            $result =[];
           
            $month=$this->input->post('month');
   
            $result['employeeList'] =  $this->employeemodel->getallemployeeAttendancelist($year,$month);
           
            
        
             $page = "dashboard/employee_attendance/employee_attendance_partial_list_view";
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;

        }
        else{
            redirect('login','refresh');
        }
    }




} // end of class
