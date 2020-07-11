<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Memberfacilityratemodel extends CI_Model{


  public function getAllfacilityrate()
	{
		$data = array();
		$this->db->select("parameter_master.*,g1.gstDescription as cgstdes,g2.gstDescription as sgstdes")
				->from('parameter_master')
				->join('gstmaster as g1','parameter_master.cgst_id = g1.id ','LEFT')
				->join('gstmaster as g2','parameter_master.sgst_id = g2.id ','LEFT');

		$query = $this->db->get();
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