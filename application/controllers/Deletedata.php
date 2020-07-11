<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Deletedata extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('delatedatamodel','delatedatamodel',TRUE);
       
    }



public function deletetennisreceiptlist()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/delete_data/delete_tennis_receipt_register_list";
        $header="";  

        $result['paymentData'] = $this->delatedatamodel->getTennisReceipt();
       
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
 }


 public function deletememberreceiptlist()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/delete_data/delete_member_receipt_register_list";
        $header="";  

        $result['paymentData'] = $this->delatedatamodel->getMemberReceipt();

       // pre($result['paymentData']);exit;
       
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
 }




 public function deleteTennisReceipt() {

      $session = $this->session->userdata('user_detail');

      if($this->session->userdata('user_detail'))
      {

            $paymentid = $this->input->post('paymentid');
            $where_payment= array(
                                  
                                  'payment_id' => $paymentid 
                                );

            $paymentData= $this->commondatamodel->getSingleRowByWhereCls('payment_master',$where_payment);

            

                   
           

            //$paymentData['user_id']=$session['userid'];

         
          if ($paymentData) {

          $voucher_id=$paymentData->voucher_master_id;
          
          $activity_array[]=$paymentData;  


          /* old data voucher master */

          $where_ovdata= array('voucher_master.id' => $voucher_id );
          $oldVoucherData= $this->commondatamodel->getSingleRowByWhereCls('voucher_master',$where_ovdata);
          $activity_array[]=$oldVoucherData; 

           /* old data voucher details */

          $where_ovdtldata= array('voucher_detail.voucher_master_id' => $voucher_id );
          $oldVoucherDtlData= $this->commondatamodel->getAllRecordWhere('voucher_detail',$where_ovdtldata);
          $activity_array[]=$oldVoucherDtlData; 




          $insert_id = $this->commondatamodel->insertSingleTableData('payment_master_delete',$paymentData);

          $update_del = array(
                                'user_id' => $session['userid'],
                                'delete_date' => date('Y-m-d h:i:s a')
                             );
          $upd_del_where = array('payment_master_delete.id' => $insert_id);
          $update2 = $this->commondatamodel->updateSingleTableData('payment_master_delete',$update_del,$upd_del_where);


          

        

          /* delete voucher details data */

          $where_vdtl = array('voucher_detail.voucher_master_id' => $voucher_id );
          $deleteData1=$this->commondatamodel->deleteTableData('voucher_detail',$where_vdtl);


         /* delete voucher master data */

          $where_vmst = array('voucher_master.id' => $voucher_id );
          $deleteData2=$this->commondatamodel->deleteTableData('voucher_master',$where_vmst);


        /* delete payment master data */

          $where_paymst = array('payment_master.payment_id' => $paymentid );
          $deleteData3=$this->commondatamodel->deleteTableData('payment_master',$where_paymst);






            $activity_description = json_encode($activity_array);
            $table_name='payment_master,voucher_master,voucher_details';
            $activity_module="Tennis receipt register";
            $this->insertActivity(NULL,$activity_description,NULL,'Delete','deleteTennisReceipt',$table_name,$activity_module);




          }
              

              $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Succesfully Deleted",
                        );


            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit; 



       }else{

               redirect('login','refresh');
       }


    }




     public function deleteMembersReceipt() {

      $session = $this->session->userdata('user_detail');

      if($this->session->userdata('user_detail'))
      {

            $receipt_id = $this->input->post('paymentid');
            $where_payment= array(
                                  
                                  'receipt_id' => $receipt_id 
                                );

            $paymentData= $this->commondatamodel->getSingleRowByWhereCls('member_receipt',$where_payment);

 
            //$paymentData['user_id']=$session['userid'];

         
          if ($paymentData) {

          
          $activity_array[]=$paymentData;  


          $insert_id = $this->commondatamodel->insertSingleTableData('member_receipt_delete',$paymentData);

          $update_del = array(
                                'deluser_id' => $session['userid'],
                                'delete_date' => date('Y-m-d h:i:s a')
                             );
          $upd_del_where = array('member_receipt_delete.id' => $insert_id);
          $update2 = $this->commondatamodel->updateSingleTableData('member_receipt_delete',$update_del,$upd_del_where);



        /* delete member receipt master data */

          $where_paymst = array('member_receipt.receipt_id' => $receipt_id );
          $deleteData3=$this->commondatamodel->deleteTableData('member_receipt',$where_paymst);



            $activity_description = json_encode($activity_array);
            $table_name='member_receipt';
            $activity_module="Member receipt register";
            $this->insertActivity(NULL,$activity_description,NULL,'Delete','deleteMembersReceipt',$table_name,$activity_module);




          }
              

              $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Succesfully Deleted",
                        );


            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit; 



       }else{

               redirect('login','refresh');
       }


    }



  public function deleteDevelopmentFees() {

      $session = $this->session->userdata('user_detail');

      if($this->session->userdata('user_detail'))
      {

            $devtranid = $this->input->post('devtranid');
            $where_dev= array(
                                  
                                  'dev_tran_id' => $devtranid 
                                );

            $devData= $this->commondatamodel->getSingleRowByWhereCls('development_fees_transaction',$where_dev);

 
            //$paymentData['user_id']=$session['userid'];

         
          if ($devData) {

          
          $activity_array[]=$devData;  


        /* delete member receipt master data */

          $where_devtran = array('development_fees_transaction.dev_tran_id' => $devtranid );
          $deleteData3=$this->commondatamodel->deleteTableData('development_fees_transaction',$where_devtran);



            $activity_description = json_encode($activity_array);
            $table_name='development_fees_transaction';
            $activity_module="Development Fees";
            $this->insertActivity(NULL,$activity_description,NULL,'Delete','deleteDevelopmentFees',$table_name,$activity_module);




          }
              

              $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Succesfully Deleted",
                        );


            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit; 



       }else{

               redirect('login','refresh');
       }


    }



      public function deleteBenvolentFees() {

      $session = $this->session->userdata('user_detail');

      if($this->session->userdata('user_detail'))
      {

            $btranid = $this->input->post('btranid');
            $where_dev= array(                                 
                                  'btran_id' => $btranid 
                             );
            $benData= $this->commondatamodel->getSingleRowByWhereCls('benvolent_fund_transaction',$where_dev);
         
          if($benData) {          
          $activity_array[]=$benData;  
        /* delete member receipt master data */

          $where_btran = array('benvolent_fund_transaction.btran_id' => $btranid );
          $deleteData3=$this->commondatamodel->deleteTableData('benvolent_fund_transaction',$where_btran);


            $activity_description = json_encode($activity_array);
            $table_name='benvolent_fund_transaction';
            $activity_module="Benvolent Fees";
            $this->insertActivity(NULL,$activity_description,NULL,'Delete','deleteBenvolentFees',$table_name,$activity_module);




          }
              

              $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Succesfully Deleted",
                        );


            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit; 



       }else{

               redirect('login','refresh');
       }


    }



 function insertActivity($description,$old_description,$table_id,$action,$method,$table_name,$activity_module){
$session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => $activity_module,
                              "action" => $action,
                              "from_method" => $method,
                              "table_name" => $table_name,
                              "user_id" => $session['userid'],
                              "ip_address" => getUserIPAddress(),
                              "user_browser" => getUserBrowserName(),
                              "user_platform" => getUserPlatform(),
                              "description" =>  $description,
                              "old_description" =>  $old_description
                             );
                             
                $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);



}



               
  }// end of class
  


