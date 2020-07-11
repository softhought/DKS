<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salarycomponent extends CI_Controller {

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
        $page = "dashboard/payroll/masters/salary_component/salary_component_list_view.php";
        $header="";  

        
  
        $result['salaryComponentList'] = $this->commondatamodel->getAllRecordWhere('salary_component_master',[]);

        //pre($result['tennisitemlist']);exit;
        
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }
 


public function addComponent(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $vendorID = 0;
                $result['salarycomponentID'] = $vendorID;
                $result['salarycompEditdata'] = [];
                
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $salarycomponentID = $this->uri->segment(3);
                $result['salarycomponentID'] = $salarycomponentID;
                

                $where = array('id' => $salarycomponentID, );
                 $result['salarycompEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('salary_component_master',$where); 
                 // pre($result['vendorEditdata']);exit;
                
            }

               
         $result['stateList'] = $this->commondatamodel->getAllRecordOrderBy('state_master','state_name','asc');

         // pre($result['stateList'] );exit;


            $header = "";
            $page = "dashboard/payroll/masters/salary_component/salary_component_add_edit.php";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function salarycomponent_action(){

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
            $salarycomponentID = trim(htmlspecialchars($dataArry['salarycomponentID']));
            $component_name = trim(htmlspecialchars($dataArry['component_name']));
            $sel_tag = trim(htmlspecialchars($dataArry['sel_tag']));
          
           

              if($salarycomponentID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */

                


                      $master_upd = array(
                                          'component_name' => $component_name, 
                                          'tag' => $sel_tag, 
                                          
                                        );
                      $upd_where = array('id' => $salarycomponentID );


                $update = $this->commondatamodel->updateSingleTableData('salary_component_master',$master_upd,$upd_where);




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
               


                 $salcom_master = array(
                                          'component_name' => $component_name, 
                                          'tag' => $sel_tag, 
                                          

                                        );

               $insertData = $this->commondatamodel->insertSingleTableData('salary_component_master',$salcom_master);

 

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