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
                foreach ($memberReceiptList as $memberreceiptlist) { 
                  if ($memberreceiptlist->total_amount!='') {
                   $total+=$memberreceiptlist->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $memberreceiptlist->mem_receipt_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($memberreceiptlist->receipt_date)); ?></td>
                   <td><?php echo $memberreceiptlist->member_code; ?></td>
                   <td><?php echo $memberreceiptlist->member_name; ?></td>
                
                  
                   <td align="right"><?php echo $memberreceiptlist->total_amount; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>memberreceipt/addReceipt/<?php echo $memberreceiptlist->receipt_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">