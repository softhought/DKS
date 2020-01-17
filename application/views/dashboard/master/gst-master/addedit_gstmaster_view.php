<script src="<?php echo base_url(); ?>assets/js/customJs/master/gstmaster.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Goods and Services Tax(GST)</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                 <a href="<?php echo base_url(); ?>gstmaster" class="btn btn-info btnpos"><i class="fas fa-clipboard-list"></i> List </a>
              </div> 
              
                           
            </div><!-- /.card-header -->

           <form name="gstFrom" id="gstFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="gstId" id="gstId" value="<?php echo $bodycontent['gstId']; ?>">
            <div class="card-body">

          <div class="formblock-box"> 
             <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Goods and Services Tax(GST) Info</h3>
                           
             <div class="row">
              
              <div class="col-md-4">
                <label for="gstdescription">GST Description</label>
                <div class="form-group">
                   <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="gstdescription" id="gstdescription" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['gstmasterEditdata']->gstDescription; } ?>">
                  </div>
                </div>
               
              </div>
             
           
              <div class="col-md-4">
                <label>Type</label>
              <div class="form-group">
                  <div class="input-group input-group-sm">
                  <select class="form-control select2" id="gstType" name="gstType" style="width: 100%;">
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
           
             <div class="col-md-4">
              <label for="gstrate">Rate</label>
                <div class="form-group">
                    <div class="input-group input-group-sm">
                    <input type="text" class="form-control number_only" name="gstrate" id="gstrate" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['gstmasterEditdata']->rate; } ?>" >
                  </div>
                </div>
               
              </div>
             </div>

             <div class="row">
              
              <div class="col-md-4">
                 <label>Account</label>
                <div class="form-group">                 
                  <div class="input-group input-group-sm">
                      <select class="form-control select2" id="accountid" name="accountid" style="width: 100%;">
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

             
              <div class="col-md-4">
                <label>Input/Output</label>
                <div class="form-group">
                   <div class="input-group input-group-sm">

                  <select class="form-control select2" id="usedfor" name="usedfor" style="width: 100%;">
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
                    <div class="col-md-8"></div>
                     <div class="col-md-2">
                       <button type="submit" class="btn btn-sm action-button" id="gstsavebtn" style="width: 80%;"><?php echo $bodycontent['btnText']; ?></button>

                         <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 80%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                     </div>
                      <div class="col-md-2">
                       <button type="reset" id="resetgstform" class="btn btn-sm action-button" style="width: 80%;">Reset</button>
                     </div>
                   </div>
              </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </section>

