<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Accounting Year List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>accountingyear/addeditaccyear" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Accounting Period</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>
 
                <?php  $i = 1;
                 foreach($bodycontent['accountingyearlist'] as $accountingyearlist) { ?>
                 <tr>
                 <td><?php echo $i++; ?></td>
                 <td><?php echo $accountingyearlist->start_date; ?></td>
                 <td><?php echo $accountingyearlist->end_date; ?></td>
                 <td><?php echo $accountingyearlist->year; ?></td>
                 <td>
                   <a href="<?php echo base_url(); ?>accountingyear/addeditaccyear/<?php echo $accountingyearlist->year_id; ?>" class="btn tbl-action-btn padbtn">
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