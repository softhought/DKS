    
               <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Day</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Time</th>
                    <th>Court No</th>
                    <th>Hr. Amt</th>
                    <th>CGST Amt</th>
                    <th>SGST Amt</th>
                    <th>Total Amt</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($fixedhrdcourtList as $fixhrdcourtlist) { 
                  if ($fixhrdcourtlist->total_amount!='') {
                   $total+=$fixhrdcourtlist->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $fixhrdcourtlist->tran_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($fixhrdcourtlist->tran_dt)); ?></td>
                   <td><?php echo $fixhrdcourtlist->member_code; ?></td>
                   <td><?php echo $fixhrdcourtlist->member_name; ?></td>
                   <td><?php echo $fixhrdcourtlist->day_code; ?></td>
                   <td ><?php echo $fixhrdcourtlist->day_night; ?></td>
                   <td ><?php echo $fixhrdcourtlist->single_double; ?></td>
                   <td ><?php echo date('h:i A', strtotime($fixhrdcourtlist->from_time))." - ".date('h:i A', strtotime($fixhrdcourtlist->to_time));?></td>
                   <td ><?php echo $fixhrdcourtlist->court_no; ?></td>
                   <td align="right"><?php echo $fixhrdcourtlist->taxable; ?></td>
                   <td align="right"><?php echo $fixhrdcourtlist->cgst_amt; ?></td>
                   <td align="right"><?php echo $fixhrdcourtlist->sgst_amt; ?></td>
                  
                   <td align="right"><?php echo $fixhrdcourtlist->total_amount; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>memberfacility/addFixedHardCourt/<?php echo $fixhrdcourtlist->ftran_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
            