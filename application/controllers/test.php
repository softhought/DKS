<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function index()
	{      
		$page = "test.php";
		$result="";
		$header="";
		$session="";            
		createbody_method($result, $page, $header, $session);
	}
}