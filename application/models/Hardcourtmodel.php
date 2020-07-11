<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hardcourtmodel extends CI_Model{

public function insertDatahardcourt($searcharray){
         try {

               $session = $this->session->userdata('user_detail');
               $company=$session['companyid'];
               $year=$session['yearid'];
              
               $serialmodule='HARDCOURT';
              


               $tran_no=$this->getSerialNumber($company,$year,$serialmodule);

               $hardcortdata['tran_no']=$tran_no;

               if($searcharray['hardcourt_date'] != ''){

              $hardcourt_date = str_replace('/', '-', $searcharray['hardcourt_date']);
                $hardcortdata['tran_date']=date('Y-m-d',strtotime($hardcourt_date));
                $hardcortdata['tran_month']=date('M',strtotime($hardcourt_date));
               
               $month = date('m',strtotime($hardcourt_date));

               $hardcortdata['month_id'] = ltrim($month,'0');

               }else{
                $hardcortdata['tran_date'] = NULL;
                $hardcortdata['tran_month'] = NULL;
                $hardcortdata['month_id'] = NULL;
               }
              
               $student = explode('_',$searcharray['student_idcode']);
               $hardcortdata['admission_id']=$student[0];
               $hardcortdata['student_code']=$student[1];
               $hardcortdata['quntity']=$searcharray['quntity'];
               $hardcortdata['rate']=$searcharray['rate'];
               $hardcortdata['amount']=$searcharray['amount'];
               $hardcortdata['company_id']=$company;
               $hardcortdata['year_id']=$year;

                          

                $this->db->trans_begin();

                 $this->db->insert('hardcourt', $hardcortdata);
                 $hardcoId = $this->db->insert_id();
                // $this->insertintoVouchrDtl($vMastId,$searcharray);


                            

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $hardcoId;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }



 private function getSerialNumber($company,$year,$module){
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
   

public function getAllDatahardcourt()
  {
    $data = array();
    
    $this->db->select("admission_register.student_name,hardcourt.*")
        ->from('hardcourt')
        ->join('admission_register','admission_register.admission_id=hardcourt.admission_id','INNER')
        ->order_by('hardcourt.id','desc');
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


}