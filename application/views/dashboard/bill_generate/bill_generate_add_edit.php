<script src="<?php echo base_url(); ?>assets/js/customJs/bill/generate_bill_tennis.js"></script>
<style type="text/css">

</style>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tennis - Bill Generation</h3>
            <!--  <a href="<?php echo base_url(); ?>intratournament" class="">
              <button class="btn btn-info btnpos">List</button></a>  -->
                           
            </div><!-- /.card-header -->

           <form name="billGenerateFrom" id="billGenerateFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
        
            <div class="card-body">
                
        
            <div id="copy_div">

             <div class="row">
              <!-- <div class="col-md-1"></div> -->
               <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Billing Style</label>
                            <div class="input-group input-group-sm" id="billing_styleerr">
                               <select class="form-control select2" name="billing_style" id="billing_style" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['billtype'] as $key => $value) { ?>

                              <option value="<?php echo $key; ?>"
                                >
                                <?php echo $value; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>
                   <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Bill Date</label>
                            <!-- <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false"> -->
                          <div class="input-group input-group-sm" id="bill_dterr">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="bill_dt" id="bill_dt" value="<?php echo date('d/m/Y');?>">
                          </div>
                        </div>
                 </div>


        <div class="col-md-2" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="montheerr">
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
                   <div class="col-md-2" id="quarterblock">
                          <div class="form-group">
                            <label for="specialcoching">Quarter</label>
                            <div class="input-group input-group-sm" id="quarter_montherr">
                               <select class="form-control select2" name="quarter_month" id="quarter_month" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['quartermonthList'] as $key => $value) { ?>

                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->quarter; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                         
               </div> 

                 <div class="col-md-2" >
                          <div class="form-group">
                            <label for="specialcoching">Student(Opt.)</label>
                            <div class="input-group input-group-sm" id="student_drp">
                               <select class="form-control select2" name="student_id" id="student_id" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['studentlist'] as $key => $value) { ?>

                              <option value="<?php echo $value->admission_id; ?>"
                                >
                                <?php echo $value->student_code; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                         
               </div>
               
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
                           <button type="submit" class="btn btn-block btn-primary btn-sm" id="billgeneratebtn">Generate</button>
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
                      
          </div> <!-- /.card-body -->
        

        <hr>

        <div id="student_list" style="padding: 5px;">
          
        </div>

     </form>


         



        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->



