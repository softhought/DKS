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




    public function getallemployeeAttendancelist($year,$month)
	{

		$where = array(
						'employee_attendance.month_id' => $month, 
						'employee_attendance.year_id' => $year, 
					);
		$data = array();
		$this->db->select("
							employee_attendance.*,
							employee_master.*,
							designation_master.designation_name,
							department_master.dept_name,
							month_master.month_name")
                ->from('employee_attendance')
                ->join('month_master','month_master.id = employee_attendance.month_id','LEFT')
                ->join('employee_master','employee_master.empl_id = employee_attendance.employee_id','LEFT')
                ->join('department_master','employee_master.dept_master_id = department_master.dept_id','LEFT')
                ->join('designation_master','employee_master.designation_id = designation_master.id','LEFT')
                ->where($where)
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