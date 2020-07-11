<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Salary Account List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>salaryaccounts/addSalaryaccounts" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th width="5%">Sl.No</th>
                    <th>Component</th>                                      
                    <th>Department</th>                                      
                    <th>Account</th>                                      
                                                    
                               
                    <th width="10%">Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['salaryAccountList'] as $salaryaccountlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $salaryaccountlist->component_name; ?></td>
                   <td><?php echo $salaryaccountlist->dept_name; ?></td>
                   <td><?php echo $salaryaccountlist->account_name; ?></td>
                 
                   <td>
                     <a href="<?php echo base_url(); ?>salaryaccounts/addSalaryaccounts/<?php echo $salaryaccountlist->comp_dtl_id; ?>" class="btn tbl-action-btn padbtn">
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