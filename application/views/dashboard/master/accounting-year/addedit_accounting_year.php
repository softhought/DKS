<script src="<?php echo base_url(); ?>assets/js/customJs/master/accountingyear.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Accounting Year</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>accountingyear" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="accountyearForm" id="accountyearForm" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="yearId" id="yearId" value="<?php echo $bodycontent['yearId']; ?>">

           <input type="hidden" name="last_startdate" id="last_startdate" value="<?php echo $bodycontent['lastaccountingyear']->start_date; ?>">

           <input type="hidden" name="last_enddate" id="last_enddate" value="<?php echo $bodycontent['lastaccountingyear']->end_date; ?>">
            <div class="card-body">

               <div class="formblock-box">
                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Accounting Year Info</h3>  
                           
                         <div class="row">
                           
                              <div class="col-md-3">
                                <label for="start_date">Start Date</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control datepicker1" name="start_date" id="start_date"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date('d/m/Y',strtotime($bodycontent['accountingyearEditdata']->start_date)); } ?>" onChange = "accoutingperiod();" readonly>
                                </div>
                              </div>
                           
                              </div>
                          
                            <div class="col-md-3">
                                <label for="end_date">End Date</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control datepicker2" name="end_date" id="end_date"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date('d/m/Y',strtotime($bodycontent['accountingyearEditdata']->end_date)); } ?>" onChange = "accoutingperiod();" readonly>
                                </div>
                              </div>
                           
                              </div>
                          
                          <div class="col-md-3">
                                <label for="acc_period">Accounting Period</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="acc_period" id="acc_period"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['accountingyearEditdata']->year; } ?>" readonly>
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
                            <button type="submit" class="btn btn-sm action-button" id="accyearsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                    <?php if($bodycontent['mode'] == 'ADD'){ ?>
                      <div class="col-md-2">
                       <button type="reset" id="resetaccyearform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                     </div>
                   <?php } ?>
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

