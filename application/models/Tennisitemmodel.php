<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tennisitemmodel extends CI_Model{


public function ActiveInactiveTennisitem($itemId,$is_active)
    {
        $where=[
            'item_id'=>$itemId
        ];
        $data=[
            'is_active'=>$is_active,
             ];
        try {
            $this->db->trans_begin();
            //$this->db->where($where);
			$this->db->update('tennis_item_master', $data,$where);
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