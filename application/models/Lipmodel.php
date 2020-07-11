<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lipmodel extends CI_Model{

    public function getLipListByMonth($month,$year)
    {
        $data = array();

        $where = array(
                             'lip_transaction.month_id' => $month,
                             'lip_transaction.year_id' => $year,
                         );

        $this->db->select("lip_transaction.*,employee_master.name as emp_name,month_master.month_name")
                ->from('lip_transaction')
                ->join('employee_master','employee_master.empl_id=lip_transaction.employee_id','INNER')
                ->join('month_master','month_master.id=lip_transaction.month_id','INNER')
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