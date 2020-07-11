<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspectorinv extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    
    
        
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/inventory_master/inspector/inspector_list_view";
        $header="";  

        
        $result['inspectorList'] = $this->commondatamodel->getAllRecordOrderBy('inspector_inv','inspector_id','asc');
        //pre($result['tennisitemlist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
 }



public function addInspector(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $inspectorID = 0;
                $result['inspectorID'] = $inspectorID;
                $result['inspectorEditdata'] = [];
                
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $inspectorID = $this->uri->segment(3);
                $result['inspectorID'] = $inspectorID;
                
                $whereAry = [
                    'inspector_inv.inspector_id' => $inspectorID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['inspectortEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('inspector_inv',$whereAry); 
                //  pre($result['cbnaatEditdata']);exit;
                
            }

               
            $header = "";
            $page = "dashboard/inventory_master/inspector/addedit_inspector";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function inspector_action(){

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
            $inspectorID = trim(htmlspecialchars($dataArry['inspectorID']));
            $inspector_name = trim(htmlspecialchars($dataArry['inspector_name']));
           

              if($inspectorID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                  $whereAry = [
                    'inspector_inv.inspector_id' => $inspectorID
                   ];

               
                 $inspector_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('inspector_inv',$whereAry); 
                      $inspector_array_upd = array(     
                                          'name' => $inspector_name,   
                                          'last_modified' => date('Y-m-d'),       
                                         );

                     $upd_where = array('inspector_inv.inspector_id' => $inspectorID);

                     $update = $this->commondatamodel->updateSingleTableData('inspector_inv',$inspector_array_upd,$upd_where);

                     
                    $activity_description = json_encode($inspector_array_upd);
                    $old_description = json_encode($inspector_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$inspectorID,"Update");

                    
                    
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

            
              
                $inspector_array = array(
                                          'name' => $inspector_name,         
                                          'company_id' => $company,         
                                          'created_on' => date('Y-m-d'),       
                                         );

                 $insertData = $this->commondatamodel->insertSingleTableData('inspector_inv',$inspector_array);

                    $activity_description = json_encode($inspector_array);
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
                              "activity_module" => 'Inventory Inspector ',
                              "action" => $action,
                              "from_method" => 'Inspectorinv/inspector_action',
                              "table_name" => 'inspector_inv',
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