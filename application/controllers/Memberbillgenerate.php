<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memberbillgenerate extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberbillmodel','memberbillmodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/account-group/account_group_view";
        $header="";  

        $result['accountgrouplist'] = $this->commondatamodel->getAllRecordOrderBy('group_master','id','desc');
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}



public function addBill(){

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

        $orderby_cat='category_name';
              $result['catogaryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_catogary_master',[],$orderby_cat);

              //$result['memberlist'] = $this->memberbillmodel->getAllActiveMemberByCategory();
              $result['memberlist'] =[];

       //  pre($result['studentlist']);exit;

        $page = "dashboard/member_bill/member_bill_generate_add_edit";
        $header="";
 
       
       
       

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}


 public function resetMemberList()
  {
      if($this->session->userdata('user_detail'))
      {
        
       $category = $this->input->post('category');     
     

         $result['memberlist'] = $this->memberbillmodel->getAllActiveMemberByCategory($category);

        

        ?>
           <select class="form-control select2" name="member_id" id="member_id" >
             <option value="">Select</option>
                          <?php 
                         foreach ($result['memberlist'] as $memberlist) {  ?>
                         <option value="<?php echo $memberlist->member_id;?>"  
                          ><?php echo $memberlist->member_code;?></option>
                          <?php     } ?>                              
          </select> 
        <?php

      }
      else
      {
          redirect('login','refresh');
      }
  } 



