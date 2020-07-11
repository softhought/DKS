<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activitylog extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
             
       
    }


function index(){

        $mobile='7003319369';
        $message='COVID-19';
        $module='TEST';
        send_sms($mobile,$message,$module);

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


  function send_sms(){

    $phone='7003319369';
    $msg='softhought';
    
    $dks_user = "dkssms";
    $dks_password = "dks1928";
    
    $dks_url = "http://5.189.187.82/sendsms/bulk.php?";
    //$mantra_from = "manl";
    $type='TEXT';
    $sender = "DKSSMS";
    $mantra_udh = 0;

      $url = 'username='.$dks_user;
      $url.= '&password='.$dks_password;
      $url.= '&type='.$type;
      $url.= '&sender='.$sender;
      $url.= '&mobile='.urlencode($phone);
      $url.= '&message='.urlencode($msg);
      // $url.= '&dlr-mask=19&dlr-url*';

      $urltouse =  $dks_url.$url;

      $file = file_get_contents($urltouse);
      $status = explode(" | ",$file);


      if($status[0]=='SUBMIT_SUCCESS')
      {
          $response="Y";

      }
      else
      {
          $response="N";
      }

      return($response);



  }





} // end of class