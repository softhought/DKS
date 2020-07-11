<script src="<?php echo base_url(); ?>assets/js/customJs/minimum_billing/gym_swimming_minimum_billing.js"></script>
<style type="text/css">

</style>
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Gym,Swimming and Minimum Billing</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>gymswimmingbill" class="btn btn-default btnpos">
                   <i class="fas fa-clipboard-list"></i> List </a> 
            </div>
            <!--  <a href="<?php echo base_url(); ?>intratournament" class="">
              <button class="btn btn-info btnpos">List</button></a>  -->
                           
            </div><!-- /.card-header -->


           <form name="kotGenerateFrom" id="kotGenerateFrom" enctype="multipart/form-data">

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

                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Account</label>
                            <div class="input-group input-group-sm" id="accounterr">
                               <select class="form-control select2" name="account" id="account" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['accountList'] as $accountlist) { ?>

                              <option value="<?php echo $accountlist->account_id; ?>"
                                >
                                <?php echo $accountlist->account_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div> 

             
          
                <div class="col-sm-2">
                      <!-- radio -->
                      <div class="form-group">
                        <label for="specialcoching">&nbsp;</label>
                        <div class="form-check">
                          <input class="form-check-input showblllsty" type="radio" name="kot_type" value="M">
                          <label class="form-check-label">Monthly KOT</label>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <!-- radio -->
                      <div class="form-group">
                        <label for="specialcoching">&nbsp;</label>
                        <div class="form-check">
                          <input class="form-check-input showblllsty" type="radio" name="kot_type" value="Y">
                          <label class="form-check-label">Yearly KOT</label>
                        </div>
                        
                      </div>
                    </div>
             





             





               
            

              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button
                           " id="generateKotbtn">Generate KOT</button>
                            </div>

                          </div>
               
              </div>

     
              
            
             </div>
         
            
             <div class="row">
               <div class="col-md-3">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
               </div>
                 <div class="col-md-2"></div>
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



