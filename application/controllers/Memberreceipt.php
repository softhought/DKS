<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class memberreceipt extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('memberreceiptmodel','memberreceiptmodel',TRUE);
        $this->load->model('Paymenttennismodel','payment_tennis_model',TRUE);   
      
    }

public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  exit;
        $page = "usermanagement/useraudit";
        $header="";       
        $result['usersAuditList']=$this->audit->getAuditList($session['userid']);
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}



    public function addReceipt(){
        
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {   
            $company=$session['companyid'];
            $year=$session['yearid'];
            if($this->uri->rsegment(3) == NULL)
            {
                $result['mode'] = "ADD";
                $result['btnText'] = "Save";
                $result['btnTextLoader'] = "Saving...";
                $memberreceiptID = 0;
                $result['memberreceiptID'] = $memberreceiptID;
                $result['paymentEditdata'] = [];
              
                
                 $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);

                $result['actobeCreditedList'] = $this->payment_tennis_model->getAcToBeCredited($company);
                $result['tennisItemList'] = $this->payment_tennis_model->getTennisItemList($company);

                $result['categoryList'] = $this->commondatamodel->getAllRecordWhere('member_catogary_master',[]);

                 //gst rate
                    $result['cgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='CGST',$usedfor='O');
                    $result['sgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='SGST',$usedfor='O');
                
                //pre($result['memberCodeList']);exit;
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $memberreceiptID = $this->uri->segment(3);
                $result['memberreceiptID'] = $memberreceiptID;
                
                $whereAry = [
                    'project_master.project_id' => $memberreceiptID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['projectEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('project_master',$whereAry); 
                //  pre($result['cbnaatEditdata']);exit;
                   $result['paymentEditdata'] = [];
                
            }

              $where_year = array('financialyear.year_id' => $year);
              $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $result['quartermonthList'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');
              $result['fineAccountList'] = $this->commondatamodel->getAllDropdownData('account_master');

              $result['acTobeDebited'] = $this->commondatamodel->getAllRecordWhere('payment_mode_details',[]);

            $header = "";
            $page = 'dashboard/member_receipt/member_receipt_add_edit.php';
            createbody_method($result, $page, $header,$session);
        }
        else
        {
            redirect('login','refresh');
        }
        

    }






       public function generateCode() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();

           $firstname = $this->input->post('firstname');
           $lastname = $this->input->post('lastname');
           $member_category = $this->input->post('member_category');



           $where_category= array('member_catogary_master.cat_id' => $member_category);
           $startLetters = $this->commondatamodel->getSingleRowByWhereCls('member_catogary_master',$where_category)->member_tag;
           
          
            $firstCharacterLastName = strtoupper($lastname[0]);
            $startcCode=$startLetters.$firstCharacterLastName;

            $LastserialData=$this->memberreceiptmodel->getNewCodeSerial($startLetters,$member_category);

          
          
            if ($LastserialData) {
               $lastSerial=intval($LastserialData->last_serial);
            }else{
              $lastSerial=0;  
            }


         $nextSerial=$lastSerial+1;

         $digit = strlen($nextSerial); 

         if($digit==2){
            $serialno = "0".$nextSerial;
         }
          elseif($digit==1){
            $serialno = "00".$nextSerial;
         }else{
             $serialno = $nextSerial;
         }

         

         $newCode=$startcCode.'-'.$serialno;


           $insert_array = array(
                                    'member_code' =>  $newCode,
                                    'member_name' => $firstname." ".$lastname,
                                    'status' => 'ACTIVE STUDENT',
                                 
                     );
            
            
                    $insertData = $this->commondatamodel->insertSingleTableData('member_master',$insert_array);




         $json_response = array(
                            "new_code" => $newCode, 
                            "member_id" => $insertData 
                          );

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


           
            

        }else
        {
            redirect('login','refresh');
        }


     }  


 public function resetMemberCodeList()
  {
      if($this->session->userdata('user_detail'))
      { 

       $memberid = $this->input->post('memberid');

      
                
           $result['memberCodeList'] = $this->commondatamodel->getAllRecordWhere('member_master',[]);

          // pre($result['memberCodeList']);

        ?>
         <select class="form-control select2" name="sel_member_code" id="sel_member_code" >
                        
                            <?php 

                         foreach ($result['memberCodeList'] as  $membercode) { ?>
                          <option value="<?php echo $membercode->member_id;?>"
                               data-name="<?php echo $membercode->title_one." ".$membercode->member_name; ?>"
                          <?php
                         if ($memberid==$membercode->member_id) {
                           echo "selected";
                         }
                         ?>

                          ><?php echo $membercode->member_code;?></option>
                          <?php     } ?>
                                          
                                                   
         </select> 
        <?php

      }
      else
      {
          redirect('login','refresh');
      }
  } 



     public function saveMemberReceiptData() {

            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $searcharray);

            
        $mode = $searcharray['mode'];
        $memberreceiptID = $searcharray['memberreceiptID'];

        pre($searcharray);exit;

        if ($mode == "ADD" && $paymentID == "0") {
          
            $insertData = $this->payment_tennis_model->insertDataTennisPayment($searcharray);
               if($insertData)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD",
                            "paymentid" => $insertData,
                           

                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }

        } else {


          $this->updateData($rentbillid, $searcharray);
        }



            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;





    }// end of saveTennisPaymentData









}// end of class
