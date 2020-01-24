<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gstmaster extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('gstmastermodel','gstmastermodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/gst-master/gst_master_list_view";
        $header="";  

        $result['gstmasterlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('gstmaster',[],'gstDescription');
       // pre($result['paymentmodelist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addgstmaster(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['gstId'] = 0;
        $result['gstmasterEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['gstId'] = $this->uri->segment(3);

          $where = array('id'=>$result['gstId']);

          $result['gstmasterEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('gstmaster',$where);
           

       }

        $page = "dashboard/master/gst-master/addedit_gstmaster_view";
        $header="";
        $result['usedfor'] = array('I'=>'Input','O'=>'Output');
        $result['gsttypelist'] = array('CGST','SGST','IGST');
        $result['accountmasterlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('account_master',[],'account_name');
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

public function gstmaster_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $gstId = trim(htmlspecialchars($dataArry['gstId']));
            $gstdescription = trim(htmlspecialchars($dataArry['gstdescription']));
            $gstType = trim($dataArry['gstType']);
            $gstrate = trim(htmlspecialchars($dataArry['gstrate']));
            $accountid = trim(htmlspecialchars($dataArry['accountid']));
            $usedfor = trim(htmlspecialchars($dataArry['usedfor']));

            

            $data = array(
                          'gstDescription'=>$gstdescription,
                          'gstType'=>$gstType,
                          'rate'=>$gstrate,
                          'accountId'=>$accountid,
                          'companyid'=>$session['companyid'],
                          'yearid'=>$session['yearid'],
                          'usedfor'=>$usedfor

                         );

            
            if($mode == 'ADD' && $gstId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('gstmaster',$data);
              $activity_module='data Insert';
              $action = 'Insert';
              $method='gstmaster_action'; 
              $master_id =$insertdata;
              $tablename = 'gstmaster';
              $description = json_encode($data);
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);
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

                $upd_where = array('gstmaster.id' => $gstId);

                //old details
                 $old_detals = $this->commondatamodel->getSingleRowByWhereCls('gstmaster',$upd_where);

                $Updatedata = $this->commondatamodel->updateSingleTableData('gstmaster',$data,$upd_where);

              $activity_module='data Update';
              $action = 'Update';
              $method='gstmaster_action'; 
              $master_id =$gstId;
              $tablename = 'gstmaster';
              $description = 'Old-'.json_encode($old_detals).' New-'.json_encode($data);
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);

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

  public function deletegstmaster(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $gstid = $this->input->post('id');
            $where = array('id'=>$gstid);

            //old delete details
             $del_where = array('gstmaster.id' => $gstid);
                
             $del_details = $this->commondatamodel->getSingleRowByWhereCls('gstmaster',$del_where);

           $delete = $this->commondatamodel->deleteTableData('gstmaster',$where);
            $activity_module='data delete';
              $action = 'Delete';
              $method='deletegstmaster'; 
              $master_id =$gstid;
              $tablename = 'gstmaster';
              $description = 'delid_details-'.$del_details;
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);

                   

            $json_response = array(
                                    "msg_status" => 1,
                                   );                                                      
         
        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 

           //redirect('gstmaster');

        }else{
            redirect('login','refresh');
        } 

  }

  function activity_log($activity_module,$action,$method,$master_id,$tablename,$description){

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
                        'description'=>$description,
                        'ip_address'=>getUserIPAddress()
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  }



}