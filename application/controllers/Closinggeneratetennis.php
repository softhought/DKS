<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Closinggeneratetennis extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('Closinggeneratetennismodel','closegenmodel',TRUE);

       

    }


  public function addClosing(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {    



       $year=$session['yearid'];

       if($this->uri->segment(3) == NULL){


        $result['mode'] = "ADD";

        $result['btnText'] = "Save";

        $result['btnTextLoader'] = "Saving...";

        $result['paymodeId'] = 0;

        $result['paymentmodeEditdata'] = [];



       }else{



          $result['mode'] = "EDIT";

          $result['btnText'] = "Update";

          $result['btnTextLoader'] = "Updating...";

          $result['paymodeId'] = $this->uri->segment(3);

       }



        $result['billtype'] = array('M'=>'Monthly','Q'=>'Quarterly');



        $orderby='display_serial';

        $result['monthList'] = $this->commondatamodel->getAllRecordWhereOrderBy('month_master',[],$orderby);

        								

        $result['quartermonthList'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');



        $where_year = array('financialyear.year_id' => $year);

        $result['acyear'] = $this->commondatamodel->getSingleRowByWhereCls('financialyear',$where_year)->year;



        $result['studentlist'] = [];



      //  pre($result['studentlist']);exit;

        $page = "dashboard/closing_generate/closing_generate_add_edit";

        $header="";



        createbody_method($result, $page, $header, $session);

    }else{

        redirect('login','refresh');

    }

}


 public function resetStudentList()

  {

      if($this->session->userdata('user_detail'))

      {

        

       $billing_style = $this->input->post('billing_style');     

       $result['studentList'] = $this->closegenmodel->studentListbyBillStyle($billing_style);



        ?>

           <select class="form-control select2" name="student_id" id="student_id" >

             <option value="">Select</option>

                          <?php 

                         foreach ($result['studentList'] as $studentlist) {  ?>

                         <option value="<?php echo $studentlist->admission_id;?>"  

                          ><?php echo $studentlist->student_code;?></option>

                          <?php     } ?>                              

          </select> 

        <?php



      }

      else

      {

          redirect('login','refresh');

      }

  }




   public function generateClosingAction() {
      
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
          
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);



            $company=$session['companyid'];
            $year=$session['yearid'];
            $activity_description="";
            $student_id=(int)$dataArry['student_id'];
            $billing_style=$dataArry['billing_style'];
            $month_id=(int)$dataArry['month'];
            $quarter_id=(int)$dataArry['quarter_month'];
            $mode=$dataArry['mode'];

            $search_month_id=0;
            $search_quarter_id=0;


              if ($billing_style=='M') {

                $where_month = array('month_master.id' => $month_id );

                  $monthData=$this->commondatamodel->getSingleRowByWhereCls('month_master',$where_month); 

                  $selectMonthSl=$monthData->display_serial;

                    if($selectMonthSl==1){

                      $search_year_id=$year-1;
                      $search_month_id=3;

                    }else{

                      $where_month_sl = array('month_master.display_serial' => $selectMonthSl-1 );
                      $monthDataSl=$this->commondatamodel->getSingleRowByWhereCls('month_master',$where_month_sl); 
                      $search_year_id=$year;
                      $search_month_id=$monthDataSl->id;

                    }

               /* echo "SM:".$search_month_id."| SY".$search_year_id; */

              }else{

                  if ($quarter_id==1) {

                    $search_quarter_id=4;
                    $search_year_id=$year-1;

                  }else{

                    $search_quarter_id=$quarter_id-1;
                    $search_year_id=$year;

                  }


                   /*   echo "QM:".$search_quarter_id."| SY".$search_year_id; */



              }


          if ($student_id!='') {
            $studentCode=$this->getStudentCode($student_id);


          $BillData = $this->closegenmodel->checkExistBillData($billing_style,$student_id,$month_id,$quarter_id,$year,$company);

          $billAmount=0;
          $closingAmount=0;
          if ($BillData) {

            $billAmount=$BillData->total_amount;

            $paidAmt=0;
            $fineAmt=0;
            $totalPay=0;

          $paymentData = $this->closegenmodel->getTannisPaymentAmount($BillData->bill_id,'RCFS');

            if ($paymentData) {

                $paidAmt=$paymentData->sum_payment_amount;
                $fineAmt=$paymentData->sum_fine_amt;
                $totalPay=$paidAmt-$fineAmt;

            }

            $closingAmount=$billAmount+$fineAmt-$paidAmt;

            
           
          }


          /* delete previous */

             $this->deleteTennisOpening($billing_style,$student_id,$month_id,$quarter_id,$year,$company);

          if ($month_id==0) {$month_id=NULL; }
          if ($quarter_id==0) {$quarter_id=NULL; }

          $student_opening = array(
                                    'student_id' => $student_id, 
                                    'student_code' => $studentCode, 
                                    'billing_style' => $billing_style, 
                                    'opening_balance' => $closingAmount, 
                                    'month_id' => $month_id, 
                                    'quarter_id' => $quarter_id, 
                                    'year_id' => $year, 
                                    'company_id' => $company, 
                                  );


           $insert=$this->commondatamodel->insertSingleTableData('tennis_student_opening',$student_opening);





             




              }else{


                 $result['studentList'] = $this->closegenmodel->studentListbyBillStyle($billing_style);


                 foreach ($result['studentList'] as $studentlist) { 

                    $student_id=$studentlist->admission_id;

                    $studentCode=$studentlist->student_code;



                    $BillData = $this->closegenmodel->checkExistBillData($billing_style,$student_id,$month_id,$quarter_id,$year,$company);

          $billAmount=0;
          $closingAmount=0;
          if ($BillData) {

            $billAmount=$BillData->total_amount;

            $paidAmt=0;
            $fineAmt=0;
            $totalPay=0;

          $paymentData = $this->closegenmodel->getTannisPaymentAmount($BillData->bill_id,'RCFS');

            if ($paymentData) {

                $paidAmt=$paymentData->sum_payment_amount;
                $fineAmt=$paymentData->sum_fine_amt;
                $totalPay=$paidAmt-$fineAmt;

            }

            $closingAmount=$billAmount+$fineAmt-$paidAmt;

            
           
          }


          /* delete previous */

             $this->deleteTennisOpening($billing_style,$student_id,$month_id,$quarter_id,$year,$company);

          if ($month_id==0) {$month_id=NULL; }
          if ($quarter_id==0) {$quarter_id=NULL; }

          $student_opening = array(
                                    'student_id' => $student_id, 
                                    'student_code' => $studentCode, 
                                    'billing_style' => $billing_style, 
                                    'opening_balance' => $closingAmount, 
                                    'month_id' => $month_id, 
                                    'quarter_id' => $quarter_id, 
                                    'year_id' => $year, 
                                    'company_id' => $company, 
                                  );


           $insert=$this->commondatamodel->insertSingleTableData('tennis_student_opening',$student_opening);




                    


                }








                
              }



                 if($insert){
                        $json_response = array(
                           "msg_status" => 1,
                            "msg_data" => "Applied successfully",
                        );

                 }else{

                        $json_response = array(
                            "msg_status" => 0,
                            "msg_data" => "There is some problem while applying ...Please try again."
                        );

                } 





            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit; 





            }

               redirect('login','refresh');

            } 




function getStudentCode($student_id){

$where = array('admission_id' => $student_id);

return $this->commondatamodel->getSingleRowByWhereCls('admission_register',$where)->student_code;

}



function deleteTennisOpening($billing_style,$student_id,$month_id,$quarter_id,$year,$company){

  if ($billing_style=='M') {
            $delwhere = array(
                                    'student_id' => $student_id, 
                                    'month_id' => $month_id, 
                                    'year_id' => $year, 
                                    'company_id' => $company, 
                             );
                           
          }else{

            $delwhere = array(
                                    'student_id' => $student_id,
                                    'quarter_id' => $quarter_id, 
                                    'year_id' => $year, 
                                    'company_id' => $company, 
                                  );
         }

         $deleteData=$this->commondatamodel->deleteTableData('tennis_student_opening',$delwhere);



}










} // end of class