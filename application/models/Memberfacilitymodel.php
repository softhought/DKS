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
       
                $this->db->select("fixed_hard_court_transaction.*,
                    member_master.member_name,member_master.member_code,
                    day_master.day_name,
                    day_master.day_code,
                    fixed_hard_court_timeslot.from_time,
                    fixed_hard_court_timeslot.to_time,
                    ")
                ->from('fixed_hard_court_transaction')
                ->join('member_master','member_master.member_id = fixed_hard_court_transaction.member_id','INNER')
                ->join('day_master','day_master.day_id = fixed_hard_court_transaction.day_id','INNER')
                ->join('fixed_hard_court_timeslot','fixed_hard_court_timeslot.time_slot_id = fixed_hard_court_transaction.time_slot_id','INNER')
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


public function getAllBenvolentFundList($yearid,$companyid)
  {
    $data = array();

    $where = array(
                    'benvolent_fund_transaction.year_id' => $yearid,
                    'benvolent_fund_transaction.company_id' => $companyid
                  );
    
    $this->db->select("
                        benvolent_fund_transaction.*,
                        member_master.member_code,
                        member_master.title_one,
                        member_master.member_name,
                        month_master.month_name,
                        member_catogary_master.category_name
                       
                        ")
        ->from('benvolent_fund_transaction')
        ->join('member_master','member_master.member_id=benvolent_fund_transaction.member_id','INNER')
        ->join('month_master','month_master.id=benvolent_fund_transaction.month_id','INNER')
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        ->order_by('benvolent_fund_transaction.btran_id')
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



  public function getAllMemberListByCategory($category)
  {
    $data = array();
      $where = array(
                            'member_master.category' => $category
                        );
    
    $this->db->select("
                        member_master.*,
                        member_catogary_master.category_name
                    
                        ")
        ->from('member_master')
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        
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


  public function getAllDevelopmentFeeList($yearid,$companyid)
  {
    $data = array();

    $where = array(
                    'development_fees_transaction.year_id' => $yearid,
                    'development_fees_transaction.company_id' => $companyid
                  );
    
    $this->db->select("
                        development_fees_transaction.*,
                        member_master.member_code,
                        member_master.title_one,
                        member_master.member_name,
                        month_master.month_name,
                        member_catogary_master.category_name
                       
                        ")
        ->from('development_fees_transaction')
        ->join('member_master','member_master.member_id=development_fees_transaction.member_id','INNER')
        ->join('month_master','month_master.id=development_fees_transaction.month_id','INNER')
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        ->order_by('development_fees_transaction.dev_tran_id')
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





  /**/


public function getMemberListForCopyBenvolentFund($category,$month,$yearid,$companyid)
  {
    $data = array();

    $where = array(
                    'benvolent_fund_transaction.year_id' => $yearid,
                    'benvolent_fund_transaction.company_id' => $companyid,
                    'member_master.category' => $category,
                    'benvolent_fund_transaction.month_id' => $month,
                  );
    
    $this->db->select("
                        benvolent_fund_transaction.*,
                        member_master.member_code,
                        member_master.title_one,
                        member_master.member_name,
                        month_master.month_name,
                        member_catogary_master.category_name
                       
                        ")
        ->from('benvolent_fund_transaction')
        ->join('member_master','member_master.member_id=benvolent_fund_transaction.member_id','INNER')
        ->join('month_master','month_master.id=benvolent_fund_transaction.month_id','INNER')
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        ->order_by('benvolent_fund_transaction.btran_id')
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



  public function getMemberListForCopyDevelopmentFees($category,$month,$yearid,$companyid)
  {
    $data = array();

    $where = array(
                    'development_fees_transaction.year_id' => $yearid,
                    'development_fees_transaction.company_id' => $companyid,
                    'member_master.category' => $category,
                    'development_fees_transaction.month_id' => $month,
                  );
    
    $this->db->select("
                        development_fees_transaction.*,
                        member_master.member_code,
                        member_master.title_one,
                        member_master.member_name,
                        month_master.month_name,
                        member_catogary_master.category_name
                       
                        ")
        ->from('development_fees_transaction')
        ->join('member_master','member_master.member_id=development_fees_transaction.member_id','INNER')
        ->join('month_master','month_master.id=development_fees_transaction.month_id','INNER')
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        ->order_by('development_fees_transaction.dev_tran_id')
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






} //  end of class