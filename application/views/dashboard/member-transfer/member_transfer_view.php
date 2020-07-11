<script src="<?php echo base_url(); ?>assets/js/customJs/membertransfer.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Searching Member Code and Transfer Member</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>            -->
            </div><!-- /.card-header -->

          
           
            <div class="card-body">

            <div class="formblock-box">

                  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Searching Last Member Code Info</h3>  
             
                 <div class = "row">
                     <div class="col-md-3">
                         <label>Category</label>
                             <div class="form-group">
                                 <div class="input-group input-group-sm">
                                      <select class="form-control select2" id="member_cat_id" name="member_cat_id" style="width: 100%;">
                                          <option value=''>Select</option>
                                             <?php foreach ($bodycontent['membercategoryList'] as $membercategoryList) { ?>

                                                 <option value="<?php echo $membercategoryList->cat_id; ?>" data-memcattag = "<?php echo $membercategoryList->member_tag; ?>"

                                                  ><?php echo $membercategoryList->category_name; ?></option>
                                
                                                  <?php   } ?>
                                
                                        </select>
                                         
                                  </div>
                              </div>
                    
                        </div>
                        <div class="col-md-3">
                            <label for="surname">Surname</label>
                                <div class="form-group">
                                   <div class="input-group input-group-sm">
                                        <input type="text" class="form-control onlyalpha" name="surname" id="surname" placeholder="Enter Surname Name" value="" style="text-transform:uppercase;">
                                   </div>
                               </div>
                           
                       </div>
                       <div class="col-md-2">
                            <label for="last_code">Last Code</label>
                                <div class="form-group">
                                   <div class="input-group input-group-sm">
                                        <input type="text" class="form-control resetval" name="last_code" id="last_code" placeholder="" value="" readonly>
                                   </div>
                               </div>
                           
                       </div>
                       <div class="col-md-3">
                       <label for="button">&nbsp;</label>
                                <div class="form-group">
                                   <div class="input-group input-group-sm">
                                        <button type="button" class="btn btn-sm action-button" id="viewlastcode">View</button>
                                   </div>
                               </div>
                           
                       </div>
                    </div>
             </div>
             <form name="membertransferFrom" id="membertransferFrom" enctype="multipart/form-data">

               <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Membership Transfer Info</h3> 
                           
                         <div class="row">   

                         <div class="col-md-3">
                             <label>Existing Code</label>
                                <div class="form-group">
                                     <div class="input-group input-group-sm" id="memberexisting">
                                         <select class="form-control select2" id="existing_code" name="existing_code" disabled  style="width: 100%;">
                                             <option value=''>Select</option>
                                             <!-- <?php foreach ($bodycontent['ExistingcodeList'] as $ExistingcodeList) { ?>

                                                 <option value="<?php echo $ExistingcodeList->member_id; ?>" 

                                                  ><?php echo $ExistingcodeList->member_code; ?></option>
                                
                                                  <?php   } ?> -->
                                
                                        </select>
                                         
                                  </div>
                              </div>                    
                           </div>                        
                              <div class="col-md-3">
                                <label for="change_code">Change Code</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control resetval" name="change_code" id="change_code" placeholder="" value="" readonly>
                                </div>
                              </div>
                           
                              </div>
                              <div class="col-md-3">
                                <label for="subscription">Subscription</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control resetval numberwithdecimal" name="subscription" id="subscription" placeholder="" value="">
                                </div>
                              </div>
                           
                              </div>  
                          
                                <div class="col-md-3">
                                     <label>Social Sub</label>
                                          <div class="form-group">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control resetval numberwithdecimal" name="social_sub" id="social_sub" placeholder="" value="">
                                        
                                                </div>
                                           </div>
                            
                                 </div>
                               
                </div>
                <div class="row">
                    <div class="col-md-3 infosection">
                            <label for="title_one" >Name*</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                               
                                <input type="text" class="form-control resetval" name="member_name" id="member_name" placeholder="" value="" style="width: 82%" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                          <label for="address_one">Address 1</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval "  name="address_one" id="address_one" im-insert="false" value="" />
                              </div>
                          </div>                           
                        </div>
                        <div class="col-md-3">
                          <label for="address_two">Address 2</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval"  name="address_two" id="address_two" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="address_three">Address 3</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control resetval"  name="address_three" id="address_three" im-insert="false" value="" />
                              </div>
                          </div>
                        </div>
                     
                </div>
                <div class="row">
                
                      <div class="col-md-3">
                          <label for="phone" >Phone No.</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control onlynumber resetval" name="phone" id="phone" im-insert="false" value="">
                              </div>
                            </div>
                        </div>
                      <div class="col-md-3">
                        <label for="mobile_no" >Mobile No*</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control onlynumber resetval"  name="mobile_no" id="mobile_no" im-insert="false" value="" maxlength=10>
                            </div>
                          </div>
                         
                          </div>
                      
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="from_date">From Date</label>
                           
                               <div class="input-group input-group-sm" id="bill_dterr">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                   </div>
                                     <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="from_date" id="from_date" value="<?php echo date('d/m/Y');?>" readonly>
                               </div>
                        </div>
                    
                    </div>
                </div>

              </div>

               <div class="formblock-box">
                   <div class="row">

                          <div class="col-md-8">
                       
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="transfersavebtn" style="width: 60%;">Save</button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;">Saving...</span>
                           </div>

                   
                      <div class="col-md-2">
                       <button type="reset" id="resetgrpform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                     </div>
                   
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

