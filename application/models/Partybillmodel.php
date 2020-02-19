<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class partybillmodel extends CI_Model{


	  public function getSerialNumber($company,$year,$module){
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
            $autoSaleNo = "0".$lastnumber."/".$yeartag;
        }elseif($digit==1){
            $autoSaleNo = "00".$lastnumber."/".$yeartag;
        }else{
           $autoSaleNo = "".$lastnumber."/".$yeartag;
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


  public function getAcToBeCredited($companyid)
  {
    $data = array();
    $where = array(
                   // 'account_group.group_category' =>'PROFIT & LOSS',
                   // 'account_group.bal_pl_item' =>'INCOME',
                    'account_master.company_id' =>$companyid,

                 );
    $this->db->select("*")
        ->from('account_master')
        ->join('group_master','group_master.id=account_master.group_id','INNER')
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



  public function getAcToBeDebited($companyid)
  {
    $data = array();
    $where = array(
                    'group_master.main_category' =>'P',
                    'group_master.sub_category' =>'I',
                    'account_master.company_id' =>$companyid,

                 );
    $this->db->select("*")
        ->from('account_master')
        ->join('group_master','group_master.id=account_master.group_id','INNER')
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



  public function insertIntoVoucher($party_bill_no,$dataArry,$party_bill_master_id){

  	try {

  			   $session = $this->session->userdata('user_detail');
               $company=$session['companyid'];
               $year=$session['yearid'];

  	           $party_bill_date = trim(htmlspecialchars($dataArry['party_bill_date']));

  			 if($party_bill_date!=""){
                $party_bill_date = str_replace('/', '-', $party_bill_date);
                $party_bill_date = date("Y-m-d",strtotime($party_bill_date)); 
             }
             else{
                 $party_bill_date = NULL;
                
             }

  		
  	           $voucherMast['voucher_no'] = $party_bill_no; 
               $voucherMast['voucher_date'] = date("Y-m-d", strtotime($party_bill_date));
               $voucherMast['narration'] = "Party Bill Invoice No ".$voucherMast['voucher_no']." Date ".date("d-m-Y", strtotime($party_bill_date));  
                    
               $voucherMast['tran_type'] = 'PRT';         
               $voucherMast['user_id'] = $session['userid'];   
               $voucherMast['year_id'] =  $year;       
               $voucherMast['company_id'] = $company;


                  $this->db->trans_begin();
                  $this->db->insert('voucher_master', $voucherMast);
                  $vMastId = $this->db->insert_id();

                  $this->insertintoVouchrDtl($vMastId,$dataArry);


                  $where_party_mst = array('party_bill_master.id' => $party_bill_master_id );
                  $party_master = array('voucher_id' => $vMastId);
                  $this->db->update('party_bill_master', $party_master,$where_party_mst);




            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $vMastId;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }         


  }


     public function insertintoVouchrDtl($vMastId,$searcharray){
            
       $this->deleteVoucherDetailData($vMastId);

      
          $cgstarray=array();
          $sgstarray =array();
     
       $debitAccId = $searcharray['select_dr_ac'];
       $netamountTotal = $searcharray['final_total'];

       $slno=1;

                       
                       $vouchrDtlCus['voucher_master_id'] = $vMastId;
                       $vouchrDtlCus['srl_no'] = $slno++;
                       $vouchrDtlCus['tran_tag'] ='Dr' ;
                       $vouchrDtlCus['account_master_id'] = $debitAccId;
                       $vouchrDtlCus['amount'] = $netamountTotal;   
                       $this->db->insert('voucher_detail', $vouchrDtlCus);


        if (isset($searcharray['tennisitemrow'])) {
        	
	       $noftennisitemrowDtl = count($searcharray['tennisitemrow']);

	           $select_kot_ac = $searcharray['select_kot_ac'];
	           $taxableTotal=0;
               $netamountTotal=0;

	       for ($i=0; $i <$noftennisitemrowDtl ; $i++) {      
	              $taxableTotal+=$searcharray['itemtaxablerow'][$i];
	              $netamountTotal+=$searcharray['item_netamtrow'][$i];
	            }

                      
                       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = $slno++;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $select_kot_ac;
                       $vouchrDtlSale['amount'] = $taxableTotal;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);


                     
                       for ($i = 0; $i < $noftennisitemrowDtl; $i++) {
                            $cgstarray[] =array("id"=>$searcharray['item_cgst_raterow'][$i],"cgstamount"=>$searcharray['item_cgst_amtrow'][$i]);
                            $sgstarray[] = array("id"=>$searcharray['item_sgst_raterow'][$i],"sgstamount"=>$searcharray['item_sgst_amtrow'][$i]);
                          
                       }



        }


        	 if (isset($searcharray['bottennisitemrow'])) {

        	 		   $nofBOTrowDtl = count($searcharray['bottennisitemrow']);
        	 		   $taxableTotalbot=0;
              		   $netamountTotalbot=0;

              		    $select_bot_ac = $searcharray['select_bot_ac'];

	        	   for ($i=0; $i <$nofBOTrowDtl ; $i++) {      
		              $taxableTotalbot+=$searcharray['botitemtaxablerow'][$i];
		              $netamountTotalbot+=$searcharray['botitem_netamtrow'][$i];
		            }

		             
                       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = $slno++;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $select_bot_ac;
                       $vouchrDtlSale['amount'] = $taxableTotalbot;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);

                       for ($i = 0; $i < $nofBOTrowDtl; $i++) {
                            $cgstarray[] =array("id"=>$searcharray['botitem_cgst_raterow'][$i],"cgstamount"=>$searcharray['botitem_cgst_amtrow'][$i]);
                            $sgstarray[] = array("id"=>$searcharray['botitem_sgst_raterow'][$i],"sgstamount"=>$searcharray['botitem_sgst_amtrow'][$i]);
                          
                       }



        	 }


        	 if ($searcharray['hall_charges']!='') {

        	 	 $select_hall_ac = $searcharray['select_hall_ac'];
        	 	 $hall_charges = $searcharray['hall_charges'];

        	 	       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = $slno++;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $select_hall_ac;
                       $vouchrDtlSale['amount'] = $hall_charges;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);

                      $cgstarray[] =array("id"=>$searcharray['hall_cgst_rate'],"cgstamount"=>$searcharray['hall_cgst_amt']);
                      $sgstarray[] = array("id"=>$searcharray['hall_sgst_rate'],"sgstamount"=>$searcharray['hall_sgst_amt']);


        	 }



        	 if ($searcharray['guest_amt']!='') {

        	 	 $select_guest_ac = $searcharray['select_guest_ac'];
        	 	 $guest_amt = $searcharray['guest_amt'];

        	 	       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = $slno++;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $select_guest_ac;
                       $vouchrDtlSale['amount'] = $guest_amt;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);

                      $cgstarray[] =array("id"=>$searcharray['guest_cgst_rate'],"cgstamount"=>$searcharray['guest_cgst_amt']);
                      $sgstarray[] = array("id"=>$searcharray['guest_sgst_rate'],"sgstamount"=>$searcharray['guest_sgst_amt']);


        	 }

        	 if ($searcharray['deco_chages']!='') {

        	 	 $select_deco_ac = $searcharray['select_deco_ac'];
        	 	 $deco_chages = $searcharray['deco_chages'];

        	 	       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = $slno++;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $select_deco_ac;
                       $vouchrDtlSale['amount'] = $deco_chages;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);

        	  }

        	  if ($searcharray['electric_charges']!='') {

        	 	 $select_electric_ac = $searcharray['select_electric_ac'];
        	 	 $electric_charges = $searcharray['electric_charges'];

        	 	       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = $slno++;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $select_electric_ac;
                       $vouchrDtlSale['amount'] = $electric_charges;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);

        	  }


        	   if ($searcharray['other_charges']!='') {

        	 	 $select_other_ac = $searcharray['select_other_ac'];
        	 	 $other_charges = $searcharray['other_charges'];

        	 	       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = $slno++;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $select_other_ac;
                       $vouchrDtlSale['amount'] = $other_charges;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);

        	  }






        	 /* ------------------- CGST SGST ----------------------------*/

        	           $groups = array();
                    $key = 0;
                    foreach ($cgstarray as $item) {
                        $key = $item['id'];
                        if (!array_key_exists($key, $groups)) {
                            $groups[$key] = array(
                                'id' => $item['id'],
                                'cgstamount' => $item['cgstamount']
                                
                            );
                        } else {
                           
                            $groups[$key]['cgstamount'] = $groups[$key]['cgstamount'] + $item['cgstamount'];
                        }
                        $key++;
                    }

                  
                    foreach ($groups as $value) {
                       // echo ($value["id"]."||".$value["cgstamount"] );
                        $this->GSTinsertionOnVoucherDetails($vMastId, $value["id"], $value["cgstamount"], "CGST",$slno++);
                    }
                    /*******************SGST******************************/
                     $groups = array();
                     $key = 0;
                    foreach ($sgstarray as $item) {
                        $key = $item['id'];
                        if (!array_key_exists($key, $groups)) {
                            $groups[$key] = array(
                                'id' => $item['id'],
                                'sgstamount' => $item['sgstamount']
                                
                            );
                        } else {
                           
                            $groups[$key]['sgstamount'] = $groups[$key]['sgstamount'] + $item['sgstamount'];
                        }
                        $key++;
                    }
                     foreach ($groups as $value) {
                       // echo ($value["id"]."||".$value["cgstamount"] );
                        $this->GSTinsertionOnVoucherDetails($vMastId, $value["id"], $value["sgstamount"], "SGST",$slno++);
                    }



              //update voucher amount

               $total_dr_amt =$this->getVoucherAmtByTag($vMastId,'Dr');
               $total_cr_amt =$this->getVoucherAmtByTag($vMastId,'Cr');

               $voucher_master = array(
                                        'total_dr_amt' => $total_dr_amt,
                                        'total_cr_amt' => $total_cr_amt
                                       );
               $where_voucher_mst = array('voucher_master.id' => $vMastId );
               $this->db->update('voucher_master', $voucher_master,$where_voucher_mst);







   }



   public function deleteVoucherDetailData($voucherId){
        
         $this->db->where('voucher_master_id', $voucherId);
         $this->db->delete('voucher_detail');
   }


      private function GSTinsertionOnVoucherDetails($vouchermasterId,$gstId,$gstAmount,$gstType,$slno){

       $sql="SELECT gstmaster.accountId
                FROM gstmaster
             WHERE gstmaster.id =".$gstId." AND gstmaster.gstType ='".$gstType."'";
       if($gstId!=0){
        $accountId = $this->db->query($sql)->row()->accountId;
       }
       if($gstId!=0){
                $vouchrDtl['voucher_master_id'] = $vouchermasterId;
                $vouchrDtl['srl_no'] = $slno;
                $vouchrDtl['tran_tag'] ='Cr' ;
                $vouchrDtl['account_master_id'] = $accountId;
                $vouchrDtl['amount'] = $gstAmount;
              
           
                $this->db->insert('voucher_detail', $vouchrDtl);
       }
   }




  public function getVoucherAmtByTag($voucher_mst_id,$tag)
  {
    $data = 0;
    $where = array(
            'voucher_detail.voucher_master_id' => $voucher_mst_id, 
            'voucher_detail.tran_tag' => $tag, 
           
          );
    $this->db->select("
               COALESCE(SUM(voucher_detail.amount),0) AS amount,
                ",FALSE)
        ->from('voucher_detail')
        ->where($where)
        ->limit(1);
    $query = $this->db->get();
    
    #echo $this->db->last_query();
    
    if($query->num_rows()> 0)
    {
           $row = $query->row();
           return $data = $row->amount;
             
        }
    else
    {
            return $data;
        }
  }



    public function getPartyBillList($from_dt,$to_dt,$member_id)
    {
        $data = array();


        if ($member_id=='All') {
            $where_member = [];
        }else{
            $where_member = array('party_bill_master.member_id' => $member_id ); 
        }
       
                $this->db->select("party_bill_master.*,member_master.member_name,member_master.member_code")
                ->from('party_bill_master')
                ->join('member_master','member_master.member_id = party_bill_master.member_id','INNER')
                ->where('DATE_FORMAT(`party_bill_master`.`party_bill_date`,"%Y-%m-%d") >= ', $from_dt)
                ->where('DATE_FORMAT(`party_bill_master`.`party_bill_date`,"%Y-%m-%d") <= ', $to_dt)
                ->where($where_member);
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



    public function getPartyBillDetails($partybill_master_id,$category)
    {
        $data = array();

        $where = array(
        				'bill_mst_id' => $partybill_master_id, 
        				'category' => $category, 
        				);
      
       
                $this->db->select("party_bill_details.*,item_master.item_name,cgst.rate AS cgst_rate,sgst.rate AS sgst_rate")
                ->from('party_bill_details')
                ->join('item_master','item_master.item_id = party_bill_details.item_id','INNER')
                ->join('gstmaster as cgst','cgst.id=party_bill_details.cgst_rate_id','left')
                ->join('gstmaster as sgst','sgst.id=party_bill_details.sgst_rate_id','left')
                ->where($where);
        $query = $this->db->get();
       # echo $this->db->last_query();

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



    public function getPartyMasterData($party_master_id)
	{
		$data = array();

		 $where = [
                    'party_bill_master.id' => $party_master_id
                ];


		$this->db->select("party_bill_master.*,member_master.title_one,member_master.member_name")
				->from('party_bill_master')
				->join('member_master','member_master.member_id = party_bill_master.member_id','INNER')
				->where($where)
				->limit(1);
		$query = $this->db->get();
		
		#echo "<br>".$this->db->last_query();
		
		if($query->num_rows()> 0)
		{
           $row = $query->row();
           return $data = $row;
             
        }
		else
		{
            return $data;
        }
	}


  public function updateIntoVoucher($dataArry,$party_bill_master_id,$voucherID){

  	try {

  			   $session = $this->session->userdata('user_detail');
               $company=$session['companyid'];
               $year=$session['yearid'];

  	 
                  $this->insertintoVouchrDtl($voucherID,$dataArry);



            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $voucherID;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }         


  }





    
} // end of class