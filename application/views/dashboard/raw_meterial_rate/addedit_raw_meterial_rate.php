<script src="<?php echo base_url(); ?>assets/js/customJs/inventory/raw_meterial_rate.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Raw Material Rate </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>rawmeterialrate" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="rawMeterialRateFrom" id="rawMeterialRateFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="rawmeterialrateID" id="rawmeterialrateID" value="<?php echo $bodycontent['rawmeterialrateID']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                 <div class="row">  
                 <div class="col-md-4"></div>
                             <!--  <div class="col-md-4">
                                <label for="groupname">Description</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['rawmeterialrateEditdata']->description; } ?>">
                                </div>
                              </div>
                           
                              </div> --> 

                      <div class="col-md-4">
                            <div class="form-group">
                            <label for="specialcoching">Raw Meterial</label>
                            <div class="input-group input-group-sm" id="sel_rawmeterialerr">
                            <select class="form-control select2" name="sel_rawmeterial" id="sel_rawmeterial" >
                            <option value="">Select</option>
                            <?php foreach ($bodycontent['rawmeterialList'] as $rawmeteriallist) { ?>
                            <option value="<?php echo $rawmeteriallist->raw_meterial_id; ?>"
                             data-unitname="<?php echo $rawmeteriallist->item_unit_name ?>"
                             <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($rawmeteriallist->raw_meterial_id==$bodycontent['rawmeterialrateEditdata']->rawmeterial_id) {
                                      echo "selected";
                                  }
                               } ?>
                             >
                            <?php echo $rawmeteriallist->name; ?></option>
                            <?php } ?>                          
                            </select>
                            </div>
                            </div>
                      </div>



                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                         <div class="col-md-4">
                                <label for="groupname">Unit</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="sel_unit" id="sel_unit" placeholder="Unit" value="<?php if($bodycontent['mode'] == 'EDIT'){ } ?>" readonly>
                                </div>
                              </div>
                              </div>      
                </div>

                  <div class="row">
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="specialcoching">Supplier</label>
                            <div class="input-group input-group-sm" id="sel_suppliererr">
                            <select class="form-control select2" name="sel_supplier" id="sel_supplier" >
                            <option value="">Select</option>
                            <?php foreach ($bodycontent['supplierList'] as $supplierlist) { ?>
                            <option value="<?php echo $supplierlist->vendor_id; ?>"
                             <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($supplierlist->vendor_id==$bodycontent['rawmeterialrateEditdata']->supplier_id) {
                                      echo "selected";
                                  }
                               } ?>
                             >
                            <?php echo $supplierlist->vendor_name; ?></option>
                            <?php } ?>                          
                            </select>
                            </div>
                            </div>
                      </div>      
                </div>


                <div class="row">  
                 <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <label for="groupname">Rate</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="rate" id="rate" placeholder="Rate" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['rawmeterialrateEditdata']->rate; } ?>" onKeyUp="numericFilter(this);">
                                </div>
                              </div>
                              </div> 
                </div>

                <div class="row">  
                <div class="col-md-4"></div>
                <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">CGST Rt. </label>
                            <div class="input-group input-group-sm" id="item_cgst_rateerr">
                             <select class="form-control select2" name="cgst_rate" id="cgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>"
                                  <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($cgstrate->id==$bodycontent['rawmeterialrateEditdata']->cgst_id) {
                                      echo "selected";
                                  }
                               } ?>
                                >

                               <?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>
                          </div>
                  </div><!-- end of col-md-1 -->

                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">SGST Rt. </label>
                            <div class="input-group input-group-sm" id="item_cgst_rateerr">
                             <select class="form-control select2" name="sgst_rate" id="sgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>" data-rate="<?php echo $sgstrate->rate; ?>"
                                  <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($sgstrate->id==$bodycontent['rawmeterialrateEditdata']->sgst_id) {
                                      echo "selected";
                                  }
                               } ?>
                                ><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>

                          </div>
                  </div><!-- end of col-md-1 -->
                  </div>

               
                  
                                     
                
            
              </div>

               <div class="formblock-box">
                   <div class="row">

                        
                    

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-10">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="rawmeterialsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

              
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

