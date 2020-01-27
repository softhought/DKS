<script src="<?php echo base_url(); ?>assets/js/customJs/member_facility/member_facility.js"></script>
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
              <h3 class="card-title">Fixed Hard Court Booking Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>memberfacility/addFixedHardCourt" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a>
                </div>
       
         <input type="hidden" name="entry_module" id="entry_module" value="FXD">
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box">
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
                    
                    <label for="student" class="col-sm-1">Member Code</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="sel_member" id="sel_member"  style="width: 100%;">
                              <option value="All">Select</option>
                              <?php
                              foreach ($bodycontent['memberList'] as $memberlist) {
                              ?>
                              <option value="<?php echo $memberlist->member_id;?>"><?php echo $memberlist->member_code?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div> 

                <div class="col-md-2">
                 <button type="button" class="btn btn-block action-button btn-sm" id="fixedhardcourtshowbtn" style="width: 60%;">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>

              <div id="fixedhardcourt_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Day</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Time</th>
                    <th>Court No</th>
                    <th>Hr. Amt</th>
                    <th>CGST Amt</th>
                    <th>SGST Amt</th>
                    <th>Total Amt</th>
                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['fixedhrdcourtList'] as $fixhrdcourtlist) { 
                  if ($fixhrdcourtlist->total_amount!='') {
                   $total+=$fixhrdcourtlist->total_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $fixhrdcourtlist->tran_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($fixhrdcourtlist->tran_dt)); ?></td>
                   <td><?php echo $fixhrdcourtlist->member_code; ?></td>
                   <td><?php echo $fixhrdcourtlist->member_name; ?></td>
                   <td><?php echo $fixhrdcourtlist->day_code; ?></td>
                   <td ><?php echo $fixhrdcourtlist->day_night; ?></td>
                   <td ><?php echo $fixhrdcourtlist->single_double; ?></td>
                   <td ><?php echo date('h:i A', strtotime($fixhrdcourtlist->from_time))." - ".date('h:i A', strtotime($fixhrdcourtlist->to_time));?></td>
                   <td ><?php echo $fixhrdcourtlist->court_no; ?></td>
                   <td align="right"><?php echo $fixhrdcourtlist->taxable; ?></td>
                   <td align="right"><?php echo $fixhrdcourtlist->cgst_amt; ?></td>
                   <td align="right"><?php echo $fixhrdcourtlist->sgst_amt; ?></td>
                  
                   <td align="right"><?php echo $fixhrdcourtlist->total_amount; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>memberfacility/addFixedHardCourt/<?php echo $fixhrdcourtlist->ftran_id; ?>" class="btn tbl-action-btn padbtn">
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