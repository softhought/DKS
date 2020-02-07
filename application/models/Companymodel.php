<?php

class Companymodel extends CI_Model {

    /**
     * returns a list of articles
     * @return array 
     */
    public function companylist() {
		$where = [
			"company_master.is_active" => "Y"
		];
        $this->db->select('*');
        $this->db->from('company_master');
		$this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function getCompanyNameById($id) 
    {
        $this->db->select("full_name")
                ->from('company_master')
                ->where('company_id', $id);
        $query = $this->db->get();         
    //    echo  $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->full_name;
        }else{
            return '';
        }
    }
    
      public function getCompanyAddressById($id = '') {
        $sql = "SELECT address FROM company_master WHERE company_id='" . $id . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->address;
        }else{
            return '';
        }
    }
    
    /**
     * result foe fetch data
     */    
    
      public function getCompanyById($id = '') {
        $sql = "SELECT * FROM company_master WHERE company_id='" . $id . "'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }else{
            return '';
        }
    }

	
}

?>