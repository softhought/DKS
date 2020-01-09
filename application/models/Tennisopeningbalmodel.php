<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tennisopeningbalmodel extends CI_Model{

public function getAlltennisopeningmonthlist($billstyle,$month_id)
	{
		$data = array();

       $where = array('admission_register.bill_style'=>$billstyle);


		$query = $this->db->select("admission_register.admission_id,admission_register.bill_style,admission_register.student_code as studcode,admission_register.title_one,admission_register.student_name,tennis_student_opening.*")
				->from('admission_register')
				->join('tennis_student_opening','tennis_student_opening.student_id = admission_register.admission_id and tennis_student_opening.month_id = '.$month_id.'','LEFT')
				->where($where)
				->where('admission_register.status <> ','RESIGNED')
		        ->get();
		  #echo $this->db->last_query();exit;      
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


	public function getAlltennisopeningqauterlist($billstyle,$quter_id)
	{
		$data = array();

       $where = array('admission_register.bill_style'=>$billstyle);


		$query = $this->db->select("admission_register.admission_id,admission_register.bill_style,admission_register.student_code as studcode,admission_register.title_one,admission_register.student_name,tennis_student_opening.*")
				->from('admission_register')
				->join('tennis_student_opening','tennis_student_opening.student_id = admission_register.admission_id and tennis_student_opening.quarter_id = '.$quter_id.'','LEFT')
				->where($where)
				->where('admission_register.status <> ','RESIGNED')
		        ->get();
		  #echo $this->db->last_query();exit;      
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