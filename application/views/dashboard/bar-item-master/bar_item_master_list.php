<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Bar Item Master</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>baritemopeningmaster/addeditbaritemopening" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Item Name</th>
                    <th>Group Name</th>
                    <th>Unit</th>
                    <th>Op. Balance BOT</th>
                    <th>Op. Balance ML</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['baritemopeninglist'] as $baritemopeninglist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $baritemopeninglist->item_name; ?></td>
                   <td><?php echo $baritemopeninglist->item_sub_group; ?></td>
                   <td><?php echo $baritemopeninglist->unit; ?></td>
                   <td><?php echo $baritemopeninglist->opening_bal_bot; ?></td>
                   <td><?php echo $baritemopeninglist->opening_bal_ml; ?></td>
                  
                   <td>
                     <a href="<?php echo base_url(); ?>baritemopeningmaster/addeditbaritemopening/<?php echo $baritemopeninglist->id; ?>" class="btn tbl-action-btn padbtn">
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