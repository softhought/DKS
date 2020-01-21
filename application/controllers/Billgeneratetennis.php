<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billgeneratetennis extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
   
        $this->load->model('Billgeneratetennismodel','billgenmodel',TRUE);
      
         
       
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

      //  pre($result['studentlist']);exit;
        $page = "dashboard/bill_generate/bill_generate_add_edit";
        $header="";
 
       
       
       

        createbody_method($result, $page, $header, $session);
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
           <select class="form-control select2" name="student_id" id="student_id" >
             <option value="">Select</option>
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


       public function generateBillAction() {

         $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
           

            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            $company=$session['companyid'];
            $year=$session['yearid'];
            $activity_description="";
            $student_id=(int)$dataArry['student_id'];
            $billing_style=$dataArry['billing_style'];
            $month_id=(int)$dataArry['month'];
            $quarter_id=(int)$dataArry['quarter_month'];
            $mode=$dataArry['mode'];
     

            if($dataArry['bill_dt']!=""){
                $billing_date = str_replace('/', '-', $dataArry['bill_dt']);
                $billing_date = date("Y-m-d",strtotime($billing_date));
               }
               else{
                 $billing_date = NULL; 
               }


            $search_month_id=0;
            $search_quarter_id=0;

	            if ($billing_style=='M') {
	            	$where_month = array('month_master.id' => $month_id );
	           	    $monthData=$this->commondatamodel->getSingleRowByWhereCls('month_master',$where_month); 
	           	   	$selectMonthSl=$monthData->display_serial;
		           	   	if ($selectMonthSl==1) {
		           	   		$search_year_id=$year-1;
		           	   		$search_month_id=3;
		           	   	}else{

		           	   		$where_month_sl = array('month_master.display_serial' => $selectMonthSl-1 );
	           	            $monthDataSl=$this->commondatamodel->getSingleRowByWhereCls('month_master',$where_month_sl); 
		           	   		$search_year_id=$year;
		           	   		$search_month_id=$monthDataSl->id;

		           	   	}
	           	 /*	echo "SM:".$search_month_id."| SY".$search_year_id; */
	            }else{
		            	if ($quarter_id==1) {
		            		$search_quarter_id=4;
		            		$search_year_id=$year-1;
		            	}else{
		            		$search_quarter_id=$quarter_id-1;
		            		$search_year_id=$year;
		            	}


		         //   echo "QM:".$search_quarter_id."| SY".$search_year_id;	

	            }



             	if ($student_id!='') {

             		/* generate for single student*/

             		//echo "single student<br>";
             		//echo $student_id;
             	$studentCode=$this->getStudentCode($student_id);

             	$opening_amount = $this->getClosingPrevious($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);
             	$subscription_amount = $this->getSubscriptionFee($billing_style,$student_id);
             	$hardCourt_amount=$this->getHardCoutExtra($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);
             	$correction_amount=$this->getCorrection($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);
                $tournament_amount=$this->getIntraTournamentFees($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);

             

             	$total_amount=($opening_amount+$subscription_amount+$hardCourt_amount+$correction_amount+$tournament_amount);


             	 $BillID = $this->billgenmodel->checkExistBillData($billing_style,$student_id,$month_id,$quarter_id,$year,$company);
		             if ($BillID) {

		             	  $inst_bill_master = array(
             								
             								'billing_date' => $billing_date,
             								'opening_bal' => $opening_amount,
             								'subscription_fee' => $subscription_amount,
             								'hard_cout_fee' => $hardCourt_amount,
             								'correction' => $correction_amount,
             								'intra_tournament_fee' => $tournament_amount,
             								'total_amount' => $total_amount,
             								'billing_style' => $billing_style
             								
             							  );
		             	 $upd_where = array('bill_id'=>$BillID);

                         $insert = $this->commondatamodel->updateSingleTableData('bill_master_tennis',$inst_bill_master,$upd_where);

		             }else{

		             	    $invoice_no=$this->billgenmodel->getSerialNumber($company,$year,'TBILLGEN');
		             		$inst_bill_master = array(
             								'invoice_no' => $invoice_no,
             								'student_id' => $student_id,
             								'student_code' => $studentCode,
             								'billing_date' => $billing_date,
             								'month_id' => $month_id,
             								'quarter_id' => $quarter_id,
             								'year_id' => $year,
             								'opening_bal' => $opening_amount,
             								'subscription_fee' => $subscription_amount,
             								'hard_cout_fee' => $hardCourt_amount,
             								'correction' => $correction_amount,
             								'intra_tournament_fee' => $tournament_amount,
             								'total_amount' => $total_amount,
             								'billing_style' => $billing_style,
             								'company_id' => $company
             							  );

		             	  $insert = $this->commondatamodel->insertSingleTableData('bill_master_tennis',$inst_bill_master);

		             }
             	
            

           

          
           $activity_description = json_encode($inst_bill_master);
		   $this->insertBillGenerateActivity($activity_description,'Insert');


             	}else{
             	   /* generate for multiple student*/

             	   /*	echo "multiple student"; */
             	   	$result['studentList'] = $this->billgenmodel->studentListbyBillStyle($billing_style);

             	foreach ($result['studentList'] as $studentlist) {	
             	   		$student_id=$studentlist->admission_id;
             	   		$studentCode=$studentlist->student_code;

             	$opening_amount = $this->getClosingPrevious($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);
             	$subscription_amount = $this->getSubscriptionFee($billing_style,$student_id);
             	$hardCourt_amount=$this->getHardCoutExtra($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);
             	$correction_amount=$this->getCorrection($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);
             	$tournament_amount=$this->getIntraTournamentFees($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id);

                

                $total_amount=($opening_amount+$subscription_amount+$hardCourt_amount+$correction_amount+$tournament_amount);

                $BillID = $this->billgenmodel->checkExistBillData($billing_style,$student_id,$month_id,$quarter_id,$year,$company);
		             if ($BillID) {

		             	  $inst_bill_master = array(
             								
             								'billing_date' => $billing_date,
             								'opening_bal' => $opening_amount,
             								'subscription_fee' => $subscription_amount,
             								'hard_cout_fee' => $hardCourt_amount,
             								'correction' => $correction_amount,
             								'intra_tournament_fee' => $tournament_amount,
             								'total_amount' => $total_amount,
             								'billing_style' => $billing_style
             								
             							  );
		             	 $upd_where = array('bill_id'=>$BillID);

                         $insert = $this->commondatamodel->updateSingleTableData('bill_master_tennis',$inst_bill_master,$upd_where);

		             }else{

		             	    $invoice_no=$this->billgenmodel->getSerialNumber($company,$year,'TBILLGEN');
		             		$inst_bill_master = array(
             								'invoice_no' => $invoice_no,
             								'student_id' => $student_id,
             								'student_code' => $studentCode,
             								'billing_date' => $billing_date,
             								'month_id' => $month_id,
             								'quarter_id' => $quarter_id,
             								'year_id' => $year,
             								'opening_bal' => $opening_amount,
             								'subscription_fee' => $subscription_amount,
             								'hard_cout_fee' => $hardCourt_amount,
             								'correction' => $correction_amount,
             								'intra_tournament_fee' => $tournament_amount,
             								'total_amount' => $total_amount,
             								'billing_style' => $billing_style,
             								'company_id' => $company
             							  );

		             	  $insert = $this->commondatamodel->insertSingleTableData('bill_master_tennis',$inst_bill_master);

		             }
             	

                        $activity_description_arr[] = $inst_bill_master;

             	   	}/* end of foreach loop */

             	   	 $activity_description = json_encode($activity_description_arr);
		             $this->insertBillGenerateActivity($activity_description,'Insert');

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




function getClosingPrevious($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id){
	  $session = $this->session->userdata('user_detail');
	  $company=$session['companyid'];
	  $amount=0;
		if ($billing_style=="M") {

		$where_close = array(
							'tennis_student_opening.student_id' => (int)$student_id,
							'tennis_student_opening.billing_style' => $billing_style,
							'tennis_student_opening.month_id' => (int)$search_month_id,
							'tennis_student_opening.year_id' => (int)$search_year_id,
							'tennis_student_opening.company_id' => $company
						  );
		$closingingData=$this->commondatamodel->getSingleRowByWhereCls('tennis_student_opening',$where_close);
			if ($closingingData) {
			 	$amount=$closingingData->opening_balance;
			} 
			

		}else{

			$where_close = array(
								'tennis_student_opening.student_id' => (int)$student_id,
								'tennis_student_opening.billing_style' => $billing_style,
								'tennis_student_opening.quarter_id' => (int)$search_quarter_id,
								'tennis_student_opening.year_id' => (int)$search_year_id,
								'tennis_student_opening.company_id' => $company
							  );
			$closingingData=$this->commondatamodel->getSingleRowByWhereCls('tennis_student_opening',$where_close);
				if ($closingingData) {
				 	$amount=$closingingData->opening_balance;
				} 




		}


// echo "<br>amount".$amount;
// echo "<br>BillStyle".$billing_style;
// echo "<br>student_id".$student_id;
// echo "<br>search_month_id".$search_month_id;
// echo "<br>search_quarter_id".$search_quarter_id;
// echo "<br>search_year_id".$search_year_id;

		return $amount;
}

/*	get monthly or quarterly fee */
function getSubscriptionFee($billing_style,$student_id){
   	  $session = $this->session->userdata('user_detail');
	  $company=$session['companyid'];
	  $amount=0;
		$where_student= array(
								'admission_register.admission_id' => (int)$student_id,
								'admission_register.bill_style' => $billing_style,
								'admission_register.company_id' => $company
							  );
			$studentData=$this->commondatamodel->getSingleRowByWhereCls('admission_register',$where_student);
			
			if ($studentData) {
				
				if ($studentData->subscription!='') {
					$amount=$studentData->subscription;
				}
				
			}

			return $amount;

}

/* Get hard Court Extra */
function getHardCoutExtra($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id){
	  $session = $this->session->userdata('user_detail');
	  $company=$session['companyid'];

$where_year = array('financialyear.year_id' => $search_year_id);

$yearData=$this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year);

	$startYear= date("Y", strtotime($yearData->start_date));
	$endYear= date("Y", strtotime($yearData->end_date));

    $endYearMonths = array('01','02','03');

    $quarterMonth[1]= array('start' => '04','end' => '06'  );
    $quarterMonth[2]= array('start' => '07','end' => '09'  );
    $quarterMonth[3]= array('start' => '10','end' => '12'  );
    $quarterMonth[4]= array('start' => '01','end' => '03'  );


	if ($billing_style=="M") {
		
				if (strlen($search_month_id)==1) {
					$search_month_id='0'.$search_month_id;
				}
				
				if (in_array($search_month_id,$endYearMonths)) {
					$searchMonthYear=$endYear."-".$search_month_id;
				}else{
					$searchMonthYear=$startYear."-".$search_month_id;
				}
			
			$amount=$this->billgenmodel->getHardCoutextraMontly($student_id,(int)$search_year_id,$company,$searchMonthYear);

	}else{

		//echo "Search quarter".$search_quarter_id;

		  

		  		if ($search_quarter_id==4) {
		  			
		  			$starMonthYear=$endYear."-".$quarterMonth[$search_quarter_id]['start'];
		  			$endMonthYear=$endYear."-".$quarterMonth[$search_quarter_id]['end'];
		  		}else{
		  			$starMonthYear=$startYear."-".$quarterMonth[$search_quarter_id]['start'];
		  			$endMonthYear=$startYear."-".$quarterMonth[$search_quarter_id]['end'];

		  		}


		  		$amount=$this->billgenmodel->getHardCoutextraQuarterly($student_id,(int)$search_year_id,$company,$starMonthYear,$endMonthYear);

	}

	return $amount;


}


/* Get Correction */

function getCorrection($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id){

	$session = $this->session->userdata('user_detail');
	$company=$session['companyid'];

	$where_year = array('financialyear.year_id' => $search_year_id);

	$yearData=$this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year);

	$startYear= date("Y", strtotime($yearData->start_date));
	$endYear= date("Y", strtotime($yearData->end_date));

    $endYearMonths = array('01','02','03');

    $quarterMonth[1]= array('start' => '04','end' => '06'  );
    $quarterMonth[2]= array('start' => '07','end' => '09'  );
    $quarterMonth[3]= array('start' => '10','end' => '12'  );
    $quarterMonth[4]= array('start' => '01','end' => '03'  );

    if ($billing_style=="M") {
		
				if (strlen($search_month_id)==1) {
					$search_month_id='0'.$search_month_id;
				}
				
				if (in_array($search_month_id,$endYearMonths)) {
					$searchMonthYear=$endYear."-".$search_month_id;
				}else{
					$searchMonthYear=$startYear."-".$search_month_id;
				}
			
			$amount=$this->billgenmodel->getCorrectionMontly($student_id,(int)$search_year_id,$company,$searchMonthYear);

	 
	 }else{

		//echo "Search quarter".$search_quarter_id;

		  

		  		if ($search_quarter_id==4) {
		  			
		  			$starMonthYear=$endYear."-".$quarterMonth[$search_quarter_id]['start'];
		  			$endMonthYear=$endYear."-".$quarterMonth[$search_quarter_id]['end'];
		  		}else{
		  			$starMonthYear=$startYear."-".$quarterMonth[$search_quarter_id]['start'];
		  			$endMonthYear=$startYear."-".$quarterMonth[$search_quarter_id]['end'];

		  		}

		  		$amount=$this->billgenmodel->getCorrectionQuarterly($student_id,(int)$search_year_id,$company,$starMonthYear,$endMonthYear);

	}

	return $amount;



}


