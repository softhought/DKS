<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menumodel extends CI_Model{

    // public function getMenu($table)
	// {
	// 	$data = array();
	// 	$sql = "SELECT * FROM ".$table." WHERE is_parent='P' ORDER BY menu_srl ASC";
	// 	 $query = $this->db->query($sql);
	// 	   if ($query->num_rows() > 0) 
	// 	   {
	// 		  foreach($query->result() as $rows){
				
	// 					$data[] = array(
	// 						"first_menu_id" => $rows->id,
	// 						"menu_name" => $rows->name,
	// 						"menu_link" => $rows->link,
	// 						"is_parent" => $rows->is_parent,
	// 						"parent_id" => $rows->parent_id,
	// 						"secondLevelMenu" => $this->getSecondLevelMenu($rows->id,$table) 
	// 					 );
					
                
	// 			}
	// 	   }
	// 	   return $data;
	// }
	
	// public function getSecondLevelMenu($parentID,$table)
	// {
	// 	$data = array();
	// 	$sql = "SELECT * FROM ".$table." WHERE parent_id=".$parentID." ORDER BY menu_srl ASC";
	// 	 $query = $this->db->query($sql);
	// 	   if ($query->num_rows() > 0) 
	// 	   {
	// 		  foreach($query->result() as $rows){
				
	// 					$data[] = array(
	// 						"second_menu_id" => $rows->id,
	// 						"second_menu_name" => $rows->name,
	// 						"second_menu_link" => $rows->link,
	// 						"second_is_parent" => $rows->is_parent,
	// 						"second_parent_id" => $rows->parent_id,
	// 						"thirdLevelMenu" => $this->getThirdLevelMenu($rows->id,$table) 
	// 					 );
					
                
	// 			}
	// 	   }
	// 	   return $data;
	// }
	
	// public function getThirdLevelMenu($parentID,$table)
	// {
	// 	$data = array();
	// 	$sql = "SELECT * FROM ".$table." WHERE parent_id=".$parentID." ORDER BY menu_srl ASC";
	// 	 $query = $this->db->query($sql);
	// 	   if ($query->num_rows() > 0) 
	// 	   {
	// 		  foreach($query->result() as $rows){
				
	// 					$data[] = array(
	// 						"third_menu_id" => $rows->id,
	// 						"third_menu_name" => $rows->name,
	// 						"third_menu_link" => $rows->link,
	// 						"third_is_parent" => $rows->is_parent,
	// 						"third_parent_id" => $rows->parent_id,
							
	// 					);
					
                
	// 			}
	// 	   }
	// 	   return $data;
	// }


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
						"first_menu_id" => $rows->id,
						"menu_name" => $rows->name,
						"menu_link" => $rows->link,
						"is_parent" => $rows->is_parent,
						"parent_id" => $rows->parent_id,
						"secondLevelMenu" => $this->getSecondLevelMenu($rows->id,$user_id) 
			);
				
                //    $data[] = array(
				// 		   "FirstLevelMenuData" => $rows,
						   
                //            "secondLevelMenu" => $this->getSecondLevelMenu($rows->id,$user_id) 
                //         );
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
				$query =  $this->db->get();
				// pre($this->db->last_query());exit;
		
		if($query->num_rows() > 0) 
		   {
				foreach($query->result() as $rows)
				{
					
					$data[] = array(
												"second_menu_id" => $rows->id,
												"second_menu_name" => $rows->name,
												"second_menu_link" => $rows->link,
												"second_is_parent" => $rows->is_parent,
												"second_parent_id" => $rows->parent_id,
												"thirdLevelMenu" => $this->getThirdLevelMenu($rows->id,$user_id) 
											 );
					// $data[] = array(
					// 		"secondLevelMenuData" => $rows,
					// 		"thirdLevelMenu" => $this->getThirdLevelMenu($rows->id,$user_id) 
					// 	 );
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
				$query =  $this->db->get();
		if($query->num_rows()> 0) 
		{
			foreach($query->result() as $rows)
			{
				$data[] = array(
											"third_menu_id" => $rows->id,
											"third_menu_name" => $rows->name,
											"third_menu_link" => $rows->link,
											"third_is_parent" => $rows->is_parent,
											"third_parent_id" => $rows->parent_id,
											
										);
			}
		}
		   return $data;
	}




}// end of class