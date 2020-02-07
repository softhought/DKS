<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemmaster extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
         
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/master/item-master/item_master_list_view";
        $header="";  

        $result['allitemsmasterlist'] = $this->commondatamodel->getAllRecordOrderBy('item_master','item_id','desc');
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function addedititems(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['itemId'] = 0;
        $result['itemsEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['itemId'] = $this->uri->segment(3);

          $where = array('item_id'=>$result['itemId']);
          $where2 = array('item_master_id'=>$result['itemId']);

          $result['itemsEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('item_master',$where);
          $result['openingbaldata'] = $this->commondatamodel->getSingleRowByWhereCls('item_opening_balance',$where2);
           
       }

       $result['itemcatlist'] = $this->commondatamodel->getAllRecordOrderBy('item_category_master','id','asc');
       $result['itemgroupcatlist'] = $this->commondatamodel->getAllRecordOrderBy('bar_item_group','item_name','asc');
       $result['unitmasterlist'] = $this->commondatamodel->getAllRecordOrderBy('unit_master','item_unit_name','asc');
       $result['foodcategorylist'] = $this->commondatamodel->getAllRecordOrderBy('item_food_categogry','cat_name','asc');
       $result['stocklist'] = array('Y','N');
       $result['manufacturetype'] = array('I','F');
       $wherecgst = array('gstType'=>'CGST');
       $result['cgstlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('gstmaster',$wherecgst,'rate');
       $wheresgst = array('gstType'=>'SGST');
       $result['sgstlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('gstmaster',$wheresgst,'rate');

        $page = "dashboard/master/item-master/addedit_item_master";
        $header="";
 
        
       // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

public function addedit_action(){

    $session = $this->session->userdata('user_detail');
      if($this->session->userdata('user_detail'))
      {

          $dataArry=[];
          $json_response = array();
          $formData = $this->input->post('formDatas');
          parse_str($formData, $dataArry);

          
          $mode = trim(htmlspecialchars($dataArry['mode']));
          $itemId = trim(htmlspecialchars($dataArry['itemId']));
          $item_name = trim(htmlspecialchars($dataArry['item_name']));          
          $item_short_name = trim(htmlspecialchars($dataArry['item_short_name']));
          $item_cat = trim(htmlspecialchars($dataArry['item_cat']));
          $item_group_cat = trim(htmlspecialchars($dataArry['item_group_cat']));
          $item_unit = trim(htmlspecialchars($dataArry['item_unit']));
          $item_food_cat = trim(htmlspecialchars($dataArry['item_food_cat']));
          $opening_bal = trim(htmlspecialchars($dataArry['opening_bal']));
          $item_rate = trim(htmlspecialchars($dataArry['item_rate']));
          $stock = trim(htmlspecialchars($dataArry['stock']));
          $manufature_type = trim(htmlspecialchars($dataArry['manufature_type']));
          $cgst = trim(htmlspecialchars($dataArry['cgst']));
          $sgst = trim(htmlspecialchars($dataArry['sgst']));
          $hsn_no = trim(htmlspecialchars($dataArry['hsn_no']));
          $mrp_rate = trim(htmlspecialchars($dataArry['mrp_rate']));

          $data = array(
                        'item_name'=>$item_name,
                        'shrot_name'=>$item_short_name,
                        'item_category'=>$item_cat,
                        'item_group_id'=>$item_group_cat,
                        'item_rate'=>$item_rate,
                        'item_unit'=>$item_unit,
                        'stock'=>$stock,
                        'for_ind'=>$manufature_type,
                        'cgst_id'=>$cgst,
                        'sgst_id'=>$sgst,
                        'hsn_no'=>$hsn_no,
                        'mrp_rate'=>$mrp_rate,
                        'cat_id'=>$item_food_cat,
                        'created_on'=>date('Y-m-d')
                       );
                //pre($session);exit;       
          
          if($mode == 'ADD' && $itemId == 0){

            $insertdata = $this->commondatamodel->insertSingleTableData('item_master',$data);

            $openingbal_data =  array(
                                       'item_master_id'=>$insertdata,
                                       'opening_balance'=>$opening_bal,
                                       'year_id'=>$session['yearid'],
                                       'company_id'=>$session['companyid']
                                      ); 
            $openingid = $this->commondatamodel->insertSingleTableData('item_opening_balance',$openingbal_data);

            $activity_module='data Insert';
            $action = 'Insert';
            $method='Itemmaster/addedit_action'; 
            $master_id =$insertdata;
            $tablename = 'item_master';
            $old_description ='';
            $description = json_encode($data).json_encode($openingbal_data);
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

              $upd_where = array('item_master.item_id' => $itemId);
              $upd_where2 = array('item_opening_balance.item_master_id' => $itemId);
              //old data details
             $old_details = $this->commondatamodel->getSingleRowByWhereCls('item_master',$upd_where);
             $old_opendetails = $this->commondatamodel->getSingleRowByWhereCls('item_opening_balance',$upd_where2);

              $Updatedata = $this->commondatamodel->updateSingleTableData('item_master',$data,$upd_where);

              $openingbal_data =  array('opening_balance'=>$opening_bal); 
              $Updatedata = $this->commondatamodel->updateSingleTableData('item_opening_balance',$openingbal_data,$upd_where2);
                   

            $activity_module='data Update';
            $action = 'Update';
            $method='Itemmaster/addedit_action'; 
            $master_id =$itemId;
            $tablename = 'item_master';
            $old_description = json_encode($old_details).json_encode($old_opendetails);
            $description = json_encode($data).json_encode($openingbal_data);
          $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

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