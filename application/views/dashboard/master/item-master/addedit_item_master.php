<script src="<?php echo base_url(); ?>assets/js/customJs/master/itemmaster.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Items Master</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>itemmaster" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="itemmasterFrom" id="itemmasterFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="itemId" id="itemId" value="<?php echo $bodycontent['itemId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Items Master Info</h3>  
                           
                    <div class="row">
                      <div class = "col-sm-10">
                         <div class="row">                           
                            <div class="col-md-4">
                                <label for="item_name">Item Name</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" name="item_name" id="item_name" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['itemsEditdata']->item_name; } ?>"  style = "text-transform: uppercase;" >
                                        
                                    </div>
                                </div>
                            
                            </div>
                            <div class="col-md-4">
                                <label for="item_short_name">Item Short Name</label>
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" name="item_short_name" id="item_short_name" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['itemsEditdata']->shrot_name; } ?>"  style = "text-transform: uppercase;" >
                                        
                                    </div>
                                </div>
                            
                            </div>
                            <div class="col-md-4">
                                 <label for="item_cat">Item Category</label>                                
                                    <div class="form-group">
                                    <div class="input-group input-group-sm">                                
                                        <select class="form-control select2" id="item_cat" name="item_cat" style="width: 100%;">
                                            <option value='' selected="selected">Select</option>
                                            <?php foreach ($bodycontent['itemcatlist'] as $itemcatlist) { ?>

                                                <option value="<?php echo $itemcatlist->category_name; ?>"

                                                <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->item_category == $itemcatlist->category_name){
                                                echo 'selected';
                                                } ?>

                                                ><?php echo $itemcatlist->category_name; ?></option>
                                            
                                            <?php   } ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                            
                                </div>
                           </div>

                        <div class="row">
                            
                        <div class="col-md-4">
                                 <label for="item_group_cat">Item Group Category</label>                                
                                    <div class="form-group">
                                    <div class="input-group input-group-sm">                                
                                        <select class="form-control select2" id="item_group_cat" name="item_group_cat" style="width: 100%;">
                                            <option value='' selected="selected">Select</option>
                                            <?php foreach ($bodycontent['itemgroupcatlist'] as $itemgroupcatlist) { ?>

                                                <option value="<?php echo $itemgroupcatlist->bar_item_group_id; ?>"

                                                <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->item_group_id == $itemgroupcatlist->bar_item_group_id){
                                                echo 'selected';
                                                } ?>

                                                ><?php echo $itemgroupcatlist->item_name; ?></option>
                                            
                                            <?php   } ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                            
                                </div>

                                <div class="col-md-4">
                                 <label for="item_unit">Item Unit</label>                                
                                    <div class="form-group">
                                    <div class="input-group input-group-sm">                                
                                        <select class="form-control select2" id="item_unit" name="item_unit" style="width: 100%;">
                                            <option value='' selected="selected">Select</option>
                                            <?php foreach ($bodycontent['unitmasterlist'] as $unitmasterlist) { ?>

                                                <option value="<?php echo $unitmasterlist->unit_id; ?>"

                                                <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->item_unit == $unitmasterlist->unit_id){
                                                echo 'selected';
                                                } ?>

                                                ><?php echo $unitmasterlist->item_unit_name; ?></option>
                                            
                                            <?php   } ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                            
                                </div>

                                <div class="col-md-4">
                                 <label for="item_food_cat">Item Food Category</label>                                
                                    <div class="form-group">
                                    <div class="input-group input-group-sm">                                
                                        <select class="form-control select2" id="item_food_cat" name="item_food_cat" style="width: 100%;">
                                            <option value='' selected="selected">Select</option>
                                            <?php foreach ($bodycontent['foodcategorylist'] as $foodcategorylist) { ?>

                                                <option value="<?php echo $foodcategorylist->id; ?>"

                                                <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->cat_id == $foodcategorylist->id){
                                                echo 'selected';
                                                } ?>

                                                ><?php echo $foodcategorylist->cat_name; ?></option>
                                            
                                            <?php   } ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                            
                                </div>
                             </div>

                             <div class="formblock-box">
                             <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Additional  Info</h3> 
                                    <div class="row">
                                        <div class="col-md-3">
                                                <label for="opening_balance">Opening Balance</label>                                
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">                               
                                                        <input type="text" class="form-control numberwithdecimal" name="opening_bal" id="opening_bal" value =" <?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['openingbaldata']->opening_balance; } ?>" >
                                                    </div>
                                                </div>
                                        
                                            </div>
                                        <div class="col-md-3">
                                            <label for="item_rate">Item Rate</label>                                
                                            <div class="form-group">
                                                <div class="input-group input-group-sm">                                
                                                    <input type="text" class="form-control numberwithdecimal" name="item_rate" id="item_rate" value =" <?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['itemsEditdata']->item_rate; } ?>" >
                                                </div>
                                            </div>
                                    
                                        </div>

                                        <div class="col-md-3">
                                            <label for="stock">Stock</label>
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">                                
                                                        <select class="form-control select2" id="stock" name="stock" style="width: 100%;">
                                                             <option value='' selected="selected">Select</option>
                                                                <?php foreach ($bodycontent['stocklist'] as $stocklist) { ?>

                                                                 <option value="<?php echo $stocklist; ?>"

                                                                  <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->stock == $stocklist){
                                                                        echo 'selected';
                                                                    } ?> ><?php echo $stocklist; ?></option>
                                                        
                                                                 <?php   } ?>
                                                        
                                                        </select>
                                                    </div>
                                                </div>
                            
                                        </div> 

                                        <div class="col-md-3">
                                            <label for="manufature_type">Type</label>
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">                                
                                                        <select class="form-control select2" id="manufature_type" name="manufature_type" style="width: 100%;">
                                                             <option value='' selected="selected">Select</option>
                                                                <?php foreach ($bodycontent['manufacturetype'] as $manufacturetype) { ?>

                                                                 <option value="<?php echo $manufacturetype; ?>"

                                                                  <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->for_ind == $manufacturetype){
                                                                        echo 'selected';
                                                                    } ?> ><?php echo $manufacturetype; ?></option>
                                                        
                                                                 <?php   } ?>
                                                        
                                                        </select>
                                                    </div>
                                                </div>
                            
                                        </div> 
                                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="cgst">CGST</label>
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">                                
                                                         <select class="form-control select2" id="cgst" name="cgst" style="width: 100%;">
                                                            <option value='' selected="selected">Select</option>
                                                                <?php foreach ($bodycontent['cgstlist'] as $cgstlist) { ?>

                                                                 <option value="<?php echo $cgstlist->id; ?>"

                                                                <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->cgst_id == $cgstlist->id){
                                                                            echo 'selected';
                                                                } ?> ><?php echo $cgstlist->gstDescription; ?></option>
                                                            
                                                                 <?php   } ?>
                                                            
                                                            </select>
                                                        </div>
                                                </div>
                                
                                        </div>
                                        <div class="col-md-3">
                                            <label for="sgst">SGST</label>
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">                                
                                                         <select class="form-control select2" id="sgst" name="sgst" style="width: 100%;">
                                                            <option value='' selected="selected">Select</option>
                                                                <?php foreach ($bodycontent['sgstlist'] as $sgstlist) { ?>

                                                                 <option value="<?php echo $sgstlist->id; ?>"

                                                                <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['itemsEditdata']->sgst_id == $sgstlist->id){
                                                                            echo 'selected';
                                                                } ?> ><?php echo $sgstlist->gstDescription; ?></option>
                                                            
                                                                 <?php   } ?>
                                                            
                                                            </select>
                                                        </div>
                                                </div>
                                
                                        </div> 
                                        <div class="col-md-3">
                                            <label for="hsn_no">HSN No.</label>                                
                                            <div class="form-group">
                                                <div class="input-group input-group-sm"> 
                                                    <input type="text" class="form-control" name="hsn_no" id="hsn_no" value =" <?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['itemsEditdata']->hsn_no; } ?>">
                                                </div>
                                            </div>
                                    
                                        </div>
                                        <div class="col-md-3">
                                            <label for="item_unit">MRP Rate</label>                                
                                            <div class="form-group">
                                                <div class="input-group input-group-sm">                                
                                                    <input type="text" class="form-control numberwithdecimal" name="mrp_rate" id="mrp_rate" value =" <?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['itemsEditdata']->mrp_rate; } ?>">
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div> 
                                   
                                </div>
                                   
                           
                       </div>
                        
                        <div class="col-md-2 memblock itmshowpad">
                          <span class="spansty">Details</span>
                            <div class="formblock-box">
                                <div class="row">
                                    <label for="specialcoching" class="col-md-5">Year Opening</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="apr" class="col-md-5">APR</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty" value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="may" class="col-md-5">MAY</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="">
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="jun" class="col-md-5">Jun</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="jul" class="col-md-5">Jul</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="">
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">AUG</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="">
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">SEP</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">OCT</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty" readonly value="">
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">NOV</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">DEC</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">JAN</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="">
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">FEB</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
                               </div>
                               <div class="row">
                                    <label for="aug" class="col-md-5">MAR</label>
                                       <div class="col-md-7">
                                          <div class="form-group">
                                             <div class="input-group input-group-sm">                                        
                                                <input type="text" class="form-control inputsty"  value="" readonly="" >
                                        
                                              </div>
                                         </div>
                                      </div>
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
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="itemmastersavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

