<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseentryreceive extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('purchaseentrymodel','purchaseentrymodel',TRUE);
        $this->load->model('baritemopeningmodel','baritemopeningmodel',TRUE);
        $this->load->model('dailystockregistermodel','dailystockregistermodel',TRUE);   
         
       
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/purchase-entry/purchase_entry_list";
        $header="";  
        $result = [];
        $result['purchaseentrylist'] = $this->purchaseentrymodel->getpurchasentry();
       //pre($result['purchaseentrylist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditpurchasentry(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['purchaseId'] = 0;
          $result['purchageentryEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['purchaseId'] = $this->uri->segment(3);
  
            $where = array('id'=>$result['purchaseId']);
  
            $result['purchageentryEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('purchase_entry_receive',$where);
            $wheredtl = array('purchase_entry_receive.tran_no'=>$result['purchageentryEditdata']->tran_no);
            $result['purchasedtl'] = $this->purchaseentrymodel->getallpurchaseentry($wheredtl);
             //pre( $result['purchasedtl']);exit;
  
         }

         $result['itemmasterlist'] = $this->baritemopeningmodel->getalllistbaritemopen();
        //pre($result['itemmasterlist']);exit;
         $result['liquervollist'] = $this->commondatamodel->getAllRecordOrderBy('bar_lequer_vol_master','lequer_vol','asc');
         $result['unitlist'] = $this->commondatamodel->getAllRecordOrderBy('bar_item_unit_master','unit','asc');;
          $page = "dashboard/purchase-entry/addedit_purcahseentry_view";
          $header="";
   
         
         // pre($result['accountgroupEditdata']);exit;
  
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }

  public function addpurchaseentry()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');

            $data['rowno'] = $this->input->post('rowNo');
            $data['item_id'] = $this->input->post('item_id');
            $data['item_name'] = $this->input->post('item_name');
            $data['unit'] = $this->input->post('unit');
            $data['unit_id'] = $this->input->post('unit_id');
            $data['liquer_vol_id'] = $this->input->post('liquer_vol_id');
            $data['liquername'] = $this->input->post('liquername');
            $data['quantity'] = $this->input->post('quantity');
            $data['pass_no'] = $this->input->post('pass_no');
            $data['batch_no'] = $this->input->post('batch_no');
            $data['stock_in_hand'] = $this->input->post('stock_in_hand');

            $data['itemmasterlist'] = $this->baritemopeningmodel->getalllistbaritemopen();       
           //pre( $result['itemmasterlist']);exit;
            //$data['liquervollist'] = $this->commondatamodel->getAllRecordOrderBy('bar_lequer_vol_master','lequer_vol','asc');

            $page = 'dashboard/purchase-entry/add_purchase_entry_partial_view';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;


        }else{
        redirect('login','refresh');
    }

}

public function getstockdetails(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {
       $item_name = $this->input->post('item_name');
       $tran_date = $this->input->post('tran_date');
       $where = array('year_id' =>$session['yearid']);
       $from_date = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where)->start_date; 
       if($tran_date != ''){

        $tran_date = str_replace('/', '-', $this->input->post('tran_date'));
        $to_dt =  date('Y-m-d',strtotime($tran_date));
       }else{
        $to_dt = NULL;
       } 
       $fiscalstartdate =  $from_date;
       $compnyid = $yearid = $session['companyid']; 
       $yearid = $session['yearid']; 
      
    //    pre($item_name);exit;
      
       $stock =  $this->dailystockregistermodel->geAllStockRegister($compnyid,$yearid,$from_date,$to_dt,$item_name);
            
     
       if($stock > 0){
       $json_response = array(
        "msg_status" => 1,
        "msg_data" =>$stock 
       );
    }else{
        $json_response = array(
            "msg_status" => 0,
            "msg_data" =>$stock
          
           );
    }


        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 

      }else{
        redirect('login','refresh');
    }
}    

