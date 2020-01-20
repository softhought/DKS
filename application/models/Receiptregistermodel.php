<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Receiptregistermodel extends CI_Model{

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



}