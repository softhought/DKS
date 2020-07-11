
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Student Category</h3>
<!-- 
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                     <a href="<?php echo base_url(); ?>paymentmode/addpaymentmodedtl" class="btn btn-default btnpos">
                      <i class="fas fa-plus"></i> Add </a>
                </div> -->
                   
             
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Category Name</th>
                    <th>Start Letter</th>
                    <th>Dr Account </th>
                    <th>Cr Account </th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['categorylist'] as $categorylist) { 

                  
                	?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $categorylist->category_name; ?></td>
                   <td><?php echo $categorylist->start_letter; ?></td>
                   <td><?php echo $categorylist->dr_account; ?></td>
                   <td><?php echo $categorylist->cr_account; ?></td>
                   
                   <td>
                   <a href="<?php echo base_url(); ?>tennisbillingac/addCategoryac/<?php echo $categorylist->student_category_id; ?>" class="btn tbl-action-btn padbtn">
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