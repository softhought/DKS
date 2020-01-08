<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Intratournamentmodel extends CI_Model{

	public function getAllTournamentFeesList()
  {
    $data = array();
    
    $this->db->select("
                        intra_tournament_fees.*,
                        admission_register.student_code,
                        admission_register.student_name
                       
                        ")
        ->from('intra_tournament_fees')
        ->join('admission_register','admission_register.admission_id=intra_tournament_fees.admission_id','INNER');
        //->join('month_master','month_master.id=intra_tournament_fees.month_id','LEFT')
       // ->join('quarter_month_master','quarter_month_master.id=intra_tournament_fees.quarter_id','LEFT');
       // ->order_by('gstmaster.gstDescription');
         $query = $this->db->get();
    #echo $this->db->last_query();

    if($query->num_rows()> 0)
    {
            foreach ($query->result() as $rows)
      {
        $data[] = $rows;
            }
            return $data;
             
        }
    else
    {
             return $data;
         }
  }






}// end of class