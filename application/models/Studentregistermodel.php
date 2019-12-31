<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Studentregistermodel extends CI_Model{

 public function getAllstudentcode()
	{
		$data = array();
		$this->db->select("student_code")
				->from('admission_register');
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