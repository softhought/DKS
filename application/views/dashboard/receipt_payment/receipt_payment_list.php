<script src="<?php echo base_url(); ?>assets/js/customJs/account/receipt_payment.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">

            <div class="card-header box-shdw">
              <h3 class="card-title">Receipt/Payment Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>receiptpayment/addReceiptpayment" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a>
                </div>
  
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box">
                  <label for="from_dt" class="col-sm-2">From Date</label>
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
                 <button type="button" class="btn btn-block action-button btn-sm" id="receiptpaymentshowbtn" style="width: 60%;">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="recpay_list_data">

                <table id="voucherlistTable" class="table customTbl table-bordered table-striped dataTable" cellspacing="0" width="100%;" border="0" >
         
     <thead>
         <tr>
        <th>Sl. &emsp;</th>
        <th>Voucher No.&emsp;</th>
        <th>Voucher Date&emsp;</th>
        <th>Narration</th>
        <th>Voucher Type&emsp;</th>
        <th>Voucher Detail&emsp;</th>
        <th>Action&emsp;</th>
         </tr>
        
    </thead>
    
    <tbody>
           <?php if($bodycontent['paymentReceiptList']){
               $j=1;
               foreach($bodycontent['paymentReceiptList'] as $content){?>
        <tr>
                <td><?php echo $j++;?></td>
                <td><?php echo $content['voucher_number']?></td>
                <td><?php echo $content['VoucherDate']?></td>
                <td><?php echo $content['narration']?></td>
                <td>
                    <?php $tran_type= $content['tran_type'];
                            if($tran_type=="PV"){
                                echo "Payment";
                            }
                            if($tran_type=="RV"){
                                echo "Receipt";
                            }
                           
                    ?>
                    
                
                </td>
                <td>
                    <table width="100%" style="font-size: 10px;">
                     
                    <tr style="color: #db4849;">
                         <th>A/C Description </th>
                         <th>Amount</th>
                         <th>Dr/Cr</th>
                     </tr>
                     <?php if($content['voucherDtl']){
                         foreach($content['voucherDtl'] as $value){
                         ?>
                     
                     <tr>
                         <td><?php echo $value->account_name;?></td>
                         <td><?php echo $value->amount;?></td>
                         
                          <td><?php echo $dbCr= $value->drCr;?></td>
                     
                     </tr>
                    
                     <?php }}?>
                 </table>
                    
                </td>
                <td>
                    
              <a href="<?php echo base_url(); ?>receiptpayment/addReceiptpayment/<?php echo $content['id']; ?>" class="btn tbl-action-btn padbtn">
                      <i class="fas fa-edit"></i> 
                    </a>
                    
                </td>
                
        </tr>
        
               <?php }
           }else{?>
                
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>No Data</td>
              <td>Found;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
        
           <?php } ?>
        
         
    </tbody>                                              
    </table>
             
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>