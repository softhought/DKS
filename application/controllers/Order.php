<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
        $this->load->model('ordermodel','ordermodel',TRUE);
        $this->load->model('companymodel', '', TRUE);
	}
	
	public function index()
	{
		$session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
			$page = "dashboard/order/kot_bot_list";
			$header=""; 
			$company=$session['companyid'];
      $year=$session['yearid'];
			$result = [];
			$category='CAT';
			$result['itemlist'] = $this->ordermodel->getAllItemByCategory($category);
			$result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);


			 $where = array('year_id' => $year);

         $result['accountingyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

         $from_dt=$result['accountingyear']->start_date;
         $to_dt=$result['accountingyear']->end_date;
         $entry_module="";
         $member_id="All";

          $from_dt=date('Y-m-d');
          $to_dt=date('Y-m-d');

          $result['orderList'] = $this->ordermodel->getOrderList($from_dt,$to_dt,$entry_module,$member_id);

			//pre($result['orderList']); exit;      
						
			createbody_method($result, $page, $header, $session);
		}else{
			redirect('login','refresh');
		}
	}


	public function addOrder(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['orderId'] = 0;
        $result['orderEditdata'] = [];
        $result['orderDetailsData'] = [];
        $category='CAT';
       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['orderId'] = $this->uri->segment(3);

          $where = array('order_master.order_id'=>$result['orderId']);

          $result['orderEditdata'] = $this->ordermodel->getOrderMasterData($result['orderId']);
          $result['orderDetailsData'] = $this->ordermodel->getOrderDetailsBymasterId($result['orderId']);

         // pre($result['orderDetailsData']);exit;
          $category=$result['orderEditdata']->category;

       }

          
			$result['itemlist'] = $this->ordermodel->getAllItemByCategory($category);
            //$result['memberCodeList'] = $this->ordermodel->getAllMemberList();
            $result['memberCodeList'] = $this->ordermodel->getallmembercode();
			$result['locationList'] = $this->ordermodel->getAllLocationList();
			$result['waiterList'] = $this->commondatamodel->getAllRecordWhere('waiter_master',[]);

			$result['lastOrder'] = $this->ordermodel->getLastOrderHistory($category,0);
			
			//pre($result['lastOrder']); exit;  

        $page = "dashboard/order/order-view";
        $header="";


        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}


	public function itemListview()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
           
           
            $item_category=$this->input->post('item_category');
        
        
        	$result['itemlist'] = $this->ordermodel->getAllItemByCategory($item_category);
         
			 
			 //  pre($result['itemlist']);exit;
            
    		
            $page = 'dashboard/order/item_list_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }


    public function itemListviewByStartLetter()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
           
           
            $item_category=$this->input->post('item_category');
            $startletter=$this->input->post('startletter');
        
        	if ($startletter=="ALL") {
        		$result['itemlist'] = $this->ordermodel->getAllItemByCategory($item_category);
        	}else{
        		$result['itemlist'] = $this->ordermodel->getAllItemByStartLetter($item_category,$startletter);
         
        	}
        	
			 
			//   pre($result['parameterData']);exit;
            
    		
            $page = 'dashboard/order/item_list_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }


public function addItemOrderDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
        
            $data['rowno'] = $this->input->post('rowNo');
            $data['itemid'] = $this->input->post('itemid');
            $data['lastmanualkot'] = $this->input->post('lastmanualkot');
            $data['item_category'] = $this->input->post('item_category');

            $data['itemdetails'] = $this->ordermodel->getItemDetailsByitemid($data['itemid']);

            //  pre($result['itemdetails']);

            $page = 'dashboard/order/item_add_order_partial_view';
            
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }


