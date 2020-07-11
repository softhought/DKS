<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partybillentrymodel extends CI_Model{


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
       if($digit==3){
           $autoSaleNo = $tag."/0".$lastnumber."/".$yeartag;
       }elseif($digit==2){
           $autoSaleNo = $tag."/00".$lastnumber."/".$yeartag;
       }elseif($digit==1){
        $autoSaleNo = $tag."/000".$lastnumber."/".$yeartag;
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

   public function getallcreditorsbill()
    {
        $data = array();
             
       
                $this->db->select("creditores_bill.*,vendor_master.vendor_name,account_master.account_name")
                ->from('creditores_bill')
                ->join('vendor_master','creditores_bill.party_id = vendor_master.account_id','INNER')
                ->join('account_master','creditores_bill.debit_account_id = account_master.account_id','INNER');
               
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

    public function getcreditorsbillByid($bill_id)
    {
        $data = array();
        
        $where = array('creditores_bill.bill_id'=>$bill_id);
       
                $this->db->select("creditores_bill.*,voucher_master.voucher_no")
                ->from('creditores_bill')
                ->join('voucher_master','creditores_bill.voucher_master_id = voucher_master.id','INNER')               
                ->where($where);
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

}