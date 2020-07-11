<?php class Tenniscoachingtoaccountsmodel extends CI_Model {


    public function TennisBillTotalByCategory($startletter,$month_id,$quarter_id,$year_id,$billing_style,$company_id) {


        if ($billing_style=='Q') {

            $where = array(
                            'year_id' => $year_id,
                            'quarter_id' => $quarter_id,
                            'company_id' => $company_id,
                          );

        }else{

            $where = array(
                            'year_id' => $year_id,
                            'month_id' => $month_id,
                            'company_id' => $company_id,
                          );

        }

        $this->db->select('IFNULL(SUM(bill_master_tennis.total_amount),0) AS total_amt');
        $this->db->from('bill_master_tennis');
		$this->db->where($where);
        $this->db->like('bill_master_tennis.student_code',$startletter, 'after');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $rows) {
                $data = $rows;
            }
            return $data;
        } else {
            return false;
        }
    }


} // end of class 