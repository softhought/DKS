<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Baritemopeningmodel extends CI_Model{


	public function getalllistbaritemopen()
	{
		$data = array();
		$this->db->select("bar_item_master.*,bar_item_unit_master.*,bar_item_opening.*,bar_item_sub_group_master.item_sub_group,bar_lequer_vol_master.lequer_vol")
                ->from('bar_item_master')
                ->join('bar_item_opening','bar_item_master.id = bar_item_opening.bar_item_master_id','INNER')
                ->join('bar_item_sub_group_master','bar_item_master.group_id = bar_item_sub_group_master.id','INNER')
                ->join('bar_lequer_vol_master','bar_item_master.liquer_vol_id = bar_lequer_vol_master.id','INNER')
                ->join('bar_item_unit_master','bar_item_master.unit_id = bar_item_unit_master.bar_unit_id','INNER')
				->order_by('bar_item_master.id','desc');
				
		$query = $this->db->get();
		#echo $this->db->last_query();exit;
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
	
	public function getbaritemsterdata($id)
	{
		$data = array();
		$where = array('bar_item_master.id'=>$id);

		$this->db->select("*")
                ->from('bar_item_master')
				->join('bar_item_opening','bar_item_master.id = bar_item_opening.bar_item_master_id','INNER')
				->where($where);             
				
	
		$query = $this->db->get();
		#echo $this->db->last_query();exit;
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
    }
    
}