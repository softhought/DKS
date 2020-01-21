<script src="<?php echo base_url(); ?>assets/js/customJs/bill/generate_bill_tennis.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">

          <div class="list-summary">
              <div class="row summary-box-container">

                <!-- <div class="col-md-3 summary-box bg-1">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3> - </h3>
                      <h4> - </h4>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 summary-box bg-2">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3> - </h3>
                      <h4> - </h4>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 summary-box bg-3">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3> - </h3>
                      <h4> - </h4>
                    </div>
                  </div>
                </div> -->
                 <div class="col-md-9"></div>
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
              <h3 class="card-title">Tennis - Bill Generation List</h3>

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>billgeneratetennis/addBill" class="btn btn-default btnpos">
                   <i class="fas fa-plus"></i> Add </a>
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
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="from_dt" id="from_dt" im-insert="false" value="<?php echo date("d/m/Y", strtotime($bodycontent['accountingyear']->start_date)); ?>" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>
                    
                    <div class="col-sm-2">
                      <label for="to_date">To Date</label>
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="to_date" id="to_date" im-insert="false" value="<?php echo date("d/m/Y", strtotime($bodycontent['accountingyear']->end_date)); ?>" readonly>
                          </div>
                        </div>
                         
                    </div>
                      
                   
                    <div class="col-sm-2">
                       <label for="billstyle">Billing Style</label>
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="billstyle" id="billstyle"  style="width: 100%;">
                              <option value="All">Select</option>
                              <?php
                              foreach ($bodycontent['billtype'] as $key => $billtype) {
                              ?>
                              <option value="<?php echo $key;?>"><?php echo $billtype?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        
                    </div> 

                    
                    <div class="col-sm-2">
                      <label for="studentcode">Student Code</label>
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="studcode" id="studcode"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['studentlist'] as $studentlist) {
                              ?>
                              <option value="<?php echo $studentlist->student_code;?>"><?php echo $studentlist->student_code?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        
                    </div>

                <div class="col-md-2">
                   <label for="button">&nbsp;</label>
                   <div class="form-group">
                       <div class="input-group input-group-sm">
                         <button type="button" class="btn btn-block action-button btn-sm" id="listshowbtn" style="width: 60%;">Show</button>
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
                               
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No&emsp;&emsp;</th>
                    <th>Student Name</th>
                    <th>Student Code</th>
                    <th>Billing Style</th>
                    <th>Billing Date</th>
                    <th>Openiing Balance</th>
                    <th>Subscription Fee</th>
                    <th>Hardcourt Fee</th>
                    <th>Correction</th>
                    <th>Intra Tournament Fee</th>
                    <th>Total Amount</th>
                                        
                    </tr>
                </thead>
                <tbody>

                  <?php  $i=1; $total = 0;
                  foreach ($bodycontent['genbilllist'] as $genbilllist) {

                     $total = $total + $genbilllist->total_amount;
                   ?>

                   <tr>
                     <td><?php echo $i++; ?></td>
                     <td><?php echo $genbilllist->title_one.' '.$genbilllist->student_name; ?></td>
                     <td><?php echo $genbilllist->student_code; ?></td>
                     <td><?php echo $genbilllist->billing_style; ?></td>
                     <td><?php echo date('d-m-Y',strtotime($genbilllist->billing_date)); ?></td>
                     <td><?php echo $genbilllist->opening_bal; ?></td>
                     <td><?php echo $genbilllist->subscription_fee; ?></td>
                     <td><?php echo $genbilllist->hard_cout_fee; ?></td>
                     <td><?php echo $genbilllist->correction; ?></td>
                     <td><?php echo $genbilllist->intra_tournament_fee; ?></td>
                     
                     <td><?php echo $genbilllist->total_amount; ?></td>
                     
                   </tr>


                    
                 <?php   } ?>

                                   
                         
                </tbody>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>