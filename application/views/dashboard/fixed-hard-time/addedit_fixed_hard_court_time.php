<script src="<?php echo base_url(); ?>assets/js/customJs/master/fixed_hard_courttime.js"></script>
<!--Time Entry -->
<script src="<?php echo(base_url());?>assets/plugins/time/jquery.plugin.js"></script>
<script src="<?php echo(base_url());?>assets/plugins/time/jquery.timeentry.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Fixed Hard Court Time</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>fixedhardcourttime" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="FixedhardtimeFrom" id="FixedhardtimeFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="timeslotId" id="timeslotId" value="<?php echo $bodycontent['timeslotId']; ?>">
            <div class="card-body">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Fixed Hard Court Time Info</h3>  
                           
                         <div class="row">
                           
                              <div class="col-md-3">
                                <label for="from_time">From Time</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control timeEntry" name="from_time" id="from_time" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['timeEditdata']->from_time; } ?>" onChange = "calculate();">
                                    <input type="hidden" name="dup_frm_date" id="dup_frm_date" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['timeEditdata']->from_time; } ?>">
                                </div>
                              </div>

                           
                              </div>
                          
                             <div class="col-md-3">
                                <label for="to_time">To Time</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control timeEntry" name="to_time" id="to_time" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['timeEditdata']->to_time; } ?>" onChange = "calculate();">
                                     <input type="hidden" class="timeEntry" name="dup_to_date" id="dup_to_date" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['timeEditdata']->to_time; } ?>">
                                </div>
                              </div>
                           
                              </div>  
                               <div class="col-md-3">
                                <label for="in_hour">In Hour</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="in_hour" id="in_hour" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['timeEditdata']->in_hour; } ?>" readonly>
                                </div>
                              </div>
                           
                              </div> 

                              <div class="col-md-3">
                                  <label>Day & Night</label>
                                  <div class="form-group">
                                        <div class="input-group input-group-sm" >
                                        <select class="form-control select2" name="sel_day_night" id="sel_day_night" >
                                            <option value="" >Select</option>
                                                  <?php foreach ($bodycontent['day_night_arr'] as $key => $value) {  ?>
                                                    <option value="<?php echo $key;?>"
                                                        <?php if($bodycontent['mode'] == 'EDIT'){
                                                            if ($bodycontent['timeEditdata']->day_night==$key) {
                                                            echo "selected";
                                                            }
                                                          } 
                                                        ?>   ><?php echo $value;?></option>
                                                    <?php } ?>
                         
                            </select>
                                        
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
                            <button type="submit" class="btn btn-sm action-button" id="timesavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                    <?php if($bodycontent['mode'] == 'ADD'){ ?>
                      <div class="col-md-2">
                       <button type="reset" id="resettimeform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                     </div>
                   <?php } ?>
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

