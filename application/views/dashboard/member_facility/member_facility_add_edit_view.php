<script src="<?php echo base_url(); ?>assets/js/customJs/member_facility/member_facility.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title"><?php echo $bodycontent['parameterData']->description; ?></h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>memberfacility/facilitylist/<?php echo $bodycontent['entry_module'];?>" class="btn btn-info btnpos">
                  <i class="fas fa-clipboard-list"></i> List </a>
                </div>
             
                           
            </div><!-- /.card-header -->

           <form name="memberFacilityFrom" id="memberFacilityFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="tranId" id="tranId" value="<?php echo $bodycontent['tranId']; ?>">
           <input type="hidden" name="entry_module" id="entry_module" value="<?php echo $bodycontent['entry_module']; ?>">
           <input type="hidden" name="parameter_id" id="parameter_id" value="<?php echo $bodycontent['parameterData']->parameter_id; ?>">
           <input type="hidden" name="cgst_id" id="cgst_id" value="<?php echo $bodycontent['parameterData']->cgst_id; ?>">
           <input type="hidden" name="sgst_id" id="sgst_id" value="<?php echo $bodycontent['parameterData']->sgst_id; ?>">
            <div class="card-body">

             <div class="formblock-box">

                   <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Info</h3>   
                           
             <div class="row">
            
              <div class="col-md-2">
                <label for="groupname">Tran. No</label>
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="tran_no" id="tran_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['transactionEditdata']->tran_no; } ?>" readonly >
                  </div>
                  
                </div>
               
              </div>
           
             
                 <div class="col-md-2">
                          <div class="form-group">
                          <label for="eqpname">Tran. Date</label>
                          <div class="input-group input-group-sm">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="tran_dt" id="tran_dt" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['transactionEditdata']->tran_dt)); }else{echo date('d/m/Y');} ?>">
                          </div>
                          </div>
                 </div>

                       <div class="col-md-3">
                          <div class="form-group ">
                            <label for="code">Member Code</label>
                            <div id="resetstudentlist">
                             <div class="input-group input-group-sm" id="sel_member_codeerr">
                              <select class="form-control select2" name="sel_member_code" id="sel_member_code" >
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
                                  if ($bodycontent['transactionEditdata']->member_id==$membercode->member_id) {
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
                            <input type="text" class="form-control forminputs " id="membername" name="membername" placeholder="" autocomplete="off" style="text-transform:uppercase"  readonly  value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->title_one." ".$bodycontent['transactionEditdata']->member_name;}?>">
                            </div>

                          </div>
               </div><!-- end of col-md-3 -->
            
             
          
             </div>

             <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Booking Data</h3> 

             <div class="row">

                         <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Qty/Hr.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="quantity" name="quantity" placeholder="" autocomplete="off" onKeyUp="numericFilter(this);" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->quantity;}?>" >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Rate</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="rate" name="rate" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->rate;}else{echo $bodycontent['parameterData']->rate; }?>"  onKeyUp="numericFilter(this);"  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Guest</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="guest_amt" name="guest_amt" placeholder="" autocomplete="off"  onKeyUp="numericFilter(this);" value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->guest_charge;}?>" >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Taxable Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="taxable_amt" name="taxable_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->taxable;}?>" >
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
                            <input type="text" class="form-control forminputs " id="cgst_amt" name="cgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->cgst_amt;}?>"  >
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
                            <input type="text" class="form-control forminputs " id="sgst_amt" name="sgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->sgst_amt;}?>">
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Net Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs" id="net_amt" name="net_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['transactionEditdata']->total_amount;}?>"  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
               
             </div>  
            
           
           </div>

            <div class="formblock-box">
            
             <div class="row">
            
                    <div class="col-md-10">
                      <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
                      <p id="errormsg" class="error"></p>
                    </div>
              
               <div class="col-md-2 text-right">
                 <button type="submit" class="btn btn-sm action-button" id="facilitysavebtn" style="width: 70%;"><?php echo $bodycontent['btnText']; ?></button>

                   <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 70%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
               </div>
            
             </div>
           </div>
                      
          </div>
          </form>
          <!-- /.card-body -->
        </div><!-- /.card -->
    </section>

