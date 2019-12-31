<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paymentmodemodel extends CI_Model{

	public function getallPaymentmodedtl()
  {
    $data = array();
    
    $this->db->select("account_master.account_name,payment_mode_details.*")
        ->from('payment_mode_details')
        ->join('account_master','payment_mode_details.account_id=account_master.account_id','INNER')
        ->order_by('payment_mode_details.payment_mode');
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