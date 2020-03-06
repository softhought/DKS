<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchaseentrymodel extends CI_Model{


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

   public function getpurchasentry()
	{
		$data = array();
		$this->db->select("id,tran_no,tran_date,sum(quantity) as total_quantity")
                ->from('purchase_entry_receive')
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

    
    public function getallpurchaseentry($wheredtl)
	{
		$data = array();
		$this->db->select("purchase_entry_receive.*,bar_lequer_vol_master.lequer_vol")
                ->from('purchase_entry_receive')
                ->join('bar_lequer_vol_master','purchase_entry_receive.liquer_vol_id = bar_lequer_vol_master.id','INNER')
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

    
    public function getstockdtl($item_id,$from_date,$to_dt)
	
	{
        $data = 0;
        $where = array('bar_item_master.id'=>$item_id);
		$this->db->select("SUM(purchase_entry_receive.quantity) + bar_item_opening.opening_bal_bot - SUM(sale_entry_issue.quantity) AS opbal")
                ->from('bar_item_master')
                ->join('bar_item_opening','bar_item_master.id = bar_item_opening.bar_item_master_id','INNER')
                ->join('purchase_entry_receive','bar_item_master.id = purchase_entry_receive.item_master_id','INNER')
                ->join('sale_entry_issue','bar_item_master.id = sale_entry_issue.item_master_id','INNER')                
                ->where($where)
                ->where('purchase_entry_receive.tran_date BETWEEN "'.$from_date.'" AND  "'.$to_dt.'"');		
        $query = $this->db->get();
       # echo $this->db->last_query();exit;
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = $rows->opbal;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
    }
}