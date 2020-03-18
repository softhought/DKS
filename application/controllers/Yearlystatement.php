<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yearlystatement extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('yearlystatementmodel','yearlystatementmodel',TRUE);
             
}

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/yearly_statement/yearly_statement.php";
        $header="";  
        $company=$session['companyid'];
        $year=$session['yearid'];
      
        $member_id='';
        $month='4';
        $category='';

        $result['billList']=[];
        $orderby='display_serial';
        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);
        $orderby_cat='category_name';
        $result['catogaryList'] = $this->commondatamodel->getAllRecordWhereOrderBy('member_catogary_master',[],$orderby_cat);

        $where_member = array('member_master.status' => 'ACTIVE MEMBER' );
        //$result['memberList'] = $this->commondatamodel->getAllRecordWhere('member_master',$where_member);
        $result['memberList'] = $this->yearlystatementmodel->getallmembercode();
       //  pre($result['memberList']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function getYearlyStatementByMonth(){
    
    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $year=$session['yearid'];
            $company = $session['companyid'];

            $from_month = $this->input->post('from_month');
            $to_month = $this->input->post('to_month');
            $sel_member = $this->input->post('sel_member');
           
        $where = array('financialyear.year_id' =>  $year);
        $result['financialyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where);

          
            $years=explode(" ",$result['financialyear']->year);
           
            if ($from_month==1 || $from_month==2 || $from_month==3) {
                if($from_month<10){$from_month="0".$from_month;}
                 $fromyearmonth=$years[2]."-".$from_month;

            }else{

              if($from_month<10){$from_month="0".$from_month;}
              $fromyearmonth=$years[0]."-".$from_month;

            }


            if ($to_month==1 || $to_month==2 || $to_month==3) {
                if($to_month<10){$to_month="0".$to_month;}
                $toyearmonth=$years[2]."-".$to_month;
            }else{
                 if($to_month<10){$to_month="0".$to_month;}
                 $toyearmonth=$years[0]."-".$to_month;
            }

     
        $result['sel_member'] = $sel_member;
        $result['fromyearmonth'] = $fromyearmonth;
        $result['sel_member'] = $toyearmonth;

        $result['billList'] = $this->yearlystatementmodel->getMemberBillMasterData($sel_member,$fromyearmonth,$toyearmonth,$year,$company);


        //  pre($result['billList']);exit;

         $page = "dashboard/yearly_statement/yearly_statement_list_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }









}// end of class