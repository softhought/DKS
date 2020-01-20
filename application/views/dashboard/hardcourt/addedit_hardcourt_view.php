<script src="<?php echo base_url(); ?>assets/js/customJs/hardcourt.js"></script>

<style type="text/css">
  label{
    font-size: 13px;
    color: #354668 !important;
    font-weight: 700;
  }
#voucherlistTable{
   font-size: 12px;
}
</style>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Hard Court</h3>

               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>hardcourt" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>
              
                           
            </div><!-- /.card-header -->

           <form name="hardcourtFrom" id="hardcourtFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="hardcourtId" id="hardcourtId" value="<?php echo $bodycontent['hardcourtId']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                 <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Hard Court Info</h3> 
                        <div class="row">
                           <div class="col-md-4">
                              <label for="firstname">Date</label>
                                <div class="form-group">                              
                                  <div class="input-group input-group-sm">
                                  <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="hardcourt_date" id="hardcourt_date" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['hardcourtEditdata']->tran_date != ''){ echo date('d-m-Y',strtotime($bodycontent['hardcourtEditdata']->tran_date));

                                  } ?>">
                                  </div>

                                </div>
                             </div>

                           
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Student</label>
                               <div class="input-group input-group-sm">
                                <select class="form-control select2" id="student_idcode" name="student_idcode" style="width: 100%;">
                                  <option value=''>&nbsp;</option>

                                  <?php foreach ($bodycontent['studentdtl'] as $studentdtl) { ?>
                                    
                                   <option value="<?php echo $studentdtl->admission_id.'_'.$studentdtl->student_code;  ?>" <?php 

                                    if($bodycontent['mode'] == 'EDIT' && $studentdtl->admission_id == $bodycontent['hardcourtEditdata']->admission_id){ echo 'selected';

                                    }?> ><?php 
                                        echo $studentdtl->student_name.'('.$studentdtl->student_code.')'; ?></option> <?php } ?>
                                    </select>
                                  </div>
                                 </div>
                             </div>
                    
                             <div class="col-md-4">
                               <label for="firstname">Quantity</label>
                                 <div class="form-group">        
                                  <div class="input-group input-group-sm">
                                  <input type="text" class="form-control onlynumber totalamt" name="quntity" id="quntity" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['hardcourtEditdata']->quntity;

                                  } ?>">
                                  </div>

                                </div>
                             </div>

                            </div>

                          <div class="row">
                             <div class="col-md-4">
                               <label for="firstname">Rate</label>
                                <div class="form-group">
                                                                  
                                   <div class="input-group input-group-sm ">
                                      <input type="text" class="form-control numberwithdecimal totalamt"  name="rate" id="rate" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['hardcourtEditdata']->rate;

                                       } ?>">
                                  </div>

                                </div>
                             </div>

                          
                             <div class="col-md-4">
                                <div class="form-group">
                                  <label for="firstname">Amount</label>
                                  <div class="input-group input-group-sm">
                                  <input type="text" class="form-control" name="amount" id="amount" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['hardcourtEditdata']->amount;

                                  } ?>" readonly="">
                                  </div>

                                </div>
                             </div>

                            </div>       
            
            
           
           </div>
           <div class="formblock-box">
            
             <div class="row">
              <?php if($bodycontent['mode'] == 'ADD'){  ?>
              <div class="col-md-8">
                <p id="errormsg" class="errormsgcolor"></p>
              </div>
              <?php }else{ ?>
                <div class="col-md-10">
                  <p id="errormsg" class="errormsgcolor"></p>
                </div>
             <?php  } ?>
               <div class="col-md-2 text-right">
                 <button type="submit" class="btn btn-sm action-button" id="hardcourtsavebtn" style="width: 60%;font-size: 13px;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-sm action-button dispnone loaderbtn" id="loaderbtn" style="width: 60%;font-size: 13px;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
               <?php if($bodycontent['mode'] == 'ADD'){ ?>
                <div class="col-md-2">
                 <button type="reset" id="resetgrpform" class="btn btn-sm action-button" style="width: 60%;font-size: 13px;">Reset</button>
               </div>
             <?php } ?>
             </div>
                      
          </div>
        </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
</section>
