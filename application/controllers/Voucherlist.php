<?php

//we need to call PHP's session object to access it through CI
class Voucherlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('voucherlistmodel', '', TRUE);
		
       
      
        }

    public function index() {

        $session = $this->session->userdata('user_detail');
        if ($this->session->userdata('user_detail')) {



            $company = $session['companyid'];
            $yearid = $session['yearid'];
           
           
            $headercontent='';
			
			$yearData = $this->voucherlistmodel->getFinancialyearData($yearid);
            $result['fiscalStartDt'] = $yearData->start_date;
			$result['fiscalEndDt'] = $yearData->end_date;
           
			$result['accountList'] =  $this->voucherlistmodel->getAccountList($company,$yearid);
           

          
            $page = 'dashboard/voucher_list/header_view';
            $header = '';
			
			
			
            createbody_method($result, $page, $header, $session, $headercontent);
        
           
        } else {
            redirect('login', 'refresh');
        }
    }

    public function showvoucherList()
    {
            $fromdate = $this->input->post('fromdate');
            $todate = $this->input->post('todate');
            $purchasetype = $this->input->post('purchasetype');
            $account = $this->input->post('account');


             if($fromdate!="" && $todate!=""){
                $fromdate = str_replace('/', '-', $fromdate);
                $fromDate = date("Y-m-d",strtotime($fromdate));
                $todate = str_replace('/', '-', $todate);
                $toDate = date("Y-m-d",strtotime($todate));
             }
             else{
                 $fromDate = NULL;
                 $toDate = NULL;
             }
             
            $vdata['from_date']= $fromDate;
            $vdata['to_date']= $toDate;
            $vdata['ptype']=$purchasetype;
            $vdata['accid']=$account;

            $data['voucherlist']=$this->voucherlistmodel->getVoucherList($vdata);
            $page = 'dashboard/voucher_list/list_view';
           // $page = 'voucher_list/list_view';
            $view = $this->load->view($page, $data, TRUE);
            echo($view);
        
    }



    public function getTransType($trantype)
    {
        $transactionType="";
        if($trantype=="PUR")
        {
            $transactionType ="Purchase";
        }
        elseif($trantype=="SALE")
        {
            $transactionType ="Sale";
        }
        elseif($trantype=="RC")
        {
            $transactionType ="Receipt";
        }
        elseif($trantype=="PY")
        {
            $transactionType ="Payment";
        }
        elseif($trantype=="GV")
        {
            $transactionType ="General";
        }
        elseif($trantype=="JV")
        {
            $transactionType ="Journal";
        }
        elseif($trantype=="CADV")
        {
            $transactionType ="Cutsomer Advance";
        }
        elseif($trantype=="VADV")
        {
            $transactionType ="Vendor Advance";
        } 
        elseif($trantype=="CN")
        {
            $transactionType ="Contra";
        }
        elseif($trantype=="All")
        {
            $transactionType ="";
        }

        return $transactionType;
    }

        
       
 
}
?>