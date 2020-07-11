<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Closinggeneratetennismodel extends CI_Model{

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

           return $row;

     

    }

    else

    {

      return 0;

    }

    

  }


public function getTannisPaymentAmount($bill_id,$tag)
  {
    $data = array();
    $where = array(
                    'bill_id' => $bill_id, 
                    'transaction_type' => $tag, 
                  );
    $this->db->select("
                  COALESCE(SUM(payment_master.payment_amount),0) as sum_payment_amount,
                  COALESCE(SUM(payment_master.fine_amt),0) as sum_fine_amt
                        ")
        ->from('payment_master')
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


} // end of class