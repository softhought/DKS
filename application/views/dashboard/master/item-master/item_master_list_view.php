<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Items Master</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>Itemmaster/addedititems" class="btn btn-default btnpos">
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
                    <th>Short Name</th>             
                    <th>Category</th>             
                    <th>Item Rate</th>             
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['allitemsmasterlist'] as $allitemsmasterlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $allitemsmasterlist->item_name; ?></td>
                   <td><?php echo $allitemsmasterlist->shrot_name; ?></td>
                   <td><?php echo $allitemsmasterlist->item_category; ?></td>
                   <td><?php echo $allitemsmasterlist->item_rate; ?></td>                   
                  
                   <td>
                     <a href="<?php echo base_url(); ?>Itemmaster/addedititems/<?php echo $allitemsmasterlist->item_id; ?>" class="btn tbl-action-btn padbtn">
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