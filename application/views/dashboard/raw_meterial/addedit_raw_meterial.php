<script src="<?php echo base_url(); ?>assets/js/customJs/inventory/raw_meterial.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Raw Material </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>rawmeterial" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="rawMeterialFrom" id="rawMeterialFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="rawmeterialID" id="rawmeterialID" value="<?php echo $bodycontent['rawmeterialID']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                 <div class="row">  
                 <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <label for="groupname">Name</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['rawmeterialEditdata']->name; } ?>">
                                </div>
                              </div>
                           
                              </div> 

                         

                </div>

                <div class="row">
                        <div class="col-md-4"></div>
                             <div class="col-md-4">
                          <div class="form-group">
                            <label for="specialcoching">Group</label>
                            <div class="input-group input-group-sm" id="sel_grouperr">
                               <select class="form-control select2" name="sel_group" id="sel_group" >
                              <option value="">Select</option>
                               <?php foreach ($bodycontent['mainGroupList'] as $maingrouplist) { ?>

                              <option value="<?php echo $maingrouplist->id; ?>"
                              <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($maingrouplist->id==$bodycontent['rawmeterialEditdata']->main_group_id) {
                                      echo "selected";
                                  }
                               } ?>


                                >
                                <?php echo $maingrouplist->group_desc; ?></option>
                               
                              <?php } ?>
                            
                                                           
                            </select>
                            </div>

                          </div>
                         
                           </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="specialcoching">Unit</label>
                            <div class="input-group input-group-sm" id="sel_uniterr">
                            <select class="form-control select2" name="sel_unit" id="sel_unit" >
                            <option value="">Select</option>
                            <?php foreach ($bodycontent['unitList'] as $unitlist) { ?>
                            <option value="<?php echo $unitlist->unit_id; ?>"
                             <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($unitlist->unit_id==$bodycontent['rawmeterialEditdata']->unit_id) {
                                      echo "selected";
                                  }
                               } ?>
                             >
                            <?php echo $unitlist->item_unit_name; ?></option>
                            <?php } ?>                          
                            </select>
                            </div>
                            </div>
                      </div>      
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="specialcoching">Item Group</label>
                            <div class="input-group input-group-sm" id="sel_uniterr">
                            <select class="form-control select2" name="store_item_group" id="store_item_group" >
                            <option value="">Select</option>
                            <?php foreach ($bodycontent['itemgroupList'] as $itemgrouplist) { ?>
                            <option value="<?php echo $itemgrouplist->main_group_id; ?>"
                            <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($itemgrouplist->main_group_id==$bodycontent['rawmeterialEditdata']->store_item_group) {
                                      echo "selected";
                                  }
                               } ?>
                             >
                            <?php echo $itemgrouplist->group_name; ?></option>
                            <?php } ?>                          
                            </select>
                            </div>
                            </div>
                      </div>      
                </div>

                   <div class="row">
                    <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="specialcoching">Item Sub Group</label>
                            <div class="input-group input-group-sm" id="material_typeerr">
                            <select class="form-control select2" name="material_type" id="material_type" >
                            <option value="">Select</option>
                            <?php foreach ($bodycontent['itemsubgroupList'] as $itemsubgrouplist) { ?>
                            <option value="<?php echo $itemsubgrouplist->material_type_id; ?>" 
                              <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($itemsubgrouplist->material_type_id==$bodycontent['rawmeterialEditdata']->material_type_id) {
                                      echo "selected";
                                  }
                               } ?>

                            >
                            <?php echo $itemsubgrouplist->material_type; ?></option>
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
                                    <input type="text" class="form-control" name="opening_balance" id="opening_balance" placeholder="opening Balance" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['rawmeterialEditdata']->open_balance; } ?>" onKeyUp="numericFilter(this);">
                                </div>
                              </div>
                           
                              </div> 
                </div>

                <div class="row">  
                 <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <label for="groupname">min Order Level</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="min_order_level" id="min_order_level" placeholder="opening Balance" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['rawmeterialEditdata']->min_order_level; } ?>" onKeyUp="numericFilter(this);">
                                </div>
                              </div>
                           
                              </div> 
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
  

