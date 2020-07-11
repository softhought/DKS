<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blockunblockregistermodel extends CI_Model{


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





	public function getMemberListCodeLike($codelike,$blockunblock,$balance)
	{
		$data = array();
		$ignore_status = array('TRANSFERRED','RESIGNED','TERMINATED');

		if ($blockunblock!='') {
			$whereblk = array('member_master.blocked_y_n' =>$blockunblock );
		}else{
			$whereblk = [];
		}


		$this->db->select("
							member_master.member_id,
							member_master.member_code,
							member_master.title_one,
							member_master.member_name,
							member_master.status,
							member_master.daily_balance,
							member_master.blocked_y_n,
						")
				->from('member_master')
				->like('member_master.member_code',$codelike)
				->where("member_code NOT LIKE 'K%'")
				->where("member_code NOT LIKE 'S%'")
				->where("member_code NOT LIKE 'A%'")
				->where("member_code NOT LIKE 'D%'")
				->where("member_code NOT LIKE 'B%'")
				->where_not_in('member_master.status', $ignore_status)
				->where('member_master.elt_member !=' , 'Y')
				->where($whereblk)
				->where('member_master.daily_balance >',$balance)
				->order_by("member_master.member_id", "asc");
		$query = $this->db->get();
		#q();
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




		public function getMemberListbyMember($member_id,$blockunblock,$balance)
	{
		$data = array();
		$ignore_status = array('TRANSFERRED','RESIGNED','TERMINATED');

		if ($member_id!='') {
			$wheremember = array('member_master.member_id' =>$member_id );
		}else{
			$wheremember = [];
		}

		if ($blockunblock!='') {
			$whereblk = array('member_master.blocked_y_n' =>$blockunblock );
		}else{
			$whereblk = [];
		}



		$this->db->select("
							member_master.member_id,
							member_master.member_code,
							member_master.title_one,
							member_master.member_name,
							member_master.status,
							member_master.daily_balance,
							member_master.blocked_y_n,
						")
				->from('member_master')
				->where("member_code NOT LIKE 'K%'")
				->where("member_code NOT LIKE 'S%'")
				->where("member_code NOT LIKE 'A%'")
				->where("member_code NOT LIKE 'D%'")
				->where("member_code NOT LIKE 'B%'")
				->where_not_in('member_master.status', $ignore_status)
				->where('member_master.elt_member !=' , 'Y')
				->where($wheremember)
				->where($whereblk)
				->where('member_master.daily_balance >',$balance)
				->order_by("member_master.member_id", "asc");
		$query = $this->db->get();
		#q();
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
