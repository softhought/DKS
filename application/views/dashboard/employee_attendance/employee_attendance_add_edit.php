<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/employee_attendance.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Employee Attendance</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  
            <a href="<?php echo base_url(); ?>employeeattendance" class="btn btn-default btnpos">
             <i class="fas fa-clipboard-list"></i> List </a> 

            </div>
            
                           
            </div><!-- /.card-header -->


           <form name="employeeattendanceFrom" id="employeeattendanceFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
        
            <div class="card-body">
                <div class="formblock-box">
        
            <div id="copy_div">
              

             <div class="row">
              <div class="col-md-3"></div>
         
           


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
                            <label for="eqpname">Attendance</label>

                          <div class="input-group input-group-sm" >
                            <div class="input-group-prepend">
                             
                            </div>
                            <input type="text" class="form-control datepicker"  name="attendance_days" id="attendance_days" value="" readonly>
                          </div>
                        </div>
                 </div>



              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button
                           " id="attendancesavebtn">Save</button>
                            <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                            </div>

                          </div>
               
              </div>

     
              
            
             </div>
         
            
             <div class="row">
               <div class="col-md-3">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
               </div>
                 <div class="col-md-5 colmargin">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
             </div>
            
           



             </div>
           </div>
                     
          </div> <!-- /.card-body -->
        

       <!--  <hr> -->

        <div id="student_list" >
                  <div class="card-body">
              <div class="formblock-box">
              <table class="table customTbl table-bordered table-hover dataTable tablepad">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>Employee Name</th>                   
                    <th>Department</th>                   
                    <th>Designation</th>                   
                                                   
                    </tr>
                </thead>
                <tbody>

                <?php $i=1;
                foreach ($bodycontent['employeeList'] as $employeeList) { ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $employeeList->name; ?></td>                   
                   <td><?php echo $employeeList->dept_name; ?></td>                   
                   <td><?php echo $employeeList->designation_name; ?></td>                  
                   

                 </tr>
                <?php } ?>                       
                         
                </tbody>
              </table>
            </div>

            </div><!-- /.card-body -->
          
        </div>

     </form>


         



        </div><!-- /.card -->
   </section>



