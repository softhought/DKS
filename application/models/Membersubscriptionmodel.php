<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Membersubscriptionmodel extends CI_Model{

  public function getallmebercode(){


        $data = array();


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


public function getallcategorylist(){

        $data = array();

        $this->db->select("*")
                ->from('member_catogary_master')
                ->order_by("category_name", "asc");

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





public function getAllMemberListByCategory($category)
{

      $data = array();

      $where = array(
                       'member_master.category' => $category       
                    );
 
     $this->db->select("
                        member_master.*,
                        member_catogary_master.category_name,
                        member_subscription.subscription_amount
                        ")

              ->from('member_master')
              ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
              ->join('member_subscription','member_subscription.member_id=member_master.member_id','LEFT')
              ->where($where);

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







  public function getAllSubscriptionFeeList($yearid,$companyid,$member_code,$cat_id)

  {

    $data = array();



    $where = array(

                    'member_subscription.year_id' => $yearid,

                    'member_subscription.company_id' => $companyid

                  );



    if($member_code != ''){



      $where2 = array('member_master.member_code'=>$member_code);

   }else{

     $where2 = array();

   }

   if($cat_id != ''){



      $where3 = array('member_catogary_master.cat_id'=>$cat_id);

   }else{

     $where3 = array();

   }





    

    $this->db->select("

                        member_subscription.*,

                        member_master.member_code,

                        member_master.title_one,

                        member_master.member_name,

                        member_catogary_master.category_name

                       

                        ")

        ->from('member_subscription')

        ->join('member_master','member_master.member_id=member_subscription.member_id','INNER')   

        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')

        ->order_by('member_subscription.sub_id')

        ->where($where)

        ->where($where2)

        ->where($where3);

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