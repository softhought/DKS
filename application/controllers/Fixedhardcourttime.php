<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Fixedhardcourttime extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('commondatamodel','commondatamodel',TRUE);

        $this->load->model('fixedhardcourttimemodel','fixedhardcourttimemodel',TRUE);

         

       

   }



public function index()

{

    $session = $this->session->userdata('user_detail');

	if($this->session->userdata('user_detail'))

	{  

        $page = "dashboard/fixed-hard-time/fixed_hard_court_time_list";

        $header="";  



        $result['fixedtimelist'] = $this->commondatamodel->getAllRecordWhereOrderBy('fixed_hard_court_timeslot',[],'from_time');

        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

    

}



public function addedittime(){



  $session = $this->session->userdata('user_detail');

    if($this->session->userdata('user_detail'))

    {  



       if($this->uri->segment(3) == NULL){



        $result['mode'] = "ADD";

        $result['btnText'] = "Save";

        $result['btnTextLoader'] = "Saving...";

        $result['timeslotId'] = 0;

        $result['timeEditdata'] = [];



       }else{



          $result['mode'] = "EDIT";

          $result['btnText'] = "Update";

          $result['btnTextLoader'] = "Updating...";

          $result['timeslotId'] = $this->uri->segment(3);



          $where = array('time_slot_id'=>$result['timeslotId']);



          $result['timeEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('fixed_hard_court_timeslot',$where);

           



       }


       $result['day_night_arr'] = array('DAY' =>"DAY",'AFTERNOON' =>"AFTERNOON",'NIGHT' =>"NIGHT" );




        $page = "dashboard/fixed-hard-time/addedit_fixed_hard_court_time";

        $header="";

        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

}



public function checkduplicatetime(){



   $session = $this->session->userdata('user_detail');

        if($this->session->userdata('user_detail'))

        {

            $from_time = date('H:i s',strtotime($this->input->post('from_time')));

            $to_time = date('H:i s',strtotime($this->input->post('to_time')));


          $where = array('from_time'=>$from_time,'to_time'=>$to_time);



          $existstime = $this->commondatamodel->getSingleRowByWhereCls('fixed_hard_court_timeslot',$where);



         

          if(!empty($existstime)){



                   $json_response = array(

                            "msg_status" => 1,

                            

                        );

          }else{



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



public function fixedhardtime_action(){



      $session = $this->session->userdata('user_detail');

        if($this->session->userdata('user_detail'))

        {



            $dataArry=[];

            $json_response = array();

            $formData = $this->input->post('formDatas');

            parse_str($formData, $dataArry);



            

            $mode = trim(htmlspecialchars($dataArry['mode']));

            $timeslotId = trim(htmlspecialchars($dataArry['timeslotId']));

            $from_time = trim(htmlspecialchars($dataArry['from_time']));

            $to_time = trim($dataArry['to_time']);

            $in_hour = trim(htmlspecialchars($dataArry['in_hour']));

            $sel_day_night = trim(htmlspecialchars($dataArry['sel_day_night']));



            // $lastinsertid = $this->fixedhardcourttimemodel->getLastinsertid();



           $wheretimeseril = array('moduleTag'=>'TIME'); 

           $serialno = $this->commondatamodel->getSingleRowByWhereCls('serialmaster',$wheretimeseril)->serial;



            $data = array('from_time'=>date('H:i s',strtotime($from_time)),'to_time'=>date('H:i s',strtotime($to_time)),'in_hour'=>$in_hour,'display_sl'=> $serialno,'is_active'=>'Y','cteated_on'=>date('Y-m-d'),'day_night'=>$sel_day_night);

           

                       

            if($mode == 'ADD' && $timeslotId == 0){



              $insertdata = $this->commondatamodel->insertSingleTableData('fixed_hard_court_timeslot',$data);

              

              $activity_module='data Insert';

              $action = 'Insert';

              $method='Fixedhardcourttime/fixedhardtime_action'; 

              $master_id =$insertdata;

              $tablename = 'fixed_hard_court_timeslot';

              $old_description ='';

              $description = json_encode($data);

            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

              if($insertdata){



                      $json_response = array(

                            "msg_status" => 1,

                            "msg_data" => "Saved successfully",

                            

                        );

                  }else

                    {

                        $json_response = array(

                            "msg_status" => 0,

                            "msg_data" => "There is some problem while updating ...Please try again."

                        );

                    }     



            }else{



               $updata = array('from_time'=>date('H:i s',strtotime($from_time)),'to_time'=>date('H:i s',strtotime($to_time)),'in_hour'=>$in_hour,'is_active'=>'Y','cteated_on'=>date('Y-m-d'),'day_night'=>$sel_day_night); 



                $upd_where = array('fixed_hard_court_timeslot.time_slot_id' => $timeslotId);

                //old data details

               $old_details = $this->commondatamodel->getSingleRowByWhereCls('fixed_hard_court_timeslot',$upd_where);



                $Updatedata = $this->commondatamodel->updateSingleTableData('fixed_hard_court_timeslot',$data,$upd_where);

                     



              $activity_module='data Update';

              $action = 'Update';

              $method='Fixedhardcourttime/fixedhardtime_action'; 

              $master_id =$timeslotId;

              $tablename = 'fixed_hard_court_timeslot';

              $old_description = json_encode($old_details);

              $description = json_encode($data);

            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);



                  if($Updatedata){



                      $json_response = array(

                            "msg_status" => 1,

                            "msg_data" => "Updated successfully",

                            

                        );



                    }else

                    {

                        $json_response = array(

                            "msg_status" => 0,

                            "msg_data" => "There is some problem while updating ...Please try again."

                        );

                    }  

            }



        $serialupdata = array('serial'=>$serialno+1,'lastnumber'=>$serialno+1);



         $Upserial = $this->commondatamodel->updateSingleTableData('serialmaster',$serialupdata,$wheretimeseril);    



        header('Content-Type: application/json');

        echo json_encode( $json_response );

        exit; 





         }else{

            redirect('login','refresh');

        }   



  }


  function calculatetime(){

    $session = $this->session->userdata('user_detail');

    if($this->session->userdata('user_detail'))

    { 

        $from_time = $this->input->post('from_time');
        $to_time = $this->input->post('to_time');

        $start = strtotime($from_time);
        $end = strtotime($to_time);
        $mins = ($end - $start) / 60;
        $time = number_format((float)$mins/60, 2, '.', '');
        if($time < 0){
            $time = 24 - ltrim($time,'-');
        }
        $json_response = array(
            "time" =>$time          

        );

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 

    }else{

        redirect('login','refresh');

    } 

  }





  function activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description){



  $session = $this->session->userdata('user_detail');

        if($this->session->userdata('user_detail'))

        {



        $user_activity = array(

                        "activity_module_admin" =>$activity_module ,

                        "activity_module" => $activity_module,

                        "action" => $action,

                        "from_method" => $method,

                        "module_master_id" => $master_id,

                        "user_id" => $session['userid'],

                        "table_name" =>$tablename ,

                        "user_browser" => getUserBrowserName(),

                        "user_platform" =>  getUserPlatform(),

                        'old_description'=>$old_description,

                        'description'=>$description,

                        'ip_address'=>getUserIPAddress()

                    );

        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);

     }else{

            redirect('login','refresh');

        }                

  }

}