public function purchaseentry_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

          
          $mode = trim(htmlspecialchars($dataArry['mode']));         
          $purchaseId = trim(htmlspecialchars($dataArry['purchaseId']));         
         
            
          if(trim($dataArry['tran_date']) != ''){

            $tran_date = str_replace('/', '-', trim($dataArry['tran_date']));
            $tran_dt =  date('Y-m-d',strtotime($tran_date));
        }else{
            $tran_dt = NULL;
        }          
        $company=$session['companyid'];
        $year=$session['yearid']; 

          //pre($data);exit;
          if($mode == 'ADD'){

                 
          $serialmodule='PURCHASE ENTRY';         


          $tran_no = $this->purchaseentrymodel->getSerialNumber($company,$year,$serialmodule); 
          
         

          if($dataArry['purchaseentryId'] != ''){

            $purchaseentryId = $dataArry['purchaseentryId'];
            $purchasestock = $dataArry['purchasestock'];
            $childitem_name = $dataArry['childitem_name'];
            $childliquer_vol_id = $dataArry['childliquer_vol_id'];
            $childquantity = $dataArry['childquantity'];
            $childpass_no = $dataArry['childpass_no'];
            $childbatch_no = $dataArry['childbatch_no'];
            $purchaseunit = $dataArry['purchaseunit'];
          
            for($i=0;$i<count($purchaseentryId);$i++){
                
                        $data = array(
                            'tran_no'=>$tran_no,
                            'tran_date'=>$tran_dt,
                            'item_master_id'=>$childitem_name[$i],
                            'unit'=> $purchaseunit[$i],
                            'liquer_vol_id'=>$childliquer_vol_id[$i],
                            'quantity'=>$childquantity[$i],
                            'pass_no'=>$childpass_no[$i],
                            'batch_no'=>$childbatch_no[$i],
                            'stock_in_hand'=>$purchasestock[$i],
                            'year_id'=>$session['yearid'],
                            'company_id'=>$session['companyid'],
                            'created_on'=>date('Y-m-d')
                           );
              $insertdata = $this->commondatamodel->insertSingleTableData('purchase_entry_receive',$data);
              $newinsert[] =  $data;
          }
         
        }
 
            $activity_module='Purchase Entry(Receive)';
            $action = 'Insert';
            $method='purchaseentry_action'; 
            $master_id =$insertdata;
            $tablename = 'purchase_entry_receive';
            $old_description ='';
            $description = json_encode($newinsert);
          $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);
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

              $tran_no = trim(htmlspecialchars($dataArry['tran_no']));

              $where = array('tran_no'=>$tran_no,'year_id'=>$year,'company_id'=>$company);
              $olddetails = $this->commondatamodel->getAllRecordWhere('purchase_entry_receive',$where);
              $deletedtl = $this->commondatamodel->deleteTableData('purchase_entry_receive',$where);
             
            if($dataArry['purchaseentryId'] != ''){

                $purchaseentryId = $dataArry['purchaseentryId'];
                $purchasestock = $dataArry['purchasestock'];
                $childitem_name = $dataArry['childitem_name'];
                $childliquer_vol_id = $dataArry['childliquer_vol_id'];
                $childquantity = $dataArry['childquantity'];
                $childpass_no = $dataArry['childpass_no'];
                $childbatch_no = $dataArry['childbatch_no'];
                $purchaseunit = $dataArry['purchaseunit'];
              
                for($i=0;$i<count($purchaseentryId);$i++){
                    
                            $data = array(
                                'tran_no'=>$tran_no,
                                'tran_date'=>$tran_dt,
                                'item_master_id'=>$childitem_name[$i],
                                'unit'=> $purchaseunit[$i],
                                'liquer_vol_id'=>$childliquer_vol_id[$i],
                                'quantity'=>$childquantity[$i],
                                'pass_no'=>$childpass_no[$i],
                                'batch_no'=>$childbatch_no[$i],
                                'stock_in_hand'=>$purchasestock[$i],
                                'year_id'=>$session['yearid'],
                                'company_id'=>$session['companyid'],
                                'created_on'=>date('Y-m-d')
                               );
                  $insertdata = $this->commondatamodel->insertSingleTableData('purchase_entry_receive',$data);
                  $newinsert[] =  $data;
              }
             
            }    

            $activity_module='Purchase Entry(Receive)';
            $action = 'Update';
            $method='purchaseentry_action'; 
            $master_id =$insertdata;
            $tablename = 'purchase_entry_receive';
            $old_description =json_encode($olddetails);
            $description = json_encode($newinsert);
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

                if($insertdata){

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

function activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description){

    $session = $this->session->userdata('user_detail');
          if($this->session->userdata('user_detail'))
          {
  
          $user_activity = array(
                          "activity_module_admin" =>$activity_module ,
                          "activity_module" => $activity_module,
                          "action" => $action,
                          "from_method" => $method,
                          "module_master_id" => $master_id,
                          "user_id" => $session['userid'],
                          "table_name" =>$tablename ,
                          "user_browser" => getUserBrowserName(),
                          "user_platform" =>  getUserPlatform(),
                          'old_description'=>$old_description,
                          'description'=>$description,
                          'ip_address'=>getUserIPAddress()
                      );
         
          $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
       }else{
              redirect('login','refresh');
          }                
    }
  

}