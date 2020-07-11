  <table id="benvolentfundList" class="table customTbl table-bordered table-hover  tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Category</th>
                  
                    
                  
                    <th>Amount</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;$total=0;
                foreach ($subscriptionList as $subscriptionlist) { 

                   if ($subscriptionlist->subscription_amount!='') {
                   $total+=$subscriptionlist->subscription_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $subscriptionlist->member_code; ?></td>
                   <td><?php echo $subscriptionlist->member_name; ?></td>
                   <td><?php echo $subscriptionlist->category_name; ?></td>
               
                  
                 
                
                 
                   <td align="right" ><?php echo number_format($subscriptionlist->subscription_amount,2); ?></td>

                 </tr>
                <?php } ?>                       
                         
                </tbody>
                <!--  <tfoot>
                           <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                          
                         
                           </tr>
                           </tfoot>  -->
              </table>

               <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">