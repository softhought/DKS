<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('vendormodel','vendormodel',TRUE);    
    }


public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/inventory_master/vendor/vendor_list_view";
        $header="";  
  
        $result['vendorList'] = $this->vendormodel->getAllVendorList();

        //pre($result['tennisitemlist']);exit;
        
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }
 


public function addVendor(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $vendorID = 0;
                $result['vendorID'] = $vendorID;
                $result['vendorEditdata'] = [];
                
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $vendorID = $this->uri->segment(3);
                $result['vendorID'] = $vendorID;
                

                // getSingleRowByWhereCls(tablename,where params)
                 $result['vendorEditdata'] = $this->vendormodel->getVendorDataByID($vendorID); 
                 // pre($result['vendorEditdata']);exit;
                
            }

               
         $result['stateList'] = $this->commondatamodel->getAllRecordOrderBy('state_master','state_name','asc');

         // pre($result['stateList'] );exit;


            $header = "";
            $page = "dashboard/inventory_master/vendor/vendor_add_edit";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function vendor_action(){

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
            $vendorID = trim(htmlspecialchars($dataArry['vendorID']));
            $accountID = trim(htmlspecialchars($dataArry['accountID']));
            $vendor_name = trim(htmlspecialchars($dataArry['vendor_name']));
            $address = trim(htmlspecialchars($dataArry['address']));
            $gst_no = trim(htmlspecialchars($dataArry['gst_no']));
            $sel_state = trim(htmlspecialchars($dataArry['sel_state']));
            $opening_balance = trim(htmlspecialchars($dataArry['opening_balance']));
           

              if($vendorID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */

                    $result['vendorExist'] = $this->vendormodel->checkExistanceVendoreName($vendorID,$vendor_name);
                  
                  if ($result['vendorExist']) {

                       $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "Vendor name already exist"
                        );
                  
                  }else{


                      $account_master_upd = array(
                                          'account_name' => $vendor_name
                                        );
                      $upd_ac_where = array('account_master.account_id' => $accountID );


                $update1 = $this->commondatamodel->updateSingleTableData('account_master',$account_master_upd,$upd_ac_where);










                  $whereAry = [
                    'vendor_master.vendor_id' => $vendorID
                   ];

               
                 $vendor_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('vendor_master',$whereAry); 
                    $vendor_array_upd = array(     
                                          'vendor_name' => $vendor_name,   
                                          'address' => $address,   
                                          'gst_no' => $gst_no,   
                                          'state_code' => $sel_state,   
                                          'last_modified' => date('Y-m-d'),       
                                         );

                    $upd_where = array('vendor_master.vendor_id' => $vendorID);

                    $update = $this->commondatamodel->updateSingleTableData('vendor_master',$vendor_array_upd,$upd_where);


                    /* Update account opening master */

                    $ac_open_upd = array( 'opening_balance' => $opening_balance);
                    $ac_open_upd_where = array(
                                                'account_id' => $vendor_array_before_upd->account_id,
                                                'year_id' => $year,
                                              );

                   $update2 = $this->commondatamodel->updateSingleTableData('account_opening_master',$ac_open_upd,$ac_open_upd_where);
                     
                    $activity_description = json_encode($vendor_array_upd);
                    $old_description = json_encode($vendor_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$vendorID,"Update");

                    
                    
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


                  }




                } // end if mode
                else
                {
                    /*  ADD MODE
                     *  -----------------
                    */
                    $where_exist = array('account_master.account_name' => $vendor_name);
                    $exist= $this->commondatamodel->checkExistanceData('account_master',$where_exist);

                    if ($exist) {

                       $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "Vendor name already exist"
                        );

                    }else{


                     $whereAry = [
                    'group_master.group_description' => 'SUNDRY CREDITOR'
                   ];

               
                 $group_id = $this->commondatamodel->getSingleRowByWhereCls('group_master',$whereAry)->id; 

                 $account_master = array(
                                          'account_name' => $vendor_name, 
                                          'group_id' => $group_id, 
                                          'is_active' => 'Y', 
                                          'company_id' => $company, 
                                          'is_gym_swim_minbill' => 'N', 

                                        );

               $account_id = $this->commondatamodel->insertSingleTableData('account_master',$account_master);

               $ac_opening_bal = array(
                                        'account_id' => $account_id,
                                        'opening_balance' => $opening_balance,
                                        'company_id' => $company,
                                        'year_id' => $year,
                                      );



               $acountOpening= $this->commondatamodel->insertSingleTableData('account_opening_master',$ac_opening_bal);

 
                $vendor_array = array(
                                          'vendor_name' => $vendor_name,   
                                          'address' => $address,   
                                          'gst_no' => $gst_no,  
                                          'state_code' => $sel_state,
                                          'account_id' => $account_id,
                                          'company_id' => $company, 
                                          'is_active' => 'Y',         
                                          'created_on' => date('Y-m-d'),       
                                         );

               $insertData = $this->commondatamodel->insertSingleTableData('vendor_master',$vendor_array);

                    $activity_description = json_encode($vendor_array);
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
                            "msg_status" => 0,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }



                  }


                } // end add mode ELSE PART
      

       

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 


         }else{
            redirect('login','refresh');
        }   

  } 



function insertActivity($description,$old_description,$table_id,$action){
$session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'vendor ',
                              "action" => $action,
                              "from_method" => 'vendor/vendor_action',
                              "table_name" => 'vendor_master',
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









} // end of class