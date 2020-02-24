<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class memberreceipt extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberreceiptmodel','memberreceiptmodel',TRUE);
        $this->load->model('Paymenttennismodel','payment_tennis_model',TRUE);   
      
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
          $page = "dashboard/member_receipt/member_receipt_list.php";
        $header="";       
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;
        $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
        $result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
        $member_id='All';

        $result['memberReceiptList'] = $this->memberreceiptmodel->getMemberReceiptList($from_dt,$to_dt,$member_id);

       // pre($result['memberReceiptList'] );exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}



    public function addReceipt(){
        
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
                $memberreceiptID = 0;
                $result['memberreceiptID'] = $memberreceiptID;
                $result['receiptEditdata'] = [];
              
      

                 //gst rate
                    $result['cgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='CGST',$usedfor='O');
                    $result['sgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='SGST',$usedfor='O');
                
                //pre($result['memberCodeList']);exit;
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $memberreceiptID = $this->uri->segment(3);
                $result['memberreceiptID']=$memberreceiptID;
                
                $whereAry = [
                    'project_master.project_id' => $memberreceiptID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['receiptEditdata'] = $this->memberreceiptmodel->getMemberReceiptData($memberreceiptID); 
                 // pre($result['receiptEditdata']);exit;
                 
                
            }

            
              $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
              $result['categoryList'] = $this->commondatamodel->getAllRecordWhere('member_catogary_master',[]);
            
              $result['fineAccountList'] = $this->commondatamodel->getAllDropdownData('account_master');

              $result['acTobeDebited'] = $this->commondatamodel->getAllRecordWhere('payment_mode_details',[]);
              $result['actobeCreditedList'] = $this->payment_tennis_model->getAcToBeCredited($company);

            $header = "";
            $page = 'dashboard/member_receipt/member_receipt_add_edit.php';
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }






       public function generateCode() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();

           $firstname = $this->input->post('firstname');
           $lastname = $this->input->post('lastname');
           $member_category = $this->input->post('member_category');



           $where_category= array('member_catogary_master.cat_id' => $member_category);
           $startLetters = $this->commondatamodel->getSingleRowByWhereCls('member_catogary_master',$where_category)->member_tag;
           
          
            $firstCharacterLastName = strtoupper($lastname[0]);
            $startcCode=$startLetters.$firstCharacterLastName;

            $LastserialData=$this->memberreceiptmodel->getNewCodeSerial($startLetters,$member_category);

          
          
            if ($LastserialData) {
               $lastSerial=intval($LastserialData->last_serial);
            }else{
              $lastSerial=0;  
            }


         $nextSerial=$lastSerial+1;

         $digit = strlen($nextSerial); 

         if($digit==2){
            $serialno = "0".$nextSerial;
         }
          elseif($digit==1){
            $serialno = "00".$nextSerial;
         }else{
             $serialno = $nextSerial;
         }

         

         $newCode=$startcCode.'-'.$serialno;


           $insert_array = array(
                                    'member_code' =>  $newCode,
                                    'member_name' => $firstname." ".$lastname,
                                    'status' => 'ACTIVE STUDENT',
                                 
                     );
            
            
        // $insertData = $this->commondatamodel->insertSingleTableData('member_master',$insert_array);




         $json_response = array(
                            "new_code" => $newCode, 
                           // "member_id" => $insertData 
                          );

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


           
            

        }else
        {
            redirect('login','refresh');
        }


     }  


 public function resetMemberCodeList()
  {
      if($this->session->userdata('user_detail'))
      { 

       $memberid = $this->input->post('memberid');

      
                
           $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);

          // pre($result['memberCodeList']);

        ?>
         <select class="form-control select2" name="sel_member_code" id="sel_member_code" >
                        
                            <?php 

                         foreach ($result['memberCodeList'] as  $membercode) { ?>
                          <option value="<?php echo $membercode->member_id;?>"
                               data-name="<?php echo $membercode->title_one." ".$membercode->member_name; ?>"
                          <?php
                         if ($memberid==$membercode->member_id) {
                           echo "selected";
                         }
                         ?>

                          ><?php echo $membercode->member_code;?></option>
                          <?php     } ?>
                                          
                                                   
         </select> 
        <?php

      }
      else
      {
          redirect('login','refresh');
      }
  } 



     public function saveMemberReceiptData() {

       $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   $company=$session['companyid'];
            $year=$session['yearid'];

            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $searcharray);

            
        $mode = $searcharray['mode'];
        $memberreceiptID = $searcharray['memberreceiptID'];
        $tran_type = $searcharray['tran_type'];
        $sel_member_id = $searcharray['sel_member_code'];
        $receipt_dt = $searcharray['receipt_dt'];

        $amount = $searcharray['amount'];
        $adm_fees = $searcharray['adm_fees'];
        $sub_coach_fees = $searcharray['sub_coach_fees'];
        $service_tax = $searcharray['service_tax'];
        $total_amount = $searcharray['total_amount'];
        $dr_ac_id = $searcharray['actobedebited'];
        $cr_ac_id = $searcharray['actobecredited'];
        $narration = $searcharray['narration'];
        $sel_member_category = $searcharray['sel_member_category'];

        $bank = $searcharray['bank'];
        $branch = $searcharray['branch'];
        $cheque_no = $searcharray['cheque_no'];
        $cheque_dt = $searcharray['cheque_dt'];




        if($receipt_dt!=""){
                $receipt_dt = str_replace('/', '-', $receipt_dt);
                $receipt_dt = date("Y-m-d",strtotime($receipt_dt)); 
        }
             else{
                 $receipt_dt = NULL;
                
         }


         if($cheque_dt!=""){
                $cheque_dt = str_replace('/', '-', $cheque_dt);
                $cheque_dt = date("Y-m-d",strtotime($cheque_dt)); 
        }
             else{
                 $cheque_dt = NULL;
                
         }

        //pre($searcharray);exit;

        if ($mode == "ADD" && $memberreceiptID == "0") {

           if ($tran_type=='ORADM') {
                 $serialmodule='MEMBER ADMISSION RECEIPT';
               }else{
                 $serialmodule='MEMBER OTHER RECEIPT';
               }

          $receipt_no = $this->memberreceiptmodel->getSerialNumber($company,$year,$serialmodule);

       


          if ($tran_type=='ORADM') {

             $newCode = $searcharray['new_member_code'];
             $firstname = strtoupper($searcharray['first_name']);
             $lastname = strtoupper($searcharray['last_name']);

             $insert_array = array(
                                    'member_code' =>  $newCode,
                                    'member_name' => $firstname." ".$lastname,
                                    'status' => 'ACTIVE STUDENT',
                                 
                     );     
             $sel_member_id = $this->commondatamodel->insertSingleTableData('member_master',$insert_array);


              
              $adm_fees = $searcharray['adm_fees'];
              $sub_coach_fees = $searcharray['sub_coach_fees'];
              $service_tax = $searcharray['service_tax'];
              $final_amount = $searcharray['total_amount'];





          }else{
                     $adm_fees = NULL;
                     $sub_coach_fees = NULL;
                     $service_tax = $searcharray['service_tax'];
                     $final_amount = $searcharray['amount'];

          }

            $insert_array_mem = array(
                                    'mem_receipt_no' => $receipt_no,
                                    'receipt_date' => $receipt_dt,
                                    'tran_type' => $tran_type,
                                    'member_id' => $sel_member_id,
                                    'adm_fees' => $adm_fees,
                                    'sub_coach_fees' => $sub_coach_fees,
                                    'service_tax' => $service_tax,
                                    'total_amount' => $final_amount,
                                    'dr_ac_id' => $dr_ac_id,
                                    'cr_ac_id' => $cr_ac_id,
                                    'bank' => $bank,
                                    'branch' => $branch,
                                    'cheque_no' => $cheque_no,
                                    'cheque_dt' => $cheque_dt,
                                    'narration' => $narration,
                                    'member_category' => $sel_member_category,
                                    'created_on' => date('Y-m-d'),
                                    'user_id' => $session['userid'],
                                    'company_id' => $company,
                                    'year_id' => $year,
                                 );
          
           



           $insertData = $this->commondatamodel->insertSingleTableData('member_receipt',$insert_array_mem);

           $activity_description = json_encode($insert_array_mem);
                    $this->insertMemberReceiptActivity($activity_description,NULL,$insertData,"Insert");

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

        } else {


              $memreceipt_array_before_upd = $this->memberreceiptmodel->getMemberReceiptData($memberreceiptID); 


             if ($tran_type=='ORADM') {


                    $adm_fees = $searcharray['adm_fees'];
                    $sub_coach_fees = $searcharray['sub_coach_fees'];
                    $service_tax = $searcharray['service_tax'];
                    $final_amount = $searcharray['total_amount'];

                   $upd_array_mem = array(
                                    'receipt_date' => $receipt_dt,
                                    'adm_fees' => $adm_fees,
                                    'sub_coach_fees' => $sub_coach_fees,
                                    'service_tax' => $service_tax,
                                    'total_amount' => $final_amount,
                                    'dr_ac_id' => $dr_ac_id,
                                    'cr_ac_id' => $cr_ac_id,
                                    'bank' => $bank,
                                    'branch' => $branch,
                                    'cheque_no' => $cheque_no,
                                    'cheque_dt' => $cheque_dt,
                                    'narration' => $narration,
                                    'created_on' => date('Y-m-d'),
                                    'user_id' => $session['userid'],
                                    'company_id' => $company,
                                 );

                 }else{

                           $adm_fees = NULL;
                           $sub_coach_fees = NULL;
                           $service_tax = $searcharray['service_tax'];
                           $final_amount = $searcharray['amount'];


                          $upd_array_mem = array(
                                  
                                    'receipt_date' => $receipt_dt,
                                    'tran_type' => $tran_type,
                                    'member_id' => $sel_member_id,
                                    'adm_fees' => $adm_fees,
                                    'sub_coach_fees' => $sub_coach_fees,
                                    'service_tax' => $service_tax,
                                    'total_amount' => $final_amount,
                                    'dr_ac_id' => $dr_ac_id,
                                    'cr_ac_id' => $cr_ac_id,
                                    'bank' => $bank,
                                    'branch' => $branch,
                                    'cheque_no' => $cheque_no,
                                    'cheque_dt' => $cheque_dt,
                                    'narration' => $narration,
                                    'created_on' => date('Y-m-d'),
                                    'user_id' => $session['userid'],
                                    'company_id' => $company,
                                 );
          






                 }
          
           

         $upd_where = array('member_receipt.receipt_id' => $memberreceiptID );

          $updatedata = $this->commondatamodel->updateSingleTableData('member_receipt',$upd_array_mem,$upd_where);




                    $activity_description = json_encode($upd_array_mem);
                    $old_description = json_encode($memreceipt_array_before_upd);
                    $this->insertMemberReceiptActivity($activity_description,$old_description,$memberreceiptID,"Update");

                    

            if($updatedata)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Updated successfully",
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


          
        }



            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


          }else{

             redirect('login','refresh');

          }


    }// end of saveTennisPaymentData


  public function getMemberReceiptListByDate(){

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


         $result['memberReceiptList'] = $this->memberreceiptmodel->getMemberReceiptList($from_dt,$to_dt,$sel_member);

       

         // pre($result['partyBillList']);exit;

         $page = "dashboard/member_receipt/member_receipt_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }




function insertMemberReceiptActivity($description,$old_description,$table_id,$action){
     $session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'Member Receipt ',
                              "action" => $action,
                              "from_method" => 'memberreceipt/member_receipt',
                              "table_name" => 'fixed_hard_court_transaction',
                              "module_master_id" => $table_id,
                              "user_id" => $session['userid'],
                              "ip_address" => getUserIPAddress(),
                              "user_browser" => getUserBrowserName(),
                              "user_platform" => getUserPlatform(),
                              "description" =>  $description,
                              "old_description" =>  $old_description
                             );
                             
                $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);



}





}// end of class
