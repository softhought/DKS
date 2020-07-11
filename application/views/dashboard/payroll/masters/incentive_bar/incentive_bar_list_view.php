<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/incentivebar.js"></script>

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
                      <h4><span  id="total_amount_value"></span><i class="fa fa-inr" aria-hidden="true"></i></h4>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="card-header box-shdw">
              <h3 class="card-title">Incentive Bar - List</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>incentivebar/addIncentivebar" class="btn btn-info btnpos">
              <i class="fas fa-plus"></i> Add </a>
                </div>
                           
              
            </div><!-- /.card-header -->

            <div class="card-body">
             
             <div class="formblock-box">
               <div class="row">

                 <div class="col-md-2">
                  
                 </div>
              
                 <div class="col-md-3">
                   <div class="form-group">
                            <label for="month">Month</label>
                                <div class="input-group input-group-sm" id="month_iderr">
                                   <select class="form-control select2 searchdata" name="month_id" id="month_id" >
                                  <option value="">Select</option>
                                  <?php foreach ($bodycontent['monthList'] as  $value) { ?>

                                  <option value="<?php echo $value->id; ?>" >
                                    <?php echo $value->short_name; ?></option>
                                   
                                  <?php } ?>
                                                               
                                </select>
                                </div>

                          </div>
                 </div>

                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Accounting Year</label>
                            <div class="input-group input-group-sm" id="amounterr">
                            <input type="text" class="form-control forminputs " id="ac_year" name="ac_year" placeholder="" autocomplete="off" value="<?php echo $bodycontent['acyear']; ?>" readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->

                       <div class="col-md-2 text-right">
                     <div class="form-group">
                   <label for="firstname">&nbsp; </label>
                      <div class="input-group input-group-sm" id="amounterr">
                 <button type="button" class="btn btn-sm action-button" id="incentivebarviewbtn" style="width: 60%;">View</button>

                   <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;">copying...</span>
                    </div>

                 </div>
               </div>
               </div>

            <div id ="incentivebarlist">
            
             </div>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>
