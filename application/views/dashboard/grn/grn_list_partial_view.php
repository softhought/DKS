   <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>GRN No</th>
                    <th>GRN Dt.</th>
                    <th>Challan No</th>
                    <th>Challan Dt.</th>
                    <th>Purchase Order No</th>
                    <th>Purchase Order Date</th>
                    <th>Vendor</th>

                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($grnList as $grnlist) { 
               
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $grnlist->grn_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($grnlist->grn_date)); ?></td>
                   <td><?php echo $grnlist->challan_no; ?></td>
                   <td><?php if($grnlist->challan_date!=''){ echo $grnlist->challan_date;} ?></td>
                   <td><?php echo $grnlist->purchase_order_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($grnlist->purchase_order_date)); ?></td>
                
                  
                   <td><?php echo $grnlist->vendor_name; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>goodsreceiptnote/addGrn/<?php echo $grnlist->grn_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                  
                        
                    </td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>