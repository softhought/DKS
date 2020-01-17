<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Billgeneratetennismodel extends CI_Model{

	public function studentListbyBillStyle($bill_style)
  {
    $data = array();

    $where = array('bill_style' => $bill_style );

    $where_in = array('ACTIVE STUDENT','TEMPORARY TERMINATED');
    
    $this->db->select("admission_register.*")
        ->from('admission_register')
        ->where($where)
        ->where_in('status', $where_in)
        ->order_by('admission_register.student_code');
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




  public function getHardCoutextraMontly($student_id,$year_id,$company_id,$year_month)
  {
    $data = 0;

    $where = array(
                    'hardcourt.admission_id' => $student_id, 
                    'hardcourt.year_id' => $year_id, 
                    'hardcourt.company_id' => $company_id 
                  );

    
    $this->db->select("COALESCE(SUM(hardcourt.`amount`),0) AS amount")
        ->from('hardcourt')
        ->where('DATE_FORMAT(`hardcourt`.`tran_date`,"%Y-%m") = ', $year_month)
        ->where($where)
        ->limit(1);
         $query = $this->db->get();
    #echo $this->db->last_query();

   if($query->num_rows()> 0)
    {
           $row = $query->row();
           return $data = $row->amount;
             
        }
    else
    {
            return $data;
     }
 
  }


  public function getHardCoutextraQuarterly($student_id,$year_id,$company_id,$starMonthYear,$endMonthYear)
  {
    $data = 0;

    $where = array(
                    'hardcourt.admission_id' => $student_id, 
                    'hardcourt.year_id' => $year_id, 
                    'hardcourt.company_id' => $company_id 
                  );

    
    $this->db->select("COALESCE(SUM(hardcourt.`amount`),0) AS amount")
        ->from('hardcourt')
      
        ->where('DATE_FORMAT(`hardcourt`.`tran_date`,"%Y-%m") >= ', $starMonthYear)
        ->where('DATE_FORMAT(`hardcourt`.`tran_date`,"%Y-%m") <= ', $endMonthYear)
        ->where($where)
        ->limit(1);
         $query = $this->db->get();
    #echo $this->db->last_query();

   if($query->num_rows()> 0)
    {
           $row = $query->row();
           return $data = $row->amount;
             
        }
    else
    {
            return $data;
     }
 
  }


  public function getCorrectionMontly($student_id,$year_id,$company_id,$year_month)
  {
    $data = 0;

    $where = array(
                    'corrections.student_id' => $student_id, 
                    'corrections.yearid' => $year_id, 
                    'corrections.companyid' => $company_id 
                  );

    
    $this->db->select("COALESCE(SUM(corrections.`amount`),0) AS amount")
        ->from('corrections')
        ->where('DATE_FORMAT(`corrections`.`date_of_correction`,"%Y-%m") = ', $year_month)
        ->where($where)
        ->limit(1);
         $query = $this->db->get();
    #echo $this->db->last_query();

   if($query->num_rows()> 0)
    {
           $row = $query->row();
           return $data = $row->amount;
             
    }
    else
    {
            return $data;
    }
 
  }



  public function getCorrectionQuarterly($student_id,$year_id,$company_id,$starMonthYear,$endMonthYear)
  {
    $data = 0;

    $where = array(
                    'corrections.student_id' => $student_id, 
                    'corrections.yearid' => $year_id, 
                    'corrections.companyid' => $company_id 
                  );

    
    $this->db->select("COALESCE(SUM(corrections.`amount`),0) AS amount")
        ->from('corrections')
      
        ->where('DATE_FORMAT(`corrections`.`date_of_correction`,"%Y-%m") >= ', $starMonthYear)
        ->where('DATE_FORMAT(`corrections`.`date_of_correction`,"%Y-%m") <= ', $endMonthYear)
        ->where($where)
        ->limit(1);
         $query = $this->db->get();
    #echo $this->db->last_query();

   if($query->num_rows()> 0)
    {
           $row = $query->row();
           return $data = $row->amount;
             
        }
    else
    {
            return $data;
     }
 
  }

  /* bill invoice serial */
     public function getSerialNumber($company,$year,$module){
        $lastnumber = (int)(0);
        $tag = "";
        $noofpaddingdigit = (int)(0);
        $autoSaleNo="";
        $yeartag ="";
        $sql="SELECT
                id,
                serial,
                moduleTag,
                lastnumber,
                noofpaddingdigit,
                module,
                companyid,
                yearid,
                yeartag
            FROM serialmaster
            WHERE companyid='".$company."' AND yearid='".$year."' AND module='".$module."' LOCK IN SHARE MODE";
        
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
            $autoSaleNo = "0".$lastnumber."/".$yeartag;
        }elseif($digit==1){
            $autoSaleNo = "00".$lastnumber."/".$yeartag;
        }else{
           $autoSaleNo = $lastnumber."/".$yeartag;
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

  public function checkExistBillData($billing_style,$student_id,$month_id,$quarter_id,$year_id,$company_id)
  {

    if ($billing_style=='M') {
    
     $where = array(
                      'student_id' => $student_id, 
                      'month_id' => $month_id, 
                      'year_id' => $year_id, 
                      'company_id' => $company_id, 
                    );

    }else{

       $where = array(
                      'student_id' => $student_id, 
                      'quarter_id' => $quarter_id, 
                      'year_id' => $year_id, 
                      'company_id' => $company_id, 
                    );

    }
    
    
    $this->db->select('*')
        ->from('bill_master_tennis')
        ->where($where)
        ->limit(1);
    $query = $this->db->get();
   #echo $this->db->last_query();
    if($query->num_rows()>0){

           $row = $query->row();
           return $row->bill_id;
     
    }
    else
    {
      return 0;
    }
    
  }




}// end of class