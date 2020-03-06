<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class partybill extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberreceiptmodel','memberreceiptmodel',TRUE);
        $this->load->model('Paymenttennismodel','payment_tennis_model',TRUE);    
        $this->load->model('partybillmodel','partybillmodel',TRUE);  
        $this->load->model('companymodel', '', TRUE);   
     
      
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/party_bill/party_bill_list";
        $header="";       
        $company=$session['companyid'];
        $year=$session['yearid'];

         $where = array('year_id' => $year);
         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);
         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;


        $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
        $result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
        $member_id='All';

        $result['partyBillList'] = $this->partybillmodel->getPartyBillList($from_dt,$to_dt,$member_id);

       // pre($result['partyBillList']);exit;
    
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function addPartyBill(){
        
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
                $partybillID = 0;
                $result['partybillID'] = $partybillID;
                $result['partybillEditdata'] = [];
                $result['catItemList'] = [];
                $result['barItems'] = [];
               
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $partybillID = $this->uri->segment(3);
                $result['partybillID'] = $partybillID;
                
            
                // getSingleRowByWhereCls(tablename,where params)
                 $result['partybillEditdata'] = $this->partybillmodel->getPartyMasterData($partybillID); 
                
                 

                 $result['catItemList'] = $this->partybillmodel->getPartyBillDetails($partybillID,'CAT');
                 $result['barItems'] = $this->partybillmodel->getPartyBillDetails($partybillID,'BAR');

                // pre($result['partybillEditdata']);exit;

                
            }

              $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
                   //gst rate
                    $result['cgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='CGST',$usedfor='O');
                    $result['sgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='SGST',$usedfor='O');


                    $where_cat = array('item_master.item_category' => 'CAT' );
                    $result['canteenItemList'] = $this->commondatamodel->getAllRecordWhere('item_master',$where_cat);

                    $where_bar = array('item_master.item_category' => 'BAR' );
                    $result['barItemList'] = $this->commondatamodel->getAllRecordWhere('item_master',$where_bar);

                     $result['actobeCreditedList'] = $this->partybillmodel->getAcToBeCredited($company);
                     $result['actobeDebitedList'] = $this->partybillmodel->getAcToBeDebited($company);

                   // pre($result['actobeCreditedList']);exit;



            $header = "";
            $page = 'dashboard/party_bill/party_bill_add_edit.php';
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        
 }




  public function addItemAmountDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
        

            $data['rowno'] = $this->input->post('rowNo');

            $tennisitemid = $this->input->post('tennisitem');
            $item_where = array('item_id' => $tennisitemid );
            $data['tennisitem']=$this->commondatamodel->getSingleRowByWhereCls('item_master',$item_where);


            $data['hsncode'] = $this->input->post('hsncode');
            $data['itemqty'] = $this->input->post('itemqty');
            $data['itemrate'] = $this->input->post('itemrate');
            $data['itemtaxable'] = $this->input->post('itemtaxable');
            $data['cgstrateid'] = $this->input->post('cgstrateid');
            $data['cgstrate'] = $this->input->post('cgstrate');
            $data['cgstamt'] = $this->input->post('cgstamt');
            $data['sgstrateid'] = $this->input->post('sgstrateid');
            $data['sgstrate'] = $this->input->post('sgstrate');
            $data['sgstamt'] = $this->input->post('sgstamt');
            $data['item_netamt'] = $this->input->post('item_netamt');


          
            $page = 'dashboard/party_bill/itemamount_details_partial_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }



      public function addItemBOTAmountDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
        

            $data['rowno'] = $this->input->post('rowNo');

            $tennisitemid = $this->input->post('tennisitem');
            $item_where = array('item_id' => $tennisitemid );
            $data['tennisitem']=$this->commondatamodel->getSingleRowByWhereCls('item_master',$item_where);
           
            $data['itemqty'] = $this->input->post('itemqty');
            $data['itemrate'] = $this->input->post('itemrate');
            $data['itemtaxable'] = $this->input->post('itemtaxable');
            $data['cgstrateid'] = $this->input->post('cgstrateid');
            $data['cgstrate'] = $this->input->post('cgstrate');
            $data['cgstamt'] = $this->input->post('cgstamt');
            $data['sgstrateid'] = $this->input->post('sgstrateid');
            $data['sgstrate'] = $this->input->post('sgstrate');
            $data['sgstamt'] = $this->input->post('sgstamt');
            $data['item_netamt'] = $this->input->post('item_netamt');
            $data['mrp_bot'] = $this->input->post('mrp_bot');


          
            $page = 'dashboard/party_bill/itemamount_details_partial_view_bot.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }



public function partybill_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

              $company=$session['companyid'];
              $year=$session['yearid'];

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $insert_arrayData=[];



            // pre($dataArry);exit;

            
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $partybillId = trim(htmlspecialchars($dataArry['partybillId']));
            $party_bill_date = trim(htmlspecialchars($dataArry['party_bill_date']));
            $party_date = trim(htmlspecialchars($dataArry['party_date']));
            $sel_member_code = trim(htmlspecialchars($dataArry['sel_member_code']));

            if($party_bill_date!=""){
                $party_bill_date = str_replace('/', '-', $party_bill_date);
                $party_bill_date = date("Y-m-d",strtotime($party_bill_date)); 
             }
             else{
                 $party_bill_date = NULL;
                
             }

            if($party_date!=""){
                $party_date = str_replace('/', '-', $party_date);
                $party_date = date("Y-m-d",strtotime($party_date)); 
             }
             else{
                 $party_date = NULL;
                
             }
          
            
            if($mode == 'ADD' && $partybillId == 0){

            $serialmodule='PARTYBILL';
            $party_bill_no= $this->partybillmodel->getSerialNumber($company,$year,$serialmodule);


          
            $insert_master = array(
                                  'party_bill_no'=>$party_bill_no,
                                  'party_bill_date'=>$party_bill_date,
                                  'party_date'=>$party_date,
                                  'member_id'=>$sel_member_code,
                                  'cat_kot'=>$dataArry['item_rowkotno'],
                                  'cat_amt'=>$dataArry['item_rowtotal_amtkot'],
                                  'bar_kot'=>$dataArry['item_rowtbotno'],
                                  'bar_amt'=>$dataArry['item_rowtotal_botamt'],
                                  'hall_chaeges'=>$dataArry['hall_charges'],
                                  'hall_cgst_id'=>$dataArry['hall_cgst_rate'],
                                  'hall_sgst_id'=>$dataArry['hall_sgst_rate'],
                                  'hall_cgst_amt'=>$dataArry['hall_cgst_amt'],
                                  'hall_sgst_amt'=>$dataArry['hall_sgst_amt'],
                                  'hall_net_amt'=>$dataArry['hall_total_amt'],
                                  'guest_head'=>$dataArry['guest_head'],
                                  'guest_rate'=>$dataArry['guest_rate'],
                                  'guest_amt'=>$dataArry['guest_amt'],
                                  'guest_cgst_id'=>$dataArry['guest_cgst_rate'],
                                  'guest_sgst_id'=>$dataArry['guest_sgst_rate'],
                                  'guest_cgst_amt'=>$dataArry['guest_cgst_amt'],
                                  'guest_sgst_amt'=>$dataArry['guest_sgst_amt'],
                                  'guest_net_amt'=>$dataArry['guest_net_amt'],

                                  'deco_chages'=>$dataArry['deco_chages'],
                                  'electric_charges'=>$dataArry['electric_charges'],
                                  'other_charges'=>$dataArry['other_charges'],
                                  'final_total'=>$dataArry['final_total'],
                                  'description'=>$dataArry['description'],
                                  'dr_ac_id'=>$dataArry['select_dr_ac'],
                                  'kot_ac_id'=>$dataArry['select_kot_ac'],
                                  'bot_ac_id'=>$dataArry['select_bot_ac'],
                                  'hall_ac_id'=>$dataArry['select_hall_ac'],
                                  'guest_ac_id'=>$dataArry['select_guest_ac'],
                                  'deco_ac_id'=>$dataArry['select_deco_ac'],
                                  'electric_ac_id'=>$dataArry['select_electric_ac'],
                                  'other_ac_id'=>$dataArry['select_other_ac'],

                                  'company_id' => $company,
                                  'year_id' => $year,  
                                  'user_id'=>$session['userid'],   
                         );

            $insert_arrayData[]=$insert_master;

              $insertdata = $this->commondatamodel->insertSingleTableData('party_bill_master',$insert_master);



              /* details kot data */

              if (isset($dataArry['tennisitemrow'])) {

                    $tennisitemrow = $dataArry['tennisitemrow'];
                    $hsncoderow = $dataArry['hsncoderow'];
                    $itemqtyrow = $dataArry['itemqtyrow'];
                    $itemraterow = $dataArry['itemraterow'];
                    $itemtaxablerow = $dataArry['itemtaxablerow'];
                    $item_cgst_raterow = $dataArry['item_cgst_raterow'];
                    $item_cgst_amtrow = $dataArry['item_cgst_amtrow'];
                    $item_sgst_raterow = $dataArry['item_sgst_raterow'];
                    $item_sgst_amtrow = $dataArry['item_sgst_amtrow'];
                    $item_netamtrow = $dataArry['item_netamtrow'];

                     for ($i=0; $i <count($dataArry['tennisitemrow']) ; $i++) { 
                        
                          $insert_dtl_cat = array(
                                                'bill_mst_id' => $insertdata,
                                                'category' => 'CAT',
                                                'item_id' => $tennisitemrow[$i],
                                                'hsn_code' => $hsncoderow[$i],
                                                'quantity' => $itemqtyrow[$i],
                                                'rate' => $itemraterow[$i],
                                                'taxable' => $itemtaxablerow[$i],
                                                'cgst_rate_id' => $item_cgst_raterow[$i],
                                                'cgst_amt' => $item_cgst_amtrow[$i],
                                                'sgst_rate_id' => $item_sgst_raterow[$i],
                                                'sgst_amt' => $item_sgst_amtrow[$i],
                                                'net_amount' => $item_netamtrow[$i]
                                             );

                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('party_bill_details',$insert_dtl_cat);

                $insert_arrayData[]=$insert_dtl_1;


                     }
                 

              }

                /* details bot data */
                if (isset($dataArry['bottennisitemrow'])) {

                            $bottennisitemrow = $dataArry['bottennisitemrow'];
                            $botitemqtyrow = $dataArry['botitemqtyrow'];
                            $botitemraterow = $dataArry['botitemraterow'];
                            $botitemtaxablerow = $dataArry['botitemtaxablerow'];
                            $botitem_cgst_raterow = $dataArry['botitem_cgst_raterow'];
                            $botitem_cgst_amtrow = $dataArry['botitem_cgst_amtrow'];
                            $botitem_sgst_raterow = $dataArry['botitem_sgst_raterow'];
                            $botitem_sgst_amtrow = $dataArry['botitem_sgst_amtrow'];
                            $botitem_netamtrow = $dataArry['botitem_netamtrow'];
                            $mrp_bot = $dataArry['botitemmrp'];

                    for ($i=0; $i < count($dataArry['bottennisitemrow']) ; $i++) { 

                        $insert_dtl_cat = array(
                                                'bill_mst_id' => $insertdata,
                                                'category' => 'BAR',
                                                'item_id' => $bottennisitemrow[$i],
                                                'quantity' => $botitemqtyrow[$i],
                                                'rate' => $botitemraterow[$i],
                                                'taxable' => $botitemtaxablerow[$i],
                                                'cgst_rate_id' => $botitem_cgst_raterow[$i],
                                                'cgst_amt' => $botitem_cgst_amtrow[$i],
                                                'sgst_rate_id' => $botitem_sgst_raterow[$i],
                                                'sgst_amt' => $botitem_sgst_amtrow[$i],
                                                'net_amount' => $botitem_netamtrow[$i],
                                                'mrp' => $mrp_bot[$i]
                                             );

                $insert_dtl_2= $this->commondatamodel->insertSingleTableData('party_bill_details',$insert_dtl_cat);


                $insert_arrayData[]=$insert_dtl_2;


                    }

                }


                 $activity_description = json_encode($insert_arrayData);
                $this->insertPartyBillActivity($activity_description,NULL,$insertdata,"Insert");



             $this->partybillmodel->insertIntoVoucher($party_bill_no,$dataArry,$insertdata);


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

                  $party_array_before_upd=[];
                  $upd_array_party=[];

                 $party_array_before_upd[] = $this->partybillmodel->getPartyMasterData($partybillId); 
                 $party_array_before_upd[]  = $this->partybillmodel->getPartyBillDetails($partybillId,'CAT');
                 $party_array_before_upd[]  = $this->partybillmodel->getPartyBillDetails($partybillId,'BAR');



                /* update master data */


            $update_master = array(
                                
                                  'party_bill_date'=>$party_bill_date,
                                  'party_date'=>$party_date,
                                  'member_id'=>$sel_member_code,
                                  'cat_kot'=>$dataArry['item_rowkotno'],
                                  'cat_amt'=>$dataArry['item_rowtotal_amtkot'],
                                  'bar_kot'=>$dataArry['item_rowtbotno'],
                                  'bar_amt'=>$dataArry['item_rowtotal_botamt'],
                                  'hall_chaeges'=>$dataArry['hall_charges'],
                                  'hall_cgst_id'=>$dataArry['hall_cgst_rate'],
                                  'hall_sgst_id'=>$dataArry['hall_sgst_rate'],
                                  'hall_cgst_amt'=>$dataArry['hall_cgst_amt'],
                                  'hall_sgst_amt'=>$dataArry['hall_sgst_amt'],
                                  'hall_net_amt'=>$dataArry['hall_total_amt'],
                                  'guest_head'=>$dataArry['guest_head'],
                                  'guest_rate'=>$dataArry['guest_rate'],
                                  'guest_amt'=>$dataArry['guest_amt'],
                                  'guest_cgst_id'=>$dataArry['guest_cgst_rate'],
                                  'guest_sgst_id'=>$dataArry['guest_sgst_rate'],
                                  'guest_cgst_amt'=>$dataArry['guest_cgst_amt'],
                                  'guest_sgst_amt'=>$dataArry['guest_sgst_amt'],
                                  'guest_net_amt'=>$dataArry['guest_net_amt'],

                                  'deco_chages'=>$dataArry['deco_chages'],
                                  'electric_charges'=>$dataArry['electric_charges'],
                                  'other_charges'=>$dataArry['other_charges'],
                                  'final_total'=>$dataArry['final_total'],
                                  'description'=>$dataArry['description'],
                                  'dr_ac_id'=>$dataArry['select_dr_ac'],
                                  'kot_ac_id'=>$dataArry['select_kot_ac'],
                                  'bot_ac_id'=>$dataArry['select_bot_ac'],
                                  'hall_ac_id'=>$dataArry['select_hall_ac'],
                                  'guest_ac_id'=>$dataArry['select_guest_ac'],
                                  'deco_ac_id'=>$dataArry['select_deco_ac'],
                                  'electric_ac_id'=>$dataArry['select_electric_ac'],
                                  'other_ac_id'=>$dataArry['select_other_ac'],
                                  'user_id'=>$session['userid'],   
                         );

             $upd_array_party[]=$update_master;

             $upd_where = array('party_bill_master.id' => $partybillId);
             $update = $this->commondatamodel->updateSingleTableData('party_bill_master',$update_master,$upd_where);



             $delete_where = array('party_bill_details.bill_mst_id' => $partybillId );
             $this->commondatamodel->deleteTableData('party_bill_details',$delete_where);


             
              /* details kot data */

              if (isset($dataArry['tennisitemrow'])) {

                    $tennisitemrow = $dataArry['tennisitemrow'];
                    $hsncoderow = $dataArry['hsncoderow'];
                    $itemqtyrow = $dataArry['itemqtyrow'];
                    $itemraterow = $dataArry['itemraterow'];
                    $itemtaxablerow = $dataArry['itemtaxablerow'];
                    $item_cgst_raterow = $dataArry['item_cgst_raterow'];
                    $item_cgst_amtrow = $dataArry['item_cgst_amtrow'];
                    $item_sgst_raterow = $dataArry['item_sgst_raterow'];
                    $item_sgst_amtrow = $dataArry['item_sgst_amtrow'];
                    $item_netamtrow = $dataArry['item_netamtrow'];

                     for ($i=0; $i <count($dataArry['tennisitemrow']) ; $i++) { 
                        
                          $insert_dtl_cat = array(
                                                'bill_mst_id' => $partybillId,
                                                'category' => 'CAT',
                                                'item_id' => $tennisitemrow[$i],
                                                'hsn_code' => $hsncoderow[$i],
                                                'quantity' => $itemqtyrow[$i],
                                                'rate' => $itemraterow[$i],
                                                'taxable' => $itemtaxablerow[$i],
                                                'cgst_rate_id' => $item_cgst_raterow[$i],
                                                'cgst_amt' => $item_cgst_amtrow[$i],
                                                'sgst_rate_id' => $item_sgst_raterow[$i],
                                                'sgst_amt' => $item_sgst_amtrow[$i],
                                                'net_amount' => $item_netamtrow[$i]
                                             );

                $insert_dtl_1= $this->commondatamodel->insertSingleTableData('party_bill_details',$insert_dtl_cat);


                $upd_array_party[]=$insert_dtl_1;
                     }
                 

              }

                /* details bot data */
                if (isset($dataArry['bottennisitemrow'])) {

                            $bottennisitemrow = $dataArry['bottennisitemrow'];
                            $botitemqtyrow = $dataArry['botitemqtyrow'];
                            $botitemraterow = $dataArry['botitemraterow'];
                            $botitemtaxablerow = $dataArry['botitemtaxablerow'];
                            $botitem_cgst_raterow = $dataArry['botitem_cgst_raterow'];
                            $botitem_cgst_amtrow = $dataArry['botitem_cgst_amtrow'];
                            $botitem_sgst_raterow = $dataArry['botitem_sgst_raterow'];
                            $botitem_sgst_amtrow = $dataArry['botitem_sgst_amtrow'];
                            $botitem_netamtrow = $dataArry['botitem_netamtrow'];
                            $mrp_bot = $dataArry['botitemmrp'];

                    for ($i=0; $i < count($dataArry['bottennisitemrow']) ; $i++) { 

                        $insert_dtl_cat = array(
                                                'bill_mst_id' => $partybillId,
                                                'category' => 'BAR',
                                                'item_id' => $bottennisitemrow[$i],
                                                'quantity' => $botitemqtyrow[$i],
                                                'rate' => $botitemraterow[$i],
                                                'taxable' => $botitemtaxablerow[$i],
                                                'cgst_rate_id' => $botitem_cgst_raterow[$i],
                                                'cgst_amt' => $botitem_cgst_amtrow[$i],
                                                'sgst_rate_id' => $botitem_sgst_raterow[$i],
                                                'sgst_amt' => $botitem_sgst_amtrow[$i],
                                                'net_amount' => $botitem_netamtrow[$i],
                                                'mrp' => $mrp_bot[$i]
                                             );

                $insert_dtl_2= $this->commondatamodel->insertSingleTableData('party_bill_details',$insert_dtl_cat);


                 $upd_array_party[]=$insert_dtl_2;


                    }

                }



                    $activity_description = json_encode($upd_array_party);
                    $old_description = json_encode($party_array_before_upd);
                    $this->insertPartyBillActivity($activity_description,$old_description,$partybillId,"Update");



                    $party_where = array('party_bill_master.id' => $partybillId);

                    $voucherID= $this->commondatamodel->getSingleRowByWhereCls('party_bill_master',$party_where)->voucher_id;


                    $voucherupdate= $this->partybillmodel->updateIntoVoucher($dataArry,$partybillId,$voucherID);








               $Updatedata=1;

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



    public function getPartyListByDate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_dt = $this->input->post('to_date');
            $sel_member = $this->input->post('sel_member');
           
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


        

          $result['partyBillList'] = $this->partybillmodel->getPartyBillList($from_dt,$to_dt,$sel_member);


         // pre($result['partyBillList']);exit;

         $page = "dashboard/party_bill/party_bill_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }

    public function billprintJasper()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {      
            $file= APPPATH."views/dashboard/party_bill/JasperReports/PartyBill.jrxml";
            $subreportfile= APPPATH."views/dashboard/party_bill/JasperReports/";
           
            $this->load->library('jasperphp');
            $jasperphp = $this->jasperphp->jasper();

            $dbdriver="mysql";
            // $server="localhost";
            // $db="teasamrat";
            // $user="root";
            // $pass="";
            
            $this->load->database();
            $server=$this->db->hostname;
            $user=$this->db->username;
            $pass=$this->db->password;
            $db=$this->db->database;
           
            $companyId = $session['companyid'];
         
            $memberid = $this->uri->segment(3);  
           
             $company=  $this->companymodel->getCompanyNameById($companyId);
             $companylocation=  $this->companymodel->getCompanyAddressById($companyId);             
            // pre($memberid);
            // pre($company);
            // pre($companylocation);exit;
            $printDate=date("d-m-Y");            
             //$jasperphp->debugsql=true;
            $jasperphp->arrayParameter = array('CompanyName'=>$company,'CompanyAddress'=>$companylocation,'memberid'=>"'".$memberid."'",'SUBREPORT_DIR'=>$subreportfile);
            
            $jasperphp->load_xml_file($file); 
            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
            $jasperphp->outpage('I','Bill Details-'.date('d_m_Y-His'));  
            // pre($jasperphp);     
    

            // $page = 'trial_balance/trailWithJasper.php';
            // $this->load->view($page, $result, TRUE);

        } else {
            redirect('login', 'refresh');
        }
    }



function insertPartyBillActivity($description,$old_description,$table_id,$action){
     $session = $this->session->userdata('user_detail');
    $user_activity = array(
                              "activity_module" => 'Party Bill ',
                              "action" => $action,
                              "from_method" => 'partybill/partybill_action',
                              "table_name" => 'party_bill_master',
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





}  // end of class