<script src="<?php echo base_url(); ?>assets/js/customJs/correction/member_correction_entry.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Member Correction Entry</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>membercorrection" class="btn btn-info btnpos">
                  <i class="fas fa-clipboard-list"></i> List </a>
                </div>
             
                           
            </div><!-- /.card-header -->

           <form name="membercorrectionFrom" id="membercorrectionFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="cortranId" id="cortranId" value="<?php echo $bodycontent['cortranId']; ?>">
           
           
           <input type="hidden" name="cgst_id" id="cgst_id" value="<?php echo $bodycontent['parameterData']->cgst_id; ?>">
           <input type="hidden" name="sgst_id" id="sgst_id" value="<?php echo $bodycontent['parameterData']->sgst_id; ?>">
            <div class="card-body">

             <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Info</h3>   
                           
             <div class="row">
            
              <div class="col-md-2">
                <label for="groupname">Correction No.</label>
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="correction_no" id="correction_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['cortransactionEditdata']->cor_tran_no; } ?>" readonly >
                  </div>
                  
                </div>
               
              </div>
           
             
                 <div class="col-md-2">
                          <div class="form-group">
                          <label for="eqpname">Correction Date</label>
                          <div class="input-group input-group-sm">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="correction_dt" id="correction_dt" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['cortransactionEditdata']->tran_date)); }else{echo date('d/m/Y');} ?>">
                          </div>
                          </div>
                 </div>

                       <div class="col-md-3">
                          <div class="form-group ">
                            <label for="code">Member Code</label>
                            <div id="resetstudentlist">
                             <div class="input-group input-group-sm" id="sel_member_codeerr">
                              <select class="form-control select2" name="sel_member_id" id="sel_member_id" >
                              <option value=""
                               data-name=""
                               data-titleone=""
                              >Select</option>
                              <?php 
                              foreach ($bodycontent['memberCodeList'] as  $membercode) {
                                
                              ?>
                              <option value="<?php echo $membercode->member_id;?>"
                               data-name="<?php echo $membercode->member_name; ?>"
                               data-titleone="<?php echo $membercode->title_one; ?>"

                               <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['cortransactionEditdata']->member_id==$membercode->member_id) {
                                   echo "selected";
                                  }
                                }
                               ?>

                              ><?php echo $membercode->member_code;?></option>
                              <?php } ?>
                             
                            </select>
                            </div></div>

                          </div>
                 </div><!-- end of col-md-3 -->
                  <div class="col-md-4">
                          <div class="form-group">
                            <label for="firstname">Member Name</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="membername" name="membername" placeholder="" autocomplete="off" style="text-transform:uppercase"  readonly  value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['cortransactionEditdata']->title_one." ".$bodycontent['cortransactionEditdata']->member_name;}?>">
                            </div>

                          </div>
               </div><!-- end of col-md-3 -->
            
             
          
             </div>

             <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Correction Data</h3> 

             <div class="row">

                    <div class="col-md-3">
                          <div class="form-group">
                            <label for="description">Description</label>
                              <div class="input-group input-group-sm" id="description_err">
                                <select class="form-control select2" name="description" id="description" >
                              <option value="">Select</option>
                              <?php 
                              foreach ($bodycontent['descriptiondtl'] as  $descriptiondtl) {                                
                              ?>
                              <option value="<?php echo $descriptiondtl->id;?>"
                               
                               <?php if($bodycontent['mode'] == 'EDIT'){
                                  if ($bodycontent['cortransactionEditdata']->desc_master_id==$descriptiondtl->id) {
                                   echo "selected";
                                  }
                                }
                               ?>

                              ><?php echo $descriptiondtl->descrtion_name;?></option>
                              <?php } ?>
                             
                            </select>
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Amount</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="amount" name="amount" placeholder="" autocomplete="off"   value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['cortransactionEditdata']->taxable;}?>" onkeyup = "numericFilter(this);" >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">CGST%</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="cgst_rate" name="cgst_rate" placeholder="" autocomplete="off" value="<?php echo $bodycontent['parameterData']->cgst_rate; ?>"  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">CGST Amt</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="cgst_amt" name="cgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['cortransactionEditdata']->cgst_amt;}?>"  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                        <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">SGST%</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="sgst_rate" name="sgst_rate" placeholder="" autocomplete="off" value="<?php echo $bodycontent['parameterData']->sgst_rate; ?>"  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">SGST Amt</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="sgst_amt" name="sgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['cortransactionEditdata']->sgst_amt;}?>">
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Net Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs" id="net_amt" name="net_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['cortransactionEditdata']->total_amount;}?>"  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
               
             </div>  

             <div class="row">
               <div class = "col-sm-4">

               <div class="form-group">
                   <label for="firstname">Remarks.</label>
                      <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="" autocomplete="off" 
                         value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['cortransactionEditdata']->remarks;}?>"  >
                      </div>

                 </div>
                
               </div>
             </div>
            
           
           </div>

            <div class="formblock-box">
            
             <div class="row">
            
                    <div class="col-md-10">
                      <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
                      <p id="errormsg" class="error"></p>
                    </div>
              
               <div class="col-md-2 text-right">
                 <button type="submit" class="btn btn-sm action-button" id="correctionsavebtn" style="width: 70%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 70%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
            
             </div>
           </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </section>

