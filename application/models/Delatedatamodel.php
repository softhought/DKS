<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Delatedatamodel extends CI_Model{



    public function getTennisReceipt()
    {
        $data = array();
		$this->db->select("payment_master_delete.*,users.*,admission_register.student_name,admission_register.student_code")
                ->from('payment_master_delete')
                ->join('admission_register','admission_register.admission_id = payment_master_delete.admission_id','INNER')
                ->join('users','users.id = payment_master_delete.user_id','INNER')
                ->order_by('payment_master_delete.payment_id','asc');
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

    public function getMemberReceipt()
    {
        $data = array();
        $this->db->select("member_receipt_delete.*,users.*,member_master.member_name,member_master.member_code")
                ->from('member_receipt_delete')
                ->join('member_master','member_master.member_id = member_receipt_delete.member_id','LEFT')
                ->join('users','users.id = member_receipt_delete.deluser_id','INNER')
                ->order_by('member_receipt_delete.receipt_id','asc');
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








} // end of class