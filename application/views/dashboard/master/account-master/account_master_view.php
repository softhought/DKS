

<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Account Master</h3>

            <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>accountmaster/addaccountMaster" class="btn btn-default btnpos">
                   <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->

           <div class="card-body">
             <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Account Name</th>
                    <th>Group Name</th>
                    <th>is Active</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['accountmasterlist'] as $accountmasterlist) { 

                  
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $accountmasterlist->account_name; ?></td>
                   <td><?php echo $accountmasterlist->group_description; ?></td>
                    <td>
                    	<?php  if ($accountmasterlist->is_active=='Y') { ?>
                                <a href="<?php echo base_url();?>accountmaster/InactiveAcc/<?php echo $accountmasterlist->account_id; ?>">
                                   <button class="btn btn-sm action-button actinct actibtn">Active</button>
                                </a>                                
                            <?php }else{ ?>
                                <a href="<?php echo base_url();?>accountmaster/ActiveAcc/<?php echo $accountmasterlist->account_id; ?>">
                                    <button class="btn btn-sm action-button actinct inactbtn">Inactive</button>
                                </a> 
                            <?php } ?>
                    </td>
                   <td>
                    <?php if($accountmasterlist->vendor_id == ''){ ?>
                   <a href="<?php echo base_url(); ?>accountmaster/addaccountMaster/<?php echo $accountmasterlist->account_id; ?>" class="btn tbl-action-btn padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                    <?php } ?>
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
               </table>
              </div>
            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>
