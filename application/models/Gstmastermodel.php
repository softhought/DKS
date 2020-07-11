<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gstmastermodel extends CI_Model{



	public function getallgstmasterdtl()

  {

    $data = array();

    

    $this->db->select("account_master.account_name,gstmaster.*")

        ->from('gstmaster')

        ->join('account_master','gstmaster.accountId=account_master.account_id','INNER')

        ->order_by('gstmaster.rate');

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