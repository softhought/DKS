<script src="<?php echo base_url(); ?>assets/js/customJs/master/membermaster.js"></script>


<section class="layout-box-content-format1">
   <div class="card card-primary">
      <div class="card-header box-shdw">
          <h3 class="card-title">Member Registration</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>membermaster" class="btn btn-default"><i class="fas fa-clipboard-list"></i> List</a>
              </div>
                           
      </div><!-- /.card-header -->
                            
<div class="card-body">

  <form id="memberregistration" name="memberregistration" enctype="multipart/form-data">
    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">

    <input type="hidden" name="memberId" id="memberId" value="<?php echo $bodycontent['memberId']; ?>"> 



<!-- Member Personal Info -->
      <div class="formblock-box">
          <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Personal Info</h3>

             <div class="row">
                <div class="col-md-8">
                  <div class="row">

                    <div class="col-md-4">
                      <label for="membercode">Member Code</label>
                        <div class="form-group">
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control" name="member_code" id="member_code" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->member_code; } ?>" readonly>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-8 infosection">
                        <label for="title_one" >Name*</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" id="title_one" name  ="title_one" style="width: 18%">
                                  <option value=''>&nbsp; </option>
                                  <?php foreach ($bodycontent['titleofneme'] as $value) { ?>
                                  <option value="<?php echo $value; ?>"
                                      <?php if($bodycontent['mode'] == 'EDIT' && $value == $bodycontent['memberEditdata']->title_one){ ?> selected <?php  } ?>><?php echo $value; ?>
                                   </option>
                                                <?php   } ?>
                              </select>
                              <input type="text" class="form-control" name="member_name" id="member_name" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->member_name; } ?>" style="width: 82%">
                            </div>
                         </div>
                      </div>
                                    
                   </div>

                  <div class="row error-row-block">
                      <div class="col-md-4"></div>
                        <div class="col-md-8">
                          <p id="membernameerr"></p>
                        </div>
                      </div>

                   <div class="row">
                     <div class="col-md-4">
                       <label for="mem_dob" >DOB</label>
                       <div class="form-group">
                         <div class="input-group input-group-sm">
                           <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                             <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="mem_dob" id="mem_dob" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['memberEditdata']->date_of_birth != ''){ echo date('d/m/Y',strtotime($bodycontent['memberEditdata']->date_of_birth)); } ?>" />
                          </div>
                        </div>
                         <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="memberdoberr"></p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="col-md-4">
                        <label for="member_occupation" >Occupation</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" id="member_occupation" name="member_occupation">
                                <option value=''>&nbsp; </option>
                                  <?php foreach ($bodycontent['occuptionlist'] as $occuptionlist) { ?>
                                   <option value="<?php echo $occuptionlist->id; ?>"
                                     <?php if($bodycontent['mode'] == 'EDIT' && $occuptionlist->id == $bodycontent['memberEditdata']->occupation_id){ echo 'selected'; } ?>>
                                          <?php echo $occuptionlist->occupation_name; ?>
                                    </option>
                                        <?php   } ?>
                              </select>
                              
                          </div>
                        </div>
                        <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="memberoccuperr"></p>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-4">
                        <label for="mem_category" >Category</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" id="mem_category" name="mem_category">
                                <option value=''>&nbsp; </option>
                                  <?php foreach ($bodycontent['categorylist'] as $categorylist) { ?>
                                   <option value="<?php echo $categorylist->cat_id; ?>"
                                     <?php if($bodycontent['mode'] == 'EDIT' && $categorylist->cat_id == $bodycontent['memberEditdata']->category){ echo 'selected'; } ?>>
                                          <?php echo $categorylist->category_name; ?>
                                    </option>
                                        <?php   } ?>
                              </select>
                              
                          </div>
                        </div>
                          <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="membercatperr"></p>
                              </div>
                          </div>
                      </div>
                    
                    </div>
                  

                    <div class="row">
                      <div class="col-md-4">
                          <label for="landline_no" >Phone No.</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control onlynumber" name="landline_no" id="landline_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->phone; } ?>">
                              </div>
                            </div>
                        </div>
                      <div class="col-md-4">
                        <label for="landline_no" >Mobile No*</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control onlynumber"  name="mobile_no" id="mobile_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->mobile; } ?>" maxlength=10>
                            </div>
                          </div>
                          <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="mobileerr"></p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <label for="email" >Email</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <input type="email" class="form-control" name="email" id="email" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->email; } ?>">
                            </div>
                          </div>
                           <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="emailerr"></p>
                              </div>
                          </div>
                        </div>
                        
                      </div>

                      

                 </div><!-- end of info section -->
                 <div class="col-md-4 uploadProfile">
                    <label for="profilepic"></label>
                     <div class="form-group profile-block">
                        <img src='<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['memberEditdata']->image_name != ''){ ?> <?php echo base_url(); ?>assets/img/member-images/<?php echo $bodycontent["memberEditdata"]->image_name; } ?>' id="showimage" style="width: 120px;height:125px;border: 1px solid #6d78cb;margin-bottom:13px; ">
                     <div class="inputWrapper">
                        <label class="btn  btn-default btn-flat">Upload Photo 
                          <input class="fileInput "  type='file' custom-file-input name='imagefile' id="imagefile" size='20' onchange="readURL(this);" style="display: none;" accept="image/*">
                         </label>
                         <input type='hidden' name='isImage' id="isImage" value="N">
                      </div>
                     </div>
                    </div> <!-- end of uploadProfile section -->
                  </div> <!-- end of infosection & uploadProfile section -->
            
                </div>
                    <!-- End of Student Personal Info -->
   
      

        <div class="row">
          <div class="col-md-9">
                      <!------------ Address Info ----->
              <div class="formblock-box">
                      <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Address Info</h3>

                      <div class="row">
                        <div class="col-md-4">
                          <label for="address_one">Address 1</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control "  name="address_one" id="address_one" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->address_one; } ?>" />
                              </div>
                          </div>
                            <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="addressoneerr"></p>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="address_two">Address 2</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control "  name="address_two" id="address_two" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->address_two; } ?>" />
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="address_three">Address 3</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control "  name="address_three" id="address_three" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->address_three; } ?>" />
                              </div>
                          </div>
                        </div>
                      </div>

                    
                      <div class="row">
                        <div class="col-md-4">
                            <label for="city">City*</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" name="city" id="city" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->city; } ?>">
                                </div>
                            </div>
                             <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="cityerr"></p>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="pincode">Pincode*</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control onlynumber"  name="pincode" id="pincode" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->pin; } ?>" maxlength='6'>
                            </div>
                          </div> 
                           <div class="row error-row-block">
                            <div class="col-md-12">
                              <p id="pincodeerr"></p>
                              </div>
                          </div>                      
                        </div>
                       
                      </div>

                      <div class="row error-row-block">
                        <div class="col-md-12"><p id="pincodeerr"></p></div>
                      </div>
                  </div>

                    <!------------ End of Address Info ----->


                 
                <!--  Other Info ------------------->

                <div class="formblock-box">
                      <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Other Info</h3>


                      <div class="row">
                        <div class="col-md-4">
                          <label for="admissiondate">Admission Date*</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="admission_date" id="admission_date" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['memberEditdata']->admission_date != ''){ echo date('d/m/Y',strtotime($bodycontent['memberEditdata']->admission_date)); } ?>">
                              </div>
                          </div>
                          <div class="row error-row-block">
                        <div class="col-md-12"><p id="addmissionerr"></p></div>
                      </div>
                        </div>
                       
                        <div class="col-md-4">
                            <label for="status">Status*</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                <select class="form-control select2" id="status" name="status" style="width: 100%;">
                                      <option value=''>Select</option>
                                      <?php foreach ($bodycontent[ 'studentstatus'] as $studentstatus) { ?>
                                      <option value="<?php echo $studentstatus; ?>" <?php if($bodycontent[ 'mode']=='EDIT' && $studentstatus==$bodycontent['memberEditdata']->status){ echo 'selected'; } ?> >
                                          <?php echo $studentstatus; ?>
                                      </option>

                                      <?php } ?>

                                </select>
                              </div>
                            </div>
                             <div class="row error-row-block">
                               <div class="col-md-12"><p id="statuserr"></p></div>
                              </div>
                        </div>
                     
                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="closing_dt">Closing Date</label>
                          <div class="input-group input-group-sm">
                           <div class="input-group-prepend">
                             <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                           </div>
                           <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="closing_dt" id="closing_dt" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['memberEditdata']->close_dt != ''){ echo date('d/m/Y',strtotime($bodycontent['memberEditdata']->close_dt)); } ?>">
                         </div>
                       </div>
                          <div class="row error-row-block">
                               <div class="col-md-12"><p id="closdterr"></p></div>
                              </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">

                           <label for="min_billing">Min Billing</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                <select class="form-control select2" id="min_billing" name="min_billing" style="width: 100%;">
                                      <option value=''>Select</option>
                                      <?php foreach ($bodycontent[ 'YorNlist'] as $YorNlist) { ?>
                                      <option value="<?php echo $YorNlist; ?>" <?php if($bodycontent[ 'mode']=='EDIT' && $YorNlist==$bodycontent[ 'memberEditdata']->min_billing){ echo 'selected'; } ?> >
                                          <?php echo $YorNlist; ?>
                                      </option>

                                      <?php } ?>

                                </select>
                              </div>
                            </div>
                          
                        </div>
                        <div class="col-md-4">

                           <label for="serv_tax_resp">Chg Srv Tex</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                <select class="form-control select2" id="serv_tax_resp" name="serv_tax_resp" style="width: 100%;">
                                      <option value=''>Select</option>
                                      <?php foreach ($bodycontent[ 'YesorNolist'] as $key => $YesorNolist) { ?>
                                      <option value="<?php echo $key; ?>" <?php if($bodycontent[ 'mode']=='EDIT' && $key == $bodycontent[ 'memberEditdata']->serv_tax_resp){ echo 'selected'; } ?> >
                                          <?php echo $YesorNolist; ?>
                                      </option>

                                      <?php } ?>

                                </select>
                              </div>
                            </div>
                          
                        </div>
                         <div class="col-md-4">
                          <label for="year_opening_bal">Opening Balance</label>
                          <div class="input-group input-group-sm">
                          
                           <input type="text" class="form-control numberwithdecimal"  name="year_opening_bal" id="year_opening_bal" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo ''; } ?>">
                         </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">

                          <label for="ceiling">Ceiling</label>
                          <div class="input-group input-group-sm">
                          
                           <input type="text" class="form-control numberwithdecimal"  name="ceiling" id="ceiling" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->min_ceiling; } ?>">
                         </div>
                          
                        </div>
                      </div>

                  </div>


                <!-- End of Other Info ------------------->
                    
          <!-- Additional Detail -->
          <div class="formblock-box"> 
            <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Additional Info</h3>
       
              <div class="row">
               <div class="col-md-4">
                          <div class="form-group ">
                            <label for="social_sub">Social Subs</label>
                           
                             <div class="input-group input-group-sm">
                               <input type="text" class="form-control numberwithdecimal" name="social_subs" id="social_subs"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->social_subs; } ?>">
                            </div>

                          </div>
                 </div>
                <div class="col-md-4">
                          <div class="form-group">
                            <label for="elt_member">Special Member</label>
                            <div class="input-group input-group-sm">
                               <select class="form-control select2" name="elt_member" id="elt_member" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['YorNlist'] as $YorNlist) { ?>

                              <option value="<?php echo $YorNlist; ?>"

                              <?php if($bodycontent['mode'] == 'EDIT' && $YorNlist == $bodycontent['memberEditdata']->elt_member){ echo 'selected'; } ?>  >
                                <?php echo $YorNlist; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
               </div>

              

                <div class="col-md-4">
                          <div class="form-group">
                            <label for="block_status">Block Status</label>
                            <div class="input-group input-group-sm">
                               <select class="form-control select2" name="block_status" id="block_status" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['YorNlist'] as $YorNlist) { ?>

                              <option value="<?php echo $YorNlist; ?>"

                              <?php if($bodycontent['mode'] == 'EDIT' && $YorNlist == $bodycontent['memberEditdata']->blocked_y_n){ echo 'selected'; } ?>


                                >
                                <?php echo $YorNlist; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          
               </div>
              

              
                                
              </div>
             
                 
                              </div>  <!-- end of  Coaching Detail -->

           <div class="formblock-box"> 
            <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Spouse Info</h3>

            <div class="row">
            
            <div class="col-md-8 infosection">
                        <label for="title_two" >Name*</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" id="title_two" name  ="title_two" style="width: 18%">
                                  <option value=''>&nbsp; </option>
                                  <?php foreach ($bodycontent['titleofneme'] as $value) { ?>
                                  <option value="<?php echo $value; ?>"
                                      <?php if($bodycontent['mode'] == 'EDIT' && $value == $bodycontent['memberEditdata']->title_two){ ?> selected <?php  } ?>><?php echo $value; ?>
                                   </option>
                                                <?php   } ?>
                              </select>
                              <input type="text" class="form-control" name="spouse_name" id="spouse_name" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['memberEditdata']->spouse_name; } ?>" style="width: 82%">
                            </div>
                         </div>
                      </div>
                     <div class="col-md-4">
                       <label for="spouse_dob" >DOB</label>
                       <div class="form-group">
                         <div class="input-group input-group-sm">
                           <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                             <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="spouse_dob" id="spouse_dob" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['memberEditdata']->spouse_dob != ''){ echo date('d/m/Y',strtotime($bodycontent['memberEditdata']->spouse_dob)); } ?>" />
                          </div>
                        </div>
                        <div class="row error-row-block">
                               <div class="col-md-12"><p id="spousedobdterr"></p></div>
                              </div>
                      </div>
                    </div>
                   <div class="row">

                    <div class="col-md-4">
                        <label for="spouse_occupation" >Occupation</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" id="spouse_occupation" name="spouse_occupation">
                                <option value=''>&nbsp; </option>
                                  <?php foreach ($bodycontent['occuptionlist'] as $occuptionlist) { ?>
                                   <option value="<?php echo $occuptionlist->id; ?>"

                                      <?php if($bodycontent['mode'] == 'EDIT' && $occuptionlist->id == $bodycontent['memberEditdata']->spouse_occupation){
                                        echo 'selected';

                                      } ?>
                                     >
                                          <?php echo $occuptionlist->occupation_name; ?>
                                    </option>
                                        <?php   } ?>
                              </select>
                              
                          </div>
                        </div>
                      </div>
                       <div class="col-md-4">
                        <label for="spouse_gender">Gender</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" id="spouse_gender" name="spouse_gender">
                                <option value=''>&nbsp; </option>
                                  <?php $genderlist = json_decode (GENDER_LIST);
                                  foreach ($genderlist as $key => $value) { ?>
                                   <option value="<?php echo $key; ?>"
                                    <?php if($bodycontent['mode'] == 'EDIT' && $key == $bodycontent['memberEditdata']->spouse_gender){ echo 'selected';

                                      } ?>
                                    >
                                          <?php echo $value; ?>
                                    </option>
                                        <?php   } ?>
                              </select>
                              
                          </div>
                        </div>
                      </div>
                       <div class="col-md-4">
                        <label for="spouse_mobile" >Mobile No.</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                             
                              <input type="text" class="form-control onlynumber" name="spouse_mobile" id="spouse_mobile" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo 
                              $bodycontent['memberEditdata']->spouse_mobile; }?>">
                          </div>
                        </div>
                      </div>

                     
                   </div> 
                   <div class="row">
                     <div class="col-md-4">
                      <label for="spouse_email" >Email</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                             
                              <input type="email" class="form-control" name="spouse_email" id="spouse_email" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo 
                              $bodycontent['memberEditdata']->spouse_email; }?>" >
                          </div>
                        </div>
                       
                     </div>
                   </div>



            </div>                   

                            </div>

                            <div class="col-md-3 memblock">
                               <span class="spansty">Details</span>
                               <div class="formblock-box">
                               
                           

                              <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                     <div class="input-group input-group-sm">

                                   <input type="text" class="form-control" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: center;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">

                                         <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: center;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">Year Opening</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">APR</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">MAY</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">JUN</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">JUL</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">AUG</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">SEP</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">OCT</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                               <div class="row">
                                 <label for="specialcoching" class="col-md-5">NOV</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                              <div class="row">
                                 <label for="specialcoching" class="col-md-5">DEC</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                              <div class="row">
                                 <label for="specialcoching" class="col-md-5">JAN</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                              <div class="row">
                                 <label for="specialcoching" class="col-md-5">FEB</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                              <div class="row">
                                 <label for="specialcoching" class="col-md-5">MAR</label>
                                <div class="col-md-7">
                                   <div class="form-group">
                                      <div class="input-group input-group-sm">
                                  
                                        <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="" readonly="" style="text-align: right;">
                                  
                                </div>
                              </div>
                            </div>
                                
                              </div>
                            </div>
                         
                        </div>
                          </div>

                 <div class="formblock-box">
                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Children Info</h3>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="childname">Name</label>
                      <div class="form-group childnameerr">
                          <div class="input-group input-group-sm">                                  
                             <input type="text" class="form-control" name="children_name" id="children_name" im-insert="false" value="">
                                  
                          </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <label for="child_dob">DOB</label>
                      <div class="form-group" id="childdoberr">
                          <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>    
                             <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="child_dob" id="child_dob" im-insert="false" value="" />
                                  
                          </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <label for="child_occupation">Occupation</label>
                      <div class="form-group">
                          <div class="input-group input-group-sm">
                                  
                            <select class="form-control select2" id="child_occupation" name="child_occupation">
                                <option value=''>&nbsp; </option>
                                  <?php foreach ($bodycontent['occuptionlist'] as $occuptionlist) { ?>
                                   <option value="<?php echo $occuptionlist->id; ?>"
                                     >
                                          <?php echo $occuptionlist->occupation_name; ?>
                                    </option>
                                        <?php   } ?>
                              </select>
                                  
                          </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <label for="children_gender">Gender</label>
                      <div class="form-group" id="childgenerr">
                          <div class="input-group input-group-sm">
                                  
                             <select class="form-control select2" id="children_gender" name="children_gender">
                                <option value=''>&nbsp; </option>
                                  <?php $genderlist = json_decode (GENDER_LIST);

                                  foreach ($genderlist as $key => $genderlist) { ?>
                                   <option value="<?php echo $key; ?>"
                                     >
                                          <?php echo  $genderlist; ?>
                                    </option>
                                        <?php   } ?>
                              </select>
                                  
                          </div>
                        </div>
                    </div>
                     <div class="col-md-2">
                      <label for="child_mobile">Mobile</label>
                      <div class="form-group childmobileerr">
                          <div class="input-group input-group-sm">
                                  
                             <input type="text" class="form-control onlynumber" name="child_mobile" id="child_mobile" im-insert="false" value="" maxlength="10">
                                  
                          </div>
                        </div>
                    </div>
                     <div class="col-md-1">
                       <label for="addbtn">&nbsp;</label>
                      <div class="form-group">
                          <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-sm action-button" id="addchilddtl"><i class="fas fa-plus"></i> Add</button>
                   </div>
                 </div>
                    </div>
                  </div>
                  <!-- children details  -->
 <div class="row">
      <div class="col-sm-12">
          <div  id="detail_memberchild" style="#border: 1px solid #e49e9e;">
             <div class="table-responsive">
                 <?php
                          $rowno=0;
                          $detailCount = 0;
                          if($bodycontent['mode']=="EDIT")
                          {
                           $detailCount = sizeof($bodycontent['memberchildtl']);
                           //$detailCount = 0;
                          }

                          // For Table style Purpose
                          if($bodycontent['mode']=="EDIT" && $detailCount>0)
                          {
                            $style_var = "display:block;width:100%;";
                          }
                          else
                          {
                            $style_var = "display:none;width:100%;";
                          }
                        ?>

