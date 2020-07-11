<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Issue extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('issuemodel','issuemodel',TRUE);
          
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/issue/issue_list.php";
        $header="";  
  
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;

         $result['issueList'] = $this->issuemodel->getIssueListData($from_dt,$to_dt);

        //pre($result['voucherentryList']);exit;
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }


 public function addIssue(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $issueID = 0;
                $result['issueID'] = $issueID;
                $result['issueEditdata'] = [];
                $result['issueDtlEditdata'] = [];
              
 
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $issueID = $this->uri->segment(3);
                $result['issueID'] = $issueID;               
                $whereAry = [
                    'issue_master.issue_id' => $issueID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['issueEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('issue_master',$whereAry); 
                 $result['issueDtlEditdata'] = $this->issuemodel->getAllissueDetailsById($issueID);

                //  pre($result['issueDtlEditdata']);exit;
                
            }

            $result['departmentList'] = $this->commondatamodel->getAllRecordOrderBy('department_master_inv','department_name','asc');

             $result['rawmeterialList'] = $this->issuemodel->getAllRawmeteriaList();

         // pre($result['rawmeterialList']);exit;

               
            $header = "";
            $page = "dashboard/issue/issue_entry_add_edit";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function addDetails()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
        

            $data['rowno'] = $this->input->post('rowNo');

            $data['rawmeterial_id'] = $this->input->post('rawmeterial_id');
            $data['rawmeterialname'] = $this->input->post('rawmeterialname'); 
            $data['unit_name'] = $this->input->post('unit_name'); 
            $data['quantity_sent'] = $this->input->post('quantity_sent');
          

          
            $page = 'dashboard/issue/issue_details_partial_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }



    public function issue_action(){

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
            $issueID = trim(htmlspecialchars($dataArry['issueID']));
            $department_id = trim(htmlspecialchars($dataArry['department_id']));
            $serialmodule='ISSUE';
            $activityArray=[];


            if($dataArry['issue_dt']!=""){
                $issue_dt = str_replace('/', '-', $dataArry['issue_dt']);
                $issue_dt = date("Y-m-d",strtotime($issue_dt));
            }
            else{
                 $issue_dt = NULL; 
            }

       

              if($issueID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                   $whereAry = [
                    'issue_master.issue_id' => $issueID
                   ];

               
                 $issue_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('issue_master',$whereAry); 

                  
                    $issue_upd = array(
                                       
                                        'issue_date' => $issue_dt, 
                                        'department_id' => $department_id, 
                                       
                                       );   

                     $upd_where_issue = array('issue_master.issue_id' => $issueID);
                     $update = $this->commondatamodel->updateSingleTableData('issue_master',$issue_upd,$upd_where_issue);
                     $activityArray[]=$issue_upd;

                     $delete_where = array('issue_details.issue_mst_id' => $issueID);
                     $this->commondatamodel->deleteTableData('issue_details',$delete_where);

                     
                        if (isset($dataArry['rawmeterialid'])) {

                                    $rawmeterialid = $dataArry['rawmeterialid'];
                                    $rowqtysent = $dataArry['rowqtysent'];
                                   
                       for ($i=0; $i <count($dataArry['rawmeterialid']) ; $i++) { 

                                        $issue_dtl_inst = array(
                                                                'issue_mst_id' => $issueID, 
                                                                'raw_meterial_id' => $rawmeterialid[$i], 
                                                                'quantity' => $rowqtysent[$i], 
                                                                );


                        $insert_dtl_1= $this->commondatamodel->insertSingleTableData('issue_details',$issue_dtl_inst);
                        $activityArray[]=$issue_dtl_inst;

                        }


                        }  

                     
                    



                    $activity_description = json_encode($activityArray);
                    $old_description = json_encode($issue_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$issueID,"Update");

                    
                    
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

               $issue_no= $this->issuemodel->getSerialNumber($company,$year,$serialmodule);

                    $issue_inst = array(
                                        'issue_no' => $issue_no, 
                                        'issue_date' => $issue_dt, 
                                        'department_id' => $department_id, 
                                        'created_on' => date('Y-m-d')
                                       );

        
               
             $issueId = $this->commondatamodel->insertSingleTableData('issue_master',$issue_inst);

               $activityArray[]=$issue_inst;

                if (isset($dataArry['rawmeterialid'])) {

                            $rawmeterialid = $dataArry['rawmeterialid'];
                            $rowqtysent = $dataArry['rowqtysent'];
                           
               for ($i=0; $i <count($dataArry['rawmeterialid']) ; $i++) { 

                                $issue_dtl_inst = array(
                                                        'issue_mst_id' => $issueId, 
                                                        'raw_meterial_id' => $rawmeterialid[$i], 
                                                        'quantity' => $rowqtysent[$i], 
                                                        );


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('issue_details',$issue_dtl_inst);
                $activityArray[]=$issue_dtl_inst;

                }


                }  



                 



 
                    $activity_description = json_encode($activityArray);
                    $this->insertActivity($activity_description,NULL,$issueId,"Insert");

                    if($issueId)
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


public function getIssuerEntryByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
          
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


        

            $result['issueList'] = $this->issuemodel->getIssueListData($from_dt,$to_dt);

         $page = "dashboard/issue/issue_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }




function insertActivity($description,$old_description,$table_id,$action){
$session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'Issue Entry',
                              "action" => $action,
                              "from_method" => 'issue/issue_action',
                              "table_name" => 'issue_master',
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