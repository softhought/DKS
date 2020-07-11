<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designationmaster extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);        
         
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/payroll/masters/designation/designation_list_view";
        $header="";       
        $result['designationList'] =  $this->commondatamodel->getAllRecordOrderBy('designation_master','id','desc');

        
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditdesignation(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['desigtId'] = 0;
          $result['designationEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['desigtId'] = $this->uri->segment(3);
  
            $where = array('id'=>$result['desigtId']);
  
            $result['designationEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('designation_master',$where);
             
  
         }
  
          $page = "dashboard/payroll/masters/designation/addedit_designation";
          $header="";
  
          
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }

  function checkexistance(){

    $session = $this->session->userdata('user_detail');
     if($this->session->userdata('user_detail'))
     {
          $designation_name = trim(htmlspecialchars($this->input->post('designation_name')));
 
          $where = array('designation_name'=>$designation_name);
         
          $getdata = $this->commondatamodel->getAllRecordWhere('designation_master',$where);
         
   
          if(!empty($getdata)){
 
               $json_response = array(
                             "msg_status" => 1,
                             "msg_data" => "Department Name Already Exists",
                             );
 
          }else{
 
               $json_response = array(
                             "msg_status" => 0,
                             "msg_data" => "",
                             );
          }
 
         
         header('Content-Type: application/json');
         echo json_encode( $json_response );
         exit; 
 
     }
     else{
            redirect('login','refresh');
      
     }
 
 }

  public function addedit_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

          
          $mode = trim(htmlspecialchars($dataArry['mode']));
          $desigtId = trim(htmlspecialchars($dataArry['desigtId']));
          $designation_name = trim(htmlspecialchars($dataArry['designation_name']));
            
          

          
          if($mode == 'ADD' && $desigtId == 0){

            $data = array('designation_name'=> ucfirst($designation_name),'is_active'=>'Y','created_on'=>date('Y-m-d')); 

            $insertdata = $this->commondatamodel->insertSingleTableData('designation_master',$data);

            $activity_module='data Insert';
            $action = 'Insert';
            $method='designationmaster/addedit_action'; 
            $master_id =$insertdata;
            $tablename = 'designation_master';
            $old_description = '';
            $description = json_encode($data);
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

            if($insertdata){

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

              $data = array('designation_name'=> ucfirst($designation_name));
              $upd_where = array('designation_master.id' => $desigtId);
              //old details
              $old_details = $this->commondatamodel->getSingleRowByWhereCls('designation_master',$upd_where);

              $Updatedata = $this->commondatamodel->updateSingleTableData('designation_master',$data,$upd_where);

            $activity_module='data Update';
            $action = 'Update';
            $method='designationmaster/addedit_action'; 
            $master_id =$desigtId;
            $tablename = 'designation_master';
            $old_description = json_encode($old_details);
            $description = json_encode($data);
          $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

                if($Updatedata){

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
                      "description"=>$description,
                      "ip_address"=>getUserIPAddress()
                  );
      $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
   }else{
          redirect('login','refresh');
      }                
}



}