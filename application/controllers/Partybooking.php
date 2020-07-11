<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partybooking extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);        
        $this->load->model('partybookingmodel','partybookingmodel',TRUE);        
                             
        
    }
    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {  
            $page = "dashboard/party/party-booking/partybooking_list";
            $header="";  
            $where = array('year_id' =>$session['yearid']);
            $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

           

            $result ['Allpartybookingcode'] = $this->partybookingmodel->getallpartybookinglist($session['yearid']);
            $result['locationlist'] = $this->commondatamodel->getAllRecordOrderBy('party_location_master','location_name','asc');
            $result['timeslotlist'] = array('DAY','AFTERNOON','NIGHT');

            createbody_method($result, $page, $header, $session);
            
        }else{
            redirect('login','refresh');
        }
        
    }  
    
    public function addeditpartybooking(){

        $session = $this->session->userdata('user_detail');
          if($this->session->userdata('user_detail'))
          {  
      
             if($this->uri->segment(3) == NULL){
      
              $result['mode'] = "ADD";
              $result['btnText'] = "Save";
              $result['btnTextLoader'] = "Saving...";
              $result['bookingId'] = 0;
              $result['partybookingEditdata'] = [];
              $result['allpartymemberlist'] = $this->partybookingmodel->getallpartymember();
      
             }else{
      
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $result['bookingId'] = $this->uri->segment(3);
      
                //$where = array('booking_id'=>$result['bookingId']);

                
      
                $result['partybookingEditdata'] = $this->partybookingmodel->getsingalbooking($result['bookingId']);
                $result['allpartymemberlist'] = $this->partybookingmodel->getallpartymemberforupdate($result['bookingId']);
      
             }
      
             $page = "dashboard/party/party-booking/addpartybooking";
              $header="";
       
             
              $result['locationlist'] = $this->commondatamodel->getAllRecordOrderBy('party_location_master','location_name','asc');
              $result['timeslotlist'] = array('DAY','AFTERNOON','NIGHT');
             //pre($result['partybookingEditdata']);exit;
      
              createbody_method($result, $page, $header, $session);
          }else{
              redirect('login','refresh');
          }
      }  
      public function addedit_action(){

        $session = $this->session->userdata('user_detail');
          if($this->session->userdata('user_detail'))
          {
    
              $dataArry=[];
              $json_response = array();
              $formData = $this->input->post('formDatas');
              parse_str($formData, $dataArry);
    
             
            $bookingId = trim(htmlspecialchars($this->input->post('bookingId')));            
            $mode = trim(htmlspecialchars($this->input->post('mode')));
            $mem_booking_id = trim(htmlspecialchars($this->input->post('mem_booking_id')));
            $mem_booking_code = trim(htmlspecialchars($this->input->post('mem_booking_code')));
           
            if(trim(htmlspecialchars($this->input->post('booking_date'))) != ''){
    
                $bookingdate = str_replace('/', '-', trim(htmlspecialchars($this->input->post('booking_date'))));
        
                $booking_dt = date('Y-m-d',strtotime($bookingdate));
                }else{
        
                $booking_dt=NULL;
        
                }
            if(trim(htmlspecialchars($this->input->post('party_date'))) != ''){
    
                $partydate = str_replace('/', '-', trim(htmlspecialchars($this->input->post('party_date'))));
        
                $party_dt = date('Y-m-d',strtotime($partydate));
                }else{
        
                $party_dt=NULL;
        
                }
            $time_slot = trim(htmlspecialchars($this->input->post('time_slot')));
            $party_location = trim(htmlspecialchars($this->input->post('party_location')));
            $no_of_heads = $this->input->post('no_of_heads');
            $narration = $this->input->post('narration');
    
           
    
                $data = array(
                               'member_master_code'=>$mem_booking_code,
                               'member_master_id'=>$mem_booking_id,
                               'booking_date'=>$booking_dt,
                               'party_date'=>$party_dt,
                               'time_slot'=>$time_slot,
                               'party_location_id'=>$party_location,
                               'heads'=>$no_of_heads,
                               'narration'=>$narration,
                               'is_cancel'=>'N',
                               'year_id'=>$session['yearid'],
                               'company_id'=>$session['companyid'],
                               'created_on'=>date('Y-m-d h:i:s'),
                               'modify_date'=>date('Y-m-d h:i:s')
                    
                            );
           
         //pre($data);exit;
         if($mode == 'ADD' && $bookingId == 0)
         {
                  
                  //pre($data);exit;                    
                   $insertupdata = $this->commondatamodel->insertSingleTableData('party_booking_master',$data); 
                   $masterid = $insertupdata;
    
            }else{
    
               $remove_arr = array('year_id'=>$session['yearid'],'company_id'=>$session['companyid'],'created_on'=>date('Y-m-d h:i:s'));   
              
               $updatearr = array_diff_assoc($data, $remove_arr);
               //pre($updatearr);exit;
               $upd_where = array('booking_id'=>$bookingId);
                // old details for auditral
              $olddetails = $this->commondatamodel->getSingleRowByWhereCls('party_booking_master',$upd_where);
    
              $insertupdata = $this->commondatamodel->updateSingleTableData('party_booking_master',$updatearr,$upd_where);
              $masterid = $bookingId;
    
            }               
    
                $activity_module= 'Party Booking';
                $action = ($mode == 'ADD') ? 'Insert':'Update';
                $method='partybooking/addedit_action'; 
                $master_id = $masterid;
                $tablename = 'party_booking_master';
                $old_description = ($mode == 'ADD') ? '':json_encode($olddetails);
                $description = json_encode($data);
    
               $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);
    
    
                    if($insertupdata){
    
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

    public function bookingcancel(){
      
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $bookingId = $this->input->post('uid');
            $is_cancel = $this->input->post('setstatus');
            

            $where = array('booking_id'=>$bookingId); 

            $bookingdtl = $this->commondatamodel->getSingleRowByWhereCls('party_booking_master',$where);

            $updatdata =  array('is_cancel'=>$is_cancel);
           
           
            $updata = $this->commondatamodel->updateSingleTableData('party_booking_master',$updatdata,$where);

                $activity_module= 'Party Booking';
                $action = 'Booking Cancel';
                $method='partybooking/bookingcancel'; 
                $master_id = $bookingId;
                $tablename = 'party_booking_master';
                $old_description = json_encode($bookingdtl);
                $description = json_encode($updatdata);
    
               $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);
    
               $json_response = array(
                "msg_status" => 1
              
               );
               header('Content-Type: application/json');
               echo json_encode( $json_response );
               exit; 

        }

        else{
            redirect('login','refresh');
        }

    }

    public function getparbookinglistbydate(){

        $session = $this->session->userdata('user_detail');
            if($this->session->userdata('user_detail'))
            {
    
                $from_dt = $this->input->post('from_dt');
                $to_dt = $this->input->post('to_date');
                $timeslot = $this->input->post('timeslot');
                $location_id = $this->input->post('location_id');
               
                if($from_dt!=""){
                    $from_dt = str_replace('/', '-', $from_dt);
                    $from_dt = date("Y-m-d",strtotime($from_dt));
                 }
                 else{
                     $from_dt = NULL;
                 }
    
                if($to_dt!=""){
                    $to_dt = str_replace('/', '-', $to_dt);
                    $to_dt = date("Y-m-d",strtotime($to_dt));
                 }
                 else{
                     $to_dt = NULL;
                 }
    
               $result['bookingList'] = $this->partybookingmodel->getbookingTransactionList($from_dt,$to_dt,$timeslot,$location_id);
               $page = "dashboard/party/party-booking/party_booking_partial_list";
    
              $this->load->view($page,$result);
    
             
    
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