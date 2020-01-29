<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developmentfees extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('memberfacilitymodel','memberfacilitymodel',TRUE);
        
         ini_set('max_input_vars', 10000);
       
    }


  public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{   $company=$session['companyid'];
        $year=$session['yearid'];

        $member_code = '';
        $cat_id = '';
        $month_id = '';
     
        $page = "dashboard/development_fees/development_fees_list_view.php";
        $header="";  

        $result['benvolentfundList'] = $this->memberfacilitymodel->getAllDevelopmentFeeList($year,$company,$member_code,$cat_id,$month_id);

        $result['allmembercodelist'] = $this->memberfacilitymodel->getallmebercode(); 
        $result['allmembercatlist'] = $this->memberfacilitymodel->getallcategorylist(); 
        $result['allmembermonthlist'] = $this->memberfacilitymodel->getallmonthlist();
       // pre($result['benvolentfundList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}




  public function addDevelopmentfees(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    $company=$session['companyid'];
        $year=$session['yearid'];
     
       if($this->uri->segment(3) == NULL){

        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
      
        $result['tranId'] = 0;
        $result['transactionEditdata'] = [];

       }else{

          $result['mode'] = "EDIT";
          $result['btnText'] = "Update";
          $result['btnTextLoader'] = "Updating...";
      
          $result['tranId'] = $this->uri->segment(3);

          $result['transactionEditdata'] = $this->memberfacilitymodel->getFactlityDetailsByTranId($result['tranId']);
           

       } 

     $result['parameterData'] = $this->memberfacilitymodel->getFacilityDataByEntryModule('BENF');

      $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $orderby_cat='category_name';
              $result['catogaryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_catogary_master',[],$orderby_cat);
       
        $result['parameterData'] = $this->memberfacilitymodel->getFacilityDataByEntryModule('DEVF');
        $page = "dashboard/development_fees/development_fees_add_edit_view";
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
        
        
         $result['memberList']=$this->memberfacilitymodel->getAllMemberListByCategory($category);
         
			 
			//   pre($result['parameterData']);exit;
            
    		
            $page = 'dashboard/development_fees/development_fees_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }

    public function developmentFeeAction() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $activity_description="";
            $company=$session['companyid'];
            $year=$session['yearid'];
            


        
               $rowCheck=$dataArry['rowCheck'];
               $sel_month=$dataArry['sel_month'];
               $category=$dataArry['category'];
               $taxable=$dataArry['amount'];
               $net_amt=$dataArry['net_amt'];
               $cgst_id=$dataArry['cgst_id'];
               $sgst_id=$dataArry['sgst_id'];
               $cgst_amt=$dataArry['cgst_amt'];
               $sgst_amt=$dataArry['sgst_amt'];
               $heads=$dataArry['heads'];

     

                 foreach ($rowCheck as $key => $value) {

                 	 $memberid = $dataArry['memberid_'.$value];

                 
		                 $del_where = array(
		                 							'member_id' => $memberid,
		                 							'month_id' => $sel_month,
		                 							'year_id' => $year,
		                 							'company_id' => $company,
		                 							
		                 						   );
		            $this->commondatamodel->deleteTableData('development_fees_transaction',$del_where);
                 	
                     
                   $benvolent_array = array(
                                                'month_id' => $sel_month,
                                                'year_id' => $year,
                                                'member_id' => $memberid,
                                                'taxable' =>$taxable,
                                                'cgst_id' =>$cgst_id,
                                                'cgst_amt' =>$cgst_amt,
                                                'sgst_id' =>$sgst_id,
                                                'sgst_amt' =>$sgst_amt,
                                                'total_amount' => $net_amt,

                                                'company_id' => $company,  
                                                'created_on' => date('Y-m-d')
                                                
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('development_fees_transaction',$benvolent_array);

          $activity_description[]=$benvolent_array; 
                    
              


                }


                            /* insert into activiry log*/
                           $activity_desc = json_encode($activity_description);

                              $user_activity = array(
                              "activity_module" => 'Development fees',
                              "action" => 'Insert',
                              "from_method" => 'developmentfee/developmentFeeAction',
                              "table_name" => 'development_fees_transaction',
                              "user_id" => $session['userid'],
                              "ip_address" => getUserIPAddress(),
                              "user_browser" => getUserBrowserName(),
                              "user_platform" => getUserPlatform(),
                              "description" =>  $activity_desc
                             );
                             
                $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);

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


    public function memberDevListviewforCopy()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
         
          $company=$session['companyid'];
          $year=$session['yearid']; 
          $category=$this->input->post('copycategory');
          $month=$this->input->post('copy_from_month');
        
      
           $result['memberList']=$this->memberfacilitymodel->getMemberListForCopyDevelopmentFees($category,$month,$year,$company);
         
      
     // pre($result['memberList']);exit;
            
        
            $page = 'dashboard/development_fees/development_fees_copy_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }


        public function DevelopmentFeeCopyMonthAction() {

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
               $copycategory=$dataArry['copycategory'];
               $copy_to_month=$dataArry['copy_to_month'];
            
                $result['memberList']=$this->memberfacilitymodel->getMemberListForCopyDevelopmentFees($copycategory,$copy_from_month,$year,$company);

                if ($result['memberList'] ) {
               
               
                foreach ($result['memberList'] as $memberlist) {
                 $memberid=$memberlist->member_id;
                 $taxable=$memberlist->taxable;
                 $total_amount=$memberlist->total_amount;
                 $cgst_id=$memberlist->cgst_id;
                 $cgst_amt=$memberlist->cgst_amt;
                 $sgst_id=$memberlist->sgst_id;
                 $sgst_amt=$memberlist->sgst_amt;
                 $net_amt=$memberlist->total_amount;
                 $sel_month=$copy_to_month;

               $del_where = array(
                                  'member_id' => $memberid,
                                  'month_id' => $sel_month,
                                  'year_id' => $year,
                                  'company_id' => $company,
                                  
                                   );
                $this->commondatamodel->deleteTableData('development_fees_transaction',$del_where);
                  
                     
                   $benvolent_array = array(
                                                'month_id' => $sel_month,
                                                'year_id' => $year,
                                                'member_id' => $memberid,
                                                'taxable' =>$taxable,
                                                'cgst_id' =>$cgst_id,
                                                'cgst_amt' =>$cgst_amt,
                                                'sgst_id' =>$sgst_id,
                                                'sgst_amt' =>$sgst_amt,
                                                'total_amount' => $net_amt,

                                                'company_id' => $company,  
                                                'created_on' => date('Y-m-d')
                                                
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('development_fees_transaction',$benvolent_array);

          $activity_description[]=$benvolent_array; 
                    
                  
                
                }


                            /* insert into activiry log*/
                           $activity_desc = json_encode($activity_description);

                              $user_activity = array(
                              "activity_module" => 'Development Fee',
                              "action" => 'Insert',
                              "from_method" => 'benvolent/DevelopmentFeeCopyMonthAction',
                              "table_name" => 'development_fees_transaction',
                              "user_id" => $session['userid'],
                              "ip_address" => getUserIPAddress(),
                              "user_browser" => getUserBrowserName(),
                              "user_platform" => getUserPlatform(),
                              "description" =>  $activity_desc
                             );
                             
                $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);

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

public function devlopmentfeespartiallist(){

   $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $company=$session['companyid'];
          $year=$session['yearid'];

          $member_code = $this->input->post('member_code');
          $category_id = $this->input->post('category_id');
          $month_id = $this->input->post('month_id');


          $result['devlopmentfessList'] = $this->memberfacilitymodel->getAllDevelopmentFeeList($year,$company,$member_code,$category_id,$month_id);

         // pre($result['benvolentfundList']);exit;

       $page = "dashboard/development_fees/development_fees_partial_list_view.php";
      $this->load->view($page,$result);

        }
        else{
            redirect('login','refresh');
        }
}





} // end of class
