<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Membercorrectionentrymodel extends CI_Model{

    public function getcorrectionDataByEntryModule($entry_module)
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
 
    public function getTranNumber($company,$year){
        $lastnumber = (int)(0);
        $tag = "";
        $noofpaddingdigit = (int)(0);
        $autoSaleNo="";
        $yeartag ="";
        $module = "CORRECTION ENTRY";
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

    public function getCorrectionDetailsByTranId($cortranId)
    {
        $data = array();
        $where = array('member_correction_transaction.mem_cor_id' => $cortranId );
        $this->db->select("member_correction_transaction.*,member_master.member_name,member_master.title_one")
                ->from('member_correction_transaction')
                ->join('member_master','member_master.member_id = member_correction_transaction.member_id','INNER')
                ->where($where)
                ->limit(1);
        $query = $this->db->get();
        
   # echo "<br>".$this->db->last_query();exit;
        
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

    public function getcorrectionTransactionList($from_dt,$to_dt,$member_id)
    {
        $data = array();

      

        if ($member_id=='All') {
            $where_member = [];
        }else{
            $where_member = array('member_correction_transaction.member_id' => $member_id ); 
        }
       
                $this->db->select("member_correction_transaction.*,member_correction_description_master.*,member_master.member_name,member_master.member_code")
                ->from('member_correction_transaction')
                ->join('member_master','member_master.member_id = member_correction_transaction.member_id','INNER')
                ->join('member_correction_description_master','member_correction_transaction.desc_master_id = member_correction_description_master.id','LEFT')
                ->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`member_correction_transaction`.`tran_date`,"%Y-%m-%d") <= ', $to_dt)
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

}