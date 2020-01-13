<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentregister extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('studentregistermodel','studentregistermodel',TRUE);
       
       
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  
        $page = "dashboard/student-register/student_registration_list";
        $header=""; 
        $result['studentregisterdtl'] = $this->commondatamodel->getAllDropdownData('admission_register');
        //pre($result['studentcodelist']); exit;      
                    
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
  }


  public function addeditstudrestration()
{
    $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

          if($this->uri->segment(3) == NULL){

            $result['mode'] = "ADD";
            $result['btnText'] = "Save";
            $result['btnTextLoader'] = "Saving...";
            $result['admissionId'] = 0;
            $result['studentregisterEditdata'] = [];

           }else{

              $result['mode'] = "EDIT";
              $result['btnText'] = "Update";
              $result['btnTextLoader'] = "Updating...";
              $result['admissionId'] = $this->uri->segment(3);

              $where = array('admission_id'=>$result['admissionId']);

              $result['studentregisterEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('admission_register',$where);
  
 
       }

           //pre($result['studentregisterEditdata']);exit;
        $result['studentcategory'] = $this->commondatamodel->getAllDropdownData('student_category');


        $result['studentplaygroup'] = $this->commondatamodel->getAllDropdownData('student_play_group');
        // pre($result['studentplaygroup']);exit;

        $result['titleofneme'] = array('MR','MR.','MS','MS.'); 
        $result['studentstatus'] = array('ACTIVE STUDENT','RESIGNED','TEMPORARY TERMINATED'); 
        $result['specialcoching'] = array('Y','N',); 
        $result['billtype'] = array('M'=>'MONTHLY','Q'=>'QUARTERLY');
              
        $page = "dashboard/student-register/addedit_student_registration";
        $header="";            
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
  }


  public function registration_action(){

      $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {

            $dataArry=[];
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

           $dir = $_SERVER['DOCUMENT_ROOT'].'/DKS/assets/img/student-images';  //server

          $isImage = trim(htmlspecialchars($this->input->post('isImage')));
          $admissionId = trim(htmlspecialchars($this->input->post('admissionId')));
          $upd_where = array('admission_register.admission_id' => $admissionId);

            $imagefile="";

          if($isImage == 'Y'){
          

                $config = array(
                    'upload_path' => $dir,
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    //allowed max file size. 0 means unlimited file size
                    'max_size' => '0',
                    //max file name size
                    'max_filename' => '255',
                    //whether file name should be encrypted or not
                    'encrypt_name' => TRUE
                        //store image info once uploaded
                );
                
             $this->load->library('upload', $config);

          //   $this->upload->initialize($config);
             
              if ($this->upload->do_upload('imagefile')) {

                $file_detail = $this->upload->data();
                //pre($file_detail);exit; 
                 $imagefile = $file_detail['file_name'];

               $image_data = array('image_name'=>$imagefile,'is_image'=>$isImage);


                  $Updatedata = $this->commondatamodel->updateSingleTableData('admission_register',$image_data,$upd_where);

                  
                }
              

        }
        
       
       $mode = trim(htmlspecialchars($this->input->post('mode')));
       $studtitle = trim(htmlspecialchars($this->input->post('studtitle')));
       $studname = trim(htmlspecialchars($this->input->post('studname')));

       if(trim(htmlspecialchars($this->input->post('studdob'))) != ''){

         $dob = str_replace('/', '-', trim(htmlspecialchars($this->input->post('studdob'))));

        $studdob = date('Y-m-d',strtotime($dob));
       }else{

        $studdob=NULL;

       }
      
       $father_title = trim(htmlspecialchars($this->input->post('father_title')));
       $fathername = trim(htmlspecialchars($this->input->post('fathername')));
       $landline_no = trim(htmlspecialchars($this->input->post('landline_no')));
       $mobile_no = trim(htmlspecialchars($this->input->post('mobile_no')));
       $address_one = trim(htmlspecialchars($this->input->post('address_one')));
       $address_two = trim(htmlspecialchars($this->input->post('address_two')));
       $address_three = trim(htmlspecialchars($this->input->post('address_three')));
       $city = trim(htmlspecialchars($this->input->post('city')));
       $pincode = trim(htmlspecialchars($this->input->post('pincode')));
       $email = trim(htmlspecialchars($this->input->post('email')));

       if(trim(htmlspecialchars($this->input->post('admission_dt'))) != ''){

        $admidt = str_replace('/', '-', trim(htmlspecialchars($this->input->post('admission_dt'))));
        $admission_dt =  date('Y-m-d',strtotime($admidt));
    }else{
        $admission_dt = NULL;
    }
       
       $category = trim(htmlspecialchars($this->input->post('category')));
       $status = trim(htmlspecialchars($this->input->post('status')));
       $category = trim(htmlspecialchars($this->input->post('category')));

       if(trim(htmlspecialchars($this->input->post('exit_dt'))) != ''){

         $exitdt = str_replace('/', '-', trim(htmlspecialchars($this->input->post('exit_dt'))));
        $exit_dt = date('Y-m-d',strtotime($exitdt));
       }else{
        $exit_dt = NULL;
       }
       
       $play_group = trim(htmlspecialchars($this->input->post('play_group')));
       $special_coaching = trim(htmlspecialchars($this->input->post('special_coaching')));
       $monthly_sub = trim(htmlspecialchars($this->input->post('monthly_sub')));
       $bill_style = trim(htmlspecialchars($this->input->post('bill_style')));
       
       

       $updata = array(
                       'title_one'=>$studtitle,
                       'student_name'=>$studname,
                       'student_dob'=>$studdob,
                       'title_two'=>$father_title,
                       'guardian_name'=>$fathername,
                       'phone_one'=>$landline_no,
                       'phone_two'=>$mobile_no,
                       'address_one'=>$address_one,
                       'address_two'=>$address_two,
                       'address_three'=>$address_three,
                       'city'=>$city,
                       'pin'=>$pincode,
                       'email'=>$email,
                       'admission_dt'=>$admission_dt,
                       'category'=>$category,
                       'status'=>$status,
                       'discharge_dt'=>$exit_dt,
                       'play_group'=>$play_group,
                       'special_coaching'=>$special_coaching,
                       'subscription'=>$monthly_sub,
                       'bill_style'=>$bill_style,
                       'modify_date'=>date('Y-m-d')
                       );
               
                                 
           
                

                $Updatedata = $this->commondatamodel->updateSingleTableData('admission_register',$updata,$upd_where);

              $activity_module='data Upadte';
              $action = 'Update';
              $method='registration_action'; 
              $master_id =$admissionId;
              $tablename = 'admission_register';
              $description = $studtitle.$studname.' '.'date of birth-'.$dob.' '.'has father name-'.$father_title.$fathername.' '.'landlin No.\mobileno-'.$landline_no.'/'.$mobile_no.' '.'address-'.$address_one.$address_two.$address_three.' '.'city-'.$city.' '.'pin-'.$pincode.' '.'admission_dt-'.$admidt.' '.'discharge_dt-'.$exitdt.' '.'monthly subscription-'.$monthly_sub.' '.'Billing Style-'.$bill_style.' '.'modify date-'.date('Y-m-d');
            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$description);

             
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
           

        header('Content-Type: application/json');
        echo json_encode( $json_response );
        exit; 


         }else{
            redirect('login','refresh');
        }   

  } 

 function activity_log($activity_module,$action,$method,$master_id,$tablename,$description){

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
                        'description'=>$description
                    );
        $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
     }else{
            redirect('login','refresh');
        }                
  }


}