<script src="<?php echo base_url(); ?>assets/js/customJs/master/accountgroup.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Account Group</h3>
              <a href="<?php echo base_url(); ?>accountgroup" class="">
              <button class="btn btn-info btnpos">List</button></a>
                           
            </div><!-- /.card-header -->

           <form name="groupnameFrom" id="groupnameFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="groupId" id="groupId" value="<?php echo $bodycontent['groupId']; ?>">
            <div class="card-body">
                           
             <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="groupname">Group Name</label>
                    <input type="text" class="form-control" name="groupname" id="groupname" placeholder="Enter Group Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountgroupEditdata']->group_name; } ?>">
                </div>
               
              </div>
             </div>
              <div class="row">
                <div class="col-md-3"></div>
              <div class="col-md-5">
              <div class="form-group">
                  <label>Group Category</label>
                  <select class="form-control select2bs4" id="gropcat" name="gropcat" style="width: 100%;">
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
             <div class="row">
                <div class="col-md-3"></div>
              <div class="col-md-5">
              <div class="form-group">
                  <label>Sub Category Name</label>
                  <select class="form-control select2bs4" id="subgropucat" name="subgropucat" style="width: 100%;">
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
            
             <div class="row">
               <div class="col-md-3"></div>
                 <div class="col-md-5 colmargin">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
             </div>
            
             <div class="row">
              <div class="col-md-4"></div>
               <div class="col-md-2">
                 <button type="submit" class="btn btn-block  btn-secondary" id="accgroupsavebtn" style="width: 80%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-block btn-secondary loaderbtn" id="loaderbtn" style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
                <div class="col-md-2">
                 <button type="reset" id="resetgrpform" class="btn btn-block btn-secondary" style="width: 80%;">Reset</button>
               </div>
             </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

