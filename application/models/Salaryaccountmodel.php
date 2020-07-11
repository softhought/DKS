<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salaryaccountmodel extends CI_Model{


	public function getSalaryAccountlist()
	{
		$data = array();
		$this->db->select("salary_component_details.*,
						salary_component_master.component_name,
						department_master.dept_name,
						account_master.account_name,
						")
                ->from('salary_component_details')
                ->join('salary_component_master','salary_component_master.id = salary_component_details.compmonent_id','INNER')
                ->join('department_master','department_master.dept_id = salary_component_details.department_id','INNER')
                ->join('account_master','account_master.account_id = salary_component_details.account_id','INNER')
				;
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


} // end of class