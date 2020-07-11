<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fixedhardcourttimemodel extends CI_Model{


	public function getLastinsertid()
	{
		$lastid = 0;
		$this->db->select("*")
				->from('fixed_hard_court_timeslot')
				->order_by('time_slot_id','desc')
				->limit(1);
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$lastid = $rows->time_slot_id;
            }
            return $lastid;
             
        }
		else
		{
             return $lastid;
         }
	}




}