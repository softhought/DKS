<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/salary_parameter.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Salary Parameter <?php echo $bodycontent['mode']; ?></h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>salaryparameter" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="salaryParameterFrom" id="salaryParameterFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="salaryparamId" id="salaryparamId" value="<?php echo $bodycontent['salaryparamId']; ?>">

            <div class="card-body">

               <div class="formblock-box">

                  
                           
             <div class="row">
               <div class="col-md-4"></div>
                <div class="col-md-4" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="montheerr">
                               <select class="form-control select2" name="month" id="month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                <?php
                                if ($bodycontent['mode']=='EDIT') {
                                  if ($bodycontent['salaryparamEditdata']->month_id==$value->id) {
                                      echo "selected";
                                  }
                                }

                                ?>
                                >
                                <?php echo $value->short_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>
                          <input type="hidden" name="orgmonth" id="orgmonth" value="<?php if ($bodycontent['mode']=='EDIT') {
                                  echo $bodycontent['salaryparamEditdata']->month_id; }?>">
                          </div>
                          
               </div>
                  </div>

                      <div class="row">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">PF Rate</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="pf_rate" id="pf_rate" placeholder="Enter PF Rate"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['salaryparamEditdata']->pf_rate; } ?>" onKeyUp="numericFilter(this);" >
                                            
                                         </div>
                                      </div>
                           
                              </div>
                              </div>

                   

                        <div class="row">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">ESI Rate</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="esi_rate" id="esi_rate" placeholder="Enter ESI Rate"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['salaryparamEditdata']->esi_rate; } ?>" onKeyUp="numericFilter(this);" >
                                            
                                         </div>
                                      </div>
                           
                              </div>
                              </div>

                        <div class="row">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">HRA Rate</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="hra_rate" id="hra_rate" placeholder="Enter HRA Rate"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['salaryparamEditdata']->hra_rate; } ?>" onKeyUp="numericFilter(this);" >
                                            
                                         </div>
                                      </div>
                           
                              </div>
                              </div>


                               <div class="row">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">ESI Limit</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="esi_limit" id="esi_limit" placeholder="Enter ESI Limit"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['salaryparamEditdata']->esi_limit; } ?>" onKeyUp="numericFilter(this);" >
                                            
                                         </div>
                                      </div>
                           
                              </div>
                              </div>







                </div>

               
              </div>

               <div class="formblock-box">
                   <div class="row">

                     
                          <div class="col-md-10">
                       
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="salparamsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                   
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

