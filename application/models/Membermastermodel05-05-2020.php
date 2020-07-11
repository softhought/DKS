<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Membermastermodel extends CI_Model{



	public function getallmemberlist()

  {

    $data = array();

    $this->db->select("member_master.*,occupation_master.*")
        ->from('member_master')
        ->join('occupation_master','member_master.occupation_id = occupation_master.id','LEFT')
        ->where("member_code NOT LIKE 'D%'")
        ->where("member_code NOT LIKE 'B%'")
        ->order_by("FIELD(member_master.status,'ACTIVE MEMBER','TRANSFERRED','TEMPORARILY TERMINATED','TERMINATED','RESIGNED','DEAD')");

         $query = $this->db->get();
             #echo $this->db->last_query();exit;

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



  public function getallspecialmemberlist()

  {

    $data = array();

    $where = array('elt_member'=>'Y');

    $this->db->select("member_master.*,occupation_master.*")

        ->from('member_master')

        ->join('occupation_master','member_master.occupation_id = occupation_master.id','LEFT')

        ->order_by("FIELD(member_master.status,'ACTIVE MEMBER','TRANSFERRED','TEMPORARILY TERMINATED','TERMINATED','RESIGNED','DEAD')")

        ->where('member_code Not Like "BQ%"')

        ->where('member_code Not Like "DK%"')

        ->where($where);

         $query = $this->db->get();

    #echo $this->db->last_query();exit;



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