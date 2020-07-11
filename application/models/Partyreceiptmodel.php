<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partyreceiptmodel extends CI_Model{


	public function getActobecredited()
	{
		$data = array();
		$where = array('party_accounting.tag' =>'Cr');
		$this->db->select("party_accounting.*,account_master.account_name")
				->from('party_accounting')
				->join('account_master','account_master.account_id = party_accounting.account_id','INNER')
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



	public function getPartyBookingmembere($company,$year)
	{
		$data = array();
		$where = array(
						'party_booking_master.is_cancel' => 'N', 
						'party_booking_master.year_id' => $year, 
						'party_booking_master.company_id' => $company, 
						);
		$this->db->select("
							party_booking_master.*,
							member_master.member_code,
							member_master.title_one,
							member_master.member_name,
							member_master.member_id,
							")
				->from('party_booking_master')
				->join('member_master','member_master.member_id = party_booking_master.member_master_id','INNER')
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


public function getPartyBookingDetails($member_master_id)
	{
		$data = array();
		$where = array('party_booking_master.member_master_id' => $member_master_id);
		$this->db->select("party_booking_master.*,party_location_master.location_name")
				->from('party_booking_master')
				->join('party_location_master','party_location_master.id = party_booking_master.party_location_id','LEFT')
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


  public function getPartyReceiptData($party_master_id)
  {
    $data = array();

     $where = [
                    'member_receipt.receipt_id' => $party_master_id
                ];


    $this->db->select("member_receipt.*,member_master.title_one,member_master.member_name,member_master.member_code")
        ->from('member_receipt')
        ->join('member_master','member_master.member_id = member_receipt.member_id','INNER')
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


    public function getPartyrReceiptList($from_dt,$to_dt,$member_id)
    {
        $data = array();


        if ($member_id=='All') {
            $where_member = array('member_receipt.tran_type' => 'PRTREC'); 
        }else{
            $where_member = array(
            						'member_receipt.member_id' => $member_id, 
            						'member_receipt.tran_type' => 'PRTREC'
            						); 
        }
       
                $this->db->select("member_receipt.*,member_master.member_name,member_master.member_code")
                ->from('member_receipt')
                ->join('member_master','member_master.member_id = member_receipt.member_id','INNER')
                ->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") <= ', $to_dt)
                ->where($where_member);
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

    public function partybookingmembercode()
    {
        $data = array();
        $this->db->select(" `member_master`.*,party_bill_master.`party_bill_no`")
                ->from('member_master')
                ->join('party_booking_master','party_booking_master.member_master_id = member_master.member_id','INNER')
                ->join('party_bill_master','party_booking_master.`member_master_id` = party_bill_master.`member_id`','LEFT')
                ->where('party_bill_master.`party_bill_no` IS NULL')
                ->where('party_booking_master.is_cancel','N');
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




