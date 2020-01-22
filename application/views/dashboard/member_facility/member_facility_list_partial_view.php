 <div id="facility_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Guest</th>
                    <th>Taxable</th>
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
                foreach ($facilityTranList as $facilitylist) { 
                  if ($facilitylist->total_amount!='') {
                   $total+=$facilitylist->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $facilitylist->tran_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($facilitylist->tran_dt)); ?></td>
                   <td><?php echo $facilitylist->member_code; ?></td>
                   <td><?php echo $facilitylist->member_name; ?></td>
                   <td><?php echo $facilitylist->quantity; ?></td>
                   <td align="right" ><?php echo $facilitylist->rate; ?></td>
                   <td align="right"><?php echo $facilitylist->guest_charge; ?></td>
                   <td align="right"><?php echo $facilitylist->taxable; ?></td>
                   <td align="right"><?php echo $facilitylist->cgst_amt; ?></td>
                   <td align="right"><?php echo $facilitylist->sgst_amt; ?></td>
                   <td align="right"><?php echo $facilitylist->total_amount; ?></td>
                   <td>
                         <a href="<?php echo base_url(); ?>memberfacility/addFacility/<?php echo $entry_module."/".$facilitylist->transaction_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                        
                      </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>