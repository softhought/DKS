<script src="<?php echo base_url(); ?>assets/js/customJs/sms.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Sms</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>sms" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="smsFrom" id="smsFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="smsID" id="smsID" value="<?php echo $bodycontent['smsID']; ?>">
          
            <div class="card-body">

               <div class="formblock-box">
                           
                         <div class="row">
                        <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <label for="groupname">Module Name</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="module_name" id="module_name" placeholder="Enter Module Name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['smsEditdata']->module; } ?>">
                                </div>
                              </div>
                           
                              </div>

                    
                            
                </div>

         
                <div class="row">
                <div class="col-md-4"></div>
                 <div class="col-md-4">
                                <label for="groupname">Sms Content</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <textarea class="form-control" name="sms_content" id="sms_content" style="height: 150px;" ><?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['smsEditdata']->module; } ?></textarea>
                                   
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
                            <button type="submit" class="btn btn-sm action-button" id="smssavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

