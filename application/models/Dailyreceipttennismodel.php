<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dailyreceipttennismodel extends CI_Model{

    public function getTennisDailyReceiptList($from_dt,$to_dt,$mode,$company,$year)
    {
        $data = array();

        $trn_type = array('ORADM','ORITM','RCFS');

        if ($mode=='All') {
            $where_mode = [];
        }else{
             $where_mode = array('payment_master.payment_mode' => $mode );
        }

        $where_compyear = array(
                            'company_id' => $company,
                            'year_id' => $year
                         );
      
       
       
                $this->db->select("
                                  SUM(`payment_master`.`payment_amount`) as total_amount,
                                  `payment_master`.`payment_mode`
                                 ")
                ->from('payment_master')
                ->where('DATE_FORMAT(`payment_master`.`payment_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`payment_master`.`payment_date`,"%Y-%m-%d") <= ', $to_dt)
                ->where($where_mode)
                ->where($where_compyear)
                ->group_by("payment_master.payment_mode")
                ->where_in('payment_master.transaction_type', $trn_type);
               $query = $this->db->get();
        #echo $this->db->last_query();

        if($query->num_rows()> 0)
        {
            foreach ($query->result() as $rows)
            {
                //$data[] = $rows;

                $data[]=[
                  "masterData"=>$rows,
                  "detailsData"=>$this->getTennisReceiptDetails($rows->payment_mode,$from_dt,$to_dt,$company,$year)

                ];
            }
            return $data;
             
        }
        else
        {
             return $data;
         }
    }



public function getTennisReceiptDetails($mode,$from_dt,$to_dt,$company,$year)
    {
            
             if ($mode=='') {
              $where_mode = [];
              }else{
             $where_mode = array('payment_master.payment_mode' => $mode );
             }

              $where_compyear = array(
                            'payment_master.company_id' => $company,
                            'payment_master.year_id' => $year
                         );


        $data = array();
        $this->db->select("payment_master.*,admission_register.title_one,admission_register.student_name")
                ->from('payment_master')
                ->join('admission_register','admission_register.admission_id=payment_master.admission_id','INNER')
                ->where('DATE_FORMAT(`payment_master`.`payment_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`payment_master`.`payment_date`,"%Y-%m-%d") <= ', $to_dt)
                ->where($where_mode)
                ->where($where_compyear)
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