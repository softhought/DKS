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
                           
                              <div class="col-md-4">
                                <label for="groupname">Group Name</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="groupname" id="groupname" placeholder="Enter Group Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountgroupEditdata']->group_name; } ?>">
                                </div>
                              </div>
                           
                              </div>
                          
                <div class="col-md-4">
                   <label>Group Category</label>
                   <div class="form-group">
                        <div class="input-group input-group-sm">
                        <select class="form-control select2" id="gropcat" name="gropcat" style="width: 100%;">
                          <option value=''>Select</option>
                          <?php foreach ($bodycontent['groupcategory'] as $groupcategory) { ?>

                            <option value="<?php echo $groupcategory; ?>"

                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->group_category == $groupcategory){
                             echo 'selected';
                            } ?>

                              ><?php echo $groupcategory; ?></option>
                           
                        <?php   } ?>
                         
                        </select>
                        <input type="hidden" name="validgroupname" id="validgroupname" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountgroupEditdata']->group_name; } ?>">
                        </div>
                      </div>
               
                    </div>
                 
              
              <div class="col-md-4">
                  <label>Sub Category Name</label>
                    <div class="form-group">
                      <div class="input-group input-group-sm">
                        <select class="form-control select2" id="subgropucat" name="subgropucat" style="width: 100%;">
                          <option value=''>Select</option>
                          <?php foreach ($bodycontent['groupsubcategory'] as $groupsubcategory) { ?>

                            <option value="<?php echo $groupsubcategory; ?>"

                            <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountgroupEditdata']->bal_pl_item == $groupsubcategory){
                             echo 'selected';
                            } ?>

                              ><?php echo $groupsubcategory; ?></option>
                           
                        <?php   } ?>
                         
                        </select>
                      </div>
                       
                    </div>
                     
                  </div>
                </div>

                <div class="row">
                   <div class="col-md-5"></div>
                     <div class="col-md-5">
                        <p id="errormsg" class="errormsgcolor"></p>
                     </div>
                   
                 </div>
            
              </div>

               <div class="formblock-box">
                   <div class="row">
                       <div class="col-md-8"></div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="accgroupsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>
                      <div class="col-md-2">
                       <button type="reset" id="resetgrpform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                     </div>
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

