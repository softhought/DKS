<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Goodsreceiptnotemodel extends CI_Model{


public function getAllPurchaseorderNo()
{
		$data = array();
		$this->db->select("purchase_master.*,vendor_master.vendor_name")
				 ->from('purchase_master')
				 ->join('vendor_master','vendor_master.vendor_id=purchase_master.vendor_id','INNER');
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
				$grnDataQuantity=$this->getGrnDataByPurchaseOrderId($rows->purchase_master_id,$rows->purchase_dtl_id)->total_quantity;

				$remaining=$rows->item_quantity-$grnDataQuantity;

				if ($remaining!=0) {
				
				//$data[] = $rows;
				$data[] = array(
						 "purchase_dtl_id" => $rows->purchase_dtl_id,
						 "purchase_master_id" => $rows->purchase_master_id,
						 "raw_material_id" => $rows->raw_material_id,
						 "item_quantity" => $rows->item_quantity,
						 "remaining_quantity" => $remaining,
						 "item_rate" => $rows->item_rate,
						 "taxable_amt" => $rows->taxable_amt,
						 "cgst_id" => $rows->cgst_id,
						 "sgst_id" => $rows->sgst_id,
						 "cgst_amt" => $rows->cgst_amt,
						 "sgst_amt" => $rows->sgst_amt,
						 "net_amount" => $rows->net_amount,
						 "raw_material" => $rows->raw_material,
						 "item_unit_name" => $rows->item_unit_name,
						 "cgst_rate" => $rows->cgst_rate,
						 "sgst_rate" => $rows->sgst_rate,
					 );

				}
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


    public function getGrnDataByPurchaseOrderId($purches_order_master_id,$purcher_dtl_id)
	{
		$data = array();
		$where = array(
						
						'grn_details.purchase_order_dtl_id' => $purcher_dtl_id, 
						
					);
		$this->db->select("
							COALESCE(SUM(grn_details.quantity),0) AS total_quantity
  							",FALSE)
				->from('grn_details')
				->where($where)
				->limit(1);
		$query = $this->db->get();
		
		#echo $this->db->last_query();
		
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



public function getGrnListData($from_dt,$to_dt)
    {
        $data = array();

                $this->db->select("
                					grn_master.*,
                					purchase_master.order_no as purchase_order_no,
                					purchase_master.order_date as purchase_order_date,
                					vendor_master.vendor_name
                				 ")
                ->from('grn_master')
                ->join('purchase_master','purchase_master.purchase_id = grn_master.purchase_order_id','INNER')
                ->join('vendor_master','vendor_master.vendor_id = purchase_master.vendor_id','LEFT')
                ->where('DATE_FORMAT(`grn_master`.`grn_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`grn_master`.`grn_date`,"%Y-%m-%d") <= ', $to_dt)
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


public function getGrnMasterdata($grn_master_id)
	{
		$data = array();
		$where = array('grn_master.grn_id' => $grn_master_id);
		$this->db->select("grn_master.*,vendor_master.vendor_name,purchase_master.order_date")
				->from('grn_master')
				->join('purchase_master','purchase_master.purchase_id = grn_master.purchase_order_id','INNER')
                ->join('vendor_master','vendor_master.vendor_id = purchase_master.vendor_id','LEFT')
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


public function getAllRecordWhere($table,$where)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
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






	public function getGrnDetailsBymasterId($grn_master_id)
	{
		$where = [];
		$data = array();
		$where = array('grn_details.grn_master_id' => $grn_master_id);
		$this->db->select("
							grn_details.*,grn_master.*,
							raw_meterial_master.name as raw_material,
							unit_master.item_unit_name,
							cgst.rate AS cgst_rate,sgst.rate AS sgst_rate,
							purchase_details.item_quantity
						")
				 ->from('grn_details')
				 ->join('grn_master','grn_master.grn_id = grn_details.grn_master_id','INNER')
				 ->join('raw_meterial_master','raw_meterial_master.raw_meterial_id = grn_details.raw_material_id','INNER')
				 ->join('unit_master','unit_master.unit_id = raw_meterial_master.unit_id','INNER')
				 ->join('purchase_details','purchase_details.purchase_dtl_id = grn_details.purchase_order_dtl_id','INNER')
				 ->join('gstmaster as cgst','cgst.id=purchase_details.cgst_id','left')
                 ->join('gstmaster as sgst','sgst.id=purchase_details.sgst_id','left')
				 ->where($where);
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$grnDataQuantity=$this->getGrnActualRemainingQuantityById($rows->purchase_order_dtl_id,$rows->grn_dtl_id)->total_quantity;

				$remaining=$rows->item_quantity-$grnDataQuantity;

				//$remaining=0;
				
				//$data[] = $rows;
				$data[] = array(
						 "purchase_dtl_id" => $rows->purchase_order_dtl_id,
						 "purchase_master_id" => $rows->purchase_order_id,
						 "raw_material_id" => $rows->raw_material_id,
						 "item_quantity" => $rows->item_quantity,
						 "grn_quantity" => $rows->quantity,
						 "remaining_quantity" => $remaining,
						 "item_rate" => $rows->rate,
						 "raw_material" => $rows->raw_material,
						 "item_unit_name" => $rows->item_unit_name,
						 "cgst_rate" => $rows->cgst_rate,
						 "sgst_rate" => $rows->sgst_rate,
					 );

				
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


public function getGrnActualRemainingQuantityById($purcher_dtl_id,$grn_dtl_id)
	{
		$data = array();
		$where = array(
						
						'grn_details.purchase_order_dtl_id' => $purcher_dtl_id, 
						
					);


          $ignore = explode(' ', $grn_dtl_id);


		$this->db->select("
							COALESCE(SUM(grn_details.quantity),0) AS total_quantity
  							",FALSE)
				->from('grn_details')
				->where($where)
				->where_not_in('grn_details.`grn_dtl_id', $ignore)
				->limit(1);
		$query = $this->db->get();
		
		#echo $this->db->last_query();
		
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











} //end of class