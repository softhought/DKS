<script src="<?php echo base_url(); ?>assets/js/customJs/yearly_statement/yearly_statement.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
 <style> 
         
            @media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
        </style>             
            

            <div class="card-header box-shdw">
              <h3 class="card-title">MEMBER BILL Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  
                </div>
      
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
 <fieldset class="scheduler-border formblock-box">
               <div class="row">
               <div class="col-sm-6">
               <div class="row">
                    
                     <div class="col-sm-3">
                      <div class="form-group">
                      <label for="student">From Month</label>
                       <div class="input-group input-group-sm" id="from_montherr">
                            
                     <select class="form-control select2" name="from_month" id="from_month" >
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

                      <div class="col-sm-3">
                      <div class="form-group">
                      <label for="student">To Month</label>
                       <div class="input-group input-group-sm" id="to_montherr">
                            
                     <select class="form-control select2" name="to_month" id="to_month" >
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
                    
       <div class="col-md-4">
                          <div class="form-group">
                            <label for="student">Member Code</label>
                             <div id="resetmemberlist">
                             <div class="input-group input-group-sm" id="sel_member_codeerr">
                              <select class="form-control select2" name="sel_member_code" id="sel_member_code" >
                              <option value="">Select</option>
                              <?php 
                              foreach ($bodycontent['memberList'] as  $membercode) {    
                              ?>
                              <option value="<?php echo $membercode->member_id;?>"
                               data-name="<?php echo $membercode->title_one." ".$membercode->member_name; ?>" 
                               data-status="<?php echo $membercode->status; ?>"   
                               data-addressone="<?php echo $membercode->address_one; ?>"   
                               data-addresstwo="<?php echo $membercode->address_two; ?>"   
                               data-addressthree="<?php echo $membercode->address_three; ?>"   
                               data-memberphone="<?php echo $membercode->address_three; ?>"   
                               data-membermobile="<?php echo $membercode->address_three; ?>"   
                              ><?php echo $membercode->member_code;?></option>
                              <?php } ?>
                             
                            </select>
                            </div></div>

                          </div>


           </div><!-- end of col-md-6 -->

           
              <div class="col-md-6">
                 <div class="form-group">
                            <label for="firstname">Name</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="member_name" name="member_name" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>

                    </div>

                   <div class="col-sm-4">
                     <div class="form-group">
                            <label for="firstname">Status</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="member_status" name="member_status" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>
                       
                    </div>










              </div>

              </div>

              <div class="col-sm-6">
               <div class="row">

                   <div class="col-sm-4">
                     <div class="form-group">
                            <label for="firstname">Address</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="address_one" name="address_one" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>
                       
                    </div>
                     <div class="col-sm-4">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="address_two" name="address_two" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>
                       
                    </div>
                     <div class="col-sm-4">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="address_three" name="address_three" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>
                       
                    </div>

                    <div class="col-sm-4">
                     <div class="form-group">
                            <label for="firstname">Phone</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="member_phone" name="member_phone" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>
                       
                    </div>
                      <div class="col-sm-4">
                     <div class="form-group">
                            <label for="firstname">Phone</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="member_mobile" name="member_mobile" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>
                       
                    </div>

                      <div class="col-sm-4">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="yearlystatementshowbtn" style="width: 60%;">Show</button>
                            </div>
                          </div>
                       
                    </div>

                   

                 

               </div>
               </div>

 </fieldset>



              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="memberbill_list_data" >
             
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>