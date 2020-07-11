<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storemaingroup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    
    
        
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/inventory_master/store_main_group/store_main_group_list_view";
        $header="";  
  
        $result['maingroupList'] = $this->commondatamodel->getAllRecordOrderBy('main_group_master','group_desc','asc');
        //pre($result['tennisitemlist']);exit;
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }



public function addMaingroup(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $groupID = 0;
                $result['groupID'] = $groupID;
                $result['groupEditdata'] = [];
                
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $groupID = $this->uri->segment(3);
                $result['groupID'] = $groupID;
                
                $whereAry = [
                    'main_group_master.id' => $groupID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['groupEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('main_group_master',$whereAry); 
                //  pre($result['cbnaatEditdata']);exit;
                
            }

               
            $header = "";
            $page = "dashboard/inventory_master/store_main_group/addedit_store_main_group";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function group_action(){

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
            $groupID = trim(htmlspecialchars($dataArry['groupID']));
            $group_name = trim(htmlspecialchars($dataArry['group_name']));
           

              if($groupID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                  $whereAry = [
                    'main_group_master.id' => $groupID
                   ];

               
                     $group_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('main_group_master',$whereAry); 
                     $group_array_upd = array(     
                                          'group_desc' => $group_name,   
                                          'last_modified' => date('Y-m-d'),       
                                         );

                    $upd_where = array('main_group_master.id' => $groupID);
                    $update = $this->commondatamodel->updateSingleTableData('main_group_master',$group_array_upd,$upd_where);

                     
                    $activity_description = json_encode($group_array_upd);
                    $old_description = json_encode($group_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$groupID,"Update");

                    
                    
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

            
              
                $group_array = array(
                                          'group_desc' => $group_name,          
                                          'is_active' => 'Y',          
                                          'company_id' => $company,         
                                          'created_on' => date('Y-m-d'),       
                                         );

                 $insertData = $this->commondatamodel->insertSingleTableData('main_group_master',$group_array);

                    $activity_description = json_encode($group_array);
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



function insertActivity($description,$old_description,$table_id,$action){
$session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'Store Main Group ',
                              "action" => $action,
                              "from_method" => 'storemaingroup/group_action',
                              "table_name" => 'main_group_master',
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