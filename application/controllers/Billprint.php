<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Billprint extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->library('session');   

        $this->load->library('jasperphp');

        $this->load->model('Billgeneratetennismodel','billgenmodel',TRUE);
        $this->load->model('companymodel', '', TRUE); 

    }





    public function index()

    {

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

            $page = "dashboard/reports/bill-print";

            $header="";    

            createbody_method($result, $page, $header, $session);

        }else{

            redirect('login','refresh');

        }

    }



    // public function billPrintPdf()

    // {

    //     $session = $this->session->userdata('user_detail');

    //     if($this->session->userdata('user_detail'))

    //     {            

           

    //         $companyId = $session['companyid'];

    //         $yearid = $session['yearid'];



    //         $where = array('company_master.company_id' => $companyId);

    //         $company = $this->commondatamodel->getSingleRowByWhereCls('company_master',$where);  

    //         $billing_style = $this->input->post('billing_style');

    //         if($billing_style=='M')
    //         {
    //             $QM =$this->input->post('month');
    //         }else if($billing_style=='Q'){
    //             $QM =$this->input->post('quarter_month');
    //         } 
           
    //         $student_id = $this->input->post('student_id');
          
    //         // pre($billing_style);
    //         // pre($QM);
    //         //pre($student_id);exit;
    //         $file2= APPPATH."views/dashboard/reports/JasperReports/";
    //        $arrayParameter=[

    //             'BillingStyle'=>"'".$billing_style."'",

    //             'QuarterMonth'=>$QM,

    //             'StudentId'=>'"'.implode(',',$student_id).'"',

    //             'YearId'=>$yearid ,

    //             'CompanyName'=>strtoupper($company->full_name),

    //             'CompanyAddress'=>$company->address,

    //             'CompanyPhone'=>$company->phone,

    //             'ofc_time'=>$company->ofc_time,
    //             'SUBREPORT_DIR'=>$file2

    //         ];

    //            //pre($arrayParameter);exit;



    //         $file= APPPATH."views/dashboard/reports/JasperReports/BillPrint.jrxml";
           

            

    //         $jasperphp = $this->jasperphp->jasper();

           

    //         $dbdriver="mysql";

           

    //         $this->load->database();

    //         $server=$this->db->hostname;

    //         $user=$this->db->username;

    //         $pass=$this->db->password;

    //         $db=$this->db->database;

                           

    //         $dateRange='('.$fromdate.' To '.$todate.')';

    //         $printDate=date("d-m-Y");

    //         $Date=date("Ymd_His");



    //         // $jasperphp->debugsql=true;

    //         $jasperphp->arrayParameter =  $arrayParameter;

    //         $jasperphp->load_xml_file($file); 

    //         $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);

    //         $jasperphp->outpage('I','BillPrint-'.$Date.'.pdf');   

    //         // pre($jasperphp);     

            

    //     }else{

    //         redirect('login','refresh');

    //     }

    // }

    public function billPrintPdf()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {      
            $file= APPPATH."views/dashboard/reports/JasperReports/BillPrint.jrxml";
            $subreportfile= APPPATH."views/dashboard/reports/JasperReports/";
           
            $this->load->library('jasperphp');
            $jasperphp = $this->jasperphp->jasper();

            $dbdriver="mysql";
            // $server="localhost";
            // $db="teasamrat";
            // $user="root";
            // $pass="";
            
            $this->load->database();
            $server=$this->db->hostname;
            $user=$this->db->username;
            $pass=$this->db->password;
            $db=$this->db->database;
           
            $companyId = $session['companyid'];

            $student_id = $this->input->post('student_id');
           
            $yearid = $session['yearid'];
            $billing_style = $this->input->post('billing_style');
          
           if($billing_style=='M')
            {
                 $QM =$this->input->post('month');
            }else if($billing_style=='Q'){
                 $QM =$this->input->post('quarter_month');
            }
         
            //$memberid = 54;  
           
             $company=  $this->companymodel->getCompanyNameById($companyId);
             $companylocation=  $this->companymodel->getCompanyAddressById($companyId);

            
             $companydetail = $this->companymodel->getCompanyById($companyId); 
             $comanyphone =   $companydetail->phone;
             $ofc_time = $companydetail->ofc_time;
             $studIDs = implode(',',$student_id);
             
            if($billing_style=='M')
            {
        $qurtermonthsql = 'SELECT bill_master_tennis.*,DATE_FORMAT(bill_master_tennis.`billing_date`,"%d/%m/%Y") AS billingDate,
            DATE_FORMAT( LAST_DAY(bill_master_tennis.`billing_date`),"%d/%m/%Y") AS lastDay, month_master.`month_name` AS month_quarter,
            financialyear.*,CONCAT(admission_register.`title_one`," ",admission_register.`student_name`) AS student_name,
            admission_register.`student_code`,admission_register.`address_one`,admission_register.`address_two`,admission_register.`address_three` 
          FROM
            bill_master_tennis 
            INNER JOIN admission_register 
              ON bill_master_tennis.`student_id` = admission_register.`admission_id` 
            INNER JOIN month_master 
              ON month_master.`id` = bill_master_tennis.`month_id` 
            INNER JOIN financialyear 
              ON bill_master_tennis.`year_id` = financialyear.`year_id` 
          WHERE bill_master_tennis.`year_id` = '.$yearid.'
            AND bill_master_tennis.`month_id` = '.$QM.'
            AND bill_master_tennis.`student_id` IN('.$studIDs.')';

          
            
            }else{

             $qurtermonthsql = 'SELECT  bill_master_tennis.*,DATE_FORMAT(bill_master_tennis.`billing_date`,"%d/%m/%Y") AS billingDate,
             DATE_FORMAT(LAST_DAY(bill_master_tennis.`billing_date`),"%d/%m/%Y") AS lastDay,quarter_month_master.`quarter` AS month_quarter,financialyear.*, CONCAT(admission_register.`title_one`," ",admission_register.`student_name`) AS   student_name,admission_register.`student_code`,admission_register.`address_one`,admission_register.`address_two`,
             admission_register.`address_three` 
           FROM
             bill_master_tennis 
             INNER JOIN admission_register 
               ON bill_master_tennis.`student_id` = admission_register.`admission_id` 
             INNER JOIN quarter_month_master 
               ON bill_master_tennis.`quarter_id` = quarter_month_master.`id` 
             INNER JOIN financialyear 
               ON bill_master_tennis.`year_id` = financialyear.`year_id` 
           WHERE bill_master_tennis.`year_id` = '.$yearid.'
             AND bill_master_tennis.quarter_id = '.$QM.'
             AND bill_master_tennis.student_id IN('.$studIDs.')';

          
          }

        //  echo $prequrtermonthsql;
        //  echo "<br>";
        //  echo $qurtermonthsql;
        //  exit;


            
            $printDate=date("d-m-Y");            
             //$jasperphp->debugsql=true;
            

            $jasperphp->arrayParameter = array( 'BillingStyle'=>"'".$billing_style."'",
                        'QuarterMonth'=>$QM,        
                        'StudentId'=>'"'.implode(',',$student_id).'"',        
                        'YearId'=>$yearid ,        
                        'CompanyName'=>strtoupper($company),        
                        'CompanyAddress'=>$companylocation,        
                        'CompanyPhone'=>$comanyphone,        
                        'ofc_time'=>$ofc_time,
                        'SUBREPORT_DIR'=>$subreportfile,"sql" =>$qurtermonthsql);

            //pre($jasperphp->arrayParameter);exit;
            $jasperphp->load_xml_file($file); 
            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);
            $jasperphp->outpage('I','Bill Details-'.date('d_m_Y-His'));  
            // pre($jasperphp);     
    

            // $page = 'trial_balance/trailWithJasper.php';
            // $this->load->view($page, $result, TRUE);

        } else {
            redirect('login', 'refresh');
        }
    }


   


    public function getStudentList()

  {

      if($this->session->userdata('user_detail'))

      {

        

       $billing_style = $this->input->post('billing_style');     

       $result['studentList'] = $this->billgenmodel->studentListbyBillStyle($billing_style);



        ?>

           <select data-live-search="true" data-actions-box="true" class="form-control selectpicker" name="student_id" multiple id="student_id" >

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





  public function test()

    {

        $session = $this->session->userdata('user_detail');

        if($this->session->userdata('user_detail'))

        {            

           

        //     $companyId = $session['companyid'];

        //     $yearid = $session['yearid'];



        //     $where = array('company_master.company_id' => $companyId);

        //     $company = $this->commondatamodel->getSingleRowByWhereCls('company_master',$where);  

        //    $arrayParameter=[

        //         'BillingStyle'=>"'".$this->uri->segment(3)."'",

        //         'QuarterMonth'=>$this->uri->segment(4),

        //         'StudentId'=>'"'.urldecode($this->uri->segment(5)).'"',

        //         'YearId'=>$yearid ,

        //         'CompanyName'=>strtoupper($company->full_name),

        //         'CompanyAddress'=>$company->address,

        //         'CompanyPhone'=>$company->phone,

        //         'ofc_time'=>$company->ofc_time

        //     ];

            //    pre($arrayParameter);exit;



            $file= APPPATH."views/dashboard/reports/JasperReports/General Ledger.jrxml";

            

            $jasperphp = $this->jasperphp->jasper();

           

            $dbdriver="mysql";

            // $server="localhost";

            // $db="dks";

            // $user="root";

            // $pass="";

            

            $this->load->database();

            $server=$this->db->hostname;

            $user=$this->db->username;

            $pass=$this->db->password;

            $db=$this->db->database;

                           

            $dateRange='('.$fromdate.' To '.$todate.')';

            $printDate=date("d-m-Y");

            $Date=date("Ymd_His");



            // $jasperphp->debugsql=true;

            $jasperphp->arrayParameter =  $arrayParameter;

            $jasperphp->load_xml_file($file); 

            $jasperphp->transferDBtoArray($server,$user,$pass,$db,$dbdriver);

            $jasperphp->outpage('I','BillPrint-'.$Date.'.pdf');   

            // pre($jasperphp);     

               

        }else{

            redirect('login','refresh');

        }

    }



}// end of class





