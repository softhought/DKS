<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/salary_comonent.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Salary Component</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>salarycomponent" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="salarycomponentFrom" id="salarycomponentFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="salarycomponentID" id="salarycomponentID" value="<?php echo $bodycontent['salarycomponentID']; ?>">
          
            <div class="card-body">

               <div class="formblock-box">
                           
                         <div class="row">
                        <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <label for="groupname">Component Name</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="component_name" id="component_name" placeholder="Enter Component Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['salarycompEditdata']->component_name; } ?>">
                                </div>
                              </div>
                           
                              </div>

                    
                            
                </div>

         
                <div class="row">
                <div class="col-md-4"></div>
               

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="specialcoching">Dr/Cr</label>
                            <div class="input-group input-group-sm" id="sel_tagerr">
                               <select class="form-control select2" name="sel_tag" id="sel_tag" >
                              <option value="">Select</option>
                              <option value="Dr" <?php if($bodycontent['mode'] == 'EDIT'){ 
                                if ($bodycontent['salarycompEditdata']->tag=='Dr') {
                                  echo "selected";
                                }
                                 } ?>
                              >Dr</option>
                              <option value="Cr"  <?php if($bodycontent['mode'] == 'EDIT'){ 
                                if ($bodycontent['salarycompEditdata']->tag=='Cr') {
                                  echo "selected";
                                }
                                 } ?>>Cr</option>
                             
                                                           
                            </select>
                            </div>

                          </div>
                        
               </div>
                  
                </div>


            

               
                  
                                     
                
            
              </div>

               <div class="formblock-box">
                   <div class="row">

                        
                    

                          <div class="col-md-10">
                      
                          <p id="response_msg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="salcomsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

