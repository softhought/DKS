<script src="<?php echo base_url(); ?>assets/js/customJs/bar_item_opening.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Bar Item Master</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>baritemopeningmaster" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="baritemopeningFrom" id="baritemopeningFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="baritemmasterId" id="baritemmasterId" value="<?php echo $bodycontent['baritemmasterId']; ?>">
           <input type="hidden" name="baritemopnId" id="baritemopnId" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['baritemopeningEditdata']->opening_id; }else{ echo '0'; } ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Bar Item Opening Master Info</h3>  
                           
                         <div class="row">
                         <div class="col-md-1"> </div>
                              <div class="col-md-3">
                                <label for="item_name">Item Name</label>
                                <div class="form-group">
                                  <div class="input-group input-group-sm" >
                                  <input type="text" class="form-control" id="item_name" name="item_name" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['baritemopeningEditdata']->item_name; } ?>" style = "text-transform:uppercase;">
                                  </div>
                                </div>
                           
                              </div>
                          
                <div class="col-md-3">
                   <label>Group Name</label>
                   <div class="form-group">
                        <div class="input-group input-group-sm" >
                        <select class="form-control select2" id="group_id" name="group_id" style="width: 100%;">
                          <option value=''>Select</option>
                          <?php foreach ($bodycontent['baritemsubgroupmasterlist'] as  $value) { ?>

                            <option value="<?php echo $value->id; ?>"

                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['baritemopeningEditdata']->group_id == $value->id){
                             echo 'selected';
                            } ?>

                              ><?php echo $value->item_sub_group; ?></option>
                           
                        <?php   } ?>
                         
                        </select>
                        
                        </div>
                      </div>
               
                    </div>
                
              <div class="col-md-3">
                  <label>Unit</label>
                    <div class="form-group">
                      <div class="input-group input-group-sm">
                        <select class="form-control select2 " id="unit" name="unit" style="width: 100%;">
                          <option value=''>Select</option>
                          <?php foreach ($bodycontent['unitlist'] as $value) { ?>

                            <option value="<?php echo $value->bar_unit_id; ?>"

                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['baritemopeningEditdata']->unit_id == $value->bar_unit_id){
                             echo 'selected';
                            } ?>

                              ><?php echo $value->unit; ?></option>
                           
                        <?php   } ?>
                         
                        </select>
                        </div>
                                               
                    </div>
                     
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1"> </div>
                  <div class="col-md-3">
                  <label>Liquer Vol</label>
                    <div class="form-group">
                      <div class="input-group input-group-sm">
                        <select class="form-control select2 calconml" id="liquer_vol_id" name="liquer_vol_id" style="width: 100%;">
                          <option value=''>Select</option>
                          <?php foreach ($bodycontent['liquervollist'] as $liquervollist) { ?>

                            <option value="<?php echo $liquervollist->id; ?>"

                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['baritemopeningEditdata']->liquer_vol_id == $liquervollist->id){
                             echo 'selected'; $liquer_vol = $liquervollist->lequer_vol;
                            } ?>

                              ><?php echo $liquervollist->lequer_vol; ?></option>
                           
                        <?php   } ?>
                         
                        </select>
                        </div>
                                               
                    </div>
                     
                  </div>
                 
                  <div class="col-md-3">
                          <div class="form-group">
                            <label for="opening_bal_botl">Opening Balance BOT </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control number_only calconml" id="opening_bal_botl" name="opening_bal_botl" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['baritemopeningEditdata']->opening_bal_bot; } ?>">
                            </div>

                          </div>
                     </div><!-- end of col-md-3 --> 
                     <div class="col-md-3">
                          <div class="form-group">
                            <label for="opening_bal_ml">Opening Balance (ML)</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control number_only calconml" id="opening_bal_ml" name="opening_bal_ml" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['baritemopeningEditdata']->opening_bal_ml; } ?>">
                            </div>

                          </div>
                          </div>
                     </div>
                     <div class="row">
                     <div class="col-md-1"></div>
                     <div class="col-md-3">
                          <div class="form-group">
                            <label for="convar_ml">Conv. ML</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="convar_ml" name="convar_ml" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $liquer_vol * $bodycontent['baritemopeningEditdata']->opening_bal_bot + $bodycontent['baritemopeningEditdata']->opening_bal_ml; } ?>">
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->  
                    
                </div>
                  
                
            
              </div>

               <div class="formblock-box">
                   <div class="row">

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-8">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="baritemsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

