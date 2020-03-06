<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vendormodel extends CI_Model{


	public function getVendorDataByID($vendor_id)
	{
		$data = array();
		$where = array('vendor_master.vendor_id' => $vendor_id);
		$this->db->select("*")
				->from('vendor_master')
				->join('account_opening_master','account_opening_master.account_id=vendor_master.account_id','INNER')
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


public function checkExistanceVendoreName($vendor_id,$vendor_name)
	{
		
		$where = array('vendor_master.vendor_name' => $vendor_name );
		$this->db->select('*')
				->from('vendor_master')
				->where_not_in('vendor_id', $vendor_id)
				->where($where);
		$query = $this->db->get();
	   #echo $this->db->last_query();
		if($query->num_rows()>0){
			return 1;
		}
		else
		{
			return 0;
		}
		
	}



public function getAllVendorList()
	{
		$data = array();
		$this->db->select("*")
				->from('vendor_master')
				->join('account_opening_master','account_opening_master.account_id=vendor_master.account_id','INNER');
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







    
}  // end of class