<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salaryprocess extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberbillmodel','memberbillmodel',TRUE);
        $this->load->model('minimumbillingmodel','minimumbillingmodel',TRUE); 
        $this->load->model('salaryprocessmodel','salaryprocess',TRUE); 
        set_time_limit(1200); 
    }


public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  exit;
        $page = "dashboard/master/account-group/account_group_view";
        $header="";  

        $result['accountgrouplist'] = $this->commondatamodel->getAllRecordOrderBy('group_master','id','desc');
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}



public function addSalaryProcess(){

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


                                        
        $where_year = array('financialyear.year_id' => $year);
        $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

        $department='';
        $result['employeeList'] = $this->salaryprocess->getAllEmployee($department);
        $result['departmentList'] = $this->salaryprocess->getAllDepartment();

        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

        $result['cashbankList'] = $this->salaryprocess->getAllCashBankAc();

       // pre($result['minbillMonth']);exit;


        $page = "dashboard/salary_process/salary_process_add_edit.php";
        $header="";
 
       
       
       

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}


 public function resetEmployeeList()
  {
      if($this->session->userdata('user_detail'))
      {
        
       $department = $this->input->post('department');     
     

           $result['employeeList'] = $this->salaryprocess->getAllEmployee($department);

        

        ?>
           <select class="form-control select2" name="employee" id="employee" >
             <option value="">Select</option>
                          <?php 
                         foreach ($result['employeeList'] as $employeelist) {  ?>
                         <option value="<?php echo $employeelist->empl_id;?>"  
                          ><?php echo $employeelist->name;?></option>
                          <?php     } ?>                              
          </select> 
        <?php

      }
      else
      {
          redirect('login','refresh');
      }
  }



public function salaryProcessAction() {

 $session = $this->session->userdata('user_detail');
 if($this->session->userdata('user_detail'))
    {
           
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);

        $insertdata=1;
        $month = $dataArry['month'];
        $department = $dataArry['department'];
        $cash_bank_ac = $dataArry['cash_bank_ac'];
       // $employee=$dataArry['employee'];
        $company = $session['companyid'];
        $year=$session['yearid'];


       /* if ($employee!='') {

           $insertdata=$this->insertIntoSalaryMaster($employee,$month,$year,$company);
 
        }else{
           $result['employeeList'] = $this->salaryprocess->getAllEmployee($department);

           foreach ($result['employeeList'] as $employeelist) {
             
              $insertdata=$this->insertIntoSalaryMaster($employeelist->empl_id,$month,$year,$company);
           }

        } 

           $result['employeeList'] = $this->salaryprocess->getAllEmployee($department);

           foreach ($result['employeeList'] as $employeelist) { }


           */
             
              $this->insertIntoSalaryMaster($department,$month,$year,$company,$cash_bank_ac);
          

    

                    /* insert next month data salary parameter */
                     $insertdata=$this->insertIntoSalaryParameter($month,$year,$company);



      


            /* insert monthly opening */

          
   


            if($insertdata){

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





   }
   else
    {
          redirect('login','refresh');
    }


}







