<script src="<?php echo base_url(); ?>assets/js/customJs/bill/tennisbillvoucher.js"></script>

<style type="text/css">



</style>

<section class="layout-box-content-format1">

        <div class="card card-primary">

            <div class="card-header box-shdw">

              <h3 class="card-title">Tennis Coaching to Accounts</h3>

               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >

                  <a href="<?php echo base_url(); ?>tenniscoachingtoaccounts" class="btn btn-default btnpos">

                   <i class="fas fa-clipboard-list"></i> List </a>

            </div>

            <!--  <a href="<?php echo base_url(); ?>intratournament" class="">

              <button class="btn btn-info btnpos">List</button></a>  -->

                           

            </div><!-- /.card-header -->



           <form name="billVoucherGenerateFrom" id="billVoucherGenerateFrom" enctype="multipart/form-data">



           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">

        

            <div class="card-body">

                <div class="formblock-box">

        

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


                   <div class="col-md-2">

                          <div class="form-group">

                            <label for="eqpname">Voucher Date</label>

                            <!-- <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false"> -->

                          <div class="input-group input-group-sm" id="voucher_dterr">

                            <div class="input-group-prepend">

                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>

                            </div>

                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="voucher_dt" id="voucher_dt" value="" readonly>

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

                           " id="billVouchergeneratebtn">Generate</button>

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







