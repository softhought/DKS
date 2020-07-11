
  <section class="layout-box-content-format1">
        <div class="card card-primary">
            
           

            <div class="card-header box-shdw">
              <h3 class="card-title">Deleted Member Receipt</h3>

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
            

              </div> <!-- End of search block -->


              <div class="formblock-box">
                
              <div id="bill_list_details">
             <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Receipt no</th>
                    <th>Receipt dt.</th>
                    <th>Member Code</th>
                    <th>Name</th>
                  
                    <th>Total Amt</th>
                    <th>Delete Dt.</th>
                    <th>Deleted By</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['paymentData'] as $memberreceiptlist) { 
                  if ($memberreceiptlist->total_amount!='') {
                   $total+=$memberreceiptlist->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $memberreceiptlist->mem_receipt_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($memberreceiptlist->receipt_date)); ?></td>
                   <td><?php echo $memberreceiptlist->member_code; ?></td>
                   <td><?php echo $memberreceiptlist->name; ?></td>
                
                  
                   <td align="right"><?php echo $memberreceiptlist->total_amount; ?></td>
                    <td>
                    <?php 

                    if ($memberreceiptlist->delete_date!='') {
                        echo date("d-m-Y h:i:s A", strtotime($memberreceiptlist->delete_date));
                    }

                  

                     ?>
                    </td>
                       <td><?php echo $memberreceiptlist->name; ?></td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>