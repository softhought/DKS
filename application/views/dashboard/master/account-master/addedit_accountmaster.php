<script src="<?php echo base_url(); ?>assets/js/customJs/master/accountmaster.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Account Master</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>accountmaster" class="btn btn-default btnpos"> <i class="fas fa-clipboard-list"></i> List </a>
             
            </div>
                           
            </div><!-- /.card-header -->

           <form name="acountmasterFrom" id="acountmasterFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="accId" id="accId" value="<?php echo $bodycontent['accId']; ?>">
          <div class="card-body">

             <div class="formblock-box">

               <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Account Master Info</h3>  

                   <div class="row">
                  
                    <div class="col-md-5">
                       <label for="groupname">Account Name</label>
                      <div class="form-group">
                         <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="accountname" id="accountname" placeholder="Enter Account Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountmasterEditdata']->account_name; } ?>">
                        </div>
                      </div>
                     
                    </div>
                   
                        
                      <div class="col-md-5">
                         <label>Group Name</label>
                           <div class="form-group">
                              <div class="input-group input-group-sm">
                                <select class="form-control select2" id="acccountgrpid" name="acccountgrpid" style="width: 100%;">
                                  <option value=''>&nbsp;</option>
                                  <?php foreach ($bodycontent['groupnamelist'] as $groupnamelist) { ?>

                                    <option value="<?php echo $groupnamelist->id; ?>"

                                    <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['accountmasterEditdata']->group_id == $groupnamelist->id){
                                     echo 'selected';
                                    } ?>

                                      ><?php echo $groupnamelist->group_description; ?></option>
                                   
                                <?php   } ?>
                                 
                                </select>
                                     <input type="hidden" name="groupname" id="groupname" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountmasterEditdata']->group_name; } ?>">
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
                         <button type="submit" class="btn btn-sm action-button" id="accmastersavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                           <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                       </div>
                       <?php if($bodycontent['mode'] == 'ADD'){ ?>
                        <div class="col-md-2">
                         <button type="reset" id="resetaccountform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                       </div>
                     <?php } ?>
                     </div>
                   </div>

             </form>
           </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
   </section>

