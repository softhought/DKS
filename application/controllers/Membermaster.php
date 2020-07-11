<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Membermaster extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('commondatamodel','commondatamodel',TRUE);

        $this->load->model('membermastermodel','membermastermodel',TRUE);

         

       

    }



public function index()

{

    $session = $this->session->userdata('user_detail');

	if($this->session->userdata('user_detail'))

	{  

        $page = "dashboard/member-master/member_list";

        $header="";  



        $result['allmemberlist'] = $this->membermastermodel->getallmemberlist();

        //pre($result['allmemberlist']);exit;

        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

    

}



public function addeditmember(){



$session = $this->session->userdata('user_detail');

    if($this->session->userdata('user_detail'))

    {  



       if($this->uri->segment(3) == NULL){



        $result['mode'] = "ADD";

        $result['btnText'] = "Save";

        $result['btnTextLoader'] = "Saving...";

        $result['memberId'] = 0;

        $result['memberEditdata'] = [];



       }else{



          $result['mode'] = "EDIT";

          $result['btnText'] = "Update";

          $result['btnTextLoader'] = "Updating...";

          $result['memberId'] = $this->uri->segment(3);



          $where = array('member_id'=>$result['memberId']);



          $result['memberEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('member_master',$where);

          $wheredtl = array('member_master_id'=>$result['memberId']);

          $result['memberchildtl'] = $this->commondatamodel->getAllRecordWhere('member_children_details',$wheredtl);

         // print_r($result['memberchildtl']);exit;

           



       }



       $result['titleofneme'] = array('MR','MR.','MS','MS.'); 

        $result['studentstatus'] = array('ACTIVE MEMBER','TRANSFERRED','TEMPORARILY TERMINATED','TERMINATED','RESIGNED','DEAD');

       $result['YesorNolist'] = array('Y'=>'Yes','N'=>'No');

       $result['YorNlist'] = array('Y','N');

       $result['occuptionlist'] = $this->commondatamodel->getAllRecordWhereOrderBy("occupation_master",[],'occupation_name');

       $result['categorylist'] = $this->commondatamodel->getAllRecordWhereOrderBy("member_catogary_master",[],'category_name');







      // pre($result['categorylist']);exit;



        $page = "dashboard/member-master/addeditmember";

        $header="";

 

        

       // pre($result['accountgroupEditdata']);exit;



        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }





}





public function addchildrenDetail()

    {

        if($this->session->userdata('user_detail'))

        {

            $session = $this->session->userdata('user_detail');



            $data['rowno'] = $this->input->post('rowNo');

            $data['children_name'] = $this->input->post('children_name');

            $data['child_dob'] = $this->input->post('child_dob');

            $data['child_occupation'] = $this->input->post('child_occupation');

            $data['occup_name'] = $this->input->post('occup_name');

            $data['children_gender'] = $this->input->post('children_gender');

            $data['gendername'] = $this->input->post('gendername');

            $data['child_mobile'] = $this->input->post('child_mobile');

            $data['occuptionlist'] = $this->commondatamodel->getAllRecordWhereOrderBy("occupation_master",[],'occupation_name');



            $page = 'dashboard/member-master/add_children_detail_partial_view';

           

            $viewTemp = $this->load->view($page,$data,TRUE);

            echo $viewTemp;





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
          

          $isImage = trim(htmlspecialchars($this->input->post('isImage')));
          $memberId = trim(htmlspecialchars($this->input->post('memberId')));
          $isspouseImage = trim(htmlspecialchars($this->input->post('isspouseImage')));
          $IsSpouseSign = trim(htmlspecialchars($this->input->post('IsSpouseSign')));
          $docFile =  $_FILES;
          $mem_image =trim($this->input->post('mem_image'));
          $spouse_image=trim($this->input->post('spouse_image'));
          $spouse_signimage=trim($this->input->post('spouse_signimage'));
         
         //pre($docFile);
          $imageData = array(				
            'docFile' => $docFile, 
           
           );
           if($isImage == 'Y'){
              $filename = "imagefile";
              
              $mem_image = $this->membermastermodel->GetUploadImage($imageData,$filename);

           }
           if($isspouseImage == 'Y'){
            $filename = "spouseimagefile";
            
            $spouse_image = $this->membermastermodel->GetUploadImage($imageData,$filename);

         }
         if($IsSpouseSign == 'Y'){
          $filename = "spousesignimagefile";
          
          $spouse_signimage = $this->membermastermodel->GetUploadImage($imageData,$filename);

       }


       $mode = trim(htmlspecialchars($this->input->post('mode')));
       $title_one = trim(htmlspecialchars($this->input->post('title_one')));
       $member_name = trim(htmlspecialchars($this->input->post('member_name')));

       if(trim(htmlspecialchars($this->input->post('mem_dob'))) != ''){
         $mem_dob = str_replace('/', '-', trim(htmlspecialchars($this->input->post('mem_dob'))));
        $mem_dob = date('Y-m-d',strtotime($mem_dob));
       }else{
        $mem_dob=NULL;
       }
    

       $member_occupation = $this->input->post('member_occupation');
       $mem_category = trim(htmlspecialchars($this->input->post('mem_category')));
       $landline_no = trim(htmlspecialchars($this->input->post('landline_no')));
       $mobile_no = trim(htmlspecialchars($this->input->post('mobile_no')));
       $address_one = trim(htmlspecialchars($this->input->post('address_one')));
       $address_two = trim(htmlspecialchars($this->input->post('address_two')));
       $address_three = trim(htmlspecialchars($this->input->post('address_three')));
       $city = trim(htmlspecialchars($this->input->post('city')));
       $pincode = trim(htmlspecialchars($this->input->post('pincode')));
       $email = trim(htmlspecialchars($this->input->post('email')));

       if(trim(htmlspecialchars($this->input->post('admission_date'))) != ''){
        $admission_date = str_replace('/', '-', trim(htmlspecialchars($this->input->post('admission_date'))));
        $admission_dt =  date('Y-m-d',strtotime($admission_date));
    }else{
        $admission_dt = NULL;
    }

    $status = trim(htmlspecialchars($this->input->post('status')));     

       if(trim(htmlspecialchars($this->input->post('closing_dt'))) != ''){
         $closing_dt = str_replace('/', '-', trim(htmlspecialchars($this->input->post('closing_dt'))));
        $closing_date = date('Y-m-d',strtotime($closing_dt));
       }else{
        $closing_date = NULL;
       }

       $min_billing = trim(htmlspecialchars($this->input->post('min_billing')));
       $serv_tax_resp = trim(htmlspecialchars($this->input->post('serv_tax_resp')));
       $year_opening_bal = trim(htmlspecialchars($this->input->post('year_opening_bal')));
       $ceiling = trim(htmlspecialchars($this->input->post('ceiling')));
       $social_subs = trim(htmlspecialchars($this->input->post('social_subs')));
       $elt_member = trim(htmlspecialchars($this->input->post('elt_member')));
       $block_status = trim(htmlspecialchars($this->input->post('block_status')));
       //spouse details

         $title_two = trim(htmlspecialchars($this->input->post('title_two')));
         $spouse_name = trim(htmlspecialchars($this->input->post('spouse_name')));

        if(trim(htmlspecialchars($this->input->post('spouse_dob'))) != ''){
         $spousedob = str_replace('/', '-', trim(htmlspecialchars($this->input->post('spouse_dob'))));
        $spouse_dt = date('Y-m-d',strtotime($spousedob));
       }else{
        $spouse_dt = NULL;

       }        

         $spouse_occupation = trim(htmlspecialchars($this->input->post('spouse_occupation')));
         $spouse_gender = trim(htmlspecialchars($this->input->post('spouse_gender')));
         $spouse_mobile = trim(htmlspecialchars($this->input->post('spouse_mobile')));
         $spouse_email = trim(htmlspecialchars($this->input->post('spouse_email')));
         $card_serial_no = trim(htmlspecialchars($this->input->post('card_serial_no')));

       $updata = array(
                       'title_one'=>$title_one,
                       'member_name'=>$member_name,
                       'date_of_birth'=>$mem_dob,
                       'occupation_id'=>$member_occupation,
                       'category'=>$mem_category,
                       'admission_date'=>$admission_dt,
                       'address_one'=>$address_one,
                       'address_two'=>$address_two,
                       'address_three'=>$address_three,
                       'city'=>$city,
                       'pin'=>$pincode,
                       'phone'=>$landline_no,
                       'mobile'=>$mobile_no,
                       'email'=>$email, 
                       'status'=>$status,
                       'close_dt'=>$closing_date,
                       'serv_tax_resp'=>$serv_tax_resp,
                       'min_billing'=>$min_billing,
                       'min_ceiling'=>$ceiling,
                       'social_subs'=>$social_subs,
                       'blocked_y_n'=>$block_status,
                       'elt_member'=>$elt_member,
                       'title_two'=>$title_two,
                       'spouse_name'=>$spouse_name,
                       'spouse_dob'=>$spouse_dt,
                       'spouse_occupation'=>$spouse_occupation,
                       'spouse_gender'=>$spouse_gender,
                       'spouse_mobile'=>$spouse_mobile,
                       'spouse_email'=>$spouse_email,
                       'modify_date'=>date('Y-m-d'),
                       'card_serial_no'=>$card_serial_no,
                       'image_name'=>$mem_image,
                       'is_image'=>$isImage,
                       'spouse_image'=>$spouse_image,
                       'is_spouse_image'=>$isspouseImage,
                       'spouse_sign_image'=>$spouse_signimage,
                       'is_spouse_sign_image'=>$IsSpouseSign
                       );

                      //  pre($updata);exit;
       $upd_where = array('member_id'=>$memberId);     

        // old details for auditral
        $olddetails = $this->commondatamodel->getSingleRowByWhereCls('member_master',$upd_where);
        $Updatedata = $this->commondatamodel->updateSingleTableData('member_master',$updata,$upd_where);     

              $activity_module='data Upadte';
              $action = 'Update';
              $method='registration_action'; 
              $master_id =$memberId;
              $tablename = 'member_master';
              $old_description = json_encode($olddetails);
              $description = json_encode($updata);

            $this->activity_log($activity_module,$action,$method,$master_id,$tablename,$old_description,$description);

if($this->input->post('delIds') != ''){

     $childIds = explode(',',$this->input->post('delIds'));     

      for ($i=0; $i < count($childIds) ; $i++) { 
       $wherechildid = array('id'=>$childIds[$i]);
        $deletedtl = $this->commondatamodel->deleteTableData('member_children_details',$wherechildid);         

        }

    }   

    // pre($_FILES["childrenmagefile"]['name']['0']);
      //pre($docFile);
    //  exit;

    if($this->input->post('childdtlId') != ''){
        $childdtlId = $this->input->post('childdtlId');
         $child_name = $this->input->post('child_name');
         $children_dob = $this->input->post('children_dob');
         $children_occup = $this->input->post('children_occup');
         $children_gender = $this->input->post('children_gender');
         $children_mobile = $this->input->post('children_mobile'); 

        //  added by anil on 05-05-2020       
         $isChildrenImage = $this->input->post('isChildrenImage');        
         $IsChildrenSign = $this->input->post('IsChildrenSign');        
         $child_image = $this->input->post('child_image');        
         $children_signimage = $this->input->post('childsign_image');    
         
         //pre($child_image);
        // pre($children_signimage);

         for($i=0;$i<count($childdtlId);$i++){             
           if($children_dob[$i] != ''){
                $childrendob = str_replace('/', '-', $children_dob[$i]);
                 $childdob = date('Y-m-d',strtotime($childrendob));
            }else{
                 $childdob = NULL;

            }

            if($isChildrenImage[$i] == 'Y'){
             $filename = "childrenmagefile";
              $child_image[$i] = $this->membermastermodel->GetchildUploadImage($imageData,$filename,$i);

           }

           if($IsChildrenSign[$i] == 'Y'){
            $filename = "childrensignimagefile";
            $children_signimage[$i] = $this->membermastermodel->GetchildUploadImage($imageData,$filename,$i);

         }


              if($childdtlId[$i] == 0){
                  $instchilddtl = array(
                                     'member_master_id'=>$memberId,
                                     'name'=>$child_name[$i],
                                     'dob'=>$childdob,
                                     'child_occuption'=>$children_occup[$i],
                                     'gender'=>$children_gender[$i],
                                     'mobile'=>$children_mobile[$i],
                                     'image'=>$child_image[$i],                                    
                                     'sign_image'=>$children_signimage[$i],                                     
                                     'created_on'=>date('Y-m-d')
                                   ); 

                  $insertdata = $this->commondatamodel->insertSingleTableData('member_children_details',$instchilddtl);

              }else{

                $upchilddtl = array(
                                     'member_master_id'=>$memberId,
                                     'name'=>$child_name[$i],
                                     'dob'=>$childdob,
                                     'child_occuption'=>$children_occup[$i],
                                     'gender'=>$children_gender[$i],
                                     'mobile'=>$children_mobile[$i],
                                     'image'=>$child_image[$i],                                    
                                     'sign_image'=>$children_signimage[$i],   
                                     'created_on'=>date('Y-m-d')
                                   );
                   $upd_where = array('id'=>$childdtlId[$i]);
                 $Updatedata = $this->commondatamodel->updateSingleTableData('member_children_details',$upchilddtl,$upd_where);

              }
         }           

       }
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

