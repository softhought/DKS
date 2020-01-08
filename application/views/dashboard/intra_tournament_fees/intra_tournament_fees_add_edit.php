<script src="<?php echo base_url(); ?>assets/js/customJs/master/intra_tournament_fees.js"></script>
<style type="text/css">
  .copycls{

  float: right;
  color: green;
  border: 2px solid #9f4e7f;
  padding: 1.7px;
  border-radius: 5px;
  color:#9f4e7f;
  font-size: 12px;
  cursor: pointer;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Intra Tournament Fees</h3>
             <a href="<?php echo base_url(); ?>intratournament" class="">
              <button class="btn btn-info btnpos">List</button></a> 
                           
            </div><!-- /.card-header -->

           <form name="interTournamentFrom" id="interTournamentFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="paymodeId" id="paymodeId" value="<?php echo $bodycontent['paymodeId']; ?>">
            <div class="card-body">
                
              <!-- <a href="<?php echo base_url(); ?>intratournament/copyHeaderView" class="">
                <span  class="copycls" ><i class="fas fa-cog"></i>&nbsp;Copy&nbsp; </span> 
                </a> 
 -->
            <div id="copy_div">

             <div class="row">
              <div class="col-md-2"></div>
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
              <!--   <div class="col-md-2" id="monthblock">
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
                         
               </div> -->
               
                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Fees </label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="fees" name="fees" placeholder="" autocomplete="off" value=""    >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->

              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-block btn-primary btn-sm" id="intraturnamentbtn">View</button>
                            </div>

                          </div>
               
              </div>

               <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-block btn-success btn-sm" id="intraturnamentfeeApplybtn">Apply</button>
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



