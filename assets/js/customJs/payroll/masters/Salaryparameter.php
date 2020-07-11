<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salaryparameter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
      
        $this->load->model('salaryparametermodel','salaryparametermodel',TRUE); 
        
        
        set_time_limit(1200); 
    }

public function index()
{

  $session = $this->session->userdata('user_detail');

	if($this->session->userdata('user_detail'))
	{ 
        $page = "dashboard/payroll/masters/salary_parameter/salary_parameter_list_view.php";
        $header="";  
        
        $result['salaryparamList'] = $this->salaryparametermodel->getsalaryparameterlist();

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}



public function addSalaryParameter(){

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    

       $year=$session['yearid'];

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['salaryparamId'] = 0;
        $result['salaryparamEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['salaryparamId'] = $this->uri->segment(3);
          $where = array('id' => $result['salaryparamId']);
          $result['salaryparamEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('salary_parameter_master',$where);
       }


        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);;

      //  pre($result['memberList']);exit;


        $page = "dashboard/payroll/masters/salary_parameter/add_edit_salary_parameter.php";
        $header="";
 
       
       
       

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}


public function salaryparameter_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $year=$session['yearid'];
            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);


            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $salaryparamId = trim(htmlspecialchars($dataArry['salaryparamId']));
            $month = trim(htmlspecialchars($dataArry['month']));
            $pf_rate = trim($dataArry['pf_rate']);
            $esi_rate = trim(htmlspecialchars($dataArry['esi_rate']));
            $hra_rate = trim(htmlspecialchars($dataArry['hra_rate']));
            $esi_limit = trim(htmlspecialchars($dataArry['esi_limit']));

            

         

            
            if($mode == 'ADD' && $salaryparamId == 0){

                 $data = array(
                          'month_id'=>$month,
                          'pf_rate'=>$pf_rate,
                          'esi_rate'=>$esi_rate,
                          'hra_rate'=>$hra_rate,
                          'esi_limit'=>$esi_limit,
                          'year_id'=>$session['yearid'],
                          'created_on'=>date('Y-m-d')
                         );


              $insertdata = $this->commondatamodel->insertSingleTableData('salary_parameter_master',$data);
             
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

            }else{

                  $data_upd = array(
                          'month_id'=>$month,
                          'pf_rate'=>$pf_rate,
                          'esi_rate'=>$esi_rate,
                          'hra_rate'=>$hra_rate,
                          'esi_limit'=>$esi_limit,
                          
                         );



                $upd_where = array('salary_parameter_master.id' => $salaryparamId);

                $Updatedata = $this->commondatamodel->updateSingleTableData('salary_parameter_master',$data_upd,$upd_where);


                  if($Updatedata){

                      $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Updated successfully",
                            
                        );

                    }else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while updating ...Please try again."
                        );
                    }  
            }

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 


         }else{
            redirect('login','refresh');
        }   

  }





public function lastDateOfmonth() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
           
            
            $processing_dt = $this->input->post('processing_dt');
          

             if($processing_dt!=""){
                $processing_dt = str_replace('/', '-', $processing_dt);
                $processing_dt = date("Y-m",strtotime($processing_dt));
               }
               else{
                 $processing_dt = NULL; 
               }
         

         $billing_month = date('M Y', strtotime($processing_dt." -1 month"));

         $json_response = array(
                            "billing_month" => $billing_month 
                          );

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


           
            

        }else
        {
            redirect('login','refresh');
        }


}



