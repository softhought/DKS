<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Memberbillmodel extends CI_Model{



 public function getAllActiveMembercode($category,$member_id){

        $data = array();

        $where = array('member_master.status' => 'ACTIVE MEMBER' );

        if ($category!='') {

        		if($member_id!=''){
        			$where2 = array('member_master.member_id' => $member_id );

        		}else{
        			$where2 = array('member_master.category' => $category );
        		}
        }else{
        	 $where2=[];
        }


        $this->db->select("
        					member_master.member_id,
        					member_master.member_code
        				 ")
                 ->from('member_master')
                 ->where($where)
                 ->where($where2)
                 ->order_by("member_code");
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


public function getAllActiveMemberByCategory($category){

        $data = array();
        $where = array(
        				'member_master.status' => 'ACTIVE MEMBER',
        				'member_master.category' => $category
        			   );

        $this->db->select("member_master.*")
                 ->from('member_master')
                 ->where($where)
                 ->order_by("member_code");
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



public function getBotKotDataByCategory($member_id,$category,$yearmonth)
	{
		$data = array();
		$where = array(
						'order_master.member_id' => $member_id,
						'order_master.category' => $category,
						'DATE_FORMAT(order_master.order_date,"%Y-%m")' => $yearmonth
					  );
		$this->db->select("
							IFNULL(SUM(order_master.item_total),0) AS taxable_total,
							IFNULL(SUM(order_master.total_cgst),0) AS cgst_total,
							IFNULL(SUM(order_master.total_sgst),0) AS sgst_total  
						")
				->from('order_master')
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


public function getMemberFacilityByCategory($member_id,$yearmonth,$entry_module)
{
		$data = array();
		$where = array(
						'member_facility_transaction.member_id' => $member_id,
						'parameter_master.entry_module' => $entry_module,
						'DATE_FORMAT(member_facility_transaction.tran_dt,"%Y-%m")' => $yearmonth
					  );
		$this->db->select("
							IFNULL(SUM(member_facility_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(member_facility_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(member_facility_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('member_facility_transaction')
				->join('parameter_master','parameter_master.parameter_id=member_facility_transaction.parameter_mst_id','INNER')
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


public function getMemberBenvolentFund($member_id,$month_id,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'benvolent_fund_transaction.member_id' => $member_id,
						'benvolent_fund_transaction.month_id' => $month_id,
						'benvolent_fund_transaction.year_id' => $year_id,
						'benvolent_fund_transaction.company_id' => $company_id,
						'benvolent_fund_transaction.is_delete' => "N"
						
					  );
		$this->db->select("
							IFNULL(SUM(benvolent_fund_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(benvolent_fund_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(benvolent_fund_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('benvolent_fund_transaction')
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


public function getMemberFixedHardCourt($member_id,$yearmonth,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'fixed_hard_court_transaction.member_id' => $member_id,
						'fixed_hard_court_transaction.year_id' => $year_id,
						'fixed_hard_court_transaction.company_id' => $company_id,
						
						'DATE_FORMAT(fixed_hard_court_transaction.tran_dt,"%Y-%m")' => $yearmonth
					  );
		$this->db->select("
							IFNULL(SUM(fixed_hard_court_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(fixed_hard_court_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(fixed_hard_court_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('fixed_hard_court_transaction')
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


public function getDevelopmentFees($member_id,$month_id,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'development_fees_transaction.member_id' => $member_id,
						'development_fees_transaction.month_id' => $month_id,
						'development_fees_transaction.year_id' => $year_id,
						'development_fees_transaction.company_id' => $company_id,
						'development_fees_transaction.is_delete' => "N"
					  );
		$this->db->select("
							IFNULL(SUM(development_fees_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(development_fees_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(development_fees_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('development_fees_transaction')
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


public function getPujaContribution($member_id,$month_id,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'puja_contribution.member_id' => $member_id,
						'puja_contribution.month_id' => $month_id,
						'puja_contribution.year_id' => $year_id,
						'puja_contribution.company_id' => $company_id
						
					  );
		$this->db->select("
							IFNULL(SUM(puja_contribution.total_amount),0) AS taxable_total,
							0 AS cgst_total,
							0 AS sgst_total  
						 ")
				->from('puja_contribution')
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


public function getCorrectionAmount($member_id,$yearmonth,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'member_correction_transaction.member_id' => $member_id,
						'member_correction_transaction.year_id' => $year_id,
						'member_correction_transaction.company_id' => $company_id,
						'DATE_FORMAT(member_correction_transaction.tran_date,"%Y-%m")' => $yearmonth
					  );
		$this->db->select("
							IFNULL(SUM(member_correction_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(member_correction_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(member_correction_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('member_correction_transaction')
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



public function getMemberReceiptAmount($member_id,$yearmonth,$year_id,$company_id)
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


public function checkNextYearExist($year_id)
{
		$data = array();
		$this->db->select("*")
				->from('financialyear')
				->where('year_id >', $year_id)
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


public function getMinimumBillingAmount($member_id,$month_id,$year_id,$company_id)
	{
		$data = array();

		        $where = array(
                                'club_usages.member_id' => $member_id,
                                'club_usages.month_id' => $month_id,
                                'club_usages.year_id' => $year_id,
                                'club_usages.company_id' => $company_id,
                             );



		$this->db->select("
							IFNULL(SUM(club_usages.short_fall),0) AS short_fall,
							IFNULL(SUM(club_usages.cgst_amt),0) AS cgst_amt,
							IFNULL(SUM(club_usages.sgst_amt),0) AS sgst_amt,
							")
				->from('club_usages')
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



public function getMemberBillMasterData($member_id,$category,$month,$year,$company)
	{
		$data = array();

		if($member_id=='') {
            $where_member = [];
        }else{
            $where_member = array('member_bill_master.member_id' => $member_id ); 
        }

        if($category=='') {
            $where_category = [];
        }else{
            $where_category = array(

            						'member_master.category' => $category
     					    ); 
        }

        if($month=='') {
            $where_month = [];
        }else{
            $where_month = array(
            						'member_bill_master.bill_month' => $month
     					        ); 
        }


		$where = array(
						'member_bill_master.year_id' => $year,
						'member_bill_master.company_id' => $company,
					   );
		$this->db->select("
							member_bill_master.*,
							member_master.title_one,
							member_master.member_name,
							member_master.member_code,
							member_catogary_master.category_name,
							month_master.month_name
						")
				->from('member_bill_master')
				->join('member_master','member_master.member_id = member_bill_master.member_id','INNER')
				->join('month_master','month_master.id = member_bill_master.bill_month','INNER')
				->join('member_catogary_master','member_catogary_master.cat_id = member_master.category','INNER')
				->where($where)
				->where($where_member)
				->where($where_month)
				->where($where_category);
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


public function getBillMasterDataByBillId($bill_id)
	{
		$data = array();

		$where = array(
						'member_bill_master.bill_id' => $bill_id
					   );

		$this->db->select("member_bill_master.*,
							member_master.title_one,
							member_master.member_name,
							member_master.member_code,
							member_catogary_master.category_name,
							month_master.month_name,
							month_master.short_name,
							")
				->from('member_bill_master')
				->join('member_master','member_master.member_id = member_bill_master.member_id','INNER')
				->join('month_master','month_master.id = member_bill_master.bill_month','INNER')
				->join('member_catogary_master','member_catogary_master.cat_id = member_master.category','INNER')
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










} // end of class