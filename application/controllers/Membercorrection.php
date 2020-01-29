<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membercorrection extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('membercorrectionentrymodel','correctionentrymodel',TRUE);
         
       
    }

public function index(){

        $session = $this->session->userdata('user_detail');
    	if($this->session->userdata('user_detail'))
    	{  
            $page = "dashboard/member-correction/member_correction_list";
            $header="";  
            $company=$session['companyid'];
            $year=$session['yearid'];

            $where = array('year_id' => $year);
            $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

             $from_dt=$result['accountingyear']->start_date;
             $to_dt=$result['accountingyear']->end_date;

            $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
            $result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
         
           //  $entry_module='All';
           $member_id='All';

           $result['correctionTranList'] = $this->correctionentrymodel->getcorrectionTransactionList($from_dt,$to_dt, $member_id);
       // pre($result['facilityTranList']); exit;    
            createbody_method($result, $page, $header, $session);
        }else{
            redirect('login','refresh');
        }
        
    }

public function addmembercorrection(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['cortranId'] = 0;
        $result['cortransactionEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['cortranId'] = $this->uri->segment(3);

          $result['cortransactionEditdata'] = $this->correctionentrymodel->getCorrectionDetailsByTranId($result['cortranId']);
           

       } 

     // pre( $result['cortransactionEditdata']);exit;
    
        $result['parameterData'] = $this->correctionentrymodel->getcorrectionDataByEntryModule("COR");

         $result['descriptiondtl'] = $this->commondatamodel->getAllRecordWhere('member_correction_description_master',[]);


        $page = "dashboard/member-correction/addedit_member_correction";
        $header="";

     
                
        $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
        
       // pre($result['transactionEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

public function correctionentry_action(){

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
          $cortranId = trim(htmlspecialchars($dataArry['cortranId']));
         
          $correction_dt = $dataArry['correction_dt'];
          if($correction_dt!=""){
              $correctiondt = str_replace('/', '-', $correction_dt);
              $correction_dt = date("Y-m-d",strtotime($correctiondt)); 
           }
           else{
               $correction_dt = NULL;
           }
            
            $sel_member_id = trim(htmlspecialchars($dataArry['sel_member_id']));
           
           
            $amount = trim(htmlspecialchars($dataArry['amount']));
            $cgst_id = trim(htmlspecialchars($dataArry['cgst_id']));
            $sgst_id = trim(htmlspecialchars($dataArry['sgst_id']));
            $cgst_amt = trim(htmlspecialchars($dataArry['cgst_amt']));
            $sgst_amt = trim(htmlspecialchars($dataArry['sgst_amt']));
            $net_amt = trim(htmlspecialchars($dataArry['net_amt']));
            $remarks = trim(htmlspecialchars($dataArry['remarks']));
            $description = trim(htmlspecialchars($dataArry['description']));

            if($cortranId>0 && $mode=="EDIT")
              {
                  /*  EDIT MODE
                   *  -----------------
                  */
               $old_details = $this->correctionentrymodel->getCorrectionDetailsByTranId($cortranId);
               $correction_data_update = array(
                                               
                                        'tran_date' => $correction_dt,       
                                        'member_id' => $sel_member_id,       
                                        'taxable' => $amount,
                                        'cgst_id' => $cgst_id,       
                                        'cgst_amt' => $cgst_amt,       
                                        'sgst_id' => $sgst_id,       
                                        'sgst_amt' => $sgst_amt,       
                                        'total_amount' => $net_amt, 
                                        'desc_master_id' => $description, 
                                        'remarks' => $remarks, 
                                        'last_modify'=>date('Y-m-d')        
                                               
                                    );

                   $upd_where = array('member_correction_transaction.mem_cor_id' => $cortranId);

                   $update = $this->commondatamodel->updateSingleTableData('member_correction_transaction',$correction_data_update,$upd_where);

                   
                  $activity_description = json_encode($correction_data_update);
                  $old_description = json_encode($old_details);
                  $this->insertActivity($activity_description,$old_description,$cortranId,"Update");

                  
                  
                  if($update)
                  {
                      $json_response = array(
                          "msg_status" => 1,
                          "msg_data" => "Updated successfully",
                          "mode" => "EDIT"
                      );
                  }
                  else
                  {
                      $json_response = array(
                          "msg_status" => 0,
                          "msg_data" => "There is some problem while updating ...Please try again."
                      );
                  }



              } // end if mode
              else
              {
                  /*  ADD MODE
                   *  -----------------
                  */

              $tran_no=$this->correctionentrymodel->getTranNumber($company,$year);
            
              $correction_data = array(
                                           
                                        'cor_tran_no' => $tran_no,       
                                        'tran_date' => $correction_dt,       
                                        'member_id' => $sel_member_id,       
                                        'taxable' => $amount,
                                        'cgst_id' => $cgst_id,       
                                        'cgst_amt' => $cgst_amt,       
                                        'sgst_id' => $sgst_id,       
                                        'sgst_amt' => $sgst_amt,       
                                        'total_amount' => $net_amt, 
                                        'desc_master_id' => $description, 
                                        'remarks' => $remarks, 
                                        'year_id' => $year,       
                                        'company_id' => $company,          
                                        'created_on' => date('Y-m-d'),
                                        'last_modify'=>date('Y-m-d')       
                                       );

                                          
               $insertData = $this->commondatamodel->insertSingleTableData('member_correction_transaction',$correction_data);

                  $activity_description = json_encode($correction_data);
                  $this->insertActivity($activity_description,NULL,$insertData,"Insert");

                  if($insertData)
                  {
                      $json_response = array(
                          "msg_status" => 1,
                          "msg_data" => "Saved successfully",
                          "mode" => "ADD"
                      );
                  }
                  else
                  {
                      $json_response = array(
                          "msg_status" => 1,
                          "msg_data" => "There is some problem.Try again"
                      );
                  }

              } // end add mode ELSE PART
    

     

      header('Content-Type: application/json');
      echo json_encode( $json_response );
      exit; 


       }else{
          redirect('login','refresh');
      }   

}

public function getCorrectionListByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $sel_member = $this->input->post('sel_member');
           
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

           $result['correctionTranList'] = $this->correctionentrymodel->getcorrectionTransactionList($from_dt,$to_dt, $sel_member);
         $page = "dashboard/member-correction/member_correction_partial_list_view"; 

          $this->load->view($page,$result);

         

        }else{
            redirect('login','refresh');
        } 

    }




function insertActivity($description,$old_description,$table_id,$action){
    $session = $this->session->userdata('user_detail');
        $user_activity = array(
                                  "activity_module" => 'Member Correction Entry ',
                                  "action" => $action,
                                  "from_method" => 'membercorrection/correctionentry_action',
                                  "table_name" => 'member_correction_transaction',
                                  "module_master_id" => $table_id,
                                  "user_id" => $session['userid'],
                                  "ip_address" => getUserIPAddress(),
                                  "user_browser" => getUserBrowserName(),
                                  "user_platform" => getUserPlatform(),
                                  "description" =>  $description,
                                  "old_description" =>  $old_description,
                                  'ip_address'=>getUserIPAddress()
                                 );
                                 
         $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
    
    
    
    }


}