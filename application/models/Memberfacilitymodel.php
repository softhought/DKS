<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Memberfacilitymodel extends CI_Model{

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


       public function getTranNumber($company,$year,$module){
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



    public function getfacilityTransactionList($from_dt,$to_dt,$entry_module,$member_id)
    {
        $data = array();

        if ($entry_module=='All') {
            $where_parameter = [];
        }else{
           $where_parameter = array('member_facility_transaction.parameter_mst_id' => $entry_module );
        }


        if ($member_id=='All') {
            $where_member = [];
        }else{
            $where_member = array('member_facility_transaction.member_id' => $member_id ); 
        }
       
                $this->db->select("member_facility_transaction.*,member_master.member_name,member_master.member_code")
                ->from('member_facility_transaction')
                ->join('member_master','member_master.member_id = member_facility_transaction.member_id','INNER')
                ->where('DATE_FORMAT(`member_facility_transaction`.`tran_dt`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`member_facility_transaction`.`tran_dt`,"%Y-%m-%d") <= ', $to_dt)
                ->where($where_parameter)
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


    public function getFactlityDetailsByTranId($tran_id)
    {
        $data = array();
        $where = array('member_facility_transaction.transaction_id' => $tran_id );
        $this->db->select("member_facility_transaction.*,member_master.member_name,member_master.title_one")
                ->from('member_facility_transaction')
                ->join('member_master','member_master.member_id = member_facility_transaction.member_id','INNER')
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


    public function getFixedHardCourtTimeSlot()
    {
        $data = array();
        $where = array('is_active' => 'Y' );
        $this->db->select("*")
                ->from('fixed_hard_court_timeslot')
                ->where($where)
                ->order_by("display_sl", "asc");
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


public function getFixedHardCourtList($from_dt,$to_dt,$member_id)
    {
        $data = array();

        // if ($entry_module=='All') {
        //     $where_parameter = [];
        // }else{
        //    $where_parameter = array('member_facility_transaction.parameter_mst_id' => $entry_module );
        // }


        if ($member_id=='All') {
            $where_member = [];
        }else{
            $where_member = array('fixed_hard_court_transaction.member_id' => $member_id ); 
        }
       
                $this->db->select("fixed_hard_court_transaction.*,member_master.member_name,member_master.member_code")
                ->from('fixed_hard_court_transaction')
                ->join('member_master','member_master.member_id = fixed_hard_court_transaction.member_id','INNER')
                ->where('DATE_FORMAT(`fixed_hard_court_transaction`.`tran_dt`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`fixed_hard_court_transaction`.`tran_dt`,"%Y-%m-%d") <= ', $to_dt)
                //->where($where_parameter)
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


    public function getFixedhardCourtDetailsByTranId($tran_id)
    {
        $data = array();
        $where = array('fixed_hard_court_transaction.ftran_id' => $tran_id );
        $this->db->select("fixed_hard_court_transaction.*,member_master.member_name,member_master.title_one")
                ->from('fixed_hard_court_transaction')
                ->join('member_master','member_master.member_id = fixed_hard_court_transaction.member_id','INNER')
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





} //  end of class