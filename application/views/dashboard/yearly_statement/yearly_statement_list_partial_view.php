<!--   
<div class="row">
     <div class="col-sm-2">
                     <div class="form-group">
                            <button type="button" class="btn btn-block action-button btn-sm noprint" id="printbtn" style="width: 60%;">Print</button>
                            </div>
                         

                          </div>
                       
                    </div> -->

<div id="print_bill_yearly">


  <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th >Month</th>
                    <th style="text-align: center;" >Open Bal</th>
                    <th style="text-align: center;">Bill Amt</th>
                    <th style="text-align: center;">Payment</th>               
                    <th style="text-align: center;">Outstanding</th>
                  
          
                </thead>
                <tbody>

                <?php 
                $billtotal=0;
                $paymenttotal=0;
                $i=1;
                foreach ($billList as $billlist) { 

                   $billtotal += ($billlist->net_amount+$billlist->receipt_amt);
                   $paymenttotal += $billlist->receipt_amt;
                   
                  ?>
                   <tr>
                   <td><?php echo $billlist->short_name; ?></td>
                   <td align="right"><?php echo number_format($billlist->month_open,2); ?></td>
                   <td align="right"><?php 
                   echo number_format(($billlist->net_amount+$billlist->receipt_amt),2); ?></td>
                   <td align="right"><?php echo number_format($billlist->receipt_amt,2); ?></td>
                 
                   <td align="right"><?php echo number_format($billlist->net_amount,2); ?></td>
                   
                  
      
                 </tr>
                <?php } ?>
                <tr style="font-weight: bold;">
                  <td> Total</td>
                  <td> &nbsp;</td>
                  <td align="right"><?php echo number_format($billtotal,2);?></td>
                  <td align="right"><?php echo number_format($paymenttotal,2);?></td>
                  <td></td>
                </tr>                       
                         
                </tbody>
              </table>

  </div>            
             