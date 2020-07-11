<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Wastage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('wastagemodel','wastagemodel',TRUE);
          
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/wastage/wastage_list.php";
        $header="";  
  
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;

         $result['wastageList'] = $this->wastagemodel->getWastageListData($from_dt,$to_dt);

        //pre($result['voucherentryList']);exit;
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }


 public function addWastage(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $wastageID = 0;
                $result['wastageID'] = $wastageID;
                $result['wastageEditdata'] = [];
                $result['wastageDtlEditdata'] = [];
              
 
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $wastageID = $this->uri->segment(3);
                $result['wastageID'] = $wastageID;               
                $whereAry = [
                    'wastage_master.wastage_id' => $wastageID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['wastageEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('wastage_master',$whereAry); 
                 $result['wastageDtlEditdata'] = $this->wastagemodel->getAllWastageDetailsById($wastageID);

                //  pre($result['wastageDtlEditdata']);exit;
                
            }

            $result['departmentList'] = $this->commondatamodel->getAllRecordOrderBy('department_master_inv','department_name','asc');

             $result['rawmeterialList'] = $this->wastagemodel->getAllRawmeteriaList();

         // pre($result['rawmeterialList']);exit;

               
            $header = "";
            $page = "dashboard/wastage/wastage_entry_add_edit";
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
            $data['wastage'] = $this->input->post('wastage');
            $data['remarks'] = $this->input->post('remarks');
          

          
            $page = 'dashboard/wastage/wastage_details_partial_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }



    public function wastage_action(){

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
            $wastageID = trim(htmlspecialchars($dataArry['wastageID']));
           
            $serialmodule='WASTAGE';
            $activityArray=[];


            if($dataArry['transaction_dt']!=""){
                $transaction_dt = str_replace('/', '-', $dataArry['transaction_dt']);
                $transaction_dt = date("Y-m-d",strtotime($transaction_dt));
            }
            else{
                 $transaction_dt = NULL; 
            }

       

              if($wastageID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                   $whereAry = [
                    'wastage_master.wastage_id' => $wastageID
                   ];

               
                 $wastage_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('wastage_master',$whereAry); 

                  
                   $wastage_upd = array(
                                       
                                        'transaction_dt' => $transaction_dt 
                                       
                                       ); 

                     $upd_where_wastage = array('wastage_master.wastage_id' => $wastageID);
                     $update = $this->commondatamodel->updateSingleTableData('wastage_master',$wastage_upd,$upd_where_wastage);
                     $activityArray[]=$wastage_upd;

                     $delete_where = array('wastage_details.wastage_mst_id' => $wastageID);
                     $this->commondatamodel->deleteTableData('wastage_details',$delete_where);

                    if (isset($dataArry['rawmeterialid'])) {

                            $rawmeterialid = $dataArry['rawmeterialid'];
                            $rowwastage = $dataArry['rowwastage'];
                            $rowremarks = $dataArry['rowremarks'];
                           
                      for ($i=0; $i <count($dataArry['rawmeterialid']) ; $i++) { 

                                $wastage_dtl_inst = array(
                                                        'wastage_mst_id' => $wastageID, 
                                                        'raw_meterial_id' => $rawmeterialid[$i], 
                                                        'wastage_quantity' => $rowwastage[$i], 
                                                        'remarks' => $rowremarks[$i], 
                                                        );

                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('wastage_details',$wastage_dtl_inst);
                $activityArray[]=$wastage_dtl_inst;

                }


                }  

                     
                    



                    $activity_description = json_encode($activityArray);
                    $old_description = json_encode($wastage_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$wastageID,"Update");

                    
                    
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

             $transaction_no= $this->wastagemodel->getSerialNumber($company,$year,$serialmodule);
                    $wastage_inst = array(
                                        'transaction_no' => $transaction_no, 
                                        'transaction_dt' => $transaction_dt, 
                                        'created_on' => date('Y-m-d')
                                       );

             $wastageId = $this->commondatamodel->insertSingleTableData('wastage_master',$wastage_inst);

               $activityArray[]=$wastage_inst;

              if (isset($dataArry['rawmeterialid'])) {

                            $rawmeterialid = $dataArry['rawmeterialid'];
                            $rowwastage = $dataArry['rowwastage'];
                            $rowremarks = $dataArry['rowremarks'];
                           
               for ($i=0; $i <count($dataArry['rawmeterialid']) ; $i++) { 

                                $wastage_dtl_inst = array(
                                                        'wastage_mst_id' => $wastageId, 
                                                        'raw_meterial_id' => $rawmeterialid[$i], 
                                                        'wastage_quantity' => $rowwastage[$i], 
                                                        'remarks' => $rowremarks[$i], 
                                                        );

                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('wastage_details',$wastage_dtl_inst);
                $activityArray[]=$wastage_dtl_inst;

                }


                }  



                 



 
                    $activity_description = json_encode($activityArray);
                    $this->insertActivity($activity_description,NULL,$wastageId,"Insert");

                    if($wastageId)
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
                              "activity_module" => 'Wastage Entry',
                              "action" => $action,
                              "from_method" => 'wastage/wastage_action',
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