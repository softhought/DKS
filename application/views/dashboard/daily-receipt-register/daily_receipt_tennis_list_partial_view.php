<table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                     <th align="left">Sl.No</th>
                    <th align="left" >Payment Mode</th>

                    
                    <th align="left"  >Code</th>
                    <th align="left"  >Name</th>
                    <th align="left"  >Payment Date</th>
                   <!--  <th align="left"  >Tran. Type</th> -->

                    <th align="right"  >Amount</th>
                    
                    
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($tennisReceiptList as $tennisReceiptlist) {

                if ($tennisReceiptlist['masterData']->total_amount!='') {
                 
                  if ($tennisReceiptlist['masterData']->total_amount!='') {
                   $total+=$tennisReceiptlist['masterData']->total_amount;
                  }
                   
                   foreach ($tennisReceiptlist['detailsData'] as $detailsData) {
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $detailsData->payment_mode; ?></td>
                   <td><?php echo $detailsData->student_code; ?></td>
                   <td><?php echo $detailsData->title_one." ".$detailsData->student_name; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($detailsData->payment_date)); ?></td>
                <!--    <td align="left"><?php 

                          if ($detailsData->transaction_type=='ORADM') {
                            echo "Other Receipts(Admission)";
                          }else if($detailsData->transaction_type=='ORITM'){
                            echo "Other Receipts(Item)";
                          }else if($detailsData->transaction_type=='RCFS'){
                             echo "Receivable From Student";
                          }

                    ?></td> -->
                   <td align="right"><?php echo $detailsData->payment_amount; ?></td>
          
                       
               
                   

                 </tr>
                <?php
                      }


                 }  } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">