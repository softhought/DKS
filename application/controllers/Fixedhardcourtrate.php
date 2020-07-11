<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fixedhardcourtrate extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('session');        
    
        $this->load->model('companymodel', '', TRUE); 

    }

    public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/fixed-hard-court-rate/fixed_hard_court_list_view";
        $header="";  
     
        
        $result['fixedhardcourtlist'] = $this->commondatamodel->getAllRecordOrderBy('fixed_parameter','day_night','asc');
        //pre($result['tennisitemlist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
 }

 public function addeditfixedhardcourt(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
          /*
              segnent(3)=facility parameter:
              segment(4)=add edit id
      
          */
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";         
          $result['fixedhardId'] = 0;
          $result['fixedhardcourtEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";           
            $result['fixedhardId'] = $this->uri->segment(3);

            $where = array('id'=> $result['fixedhardId']);
  
            $result['fixedhardcourtEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('fixed_parameter',$where);
            // pre($result['fixedhardcourtEditdata']);exit;
  
         } 
  
               
  
          $page = "dashboard/master/fixed-hard-court-rate/addedit_fixed_hard_court";
          $header="";
  
                 
  
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }

  
public function fixedhardcort_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);
          $company=$session['companyid'];
          $year=$session['yearid'];

         
          $mode = trim(htmlspecialchars($dataArry['mode']));
          $fixedhardId = trim(htmlspecialchars($dataArry['fixedhardId']));
               
          
            $rate = trim($dataArry['rate']);

            if($fixedhardId>0 && $mode=="EDIT")
              {
                  /*  EDIT MODE
                   *  -----------------
                  */
                  $where = array('id'=>$fixedhardId);
                
                  $old_details = $this->commondatamodel->getSingleRowByWhereCls('fixed_parameter',$where);
                    $upt_arr = array(     
                                        'rate'=>$rate
                                       );
              

                   $update = $this->commondatamodel->updateSingleTableData('fixed_parameter',$upt_arr,$where);


                   $activity_module='Fixed Hard Court Rate';
                   $action = 'Insert';
                   $method='fixedhardcourtrate/fixedhardcort_action'; 
                   $master_id =$fixedhardId;
                   $tablename = 'fixed_parameter';
                   $old_description = json_encode($old_details);
                   $description = json_encode($upt_arr);
                   $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);
       
                  
                  if($update)
                  {
                      $json_response = array(
                          "msg_status" => 1,
                          "msg_data" => "Updated successfully",
                          "mode" => "EDIT"
                      );
                  }
                  else
                  {
                      $json_response = array(
                          "msg_status" => 0,
                          "msg_data" => "There is some problem while updating ...Please try again."
                      );
                  }



              } // end if mode
              else
              {
                  /*  ADD MODE
                   *  -----------------
                  */

             
              } // end add mode ELSE PART
    

     

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