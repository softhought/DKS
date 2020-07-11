  <table class="table customTbl table-bordered table-striped dataTable2">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Bill No.</th>
                    <th>Bill dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Month</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Action</th>
          
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($billList as $billlist) { 
                  if ($billlist->net_amount!='') {
                   $total+=$billlist->net_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $billlist->member_bill_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($billlist->bill_date)); ?></td>
                   <td><?php echo $billlist->member_code; ?></td>
                   <td><?php echo $billlist->member_name; ?></td>
                   <td><?php echo $billlist->month_name; ?></td>
                   <td><?php echo $billlist->category_name; ?></td>
                   <td align="right"><?php echo $billlist->net_amount; ?></td>
                   
                   <td> <span  class="btn tbl-action-btn btn-xs receivableDtl" data-toggle="modal" data-target="#billModalDetails" id="bill_dtl_btn"
                    data-billid="<?php echo $billlist->bill_id; ?>" style="padding-right:7px;"  ><i class="fas fa-cog"></i> </span>
                    
                    <a href="<?php echo base_url(); ?>memberbillgenerate/memberbillprintJasper/<?php echo $billlist->bill_id; ?>" target="_blank" class="btn tbl-action-btn padbtn" style="padding-right:7px;">
                      <i class="fas fa-print"></i> 
                    </a>
                    
                    </td>
               
                
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">