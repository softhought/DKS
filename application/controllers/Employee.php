<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);        
        $this->load->model('employeemodel','employeemodel',TRUE);        
         
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/payroll/masters/employee/employee_list_view";
        $header="";       
        $result['employeeList'] =  $this->employeemodel->getallemployeelist();

        
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditemployee(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['emplId'] = 0;
          $result['employeeEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['emplId'] = $this->uri->segment(3);
  
            $where = array('empl_id'=>$result['emplId']);
            $where2 = array('empl_master_id'=>$result['emplId'],'year_id'=>$session['yearid'],'company_id'=>$session['companyid']);
  
            $result['employeeEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('employee_master',$where);
            $result['employeesalarydtl'] = $this->commondatamodel->getAllRecordWhereOrderBy('employee_salary_details',$where2,[]);
             
  
         }

         $result['Alldepartementlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('department_master',[],'dept_name');
         $result['Alldesignationlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('designation_master',[],'designation_name');
         $result['monthlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],'id');
  
          $page = "dashboard/payroll/masters/employee/addedit_employee";
          $header="";
  
          
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }

  public function addemployeeDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');

            $data['rowno'] = $this->input->post('rowNo');
            $data['month_id'] = $this->input->post('month_id');
            $data['month_name'] = $this->input->post('month_name');
            $data['basic_salary'] = $this->input->post('basic_salary');
            $data['salary_da'] = $this->input->post('salary_da');
            $data['house_rent'] = $this->input->post('house_rent');
        
            $data['dtlmonthlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],'id');
            
            $page = 'dashboard/payroll/masters/employee/add_salary_detail_partial_view';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;


        }else{
        redirect('login','refresh');
    }

}


public function addedit_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

         
        $emplId = trim(htmlspecialchars($this->input->post('emplId')));            
        $mode = trim(htmlspecialchars($this->input->post('mode')));
        $name = trim(htmlspecialchars($this->input->post('name')));
       
        if(trim(htmlspecialchars($this->input->post('emp_dob'))) != ''){

            $empdob = str_replace('/', '-', trim(htmlspecialchars($this->input->post('emp_dob'))));
    
            $empdob_dt = date('Y-m-d',strtotime($empdob));
            }else{
    
            $empdob_dt=NULL;
    
            }
        $father_name = trim(htmlspecialchars($this->input->post('father_name')));
        $mobile_no = trim(htmlspecialchars($this->input->post('mobile_no')));
        $designation_id = $this->input->post('designation_id');
        $dept_id = $this->input->post('dept_id');

        if(trim(htmlspecialchars($this->input->post('retirement_date'))) != ''){

        $retirementdate = str_replace('/', '-', trim(htmlspecialchars($this->input->post('retirement_date'))));

        $retirement_dt = date('Y-m-d',strtotime($retirementdate));
        }else{

        $retirement_dt=NULL;

        }
        $emp_address = trim($this->input->post('emp_address'));
        if(trim(htmlspecialchars($this->input->post('join_date'))) != ''){

            $joindate = str_replace('/', '-', trim(htmlspecialchars($this->input->post('join_date'))));
    
            $join_dt = date('Y-m-d',strtotime($joindate));
            }else{
    
            $join_dt=NULL;
    
            }
    
     
         
     $is_pf = trim(htmlspecialchars($this->input->post('is_pf'))) == true ?'Y':'N';
     $pf_no = trim(htmlspecialchars($this->input->post('pf_no')));
     $adhaar_no = trim(htmlspecialchars($this->input->post('adhaar_no')));
     $is_esi = trim(htmlspecialchars($this->input->post('is_esi'))) == true ?'Y':'N';
     $esi_no = trim(htmlspecialchars($this->input->post('esi_no')));
     $ptax = trim(htmlspecialchars($this->input->post('ptax'))) == true ?'Y':'N';
     
     $salary_from_bank = trim(htmlspecialchars($this->input->post('salary_from_bank'))) == true ?'Y':'N';
     $acc_no = trim(htmlspecialchars($this->input->post('acc_no')));
     $dispensary_name = trim(htmlspecialchars($this->input->post('dispensary_name')));
     $doctors_name = trim(htmlspecialchars($this->input->post('doctors_name')));
     $doctors_degree = trim(htmlspecialchars($this->input->post('doctors_degree')));    
     $doctors_address = trim($this->input->post('doctors_address'));

            $data = array(
                'name'=>strtoupper($name),
                'dob'=>$empdob_dt,
                'father_name'=>strtoupper($father_name),
                'mobile_no'=>$mobile_no,
                'address'=>$emp_address,
                'dept_master_id'=>$dept_id,
                'joining_date'=>$join_dt,
                'retirement_date'=>$retirement_dt,
                'designation_id'=>$designation_id,
                'is_pfno'=>$is_pf,
                'pf_no'=>$pf_no,
                'adhaar_no'=>$adhaar_no,
                'is_esino'=>$is_esi,
                'esi_no'=>$esi_no,
                'ptax'=>$ptax,
                'salary_from_bank'=>$salary_from_bank,
                'bank_acc_no'=>$acc_no,
                'dispensary_name'=>strtoupper($dispensary_name),
                'doctors_name'=>strtoupper($doctors_name),
                'doctors_degree'=>$doctors_degree,
                'doctors_address'=>$doctors_address,
                'year_id'=>$session['yearid'],
                'company_id'=>$session['companyid'],                           
                'created_on'=>date('Y-m-d'),
                'modify_date'=>date('Y-m-d')
                
                );
       
     
     if($mode == 'ADD' && $emplId == 0)
     {
              
              //pre($data);exit;                    
               $insertupdata = $this->commondatamodel->insertSingleTableData('employee_master',$data); 
               $masterid = $insertupdata;

        }else{

           $remove_arr = array('year_id'=>$session['yearid'],'company_id'=>$session['companyid'],'created_on'=>date('Y-m-d'));   
           $updatearr = array_diff_assoc($data, $remove_arr);
          
           $upd_where = array('empl_id'=>$emplId);
            // old details for auditral
          $olddetails = $this->commondatamodel->getSingleRowByWhereCls('employee_master',$upd_where);

          $insertupdata = $this->commondatamodel->updateSingleTableData('employee_master',$updatearr,$upd_where);
          $masterid = $emplId;

        }               

            $activity_module= ($mode == 'ADD') ? 'data Insert':'data Upadte';
            $action = ($mode == 'ADD') ? 'Insert':'Update';
            $method='employee/addedit_action'; 
            $master_id = $masterid;
            $tablename = 'employee_master';
            $old_description = ($mode == 'ADD') ? '':json_encode($olddetails);
            $description = json_encode($data);

           $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);


//Employee Salary Details 

if($this->input->post('delIds') != ''){

   $dtlIds = explode(',',$this->input->post('delIds'));
    
    for ($i=0; $i < count($dtlIds) ; $i++) { 

      $wheredtlid = array('emp_dtl_id'=>$dtlIds[$i]);
      $deletedtl = $this->commondatamodel->deleteTableData('employee_salary_details',$wheredtlid);
       
      }
   
  }   
  


  if($this->input->post('employeedtlId') != ''){

      $employeedtlId = $this->input->post('employeedtlId');

       $dtl_month_id = $this->input->post('dtl_month_id');
       $dtl_basic_sal = $this->input->post('dtl_basic_sal');
       $dtl_salary_da = $this->input->post('dtl_salary_da');
       $dtl_salary_hra = $this->input->post('dtl_salary_hra');
       
        
       for($i=0;$i<count($employeedtlId);$i++){

            if($employeedtlId[$i] == 0){

                $instsalarydtl = array(
                                   'empl_master_id'=>$masterid,
                                   'month_id'=>$dtl_month_id[$i],
                                   'year_id'=>$session['yearid'],
                                   'company_id'=>$session['companyid'],
                                   'basic_salary'=>$dtl_basic_sal[$i],
                                   'da_amount'=>$dtl_salary_da[$i],
                                   'hra_amount'=>$dtl_salary_hra[$i],
                                   'created_on'=>date('Y-m-d')
                                 ); 


                $insertdata = $this->commondatamodel->insertSingleTableData('employee_salary_details',$instsalarydtl);

                //pre($instsalarydtl);
            }else{

              $upsalarydtl = array(
                                   'empl_master_id'=>$masterid,
                                   'month_id'=>$dtl_month_id[$i],
                                   'year_id'=>$session['yearid'],
                                   'company_id'=>$session['companyid'],
                                   'basic_salary'=>$dtl_basic_sal[$i],
                                   'da_amount'=>$dtl_salary_da[$i],
                                   'hra_amount'=>$dtl_salary_hra[$i],                                  
                                 );
                $upd_where = array('emp_dtl_id'=>$employeedtlId[$i],'year_id'=>$session['yearid'],'company_id'=>$session['companyid']);                 
               $Updatedata = $this->commondatamodel->updateSingleTableData('employee_salary_details',$upsalarydtl,$upd_where);

            }
            
       }
      
      
     }

                if($insertupdata){

                    $json_response = array(
                          "msg_status" => 1,
                          "msg_data" => "Saved successfully",
                          
                      );

                  }else
                  {
                      $json_response = array(
                          "msg_status" => 0,
                          "msg_data" => "There is some problem while updating ...Please try again."
                      );
                  }  
         

      header('Content-Type: application/json');
      echo json_encode( $json_response );
      exit; 


       }else{
          redirect('login','refresh');
      }   

}


function activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description){

$session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

      $user_activity = array(
                      "activity_module_admin" =>$activity_module ,
                      "activity_module" => $activity_module,
                      "action" => $action,
                      "from_method" => $method,
                      "module_master_id" => $master_id,
                      "user_id" => $session['userid'],
                      "table_name" =>$tablename ,
                      "user_browser" => getUserBrowserName(),
                      "user_platform" =>  getUserPlatform(),
                      'old_description'=>$old_description,
                      'description'=>$description,
                      'ip_address'=>getUserIPAddress()
                  );
     
      $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
   }else{
          redirect('login','refresh');
      }                
}





}