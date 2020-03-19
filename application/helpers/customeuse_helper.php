<?php


if(!function_exists('pre'))
{
	
	function pre($printarry){
		$CI =& get_instance();
		echo "<pre>";
		print_r($printarry);
		echo "</pre>";
	}
}

if(!function_exists('q'))
{
	
	function q(){
		$CI =& get_instance();
        $CI->load->database();
        echo $CI->db->last_query();
	}
}

if(!function_exists('date_ymd'))
{
	//added by sandipan sarkar on 25.02.2019
	function date_ymd($date)
	{
		$dateEx = explode('/',$date);
            $month  = $dateEx[0];
            $day  = $dateEx[1];
			$year  = $dateEx[2];
			$stringDate = $day."-".$month."-".$year;
			$formated_date = date("Y-m-d",strtotime($stringDate));
			return $formated_date;
	}
}

if(!function_exists('date_dmy_to_ymd'))
{
	//added by sandipan sarkar on 25.02.2019
	function date_dmy_to_ymd($date)
	{
		$dateEx = explode('/',$date);
            $month  = $dateEx[1];
            $day  = $dateEx[0];
			$year  = $dateEx[2];
			$stringDate = $day."-".$month."-".$year;
			$formated_date = date("Y-m-d",strtotime($stringDate));
			return $formated_date;
	}
}


if(!function_exists('send_sms'))
{
	//added by shankha 
	function send_sms($mobile,$message,$module)
	{       $CI =& get_instance();
			$CI->load->database();

			//$phone='7003319369';
		   // $msg='softhought';
		    
			    $dks_user = "dkssms";
			    $dks_password = "dks1928";
			    
			    $dks_url = "http://5.189.187.82/sendsms/bulk.php?";
			    $type='TEXT';
			    $sender = "DKSSMS";
			    $mantra_udh = 0;

		      $url = 'username='.$dks_user;
		      $url.= '&password='.$dks_password;
		      $url.= '&type='.$type;
		      $url.= '&sender='.$sender;
		      $url.= '&mobile='.urlencode($mobile);
		      $url.= '&message='.urlencode($message);
		      // $url.= '&dlr-mask=19&dlr-url*';

		      $urltouse =  $dks_url.$url;

		      $file = file_get_contents($urltouse);
		      $status = explode(" | ",$file);


		      if($status[0]=='SUBMIT_SUCCESS')
		      {
		          $response="Y";

		          $sms_log_inst = array(
		          						'mobile' => $mobile,
		          						'message' => $message,
		          						'status_code' => $status[0],
		          						'response_code' => $status[1],
		          						'module' => $module,
		          						'created_on' => date('Y-m-d')
		          					   );

		          $CI->commondatamodel->insertSingleTableData('sms_log',$sms_log_inst);
		          
		      }
		      else
		      {
		          $response="N";
		      }

		      return($response);

		

	}
}
