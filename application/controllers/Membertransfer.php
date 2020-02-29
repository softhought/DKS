<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membertransfer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('membertransfermodel','membertransfermodel',TRUE);
         
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/member-transfer/member_transfer_view";
        $header="";       
        $result['membercategoryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_catogary_master',[],'category_name');

        // $where = array('status'=>'ACTIVE MEMBER');
        // $result['ExistingcodeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_master',$where,'member_code');
        // $result['titleofneme'] = array('MR','MR.','MS','MS.');
        
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function getlastCode() {

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $memcattag = $this->input->post('memcattag');
        $surname = $this->input->post('surname');

       // $start_letter='S';
        $firstCharacterLastName = strtoupper($surname[0]);
        $startcCode=$memcattag.$firstCharacterLastName;
       
        $alldtlusestartcode = $this->membertransfermodel->getalldetails($surname[0]);
        $LastserialData=$this->membertransfermodel->getlastcode($startcCode);
       

        if ($LastserialData) {
            $lastSerial=intval($LastserialData->last_serial);
            
         }else{
           $lastSerial=0;  
         }
     
          
     if($lastSerial == 0){
        $lastcodenextSerial=$lastSerial+1;
     }else{
        $lastcodenextSerial=$lastSerial;
     }
     //pre($lastcodenextSerial);exit;
      $newcodenextSerial=$lastSerial+1;

      $digit = strlen($lastcodenextSerial); 
      $newdigit = strlen($newcodenextSerial); 

      if($digit==2){
         $lastcodeserialno = "0".$lastcodenextSerial;
         
      }
       elseif($digit==1){
         $lastcodeserialno = "00".$lastcodenextSerial;
         
      }else{
          $lastcodeserialno = $lastcodenextSerial;
         
      }

      if($newdigit==2){
        
        $newcodeserialno = "0".$newcodenextSerial;
     }
      elseif($digit==1){
       
        $newcodeserialno = "00".$newcodenextSerial;
     }else{
        
         $newcodeserialno = $newcodenextSerial;
     }

      

      $lastCode=$startcCode.'-'.$lastcodeserialno;
      $newCode=$startcCode.'-'.$newcodeserialno;
      
             
     $json_response = array(
                        "last_code" => $lastCode,
                        'new_code'=>$newCode,
                        'alldtlusestartcode'=>$alldtlusestartcode
                      );

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit;


    }else
    {
        redirect('login','refresh');
    }


 }  
 public function getmemberdetails() {

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $member_id = $this->input->post('member_id');
        
        $details = $this->membertransfermodel->getmemberdetails($member_id); 

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
 
 public function savemembertransfer() {

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);        
    
    
        $member_id = trim(htmlspecialchars($dataArry['existing_code']));
        $change_code = trim(htmlspecialchars($dataArry['change_code']));
        $subscription = trim(htmlspecialchars($dataArry['subscription']));
        $social_sub = trim(htmlspecialchars($dataArry['social_sub']));
        $address_one = trim(htmlspecialchars($dataArry['address_one']));
        $address_two = trim(htmlspecialchars($dataArry['address_two']));
        $address_three = trim(htmlspecialchars($dataArry['address_three']));
        $phone = trim(htmlspecialchars($dataArry['phone']));
        $mobile_no = trim(htmlspecialchars($dataArry['mobile_no']));

        if($dataArry['from_date'] != ''){

            $fromdate = str_replace('/', '-', $dataArry['from_date']);
            $from_dt = date("Y-m-d",strtotime($fromdate));

            
        } else{

          $from_dt = NULL;
        }
       
        $whereid = array('member_id'=>$member_id);
        
        $memberdtl = $this->commondatamodel->getSingleRowByWhereCls('member_master',$whereid);
                   

                   $insert_array = array(
                                            'member_code' => $change_code,
                                            'title_one' => $memberdtl->title_one,
                                            'member_name' => $memberdtl->member_name,
                                            'date_of_birth' => $memberdtl->date_of_birth,
                                            'occupation_id' =>$memberdtl->occupation_id,
                                            'category' => $memberdtl->category,                                            
                                            'admission_date' => $from_dt,
                                            'address_one' => $address_one,
                                            'address_two' => $address_two,
                                            'address_three' => $address_three,
                                            'city' => $memberdtl->city,
                                            'pin' => $memberdtl->pin,
                                            'phone' => $phone,
                                            'mobile' => $mobile_no,
                                            'email' => $memberdtl->email, 
                                            'status' => 'ACTIVE MEMBER',
                                            'subscription' => $subscription,
                                            'min_billing'=>$memberdtl->min_billing,
                                            'min_ceiling'=>$memberdtl->min_ceiling,
                                            'social_subs' => $social_sub,
                                            'blocked_y_n'=>$memberdtl->blocked_y_n,
                                            'elt_member'=>$memberdtl->elt_member,
                                            'created_on' => date('Y-m-d'),
                                            'modify_date' => date('Y-m-d')
                                            
                                         );


        
         //pre($insert_array);exit;
         $insertData = $this->commondatamodel->insertSingleTableData('member_master',$insert_array);

         $update_arr = array('status'=>'TRANSFERRED');
         $Updatedata = $this->commondatamodel->updateSingleTableData('member_master',$update_arr,$whereid);

         $transferdtl_arr = array(
                                 'from_code'=>$memberdtl->member_code,
                                 'to_code'=> $change_code,
                                 'transfer_date'=>$from_dt
                               );  
          $transferid = $this->commondatamodel->insertSingleTableData('member_transfer_details',$transferdtl_arr);

          $activity_module='data Insert';
          $action = 'Insert';
          $method='Membertransfer/savemembertransfer'; 
          $master_id =$insertData;
          $tablename = 'member_master';
          $old_description = '';
          $description = json_encode($insert_array).'update id'.json_encode($whereid).'update_data-'.json_encode($update_arr).'transfer-id-'.$transferid;

        $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);                

                if($insertData)
                {
                    $json_response = array(
                        "msg_status" => 1,
                        "msg_data" => "Transfer Successfully",
                       
                    );
                }
                else
                {
                    $json_response = array(
                        "msg_status" => 0,
                        "msg_data" => "There is some problem.Try again"
                    );
                }
           

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit;
        

    }
    else
    {
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