public function order_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

           // pre($dataArry);

          
            $company=$session['companyid'];
            $year=$session['yearid'];
            $userid=$session['userid'];

           
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $orderId = trim(htmlspecialchars($dataArry['orderID']));
           
            $order_dt = $dataArry['order_dt'];
            if($order_dt!=""){
                $order_dt = str_replace('/', '-', $order_dt);
                $order_dt = date("Y-m-d",strtotime($order_dt)); 
             }
             else{
                 $order_dt = NULL;
             }


           
              $sel_member_code = trim(htmlspecialchars($dataArry['sel_member_code']));
              $sel_location = trim(htmlspecialchars($dataArry['sel_location']));
              $item_category = trim(htmlspecialchars($dataArry['item_category']));
              $waiter = trim(htmlspecialchars($dataArry['waiter']));
              $itemtotalsum = trim(htmlspecialchars($dataArry['itemtotalsum']));
              $totalcgstsum = trim(htmlspecialchars($dataArry['totalcgstsum']));
              $totalsgstsum = trim(htmlspecialchars($dataArry['totalsgstsum']));
              $totaltobepaid = trim(htmlspecialchars($dataArry['totaltobepaid']));

                	
             	
             
      
              if($orderId>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */

           $old_description[0] = $this->ordermodel->getOrderMasterData($orderId);
           $old_description[1] = $this->ordermodel->getOrderDetailsBymasterId($orderId);

       


                     $order_mst_array = array(  
                                          'order_date' => $order_dt,       
                                          'member_id' => $sel_member_code,       
                                          'location_id' => $sel_location,       
                                          'category' => $item_category,       
                                          'waiter_id' => $waiter,       
                                          'item_total' => $itemtotalsum,       
                                          'total_cgst' => $totalcgstsum,       
                                          'total_sgst' => $totalsgstsum,       
                                          'total_to_be_paid' => $totaltobepaid,       
                                             
                                         );

                     $upd_where = array('order_master.order_id' => $orderId);

                     $update = $this->commondatamodel->updateSingleTableData('order_master',$order_mst_array,$upd_where);

                     /* delete details data */
                     $where_details = array('order_details.order_mst_id' => $orderId);
                     $delete = $this->commondatamodel->deleteTableData('order_details',$where_details);

                          $oitemid = $dataArry['oitemid'];
                  $ocgstid = $dataArry['ocgstid'];
                  $ocgstrate = $dataArry['ocgstrate'];
                  $osgstid = $dataArry['osgstid'];
                  $osgstrate = $dataArry['osgstrate'];
                  $itemrate = $dataArry['itemrate'];
                  $rowamount = $dataArry['rowamount'];
                  $rowtotalcgst = $dataArry['rowtotalcgst'];
                  $rowtotalsgst = $dataArry['rowtotalsgst'];
                  $rowtotalamount = $dataArry['rowtotalamount'];
                  $quantity = $dataArry['quantity'];
                  $is_free = $dataArry['isFree'];
                  $manualkot = $dataArry['manualkot'];
               
                   $activity_description[] = json_encode($order_mst_array);
                  for ($i=0; $i < count($dataArry['oitemid']); $i++) { 

                $order_details_array = array(
                										'order_mst_id' => $orderId,
                										'item_mst_id' => $oitemid[$i],
                										'item_rate' => $itemrate[$i],
                										'cgst_id' => $ocgstid[$i],
                										'sgst_id' => $osgstid[$i],
                										'cgst_rate' => $ocgstrate[$i],
                										'sgst_rate' => $osgstrate[$i],
                										'quantity' => $quantity[$i],
                										'taxable' => $rowamount[$i],
                										'cgst_amount' => $rowtotalcgst[$i],
                										'sgst_amount' => $rowtotalsgst[$i],
                										'total_amount' => $rowtotalamount[$i],
                										'is_free' => $is_free[$i],
                										'menual_kot' => $manualkot[$i],
                									 );
                		
                   $insertdtlId = $this->commondatamodel->insertSingleTableData('order_details',$order_details_array);
                   $activity_description[] = json_encode($order_details_array);

                	}

                     
                   
                   $old_description = json_encode($old_description);
                   $activity_description = json_encode($activity_description);
                    $this->insertActivity($activity_description,$old_description,$orderId,"Update");

                    
                    
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

           $where_loc = array('location_master.location_id' => $sel_location);
           $result['location'] = $this->commondatamodel->getSingleRowByWhereCls('location_master',$where_loc)->location;

           $where_mem = array('member_master.member_id' => $sel_member_code);
           $member_mobile = $this->commondatamodel->getSingleRowByWhereCls('member_master',$where_mem)->mobile;

         

               $nextserial = $this->ordermodel->getOrderSerial($item_category,$order_dt);
               $order_no = $item_category."/".$nextserial;
                
               $order_mst_array = array(
                                          'sl_no' => $nextserial,       
                                          'order_no' => $order_no,       
                                          'order_date' => $order_dt,       
                                          'member_id' => $sel_member_code,       
                                          'location_id' => $sel_location,       
                                          'category' => $item_category,       
                                          'waiter_id' => $waiter,       
                                          'item_total' => $itemtotalsum,       
                                          'total_cgst' => $totalcgstsum,       
                                          'total_sgst' => $totalsgstsum,       
                                          'total_to_be_paid' => $totaltobepaid,       
                                          'year_id' => $year,       
                                          'company_id' => $company,          
                                          'entry_date' => date('Y-m-d'), 
                                          'user_id' => $userid      
                                         );

                $insertId = $this->commondatamodel->insertSingleTableData('order_master',$order_mst_array);

                  $oitemid = $dataArry['oitemid'];
                  $ocgstid = $dataArry['ocgstid'];
                  $ocgstrate = $dataArry['ocgstrate'];
                  $osgstid = $dataArry['osgstid'];
                  $osgstrate = $dataArry['osgstrate'];
                  $itemrate = $dataArry['itemrate'];
                  $rowamount = $dataArry['rowamount'];
                  $rowtotalcgst = $dataArry['rowtotalcgst'];
                  $rowtotalsgst = $dataArry['rowtotalsgst'];
                  $rowtotalamount = $dataArry['rowtotalamount'];
                  $quantity = $dataArry['quantity'];
                  $is_free = $dataArry['isFree'];
                  $manualkot = $dataArry['manualkot'];
               
                  $activity_description[] = json_encode($order_mst_array);
                	for($i=0; $i < count($dataArry['oitemid']); $i++) { 

                $order_details_array = array(
                										'order_mst_id' => $insertId,
                										'item_mst_id' => $oitemid[$i],
                										'item_rate' => $itemrate[$i],
                										'cgst_id' => $ocgstid[$i],
                										'sgst_id' => $osgstid[$i],
                										'cgst_rate' => $ocgstrate[$i],
                										'sgst_rate' => $osgstrate[$i],
                										'quantity' => $quantity[$i],
                										'taxable' => $rowamount[$i],
                										'cgst_amount' => $rowtotalcgst[$i],
                										'sgst_amount' => $rowtotalsgst[$i],
                										'total_amount' => $rowtotalamount[$i],
                										'is_free' => $is_free[$i],
                										'menual_kot' => $manualkot[$i],
                									 );
                		
                $insertdtlId = $this->commondatamodel->insertSingleTableData('order_details',$order_details_array);
                   $activity_description[] = $order_details_array;

                	}

                  $activity_description = json_encode($activity_description);
                	
                     $this->insertActivity($activity_description,NULL,$insertId,"Insert");


                     /* send sms */

                      $sms_message = "Invoice for Rs. ".$totaltobepaid." dtd ".date("d-m-Y",strtotime($order_dt))." has been debited to your account for usages at ".$result['location'];

                      if ($member_mobile!='') {

                          $module='KOT/BOT';
                         // send_sms($member_mobile,$sms_message,$module);
                      }

                    


                    if($insertId)
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
                              "activity_module" => 'Order',
                              "action" => $action,
                              "from_method" => 'order/orderaction',
                              "table_name" => 'order_master and order_details',
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



public function getOrderHistoryData() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $view_category = $this->input->post('view_category');
            $type = $this->input->post('type');
            $currentorderid = (int)$this->input->post('orderhistoryid');


            $orderHistory = $this->ordermodel->getLastOrderHistoryNextPrevious($currentorderid,$view_category,$type);

            if ($orderHistory) {
            	  $json_response = array(
                            "status" => 1,
                            "orderdata" => $orderHistory,
                          );

            }else{
            	 $json_response = array(
                            "status" => 0,
                            "orderdata" => "",
                          );

            }
           


       
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


           
            

        }else
        {
            redirect('login','refresh');
        }


     }  


     public function getOrderHistoryDataByCategory() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $view_category = $this->input->post('view_category');
           


            $orderHistory = $this->ordermodel->getLastOrderHistory($view_category,0);
            
            if ($orderHistory) {
            	  $json_response = array(
                            "status" => 1,
                            "orderdata" => $orderHistory,
                          );

            }else{
            	 $json_response = array(
                            "status" => 0,
                            "orderdata" => "",
                          );

            }
           


       
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


           
            

        }else
        {
            redirect('login','refresh');
        }


     }


    public function getOrderListByDate(){

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


         $entry_module="";
      
         $result['orderList'] = $this->ordermodel->getOrderList($from_dt,$to_dt,$entry_module,$sel_member);

        
         $page = "dashboard/order/kot_bot_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }
  
    public function orderprintJasper()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {      
            $file= APPPATH."views/dashboard/reports/kot-bot-print/KotBotPrint.jrxml";
            
           
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
         
            $orderId = $this->uri->segment(3);  
           
             $company=  $this->companymodel->getCompanyNameById($companyId);
             $companylocation=  $this->companymodel->getCompanyAddressById($companyId);  
             $phone =    $this->companymodel->getCompanyById($companyId)->phone; 
            
            
           
            //  pre($phone);exit;       
            // pre($memberid);
            // pre($company);
            // pre($companylocation);exit;
            $printDate=date("d-m-Y");            
             //$jasperphp->debugsql=true;
            $jasperphp->arrayParameter = array('CompanyName'=>$company,'CompanyAddress'=>$companylocation,'phone'=> $phone,'orderId'=>"'".$orderId."'");
            
            $jasperphp->load_xml_file($file); 
            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
            $jasperphp->outpage('I','Order-'.date('d_m_Y-His').'.pdf');  
           
            // pre($jasperphp);     
           

            // $page = 'trial_balance/trailWithJasper.php';
            // $this->load->view($page, $result, TRUE);

        } else {
            redirect('login', 'refresh');
        }
    }

   

	
}  // end of class
