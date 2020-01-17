<script src="<?php echo base_url(); ?>assets/js/customJs/correction/correction.js"></script>
<style>

.card-body .modal-body{
    #color: #44423d;

   
  }
  label{
    font-size: 14px;
     color: #354668 !important;
  }

</style>


<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Corrections-Tennis Coaching</h3>
              <a href="<?php echo base_url(); ?>Correction" class="">
              <button class="btn btn-info btnpos">List</button></a>
                           
            </div><!-- /.card-header -->

        <form name="correctionFrom" id="correctionFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="correctionId" id="correctionId" value="<?php echo $bodycontent['correctionId']; ?>">
            <div class="card-body">
                           
             <div class="row">
              <label for="correction_dt" class="col-sm-2">Correction Date</label>
                    <div class="col-sm-3">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask datevalid" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="correction_dt" id="correction_dt" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['correctionEditdata']->date_of_correction != ''){ echo date('d/m/Y',strtotime($bodycontent['correctionEditdata']->date_of_correction)); } ?>">
                          </div>
                        </div>
                         <p id="correctionerr"></p>
                    </div>

                 <label for="student" class="col-sm-1">Student</label>
                    <div class="col-sm-3">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                       <select class="form-control select2" id="student" name="student" style="width: 100%;">
                    <option value=''>Select</option>
                    <?php foreach ($bodycontent['studentcodelist'] as $studentcodelist) { ?>

                      <option value="<?php echo $studentcodelist->admission_id.'_'.$studentcodelist->student_code; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $studentcodelist->admission_id == $bodycontent['correctionEditdata']->student_id){ echo 'selected'; } ?>

                        ><?php echo $studentcodelist->student_code; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                          </div>
                        </div>
                        <p id="studentcoderr"></p>
                    </div>   


             </div>

             <div class="row">
               <label for="name" class="col-sm-2">Name</label>
                    <div class="col-sm-3">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                           
                            <input type="text" class="form-control"  name="name" id="name" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['correctionEditdata']->title_one.' '.$bodycontent['correctionEditdata']->student_name; } ?>" readonly>
                          </div>
                        </div>
                         
                    </div>
                    <label for="billstyle" class="col-sm-1">Billing Style</label>
                    <div class="col-sm-3">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                           
                            <input type="text" class="form-control"  name="bill_style" id="bill_style" value="<?php if($bodycontent['mode'] == 'EDIT'){ if($bodycontent['correctionEditdata']->bill_style == 'M'){ echo 'Monthly'; } else if($bodycontent['correctionEditdata']->bill_style == 'Q'){ echo 'Quarterly'; }  } ?>" readonly>
                          </div>
                        </div>
                        
                    </div>
             </div>

             <div class="row">
              <label for="correction_acc" class="col-sm-2">Correction Account</label>
                    <div class="col-sm-3">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                       <select class="form-control select2" id="correction_acc_id" name="correction_acc_id" style="width: 100%;">
                    <option value=''>Select</option>
                    <?php foreach ($bodycontent['correctionaccount'] as $correctionaccount) { ?>

                      <option value="<?php echo $correctionaccount->correction_acc_id; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $correctionaccount->correction_acc_id == $bodycontent['correctionEditdata']->correction_acc_id){ echo 'selected'; } ?>

                        ><?php echo $correctionaccount->correction_name; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                          </div>
                        </div>
                        <p id="correctionaccounterr"></p>
                    </div> 

                   <label for="amount" class="col-sm-1">Amount</label>
                    <div class="col-sm-3">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                           
                            <input type="text" class="form-control numberwithdecimal"  name="amount" id="amount" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['correctionEditdata']->amount;; } ?>" >
                          </div>
                        </div>
                         <p id="amounterr"></p>
                    </div>    
               
             </div>
             <div class="row">

               <label for="narration" class="col-sm-2">Narration</label>
                    <div class="col-sm-3">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                           <textarea id="narration" name="narration" class="form-control"><?php if($bodycontent['mode'] == 'EDIT'){
                            echo $bodycontent['correctionEditdata']->narration;
                           } ?></textarea>
                           
                          </div>
                        </div>
                         
                    </div>
               
             </div>
             
             
            
             <div class="row">
               <div class="col-md-3"></div>
                 <div class="col-md-5 colmargin">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
               </div>
                        
             <div class="row">
              <div class="col-md-4"></div>
               <div class="col-md-2">
                 <button type="submit" class="btn btn-block  btn-secondary " id="correctionsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-block btn-secondary loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
                <div class="col-md-2">
                <!--  <button type="reset" id="resetgrpform" class="btn btn-block btn-secondary" style="width: 80%;">Reset</button> -->
               </div>
             </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

