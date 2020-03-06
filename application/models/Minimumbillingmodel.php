<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Minimumbillingmodel extends CI_Model{

 public function getAllActiveMembercode(){

        $data = array();

        $where = array('member_master.status' => 'ACTIVE MEMBER' );

        $this->db->select("
                            member_master.member_id,
        					member_master.member_code,
        					member_master.min_ceiling,
        				 ")
                 ->from('member_master')
                 ->where($where)
                 ->order_by("member_id");
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


public function getMemberQuarterlyConsumption($member_id,$startyearmonth,$endyearmonth)
{
		$data = array();
		$where = array(
						'member_bill_master.member_id' => $member_id,
					  );
		$this->db->select("
						   IFNULL(SUM(member_bill_master.bar_amount),0) AS tot_bar_amount,
						   IFNULL(SUM(member_bill_master.cat_amount),0) AS tot_cat_amount,
						   IFNULL(SUM(member_bill_master.swimming),0) AS tot_swimming,
						   IFNULL(SUM(member_bill_master.gym),0) AS tot_gym,
						   IFNULL(SUM(member_bill_master.locker_charge),0) AS tot_locker_charge,
						   IFNULL(SUM(member_bill_master.hard_court_extra),0) AS tot_hard_court_extra,
						   IFNULL(SUM(member_bill_master.guest_charge),0) AS tot_guest_charge,
						   IFNULL(SUM(member_bill_master.towel_charge),0) AS tot_towel_charge,
						   IFNULL(SUM(member_bill_master.ben_fund),0) AS tot_ben_fund,
						   IFNULL(SUM(member_bill_master.fixed_hard),0) AS tot_fixed_hard,
						   IFNULL(SUM(member_bill_master.card_play),0) AS tot_card_play,
						   IFNULL(SUM(member_bill_master.development_charge),0) AS tot_development_charge,
						   IFNULL(SUM(member_bill_master.puja_contribution),0) AS tot_puja_contribution,

						   IFNULL(SUM(member_bill_master.bar_cgst),0) AS tot_bar_cgst,
						   IFNULL(SUM(member_bill_master.bar_sgst),0) AS tot_bar_sgst,
						   IFNULL(SUM(member_bill_master.cat_cgst),0) AS tot_cat_cgst,
						   IFNULL(SUM(member_bill_master.cat_sgst),0) AS tot_cat_sgst,
						   IFNULL(SUM(member_bill_master.outgoing_cgst),0) AS tot_outgoing_cgst,
						   IFNULL(SUM(member_bill_master.outgoing_sgst),0) AS tot_outgoing_sgst,
						 ")
				->from('member_bill_master')
				->where($where)
				->where('DATE_FORMAT(`member_bill_master`.`bill_date`,"%Y-%m") >= ', $startyearmonth)
                ->where('DATE_FORMAT(`member_bill_master`.`bill_date`,"%Y-%m") <= ', $endyearmonth)
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



    public function getFacilityDataByEntryModule($entry_module)
    {
        $data = array();
        $where = array('parameter_master.entry_module' => $entry_module);
        $this->db->select("parameter_master.*,cgst.rate AS cgst_rate,sgst.rate AS sgst_rate")
                ->from('parameter_master')
                ->join('gstmaster as cgst','cgst.id=parameter_master.cgst_id','left')
                ->join('gstmaster as sgst','sgst.id=parameter_master.sgst_id','left')
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


public function getCorrectionAmount($member_id,$startyearmonth,$endyearmonth,$year_id,$company_id)
{
        $data = array();
        $where = array(
                        'member_correction_transaction.member_id' => $member_id,
                        'member_correction_transaction.year_id' => $year_id,
                        'member_correction_transaction.company_id' => $company_id,
                        'member_correction_description_master.is_min_billing' => 'Y'
                      );
        $this->db->select("
                            IFNULL(SUM(member_correction_transaction.taxable),0) AS taxable_total,
                            IFNULL(SUM(member_correction_transaction.cgst_amt),0) AS cgst_total,
                            IFNULL(SUM(member_correction_transaction.sgst_amt),0) AS sgst_total  
                         ")
                ->from('member_correction_transaction')
                ->join('member_correction_description_master','member_correction_description_master.id=member_correction_transaction.mem_cor_id','INNER')
                ->where($where)
                ->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m") >= ', $startyearmonth)
                ->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m") <= ', $endyearmonth)
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


public function getMemberGymSwimmingKotConsumption($member_id,$startyearmonth,$endyearmonth)
{
        $data = array();
        $where = array(
                        'gym_swimming_kot.member_id' => $member_id,
                      );
        $this->db->select("
                           IFNULL(SUM(gym_swimming_kot.kot_amount),0) AS tot_kot_amount
                         ")
                ->from('gym_swimming_kot')
                ->where($where)
                ->where('DATE_FORMAT(`gym_swimming_kot`.`kot_date`,"%Y-%m") >= ', $startyearmonth)
                ->where('DATE_FORMAT(`gym_swimming_kot`.`kot_date`,"%Y-%m") <= ', $endyearmonth)
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