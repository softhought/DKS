<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Waiter Master </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>waitermaster/addeditwaiter" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Waiter Name</th>
                    <th>Mobile No.</th>
                    <th>Address</th>                    
                    <th>Satus</th>                    
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['Allwaiterlist'] as $Allwaiterlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $Allwaiterlist->waiter_name; ?></td>
                   <td><?php echo $Allwaiterlist->mobile_no; ?></td>
                   <td><?php echo $Allwaiterlist->address_one.' '.$Allwaiterlist->address_two.' '.$Allwaiterlist->address_three; ?></td>
                   <td>
                      <?php  if ($Allwaiterlist->is_active=='Y') { ?>
                                <a href="<?php echo base_url();?>waitermaster/Inactive/<?php echo $Allwaiterlist->id; ?>" class="btn btn-sm action-button actinct actibtn">
                                   <!-- <button class="btn btn-sm action-button actinct actibtn">Active</i></a></button> -->
                                   <i class="fas fa-check"></i>
                                </a>                                
                            <?php }else{ ?>
                                <a href="<?php echo base_url();?>waitermaster/Active/<?php echo $Allwaiterlist->id; ?>" class="btn btn-sm action-button actinct actibtn">
                                    <!-- <button class="btn btn-sm action-button actinct actibtn">Inactive</button> -->
                                    <i class="fas fa-times"></i>
                                </a> 
                            <?php } ?>
                    </td>
                   <td>
                     <a href="<?php echo base_url(); ?>waitermaster/addeditwaiter/<?php echo $Allwaiterlist->id; ?>" class="btn tbl-action-btn padbtn">
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