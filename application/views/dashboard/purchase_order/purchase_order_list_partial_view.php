<table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Order No</th>
                    <th>Order Dt.</th>
                    <th>Quotation No</th>
                    <th>Quotation Dt.</th>
                    <th>Total Amt</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($purchaseOrderList as $purchaseorderlist) { 
                  if ($purchaseorderlist->net_amount!='') {
                   $total+=$purchaseorderlist->net_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $purchaseorderlist->order_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($purchaseorderlist->order_date)); ?></td>
                   <td><?php echo $purchaseorderlist->quotation_no; ?></td>
                   <td><?php if($purchaseorderlist->quotation_date!=''){ echo $purchaseorderlist->quotation_date;} ?></td>
                
                  
                   <td align="right"><?php echo $purchaseorderlist->net_amount; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>purchaseorder/addPurchaseorder/<?php echo $purchaseorderlist->purchase_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                  
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">