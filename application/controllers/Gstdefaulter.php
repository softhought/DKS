<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gstdefaulter extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('yearlystatementmodel','yearlystatementmodel',TRUE);
        $this->load->model('gstdefaultermodel','gstdefaultermodel',TRUE);
      
             
}

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/gstdefaulter/gst_defaulter_view.php";
        $header="";  
        $company=$session['companyid'];
        $year=$session['yearid'];
      
        $member_id='';
        $month='4';
        $category='';

        
        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);
        $orderby_cat='category_name';
        $result['catogaryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_catogary_master',[],$orderby_cat);
        $where_year = array('financialyear.year_id' => $year);
        $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;
        $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
         //$result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
        $result['memberList'] = $this->gstdefaultermodel->getallmembercode();
        // pre($result['memberList']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function getDefaluterMemberList(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $company=$session['companyid'];
            $year=$session['yearid'];
            $sel_member = $this->input->post('member_id');
            $category = $this->input->post('category');
            $month = $this->input->post('billing_upto');
            $notice_date = $this->input->post('notice_date');
            $equal_above = $this->input->post('equal_above');


            if($notice_date!=""){
                    $notice_date = str_replace('/', '-', $notice_date);
                    $notice_monthyear = date("Y-m",strtotime($notice_date)); 
                    $notice_date = date("Y-m-d",strtotime($notice_date)); 
            }else{
                    $notice_date = NULL;
            }

            $firstdate = $notice_monthyear."-01";
          

       
        $result['billList'] = $this->gstdefaultermodel->getBillingDefaulterList($sel_member,$category,$month,$year,$company,$firstdate,$notice_date,$equal_above);
      
       // pre($result['billList']);exit;
         $page = "dashboard/gstdefaulter/member_bill_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }



 public function resetMemberList()
  {
      if($this->session->userdata('user_detail'))
      {
        
       $category = $this->input->post('category');     
     

         $result['memberlist'] = $this->gstdefaultermodel->getAllActiveMemberByCategory($category);

        

        ?>
           <select class="form-control select2" name="member_id" id="member_id" >
             <option value="">Select</option>
                          <?php 
                         foreach ($result['memberlist'] as $memberlist) {  ?>
                         <option value="<?php echo $memberlist->member_id;?>"  
                          ><?php echo $memberlist->member_code;?></option>
                          <?php     } ?>                              
          </select> 
        <?php

      }
      else
      {
          redirect('login','refresh');
      }
  } 



 public function print_notice(){
       if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
            $company=$session['companyid'];
            $year=$session['yearid'];

            $equal_above = $this->input->post('equal_above');
            $rowCheck = $this->input->post('rowCheck');
            $sel_member = $this->input->post('member_id');
            $category = $this->input->post('category');
            $month = $this->input->post('billing_upto');
            $notice_date = $this->input->post('notice_date');
            $equal_above = $this->input->post('equal_above');


            if($notice_date!=""){
                    $notice_date = str_replace('/', '-', $notice_date);
                    $notice_monthyear = date("Y-m",strtotime($notice_date)); 
                    $notice_date = date("Y-m-d",strtotime($notice_date)); 
            }else{
                    $notice_date = NULL;
            }

            $firstdate = $notice_monthyear."-01";

            foreach ($rowCheck as $key => $value) {

                   $memberids[] = $this->input->post('memberid_'.$value);

            }


             $result['billList'] = $this->gstdefaultermodel->getSelectedDefaulterListNotice($memberids,$month,$year,$company,$firstdate,$notice_date,$equal_above);

            // pre($result['billList']);
      



            // load library
            $this->load->library('Pdf');
            $pdf = $this->pdf->load();
            ini_set('memory_limit', '256M'); 

            $where_company = array('company_master.company_id' => $company);

            $result['companyData'] = $this->commondatamodel->getSingleRowByWhereCls('company_master',$where_company);
       
            //pre( $result['companyData']);exit;
     
            ini_set('memory_limit', '256M'); 
            $page = "dashboard/gstdefaulter/defaulter_notice_pdf_view.php"; 

               // $html = $this->load->view($page, $result, true);
               
              //  $html="Hello";
                     $html = $this->load->view($page, $result, true);
                // render the view into HTML
                $pdf->WriteHTML($html); 
                $output = 'testPdf' . date('Y_m_d_H_i_s') . '_.pdf'; 
                $pdf->Output("$output", 'I');
                exit();
         }
         else {
            redirect('login', 'refresh');
        }
}








}// end of class