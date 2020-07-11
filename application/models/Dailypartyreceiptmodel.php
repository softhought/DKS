<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dailypartyreceiptmodel extends CI_Model{

    public function getPartyReceiptList($from_dt,$to_dt,$payment_id)
    {
        $data = array();

        $trn_type = array('PRTREC');
        if ($payment_id=='') {
            $where_payment = [];
        }else{
            $where_payment = array('member_receipt.dr_ac_id' => $payment_id ); 
        }
       
                $this->db->select("member_receipt.*,member_master.member_name,member_master.member_code")
                ->from('member_receipt')
                ->join('member_master','member_master.member_id = member_receipt.member_id','LEFT')
                ->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") <= ', $to_dt)
                ->where($where_payment)
                ->where_in('member_receipt.tran_type', $trn_type);//added by anil on 06-04-2020;
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