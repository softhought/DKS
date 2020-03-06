<script src="<?php echo base_url();?>assets/js/customJs/member_receipt/member_receipt.js"></script>

<style type="text/css">
  /* .frm_header{
    #background-color:#394077;
    #background-color:#394077;
    color:#9f4e7f;
    padding-left: 5px;
    padding-right: 5px;
    border-radius: 3px;
    margin-bottom: 5px;
    font-size: 12px;

  } */
  .card-body .modal-body{
    #color: #44423d;
   
  }
  /* label{
    font-size: 12px;
    color: #354668 !important;
    font-weight: 700;
  } */

  #cheque_bank_dtl{
    display: none;
  }



    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
        color:#9f4e7f;
        font-size: 13px !important;
    }

.addItem{
  font-size: 28px;
  color:#9f4e7f;
  cursor: pointer;
}
.table td, .table th {
    padding: .3rem;
    
}

.modal.fade:not(.in).right .modal-dialog {
  -webkit-transform: translate3d(125%, 0, 0);
  transform: translate3d(125%, 0, 0);
}




</style>




 <?php 
              $attr = array("id"=>"memberreceiptForm","name"=>"memberreceiptForm");
              echo form_open('',$attr); ?>
<section class="content layout-box-content-format1">

 

   <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Member Receipt</h3>
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                 <a href="<?php echo base_url(); ?>memberreceipt" class="btn btn-info btnpos"><i class="fas fa-clipboard-list"></i> List </a>
              </div> 

           
            </div><!-- /.card-header -->

            <div class="card-body ">
          
            <fieldset class="scheduler-border formblock-box"> 
              <!-- <legend class="scheduler-border">Student Details</legend> -->
              <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i>  Details</h3>
      



             <input type="hidden" name="memberreceiptID" id="memberreceiptID" value="<?php echo $bodycontent['memberreceiptID']; ?>" />
             <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

              <div class="row">


               <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Receipt No</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="receipt_no" name="receipt_no" placeholder="" autocomplete="off" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo $bodycontent['receiptEditdata']->mem_receipt_no;} ?>"   readonly >
                            </div>

                          </div>
              </div><!-- end of col-md-3 -->

                   <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Receipt Date</label>
                            <!-- <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false"> -->
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="receipt_dt" id="receipt_dt" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['receiptEditdata']->receipt_date));}else{echo date('d/m/Y');}?>">
                          </div>
                        </div>
                 </div>

                   <?php
                 $tran_type = array(
                                    'ORADM' => "Other Receipts(Admission)",
                                    'ORITM' => "Other Receipts(Item)",
                                    'RCFM' => "Receivable From Member",
                                     );
                 ?>
                 <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">Transaction Type</label>
                             <div class="input-group input-group-sm" id="tran_typeerr">
                             
                              <select class="form-control select2" name="tran_type" id="tran_type"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($tran_type as $key => $tran_type) {
                              ?>
                              <option value="<?php echo $key;?>"

                              <?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                if($bodycontent['receiptEditdata']->tran_type==$key){echo "selected";}
                              }
                              ?>
                              ><?php echo $tran_type?></option>
                              <?php } ?>
                            </select>
                            </div>
                          </div>
                 </div><!-- end of col-md-3 -->
           

              </div>
              </fieldset>


              <fieldset class="scheduler-border formblock-box"> 
               <div class="row">
                <div class="col-md-1"></div>
                 <div class="col-md-4" id="other_block">
                    <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Regular</h3>

             
                          <div class="form-group ">
                            <label for="code">Member Code</label>
                            <div id="resetmemberlist">
                             <div class="input-group input-group-sm" id="sel_member_codeerr">
                              <select class="form-control select2" name="sel_member_code" id="sel_member_code" >
                              <option value="">Select</option>
                              <?php 
                              foreach ($bodycontent['memberCodeList'] as  $membercode) {    
                              ?>
                              <option value="<?php echo $membercode->member_id;?>"
                               data-name="<?php echo $membercode->title_one." ".$membercode->member_name; ?>"

                               <?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                if($bodycontent['receiptEditdata']->tran_type=='RCFM'){
                                   if($bodycontent['receiptEditdata']->member_id == $membercode->member_id){echo "selected";}
                                }
                               
                              }
                              ?>
                              
                              ><?php echo $membercode->member_code;?></option>
                              <?php } ?>
                             
                            </select>
                            </div></div>

                          </div>
              
             
                          <div class="form-group">
                            <label for="firstname">Name</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="member_name" name="member_name" placeholder="" autocomplete="off" value="<?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                if($bodycontent['receiptEditdata']->tran_type!='ORADM'){
                                  echo $bodycontent['receiptEditdata']->title_one." ".$bodycontent['receiptEditdata']->member_name;
                                }  
                              }
                              ?>" readonly    >
                            </div>
                          </div>



                          <div class="form-group">
                            <label for="firstname">Amount</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="amount" name="amount" placeholder="" autocomplete="off" value="<?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                if($bodycontent['receiptEditdata']->tran_type!='ORADM'){
                                  echo $bodycontent['receiptEditdata']->total_amount;
                                }
                               
                              }
                              ?>"    >
                            </div>

                          </div>



                           
                 





              
                 </div>
                  <div class="col-md-2"></div>
                 <div class="col-md-4" id="adm_block">
                  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> New membership & Items</h3>

                   <div class="row">
                               <div class="col-md-12">
                                      <div class="form-group ">
                                      <label for="code">Member Category</label>
                                       <div class="input-group input-group-sm" id="sel_member_categoryerr">
                                        <select class="form-control select2" name="sel_member_category" id="sel_member_category" >
                                        <option value="">Select</option>
                                        <?php 
                                        foreach ($bodycontent['categoryList'] as  $categorylist) { 
                                        ?>
                                        <option value="<?php echo $categorylist->cat_id;?>"
                                        <?php 
                                     if($bodycontent['mode'] == 'EDIT'){ 
                                      if($bodycontent['receiptEditdata']->tran_type=='ORADM'){
                                       if($bodycontent['receiptEditdata']->member_category==$categorylist->cat_id){echo "selected";}
                                      }
                                     
                                    }
                              ?>



                                        ><?php echo $categorylist->category_name;?></option>
                                        <?php } ?>   
                                      </select>
                                      </div>
                                    </div>
                              </div>
                  </div>

                  <?php

                    $firstname="";
                    $lastname="";

                     if($bodycontent['mode'] == 'EDIT'){

                      $name = $bodycontent['receiptEditdata']->member_name;
                      $parts = explode(' ', $name);
                      $firstname = $parts[0];
                      $lastname = $parts[1];


                      }



                  ?>
              
                          <div class="row">
                           <div class="col-md-6">
                             <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <div class="input-group input-group-sm">
                               <input type="text" class="form-control forminputs " id="first_name" name="first_name" placeholder="" autocomplete="off" value="<?php echo $firstname;?>" <?php if($bodycontent['mode'] == 'EDIT'){echo "readonly";}?>   
                                     >
                                    </div>
                                  </div>
                           </div>
                           <div class="col-md-6">
                             <div class="form-group">
                                <label for="firstname">Last Name</label>
                                <div class="input-group input-group-sm">
                                <input type="text" class="form-control forminputs " id="last_name" name="last_name" placeholder="" autocomplete="off" value="<?php echo $lastname;?>"  <?php if($bodycontent['mode'] == 'EDIT'){echo "readonly";}?>  >
                                </div>
                              </div>   
                           </div> 
                          </div>

                         
                           <div class="row">
                               <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="firstname">Code</label>
                                        <div class="input-group input-group-sm">
                                        <input type="text" class="form-control forminputs " id="new_member_code" name="new_member_code" placeholder="" autocomplete="off" value="<?php 
                                     if($bodycontent['mode'] == 'EDIT'){ 
                                      if($bodycontent['receiptEditdata']->tran_type=='ORADM'){
                                       echo $bodycontent['receiptEditdata']->member_code;
                                      }
                                     
                                    }
                              ?>"   readonly >
                                        </div>
                                      </div> 

                               </div>
                               <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="eqpname">&nbsp;</label>
                                       <button type="button" class="btn btn-block btn-sm action-button" id="create_code"> <i class="fas fa-cog"></i> Create </button>

                                    </div>
                                 
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                      <label for="firstname">Adm Fees/Item Fees</label>
                                      <div class="input-group input-group-sm">
                                      <input type="text" class="form-control forminputs " id="adm_fees" name="adm_fees" placeholder="" autocomplete="off" value="<?php 
                                     if($bodycontent['mode'] == 'EDIT'){ 
                                      if($bodycontent['receiptEditdata']->tran_type=='ORADM'){
                                       echo $bodycontent['receiptEditdata']->adm_fees;
                                      }
                                    }
                              ?>" onKeyUp="numericFilter(this);"   >
                                      </div>
                                  </div>
                                 
                               </div>



                               <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="firstname">Sub/Coach Fees</label>
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control forminputs " id="sub_coach_fees" name="sub_coach_fees" placeholder="" autocomplete="off" value="<?php 
                                     if($bodycontent['mode'] == 'EDIT'){ 
                                      if($bodycontent['receiptEditdata']->tran_type=='ORADM'){
                                       echo $bodycontent['receiptEditdata']->sub_coach_fees;
                                      }
                                     
                                    }
                              ?>" onKeyUp="numericFilter(this);" >
                                    </div>
                                </div>
                                 
                               </div>
                           </div>
                           <div class="row">


                           <div class="col-md-3">
                              <div class="form-group">
                                <label for="firstname">CGST%</label>
                                  <div class="input-group input-group-sm">
                                <input type="text" class="form-control forminputs " id="cgst_rate" name="cgst_rate" placeholder="" autocomplete="off" value="<?php echo $bodycontent['parameterData']->cgst_rate; ?>"  readonly  >
                                </div>

                              </div>
                          </div><!-- end of col-md-1 -->

                              <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">CGST Amt</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="cgst_amt" name="cgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['receiptEditdata']->cgst_amt;}?>"  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">SGST%</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="sgst_rate" name="sgst_rate" placeholder="" autocomplete="off" value="<?php echo $bodycontent['parameterData']->sgst_rate; ?>"  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->

                       <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">SGST Amt</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="sgst_amt" name="sgst_amt" placeholder="" autocomplete="off"  readonly value="<?php if($bodycontent['mode'] == 'EDIT'){echo $bodycontent['receiptEditdata']->sgst_amt;}?>">
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->



                               <!-- <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="firstname">Serv. Tax</label>
                                      <div class="input-group input-group-sm">
                                      <input type="text" class="form-control forminputs " id="service_tax" name="service_tax" placeholder="" autocomplete="off" value="<?php 
                                     if($bodycontent['mode'] == 'EDIT'){ 
                                      if($bodycontent['receiptEditdata']->tran_type=='ORADM'){
                                       echo $bodycontent['receiptEditdata']->service_tax;
                                      }
                                     
                                    }
                              ?>"  onKeyUp="numericFilter(this);" >
                                      </div>
                                 </div>
                                 
                               </div> -->


                               <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="firstname">Total</label>
                                          <div class="input-group input-group-sm">
                                          <input type="text" class="form-control forminputs " id="total_amount" name="total_amount" placeholder="" autocomplete="off" value="<?php 
                                     if($bodycontent['mode'] == 'EDIT'){ 
                                      if($bodycontent['receiptEditdata']->tran_type=='ORADM'){
                                       echo $bodycontent['receiptEditdata']->total_amount;
                                      }
                                     
                                    }
                              ?>"  onKeyUp="numericFilter(this);" readonly  >
                                          </div>
                                    </div>
                                 
                               </div>
                           </div>




                          
                        
                             
                         
               
                 </div>
               </div>

              </fieldset>



     
  <fieldset class="scheduler-border formblock-box"> 
  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Accounting Treatment </h3>
    <!-- <legend class="scheduler-border">Payment Details</legend> -->
              <!--    <span class="frm_header"></span> -->
                 <div class="row">
                 
               <?php
                          // testing data it will be call from databese account map table
                          // $acTobeDebited = array(
                          //                         '1' =>"CASH IN HAND" , 
                          //                         '2' =>"CHEQUE IN HAND" , 
                          //                         '3' =>"DEBIT CARD" , 
                          //                         '4' =>"CREDIT CARD" 
                          //                         );

                  ?>

              
             <div class="col-md-2"></div>
                  <div class="col-md-3">
                          <div class="form-group">
                            <label for="code">(A/C to be debited)</label>
                            <div class="input-group input-group-sm" id="actobedebitederr">
                              <select class="form-control select2" name="actobedebited" id="actobedebited"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['acTobeDebited'] as $actobedebited) {
                              
                               ?>
                               <option value="<?php echo $actobedebited->id;?>"
                                <?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                if($bodycontent['receiptEditdata']->dr_ac_id==$actobedebited->id){echo "selected";}
                              }
                              ?>
                               ><?php echo $actobedebited->payment_mode;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                  </div>


                       <div class="col-md-3">
                          <div class="form-group">
                            <label for="code">A/C to be credited</label>
                            <div class="input-group input-group-sm" id="actobecreditederr">
                              <select class="form-control select2" name="actobecredited" id="actobecredited"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['actobeCreditedList'] as $actobecredited) {
                              
                               ?>
                               <option value="<?php echo $actobecredited->account_id;?>"
                                <?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                if($bodycontent['receiptEditdata']->dr_ac_id==$actobecredited->id){echo "selected";}
                              }
                              ?>
                               ><?php echo $actobecredited->account_name;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                       </div>


                        

            

                 </div>

            
               

                  <div id="cheque_bank_dtl">
                    <span class="frm_header form-block-subtitle"><i class="fas fa-angle-right"></i> Cheque In Hand Details</span>
                    <div class="row" >
                    <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Bank</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="bank" name="bank" placeholder="" autocomplete="off" value="<?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                echo $bodycontent['receiptEditdata']->bank;
                              }
                              ?>" >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                     <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Branch</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="branch" name="branch" placeholder="" autocomplete="off" value="<?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                echo $bodycontent['receiptEditdata']->branch;
                              }
                              ?>"  >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Cheque No.</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="cheque_no" name="cheque_no" placeholder="" autocomplete="off" value="<?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                echo $bodycontent['receiptEditdata']->cheque_no;
                              }
                              ?>">
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->

                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Cheque Date.</label>
                             <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="cheque_dt" id="cheque_dt" value="<?php if($bodycontent['mode'] == 'EDIT'){ echo date("d/m/Y", strtotime($bodycontent['receiptEditdata']->cheque_dt));}?>">
                          </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                      

                    </div>

                    </div>
                    </fieldset>

              <fieldset class="scheduler-border formblock-box">
                        <div class="row">
                          <div class="col-md-8">
                                  <div class="form-group">
                                    <label for="firstname">Narration</label>
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control forminputs " id="narration" name="narration" placeholder="" autocomplete="off" value="<?php 
                               if($bodycontent['mode'] == 'EDIT'){ 
                                echo $bodycontent['receiptEditdata']->narration;
                              }
                              ?>" style="text-transform:uppercase"  >
                                    </div>

                                  </div>
                          </div><!-- end of col-md-3 -->
                    </div>


                     </fieldset> 




                 

                     

                     <div class="row formblock-button-blocks">
                       <div class="col-md-8">
                          <p id="error_msg" class="error" style="color: #bf2929;"></p>
                       </div>
                       <div class="col-md-4 text-right">
                              <div class="btnDiv">
                                    <button type="submit" class="btn action-button btn-sm" id="memberreceiptsavebtn"><i class="fas fa-save"></i> &nbsp; <?php echo $bodycontent['btnText']; ?></button>
                                  
                                    <span class="btn btn-sm action-button formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                              </div>
                       </div>
                     </div>

                    




              
           
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

