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
                foreach ($lipList as $liplist) { 

                   if ($liplist->lip_amount!='') {
                   $total+=$liplist->lip_amount;
                  }
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $liplist->emp_name; ?></td>
                   <td><?php echo $liplist->month_name; ?></td>
                   <td align="right"><?php echo $liplist->lip_amount; ?></td>
            

                    <td>
                     <a href="<?php echo base_url(); ?>lip/addLip/<?php echo $liplist->lip_tran_id; ?>" class="btn tbl-action-btn padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                    
                  </td>

                 </tr>
                <?php } ?>                       
                         
                </tbody>
                 
              </table>

              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">