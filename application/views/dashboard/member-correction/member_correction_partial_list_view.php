<table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Correction No</th>
                    <th>Correction dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Description</th>
                    <th>Amount</th>
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
                foreach ($correctionTranList as $correctionTranList) { 
                  if ($correctionTranList->total_amount!='') {
                   $total+=$correctionTranList->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $correctionTranList->cor_tran_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($correctionTranList->tran_date)); ?></td>
                   <td><?php echo $correctionTranList->member_code; ?></td>
                   <td><?php echo $correctionTranList->member_name; ?></td>
                   <td><?php echo $correctionTranList->descrtion_name; ?></td>
                  
                   <td align="right"><?php echo $correctionTranList->taxable; ?></td>
                   <td align="right"><?php echo $correctionTranList->cgst_amt; ?></td>
                   <td align="right"><?php echo $correctionTranList->sgst_amt; ?></td>
                  
                   <td align="right"><?php echo $correctionTranList->total_amount; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>membercorrection/addmembercorrection/<?php echo $correctionTranList->mem_cor_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">