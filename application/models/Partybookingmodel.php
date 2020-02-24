<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partybookingmodel extends CI_Model{

    public function getallpartybookinglist($yearid)
	{
		$data = array();
		$this->db->select("party_booking_master.*,member_master.*,party_location_master.location_name as partylocation")
                ->from('party_booking_master')
                ->join('member_master','party_booking_master.member_master_id = member_master.member_id','INNER')
                ->join('party_location_master','party_booking_master.party_location_id = party_location_master.id','INNER')
                ->where('party_booking_master.year_id',$yearid);
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
    
    public function getallpartymember()
	{
		$data = array();
		$this->db->select("member_master.member_code,member_master.member_id,member_master.title_one,member_master.member_name")
                ->from('member_master')
                ->join('party_booking_master','member_master.member_code = party_booking_master.member_master_code','LEFT')
                // ->where("status",'ACTIVE MEMBER')
                // ->where("member_code  LIKE 'D%'")
                // ->where("member_code  LIKE 'B%'")
                ->where("CAST(SUBSTRING(member_code,1,2) AS UNSIGNED) > 0 ")
                ->where("party_booking_master.`member_master_code` IS NULL");
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
    
    public function getsingalbooking($bookingId)
	{
		$data = array();
		$this->db->select("party_booking_master.*,member_master.title_one,member_master.member_name")
                ->from('party_booking_master')
                ->join('member_master','party_booking_master.member_master_id = member_master.member_id','INNER')
                ->where('party_booking_master.booking_id',$bookingId);
        $query = $this->db->get();
        #echo $this->db->last_query();exit;
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
    }
    
    public function getallpartymemberforupdate($member_id)
	{
		$data = array();
		$this->db->select("member_master.member_code,member_master.member_id,member_master.title_one,member_master.member_name")
                ->from('member_master')
                ->join('party_booking_master','member_master.member_code = party_booking_master.member_master_code','LEFT')
                // ->where("status",'ACTIVE MEMBER')
                // ->where("member_code  LIKE 'D%'")
                // ->where("member_code  LIKE 'B%'")
                ->where("CAST(SUBSTRING(member_code,1,2) AS UNSIGNED) > 0 ")
                ->where("party_booking_master.`member_master_code` IS NULL")
                ->or_where("party_booking_master.booking_id = '".$member_id."'");
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

    public function getbookingTransactionList($from_dt,$to_dt,$timeslot,$location_id)
    {
        $data = array();      

        if ($timeslot=='All') {
            $where_time = [];
        }else{
            $where_time = array('party_booking_master.time_slot' => $timeslot ); 
        }
        if ($location_id=='All') {
            $where_loc = [];
        }else{
            $where_loc = array('party_booking_master.party_location_id' => $location_id ); 
        }
       
       $this->db->select("party_booking_master.*,member_master.*,party_location_master.location_name as partylocation")
                ->from('party_booking_master')
                ->join('member_master','party_booking_master.member_master_id = member_master.member_id','INNER')
                ->join('party_location_master','party_booking_master.party_location_id = party_location_master.id','INNER')
                ->where('DATE_FORMAT(`party_booking_master`.`booking_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`party_booking_master`.`booking_date`,"%Y-%m-%d") <= ', $to_dt)
                ->where($where_time)
                ->where($where_loc);
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

    public function getallpartybookingforcalender($location)
	{
        $data = array();
        if($location == 'All'){

            $where = [];
        }else{
            $where = array('party_location_id'=>$location);
        }
		$this->db->select("*")
                ->from('party_booking_master')                
                ->where('party_booking_master.is_cancel','N')
                ->where($where)
                ->order_by("party_date,FIELD(time_slot,'DAY','AFTERNOON','NIGHT')");
        $query = $this->db->get();
         #echo $this->db->last_query();exit;
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
                $data[] = array('title'=>$rows->time_slot[0],
                                'start'=>date('Y-m-d',strtotime($rows->party_date))
                            );
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
    }

}