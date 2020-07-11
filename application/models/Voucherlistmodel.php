<?php



class Voucherlistmodel extends CI_Model {



    public function getFinancialyearData($yearid){

        $sql="SELECT * FROM financialyear WHERE financialyear.year_id=".$yearid;

        $query = $this->db->query($sql);

         if ($query->num_rows() > 0) {

                foreach ($query->result() as $rows) {

                    return $rows;

                }

         }

        

    }





    public function getAccountList($company,$year)

	{

		$data = array();

		$where = array('account_master.company_id' => $company );

		$this->db->select("*")

				->from('account_master');

		$query = $this->db->get();

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





	    public function getVoucherList($vdata){

        $session = $this->session->userdata('user_detail');

        $fromdt = $vdata['from_date'];

        $todt = $vdata['to_date'];

        $ptype = $vdata['ptype'];

        $account = $vdata['accid'];



        

        $whereTranType = "";

        $whereAccID = "";



        if($ptype!="ALL")

        {

          if($ptype=="PUR")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('PR','RP','SP')";

          }

          elseif($ptype=="SALE")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('SL','RS')";

          }

          elseif($ptype=="GV")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('GV')";

          }

          elseif($ptype=="JV")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('JV')";

          }

          elseif($ptype=="CN")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('CN')";

          }

          elseif($ptype=="VADV")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('VADV')";

          }

          elseif($ptype=="CADV")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('CADV')";

          }

          elseif($ptype=="PY")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('PY','PJV')";

          }

          elseif($ptype=="RC")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('RC')";

          }

           elseif($ptype=="CB")

          {

            $whereTranType = " AND `voucher_master`.`tran_type` IN ('CB')";

          }



          

        }



        if($account>0)

        {

          $whereAccID = " AND `voucher_detail`.`account_master_id`=".$account;

        }



            $sql = "SELECT 

                    voucher_master.`id` AS vmasterID,

                    voucher_master.`voucher_no`,

                    DATE_FORMAT(`voucher_master`.`voucher_date`,'%d-%m-%Y') AS VoucherDate,

                    voucher_master.`tran_type`,

                   

                    voucher_master.`narration`

                    FROM voucher_detail 

                    INNER JOIN voucher_master

                    ON voucher_master.`id` = voucher_detail.`voucher_master_id`

                    WHERE 

                    voucher_master.`voucher_date` BETWEEN '".$fromdt."' AND '".$todt."'

                    AND voucher_master.`company_id` = ".$session['companyid']." 

                    AND voucher_master.`year_id`=".$session['yearid']." ".$whereTranType." ".$whereAccID."

                    GROUP BY voucher_detail.`voucher_master_id`

                    ORDER BY voucher_master.`voucher_date`";

                

        

        

        $query =$this->db->query($sql);

       # echo $this->db->last_query();

        if($query->num_rows()> 0){

            foreach ($query->result() as $rows){

                $data[]=array(

                   "id"=>$rows->vmasterID,

                   // "voucherDtlId"=>$rows->voucherDtlId,

                    "voucher_number"=>$rows->voucher_no,

                    "VoucherDate"=>$rows->VoucherDate,

                    "narration"=>$rows->narration,

                    "tran_type"=>$rows->tran_type,

                    "voucherDtl"=>$this->getVoucherDetaildata($rows->vmasterID)

                );

            }



          return $data;

        }

        else{

            return $data=array();

        }

    }

    



         public function getVoucherDetaildata($vouchmastId){

        $sql="SELECT 

            `account_master`.`account_name`,

            `voucher_detail`.`amount`,

            `voucher_detail`.`tran_tag` AS drCr

             FROM `voucher_detail`

             INNER JOIN `account_master`

             ON `account_master`.`account_id`=`voucher_detail`.`account_master_id`

             WHERE `voucher_detail`.`voucher_master_id`='".$vouchmastId."'";

          $query = $this->db->query($sql);

          #echo $this->db->last_query();

            if ($query->num_rows() > 0) {

                foreach ($query->result() as $rows) {

                    $data[] = $rows;

                }





                return $data;

            } else {

                return $data;

            }

        

    }

    



}// end of class