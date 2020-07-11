<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tennisexp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('incentivebarmodel','incentivebarmodel',TRUE);
        $this->load->model('tennisexpmodel','tennisexpmodel',TRUE);
        
         ini_set('max_input_vars', 10000);
       
    }


public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{   $company=$session['companyid'];
        $year=$session['yearid'];
     
       
          $page = "dashboard/payroll/masters/tennis_exp/tennis_exp_list_view.php";
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




  public function addTennisexp(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    $company=$session['companyid'];
        $year=$session['yearid'];
     
       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
      
        $result['tennisexpID'] = 0;
        $result['tennisexpEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
      
          $result['tennisexpID'] = $this->uri->segment(3);


          $where_inc = array('tennis_exp_transaction.tennis_exp_id' => $result['tennisexpID'] );

         $result['tennisexpEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('tennis_exp_transaction',$where_inc);
           

       } 



      $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $orderby_cat='name';
              $result['employeeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('employee_master',[],$orderby_cat);
       

        $page = "dashboard/payroll/masters/tennis_exp/tennis_exp_add_edit_view";
        $header="";

     
                
        $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
        
       // pre($result['transactionEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}



    public function tennisexpAction() {

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
               $tennisexpID=$dataArry['tennisexpID'];
               $sel_month=$dataArry['sel_month'];
               $employee_id=$dataArry['employee'];
               $amount=$dataArry['amount'];
              
     

                 
		                 $del_where = array(
		                 							'employee_id' => $employee_id,
		                 							'month_id' => $sel_month,
                                  'year_id' => $year,
		                 							'company_id' => $company,

		                 						   );
		            $this->commondatamodel->deleteTableData('tennis_exp_transaction',$del_where);
                 	
                     
                   $tennis_array = array(
                                                'employee_id' => $employee_id,
                                                'month_id' => $sel_month,
                                                'amount' => $amount,
                                                'year_id' => $year,
                                                'company_id' => $company,
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('tennis_exp_transaction',$tennis_array);

       
      

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






    public function tennisexpCopyMonthAction() {

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
                                'tennis_exp_transaction.month_id' => $copy_from_month, 
                                'tennis_exp_transaction.year_id' => $year, 
                                'tennis_exp_transaction.company_id' => $company, 
                              );
            
               $result['tennisexpList']=$this->commondatamodel->getAllRecordWhere('tennis_exp_transaction',$where);
         

                if ($result['tennisexpList'] ) {

                foreach ($result['tennisexpList'] as $tennisexplist) {
                 $employee_id=$tennisexplist->employee_id;
                 $amount=$tennisexplist->amount;
                

                   $del_where = array(
                                  'employee_id' => $employee_id,
                                  'month_id' => $copy_to_month,
                                  'year_id' => $year,
                                  'company_id' => $company,

                                   );
                $this->commondatamodel->deleteTableData('tennis_exp_transaction',$del_where);
                  
                     
                   $inc_array = array(
                                                'employee_id' => $employee_id,
                                                'month_id' => $copy_to_month,
                                                'amount' => $amount,
                                                'year_id' => $year,
                                                'company_id' => $company
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('tennis_exp_transaction',$inc_array);
                  
                
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

public function tennisexpListByMonth(){

   $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $company=$session['companyid'];
          $year=$session['yearid'];

         
          $month_id = $this->input->post('month_id');


          $result['tennisexpList'] = $this->tennisexpmodel->getTennisexpByMonth($month_id,$year,$company);
        //  pre($result['lipList']);exit;


     $page = "dashboard/payroll/masters/tennis_exp/tennis_exp_list_view_partial_list_view.php";
     
      $this->load->view($page,$result);

        }
        else{
            redirect('login','refresh');
        }
}




} // end of class
