<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('Dashboardmodel','dashboard',TRUE);
       
    }

    public function index()
	{      
		$page = "dashboard/dashboard";
		$result="";
		$header="";
		$session="";            
		createbody_method($result, $page, $header, $session);
	}


  public function checkdateRange(){
  	 $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {

       $year_id = $session['yearid'];
    	$datedata = $this->input->post('datedata');

    	 $inputdt = str_replace('/', '-', $datedata);
          $input_date=date('Y-m-d',strtotime($inputdt));

    	$getdata = $this->dashboard->checkdaterange($input_date,$year_id);
    	
    	if(!empty($getdata))
                    {
                        $json_response = array(
                            "msg_status" => 1,
                        
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                           
                        );
                    }
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


    }else{
           redirect('login','refresh');
     
    }
  }










}//end of class