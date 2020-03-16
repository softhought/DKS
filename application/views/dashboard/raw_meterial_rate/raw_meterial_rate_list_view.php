<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Raw Material Rate </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>rawmeterialrate/addRawmeterialrate" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th width="5%">Sl.No</th>
                    <th>Raw meterial</th>                                                                                    
                    <th>Unit</th>                                                  
                    <th>Supplier</th>                                                  
                    <th>Rate</th>                                                                                        
                    <th width="10%">Action</th>                   
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['rawmeterialrateList'] as $rawmeterialratelist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $rawmeterialratelist->raw_meterial_name; ?></td>
                   <td><?php echo $rawmeterialratelist->item_unit_name; ?></td>
                   <td><?php echo $rawmeterialratelist->vendor_name; ?></td>
                   <td><?php echo $rawmeterialratelist->rate; ?></td>
                 <td>
         
                     <a href="<?php echo base_url(); ?>rawmeterialrate/addRawmeterialrate/<?php echo $rawmeterialratelist->rate_id; ?>" class="btn tbl-action-btn padbtn">
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