function dailyBalanceProcess($processing_date,$member_id){

 $session = $this->session->userdata('user_detail');
 if($this->session->userdata('user_detail'))
 {
   // echo "<br>".$processing_date;
   // echo "<br>".$member_id;exit;
    $year=$session['yearid'];
    $company = $session['companyid'];
    $billingAmt=0;$consumption=0;$paymentAmt=0;$totalConsumption=0;$outgoing_cgst=0;$outgoing_sgst=0;

    $billing_month = date('m', strtotime($processing_date." -1 month"));

    $start_dt = date("Y-m",strtotime($processing_date))."-01";
    $end_dt = date("Y-m-d",strtotime($processing_date));

    /* bill amount */
      $BillingData=$this->dailybalancemodel->getMonthBillDataOpeningMonthlyData($member_id,$billing_month,$year,$company);

      if($BillingData){

        $billingAmt=$BillingData->open_bal;

      }

      /* comsumption */

      $barData = $this->getBarAmountDetails($member_id,$start_dt,$end_dt,$year);
      $catData = $this->getCatAmountDetails($member_id,$start_dt,$end_dt,$year);

    

        /* Guest Charges */
            $guestData = $this->getFacilityData($member_id,$start_dt,$end_dt,'GST');
            $outgoing_cgst+=$guestData->cgst_total;
            $outgoing_sgst+=$guestData->sgst_total;

       /* gym */
            $gymData = $this->getFacilityData($member_id,$start_dt,$end_dt,'GYM');
            $outgoing_cgst+=$gymData->cgst_total;
            $outgoing_sgst+=$gymData->sgst_total; 

        /* Hard Court Extra Charges */
            $hrdData = $this->getFacilityData($member_id,$start_dt,$end_dt,'HRD');
            $outgoing_cgst+=$hrdData->cgst_total;
            $outgoing_sgst+=$hrdData->sgst_total;

        /* Locker */
            $locData = $this->getFacilityData($member_id,$start_dt,$end_dt,'LOC');
            $outgoing_cgst+=$locData->cgst_total;
            $outgoing_sgst+=$locData->sgst_total;

        /* swiming */
            $swimingData = $this->getFacilityData($member_id,$start_dt,$end_dt,'SWM');
            $outgoing_cgst+=$swimingData->cgst_total;
            $outgoing_sgst+=$swimingData->sgst_total;

        /* member Correction */
            $correctionData = $this->getCorrectionData($member_id,$start_dt,$end_dt,$year,$company);
            $outgoing_cgst+=$correctionData->cgst_total;
            $outgoing_sgst+=$correctionData->sgst_total;


         /* member Receipt */
            $memberReceiptData = $this->getMemberReceiptData($member_id,$start_dt,$end_dt,$year,$company);
            $receipt_amt =$memberReceiptData->taxable_total;

          
          


      $totalConsumption=($barData->taxable_total+$catData->taxable_total+$guestData->taxable_total+$gymData->taxable_total+$hrdData->taxable_total+$swimingData->taxable_total+$correctionData->taxable_total);

      $gstTotal=($barData->cgst_total+$barData->sgst_total+$catData->cgst_total+$catData->sgst_total+$outgoing_cgst+$outgoing_sgst);

      $mOutStanding=($billingAmt+$totalConsumption+$gstTotal)-$receipt_amt;



      $mBalance_after_payment=0;
      $mSplMember="";
      $proc_bal_after_payment=0;

       $where_member = array('member_master.member_id' => $member_id);
       $memberData= $this->commondatamodel->getSingleRowByWhereCls('member_master',$where_member);

       if ($memberData->balance_aft_pmt!='') {
          $mBalance_after_payment=$memberData->balance_aft_pmt;
       }


       /* start of daily balance logic */

        if ($mBalance_after_payment>0) {
            $mSplMember=$memberData->elt_member;

              if ($mSplMember=='Y') {
                  $mBlocked='N';
              }else{
                  $mBlocked='Y';
              }

            if ($memberData->blocked_y_n=="N") {
              
                  if ($mBalance_after_payment<5000) {
                     $mBlocked='N';
                  }else{
                     $mBlocked='Y';
                  }

            }else{

                 if ($mOutStanding>100) {
                     $mBlocked='Y';
                 }

            }


            if ($mBalance_after_payment<=100) {
                 $mBlocked='N';
            }

            if ($mOutStanding<=100) {
                $mBlocked='N';
            }


            if ($mSplMember=='Y') {
                  $mBlocked='N';
              }else{
                  $mBlocked='Y';
              }


              /* update member master*/

                $member_array_upd = array(     
                                          'daily_balance' => $mOutStanding,   
                                          'lastupdate_date' => $processing_date,   
                                          'lastupdate_time' => date('H:i:s'), 
                                          'balance_aft_pmt' => $mOutStanding,  
                                          'blocked_y_n' => $mBlocked,  
                                               
                                         );

                $upd_where = array('member_master.member_id' => $member_id);

                $update = $this->commondatamodel->updateSingleTableData('member_master',$member_array_upd,$upd_where);








          
        } // end of first if
        else{

              if($mBalance_after_payment>=5000){
                   $mBlocked='Y';
              }else{
                  $mBlocked='N';
              }

              $mSplMember=$memberData->elt_member;

              if ($mSplMember=='Y') {
                  $mBlocked='N';
              }

              if ($mOutStanding>=5000) {
                $proc_bal_after_payment=$mOutStanding;
              }


                /* update member master*/

                $member_array_upd = array(     
                                          'daily_balance' => $mOutStanding,   
                                          'lastupdate_date' => $processing_date,   
                                          'lastupdate_time' => date('H:i:s'), 
                                          'balance_aft_pmt' => $proc_bal_after_payment,  
                                          'blocked_y_n' => $mBlocked,  
                                               
                                         );

                $upd_where = array('member_master.member_id' => $member_id);

                $update = $this->commondatamodel->updateSingleTableData('member_master',$member_array_upd,$upd_where);



        } 

       /* end of daily balance logic */


       /* insert into */
          $delete_where = array(
                            'member_daily_balance.member_id' => $member_id,
                            'member_daily_balance.updatedate' => $processing_date 
                         );
         $deletedata = $this->commondatamodel->deleteTableData('member_daily_balance',$delete_where);

          $insert_array = array(
                            'member_daily_balance.member_id' => $member_id,
                            'member_daily_balance.updatedate' => $processing_date,
                            'member_daily_balance.updatetime' => date('H:i:s'),
                            'member_daily_balance.member_code' => $memberData->member_code,
                            'member_daily_balance.daily_balance' => $mOutStanding,

                         );

   $insert = $this->commondatamodel->insertSingleTableData('member_daily_balance',$insert_array);




     
  }else
  {
            
    redirect('login','refresh');
  }

}



