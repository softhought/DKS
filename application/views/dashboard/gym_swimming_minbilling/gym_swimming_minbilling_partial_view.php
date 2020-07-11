     <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Account</th>
                    <th>Amount</th>
                   
          
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($kotList as $kotlist) { 
                  if ($kotlist->kot_amount!='') {
                   $total+=$kotlist->kot_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $kotlist->kot_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($kotlist->kot_date)); ?></td>
                   <td><?php echo $kotlist->member_code; ?></td>
                   <td><?php echo $kotlist->member_name; ?></td>
                   <td><?php echo $kotlist->account_name; ?></td>
                   <td><?php echo $kotlist->kot_amount; ?></td>
                  
               
                
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">