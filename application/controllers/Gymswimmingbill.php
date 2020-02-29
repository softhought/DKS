<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gymswimmingbill extends CI_Controller {
    public function __construct() {

        parent::__construct();
        $this->load->library('session');
        $this->load->model('gymswimmingbillmodel','gymswimming',TRUE);
     
         
       
    }

public function facilitylist()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

        $company=$session['companyid'];
        $year=$session['yearid'];
        $page = "dashboard/gym_swimming_minbilling/gym_swimming_minbilling_list";
        $header=""; 
        $result['entry_module'] = $this->uri->segment(3);

         $result['parameterData'] = $this->memberfacilitymodel->getFacilityDataByEntryModule($result['entry_module']);
         $parameter_mst_id=$result['parameterData']->parameter_id;

         $where = array('year_id' => $year);

         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;
    
        $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
        $result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
         
       //  $entry_module='All';
         $member_id='All';

        $result['facilityTranList'] = $this->memberfacilitymodel->getfacilityTransactionList($from_dt,$to_dt,$parameter_mst_id, $member_id);
       // pre($result['facilityTranList']); exit;      
                    
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
  }



public function addKOT(){

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

  

        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);
                                        
       

        $where_year = array('financialyear.year_id' => $year);
        $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

        $result['studentlist'] = [];

        $where_ac = array(
                            'account_master.is_active' => 'Y', 
                            'account_master.is_gym_swim_minbill' => 'Y', 
                         );

        $result['accountList'] = $this->commondatamodel->getAllRecordWhere('account_master',$where_ac);

        //pre($result['accountList']);exit;


        $page = "dashboard/gym_swimming_minbilling/gym_swimming_minbilling_add_edit.php";
        $header="";
 

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}



public function minimumeBillAction() {

 $session = $this->session->userdata('user_detail');
 if($this->session->userdata('user_detail'))
    {
           
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);


        $year=$session['yearid'];
        $company = $session['companyid'];
        $selectMonth = $month = $dataArry['month'];
        $account = $dataArry['account'];
        $kot_type = $dataArry['kot_type'];

        if ($kot_type=="M") {
          $kot_status="MONTHLY";
        }else{
           $kot_status="YEARLY";
        }

        $where = array('financialyear.year_id' =>  $year);
        $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

         $years=explode(" ",$result['financialyear']->year);
           
            if ($month==1 || $month==2 || $month==3) {

                if($month<10){$month="0".$month;}
                $yearmonth=$years[2]."-".$month;
                $firstdate=$years[2]."-".$month."-01";

            }else{

              if($month<10){$month="0".$month;}
              $yearmonth=$years[0]."-".$month;
              $firstdate=$years[0]."-".$month."-01";

            }

            $insertdata=1;
            $result['receiptData'] = $this->gymswimming->getBotKotDataByCategory($yearmonth,$account,$year,$company);
         


           

               /* Delete data */
              $where_delete = array(
                                    'gym_swimming_kot.accoint_id' => $account,
                                    'gym_swimming_kot.kot_status' => $kot_status,
                                    'gym_swimming_kot.receipt_month' => $month,
                                    'gym_swimming_kot.year_id' => $year,
                                    'gym_swimming_kot.company_id' => $company,
                                 );
               $deletedata = $this->commondatamodel->deleteTableData('gym_swimming_kot',$where_delete);
            
               $module="MINIMUM BILLING KOT";

           

            foreach ($result['receiptData'] as $receiptdata) {
              
              $member_id = $receiptdata->member_id;
              $adm_fees = $receiptdata->adm_fees;

              if ($kot_status=='YEARLY') {
                   $monthdiff = $this->getMonthDifferance($selectMonth);
                   $adm_fees=($adm_fees/$monthdiff);

                $flag=0;
                 for ($i=$monthdiff; $i >= 1; $i--) { 
                  
                        if ($flag==0) {
                            $selectMonth=$selectMonth;
                            $flag++;
                        }else{
                            $selectMonth=$selectMonth+1;    
                        }

                        /* insert data */
                           $kot_no = $this->gymswimming->getSerialNumber($company,$year,$module);
                                     $gym_swimming_kot = array( 
                                          'member_id' => $member_id,
                                          'kot_no' => $kot_no,
                                          'kot_date' => $firstdate,
                                          'kot_amount' => $adm_fees,
                                          'account_id' => $account,
                                          'kot_status' => $kot_status,
                                          'receipt_month' => $month,
                                          'year_id' => $year,
                                          'company_id' => $company,
                                       );

                                    $insertdata = $this->commondatamodel->insertSingleTableData('gym_swimming_kot',$gym_swimming_kot);

                        if ($selectMonth==12) {
                         $selectMonth=0;
                        }

                 }

              }else{
                 $kot_no = $this->gymswimming->getSerialNumber($company,$year,$module);
                              $gym_swimming_kot = array( 
                                          'member_id' => $member_id,
                                          'kot_no' => $kot_no,
                                          'kot_date' => $firstdate,
                                          'kot_amount' => $adm_fees,
                                          'account_id' => $account,
                                          'kot_status' => $kot_status,
                                          'receipt_month' => $month,
                                          'year_id' => $year,
                                          'company_id' => $company,
                                       );

                $insertdata = $this->commondatamodel->insertSingleTableData('gym_swimming_kot',$gym_swimming_kot);

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





public function getMonthDifferance($month){

  $getDifferance=0;

  if($month==4){ $getDifferance=12; }
  else if($month==5) { $getDifferance=11; }
  else if($month==6) { $getDifferance=10; }
  else if($month==7) { $getDifferance=9; }
  else if($month==8) { $getDifferance=8; }
  else if($month==9) { $getDifferance=7;}
  else if($month==10) { $getDifferance=6; }
  else if($month==11) { $getDifferance=5; }
  else if($month==12) { $getDifferance=4; }
  else if($month==1) { $getDifferance=3; }
  else if($month==2) { $getDifferance=2; }
  else if($month==3) { $getDifferance=1; }

    return $getDifferance;




    

}


}  // end of class 