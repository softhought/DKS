<script src="<?php echo base_url(); ?>assets/js/customJs/member_facility/pujacontribution.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">puja contribution </h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                <a href="javascript:;" class="btn btn-info btnpos" id="pujacontributioncopybtn">
              <i class="fas fa-copy"></i><span id="cpspan"> Copy </span></a>
              <a href="<?php echo base_url(); ?>pujacontribution" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>
             
                           
            </div><!-- /.card-header -->

           <form name="pujacontributionFrom" id="pujacontributionFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           
            <div class="card-body">
              <div class="formblock-box">

                
         
            <div id="add_div">

             <div class="row">

                 <div class="col-md-2">
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
               <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Contribution </label>
                            <div class="input-group input-group-sm" id="contributionerr">
                            <input type="text" class="form-control forminputs " id="contribution" name="contribution" placeholder="" autocomplete="off" value=""  onKeyUp="numericFilter(this);"  >
                            </div>

                          </div>
              </div><!-- end of col-md-3 -->  

              <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">S/Tax </label>
                            <div class="input-group input-group-sm" id="subscriptionerr">
                            <input type="text" class="form-control forminputs " id="service_tax" name="service_tax" placeholder="" autocomplete="off" value=""  onKeyUp="numericFilter(this);"  >
                            </div>

                          </div>
              </div><!-- end of col-md-3 --> 

              <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Total </label>
                            <div class="input-group input-group-sm" id="subscriptionerr">
                            <input type="text" class="form-control forminputs " id="total" name="total" placeholder="" autocomplete="off" value=""  onKeyUp="numericFilter(this);" readonly >
                            </div>

                          </div>
              </div><!-- end of col-md-3 -->  
                  

                
                    

          
              
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
                           <button type="submit" class="btn btn-sm action-button" id="pujacontributionbtn">View</button>
                            </div>

                          </div>
               
              </div>

               <div class="col-md-1">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button" id="pujacontributionApplybtn">Apply</button>
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
                           <button type="submit" class="btn btn-sm action-button" id="pujacontributionCopybtn">Copy</button>
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



