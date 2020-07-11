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

//added by anil on 04-05-2020
public function GetUploadImage($data,$filename)
	{ 
		
    $dir = $_SERVER['DOCUMENT_ROOT'].'/assets/img/member-images'; //local
	//	$dir1 = APPPATH.'assets/img/room'; 
		
	
		$config = array(
			'upload_path' => $dir,
			'allowed_types' => 'jpg|png|jpeg|gif',
			'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_filename' => '255',
			'encrypt_name' => TRUE,
			);

		$this->load->library('upload', $config);
		$images = array();
        $detail_array = array();	
             
      		$_FILES['images']['name']= $_FILES[$filename]['name'];
            $_FILES['images']['type']= $_FILES[$filename]['type'];
            $_FILES['images']['tmp_name']= $_FILES[$filename]['tmp_name'];
            $_FILES['images']['error']= $_FILES[$filename]['error'];
            $_FILES['images']['size']= $_FILES[$filename]['size'];
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('images'))
			{
				
               $file_detail = $this->upload->data();
               $file_name = $file_detail['file_name']; 
			   return $file_name;
      }
       
       

  }
  
  public function GetchildUploadImage($data,$filename,$i)
	{ 
		
    $dir = $_SERVER['DOCUMENT_ROOT'].'/assets/img/children-images'; //local
	//	$dir1 = APPPATH.'assets/img/room'; 
		
	
		$config = array(
			'upload_path' => $dir,
			'allowed_types' => 'jpg|png|jpeg|gif',
			'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_filename' => '255',
			'encrypt_name' => TRUE,
			);

		$this->load->library('upload', $config);
		$images = array();
        $detail_array = array();	
             
      		$_FILES['images']['name']= $_FILES[$filename]['name'][$i];
            $_FILES['images']['type']= $_FILES[$filename]['type'][$i];
            $_FILES['images']['tmp_name']= $_FILES[$filename]['tmp_name'][$i];
            $_FILES['images']['error']= $_FILES[$filename]['error'][$i];
            $_FILES['images']['size']= $_FILES[$filename]['size'][$i];
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('images'))
			{
				
               $file_detail = $this->upload->data();
               $file_name = $file_detail['file_name']; 
			   return $file_name;
      }
       
       

	}

}