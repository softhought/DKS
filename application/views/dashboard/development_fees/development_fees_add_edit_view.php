<script src="<?php echo base_url(); ?>assets/js/customJs/member_facility/development_fees.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Development Fees</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                <a href="javascript:;" class="btn btn-info btnpos" id="benvolentcopybtn">
              <i class="fas fa-copy"></i><span id="cpspan"> Copy </span></a>
              <a href="<?php echo base_url(); ?>developmentfees" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>
             
                           
            </div><!-- /.card-header -->

           <form name="developmentFrom" id="developmentFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
            <input type="hidden" name="cgst_id" id="cgst_id" value="<?php echo $bodycontent['parameterData']->cgst_id; ?>">
           <input type="hidden" name="sgst_id" id="sgst_id" value="<?php echo $bodycontent['parameterData']->sgst_id; ?>">
            <div class="card-body">
              <div class="formblock-box">

                
              <!-- <a href="<?php echo base_url(); ?>intratournament/copyHeaderView" class="">
                <span  class="copycls" ><i class="fas fa-cog"></i>&nbsp;Copy&nbsp; </span> 
                </a> 
 -->
            <div id="add_div">

             <div class="row">

             
               <div class="col-md-1">
                          <div class="form-group">
                            <label for="specialcoching">Month</label>
                            <div class="input-group input-group-sm" id="sel_montherr">
                               <select class="form-control select2" name="sel_month" id="sel_month" >
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
               <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Amount </label>
                            <div class="input-group input-group-sm" id="amounterr">
                            <input type="text" class="form-control forminputs " id="amount" name="amount" placeholder="" autocomplete="off" value=""  onKeyUp="numericFilter(this);"  >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->  
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">CGST%</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="cgst_rate" name="cgst_rate" placeholder="" autocomplete="off" value="<?php echo $bodycontent['parameterData']->cgst_rate; ?>"  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">CGST Amt</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="cgst_amt" name="cgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->cgst_amt;}?>"  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">SGST%</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="sgst_rate" name="sgst_rate" placeholder="" autocomplete="off" value="<?php echo $bodycontent['parameterData']->sgst_rate; ?>"  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">SGST Amt</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="sgst_amt" name="sgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->sgst_amt;}?>">
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

          
                <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Net Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs" id="net_amt" name="net_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->total_amount;}?>"  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                 <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Head(s)</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="heads" name="heads" placeholder="" autocomplete="off" value="" style="text-transform:uppercase"  readonly >
                            </div>

                          </div>
               </div>      
              <div class="col-md-1 text-right">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button" id="developmentfeestbtn">View</button>
                            </div>

                          </div>
               
              </div>

               <div class="col-md-1">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button" id="developmentAmountApplybtn">Apply</button>
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
                            <label for="specialcoching">Category</label>
                            <div class="input-group input-group-sm" id="copycategoryerr">
                               <select class="form-control select2" name="copycategory" id="copycategory" >
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

                       <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button" id="developmentCopybtn">Copy</button>
                            </div>

                          </div>
               
              </div>




               </div>


               
             </div>



               <div class="row">
               <div class="col-md-3">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
                  <p id="errormsg" class="error"></p>
               </div>
                 <div class="col-md-5 colmargin">
                  
                 </div>
               
             </div>





             <hr>

              <div id="member_list" style="padding: 5px;">
                
              </div>
             </div>
                      
          </div> <!-- /.card-body -->
        

        


     </form>


        




        </div><!-- /.card -->
  </section>



