<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wastagemodel extends CI_Model{

	public function getAllRawmeteriaList()
	{
		$data = array();
		$where = [];
		$this->db->select("*")
				->from('raw_meterial_master')
				->join('unit_master','unit_master.unit_id=raw_meterial_master.unit_id','INNER')
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



public function getSerialNumber($company,$year,$module){
        $lastnumber = (int)(0);
        $tag = "";
        $noofpaddingdigit = (int)(0);
        $autoSaleNo="";
        $yeartag ="";
        $sql="SELECT
                id,
                SERIAL,
                moduleTag,
                lastnumber,
                noofpaddingdigit,
                module,
                companyid,
                yearid,
                yeartag
            FROM serialmaster
            WHERE companyid=".$company." AND yearid=".$year." AND module='".$module."' LOCK IN SHARE MODE";
        
                  $query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
        $row = $query->row(); 
        $lastnumber = $row->lastnumber;
                          $tag = $row->moduleTag;
                          $noofpaddingdigit = $row->noofpaddingdigit;
                          $yeartag = $row->yeartag;
                          
                          
      }

        $digit = (int)(log($lastnumber,10)+1) ;
        if($digit==4){
            $autoSaleNo = $tag."/0".$lastnumber."/".$yeartag;
        }else if($digit==3){
            $autoSaleNo = $tag."/00".$lastnumber."/".$yeartag;
        }else if($digit==2){
            $autoSaleNo = $tag."/000".$lastnumber."/".$yeartag;
        }elseif($digit==1){
            $autoSaleNo = $tag."/0000".$lastnumber."/".$yeartag;
        }else{
           $autoSaleNo = $tag."/".$lastnumber."/".$yeartag;
        }
        $lastnumber = $lastnumber + 1;
        
        //update
        $data = array(
        'serial' => $lastnumber,
        'lastnumber' => $lastnumber
        );
        $array = array('companyid' => $company, 'yearid' => $year, 'module' => $module);
        $this->db->where($array); 
        $this->db->update('serialmaster', $data);
        
        return $autoSaleNo;
        
    }



public function getWastageListData($from_dt,$to_dt)
    {
        $data = array();

                $this->db->select("
                					wastage_master.*,
                					
                				
                				 ")
                ->from('wastage_master')
                
                ->where('DATE_FORMAT(`wastage_master`.`transaction_dt`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`wastage_master`.`transaction_dt`,"%Y-%m-%d") <= ', $to_dt)
                ;
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



public function getAllWastageDetailsById($wastage_mst_id)
{
        $data = array();

        $where = array('wastage_details.wastage_mst_id' => $wastage_mst_id);

        $this->db->select("
                            wastage_details.*,
                            raw_meterial_master.name as rawmaterialname,
                            unit_master.item_unit_name
                         ")
                 ->from('wastage_details')
                 ->join('wastage_master','wastage_master.wastage_id = wastage_details.wastage_mst_id','INNER')
                 ->join('raw_meterial_master','raw_meterial_master.raw_meterial_id = wastage_details.raw_meterial_id','INNER')
                 ->join('unit_master','unit_master.unit_id = raw_meterial_master.unit_id','INNER')
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
	






} // end of class