<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountgroup extends CI_Controller {
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
        $page = "dashboard/master/account-group/account_group_view";
        $header="";  

        $result['accountgrouplist'] = $this->commondatamodel->getAllRecordWhereOrderBy('group_master',[],'group_description');
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addaccgroup(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['groupId'] = 0;
        $result['accountgroupEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['groupId'] = $this->uri->segment(3);

          $where = array('ac_grp_id'=>$result['groupId']);

          $result['accountgroupEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('group_master',$where);
           

       }

        $page = "dashboard/master/account-group/addedit_accountgroup_view";
        $header="";
 
        $result['groupcategory'] = array('PROFIT & LOSS','BALANCE SHEET');
        $result['groupsubcategory'] = array('INCOME','ASSET');
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

function checkduplicatgroupname(){

   $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
         $groupname = $this->input->post('groupname');

         $where = array('group_description'=>$groupname);
        
         $getdata = $this->commondatamodel->getAllRecordWhere('group_master',$where);
        
  
         if(!empty($getdata)){

              $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Group Name Already Exists",
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

 public function groupform_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $groupId = trim(htmlspecialchars($dataArry['groupId']));
            $groupname = trim(htmlspecialchars($dataArry['groupname']));
            $gropcat = trim($dataArry['gropcat']);
            $subgropucat = trim(htmlspecialchars($dataArry['subgropucat']));

            $data = array('group_description'=>strtoupper($groupname),'main_category'=>$gropcat,'sub_category'=>$subgropucat);

            
            if($mode == 'ADD' && $groupId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('group_master',$data);
              
              $activity_module='data Insert';
              $action = 'Insert';
              $method='groupform_action'; 
              $master_id =$insertdata;
              $tablename = 'group_master';
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

                $upd_where = array('group_master.ac_grp_id' => $groupId);
                //old data details
               $old_details = $this->commondatamodel->getSingleRowByWhereCls('group_master',$upd_where);

                $Updatedata = $this->commondatamodel->updateSingleTableData('group_master',$data,$upd_where);
                     

              $activity_module='data Update';
              $action = 'Update';
              $method='groupform_action'; 
              $master_id =$groupId;
              $tablename = 'group_master';
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
                        'description'=>$description,
                        'ip_address'=>getUserIPAddress()
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  }


}