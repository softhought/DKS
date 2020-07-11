<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tenniscoachingtoaccounts extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('Tenniscoachingtoaccountsmodel','coachingaccount',TRUE);
        $this->load->model('voucherlistmodel', '', TRUE);

       

    }


public function index()
{

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

        $company=$session['companyid'];
        $year=$session['yearid'];
        $header=""; 

        $where = array('year_id' => $year);
        $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

        $from_dt=$result['accountingyear']->start_date;
        $to_dt=$result['accountingyear']->end_date;
         
        $vdata['from_date']= $from_dt;
        $vdata['to_date']= $to_dt;
        $vdata['ptype']='CB';
        $vdata['accid']=0;

        $result['voucherlist']=$this->voucherlistmodel->getVoucherList($vdata);
        $page = 'dashboard/tennis_coaching_to_accounts/billvoucher_list_view';
                    

        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

    

  }




  public function addBillVoucher(){

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

        $page = "dashboard/tennis_coaching_to_accounts/billvoucher_add_edit";

        $header="";

       createbody_method($result, $page, $header, $session);

    }else{

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
            $quarter_month = $this->input->post('quarter_month');
            $billing_style = $this->input->post('billing_style');
            $year=$session['yearid'];

            $QMonth[1]=6;
            $QMonth[2]=9;
            $QMonth[3]=12;
            $QMonth[4]=3;

            if ($billing_style=='Q') {
                $month=$QMonth[$quarter_month];
            }

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



public function generateBillVoucherAction() {

 $session = $this->session->userdata('user_detail');
 if($this->session->userdata('user_detail'))
    {
           
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);


        $billing_style = $dataArry['billing_style'];
        $month = $dataArry['month'];
        $quarter_month = $dataArry['quarter_month'];
        $year=$session['yearid'];
        $company = $session['companyid'];
        $userid = $session['userid'];

        $voucher_dt = $dataArry['voucher_dt'];

        if($voucher_dt!=""){
                $voucher_dt = str_replace('/', '-', $voucher_dt);
                $voucher_dt = date("Y-m-d",strtotime($voucher_dt)); 
        }else{
                $voucher_dt = NULL;

        }


        $where = array('financialyear.year_id' =>  $year);
        $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
        $years=explode(" ",$result['financialyear']->year);
              
        if ($billing_style=='Q') {

              if ($quarter_month==4) {
                 $vyear=$years[2];
              }else{
                  $vyear=$years[0];
              }

            $where_qtr = array('quarter_month_master.id' =>  $quarter_month);
            $quarterData = $this->commondatamodel->getSingleRowByWhereCls('quarter_month_master',$where_qtr);

       
         $vouchernoK='Q'.strtoupper($quarterData->from_month).strtoupper($quarterData->to_month).'M'.$vyear;
         $vouchernoS='Q'.strtoupper($quarterData->from_month).strtoupper($quarterData->to_month).'T'.$vyear;

         $this->insertIntoVoucher($vouchernoK,$vouchernoS,$billing_style,$month,$quarter_month,$year,$company,$userid,$voucher_dt);

        }else{


             if ($month==1 || $month==2 || $month==3) {
                 $vyear=$years[2];
              }else{
                  $vyear=$years[0];
              }


            $where_month = array('month_master.id' =>  $month);
            $monthData = $this->commondatamodel->getSingleRowByWhereCls('month_master',$where_month);


         $vouchernoK='M'.strtoupper($monthData->short_name).'M'.$vyear;
         $vouchernoS='M'.strtoupper($monthData->short_name).'T'.$vyear;

         $this->insertIntoVoucher($vouchernoK,$vouchernoS,$billing_style,$month,$quarter_month,$year,$company,$userid,$voucher_dt);

        }




            if(1){

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



public function insertIntoVoucher($vouchernoK,$vouchernoS,$billing_style,$month,$quarter_month,$year,$company,$userid,$voucher_dt){


 $miniTannisTotalBill= $this->coachingaccount->TennisBillTotalByCategory('K',$month,$quarter_month,$year,$billing_style,$company)->total_amt;
 $tannisTotalBill=$this->coachingaccount->TennisBillTotalByCategory('S',$month,$quarter_month,$year,$billing_style,$company)->total_amt;


  /* for voucher mini tennis */

        $where_voucherK = array('voucher_master.voucher_no' =>  $vouchernoK);
        $voucherKData = $this->commondatamodel->getSingleRowByWhereCls('voucher_master',$where_voucherK);

        if ($voucherKData) {
            $voucherKID=$voucherKData->id;

            $voucherMast['total_dr_amt'] = $miniTannisTotalBill;  
            $voucherMast['total_cr_amt'] = $miniTannisTotalBill;
            $upd_where = array('voucher_master.id' => $voucherKID);

            $this->commondatamodel->updateSingleTableData('voucher_master',$voucherMast,$upd_where); 


        }else{

               $voucherMast['voucher_no'] = $vouchernoK; 
               $voucherMast['voucher_date'] = $voucher_dt;
               $voucherMast['narration'] = "Invoice No ".$voucherMast['voucher_no']." Date ".date("d-m-Y", strtotime($voucher_dt));
               $voucherMast['tran_type'] = 'CB';                                 
               $voucherMast['user_id'] = $userid;   
               $voucherMast['year_id'] =  $year;       
               $voucherMast['company_id'] = $company;  
               $voucherMast['total_dr_amt'] = $miniTannisTotalBill;  
               $voucherMast['total_cr_amt'] = $miniTannisTotalBill;  

               $voucherKID = $this->commondatamodel->insertSingleTableData('voucher_master',$voucherMast);

        }


        $where_categoryK = array('student_category.start_letter' => 'K');
        $KaccoutData = $this->commondatamodel->getSingleRowByWhereCls('student_category',$where_categoryK);

                       $delete_where = array('voucher_detail.voucher_master_id' =>$voucherKID);
                       $this->commondatamodel->deleteTableData('voucher_detail',$delete_where);
                    
                       $vouchrDtlDr1['voucher_master_id'] = $voucherKID;
                       $vouchrDtlDr1['srl_no'] = 1;
                       $vouchrDtlDr1['tran_tag'] ='Dr' ;
                       $vouchrDtlDr1['account_master_id'] = $KaccoutData->dr_account_id;
                       $vouchrDtlDr1['amount'] = $miniTannisTotalBill;   
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlDr1);

                       $vouchrDtlCr1['voucher_master_id'] = $voucherKID;
                       $vouchrDtlCr1['srl_no'] = 2;
                       $vouchrDtlCr1['tran_tag'] ='Cr' ;
                       $vouchrDtlCr1['account_master_id'] = $KaccoutData->cr_account_id;
                       $vouchrDtlCr1['amount'] = $miniTannisTotalBill;
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCr1);

 

   /* for voucher tennis */   

        $where_voucherS = array('voucher_master.voucher_no' =>  $vouchernoS);
        $voucherSData = $this->commondatamodel->getSingleRowByWhereCls('voucher_master',$where_voucherS);

        if ($voucherSData) {
            $voucherSID=$voucherSData->id;

            $voucherMast2['total_dr_amt'] = $tannisTotalBill;  
            $voucherMast2['total_cr_amt'] = $tannisTotalBill;
            $upd_where2 = array('voucher_master.id' => $voucherSID);

            $this->commondatamodel->updateSingleTableData('voucher_master',$voucherMast2,$upd_where2); 


        }else{

               $voucherMast2['voucher_no'] = $vouchernoS; 
               $voucherMast2['voucher_date'] = $voucher_dt;
               $voucherMast2['narration'] = "Invoice No ".$voucherMast['voucher_no']." Date ".date("d-m-Y", strtotime($voucher_dt));
               $voucherMast2['tran_type'] = 'CB';                                 
               $voucherMast2['user_id'] = $userid;   
               $voucherMast2['year_id'] =  $year;       
               $voucherMast2['company_id'] = $company;  
               $voucherMast2['total_dr_amt'] = $tannisTotalBill;  
               $voucherMast2['total_cr_amt'] = $tannisTotalBill;  

               $voucherSID = $this->commondatamodel->insertSingleTableData('voucher_master',$voucherMast2);

        }


        $where_categoryS = array('student_category.start_letter' => 'S');
        $SaccoutData = $this->commondatamodel->getSingleRowByWhereCls('student_category',$where_categoryS);


                       $delete_where2 = array('voucher_detail.voucher_master_id' =>$voucherSID);
                       $this->commondatamodel->deleteTableData('voucher_detail',$delete_where2);

                       $vouchrDtlDr2['voucher_master_id'] = $voucherSID;
                       $vouchrDtlDr2['srl_no'] = 1;
                       $vouchrDtlDr2['tran_tag'] ='Dr' ;
                       $vouchrDtlDr2['account_master_id'] = $SaccoutData->dr_account_id;
                       $vouchrDtlDr2['amount'] = $tannisTotalBill;   
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlDr2);

                       $vouchrDtlCr3['voucher_master_id'] = $voucherSID;
                       $vouchrDtlCr3['srl_no'] = 2;
                       $vouchrDtlCr3['tran_tag'] ='Cr' ;
                       $vouchrDtlCr3['account_master_id'] = $SaccoutData->cr_account_id;
                       $vouchrDtlCr3['amount'] = $tannisTotalBill;
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCr3);




}


} // end of class