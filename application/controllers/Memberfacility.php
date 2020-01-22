<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memberfacility extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('memberfacilitymodel','memberfacilitymodel',TRUE);
        
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/member_facility/tennis_item_list_view";
        $header="";  
     exit;
        
        $result['tennisitemlist'] = $this->commondatamodel->getAllRecordOrderBy('tennis_item_master','item_id','desc');
        //pre($result['tennisitemlist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
 }

public function facilitylist()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

        $company=$session['companyid'];
        $year=$session['yearid'];
        $page = "dashboard/member_facility/member_facility_list";
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

  public function addFacility(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        /*
            segnent(3)=facility parameter:
            segment(4)=add edit id
    
        */
       if($this->uri->segment(4) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['entry_module'] = $this->uri->segment(3);
        $result['tranId'] = 0;
        $result['transactionEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['entry_module'] = $this->uri->segment(3);
          $result['tranId'] = $this->uri->segment(4);

          $result['transactionEditdata'] = $this->memberfacilitymodel->getFactlityDetailsByTranId($result['tranId']);
           

       } 

    
        $result['parameterData'] = $this->memberfacilitymodel->getFacilityDataByEntryModule($result['entry_module']);

        $page = "dashboard/member_facility/member_facility_add_edit_view";
        $header="";

     
                
        $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
        
       // pre($result['transactionEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}


public function facility_action(){

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
            $tranId = trim(htmlspecialchars($dataArry['tranId']));
            $entry_module = trim(htmlspecialchars($dataArry['entry_module']));
            $tran_dt = $dataArry['tran_dt'];
            if($tran_dt!=""){
                $tran_dt = str_replace('/', '-', $tran_dt);
                $tran_dt = date("Y-m-d",strtotime($tran_dt)); 
             }
             else{
                 $tran_dt = NULL;
             }
              $parameter_id = trim(htmlspecialchars($dataArry['parameter_id']));
              $sel_member_code = trim(htmlspecialchars($dataArry['sel_member_code']));
              $quantity = trim(htmlspecialchars($dataArry['quantity']));
              $rate = trim(htmlspecialchars($dataArry['rate']));
              $guest_amt = trim(htmlspecialchars($dataArry['guest_amt']));
              $taxable_amt = trim(htmlspecialchars($dataArry['taxable_amt']));
              $cgst_id = trim(htmlspecialchars($dataArry['cgst_id']));
              $sgst_id = trim(htmlspecialchars($dataArry['sgst_id']));
              $cgst_amt = trim(htmlspecialchars($dataArry['cgst_amt']));
              $sgst_amt = trim(htmlspecialchars($dataArry['sgst_amt']));
              $net_amt = trim(htmlspecialchars($dataArry['net_amt']));

              if($tranId>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                 $facility_array_before_upd= $this->memberfacilitymodel->getFactlityDetailsByTranId($tranId);
                      $facility_array_upd = array(     
                                          'tran_dt' => $tran_dt,       
                                          'member_id' => $sel_member_code,       
                                          'quantity' => $quantity,       
                                          'rate' => $rate,       
                                          'guest_charge' => $guest_amt,       
                                          'taxable' => $taxable_amt,       
                                          'cgst_id' => $cgst_id,       
                                          'cgst_amt' => $cgst_amt,       
                                          'sgst_id' => $sgst_id,       
                                          'sgst_amt' => $sgst_amt,       
                                          'total_amount' => $net_amt,       
                                          'last_modified' => date('Y-m-d'),       
                                         );

                     $upd_where = array('member_facility_transaction.transaction_id' => $tranId);

                     $update = $this->commondatamodel->updateSingleTableData('member_facility_transaction',$facility_array_upd,$upd_where);

                     
                    $activity_description = json_encode($facility_array_upd);
                    $old_description = json_encode($facility_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$tranId,"Update");

                    
                    
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

                $tran_no=$this->memberfacilitymodel->getTranNumber($company,$year,$entry_module);
              
                $facility_array = array(
                                          'parameter_mst_id' => $parameter_id,       
                                          'tran_no' => $tran_no,       
                                          'tran_dt' => $tran_dt,       
                                          'member_id' => $sel_member_code,       
                                          'quantity' => $quantity,       
                                          'rate' => $rate,       
                                          'guest_charge' => $guest_amt,       
                                          'taxable' => $taxable_amt,       
                                          'cgst_id' => $cgst_id,       
                                          'cgst_amt' => $cgst_amt,       
                                          'sgst_id' => $sgst_id,       
                                          'sgst_amt' => $sgst_amt,       
                                          'total_amount' => $net_amt,       
                                          'created_on' => date('Y-m-d'),       
                                         );

                 $insertData = $this->commondatamodel->insertSingleTableData('member_facility_transaction',$facility_array);

                    $activity_description = json_encode($facility_array);
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


    public function getFacilistListByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $sel_member = $this->input->post('sel_member');
            $parameter_id = $this->input->post('parameter_id');
            $result['entry_module'] = $this->input->post('entry_module');
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


        

        $result['facilityTranList'] = $this->memberfacilitymodel->getfacilityTransactionList($from_dt,$to_dt,$parameter_id, $sel_member);
         $page = "dashboard/member_facility/member_facility_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }


function insertActivity($description,$old_description,$table_id,$action){
$session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'Member Facility ',
                              "action" => $action,
                              "from_method" => 'memberfacility/facility_action',
                              "table_name" => 'member_facility_transaction',
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