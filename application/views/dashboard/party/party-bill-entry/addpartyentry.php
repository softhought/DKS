<script src="<?php echo base_url(); ?>assets/js/customJs/party/partybillentry.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Party Bill Entry</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>partybillentry" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div> 
                
                 
            </div><!-- /.card-header -->

           <form name="partybillentryform" id="partybillentryform" enctype="multipart/form-data">
           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="partybillID" id="partybillID" value="<?php echo $bodycontent['partybillID']; ?>">
                     
            <div class="card-body">

            <div class="formblock-box">

                  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>Party Bill Entry Info</h3>

                  <div class="row">
                      <div class="col-md-3">
                      </div>
                      <div class="col-md-6 backdesign">

                              <div class="row">                                
                                   <label for="bill_no" class="col-md-3">Bill No.</label>
                                      <div class="col-md-6">                                   
                                          <div class="form-group">
                                              <div class="input-group input-group-sm">
                                              <input type="text" class="form-control"  name="bill_no" id="bill_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['partybillentryEditdata']->bill_no;  } ?>" <?php if($bodycontent['mode'] == 'EDIT') { ?>readonly <?php }?>>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                        <label for="bill_date" class="col-md-3">Bill Date</label>   
                                        <div class="col-md-3">
                                              <div class="form-group">
                                                  
                                                  <div class="input-group input-group-sm" id="bill_dterr">
                                                      <div class="input-group-prepend">
                                                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="bill_date" id="bill_date" value="<?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybillentryEditdata']->bill_date != ''){ echo date('d/m/Y',strtotime($bodycontent['partybillentryEditdata']->bill_date)); } ?>">
                                                    </div>
                                              </div>
                                            </div>
                                                                     
                                   <label for="voucher_no" class="col-md-3" >Voucher No.</label>
                                      <div class="col-md-3">                                   
                                          <div class="form-group">
                                              <div class="input-group input-group-sm">
                                              <input type="text" class="form-control"  name="voucher_no" id="voucher_no" im-insert="false" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['partybillentryEditdata']->voucher_no; } ?>" readonly>
                                              </div>
                                          </div>
                                      </div>
                                  </div>  

                           <div class="row">
                               <label class="col-md-3">Party</label>
                                  <div class="col-md-6">                               
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <select class="form-control select2" id="vender_account_id" name="vender_account_id"   style="width: 100%;">
                                                    <option value=''>Select</option>
                                                    <?php foreach ($bodycontent['venderlist'] as $venderlist) { ?>

                                                        <option value="<?php echo $venderlist->account_id; ?>" 

                                                        <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybillentryEditdata']->party_id == $venderlist->account_id){ echo 'selected'; } ?>

                                                        ><?php echo $venderlist->vendor_name; ?></option>
                                        
                                                        <?php   } ?>
                                        
                                                </select>
                                             
                                        </div>
                                    </div>                    
                                </div>
                            </div>
                                 
                            <div class="row">                            
                                  <label for="bill_amount" class="col-md-3">Bill Amount</label>                                            <div class="col-md-6">
                                                
                                             <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                      <input type="text" class="form-control numberonly"  name="bill_amount" id="bill_amount" im-insert="false" value=" <?php if($bodycontent['mode'] == 'EDIT'){  echo  $bodycontent['partybillentryEditdata']->bill_amount;  } ?>" />
                                                    </div>
                                                </div>
                                              </div>    
                                          </div>       
                                    
                                          <div class="row">
                               <label class="col-md-3">Account To be Debited</label>
                                  <div class="col-md-6">                               
                                        <div class="form-group">
                                            <div class="input-group input-group-sm">
                                                <select class="form-control select2" id="account_id" name="account_id"   style="width: 100%;">
                                                    <option value=''>Select</option>
                                                    <?php foreach ($bodycontent['accountlist'] as $accountlist) { ?>

                                                        <option value="<?php echo $accountlist->account_id; ?>" 

                                                        <?php if($bodycontent['mode'] == 'EDIT' && $bodycontent['partybillentryEditdata']->debit_account_id == $accountlist->account_id){ echo 'selected'; } ?>

                                                        ><?php echo $accountlist->account_name; ?></option>
                                        
                                                        <?php   } ?>
                                        
                                                </select>
                                             
                                        </div>
                                    </div>                    
                                </div>
                            </div>   

                                         
                                        
                                        
                                  
                      </div>
                  </div>
            </div>      


               <div class="formblock-box">
                   <div class="row">
                     
                   <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-8">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                          </div>
                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="billentrysavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>

                    <?php if($bodycontent['mode'] == 'ADD'){ ?>
                      <div class="col-md-2">
                       <button type="reset" id="resetgrpform" class="btn btn-sm action-button" style="width: 60%;">Reset</button>
                     </div>
                   <?php } ?>
                  
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

