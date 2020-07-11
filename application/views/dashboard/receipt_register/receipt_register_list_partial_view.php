
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
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($paymentData as $paymentdata) { 
                  if ($paymentdata->payment_amount!='') {
                   $total+=$paymentdata->payment_amount;
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
                   <td><?php echo $paymentdata->payment_amount; ?></td>
                   <td><a href="<?php echo base_url(); ?>paymenttennis/addPayment/<?php echo $paymentdata->payment_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                    <?php  if ($paymentdata->transaction_type=='ORITM') { ?>
                    <a href="<?php echo base_url(); ?>paymenttennis/receiptprintJasper/<?php echo $paymentdata->payment_id; ?>/ORITM" target="_blank" class="btn tbl-action-btn padbtn" style="padding-right:7px;">
                      <i class="fas fa-print"></i> 
                    </a>
                    <?php }else{  ?>
                      <a href="<?php echo base_url(); ?>paymenttennis/receiptprintJasper/<?php echo $paymentdata->payment_id; ?>" target="_blank" class="btn tbl-action-btn padbtn" style="padding-right:7px;">
                      <i class="fas fa-print"></i> 
                    </a>
                     <a href="javascript:;" target="_blank" class="btn tbl-action-btn padbtn delReceipt"  style="padding-right:7px;" data-paymentid="<?php echo $paymentdata->payment_id; ?>">
                      <i class="fas fa-trash"> </i> 
                    </a>
                    <?php } ?></td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              