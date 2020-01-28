<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tennisitem extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('tennisitemmodel','tennisitemmodel',TRUE);
        
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/tennis-item/tennis_item_list_view";
        $header="";  

        
        $result['tennisitemlist'] = $this->commondatamodel->getAllRecordOrderBy('tennis_item_master','item_id','desc');
        //pre($result['tennisitemlist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
 }

 public function addtennisitem(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['itemId'] = 0;
        $result['tennisitemEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['itemId'] = $this->uri->segment(3);

          $where = array('item_id'=>$result['itemId']);

          $result['tennisitemEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('tennis_item_master',$where);
           

       }

        $page = "dashboard/master/tennis-item/addedit_tennis_item_view";
        $header="";

         
        
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

public function tennisitem_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $itemId = trim(htmlspecialchars($dataArry['itemId']));
            $tennisitem = trim(htmlspecialchars($dataArry['tennisitem']));
            $hsn_no = trim(htmlspecialchars($dataArry['hsn_no']));
            $rate = trim(htmlspecialchars($dataArry['rate']));
           
           

            $data = array('item_name'=>$tennisitem,'hsn_no'=>$hsn_no,'rate'=>$rate,'is_active'=>'Y',);

            
            if($mode == 'ADD' && $itemId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('tennis_item_master',$data);
              $activity_module='data Insert';
              $action = 'Insert';
              $method='tennisitem_action'; 
              $master_id =$insertdata;
              $tablename = 'tennis_item_master';
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

                $upd_where = array('tennis_item_master.item_id' => $itemId);

                //old_details
                $old_details = $this->commondatamodel->getSingleRowByWhereCls('tennis_item_master',$upd_where);

               $Updatedata = $this->commondatamodel->updateSingleTableData('tennis_item_master',$data,$upd_where);
              $activity_module='data Upadte';
              $action = 'Update';
              $method='tennisitem_action'; 
              $master_id =$itemId;
              $tablename = 'tennis_item_master';
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

            $itemId=$this->uri->segment(3);            
            $this->tennisitemmodel->ActiveInactiveTennisitem($itemId,'Y');
           

            redirect('tennisitem','refresh');

        }else{
            redirect('login','refresh');
        }
    }
    public function Inactive()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   
            $itemId=$this->uri->segment(3);
            $this->tennisitemmodel->ActiveInactiveTennisitem($itemId,'N');
            

            redirect('tennisitem','refresh');

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
                        "ip_address"=>getUserIPAddress()
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  } 

}