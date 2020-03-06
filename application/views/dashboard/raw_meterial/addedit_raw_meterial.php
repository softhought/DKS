<script src="<?php echo base_url(); ?>assets/js/customJs/inventory/material_type.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Raw Material </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>materialtypeinv" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="materialTypeFrom" id="materialTypeFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="rawmeterialID" id="rawmeterialID" value="<?php echo $bodycontent['rawmeterialID']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                 <div class="row">  
                              <div class="col-md-3">
                                <label for="groupname">Name</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Material Type" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['materialtypeEditdata']->name; } ?>">
                                </div>
                              </div>
                           
                              </div> 

                          <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="sel_montherr">
                               <select class="form-control select2" name="sel_group" id="sel_group" >
                              <option value="">Select</option>
                            
                                                           
                            </select>
                            </div>

                          </div>
                         
               </div>

                </div>

                <div class="row">
                    
                </div>

               
                  
                                     
                
            
              </div>

               <div class="formblock-box">
                   <div class="row">

                        
                    

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-10">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="materialtypesavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

              
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

