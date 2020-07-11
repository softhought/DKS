<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salaryparametermodel extends CI_Model{

    public function getsalaryparameterlist()
    {
        $data = array();
		$this->db->select("salary_parameter_master.*,month_master.month_name")
                ->from('salary_parameter_master')
                ->join('month_master','month_master.id = salary_parameter_master.month_id','INNER')
                ->order_by('salary_parameter_master.id','desc');
		$query = $this->db->get();
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



}