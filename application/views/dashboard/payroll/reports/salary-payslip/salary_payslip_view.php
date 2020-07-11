<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/reports/salary_payslip.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
 <style> 
         
            @media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
        </style>             
            
       <form name="salaryregisterFrom" id="salaryregisterFrom" method="post" action="<?php echo base_url(); ?>salaryregister/print_salaryregister"  target="_blank">

            <div class="card-header box-shdw">
              <h3 class="card-title">Salary Pay Slip</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                 
                </div>
      
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">

            <div class="list-search-block">
 <fieldset class="scheduler-border formblock-box">
               <div class="row">
                                
                <div class="col-md-2" >
                          <div class="form-group">
                            <label for="month">Month </label>
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" name="month_id" id="month_id" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthlist'] as $monthlist) { ?>
                              <option value="<?php echo $monthlist->id; ?>"
                                
                                >
                              <?php echo $monthlist->short_name; ?></option>
                              <?php } ?>                             
                            </select>
                            </div>
                          </div>    
               </div>

               <div class="col-md-3" >
                          <div class="form-group">
                            <label for="dept">Department </label>
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" name="dept_id" id="dept_id" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['departmentList'] as $departmentList) { ?>
                              <option value="<?php echo $departmentList->dept_id; ?>"
                                
                                >
                              <?php echo $departmentList->dept_name; ?></option>
                              <?php } ?>                             
                            </select>
                            </div>
                          </div> 
                          </div>

                           <div class="col-md-3" >
                          <div class="form-group">
                            <label for="emp">Employee </label>
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" name="emp_id" id="emp_id" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['employeeList'] as $employeeList) { ?>
                              <option value="<?php echo $employeeList->empl_id; ?>"
                                
                                >
                              <?php echo $employeeList->name; ?></option>
                              <?php } ?>                             
                            </select>
                            </div>
                          </div>  
                          </div>  

                           <div class="col-sm-1">
                     <div class="form-group">
                            <label for="show">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="salarypayslipbtn" >Show</button>
                            </div>
                          </div>
              </div> 
              
              <div class="col-md-2" style="display:none;" id="salryprintbtn">
                     <div class="form-group">
                     <label for="printbtn">&nbsp;</label>
                      <div class="input-group input-group-sm">
                      <button type="submit" class="btn btn-sm action-button" id="printsalarykbtn">Print</button>
                      </div>
                 </div>
                  </div>
               </div>
                 


             

           

 </fieldset>



              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="salary_register_data"  >
             
              </div>
            
              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>
  </from>