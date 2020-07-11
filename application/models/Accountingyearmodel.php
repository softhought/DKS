<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accountingyearmodel extends CI_Model{


	public function getlastAccountingyear()
	{
		$data = array();
		$this->db->select("*")
				->from('financialyear')
				->order_by('year_id','desc')
				->limit(1);
		$query = $this->db->get();
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


public function getallserialmasterdata()
	{
		$data = array();
		$this->db->select("moduleTag,noofpaddingdigit,module")
				->from('serialmaster')
				->group_by('module')
				->order_by('id');				
		$query = $this->db->get();
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