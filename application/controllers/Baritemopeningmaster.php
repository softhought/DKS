<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baritemopeningmaster extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('baritemopeningmodel','baritemopeningmodel',TRUE);
         
       
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/bar-item-master/bar_item_master_list";
        $header="";  
        
        $result['baritemopeninglist'] = $this->baritemopeningmodel->getalllistbaritemopen();
         //pre($result['baritemopeninglist']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addeditbaritemopening(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {  
  
         if($this->uri->segment(3) == NULL){
  
          $result['mode'] = "ADD";
          $result['btnText'] = "Save";
          $result['btnTextLoader'] = "Saving...";
          $result['baritemmasterId'] = 0;
          $result['baritemopeningEditdata'] = [];
  
         }else{
  
            $result['mode'] = "EDIT";
            $result['btnText'] = "Update";
            $result['btnTextLoader'] = "Updating...";
            $result['baritemmasterId'] = $this->uri->segment(3);
  
            //$where = array('bar_item_master.id'=>);
           
            $result['baritemopeningEditdata'] = $this->baritemopeningmodel->getbaritemsterdata($result['baritemmasterId']);
           # pre($result['baritemopeningEditdata']);exit;
  
         }


         $result['itemmasterlist'] = $this->commondatamodel->getAllRecordOrderBy('item_master','item_name','asc');
         $result['baritemsubgroupmasterlist'] = $this->commondatamodel->getAllRecordOrderBy('bar_item_sub_group_master','item_sub_group','asc');
         $result['unitlist'] = $this->commondatamodel->getAllRecordOrderBy('bar_item_unit_master','unit','asc');
         $result['liquervollist'] = $this->commondatamodel->getAllRecordOrderBy('bar_lequer_vol_master','lequer_vol','asc');

          $page = "dashboard/bar-item-master/addedit_baritemopening_view";
          $header="";
   
         
         // pre($result['accountgroupEditdata']);exit;
  
          createbody_method($result, $page, $header, $session);
      }else{
          redirect('login','refresh');
      }
  }

  public function baritemopening_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

          
          $mode = trim(htmlspecialchars($dataArry['mode']));
          $baritemmasterId = trim(htmlspecialchars($dataArry['baritemmasterId']));
          $baritemopnId = trim(htmlspecialchars($dataArry['baritemopnId']));
          $item_name = trim(htmlspecialchars($dataArry['item_name']));
          $group_id = trim($dataArry['group_id']);
          $unit = trim(htmlspecialchars($dataArry['unit']));
          $liquer_vol_id = trim(htmlspecialchars($dataArry['liquer_vol_id']));
          $opening_bal_ml = trim(htmlspecialchars($dataArry['opening_bal_ml']));
          $opening_bal_botl = trim(htmlspecialchars($dataArry['opening_bal_botl']));
          

          

          $data = array(
                        'item_name'=>strtoupper($item_name),
                        'group_id'=>$group_id,
                        'unit_id'=>$unit,
                        'liquer_vol_id'=>$liquer_vol_id,                                                   
                        'created_on'=>date('Y-m-d')
                      );
                     

          //pre($data);exit;
          if($mode == 'ADD' && $baritemmasterId == 0){

            $insertdata = $this->commondatamodel->insertSingleTableData('bar_item_master',$data);

            $data2 = array(
                'bar_item_master_id'=>$insertdata,
                'opening_bal_bot'=>$opening_bal_botl,
                'opening_bal_ml'=>$opening_bal_ml,
                'year_id'=>$session['yearid'],
                'company_id'=>$session['companyid'],                           
                'created_on'=>date('Y-m-d')
              );
              $insertdata = $this->commondatamodel->insertSingleTableData('bar_item_opening',$data2);

            $activity_module='Bar Item Master ';
            $action = 'Insert';
            $method='baritemopening_action'; 
            $master_id =$insertdata;
            $tablename = 'bar_item_master';
            $old_description ='';
            $description = json_encode($data);
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

              $upd_where = array('bar_item_master.id' => $baritemmasterId);
              $upd_where2 = array('bar_item_opening.opening_id' => $baritemopnId);
              //old data details
             $old_details = $this->commondatamodel->getSingleRowByWhereCls('bar_item_master',$upd_where);

              $Updatedata = $this->commondatamodel->updateSingleTableData('bar_item_master',$data,$upd_where);
              $data2 = array(                
                'opening_bal_bot'=>$opening_bal_botl,
                'opening_bal_ml'=>$opening_bal_ml,                                        
                
              );
              $Updatedata2 = $this->commondatamodel->updateSingleTableData('bar_item_opening',$data2,$upd_where2);
                   

            $activity_module='Bar Item Master';
            $action = 'Update';
            $method='baritemopening_action'; 
            $master_id =$baritemopnId;
            $tablename = 'bar_item_opening';
            $old_description = json_encode($old_details);
            $description = json_encode($data);
          $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

                if($Updatedata2){

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