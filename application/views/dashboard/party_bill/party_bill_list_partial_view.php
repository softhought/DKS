 <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Partybill no</th>
                    <th>Partybill dt.</th>
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
                foreach ($partyBillList as $partybillist) { 
                  if ($partybillist->final_total!='') {
                   $total+=$partybillist->final_total;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $partybillist->party_bill_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($partybillist->party_bill_date)); ?></td>
                   <td><?php echo $partybillist->member_code; ?></td>
                   <td><?php echo $partybillist->member_name; ?></td>
                
                  
                   <td align="right"><?php echo $partybillist->final_total; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>memberfacility/addFacility/<?php echo $partybillist->id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">