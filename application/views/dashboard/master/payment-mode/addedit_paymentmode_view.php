<script src="<?php echo base_url(); ?>assets/js/customJs/master/paymentmode.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Payment Mode</h3>
              <a href="<?php echo base_url(); ?>paymentmode" class="">
              <button class="btn btn-info btnpos">List</button></a>
                           
            </div><!-- /.card-header -->

           <form name="paymentmodeFrom" id="paymentmodeFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="paymodeId" id="paymodeId" value="<?php echo $bodycontent['paymodeId']; ?>">
            <div class="card-body">
                           
             <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="groupname">Payment Mode</label>
                    <input type="text" class="form-control" name="paymentmode" id="paymentmode" placeholder="Enter Payment Mode" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['paymentmodeEditdata']->payment_mode; } ?>">

                    <input type="hidden" class="form-control" name="validpaymentmode" id="validpaymentmode" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['paymentmodeEditdata']->payment_mode; } ?>">
                </div>
               
              </div>
             </div>
              <div class="row">
                <div class="col-md-3"></div>
              <div class="col-md-5">
              <div class="form-group">
                  <label>Account Name</label>
                  <select class="form-control select2bs4" id="acccountid" name="acccountid" style="width: 100%;">
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
            
             <div class="row">
               <div class="col-md-3"></div>
                 <div class="col-md-5 colmargin">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
             </div>
            
             <div class="row">
              <div class="col-md-4"></div>
               <div class="col-md-2">
                 <button type="submit" class="btn btn-block  btn-secondary" id="paymentmodesavebtn" style="width: 80%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-block btn-secondary loaderbtn" id="loaderbtn" style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
                <div class="col-md-2">
                 <button type="reset" id="resetpaymentmodeform" class="btn btn-block btn-secondary" style="width: 80%;">Reset</button>
               </div>
             </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

