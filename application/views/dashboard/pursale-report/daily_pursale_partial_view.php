<table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Transation Date</th>
                    <th>Transation No.</th>
                    <th>Brand Name</th>                   
                    <th>Liquer Vol</th>                   
                    <th>Qty</th>  
                    <?php if($selmode == 'PURCHASE'){  ?>
                        <th>Pass No</th>                   
                        <th>Batch No</th>
                   <?php  } ?>                 
                                     
                                                     
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($allpurchasesalereport as $allpurchasesalereport) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo date('d/m/Y',strtotime($allpurchasesalereport->tran_date)); ?></td>
                   <td><?php echo $allpurchasesalereport->tran_no; ?></td>                 
                   <td><?php echo $allpurchasesalereport->item_name; ?></td>
                   <td><?php echo $allpurchasesalereport->lequer_vol; ?></td>
                   <td><?php echo $allpurchasesalereport->quantity; ?></td>
                   <?php if($selmode == 'PURCHASE'){  ?>
                   <td><?php echo $allpurchasesalereport->pass_no; ?></td>
                   <td><?php echo $allpurchasesalereport->batch_no; ?></td>
                   <?php } ?>
                                     
                  


                 </tr>
                <?php } ?>                      
                         