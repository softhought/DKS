<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correction extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('correctionmodel','correctionmodel',TRUE);
       
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/correction/correction_list_view";
        $header=""; 
        $result['studentcodelist'] = $this->correctionmodel->getAllstudentcode();
        $result['correctiondtl'] = $this->correctionmodel->getAllCorrectionData();

        //pre($result['studentregisterdtl']); exit;      
                    
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
  }


  public function addeditcorrection(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
        $result['correctionId'] = 0;
        $result['correctionEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
          $result['correctionId'] = $this->uri->segment(3);

          //$where = array('id'=>$result['correctionId']);

          $result['correctionEditdata'] = $this->correctionmodel->getSingleCorrectionData($result['correctionId']);
           //pre($result['correctionEditdata']);exit;

       }


        $page = "dashboard/correction/addedit_correction_view";
        $header="";
       
        $result['studentcodelist'] = $this->commondatamodel->getAllDropdownData('admission_register');

         $result['correctionaccount'] = $this->commondatamodel->getAllDropdownData('correction_account_list');

 
        // pre($result['accountgroupEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

function getstudentdtl(){

   $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {
         $studentid = $this->input->post('studentid');

         $where = array('admission_id'=>$studentid);
         $billstyle = '';
         $getdata = $this->commondatamodel->getSingleRowByWhereCls('admission_register',$where);
         //pre($getdata);exit;

         if($getdata->bill_style == 'M'){

            $billstyle = 'Monthly';
         }else if($getdata->bill_style == 'Q'){
            $billstyle = 'Quarterly';
         }
        
       
  
         if(!empty($getdata)){

              $json_response = array(
                            "msg_status" => 1,
                            "name" => $getdata->title_one.' '.$getdata->student_name,
                            "bill_style"=>$billstyle
                            );

         }else{

              $json_response = array(
                            "msg_status" => 0,
                            "name" => "",
                            "bill_style" => "",
                            );
         }

        
        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 

    }
    else{
           redirect('login','refresh');
     
    }

}


public function correction_action() {

     $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {

        $dataArry=[];
        $json_response = array();
        $formData = $this->input->post('formDatas');
        parse_str($formData, $dataArry);

         
        $mode = $dataArry['mode'];
        $correctionId = $dataArry['correctionId'];
        
               
        if ($mode == "ADD" && $correctionId == "0") {
          
            $insertData = $this->correctionmodel->insertCorrectionData($dataArry);

             
              $activity_module='Data Insert';
              $action = 'Insert';
              $method='correction_action'; 
              $master_id =$insertData;
              $tablename = 'corrections';
              $description = 'date of correction-'.$dataArry['correction_dt'].' '.'student code-'.$dataArry['student'].' '.'bill style-'.$dataArry['bill_style'].' amount-'.$dataArry['correction_acc_id'].' correction-No= '.$insertData;
              $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);

               if($insertData)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD",
                            "correctionNo" => $insertData,
                           

                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }

        }else{

            if($dataArry['correction_dt'] != ''){

                $correction_dt = str_replace('/', '-', $dataArry['correction_dt']);
                $correc_date=date('Y-m-d',strtotime($correction_dt));
               
            }else{
                 $correc_date = NULL;
                
            }

           $data = array(
                         'date_of_correction' =>$correc_date,
                         'correction_acc_id' =>$dataArry['correction_acc_id'],
                         'amount'=> $dataArry['amount'],
                         'narration'=>$dataArry['narration'],
                        
                          );
           
           $upd_where = array('id'=>$correctionId);

           $Updatedata = $this->commondatamodel->updateSingleTableData('corrections',$data,$upd_where);

             $activity_module='Data Updated';
              $action = 'Updated';
             $method='correction_action'; 
              $master_id =$correctionId;
              $tablename = 'corrections';
              $description = 'date of correction-'.$dataArry['correction_dt'].' '.'student code-'.$dataArry['student'].' '.'bill style-'.$dataArry['bill_style'].' amount-'.$dataArry['correction_acc_id'];
              $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);
               
                if($Updatedata)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Updated successfully",
                                                      

                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }
            
        }



            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
   }
     
    
    else{
           redirect('login','refresh');
     
    }


}


public function deletecorrection(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $correctionId = $this->input->post('id');
            $where = array('id'=>$correctionId);

           $delete = $this->commondatamodel->deleteTableData('corrections',$where);
            $activity_module='data delete';
              $action = 'Delete';
              $method='deletecorrection'; 
              $master_id =$correctionId;
              $tablename = 'corrections';
              $description = '';
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);

          $json_response = array(
                                    "msg_status" => 1,
                                   );                                                      
         
        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 

        }else{
            redirect('login','refresh');
        } 

  }

public function getallcorrectionbydate(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $from_dt = $this->input->post('from_dt');
            $to_date = $this->input->post('to_date');
            $student_id = $this->input->post('student_id');
            if($from_dt != ''){

               $fromdt = str_replace('/', '-', $from_dt);
               $from_date=date('Y-m-d',strtotime($fromdt));

            }else{

                $from_date = NULL;
            }

            if($to_date != ''){

               $todt = str_replace('/', '-', $to_date);
               $to_dt=date('Y-m-d',strtotime($todt));

            }else{

                $to_dt = NULL;
            }

        if($student_id != ''){

            $condition = ' and ';
        }else{
            $condition = ' or ';
        }

       if($from_date == '' && $to_date == ''){

        $result['correctiondtl'] = $this->correctionmodel->getAllCorrectionDatabyStudid($student_id);

       }else{

        $result['correctiondtl'] = $this->correctionmodel->getAllCorrectionDataUsingdate($from_date,$to_dt,$student_id,$condition);

       }

        

        $page = "dashboard/correction/correction_list_partial_view"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

  }



function activity_log($activity_module,$action,$method,$master_id,$tablename,$description){

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
                        'description'=>$description
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  } 



}