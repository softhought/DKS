  <table class="table customTbl table-bordered table-striped dataTable2">
                <thead>
                    <tr>
                    <th>Sl.No</th>

                    <th width="10%">Member Code</th>
                    <th width="40%">Member Name</th>
                    <th>Dispatched</th>
                    <th align="right">Bill Amt</th>
                    <th align="right">Paid Amt</th>
                    <th align="right">Adjustment</th>
                    <th align="right">Outstanding</th>
                    <th align="center">
                    <input type="checkbox" class="rowCheckAll" name="rowCheckAll" id="rowCheckAll" value="Y" > Select All</th>
                  
          
                </thead>
                <tbody>

                <?php 
                $totalbillAmt=0;
                $totalpaidAmt=0;
                $totaladjustmentAmt=0;
                $totaloutstandingAmt=0;
              
                $i = 1;
                $row=1;
                foreach ($billList as $billlist) { 

                        $totalbillAmt+=$billlist['billAmount'];
                        $totalpaidAmt+=$billlist['paidAmount'];
                        $totaladjustmentAmt+=$billlist['adjustmentAmount'];
                        $totaloutstandingAmt+=$billlist['outstandingAmount'];
                  
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $billlist['memberData']->member_code; ?></td>
                   <td><?php echo $billlist['memberData']->member_name; ?></td>
                   <td><?php echo $billlist['dispatchDate']; ?></td>
                   <td align="right"><?php echo $billlist['billAmount'];?></td>
                   <td align="right"><?php echo $billlist['paidAmount'];?></td>
                   <td align="right"><?php echo $billlist['adjustmentAmount'];?></td>
                   <td align="right"><?php echo number_format($billlist['outstandingAmount'],2);?></td>
                         <td align="center">

               <input type="hidden" name="memberid_<?php echo $row;?>" id="memberid_<?php echo $row;?>" value="<?php echo $billlist['memberData']->member_id;?>" >
               <input type="checkbox" class="rowCheck" name="rowCheck[]" id="rowCheck_<?php echo $row;?>" value="<?php echo $row;?>" >
               </td>
               
                   

                 </tr>
                <?php $row++;} ?> 

                <tr style="font-weight: bold;">
                  <td colspan="4">Total</td>
                  <td align="right"><?php echo number_format($totalbillAmt,2);?></td>
                  <td align="right"><?php echo number_format($totalpaidAmt,2);?></td>
                  <td align="right"><?php echo number_format($totaladjustmentAmt,2);?></td>
                  <td align="right"><?php echo number_format($totaloutstandingAmt,2);?></td>
                  <td >&nbsp;</td>
                </tr>                      
                         
                </tbody>
              </table>
           