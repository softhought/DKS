<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountmaster extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('accountmastermodel','accountmastermodel',TRUE);
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/master/account-master/account_master_view";
        $header="";  

        $result['accountmasterlist'] = $this->commondatamodel->getAllRecordOrderBy('account_master','account_id','desc');
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
 }

public function addaccountMaster(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['accId'] = 0;
        $result['accountmasterEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['accId'] = $this->uri->segment(3);

          $where = array('account_id'=>$result['accId']);

          $result['accountmasterEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('account_master',$where);
           

       }

        $page = "dashboard/master/account-master/addedit_accountmaster";
        $header="";

        $result['groupnamelist'] =  $this->commondatamodel->getAllRecordWhereOrderBy('group_master',[],'group_description');
 
        
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

 public function ActiveAcc()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   

            $accId=$this->uri->segment(3);            
            $this->accountmastermodel->ActiveInactiveAccountMaster($accId,'Y');
           

            redirect('accountmaster','refresh');

        }else{
            redirect('login','refresh');
        }
    }
    public function InactiveAcc()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   
            $accId=$this->uri->segment(3);
            $this->accountmastermodel->ActiveInactiveAccountMaster($accId,'N');
            

            redirect('accountmaster','refresh');

        }else{
            redirect('login','refresh');
        }
    }


 public function accountmaster_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $accId = trim(htmlspecialchars($dataArry['accId']));
            $accountname = trim(htmlspecialchars($dataArry['accountname']));
            $groupname = trim(htmlspecialchars($dataArry['groupname']));
            $acccountgrpid = trim(htmlspecialchars($dataArry['acccountgrpid']));
           
           

            $data = array('account_name'=>$accountname,'group_name'=>$groupname,'group_id'=>$acccountgrpid,'is_active'=>'Y','company_id'=>$session['companyid']);

            
            if($mode == 'ADD' && $accId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('account_master',$data);
              $activity_module='data Insert';
              $action = 'Insert';
              $method='accountmaster_action'; 
              $master_id =$insertdata;
              $tablename = 'account_master';
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

                $upd_where = array('account_master.account_id' => $accId);
                //old details
                $old_details = $this->commondatamodel->getSingleRowByWhereCls('account_master',$upd_where);

                $Updatedata = $this->commondatamodel->updateSingleTableData('account_master',$data,$upd_where);

              $activity_module='data Upadte';
              $action = 'Update';
              $method='accountmaster_action'; 
              $master_id =$accId;
              $tablename = 'account_master';
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