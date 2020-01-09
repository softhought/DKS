<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hardcourt extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('hardcourtmodel','hardcourtmodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/hardcourt/hardcourt_view";
        $header="";  
        $result = [];

       $result['hardcourtlist'] = $this->hardcourtmodel->getAllDatahardcourt('hardcourt');
       //pre($result['hardcourtlist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function addhardcourt(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['hardcourtId'] = 0;
        $result['hardcourtEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['hardcourtId'] = $this->uri->segment(3);

          $where = array('id'=>$result['hardcourtId']);

          $result['hardcourtEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('hardcourt',$where);
           

       }

        $page = "dashboard/hardcourt/addedit_hardcourt_view";
        $header="";
 
        $result['studentdtl'] = $this->commondatamodel->getAllRecordOrderBy('admission_register','student_name','asc');
        
       //pre($result['studentdtl']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

 public function hardcourt_action() {

        $dataArry=[];
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);

         
        $mode = $dataArry['mode'];
        $hardcourtId = $dataArry['hardcourtId'];
        

       
        if ($mode == "ADD" && $hardcourtId == "0") {
          
            $insertData = $this->hardcourtmodel->insertDatahardcourt($dataArry);

              $activity_module='Data Insert';
              $action = 'Insert';
              $method='hardcourt_action'; 
              $master_id =$insertData;
              $tablename = 'hardcourt';
              $description = 'tran date-'.$dataArry['hardcourt_date'].' '.'Quantity-'.$dataArry['quntity'].' '.'rate-'.$dataArry['rate'];
              $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);

               if($insertData)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD",
                            "hardcourtId" => $insertData,
                           

                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }

        }else{

            if($dataArry['hardcourt_date'] != ''){

                $hardcourt_date = str_replace('/', '-', $dataArry['hardcourt_date']);
                $tran_dt=date('Y-m-d',strtotime($hardcourt_date));
                $tran_month=date('M',strtotime($hardcourt_date));
               
               $month = date('m',strtotime($hardcourt_date));

               $month_id = ltrim($month,'0');
            }else{
                 $tran_dt = NULL;
                 $tran_month = NULL;
                 $month_id = NULL;
            }

           $data = array(
                         'tran_date' =>$tran_dt,
                         'tran_month' =>$tran_month,
                         'quntity'=> $dataArry['quntity'],
                         'rate'=>$dataArry['rate'],
                         'amount'=>$dataArry['amount'],
                         'month_id'=>$month_id
                          );
           
           $upd_where = array('id'=>$hardcourtId);

           $Updatedata = $this->commondatamodel->updateSingleTableData('hardcourt',$data,$upd_where);

             $activity_module='Data Updated';
              $action = 'Updated';
              $method='hardcourt_action'; 
              $master_id =$hardcourtId;
              $tablename = 'hardcourt';
              $description = 'tran date-'.$dataArry['hardcourt_date'].' '.'Quantity-'.$dataArry['quntity'].' '.'rate-'.$dataArry['rate'];
              $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);
               
                if($Updatedata)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Updated successfully",
                                                      

                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }
            
        }



            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;

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
                        'description'=>$description
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  } 

}