function insertIntoSalaryMaster($department,$month,$year,$company,$cash_bank_ac){

 $result['employeeList'] = $this->salaryprocess->getAllEmployee($department);

 $voucher_no = $this->voucherNo($department,$month,$year); 

 $dr_basic_total=0;
 $dr_hra_total=0;
 $dr_traveling_total=0;
 $dr_incentivebar_total=0;
 $dr_tennisexp_total=0;
 $cr_pf_total=0;
 $cr_esi_total=0;
 $cr_ptax_total=0;
 $cr_loan_total=0;
 $cr_lip_total=0;
 $cr_netpable_total=0;

  foreach ($result['employeeList'] as $employeelist) {
    $employee=$employeelist->empl_id;

              $delete_where = array(
                                    'salary_master.employee_id' => $employee,
                                    'salary_master.month_id' => $month,
                                    'salary_master.year_id' => $year,
                                    'salary_master.company_id' => $company,
                                  );

              $deleteData = $this->commondatamodel->deleteTableData('salary_master',$delete_where);



      /* get get basic,hra,travelling */
        $basic=0;$hra=0;$travelling=0;
        $where_emp_sal = array(
                                'employee_salary_details.empl_master_id' => $employee,
                                'employee_salary_details.month_id' => $month,
                                'employee_salary_details.year_id' => $year,
                                'employee_salary_details.company_id' => $company,
                              );
        $salaryDatails = $this->commondatamodel->getSingleRowByWhereCls('employee_salary_details',$where_emp_sal);

        if ($salaryDatails) {

          $basic=$salaryDatails->basic_salary;
          $hra=$salaryDatails->hra_amount;
          $travelling=$salaryDatails->traveling_amount;  
        }

        /* Attendance */
        $attendance=0;
        $where_att = array(
                                'employee_attendance.employee_id' => $employee, 
                                'employee_attendance.month_id' => $month, 
                                'employee_attendance.year_id' => $year, 
                                'employee_attendance.company_id' => $company, 
                              );
        $attendanceDatails = $this->commondatamodel->getSingleRowByWhereCls('employee_attendance',$where_att);

        if ($attendanceDatails) {
            $attendance=$attendanceDatails->attendance_days;
        }


                /* get incentive bar amount  */
        $incentive_bar_amt=0;
        $where_incentive_bar = array(
                                'incentive_bar_transaction.employee_id' => $employee, 
                                'incentive_bar_transaction.month_id' => $month, 
                                'incentive_bar_transaction.year_id' => $year, 
                                'incentive_bar_transaction.company_id' => $company 
                              );
         $incentiveDatails = $this->commondatamodel->getSingleRowByWhereCls('incentive_bar_transaction',$where_incentive_bar);

        if ($incentiveDatails){
            $incentive_bar_amt=$incentiveDatails->amount;
        }

        /* get tennis exp amount deduction */
        $tennis_exp_amt=0;
        $where_tennis_exp = array(
                                'tennis_exp_transaction.employee_id' => $employee, 
                                'tennis_exp_transaction.month_id' => $month, 
                                'tennis_exp_transaction.year_id' => $year, 
                                'tennis_exp_transaction.company_id' => $company 
                              );
         $tennisexpDatails = $this->commondatamodel->getSingleRowByWhereCls('tennis_exp_transaction',$where_tennis_exp);

          if ($tennisexpDatails){
            $tennis_exp_amt=$tennisexpDatails->amount;
        }

        $gross= $basic+$hra+$travelling+$incentive_bar_amt+$tennis_exp_amt;

        $pf_rate=0;$esi_rate=0;$PF=0;$ESI=0;
        $salaryParameterData = $this->salaryprocess->getSalaryPerameter($month,$year,$company);
       
        if($salaryParameterData) {
          $PF= round(($basic*$salaryParameterData->pf_rate)/100);
          $ESI = round(($gross*$salaryParameterData->esi_rate)/100);
        }


        /* get professional tax */
        $pt=0;
        $professionalTaxData = $this->salaryprocess->getProfessionalTax($gross);
        if($professionalTaxData) {
           $pt=$professionalTaxData->rate;
        }


        /* get loan deduction amount */
        $loan=0;

        $where_loan = array(
                                'loan_adjustment.employee_id' => $employee, 
                                'loan_adjustment.month_id' => $month, 
                                'loan_adjustment.year_id' => $year, 
                                'loan_adjustment.company_id' => $company, 
                              );
        $loanDatails = $this->commondatamodel->getSingleRowByWhereCls('loan_adjustment',$where_loan);

        if ($loanDatails) {
         $loan=$loanDatails->adjusted_amt;

        }

        /* get lip deduction amount */
        $lip=0;
        $where_lip = array(
                                'lip_transaction.employee_id' => $employee, 
                                'lip_transaction.month_id' => $month, 
                                'lip_transaction.year_id' => $year, 
                              );
        $lipDatails = $this->commondatamodel->getSingleRowByWhereCls('lip_transaction',$where_lip);
        if ($lipDatails) {
            $lip=$lipDatails->lip_amount;
        }



        $total_deduction = $PF+$ESI+$pt+$loan+$lip;


        $net_payable = $gross-$total_deduction;



               $salary_array = array(
                                          'employee_id' => $employee,         
                                          'month_id' => $month,         
                                          'year_id' => $year,  
                                          'attendance' => $attendance,
                                          'basic' => $basic,
                                          'chg_basic' => $basic,
                                          'hra' => $hra,
                                          'travelling' => $travelling,
                                          'incentive_bar_amt' => $incentive_bar_amt,
                                          'tennis_exp_amt' => $tennis_exp_amt,
                                          'gross' => $gross,
                                          'pf_ded' => $PF,
                                          'esi_ded' => $ESI,
                                          'pt_ded' => $pt,
                                          'loan_ded' => $loan,
                                          'lip_ded' => $lip,
                                          'total_deduction' => $total_deduction,
                                          'net_payable' => $net_payable,
                                          'company_id' => $company,           
                                         );

              $insertData = $this->commondatamodel->insertSingleTableData('salary_master',$salary_array);
                    
                     $dr_basic_total+=$basic;
                     $dr_hra_total+=$hra;
                     $dr_traveling_total+=$travelling;
                     $dr_incentivebar_total+=$incentive_bar_amt;
                     $dr_tennisexp_total+=$tennis_exp_amt;
                     $cr_pf_total+=$PF;
                     $cr_esi_total+=$ESI;
                     $cr_ptax_total+=$pt;
                     $cr_loan_total+=$loan;
                     $cr_lip_total+=$lip;
                     $cr_netpable_total+=$net_payable;




              /* insert next month employee salary details */

        if ($salaryDatails){

              if ($month=='3') {
                    $nextmonth=(int)$month+1;
                    $nxtyear_id = $this->memberbillmodel->checkNextYearExist($year)->year_id;
                    $this->deleteEmployeeSalaryDetails($employee,$nextmonth,$nxtyear_id,$company);
                        $instsalarydtl = array(
                                   'empl_master_id'=>$employee,
                                   'month_id'=>$nextmonth,
                                   'year_id'=>$nxtyear_id,
                                   'company_id'=>$salaryDatails->company_id,
                                   'basic_salary'=>$salaryDatails->basic_salary,
                                   'traveling_amount'=>$salaryDatails->traveling_amount,
                                   'hra_amount'=>$salaryDatails->hra_amount,
                                   'created_on'=>date('Y-m-d')
                                 ); 


                $insertSal = $this->commondatamodel->insertSingleTableData('employee_salary_details',$instsalarydtl);
                           
              }else{

                  if ($month=='12') {
                      $nextmonth=1;
                  }else{
                      $nextmonth=(int)$month+1; 
                  }
                    $this->deleteEmployeeSalaryDetails($employee,$nextmonth,$year,$company);
                       $instsalarydtl = array(
                                   'empl_master_id'=>$employee,
                                   'month_id'=>$nextmonth,
                                   'year_id'=>$year,
                                   'company_id'=>$salaryDatails->company_id,
                                   'basic_salary'=>$salaryDatails->basic_salary,
                                   'traveling_amount'=>$salaryDatails->traveling_amount,
                                   'hra_amount'=>$salaryDatails->hra_amount,
                                   'created_on'=>date('Y-m-d')
                                 ); 
                $insertSal = $this->commondatamodel->insertSingleTableData('employee_salary_details',$instsalarydtl);
                     

              }

          }





        }




/* create voucher master */


                  $component_array['BA']=$dr_basic_total;
                  $component_array['HR']=$dr_hra_total;
                  $component_array['TR']=$dr_traveling_total;
                  $component_array['IN']=$dr_incentivebar_total;
                  $component_array['TI']=$dr_tennisexp_total;
                  $component_array['PF']=$cr_pf_total;
                  $component_array['ES']=$cr_esi_total;
                  $component_array['PR']=$cr_ptax_total;
                  $component_array['AD']=$cr_loan_total;
                  $component_array['LI']=$cr_lip_total;
                 // $component_array['NP']=$cr_netpable_total;

                  $total_dr=($dr_basic_total+$dr_hra_total+$dr_traveling_total+$dr_incentivebar_total+$dr_tennisexp_total);
                  $total_cr=($cr_pf_total+$cr_esi_total+$cr_ptax_total+$cr_loan_total+$cr_lip_total+$cr_netpable_total);

                  $where_voucher = array(
                                          'voucher_master.voucher_no' => $voucher_no,
                                        );
                  $voucherData= $this->commondatamodel->getSingleRowByWhereCls('voucher_master',$where_voucher);

                  if ($voucherData) {

                     $vMastId=$voucherData->id;
                     $voucher_no=$voucherData->voucher_no;
                     $data_upd = array(
                              'total_dr_amt'=>$total_dr,
                              'total_cr_amt'=>$total_cr
                         );
                     $update_voucher_master_where = array('voucher_master.id' => $vMastId);

             $Updatedata = $this->commondatamodel->updateSingleTableData('voucher_master',$data_upd,$update_voucher_master_where);

                  }else{

                     $voucherMast['voucher_no'] = $voucher_no; 
                     $voucherMast['voucher_date'] = date("Y-m-d");
                     $voucherMast['narration'] = "Salary Invoice No ".$voucher_no." Dated ".$voucherMast['voucher_date']; 
                     $voucherMast['cheque_no'] = NULL;         
                     $voucherMast['cheque_date'] =NULL;        
                     $voucherMast['bank_name'] = NULL;        
                     $voucherMast['bank_branch'] = NULL;          
                     $voucherMast['tran_type'] = 'PY';         
                     $voucherMast['year_id'] =  $year;       
                     $voucherMast['company_id'] = $company;  
                     $voucherMast['total_dr_amt'] = $total_dr;         
                     $voucherMast['total_cr_amt'] = $total_cr; 
                     $vMastId = $this->commondatamodel->insertSingleTableData('voucher_master',$voucherMast);

                  }


                  /* delete voucher details */

                   $where_vcdtl = array('voucher_detail.voucher_master_id' => $vMastId);
                   $this->commondatamodel->deleteTableData('voucher_detail',$where_vcdtl);

                  $slno=1;
                  foreach ($component_array as $key => $value) {

                    $acData= $this->salaryprocess->getAccountIdByComponentDepartment($department,$key);

                      if ($acData){
                          $vouchrDtlCus['voucher_master_id'] = $vMastId;
                          $vouchrDtlCus['srl_no'] = $slno++;
                          $vouchrDtlCus['tran_tag'] = $acData->tag ;
                          $vouchrDtlCus['account_master_id'] = $acData->account_id;
                          $vouchrDtlCus['amount'] = $value;
                          $insert_dtl= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
                      }

                  }

                          /* net payable */
                          $vouchrDtlCus['voucher_master_id'] = $vMastId;
                          $vouchrDtlCus['srl_no'] = $slno++;
                          $vouchrDtlCus['tran_tag'] = 'Cr' ;
                          $vouchrDtlCus['account_master_id'] = $cash_bank_ac;
                          $vouchrDtlCus['amount'] = $cr_netpable_total;
                          $insert_dtl= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);












}


