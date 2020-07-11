<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/salary_accounts.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Salary Account</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>salaryaccounts" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="salaryaccountFrom" id="salaryaccountFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="salaryaccountID" id="salaryaccountID" value="<?php echo $bodycontent['salaryaccountID']; ?>">
          
            <div class="card-body">

               <div class="formblock-box">
                           
               

         
                <div class="row">
                <div class="col-md-4"></div>
               

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="specialcoching">Component</label>
                            <div class="input-group input-group-sm" id="sel_componenterr">
                               <select class="form-control select2" name="sel_component" id="sel_component" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['componentList'] as $componentlist) { ?>
                              <option value="<?php echo $componentlist->id; ?>"
                                <?php
                                if ($bodycontent['mode']=='EDIT') {
                                  if ($bodycontent['salarycompEditdata']->compmonent_id==$componentlist->id) {
                                      echo "selected";
                                  }
                                }

                                ?>
                                >
                                <?php echo $componentlist->component_name; ?></option>
                               
                              <?php } ?>
                              
                             
                                                           
                            </select>
                            </div>

                          </div>
                        
               </div>
                  
                </div>


                  <div class="row">
                <div class="col-md-4"></div>
               

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="specialcoching">Department</label>
                            <div class="input-group input-group-sm" id="sel_departmenterr">
                               <select class="form-control select2" name="sel_department" id="sel_department" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['departmentList'] as $departmentlist) { ?>
                              <option value="<?php echo $departmentlist->dept_id; ?>"
                                <?php
                                if ($bodycontent['mode']=='EDIT') {
                                  if ($bodycontent['salarycompEditdata']->department_id==$departmentlist->dept_id) {
                                      echo "selected";
                                  }
                                }

                                ?>
                                >
                                <?php echo $departmentlist->dept_name; ?></option>
                               
                              <?php } ?>
                              
                             
                                                           
                            </select>
                            </div>

                          </div>
                        
               </div>
                  
                </div>

                     <div class="row">
                <div class="col-md-4"></div>
               

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="specialcoching">Account</label>
                            <div class="input-group input-group-sm" id="sel_accounterr">
                               <select class="form-control select2" name="sel_account" id="sel_account" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['accountList'] as $accountlist) { ?>
                              <option value="<?php echo $accountlist->account_id; ?>"
                                <?php
                                if ($bodycontent['mode']=='EDIT') {
                                  if ($bodycontent['salarycompEditdata']->account_id==$accountlist->account_id) {
                                      echo "selected";
                                  }
                                }

                                ?>
                                >
                                <?php echo $accountlist->account_name; ?></option>
                               
                              <?php } ?>
                              
                             
                                                           
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
  

