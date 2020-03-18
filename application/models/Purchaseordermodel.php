<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchaseordermodel extends CI_Model{


	public function getAllVendorList()
	{
		$where = array('vendor_master.is_active' => 'Y');
		$data = array();
		$this->db->select("*")
				 ->from('vendor_master')
				 ->where($where);
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


	public function getAllRawmeterialList()
	{
		$where = [];
		$data = array();
		$this->db->select("*")
				 ->from('raw_meterial_master')
				 ->where($where);
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


	public function getRawmeterialRate($rawmeterial_id,$vendor_id)
	{
		$data = array();
		$where = array(
						'raw_meterial_master.raw_meterial_id' => $rawmeterial_id,
						'supplier_id' => $vendor_id,
					   );
		$this->db->select("raw_meterial_rate.*,unit_master.item_unit_name,cgst.rate AS cgst_rate,sgst.rate AS sgst_rate")
				->from('raw_meterial_rate')
				->join('raw_meterial_master','raw_meterial_master.raw_meterial_id = raw_meterial_rate.rate_id','LEFT')
				->join('unit_master','unit_master.unit_id = raw_meterial_master.unit_id','LEFT')
			    ->join('gstmaster as cgst','cgst.id=raw_meterial_rate.cgst_id','left')
                ->join('gstmaster as sgst','sgst.id=raw_meterial_rate.sgst_id','left')
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



public function getPurchaseOrderList($from_dt,$to_dt)
    {
        $data = array();

                $this->db->select("purchase_master.*")
                ->from('purchase_master')
                ->where('DATE_FORMAT(`purchase_master`.`order_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`purchase_master`.`order_date`,"%Y-%m-%d") <= ', $to_dt)
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



public function getpurchaseDetailsBymasterId($purchase_mst_id)
	{
		$where = [];
		$data = array();
		$where = array('purchase_details.purchase_master_id' => $purchase_mst_id);
		$this->db->select("
							purchase_details.*,
							raw_meterial_master.name as raw_material,
							unit_master.item_unit_name,
							cgst.rate AS cgst_rate,sgst.rate AS sgst_rate
						")
				 ->from('purchase_details')
				 ->join('raw_meterial_master','raw_meterial_master.raw_meterial_id = purchase_details.raw_material_id','LEFT')
				 ->join('unit_master','unit_master.unit_id = raw_meterial_master.unit_id','LEFT')
				 ->join('gstmaster as cgst','cgst.id=purchase_details.cgst_id','left')
                 ->join('gstmaster as sgst','sgst.id=purchase_details.sgst_id','left')
				 ->where($where);
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








} // end of class