<script src="<?php echo base_url(); ?>assets/js/customJs/salary_process/salary_process.js"></script>
<style type="text/css">

</style>
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Salary Process </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <!-- <a href="<?php echo base_url(); ?>billgeneratetennis/generatelistbill" class="btn btn-default btnpos">
                   <i class="fas fa-clipboard-list"></i> List </a> -->
            </div>
            <!--  <a href="<?php echo base_url(); ?>intratournament" class="">
              <button class="btn btn-info btnpos">List</button></a>  -->
                           
            </div><!-- /.card-header -->


           <form name="salaryProcessFrom" id="salaryProcessFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
        
            <div class="card-body">
                <div class="formblock-box">
        
            <div id="copy_div">
              

             <div class="row">
              <div class="col-md-1"></div>
             
           


        <div class="col-md-2" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="montheerr">
                               <select class="form-control select2" name="month" id="month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->short_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>

                   <div class="col-md-2" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Department</label>
                            <div class="input-group input-group-sm" id="departmenterr">
                               <select class="form-control select2" name="department" id="department" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['departmentList'] as $key => $value) { ?>
                              <option value="<?php echo $value->dept_id; ?>"
                                >
                                <?php echo $value->dept_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">A/c to be Credited</label>
                             <div class="input-group input-group-sm" id="cash_bank_acerr">
                             
                              <select class="form-control select2" name="cash_bank_ac" id="cash_bank_ac"  style="width: 100%;">
                              <option value="">Select</option>
                                  <?php 
                              foreach ($bodycontent['cashbankList'] as $cashbankList) {
                              
                               ?>
                               <option value="<?php echo $cashbankList->account_id;?>">
                               <?php echo $cashbankList->account_name;?></option>

                              <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-2 -->

           <!--       <div class="col-md-2" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Employee</label>
                            <div class="input-group input-group-sm" id="emp_drp">
                               <select class="form-control select2" name="employee" id="employee" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['employeeList'] as $key => $value) { ?>
                              <option value="<?php echo $value->empl_id; ?>"
                                >
                                <?php echo $value->name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
                 </div>
 -->

           


             




               
                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Accounting Year </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="acyear" name="acyear" placeholder="" autocomplete="off" value="<?php echo $bodycontent['acyear']; ?>" readonly   >
                            </div>

                          </div>
                  </div><!-- end of col-md-3 -->

              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button
                           " id="salaryprocessbtn">Process</button>
                            </div>

                          </div>
               
              </div>

     
              
            
             </div>
         
            
             <div class="row">
               <div class="col-md-3">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
               </div>
                 <div class="col-md-8 colmargin">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
             </div>
            
           



             </div>
           </div>
                     
          </div> <!-- /.card-body -->
        

       <!--  <hr> -->

        <div id="student_list" style="padding: 5px;">
          
        </div>

     </form>


         



        </div><!-- /.card -->
   </section>



