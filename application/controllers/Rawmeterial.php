<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rawmeterial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('rawmeterialmodel','rawmeterialmodel',TRUE);
   
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
         $page = "dashboard/raw_meterial/raw_meterial_list_view.php";
        $header="";  
  
        $result['rawmeterialList'] = $this->rawmeterialmodel->getAllRawMeterialList();

        //pre($result['rawmeterialList']);exit;
        
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }
 


public function addRawmeterial(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $rawmeterialID = 0;
                $result['rawmeterialID'] = $rawmeterialID;
                $result['rawmeterialEditdata'] = [];

            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $rawmeterialID = $this->uri->segment(3);
                $result['rawmeterialID'] = $rawmeterialID;
                
                $whereAry = [
                    'raw_meterial_master.raw_meterial_id' => $rawmeterialID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['rawmeterialEditdata'] = $this->rawmeterialmodel->getRawmeterialDataById($rawmeterialID); 
                //  pre($result['cbnaatEditdata']);exit;
                
            }



              
              $result['mainGroupList'] = $this->commondatamodel->getAllRecordOrderBy('main_group_master','group_desc','asc');
              $result['unitList'] = $this->commondatamodel->getAllRecordOrderBy('unit_master','item_unit_name','asc');
              $result['itemgroupList'] = $this->commondatamodel->getAllRecordOrderBy('store_item_group_master','group_name','asc');
              $result['itemsubgroupList'] = $this->commondatamodel->getAllRecordOrderBy('material_type_inv','material_type','asc');
      

            // pre($result['mainGroupList'] );exit;


            $header = "";
            $page = "dashboard/raw_meterial/addedit_raw_meterial.php";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function rawmeterial_action(){

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
            $rawmeterialID = trim(htmlspecialchars($dataArry['rawmeterialID']));
            $name = trim(htmlspecialchars($dataArry['name']));
            $sel_group = trim(htmlspecialchars($dataArry['sel_group']));
            $sel_unit = trim(htmlspecialchars($dataArry['sel_unit']));
            $store_item_group = trim(htmlspecialchars($dataArry['store_item_group']));
            $material_type = trim(htmlspecialchars($dataArry['material_type']));
            $opening_balance = trim(htmlspecialchars($dataArry['opening_balance']));
            $min_order_level = trim(htmlspecialchars($dataArry['min_order_level']));
           

              if($rawmeterialID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                  // $whereAry = [
                  //   'raw_meterial_master.vendor_id' => $rawmeterialID
                  //  ];

               
                // $vendor_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('raw_meterial_master',$whereAry); 
                  $rawmeterial_master_upd = array(
                                          'name' => $name, 
                                          'main_group_id' => $sel_group, 
                                          'unit_id' => $sel_unit, 
                                          'store_item_group' => $store_item_group, 
                                          'material_type_id' => $material_type, 
                                          'min_order_level' => $min_order_level, 
                                          'created_on' => date('Y-m-d'), 
                                        );

                    $upd_where = array('raw_meterial_master.raw_meterial_id' => $rawmeterialID);

                    $update = $this->commondatamodel->updateSingleTableData('raw_meterial_master',$rawmeterial_master_upd,$upd_where);

                    $update_open = array('open_balance' => $opening_balance );
                    $upd_open_where = array('raw_meterial_opening.raw_meterial_id' => $rawmeterialID);
                    $update2 = $this->commondatamodel->updateSingleTableData('raw_meterial_opening',$update_open,$upd_open_where);

                     
                    // $activity_description = json_encode($vendor_array_upd);
                    // $old_description = json_encode($vendor_array_before_upd);
                    // $this->insertActivity($activity_description,$old_description,$rawmeterialID,"Update");

                    
                    
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

              $rawmeterial_master = array(
                                          'name' => $name, 
                                          'main_group_id' => $sel_group, 
                                          'unit_id' => $sel_unit, 
                                          'store_item_group' => $store_item_group, 
                                          'material_type_id' => $material_type, 
                                          'min_order_level' => $min_order_level, 
                                          'created_on' => date('Y-m-d'), 
                                        );

              $rawmeterial_id = $this->commondatamodel->insertSingleTableData('raw_meterial_master',$rawmeterial_master);
              $activity_array[]=$rawmeterial_master;

 
                $raw_meterial_opening = array(
                                              'raw_meterial_id' => $rawmeterial_id,   
                                              'open_balance' => $opening_balance,   
                                              'company_id' => $company,   
                                              'year_id' => $year,      
                                         );

               $insertData = $this->commondatamodel->insertSingleTableData('raw_meterial_opening',$raw_meterial_opening);

                $activity_array[]=$raw_meterial_opening;

                    $activity_description = json_encode($activity_array);
                    $this->insertActivity($activity_description,NULL,$rawmeterial_id,"Insert");

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