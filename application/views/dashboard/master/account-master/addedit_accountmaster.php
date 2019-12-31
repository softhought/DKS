<script src="<?php echo base_url(); ?>assets/js/customJs/master/accountmaster.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Account Master</h3>
              <a href="<?php echo base_url(); ?>accountmaster" class="">
              <button class="btn btn-info btnpos">List</button></a>
                           
            </div><!-- /.card-header -->

           <form name="acountmasterFrom" id="acountmasterFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="accId" id="accId" value="<?php echo $bodycontent['accId']; ?>">
            <div class="card-body">
                           
             <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="groupname">Account Name</label>
                    <input type="text" class="form-control" name="accountname" id="accountname" placeholder="Enter Account Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountmasterEditdata']->account_name; } ?>">
                </div>
               
              </div>
             </div>
              <div class="row">
                <div class="col-md-3"></div>
              <div class="col-md-5">
              <div class="form-group">
                  <label>Group Name</label>
                  <select class="form-control select2bs4" id="acccountgrpid" name="acccountgrpid" style="width: 100%;">
                    <option value=''>&nbsp;</option>
                    <?php foreach ($bodycontent['groupnamelist'] as $groupnamelist) { ?>

                      <option value="<?php echo $groupnamelist->ac_grp_id; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountmasterEditdata']->ac_grp_id == $groupnamelist->ac_grp_id){
                       echo 'selected';
                      } ?>

                        ><?php echo $groupnamelist->group_name; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                  <input type="hidden" name="groupname" id="groupname" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountmasterEditdata']->group_name; } ?>">
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
                 <button type="submit" class="btn btn-block  btn-secondary" id="accmastersavebtn" style="width: 80%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-block btn-secondary loaderbtn" id="loaderbtn" style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
                <div class="col-md-2">
                 <button type="reset" id="resetaccountform" class="btn btn-block btn-secondary" style="width: 80%;">Reset</button>
               </div>
             </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

