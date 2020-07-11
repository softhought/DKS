<script src="<?php echo base_url(); ?>assets/js/customJs/report/student_outstanding_report.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">   

        <div class="list-summary">
              <div class="row summary-box-container">

                <div class="col-md-3  bg-3">
                
                </div>
                <div class="col-md-3 summary-box bg-4">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3 style="font-size: 1.08rem">Total Bill Amt</h3>
                      <h4><span  id="total_bill_amt">0.00</span></h4>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 summary-box bg-4">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3 style="font-size: 1.08rem">Total Payment Amt</h3>
                      <h4><span  id="total_pay_amt">0.00</span></h4>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 summary-box bg-4">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3 style="font-size: 1.08rem">Total Outstanding Amt</h3>
                      <h4><span  id="total_outstandig_amt">0.00</span></h4>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>        
           

            <div class="card-header box-shdw">
              <h3 class="card-title">Student Outstanding List </h3>

              <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>billgeneratetennis/addBill" class="btn btn-default btnpos">
                   <i class="fas fa-plus"></i> Add </a>
              </div> -->
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box"> 
                   
               <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Billing Style</label>
                            <div class="input-group input-group-sm" id="billing_styleerr">
                               <select class="form-control select2" name="billing_style" id="billing_style" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['billtype'] as $key => $value) { ?>

                              <option value="<?php echo $key; ?>">
                                <?php echo $value; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>
                    <div class="col-md-2" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="montheerr">
                               <select class="form-control select2" name="month" id="month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->month_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>
                   <div class="col-md-2" id="quarterblock">
                          <div class="form-group">
                            <label for="specialcoching">Quarter</label>
                            <div class="input-group input-group-sm" id="quarter_montherr">
                               <select class="form-control select2" name="quarter_month" id="quarter_month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['quartermonthList'] as $key => $value) { ?>

                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->quarter; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                         
               </div> 
                
               <div class="col-sm-2">
                      <label for="studentcode">Student Code</label>
                      <div class="form-group">
                       <div class="input-group input-group-sm" id="student_drp">
                            
                        <select class="form-control select2" name="studid" id="studid"  style="width: 100%;">
                              <option value="0">Select</option>
                              <?php
                              foreach ($bodycontent['studentlist'] as $studentlist) {
                              ?>
                              <option value="<?php echo $studentlist->student_id;?>"><?php echo $studentlist->student_code?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Accounting Year </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="acyear" name="acyear" placeholder="" autocomplete="off" value="<?php echo $bodycontent['acyear']; ?>" readonly   >
                            </div>

                          </div>
                  </div>
                  

                   

                <div class="col-md-1">
                   <label for="button">&nbsp;</label>
                   <div class="form-group">
                       <div class="input-group input-group-sm">
                         <button type="button" class="btn btn-block action-button btn-sm" id="listshowbtn" >Show</button>
                       </div>
                     </div>
                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
               <div class="col-md-2" >
                   <label for="button">&nbsp;</label>
                   <div class="form-group">
                       <div class="input-group input-group-sm">
                         <button type="button" class="btn btn-block action-button btn-sm dispnone"  id="printbtn" style="width: 60%;">Print</button>
                       </div>
                     </div>
                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">

                 <div class="row" id="loaderbtn" style="
                 display: none;text-align: center;">
                  <div class="col-sm-12">
                    <img src="<?php echo base_url(); ?>assets/img/loader.gif" style="width: 90px;">
                    <p style="color: #458632;margin-bottom: 0px;">Please Wait...</p>
                  </div>
                </div>
                
              <div id="bill_list_details">
                               
             
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>