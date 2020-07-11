<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Goodsreceiptnote extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('purchaseordermodel','purchaseordermodel',TRUE);
        $this->load->model('Goodsreceiptnotemodel','grnmodel',TRUE);
          
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
         $page = "dashboard/grn/grn_list.php";
         $header="";  
  
         $company=$session['companyid'];
         $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;

         $result['grnList'] = $this->grnmodel->getGrnListData($from_dt,$to_dt);

        // pre($result['grnList']);exit;

       
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }


 public function addGrn(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $grnID = 0;
                $result['grnID'] = $grnID;
                $result['grnMasterEditdata'] = [];
                $result['grnDetailsEditdata'] = [];
               
 
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $grnID = $this->uri->segment(3);
                $result['grnID'] = $grnID;               
                $whereAry = [
                    'grn_master.grn_id' => $grnID
                ];

                 // getSingleRowByWhereCls(tablename,where params)
                 $result['grnMasterEditdata'] = $this->grnmodel->getGrnMasterdata($grnID); 

             $result['grnDetailsEditdata'] = $this->grnmodel->getGrnDetailsBymasterId($grnID);

              //  pre($result['grnMasterEditdata']);exit;
                
            }


              $result['allvendorList'] = $this->purchaseordermodel->getAllVendorList();
              $result['rawmeterialList'] = $this->purchaseordermodel->getAllRawmeterialList();

              $result['purchaseOrderList'] = $this->grnmodel->getAllPurchaseorderNo();

               $result['departmentList'] = $this->commondatamodel->getAllRecordOrderBy('department_master_inv','department_name','asc');

                // pre($result['purchaseOrderList']);exit;

               
            $header = "";
            $page = "dashboard/grn/grn_add_edit.php";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function addRawMeterialDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
            $purchaseorderID = $this->input->post('purchase_id');

            $data['purchaseDetailsData'] = $this->grnmodel->getpurchaseDetailsBymasterId($purchaseorderID);

          //  pre($data['purchaseDetailsData']);exit;
         
            $page = 'dashboard/grn/grn_partial_purches_details_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }



    public function grn_action(){

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
            $grnID = trim(htmlspecialchars($dataArry['grnID']));
            $grn_no = trim(htmlspecialchars($dataArry['grn_no']));
            
            $challan_no = trim(htmlspecialchars($dataArry['challan_no']));
            $purchase_order_no = trim(htmlspecialchars($dataArry['purchase_order_no']));
            $department_id = trim(htmlspecialchars($dataArry['department_id']));

          
            $serialmodule='GOODS RECEIPTS NOTE';
            $activityArray=[];


            if($dataArry['grn_date']!=""){
                $grn_date = str_replace('/', '-', $dataArry['grn_date']);
                $grn_date = date("Y-m-d",strtotime($grn_date));
            }
            else{
                 $grn_date = NULL; 
            }



            if($dataArry['challan_date']!=""){
                $challan_date = str_replace('/', '-', $dataArry['challan_date']);
                $challan_date = date("Y-m-d",strtotime($challan_date));
            }
            else{
                 $challan_date = NULL; 
            }

       

              if($grnID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                   $whereAry = [
                    'grn_master.grn_id' => $grnID
                   ];

                $grnarray_before_upd = $this->commondatamodel->getSingleRowByWhereCls('grn_master',$whereAry); 

                     $grn_upd= array(
                                          
                                            'grn_date' => $grn_date, 
                                            'challan_no' => $challan_no, 
                                            'challan_date' => $challan_date, 
                                            'purchase_order_id' => $purchase_order_no, 
                                            'department_id' => $department_id, 
                                            
                                        );  

               
       

                    /* Update voucher */

                     $upd_where_grnmst = array('grn_master.grn_id' => $grnID);
                     $update = $this->commondatamodel->updateSingleTableData('grn_master',$grn_upd,$upd_where_grnmst);

                     $activityArray[]=$grn_upd;
                     $delete_where = array('grn_details.grn_master_id' => $grnID);
                     $this->commondatamodel->deleteTableData('grn_details',$delete_where);

              if (isset($dataArry['rowrawmeterial'])) {

                            $rowrawmeterial = $dataArry['rowrawmeterial'];
                            $rowunit = $dataArry['rowunit'];
                            $rowquantity = $dataArry['rowquantity'];
                            $rowrate = $dataArry['rowrate'];
                            $rowpurchasedtlid = $dataArry['rowpurchasedtlid'];
                           

                                $sl=1;
                              for ($i=0; $i <count($dataArry['rowrawmeterial']) ; $i++) { 


                                   $grn_dtl_inst = array(
                                                                'grn_master_id' => $grnID, 
                                                                'purchase_order_dtl_id' => $rowpurchasedtlid[$i], 
                                                                'raw_material_id' => $rowrawmeterial[$i], 
                                                                'quantity' => $rowquantity[$i], 
                                                                'rate' => $rowrate[$i], 
                                                                
                                                              );


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('grn_details',$grn_dtl_inst);
                $activityArray[]=$grn_dtl_inst;

                     }


                        }  

             


                    $activity_description = json_encode($activityArray);
                    $old_description = json_encode($grnarray_before_upd);
                    $this->insertActivity($activity_description,$old_description,$grnID,"Update");

                    
                    
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

               $grn_no= $this->grnmodel->getSerialNumber($company,$year,$serialmodule);


                $grn_insert = array(
                                            'grn_no' => $grn_no, 
                                            'grn_date' => $grn_date, 
                                            'challan_no' => $challan_no, 
                                            'challan_date' => $challan_date, 
                                            'purchase_order_id' => $purchase_order_no,
                                            'department_id' => $department_id,  
                                            
                                        );    
               
             $grnId = $this->commondatamodel->insertSingleTableData('grn_master',$grn_insert);
           $activityArray[]=$grn_insert;

                        if (isset($dataArry['rowrawmeterial'])) {

                            $rowrawmeterial = $dataArry['rowrawmeterial'];
                            $rowunit = $dataArry['rowunit'];
                            $rowquantity = $dataArry['rowquantity'];
                            $rowrate = $dataArry['rowrate'];
                            $rowpurchasedtlid = $dataArry['rowpurchasedtlid'];
                           

                                $sl=1;
                              for ($i=0; $i <count($dataArry['rowrawmeterial']) ; $i++) { 


                                   $grn_dtl_inst = array(
                                                                'grn_master_id' => $grnId, 
                                                                'purchase_order_dtl_id' => $rowpurchasedtlid[$i], 
                                                                'raw_material_id' => $rowrawmeterial[$i], 
                                                                'quantity' => $rowquantity[$i], 
                                                                'rate' => $rowrate[$i], 
                                                                
                                                              );


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('grn_details',$grn_dtl_inst);
                $activityArray[]=$grn_dtl_inst;

                     }


                        }  



                 



 
                    $activity_description = json_encode($activityArray);
                    $this->insertActivity($activity_description,NULL,$grnId,"Insert");

                    if($grnId)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD",
                           
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
                              "activity_module" => 'GRn Receipt Note',
                              "action" => $action,
                              "from_method" => 'goodsreceiptnote/grn_action',
                              "table_name" => 'grn_master',
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


public function rawmeterialRateDetails(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $rawmeterial_id = $this->input->post('raw_meterial');
            $vendor_id = $this->input->post('vendor_id');

            $rawMeterrialData = $this->purchaseordermodel->getRawmeterialRate($rawmeterial_id,$vendor_id);

           // pre($rawMeterrialData);

                    if($rawMeterrialData)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => $rawMeterrialData
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => ""
                        );
                    }

      

       

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 


         }else{
            redirect('login','refresh');
        }   

  }


public function getGrnListByDate(){

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


        

               $result['grnList'] = $this->grnmodel->getGrnListData($from_dt,$to_dt);


         // pre($result['partyBillList']);exit;

         $page = "dashboard/grn/grn_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    } 








} // end of class