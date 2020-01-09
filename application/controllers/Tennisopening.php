<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tennisopening extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('tennisopeningbalmodel','tennisopeningbalmodel',TRUE);
           
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/tennis-opening/tennis_opening_view";
       
        $header="";  
        $result['ListOfMonth'] = $this->commondatamodel->getAllRecordOrderBy('month_master','display_serial','asc');

        $result['ListOfQuarterMonth'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');

        $yearid = array('year_id'=>$session['yearid']);
             

        $result['Financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$yearid)->year;  

        
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}

public function tennisopeninglist(){

    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    { 

      $billstyle = $this->input->post('billstyle');
      $month_id = $this->input->post('month_id');
      $quter_id = $this->input->post('quter_id');
      $year = $session['yearid'];

     if($billstyle == "M"){

         $result['tennisopeninglist'] = $this->tennisopeningbalmodel->getAlltennisopeningmonthlist($billstyle,$month_id);
     }else{

         $result['tennisopeninglist'] = $this->tennisopeningbalmodel->getAlltennisopeningqauterlist($billstyle,$quter_id);

     }

    
   
 //pre($result['tennisopeninglist']);exit;
    $this->load->view("dashboard/tennis-opening/tennis_opening_partial_view",$result);


    
    }else{
         redirect('login','refresh');
    } 
}



public function tennisopeningbalance_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $bill_style = $this->input->post('bill_style');
            $month_id = $this->input->post('month_id');
            $quter_id = $this->input->post('quter_id');
            $admission_id = $this->input->post('admission_id');
            $studcode = $this->input->post('studcode');
            $opening_id = $this->input->post('opening_id');
            $opening_bal = $this->input->post('opening_bal');
            

                      

         $data = array(
                        'student_id'=>$admission_id,
                        'student_code'=>$studcode,
                        'billing_style'=>$bill_style,
                        'opening_balance'=>$opening_bal,
                        'month_id'=>$month_id,
                        'quarter_id'=>$quter_id,
                        'year_id'=>$session['yearid'],
                        'company_id'=>$session['companyid'],

                       );
       

                    
            if($opening_id == ''){

               $insupdata = $this->commondatamodel->insertSingleTableData('tennis_student_opening',$data);

               $insertId = $insupdata; 
              $activity_module='data Insert';
              $action = 'Insert';
              $method='tennisopeningbalance_action'; 
              $master_id =$insupdata;
              $tablename = 'tennis_student_opening';
              $description = 'studentid-'.$admission_id.' '.'student code-'.$studcode.' '.'billing style-'.$bill_style.' '.'opening balance-'.$opening_bal.' '.'monthid-'.$month_id.' '.'quarterid-'.$quter_id.' '.'yearid-'.$session['yearid'].' '.'companyid-'.$session['companyid'];
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);
                              

            }else{

            $upd_where = array('tennis_student_opening.opening_id' => $opening_id);

                $insupdata = $this->commondatamodel->updateSingleTableData('tennis_student_opening',$data,$upd_where);

                $insertId = $opening_id;
              $activity_module='data Update';
              $action = 'Update';
              $method='tennisopeningbalance_action'; 
              $master_id =$opening_id;
              $tablename = 'tennis_student_opening';
              $description = 'studentid-'.$admission_id.' '.'student code-'.$studcode.' '.'billing style-'.$bill_style.' '.'opening balance-'.$opening_bal.' '.'monthid-'.$month_id.' '.'quarterid-'.$quter_id.' '.'yearid-'.$session['yearid'].' '.'companyid-'.$session['companyid'];
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description); 
 
            }

             if($insupdata){

                      $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            'insertId'=>$insertId

                            
                        );
                  }else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while updating ...Please try again."
                        );
                    }

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 


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