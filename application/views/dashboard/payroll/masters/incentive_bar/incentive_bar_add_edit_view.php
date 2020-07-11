<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/incentivebar.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Incentive Bar</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
               <a href="javascript:;" class="btn btn-info btnpos" id="inccopybtn">
              <i class="fas fa-copy"></i><span id="cpspan"> Copy </span></a>

              <a href="<?php echo base_url(); ?>incentivebar" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>
             
                           
            </div><!-- /.card-header -->

           <form name="incentiveBarFrom" id="incentiveBarFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="incentiveID" id="incentiveID" value="<?php echo $bodycontent['incentiveID']; ?>">
        
            <div class="card-body">
              <div class="formblock-box">

                
              <!-- <a href="<?php echo base_url(); ?>intratournament/copyHeaderView" class="">
                <span  class="copycls" ><i class="fas fa-cog"></i>&nbsp;Copy&nbsp; </span> 
                </a> 
              -->

            <div id="add_div">

             <div class="row">

              <div class="col-md-1"></div>
               <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="sel_montherr">
                               <select class="form-control select2" name="sel_month" id="sel_month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $monthlist) { ?>

                              <option value="<?php echo $monthlist->id; ?>"
                                <?php if($bodycontent['mode']=='EDIT'){

                                  if ($bodycontent['incentiveEditdata']->month_id==$monthlist->id) {
                                      echo "selected";
                                  }
                            
                                  }?>
                                >
                                <?php echo $monthlist->month_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>

                   <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Accounting Year</label>
                            <div class="input-group input-group-sm" id="amounterr">
                            <input type="text" class="form-control forminputs " id="ac_year" name="ac_year" placeholder="" autocomplete="off" value="<?php echo $bodycontent['acyear']; ?>" readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
            
               
                  

                   <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Employee</label>
                            <div class="input-group input-group-sm" id="employeeerr">
                               <select class="form-control select2" name="employee" id="employee" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['employeeList'] as $employeelist) { ?>

                              <option value="<?php echo $employeelist->empl_id; ?>"
                                <?php if($bodycontent['mode']=='EDIT'){

                                  if ($bodycontent['incentiveEditdata']->employee_id==$employeelist->empl_id) {
                                      echo "selected";
                                  }
                            
                                  }?>
                                >
                                <?php echo $employeelist->name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>   
               <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Amount </label>
                            <div class="input-group input-group-sm" id="amounterr">
                            <input type="text" class="form-control forminputs " id="amount" name="amount" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode']=='EDIT'){
                              echo $bodycontent['incentiveEditdata']->amount;
                            }?>" onKeyUp="numericFilter(this);"   >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->  

   
                 <div class="col-md-2 text-right">
                     <div class="form-group">
                   <label for="firstname">&nbsp; </label>
                      <div class="input-group input-group-sm" id="amounterr">
                 <button type="submit" class="btn btn-sm action-button" id="incentiveBarbtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                    </div>

                 </div>
               </div>

            
             </div>
         
            
         
            
           



             </div>


             <div id="copy_div">

             <div class="row">
              <div class="col-md-2"></div>
               <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">From Month</label>
                            <div class="input-group input-group-sm" id="copy_from_montherr">
                               <select class="form-control select2" name="copy_from_month" id="copy_from_month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $monthlist) { ?>

                              <option value="<?php echo $monthlist->id; ?>"
                                >
                                <?php echo $monthlist->short_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>

                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Accounting Year</label>
                            <div class="input-group input-group-sm" id="amounterr">
                            <input type="text" class="form-control forminputs " id="ac_year" name="ac_year" placeholder="" autocomplete="off" value="<?php echo $bodycontent['acyear']; ?>" readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->

                 

                <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">To Month</label>
                            <div class="input-group input-group-sm" id="copy_to_montherr">
                               <select class="form-control select2" name="copy_to_month" id="copy_to_month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['monthList'] as $monthlist) { ?>

                              <option value="<?php echo $monthlist->id; ?>"
                                >
                                <?php echo $monthlist->short_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>


                   <div class="col-md-2 text-right">
                     <div class="form-group">
                   <label for="firstname">&nbsp; </label>
                      <div class="input-group input-group-sm" id="amounterr">
                 <button type="button" class="btn btn-sm action-button" id="incbarCopybtn" style="width: 60%;">copy</button>

                   <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;">copying...</span>
                    </div>

                 </div>
               </div>

                     




               </div>


               
             </div>

                 <div class="row">
               <div class="col-md-4">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
                <p id="errormsg" class="error"></p>
               </div>
                 <div class="col-md-5 colmargin">
                   
                 </div>
               
             </div>




             </div>
                      
          </div> <!-- /.card-body -->
        

        


     </form>


        




        </div><!-- /.card -->
  </section>