public function getBarAmountDetails($member_id,$start_dt,$end_dt,$year){

           $category='BAR';
           return $barData = $this->dailybalancemodel->getBotKotDataByCategory($member_id,$category,$start_dt,$end_dt);     

}

public function getCatAmountDetails($member_id,$start_dt,$end_dt,$year){

            $category='CAT';
            return $barData = $this->dailybalancemodel->getBotKotDataByCategory($member_id,$category,$start_dt,$end_dt);     

}

public function getFacilityData($member_id,$start_date,$end_date,$entry_module){

     return $facilityData = $this->dailybalancemodel->getMemberFacilityByCategory($member_id,$start_date,$end_date,$entry_module);
}


public function getCorrectionData($member_id,$start_date,$end_date,$year_id,$company_id){

    return $CorrectionAmount = $this->dailybalancemodel->getCorrectionAmount($member_id,$start_date,$end_date,$year_id,$company_id);

}

public function getMemberReceiptData($member_id,$start_date,$end_date,$yearid,$company_id){

    return $MemberReceiptAmount = $this->dailybalancemodel->getMemberReceiptAmount($member_id,$start_date,$end_date,$yearid,$company_id);

}



public function getDailyBalanceMemberList(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $member_id = $this->input->post('member_id');

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_dt');
           

            if($from_dt!=""){
                    $from_dt = str_replace('/', '-', $from_dt);
                    $from_dt = date("Y-m-d",strtotime($from_dt)); 
            }else{
                    $from_dt = NULL;
            }

            if($to_dt!=""){
                    $to_dt = str_replace('/', '-', $to_dt);
                    $to_dt = date("Y-m-d",strtotime($to_dt)); 
            }else{
                    $to_dt = NULL;
            }

       
        $result['memberList'] = $this->dailybalancemodel->getDailyBalanceList($member_id,$from_dt,$to_dt);
      
        //pre($result['memberList']);exit;
        
        $page = "dashboard/daily_balance/daily_balance_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }



}// end of class
