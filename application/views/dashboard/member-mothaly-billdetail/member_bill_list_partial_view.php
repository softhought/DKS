<table id="mmemexample" class="table customTbl table-bordered table-striped">
                <thead>
                    <tr>
                    <th style="width:55px;">Sl.No</th>
                    <th style="width:100px;">Bill No.</th>
                    <th style="width:100px;">Bill dt.</th>
                    <th style="width:100px;">Member Code</th>
                    <th style="width:150px;">Member Name</th>
                    <th style="width:70px;">Month</th>
                    <th style="width:100px;">Opening Bal.</th>
                    <th style="width:100px;">Monthly Sub</th>
                    <th style="width:100px;">Bar Amt.</th>
                    <th style="width:100px;">Bar GST</th>
                    <th style="width:100px;">Canteen Amt.</th>
                    <th style="width:100px;">Canteen GST</th>
                    <th style="width:100px;">Swimming</th>
                    <th style="width:100px;">GYM</th>
                    <th style="width:120px;">Locker Charges</th>
                    <th style="width:130px;">Hard Court Extra</th>
                    <th style="width:110px;">Guest Charges</th>
                    <th style="width:110px;">Towel Charges</th>
                    <th style="width:110px;">Benvolent Fund</th>
                    <th style="width:130px;">Fixed Hard Court</th>
                    <th style="width:90px;">Card Play</th>
                    <th style="width:120px;">Devlopment Chrg.</th>
                    <th style="width:110px;">Puja Contribution</th>
                    <th style="width:70px;">Corrections</th>
                    <th style="width:90px;">Receipts Amt.</th>
                    <th style="width:100px;">Min Bill Amt.</th>
                    <th style="width:140px;">GST On Outgoing Chrg.</th>
                    <th style="width:130px;">Outstanding Amt.</th>
                  
          
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($billList as $billlist) { 
                  if ($billlist->net_amount!='') {
                   $total+=$billlist->net_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $billlist->member_bill_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($billlist->bill_date)); ?></td>
                   <td><?php echo $billlist->member_code; ?></td>
                   <td><?php echo $billlist->member_name; ?></td>
                   <td><?php echo $billlist->month_name; ?></td>
                   <td align="right"><?php echo $billlist->month_open; ?></td>
                   <td align="right"><?php echo $billlist->month_subs; ?></td>
                   <td align="right"><?php echo $billlist->bar_amount; ?></td>
                   <td align="right"><?php echo $billlist->bar_cgst + $billlist->bar_sgst; ?></td>
                   <td align="right"><?php echo $billlist->cat_amount; ?></td>
                   <td align="right"><?php echo $billlist->cat_cgst + $billlist->cat_sgst; ?></td>
                   <td align="right"><?php echo $billlist->swimming; ?></td>
                   <td align="right"><?php echo $billlist->gym; ?></td>
                   <td align="right"><?php echo $billlist->locker_charge; ?></td>
                   <td align="right"><?php echo $billlist->hard_court_extra; ?></td>
                   <td align="right"><?php echo $billlist->guest_charge; ?></td>
                   <td align="right"><?php echo $billlist->towel_charge; ?></td>
                   <td align="right"><?php echo $billlist->ben_fund; ?></td>
                   <td align="right"><?php echo $billlist->fixed_hard; ?></td>
                   <td align="right"><?php echo $billlist->card_play; ?></td>
                   <td align="right"><?php echo $billlist->development_charge; ?></td>
                   <td align="right"><?php echo $billlist->puja_contribution; ?></td>
                   <td align="right"><?php echo $billlist->corrections; ?></td>
                   <td align="right"><?php echo $billlist->receipt_amt; ?></td>
                   <td align="right"><?php echo $billlist->min_bill_amt; ?></td>
                   <td align="right"><?php echo $billlist->outgoing_cgst + $billlist->outgoing_sgst; ?></td>
                   <td align="right"><?php echo $billlist->net_amount; ?></td>
                
                 
                   
                  

               
                
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
                <tfoot>
            <tr>
                <th colspan="6">Total&nbsp;:<br>&nbsp;Net Amt&nbsp;:</th>
                 <!-- <th></th>
                <th></th>
                <th></th>
                <th></th> 
                 <th></th> -->
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
              </table>