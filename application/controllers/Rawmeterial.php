<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rawmeterial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    
    
        
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/inventory_master/vendor/vendor_list_view";
        $header="";  
  
        $result['vendorList'] = $this->commondatamodel->getAllRecordOrderBy('vendor_master','vendor_name','asc');

        //pre($result['tennisitemlist']);exit;
        
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }
 


public function addRawmeterial(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $rawmeterialID = 0;
                $result['rawmeterialID'] = $rawmeterialID;
                $result['rawmeterialEditdata'] = [];

            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $rawmeterialID = $this->uri->segment(3);
                $result['rawmeterialID'] = $rawmeterialID;
                
                $whereAry = [
                    'raw_meterial_master.raw_meterial_id' => $rawmeterialID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['rawmeterialEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('raw_meterial_master',$whereAry); 
                //  pre($result['cbnaatEditdata']);exit;
                
            }

      

         // pre($result['stateList'] );exit;


            $header = "";
            $page = "dashboard/raw_meterial/addedit_raw_meterial.php";
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
            $vendor_name = trim(htmlspecialchars($dataArry['vendor_name']));
            $address = trim(htmlspecialchars($dataArry['address']));
            $gst_no = trim(htmlspecialchars($dataArry['gst_no']));
            $sel_state = trim(htmlspecialchars($dataArry['sel_state']));
           

              if($vendorID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
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

                    $update = $this->commondatamodel->updateSingleTableData('material_type_inv',$vendor_array_upd,$upd_where);

                     
                    $activity_description = json_encode($vendor_array_upd);
                    $old_description = json_encode($vendor_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$materialtypeID,"Update");

                    
                    
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
                              "activity_module" => 'Inventory Main Group ',
                              "action" => $action,
                              "from_method" => 'maingroupinv/group_action',
                              "table_name" => 'main_group_inv',
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