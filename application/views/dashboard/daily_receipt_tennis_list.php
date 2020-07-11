<script src="<?php echo base_url();?>assets/js/customJs/tennis_receipt/tennis_receipt.js"></script>

<form name="tennisDailyBalanceFrom" id="tennisDailyBalanceFrom" method="post"   target="_blank">


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
              <h3 class="card-title">Daily Collection Register</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>memberreceipt/addReceipt" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a> 
                </div> -->
      
       
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box">


                 

                    <div class="col-sm-2">
                    <label for="from_dt">From Date</label>
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="from_dt" id="from_dt" im-insert="false" value="<?php echo date("d/m/Y"); ?>" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>
                   
                    <div class="col-sm-2">
                    <label for="to_date" >To Date</label>
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="to_date" id="to_date" im-insert="false" value="<?php echo date("d/m/Y"); ?>" readonly>
                          </div>
                        </div>
                         <p id="todateerr" style="font-size: 12px;"></p>
                    </div>
                    
                  
 
                   
                    <div class="col-sm-2">
                    <label for="payment">Payment Mode</label>
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="payment_mode" id="payment_mode">
                              <option value="All">Select</option>
                              <?php
                              foreach ($bodycontent['paymentmodelist'] as $paymentmodelist) {
                              ?>
                              <option value="<?php echo $paymentmodelist->payment_mode;?>"><?php echo $paymentmodelist->payment_mode?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>



                <div class="col-md-2">
                <label for="payment">&nbsp;</label>
                 <button type="button" class="btn btn-block action-button btn-sm" id="receiptlistshowbtn" style="width: 60%;">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
               <div class="col-sm-2">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="dailyprintbtn" style="width: 60%;">Print</button>
                            </div>
                          </div>
              </div>




           
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader1">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="receipt_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Payment Mode</th>
                    <th align="right">Amount</th>
                    
                   
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['tennisReceiptList'] as $tennisReceiptlist) {

                if ($tennisReceiptlist['masterData']->total_amount!='') {
                 
                  if ($tennisReceiptlist['masterData']->total_amount!='') {
                   $total+=$tennisReceiptlist['masterData']->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $tennisReceiptlist['masterData']->payment_mode; ?></td>
               
                   <td align="right"><?php echo $tennisReceiptlist['masterData']->total_amount; ?></td>
                
                  
                  

                 


                 </tr>
                <?php }  } ?>                       
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>

  </from>