<script src="<?php echo base_url(); ?>assets/js/customJs/report/student_status.js"></script>
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
                      <h4><span  id="total_amount_value">0.00</span></h4>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="card-header box-shdw">
              <h3 class="card-title">Student Status List </h3>

              <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>billgeneratetennis/addBill" class="btn btn-default btnpos">
                   <i class="fas fa-plus"></i> Add </a>
              </div> -->
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box"> 
                   
                       <div class="col-md-3">
                            <label for="category">Category*</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm" id="caterr">
                                  <select class="form-control select2" id="category" name="category" style="width: 100%;">
                                      <option value=''>Select</option>
                                      <?php foreach ($bodycontent[ 'studentcategory'] as $studentcategory) { ?>

                                      <option value="<?php echo $studentcategory->category_name; ?>"  >

                                          <?php echo $studentcategory->category_name; ?></option>

                                      <?php } ?>

                                  </select>
                              </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="status">Status*</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm" id="statuserr">
                                <select class="form-control select2" id="status" name="status" style="width: 100%;">
                                      <option value=''>Select</option>
                                      <?php foreach ($bodycontent[ 'studentstatus'] as $studentstatus) { ?>
                                      <option value="<?php echo $studentstatus; ?>"  >
                                          <?php echo $studentstatus; ?>
                                      </option>

                                      <?php } ?>

                                </select>
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
               <div class="col-md-1" >
                   <label for="button">&nbsp;</label>
                   <div class="form-group">
                       <div class="input-group input-group-sm">
                         <button type="button" class="btn btn-block action-button btn-sm dispnone"  id="printbtn" >Print</button>
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
                
              <div id="student_list">
                               
             
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>