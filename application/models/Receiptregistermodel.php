<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Receiptregistermodel extends CI_Model{


    public function getPaymentDetails($from_dt,$to_dt,$tran_type)
    {
        $data = array();

        if ($tran_type=='All') {
            $where_in = array('ORADM','ORITM','RCFS');
        }else{
            $where_in = explode(" ",$tran_type);
        }
        // $where_in = array('ORADM','ORITM','RCFS');
       
                $this->db->select("*")
                ->from('payment_master')
                ->join('admission_register','admission_register.admission_id = payment_master.admission_id','INNER')
                ->where('DATE_FORMAT(`payment_master`.`payment_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`payment_master`.`payment_date`,"%Y-%m-%d") <= ', $to_dt)
                ->where_in('transaction_type', $where_in);
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