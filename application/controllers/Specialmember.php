<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Specialmember extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('membermastermodel','membermastermodel',TRUE);
       
    }

public function index()
{
  $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/special-member/special_member_list";
        $header="";  
        
        

        $result['specialmemberlist'] = $this->membermastermodel->getallspecialmemberlist();
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}




public function print_specialmember(){
       if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
            $company=$session['companyid'];
            $year=$session['yearid'];


            // load library
            $this->load->library('Pdf');
            $pdf = $this->pdf->load();
            ini_set('memory_limit', '256M'); 

            $page = "dashboard/special-member/special_member_list_pdf.php"; 
            $result['specialmemberlist'] = $this->membermastermodel->getallspecialmemberlist();

                 // $html = $this->load->view($page, $result, true);
               
                //  $html="Hello";
                $html = $this->load->view($page, $result, true);
                // render the view into HTML
                $pdf->WriteHTML($html); 
                $output = 'specialmemberPdf' . date('Y_m_d_H_i_s') . '_.pdf'; 
                $pdf->Output("$output", 'I');
                exit();
         }
         else {
            redirect('login', 'refresh');
        }
}







} // end of class