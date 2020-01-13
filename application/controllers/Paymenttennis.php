<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymenttennis extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('Userauditmodel','audit',TRUE);    
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


    public function addPayment(){
        
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
                $paymentID = 0;
                $result['paymentID'] = $paymentID;
                $result['paymentEditdata'] = [];
                $where = array('status' => 'ACTIVE STUDENT' );
                
                $result['studentCodeList'] = $this->commondatamodel->getAllRecordWhere('admission_register',$where);

                $result['actobeCreditedList'] = $this->payment_tennis_model->getAcToBeCredited($company);
                $result['tennisItemList'] = $this->payment_tennis_model->getTennisItemList($company);

                 //gst rate
                    $result['cgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='CGST',$usedfor='O');
                    $result['sgstrate'] = $this->payment_tennis_model->getGSTrate($company,$year,$type='SGST',$usedfor='O');
                
              //  pre($result['sgstrate']);exit;
            
            }
            else
            {
                $result['mode'] = "EDIT";
                $result['btnText'] = "Update";
                $result['btnTextLoader'] = "Updating...";
                $paymentID = $this->uri->segment(3);
                $result['paymentID'] = $paymentID;
                
                $whereAry = [
                    'project_master.project_id' => $paymentID
                ];

                // getSingleRowByWhereCls(tablename,where params)
                 $result['projectEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('project_master',$whereAry); 
                //  pre($result['cbnaatEditdata']);exit;
                   $result['paymentEditdata'] = [];
                
            }

              $orderby='display_serial';
              $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

              $result['quartermonthList'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');

                

            $header = "";
            $page = 'dashboard/payment/payment_add_edit.php';
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
            $formData = $this->input->post('formDatas');
           // $rowDtlNo = $this->input->post('rowDtlNo');
            parse_str($formData, $dataArry);

            $start_letter='S';
            $firstCharacterLastName = strtoupper($dataArry['lastname'][0]);
            $startcCode=$start_letter.$firstCharacterLastName;

            $LastserialData=$this->payment_tennis_model->getNewCodeSerial($startcCode);
          
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

         $json_response = array(
                            "new_code" => $newCode 
                          );

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;


           
            

        }else
        {
            redirect('login','refresh');
        }


     }  





     /*  add admission data */


        public function admission_action() {

        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);
            
        
        
            $admissionID = trim(htmlspecialchars($dataArry['admissionID']));
            $mode = trim(htmlspecialchars($dataArry['mode']));
            $student_code = trim(htmlspecialchars($dataArry['student_code']));
            $title_one = trim(htmlspecialchars($dataArry['title_one']));
            $student_name = trim(htmlspecialchars($dataArry['student_name']));

        
                if($admissionID>0 && $mode=="EDIT")
                {
                    /*  EDIT MODE
                     *  -----------------
                    */

                    // $upd_where = array('news_flash.news_flash_id' =>$flashnewsID);

                    // $upd_array = array(
                    //     'line_one' => $lineone,
                  
                    //  );

                    //     $update = $this->commondatamodel->updateSingleTableData('news_flash',$upd_array,$upd_where);
                    
                    $update=1;
                    if($update)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Updated successfully",
                            "mode" => "EDIT"
                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while updating ...Please try again."
                        );
                    }



                } // end if mode
                else
                {
                    /*  ADD MODE
                     *  -----------------
                    */

                       $insert_array = array(
                                    'student_code' => $student_code,
                                    'title_one' => $title_one,
                                    'student_name' => $student_name,
                                    'status' => 'ACTIVE STUDENT',
                                    'entry_date' => date('Y-m-d')
                     );
            
            
                    $insertData = $this->commondatamodel->insertSingleTableData('admission_register',$insert_array);
                    

                    if($insertData)
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "Saved successfully",
                            "mode" => "ADD",
                            "admissionID" => $insertData,
                            "student_code" => $student_code

                        );
                    }
                    else
                    {
                        $json_response = array(
                            "msg_status" => 1,
                            "msg_data" => "There is some problem.Try again"
                        );
                    }

                } // end add mode ELSE PART




                

              
         

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;

            

        }
        else
        {
            redirect('login','refresh');
        }
    }



 public function resetStudentCodeList()
  {
      if($this->session->userdata('user_detail'))
      {
        

       $studentcode = $this->input->post('studentcode');


         $where = array('status' => 'ACTIVE STUDENT' );
                
        $result['studentCodeList'] = $this->commondatamodel->getAllRecordWhere('admission_register',$where);
        ?>
         <select class="form-control select2" name="sel_student_code" id="sel_student_code" >
                        
                            <?php 

                         foreach ($result['studentCodeList'] as $codelist) {  ?>
                         <option value="<?php echo $codelist->student_code;?>"
                          data-name="<?php echo $codelist->student_name; ?>"
                          <?php
                         if ($studentcode==$codelist->student_code) {
                           echo "selected";
                         }
                         ?>

                          ><?php echo $codelist->student_code;?></option>
                          <?php     } ?>
                                          
                                                   
         </select> 
        <?php

       


      }
      else
      {
          redirect('login','refresh');
      }
  } 



      public function addItemAmountDetail()
    {
        if($this->session->userdata('user_detail'))
        {
            $session = $this->session->userdata('user_detail');
        

            $data['rowno'] = $this->input->post('rowNo');

            $tennisitemid = $this->input->post('tennisitem');
            $tennisitem_where = array('item_id' => $tennisitemid );
            $data['tennisitem']=$this->commondatamodel->getSingleRowByWhereCls('tennis_item_master',$tennisitem_where);
            $data['hsncode'] = $this->input->post('hsncode');
            $data['itemqty'] = $this->input->post('itemqty');
            $data['itemrate'] = $this->input->post('itemrate');
            $data['itemtaxable'] = $this->input->post('itemtaxable');
            $data['cgstrateid'] = $this->input->post('cgstrateid');
            $data['cgstrate'] = $this->input->post('cgstrate');
            $data['cgstamt'] = $this->input->post('cgstamt');
            $data['sgstrateid'] = $this->input->post('sgstrateid');
            $data['sgstrate'] = $this->input->post('sgstrate');
            $data['sgstamt'] = $this->input->post('sgstamt');
            $data['item_netamt'] = $this->input->post('item_netamt');


          
            $page = 'dashboard/payment/itemamount_details_partial_view.php';
           
            $viewTemp = $this->load->view($page,$data,TRUE);
            echo $viewTemp;
        }
        else
        {
            redirect('login','refresh');
        }
    }


     public function saveTennisPaymentData() {

            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $searcharray);

            
        $mode = $searcharray['mode'];
        $paymentID = $searcharray['paymentID'];

   

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

    





}//end of class