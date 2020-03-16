<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partybillentry extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');      
        $this->load->model('companymodel', '', TRUE);   
        $this->load->model('partybillentrymodel','partybillentrymodel',TRUE);
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/party/party-bill-entry/partybillentry_list.php";
        $header="";  
        $company=$session['companyid'];
        $year=$session['yearid'];      
       
        $result['partybillentrylist'] = $this->partybillentrymodel->getallcreditorsbill();
       //pre($result['partybillentrylist']);exit;
       // pre($result['billList']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addPartyBillEntry(){
        
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {   
        $company=$session['companyid'];
        $year=$session['yearid'];
        if($this->uri->rsegment(3) == NULL)
        {
            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['btnTextLoader'] = "Saving...";           
            $result['partybillID'] =0;
            $result['partybillentryEditdata'] = []; 
          
           
        
        }
        else
        {
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['partybillID'] = $this->uri->segment(3);                   
            //pre($result['partybillID']);exit;
            
            // getSingleRowByWhereCls(tablename,where params)
             $result['partybillentryEditdata'] = $this->partybillentrymodel->getcreditorsbillByid($result['partybillID']);           
            // pre($result['partybillentryEditdata']);exit;
            
        }

        $result['venderlist'] = $this->commondatamodel->getAllRecordOrderBy('vendor_master','vendor_name','asc');
        $result['accountlist'] = $this->commondatamodel->getAllRecordOrderBy('account_master','account_name','asc');

               // pre($result['actobeCreditedList']);exit;

        $header = "";
        $page = 'dashboard/party/party-bill-entry/addpartyentry.php';
        createbody_method($result, $page, $header,$session);
    }
    else
    {
        redirect('login','refresh');
    }
    
}

public function checkbillno(){
        
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

        $bill_no = $this->input->post('bill_no');
        $vender_account_id = $this->input->post('vender_account_id');
        $year = $session['yearid'];

        $where = array('bill_no'=>$bill_no,'party_id'=>$vender_account_id,'year_id'=>$year);

        $existing = $this->commondatamodel->getSingleRowByWhereCls('creditores_bill',$where);

        if(!empty($existing)){
              
            $json_response = array(
                "msg_status" => 1,
                "msg_data" => "Existing data"
            );
        }else{
            $json_response = array(
                "msg_status" => 0,
                "msg_data" => "No Existing data"
            );
        }
       

       

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit;
    }else{
        redirect('login','refresh');
    }

}

