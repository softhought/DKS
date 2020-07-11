<script src="<?php echo base_url(); ?>assets/js/customJs/daily_balance/daily_balance.js"></script>
<style type="text/css">

</style>
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Daily Balance </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                   <a href="<?php echo base_url(); ?>dailybalance" class="btn btn-default btnpos">
                   <i class="fas fa-clipboard-list"></i> List </a> 
            </div>
            <!--  <a href="<?php echo base_url(); ?>intratournament" class="">
              <button class="btn btn-info btnpos">List</button></a>  -->
                           
            </div><!-- /.card-header -->


           <form name="dailyBalanceFrom" id="dailyBalanceFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
        
            <div class="card-body">
                <div class="formblock-box">
        
            <div id="copy_div">
              

             <div class="row">
              <div class="col-md-3"></div>

                  <div class="col-sm-2">
                       <div class="form-group">
                         <label for="specialcoching">Processing Date</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="processing_dt" id="processing_dt" im-insert="false" value="" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>

                      <div class="col-sm-2">
                       <div class="form-group">
                         <label for="specialcoching">Billing Month</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                             
                            </div>
                            <input type="text" class="form-control"  name="billing_month" id="billing_month"  value="" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>
             
           


        <div class="col-md-2" id="monthblock">
                          <div class="form-group">
                            <label for="specialcoching">Member</label>
                            <div class="input-group input-group-sm" id="membererr">
                               <select class="form-control select2" name="member" id="member" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['memberList'] as $key => $value) { ?>
                              <option value="<?php echo $value->member_id; ?>"
                                >
                                <?php echo $value->member_code; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>


           




              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button
                           " id="dailybalanceupdatebtn">Update</button>
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

        <div id="student_list" style="padding: 5px;">
          
        </div>

     </form>


         



        </div><!-- /.card -->
   </section>



