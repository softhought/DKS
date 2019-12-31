<script src="<?php echo base_url(); ?>assets/js/customJs/master/tennisitem.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tennis Items</h3>
              <a href="<?php echo base_url(); ?>tennisitem" class="">
              <button class="btn btn-info btnpos">List</button></a>
                           
            </div><!-- /.card-header -->

           <form name="tennisitemFrom" id="tennisitemFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="itemId" id="itemId" value="<?php echo $bodycontent['itemId']; ?>">
            <div class="card-body">
                           
             <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="groupname">Tennis Item</label>
                    <input type="text" class="form-control" name="tennisitem" id="tennisitem" placeholder="Enter Tennis Item" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['tennisitemEditdata']->item_name; } ?>">

                  
                </div>
               
              </div>
             </div>
              <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="groupname">HSN No.</label>
                    <input type="text" class="form-control" name="hsn_no" id="hsn_no" placeholder="Enter HSN No." value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['tennisitemEditdata']->hsn_no; } ?>">

                  
                </div>
               
              </div>
             </div>

              <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="groupname">Rate</label>
                    <input type="text" class="form-control number_only" name="rate" id="rate" placeholder="Enter Rate" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['tennisitemEditdata']->rate; } ?>">

                  
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
                 <button type="submit" class="btn btn-block  btn-secondary" id="tennisitemsavebtn" style="width: 70%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-block btn-secondary loaderbtn" id="loaderbtn" style="display:none;width: 70%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
                <div class="col-md-2">
                 <button type="reset" id="resetformtennis" class="btn btn-block btn-secondary" style="width: 70%;">Reset</button>
               </div>
             </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

