<script src="<?php echo base_url(); ?>assets/js/customJs/discount/discount.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Discount</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>discount" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="discountFrom" id="discountFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="discId" id="discId" value="<?php echo $bodycontent['discId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Discount Info</h3>  
                           
                         <div class="row">
                           
                              <div class="col-md-3">
                                <label for="groupname">Discount Rate</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control numberwithdecimal" name="discount_rate" id="discount_rate" placeholder="Enter Discount Rate" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['discountEditdata']->discount_rate; } ?>">
                                </div>
                              </div>
                           
                              </div>

                              <div class="col-md-8">
                                <label for="narration">Narration</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control " name="narration" id="narration" placeholder="Enter Narration" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['discountEditdata']->narration; } ?>">
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
                            <button type="submit" class="btn btn-sm action-button" id="discountsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

