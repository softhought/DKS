<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salentryissue extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('salentryissusmodel','salentryissusmodel',TRUE);
        $this->load->model('baritemopeningmodel','baritemopeningmodel',TRUE);
         
       
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/sale-entry-issue/sale_entry_issue_list";
        $header="";  
       
        $result['saleissueentrylist'] = $this->salentryissusmodel->getallsaleissuentrylist();
       //pre($result['saleissueentrylist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditsaleissuse(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['saleissueId'] = 0;
          $result['salentryissueEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['saleissueId'] = $this->uri->segment(3);
  
            $where = array('id'=>$result['saleissueId']);
  
            $result['salentryissueEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('sale_entry_issue',$where);
            $wheredtl = array('sale_entry_issue.tran_no'=>$result['salentryissueEditdata']->tran_no);
            $result['saleissuedtl'] = $this->salentryissusmodel->getallsaleissuentry($wheredtl);
             //pre( $result['saleissuedtl']);exit;
  
         }

         $result['itemmasterlist'] = $this->baritemopeningmodel->getalllistbaritemopen();
        //pre($result['itemmasterlist']);exit;
         $result['liquervollist'] = $this->commondatamodel->getAllRecordOrderBy('bar_lequer_vol_master','lequer_vol','asc');
         $result['unitlist'] = $this->commondatamodel->getAllRecordOrderBy('bar_item_unit_master','unit','asc');
         $result['locationlist'] = $this->commondatamodel->getAllRecordOrderBy('location_master','location','asc');
          $page = "dashboard/sale-entry-issue/addedit_salentryissue_view";
          $header="";
   
         
         // pre($result['accountgroupEditdata']);exit;
  
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }

  public function addsalentryissue()
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
            $data['location_id'] = $this->input->post('location_id');           
            $data['stock_in_hand'] = $this->input->post('stock_in_hand');

            $data['itemmasterlist'] = $this->baritemopeningmodel->getalllistbaritemopen();       
           //pre( $result['itemmasterlist']);exit;
            //$data['liquervollist'] = $this->commondatamodel->getAllRecordOrderBy('bar_lequer_vol_master','lequer_vol','asc');
            $data['locationlist'] = $this->commondatamodel->getAllRecordOrderBy('location_master','location','asc');
            $page = 'dashboard/sale-entry-issue/add_sale_entryissue_partial_view';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;


        }else{
        redirect('login','refresh');
    }

}

public function saleentryissue_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

          
          $mode = trim(htmlspecialchars($dataArry['mode']));         
          $saleissueId = trim(htmlspecialchars($dataArry['saleissueId']));         
         
            
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
                 
          $serialmodule='SALE ENTRY ISSUE';  
          $tran_no = $this->salentryissusmodel->getSerialNumber($company,$year,$serialmodule); 
          $saleeentryissueId = $dataArry['saleeentryissueId'];

          if($dataArry['saleeentryissueId'] != ''){

            $saleeentryissueId = $dataArry['saleeentryissueId'];
            $stockinhand = $dataArry['stockinhand'];
            $childitem_name = $dataArry['childitem_name'];
            $childliquer_vol_id = $dataArry['childliquer_vol_id'];
            $childquantity = $dataArry['childquantity'];
            $childlocation_id = $dataArry['childlocation_id'];            
            $itemunit = $dataArry['itemunit'];
          
            for($i=0;$i<count($saleeentryissueId);$i++){
                
                        $data = array(
                            'tran_no'=>$tran_no,
                            'tran_date'=>$tran_dt,
                            'item_master_id'=>$childitem_name[$i],
                            'stock_in_hand'=>$stockinhand[$i],
                            'unit_id'=> $itemunit[$i],
                            'liquer_vol_id'=>$childliquer_vol_id[$i],
                            'location_id'=>$childlocation_id[$i],   
                            'quantity'=>$childquantity[$i],                                                                               
                            'year_id'=>$session['yearid'],
                            'company_id'=>$session['companyid'],
                            'created_on'=>date('Y-m-d')
                           );
              $insertdata = $this->commondatamodel->insertSingleTableData('sale_entry_issue',$data);
              $newinsert[] =  $data;
          }
         
        }
 
            $activity_module='Sale Entry(Issue)';
            $action = 'Insert';
            $method='saleentryissue_action'; 
            $master_id =$insertdata;
            $tablename = 'sale_entry_issue';
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
              $olddetails = $this->commondatamodel->getAllRecordWhere('sale_entry_issue',$where);
              
              $saleeentryissueId = $dataArry['saleeentryissueId'];
              $deletedtl = $this->commondatamodel->deleteTableData('sale_entry_issue',$where);
              
              if($dataArry['saleeentryissueId'] != ''){

                $saleeentryissueId = $dataArry['saleeentryissueId'];
                $stockinhand = $dataArry['stockinhand'];
                $childitem_name = $dataArry['childitem_name'];
                $childliquer_vol_id = $dataArry['childliquer_vol_id'];
                $childquantity = $dataArry['childquantity'];
                $childlocation_id = $dataArry['childlocation_id'];            
                $itemunit = $dataArry['itemunit'];
              
                for($i=0;$i<count($saleeentryissueId);$i++){
                    
                            $data = array(
                                'tran_no'=>$tran_no,
                                'tran_date'=>$tran_dt,
                                'item_master_id'=>$childitem_name[$i],
                                'stock_in_hand'=>$stockinhand[$i],
                                'unit_id'=> $itemunit[$i],
                                'liquer_vol_id'=>$childliquer_vol_id[$i],
                                'location_id'=>$childlocation_id[$i],   
                                'quantity'=>$childquantity[$i],                                                                               
                                'year_id'=>$session['yearid'],
                                'company_id'=>$session['companyid'],
                                'created_on'=>date('Y-m-d')
                               );
                  $insertdata = $this->commondatamodel->insertSingleTableData('sale_entry_issue',$data);
                  $newinsert[] =  $data;
                //pre($data);exit;
              }
             
            }   
           
            $activity_module='Sale Entry(Issue)';
            $action = 'Update';
            $method='saleentryissue_action'; 
            $master_id =$insertdata;
            $tablename = 'sale_entry_issue';
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