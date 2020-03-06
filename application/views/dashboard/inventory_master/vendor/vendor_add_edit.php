<script src="<?php echo base_url(); ?>assets/js/customJs/inventory/vendor.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Vendor</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>vendor" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="vendorFrom" id="vendorFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="vendorID" id="vendorID" value="<?php echo $bodycontent['vendorID']; ?>">
           <input type="hidden" name="accountID" id="accountID" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['vendorEditdata']->account_id; } ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                         <div class="row">
                        <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <label for="groupname">Vendor Name</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="Enter Vendor Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['vendorEditdata']->vendor_name; } ?>">
                                </div>
                              </div>
                           
                              </div>


                             


                       
                          
                          
           
            
                    
                            
                </div>

                <div class="row">
                <div class="col-md-4"></div>
                   <div class="col-md-4">
                                <label for="groupname">Address</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['vendorEditdata']->address; } ?>">
                                </div>
                              </div>
                           
                              </div>
                  
                </div> 

                <div class="row">
                <div class="col-md-4"></div>
                 <div class="col-md-2">
                                <label for="groupname">GST No</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="gst_no" id="gst_no" placeholder="Enter GST No" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['vendorEditdata']->gst_no; } ?>">
                                </div>
                              </div>
                           
                        </div>


                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">State Code</label>
                            <div class="input-group input-group-sm" id="sel_staterr">
                               <select class="form-control select2" name="sel_state" id="sel_state" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['stateList'] as $statelist) { ?>
                              <option value="<?php echo $statelist->state_code; ?>"
                                 <?php if ($statelist->state_code==19) {
                                    echo "selected";
                                  }?>
                           
                                >
                                <?php echo $statelist->state_name; ?></option>
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                        
               </div>
                  
                </div>


                <div class="row">

                <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <label for="groupname">Opening Balance</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="opening_balance" id="opening_balance" placeholder="Opening Balance" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['vendorEditdata']->opening_balance; } ?>"  onKeyUp="numericFilter(this);">
                                </div>
                              </div>
                           
                              </div>

                  
                </div>

               
                  
                                     
                
            
              </div>

               <div class="formblock-box">
                   <div class="row">

                        
                    

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-8">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="response_msg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="vendorsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                    <?php if($bodycontent['mode'] == 'ADD'){ ?>
                      <div class="col-md-2">
                       <button type="reset" id="resetgrpform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                     </div>
                   <?php } ?>
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

