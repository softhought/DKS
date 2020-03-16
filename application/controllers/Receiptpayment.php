<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Receiptpayment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('receiptpaymentmodel','receiptpaymentmodel',TRUE);
          
    }



public function index()
{

  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/receipt_payment/receipt_payment_list.php";
        $header="";  
  
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;


         $result['paymentReceiptList'] = $this->receiptpaymentmodel->getPaymentReceiptList($from_dt,$to_dt);


       // pre($result['paymentReceiptList']);exit;
        createbody_method($result, $page, $header, $session);

    }else{
        redirect('login','refresh');
    }
    
 }



public function addReceiptpayment(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $recpayID = 0;
                $result['recpayID'] = $recpayID;
                $result['recpayEditdata'] = [];
                $result['accountHeadList']=[];
                $result['cashbankac']=[];
 
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $recpayID = $this->uri->segment(3);
                $result['recpayID'] = $recpayID;               
                $whereAry = [
                    'voucher_master.id' => $recpayID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['recpayEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('voucher_master',$whereAry); 


                 $tran_type=$result['recpayEditdata']->tran_type;


                 if ($tran_type=='PV') {
                 	$result['cashbankac'] = $this->receiptpaymentmodel->getCashBankAccount('Cr',$recpayID)->account_master_id;
                 	$result['accountHeadList'] = $this->receiptpaymentmodel->getDetailsAccountHead('Dr',$recpayID);
                 }else{
                 	$result['cashbankac'] = $this->receiptpaymentmodel->getCashBankAccount('Dr',$recpayID)->account_master_id;
                 	$result['accountHeadList'] = $this->receiptpaymentmodel->getDetailsAccountHead('Cr',$recpayID);
                 }
                  //pre($result['accountHeadList']);exit;
                
            }



          $result['cashbankList'] = $this->receiptpaymentmodel->getAllCashBankAc();
          $result['allaccountList'] = $this->receiptpaymentmodel->getAllAccountList();
          $result['catItemList']=[];

         // pre($result['cashbankList']);exit;

               
            $header = "";
            $page = "dashboard/receipt_payment/receipt_payment_add_edit";
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }


public function receipt_payment_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $company=$session['companyid'];
            $year=$session['yearid'];

            $activityArray=[];

           
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $recpayID = trim(htmlspecialchars($dataArry['recpayID']));
            $entry_mode = trim(htmlspecialchars($dataArry['entry_mode']));
            $total_dr = trim(htmlspecialchars($dataArry['total_dr']));
            $total_cr = trim(htmlspecialchars($dataArry['total_cr']));
            $cash_bank_ac = trim(htmlspecialchars($dataArry['cash_bank_ac']));
            $narration = trim(htmlspecialchars($dataArry['narration']));
            

            if ($entry_mode=='REC') {
            	 $serialmodule='AMOUNT RECEIPT';
            	 $tran_type='RV';
            }else{
            	 $serialmodule='AMOUNT PAYMENT';
            	 $tran_type='PV';
            }

            if($dataArry['voucher_dt']!=""){
                $voucher_dt = str_replace('/', '-', $dataArry['voucher_dt']);
                $voucher_dt = date("Y-m-d",strtotime($voucher_dt));
            }
            else{
                 $voucher_dt = NULL; 
            }



         
          
           

              if($recpayID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */

                  $whereAry = [
                    'voucher_master.id' => $recpayID
                   ];

               
                 $voucher_array_before_upd = $this->commondatamodel->getSingleRowByWhereCls('voucher_master',$whereAry); 

                	/* Update voucher */
			
                    
                    $voucherMast['voucher_date'] = date("Y-m-d", strtotime($voucher_dt));
                    $voucherMast['narration'] = $narration;   
                    $voucherMast['total_dr_amt'] = $total_dr;         
            		    $voucherMast['total_cr_amt'] = $total_cr;         
                                         

                     $upd_where_vm = array('voucher_master.id' => $recpayID);
                     $update = $this->commondatamodel->updateSingleTableData('voucher_master',$voucherMast,$upd_where_vm);
                     $activityArray[]=$voucherMast;
                     $delete_where = array('voucher_detail.voucher_master_id' => $recpayID);
                     $this->commondatamodel->deleteTableData('voucher_detail',$delete_where);

                     /*----------------------------------------------------------------------------------*/

                      if ($entry_mode=='REC') {

             		   $vouchrDtlCus['voucher_master_id'] = $recpayID;
                       $vouchrDtlCus['srl_no'] = 1;
                       $vouchrDtlCus['tran_tag'] ='Dr' ;
                       $vouchrDtlCus['account_master_id'] = $cash_bank_ac;
                       $vouchrDtlCus['amount'] = $total_dr;   
                       
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
                        $activityArray[]=$vouchrDtlCus;

                       	if (isset($dataArry['listaccountid'])) {

                    		$acdroplist = $dataArry['acdroplist'];
                            $listamount = $dataArry['listamounted'];
                            	$sl=2;
                              for ($i=0; $i <count($dataArry['listaccountid']) ; $i++) { 


                             $vouchrDtlCus['voucher_master_id'] = $recpayID;
			                       $vouchrDtlCus['srl_no'] = $sl++;
			                       $vouchrDtlCus['tran_tag'] ='Cr' ;
			                       $vouchrDtlCus['account_master_id'] = $acdroplist[$i];
			                       $vouchrDtlCus['amount'] = $listamount[$i];


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
                $activityArray[]=$vouchrDtlCus;

                     }


                    	}  
                       




            	 
            }else{			   

            	     $vouchrDtlCus['voucher_master_id'] = $recpayID;
                       $vouchrDtlCus['srl_no'] = 1;
                       $vouchrDtlCus['tran_tag'] ='Cr' ;
                       $vouchrDtlCus['account_master_id'] = $cash_bank_ac;
                       $vouchrDtlCus['amount'] = $total_cr;   
                       
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);

                       $activityArray[]=$vouchrDtlCus;
                       	if (isset($dataArry['listaccountid'])) {

                    		$acdroplist = $dataArry['acdroplist'];
                            $listamount = $dataArry['listamounted'];
                            	$sl=2;
                              for ($i=0; $i <count($dataArry['listaccountid']) ; $i++) { 


                              	   $vouchrDtlCus['voucher_master_id'] = $recpayID;
			                       $vouchrDtlCus['srl_no'] = $sl++;
			                       $vouchrDtlCus['tran_tag'] ='Dr' ;
			                       $vouchrDtlCus['account_master_id'] = $acdroplist[$i];
			                       $vouchrDtlCus['amount'] = $listamount[$i];


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
                $activityArray[]=$vouchrDtlCus;

                     }


                    	}  
                       
            	

            }


                     /*----------------------------------------------------------------------------------*/











                     
                    $activity_description = json_encode($activityArray);
                    $old_description = json_encode($voucher_array_before_upd);
                    $this->insertActivity($activity_description,$old_description,$recpayID,"Update");

                    
                    
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

            
                  $voucher_no= $this->receiptpaymentmodel->getSerialNumber($company,$year,$serialmodule);


               $voucherMast['voucher_no'] = $voucher_no; 
               $voucherMast['voucher_date'] = date("Y-m-d", strtotime($voucher_dt));
               $voucherMast['narration'] = $narration; 
               $voucherMast['cheque_no'] =NULL;         
               $voucherMast['cheque_date'] =NULL;        
               $voucherMast['bank_name'] = NULL;        
               $voucherMast['bank_branch'] = NULL;          
               $voucherMast['tran_type'] = $tran_type;         
               $voucherMast['user_id'] = $session['userid'];   
               $voucherMast['year_id'] =  $year;       
               $voucherMast['company_id'] = $company;         
               $voucherMast['total_dr_amt'] = $total_dr;         
               $voucherMast['total_cr_amt'] = $total_cr;         
               
           $vMastId = $this->commondatamodel->insertSingleTableData('voucher_master',$voucherMast);
           $activityArray[]=$voucherMast;

             if ($entry_mode=='REC') {

             		   $vouchrDtlCus['voucher_master_id'] = $vMastId;
                       $vouchrDtlCus['srl_no'] = 1;
                       $vouchrDtlCus['tran_tag'] ='Dr' ;
                       $vouchrDtlCus['account_master_id'] = $cash_bank_ac;
                       $vouchrDtlCus['amount'] = $total_dr;   
                       
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);

                       $activityArray[]=$vouchrDtlCus;

                       	if (isset($dataArry['listaccountid'])) {

                    		$acdroplist = $dataArry['acdroplist'];
                            $listamount = $dataArry['listamounted'];
                            	$sl=2;
                              for ($i=0; $i <count($dataArry['listaccountid']) ; $i++) { 


                             $vouchrDtlCus['voucher_master_id'] = $vMastId;
			                       $vouchrDtlCus['srl_no'] = $sl++;
			                       $vouchrDtlCus['tran_tag'] ='Cr' ;
			                       $vouchrDtlCus['account_master_id'] = $acdroplist[$i];
			                       $vouchrDtlCus['amount'] = $listamount[$i];


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
                $activityArray[]=$vouchrDtlCus;

                     }


                    	}  
                       




            	 
            }else{			   

            	     $vouchrDtlCus['voucher_master_id'] = $vMastId;
                       $vouchrDtlCus['srl_no'] = 1;
                       $vouchrDtlCus['tran_tag'] ='Cr' ;
                       $vouchrDtlCus['account_master_id'] = $cash_bank_ac;
                       $vouchrDtlCus['amount'] = $total_cr;   
                       
                       $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
                       $activityArray[]=$vouchrDtlCus;

                       	if (isset($dataArry['listaccountid'])) {

                    		$acdroplist = $dataArry['acdroplist'];
                            $listamount = $dataArry['listamounted'];
                            	$sl=2;
                              for ($i=0; $i <count($dataArry['listaccountid']) ; $i++) { 


                              	   $vouchrDtlCus['voucher_master_id'] = $vMastId;
			                       $vouchrDtlCus['srl_no'] = $sl++;
			                       $vouchrDtlCus['tran_tag'] ='Dr' ;
			                       $vouchrDtlCus['account_master_id'] = $acdroplist[$i];
			                       $vouchrDtlCus['amount'] = $listamount[$i];


                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);
                $activityArray[]=$vouchrDtlCus;

                     }


                    	}  
                       
            	

            }

        


                

                    $activity_description = json_encode($activityArray);
                    $this->insertActivity($activity_description,NULL,$vMastId,"Insert");

                    if($vMastId)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "voucher_no" => $voucher_no
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
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
                              "activity_module" => 'Receipt Payment',
                              "action" => $action,
                              "from_method" => 'receiptpayment/receipt_payment_action',
                              "table_name" => 'voucher_master',
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



  public function addAmountDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
        

            $data['rowno'] = $this->input->post('rowNo');

            $data['account_id'] = $this->input->post('account_id');
            $data['account_name'] = $this->input->post('account_name');
            $data['amount'] = $this->input->post('amount');
           $data['allaccountList'] = $this->receiptpaymentmodel->getAllAccountList();

          
            $page = 'dashboard/receipt_payment/amount_details_partial_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }



    public function getReceiptPaymentByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $sel_member = $this->input->post('sel_member');
            $parameter_id = $this->input->post('parameter_id');
            $result['entry_module'] = $this->input->post('entry_module');
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


        

         $result['paymentReceiptList'] = $this->receiptpaymentmodel->getPaymentReceiptList($from_dt,$to_dt);
         $page = "dashboard/receipt_payment/receipt_payment_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }









} // end of class