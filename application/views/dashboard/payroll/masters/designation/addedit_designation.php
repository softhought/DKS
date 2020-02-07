<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/designation.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Designation <?php echo $bodycontent['mode']; ?></h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>designationmaster" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="designationmasterFrom" id="designationmasterFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="desigtId" id="desigtId" value="<?php echo $bodycontent['desigtId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Designation Info</h3>  
                           
                         <div class="row">
                           
                              <div class="col-md-4">
                                 <label for="designation_name">Designation Name</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="designation_name" id="designation_name" placeholder="Enter Designation Name" style="text-transform:capitalize ;" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['designationEditdata']->designation_name; } ?>">
                                              <input type="hidden"  name="validdesig_name" id="validdesig_name"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['designationEditdata']->designation_name; } ?>">
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
                            <button type="submit" class="btn btn-sm action-button" id="designationsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

