<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Tennis Items</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>tennisitem/addtennisitem" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
               <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tennis Item</th>
                    <th>HSN No.</th>
                    <th>Rate</th>
                    <th>Satus</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['tennisitemlist'] as $tennisitemlist) { 

                  
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $tennisitemlist->item_name; ?></td>
                   <td><?php echo $tennisitemlist->hsn_no; ?></td>
                   <td><?php echo $tennisitemlist->rate; ?></td>
                   <td>
                      <?php  if ($tennisitemlist->is_active=='Y') { ?>
                                <a href="<?php echo base_url();?>tennisitem/Inactive/<?php echo $tennisitemlist->item_id; ?>">
                                   <button class="btn btn-sm action-button actinct actibtn">Active</button>
                                </a>                                
                            <?php }else{ ?>
                                <a href="<?php echo base_url();?>tennisitem/Active/<?php echo $tennisitemlist->item_id; ?>">
                                    <button class="btn btn-sm action-button actinct actibtn">Inactive</button>
                                </a> 
                            <?php } ?>
                    </td>
                  
                   
                   <td>
                   <a href="<?php echo base_url(); ?>tennisitem/addtennisitem/<?php echo $tennisitemlist->item_id; ?>" class="btn tbl-action-btn padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>
