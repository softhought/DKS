<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locationmaster extends CI_Controller {
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
        $page = "dashboard/master/location/location_list_view";
        $header="";       
        $result['locationList'] =  $this->commondatamodel->getAllRecordOrderBy('location_master','location_id','desc');

        
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditlocation(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['locationId'] = 0;
          $result['locationEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['locationId'] = $this->uri->segment(3);
  
            $where = array('location_id'=>$result['locationId']);
  
            $result['locationEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('location_master',$where);
             
  
         }
  
          $page = "dashboard/master/location/addedit_location";
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
          $location_name = trim(htmlspecialchars($this->input->post('location_name')));
 
          $where = array('location'=>$location_name);
         
          $getdata = $this->commondatamodel->getAllRecordWhere('location_master',$where);
         
   
          if(!empty($getdata)){
 
               $json_response = array(
                             "msg_status" => 1,
                             "msg_data" => "Location Already Exists",
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
          $locationId = trim(htmlspecialchars($dataArry['locationId']));
          $location_name = trim(htmlspecialchars($dataArry['location_name']));
            
          $data = array('location'=>strtoupper($location_name),'is_active'=>'Y'); 

          
          if($mode == 'ADD' && $locationId == 0){

           
            $insertdata = $this->commondatamodel->insertSingleTableData('location_master',$data);

            $activity_module='data Insert';
            $action = 'Insert';
            $method='locationmaster/addedit_action'; 
            $master_id =$insertdata;
            $tablename = 'loaction_master';
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

             
              $upd_where = array('location_master.location_id' => $locationId);
              //old details
              $old_details = $this->commondatamodel->getSingleRowByWhereCls('location_master',$upd_where);

              $Updatedata = $this->commondatamodel->updateSingleTableData('location_master',$data,$upd_where);

            $activity_module='data Update';
            $action = 'Update';
            $method='locationmaster/addedit_action'; 
            $master_id =$locationId;
            $tablename = 'location_master';
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

public function Active()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   

            $Id=$this->uri->segment(3); 
            $data = array('is_active'=>'Y');
            $where = array('location_id'=>$Id);           
            $this->commondatamodel->ActiveInactive('location_master',$data,$where);
           
            redirect('locationmaster','refresh');

        }else{
            redirect('login','refresh');
        }
    }
    public function Inactive()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   
            $Id=$this->uri->segment(3); 
            $data = array('is_active'=>'N');
            $where = array('location_id'=>$Id);           
            $this->commondatamodel->ActiveInactive('location_master',$data,$where);
            
            redirect('locationmaster','refresh');

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