<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Correctionmodel extends CI_Model{

 public function getAllCorrectionData($from_dt,$to_dt)
	{
		$data = array();
		$query = $this->db->select("corrections.*,admission_register.title_one,admission_register.student_name,admission_register.bill_style")
				->from('corrections')
				->join('admission_register','corrections.student_id = admission_register.admission_id','INNER')
        ->where('DATE_FORMAT(`corrections`.`date_of_correction`,"%Y-%m-%d") >= ', $from_dt)
        ->where('DATE_FORMAT(`corrections`.`date_of_correction`,"%Y-%m-%d") <= ', $to_dt)
				->order_by('corrections.id','desc')
		    ->get();
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


public function insertCorrectionData($searcharray){
         try {

               $session = $this->session->userdata('user_detail');
               $company=$session['companyid'];
               $year=$session['yearid'];
              
               $serialmodule='CORRECTION';
              


               $tran_no=$this->getSerialNumber($company,$year,$serialmodule);

               $correctiodata['tran_no']=$tran_no;

               if($searcharray['correction_dt'] != ''){

              $correction_dt = str_replace('/', '-', $searcharray['correction_dt']);
                $correctiodata['date_of_correction']=date('Y-m-d',strtotime($correction_dt));
               

              
               }else{
                $correctiodata['date_of_correction'] = NULL;
                
               }
              
               $student = explode('_',$searcharray['student']);
               $correctiodata['student_id']=$student[0];
               $correctiodata['student_code']=$student[1];
               $correctiodata['correction_acc_id']=$searcharray['correction_acc_id'];
               $correctiodata['amount']=$searcharray['amount'];
               $correctiodata['narration']=$searcharray['narration'];
               $correctiodata['companyid']=$company;
               $correctiodata['yearid']=$year;
               $correctiodata['created_on']=date('Y-m-d');

                          

                $this->db->trans_begin();

                 $this->db->insert('corrections', $correctiodata);
                 $correctionNo = $tran_no;
                // $this->insertintoVouchrDtl($vMastId,$searcharray);


                            

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $correctionNo;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }



 private function getSerialNumber($company,$year,$module){
        $lastnumber = (int)(0);
        $tag = "";
        $noofpaddingdigit = (int)(0);
        $autoSaleNo="";
        $yeartag ="";
        $sql="SELECT
                id,
                SERIAL,
                moduleTag,
                lastnumber,
                noofpaddingdigit,
                module,
                companyid,
                yearid,
                yeartag
            FROM serialmaster
            WHERE companyid=".$company." AND yearid=".$year." AND module='".$module."' LOCK IN SHARE MODE";
        
                  $query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
        $row = $query->row(); 
        $lastnumber = $row->lastnumber;
                          $tag = $row->moduleTag;
                          $noofpaddingdigit = $row->noofpaddingdigit;
                          $yeartag = $row->yeartag;
                          
                          
      }
        $digit = (int)(log($lastnumber,10)+1) ;  
        if($digit==2){
            $autoSaleNo = $tag."/0".$lastnumber."/".$yeartag;
        }elseif($digit==1){
            $autoSaleNo = $tag."/00".$lastnumber."/".$yeartag;
        }else{
           $autoSaleNo = $tag."/".$lastnumber."/".$yeartag;
        }
        $lastnumber = $lastnumber + 1;
        
        //update
        $data = array(
        'serial' => $lastnumber,
        'lastnumber' => $lastnumber
        );
        $array = array('companyid' => $company, 'yearid' => $year, 'module' => $module);
        $this->db->where($array); 
        $this->db->update('serialmaster', $data);
        
        return $autoSaleNo;
        
    }

 public function getSingleCorrectionData($correctionId)
	{
		$data = array();
		$where = array('id'=>$correctionId);
		$query = $this->db->select("corrections.*,admission_register.title_one,admission_register.student_name,admission_register.bill_style")
				->from('corrections')
				->join('admission_register','corrections.student_id = admission_register.admission_id','INNER')
				->where($where)
		        ->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


public function getAllCorrectionDataUsingdate($from_dt,$to_date,$student_id,$condition)
	{
		$data = array();
		
		$query = $this->db->select("corrections.*,admission_register.title_one,admission_register.student_name,admission_register.bill_style")
				->from('corrections')
				->join('admission_register','corrections.student_id = admission_register.admission_id','INNER')
				->where('corrections.student_id = "'.$student_id.'" '.$condition.'corrections.date_of_correction BETWEEN "'.$from_dt.'" and "'.$to_date.'"')
				->order_by('corrections.id','desc')
		        ->get();
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

public function getAllCorrectionDatabyStudid($student_id)
	{
		$data = array();
		$where = array('corrections.student_id'=>$student_id);
		$query = $this->db->select("corrections.*,admission_register.title_one,admission_register.student_name,admission_register.bill_style")
				->from('corrections')
				->join('admission_register','corrections.student_id = admission_register.admission_id','INNER')
				->where($where)
				->order_by('corrections.id','desc')
		        ->get();
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



public function getAllstudentcode()
	{
		$data = array();
		
		$query = $this->db->select("student_code,student_id")
				->from('corrections')
				->group_by('student_code')
				->order_by('student_code','asc')
		        ->get();
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