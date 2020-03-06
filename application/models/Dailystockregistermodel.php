<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dailystockregistermodel extends CI_Model{

    public function geAllStockRegister($compnyid,$yearid,$from_dt,$to_dt,$item_name)
    {
        $data = 0;
		$query = $this->db->query("CALL usp_GetBarStockInHand($compnyid,$yearid,'$from_dt','$to_dt',$item_name)");
        //$result = $query->result();;
		#echo $this->db->last_query();exit;

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = $rows->Stockinhand;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
    }

    public function getFiscalStartDt($yearid){
        $sql="SELECT start_date FROM financialyear WHERE financialyear.year_id=".$yearid;
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
                foreach ($query->result() as $rows) {
                    return $rows->start_date;
                }
         }
        
    }


}
