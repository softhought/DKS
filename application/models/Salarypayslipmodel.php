<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salarypayslipmodel extends CI_Model{

    public function getsalaryregisterlist($month_id,$dept_id,$emp_id,$company,$year)
	{
		$data = array();
		if($month_id != ''){

            $wheremonth = array('salary_master.month_id'=>$month_id);
        }else{
            $wheremonth = [];
        }
        if($dept_id != ''){

            $wheredept = array('employee_master.dept_master_id'=>$dept_id);
        }else{
            $wheredept = [];
        }
        if($emp_id != ''){

            $whereempl = array('salary_master.employee_id'=>$emp_id);
        }else{
            $whereempl = [];
        }
        $where = array('salary_master.year_id'=>$year,'salary_master.company_id'=>$company);


        $this->db->select("salary_master.net_payable,employee_master.*,department_master.dept_name,month_master.short_name")
        		->from('salary_master')
                ->join('employee_master','salary_master.employee_id = employee_master.empl_id','INNER')
                ->join('department_master','employee_master.dept_master_id = department_master.dept_id','LEFT')
                ->join('month_master','salary_master.month_id = month_master.id','LEFT')
				->where($wheremonth)
				->where($wheredept)
                ->where($whereempl)
                ->where($where);
               			
		$query = $this->db->get();
		#q();
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