public function generateBillAction() {

 $session = $this->session->userdata('user_detail');
 if($this->session->userdata('user_detail'))
    {
           
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);


        $month = $dataArry['month'];
        $year=$session['yearid'];
        $company = $session['companyid'];


    


        // pre($result['acyear']);

      

        $category = $dataArry['category'];
        $member_id = $dataArry['member_id'];
        
        $bill_dt = $dataArry['bill_dt'];

        if($bill_dt!=""){
                $bill_dt = str_replace('/', '-', $bill_dt);
                $bill_dt = date("Y-m-d",strtotime($bill_dt)); 
        }else{
                $bill_dt = NULL;
        }

        $where = array('financialyear.year_id' =>  $year);
        $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

          
            $years=explode(" ",$result['financialyear']->year);
           
            if ($month==1 || $month==2 || $month==3) {

                if($month<10){$month="0".$month;}
              $yearmonth=$years[2]."-".$month;

            }else{

              if($month<10){$month="0".$month;}
              $yearmonth=$years[0]."-".$month;

            }




$result['memberlist'] = $this->memberbillmodel->getAllActiveMembercode($category,$member_id);

        foreach ($result['memberlist'] as $memberlist) {
           
            $member_id=$memberlist->member_id;
            $outgoing_cgst=0;
            $outgoing_sgst=0;

            $month_opening=$this->MemberMonthOpening($member_id,$month,$year,$company);

            $barData = $this->getBarAmountDetails($member_id,$yearmonth,$year);
            $catData = $this->getCatAmountDetails($member_id,$yearmonth,$year);









            $month_subs = $this->monthlySubscription($member_id);

            /* swiming */
            $swimingData = $this->getFacilityData($member_id,$yearmonth,'SWM');
            $outgoing_cgst+=$swimingData->cgst_total;
            $outgoing_sgst+=$swimingData->sgst_total;

            /* gym */
            $gymData = $this->getFacilityData($member_id,$yearmonth,'GYM');
            $outgoing_cgst+=$gymData->cgst_total;
            $outgoing_sgst+=$gymData->sgst_total;

            /* Locker */
            $locData = $this->getFacilityData($member_id,$yearmonth,'LOC');
            $outgoing_cgst+=$locData->cgst_total;
            $outgoing_sgst+=$locData->sgst_total;

            /* Hard Court Extra Charges */
            $hrdData = $this->getFacilityData($member_id,$yearmonth,'HRD');
            $outgoing_cgst+=$hrdData->cgst_total;
            $outgoing_sgst+=$hrdData->sgst_total;

            /* Guest Charges */
            $guestData = $this->getFacilityData($member_id,$yearmonth,'GST');
            $outgoing_cgst+=$guestData->cgst_total;
            $outgoing_sgst+=$guestData->sgst_total;


            /* Towel Charge */
            $towelData = $this->getFacilityData($member_id,$yearmonth,'TOW');
            $outgoing_cgst+=$towelData->cgst_total;
            $outgoing_sgst+=$towelData->sgst_total;

             /* Card Play Charge */
            $cardplayData = $this->getFacilityData($member_id,$yearmonth,'CRD');
            $outgoing_cgst+=$cardplayData->cgst_total;
            $outgoing_sgst+=$cardplayData->sgst_total;

            /* Benvolent Fund */
            $benvolentData = $this->getBenvolentData($member_id,$month,$year,$company);
            $outgoing_cgst+=$benvolentData->cgst_total;
            $outgoing_sgst+=$benvolentData->sgst_total;

            /* Fixed hard court */
            $fixedHardCourtData = $this->getFixedHardCourtData($member_id,$yearmonth,$year,$company);
            $outgoing_cgst+=$fixedHardCourtData->cgst_total;
            $outgoing_sgst+=$fixedHardCourtData->sgst_total;

            /* development fees */
            $developmentData = $this->getDevelopmentFeesData($member_id,$month,$year,$company);
            $outgoing_cgst+=$developmentData->cgst_total;
            $outgoing_sgst+=$developmentData->sgst_total;


            /* puja contribution */
            $pujacontributionData = $this->getPujaContributionData($member_id,$month,$year,$company);
            $outgoing_cgst+=$pujacontributionData->cgst_total;
            $outgoing_sgst+=$pujacontributionData->sgst_total;


            /* member Correction */
            $correctionData = $this->getCorrectionData($member_id,$yearmonth,$year,$company);
            $outgoing_cgst+=$correctionData->cgst_total;
            $outgoing_sgst+=$correctionData->sgst_total;


            /* member Receipt */
            $memberReceiptData = $this->getMemberReceiptData($member_id,$yearmonth,$year,$company);
            $outgoing_cgst+=$memberReceiptData->cgst_total;
            $outgoing_sgst+=$memberReceiptData->sgst_total;

            /* minimum belling */
            $minimum_billing_amt=0;
            $minimumBillingData = $this->minimumBillingAmount($member_id,$month,$year,$company);
            $minimum_billing_amt=$minimumBillingData->short_fall;
            $outgoing_cgst+=$minimumBillingData->cgst_amt;
            $outgoing_sgst+=$minimumBillingData->sgst_amt;
            

            $taxableAmount=($month_subs+$barData->taxable_total+$catData->taxable_total+$swimingData->taxable_total+$gymData->taxable_total+$locData->taxable_total+$hrdData->taxable_total+$guestData->taxable_total+$towelData->taxable_total+$benvolentData->taxable_total+$fixedHardCourtData->taxable_total+$cardplayData->taxable_total+$developmentData->taxable_total+$pujacontributionData->taxable_total+$correctionData->taxable_total+$memberReceiptData->taxable_total+$minimum_billing_amt);

            $gstTotal=($barData->cgst_total+$barData->sgst_total+$catData->cgst_total+$catData->sgst_total+$outgoing_cgst+$outgoing_sgst);

            $totalAmount = ($taxableAmount+$gstTotal);

            $netAmount=$totalAmount-$memberReceiptData->taxable_total;


            $member_bill_inst = array(
                                        'member_id' => $member_id, 
                                        'bill_date' => $bill_dt, 
                                        'bill_month' => $month, 
                                        'year_id' => $year, 
                                        'company_id' => $company, 
                                        'month_open' => $month_opening, 
                                        'month_subs' => $month_subs, 
                                        'bar_amount' => $barData->taxable_total, 
                                        'bar_cgst' => $barData->cgst_total, 
                                        'bar_sgst' => $barData->sgst_total, 
                                        'cat_amount' => $catData->taxable_total, 
                                        'cat_cgst' => $catData->cgst_total, 
                                        'cat_sgst' => $catData->sgst_total, 
                                        'swimming' => $swimingData->taxable_total, 
                                        'gym' => $gymData->taxable_total,
                                        'locker_charge' => $locData->taxable_total,
                                        'hard_court_extra' => $hrdData->taxable_total,
                                        'guest_charge' => $guestData->taxable_total,
                                        'towel_charge' => $towelData->taxable_total,
                                        'ben_fund' => $benvolentData->taxable_total,
                                        'fixed_hard' => $fixedHardCourtData->taxable_total,
                                        'card_play' => $cardplayData->taxable_total,
                                        'development_charge' => $developmentData->taxable_total,
                                        'puja_contribution' => $pujacontributionData->taxable_total,
                                        'corrections' => $correctionData->taxable_total,
                                        'receipt_amt' => $memberReceiptData->taxable_total,
                                        'min_bill_amt' => $minimum_billing_amt,
                                        'net_amount' => $netAmount,
                                        'outgoing_cgst' => $outgoing_cgst, 
                                        'outgoing_sgst' => $outgoing_sgst, 
                                      );


        $insertdata = $this->commondatamodel->insertSingleTableData('member_bill_master',$member_bill_inst);


            /* insert monthly opening */

          
        if ($month=='03') {
            $month=(int)$month+1;

              $nxtyear_id = $this->memberbillmodel->checkNextYearExist($year)->year_id;
       
            $this->insertMonthlyopening($member_id,$netAmount,$month,$nxtyear_id,$company);

        }else{

            if ($month=='12') {
                $month=1;
            }else{
                $month=(int)$month+1; 
            }


            $this->insertMonthlyopening($member_id,$netAmount,$month,$year,$company);
        }

      
            


        }


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



public function lastDateOfmonth() {

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

         

         $lastdate = date("d/m/Y", strtotime($this->last_day_of_the_month($firstdate)));

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


public function getBarAmountDetails($member_id,$yearmonth,$year){

           $category='BAR';
           return $barData = $this->memberbillmodel->getBotKotDataByCategory($member_id,$category,$yearmonth);     

}

public function getCatAmountDetails($member_id,$yearmonth,$year){

            $category='CAT';
            return $barData = $this->memberbillmodel->getBotKotDataByCategory($member_id,$category,$yearmonth);     

}


public function monthlySubscription($memberid){

$where = array('member_master.member_id' =>  $memberid);
return $this->commondatamodel->getSingleRowByWhereCls('member_master',$where)->subscription;

}



public function getFacilityData($member_id,$yearmonth,$entry_module){

     return $facilityData = $this->memberbillmodel->getMemberFacilityByCategory($member_id,$yearmonth,$entry_module);
}


public function getBenvolentData($member_id,$monthid,$yearid,$company_id){

 return $benvolentFund = $this->memberbillmodel->getMemberBenvolentFund($member_id,$monthid,$yearid,$company_id);

}

public function getFixedHardCourtData($member_id,$yearmonth,$year_id,$company_id){

     return $facilityData = $this->memberbillmodel->getMemberFixedHardCourt($member_id,$yearmonth,$year_id,$company_id);
}


public function getDevelopmentFeesData($member_id,$monthid,$yearid,$company_id){

    return $developmentData = $this->memberbillmodel->getDevelopmentFees($member_id,$monthid,$yearid,$company_id);

}


public function getPujaContributionData($member_id,$monthid,$yearid,$company_id){

    return $PujaContribution = $this->memberbillmodel->getPujaContribution($member_id,$monthid,$yearid,$company_id);

}


public function getCorrectionData($member_id,$monthid,$yearid,$company_id){

    return $CorrectionAmount = $this->memberbillmodel->getCorrectionAmount($member_id,$monthid,$yearid,$company_id);

}

public function getMemberReceiptData($member_id,$monthid,$yearid,$company_id){

    return $MemberReceiptAmount = $this->memberbillmodel->getMemberReceiptAmount($member_id,$monthid,$yearid,$company_id);

}


public function MemberMonthOpening($member_id,$month,$year,$company){

    $where = array(
                    'member_monthly_opening.member_id' =>  $member_id,
                    'member_monthly_opening.month_id' =>  $month,
                    'member_monthly_opening.year_id' =>  $year,
                    'member_monthly_opening.company_id' =>  $company,
                    );

    $monthOpeningData = $this->commondatamodel->getSingleRowByWhereCls('member_monthly_opening',$where);

    if ($monthOpeningData) {
       $opn_bal=$monthOpeningData->open_bal;
    }else{
        $opn_bal=0;
    }

    return $opn_bal;

}



public function minimumBillingAmount($member_id,$month,$year,$company){

  return $minimumBillingData = $this->memberbillmodel->getMinimumBillingAmount($member_id,$month,$year,$company);

}





       public function chechnextYearData() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();

              $year=$session['yearid'];
              $company = $session['companyid'];



     
        $result['acyearnxt'] = $this->memberbillmodel->checkNextYearExist($year);
       

       // pre( $result['acyearnxt']);


       
        if ($result['acyearnxt']) {
              $json_response = array(
                            "status" => 1  
                          );
        }else{
             $json_response = array(
                            "status" => 0  
                          );

        }

          

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;  

        }else
        {
            redirect('login','refresh');
        }


     }  



function insertMonthlyopening($member_id,$opening_balance,$month_id,$year_id,$company_id){

    $delete_where = array(
                            'member_monthly_opening.member_id' => $member_id,
                            'member_monthly_opening.month_id' => $month_id,
                            'member_monthly_opening.year_id' => $year_id,
                            'member_monthly_opening.company_id' => $company_id,
                         );


   $deletedata = $this->commondatamodel->deleteTableData('member_monthly_opening',$delete_where);



   $insert_array = array(
                            'member_monthly_opening.open_bal' => $opening_balance,
                            'member_monthly_opening.member_id' => $member_id,
                            'member_monthly_opening.month_id' => $month_id,
                            'member_monthly_opening.year_id' => $year_id,
                            'member_monthly_opening.company_id' => $company_id,
                         );

   $insert = $this->commondatamodel->insertSingleTableData('member_monthly_opening',$insert_array);





}












} // end of class