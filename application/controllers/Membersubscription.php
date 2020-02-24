<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membersubscription extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('memberfacilitymodel','memberfacilitymodel',TRUE);
        $this->load->model('membersubscriptionmodel','membersubscriptionmodel',TRUE);
        
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
     
        $page = "dashboard/member_subscription/member_subscription_list_view.php";
        $header="";  

        $result['subscriptionList'] = $this->membersubscriptionmodel->getAllSubscriptionFeeList($year,$company,$member_code,$cat_id);

       
        //pre($result['subscriptionList']);exit;

        $result['allmembercodelist'] = $this->membersubscriptionmodel->getallmebercode(); 
        $result['allmembercatlist'] = $this->membersubscriptionmodel->getallcategorylist(); 
      
       
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function addSubscription(){

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

      //    $result['transactionEditdata'] = $this->memberfacilitymodel->getFactlityDetailsByTranId($result['tranId']);
           

       } 

     $result['parameterData'] = $this->memberfacilitymodel->getFacilityDataByEntryModule('BENF');

      $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $orderby_cat='category_name';
              $result['catogaryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_catogary_master',[],$orderby_cat);
       
    
        $page = "dashboard/member_subscription/member_subscription_add_edit_view";
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
        
        
         $result['memberList']=$this->membersubscriptionmodel->getAllMemberListByCategory($category);
         
             
            //   pre($result['parameterData']);exit;
            
            
            $page = 'dashboard/member_subscription/member_subscription_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }


public function subscriptionFeeAction() {

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
               $category=$dataArry['category'];
               $subscription=$dataArry['subscription'];
             
               $heads=$dataArry['heads'];


               if ($rowCheck) {
               
                             $del_where = array(
                                                    'category_id' =>$category,
                                                    'year_id' => $year,
                                                    'company_id' => $company,
                                                    
                                                   );
                    $this->commondatamodel->deleteTableData('member_subscription',$del_where);
               }


                 foreach ($rowCheck as $key => $value) {

                     $memberid = $dataArry['memberid_'.$value];

                 
                         
                    
                     
                   $subscription_array = array(
                                                'member_id' => $memberid,
                                                'category_id' =>$category,
                                                'subscription_amount' =>$subscription,
                                                'year_id' => $year,
                                                'company_id' => $company,  
                                                'created_on' => date('Y-m-d')
                                                
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('member_subscription',$subscription_array);

          $activity_description[]=$subscription_array; 
                    
              


                }


                            /* insert into activiry log*/
                           $activity_desc = json_encode($activity_description);

                              $user_activity = array(
                              "activity_module" => 'subscription fees',
                              "action" => 'Insert',
                              "from_method" => 'Membersubscription/subscriptionFeeAction',
                              "table_name" => 'member_subscription',
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


    public function subscriptionfeespartiallist(){

   $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $company=$session['companyid'];
          $year=$session['yearid'];

          $member_code = $this->input->post('member_code');
          $cat_id = $this->input->post('category_id');
        


        

           $result['subscriptionList'] = $this->membersubscriptionmodel->getAllSubscriptionFeeList($year,$company,$member_code,$cat_id);

         // pre($result['benvolentfundList']);exit;

       $page = "dashboard/member_subscription/member_subscription_partial_list_view.php";
      $this->load->view($page,$result);

        }
        else{
            redirect('login','refresh');
        }
}











}// end of class
