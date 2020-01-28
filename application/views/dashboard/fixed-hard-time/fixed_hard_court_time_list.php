<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Fixed Hard Court Time List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>fixedhardcourttime/addedittime" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>From Time</th>
                    <th>To Time</th>
                    <th>In Hour</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                  <?php $i=1;
                foreach ($bodycontent['fixedtimelist'] as $fixedtimelist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo date('h:i A',strtotime($fixedtimelist->from_time)); ?></td>
                   <td><?php echo date('h:i A',strtotime($fixedtimelist->to_time)); ?></td>
                   <td><?php echo $fixedtimelist->in_hour; ?></td>
                   <td>
                     <a href="<?php echo base_url(); ?>fixedhardcourttime/addedittime/<?php echo $fixedtimelist->time_slot_id; ?>" class="btn tbl-action-btn padbtn">
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