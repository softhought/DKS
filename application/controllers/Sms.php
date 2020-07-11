<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('vendormodel','vendormodel',TRUE);    
    }


public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/sms/sms_list_view.php";
        $header="";  

        
  
        $result['smsList'] = $this->commondatamodel->getAllRecordWhere('sms_master',[]);

        //pre($result['tennisitemlist']);exit;
        
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }
 


public function addSms(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $smsID = 0;
                $result['smsID'] = $smsID;
                $result['smsEditdata'] = [];
                
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $smsID = $this->uri->segment(3);
                $result['smsID'] = $smsID;
                

                $where = array('id' => $smsID, );
                 $result['smsEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('sms_master',$where); 
                 // pre($result['salarycompEditdata']);exit;
                
            }

        

            $header = "";
            $page = "dashboard/sms/sms_add_edit";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function sms_action(){

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
            $smsID = trim(htmlspecialchars($dataArry['smsID']));
            $module_name = trim(htmlspecialchars($dataArry['module_name']));
            $sms_content = trim(htmlspecialchars($dataArry['sms_content']));
          
           

              if($smsID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */

                      $master_upd = array(
                                          'module' => $module_name, 
                                          'sms_content' => $sms_content, 
                                          
                                        );
                      $upd_where = array('id' => $smsID );


                $update = $this->commondatamodel->updateSingleTableData('sms_master',$master_upd,$upd_where);


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
               


                 $sms_master = array(
                                          'module' => $module_name, 
                                          'sms_content' => $sms_content, 
                                          
                                        );

               $insertData = $this->commondatamodel->insertSingleTableData('sms_master',$sms_master);

 

                    // $activity_description = json_encode($vendor_array);
                    // $this->insertActivity($activity_description,NULL,$insertData,"Insert");

                    if($insertData)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD"
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }



                 


                } // end add mode ELSE PART
      

       

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 


         }else{
            redirect('login','refresh');
        }   

  } 



function insertActivity($description,$old_description,$table_id,$action){
$session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'vendor ',
                              "action" => $action,
                              "from_method" => 'vendor/vendor_action',
                              "table_name" => 'vendor_master',
                              "module_master_id" => $table_id,
                              "user_id" => $session['userid'],
                              "ip_address" => getUserIPAddress(),
                              "user_browser" => getUserBrowserName(),
                              "user_platform" => getUserPlatform(),
                              "description" =>  $description,
                              "old_description" =>  $old_description
                             );
                             
                $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);



}









} // end of class