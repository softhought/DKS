<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('purchaseordermodel','purchaseordermodel',TRUE);
          
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
         $page = "dashboard/purchase_order/purchase_order_list.php";
         $header="";  
  
         $company=$session['companyid'];
         $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;

         $result['purchaseOrderList'] = $this->purchaseordermodel->getPurchaseOrderList($from_dt,$to_dt);

       
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }


 public function addPurchaseorder(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $purchaseorderID = 0;
                $result['purchaseorderID'] = $purchaseorderID;
                $result['purchaseMasterEditdata'] = [];
                $result['purchaseDetailsEditdata'] = [];
               
 
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $purchaseorderID = $this->uri->segment(3);
                $result['purchaseorderID'] = $purchaseorderID;               
                $whereAry = [
                    'purchase_master.purchase_id' => $purchaseorderID
                ];

                 // getSingleRowByWhereCls(tablename,where params)
                 $result['purchaseMasterEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('purchase_master',$whereAry); 

                 $result['purchaseDetailsEditdata'] = $this->purchaseordermodel->getpurchaseDetailsBymasterId($purchaseorderID);

               // pre($result['purchaseDetailsEditdata']);exit;
                
            }


              $result['allvendorList'] = $this->purchaseordermodel->getAllVendorList();
              $result['rawmeterialList'] = $this->purchaseordermodel->getAllRawmeterialList();

         // pre($result['allvendorList']);exit;

               
            $header = "";
            $page = "dashboard/purchase_order/purchase_order_entry_add_edit.php";
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
        

            $data['rowno'] = $this->input->post('rowNo');

            $data['raw_meterial'] = $this->input->post('raw_meterial');
            $data['raw_meterial_name'] = $this->input->post('raw_meterial_name');
            $data['unit'] = $this->input->post('unit');
            $data['quantity'] = $this->input->post('quantity');
            $data['rate'] = $this->input->post('rate');
            $data['taxable_amt'] = $this->input->post('taxable_amt');
            $data['cgstrateid'] = $this->input->post('cgst_rate_id');
            $data['sgstrateid'] = $this->input->post('sgst_rate_id');
            $data['cgstrate'] = $this->input->post('cgst_rate');
            $data['cgstamt'] = $this->input->post('cgst_amt');
            $data['sgstrate'] = $this->input->post('sgst_rate');
            $data['sgstamt'] = $this->input->post('sgst_amt');
            $data['net_amt'] = $this->input->post('net_amt');
       

         
            $page = 'dashboard/purchase_order/purchase_details_partial_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }



    public function purchase_action(){

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
            $purchaseorderID = trim(htmlspecialchars($dataArry['purchaseorderID']));
            $order_no = trim(htmlspecialchars($dataArry['order_no']));
            $quotation_no = trim(htmlspecialchars($dataArry['quotation_no']));
            $vendor_id = trim(htmlspecialchars($dataArry['vendor_id']));
            $total_amt = trim(htmlspecialchars($dataArry['total_amt']));
            $roundoff = trim(htmlspecialchars($dataArry['roundoff']));
            $net_amount = trim(htmlspecialchars($dataArry['net_amount']));
            $serialmodule='RAW MATERIAL PURCHASE';
            $activityArray=[];


            if($dataArry['order_date']!=""){
                $order_date = str_replace('/', '-', $dataArry['order_date']);
                $order_date = date("Y-m-d",strtotime($order_date));
            }
            else{
                 $order_date = NULL; 
            }

            if($dataArry['quotation_date']!=""){
                $quotation_date = str_replace('/', '-', $dataArry['quotation_date']);
                $quotation_date = date("Y-m-d",strtotime($quotation_date));
            }
            else{
                 $quotation_date = NULL; 
            }

       

              if($purchaseorderID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */
                   $whereAry = [
                    'purchase_master.purchase_id' => $purchaseorderID
                   ];

                     $parchase_upd= array(
                                         
                                            'order_date' => $order_date, 
                                            'quotation_no' => $quotation_no, 
                                            'quotation_date' => $quotation_date, 
                                            'vendor_id' => $vendor_id, 
                                            'total_amount' => $total_amt, 
                                            'round_off' => $roundoff, 
                                            'net_amount' => $net_amount
                                        );    
               

               
                 $purchase_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('purchase_master',$whereAry); 

                    /* Update voucher */

                     $upd_where_purmst = array('purchase_master.purchase_id' => $purchaseorderID);
                     $update = $this->commondatamodel->updateSingleTableData('purchase_master',$parchase_upd,$upd_where_purmst);
                     $activityArray[]=$parchase_upd;
                     $delete_where = array('purchase_details.purchase_master_id' => $purchaseorderID);
                     $this->commondatamodel->deleteTableData('purchase_details',$delete_where);

                           if (isset($dataArry['rowrawmeterial'])) {

                            $rowrawmeterial = $dataArry['rowrawmeterial'];
                            $rowunit = $dataArry['rowunit'];
                            $rowquantity = $dataArry['rowquantity'];
                            $rowrate = $dataArry['rowrate'];
                            $rowtaxableamt = $dataArry['rowtaxableamt'];
                            $item_cgst_raterow = $dataArry['item_cgst_raterow'];
                            $item_cgst_amtrow = $dataArry['item_cgst_amtrow'];
                            $item_sgst_raterow = $dataArry['item_sgst_raterow'];
                            $item_sgst_amtrow = $dataArry['item_sgst_amtrow'];
                            $item_netamtrow = $dataArry['item_netamtrow'];

                                $sl=1;
                              for ($i=0; $i <count($dataArry['rowrawmeterial']) ; $i++) { 

                                   $purchase_dtl_inst = array(
                                                                'purchase_master_id' => $purchaseorderID, 
                                                                'raw_material_id' => $rowrawmeterial[$i], 
                                                                'item_quantity' => $rowquantity[$i], 
                                                                'item_rate' => $rowrate[$i], 
                                                                'taxable_amt' => $rowtaxableamt[$i], 
                                                                'cgst_id' => $item_cgst_raterow[$i], 
                                                                'sgst_id' => $item_sgst_raterow[$i], 
                                                                'cgst_amt' => $item_cgst_amtrow[$i], 
                                                                'sgst_amt' => $item_sgst_amtrow[$i], 
                                                                'net_amount' => $item_netamtrow[$i], 
                                                              );


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('purchase_details',$purchase_dtl_inst);
                $activityArray[]=$purchase_dtl_inst;

                     }


                        }  


                   

                     
                    



                    $activity_description = json_encode($activityArray);
                    $old_description = json_encode($purchase_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$purchaseorderID,"Update");

                    
                    
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

               $order_no= $this->purchaseordermodel->getSerialNumber($company,$year,$serialmodule);


                $parchase_insert = array(
                                            'order_no' => $order_no, 
                                            'order_date' => $order_date, 
                                            'quotation_no' => $quotation_no, 
                                            'quotation_date' => $quotation_date, 
                                            'vendor_id' => $vendor_id, 
                                            'total_amount' => $total_amt, 
                                            'round_off' => $roundoff, 
                                            'net_amount' => $net_amount
                                        );    
               
             $purchaseId = $this->commondatamodel->insertSingleTableData('purchase_master',$parchase_insert);
           $activityArray[]=$parchase_insert;

                        if (isset($dataArry['rowrawmeterial'])) {

                            $rowrawmeterial = $dataArry['rowrawmeterial'];
                            $rowunit = $dataArry['rowunit'];
                            $rowquantity = $dataArry['rowquantity'];
                            $rowrate = $dataArry['rowrate'];
                            $rowtaxableamt = $dataArry['rowtaxableamt'];
                            $item_cgst_raterow = $dataArry['item_cgst_raterow'];
                            $item_cgst_amtrow = $dataArry['item_cgst_amtrow'];
                            $item_sgst_raterow = $dataArry['item_sgst_raterow'];
                            $item_sgst_amtrow = $dataArry['item_sgst_amtrow'];
                            $item_netamtrow = $dataArry['item_netamtrow'];

                                $sl=1;
                              for ($i=0; $i <count($dataArry['rowrawmeterial']) ; $i++) { 


                                   $purchase_dtl_inst = array(
                                                                'purchase_master_id' => $purchaseId, 
                                                                'raw_material_id' => $rowrawmeterial[$i], 
                                                                'item_quantity' => $rowquantity[$i], 
                                                                'item_rate' => $rowrate[$i], 
                                                                'taxable_amt' => $rowtaxableamt[$i], 
                                                                'cgst_id' => $item_cgst_raterow[$i], 
                                                                'sgst_id' => $item_sgst_raterow[$i], 
                                                                'cgst_amt' => $item_cgst_amtrow[$i], 
                                                                'sgst_amt' => $item_sgst_amtrow[$i], 
                                                                'net_amount' => $item_netamtrow[$i], 
                                                              );


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('purchase_details',$purchase_dtl_inst);
                $activityArray[]=$purchase_dtl_inst;

                     }


                        }  



                 



 
                    $activity_description = json_encode($activityArray);
                    $this->insertActivity($activity_description,NULL,$purchaseId,"Insert");

                    if($purchaseId)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD",
                            "order_no" => $order_no
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
                              "activity_module" => 'Purchase Order',
                              "action" => $action,
                              "from_method" => 'purchaseorder/purchase_action',
                              "table_name" => 'purchase_master',
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


public function getPurchaseOrderByDate(){

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


        

              $result['purchaseOrderList'] = $this->purchaseordermodel->getPurchaseOrderList($from_dt,$to_dt);


         // pre($result['partyBillList']);exit;

         $page = "dashboard/purchase_order/purchase_order_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    } 








} // end of class