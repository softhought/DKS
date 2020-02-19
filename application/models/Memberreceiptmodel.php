<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class memberreceiptmodel extends CI_Model{


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



  public function getNewCodeSerial($startLetters,$category)
  {
    $data = array();
    $where = array('member_master.category' => $category);
    $this->db->select("SUBSTRING(member_code, 4) as last_serial")
        ->from('member_master')
        ->where("member_code LIKE '$startLetters%'")
        ->where($where)
        ->order_by('last_serial', 'desc')
        ->limit(1);
    $query = $this->db->get();
    
    #echo $this->db->last_query();
    
    if($query->num_rows()> 0)
    {
           $row = $query->row();
           return $data = $row;
             
        }
    else
    {
            return $data;
        }
  }




    
} // end of class