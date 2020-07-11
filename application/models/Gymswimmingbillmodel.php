<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gymswimmingbillmodel extends CI_Model{

public function getBotKotDataByCategory($yearmonth,$account,$year,$company)
	{
		$data = array();
		$where = array(
						'member_receipt.year_id' => $year,
						'member_receipt.company_id' => $company,
						'member_receipt.cr_ac_id' => $account,
						'member_receipt.tran_type' => 'ORITM',
						'DATE_FORMAT(member_receipt.receipt_date,"%Y-%m")' => $yearmonth
					   );
		$this->db->select("*")
				->from('member_receipt')
				->where($where);
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



    public function getGymSwimmingBillingList($month,$account_id,$member_id)
    {
        $data = array();


        if($member_id=='') {
            $where_member = [];
        }else{
            $where_member = array('gym_swimming_kot.member_id' => $member_id ); 
        }


        if($account_id==''){
        	$where_account=[];
        }else{
        	$where_account = array('gym_swimming_kot.account_id' => $account_id); 
        }


        if ($month=='') {
        	$where_month=[];
        }else{
        	$where_month = array(
        							'DATE_FORMAT(gym_swimming_kot.kot_date,"%Y-%m")' => $month
        						 ); 
        }

       
                $this->db->select("gym_swimming_kot.*,member_master.member_name,member_master.member_code,account_master.account_name")
                ->from('gym_swimming_kot')
                ->join('member_master','member_master.member_id = gym_swimming_kot.member_id','INNER')
                ->join('account_master','account_master.account_id = gym_swimming_kot.account_id','INNER')
                ->where($where_member)
                ->where($where_month)
                ->where($where_account);
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

	public function getallmemberlist()
    {
      $data = array();
      $this->db->select("member_master.*")
          ->from('member_master')
          ->where("status",'ACTIVE MEMBER')
          ->where("member_code NOT LIKE 'D%'")
          ->where("member_code NOT LIKE 'B%'")         
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






} // end of class