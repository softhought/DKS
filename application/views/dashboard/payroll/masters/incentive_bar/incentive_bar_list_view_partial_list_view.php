<table  class="table customTbl table-bordered table-hover  tablepad dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Employee</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Action</th>   
                   
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;$total=0;
                foreach ($incentivebarList as $incentivebarlist) { 

                   if ($incentivebarlist->amount!='') {
                   $total+=$incentivebarlist->amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $incentivebarlist->emp_name; ?></td>
                   <td><?php echo $incentivebarlist->month_name; ?></td>
                   <td align="right"><?php echo $incentivebarlist->amount; ?></td>
            

                    <td>
                     <a href="<?php echo base_url(); ?>incentivebar/addIncentivebar/<?php echo $incentivebarlist->inc_id; ?>" class="btn tbl-action-btn padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                    
                  </td>

                 </tr>
                <?php } ?>                       
                         
                </tbody>
                 
              </table>

              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">