<table id="devlopmentfessList" class="table customTbl table-bordered table-hover  tablepad dataTable">
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
                foreach ($devlopmentfessList as $devlopmentfessList) { 

                   if ($devlopmentfessList->total_amount!='') {
                   $total+=$devlopmentfessList->total_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $devlopmentfessList->member_code; ?></td>
                   <td><?php echo $devlopmentfessList->member_name; ?></td>
                   <td><?php echo $devlopmentfessList->category_name; ?></td>
                   <td><?php echo $devlopmentfessList->month_name; ?></td>
                  
                 
                
                 
                   <td align="right" ><?php echo $devlopmentfessList->total_amount; ?></td>

                 </tr>
                <?php } ?>                       
                         
                </tbody>
                 <!-- <tfoot>
                           <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                          
                         
                           </tr>
                           </tfoot> --> 
              </table>

               <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">