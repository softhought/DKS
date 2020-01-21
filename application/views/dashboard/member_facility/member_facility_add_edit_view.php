<script src="<?php echo base_url(); ?>assets/js/customJs/master/tennisitem.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Tennis Items</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>tennisitem" class="btn btn-info btnpos">
                  <i class="fas fa-clipboard-list"></i> List </a>
                </div>
             
                           
            </div><!-- /.card-header -->

           <form name="tennisitemFrom" id="tennisitemFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="itemId" id="itemId" value="<?php echo $bodycontent['tranId']; ?>">
            <div class="card-body">

             <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Tennis Items Info</h3>   
                           
             <div class="row">
            
              <div class="col-md-4">
                <label for="groupname">Tennis Item</label>
                <div class="form-group">
                  <div class="input-group input-group-sm">
                   
                    <input type="text" class="form-control" name="tennisitem" id="tennisitem" placeholder="Enter Tennis Item" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['tennisitemEditdata']->item_name; } ?>">
                  </div>
                  
                </div>
               
              </div>
           
             
              <div class="col-md-4">
                <label for="groupname">HSN No.</label>
                <div class="form-group">
                   
                    <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="hsn_no" id="hsn_no" placeholder="Enter HSN No." value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['tennisitemEditdata']->hsn_no; } ?>">

                  </div>
                </div>
               
              </div>
            
             
              <div class="col-md-4">
                 <label for="groupname">Rate</label>
                <div class="form-group">
                   <div class="input-group input-group-sm">
                  
                    <input type="text" class="form-control number_only" name="rate" id="rate" placeholder="Enter Rate" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['tennisitemEditdata']->rate; } ?>">

                  </div>
                </div>
               
              </div>
             </div>
            
           
           </div>

            <div class="formblock-box">
            
             <div class="row">
              <?php if($bodycontent['mode'] == 'ADD'){ ?>
                    <div class="col-md-8">
                      <p id="errormsg" class="errormsgcolor"></p>
                    </div>
                <?php }else{  ?>
                    <div class="col-md-10">
                      <p id="errormsg" class="errormsgcolor"></p>
                    </div>
               <?php  }?>
               <div class="col-md-2 text-right">
                 <button type="submit" class="btn btn-sm action-button" id="tennisitemsavebtn" style="width: 70%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 70%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
                <?php if($bodycontent['mode'] == 'ADD'){ ?>
                <div class="col-md-2">
                 <button type="reset" id="resetformtennis" class="btn btn-sm action-button" style="width: 70%;">Reset</button>
               </div>
             <?php } ?>
             </div>
           </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </section>

