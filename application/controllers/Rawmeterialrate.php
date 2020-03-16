<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rawmeterialrate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('rawmeterialmodel','rawmeterialmodel',TRUE);
        $this->load->model('rawmeterialratemodel','rawmeterialratemodel',TRUE);
   
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/raw_meterial_rate/raw_meterial_rate_list_view";
        $header="";  
  
        $result['rawmeterialrateList'] = $this->rawmeterialratemodel->getAllRawMeterialrateList();

       // pre($result['rawmeterialrateList']);exit;
        
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }
 


public function addRawmeterialrate(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {    
              $company=$session['companyid'];
              $year=$session['yearid'];
     
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $rawmeterialrateID = 0;
                $result['rawmeterialrateID'] = $rawmeterialrateID;
                $result['rawmeterialrateEditdata'] = [];

            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $rawmeterialrateID = $this->uri->segment(3);
                $result['rawmeterialrateID'] = $rawmeterialrateID;
                
                $whereAry = [
                    'raw_meterial_master.raw_meterial_id' => $rawmeterialrateID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['rawmeterialrateEditdata'] = $this->rawmeterialratemodel->getRawmeterialRateDataById($rawmeterialrateID); 
                //  pre($result['cbnaatEditdata']);exit;  
            }


             
              $result['unitList'] = $this->commondatamodel->getAllRecordOrderBy('unit_master','item_unit_name','asc');
              $result['itemgroupList'] = $this->commondatamodel->getAllRecordOrderBy('store_item_group_master','group_name','asc');
              $result['itemsubgroupList'] = $this->commondatamodel->getAllRecordOrderBy('material_type_inv','material_type','asc');
              $result['supplierList'] = $this->commondatamodel->getAllRecordOrderBy('vendor_master','vendor_name','asc');

              $result['cgstrate'] = $this->rawmeterialratemodel->getGSTrate($company,$year,$type='CGST',$usedfor='O');
              $result['sgstrate'] = $this->rawmeterialratemodel->getGSTrate($company,$year,$type='SGST',$usedfor='O');
                
             $result['rawmeterialList'] = $this->commondatamodel->getAllRecordOrderBy('raw_meterial_master','name','asc');
            // pre($result['mainGroupList'] );exit;

            $header = "";
            $page = "dashboard/raw_meterial_rate/addedit_raw_meterial_rate.php";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function rawmeterialrate_action(){

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
            $rawmeterialrateID = trim(htmlspecialchars($dataArry['rawmeterialrateID']));
            //$description = trim(htmlspecialchars($dataArry['description']));
            $sel_rawmeterial = trim(htmlspecialchars($dataArry['sel_rawmeterial']));
          
            $sel_unit = trim(htmlspecialchars($dataArry['sel_unit']));
            $sel_supplier = trim(htmlspecialchars($dataArry['sel_supplier']));
            $rate = trim(htmlspecialchars($dataArry['rate']));
            $cgst_rate = trim(htmlspecialchars($dataArry['cgst_rate']));
            $sgst_rate = trim(htmlspecialchars($dataArry['sgst_rate']));
           

              if($rawmeterialrateID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                  // $whereAry = [
                  //   'raw_meterial_master.vendor_id' => $rawmeterialrateID
                  //  ];

               
                // $vendor_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('raw_meterial_master',$whereAry); 
                  $rawmeterialrate_master_upd = array(
                                          'rawmeterial_id' => $sel_rawmeterial, 
                                          'unit_id' => $sel_unit, 
                                          'supplier_id' => $sel_supplier, 
                                          'rate' => $rate, 
                                          'cgst_id' => $cgst_rate, 
                                          'sgst_id' => $sgst_rate, 
                                        );

                $upd_where = array('raw_meterial_rate.rate_id' => $rawmeterialrateID);

                $update = $this->commondatamodel->updateSingleTableData('raw_meterial_rate',$rawmeterialrate_master_upd,$upd_where);

                    

                     
                    // $activity_description = json_encode($vendor_array_upd);
                    // $old_description = json_encode($vendor_array_before_upd);
                    // $this->insertActivity($activity_description,$old_description,$rawmeterialrateID,"Update");

                    
                    
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
                    

             $activity_array=[];

              $rawmeterial_rate_master = array(
                                           'rawmeterial_id' => $sel_rawmeterial,  
                                          'unit_id' => $sel_unit, 
                                          'supplier_id' => $sel_supplier, 
                                          'rate' => $rate, 
                                          'cgst_id' => $cgst_rate, 
                                          'sgst_id' => $sgst_rate, 
                                          'created_on' => date('Y-m-d'), 
                                        );

              $insertData = $this->commondatamodel->insertSingleTableData('raw_meterial_rate',$rawmeterial_rate_master);
              $activity_array[]=$rawmeterial_rate_master;

 

                    $activity_description = json_encode($activity_array);
                    $this->insertActivity($activity_description,NULL,$insertData,"Insert");

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
                              "activity_module" => 'Inventory Main Group ',
                              "action" => $action,
                              "from_method" => 'maingroupinv/group_action',
                              "table_name" => 'main_group_inv',
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