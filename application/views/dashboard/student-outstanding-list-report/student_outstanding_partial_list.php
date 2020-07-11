<table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No&emsp;&emsp;</th>
                    <th>Student Name</th>
                    <th>Student Code</th>
                   <!--  <th>Billing Style</th> -->
                   <?php if($billing_style == 'M'){ ?>
                    <th>Month</th>
                   <?php }else{  ?>
                    <th>Quarter</th>
                   <?php } ?>
                    <th>Billing Amount</th>
                    <th>Payment Amt.</th>
                    <th>Outstanding Amt.</th>
                    <th>Mobile No.</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                  <?php  $i=1;$total_billamt=0;$total_payamt = 0;$total_outstanding = 0;
                  foreach ($studsoutstandinglist as $studsoutstandinglist) { 

                     $total_billamt =  $total_billamt + $studsoutstandinglist->total_amount;
                     $total_payamt =  $total_payamt + $studsoutstandinglist->payment_amt;
                     $total_outstanding =  $total_outstanding + $studsoutstandinglist->outstanding_amt;

                    ?>

                   <tr>
                     <td><?php echo $i++; ?></td>
                     <td><?php echo $studsoutstandinglist->student_name; ?></td>
                     <td><?php echo $studsoutstandinglist->student_code; ?></td>
                    
                    <td><?php echo $studsoutstandinglist->month_qurtername; ?></td>       
                       <td style="text-align: right;"><?php echo $studsoutstandinglist->total_amount; ?></td>       
                       <td  style="text-align: right;"><?php echo $studsoutstandinglist->payment_amt; ?></td>       
                       <td  style="text-align: right;"><?php echo $studsoutstandinglist->outstanding_amt; ?></td>       
                       <td><?php echo $studsoutstandinglist->phone_one; ?></td>       
                     
                             
                     
                     
                   </tr>


                    
                 <?php   } ?>

                                   
                         
                </tbody>
              </table>
              <input type="hidden" id="totalbill_amt" value="<?php echo number_format($total_billamt,2); ?>" >
              <input type="hidden" id="total_payment_amt" value="<?php echo number_format($total_payamt,2); ?>" >
              <input type="hidden" id="total_outstand_amt" value="<?php echo number_format($total_outstanding,2); ?>" >
            