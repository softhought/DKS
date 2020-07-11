<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salentryissusmodel extends CI_Model{


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
       if($digit==2){
           $autoSaleNo = $tag."/0".$lastnumber."/".$yeartag;
       }elseif($digit==1){
           $autoSaleNo = $tag."/00".$lastnumber."/".$yeartag;
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

   public function getallsaleissuentrylist()
	{
		$data = array();
		$this->db->select("id,tran_no,tran_date,sum(quantity) as total_quantity")
                ->from('sale_entry_issue')
				->group_by('tran_no','desc');
				
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

    
    public function getallsaleissuentry($wheredtl)
	{
		$data = array();
		$this->db->select("sale_entry_issue.*,bar_lequer_vol_master.lequer_vol")
                ->from('sale_entry_issue')
                ->join('bar_lequer_vol_master','sale_entry_issue.liquer_vol_id = bar_lequer_vol_master.id','INNER')
                ->where($wheredtl);			
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
}