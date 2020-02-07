<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Membertransfermodel extends CI_Model{


  public function getlastcode($startLetters)
  {
    $data = array();
    $this->db->select("SUBSTRING(member_code, 4) as last_serial")
        ->from('member_master')
        ->where("member_code LIKE '%$startLetters%'")
        ->order_by('member_code', 'desc')
        ->limit(1);
    $query = $this->db->get();
    
   // echo $this->db->last_query();exit;
    
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

  public function getmemberdetails($memberid)
  {
    $data = array();
    $this->db->select('title_one,member_name,address_one,address_two,address_three,phone,mobile')
        ->from('member_master')
        ->where("member_id",$memberid);
        
    $query = $this->db->get();
    
   // echo $this->db->last_query();exit;
    
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

  public function getalldetails($startLetters)
  {
    $data = array();
    $this->db->select("member_id,member_code")
        ->from('member_master')
        ->where("member_code LIKE '_$startLetters%'")
        ->where("status",'ACTIVE MEMBER')
        ->where("member_code NOT LIKE 'D%'")
        ->where("member_code NOT LIKE 'B%'")
        ->order_by('member_code', 'asc');
       
    $query = $this->db->get();
    
   //echo $this->db->last_query();exit;
    
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