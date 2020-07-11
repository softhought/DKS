<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rawmeterialratemodel extends CI_Model{

public function getGSTrate($companyId,$yearId,$type=NULL,$usedfor=NULL){
         $gstData=array();

        $sql="SELECT gstmaster.*
                FROM gstmaster WHERE
                gstmaster.gstType ='".$type."' AND gstmaster.usedfor='".$usedfor."'
                AND gstmaster.companyid=".$companyId;

         $query = $this->db->query($sql);
         if($query->num_rows()>0){
             foreach ($query->result() as $rows) {
               

                 $gstData[] = $rows;
             }
         }
        return $gstData;
         
     }


public function getAllRawMeterialrateList()
	{
		$data = array();
		$where = [];
		$this->db->select("
							raw_meterial_rate.*,
							unit_master.item_unit_name,
							vendor_master.vendor_name,
							raw_meterial_master.name as raw_meterial_name
							")
				->from('raw_meterial_rate')
				->join('raw_meterial_master','raw_meterial_master.raw_meterial_id = raw_meterial_rate.rawmeterial_id','LEFT')
				->join('unit_master','unit_master.unit_id = raw_meterial_master.unit_id','LEFT')
				->join('vendor_master','vendor_master.vendor_id = raw_meterial_rate.supplier_id','LEFT')
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


	public function getRawmeterialRateDataById($rawmeterialrate_id)
	{
		$data = array();
		$where = array('raw_meterial_rate.rate_id' => $rawmeterialrate_id);
		$this->db->select("raw_meterial_rate.*")
				->from('raw_meterial_rate')
				
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


	public function getAllRawmeterial()
	{
		$data = array();
		$where=[];
		$this->db->select("raw_meterial_master.*,unit_master.item_unit_name")
				->from('raw_meterial_master')
				->where($where)
				->join('unit_master','unit_master.unit_id = raw_meterial_master.unit_id','LEFT')
				->order_by("name", "asc");
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





} // end of class

