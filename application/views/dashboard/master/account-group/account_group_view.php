<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Account Group</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>accountgroup/addaccgroup" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Group Description</th>
                    <th>Group Category</th>
                    <th>Sub Group Category</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['accountgrouplist'] as $accountgrouplist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $accountgrouplist->group_description; ?></td>
                   <td><?php if($accountgrouplist->main_category == 'B'){

                      echo 'BALANCE SHEET';

                   }else if($accountgrouplist->main_category == 'P'){

                      echo 'PROFIT & LOSS';
                   } 
                   
                   ?></td>
                   <td><?php if($accountgrouplist->sub_category == 'A'){
                       echo 'ASSETS';
                   }else if($accountgrouplist->sub_category == 'L'){
                         echo 'LIABILITY';
                   }else if($accountgrouplist->sub_category == 'I'){
                         echo 'INCOME';
                   }else if($accountgrouplist->sub_category == 'E'){
                         echo 'EXPENDITURE';
                } ?></td>
                   <td>
                     <a href="<?php echo base_url(); ?>accountgroup/addaccgroup/<?php echo $accountgrouplist->id; ?>" class="btn tbl-action-btn padbtn">
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