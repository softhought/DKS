<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentadvancemodel extends CI_Model{

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
        ->where($where)
        ->order_by("account_master.account_name", "asc");
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
                   // 'account_group.group_category' =>'PROFIT & LOSS',
                   // 'account_group.bal_pl_item' =>'INCOME',
                    'account_master.company_id' =>$companyid,

                 );
    $this->db->select("*")
        ->from('account_master')
        ->join('group_master','group_master.id=account_master.group_id','INNER')
        ->where($where)
        ->order_by("account_master.account_name", "asc");
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
        if($digit==4){
            $autoSaleNo = $tag."/0".$lastnumber."/".$yeartag;
        }else if($digit==3){
            $autoSaleNo = $tag."/00".$lastnumber."/".$yeartag;
        }else if($digit==2){
            $autoSaleNo = $tag."/000".$lastnumber."/".$yeartag;
        }elseif($digit==1){
            $autoSaleNo = $tag."/0000".$lastnumber."/".$yeartag;
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



public function getLoanList($yearid)
{
    $data = array();
    $where = array(
                     'loan_master.year_id' =>$yearid,
                  );
    $this->db->select("loan_master.*,employee_master.name")
        ->from('loan_master')
        ->join('employee_master','employee_master.empl_id=loan_master.employee_id','INNER')
        ->where($where)
        ->order_by("loan_master.payment_adv_id", "asc");
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




public function getLoanListForAdjustment($month,$yearid,$yearmonth)
{
    $data = array();
    $where = array(
                     'loan_master.year_id' =>$yearid,
                  );
    $this->db->select("loan_master.*,employee_master.name")
        ->from('loan_master')
        ->join('employee_master','employee_master.empl_id=loan_master.employee_id','INNER')
        ->where($where)
        ->where('DATE_FORMAT(`loan_master`.`date_of_advance`,"%Y-%m") <= ', $yearmonth)
        ->order_by("loan_master.payment_adv_id", "asc");
    $query = $this->db->get();
    #echo $this->db->last_query();

    if($query->num_rows()> 0)
    {
    
    foreach ($query->result() as $rows)
    {
      //  $data[] = $rows;

        $balance=0;
        $adjAmount=$rows->monthly_deduct_amt;

        $LoanAdjData=$this->getTotalAdjustmentAmount($rows->employee_id,$yearid,$month);



        if ($LoanAdjData) {
            $balance=$rows->adv_amount-$LoanAdjData->adjusted_total_amount;
        }

        $LoanAdjEmp=$this->getAdjustmentDetailsByEmployee($rows->employee_id,$yearid,$month);

        if ($LoanAdjEmp) {
            $balance=$LoanAdjEmp->balance;
            $adjAmount=$LoanAdjEmp->adjusted_amt;
        }

            if ($balance>0) {

                $data[]=[
                
                    "memberData"=>$rows,
                    "balance"=>$balance,
                    "adjAmount"=>$adjAmount,
                         
                    ];
            }
            


    }
            return $data;
             
        }
    else
    {
             return $data;
         }
}




public function getTotalAdjustmentAmount($employeeid,$year_id,$month)
{
        $data = array();
        $where = array(
                        'loan_adjustment.employee_id' => $employeeid,
                        'loan_adjustment.year_id' => $year_id,
                      );
        $this->db->select("
                            IFNULL(SUM(loan_adjustment.adjusted_amt),0) AS adjusted_total_amount,
                         ")
                ->from('loan_adjustment')
                //->where('DATE_FORMAT(`member_receipt`.`receipt_date`,"%Y-%m-%d") >= ', $fromDt)
                ->where($where)
                ->where('loan_adjustment.month_id !=',$month)
                ->limit(1);
        $query = $this->db->get();
        // if ($member_id==1441) {
        //  echo "<br>".$this->db->last_query();
        // }
        
        
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


public function getAdjustmentDetailsByEmployee($employeeid,$year_id,$month)
    {
        $data = array();

        $where = array(
                        'loan_adjustment.employee_id' => $employeeid,
                        'loan_adjustment.year_id' => $year_id,
                        'loan_adjustment.month_id' => $month,
                      );

        $this->db->select("*")
                ->from('loan_adjustment')
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








} //end of class