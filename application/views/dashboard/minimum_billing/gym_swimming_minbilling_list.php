<script src="<?php echo base_url(); ?>assets/js/customJs/minimum_billing/gym_swimming_minimum_billing.js"></script>
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
              <h3 class="card-title">GYM,SWIMMING MINIMUM BILLING Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>gymswimmingbill/addKOT" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a>
                </div>
      
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box">
                 
                 

                    <label for="student" class="col-sm-1">Member Code</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="sel_member" id="sel_member"  style="width: 100%;">
                              <option value="">Select</option>
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

                    <label for="student" class="col-sm-1">Month</label>

                           <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                     <select class="form-control select2" name="month" id="month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->short_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>

                    <label for="student" class="col-sm-1">Account</label>

                      <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                   <select class="form-control select2" name="account" id="account" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['accountList'] as $accountlist) { ?>

                              <option value="<?php echo $accountlist->account_id; ?>"
                                >
                                <?php echo $accountlist->account_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>




                <div class="col-md-2">
                 <button type="button" class="btn btn-block action-button btn-sm" id="gymswmshowbtn" style="width: 60%;">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="gymswimming_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Tran no</th>
                    <th>Tran dt.</th>
                    <th>Member Code</th>
                    <th>Member Name</th>
                    <th>Account</th>
                    <th>Amount</th>
                  
          
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['kotList'] as $kotlist) { 
                  if ($kotlist->kot_amount!='') {
                   $total+=$kotlist->kot_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $kotlist->kot_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($kotlist->kot_date)); ?></td>
                   <td><?php echo $kotlist->member_code; ?></td>
                   <td><?php echo $kotlist->member_name; ?></td>
                   <td><?php echo $kotlist->account_name; ?></td>
                   <td><?php echo $kotlist->kot_amount; ?></td>
                  
               
                
               
                 


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