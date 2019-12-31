<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menupermissionmodel extends CI_Model{


 public function getUserList($userRole)
 {
     // 1 is the role id for Developer      
     if ($userRole==1) {
        $this->db->select("*")->from('users')->where('is_active','Y');
        
     }else{
        $this->db->select("*")->from('users')->where('is_active','Y')->where_not_in('user_role_id',1);
     }

     $query = $this->db->get();
     // echo $this->db->last_query();

    if($query->num_rows()> 0)
    {
        foreach ($query->result() as $rows)
        {
            $data[] = $rows;
        }
         return $data;
          
    }else{
        return $data;
    }

 }

 public function getMenuList($userRole,$user_id=null)
 {
     // 1 is the role id for Developer 
    if ($userRole==1) {
     return  $this->getAllAdministrativeMenuDevOnly();
    }else{
     return  $this->getAllAdministrativeMenu($user_id);
    }
   
 }

   /** menu list for developer (developer will have all the menu access ) */

   public function getAllAdministrativeMenuDevOnly()
   {
       $data = array();
       $where_Ary = array(
           "menumaster.is_parent" => "P",
           "menumaster.is_active" => "Y"
       );
       
       $this->db->select("*")->from('menumaster')
                    ->where($where_Ary)
                    ->order_by('menumaster.menu_srl','ASC');
        $query = $this->db->get();

        if ($query->num_rows()> 0)
        {
            foreach($query->result() as $rows)
            {
                $data[] = array(
                        "FirstLevelMenuData" => $rows,
                        "secondLevelMenu" => $this->getSecondLevelMenuDevOnly($rows->id) 
                    );
            }
        }
          return $data;
   }

   public function getSecondLevelMenuDevOnly($parentID)
   {
       $data = array();
       $where_Ary = array(
           "menumaster.parent_id" => $parentID,
           "menumaster.is_active" => "Y"
       );
       
       $this->db->select("*")->from('menumaster')
               ->where($where_Ary)
               ->order_by('menumaster.menu_srl','ASC');
        $query = $this->db->get();
        // pre($this->db->last_query());
       if($query->num_rows()> 0)
          {
               foreach($query->result() as $rows)
               {
                   $data[] = array(
                           "secondLevelMenuData" => $rows,
                           "thirdLevelMenu" => $this->getThirdLevelMenuDevOnly($rows->id) 
                        );
               }
          }
          return $data;
   }
   
   public function getThirdLevelMenuDevOnly($parentID)
   {
       $data = array();
       $where_Ary = array(
           "menumaster.parent_id" => $parentID,
           "menumaster.is_active" => "Y"
       );
       
        $this->db->select("*")->from('menumaster')
               ->where($where_Ary)
               ->order_by('menumaster.menu_srl','ASC');
        $query = $this->db->get();
       if($query->num_rows()>  0) 
       {
           foreach($query->result() as $rows)
           {
               $data[] = array(
                       "thirdLevelMenuData" =>$rows,
                   );
           }
       }
          return $data;
   }
/** end  menu list for developer  */

   public function getAllAdministrativeMenu($user_id)
   {
       $data = array();
       $where_Ary = array(
           "menumaster.is_parent" => "P",
           "menumaster.is_active" => "Y",
           "menupermissions.user_id" => $user_id,
       );
       
        $this->db->select("menumaster.*")->from('menumaster')
               ->join('menupermissions','menumaster.id=menupermissions.menu_id')
               ->where($where_Ary)
               ->order_by('menumaster.menu_srl','ASC');
        $query = $this->db->get();
        
       if ($query->num_rows()> 0)
          {
             foreach($query->result() as $rows)
             {
                   $data[] = array(
                           "FirstLevelMenuData" => $rows,
                           "secondLevelMenu" => $this->getSecondLevelMenu($rows->id,$user_id) 
                        );
            }
          }
          return $data;
   }

   public function getSecondLevelMenu($parentID,$user_id)
   {
       $data = array();
       $where_Ary = array(
           "menumaster.parent_id" => $parentID,
           "menumaster.is_active" => "Y",
           "menupermissions.user_id" => $user_id,
       );
       
        $this->db->select("menumaster.*")->from('menumaster')
               ->join('menupermissions','menumaster.id=menupermissions.menu_id')
               ->where($where_Ary)
               ->order_by('menumaster.menu_srl','ASC');
              
               $query = $this->db->get();
            //    pre($this->db->last_query());exit;
       if($query->num_rows()> 0)
          {
               foreach($query->result() as $rows)
               {
                   $data[] = array(
                           "secondLevelMenuData" => $rows,
                           "thirdLevelMenu" => $this->getThirdLevelMenu($rows->id,$user_id) 
                        );
               }
          }
          return $data;
   }
   
   public function getThirdLevelMenu($parentID,$user_id)
   {
       $data = array();
       $where_Ary = array(
           "menumaster.parent_id" => $parentID,
           "menumaster.is_active" => "Y",
           "menupermissions.user_id" => $user_id,
       );
       
      $this->db->select("menumaster.*")->from('menumaster')
               ->join('menupermissions','menumaster.id=menupermissions.menu_id')
               ->where($where_Ary)
               ->order_by('menumaster.menu_srl','ASC');
        $query = $this->db->get();
       if($query->num_rows()> 0) 
       {
           foreach($query->result() as $rows)
           {
               $data[] = array(
                       "thirdLevelMenuData" =>$rows,
                   );
           }
       }
          return $data;
   }
   

    public function getUsersPermittedMenu($userId)
    {
        $data = array();
        $this->db->select("menumaster.id")->from('menupermissions')
                ->join('menumaster','menumaster.id=menupermissions.menu_id','INNER')
                ->where('menupermissions.user_id',$userId);
        $query = $this->db->get();
        if($query->num_rows()> 0) 
        {
            
            foreach($query->result() as $rows)
            {
                $data[] = $rows;
            }
        }
        return $data;
    }

    public function getMenuCount($userId)
    {
        $this->db->select('*')
				->from('menupermissions')->where('user_id',$userId);

		$query = $this->db->get();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
    }

    public function DeletePermittedMenu($userId)
    {
        $this->db->delete('menupermissions', array('user_id'=>$userId)); 
        
    }

    public function InsertPermittedMenu($insert_Arr)
    {    
        $lastinsert_id = 0;
        try {
            $this->db->trans_begin();

            $this->db->insert('menupermissions', $insert_Arr);
            $lastinsert_id = $this->db->insert_id();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $lastinsert_id=0;
                return $lastinsert_id;
            } else {
                $this->db->trans_commit();
                return $lastinsert_id;
            }
        } catch (Exception $err) {
            echo $err->getTraceAsString();
        }
        
    }







}//end of class