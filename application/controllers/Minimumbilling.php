<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minimumbilling extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberbillmodel','memberbillmodel',TRUE);
        $this->load->model('minimumbillingmodel','minimumbillingmodel',TRUE); 
        set_time_limit(1200); 
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



public function addMinimumBill(){

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


        $where_month = array('month_master.is_min_bill' => 'Y' );
        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',$where_month,$orderby);;

       // pre($result['minbillMonth']);exit;


        $page = "dashboard/minimum_billing/minimum_billing_add_edit";
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


        $month = $dataArry['month'];
        $year=$session['yearid'];
        $company = $session['companyid'];

        $where = array('financialyear.year_id' =>  $year);
        $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
        $years=explode(" ",$result['financialyear']->year);


        if ($month==3) {

        $Yearmonth[3]['first']=$years[2]."-01";
        $Yearmonth[3]['second']=$years[2]."-02";
        $Yearmonth[3]['third']=$years[2]."-03";    

        }else{

        $Yearmonth[6]['first']=$years[0]."-04";
        $Yearmonth[6]['second']=$years[0]."-05";
        $Yearmonth[6]['third']=$years[0]."-06";


        $Yearmonth[9]['first']=$years[0]."-07";
        $Yearmonth[9]['second']=$years[0]."-08";
        $Yearmonth[9]['third']=$years[0]."-09";


        $Yearmonth[12]['first']=$years[0]."-10";
        $Yearmonth[12]['second']=$years[0]."-11";
        $Yearmonth[12]['third']=$years[0]."-12";

         }

        
         $Yearmonth[$month]['first'];
         $Yearmonth[$month]['third'];

         $result['memberlist'] = $this->minimumbillingmodel->getAllActiveMembercode();




        $entry_module='MINBILL';
        $result['gstRate'] = $this->minimumbillingmodel->getFacilityDataByEntryModule($entry_module);
      


        // $member_id=20;


             $delete_where = array(
                              
                                'club_usages.month_id' => $month,
                                'club_usages.year_id' => $year,
                                'club_usages.company_id' => $company,
                             );


        $deleteData = $this->commondatamodel->deleteTableData('club_usages',$delete_where);

       

        foreach ($result['memberlist'] as $memberlist) {
           
        $member_id=$memberlist->member_id;
        $min_ceiling=$memberlist->min_ceiling;
        $correction=0;
        $correctionData= $this->correctionAmount($member_id,$Yearmonth[$month]['first'],$Yearmonth[$month]['third'],$year,$company);
        $correction = $correctionData->taxable_total; 

     


         /* ------------------------------------------------------------------------- */

         $quarterlyConsumption = $this->minimumbillingmodel->getMemberQuarterlyConsumption($member_id,$Yearmonth[$month]['first'],$Yearmonth[$month]['third']);

         
         $total_consumption=($quarterlyConsumption->tot_bar_amount+$quarterlyConsumption->tot_cat_amount+$quarterlyConsumption->tot_swimming+$quarterlyConsumption->tot_gym+$quarterlyConsumption->tot_locker_charge+$quarterlyConsumption->tot_hard_court_extra+$quarterlyConsumption->tot_guest_charge+$quarterlyConsumption->tot_towel_charge+$quarterlyConsumption->tot_ben_fund+$quarterlyConsumption->tot_fixed_hard+$quarterlyConsumption->tot_card_play+$quarterlyConsumption->tot_development_charge+$quarterlyConsumption->tot_puja_contribution+$quarterlyConsumption->tot_puja_contribution)+$correction;



         if ($total_consumption > $min_ceiling) {
             $club_useges_inst = array(
                                    'member_id' => $member_id, 
                                    'month_id' => $month, 
                                    'club_usages' => $total_consumption, 
                                    'short_fall' => 0, 
                                    'cgst_id' => 0, 
                                    'sgst_id' => 0, 
                                    'cgst_amt' => 0, 
                                    'sgst_amt' => 0, 
                                    'year_id' => $year, 
                                    'company_id' => $company, 
                                  );
         }else{


            $short_fall=($min_ceiling-$total_consumption);
            $cgst_amt=($short_fall*$result['gstRate']->cgst_rate)/100;
            $sgst_amt=($short_fall*$result['gstRate']->sgst_rate)/100;
            
             $club_useges_inst = array(
                                    'member_id' => $member_id, 
                                    'month_id' => $month, 
                                    'club_usages' => $total_consumption, 
                                    'short_fall' => $short_fall, 
                                    'cgst_id' => $result['gstRate']->cgst_id, 
                                    'sgst_id' => $result['gstRate']->sgst_id, 
                                    'cgst_amt' => $cgst_amt, 
                                    'sgst_amt' => $sgst_amt,
                                    'year_id' => $year, 
                                    'company_id' => $company, 
                                  );

         }

        
       $insertdata = $this->commondatamodel->insertSingleTableData('club_usages',$club_useges_inst);

       
         /* ------------------------------------------------------------------------- */



            
         } /* end of member foreach  */





      


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


public function correctionAmount($member_id,$startyearmonth,$endyearmonth,$year_id,$company_id){

 return $correctionData = $this->minimumbillingmodel->getCorrectionAmount($member_id,$startyearmonth,$endyearmonth,$year_id,$company_id);

  

}



}// end of class
