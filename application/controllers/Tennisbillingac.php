<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tennisbillingac extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('tennisbillingacmodel','tennisbillingacmodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/student_category_ac/student_category_list_view";
        $header="";  

        $result['categorylist'] = $this->tennisbillingacmodel->getAllCategoryDetails();
       // pre($result['categorylist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addCategoryac(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['categoryId'] = 0;
        $result['categoryEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['categoryId'] = $this->uri->segment(3);

          $where = array('student_category_id'=>$result['categoryId']);

          $result['categoryEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('student_category',$where);
           

       }

        $page = "dashboard/master/student_category_ac/addedit_category_view";
        $header="";
 
        $result['accountmasterlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('account_master',[],'account_name');
       
       // pre($result['accountmasterlist']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}




public function category_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $categoryId = trim(htmlspecialchars($dataArry['categoryId']));
           
            $dracccountid = trim($dataArry['dracccountid']);
            $cracccountid = trim($dataArry['cracccountid']);
            

            $data = array(
                          'dr_account_id'=>$dracccountid,
                          'cr_account_id'=>$cracccountid
                        );

            
            if($mode == 'ADD' && $categoryId == 0){

             


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

                $upd_where = array('student_category.student_category_id' => $categoryId);

               // old details
              $old_details = $this->commondatamodel->getSingleRowByWhereCls('student_category',$upd_where);

               $Updatedata = $this->commondatamodel->updateSingleTableData('student_category',$data,$upd_where);

              $activity_module='Data Update';
              $action = 'Update';
              $method='category_action'; 
              $master_id =$categoryId;
              $tablename = 'student_category';
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