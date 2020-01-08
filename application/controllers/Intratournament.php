<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intratournament extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('intratournamentmodel','intratournamentmodel',TRUE);
        
         
       
    }


public function index()
{
    $session = $this->session->userdata('user_detail');
	if($this->session->userdata('user_detail'))
	{  
        $page = "dashboard/intra_tournament_fees/intra_tournament_fees_list_view.php";
        $header="";  

        $result['StudentList'] = $this->intratournamentmodel->getAllTournamentFeesList();
       // pre($result['StudentList']);exit;
        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
    
}


public function addFees(){

  $session = $this->session->userdata('user_detail');
    if($this->session->userdata('user_detail'))
    {  

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

          $where = array('id'=>$result['paymodeId']);

          $result['paymentmodeEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('payment_mode_details',$where);
           

       }

        $result['billtype'] = array('M'=>'MONTHLY','Q'=>'QUARTERLY');

        $result['monthList'] = $this->commondatamodel->getAllDropdownData('month_master');
        $result['quartermonthList'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');

        $page = "dashboard/intra_tournament_fees/intra_tournament_fees_add_edit.php";
        $header="";
 
        $result['accountmasterlist'] = $this->commondatamodel->getAllRecordWhereOrderBy('account_master',[],'account_name');
       
      //  pre($result['quartermonthList']);exit;

        createbody_method($result, $page, $header, $session);
    }else{
        redirect('login','refresh');
    }
}



       
    public function studentListview()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
           
           
          $billing_style=$this->input->post('billing_style');
        
          $where = array(
          					'admission_register.bill_style' => $billing_style
          				);
           $result['studentList']=$this->commondatamodel->getAllRecordWhere("admission_register",$where);
         
			
			//pre($result['studentList']);exit;
            
    		
            $page = 'dashboard/intra_tournament_fees/intra_tournament_fees_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }


       public function IntraTournamentFeesAction() {

         $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {
            $json_response = array();
            $formData = $this->input->post('formDatas');
            parse_str($formData, $dataArry);

            $company=$session['companyid'];
            $year=$session['yearid'];

        
               $rowCheck=$dataArry['rowCheck'];
               $billing_style=$dataArry['billing_style'];

     

                 foreach ($rowCheck as $key => $value) {

                 	 $admissionid = $dataArry['admissionid_'.$value];

                 
		                 $del_where = array(
		                 							'admission_id' => $admissionid
		                 							
		                 						   );
		               	$this->commondatamodel->deleteTableData('intra_tournament_fees',$del_where);
                 	
                     
                       $where = array('admission_id' =>$admissionid);
                   
    $student_code = $this->commondatamodel->getSingleRowByWhereCls('admission_register',$where)->student_code;
                   $turnament_array = array(
                                                'admission_id' => $admissionid,
                                                'student_code' => $student_code,
                                                'month_id' => NULL,
                                                'quarter_id' => NULL,
                                                'yearid' => $year,
                                                'billing_style' => $billing_style,
                                                'fees' => $dataArry['fees'],
                                                'created_on' => date('Y-m-d')
                                                
                                               );

          $insert = $this->commondatamodel->insertSingleTableData('intra_tournament_fees',$turnament_array);
                    
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
        else{
            redirect('login','refresh');
        }



    }







    public function copyHeaderView()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
        $result =[];
        $header="";
        $result['mode'] = "ADD";
        $result['btnText'] = "Save";
        $result['btnTextLoader'] = "Saving...";
         $result['paymodeId'] = 0;
        $result['paymentmodeEditdata'] = [];
           
        $result['billtype'] = array('M'=>'MONTHLY','Q'=>'QUARTERLY');

        $result['monthList'] = $this->commondatamodel->getAllDropdownData('month_master');
        $result['quartermonthList'] = $this->commondatamodel->getAllDropdownData('quarter_month_master');
         
			
			//pre($result['billtype']);exit;
            
    		
            $page = 'dashboard/intra_tournament_fees/copy_tournament_fees_header_view.php';
           
             createbody_method($result, $page, $header, $session);
            
        }
        else{
            redirect('login','refresh');
        }
    }



    public function studentCopyListview()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
            $result =[];
           
           
          $billing_style=$this->input->post('billing_style');
        
          $where = array(
          					'admission_register.bill_style' => $billing_style
          				);
           $result['studentList']=$this->commondatamodel->getAllRecordWhere("admission_register",$where);
         
			
			//pre($result['studentList']);exit;
            
    		
            $page = 'dashboard/intra_tournament_fees/intra_tournament_fees_copy_list_partial_view';
           
           
            $display = $this->load->view($page,$result,TRUE);
            echo $display;
        }
        else{
            redirect('login','refresh');
        }
    }



} // end of class