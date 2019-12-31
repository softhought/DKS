
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Goods and Services Tax(GST)</h3>
              <a href="<?php echo base_url(); ?>gstmaster/addgstmaster" class="">
              <button class="btn btn-info btnpos">ADD</button></a>
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Rate</th>
                    <th>Used</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['gstmasterlist'] as $gstmasterlist) { 

                  
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $gstmasterlist->gstDescription; ?></td>
                   <td><?php echo $gstmasterlist->gstType; ?></td>
                   <td><?php echo $gstmasterlist->rate; ?></td>
                   <td><?php if($gstmasterlist->usedfor == 'O'){
                              echo 'Output';
                            }else{
                              echo 'Input';
                            }
                     ?></td>
                   
                   <td>
                   <a href="<?php echo base_url(); ?>gstmaster/addgstmaster/<?php echo $gstmasterlist->id; ?>" class="btn bg-gradient-info padbtn">
                  <i class="fas fa-edit"></i> 
                </a>
                <a href="<?php echo base_url(); ?>gstmaster/deletegstmaster/<?php echo $gstmasterlist->id; ?>" class="btn bg-gradient-info padbtn">
                  <i class="fas fa-trash"></i> 
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
