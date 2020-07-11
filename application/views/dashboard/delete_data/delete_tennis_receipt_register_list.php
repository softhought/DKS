
  <section class="layout-box-content-format1">
        <div class="card card-primary">
            
           

            <div class="card-header box-shdw">
              <h3 class="card-title">Deleted Tennis Receipt</h3>

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
            

              </div> <!-- End of search block -->


              <div class="formblock-box">
                
              <div id="bill_list_details">
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
                    <th>Delete Dt.</th>
                    <th>Deleted By</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['paymentData'] as $paymentdata) { 
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

                   <td>
                    <?php 

                    if ($paymentdata->delete_date!='') {
                        echo date("d-m-Y h:i:s A", strtotime($paymentdata->delete_date));
                    }

                  

                     ?>
                    </td>
                       <td><?php echo $paymentdata->name; ?></td>
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>