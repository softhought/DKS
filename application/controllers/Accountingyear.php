<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountingyear extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('accountingyearmodel','accountingyearmodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/accounting-year/accountiing_year_list";
        $header="";  

       
        $result['accountingyearlist'] = $this->commondatamodel->getAllRecordOrderBy('financialyear','year_id','desc');
        //pre( $result['lastaccountingyear']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditaccyear(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['yearId'] = 0;
          $result['accountingyearEditdata'] = [];

           $result['lastaccountingyear'] = $this->accountingyearmodel->getlastAccountingyear();
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['yearId'] = $this->uri->segment(3);
  
            $where = array('year_id'=>$result['yearId']);

            $result['lastaccountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
  
            $result['accountingyearEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
             
  
         }

         

  
          $page = "dashboard/master/accounting-year/addedit_accounting_year";
          $header="";
   
  
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }


  public function accountingyear_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $yearId = trim(htmlspecialchars($dataArry['yearId']));

            if($dataArry['start_date'] != ''){

                $start_date = str_replace('/', '-', $dataArry['start_date']);
                $startdate = date("Y-m-d",strtotime($start_date));

                
            } else{

              $startdate = NULL;
            }

            if($dataArry['end_date'] != ''){

                $end_date = str_replace('/', '-', $dataArry['end_date']);
                $enddate = date("Y-m-d",strtotime($end_date));

                
            } else{

              $enddate = NULL;
            }

           $acc_period = trim(htmlspecialchars($dataArry['acc_period']));

           $shortstartdate = date('y',strtotime($startdate));
           $shortenddate = date('y',strtotime($enddate));

              
          $allserialmasterdata = $this->accountingyearmodel->getallserialmasterdata();
          
         //pre($allserialmasterdata);exit;
           
          $data = array('year'=>$acc_period,'start_date'=>$startdate,'end_date'=>$enddate,'is_active'=>'Y','short_year'=>$shortstartdate.'-'.$shortenddate);

        
            
            if($mode == 'ADD' && $yearId == 0){

              $insertdata = $this->commondatamodel->insertSingleTableData('financialyear',$data);

              foreach ($allserialmasterdata as $allserialmasterdata) {

               $insertseriadata = array(
                                         'serial'=>1,
                                         'moduleTag'=>$allserialmasterdata->moduleTag,
                                         'lastnumber'=>1,
                                         'noofpaddingdigit'=>$allserialmasterdata->noofpaddingdigit,
                                         'module'=>$allserialmasterdata->module,
                                         'companyid'=>$session['companyid'],
                                         'yearid'=>$insertdata,
                                         'yeartag'=>$shortstartdate.'-'.$shortenddate
                                        );
                
                $serialinsertdata = $this->commondatamodel->insertSingleTableData('serialmaster',$insertseriadata);
              

              }             
              
              $activity_module='data Insert';
              $action = 'Insert';
              $method='Accountingyear/accountingyear_action'; 
              $master_id =$insertdata;
              $tablename = 'financialyear';
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

               $upd_where = array('year_id'=>$yearId);
  
               $old_details = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$upd_where);

                $Updatedata = $this->commondatamodel->updateSingleTableData('financialyear',$data,$upd_where);                     

              $activity_module='data Update';
              $action = 'Update';
              $method='Accountingyear/accountingyear_action'; 
              $master_id =$yearId;
              $tablename = 'financialyear';
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