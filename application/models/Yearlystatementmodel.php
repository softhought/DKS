<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Yearlystatementmodel extends CI_Model{


	public function getMemberBillMasterData($member_id,$fromyearmonth,$toyearmonth,$year_id,$company_id)
{
		$data = array();
		$where = array(
						'member_bill_master.member_id' => $member_id,
						'member_bill_master.year_id' => $year_id,
						'member_bill_master.company_id' => $company_id,
						
					  );
		$this->db->select("
							member_bill_master.*,
							month_master.month_name,
							month_master.short_name,

						 ")
				->from('member_bill_master')
				->join('month_master','month_master.id=member_bill_master.bill_month','INNER')
				->where($where)
				->where('DATE_FORMAT(`member_bill_master`.`bill_date`,"%Y-%m") >= ', $fromyearmonth)
                ->where('DATE_FORMAT(`member_bill_master`.`bill_date`,"%Y-%m") <= ', $toyearmonth)
                ->order_by("month_master.display_serial", "asc");
		$query = $this->db->get();
		
		#echo "<br>".$this->db->last_query();
		
	    if($query->num_rows()> 0)
        {
            foreach ($query->result() as $rows)
            {
                $data[] = $rows;
            }
            return $data;
        }else{
            return $data;
         }

}

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







}// end of class