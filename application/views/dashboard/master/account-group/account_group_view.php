
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Account Group</h3>
              <a href="<?php echo base_url(); ?>accountgroup/addaccgroup" class="">
              <button class="btn btn-info btnpos">ADD</button></a>
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Group Name</th>
                    <th>Group Category</th>
                    <th>Sub Category Name</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['accountgrouplist'] as $accountgrouplist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $accountgrouplist->group_name; ?></td>
                   <td><?php echo $accountgrouplist->group_category; ?></td>
                   <td><?php echo $accountgrouplist->bal_pl_item; ?></td>
                   <td>
                     <a href="<?php echo base_url(); ?>accountgroup/addaccgroup/<?php echo $accountgrouplist->ac_grp_id; ?>" class="btn bg-gradient-info padbtn">
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