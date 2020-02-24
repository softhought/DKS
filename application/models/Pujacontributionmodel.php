<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pujacontributionmodel extends CI_Model{

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
                        member_catogary_master.category_name
                    
                        ")
        ->from('member_master')
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        
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

public function getallmonthlist(){


        $data = array();
        $this->db->select("*")
                ->from('month_master')
                ->order_by("id", "asc");
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



    public function getAllPujacontributionList($yearid,$companyid,$member_code,$cat_id,$month_id)
  {
    $data = array();

    $where = array(
                    'puja_contribution.year_id' => $yearid,
                    'puja_contribution.company_id' => $companyid
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

  if($month_id != ''){

      $where4 = array('month_master.id'=>$month_id);
   }else{
     $where4 = array();
   }



    
    $this->db->select("
                        puja_contribution.*,
                        member_master.member_code,
                        member_master.title_one,
                        member_master.member_name,
                        month_master.month_name,
                        member_catogary_master.category_name
                       
                        ")
        ->from('puja_contribution')
        ->join('member_master','member_master.member_id=puja_contribution.member_id','INNER')   
        ->join('month_master','month_master.id=puja_contribution.month_id','INNER')   
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        ->order_by('puja_contribution.contribution_id')
        ->where($where)
        ->where($where2)
        ->where($where3)
        ->where($where4);
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




public function getMemberListForCopyPujacontribution($category,$month,$yearid,$companyid)
  {
    $data = array();
    $where = array(
                    'puja_contribution.year_id' => $yearid,
                    'puja_contribution.company_id' => $companyid,
                    'puja_contribution.category_id' => $category,
                    'puja_contribution.month_id' => $month,
                  );
    
    $this->db->select("
                        puja_contribution.*,
                        member_master.member_code,
                        member_master.title_one,
                        member_master.member_name,
                        month_master.month_name,
                        member_catogary_master.category_name
                        ")
        ->from('puja_contribution')
        ->join('member_master','member_master.member_id=puja_contribution.member_id','INNER')
        ->join('month_master','month_master.id=puja_contribution.month_id','INNER')
        ->join('member_catogary_master','member_catogary_master.cat_id=member_master.category','INNER')
        ->order_by('puja_contribution.contribution_id')
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



} // end of class