<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materialtypeinv extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    
    
        
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/inventory_master/material_type/material_type_list_view";
        $header="";  
  
        $result['materialtypeList'] = $this->commondatamodel->getAllRecordOrderBy('material_type_inv','material_type_id','asc');
        //pre($result['tennisitemlist']);exit;
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }



public function addMaterialtype(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $materialtypeID = 0;
                $result['materialtypeID'] = $materialtypeID;
                $result['materialtypeEditdata'] = [];
                
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $materialtypeID = $this->uri->segment(3);
                $result['materialtypeID'] = $materialtypeID;
                
                $whereAry = [
                    'material_type_inv.material_type_id' => $materialtypeID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['materialtypeEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('material_type_inv',$whereAry); 
                //  pre($result['cbnaatEditdata']);exit;
                
            }

               
            $header = "";
            $page = "dashboard/inventory_master/material_type/addedit_material_type";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function materialtype_action(){

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
            $materialtypeID = trim(htmlspecialchars($dataArry['materialtypeID']));
            $material_type = trim(htmlspecialchars($dataArry['material_type']));
           

              if($materialtypeID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                  $whereAry = [
                    'material_type_inv.material_type_id' => $materialtypeID
                   ];

               
                 $materialtype_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('material_type_inv',$whereAry); 
                    $materialtype_array_upd = array(     
                                          'material_type' => $material_type,   
                                          'last_modified' => date('Y-m-d'),       
                                         );

                    $upd_where = array('material_type_inv.material_type_id' => $materialtypeID);

                    $update = $this->commondatamodel->updateSingleTableData('material_type_inv',$materialtype_array_upd,$upd_where);

                     
                    $activity_description = json_encode($materialtype_array_upd);
                    $old_description = json_encode($materialtype_array_before_upd);
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

            
              
                $materialtype_array = array(
                                          'material_type' => $material_type,        
                                          'company_id' => $company,         
                                          'created_on' => date('Y-m-d'),       
                                         );

                 $insertData = $this->commondatamodel->insertSingleTableData('material_type_inv',$materialtype_array);

                    $activity_description = json_encode($materialtype_array);
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
                              "activity_module" => 'Inventory Material Type ',
                              "action" => $action,
                              "from_method" => 'materialtypeinv/materialtype_action',
                              "table_name" => 'material_type_inv',
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