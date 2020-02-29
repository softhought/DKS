<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partymember extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);        
        $this->load->model('partymembermodel','partymembermodel',TRUE);        
               
         
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/party/master/partymember/addpartymember";
        $header="";  
        $whereid = array('year_id'=>$session['yearid']);
        $financialyear = explode('-',$this->commondatamodel->getSingleRowByWhereCls('financialyear',$whereid)->short_year);
        
         $startcCode = 'BQ';
        //  pre($startcCode);exit;
        
        $LastserialData=$this->partymembermodel->getlastcode();
       
         //pre($LastserialData);exit;
       
        if ($LastserialData) {
            $lastSerial = $LastserialData;
                   
         }else{
           $lastSerial=0; 
           
         }
        
     if($lastSerial == 0){
        $lastcodenextSerial=$lastSerial+1;
        
     }else{
        $lastcodenextSerial=$lastSerial;
        
     }
      
      $newcodenextSerial=$lastSerial+1;

      $digit = strlen($lastcodenextSerial); 
    
      if($digit==3){
         $lastcodeserialno = "0".$lastcodenextSerial;
         $newcodeserialno = "0".$newcodenextSerial;
      }
       elseif($digit==2){
         $lastcodeserialno = "00".$lastcodenextSerial;
         $newcodeserialno = "00".$newcodenextSerial;
      }elseif($digit==1){
        $lastcodeserialno = "000".$lastcodenextSerial;
        $newcodeserialno = "000".$newcodenextSerial;
     }else{
          $lastcodeserialno = $lastcodenextSerial;
          $newcodeserialno = $newcodenextSerial;
      }

      

      $result['lastCode'] = $startcCode.'-'.$lastcodeserialno.date('y',strtotime(date('Y-m-d')));
      $result['newCode'] = $startcCode.'-'.$newcodeserialno.date('y',strtotime(date('Y-m-d')));
    //   pre($result['lastCode']);
    //   pre($result['newCode']);
    //   exit;
        $result['ExistingcodeList'] = $this->partymembermodel->getalldetails($startcCode);

        
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function getmemberdetails() {

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $member_id = $this->input->post('member_id');
        
        $details = $this->partymembermodel->getmemberdetails($member_id); 

        $json_response = array(
                                 "details" => $details
                                );

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit;
    }else
    {
        redirect('login','refresh');
    }

 }

 public function checkexistingcode(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {
        $new_partymember_code = $this->input->post('new_partymember_code');

        $where = array('member_code'=>$new_partymember_code);
        $existing = $this->commondatamodel->getSingleRowByWhereCls('member_master',$where);

         if(!empty($existing)){
            $json_response = array(
                "msg_status" => 1,
               );
         }else{
            $json_response = array(
                "msg_status" => 0,
               );
         }

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit;
      }else
      {
          redirect('login','refresh');
      }

    }
 

  public function addparty_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

                    
          $member_id = trim(htmlspecialchars($dataArry['existing_code']));
          $mobile_no = trim(htmlspecialchars($dataArry['mobile_no']));
          $address_one = trim(htmlspecialchars($dataArry['address_one']));
          $address_two = trim(htmlspecialchars($dataArry['address_two']));
          $address_three = trim(htmlspecialchars($dataArry['address_three']));
          $new_partymember_code = trim(htmlspecialchars($dataArry['new_partymember_code']));
          $party_mem_name = trim(htmlspecialchars($dataArry['party_mem_name']));
          $party_mem_mobile = trim(htmlspecialchars($dataArry['party_mem_mobile']));
          $comapany_name = trim(htmlspecialchars($dataArry['comapany_name']));
          $gst_no = trim(htmlspecialchars($dataArry['gst_no']));
            
          $whereid = array('member_id'=>$member_id);
        
           $memberdtl = $this->commondatamodel->getSingleRowByWhereCls('member_master',$whereid);

                        $insert_array = array(
                            'member_code' => $new_partymember_code,
                            'title_one' => $memberdtl->title_one,
                            'member_name' => $memberdtl->member_name,
                            'date_of_birth' => $memberdtl->date_of_birth,
                            'occupation_id' =>$memberdtl->occupation_id,
                            'category' => $memberdtl->category,                                            
                            'admission_date' => $memberdtl->admission_date,
                            'address_one' => $address_one,
                            'address_two' => $address_two,
                            'address_three' => $address_three,
                            'city' => $memberdtl->city,
                            'pin' => $memberdtl->pin,
                            'phone' => $memberdtl->phone,
                            'mobile' => $mobile_no,
                            'email' => $memberdtl->email, 
                            'status' => $memberdtl->status,
                            'subscription' => $memberdtl->subscription,
                            'min_billing'=>$memberdtl->min_billing,
                            'min_ceiling'=>$memberdtl->min_ceiling,
                            'social_subs' => $memberdtl->social_subs,
                            'blocked_y_n'=>$memberdtl->blocked_y_n,
                            'elt_member'=>$memberdtl->elt_member,
                            'created_on' => date('Y-m-d'),
                            'modify_date' => date('Y-m-d'),
                            'actual_member_code'=>$memberdtl->member_code,
                            'party_mem_name'=>$party_mem_name,
                            'party_mem_mobile'=>$party_mem_mobile,
                            'company_name'=>$comapany_name,
                            'gst_no'=>$gst_no
                            
                        );

            $insertdata = $this->commondatamodel->insertSingleTableData('member_master',$insert_array);

            $activity_module='data Insert';
            $action = 'Insert';
            $method='partymember/addparty_action'; 
            $master_id =$insertdata;
            $tablename = 'member_master';
            $old_description = '';
            $description = json_encode($insert_array);
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