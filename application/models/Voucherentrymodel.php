<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Voucherentrymodel extends CI_Model{


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
        if($digit==4){
            $autoSaleNo = $tag."/0".$lastnumber."/".$yeartag;
        }else if($digit==3){
            $autoSaleNo = $tag."/00".$lastnumber."/".$yeartag;
        }else if($digit==2){
            $autoSaleNo = $tag."/000".$lastnumber."/".$yeartag;
        }elseif($digit==1){
            $autoSaleNo = $tag."/0000".$lastnumber."/".$yeartag;
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



public function getVoucherEntryList($fromdt,$todt){
        $session = $this->session->userdata('user_detail');
       
       
       
        
        $whereTranType = "";
        $whereAccID = "";

      $whereTranType = " AND `voucher_master`.`tran_type` IN ('JV')";

     

            $sql = "SELECT 
                    voucher_master.`id` AS vmasterID,
                    voucher_master.`voucher_no`,
                    DATE_FORMAT(`voucher_master`.`voucher_date`,'%d-%m-%Y') AS VoucherDate,
                    voucher_master.`tran_type`,
                   
                    voucher_master.`narration`
                    FROM voucher_detail 
                    INNER JOIN voucher_master
                    ON voucher_master.`id` = voucher_detail.`voucher_master_id`
                    WHERE 
                    voucher_master.`voucher_date` BETWEEN '".$fromdt."' AND '".$todt."'
                    AND voucher_master.`company_id` = ".$session['companyid']." 
                    AND voucher_master.`year_id`=".$session['yearid']." ".$whereTranType."
                    GROUP BY voucher_detail.`voucher_master_id`
                    ORDER BY voucher_master.`voucher_date`";
                
        
        
        $query =$this->db->query($sql);
       # echo $this->db->last_query();
        if($query->num_rows()> 0){
            foreach ($query->result() as $rows){
                $data[]=array(
                   "id"=>$rows->vmasterID,
                   // "voucherDtlId"=>$rows->voucherDtlId,
                    "voucher_number"=>$rows->voucher_no,
                    "VoucherDate"=>$rows->VoucherDate,
                    "narration"=>$rows->narration,
                    "tran_type"=>$rows->tran_type,
                    "voucherDtl"=>$this->getVoucherDetaildata($rows->vmasterID)
                );
            }

          return $data;
        }
        else{
            return $data=array();
        }
    }
    
public function getVoucherDetaildata($vouchmastId){
        $sql="SELECT 
            `account_master`.`account_name`,
            `voucher_detail`.`amount`,
            `voucher_detail`.`tran_tag` AS drCr
             FROM `voucher_detail`
             INNER JOIN `account_master`
             ON `account_master`.`account_id`=`voucher_detail`.`account_master_id`
             WHERE `voucher_detail`.`voucher_master_id`='".$vouchmastId."'";
          $query = $this->db->query($sql);
          #echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $rows) {
                    $data[] = $rows;
                }


                return $data;
            } else {
                return $data;
            }
        
    }


public function getDetailsAccountHead($voucher_master_id)
    {
        $data = array();
          $where = array(
                       
                        'voucher_master_id' => $voucher_master_id, 
                      );
        $this->db->select("voucher_detail.*,account_master.account_name")
                ->from('voucher_detail')
                ->join('account_master','account_master.account_id = voucher_detail.account_master_id','INNER')
                ->where($where)
                ->order_by("voucher_detail.srl_no", "asc");
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