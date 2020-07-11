<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dailybalancemodel extends CI_Model{


public function getMemberListDataForDailyBalance()
	{
		$data = array();
		$ignore_status = array('TRANSFERRED','RESIGNED','TERMINATED');
		$this->db->select("
							member_master.member_id,
							member_master.member_code,
							member_master.title_one,
							member_master.member_name,
							member_master.status,
							member_master.elt_member
						")
				->from('member_master')
				->where("member_code NOT LIKE 'K%'")
				->where("member_code NOT LIKE 'S%'")
				->where("member_code NOT LIKE 'A%'")
				->where("member_code NOT LIKE 'D%'")
				->where("member_code NOT LIKE 'B%'")
				->where_not_in('member_master.status', $ignore_status)
				->where('member_master.elt_member !=' , 'Y')
				->order_by("member_master.member_id", "asc");
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



public function getMonthBillDataOpeningMonthlyData($member_id,$month,$year,$company)
	{
	    $data = array();


		$where = array(
						'member_monthly_opening.month_id' => $month,
						'member_monthly_opening.member_id' => $member_id,
						'member_monthly_opening.company_id' => $company,
						'member_monthly_opening.year_id' => $year
					   );
		$this->db->select("
							IFNULL(member_monthly_opening.open_bal,0) AS open_bal,
							member_monthly_opening.previous_month_bill_date
						")
				->from('member_monthly_opening')
				->where($where)
				->limit(1);
		$query = $this->db->get();


		#echo "<br>".$this->db->last_query();exit;
		
		
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



	public function getBotKotDataByCategory($member_id,$category,$start_date,$end_date)
	{
		$data = array();
		$where = array(
						'order_master.member_id' => $member_id,
						'order_master.category' => $category,
						
					  );
		$this->db->select("
							IFNULL(SUM(order_master.item_total),0) AS taxable_total,
							IFNULL(SUM(order_master.total_cgst),0) AS cgst_total,
							IFNULL(SUM(order_master.total_sgst),0) AS sgst_total  
						")
				->from('order_master')
				->where($where)
				->where('DATE_FORMAT(`order_master`.`order_date`,"%Y-%m-%d") >= ', $start_date)
       			->where('DATE_FORMAT(`order_master`.`order_date`,"%Y-%m-%d") <= ', $end_date)
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


	public function getMemberFacilityByCategory($member_id,$start_date,$end_date,$entry_module)
{
		$data = array();
		$where = array(
						'member_facility_transaction.member_id' => $member_id,
						'parameter_master.entry_module' => $entry_module,
						
					  );
		$this->db->select("
							IFNULL(SUM(member_facility_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(member_facility_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(member_facility_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('member_facility_transaction')
				->join('parameter_master','parameter_master.parameter_id=member_facility_transaction.parameter_mst_id','INNER')
				->where($where)
				->where('DATE_FORMAT(`member_facility_transaction`.`tran_dt`,"%Y-%m-%d") >= ', $start_date)
       			->where('DATE_FORMAT(`member_facility_transaction`.`tran_dt`,"%Y-%m-%d") <= ', $end_date)
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


public function getCorrectionAmount($member_id,$start_date,$end_date,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'member_correction_transaction.member_id' => $member_id,
						'member_correction_transaction.year_id' => $year_id,
						'member_correction_transaction.company_id' => $company_id,
						
					  );
		$this->db->select("
							IFNULL(SUM(member_correction_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(member_correction_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(member_correction_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('member_correction_transaction')
				->where($where)
				->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m-%d") >= ', $start_date)
       			->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m-%d") <= ', $end_date)
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

public function getMemberReceiptAmount($member_id,$start_date,$end_date,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'member_receipt.member_id' => $member_id,
						'member_receipt.year_id' => $year_id,
						'member_receipt.company_id' => $company_id,
						'member_receipt.tran_type' => 'RCFM',
						'DATE_FORMAT(member_receipt.receipt_date,"%Y-%m")' => $yearmonth
					  );
		$this->db->select("
							IFNULL(SUM(member_receipt.total_amount),0) AS taxable_total,
							0 AS cgst_total,
							0 AS sgst_total  
						 ")
				->from('member_receipt')
				->where($where)
				->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") >= ', $start_date)
       			->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") <= ', $end_date)
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



	public function getDailyBalanceList($member_id,$from_date,$to_date)
	{
		$data = array();

		if ($member_id!='') {
			$where = array('member_daily_balance.member_id' => $member_id);
		}else{
			$where=[];
		}
		
		$this->db->select("
							member_daily_balance.*,
							member_master.member_id,
							member_master.member_code,
							member_master.title_one,
							member_master.member_name,
							member_master.status,
							member_master.elt_member
							
							")
				->from('member_daily_balance')
				->join('member_master','member_master.member_id = member_daily_balance.member_id','INNER')
				->where($where)
				->where('DATE_FORMAT(`member_daily_balance`.`updatedate`,"%Y-%m-%d") >= ', $from_date)
       			->where('DATE_FORMAT(`member_daily_balance`.`updatedate`,"%Y-%m-%d") <= ', $to_date)
       			->order_by("member_daily_balance.member_id", "asc")
       			->order_by("member_daily_balance.updatedate", "asc")
				;
		$query = $this->db->get();
		
		#echo "<br>".$this->db->last_query();
		
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




} //end of class