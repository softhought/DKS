<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paymenttennismodel extends CI_Model{


  public function getNewCodeSerial($startLetters)
  {
    $data = array();
    $this->db->select("SUBSTRING(student_code, 4) as last_serial")
        ->from('admission_register')
        ->where("student_code LIKE '%$startLetters%'")
        ->order_by('student_code', 'desc')
        ->limit(1);
    $query = $this->db->get();
    
    #echo $this->db->last_query();
    
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



  public function getAcToBeCredited($companyid)
  {
    $data = array();
    $where = array(
                    'account_group.group_category' =>'PROFIT & LOSS',
                    'account_group.bal_pl_item' =>'INCOME',
                    'account_master.company_id' =>$companyid,

                 );
    $this->db->select("*")
        ->from('account_master')
        ->join('account_group','account_group.ac_grp_id=account_master.ac_grp_id','INNER')
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


  public function getTennisItemList($companyid)
  {
    $data = array();
    $where = array(
                    'tennis_item_master.is_active' =>'Y'                               
                 );
    $this->db->select("*")
        ->from('tennis_item_master')  
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


      /**
     * @method getGSTrate
     * @param type $companyId
     * @param type $yearId
     * @param type $type
     * @param type $usedfor
     * @return type gstData
     */
     public function getGSTrate($companyId,$yearId,$type=NULL,$usedfor=NULL){
         $gstData=array();

        $sql="SELECT gstmaster.*
                FROM gstmaster WHERE
                gstmaster.gstType ='".$type."' AND gstmaster.usedfor='".$usedfor."'
                AND gstmaster.companyid=".$companyId;

         $query = $this->db->query($sql);
         if($query->num_rows()>0){
             foreach ($query->result() as $rows) {
               

                 $gstData[] = $rows;
             }
         }
        return $gstData;
         
     }




     /* insert tennis payment details */

         /**
     * 
     * @param type $RentBillMaster
     * @param type $searcharray
     * @return boolean
     */
    public function insertDataTennisPayment($searcharray){
         try {

               $session = $this->session->userdata('user_detail');
               $company=$session['companyid'];
               $year=$session['yearid'];


               $searcharray['payment_dt'];
                if($searcharray['payment_dt']!=""){
                $payment_dt = str_replace('/', '-', $searcharray['payment_dt']);
                $payment_dt = date("Y-m-d",strtotime($payment_dt));
               }
               else{
                 $payment_dt = NULL; 
               }

                $searcharray['cheque_dt'];
                if($searcharray['cheque_dt']!=""){
                $cheque_dt = str_replace('/', '-', $searcharray['cheque_dt']);
                $cheque_dt = date("Y-m-d",strtotime($cheque_dt));
               }
               else{
                 $cheque_dt = NULL; 
               }


               $tran_type=$searcharray['tran_type'];
              
               if ($tran_type=='RCFS') {
                 $serialmodule='RECEIVABLE FROM STUDENT';
               }else{
                 $serialmodule='OTHER RECEIPT';
               }


               $receipt_no=$this->getSerialNumber($company,$year,$serialmodule);

               $voucherMast['voucher_no'] = $receipt_no; 
               $voucherMast['voucher_date'] = date("Y-m-d", strtotime($searcharray['payment_dt']));
               $voucherMast['narration'] = "Other Receipt Invoice No ".$voucherMast['voucher_no']." Date ".date("Y-m-d", strtotime($searcharray['payment_dt']));  
               $voucherMast['cheque_no'] =$searcharray['cheque_no'];         
               $voucherMast['cheque_date'] =$cheque_dt;        
               $voucherMast['bank_name'] = $searcharray['bank'];        
               $voucherMast['bank_branch'] = $searcharray['branch'];          
               $voucherMast['tran_type'] = 'RC';         
               $voucherMast['user_id'] = $session['userid'];   
               $voucherMast['year_id'] =  $year;       
               $voucherMast['company_id'] = $company;         
               
             // pre($searcharray);  

                  
                  $this->db->trans_begin();

                   

                  $this->db->insert('voucher_master', $voucherMast);
                  $vMastId = $this->db->insert_id();
                  $this->insertintoVouchrDtl($vMastId,$searcharray);

                  $paymentID = $this->insertintoPaymentMaster($searcharray,$vMastId,$payment_dt,$receipt_no);
          
          

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return $paymentID;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }


     /*@method insertintoVouchrDtl
     * @date 28-12-2019
     * @By Shankha
     */
        public function insertintoVouchrDtl($vMastId,$searcharray){
            
       $this->deleteVoucherDetailData($vMastId);
            
       $session = $this->session->userdata('user_detail');
       $company=$session['companyid'];
       $year=$session['yearid'];

       $vouchrDtlCus = array();
       $vouchrDtlSale =array();
       $vouchrDtlVat = array();

      
  
          
       $debitAccId = $searcharray['actobedebited'];
       $creditAccId = $searcharray['actobecredited'];
     
       $tran_type=$searcharray['tran_type'];

       /*************************************************************
         'ORADM' => "Other Receipts(Admission)",
         'ORITM' => "Other Receipts(Item)",
         'RCFS' => "Receivable From Student",

       ***************************************************************/

       if ($tran_type=='ORITM') {
        /* Other Receipts(Item) */
        $taxableTotal=0;
        $netamountTotal=0;
        $numberofDetails = count($searcharray['tennisitemrow']);
       
            for ($i=0; $i <$numberofDetails ; $i++) {      
              $taxableTotal+=$searcharray['itemtaxablerow'][$i];
              $netamountTotal+=$searcharray['item_netamtrow'][$i];
            }

                       /*For Customer Acc*/
                       $vouchrDtlCus['voucher_master_id'] = $vMastId;
                       $vouchrDtlCus['srl_no'] = 1;
                       $vouchrDtlCus['tran_tag'] ='Dr' ;
                       $vouchrDtlCus['account_master_id'] = $debitAccId;
                       $vouchrDtlCus['amount'] = $netamountTotal;   
                       $this->db->insert('voucher_detail', $vouchrDtlCus);


                       /* For Sale Acc */
                       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = 2;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $creditAccId;
                       $vouchrDtlSale['amount'] = $taxableTotal;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);


                  /*------------------------------------------------------------------------------------------------*/     
                       // for GST(cgst+sgst+igst)
                     
                       $cgstarray=array();
                       $sgstarray =array();
                     
                       for ($i = 0; $i < $numberofDetails; $i++) {
                            $cgstarray[] =array("id"=>$searcharray['item_cgst_raterow'][$i],"cgstamount"=>$searcharray['item_cgst_amtrow'][$i]);
                            $sgstarray[] = array("id"=>$searcharray['item_sgst_raterow'][$i],"sgstamount"=>$searcharray['item_sgst_amtrow'][$i]);
                          
                       }
                       //*************************************//
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
                        $this->GSTinsertionOnVoucherDetails($vMastId, $value["id"], $value["cgstamount"], "CGST",3);
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
                        $this->GSTinsertionOnVoucherDetails($vMastId, $value["id"], $value["sgstamount"], "SGST",4);
                    }

                /*------------------------------------------------------------------------------------------------*/



       }else if($tran_type=='ORADM'){

          $oth_rec_amtTaxable=$searcharray['oth_rec_amt'];
          $oth_rec_cgst_rate=$searcharray['oth_rec_cgst_rate'];
          $oth_rec_cgst_amt=$searcharray['oth_rec_cgst_amt'];
          $oth_rec_sgst_rate=$searcharray['oth_rec_sgst_rate'];
          $oth_rec_sgst_amt=$searcharray['oth_rec_sgst_amt'];
          $oth_rec_netamt=$searcharray['oth_rec_netamt'];

                       /* For Customer Acc */
                       $vouchrDtlCus['voucher_master_id'] = $vMastId;
                       $vouchrDtlCus['srl_no'] = 1;
                       $vouchrDtlCus['tran_tag'] ='Dr' ;
                       $vouchrDtlCus['account_master_id'] = $debitAccId;
                       $vouchrDtlCus['amount'] = $oth_rec_netamt;   
                       $this->db->insert('voucher_detail', $vouchrDtlCus);


                       /* For Sale Acc */
                       $vouchrDtlSale['voucher_master_id'] = $vMastId;
                       $vouchrDtlSale['srl_no'] = 2;
                       $vouchrDtlSale['tran_tag'] ='Cr' ;
                       $vouchrDtlSale['account_master_id'] = $creditAccId;
                       $vouchrDtlSale['amount'] = $oth_rec_amtTaxable;
                       $this->db->insert('voucher_detail', $vouchrDtlSale);

                       $this->GSTinsertionOnVoucherDetails($vMastId,$oth_rec_cgst_rate,$oth_rec_cgst_amt, "CGST",3);
                       $this->GSTinsertionOnVoucherDetails($vMastId,$oth_rec_sgst_rate,$oth_rec_sgst_amt, "SGST",4);






       }else if($tran_type=='RCFS'){

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
        if($digit==3){
            $autoSaleNo = $tag."/".$lastnumber;
        }elseif($digit==2){
            $autoSaleNo = $tag."/0".$lastnumber;
        }elseif($digit==1){
            $autoSaleNo = $tag."/00".$lastnumber;
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


    public function deleteVoucherDetailData($voucherId){
        
         $this->db->where('account_master_id', $voucherId);
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


    /* @method insertintoPaymentMaster
     * @date 30-12-2019
     * By Shankha
     */
     public function insertintoPaymentMaster($searcharray,$vMastId,$payment_dt,$receipt_no){
              $session = $this->session->userdata('user_detail');
              $company=$session['companyid'];
              $year=$session['yearid'];
              $patment_mst_inst = array();
              $where = array('student_code' =>$searcharray['sel_student_code']);
            
               if($searcharray['cheque_dt']!=""){
                $cheque_dt = str_replace('/', '-', $searcharray['cheque_dt']);
                $cheque_dt = date("Y-m-d",strtotime($cheque_dt));
               }
               else{
                 $cheque_dt = NULL; 
               }


      
           
              $admission_id = $this->commondatamodel->getSingleRowByWhereCls('admission_register',$where)->admission_id;

              $patment_mst_inst['voucher_master_id']=$vMastId;
              $patment_mst_inst['payment_date']=$payment_dt;
              $patment_mst_inst['receipt_no']=$receipt_no;
              $patment_mst_inst['student_code']=$searcharray['sel_student_code'];
              $patment_mst_inst['admission_id']=$admission_id;
              $patment_mst_inst['transaction_type']=$searcharray['tran_type'];
              $patment_mst_inst['payment_mode']=$searcharray['paymentmode'];
              $patment_mst_inst['actobedebited']=$searcharray['actobedebited'];
              $patment_mst_inst['actobecredited']=$searcharray['actobecredited'];
              $patment_mst_inst['fees_quarter']=$searcharray['fees_quarter'];
              $patment_mst_inst['fees_month']=$searcharray['fees_month'];
              $patment_mst_inst['fees_year']=$searcharray['fees_month'];
              $patment_mst_inst['cheque_bank']=$searcharray['bank'];
              $patment_mst_inst['cheque_bank_branch']=$searcharray['branch'];
              $patment_mst_inst['cheque_no']=$searcharray['cheque_no'];
              $patment_mst_inst['cheque_date']=$cheque_dt;
              $patment_mst_inst['voucher_master_id']=$vMastId;
              $patment_mst_inst['company_id']=$company;
              $patment_mst_inst['year_id']=$year;

              if ($searcharray['tran_type']=='ORADM') {

              $patment_mst_inst['taxable_amount']=$searcharray['oth_rec_amt']; 
              $patment_mst_inst['cgst_id']=$searcharray['oth_rec_cgst_rate']; 
              $patment_mst_inst['cgst_amt']=$searcharray['oth_rec_cgst_amt']; 
              $patment_mst_inst['sgst_id']=$searcharray['oth_rec_sgst_rate']; 
              $patment_mst_inst['sgst_amt']=$searcharray['oth_rec_sgst_amt']; 
              $patment_mst_inst['total_amount']=$searcharray['oth_rec_netamt']; 

              }else if($searcharray['tran_type']=='RCFS'){

              }

              $this->db->insert('payment_master', $patment_mst_inst);
              $payment_id = $this->db->insert_id();



              if ($searcharray['tran_type']=='ORITM') {
               $this->insertintoSellItemDetails($searcharray,$payment_id);
              }
             
             return $payment_id; 
           
     }


    /* @method insertintoSellItemDetails
     * @date 30-12-2019
     * By Shankha
     */
     public function insertintoSellItemDetails($searcharray,$payment_id){
              $session = $this->session->userdata('user_detail');
              $company=$session['companyid'];
              $year=$session['yearid'];
              $sellItemDtl = array();

              $numberofDetails = count($searcharray['tennisitemrow']);
              $totalTaxable=0;
              $totalcgstAmt=0;
              $totalsgstAmt=0;
              $totalNetAmt=0;

              for ($i=0; $i < $numberofDetails; $i++) { 
                
                   $sellItemDtl['payment_master_id']=$payment_id;
                   $sellItemDtl['tennis_item_id']=$searcharray['tennisitemrow'][$i];
                   $sellItemDtl['quantity']=$searcharray['itemqtyrow'][$i];
                   $sellItemDtl['rate']=$searcharray['itemraterow'][$i];
                   $sellItemDtl['taxable']=$searcharray['itemtaxablerow'][$i];
                   $sellItemDtl['cgst_rate_id']=$searcharray['item_cgst_raterow'][$i];
                   $sellItemDtl['cgst_amount']=$searcharray['item_cgst_amtrow'][$i];
                   $sellItemDtl['sgst_rate_id']=$searcharray['item_sgst_raterow'][$i];
                   $sellItemDtl['sgst_amount']=$searcharray['item_sgst_amtrow'][$i];
                   $sellItemDtl['net_amount']=$searcharray['item_netamtrow'][$i];

                   $totalTaxable+=$sellItemDtl['taxable'];
                   $totalcgstAmt+=$sellItemDtl['cgst_amount'];
                   $totalsgstAmt+=$sellItemDtl['sgst_amount'];
                   $totalNetAmt+=$sellItemDtl['net_amount'];

                   $this->db->insert('sell_item_details', $sellItemDtl);
              }


                $patment_mst_upd['taxable_amount']=$totalTaxable; 
                $patment_mst_upd['cgst_amt']=$totalcgstAmt; 
                $patment_mst_upd['sgst_amt']=$totalsgstAmt; 
                $patment_mst_upd['total_amount']=$totalNetAmt; 

                $where_payment_mst = array('payment_master.payment_id' => $payment_id );
                $this->db->update('payment_master', $patment_mst_upd,$where_payment_mst);




               // return $payment_id;
              
           
     }

    

}//end of class