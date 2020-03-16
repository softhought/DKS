<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accountmastermodel extends CI_Model{

public function ActiveInactiveAccountMaster($accId,$is_active)
    {
        $where=[
            'account_id'=>$accId
        ];
        $data=[
            'is_active'=>$is_active,
             ];
        try {
            $this->db->trans_begin();
            //$this->db->where($where);
			$this->db->update('account_master', $data,$where);
			$this->db->last_query();
			
            //$affectedRow = $this->db->affected_rows();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
                return FALSE;
            } else {
                $this->db->trans_commit();
                
                return TRUE;
            }
        } catch (Exception $exc) {
             return FALSE;
        }
    }

    public function getallacountmasterdtl()
    {
        $data = array();
		$this->db->select("account_master.*,group_master.group_description,vendor_master.vendor_id")
                ->from('account_master')
                ->join('group_master','account_master.group_id = group_master.id','INNER')
                ->join('vendor_master','account_master.account_id = vendor_master.account_id','LEFT')
                ->order_by('account_id','desc');
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