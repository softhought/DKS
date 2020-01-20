<script src="<?php echo base_url(); ?>assets/js/customJs/payment/receipt_register.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
            

            <div class="card-header box-shdw">
              <h3 class="card-title">Receipt Register</h3>

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">

              <div class="formblock-box">
                <div class="row" style="background-color:#c8c8c8;padding: 10px;">
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
                      <?php
                 $tran_type = array(
                                    'ORADM' => "Other Receipts(Admission)",
                                    'ORITM' => "Other Receipts(Item)",
                                    'RCFS' => "Receivable From Student",
                                     );
                 ?>
                    <label for="student" class="col-sm-1">Tran Type</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="tran_type" id="tran_type"  style="width: 100%;">
                              <option value="All">Select</option>
                              <?php
                              foreach ($tran_type as $key => $tran_type) {
                              ?>
                              <option value="<?php echo $key;?>"><?php echo $tran_type?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div> 

                <div class="col-md-2">
                 <button type="button" class="btn btn-block action-button btn-sm" id="billshowbtn" style="width: 60%;">Show</button>

                   Total <span class="badge" id="total_amount_value">7</span>
               </div>
              </div>
              <div id="bill_list_details">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Tran Type</th>
                    <th>Amount</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['paymentData'] as $paymentdata) { 
                  if ($paymentdata->total_amount!='') {
                   $total+=$paymentdata->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $paymentdata->receipt_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($paymentdata->payment_date)); ?></td>
                   <td><?php echo $paymentdata->student_code; ?></td>
                   <td><?php echo $paymentdata->student_name; ?></td>
                   <td><?php echo $paymentdata->transaction_type; ?></td>
                   <td><?php echo $paymentdata->total_amount; ?></td>
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
              <input type="text" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>