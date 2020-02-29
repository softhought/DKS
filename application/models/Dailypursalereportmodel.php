<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dailypursalereportmodel extends CI_Model{

    public function getpurchasesalereport($from_dt,$to_dt,$table)
    {
        $data = array();
		$this->db->select("$table.*,bar_item_master.item_name,bar_lequer_vol_master.lequer_vol")
                ->from($table)
                ->join('bar_item_master',''.$table.'.item_master_id = bar_item_master.id','INNER')
                ->join('bar_lequer_vol_master',''.$table.'.liquer_vol_id = bar_lequer_vol_master.id','INNER')
                ->where(''.$table.'.tran_date >= "'.$from_dt.'" AND  '.$table.'.tran_date <= "'.$to_dt.'"')
                ->order_by(''.$table.'.tran_date','asc');
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
