<script src="<?php echo base_url(); ?>assets/js/customJs/master/baritemgroupmaster.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Bar Items Group Master</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>baritemgroupmaster" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="baritemsgroupFrom" id="baritemsgroupFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="baritemId" id="baritemId" value="<?php echo $bodycontent['baritemId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Bar Items Info</h3>  
                           
                    <div class="row">
                           
                        <div class="col-md-4">
                            <label for="item_name">Item Name</label>
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                       <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Enter Bar Item Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['baritemsEditdata']->item_name; } ?>"  style = "text-transform: uppercase;" >
                                       <input type="hidden" name="validitem_name" id="validitem_name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['baritemsEditdata']->item_name; } ?>"  style = "text-transform: uppercase;" >
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
                            <button type="submit" class="btn btn-sm action-button" id="baritemsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

