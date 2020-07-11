<script src="<?php echo base_url(); ?>assets/js/customJs/master/waitermaster.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Waiter Master</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>waitermaster" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="waitermasterFrom" id="waitermasterFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="waiterId" id="waiterId" value="<?php echo $bodycontent['waiterId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Waiter Master Info</h3>  
                           
                    <div class="row">
                           
                        <div class="col-md-4">
                            <label for="waiter_name">Waiter Name</label>
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                       <input type="text" class="form-control" name="waiter_name" id="waiter_name" placeholder="Enter Waiter Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['waiterEditdata']->waiter_name; } ?>"  style = "text-transform: uppercase;" >
                                   </div>
                               </div>
                           
                        </div>
                        <div class="col-md-4">
                            <label for="address_one">Address One</label>
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                       <input type="text" class="form-control" name="address_one" id="address_one" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['waiterEditdata']->address_one; } ?>">
                                   </div>
                               </div>
                           
                        </div>
                        <div class="col-md-4">
                            <label for="address_two">Address Two</label>
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                       <input type="text" class="form-control" name="address_two" id="address_two" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['waiterEditdata']->address_two; } ?>">
                                   </div>
                               </div>
                           
                        </div>
                     
            
                    </div>
                    <div class= "row">
                       <div class="col-sm-4">
                            <label for="address_three">Address Three</label>
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                       <input type="text" class="form-control" name="address_three" id="address_three" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['waiterEditdata']->address_three; } ?>">
                                   </div>
                               </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="mobile_no">Mobile No.</label>
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                       <input type="text" class="form-control number_only" name="mobile_no" id="mobile_no" placeholder="" maxlength="10" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['waiterEditdata']->mobile_no; } ?>">
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
                            <button type="submit" class="btn btn-sm action-button" id="waitersavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

