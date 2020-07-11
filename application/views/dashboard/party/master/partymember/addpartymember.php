<script src="<?php echo base_url(); ?>assets/js/customJs/party/masters/partymember.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Party Member</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>departmentmaster" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div> 
                 -->
                 
            </div><!-- /.card-header -->

           <form name="partymemberFrom" id="partymemberFrom" enctype="multipart/form-data">
                     
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Party Info</h3> 
                   <div class="row">
                       <div class="col-md-8"></div>
                        <div class="col-md-2" style="text-align:right;">
                        <label for="last_membercode" style="font-size:13px;" >Last Membership</label> 
                        </div>                       
                        <div class="col-md-2">                          
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="last_membercode" id="last_membercode" placeholder=""  value="<?php echo $bodycontent['lastCode']; ?>" readonly>
                                                            
                                    </div>
                                </div>
                                </div>
                        </div>
                           
                         <div class="row">
                           
                            <div class="col-md-3">
                                <label>Existing Code</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-sm" id="memberexisting">
                                            <select class="form-control select2" id="existing_code" name="existing_code"   style="width: 100%;">
                                                <option value=''>Select</option>
                                                <?php foreach ($bodycontent['ExistingcodeList'] as $ExistingcodeList) { ?>

                                                    <option value="<?php echo $ExistingcodeList->member_id; ?>" 

                                                    ><?php echo $ExistingcodeList->member_code; ?></option>
                                    
                                                    <?php   } ?>
                                    
                                            </select>
                                            
                                    </div>
                                </div>                    
                            </div> 
                            <div class="col-md-3">
                                <label for="landline_no" >Phone/Mobile No*</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                        <input type="text" class="form-control onlynumber"  name="mobile_no" id="mobile_no" im-insert="false" value="" >
                                        </div>
                                    </div>
                          
                          </div>
                          <div class="col-md-3">
                          <label for="address_one">Address 1</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval "  name="address_one" id="address_one" im-insert="false" value="" />
                              </div>
                          </div>                           
                        </div>
                        <div class="col-md-3">
                          <label for="address_two">Address 2</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval"  name="address_two" id="address_two" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-md-3">
                          <label for="address_three">Address 3</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval"  name="address_three" id="address_three" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="new_partymember_code">Party Member Code</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval"  name="new_partymember_code" id="new_partymember_code" im-insert="false" value="<?php echo $bodycontent['newCode']; ?>"  readonly/>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="party_mem_name">Party Member Name</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control "  name="party_mem_name" id="party_mem_name" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="party_mem_mobile">Party Mobile No.</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval onlynumber"  name="party_mem_mobile" id="party_mem_mobile" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                </div>
                <div class="row">
                       <div class="col-md-3">
                          <label for="comapany_name">Company Name</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control"  name="comapany_name" id="comapany_name" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="gst_no">GST No.</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval"  name="gst_no" id="gst_no" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                </div>
               
              </div>
                 

               <div class="formblock-box">
                   <div class="row">
                     
                          <div class="col-md-8">               
                      
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>  
                                               
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="partysavebtn">Save</button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;">Saving..</span>
                           </div>

                  
                      <div class="col-md-1" style="text-align:center;">
                       <button type="reset" id="resetgrpform" class="btn btn-sm action-button">Reset</button>
                     </div>
                     <div class="col-md-1">
                           <button type="button" id="refresh" class="btn btn-sm action-button">Refresh</button>
                      </div> 

                  
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

