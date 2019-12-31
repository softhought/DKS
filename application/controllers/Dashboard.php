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












}//end of class