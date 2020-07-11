<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salaryaccounts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('salaryaccountmodel','salaryaccountmodel',TRUE);    
    }


public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/payroll/masters/salary_and_accounts/salary_account_list_view.php";
        $header="";  

        
  
        $result['salaryAccountList'] = $this->salaryaccountmodel->getSalaryAccountlist();

        
        
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }
 


public function addSalaryaccounts(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $salaryaccountID = 0;
                $result['salaryaccountID'] = $salaryaccountID;
                $result['salarycompEditdata'] = [];
                
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $salaryaccountID = $this->uri->segment(3);
                $result['salaryaccountID'] = $salaryaccountID;
                

                $where = array('comp_dtl_id' => $salaryaccountID, );
                 $result['salarycompEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('salary_component_details',$where); 
                 // pre($result['vendorEditdata']);exit;
                
            }

               
         $result['componentList'] = $this->commondatamodel->getAllRecordOrderBy('salary_component_master','component_name','asc');
         $result['departmentList'] = $this->commondatamodel->getAllRecordOrderBy('department_master','dept_name','asc');

         $result['accountList'] = $this->commondatamodel->getAllRecordOrderBy('account_master','account_name','asc');
         // pre($result['accountList'] );exit;


            $header = "";
            $page = "dashboard/payroll/masters/salary_and_accounts/salary_accounts_add_edit.php";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function salaryaccount_action(){

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
            $salaryaccountID = trim(htmlspecialchars($dataArry['salaryaccountID']));
            $sel_component = trim(htmlspecialchars($dataArry['sel_component']));
            $sel_department = trim(htmlspecialchars($dataArry['sel_department']));
            $sel_account = trim(htmlspecialchars($dataArry['sel_account']));
          
           

              if($salaryaccountID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                     */

                      $master_upd = array(
                                          'compmonent_id' => $sel_component, 
                                          'department_id' => $sel_department, 
                                          'account_id' => $sel_account,
                                          
                                        );
                      $upd_where = array('comp_dtl_id' => $salaryaccountID );


                $update = $this->commondatamodel->updateSingleTableData('salary_component_details',$master_upd,$upd_where);




                    // $activity_description = json_encode($vendor_array_upd);
                    // $old_description = json_encode($vendor_array_before_upd);
                    // $this->insertActivity($activity_description,$old_description,$vendorID,"Update");

                    
                    
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
               


                 $salacc_master = array(
                                          'compmonent_id' => $sel_component, 
                                          'department_id' => $sel_department, 
                                          'account_id' => $sel_account, 
                                        );

               $insertData = $this->commondatamodel->insertSingleTableData('salary_component_details',$salacc_master);

 

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