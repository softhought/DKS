<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baritemgroupmaster extends CI_Controller {
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
        $page = "dashboard/master/bar-items-group/bar_items_group_list";
        $header="";  

        $result['Allbaritemslist'] = $this->commondatamodel->getAllRecordOrderBy('bar_item_group','bar_item_group_id','desc');
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditbaritems(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['baritemId'] = 0;
        $result['baritemsEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['baritemId'] = $this->uri->segment(3);

          $where = array('bar_item_group_id'=>$result['baritemId']);

          $result['baritemsEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('bar_item_group',$where);
           

       }

        $page = "dashboard/master/bar-items-group/addedit_bar_items_group";
        $header="";
 
        
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}


function checkduplicat(){

    $session = $this->session->userdata('user_detail');
     if($this->session->userdata('user_detail'))
     {
          $item_name = $this->input->post('item_name');
 
          $where = array('item_name'=>$item_name);
         
          $getdata = $this->commondatamodel->getAllRecordWhere('bar_item_group',$where);
         
   
          if(!empty($getdata)){
 
               $json_response = array(
                             "msg_status" => 1,
                             "msg_data" => "This Bar Item Already Exists",
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

 public function baritems_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $baritemId = trim(htmlspecialchars($dataArry['baritemId']));
            $item_name = trim(htmlspecialchars($dataArry['item_name']));           
           

            $data = array('item_name'=>strtoupper($item_name));
           
            
            if($mode == 'ADD' && $baritemId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('bar_item_group',$data);
              
              $activity_module='data Insert';
              $action = 'Insert';
              $method='baritems_action'; 
              $master_id =$insertdata;
              $tablename = 'bar_item_group';
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

              $upd_where = array('bar_item_group.bar_item_group_id' => $baritemId);
                //old data details
               $old_details = $this->commondatamodel->getSingleRowByWhereCls('bar_item_group',$upd_where);

                $Updatedata = $this->commondatamodel->updateSingleTableData('bar_item_group',$data,$upd_where);
                     

              $activity_module='data Update';
              $action = 'Update';
              $method='baritems_action'; 
              $master_id =$baritemId;
              $tablename = 'bar_item_group';
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
            $where = array('bar_item_group_id'=>$Id);           
            $this->commondatamodel->ActiveInactive('bar_item_group',$data,$where);
           
            redirect('baritemgroupmaster','refresh');

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
            $where = array('bar_item_group_id'=>$Id);           
            $this->commondatamodel->ActiveInactive('bar_item_group',$data,$where);
            
            redirect('baritemgroupmaster','refresh');

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