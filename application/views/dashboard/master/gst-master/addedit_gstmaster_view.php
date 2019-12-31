<script src="<?php echo base_url(); ?>assets/js/customJs/master/gstmaster.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Goods and Services Tax(GST)</h3>
              <a href="<?php echo base_url(); ?>gstmaster" class="">
              <button class="btn btn-info btnpos">List</button></a>
                           
            </div><!-- /.card-header -->

           <form name="gstFrom" id="gstFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="gstId" id="gstId" value="<?php echo $bodycontent['gstId']; ?>">
            <div class="card-body">
                           
             <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="gstdescription">GST Description</label>
                    <input type="text" class="form-control" name="gstdescription" id="gstdescription" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['gstmasterEditdata']->gstDescription; } ?>">
                </div>
               
              </div>
             </div>
              <div class="row">
                <div class="col-md-3"></div>
              <div class="col-md-5">
              <div class="form-group">
                  <label>Type</label>
                  <select class="form-control select2bs4" id="gstType" name="gstType" style="width: 100%;">
                    <option value='' selected="selected">Select</option>
                    <?php foreach ($bodycontent['gsttypelist'] as $value) { ?>

                      <option value="<?php echo $value ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['gstmasterEditdata']->gstType == $value){
                       echo 'selected';
                      } ?>

                        ><?php echo $value; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                </div>
               
              </div>
             </div>

               <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                   <label for="gstrate">Rate</label>
                    <input type="text" class="form-control number_only" name="gstrate" id="gstrate" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['gstmasterEditdata']->rate; } ?>" >
                </div>
               
              </div>
             </div>

             <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Account</label>

                  <select class="form-control select2bs4" id="accountid" name="accountid" style="width: 100%;">
                    <option value='' selected="selected">Select</option>

                    <?php foreach ($bodycontent['accountmasterlist'] as $value) { ?>

                   <option  value="<?php echo $value->account_id; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['gstmasterEditdata']->accountId == $value->account_id){
                       echo 'selected';
                      } ?>
                    ><?php echo $value->account_name; ?></option>
                     
                   <?php  } ?>
                   
                  </select>
                </div>
               
              </div>

             </div>
             <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Input/Output</label>

                  <select class="form-control select2bs4" id="usedfor" name="usedfor" style="width: 100%;">
                    <option value='' selected="selected">Select</option>

                    <?php foreach ($bodycontent['usedfor'] as $key => $value) { ?>

                   <option  value="<?php echo $key; ?>"

                      <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['gstmasterEditdata']->usedfor == $key){
                       echo 'selected';
                      } ?>
                    ><?php echo $value; ?></option>
                     
                   <?php  } ?>
                   
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
                 <button type="submit" class="btn btn-block  btn-secondary " id="gstsavebtn" style="width: 80%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-block btn-secondary loaderbtn" id="loaderbtn" style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
                <div class="col-md-2">
                 <button type="reset" id="resetgstform" class="btn btn-block btn-secondary" style="width: 80%;">Reset</button>
               </div>
             </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

