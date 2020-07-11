<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/employee_attendance.js"></script>

<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Employee Attendance List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>employeeattendance/addAttendance" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
              <div class="formblock-box">

                         <div class="row">
              <div class="col-md-4"></div>
         
           


        <div class="col-md-2" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="montherr">
                               <select class="form-control select2" name="month" id="month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->month_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>


  



              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="button" class="btn btn-sm action-button
                           " id="showloanbtn">Show</button>
                           
                            </div>

                          </div>
              </div>

     
              
            
             </div>
               <div class="row">
               <div class="col-md-3">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
                  <p id="errormsg" class="error"></p>
               </div>
                 <div class="col-md-5 colmargin">
                  
                 </div>
               
             </div>


              <div id="employee_list">

             
              </div>
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>