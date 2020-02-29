<script src="<?php echo base_url(); ?>assets/js/customJs/party/partybooking.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Party Booking</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>partybooking" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div> 
                
                 
            </div><!-- /.card-header -->

           <form name="partybookingFrom" id="partybookingFrom" enctype="multipart/form-data">
           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="bookingId" id="bookingId" value="<?php echo $bodycontent['bookingId']; ?>">
                     
            <div class="card-body">

            <div class="formblock-box">

                  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Party Booking Info</h3>

                  <div class="row">
                      <div class="col-md-3">
                      </div>
                      <div class="col-md-6 backdesign">
                           <div class="row">
                               <label class="col-md-3">Member Code</label>
                                  <div class="col-md-4">                               
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <select class="form-control select2" id="mem_booking_id" name="mem_booking_id"   style="width: 100%;">
                                                    <option value=''>Select</option>
                                                    <?php foreach ($bodycontent['allpartymemberlist'] as $allpartymemberlist) { ?>

                                                        <option value="<?php echo $allpartymemberlist->member_id; ?>" data-membername = "<?php echo $allpartymemberlist->title_one.' '.$allpartymemberlist->member_name; ?>"

                                                        <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybookingEditdata']->member_master_id == $allpartymemberlist->member_id){ echo 'selected'; } ?>

                                                        ><?php echo $allpartymemberlist->member_code; ?></option>
                                        
                                                        <?php   } ?>
                                        
                                                </select>
                                            <input type="hidden" name="mem_booking_code" id="mem_booking_code" value=" <?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['partybookingEditdata']->member_master_code; } ?>">   
                                        </div>
                                    </div>                    
                                </div>
                            </div>
                                 <div class="row">                                
                                   <label for="member_name" class="col-md-3" >Member Name</label>
                                      <div class="col-md-6">                                   
                                          <div class="form-group">
                                              <div class="input-group input-group-sm">
                                              <input type="text" class="form-control"  name="member_name" id="member_name" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['partybookingEditdata']->title_one.' '.$bodycontent['partybookingEditdata']->member_name; } ?>" readonly>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                       <label for="booking_date" class="col-md-3">Booking Date</label>
                                       <div class="col-md-5">
                                            <div class="form-group">                                               
                                        
                                                <div class="input-group input-group-sm" >
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                      </div>
                                                      <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="booking_date" id="booking_date" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybookingEditdata']->booking_date != ''){ echo date('d/m/Y',strtotime($bodycontent['partybookingEditdata']->booking_date)); }else{ echo date('d/m/Y'); } ?>">
                                                  </div>
                                            </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <label for="party_date" class="col-md-3">Party Date</label>
                                      
                                        <div class="col-md-5">
                                              <div class="form-group">
                                                  
                                                  <div class="input-group input-group-sm" id="bill_dterr">
                                                      <div class="input-group-prepend">
                                                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="party_date" id="party_date" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybookingEditdata']->party_date != ''){ echo date('d/m/Y',strtotime($bodycontent['partybookingEditdata']->party_date)); } ?>">
                                                    </div>
                                              </div>
                                            </div>
                                       </div>
                                       <div class="row">
                                           <label  class="col-md-3">Time Slot</label>
                                            <div class="col-md-5">                                             
                                                  <div class="form-group">
                                                      <div class="input-group input-group-sm">
                                                          <select class="form-control select2" id="time_slot" name="time_slot"   style="width: 100%;">
                                                              <option value=''>Select</option>
                                                              <?php foreach ($bodycontent['timeslotlist'] as $timeslotlist) { ?>

                                                                  <option value="<?php echo $timeslotlist; ?>" 
                                                                  <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybookingEditdata']->time_slot == $timeslotlist){ echo 'selected'; } ?>

                                                                  ><?php echo $timeslotlist; ?></option>
                                                  
                                                                  <?php   } ?>
                                                  
                                                          </select>
                                                          
                                                         </div>
                                                     </div>                    
                                              </div> 

                                          </div>
                                          <div class="row">
                                              <label class="col-md-3">Location</label>
                                              <div class="col-md-5">                                                 
                                                      <div class="form-group">
                                                          <div class="input-group input-group-sm">
                                                              <select class="form-control select2" id="party_location" name="party_location"   style="width: 100%;">
                                                                  <option value=''>Select</option>
                                                                  <?php foreach ($bodycontent['locationlist'] as $locationlist) { ?>

                                                                      <option value="<?php echo $locationlist->id; ?>" 
                                                                      <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybookingEditdata']->party_location_id == $locationlist->id){ echo 'selected'; } ?>

                                                                      ><?php echo $locationlist->location_name; ?></option>
                                                      
                                                                      <?php   } ?>
                                                      
                                                              </select>
                                                              
                                                      </div>
                                                  </div>                    
                                              </div>
                                          </div>
                                          <div class="row">                            
                                             <label for="no_of_heads" class="col-md-3">Heads</label>                                              <div class="col-md-5">
                                                
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                      <input type="text" class="form-control numberonly"  name="no_of_heads" id="no_of_heads" im-insert="false" value=" <?php if($bodycontent['mode'] == 'EDIT'){  echo  $bodycontent['partybookingEditdata']->heads;  } ?>" />
                                                    </div>
                                                </div>
                                              </div>    
                                          </div>
                                          <div class="row">
                                              <label for="narration" class="col-md-3">Narration.</label>   
                                              <div class="col-md-5">                                                
                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                      <textarea  class="form-control"  name="narration" id="narration" ><?php if($bodycontent['mode'] == 'EDIT'){  echo  $bodycontent['partybookingEditdata']->narration;  } ?></textarea>
                                                    </div>
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
                            <button type="submit" class="btn btn-sm action-button" id="bookingsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

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
  

