<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentadvance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
       
        $this->load->model('paymentadvancemodel','paymentadvancemodel',TRUE); 
        set_time_limit(1200); 
    }

public function index()
{

  $session = $this->session->userdata('user_detail');

	if($this->session->userdata('user_detail'))
	{ 
        $page = "dashboard/payroll/masters/payment_advance/loan_list_view.php";
        $header=""; 
        $year=$session['yearid'];

        $result['loanList'] = $this->paymentadvancemodel->getLoanList($year);

        //pre($result['loanList']);exit;


        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


    public function getLoanAdjustmentListPrint(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $month = $this->input->post('month');
           

         
        $where = array('financialyear.year_id' =>  $year);
        $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

          
            $years=explode(" ",$result['financialyear']->year);
           
            if ($month==1 || $month==2 || $month==3) {
              if ($month<10) {$month="0".$month;}
                $result['yearmonth']=$years[2].'-'.$month;
                $yearmonth=$month.'-'.$years[2];
            }else{
                if ($month<10) {$month="0".$month;}
                $yearmonth=$years[0].'-'.$month;
                $result['yearmonth']=$month.'-'.$years[0];
            }

            $result['loanList']=$this->paymentadvancemodel->getLoanListForAdjustment($month,$year,$yearmonth);


            // load library
            $this->load->library('Pdf');
            $pdf = $this->pdf->load();
            ini_set('memory_limit', '256M'); 
            
            $page = "dashboard/payroll/masters/loan_adjustment/loan_adjustment_pdf_list_view"; 
      
            // pre($result['billList']);exit;

           $html = $this->load->view($page, $result, true);
                // render the view into HTML
                $pdf->WriteHTML($html); 
                $output = 'loanadjustmentPdf' . date('Y_m_d_H_i_s') . '_.pdf'; 
                $pdf->Output("$output", 'I');
                exit();

         

         // $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }




public function loanadjustment(){

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    

       $year=$session['yearid'];

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['paymodeId'] = 0;
        $result['paymentmodeEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['paymodeId'] = $this->uri->segment(3);
       }

        $result['billtype'] = array('M'=>'Monthly','Q'=>'Quarterly');

        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);
                                        
     $result['employeeList'] = [];

       //  pre($result['studentlist']);exit;

        $page = "dashboard/payroll/masters/loan_adjustment/loan_adjustment_add_edit";
       
        $header="";
 
       
       
       

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}



public function addPaymentAdvance(){

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    

       $year=$session['yearid'];
       $company = $session['companyid'];
       $result['drac']="";
       $result['crac']="";

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['paymentadvanceId'] = 0;
        $result['salaryparamEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['paymentadvanceId'] = $this->uri->segment(3);
          $where = array('payment_adv_id' => $result['paymentadvanceId']);
          $result['paymentAdvanceEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('loan_master',$where);
          $result['chequeno']="";

          if ($result['paymentAdvanceEditdata']->is_opening=='N') {
          $where_dr_ac = array(
                                'voucher_detail.voucher_master_id' => $result['paymentAdvanceEditdata']->voucher_id,
                                'voucher_detail.tran_tag' => 'Dr',
                              );

          $result['drac'] = $this->commondatamodel->getSingleRowByWhereCls('voucher_detail',$where_dr_ac)->account_master_id;
          $where_cr_ac = array(
                                'voucher_detail.voucher_master_id' => $result['paymentAdvanceEditdata']->voucher_id,
                                'voucher_detail.tran_tag' => 'Cr',
                              );
          $result['crac'] = $this->commondatamodel->getSingleRowByWhereCls('voucher_detail',$where_cr_ac)->account_master_id;



            $where_vmaster = array('voucher_master.id' => $result['paymentAdvanceEditdata']->voucher_id);

            $result['chequeno'] = $this->commondatamodel->getSingleRowByWhereCls('voucher_master',$where_vmaster)->cheque_no;

            
          }


       }


        $orderby='display_serial';
        $result['employeeList'] = $this->commondatamodel->getAllDropdownData('employee_master');
        $result['debitAcList'] = $this->paymentadvancemodel->getAcToBeDebited($company);
        $result['creditAcList'] = $this->paymentadvancemodel->getAcToBeCredited($company);

        //pre($result['employeeList']);exit;


        $page = "dashboard/payroll/masters/payment_advance/payment_advance_add_edit.php";
        $header="";
 
       
       
       

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}


public function paymentadvance_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $year=$session['yearid'];
            $company = $session['companyid'];
            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

         
            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $paymentadvanceId = trim(htmlspecialchars($dataArry['paymentadvanceId']));
            $employee = trim(htmlspecialchars($dataArry['employee']));
            $advance_amount = trim($dataArry['advance_amount']);
            $monthly_deduction = trim(htmlspecialchars($dataArry['monthly_deduction']));
            $actobe_debited = trim(htmlspecialchars($dataArry['actobe_debited']));
            $actobe_credited = trim(htmlspecialchars($dataArry['actobe_credited']));
            $cheque_no = trim(htmlspecialchars($dataArry['cheque_no']));

            if(isset($dataArry['isopeningadvance'])) { 
                   $isopeningadvance='Y';
            }else{
                   $isopeningadvance='N';
            }

            if($dataArry['advance_date']!=""){
                $advance_date = str_replace('/', '-', $dataArry['advance_date']);
                $advance_date = date("Y-m-d",strtotime($advance_date));
            }
            else{
                 $advance_date = NULL; 
            }


        


            
            if($mode == 'ADD' && $paymentadvanceId == 0){

               $serialmodule='LOAN';
               $voucher_no= $this->paymentadvancemodel->getSerialNumber($company,$year,$serialmodule);

               $voucherMast['voucher_no'] = $voucher_no; 
               $voucherMast['voucher_date'] = date("Y-m-d", strtotime($advance_date));
               $voucherMast['narration'] = "Loan Invoice No ".$voucher_no." Dated ".$voucherMast['voucher_date']; 
               $voucherMast['cheque_no'] = $cheque_no;         
               $voucherMast['cheque_date'] =NULL;        
               $voucherMast['bank_name'] = NULL;        
               $voucherMast['bank_branch'] = NULL;          
               $voucherMast['tran_type'] = 'PY';         
               $voucherMast['user_id'] = $session['userid'];   
               $voucherMast['year_id'] =  $year;       
               $voucherMast['company_id'] = $company;         
               $voucherMast['total_dr_amt'] = $advance_amount;         
               $voucherMast['total_cr_amt'] = $advance_amount; 

               $vMastId=NULL;
               if ($isopeningadvance=='N') {

               $vMastId = $this->commondatamodel->insertSingleTableData('voucher_master',$voucherMast);

                                   $vouchrDtlCus['voucher_master_id'] = $vMastId;
                                   $vouchrDtlCus['srl_no'] = 1;
                                   $vouchrDtlCus['tran_tag'] ='Dr' ;
                                   $vouchrDtlCus['account_master_id'] = $actobe_debited;
                                   $vouchrDtlCus['amount'] = $advance_amount;

              $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);

                                   $vouchrDtlCus2['voucher_master_id'] = $vMastId;
                                   $vouchrDtlCus2['srl_no'] = 1;
                                   $vouchrDtlCus2['tran_tag'] ='Cr' ;
                                   $vouchrDtlCus2['account_master_id'] = $actobe_credited;
                                   $vouchrDtlCus2['amount'] = $advance_amount;


              $insert_dtl_2= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus2);

            }

             $data = array(
                              'employee_id'=>$employee,
                              'adv_amount'=>$advance_amount,
                              'date_of_advance'=>$advance_date,
                              'monthly_deduct_amt'=>$monthly_deduction,
                              'year_id'=>$year,
                              'company_id'=>$company,
                              'voucher_id'=>$vMastId,
                              'is_opening'=>$isopeningadvance
                         );

              $insertdata = $this->commondatamodel->insertSingleTableData('loan_master',$data);
             
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

                   $voucher_id=NULL;
                   $where = array('payment_adv_id' => $paymentadvanceId);
                   $result['paymentAdvanceEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('loan_master',$where);
                   if ($result['paymentAdvanceEditdata']->is_opening=='N') {
                         $voucher_id=$result['paymentAdvanceEditdata']->voucher_id;
                               
                   }


                   if ($isopeningadvance=='N') {
                      if ($result['paymentAdvanceEditdata']->is_opening=='N') {

                          /* update voucher master */
                          $voucherMast_upd['total_dr_amt'] = $advance_amount;         
                          $voucherMast['total_cr_amt'] = $advance_amount; 
                          $upd_where = array('voucher_master.id' => $voucher_id);

                          $this->commondatamodel->updateSingleTableData('voucher_master',$voucherMast_upd,$upd_where);

                          $where_vcdtl = array('voucher_detail.voucher_master_id' => $voucher_id );
                          $this->commondatamodel->deleteTableData('voucher_detail',$where_vcdtl);

                           $vouchrDtlCus['voucher_master_id'] = $voucher_id;
                                   $vouchrDtlCus['srl_no'] = 1;
                                   $vouchrDtlCus['tran_tag'] ='Dr' ;
                                   $vouchrDtlCus['account_master_id'] = $actobe_debited;
                                   $vouchrDtlCus['amount'] = $advance_amount;

                          $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);

                                   $vouchrDtlCus2['voucher_master_id'] = $voucher_id;
                                   $vouchrDtlCus2['srl_no'] = 1;
                                   $vouchrDtlCus2['tran_tag'] ='Cr' ;
                                   $vouchrDtlCus2['account_master_id'] = $actobe_credited;
                                   $vouchrDtlCus2['amount'] = $advance_amount;


                         $insert_dtl_2= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus2);




                      }else{


                                 $serialmodule='LOAN';
                                 $voucher_no= $this->paymentadvancemodel->getSerialNumber($company,$year,$serialmodule);

                                 $voucherMast['voucher_no'] = $voucher_no; 
                                 $voucherMast['voucher_date'] = date("Y-m-d", strtotime($advance_date));
                                 $voucherMast['narration'] = "Loan Invoice No ".$voucher_no." Dated ".$voucherMast['voucher_date'];
                                 $voucherMast['cheque_no'] = $cheque_no;         
                                 $voucherMast['cheque_date'] =NULL;        
                                 $voucherMast['bank_name'] = NULL;        
                                 $voucherMast['bank_branch'] = NULL;          
                                 $voucherMast['tran_type'] = 'PY';         
                                 $voucherMast['user_id'] = $session['userid'];   
                                 $voucherMast['year_id'] =  $year;       
                                 $voucherMast['company_id'] = $company;         
                                 $voucherMast['total_dr_amt'] = $advance_amount;         
                                 $voucherMast['total_cr_amt'] = $advance_amount; 

                                   $voucher_id = $this->commondatamodel->insertSingleTableData('voucher_master',$voucherMast);
                                   $vouchrDtlCus['voucher_master_id'] = $voucher_id;
                                   $vouchrDtlCus['srl_no'] = 1;
                                   $vouchrDtlCus['tran_tag'] ='Dr' ;
                                   $vouchrDtlCus['account_master_id'] = $actobe_debited;
                                   $vouchrDtlCus['amount'] = $advance_amount;

              $insert_dtl_1= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus);

                                   $vouchrDtlCus2['voucher_master_id'] = $voucher_id;
                                   $vouchrDtlCus2['srl_no'] = 1;
                                   $vouchrDtlCus2['tran_tag'] ='Cr' ;
                                   $vouchrDtlCus2['account_master_id'] = $actobe_credited;
                                   $vouchrDtlCus2['amount'] = $advance_amount;

              $insert_dtl_2= $this->commondatamodel->insertSingleTableData('voucher_detail',$vouchrDtlCus2);

            }

     
                    


                   
                   }else{


                      if ($result['paymentAdvanceEditdata']->is_opening=='N') {
                      //delete voucher master 
                        $where_vcmst = array('voucher_master.id' => $voucher_id );
                        $this->commondatamodel->deleteTableData('voucher_master',$where_vcmst);

                        $where_vcdtl = array('voucher_detail.voucher_master_id' => $voucher_id );
                         $this->commondatamodel->deleteTableData('voucher_detail',$where_vcdtl);
                          $voucher_id=NULL;
                       }



                   }

    
            $data_upd = array(
                              'employee_id'=>$employee,
                              'adv_amount'=>$advance_amount,
                              'date_of_advance'=>$advance_date,
                              'monthly_deduct_amt'=>$monthly_deduction,
                              'year_id'=>$year,
                              'company_id'=>$company,
                              'voucher_id'=>$voucher_id,
                              'is_opening'=>$isopeningadvance
                         );

             $update_loan_master_where = array('loan_master.payment_adv_id' => $paymentadvanceId );

             $Updatedata = $this->commondatamodel->updateSingleTableData('loan_master',$data_upd,$update_loan_master_where);


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



