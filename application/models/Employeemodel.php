<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employeemodel extends CI_Model{


	public function getallemployeelist()
	{
		$data = array();
		$this->db->select("employee_master.*,designation_master.designation_name,department_master.dept_name")
                ->from('employee_master')
                ->join('department_master','employee_master.dept_master_id = department_master.dept_id','LEFT')
                ->join('designation_master','employee_master.designation_id = designation_master.id','LEFT')
				->order_by('empl_id','desc');
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