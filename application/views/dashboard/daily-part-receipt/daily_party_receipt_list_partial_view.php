 <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Receipt no</th>
                    <th>Receipt dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                  
                    <th>Total Amt</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($partyReceiptList as $partyreceiptlist) { 
                  if ($partyreceiptlist->total_amount!='') {
                   $total+=$partyreceiptlist->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $partyreceiptlist->mem_receipt_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($partyreceiptlist->receipt_date)); ?></td>
                   <td><?php echo $partyreceiptlist->member_code; ?></td>
                   <td><?php echo $partyreceiptlist->member_name; ?></td>
                
                  
                   <td align="right"><?php echo $partyreceiptlist->total_amount; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>partyreceipt/addReceipt/<?php echo $partyreceiptlist->receipt_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                    <a href="<?php echo base_url(); ?>partyreceipt/partyreceiptprintJasper/<?php echo $partyreceiptlist->receipt_id; ?>" target="_blank" class="btn tbl-action-btn padbtn" style="padding-right:7px;">
                      <i class="fas fa-print"></i> 
                    </a>
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>"