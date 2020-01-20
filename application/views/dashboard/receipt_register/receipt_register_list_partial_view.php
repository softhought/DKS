
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Tran Type</th>
                    <th>Amount</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($paymentData as $paymentdata) { 
                  if ($paymentdata->total_amount!='') {
                   $total+=$paymentdata->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $paymentdata->receipt_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($paymentdata->payment_date)); ?></td>
                   <td><?php echo $paymentdata->student_code; ?></td>
                   <td><?php echo $paymentdata->student_name; ?></td>
                   <td><?php 
                     
                   if ($paymentdata->transaction_type=='ORADM') {
                    echo "Other Receipts(Admission)";
                   }else if($paymentdata->transaction_type=='ORITM'){
                    echo "Other Receipts(Item)";
                   }else if($paymentdata->transaction_type=='RCFS'){
                    echo "Receivable From Student";
                   }

                   
                    ?></td>
                   <td><?php echo $paymentdata->total_amount; ?></td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              