<table class="table table-bordered" style="font-size: 13px;color: #354668;<?php echo $style_var; ?>">
    <thead>                  
         <tr>
                     
            <th>Name</th>
            <th>Date Of Birth</th>
            <th>Occupation</th>
            <th>Gender</th>
            <th>Mobile No.</th>                                         
            <th style="width: 80px;" >Action</th>
          </tr>
     </thead>
  <tbody>
    <input type="hidden" name="delIds" id="delIds" value="">
   

 <?php foreach ($bodycontent['memberchildtl'] as $memberchildtl) { ?>
                      
                         
    <tr id="rowchilddetails_<?php echo $rowno; ?>" class="childDtlCls" >

      <input type="hidden" name="editbtncheck" id="editbtncheck_<?php echo $rowno; ?>" value="N">  
      <input type="hidden" name="childdtlId[]" id="childdtlId_<?php echo $rowno; ?>" value="<?php echo $memberchildtl->id; ?>"> 
    
    <td style="text-align: left;width: 20%"> 
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm">   
               <input type="hidden" class="form-control valch_<?php echo $rowno; ?> editchilddtl_<?php echo $rowno; ?>"  name="child_name[]" id="child_name_<?php echo $rowno; ?>" value="<?php echo $memberchildtl->name; ?>">  
             </div>
        </div> 
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $memberchildtl->name; ?></span>                   
    </td>
    <td style="text-align: left;width: 20%"> 
        <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>     
               <input type="hidden" class="form-control valch<?php echo $rowno; ?> datemask editchilddtl_<?php echo $rowno; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask=""  name="children_dob[]" id="children_dob_<?php echo $rowno; ?>" value="<?php if($memberchildtl->dob != ''){
      echo date('d/m/Y',strtotime($memberchildtl->dob)); } ?>">
            </div>
         </div>          
     <span class="showdata_<?php echo $rowno; ?>"><?php if($memberchildtl->dob != ''){
      echo date('d/m/Y',strtotime($memberchildtl->dob)); } ?></span>                   
    </td>
     <td style="text-align: left;width: 20%"> 

          <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
             <div class="input-group input-group-sm"> 
                 
                  <select class="form-control select2" name="children_occup[]" id="children_occup_<?php echo $rowno; ?>">
                    <option value=''>&nbsp; </option>
                      <?php $occup_name ='';
                      foreach ($bodycontent['occuptionlist'] as $occuptionlist) { ?>
                               <option value="<?php echo $occuptionlist->id; ?>" 
                                
                                <?php if($occuptionlist->id == $memberchildtl->child_occuption){
                                    echo 'selected'; $occup_name =$occuptionlist->occupation_name; 
                                } ?>

                                >
                                    <?php echo $occuptionlist->occupation_name; ?>
                                </option>
                       <?php   } ?>
                  </select>


               </div>
         </div>          

  <!--   <input type="hidden" name="children_occup[]" id="children_occup_<?php echo $rowno; ?>" value="<?php echo $child_occupation;?>">  -->  
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $occup_name;?></span>                   
    </td>
    <td style="text-align: left;width: 20%"> 

        <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
             <div class="input-group input-group-sm"> 
                 
                  <select class="form-control select2" name="children_gender[]" id="children_gender_<?php echo $rowno; ?>">
                   <option value=''>&nbsp; </option>
                                  <?php $genderlist = json_decode (GENDER_LIST);

                                  foreach ($genderlist as $key => $genderlist) { ?>
                                   <option value="<?php echo $key; ?>"
                                    <?php if($key == $memberchildtl->gender){
                                         echo 'selected'; $gendername =$genderlist; 
                                      } ?>
                                     >
                                          <?php echo  $genderlist; ?>
                                    </option>
                                        <?php   } ?>
                  </select>


               </div>
         </div>
    <!-- <input type="hidden" name="children_gender[]" id="children_gender_<?php echo $rowno; ?>" value="<?php echo $children_gender;?>"> -->   
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $gendername;?></span>                  
    </td>
     <td style="text-align: left;width: 20%">
       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="hidden" class="form-control onlynumber editchilddtl_<?php echo $rowno; ?>" name="children_mobile[]" id="children_mobile_<?php echo $rowno; ?>" value="<?php echo $memberchildtl->mobile; ?>" maxlength=10> 
             </div>
         </div>         
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $memberchildtl->mobile; ?> </span>                  
    </td>
   
    
    <td style="vertical-align: left;">
              
     <a href="javascript:;" class="editchilddetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
     </a>&emsp;
           
   <a href="javascript:;" class="delchildDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
           <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
           

    </a>
        
        
      </td>       
        
    
    </tr>
    
   
 <?php $rowno++; } ?>  
            
    
               
                 <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">     
                  </tbody>
                </table>
                </div><!-- end of table responsive -->
                </div>
             
                </div>



                      
                    </div>

                <!--end children details -->

                 </div>          
                        

              <div class="formblock-box">
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2 text-right">
                      <button type="submit" class="btn btn-sm action-button" id="membersavebtn" style="width: 57%;"><?php echo $bodycontent['btnText']; ?></button>

                        <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 57%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                    </div>
                </div>
              </div>

                
                   </form>
                
                </div>
         
          <!-- /.card-body -->
        </div><!-- /.card -->
    </section>

