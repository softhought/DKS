<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);        
        $this->load->model('employeemodel','employeemodel',TRUE);        
         
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/discount/discount_list";
        $header="";       
        $result['discountList'] =  $this->commondatamodel->getAllDropdownData('discount');

        
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditdiscount(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['discId'] = 0;
          $result['discountEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['discId'] = $this->uri->segment(3);
  
            $where = array('id'=>$result['discId']);
          
            $result['discountEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('discount',$where);
            
             
  
         }

          
  
          $page = "dashboard/discount/add_edit_discount";
          $header="";
  
          
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }

  public function discount_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

          
          $mode = trim(htmlspecialchars($dataArry['mode']));
          $discId = trim(htmlspecialchars($dataArry['discId']));
          $discount_rate = trim(htmlspecialchars($dataArry['discount_rate']));
          $narration = trim(htmlspecialchars($dataArry['narration']));
         
         

          $data = array('discount_rate'=>$discount_rate,'narration'=>$narration);

          
          if($mode == 'ADD' && $discId == 0){

            $insertdata = $this->commondatamodel->insertSingleTableData('discount',$data);
            $activity_module='discount';
            $action = 'Insert';
            $method='discount_action'; 
            $master_id =$insertdata;
            $tablename = 'discount';
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

              $upd_where = array('discount.id' => $discId);
              //old details
              $old_details = $this->commondatamodel->getSingleRowByWhereCls('discount',$upd_where);

              $Updatedata = $this->commondatamodel->updateSingleTableData('discount',$data,$upd_where);

            $activity_module='discount';
            $action = 'Update';
            $method='discount_action'; 
            $master_id =$discId;
            $tablename = 'discount';
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