<script src="<?php echo base_url(); ?>assets/js/customJs/master/gstmaster.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Goods and Services Tax(GST)</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>gstmaster/addgstmaster" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
                           
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
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
                   <a href="<?php echo base_url(); ?>gstmaster/addgstmaster/<?php echo $gstmasterlist->id; ?>" class="btn tbl-action-btn padbtn">
                  <i class="fas fa-edit"></i> 
                </a>

                <button class="btn tbl-del-action-btn padbtn" onclick="deletegst(<?php echo $gstmasterlist->id; ?>)"><i class="fas fa-trash"></i></button>
                <!-- <a href="<?php echo base_url(); ?>gstmaster/deletegstmaster/<?php echo $gstmasterlist->id; ?>" class="btn tbl-del-action-btn padbtn">
                  <i class="fas fa-trash"></i> 
                </a> -->
                  </td>


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </section>
