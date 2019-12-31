
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Account Master</h3>
              <a href="<?php echo base_url(); ?>accountmaster/addaccountMaster" class="">
              <button class="btn btn-info btnpos">ADD</button></a>
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered table-hover dataTable tablepad">
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
                   <td><?php echo $accountmasterlist->group_name; ?></td>
                    <td>
                    	<?php  if ($accountmasterlist->is_active=='Y') { ?>
                                <a href="<?php echo base_url();?>accountmaster/InactiveAcc/<?php echo $accountmasterlist->account_id; ?>">
                                   <button class="btn btn-secondary actibtn">Active</button>
                                </a>                                
                            <?php }else{ ?>
                                <a href="<?php echo base_url();?>accountmaster/ActiveAcc/<?php echo $accountmasterlist->account_id; ?>">
                                    <button class="btn btn-secondary inactbtn">Inactive</button>
                                </a> 
                            <?php } ?>
                    </td>
                   <td>
                   <a href="<?php echo base_url(); ?>accountmaster/addaccountMaster/<?php echo $accountmasterlist->account_id; ?>" class="btn bg-gradient-info padbtn">
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
