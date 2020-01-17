<script src="<?php echo base_url();?>assets/js/customJs/payment/payment_tennis.js"></script>

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

  #cheque_bank_dtl,
  #receivable_dtl,
  #other_recpt_amount_adm,
  #other_recpt_amount_item,
  #receivable_from_student_amount{
    display: none;
  }
.codegencls{

  float: right;
  color: green;
  border: 2px solid #9f4e7f;
  padding: 1.7px;
  border-radius: 5px;
  color:#9f4e7f;
  font-size: 12px;
  cursor: pointer;
}

.receivableDtl{
  float: right;
  font-size: 12px;
  cursor: pointer;
}

fieldset.scheduler-border {
    /* border: 1px groove #ddd !important;
    #padding: 0 1.4em 1.4em 1.4em !important;
    padding: 0 1em 1em 1em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000; */
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
              $attr = array("id"=>"tennisPaymentForm","name"=>"tennisPaymentForm");
              echo form_open('',$attr); ?>
<section class="content layout-box-content-format1">

 

   <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Receipt</h3>

              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                <button type="button" class="btn btn-default"><i class="fas fa-plus"></i> Add </button>
                <button type="button" class="btn btn-default"><i class="fas fa-clipboard-list"></i> List</button>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i> Generate Code</button>
               
              </div>
            </div><!-- /.card-header -->

            <div class="card-body ">
          
            <fieldset class="scheduler-border formblock-box"> 
              <!-- <legend class="scheduler-border">Student Details</legend> -->
              <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Student Details</h3>
        <!--    <span class="frm_header">Student Details</span> -->
            <!-- <span  class="codegencls" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i>&nbsp;Code Generation</span> -->



             <input type="hidden" name="paymentID" id="paymentID" value="<?php echo $bodycontent['paymentID']; ?>" />
             <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

              <div class="row">
               <div class="col-md-3">
                          <div class="form-group ">
                            <label for="code">Student Code</label>
                            <div id="resetstudentlist">
                             <div class="input-group input-group-sm" id="sel_student_codeerr">
                              <select class="form-control select2" name="sel_student_code" id="sel_student_code" >
                              <option value="">Select</option>
                              <?php 
                              foreach ($bodycontent['studentCodeList'] as  $studentcode) {
                                
                              ?>
                              <option value="<?php echo $studentcode->student_code;?>"
                               data-name="<?php echo $studentcode->student_name; ?>"
                               data-billstyle="<?php echo $studentcode->bill_style; ?>"

                              ><?php echo $studentcode->student_code;?></option>
                              <?php } ?>
                             
                            </select>
                            </div></div>

                          </div>
                 </div><!-- end of col-md-3 -->
                <div class="col-md-4">
                          <div class="form-group">
                            <label for="firstname">Student Name</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="studentname" name="studentname" placeholder="" autocomplete="off" value="" style="text-transform:uppercase"  readonly >
                            </div>

                          </div>
               </div><!-- end of col-md-3 -->
                

                
                
              </div>
              </fieldset>



     
  <fieldset class="scheduler-border formblock-box"> 
  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Payment Details</h3>
    <!-- <legend class="scheduler-border">Payment Details</legend> -->
              <!--    <span class="frm_header"></span> -->
                 <div class="row">
                 
                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">Payment Date</label>
                            <!-- <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false"> -->
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="payment_dt" id="payment_dt" value="<?php echo date('d/m/Y');?>">
                          </div>
                        </div>
                 </div>
                 <?php
                 $tran_type = array(
                                    'ORADM' => "Other Receipts(Admission)",
                                    'ORITM' => "Other Receipts(Item)",
                                    'RCFS' => "Receivable From Student",
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
                              <option value="<?php echo $key;?>"><?php echo $tran_type?></option>
                              <?php } ?>
                            </select>

                            </div>

                          </div>
                 </div><!-- end of col-md-3 -->

              
                  <?php
                          // testing data it will be call from databese account map table
                          $acTobeDebited = array(
                                                  '1' =>"CASH IN HAND" , 
                                                  '2' =>"CHEQUE IN HAND" , 
                                                  '3' =>"DEBIT CARD" , 
                                                  '4' =>"CREDIT CARD" 
                                                  );

                  ?>
                    <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">Payment Mode</label>
                            <div class="input-group input-group-sm" id="paymentmodeerr">
                              <select class="form-control select2" name="paymentmode" id="paymentmode"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($acTobeDebited as $key => $actobedebited) {
                              
                               ?>
                               <option value="<?php echo $actobedebited;?>"><?php echo $actobedebited;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                  </div>
                     <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">(A/C to be debited)</label>
                            <div class="input-group input-group-sm" id="actobedebitederr">
                              <select class="form-control select2" name="actobedebited" id="actobedebited"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($acTobeDebited as $key => $actobedebited) {
                              
                               ?>
                               <option value="<?php echo $key;?>"><?php echo $actobedebited;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                  </div>
                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">A/C to be credited</label>
                            <div class="input-group input-group-sm" id="actobecreditederr">
                              <select class="form-control select2" name="actobecredited" id="actobecredited"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['actobeCreditedList'] as $actobecredited) {
                              
                               ?>
                               <option value="<?php echo $actobecredited->account_id;?>"><?php echo $actobecredited->account_name;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                       </div>
                         <div class="col-md-2" id="fine_ac_drp" style="display: none">
                          <div class="form-group">
                            <label for="code">Ledger For Fine</label>
                            <div class="input-group input-group-sm" id="fine_ledger_acerr">
                              <select class="form-control select2" name="fine_ledger_ac" id="fine_ledger_ac"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['fineAccountList'] as $fineaccountlist) {
                              
                               ?>
                               <option value="<?php echo $fineaccountlist->account_id;?>"><?php echo $fineaccountlist->account_name;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                       </div>

            

                 </div>

                 <?php
                      // $monthlyQuarter = array(
                      //                         '1' => 'Apr-Jun',
                      //                         '2' => 'July-Sep',
                      //                         '3' => 'Oct-Dec',
                      //                         '4' => 'Jan-Mar',
                      //                          );

                 ?>
                 <div id="receivable_dtl">
                  <div class="row">
                      <div class="col-md-3" id="billing_style_Q">
                          <div class="form-group">
                            <label for="code">Fees Quarter</label>
                            <div class="input-group input-group-sm" id="fees_quartererr">
                              <select class="form-control select2" name="fees_quarter" id="fees_quarter"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['quartermonthList'] as $monthlyquarter) {
                              
                               ?>
                               <option value="<?php echo $monthlyquarter->id;?>"><?php echo $monthlyquarter->quarter;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                      </div>
                      <?php      /*   $months = array(
                                                '1' => 'January', 
                                                '2' => 'February', 
                                                '3' => 'March', 
                                                '4' => 'April', 
                                                '5' => 'May', 
                                                '6' => 'June', 
                                                '7' => 'July', 
                                                '8' => 'August', 
                                                '9' => 'September', 
                                                '10' => 'October', 
                                                '11' => 'November', 
                                                '12' => 'December'
                                                ); */

                     ?>

                        <div class="col-md-3" id="billing_style_M">
                          <div class="form-group">
                            <label for="code">Fees Month</label>
                            <div class="input-group input-group-sm" id="fees_montherr" >
                              <select class="form-control select2" name="fees_month" id="fees_month"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['monthList'] as $months) {
                              
                               ?>
                               <option value="<?php echo $months->id;?>"><?php echo $months->short_name;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Fees Year</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="fees_year" name="fees_year" placeholder="" autocomplete="off" value="<?php echo $bodycontent['acyear'];?>"   readonly >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                    
                  </div>
                  </div>


                  <div id="cheque_bank_dtl">
                    <span class="frm_header form-block-subtitle"><i class="fas fa-angle-right"></i> Cheque In Hand Details</span>
                    <div class="row" >
                    <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Bank</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="bank" name="bank" placeholder="" autocomplete="off" value="" >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                     <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Branch</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="branch" name="branch" placeholder="" autocomplete="off" value=""  >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Cheque No.</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="cheque_no" name="cheque_no" placeholder="" autocomplete="off" value="">
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
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="cheque_dt" id="cheque_dt">
                          </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                      

                    </div>

                    </div>
                    </fieldset>

                     <div id="receivable_from_student_amount">
                        <fieldset class="scheduler-border formblock-box"> 
                          <!-- <legend class="scheduler-border">Amount (Receivable From Student)</legend> -->
                          <h3 class="form-block-subtitle">Amount (Receivable From Student)</h3>
                         <span  class="bg-gradient-warning btn-xs receivableDtl" data-toggle="modal" data-target="#billModalDetails" id="bill_dtl_btn"  ><i class="fas fa-cog"></i>&nbsp;Bill Details </span>
                      <div class="row" >

                         <input type="hidden" name="bill_id" id="bill_id" value="" />
                         <input type="hidden" name="clear_fine_amt" id="clear_fine_amt" value="" />
                         <input type="hidden" name="student_new_status" id="student_new_status" value="" />
                      <div class="col-md-1">
                              <div class="form-group">
                                <label for="firstname">Amount</label>
                                  <div class="input-group input-group-sm" id="receivable_student_amterr">
                                <input type="text" class="form-control forminputs " id="receivable_student_amt" name="receivable_student_amt" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" readonly>
                                </div>

                              </div>
                     </div><!-- end of col-md-2 -->

                      <div class="col-md-1">
                              <div class="form-group">
                                <label for="firstname">Fine Amt.</label>
                                  <div class="input-group input-group-sm">
                                <input type="text" class="form-control forminputs " id="receivable_student_fineamt" name="receivable_student_fineamt" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" readonly >
                                </div>

                              </div>
                     </div><!-- end of col-md-2 -->

                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Taxable</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="receivable_student_taxable" name="receivable_student_taxable" placeholder="" autocomplete="off" value=""  readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">CGST Rate</label>
                              <div class="input-group input-group-sm" id="receivable_student_cgst_rateerr">
                              <select class="form-control select2" name="receivable_student_cgst_rate" id="receivable_student_cgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>" ><?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">CGST Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="receivable_student_cgst_amt" name="receivable_student_cgst_amt" placeholder="" autocomplete="off" value=""  readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                         <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">SGST Rate</label>
                              <div class="input-group input-group-sm" id="receivable_student_sgst_rateerr">
                              <select class="form-control select2" name="receivable_student_sgst_rate" id="receivable_student_sgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>" data-rate="<?php echo $sgstrate->rate; ?>" ><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            
                            </select>
                            </div>
                          </div>
                      </div>
                        <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">SGST Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="receivable_student_sgst_amt" name="receivable_student_sgst_amt" placeholder="" autocomplete="off" value="" readonly   >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Net Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="receivable_student_netamt" name="receivable_student_netamt" placeholder="" autocomplete="off" value=""   readonly >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                          <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Pay. Amt.</label>
                              <div class="input-group input-group-sm" id="receivable_student_paymentamterr">
                            <input type="text" class="form-control forminputs " id="receivable_student_paymentamt" name="receivable_student_paymentamt" placeholder="" autocomplete="off" value=""    >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->

                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                              <div class="input-group input-group-sm">
                            <button type="button" class="btn  bg-gradient-success btn-xs" id="clear_fine_rec">Clear Fine</button>
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                      
                     
                  





                     </div>


                        </fieldset>
                     </div>




                    <div id="other_recpt_amount_adm">
                     <fieldset class="scheduler-border formblock-box"> 
                       <h3 class="form-block-subtitle">
                       Amount (Other Receipts-Admission)
                       </h3>
                       <!-- <legend class="scheduler-border">Amount (Other Receipts-Admission)</legend> -->
                   <!--  <span class="frm_header">Other Receipts Amount Details(Admission)</span> -->
                    <div class="row" >

                    <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Amount</label>
                              <div class="input-group input-group-sm" id="oth_rec_amterr">
                            <input type="text" class="form-control forminputs " id="oth_rec_amt" name="oth_rec_amt" placeholder="" autocomplete="off" value=""  onKeyUp="numericFilter(this);">
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">CGST Rate</label>
                              <div class="input-group input-group-sm" id="oth_rec_cgst_rateerr">
                              <select class="form-control select2" name="oth_rec_cgst_rate" id="oth_rec_cgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>"><?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">CGST Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="oth_rec_cgst_amt" name="oth_rec_cgst_amt" placeholder="" autocomplete="off" value=""  readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                     <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">SGST Rate</label>
                              <div class="input-group input-group-sm" id="oth_rec_sgst_rateerr">
                              <select class="form-control select2" name="oth_rec_sgst_rate" id="oth_rec_sgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>" data-rate="<?php echo $sgstrate->rate; ?>" ><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            
                            </select>
                            </div>
                          </div>
                      </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">SGST Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="oth_rec_sgst_amt" name="oth_rec_sgst_amt" placeholder="" autocomplete="off" value="" readonly   >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->

                      <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Net Amt</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="oth_rec_netamt" name="oth_rec_netamt" placeholder="" autocomplete="off" value=""   readonly>
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                      
                    </div>
                    </fieldset>
                      
                    </div>

                  <div id="other_recpt_amount_item">
                  <fieldset class="scheduler-border formblock-box"> 
                    <!-- <legend class="scheduler-border">Amount (Other Receipts-Item)</legend> -->
                    <h3 class="form-block-subtitle">Amount (Other Receipts-Item)</h3>
                   
                         <div class="row" >
                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="code">Item</label>
                            <div class="input-group input-group-sm" id="tennisitem_err">
                              <select class="form-control select2" name="tennisitem" id="tennisitem"  style="width: 100%;">
                              <option value=""
                              data-itemrate=""
                              data-itemhsn=""
                              >Select</option>
                              <?php
                              foreach ($bodycontent['tennisItemList'] as $itemList) {
                              
                               ?>
                               <option value="<?php echo $itemList->item_id;?>"
                                data-itemrate="<?php echo $itemList->rate; ?>"
                                data-itemhsn="<?php echo $itemList->hsn_no; ?>"
                               ><?php echo $itemList->item_name;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                       </div>

                         <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">HSN</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="hsncode" name="hsncode" placeholder="" autocomplete="off" value=""   readonly >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Qty.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="itemqty" name="itemqty" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);"   >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Rate</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="itemrate" name="itemrate" placeholder="" autocomplete="off" value="" readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                         <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Taxable</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="itemtaxable" name="itemtaxable" placeholder="" autocomplete="off" value=""  readonly  >
                            </div>

                          </div>
                      </div><!-- end of col-md-1 -->
                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="code">CGST Rate</label>
                              <div class="input-group input-group-sm" id="item_cgst_rateerr">
                              <select class="form-control select2" name="item_cgst_rate" id="item_cgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['cgstrate'] as $cgstrate) {  
                               ?>
                               <option value="<?php echo $cgstrate->id?>" data-rate="<?php echo $cgstrate->rate; ?>" ><?php echo $cgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">CGST Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_cgst_amt" name="item_cgst_amt" placeholder="" autocomplete="off" value=""  readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                       <div class="col-md-1">
                          <div class="form-group">
                            <label for="code">SGST Rate</label>
                              <div class="input-group input-group-sm" id="item_sgst_rateerr">
                              <select class="form-control select2" name="item_sgst_rate" id="item_sgst_rate"  style="width: 100%;">
                              <option value="" data-rate="0">Select</option>
                                <?php
                                 foreach ($bodycontent['sgstrate'] as $sgstrate) {  
                               ?>
                               <option value="<?php echo $sgstrate->id?>"  data-rate="<?php echo $sgstrate->rate; ?>"><?php echo $sgstrate->gstDescription?></option>
                              <?php }?>
                            </select>
                            </div>
                          </div>
                      </div>
                        <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">SGST Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_sgst_amt" name="item_sgst_amt" placeholder="" autocomplete="off" value="" readonly   >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">Net Amount</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="item_netamt" name="item_netamt" placeholder="" autocomplete="off" value=""  readonly  >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                              <div class="input-group input-group-sm">
                           <i class="far fa-plus-square  addItem"></i>
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->

                   
                    </div>

                    <div class="row">
                    <div class="col-sm-12">
                    <div  id="detail_itemamt" style="#border: 1px solid #e49e9e;">
                    <div class="table-responsive">
                     <?php
                          $rowno=0;
                          $detailCount = 0;
                          if($bodycontent['mode']=="EDIT")
                          {
                          // $detailCount = sizeof($bodycontent['mensuMedList']);
                           $detailCount = 0;
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

                 <table class="table table-bordered" style="font-size: 10px;color: #354668;<?php echo $style_var; ?>">
                  <thead>                  
                    <tr>
                     
                      <th>Item</th>
                      <th>HSN</th>
                      <th>Qty</th>
                      <th>Rate</th>
                      <th>Taxable</th>
                      <th>Rate</th>
                      <th>CGST Amt.</th>
                      <th>Rate</th>
                      <th>SGST Amt.</th>
                      <th>Net Amt.</th>
                      <th style="width: 40px">Del</th>
                    </tr>
                  </thead>
                  <tbody>
            
    
               
                <input type="hidden" name="rowno" id="rowno" value="<?php echo $rowno;?>">     
                  </tbody>
                </table>
                </div><!-- end of table responsive -->
                </div>
             
                </div>



                      
                    </div>
                      
                  
                    </fieldset>

                 
                      </div>


                    <fieldset class="scheduler-border formblock-box">
                        <div class="row">
                          <div class="col-md-8">
                                  <div class="form-group">
                                    <label for="firstname">Narration</label>
                                    <div class="input-group input-group-sm">
                                    <input type="text" class="form-control forminputs " id="narration" name="narration" placeholder="" autocomplete="off" value="" style="text-transform:uppercase"  >
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
                                    <button type="submit" class="btn action-button btn-sm" id="tennispaymentsavebtn"><i class="fas fa-save"></i> &nbsp; <?php echo $bodycontent['btnText']; ?></button>
                                  
                                    <span class="btn btn-sm action-button formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                              </div>
                       </div>
                     </div>

                      <!-- <div class="row">
                        <div class="col-md-5"></div>
                          <div class="col-md-2">
                            <div class="form-group">
                                  <label for="eqpname">&nbsp;</label>
                                  <div class="btnDiv">
                                    <button type="submit" class="btn btn-block btn-primary btn-sm" id="tennispaymentsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                                  
                                    <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i><?php echo $bodycontent['btnTextLoader']; ?></span>
                                  </div>
                            </div>
                          </div>
                      </div> -->




              
           
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

                <div id="student_adminfo" style="display: none">
                   <div class="frm_header form-block-subtitle">Admission Details</div>
                   <input type="hidden" name="admissionID" id="admissionID" value="0" />
                  <input type="hidden" name="mode" id="mode" value="ADD" />
                 <div class="row">
                  <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Student Code</label>
                            <input type="text" class="form-control forminputs " id="student_code" name="student_code" placeholder="" autocomplete="off" value=""  readonly >

                          </div>
                 </div><!-- end of col-md-3 -->

                   <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                               <select class="form-control select" name="title_one" id="title_one" style="width: 100%;">
                              <option value="">Select</option>
                              <option value="MR">MR</option>
                              <option value="MR.">MR.</option>
                              <option value="MS">MS</option>
                              <option value="MS.">MS.</option>
                              
                            </select>

                          </div>
                   </div><!-- end of col-md-2 -->
                     <div class="col-md-4">
                          <div class="form-group">
                            <label for="firstname">Student Name</label>
                            <input type="text" class="form-control forminputs " id="student_name" name="student_name" placeholder="" autocomplete="off" value="" style="text-transform:uppercase"  readonly >

                          </div>
                     </div><!-- end of col-md-3 -->
                 <div class="col-md-3">
                          <div class="form-group">
                            <label for="eqpname">&nbsp;</label>
             
                         <!--   <button type="button" class="btn btn-block btn-primary" id="create_code">Continue</button> -->
                         

                  <div class="btnDiv">
                      <button type="submit" class="btn formBtn btn-block btn-sm action-button" id="admissionsavebtn">Continue <i class="fas fa-long-arrow-alt-right"></i></button>
                    
                      <span class="btn action-button formBtn loaderbtn btn-sm" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Saving...</span>
                  </div>
                          </div>
                 </div><!-- end of col-md-2 -->


                  
                </div>
             


            </div>
            <!-- <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->

             <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      </div>




    <div class="modal fade" id="tennispaymentaftersavemodel" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xs" style="width: 300px;margin-top: 260px;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="frm_header"> Saved Succesfully</h5>
           
              
            </div>
            <div class="modal-body" style="font-size: 12px;">
            <table>
              <tr>
                <td><button type="button" class="btn btn-block btn-success btn-xs">Print Receipt</button></td>
                <td><button type="button" class="btn btn-block btn-danger btn-xs" data-dismiss="modal" aria-label="Close" id="close_btn_patment_rec">Close</button></td>
              </tr>
            </table>
             
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      </div>


  <div id="billModalDetails" class="modal fade customModal format1 right"  data-keyboard="false" data-backdrop="false">
  <div class="modal-dialog modal-xs" style="width: 350px;margin-top: 195px;">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, #A60711 0%,#4E3FFB 100%);background-color: rgba(0, 0, 0, 0);
padding: 5px;color: #fff;">
       <h4 class="frm_header">Bill Details</h4>
        <button type="button" class="close" data-dismiss="modal"  >&times;<span class="sr-only">Close</span></button>
       
      </div>
      <div class="modal-body">
        <div id="bill_details_data"></div>
      </div>
    </div>
  </div>
</div>











