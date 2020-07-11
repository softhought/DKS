<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blockunblockregister extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
      
        $this->load->model('blockunblockregistermodel','blockunblockmodel',TRUE); 
        
        
        set_time_limit(1200); 
    }

public function index()
{

  $session = $this->session->userdata('user_detail');

	if($this->session->userdata('user_detail'))
	{ 
        $page = "dashboard/block_unblock_register/block_unblock_register_view.php";
        $header="";  
        
        $result['memberList'] = $this->blockunblockmodel->getMemberListDataForDailyBalance();

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}



public function getBlockUnblockMemberList(){

    $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $company=$session['companyid'];
            $year=$session['yearid'];
           
            $codelike = $this->input->post('member_start_letter');
            $member_id = $this->input->post('member_id');
            $blockunblock = $this->input->post('sel_block_unblock');
            $balance = $this->input->post('balance');


        if ($codelike!='') {
            $result['memberList'] = $this->blockunblockmodel->getMemberListCodeLike($codelike,$blockunblock,$balance);
        }else{
            $result['memberList'] = $this->blockunblockmodel->getMemberListbyMember($member_id,$blockunblock,$balance); 
        }
        
      
       // pre($result['memberList']);exit;
        
        $page = "dashboard/block_unblock_register/block_unblock_partial_view.php"; 

          $this->load->view($page,$result);

          

        }else{
            redirect('login','refresh');
        } 

    }



public function print_blockunblock(){
       if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
            $company=$session['companyid'];
            $year=$session['yearid'];

            $codelike = $this->input->post('member_start_letter');
            $member_id = $this->input->post('sel_member_code');
            $blockunblock = $this->input->post('sel_block_unblock');
            $balance = $this->input->post('balance');

            if ($balance=='') {
                $balance=0;
            }


        if ($codelike!='') {
            $result['memberList'] = $this->blockunblockmodel->getMemberListCodeLike($codelike,$blockunblock,$balance);
        }else{
            $result['memberList'] = $this->blockunblockmodel->getMemberListbyMember($member_id,$blockunblock,$balance); 
        }


            // load library
            $this->load->library('Pdf');
            $pdf = $this->pdf->load();
            ini_set('memory_limit', '256M'); 

            $page = "dashboard/block_unblock_register/block_unblock_pdf_view.php"; 

               // $html = $this->load->view($page, $result, true);
               
              //  $html="Hello";
                     $html = $this->load->view($page, $result, true);
                // render the view into HTML
                $pdf->WriteHTML($html); 
                $output = 'blockunblockPdf' . date('Y_m_d_H_i_s') . '_.pdf'; 
                $pdf->Output("$output", 'I');
                exit();
         }
         else {
            redirect('login', 'refresh');
        }
}



}// end of class
