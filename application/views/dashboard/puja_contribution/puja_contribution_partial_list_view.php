 <table  class="table customTbl table-bordered table-hover dataTable  tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Category</th>
                    <th>Month</th>
                  
                    
                  
                    <th>Amount</th>
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;$total=0;
                foreach ($pujacontributionList as $pujacontributionlist) { 

                   if ($pujacontributionlist->total_amount!='') {
                   $total+=$pujacontributionlist->total_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $pujacontributionlist->member_code; ?></td>
                   <td><?php echo $pujacontributionlist->member_name; ?></td>
                   <td><?php echo $pujacontributionlist->category_name; ?></td>
                   <td><?php echo $pujacontributionlist->month_name; ?></td>
               
                  
                 
                
                 
                   <td align="right" ><?php echo number_format($pujacontributionlist->total_amount,2); ?></td>

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