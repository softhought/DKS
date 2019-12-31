
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tennis Items</h3>
              <a href="<?php echo base_url(); ?>tennisitem/addtennisitem" class="">
              <button class="btn btn-info btnpos">ADD</button></a>
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered table-hover dataTable tablepad">
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
                                   <button class="btn btn-secondary actibtn">Active</button>
                                </a>                                
                            <?php }else{ ?>
                                <a href="<?php echo base_url();?>tennisitem/Active/<?php echo $tennisitemlist->item_id; ?>">
                                    <button class="btn btn-secondary inactbtn">Inactive</button>
                                </a> 
                            <?php } ?>
                    </td>
                  
                   
                   <td>
                   <a href="<?php echo base_url(); ?>tennisitem/addtennisitem/<?php echo $tennisitemlist->item_id; ?>" class="btn bg-gradient-info padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->
