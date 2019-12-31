<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loginmodel extends CI_Model{

    public function checkLogin($user_name,$password)
    {      
        $userId="";
        $where_arr =["user_name"=>$this->db->escape_str($user_name),
                     "password"=>md5($this->db->escape_str($password)),
                     "is_active"=>'Y'
            ];
       $query= $this->db->select("users.*")
                ->where($where_arr)
                ->get("users");
            
       if($query->num_rows()>0)
       {
           $rows = $query->row();
           $userId = $rows->id;
       }
       return $userId;
    }

    public function get_user($user_id)
    {
        $user="";
        $query=$this->db->select("users.*")
                ->where("users.id",$user_id)
                ->get("users");
        if($query->num_rows()>0){
            $user = $query->row();
        }
        return $user;
    }

    

}//end of class