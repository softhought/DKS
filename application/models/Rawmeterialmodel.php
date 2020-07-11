<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rawmeterialmodel extends CI_Model{


public function getAllRawMeterialList()
	{
		$data = array();
		$where = [];
		$this->db->select("
							raw_meterial_master.*,
							main_group_master.group_desc as main_group,
							unit_master.item_unit_name,
							store_item_group_master.group_name as item_group,
							material_type_inv.material_type as item_sub_group,
							raw_meterial_opening.open_balance

							")
				->from('raw_meterial_master')
				->join('main_group_master','main_group_master.id = raw_meterial_master.main_group_id','LEFT')
				->join('unit_master','unit_master.unit_id = raw_meterial_master.unit_id','LEFT')
				->join('store_item_group_master','store_item_group_master.main_group_id = raw_meterial_master.store_item_group','LEFT')
				->join('material_type_inv','material_type_inv.material_type_id = raw_meterial_master.material_type_id','LEFT')
				->join('raw_meterial_opening','raw_meterial_opening.raw_meterial_id = raw_meterial_master.raw_meterial_id','LEFT')
				->where($where);
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



public function getRawmeterialDataById($rawmeterial_id)
	{
		$data = array();
		$where = array('raw_meterial_master.raw_meterial_id' => $rawmeterial_id);
		$this->db->select("raw_meterial_master.*,raw_meterial_opening.open_balance")
				->from('raw_meterial_master')
				->join('raw_meterial_opening','raw_meterial_opening.raw_meterial_id = raw_meterial_master.raw_meterial_id','LEFT')
				->where($where)
				->limit(1);
		$query = $this->db->get();
		
		#echo "<br>".$this->db->last_query();
		
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