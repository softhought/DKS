<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tennisexpmodel extends CI_Model{

    public function getTennisexpByMonth($month,$year,$company)
    {
        $data = array();

        $where = array(
                             'tennis_exp_transaction.month_id' => $month,
                             'tennis_exp_transaction.year_id' => $year,
                             'tennis_exp_transaction.company_id' => $company,
                         );

        $this->db->select("tennis_exp_transaction.*,employee_master.name as emp_name,month_master.month_name")
                ->from('tennis_exp_transaction')
                ->join('employee_master','employee_master.empl_id=tennis_exp_transaction.employee_id','INNER')
                ->join('month_master','month_master.id=tennis_exp_transaction.month_id','INNER')
                ->where($where);
        $query = $this->db->get();
        #echo "<br>".$this->db->last_query();
        
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