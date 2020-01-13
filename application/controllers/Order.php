<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('commondatamodel','commondatamodel',TRUE);
	}
	
	public function index()
	{
		$session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
			$page = "dashboard/order/order-view";
			$header=""; 
			$result = [];
			//pre($result['studentcodelist']); exit;      
						
			createbody_method($result, $page, $header, $session);
		}else{
			redirect('login','refresh');
		}
	}
	
}
