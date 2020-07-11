<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salaryprocessmodel extends CI_Model{

 public function getAllEmployee($department){

        $data = array();
        if ($department!='') {
            $where = array('employee_master.dept_master_id' =>$department );
        }else{
            $where = [];
        }

        $this->db->select("*")
                 ->from('employee_master')
                 ->where($where)
                 ->order_by("name");
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

 public function getAllDepartment(){

        $data = array();

        $this->db->select("*")
                 ->from('department_master')
                
                 ->order_by("dept_name");
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



    public function getSalaryPerameter($month_id,$year_id,$company_id)
    {
        $data = array();
        $where = array(
                        'month_id' => $month_id, 
                        'year_id' => $year_id, 
                        'company_id' => $company_id, 
                    );
        $this->db->select("*")
                ->from('salary_parameter_master')
                ->where($where)
                ->limit(1);
        $query = $this->db->get();
        
        #echo $this->db->last_query();
        
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


    public function getProfessionalTax($gross)
    {
        $data = array();
       
        $this->db->select("*")
                ->from('professional_tax_master')
                ->where("$gross BETWEEN min_slab AND max_slab")
                ->limit(1);
        $query = $this->db->get();
        
        #echo $this->db->last_query();
        
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



    public function getAllCashBankAc()
    {
        $data = array();
        $where = array(
                        'account_master.is_active' => 'Y',
                        'group_master.is_bank' => 'Y',
                       );

        $this->db->select("*")
                ->from('account_master')
                ->join('group_master','group_master.id = account_master.group_id','INNER')
                ->where($where)
                ->order_by('account_master.account_name','asc');
        $query = $this->db->get();
        #q();
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



 public function getAccountIdByComponentDepartment($department_id,$component_code)
    {
        $data = array();
        $where = array(
                        'salary_component_details.department_id' =>$department_id, 
                        'salary_component_master.code' =>$component_code, 
                      );
        $this->db->select("*")
                ->from('salary_component_details')
                ->join('salary_component_master','salary_component_master.id = salary_component_details.compmonent_id','INNER')
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