<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class memberreceiptmodel extends CI_Model{


	public function getallemployeelist()
	{
		$data = array();
		$this->db->select("employee_master.*,designation_master.designation_name,department_master.dept_name")
                ->from('employee_master')
                ->join('department_master','employee_master.dept_master_id = department_master.dept_id','LEFT')
                ->join('designation_master','employee_master.designation_id = designation_master.id','LEFT')
				->order_by('empl_id','desc');
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



  public function getNewCodeSerial($startLetters,$category)
  {
    $data = array();
    $where = array('member_master.category' => $category);
    $this->db->select("SUBSTRING(member_code, 4) as last_serial")
        ->from('member_master')
        ->where("member_code LIKE '$startLetters%'")
        ->where($where)
        ->order_by('last_serial', 'desc')
        ->limit(1);
    $query = $this->db->get();
    
    #echo $this->db->last_query();
    
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


  public function getMemberReceiptData($party_master_id)
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



    public function getMemberReceiptList($from_dt,$to_dt,$member_id)
    {
        $data = array();


        if ($member_id=='All') {
            $where_member = [];
        }else{
            $where_member = array('member_receipt.member_id' => $member_id ); 
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

    
} // end of class