</div>
</section>

  <?php echo form_close(); ?>


      <div class="modal fade customModal format1" id="codegeneration_modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="frm_header">Code Generation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
              <?php 
              $attr = array("id"=>"genCodeForm","name"=>"genCodeForm");
              echo form_open('',$attr); ?>

                  <div class="row">
                  <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control forminputs " id="firstname" name="firstname" placeholder="" autocomplete="off" value=""  style="text-transform:uppercase"  >

                          </div>
                 </div><!-- end of col-md-3 -->
                  <div class="col-md-3">
                          <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control forminputs " id="lastname" name="lastname" placeholder="" autocomplete="off" value="" style="text-transform:uppercase" >

                          </div>
                 </div><!-- end of col-md-3 -->

                  <div class="col-md-3">
                          <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control forminputs " id="generatedcode" name="generatedcode" placeholder="" autocomplete="off" value="" readonly >

                          </div>
                 </div><!-- end of col-md-3 -->
                  <div class="col-md-3">
                          <div class="form-group">
                            <label for="eqpname">&nbsp;</label>
             
                           <button type="button" class="btn btn-block btn-sm action-button" id="create_code"> <i class="fas fa-cog"></i> Create </button>

                          </div>
                 </div><!-- end of col-md-3 -->

                 </div>

          
         

             <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      </div>















