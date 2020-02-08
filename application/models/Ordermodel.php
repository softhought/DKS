<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ordermodel extends CI_Model{

	public function getAllMemberList()
	{
		$data = array();
		$where = [];
		$this->db->select("*")
				->from('member_master')
				->where($where)
				->order_by("member_code", "asc");;
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

	public function getAllLocationList()
	{
		$data = array();
		$where = array('is_active' => 'Y' );
		$this->db->select("*")
				->from('location_master')
				->where($where)
				->order_by("location", "asc");;
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


	public function getAllItemByCategory($category)
	{
		$data = array();

		$where = array(
						'item_master.item_category' => $category
					 );

		$this->db->select("item_master.*,cgst.rate AS cgst_rate,sgst.rate AS sgst_rate")
				 ->from('item_master')
				 ->join('gstmaster as cgst','cgst.id=item_master.cgst_id','LEFT')
                 ->join('gstmaster as sgst','sgst.id=item_master.sgst_id','LEFT')
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


	public function getAllItemByStartLetter($category,$startletter)
	{
		$data = array();

		$where = array(
						'item_master.item_category' => $category
					 );

		$this->db->select("item_master.*,cgst.rate AS cgst_rate,sgst.rate AS sgst_rate")
				->from('item_master')
				->join('gstmaster as cgst','cgst.id=item_master.cgst_id','LEFT')
                ->join('gstmaster as sgst','sgst.id=item_master.sgst_id','LEFT')
				->where($where)
				->like('item_name',$startletter, 'after');;
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


	public function getItemDetailsByitemid($itemid)
	{
		$data = array();
		$where = array('item_master.item_id' =>$itemid);
		$this->db->select("item_master.*,cgst.rate AS cgst_rate,sgst.rate AS sgst_rate")
				->from("item_master")
				->join('gstmaster as cgst','cgst.id=item_master.cgst_id','LEFT')
                ->join('gstmaster as sgst','sgst.id=item_master.sgst_id','LEFT')
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


	public function getOrderSerial($category,$order_date)
	{
		$data = array();
		$where = array('order_master.category' => $category );
		$data=1;
		$this->db->select("*")
				->from('order_master')
				->where($where)
				->where('DATE_FORMAT(order_master.order_date,"%Y-%m-%d") = ', $order_date)
				->order_by("order_master.sl_no", "desc")
				->limit(1);
		$query = $this->db->get();
		
		#echo "<br>".$this->db->last_query();
		
		if($query->num_rows()> 0)
		{
           $row = $query->row();
           return $data = $row->sl_no+1;
             
        }
		else
		{
            return $data;
        }
	}


	public function getOrderMasterData($orderid)
	{
		$data = array();
		$where = array('order_master.order_id' => $orderid );
		
		$this->db->select("order_master.*,member_master.title_one,member_master.member_name")
				->from('order_master')
				->join('member_master','member_master.member_id=order_master.member_id','INNER')
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



	public function getOrderDetailsBymasterId($order_master_id)
	{
		$data = array();

		$where = array(
						'order_details.order_mst_id' => $order_master_id
					 );

		$this->db->select("order_details.*,item_master.item_name")
				 ->from('order_details')
				 ->join('item_master','item_master.item_id=order_details.item_mst_id','INNER')
				 ->where($where)
				 ->order_by("order_details.order_dtl_id", "asc");
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



public function getLastOrderHistory($category,$oderid)
	{
		$data = array();
		if ($oderid!='0') {
			$where = array(
							'order_master.order_id' => $oderid,
							'order_master.category' => $category
						   );
		}else{
			$where = array('order_master.category' => $category );
		}
		
		$data=1;
		$this->db->select("order_master.*,member_master.title_one,member_master.member_name,member_master.member_code")
				->from('order_master')
				->join('member_master','member_master.member_id=order_master.member_id','INNER')
				->where($where)
				->order_by("order_master.order_id", "desc")
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


	public function getLastOrderHistoryNextPrevious($oderid,$category,$type)
	{
		$data = array();
		if ($type=='NEXT') {
			$where = array(
				  'order_master.order_id >'=>$oderid,
				  'order_master.category' => $category
				  );
		}else{
			$where = array('
					order_master.order_id <'=>$oderid,
					'order_master.category' => $category
					);
		}
		
		
		$this->db->select("order_master.*,
						  member_master.title_one,
						  member_master.member_name,
						  member_master.member_code,
						  DATE_FORMAT(order_master.order_date,'%d/%m/%Y') AS order_date
						  ")
				->from('order_master',False)
				->join('member_master','member_master.member_id=order_master.member_id','INNER')
				->where($where)
				->order_by("order_master.order_id", "desc")
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


	public function getOrderList($from_dt,$to_dt,$entry_module,$member_id)
    {
        $data = array();

        if ($entry_module=='All') {
            $where_parameter = [];
        }else{
           $where_parameter = array('order_master.category' => $entry_module );
        }


        if ($member_id=='All') {
            $where_member = [];
        }else{
            $where_member = array('order_master.member_id' => $member_id ); 
        }
       
                $this->db->select("order_master.*,member_master.member_name,member_master.member_code")
                ->from('order_master')
                ->join('member_master','member_master.member_id = order_master.member_id','INNER')
                ->where('DATE_FORMAT(`order_master`.`order_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`order_master`.`order_date`,"%Y-%m-%d") <= ', $to_dt)
               // ->where($where_parameter)
                ->where($where_member)
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








} // end of class
