<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Memberbillmodel extends CI_Model{



 public function getAllActiveMembercode(){

        $data = array();

        $where = array('member_master.' => 'ACTIVE MEMBER' );


        $this->db->select("member_master.member_code")
                 ->from('member_master')
                 ->order_by("member_code");
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


public function getAllActiveMemberByCategory(){

        $data = array();
        $where = array(
        				'member_master.status' => 'ACTIVE MEMBER',
        			  );

        $this->db->select("member_master.member_code")
                 ->from('member_master')
                 ->order_by("member_code");
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