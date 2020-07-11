<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Studentoutstandingmodel extends CI_Model{

    
    public function getstudentoutstandinglist($billing_style,$QM,$yearid,$student_id)
    {
      $data = array();
    //   pre("'$billing_style'");
    //   pre($QM);
    //   pre($yearid);
    //   pre($student_id);
    //   exit;
      $a_procedure = "CALL usp_StudentOutstandingList (?,?,?,?)";
      $data = $this->db->query( $a_procedure, array($billing_style,$QM,$yearid,$student_id));
      
    //   $data = $this->db->query("CALL usp_StudentOutstandingList($billing_style,$QM,$yearid)");
      return $result = $data->result(); 
    //echo $this->db->last_query();exit;
    }

}