function getIntraTournamentFees($billing_style,$student_id,$search_month_id,$search_quarter_id,$search_year_id){

$session = $this->session->userdata('user_detail');
$company=$session['companyid'];
$amount=0;
$where = array(
				'intra_tournament_fees.admission_id' => $student_id, 
				'intra_tournament_fees.billing_style' => $billing_style, 
				'intra_tournament_fees.yearid' => $search_year_id, 
				'intra_tournament_fees.company_id' => $company, 
				);
$tournamentData=$this->commondatamodel->getSingleRowByWhereCls('intra_tournament_fees',$where);


if ($tournamentData) {
	$amount=$tournamentData->fees;
}


return $amount;

}


function getStudentCode($student_id){
$where = array('admission_id' => $student_id);
return $this->commondatamodel->getSingleRowByWhereCls('admission_register',$where)->student_code;
}


public function generatelistbill(){
    $session = $this->session->userdata('user_detail');
     if($this->session->userdata('user_detail'))
        {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $page = "dashboard/bill_generate/generate_bill_list";
            $header=""; 

            $where = array('year_id' => $year);

             $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

             $from_dt=$result['accountingyear']->start_date;
             $to_dt=$result['accountingyear']->end_date;

              if($from_dt!=""){
                $from_dt = str_replace('/', '-', $from_dt);
                $from_dt = date("Y-m-d",strtotime($from_dt));
             }
             else{
                 $from_dt = NULL;
             }

            if($to_dt!=""){
                $to_dt = str_replace('/', '-', $to_dt);
                $to_dt = date("Y-m-d",strtotime($to_dt));
             }
             else{
                 $to_dt = NULL;
             }


                         
             $tran_type='All';
             $result['billtype'] = array('M'=>'Monthly','Q'=>'Quarterly');

            $result['genbilllist'] = $this->billgenmodel->getgeneratebilllist($from_dt,$to_dt,$tran_type);
            $result['studentlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('admission_register',[],'student_code');
            //pre($result['genbilllist']);exit;
            createbody_method($result, $page, $header, $session);
           
        }
        else{
            redirect('login','refresh');
        }

}


public function generatelistpartialview(){


 $session = $this->session->userdata('user_detail');
     if($this->session->userdata('user_detail'))
        {



            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $billstyle = $this->input->post('billstyle');
            $studcode = $this->input->post('studcode');

            if($from_dt!=""){
                $from_dt = str_replace('/', '-', $from_dt);
                $from_dt = date("Y-m-d",strtotime($from_dt));
             }
             else{
                 $from_dt = NULL;
             }

            if($to_dt!=""){
                $to_dt = str_replace('/', '-', $to_dt);
                $to_dt = date("Y-m-d",strtotime($to_dt));
             }
             else{
                 $to_dt = NULL;
             }

        $result['genbilllist'] = $this->billgenmodel->getGenratebillpartiallist($from_dt,$to_dt,$billstyle,$studcode);

       //print_r($result['genbilllist']);exit;
        $page = "dashboard/bill_generate/generate_bill_partial_list";
        $this->load->view($page,$result);
       }
        else{
            redirect('login','refresh');
        }
}


function insertBillGenerateActivity($activity_description,$action){
$session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'Bill Generate tennis',
                              "action" => $action,
                              "from_method" => 'Billgeneratetennis/generateBillAction',
                              "table_name" => 'bill_master_tennis',
                              "user_id" => $session['userid'],
                              "ip_address" => getUserIPAddress(),
                              "user_browser" => getUserBrowserName(),
                              "user_platform" => getUserPlatform(),
                              "description" =>  $activity_description
                             );
                             
                $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);



}






   }// end of class