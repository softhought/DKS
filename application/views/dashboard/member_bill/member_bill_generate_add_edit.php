<script src="<?php echo base_url(); ?>assets/js/customJs/bill/member_bill_generate.js"></script>
<style type="text/css">

</style>
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Member - Bill Generation</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  
            <a href="<?php echo base_url(); ?>memberbillgenerate" class="btn btn-default btnpos">
             <i class="fas fa-clipboard-list"></i> List </a> 

            </div>
            <!--  <a href="<?php echo base_url(); ?>intratournament" class="">
              <button class="btn btn-info btnpos">List</button></a>  -->
                           
            </div><!-- /.card-header -->


           <form name="membillGenerateFrom" id="membillGenerateFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
        
            <div class="card-body">
                <div class="formblock-box">
        
            <div id="copy_div">
              

             <div class="row">
              <!-- <div class="col-md-1"></div> -->
             <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Category</label>
                            <div class="input-group input-group-sm" id="categoryerr">
                               <select class="form-control select2" name="category" id="category" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['catogaryList'] as $categorylist) { ?>

                              <option value="<?php echo $categorylist->cat_id; ?>"
                                >
                                <?php echo $categorylist->category_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
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


             <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Bill Date</label>
                            <!-- <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false"> -->
                          <div class="input-group input-group-sm" id="bill_dterr">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="bill_dt" id="bill_dt" value="" readonly>
                          </div>
                        </div>
                 </div>


                <div class="col-md-2" >
                          <div class="form-group">
                            <label for="specialcoching">Member </label>
                            <div class="input-group input-group-sm" id="member_drp">
                              <select class="form-control select2" name="member_id" id="member_id" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['memberlist'] as $memberlist) { ?>
                              <option value="<?php echo $memberlist->member_id; ?>">
                              <?php echo $memberlist->member_code; ?></option>
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
                           <button type="submit" class="btn btn-sm action-button
                           " id="billgeneratebtn">Generate</button>
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



