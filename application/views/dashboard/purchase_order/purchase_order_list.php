<script src="<?php echo base_url(); ?>assets/js/customJs/purchase/raw_meterial_purchase.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
            
            <div class="list-summary">
              <div class="row summary-box-container">

                <div class="col-md-9  bg-3">
                
                </div>
                <div class="col-md-3 summary-box bg-4">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3>Total Amount</h3>
                      <h4><span  id="total_amount_value"></span></h4>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>


            <div class="card-header box-shdw">
              <h3 class="card-title">Purchase Order Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>purchaseorder/addPurchaseorder" class="btn btn-info btnpos">
              <i class="fas fa-plus"></i> Add </a>
                </div>
      
       
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box"><div class="col-sm-2"></div>
                  <label for="from_dt" class="col-sm-1">From Date</label>
                    <div class="col-sm-2">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="from_dt" id="from_dt" im-insert="false" value="<?php echo date("d/m/Y", strtotime($bodycontent['accountingyear']->start_date)); ?>" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>
                    <label for="to_date" class="col-sm-1">To Date</label>
                    <div class="col-sm-2">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="to_date" id="to_date" im-insert="false" value="<?php echo date("d/m/Y", strtotime($bodycontent['accountingyear']->end_date)); ?>" readonly>
                          </div>
                        </div>
                         <p id="todateerr" style="font-size: 12px;"></p>
                    </div>
                    
                 
                  

                <div class="col-md-2">
                 <button type="button" class="btn btn-block action-button btn-sm" id="purchaseordershowbtn" style="width: 60%;">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="purchaseorder_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Order No</th>
                    <th>Order Dt.</th>
                    <th>Quotation No</th>
                    <th>Quotation Dt.</th>
                    <th>Total Amt</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['purchaseOrderList'] as $purchaseorderlist) { 
                  if ($purchaseorderlist->net_amount!='') {
                      $total+=$purchaseorderlist->net_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $purchaseorderlist->order_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($purchaseorderlist->order_date)); ?></td>
                   <td><?php echo $purchaseorderlist->quotation_no; ?></td>
                   <td><?php if($purchaseorderlist->quotation_date!=''){ echo $purchaseorderlist->quotation_date;} ?></td>
                
                  
                   <td align="right"><?php echo $purchaseorderlist->net_amount; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>purchaseorder/addPurchaseorder/<?php echo $purchaseorderlist->purchase_id; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                  
                        
                    </td>
               
                 


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