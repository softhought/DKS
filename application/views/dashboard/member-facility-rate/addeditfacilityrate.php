<script src="<?php echo base_url(); ?>assets/js/customJs/faccilityrate.js"></script>



<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Member Facility Rate</h3>

               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>memeberfacilityrate" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>
              
                           
            </div><!-- /.card-header -->

           <form name="facilityRateFrom" id="facilityRateFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="parameterId" id="parameterId" value="<?php echo $bodycontent['parameterId']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                 <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Facility Rate Info</h3> 
                        <div class="row">
                           <div class="col-md-3">
                              <label for="firstname">Description</label>
                                <div class="form-group">                              
                                  <div class="input-group input-group-sm">
                                  <input type="text" class="form-control"  name="description" id="description"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['facilityrateEditdata']->description;

                                  } ?>" readonly>
                                  </div>

                                </div>
                             </div>

                           <div class="col-md-3">
                               <label for="firstname">Rate</label>
                                <div class="form-group">
                                                                  
                                   <div class="input-group input-group-sm ">
                                      <input type="text" class="form-control numberwithdecimal"  name="rate" id="rate" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['facilityrateEditdata']->rate;

                                       } ?>">
                                       <input type="hidden" name="is_rate" id="is_rate" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['facilityrateEditdata']->is_rate;

                                       } ?>">
                                  </div>

                                </div>
                             </div>  

                           
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>CGST</label>
                               <div class="input-group input-group-sm">
                                <select class="form-control select2" id="cgst" name="cgst" style="width: 100%;">
                                  <option value='0'>Select</option>

                                  <?php foreach ($bodycontent['allcgsttypelist'] as $allcgsttypelist) { ?>
                                    
                                   <option value="<?php echo $allcgsttypelist->id;  ?>" <?php 

                                    if($bodycontent['mode'] == 'EDIT' && $allcgsttypelist->id == $bodycontent['facilityrateEditdata']->cgst_id){ echo 'selected';

                                    }?> ><?php 
                                        echo $allcgsttypelist->gstDescription; ?></option> <?php } ?>
                                    </select>
                                  </div>
                                 </div>
                             </div>
                    
                            
                             
                            <div class="col-md-3">
                            <div class="form-group">
                              <label>SGST</label>
                               <div class="input-group input-group-sm">
                                <select class="form-control select2" id="sgst" name="sgst" style="width: 100%;">
                                  <option value='0'>Select</option>

                                  <?php foreach ($bodycontent['allsgstlist'] as $allsgstlist) { ?>
                                    
                                   <option value="<?php echo $allsgstlist->id;  ?>" <?php 

                                    if($bodycontent['mode'] == 'EDIT' && $allsgstlist->id == $bodycontent['facilityrateEditdata']->sgst_id){ echo 'selected';

                                    }?> ><?php 
                                        echo $allsgstlist->gstDescription; ?></option> <?php } ?>
                                    </select>
                                  </div>
                                 </div>
                             </div>
                          
                              <input type="hidden" name="is_gst" id="is_gst" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['facilityrateEditdata']->is_gst;

                                       } ?>">

                            </div>       
            
            
           
           </div>
           <div class="formblock-box">
            
             <div class="row">
              
                <div class="col-md-10">
                  <p id="errormsg" class="errormsgcolor"></p>
                </div>
            
               <div class="col-md-2 text-right">
                 <button type="submit" class="btn btn-sm action-button" id="facilityratebtn" style="width: 60%;font-size: 13px;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-sm action-button dispnone loaderbtn" id="loaderbtn" style="width: 60%;font-size: 13px;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
               <?php if($bodycontent['mode'] == 'ADD'){ ?>
                <div class="col-md-2">
                 <button type="reset" id="resetgrpform" class="btn btn-sm action-button" style="width: 60%;font-size: 13px;">Reset</button>
               </div>
             <?php } ?>
             </div>
                      
          </div>
        </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
</section>