public function loanListview()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            
            $year=$session['yearid'];
            $result =[];
           
            $month=$this->input->post('month');
              $where = array('financialyear.year_id' =>  $year);
        $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

          
            $years=explode(" ",$result['financialyear']->year);
           
            if ($month==1 || $month==2 || $month==3) {
              if ($month<10) {$month="0".$month;}
                $yearmonth=$years[2].'-'.$month;
            }else{
                if ($month<10) {$month="0".$month;}
                $yearmonth=$years[0].'-'.$month;
            }

            $result['loanList']=$this->paymentadvancemodel->getLoanListForAdjustment($month,$year,$yearmonth);

            $result['monthid']=$month;

            //pre($result['loanList']);exit;
            
        
            $page = "dashboard/payroll/masters/loan_adjustment/loan_adjustment_partial_view";
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;

        }
        else{
            redirect('login','refresh');
        }
    }


public function loanadjustment_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $company=$session['companyid'];
            $year=$session['yearid'];


            //pre($dataArry);exit;

           
            $monthid = trim(htmlspecialchars($dataArry['monthid']));

                 $wehere_delete = array(
                                          'loan_adjustment.month_id' => $monthid,
                                          'loan_adjustment.year_id' => $year,
                                          'loan_adjustment.company_id' => $company,
                                        );

                $this->commondatamodel->deleteTableData('loan_adjustment',$wehere_delete);


               for ($i=0; $i < count($dataArry['balancedtl']); $i++) { 
                 
                     $balancedtl = $dataArry['balancedtl'];
                     $adjAmt = $dataArry['adjAmt'];
                     $employeeid = $dataArry['employeeid'];

                     $inspector_array = array(
                                          'employee_id' => $employeeid[$i],         
                                          'month_id' => $monthid,         
                                          'year_id' =>  $year,
                                          'loan_adjustment.company_id' => $company,         
                                          'adjusted_amt' => $adjAmt[$i],         
                                          'balance' => $balancedtl[$i]-$adjAmt[$i],         
                                        
                                         );

                 $insertData = $this->commondatamodel->insertSingleTableData('loan_adjustment',$inspector_array);


               }


            

            

              


                    // $activity_description = json_encode($inspector_array);
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
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }

             

       

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 


         }else{
            redirect('login','refresh');
        }   

  } 












}// end of class
