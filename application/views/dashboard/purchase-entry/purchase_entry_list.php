<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Purchase Entry (Receive)</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>purchaseentryreceive/addeditpurchasentry" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Transation No.</th>
                    <th>Transation Date</th>
                    <th>Total Quantity</th>                   
                    <th>Action</th>                                        
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['purchaseentrylist'] as $purchaseentrylist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $purchaseentrylist->tran_no; ?></td>
                   <td><?php echo date('d/m/Y',strtotime($purchaseentrylist->tran_date)); ?></td>
                   <td><?php echo $purchaseentrylist->total_quantity; ?></td>
                                     
                   <td>
                     <a href="<?php echo base_url(); ?>purchaseentryreceive/addeditpurchasentry/<?php echo  $purchaseentrylist->id; ?>" class="btn tbl-action-btn padbtn">
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