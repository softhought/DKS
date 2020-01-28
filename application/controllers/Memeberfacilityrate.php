<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memeberfacilityrate extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('memberfacilityratemodel','memberfacilityratemodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/member-facility-rate/member_facility_rate_list";
        $header="";  

        $result['allfacilityrate'] = $this->memberfacilityratemodel->getAllfacilityrate();
       // pre($result['allfacilityrate']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditfacilityrate(){

$session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['parameterId'] = 0;
        $result['facilityrateEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['parameterId'] = $this->uri->segment(3);

          $where = array('parameter_id'=>$result['parameterId']);

          $result['facilityrateEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('parameter_master',$where);
         
           

       }

      $wherecgst = array('gstType'=>'CGST');
       $result['allcgsttypelist'] = $this->commondatamodel->getAllRecordWhere('gstmaster',$wherecgst);
       $wheresgst = array('gstType'=>'SGST');
       $result['allsgstlist'] = $this->commondatamodel->getAllRecordWhere('gstmaster',$wheresgst);


       //pre($result['facilityrateEditdata']);exit;

        $page = "dashboard/member-facility-rate/addeditfacilityrate";
        $header="";
 
        
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }


}

public function facilityrate_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            //$mode = trim(htmlspecialchars($dataArry['mode']));
            $parameterId = trim(htmlspecialchars($dataArry['parameterId']));
            $rate = trim(htmlspecialchars($dataArry['rate']));
            $cgst = trim(htmlspecialchars($dataArry['cgst']));
            $sgst = trim(htmlspecialchars($dataArry['sgst']));

             
            $data =  array(
                           'rate'=>$rate,
                           'cgst_id'=>$cgst,
                           'sgst_id'=>$sgst
                           );

            
            $upd_where = array('parameter_master.parameter_id' => $parameterId);

            //old details
             $old_details = $this->commondatamodel->getSingleRowByWhereCls('parameter_master',$upd_where);
            
            $Updatedata = $this->commondatamodel->updateSingleTableData('parameter_master',$data,$upd_where);

              $activity_module='data Update';
              $action = 'Update';
              $method='facilityrate_action'; 
              $master_id =$parameterId;
              $tablename = 'parameter_master';
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