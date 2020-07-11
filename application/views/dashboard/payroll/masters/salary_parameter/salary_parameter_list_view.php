<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Salary Parameter List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>salaryparameter/addSalaryParameter" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Month</th>                   
                    <th>PF Rate</th>                   
                    <th>ESI Rate</th>                   
                    <th>HRA Rate</th>                   
                    <th>ESI Limit</th>                   
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['salaryparamList'] as $salaryparamlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $salaryparamlist->month_name; ?></td>                   
                   <td><?php echo $salaryparamlist->pf_rate; ?></td>                   
                   <td><?php echo $salaryparamlist->esi_rate; ?></td>                   
                   <td><?php echo $salaryparamlist->hra_rate; ?></td>                   
                   <td><?php echo $salaryparamlist->esi_limit; ?></td>                   
                   <td>
                     <a href="<?php echo base_url(); ?>salaryparameter/addSalaryParameter/<?php echo $salaryparamlist->id; ?>" class="btn tbl-action-btn padbtn">
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