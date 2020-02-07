<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partymember extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);        
                             
        
    }



}   