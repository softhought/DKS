<script src="<?php echo base_url(); ?>assets/js/customJs/master/paymentmode.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Payment Mode</h3>
                  <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                    <a href="<?php echo base_url(); ?>paymentmode" class="btn btn-default btnpos"> <i class="fas fa-clipboard-list"></i> List </a>
             
                 </div>
            
                           
            </div><!-- /.card-header -->

           <form name="paymentmodeFrom" id="paymentmodeFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="paymodeId" id="paymodeId" value="<?php echo $bodycontent['paymodeId']; ?>">
            <div class="card-body">

              <div class="formblock-box">
                 <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Payment Mode Info</h3>  
                           
                   <div class="row">
                  
                    <div class="col-md-5">
                       <label for="groupname">Payment Mode</label>
                      <div class="form-group">
                           <div class="input-group input-group-sm">
                          <input type="text" class="form-control" name="paymentmode" id="paymentmode" placeholder="Enter Payment Mode" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['paymentmodeEditdata']->payment_mode; } ?>">

                          <input type="hidden" class="form-control" name="validpaymentmode" id="validpaymentmode" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['paymentmodeEditdata']->payment_mode; } ?>">
                      </div>
                    </div>
                     
                    </div>
                   
                     
                    <div class="col-md-5">
                       <label>Account Name</label>
                    <div class="form-group">
                       <div class="input-group input-group-sm">
                       
                            <select class="form-control select2" id="acccountid" name="acccountid" style="width: 100%;">
                              <option value='' selected="selected">Select</option>
                              <?php foreach ($bodycontent['accountmasterlist'] as $accountmasterlist) { ?>

                                <option value="<?php echo $accountmasterlist->account_id; ?>"

                                <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['paymentmodeEditdata']->account_id == $accountmasterlist->account_id){
                                 echo 'selected';
                                } ?>

                                  ><?php echo $accountmasterlist->account_name; ?></option>
                               
                            <?php   } ?>
                             
                            </select>
                         </div>
                      </div>
                     
                     </div>
                   </div>
            
             <div class="row">
               <div class="col-md-4"></div>
                 <div class="col-md-5">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
             </div>
           </div>
               <div class="formblock-box">
                 <div class="row">
                  <?php if($bodycontent['mode'] == 'ADD'){ ?>
                        <div class="col-md-8"></div>
                  <?php }else{  ?>
                        <div class="col-md-10"></div>
                  <?php  }?>
                   <div class="col-md-2">
                     <button type="submit" class="btn btn-sm action-button" id="paymentmodesavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                       <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                   </div>
                    <?php if($bodycontent['mode'] == 'ADD'){ ?>
                    <div class="col-md-2">
                     <button type="reset" id="resetpaymentmodeform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                   </div>
                 <?php } ?>
                 </div>
                      
             </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

