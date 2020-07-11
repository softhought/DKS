<script src="<?php echo base_url(); ?>assets/js/customJs/payroll/masters/payment_advance.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Loan Adjustment</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  
           <!--  <a href="<?php echo base_url(); ?>employeeattendance" class="btn btn-default btnpos">
             <i class="fas fa-clipboard-list"></i> List </a>  -->

            </div>
            
                           
            </div><!-- /.card-header -->


           <form name="loanAdjustmentFrom" id="loanAdjustmentFrom" enctype="multipart/form-data" method="post">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
        
            <div class="card-body">
                <div class="formblock-box">
        
            <div id="copy_div">
              

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


  



              <div class="col-md-1">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="button" class="btn btn-sm action-button
                           " id="showloanbtn">Show</button>
                           
                            </div>

                          </div>
              </div>

                   <div class="col-sm-2">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="loanprintbtn" style="width: 60%;">Print</button>
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

       
                  <div class="card-body">
              <div class="formblock-box">
             <div id="employee_list" >  </div>
            </div>

            </div><!-- /.card-body -->
          
      

     </form>


         



        </div><!-- /.card -->
   </section>



