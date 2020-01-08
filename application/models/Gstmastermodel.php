<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Intratournamentmodel extends CI_Model{

	public function getallgstmasterdtl()
  {
    $data = array();
    
    $this->db->select("account_master.account_name,gstmaster.*")
        ->from('gstmaster')
        ->join('account_master','gstmaster.account_id=account_master.account_id','INNER')
        ->order_by('gstmaster.gstDescription');
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
}