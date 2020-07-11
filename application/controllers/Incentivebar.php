<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Incentivebar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('incentivebarmodel','incentivebarmodel',TRUE);
        
         ini_set('max_input_vars', 10000);
       
    }


public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{   $company=$session['companyid'];
        $year=$session['yearid'];
     
       
          $page = "dashboard/payroll/masters/incentive_bar/incentive_bar_list_view.php";
        $header="";  
       
       
        $member_code = '';
        $cat_id = '';
        $month_id = '';

      
              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

         $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

        
            
       
       // pre($result['benvolentfundList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}




  public function addIncentivebar(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    $company=$session['companyid'];
        $year=$session['yearid'];
     
       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
      
        $result['incentiveID'] = 0;
        $result['incentiveEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
      
          $result['incentiveID'] = $this->uri->segment(3);


          $where_inc = array('incentive_bar_transaction.inc_id' => $result['incentiveID'] );

         $result['incentiveEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('incentive_bar_transaction',$where_inc);
           

       } 



      $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $orderby_cat='name';
              $result['employeeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('employee_master',[],$orderby_cat);
       

        $page = "dashboard/payroll/masters/incentive_bar/incentive_bar_add_edit_view";
        $header="";

     
                
        $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
        
       // pre($result['transactionEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}



    public function incentiveAction() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $activity_description="";
            $company=$session['companyid'];
            $year=$session['yearid'];

        
               $mode=$dataArry['mode'];
               $incentiveID=$dataArry['incentiveID'];
               $sel_month=$dataArry['sel_month'];
               $employee_id=$dataArry['employee'];
               $amount=$dataArry['amount'];
              
     

                 
		                 $del_where = array(
		                 							'employee_id' => $employee_id,
		                 							'month_id' => $sel_month,
                                  'year_id' => $year,
		                 							'company_id' => $company,

		                 						   );
		            $this->commondatamodel->deleteTableData('incentive_bar_transaction',$del_where);
                 	
                     
                   $lip_array = array(
                                                'employee_id' => $employee_id,
                                                'month_id' => $sel_month,
                                                'amount' => $amount,
                                                'year_id' => $year,
                                                'company_id' => $company,
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('incentive_bar_transaction',$lip_array);

       
      

                if($insert){

                       $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Applied successfully",
                            
                        );

                }else{
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while applying ...Please try again."
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






    public function incBarCopyMonthAction() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $activity_description="";
            $company=$session['companyid'];
            $year=$session['yearid'];

     
               $copy_from_month=$dataArry['copy_from_month'];
               $copy_to_month=$dataArry['copy_to_month'];

               $where = array(
                                'incentive_bar_transaction.month_id' => $copy_from_month, 
                                'incentive_bar_transaction.year_id' => $year, 
                                'incentive_bar_transaction.company_id' => $company, 
                              );
            
               $result['incentiveList']=$this->commondatamodel->getAllRecordWhere('incentive_bar_transaction',$where);
         

                if ($result['incentiveList'] ) {

                foreach ($result['incentiveList'] as $inclist) {
                 $employee_id=$inclist->employee_id;
                 $amount=$inclist->amount;
                

                   $del_where = array(
                                  'employee_id' => $employee_id,
                                  'month_id' => $copy_to_month,
                                  'year_id' => $year,
                                  'company_id' => $company,

                                   );
                $this->commondatamodel->deleteTableData('incentive_bar_transaction',$del_where);
                  
                     
                   $inc_array = array(
                                                'employee_id' => $employee_id,
                                                'month_id' => $copy_to_month,
                                                'amount' => $amount,
                                                'year_id' => $year,
                                                'company_id' => $company
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('incentive_bar_transaction',$inc_array);
                  
                
                }


                    

                if($insert){

                       $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Applied successfully",
                            
                        );

                }else{
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while applying ...Please try again."
                        );
                }

               }else{
                   $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "No data found to copy"
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

public function incentivebarListByMonth(){

   $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $company=$session['companyid'];
          $year=$session['yearid'];

         
          $month_id = $this->input->post('month_id');


          $result['incentivebarList'] = $this->incentivebarmodel->getIncentivebarByMonth($month_id,$year,$company);
        //  pre($result['lipList']);exit;


     $page = "dashboard/payroll/masters/incentive_bar/incentive_bar_list_view_partial_list_view.php";
     
      $this->load->view($page,$result);

        }
        else{
            redirect('login','refresh');
        }
}




} // end of class
