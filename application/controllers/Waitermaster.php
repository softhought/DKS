<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waitermaster extends CI_Controller {
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
        $page = "dashboard/master/waiter-master/waiter_list_view";
        $header="";  

        $result['Allwaiterlist'] = $this->commondatamodel->getAllRecordOrderBy('waiter_master','id','desc');
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditwaiter(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['waiterId'] = 0;
        $result['waiterEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['waiterId'] = $this->uri->segment(3);

          $where = array('id'=>$result['waiterId']);

          $result['waiterEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('waiter_master',$where);
           

       }

        $page = "dashboard/master/waiter-master/addedit_waiter_view";
        $header="";
 
        
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}



 public function waitermaster_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $waiterId = trim(htmlspecialchars($dataArry['waiterId']));
            $waiter_name = trim(htmlspecialchars($dataArry['waiter_name']));           
            $address_one = trim(htmlspecialchars($dataArry['address_one']));
            $address_two = trim(htmlspecialchars($dataArry['address_two']));
            $address_three = trim(htmlspecialchars($dataArry['address_three']));
            $mobile_no = trim(htmlspecialchars($dataArry['mobile_no']));

            $data = array('waiter_name'=>strtoupper($waiter_name),'address_one'=>$address_one,'address_two'=>$address_two,'address_three'=>$address_three,'mobile_no'=>$mobile_no);
           
            
            if($mode == 'ADD' && $waiterId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('waiter_master',$data);
              
              $activity_module='data Insert';
              $action = 'Insert';
              $method='waitermaster_action'; 
              $master_id =$insertdata;
              $tablename = 'waiter_master';
              $old_description ='';
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

              $upd_where = array('waiter_master.id' => $waiterId);
                //old data details
               $old_details = $this->commondatamodel->getSingleRowByWhereCls('waiter_master',$upd_where);

                $Updatedata = $this->commondatamodel->updateSingleTableData('waiter_master',$data,$upd_where);
                     

              $activity_module='data Update';
              $action = 'Update';
              $method='waitermaster_action'; 
              $master_id =$waiterId;
              $tablename = 'waiter_master';
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
            $where = array('id'=>$Id);           
            $this->commondatamodel->ActiveInactive('waiter_master',$data,$where);
           
            redirect('waitermaster','refresh');

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
            $where = array('id'=>$Id);           
            $this->commondatamodel->ActiveInactive('waiter_master',$data,$where);
            
            redirect('waitermaster','refresh');

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
                        'description'=>$description,
                        'ip_address'=>getUserIPAddress()
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  }


}