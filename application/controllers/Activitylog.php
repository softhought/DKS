<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activitylog extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
             
       
    }

  function activity_log(){

  $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

        // $user_activity = array(
        //                 "activity_module_admin" =>$activity_module ,
        //                 "activity_module" => $activity_module,
        //                 "action" => $action,
        //                 "from_method" => $method,
        //                 "module_master_id" => $master_id,
        //                 "user_id" => $session['userid'],
        //                 "table_name" =>$tablename ,
        //                 "user_browser" => getUserBrowserName(),
        //                 "user_platform" =>  getUserPlatform(),
        //                 'description'=>$description
        //             );
        // $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
        	pre('fgdf');
     }else{
            redirect('login','refresh');
        }                
  }


}