public function partybillentry_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

          $company=$session['companyid'];
          $year=$session['yearid'];
          $mode = trim(htmlspecialchars($dataArry['mode']));         
          $partybillID = trim(htmlspecialchars($dataArry['partybillID']));         
          $bill_no = trim(htmlspecialchars($dataArry['bill_no']));         
         
            
          if(trim($dataArry['bill_date']) != ''){

            $bill_date = str_replace('/', '-', trim($dataArry['bill_date']));
            $bill_dt =  date('Y-m-d',strtotime($bill_date));
        }else{
            $bill_dt = NULL;
        }   
        
        $voucher_no = trim(htmlspecialchars($dataArry['voucher_no']));
        $vender_account_id = trim(htmlspecialchars($dataArry['vender_account_id']));
        $bill_amount = trim(htmlspecialchars($dataArry['bill_amount']));
        $account_id = trim(htmlspecialchars($dataArry['account_id']));
        $narration = 'Being Credit Purchase';
       
          //pre($data);exit;
          if($mode == 'ADD' &&  $partybillID == 0){
                 
          $serialmodule='PARTY BILL ENTRY'; 
          $voucher_no = $this->partybillentrymodel->getSerialNumber($company,$year,$serialmodule);          
         
               $voucherMast['voucher_no'] = $voucher_no; 
               $voucherMast['voucher_date'] = $bill_dt;
               $voucherMast['narration'] = $narration; 
               $voucherMast['cheque_no'] =NULL;         
               $voucherMast['cheque_date'] =NULL;        
               $voucherMast['bank_name'] = NULL;        
               $voucherMast['bank_branch'] = NULL;          
               $voucherMast['tran_type'] = 'PR';         
               $voucherMast['user_id'] = $session['userid'];   
               $voucherMast['year_id'] =  $year;       
               $voucherMast['company_id'] = $company;         
               $voucherMast['total_dr_amt'] = $bill_amount;         
               $voucherMast['total_cr_amt'] = $bill_amount; 
            
               $vMastId = $this->commondatamodel->insertSingleTableData('voucher_master',$voucherMast);

               $vouchrDtlCus['voucher_master_id'] = $vMastId;
               $vouchrDtlCus['srl_no'] = 1;
               $vouchrDtlCus['tran_tag'] ='Cr' ;
               $vouchrDtlCus['account_master_id'] = $vender_account_id;
               $vouchrDtlCus['amount'] = $bill_amount;
 
               $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);

               $vouchrDtlCus['srl_no'] = 2;
               $vouchrDtlCus['tran_tag'] ='Dr';
               $vouchrDtlCus['account_master_id'] = $account_id;

               $insert_dtl_2= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
     
               $insertcreditors = array(
                                         'bill_no'=>$bill_no,
                                         'bill_date'=>$bill_dt,
                                         'party_id'=>$vender_account_id,
                                         'bill_amount'=>$bill_amount,
                                         'voucher_master_id'=>$vMastId,
                                         'debit_account_id'=>$account_id,
                                         'company_id'=>$company,
                                         'year_id'=>$year,
                                         'created_on'=>date('Y-m-d')
                                    );

            $insert_creditorsbill= $this->commondatamodel->insertSingleTableData('creditores_bill',$insertcreditors);

            $activity_module='Party Bill Entry';
            $action = 'Insert';
            $method='partybillentry_action'; 
            $master_id =$insert_creditorsbill;
            $tablename = 'creditores_bill';
            $old_description ='';
            $description = json_encode($insertcreditors);
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);
            if($insert_creditorsbill){

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

            $where = array('creditores_bill.bill_id'=>$partybillID);
            $olddetails = $this->commondatamodel->getSingleRowByWhereCls('creditores_bill',$where);  
           
            $where_voucher = array('id'=>$olddetails->voucher_master_id);
           
            $voucherMast['voucher_date'] = $bill_dt;
            $voucherMast['total_dr_amt'] = $bill_amount;         
            $voucherMast['total_cr_amt'] = $bill_amount; 

            $upd_voucher = $this->commondatamodel->updateSingleTableData('voucher_master',$voucherMast,$where_voucher);

            $voucher_dtlwhere = array('voucher_master_id'=>$olddetails->voucher_master_id,'tran_tag'=>'Cr');
            $vouchrDtlCus['account_master_id'] = $vender_account_id;
            $vouchrDtlCus['amount'] = $bill_amount;

            $upd_voucher_dtl1 = $this->commondatamodel->updateSingleTableData('voucher_detail',$vouchrDtlCus,$voucher_dtlwhere);

            $voucher_dtlwhere = array('voucher_master_id'=>$olddetails->voucher_master_id,'tran_tag'=>'Dr');
            $vouchrDtlCus2['account_master_id'] = $account_id;
            $vouchrDtlCus2['amount'] = $bill_amount;

            $upd_voucher_dtl2 = $this->commondatamodel->updateSingleTableData('voucher_detail',$vouchrDtlCus2,$voucher_dtlwhere);

            
            $uptcreditors = array(
                                    'bill_no'=>$bill_no,
                                    'bill_date'=>$bill_dt,
                                    'party_id'=>$vender_account_id,
                                    'bill_amount'=>$bill_amount,                                    
                                    'debit_account_id'=>$account_id                
                                   );

           $upd_creditors = $this->commondatamodel->updateSingleTableData('creditores_bill',$uptcreditors,$where);

            $activity_module='Party Bill Entry';
            $action = 'Update';
            $method='partybillentry_action'; 
            $master_id =$partybillID;
            $tablename = 'creditores_bill';
            $old_description =json_encode($olddetails);
            $description = json_encode($uptcreditors);
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

                if($upd_creditors){

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