function deleteEmployeeSalaryDetails($employee_id,$month_id,$year_id,$company_id){

      $delete_where = array(
                                    'employee_salary_details.empl_master_id' => $employee_id,
                                    'employee_salary_details.month_id' => $month_id,
                                    'employee_salary_details.year_id' => $year_id,
                                    'employee_salary_details.company_id' => $company_id,
                                  );

              $deleteData = $this->commondatamodel->deleteTableData('employee_salary_details',$delete_where);
      }





function insertIntoSalaryParameter($month,$year,$company){

   $salaryParameterData = $this->salaryprocess->getSalaryPerameter($month,$year,$company);

   if ($salaryParameterData) {

   
     
   if ($month=='3') {
                    $nextmonth=(int)$month+1;
                    $nxtyear_id = $this->memberbillmodel->checkNextYearExist($year)->year_id;

                     $delete_where = array( 
                           'salary_parameter_master.month_id' => $nextmonth,
                           'salary_parameter_master.year_id' => $nxtyear_id,
                           'salary_parameter_master.company_id' => $company,
                                   
                            );

     $deleteData = $this->commondatamodel->deleteTableData('salary_parameter_master',$delete_where);
                   
                        $instsalaryParamdtl = array(
                                   'month_id'=>$nextmonth,
                                   'pf_rate'=>$salaryParameterData->pf_rate,
                                   'esi_rate'=>$salaryParameterData->esi_rate,
                                   'hra_rate'=>$salaryParameterData->hra_rate,
                                   'esi_limit'=>$salaryParameterData->esi_limit,
                                   'year_id'=>$nxtyear_id,
                                   'company_id'=>$company,
                                   'created_on'=>date('Y-m-d')
                                   
                                 ); 


                $insert = $this->commondatamodel->insertSingleTableData('salary_parameter_master',$instsalaryParamdtl);
                           
              }else{

                  if ($month=='12') {
                      $nextmonth=1;
                  }else{
                      $nextmonth=(int)$month+1; 
                  }


                  $delete_where = array( 
                           'salary_parameter_master.month_id' => $nextmonth,
                           'salary_parameter_master.year_id' => $year,
                           'salary_parameter_master.company_id' => $company,
                                   
                            );

     $deleteData = $this->commondatamodel->deleteTableData('salary_parameter_master',$delete_where);
                            $instsalaryParamdtl = array(
                                   'month_id'=>$nextmonth,
                                   'pf_rate'=>$salaryParameterData->pf_rate,
                                   'esi_rate'=>$salaryParameterData->esi_rate,
                                   'hra_rate'=>$salaryParameterData->hra_rate,
                                   'esi_limit'=>$salaryParameterData->esi_limit,
                                   'year_id'=>$year,
                                   'company_id'=>$company,
                                   'created_on'=>date('Y-m-d')
                                   
                                 ); 
                $insert = $this->commondatamodel->insertSingleTableData('salary_parameter_master',$instsalaryParamdtl);
                     

              }

        }

        return $insert;

}



