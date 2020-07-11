<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Fixed Hard Court Rate List</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>locationmaster/addeditlocation" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div> -->
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Day & Night</th>                   
                    <th>Singles & Doubles</th>                   
                    <th>Hour</th>                   
                    <th>Rate</th>                   
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['fixedhardcourtlist'] as $fixedhardcourtlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $fixedhardcourtlist->day_night; ?></td>                   
                   <td><?php echo $fixedhardcourtlist->single_double; ?></td>                   
                   <td><?php echo $fixedhardcourtlist->for_hour; ?></td>                   
                   <td><?php echo $fixedhardcourtlist->rate; ?></td>                   
                                   
                   <td>
                     <a href="<?php echo base_url(); ?>fixedhardcourtrate/addeditfixedhardcourt/<?php echo $fixedhardcourtlist->id; ?>" class="btn tbl-action-btn padbtn">
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