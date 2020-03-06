<script src="<?php echo base_url(); ?>assets/js/customJs/master/accountgroup.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Account Group</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>accountgroup" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="groupnameFrom" id="groupnameFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="groupId" id="groupId" value="<?php echo $bodycontent['groupId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Account Group Info</h3>  
                           
                         <div class="row">
                           
                              <div class="col-md-3">
                                <label for="groupname">Group Name</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="groupname" id="groupname" placeholder="Enter Group Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountgroupEditdata']->group_description; } ?>">
                                </div>
                              </div>
                           
                              </div>
                          
                <div class="col-md-3">
                   <label>Group Category</label>
                   <div class="form-group">
                        <div class="input-group input-group-sm" >
                        <select class="form-control select2" id="gropcat" name="gropcat" style="width: 100%;">
                          <option value=''>Select</option>
                          <?php foreach ($bodycontent['groupcategory'] as $key => $value) { ?>

                            <option value="<?php echo $key; ?>"

                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->main_category == $key){
                             echo 'selected';
                            } ?>

                              ><?php echo $value; ?></option>
                           
                        <?php   } ?>
                         
                        </select>
                        <input type="hidden" name="validgroupname" id="validgroupname" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountgroupEditdata']->group_description; } ?>">
                        </div>
                      </div>
               
                    </div>
                 <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->main_category == 'B'){
                      
                      $coldisp = "display:block;";
                      $balcatdisp = "display:block;";
                      $procatdisp = "display:none;";

                 }else if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->main_category == 'P'){
                      $balcatdisp = "display:none;";
                      $procatdisp = "display:block;";
                      $coldisp = "display:block;";
                 }else{
                  $balcatdisp = "display:none;";
                  $procatdisp = "display:none;";
                  $coldisp = "display:none;";
                 } ?>
              
              <div class="col-md-3" id ="subcat" style="<?php  echo $coldisp;?>">
                  <label>Sub Category Name</label>
                    <div class="form-group">
                      <div class="input-group input-group-sm" id="balancesheetcat" style="<?php  echo $balcatdisp;?>">
                        <select class="form-control select2" id="subgropucatbal" name="subgropucatbal" style="width: 100%;">
                          <option value=''>Select</option>
                          <?php foreach ($bodycontent['groupsubcategory1'] as $key => $value) { ?>

                            <option value="<?php echo $key; ?>"

                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->sub_category == $key){
                             echo 'selected';
                            } ?>

                              ><?php echo $value; ?></option>
                           
                        <?php   } ?>
                         
                        </select>
                        </div>
                        <div class="input-group input-group-sm" id="profitlosscat" style="<?php  echo $procatdisp;?>">
                          <select class="form-control select2" id="subgropucatpro" name="subgropucatpro" style="width: 100%;">
                            <option value=''>Select</option>
                            <?php foreach ($bodycontent['groupsubcategory2'] as $key => $value) { ?>

                              <option value="<?php echo $key; ?>"

                              <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->sub_category == $key){
                              echo 'selected';
                              } ?>

                                ><?php echo $value; ?></option>
                            
                          <?php   } ?>
                          
                          </select>
                      </div>
                       
                    </div>
                     
                  </div>
                    
                             <div class="col-md-2">
                             <label for="is_bank" >Is Cash/Bank</label>                                                                
                                  <div class="form-group" style="margin-left: 12px;margin-top: 6px;">
                                        <div class="input-group input-group-sm">                                           
                                           <input type="checkbox" class="rowCheck inputcheck" name="is_bank" id="is_bank"  <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->is_bank == 'Y'){ echo 'checked'; } ?> value=" <?php if($bodycontent['mode'] == 'EDIT'  && $bodycontent['accountgroupEditdata']->is_bank == 'Y'){ echo 'Y'; }else{ echo 'N'; } ?>" >
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
                            <button type="submit" class="btn btn-sm action-button" id="accgroupsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

