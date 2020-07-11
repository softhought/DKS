<table id="benvolentfundList" class="table customTbl table-bordered table-hover  tablepad dataTable">
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
                foreach ($benvolentfundList as $benvolentfundlist) { 

                   if ($benvolentfundlist->total_amount!='') {
                   $total+=$benvolentfundlist->total_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $benvolentfundlist->member_code; ?></td>
                   <td><?php echo $benvolentfundlist->member_name; ?></td>
                   <td><?php echo $benvolentfundlist->category_name; ?></td>
                   <td><?php echo $benvolentfundlist->month_name; ?></td>
                  
                 
                
                 
                   <td align="right" ><?php echo $benvolentfundlist->total_amount; ?>
                     
                   </td>

                 </tr>
                <?php } ?>                       
                         
                </tbody>
                 
              </table>

              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">