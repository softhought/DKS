<script src="<?php echo base_url(); ?>assets/js/customJs/gst_defaulter/gst_defaulter.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
 <style> 
         
            @media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
        </style>             
            
       <form name="gstDefaulterFrom" id="gstDefaulterFrom" method="post" action="<?php echo base_url(); ?>gstdefaulter/print_notice"  target="_blank">

            <div class="card-header box-shdw">
              <h3 class="card-title">GST Defaulter List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  
                </div>
      
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">

            <div class="list-search-block">
 <fieldset class="scheduler-border formblock-box">
               <div class="row">
               <div class="col-sm-12">
               <div class="row">

         

                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Category</label>
                            <div class="input-group input-group-sm" id="categoryerr">
                               <select class="form-control select2" name="category" id="category" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['catogaryList'] as $categorylist) { ?>

                              <option value="<?php echo $categorylist->cat_id; ?>"
                                >
                                <?php echo $categorylist->category_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div> 
                    
                     <div class="col-sm-2">
                      <div class="form-group">
                      <label for="student">Billing Upto</label>
                       <div class="input-group input-group-sm" id="billing_uptoerr">
                            
                     <select class="form-control select2" name="billing_upto" id="billing_upto" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->short_name; ?></option>
                               
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
                  </div ><!-- end of col-md-3 -->

                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Notice Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="notice_date" id="notice_date" value="<?php echo date('d/m/Y'); ?>">
                          </div>
                        </div>
                        </div>

                     
                  
                <div class="col-md-2" >
                          <div class="form-group">
                            <label for="specialcoching">Member </label>
                            <div class="input-group input-group-sm" id="member_drp">
                              <select class="form-control select2" name="member_id" id="member_id" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['memberList'] as $memberlist) { ?>
                              <option value="<?php echo $memberlist->member_id; ?>">
                              <?php echo $memberlist->member_code; ?></option>
                              <?php } ?>                             
                            </select>
                            </div>
                          </div>    
               </div>

                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Equal and Above</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="equal_above" name="equal_above" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" >
                            </div>

                          </div>
                  </div><!-- end of col-md-3 -->
      

              </div>

              <div class="row">
              <div class="col-sm-8">
                  <div class="form-group">
                     <label for="specialcoching">&nbsp;</label>
                      <div class="input-group input-group-sm">
                      <button type="submit" class="btn btn-sm action-button" id="noticeApplybtn">Reminder Notice</button>
                      </div>
                 </div>
              </div>

                <div class="col-sm-2">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="defaulterprintbtn" style="width: 60%;">Print</button>
                            </div>
                          </div>
              </div>

              <div class="col-sm-2">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="defaultershowbtn" style="width: 60%;">Show</button>
                            </div>
                          </div>
              </div>

              </div>

              </div>

           

 </fieldset>



              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="memberbill_list_data" style="max-height: 400px;overflow-y:scroll;" >
             
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>
  </from>