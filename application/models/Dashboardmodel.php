<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboardmodel extends CI_Model{

public function checkdaterange($datedata,$year_id)
	{
		$data = array();
		
		$query = $this->db->select("*")
				->from('financialyear')
				->where('start_date <= "'.$datedata.'" and end_date >= "'.$datedata.'" and year_id = "'.$year_id.'"')
				
		        ->get();
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

    

}//end of class