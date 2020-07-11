<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benvolentfund extends CI_Controller {

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
     
        $page = "dashboard/benvolent_fund/benvolent_fund_list_view.php";
        $header="";  
       
       
        $member_code = '';
        $cat_id = '';
        $month_id = '';

        $result['benvolentfundList'] = $this->memberfacilitymodel->getAllBenvolentFundList($year,$company,$member_code,$cat_id,$month_id);

        $result['allmembercodelist'] = $this->memberfacilitymodel->getallmebercode(); 
        $result['allmembercatlist'] = $this->memberfacilitymodel->getallcategorylist(); 
        $result['allmembermonthlist'] = $this->memberfacilitymodel->getallmonthlist(); 
        
            
       
       // pre($result['benvolentfundList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}




  public function addBenvolentFund(){

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
       

        $page = "dashboard/benvolent_fund/benvolent_fund_add_edit_view";
        $header="";

     
                
        //$result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);
        $result['memberCodeList'] = $this->memberfacilitymodel->getallmebercode();


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
           
          $year=$session['yearid'];
          $category=$this->input->post('category');
          $sel_month=$this->input->post('sel_month');
        

           $result['memberList']=$this->memberfacilitymodel->getAllMemberListByCategoryForBenovolentFees($category,$sel_month,$year);
         
			
			//pre($result['memberList']);exit;
            
    		
            $page = 'dashboard/benvolent_fund/member_benvolent_fund_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }

    public function benvolentFundAction() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            $activity_description=[];
            $company=$session['companyid'];
            $year=$session['yearid'];

        
               $rowCheck=$dataArry['rowCheck'];
               $sel_month=$dataArry['sel_month'];
               $category=$dataArry['category'];
               $amount=$dataArry['amount'];
               $heads=$dataArry['heads'];

     

                 foreach ($rowCheck as $key => $value) {

                 	 $memberid = $dataArry['memberid_'.$value];

                 
		                 $del_where = array(
		                 							'member_id' => $memberid,
		                 							'month_id' => $sel_month,
		                 							'year_id' => $year,
		                 							'company_id' => $company,
		                 							
		                 						   );
		            $this->commondatamodel->deleteTableData('benvolent_fund_transaction',$del_where);
                 	
                     
                   $benvolent_array = array(
                                                'month_id' => $sel_month,
                                                'year_id' => $year,
                                                'member_id' => $memberid,
                                                'taxable' =>$amount,
                                                'total_amount' => $amount,
                                                
                                               
                                                'company_id' => $company,  
                                                'created_on' => date('Y-m-d')
                                                
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('benvolent_fund_transaction',$benvolent_array);

          $activity_description[]=$benvolent_array; 
                    
              


                }


                            /* insert into activiry log*/
                           $activity_desc = json_encode($activity_description);

                              $user_activity = array(
                              "activity_module" => 'Benvolent Fund',
                              "action" => 'Insert',
                              "from_method" => 'benvolent/benvolentFundAction',
                              "table_name" => 'benvolent_fund_transaction',
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



    public function benvolentFundCopyMonthAction() {

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
            
                $result['memberList']=$this->memberfacilitymodel->getMemberListForCopyBenvolentFund($copycategory,$copy_from_month,$year,$company);

                if ($result['memberList'] ) {

                foreach ($result['memberList'] as $memberlist) {
                 $memberid=$memberlist->member_id;
                 $taxable=$memberlist->taxable;
                 $total_amount=$memberlist->total_amount;
                 $sel_month=$copy_to_month;

                 $del_where = array(
                                  'member_id' => $memberid,
                                  'month_id' => $sel_month,
                                  'year_id' => $year,
                                  'company_id' => $company,
                                  
                                   );
                     $this->commondatamodel->deleteTableData('benvolent_fund_transaction',$del_where);


                           $benvolent_array = array(
                                                'month_id' => $sel_month,
                                                'year_id' => $year,
                                                'member_id' => $memberid,
                                                'taxable' =>$taxable,
                                                'total_amount' => $total_amount,
                                                'company_id' => $company,  
                                                'created_on' => date('Y-m-d')
                                                
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('benvolent_fund_transaction',$benvolent_array);

          $activity_description[]=$benvolent_array; 
                    
                  
                
                }


                            /* insert into activiry log*/
                           $activity_desc = json_encode($activity_description);

                              $user_activity = array(
                              "activity_module" => 'Benvolent Fund',
                              "action" => 'Insert',
                              "from_method" => 'benvolent/benvolentFundCopyMonthAction',
                              "table_name" => 'benvolent_fund_transaction',
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

public function benvolentFundpartiallist(){

   $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $company=$session['companyid'];
          $year=$session['yearid'];

          $member_code = $this->input->post('member_code');
          $category_id = $this->input->post('category_id');
          $month_id = $this->input->post('month_id');


          $result['benvolentfundList'] = $this->memberfacilitymodel->getAllBenvolentFundList($year,$company,$member_code,$category_id,$month_id);

         // pre($result['benvolentfundList']);exit;

      $page = "dashboard/benvolent_fund/benvolent_fund_partial_list_view";
      $this->load->view($page,$result);

        }
        else{
            redirect('login','refresh');
        }
}




} // end of class
