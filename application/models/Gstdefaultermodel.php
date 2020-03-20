<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gstdefaultermodel extends CI_Model{

public function getallmembercode()
    {
      $data = array();
      $this->db->select("*")
          ->from('member_master')
          ->where("status",'ACTIVE MEMBER')
          ->where("member_code NOT LIKE 'D%'")
          ->where("member_code NOT LIKE 'B%'")
          ->where("CAST(SUBSTRING(member_code,1,2) AS UNSIGNED) = 0 ")
          ->order_by('member_code', 'asc');
         
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


public function getAllActiveMemberByCategory($category){

        $data = array();
        $where = array(
        				'member_master.status' => 'ACTIVE MEMBER',
        				'member_master.category' => $category
        			   );

        $this->db->select("member_master.*")
                 ->from('member_master')
                 ->where("status",'ACTIVE MEMBER')
        		 ->where("member_code NOT LIKE 'D%'")
          		 ->where("member_code NOT LIKE 'B%'")
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



public function getBillingDefaulterList($member_id,$category,$month,$year,$company,$firstdate,$notice_date,$equal_above)
	{
		$data = array();

		if($member_id=='') {
            $where_member = [];
        }else{
            $where_member = array('member_master.member_id' => $member_id ); 
        }

        if($category=='') {
            $where_category = [];
        }else{
            $where_category = array(

            						'member_master.category' => $category
     					    ); 
        }
		
		$this->db->select("
							member_master.member_id,
							member_master.title_one,
							member_master.member_name,
							member_master.member_code,
							member_master.mobile,
							member_catogary_master.category_name,
							
						")
				->from('member_master')	
				->join('member_catogary_master','member_catogary_master.cat_id = member_master.category','INNER')
				->where("status",'ACTIVE MEMBER')
          		->where("member_code NOT LIKE 'D%'")
          		->where("member_code NOT LIKE 'B%'")
				->where($where_member)
				//->where($where_month)
				->where($where_category);
		$query = $this->db->get();
		
		#echo "<br>".$this->db->last_query();exit;
		
		if($query->num_rows()> 0)
        {
            foreach ($query->result() as $rows)
            {
            		$billAmount=0;$paidAmount=0;$correctionAmount=0;$dispatchdate=NULL;$outstanding=0;
            		//$billData=$this->getMemberBillMasterData($rows->member_id,$month,$year,$company);
            		$billData=$this->getMonthBillDataOpeningMonthlyData($rows->member_id,$month,$year,$company);
            		 if ($billData) {
                         $billAmount=$billData->open_bal;
                         if ($billData->previous_month_bill_date!='') {
                         	  $dispatchdate=date("d-M-Y", strtotime($billData->previous_month_bill_date));
                         }
                       
                         }

            		$PaidAmt=$this->getMemberReceiptAmount($rows->member_id,$year,$company,$firstdate,$notice_date);

            		if ($PaidAmt) { 
                         $paidAmount=$PaidAmt->taxable_total;
                    }

            		$CorrectionAmt=$this->getCorrectionAmount($rows->member_id,$year,$company,$firstdate,$notice_date);
            		if($CorrectionAmt) { 
                           $correctionAmount=$CorrectionAmt->total_amount;
                        }

                   $outstanding= $billAmount-$paidAmount+$correctionAmount ;   

               // $data[] = $rows;
            	 // $data[]=[
              //     "memberData"=>$rows,
              //     "billData"=>$this->getMemberBillMasterData($rows->member_id,$month,$year,$company),
              //     "PaidAmt"=>$this->getMemberReceiptAmount($rows->member_id,$year,$company,$firstdate,$notice_date),
              //     "CorrectionAmt"=>$this->getCorrectionAmount($rows->member_id,$year,$company,$firstdate,$notice_date)
              //     ];

                   if ($equal_above<=$outstanding) {
                  
		            		$data[]=[
		                  "memberData"=>$rows,
		                  "billAmount"=>$billAmount,
		                  "dispatchDate"=>$dispatchdate,
		                  "paidAmount"=>$paidAmount,
		                  "adjustmentAmount"=>$correctionAmount,
		                  "outstandingAmount"=>$outstanding,
		                  
		                  ];

                    }





            }
                return $data;
             
        }
        else
        {
                return $data;
        }


	}






	/* get member bill data */



public function getMemberBillMasterData($member_id,$month,$year,$company)
	{
	    $data = array();


		$where = array(
						'member_bill_master.bill_month' => $month,
						'member_bill_master.member_id' => $member_id,
						'member_bill_master.company_id' => $company,
						'member_bill_master.year_id' => $year
					   );
		$this->db->select("
							IFNULL(member_bill_master.net_amount,0) AS net_amount,
							member_bill_master.bill_date
						")
				->from('member_bill_master')
				->join('month_master','month_master.id = member_bill_master.bill_month','INNER')
				->where($where)
				->limit(1);
		$query = $this->db->get();
		// if ($member_id==1440) {
		// 	echo "<br>".$this->db->last_query();exit;
		// }

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


public function getMonthBillDataOpeningMonthlyData($member_id,$month,$year,$company)
	{
	    $data = array();

		    if ($month==3) {
		    	$year=$year+1;
		    }

		    if ($month==12) {
		    	$month=1;
		    }else{
		    	$month=$month+1;
		    }


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






public function getMemberReceiptAmount($member_id,$year_id,$company_id,$fromDt,$toDt)
{
		$data = array();
		$where = array(
						'member_receipt.member_id' => $member_id,
						'member_receipt.year_id' => $year_id,
						'member_receipt.company_id' => $company_id,
						'member_receipt.tran_type' => 'RCFM',
						
					  );
		$this->db->select("
							IFNULL(SUM(member_receipt.total_amount),0) AS taxable_total,
							0 AS cgst_total,
							0 AS sgst_total  
						 ")
				->from('member_receipt')
				->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") >= ', $fromDt)
                ->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") <= ', $toDt)
				->where($where)
				->limit(1);
		$query = $this->db->get();
		// if ($member_id==1441) {
		// 	echo "<br>".$this->db->last_query();
		// }
		
		
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



public function getCorrectionAmount($member_id,$year_id,$company_id,$fromDt,$toDt)
{
		$data = array();
		$where = array(
						'member_correction_transaction.member_id' => $member_id,
						'member_correction_transaction.year_id' => $year_id,
						'member_correction_transaction.company_id' => $company_id,
						
					  );
		$this->db->select("
							IFNULL(SUM(member_correction_transaction.total_amount),0) AS total_amount,
							IFNULL(SUM(member_correction_transaction.taxable),0) AS taxable_total,
							IFNULL(SUM(member_correction_transaction.cgst_amt),0) AS cgst_total,
							IFNULL(SUM(member_correction_transaction.sgst_amt),0) AS sgst_total  
						 ")
				->from('member_correction_transaction')
				->where($where)
				->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m-%d") >= ', $fromDt)
                ->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m-%d") <= ', $toDt)
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





public function getSelectedDefaulterListNotice($member_ids,$month,$year,$company,$firstdate,$notice_date,$equal_above)
	{
		$data = array();

		
		$this->db->select("
							member_master.member_id,
							member_master.title_one,
							member_master.member_name,
							member_master.member_code,
							member_master.address_one,
							member_master.address_two,
							member_master.address_three,
						")
				->from('member_master')	
				->where_in('member_id',$member_ids);

		$query = $this->db->get();
		
		#echo "<br>".$this->db->last_query();exit;
		
		if($query->num_rows()> 0)
        {
            foreach ($query->result() as $rows)
            {
            		$billAmount=0;$paidAmount=0;$correctionAmount=0;$dispatchdate=NULL;$outstanding=0;
            		$billData=$this->getMemberBillMasterData($rows->member_id,$month,$year,$company);
            		
            		 if ($billData) {
                         $billAmount=$billData->net_amount;
                         if ($billData->bill_date!='') {
                         	  $dispatchdate=date("M-Y", strtotime($billData->bill_date));
                         }
                       
                         }


		            if ($month=='12') {
		                $nextmonth=1;  
		            }else{
		            	$nextmonth=$month+1;  
		                if ($month=='3') {
		                	 $year=$year+1;
		                }
		            }
		            $billAmountNext='';$dispatchdateNext=NULL;
            	 
					$billDataNext=$this->getMemberBillMasterData($rows->member_id,$nextmonth,$year,$company);
					 if ($billDataNext) {
                         $billAmountNext=$billDataNext->net_amount;
                         if ($billDataNext->bill_date!='') {
                         	  $dispatchdateNext=date("M-Y", strtotime($billDataNext->bill_date));
                         }
                       
                         }

                         $dailyBalance = $this->getDailyBalanceByMemberId($rows->member_id)->daily_balance;
                  
		            		$data[]=[
		                  "memberData"=>$rows,
		                  "selMonthbillAmount"=>$billAmount,
		                  "selMonthdispatchDate"=>$dispatchdate,
		                  "nxtMonthbillAmount"=>$billAmountNext,
		                  "nxtMonthdispatchDate"=>$dispatchdateNext,
		                  "dailyBalance"=>$dailyBalance,
		               
		                 
		                  ];

                  





            }
                return $data;
             
        }
        else
        {
                return $data;
        }


	}



public function getDailyBalanceByMemberId($member_id)
	{
		$data = array();
		$where = array('member_master.member_id' => $member_id);
		$this->db->select("member_master.daily_balance")
				->from('member_master')
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