<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmode extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('paymentmodemodel','paymentmodemodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/payment-mode/payment_mode_list_view";
        $header="";  

        $result['paymentmodelist'] = $this->paymentmodemodel->getallPaymentmodedtl();
       // pre($result['paymentmodelist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addpaymentmodedtl(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['paymodeId'] = 0;
        $result['paymentmodeEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['paymodeId'] = $this->uri->segment(3);

          $where = array('id'=>$result['paymodeId']);

          $result['paymentmodeEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('payment_mode_details',$where);
           

       }

        $page = "dashboard/master/payment-mode/addedit_paymentmode_view";
        $header="";
 
        $result['accountmasterlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('account_master',[],'account_name');
       
       // pre($result['accountmasterlist']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

function checkduplicatpaymentmode(){

   $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
         $paymentmode = $this->input->post('paymentmode');

         $where = array('Payment_mode'=>$paymentmode);
        
         $getdata = $this->commondatamodel->getAllRecordWhere('payment_mode_details',$where);
        
  
         if(!empty($getdata)){

              $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Payment Mode Already Exists",
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


public function paymentmode_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $paymodeId = trim(htmlspecialchars($dataArry['paymodeId']));
            $paymentmode = trim(htmlspecialchars($dataArry['paymentmode']));
            $acccountid = trim($dataArry['acccountid']);
            

            $data = array('payment_mode'=>$paymentmode,'account_id'=>$acccountid);

            
            if($mode == 'ADD' && $paymodeId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('payment_mode_details',$data);
              $activity_module='Data Insert';
              $action = 'Insert';
              $method='paymentmode_action'; 
              $master_id =$insertdata;
              $tablename = 'payment_mode_details';
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

                $upd_where = array('payment_mode_details.id' => $paymodeId);

               // old details
              $old_details = $this->commondatamodel->getSingleRowByWhereCls('payment_mode_details',$upd_where);

               $Updatedata = $this->commondatamodel->updateSingleTableData('payment_mode_details',$data,$upd_where);

              $activity_module='Data Update';
              $action = 'Update';
              $method='paymentmode_action'; 
              $master_id =$paymodeId;
              $tablename = 'payment_mode_details';
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
                        'old_description'=> $old_description,
                        'description'=>$description,
                        "ip_address"=>getUserIPAddress()
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  }

}