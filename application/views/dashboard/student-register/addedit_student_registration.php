<script src="<?php echo base_url(); ?>assets/js/customJs/studentregister.js"></script>

<style>

/* .card-body .modal-body{
    #color: #44423d;

   
  }
  label{
    font-size: 14px;
     color: #354668 !important;
  }

 fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    #padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
        color:#9f4e7f;
        font-size: 13px !important;
    }
 .maxwidth{
  max-width: 10.33%;
  margin-left: -16px;
 }     */
</style>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Student Registration</h3>
              <!-- <a href="<?php echo base_url(); ?>studentregister" class="">
              <button class="btn btn-info btnpos">List</button></a> -->

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
               
                <a href="<?php echo base_url(); ?>studentregister" class="btn btn-default"><i class="fas fa-clipboard-list"></i> List</a>
                
               
              </div>
                           
            </div><!-- /.card-header -->
                            
                  <div class="card-body">

                    <form id="stdentregisterForm" name="stdentregisterForm" enctype="multipart/form-data">

                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">

                    <input type="hidden" name="admissionId" id="admissionId" value="<?php echo $bodycontent['admissionId']; ?>">   

                    <!-- Student Personal Info -->
                    <div class="formblock-box">
                      <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Personal Info</h3>

                          <div class="row">
                            <div class="col-md-8 infosection">
                                  <div class="row">
                                    <div class="col-md-4">
                                        <label for="studentcode">Student Code</label>
                                          <div class="form-group">
                                            <div class="input-group input-group-sm">
                                              <input type="text" class="form-control" name="studcode" id="studcode" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->student_code; } ?>" readonly>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-md-8">
                                      <label for="studname" >Name</label>
                                      <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="form-control select2" id="studtitle" name="studtitle" style="width: 18%">
                                                <option value=''>&nbsp; </option>
                                                <?php foreach ($bodycontent['titleofneme'] as $value) { ?>
                                                <option value="<?php echo $value; ?>"
                                                  <?php if($bodycontent['mode'] == 'EDIT' && $value == $bodycontent['studentregisterEditdata']->title_one){ ?> selected <?php  } ?>><?php echo $value; ?>
                                                </option>
                                                <?php   } ?>
                                            </select>
                                            <input type="text" class="form-control" name="studname" id="studname" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->student_name; } ?>" style="width: 82%">
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </div>

                                  <div class="row error-row-block">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                      <p id="studnameerr"></p>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-4">
                                      <label for="studdob" >DOB</label>
                                      <div class="form-group">
                                          <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="studdob" id="studdob" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->student_dob != ''){ echo date('d/m/Y',strtotime($bodycontent['studentregisterEditdata']->student_dob)); } ?>" />
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="father_title" >Father's /Mother's Name</label>
                                        <div class="form-group">
                                          <div class="input-group input-group-sm">
                                              <select class="form-control select2" id="father_title" name="father_title" style="width: 18%;">
                                                <option value=''>&nbsp; </option>
                                                <?php foreach ($bodycontent['titleofneme'] as $titleofneme) { ?>
                                                <option value="<?php echo $titleofneme; ?>"
                                                  <?php if($bodycontent['mode'] == 'EDIT' && $titleofneme == $bodycontent['studentregisterEditdata']->title_two){ echo 'selected'; } ?>>
                                                    <?php echo $titleofneme; ?>
                                                </option>
                                                <?php   } ?>
                                              </select>
                                              <input type="text" class="form-control"  name="fathername" id="fathername"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->guardian_name; } ?>">
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row error-row-block">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                      <p id="fathernameerr"></p>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-4">
                                        <label for="landline_no" >Mobile No 1</label>
                                        <div class="form-group">
                                          <div class="input-group input-group-sm">
                                              <input type="text" class="form-control onlynumber" name="landline_no" id="landline_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->phone_one; } ?>">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                      <label for="landline_no" >Mobile No 2</label>
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                              <input type="text" class="form-control onlynumber"  name="mobile_no" id="mobile_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->phone_two; } ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="landline_no" >Email</label>
                                        <div class="form-group">
                                              <div class="input-group input-group-sm">
                                              <input type="email" class="form-control" name="email" id="email" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->email; } ?>">
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row error-row-block">
                                    <div class="col-md-12"><p id="mobilenoerr"></p></div>
                                  </div>

                            </div><!-- end of info section -->
                            <div class="col-md-4 uploadProfile">
                                <label for="profilepic"></label>
                                <div class="form-group profile-block">
                                  <img src='<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->image_name != ''){ ?> <?php echo base_url(); ?>assets/img/student-images/<?php echo $bodycontent["studentregisterEditdata"]->image_name; } ?>' id="showimage" style="width: 120px;height:125px;border: 1px solid #6d78cb;margin-bottom:13px; ">
                                  <div class="inputWrapper">
                                    <label class="btn  btn-default btn-flat">Upload Photo 
                                      <input class="fileInput "  type='file' custom-file-input name='imagefile' id="imagefile" size='20' onchange="readURL(this);" style="display: none;" accept="image/*">
                                    </label>
                                    <input type='hidden' name='isImage' id="isImage" value="N">
                                  </div>
                                </div>
                            </div> <!-- end of uploadProfile section -->
                          </div> <!-- end of infosection & uploadProfile section -->


                          





                                        <!-- <div class="row">
                            
                                  <div class="col-sm-3">
                                      <div class="form-group">



                                      <img src='<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->image_name != ''){ ?> <?php echo base_url(); ?>assets/img/student-images/<?php echo $bodycontent["studentregisterEditdata"]->image_name; } ?>' id="showimage" style="width: 120px;height:125px;border: 2px solid #6d78cb;margin-left:40px;margin-bottom:13px; ">

                                    <div class="inputWrapper" style="width:140px;margin-left: 40px;">

                                      <label class="btn  btn-default btn-flat">Upload Photo 
                                                              
                                        <input class="fileInput "  type='file' custom-file-input name='imagefile' id="imagefile" size='20' onchange="readURL(this);" style="display: none;" accept="image/*">
                                      </label>

                                      <input type='hidden' name='isImage' id="isImage" value="N">

                                        </div>
                                      </div>
                                    
                                  </div>   
                        </div>  -->
                    </div>
                    <!-- End of Student Personal Info -->



                    

                    <!------------ Address Info ----->
                    <div class="formblock-box">
                      <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Address Info</h3>

                      <div class="row">
                        <div class="col-md-4">
                          <label for="address_one">Address 1</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control "  name="address_one" id="address_one" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->address_one; } ?>" />
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="address_two">Address 2</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control "  name="address_two" id="address_two" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->address_two; } ?>" />
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label for="address_three">Address 3</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <input type="text" class="form-control "  name="address_two" id="address_two" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->address_three; } ?>" />
                              </div>
                          </div>
                        </div>
                      </div>

                    
                      <div class="row">
                        <div class="col-md-4">
                            <label for="city">City</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" name="city" id="city" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->city; } ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <label for="pincode">Pincode</label>
                          <div class="form-group">
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control onlynumber"  name="pincode" id="pincode" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->pin; } ?>" maxlength='6'>
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
                          <label for="admissiondate">Admission Date</label>
                          <div class="form-group">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="admission_dt" id="admission_dt" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->admission_dt != ''){ echo date('d/m/Y',strtotime($bodycontent['studentregisterEditdata']->admission_dt)); } ?>">
                              </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <label for="category">Category</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                  <select class="form-control select2" id="category" name="category" style="width: 100%;">
                                      <option value=''>Select</option>
                                      <?php foreach ($bodycontent[ 'studentcategory'] as $studentcategory) { ?>

                                      <option value="<?php echo $studentcategory->category_name; ?>" <?php if($bodycontent[ 'mode']=='EDIT' && $studentcategory->category_name == $bodycontent['studentregisterEditdata']->category){ echo 'selected'; } ?> >

                                          <?php echo $studentcategory->category_name; ?></option>

                                      <?php } ?>

                                  </select>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="status">Status</label>
                            <div class="form-group">
                              <div class="input-group input-group-sm">
                                <select class="form-control select2" id="status" name="status" style="width: 100%;">
                                      <option value=''>Select</option>
                                      <?php foreach ($bodycontent[ 'studentstatus'] as $studentstatus) { ?>
                                      <option value="<?php echo $studentstatus; ?>" <?php if($bodycontent[ 'mode']=='EDIT' && $studentstatus==$bodycontent[ 'studentregisterEditdata']->status){ echo 'selected'; } ?> >
                                          <?php echo $studentstatus; ?>
                                      </option>

                                      <?php } ?>

                                </select>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row error-row-block">
                          <div class="col-md-4">
                            <p id="admissiondterr"></p>
                          </div>
                          <div class="col-md-4">
                            <p id="cateerr" ></p>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <label for="studdob" class="col-sm-3">Exit Date</label>
                          <div class="input-group input-group-sm">
                           <div class="input-group-prepend">
                             <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                           </div>
                           <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="exit_dt" id="exit_dt" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->discharge_dt != ''){ echo date('d/m/Y',strtotime($bodycontent['studentregisterEditdata']->discharge_dt)); } ?>">
                         </div>
                        </div>
                      </div>

                  </div>


                <!-- End of Other Info ------------------->
                    
          <!-- Coaching Detail -->
          <div class="scheduler-border formblock-box"> 
            <h3 class="form-block-subtitle">Coaching Details</h3>
       
              <div class="row">
               <div class="col-md-4">
                          <div class="form-group ">
                            <label for="playgroup">Playing Group Name</label>
                           
                             <div class="input-group input-group-sm">
                              <select class="form-control select2" name="play_group" id="play_group" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['studentplaygroup'] as $studentplaygroup) { ?>

                              <option value="<?php echo $studentplaygroup->play_group_id; ?>"

                              <?php if($bodycontent['mode'] == 'EDIT' && $studentplaygroup->play_group_id == $bodycontent['studentregisterEditdata']->play_group){ echo 'selected'; } ?>


                                >
                                <?php echo $studentplaygroup->play_group_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                 </div>
                <div class="col-md-3">
                          <div class="form-group">
                            <label for="specialcoching">Special Coaching</label>
                            <div class="input-group input-group-sm">
                               <select class="form-control select2" name="special_coaching" id="special_coaching" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['specialcoching'] as $specialcoching) { ?>

                              <option value="<?php echo $specialcoching; ?>"

                              <?php if($bodycontent['mode'] == 'EDIT' && $specialcoching == $bodycontent['studentregisterEditdata']->special_coaching){ echo 'selected'; } ?>


                                >
                                <?php echo $specialcoching; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
               </div>

              
<!-- 
               <div class="col-md-3">
                          <div class="form-group">
                            <label for="openingbal">Opening Balance</label>
                            <div class="input-group input-group-sm">

                               <input type="text" class="form-control" name="opening_balnce" id="opening_balnce" im-insert="false">
                              
                            </div>

                          </div>
               </div> -->
               <div class="col-md-3">
                          <div class="form-group">
                            <label for="openingbal">
                              <span id="billstytext">
                              <?php if($bodycontent['mode'] == 'EDIT'){
                                 if($bodycontent['studentregisterEditdata']->bill_style == 'M'){
                                  echo 'Monthly';
                                 }else if($bodycontent['studentregisterEditdata']->bill_style == 'Q'){
                                   echo 'Quarterly';
                                 }else{
                                   echo 'Monthly';
                                 }
                              }  ?> </span> Subscription</label>
                            <div class="input-group input-group-sm">

                               <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->subscription; } ?>">
                              
                            </div>

                          </div>
                               
              </div>

               <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Billing Style</label>
                            <div class="input-group input-group-sm">
                               <select class="form-control select2" name="bill_style" id="bill_style" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['billtype'] as $key => $value) { ?>

                              <option value="<?php echo $key; ?>"

                              <?php if($bodycontent['mode'] == 'EDIT' && $key == $bodycontent['studentregisterEditdata']->bill_style){ echo 'selected'; } ?>


                                >
                                <?php echo $value; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>
                                
              </div>
             
                 
                              </div>  <!-- end of  Coaching Detail -->

              <div class="formblock-box">
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2 text-right">
                      <button type="submit" class="btn btn-sm action-button" id="studregsavebtn" style="width: 57%;"><?php echo $bodycontent['btnText']; ?></button>

                        <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 57%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                    </div>
                </div>
              </div>

                
                   </form>
                
                </div>
         
          <!-- /.card-body -->
        </div><!-- /.card -->
    </section>

