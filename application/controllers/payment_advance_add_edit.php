<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/payment_advance.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Loan <?php echo $bodycontent['mode']; ?></h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>paymentadvance" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="paymentAdvanceFrom" id="paymentAdvanceFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="paymentadvanceId" id="paymentadvanceId" value="<?php echo $bodycontent['paymentadvanceId']; ?>">

            <div class="card-body">

               <div class="formblock-box">

                    <div class="row">
               <div class="col-md-4"></div>
                 <label for="is_openingadvance" class="col-md-2">Opening Advance</label>
                             <div class="col-md-2">     

                            <input type="checkbox" class="opadv" name="isopeningadvance" id="isopeningadvance" <?php 
                            if($bodycontent['mode'] == 'EDIT'){ 
                              if($bodycontent['paymentAdvanceEditdata']->is_opening=='Y'){echo "checked";
                                } } ?> />
                            <!--<input type="checkbox" class="rowCheck inputcheck" name="is_openingadvance" id="is_openingadvance" data-showid = "is_openingadvance">-->

                                  <div class="form-group">
                                        <div class="input-group input-group-sm">                                           
                                           
                                        </div>
                                  </div>       
                             </div>
                  </div>

           

                  <div class="row">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">Loan Date</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                               <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="advance_date" id="advance_date" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['paymentAdvanceEditdata']->date_of_advance));}else{echo date('d/m/Y');}?>">
                                            
                                         </div>
                                      </div>
                           
                              </div>
                              </div>

                  
                           
             <div class="row">
               <div class="col-md-4"></div>
                <div class="col-md-4" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Employee</label>
                            <div class="input-group input-group-sm" id="employeeerr">
                               <select class="form-control select2" name="employee" id="employee" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['employeeList'] as $emplist) { ?>
                              <option value="<?php echo $emplist->empl_id; ?>"
                                <?php
                                if ($bodycontent['mode']=='EDIT') {
                                  if ($bodycontent['paymentAdvanceEditdata']->employee_id==$emplist->empl_id) {
                                      echo "selected";
                                  }
                                }

                                ?>
                                >
                                <?php echo $emplist->name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>
                  </div>

                      <div class="row">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">Loan Issued Amount</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="advance_amount" id="advance_amount" placeholder="Loan Issued Amount"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['paymentAdvanceEditdata']->adv_amount; } ?>" onKeyUp="numericFilter(this);" >
                                            
                                         </div>
                                      </div>
                              </div>
                       </div>

                   

                <div class="row">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">Monthly Deduction</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="monthly_deduction" id="monthly_deduction" placeholder="Enter Monthly Deduction"  value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['paymentAdvanceEditdata']->monthly_deduct_amt; } ?>" onKeyUp="numericFilter(this);" >
                                         </div>
                                      </div>
                              </div>
                    </div>


              <div class="row  accrow">
               <div class="col-md-4"></div>
                <div class="col-md-4" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Account To Be Debited</label>
                            <div class="input-group input-group-sm" id="actobe_debitederr">
                               <select class="form-control select2" name="actobe_debited" id="actobe_debited" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['debitAcList'] as $debitaclist) { ?>
                              <option value="<?php echo $debitaclist->account_id; ?>"
                                <?php
                                if ($bodycontent['mode']=='EDIT') {
                                  if ($bodycontent['drac']==$debitaclist->account_id) {
                                      echo "selected";
                                  }
                                }

                                ?>
                                >
                                <?php echo $debitaclist->account_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>
                          </div>
                          
               </div>
                  </div>

                         <div class="row accrow">
               <div class="col-md-4"></div>
                <div class="col-md-4" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Account To Be Credited</label>
                            <div class="input-group input-group-sm" id="actobe_creditederr">
                               <select class="form-control select2" name="actobe_credited" id="actobe_credited" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['creditAcList'] as $creditaclist) { ?>
                              <option value="<?php echo $creditaclist->account_id; ?>"
                                <?php
                                if ($bodycontent['mode']=='EDIT') {
                                  if ($bodycontent['crac']==$creditaclist->account_id) {
                                      echo "selected";
                                  }
                                }

                                ?>
                                >
                                <?php echo $creditaclist->account_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>
                  </div>  


                   <div class="row accrow">
                         <div class="col-md-4"></div>
                              <div class="col-md-4">
                                 <label for="dept_name">Cheque No</label>
                                     <div class="form-group">
                                         <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="Cheque No" id="cheque_no" placeholder="Enter Cheque No"  value="<?php if($bodycontent['mode'] == 'EDIT'){ 
                                              //  echo $bodycontent['paymentAdvanceEditdata']->esi_rate; 
                                              } ?>" onKeyUp="numericFilter(this);" >
                                            
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
                            <button type="submit" class="btn btn-sm action-button" id="loansavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                   
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

