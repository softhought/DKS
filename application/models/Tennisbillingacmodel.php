<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tennisbillingacmodel extends CI_Model{

	public function getAllCategoryDetails()
  {
    $data = array();
    
    $this->db->select("
            drac.account_name as dr_account,
            crac.account_name as cr_account,
            student_category.*")
        ->from('student_category')
        ->join('account_master as drac','student_category.dr_account_id=drac.account_id','INNER')
        ->join('account_master as crac','student_category.cr_account_id=crac.account_id','INNER')
        ->order_by('student_category.category_name');
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