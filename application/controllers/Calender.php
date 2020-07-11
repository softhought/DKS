<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);        
        $this->load->model('partybookingmodel','partybookingmodel',TRUE);        
                             
        
    }
    public function index()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        {  
            $page = "dashboard/party/calender/calender_view";
            $header="";  
         
           //pre($result ['Allpartybookingcode']);exit; 
           $result['locationlist'] = $this->commondatamodel->getAllRecordOrderBy('party_location_master','location_name','asc');
            createbody_method($result, $page, $header, $session);
            
        }else{
            redirect('login','refresh');
        }
        
    }

    // public  function getbookingdata()
    // {
    //     $session = $this->session->userdata('user_detail');
    //     if($this->session->userdata('user_detail'))
    //     { 

           
    //             $json_response = $this->partybookingmodel->getallpartybookingforcalender($location);
          
          
    //         //pre($json_response);
    //         header('Content-Type: application/json');
    //         echo json_encode( $json_response );
    //         exit;
    //     }
    //     else{
    //         redirect('login','refresh');
    //     }
    // }
    public  function getbookingdata()
    {
        $session = $this->session->userdata('user_detail');
        if($this->session->userdata('user_detail'))
        { 
        
            $location = $this->input->post('location');                        
            //pre($location);exit;
            $json_response = $this->partybookingmodel->getallpartybookingforcalender($location);          
          
            //pre($json_response);
            //$json_response = array('response'=>$json_response);
            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
        }
        else{
            redirect('login','refresh');
        }
    }



}   