public function voucherNo($department,$month,$year){

    $voucher_no='';

    $where_year = array('financialyear.year_id' => $year);
    $acyear= $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->short_year;

    $where_month = array('month_master.id' => $month);
    $shortmonth= strtoupper($this->commondatamodel->getSingleRowByWhereCls('month_master',$where_month)->short_name);

    $where_dept = array('department_master.dept_id' => $department);
    $deptcode= strtoupper($this->commondatamodel->getSingleRowByWhereCls('department_master',$where_dept)->dept_code);

    $yeartagArray= explode("-",$acyear);

    $yeartag=$yeartagArray[0].$yeartagArray[1];

    $voucher_no ='SAL'.$shortmonth.$deptcode.$yeartag;

    return $voucher_no;

}


   function checkexistanceDeptComponentWiseAccount(){

    $session = $this->session->userdata('user_detail');
     if($this->session->userdata('user_detail'))
     {


         $department = $this->input->post('department');


       
 
         
         
          $ComponentData = $this->commondatamodel->getAllRecordWhere('salary_component_master',[]);
          $where_comp_ac = array('salary_component_details.department_id'=>$department);
          $ComponentDetailsData = $this->commondatamodel->getAllRecordWhere('salary_component_details', $where_comp_ac);
         
        // sizeof($ComponentData);
        // sizeof($ComponentDetailsData);
   
          if(sizeof($ComponentData)==sizeof($ComponentDetailsData)){
 
               $json_response = array(
                             "msg_status" => 1,
                             "msg_data" => "",
                             );
 
          }else{
 
               $json_response = array(
                             "msg_status" => 0,
                             "msg_data" => "Please add account against all salary components of selected department",
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



}// end of class
