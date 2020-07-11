<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('memberfacilitymodel','memberfacilitymodel',TRUE);
        $this->load->model('lipmodel','lipmodel',TRUE);
        
         ini_set('max_input_vars', 10000);
       
    }


public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{   $company=$session['companyid'];
        $year=$session['yearid'];
     
       
          $page = "dashboard/payroll/masters/lip/lip_list_view.php";
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




  public function addLip(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    $company=$session['companyid'];
        $year=$session['yearid'];
     
       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
      
        $result['lipID'] = 0;
        $result['lipEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
      
          $result['lipID'] = $this->uri->segment(3);


          $where_lip = array('lip_transaction.lip_tran_id' => $result['lipID'] );

         $result['lipEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('lip_transaction',$where_lip);
           

       } 

     $result['parameterData'] = $this->memberfacilitymodel->getFacilityDataByEntryModule('BENF');

      $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $orderby_cat='name';
              $result['employeeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('employee_master',[],$orderby_cat);
       

        $page = "dashboard/payroll/masters/lip/lip_add_edit_view";
        $header="";

     
                
        $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
        
       // pre($result['transactionEditdata']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}

    public function memberListview()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
           
           
          $category=$this->input->post('category');
        
          $where = array(
          					'member_master.category' => $category
          				);
           $result['memberList']=$this->commondatamodel->getAllRecordWhere("member_master",$where);
         
			
		//	pre($result['memberList']);exit;
            
    		
            $page = 'dashboard/benvolent_fund/member_benvolent_fund_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }

    public function lipAction() {

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
               $lipID=$dataArry['lipID'];
               $sel_month=$dataArry['sel_month'];
               $employee_id=$dataArry['employee'];
               $amount=$dataArry['amount'];
              
     

                 
		                 $del_where = array(
		                 							'employee_id' => $employee_id,
		                 							'month_id' => $sel_month,
		                 							'year_id' => $year,

		                 						   );
		            $this->commondatamodel->deleteTableData('lip_transaction',$del_where);
                 	
                     
                   $lip_array = array(
                                                'employee_id' => $employee_id,
                                                'month_id' => $sel_month,
                                                'lip_amount' => $amount,
                                                'year_id' => $year
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('lip_transaction',$lip_array);

       
      

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


    public function memberListviewforCopy()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
         
          $company=$session['companyid'];
          $year=$session['yearid']; 
          $category=$this->input->post('copycategory');
          $month=$this->input->post('copy_from_month');
        
      
           $result['memberList']=$this->memberfacilitymodel->getMemberListForCopyBenvolentFund($category,$month,$year,$company);
         
      
     // pre($result['memberList']);exit;
            
        
            $page = 'dashboard/benvolent_fund/member_benvolent_fund_copy_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }



    public function lipCopyMonthAction() {

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
                                'lip_transaction.month_id' => $copy_from_month, 
                                'lip_transaction.year_id' => $year, 
                              );
            
               $result['lipList']=$this->commondatamodel->getAllRecordWhere('lip_transaction',$where);
         

                if ($result['lipList'] ) {

                foreach ($result['lipList'] as $liplist) {
                 $employee_id=$liplist->employee_id;
                 $lip_amount=$liplist->lip_amount;
                

                   $del_where = array(
                                  'employee_id' => $employee_id,
                                  'month_id' => $copy_to_month,
                                  'year_id' => $year,

                                   );
                $this->commondatamodel->deleteTableData('lip_transaction',$del_where);
                  
                     
                   $lip_array = array(
                                                'employee_id' => $employee_id,
                                                'month_id' => $copy_to_month,
                                                'lip_amount' => $lip_amount,
                                                'year_id' => $year
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('lip_transaction',$lip_array);
                  
                
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

public function lipListByMonth(){

   $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $company=$session['companyid'];
          $year=$session['yearid'];

         
          $month_id = $this->input->post('month_id');


          $result['lipList'] = $this->lipmodel->getLipListByMonth($month_id,$year);
        //  pre($result['lipList']);exit;


     $page = "dashboard/payroll/masters/lip/lip_list_view_partial_list_view.php";
     
      $this->load->view($page,$result);

        }
        else{
            redirect('login','refresh');
        }
}




} // end of class
