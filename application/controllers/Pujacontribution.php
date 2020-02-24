<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pujacontribution extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('pujacontributionmodel','pujacontributionmodel',TRUE);

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
     
        $page = "dashboard/puja_contribution/puja_contribution_list_view.php";
        $header="";  

        $result['pujacontributionList'] = $this->pujacontributionmodel->getAllPujacontributionList($year,$company,$member_code,$cat_id,$month_id);

 
       // pre($result['pujacontributionList']);exit;

        $result['allmembercodelist'] = $this->pujacontributionmodel->getallmebercode(); 
        $result['allmembercatlist'] = $this->pujacontributionmodel->getallcategorylist(); 
       // $result['allmembermonthlist'] = $this->pujacontributionmodel->getallmonthlist();

           $orderby='display_serial';
              $result['allmembermonthlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

       
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function addContribution(){

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


       } 

   

      $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $orderby_cat='category_name';
              $result['catogaryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_catogary_master',[],$orderby_cat);
       
        
        $page = "dashboard/puja_contribution/puja_contribution_add_edit_view";
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
        
        
         $result['memberList']=$this->pujacontributionmodel->getAllMemberListByCategory($category);
         
             
              // pre($result['memberList']);exit;
            
            
            $page = 'dashboard/puja_contribution/puja_contribution_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }


public function pujacontributionAction() {

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
               $contribution=$dataArry['contribution'];
               $service_tax=$dataArry['service_tax'];
               $total=$dataArry['total'];
             
               $heads=$dataArry['heads'];

               if ($rowCheck) {


                           $del_where = array(
                                                    'month_id' =>$sel_month,
                                                    'category_id' =>$category,
                                                    'year_id' => $year,
                                                    'company_id' => $company,
                                                    
                                                   );
                    $this->commondatamodel->deleteTableData('puja_contribution',$del_where);
               }

                


                 foreach ($rowCheck as $key => $value) {

                     $memberid = $dataArry['memberid_'.$value];

                   
                    
                     
                   $puja_contribution_array = array(
                                                'member_id' => $memberid,
                                                'month_id' => $sel_month,
                                                'category_id' =>$category,
                                                'contribution' =>$contribution,
                                                'service_tax' =>$service_tax,
                                                'total_amount' =>$total,
                                                'year_id' => $year,
                                                'company_id' => $company,  
                                                'created_on' => date('Y-m-d')
                                                
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('puja_contribution',$puja_contribution_array);

          $activity_description[]=$puja_contribution_array; 

                }


                            /* insert into activiry log*/
                           $activity_desc = json_encode($activity_description);
                              $user_activity = array(
                              "activity_module" => 'Puja Contribution',
                              "action" => 'Insert',
                              "from_method" => 'pujacontribution/pujacontributionAction',
                              "table_name" => 'puja_contribution',
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


public function pujacontributionpartiallist(){

   $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

          $company=$session['companyid'];
          $year=$session['yearid'];
          $member_code = $this->input->post('member_code');
          $cat_id = $this->input->post('category_id');
          $month_id = $this->input->post('month_id');
        

          $result['pujacontributionList'] = $this->pujacontributionmodel->getAllPujacontributionList($year,$company,$member_code,$cat_id,$month_id);

         // pre($result['pujacontributionList']);exit;

       $page = "dashboard/puja_contribution/puja_contribution_partial_list_view.php";
      $this->load->view($page,$result);

        }
        else{
            redirect('login','refresh');
        }
}


public function memberPujaConListviewforCopy()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
         
          $company=$session['companyid'];
          $year=$session['yearid']; 
          $category=$this->input->post('copycategory');
          $month=$this->input->post('copy_from_month');
        
      
           $result['memberList']=$this->pujacontributionmodel->getMemberListForCopyPujacontribution($category,$month,$year,$company);
         
      
     // pre($result['memberList']);exit;
            
        
            $page = 'dashboard/puja_contribution/puja_contribution_copy_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }


 public function pujacontributionCopyMonthAction() {

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
            
                $result['memberList']=$this->pujacontributionmodel->getMemberListForCopyPujacontribution($copycategory,$copy_from_month,$year,$company);


                if ($result['memberList']) {
                 $del_where = array(
                                  
                                  'month_id' => $copy_to_month,
                                  'category_id' => $copycategory,
                                  'year_id' => $year,
                                  'company_id' => $company,
                                  
                                   );
                $this->commondatamodel->deleteTableData('puja_contribution',$del_where);
                }


                if ($result['memberList'] ) {
               
               
                foreach ($result['memberList'] as $memberlist) {
                 $memberid=$memberlist->member_id;
                 $contribution=$memberlist->contribution;
                 $service_tax=$memberlist->service_tax;
                 $total_amount=$memberlist->total_amount;
               

                 $sel_month=$copy_to_month;

               
                  
                     
                     $puja_contribution_array = array(
                                                'member_id' => $memberid,
                                                'month_id' => $sel_month,
                                                'category_id' =>$copycategory,
                                                'contribution' =>$contribution,
                                                'service_tax' =>$service_tax,
                                                'total_amount' =>$total_amount,
                                                'year_id' => $year,
                                                'company_id' => $company,  
                                                'created_on' => date('Y-m-d')
                                                
                                               );


          $insert = $this->commondatamodel->insertSingleTableData('puja_contribution',$puja_contribution_array);

          $activity_description[]=$puja_contribution_array; 
                    
                  
                
                }


                            /* insert into activiry log*/
                           $activity_desc = json_encode($activity_description);

                              $activity_desc = json_encode($activity_description);
                              $user_activity = array(
                              "activity_module" => 'Puja Contribution',
                              "action" => 'Insert',
                              "from_method" => 'pujacontribution/pujacontributionAction',
                              "table_name" => 'puja_contribution',
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








}// end of class
