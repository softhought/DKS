<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partyreceipt extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('partyreceiptmodel','partyreceiptmodel',TRUE);
        $this->load->model('companymodel', '', TRUE); 

      
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
          $page = "dashboard/party_receipt/party_receipt_list.php";
        $header="";       
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;
        
        $member_id='All';

        $result['partyReceiptList'] = $this->partyreceiptmodel->getPartyrReceiptList($from_dt,$to_dt,$member_id);
        $result['memberList'] = $this->partyreceiptmodel->getPartyBookingmembere($company,$year);

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
                $partyreceiptID = 0;
                $result['partyreceiptID'] = $partyreceiptID;
                $result['receiptEditdata'] = [];
              
      

            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $partyreceiptID = $this->uri->segment(3);
                $result['partyreceiptID']=$partyreceiptID;
                
                $whereAry = [
                    'project_master.project_id' => $partyreceiptID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['receiptEditdata'] = $this->partyreceiptmodel->getPartyReceiptData($partyreceiptID); 
                //  pre($result['receiptEditdata']);exit;
                 
                
            }

            
              $result['memberCodeList'] = $this->partyreceiptmodel->getPartyBookingmembere($company,$year);
              //$result['memberCodeList'] = $this->partyreceiptmodel->partybookingmembercode();
              //$result['memberCodeList'] = $this->partybillmodel->partybookingmembercode();
              $result['fineAccountList'] = $this->commondatamodel->getAllDropdownData('account_master');
              $result['acTobeDebited'] = $this->commondatamodel->getAllRecordWhere('payment_mode_details',[]);
             
              $result['actobeCreditedList'] = $this->partyreceiptmodel->getActobecredited();




             // pre($result['memberCodeList']);exit;



            $header = "";
            $page = 'dashboard/party_receipt/party_receipt_add_edit';
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }

public function receipt_action() {

       $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   $company=$session['companyid'];
            $year=$session['yearid'];

            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $searcharray);

               

           

            
        $mode = $searcharray['mode'];
        $partyreceiptID = $searcharray['partyreceiptID'];
        $receipt_no = $searcharray['receipt_no'];
        $receipt_dt = $searcharray['receipt_dt'];
        $dr_ac_id = $searcharray['actobedebited'];
        $cr_ac_id = $searcharray['actobecredited'];
        $sel_member_code = $searcharray['sel_member_code'];
        $amount = $searcharray['amount'];
        $service_charges = $searcharray['service_charges'];
        $net_amount = $searcharray['net_amount'];
        $narration = $searcharray['narration'];
        $sel_member_id = $searcharray['sel_member_code'];

        

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

        if ($mode == "ADD" && $partyreceiptID == "0") {

          $serialmodule='PARTY RECEIPT';

          $receipt_no = $this->partyreceiptmodel->getSerialNumber($company,$year,$serialmodule);

            $insert_array_mem = array(
                                    'mem_receipt_no' => $receipt_no,
                                    'receipt_date' => $receipt_dt,
                                    'tran_type' => 'PRTREC',
                                    'member_id' => $sel_member_id,         
                                    'amount' => $amount,
                                    'service_charges' => $service_charges,
                                    'total_amount' => $net_amount,
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
                                    'year_id' => $year,
                                 );
          
           



           $insertData = $this->commondatamodel->insertSingleTableData('member_receipt',$insert_array_mem);


           $activity_description = json_encode($insert_array_mem);
                    $this->insertReceiptActivity($activity_description,NULL,$insertData,"Insert");

               if($insertData)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD",
                            "receipt_id"=>$insertData,
                            'receipt_no'=>$receipt_no
                           
                           

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


            

               $partyreceipt_array_before_upd = $this->partyreceiptmodel->getPartyReceiptData($partyreceiptID); 

                $upd_array_rec= array(
                                   
                                    'receipt_date' => $receipt_dt,
                                    'member_id' => $sel_member_id,         
                                    'amount' => $amount,
                                    'service_charges' => $service_charges,
                                    'total_amount' => $net_amount,
                                    'dr_ac_id' => $dr_ac_id,
                                    'cr_ac_id' => $cr_ac_id,
                                    'bank' => $bank,
                                    'branch' => $branch,
                                    'cheque_no' => $cheque_no,
                                    'cheque_dt' => $cheque_dt,
                                    'narration' => $narration,
                                    
                                 );
          


            
           

         $upd_where = array('member_receipt.receipt_id' => $partyreceiptID );

          $updatedata = $this->commondatamodel->updateSingleTableData('member_receipt',$upd_array_rec,$upd_where);




                    $activity_description = json_encode($upd_array_rec);
                    $old_description = json_encode($partyreceipt_array_before_upd);
                    $this->insertReceiptActivity($activity_description,$old_description,$partyreceiptID,"Update");

                    

            if($updatedata)
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




function insertReceiptActivity($description,$old_description,$table_id,$action){
     $session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'Party Receipt ',
                              "action" => $action,
                              "from_method" => 'partyreceipt/receipt_action',
                              "table_name" => 'member_receipt',
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



  public function getPartyrReceiptListByDate(){

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


         

           $result['partyReceiptList'] = $this->partyreceiptmodel->getPartyrReceiptList($from_dt,$to_dt,$sel_member);

       

         // pre($result['partyBillList']);exit;

         $page = "dashboard/party_receipt/party_receipt_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }


public function addPartyBookingDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
        

             $member_master_id= $this->input->post('sel_member_code');

            

          $data['partyBookingData'] = $this->partyreceiptmodel->getPartyBookingDetails($member_master_id);

        //  pre($result['partyBookingData']);exit;
          
            $page = 'dashboard/party_receipt/party_booking_details_partial_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }

    public function partyreceiptprintJasper()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {     
         
            $file= APPPATH."views/dashboard/reports/party-receipt/PartyReceipt.jrxml";
            
          
            $this->load->library('jasperphp');
            $jasperphp = $this->jasperphp->jasper();
          
            $dbdriver="mysql";
            // $server="localhost";
            // $db="teasamrat";
            // $user="root";
            // $pass="";
            
            $this->load->database();
            $server=$this->db->hostname;
            $user=$this->db->username;
            $pass=$this->db->password;
            $db=$this->db->database;
           
            $companyId = $session['companyid'];
         
            $receptid = $this->uri->segment(3);  
           
             $company=  $this->companymodel->getCompanyNameById($companyId);
             $companylocation=  $this->companymodel->getCompanyAddressById($companyId);  
             $phone =    $this->companymodel->getCompanyById($companyId)->phone; 
            //  pre($phone);exit;       
            // pre($memberid);
            // pre($company);
            // pre($companylocation);exit;
            $image_path =  $_SERVER['DOCUMENT_ROOT'].'/assets/img/report-logo-dks.jpg';
            $printDate=date("d-m-Y");            
             //$jasperphp->debugsql=true;
            $jasperphp->arrayParameter = array('CompanyName'=>$company,'CompanyAddress'=>$companylocation,'receptId'=>"'".$receptid."'",'phone'=> $phone,'image_path'=> $image_path);
            //pre($jasperphp->arrayParameter);exit;
            $jasperphp->load_xml_file($file); 
            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
            $jasperphp->outpage('I','PartyReceipt-'.date('d_m_Y-His').'.pdf');  
             //pre($jasperphp); exit;    
    

            // $page = 'trial_balance/trailWithJasper.php';
            // $this->load->view($page, $result, TRUE);

        } else {
            redirect('login', 'refresh');
        }
    }


} // end of class