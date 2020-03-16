<script src="<?php echo base_url(); ?>assets/js/customJs/account/receipt_payment.js"></script>

<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Payment/Receipt</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                <a href="<?php echo base_url(); ?>receiptpayment/addReceiptpayment" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a>
              <a href="<?php echo base_url(); ?>receiptpayment" class="btn btn-info btnpos">
              <i class="fas fa-clipboard-list"></i> List </a>
                </div>           
            </div><!-- /.card-header -->

           <form name="receiptPaymentFrom" id="receiptPaymentFrom" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>">
           <input type="hidden" name="recpayID" id="recpayID" value="<?php echo $bodycontent['recpayID']; ?>">
            <div class="card-body">

               <div class="formblock-box">
                           
                         <div class="row">
                           <div class="col-md-3"></div>
                              <div class="col-md-3">
                                <label for="groupname">Voucher No</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="voucher_no" id="voucher_no" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['recpayEditdata']->voucher_no; } ?>" readonly >
                                </div>
                              </div>
                           
                              </div>

                                <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Voucher Date</label>
                            
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="voucher_dt" id="voucher_dt" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['recpayEditdata']->voucher_date));;}else{echo date('d/m/Y');}?>">
                          </div>
                        </div>
                 </div>
        
                </div>

                <?php

                        $entry_mode = array(
                                              'PAY' => "Payment",
                                              'REC' => "Receipt"
                                            );


                        if($bodycontent['mode'] == 'EDIT'){


                            if ($bodycontent['recpayEditdata']->tran_type=='PV') {
                               $voucher_entry='PAY';
                            }else{
                               $voucher_entry='REC';
                            }

                         }

                ?>
                  


                 <div class="row">
                    <div class="col-md-3"></div>
                     <div class="col-md-3">
                          <div class="form-group">
                            <label for="code">Payment/Receipt Mode</label>
                             <div class="input-group input-group-sm" id="entry_modeerr">
                             
                              <select class="form-control select2" name="entry_mode" id="entry_mode"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($entry_mode as $key => $entry_mode) {
                              ?>
                              <option value="<?php echo $key;?>"
                              <?php

                                  if($bodycontent['mode'] == 'EDIT'){ 

                                      if ($voucher_entry==$key) {
                                        echo "selected";
                                      }
                                  }

                              ?>
                              ><?php echo $entry_mode;?></option>
                              <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-2 -->

                     <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">Bank/Cash A/c</label>
                             <div class="input-group input-group-sm" id="cash_bank_acerr">
                             
                              <select class="form-control select2" name="cash_bank_ac" id="cash_bank_ac"  style="width: 100%;">
                              <option value="">Select</option>
                                  <?php 
                              foreach ($bodycontent['cashbankList'] as $cashbankList) {
                              
                               ?>
                               <option value="<?php echo $cashbankList->account_id;?>"
                                 <?php

                                  if($bodycontent['mode'] == 'EDIT'){ 

                                      if ($bodycontent['cashbankac']==$cashbankList->account_id) {
                                        echo "selected";
                                      }
                                  }

                              ?>
                               >
                               <?php echo $cashbankList->account_name;?></option>

                              <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-2 -->


                 </div>

                 <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">

                          <div class="form-group">
                            <label for="code">Account to be <span id="dr_br_text">Debeted</span></label>
                             <div class="input-group input-group-sm" id="account_iderr">
                             
                              <select class="form-control select2" name="account_id" id="account_id"  style="width: 100%;">
                              <option value="">Select</option>
                                  <?php 
                              foreach ($bodycontent['allaccountList'] as $allaccountlist) {
                              
                               ?>
                               <option value="<?php echo $allaccountlist->account_id;?>">
                               <?php echo $allaccountlist->account_name;?></option>

                              <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-2 -->

                   <div class="col-md-2">
                                <label for="groupname">Amount</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="" value=""  onKeyUp="numericFilter(this);" >
                                </div>
                              </div>
                           
                              </div>
                      <div class="col-md-1">   <label for="groupname">&nbsp;</label>
                       <div class="form-group">
                                   <div class="input-group input-group-sm">
                      <button type="button" class="btn btn-sm action-button addAmount" id="maingroupsavebtn" style="width: 60%;">Add</button>
                      </div></div>  </div>           

                 </div>


                 

                      <!-- ----------------------Item details Account --------------------------- -->
                         <div class="row">
                          <div class="col-md-2"></div>
                    <div class="col-sm-7">
                    <div  id="detail_itemamt" style="border: 1px solid #a84e7f;max-height: 250px;overflow: scroll;">

                    <div class="table-responsive">
                     <?php
                          $rowno=0;
                          $detailCount = 0;
                          if($bodycontent['mode']=="EDIT")
                          {
                           $detailCount = sizeof($bodycontent['accountHeadList']);
                          
                          }

                          // For Table style Purpose
                          if($bodycontent['mode']=="EDIT" && $detailCount>0)
                          {
                            $style_var = "display:block;width:100%;";
                          }
                          else
                          {
                            $style_var = "display:none;width:100%;";
                          }
                        ?>

                 <table class="table table-bordered" style="font-size: 10px;color: #354668;<?php //echo $style_var; ?>">
                  <thead>                  
                    <tr>
                     
                      <th style="width:10%">Sl No</th>
                      <th style="width:60%">Account Head</th>
                      <th>Amount</th>
                      
                      <th style="width:10%">Del</th>
                    </tr>
                  </thead>
                  <tbody>


                  <?php 
                        if ($bodycontent['accountHeadList']) {
                          $sl=1;
                          foreach ($bodycontent['accountHeadList'] as $accountheadlist) {
                         

                  ?>


    <tr id="rowItemdetails_<?php echo $rowno; ?>" class="itemDtlCls" >

      <td style="text-align: left;"> 
        
          <span id="serial_<?php echo $rowno; ?>"><?php echo $sl++;?></span> 
                        
    </td>
    
    <td style="text-align: left;width: 20%"> 
    <input type="hidden" class="listaccountid" name="listaccountid[]" id="listaccountid_<?php echo $rowno; ?>" value="<?php echo $accountheadlist->account_master_id;?>"> 

       <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
             <div class="input-group input-group-sm"> 
                 
                  <select class="form-control select2" name="acdroplist[]" id="acdroplist_<?php echo $rowno; ?>">
                   
                     <?php 
                              foreach ($bodycontent['allaccountList'] as $allaccountlist) {
                              
                               ?>
                               <option value="<?php echo $allaccountlist->account_id;?>" 
                                <?php if($allaccountlist->account_id == $accountheadlist->account_master_id){
                                    echo 'selected';
                                } ?>>
                               
                               <?php echo $allaccountlist->account_name;?></option>

                              <?php } ?>
                  </select>


               </div>
         </div> 




    
     <span class="showdata_<?php echo $rowno; ?>"><?php echo $accountheadlist->account_name;?></span>                    
    </td>
  

     <td style="text-align: right;"> 
    <input type="hidden" class="listamount" name="listamount[]" id="listamount_<?php echo $rowno; ?>" value="<?php echo $accountheadlist->amount;?>">    
     <div class="form-group dispblock_<?php echo $rowno; ?>" style="display: none;">
            <div class="input-group input-group-sm"> 
                <input type="text" class="form-control listamounted editchilddtl_<?php echo $rowno; ?>" name="listamounted[]" id="listamounted_<?php echo $rowno; ?>" value="<?php echo $accountheadlist->amount;?>"  onKeyUp="numericFilter(this);"> 
             </div>
         </div>
     
     <span class="showdata2_<?php echo $rowno; ?>"><?php echo $accountheadlist->amount;?></span>                    
    </td>

  
         

            <td style="vertical-align: middle;text-align: center;">
             
<a href="javascript:;" class="editchilddetails" id="editDocRow_<?php echo $rowno; ?>" title="edit"> <i class="far fa-edit" style="color: #d04949;; font-weight:700;"></i>
     </a>&emsp;

      <a href="javascript:;" class="delDetails" id="delDocRow_<?php echo $rowno; ?>" title="Delete">
     
      <i class="far fa-trash-alt" style="color: #d04949;; font-weight:700;"></i>
         

        </a>
        
        
      </td>       
        
    
    </tr>



                


                  <?php $rowno++;
                          }


                      }
                  ?>

                   
                  </tbody>
                </table>
                </div><!-- end of table responsive -->





                </div>

                <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">  
             
                </div>
                      
                    </div>


                    <!-- -------------End details account ------------------ -->



                    <div class="row">
                        <div class="col-md-2"></div>
                              <div class="col-md-3">
                                <label for="groupname">Total Dr</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="total_dr" id="total_dr" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['recpayEditdata']->total_dr_amt; } ?>" readonly >
                                </div>
                              </div>
                           
                              </div>
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                <label for="groupname">Total Cr</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="total_cr" id="total_cr" placeholder="" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['recpayEditdata']->total_cr_amt; } ?>" readonly >
                                </div>
                              </div>
                           
                              </div>   
                      
                    </div>

                     <div class="row">
                     <div class="col-md-2"></div>
                              <div class="col-md-7">
                                <label for="groupname">Narration</label>
                                  <div class="form-group">
                                   <div class="input-group input-group-sm">
                                    <textarea  class="form-control" name="narration" id="narration"><?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['recpayEditdata']->narration; } ?></textarea>
                                </div>
                              </div>
                           
                              </div>
                       
                     </div>



                   
                 

               
                  
                                     
                
            
              </div>

               <div class="formblock-box">
                   <div class="row">

                        
                    

                      <?php if($bodycontent['mode'] == 'ADD'){ ?>
                          <div class="col-md-10">
                        <?php }else{  ?>
                          <div class="col-md-10">
                        <?php  }?>
                          <p id="errormsg" class="errormsgcolor"></p>
                          <p id="response_msg" style="color: #689921;font-weight: bold;">  </p>
                          </div>


                         <div class="col-md-2 text-right">
                            <button type="submit" class="btn btn-sm action-button" id="patrecsavebtn" style="width: 60%;"><?php echo $bodycontent['btnText']; ?></button>

                              <span class="btn btn-sm action-button loaderbtn" id="loaderbtn" style="display:none;width: 60%;"><?php echo $bodycontent['btnTextLoader']; ?></span>
                           </div>


              
                   </div>
                      
            </div>
          </form>
        </div>
          <!-- /.card-body -->
        </div><!-- /.card -->
  

