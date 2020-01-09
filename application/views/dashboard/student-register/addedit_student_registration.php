<script src="<?php echo base_url(); ?>assets/js/customJs/studentregister.js"></script>

<style>

.card-body .modal-body{
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
 }    
</style>


<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Student Registration</h3>
              <a href="<?php echo base_url(); ?>studentregister" class="">
              <button class="btn btn-info btnpos">List</button></a>
                           
            </div><!-- /.card-header -->
                            
                  <div class="card-body">

  <form id="stdentregisterForm" name="stdentregisterForm" enctype="multipart/form-data">

  <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">

  <input type="hidden" name="admissionId" id="admissionId" value="<?php echo $bodycontent['admissionId']; ?>">   

  <div class="row">
          <div class="col-sm-9">      

                  <div class="row">
                     
                    <label for="studentcode" class="col-sm-4">Student Code</label>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="input-group input-group-sm">

                            <input type="text" class="form-control" name="studcode" id="studcode" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->student_code; } ?>" readonly>

                        </div>
              </div>
                    </div>
                  </div>

         


             <div class="row">

                    <label for="studentcode" class="col-sm-3">Name</label>
                    <div class="col-sm-1 maxwidth">
                      <div class="form-group">
                       <div class="input-group input-group-sm">

                       <select class="form-control select2" id="studtitle" name="studtitle" style="width: 100%;">
                    <option value=''>&nbsp; </option>
                    <?php foreach ($bodycontent['titleofneme'] as $value) { ?>

                      <option value="<?php echo $value; ?>"

                       <?php if($bodycontent['mode'] == 'EDIT' && $value == $bodycontent['studentregisterEditdata']->title_one){ ?> selected <?php  } ?>

                        ><?php echo $value; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                </div>
                </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                          
                             <input type="text" class="form-control" name="studname" id="studname" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->student_name; } ?>">


                       
                     </div>
                   </div>

                   <p id="studnameerr"></p>
                      
                    </div>
                  </div>

                  <div class="row">
                    <label for="studdob" class="col-sm-4">Date Of Birth</label>
                    <div class="col-sm-6">
                       <div class="form-group">
                       <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="studdob" id="studdob" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->student_dob != ''){ echo date('d/m/Y',strtotime($bodycontent['studentregisterEditdata']->student_dob)); } ?>">
                          </div>
                    </div>
                   </div>
                  </div>


                  <div class="row">
                    <label for="studfathername" class="col-sm-3">Father's /Mother's Name</label>
                    <div class="col-sm-1 maxwidth">
                      <div class="form-group">
                       <div class="input-group input-group-sm">

                       <select class="form-control select2" id="father_title" name="father_title" style="width: 100%;">
                    <option value=''>&nbsp; </option>
                    <?php foreach ($bodycontent['titleofneme'] as $titleofneme) { ?>

                      <option value="<?php echo $titleofneme; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $titleofneme == $bodycontent['studentregisterEditdata']->title_two){ echo 'selected'; } ?>

                        ><?php echo $titleofneme; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                </div>
                </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control"  name="fathername" id="fathername"  value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->guardian_name; } ?>">
                          </div>
                        </div>
                         <p id="fathernameerr"></p>
                    </div>
                  </div>

                  <div class="row">
                    <label for="studdob" class="col-sm-4">Land/Mobile No</label>
                    <div class="col-sm-3">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control onlynumber" name="landline_no" id="landline_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->phone_one; } ?>">
                          </div>
                        </div>
                    </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control onlynumber"  name="mobile_no" id="mobile_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->phone_two; } ?>">
                          </div>
                        </div>
                         <p id="mobilenoerr"></p>
                    </div>
                  </div>

                  </div>
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
       </div> 
                 
                    
                    <div class="row">
                       <label for="studsddress" class="col-sm-3">Address</label>
                      <div class="col-sm-4">
                       <div class="form-group">
                       <div class="input-group input-group-sm">

                        <input type="text" class="form-control "  name="address_one" id="address_one" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->address_one; } ?>">
                      </div>
                    </div>
                  </div>
                   <div class="col-sm-4">
                       <div class="form-group">
                       <div class="input-group input-group-sm">

                        <input type="text" class="form-control "  name="address_two" id="address_two" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->address_two; } ?>">
                      </div>
                    </div>
                  </div>
                         </div>

                         
                         <div class="row">
                       <label for="studsddress" class="col-sm-3"></label>
                      <div class="col-sm-8">
                       <div class="form-group">
                       <div class="input-group input-group-sm">

                        <input type="text" class="form-control "  name="address_three" id="address_three" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->address_three; } ?>">
                      </div>
                    </div>
                  </div>
                         </div>
                                        
                                      

                    <div class="row">
                    <label for="city" class="col-sm-3">City</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control "  name="city" id="city" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->city; } ?>">
                          </div>
                        </div>
                        <p id="citynameerr"></p>
                    </div>

                    <label for="pincode" class="col-sm-1">Pin</label>
                    <div class="col-sm-3">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control onlynumber"  name="pincode" id="pincode" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->pin; } ?>" maxlength='6'>
                          </div>
                        </div>
                         <p id="pincodeerr"></p>
                    </div>
                      
                  </div> 
                   
                   <div class="row">
                    <label for="email" class="col-sm-3">Email Address</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="input-group input-group-sm">
                            
                            <input type="email" class="form-control" name="email" id="email" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->email; } ?>">
                          </div>
                        </div>
                    </div>

                    <label for="admissiondate" class="col-sm-2">Admission Date</label>
                    <div class="col-sm-2">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="admission_dt" id="admission_dt" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->admission_dt != ''){ echo date('d/m/Y',strtotime($bodycontent['studentregisterEditdata']->admission_dt)); } ?>">
                          </div>
                        </div>
                         <p id="admissiondterr"></p>
                    </div>
                      
                  </div> 

                  <div class="row">
                    
                  </div> 

                  <div class="row">
                    <label for="email" class="col-sm-3">Category</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                       <select class="form-control select2" id="category" name="category" style="width: 100%;">
                    <option value=''>Select</option>
                    <?php foreach ($bodycontent['studentcategory'] as $studentcategory) { ?>

                      <option value="<?php echo $studentcategory->category_name; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $studentcategory->category_name == $bodycontent['studentregisterEditdata']->category){ echo 'selected'; } ?>

                        ><?php echo $studentcategory->category_name; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                          </div>
                        </div>
                        <p id="cateerr" ></p>
                    </div>

                    <label for="email" class="col-sm-1">Status</label>
                    <div class="col-sm-3">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                       <select class="form-control select2" id="status" name="status" style="width: 100%;">
                    <option value=''>Select</option>
                    <?php foreach ($bodycontent['studentstatus'] as $studentstatus) { ?>

                      <option value="<?php echo $studentstatus; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $studentstatus == $bodycontent['studentregisterEditdata']->status){ echo 'selected'; } ?>

                        ><?php echo $studentstatus; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                          </div>
                    </div>
                     <p id="statuserr" class="perrmsg"></p>
                  </div>
                      
                  </div>

                   
                  <div class="row">
                    <label for="studdob" class="col-sm-3">Exit Date</label>
                    <div class="col-sm-4">
                       <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="exit_dt" id="exit_dt" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['studentregisterEditdata']->discharge_dt != ''){ echo date('d/m/Y',strtotime($bodycontent['studentregisterEditdata']->discharge_dt)); } ?>">
                          </div>
                    </div>
                  </div>
 



                

          <fieldset class="scheduler-border"> <legend class="scheduler-border">Coaching Details</legend>
            
              <div class="row" style="margin-left: 3.5px;">

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
               <div class="col-md-3" style="max-width: 24% !important;">
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

                               <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['studentregisterEditdata']->monthly_subscription; } ?>">
                              
                            </div>

                          </div>
                               
              </div>

               
                                
              </div>
             
                 
              </fieldset>

              <div class="row">
                  <div class="col-md-4"></div>
                   <div class="col-md-2">
                     <button type="submit" class="btn btn-block  btn-secondary " id="studregsavebtn" style="width: 80%;"><?php echo $bodycontent['btnText']; ?></button>

                       <span class="btn btn-block btn-secondary loaderbtn" id="loaderbtn" style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                   </div>
                  
             </div>

                
                   </form>
                
                </div>
         
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

