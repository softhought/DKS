<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Incentivebarmodel extends CI_Model{

    public function getIncentivebarByMonth($month,$year,$company)
    {
        $data = array();

        $where = array(
                             'incentive_bar_transaction.month_id' => $month,
                             'incentive_bar_transaction.year_id' => $year,
                             'incentive_bar_transaction.company_id' => $company,
                         );

        $this->db->select("incentive_bar_transaction.*,employee_master.name as emp_name,month_master.month_name")
                ->from('incentive_bar_transaction')
                ->join('employee_master','employee_master.empl_id=incentive_bar_transaction.employee_id','INNER')
                ->join('month_master','month_master.id=incentive_bar_transaction.month_id','INNER')
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