<table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Brand Name</th>
                    <th>OP. Bal</th>
                    <th>Purchase</th>
                    <th>Total</th>                   
                    <th>Sale(Issue)</th>                   
                    <th>Closing Stock</th>  
                    <th>Conv. LTR</th>  
                                 
                                     
                                                     
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($stockregisterlist as $stockregisterlist) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $stockregisterlist->ItemName; ?></td>
                   <td><?php echo $stockregisterlist->Opbot; ?></td>                 
                   <td><?php echo $stockregisterlist->totalPurchase; ?></td>
                   <td><?php echo $stockregisterlist->total; ?></td>
                   <td><?php echo $stockregisterlist->totalSale; ?></td>
                   <td><?php echo $stockregisterlist->closingstock; ?></td>
                   <td><?php echo ($stockregisterlist->closingstock * $stockregisterlist->lequervol)/1000; ?></td>
                  
                                     
                  


                 </tr>
                <?php } ?>                      
                         