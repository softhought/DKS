 <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Order no</th>
                    <th>Order dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($orderList as $orderlist) { 
                  if ($orderlist->total_to_be_paid!='') {
                   $total+=$orderlist->total_to_be_paid;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $orderlist->order_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($orderlist->order_date)); ?></td>
                   <td><?php echo $orderlist->member_code; ?></td>
                   <td><?php echo $orderlist->member_name; ?></td>
             
                   <td ><?php if ($orderlist->category=='CAT') {
                     echo "CANTEEN";
                   }else{
                     echo "BAR";
                    } ?></td>
                   <td align="right"><?php echo $orderlist->total_to_be_paid; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>order/addOrder/<?php echo $orderlist->order_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">