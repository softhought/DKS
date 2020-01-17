<script src="<?php echo base_url();?>assets/js/customJs/payment/payment_tennis.js"></script>

<style type="text/css">
  .frm_header{
    #background-color:#394077;
    #background-color:#394077;
    color:#9f4e7f;
    padding-left: 5px;
    padding-right: 5px;
    border-radius: 3px;
    margin-bottom: 5px;
    font-size: 12px;

  }
  .card-body .modal-body{
    #color: #44423d;
   
  }
  label{
    font-size: 12px;
    color: #354668 !important;
    font-weight: 700;
  }

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
    border: 1px groove #ddd !important;
    #padding: 0 1.4em 1.4em 1.4em !important;
    padding: 0 1em 1em 1em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
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
 .maxwidth{
  max-width: 10.33%;
  margin-left: -16px;
 }    


</style>

              <?php 
              $attr = array("id"=>"tennisPaymentForm","name"=>"tennisPaymentForm");
              echo form_open('',$attr); ?>
<section class="content">
   <div class="container-fluid">
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Receipt</h3>

             <span></span>
            </div><!-- /.card-header -->

            <div class="card-body ">
            <div class="row">
            <div class=" col-md-10"></div>
             <div class=" col-md-2">
           <!--  <span class="frm_header">Code Generation</span> -->
          
           </div>
           </div>
            <fieldset class="scheduler-border"> <legend class="scheduler-border">Student Details</legend>
        <!--    <span class="frm_header">Student Details</span> -->
            <span  class="codegencls" data-toggle="modal" data-target="#codegeneration_modal" id="codegenbtn"><i class="fas fa-cog"></i>&nbsp;Code Generation</span>



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



     
  <fieldset class="scheduler-border"> <legend class="scheduler-border">Payment Details</legend>
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
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="payment_dt" id="payment_dt">
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
                 <div class="col-md-3">
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
                          <div class="col-md-3">
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

            

                 </div>

                 <?php
                      $monthlyQuarter = array(
                                              '1' => 'Apr-Jun',
                                              '2' => 'July-Sep',
                                              '3' => 'Oct-Dec',
                                              '4' => 'Jan-Mar',
                                               );

                 ?>
                 <div id="receivable_dtl">
                  <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="code">Fees Quarter</label>
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" name="fees_quarter" id="fees_quarter"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($monthlyQuarter as $key => $monthlyquarter) {
                              
                               ?>
                               <option value="<?php echo $key;?>"><?php echo $monthlyquarter;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                      </div>
                      <?php         $months = array(
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
                                                );

                     ?>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="code">Fees Month</label>
                            <div class="input-group input-group-sm">
                              <select class="form-control select2" name="fees_month" id="fees_month"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($months as $key => $months) {
                              
                               ?>
                               <option value="<?php echo $key;?>"><?php echo $months;?></option>

                              <?php } ?>
                            
                            </select>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                            <label for="firstname">Fees Year</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="fees_year" name="fees_year" placeholder="" autocomplete="off" value="<?php echo date('Y');?>"   readonly >
                            </div>

                          </div>
                     </div><!-- end of col-md-3 -->
                    
                  </div>
                  </div>


                  <div id="cheque_bank_dtl">
                    <span class="frm_header"><i class="fas fa-angle-right"></i> Cheque In Hand Details</span>
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
                        <fieldset class="scheduler-border"> <legend class="scheduler-border">Amount (Receivable From Student)</legend>
                         <span  class="bg-gradient-warning btn-xs receivableDtl" ><i class="fas fa-cog"></i>&nbsp;Details View</span>
                      <div class="row" >

                      <div class="col-md-1">
                              <div class="form-group">
                                <label for="firstname">Amount</label>
                                  <div class="input-group input-group-sm">
                                <input type="text" class="form-control forminputs " id="receivable_student_amt" name="receivable_student_amt" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" >
                                </div>

                              </div>
                     </div><!-- end of col-md-2 -->

                       <div class="col-md-1">
                              <div class="form-group">
                                <label for="firstname">Fine Amt.</label>
                                  <div class="input-group input-group-sm">
                                <input type="text" class="form-control forminputs " id="receivable_student_fineamt" name="receivable_student_fineamt" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" >
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
                              <div class="input-group input-group-sm">
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
                              <div class="input-group input-group-sm">
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
                       <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">Net Amt.</label>
                              <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="receivable_student_netamt" name="receivable_student_netamt" placeholder="" autocomplete="off" value=""    >
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->

                      <div class="col-md-1">
                          <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                              <div class="input-group input-group-sm">
                            <button type="button" class="btn  bg-gradient-success btn-xs">Clear Fine</button>
                            </div>

                          </div>
                     </div><!-- end of col-md-2 -->
                      
                     
                  





                     </div>


                        </fieldset>
                     </div>




                    <div id="other_recpt_amount_adm">
                     <fieldset class="scheduler-border"> <legend class="scheduler-border">Amount (Other Receipts-Admission)</legend>
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
                  <fieldset class="scheduler-border"> <legend class="scheduler-border">Amount (Other Receipts-Item)</legend>
                   
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


                  <!--    <fieldset class="scheduler-border"> <legend class="scheduler-border">Accounting</legend>
                      <div class="row" >
               
                    </div>


                     </fieldset> -->

                     <p id="error_msg" style="color: #bf2929;"></p>
                      <div class="row">
                      
                      <div class="col-md-5"></div>
                         <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">&nbsp;</label>
             
                         <!--   <button type="button" class="btn btn-block btn-primary" id="create_code">Continue</button> -->
                         

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-block btn-primary btn-sm" id="tennispaymentsavebtn"><?php echo $bodycontent['btnText']; ?></button>
                    
                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i><?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                          </div>
                 </div><!-- end of col-md-2 -->
                      </div>




              
           
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->

</div>
</section>

  <?php echo form_close(); ?>


      <div class="modal fade" id="codegeneration_modal" data-backdrop="static" data-keyboard="false">
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
                  <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">&nbsp;</label>
             
                           <button type="button" class="btn btn-block btn-primary" id="create_code">  Create</button>

                          </div>
                 </div><!-- end of col-md-3 -->

                 </div>
                  <?php echo form_close(); ?>

                <div id="student_adminfo" >
                   <div class="frm_header">Admission Details</div>
                  

                  <form id="stdentregisterForm" name="stdentregisterForm" enctype="multipart/form-data">

           <input type="hidden" name="mode" id="mode" value="ADD">

          <input type="hidden" name="admissionId" id="admissionId" value="">   

  <div class="row">
          <div class="col-sm-9">      

                  <div class="row">
                     
                    <label for="studentcode" class="col-sm-5">Student Code</label>

                    <div class="col-sm-7">
                      <div class="form-group">
                        <div class="input-group input-group-sm">

                            <input type="text" class="form-control" name="studcode" id="studcode" placeholder="" value="" readonly>

                        </div>
              </div>
                    </div>
                  </div>

         

             <div class="row">

                    <label for="studentcode" class="col-sm-4">Name</label>
                    <div class="col-sm-1 maxwidth">
                      <div class="form-group">
                       <div class="input-group input-group-sm">

                       <select class="form-control select2" id="studtitle" name="studtitle" style="width: 100%;">
                    <option value=''>&nbsp; </option>
                    <?php foreach ($bodycontent['titleofneme'] as $value) { ?>

                      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                </div>
                </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                          
                             <input type="text" class="form-control" name="studname" id="studname" placeholder="" value="">


                       
                     </div>
                   </div>

                   <p id="studnameerr"></p>
                      
                    </div>
                  </div>

                  <div class="row">
                    <label for="studdob" class="col-sm-5">Date Of Birth</label>
                    <div class="col-sm-7">
                       <div class="form-group">
                       <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="studdob" id="studdob" im-insert="false" value="">
                          </div>
                    </div>
                   </div>
                  </div>


                  <div class="row">
                    <label for="studfathername" class="col-sm-4">Father's /Mother's Name</label>
                    <div class="col-sm-1 maxwidth">
                      <div class="form-group">
                       <div class="input-group input-group-sm">

                       <select class="form-control select2" id="father_title" name="father_title" style="width: 100%;">
                    <option value=''>&nbsp; </option>
                    <?php foreach ($bodycontent['titleofneme'] as $titleofneme) { ?>

                      <option value="<?php echo $titleofneme; ?>"><?php echo $titleofneme; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                </div>
                </div>
                    </div>
                    <div class="col-sm-7">
                       <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control"  name="fathername" id="fathername"  value="">
                          </div>
                        </div>
                         <p id="fathernameerr"></p>
                    </div>
                  </div>

                  <div class="row">
                    <label for="studdob" class="col-sm-4">Land/Mobile No</label>
                    <div class="col-sm-3">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control onlynumber" name="landline_no" id="landline_no" im-insert="false" value="">
                          </div>
                        </div>
                    </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control onlynumber"  name="mobile_no" id="mobile_no" im-insert="false" value="">
                          </div>
                        </div>
                         <p id="mobilenoerr"></p>
                    </div>
                  </div>

                  </div>
                 <div class="col-sm-3">
                    <div class="form-group">



                    <img src='' id="showimage" style="width: 120px;height:125px;border: 2px solid #6d78cb;margin-left:40px;margin-bottom:13px; ">

                  <div class="inputWrapper" style="width:140px;margin-left: 40px;">

                    <label class="btn  btn-default btn-flat">Upload Photo 
                                             
                      <input class="fileInput "  type='file' custom-file-input name='imagefile' id="imagefile" size='20' onchange="readURL(this);" style="display: none;" accept="image/*">
                     </label>

                    <input type='hidden' name='isImage' id="isImage" value="N">

                      </div>
                    </div>
                   
                 </div>   
       </div> 
                 
                    
                    <div class="row">
                       <label for="studsddress" class="col-sm-3">Address</label>
                      <div class="col-sm-4">
                       <div class="form-group">
                       <div class="input-group input-group-sm">

                        <input type="text" class="form-control "  name="address_one" id="address_one" im-insert="false" value="">
                      </div>
                    </div>
                  </div>
                   <div class="col-sm-4">
                       <div class="form-group">
                       <div class="input-group input-group-sm">

                        <input type="text" class="form-control "  name="address_two" id="address_two" im-insert="false" value="">
                      </div>
                    </div>
                  </div>
                         </div>

                         
                         <div class="row">
                       <label for="studsddress" class="col-sm-3"></label>
                      <div class="col-sm-8">
                       <div class="form-group">
                       <div class="input-group input-group-sm">

                        <input type="text" class="form-control "  name="address_three" id="address_three" im-insert="false" value="">
                      </div>
                    </div>
                  </div>
                         </div>
                                        
                                      

                    <div class="row">
                    <label for="city" class="col-sm-3">City</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control "  name="city" id="city" im-insert="false" value="">
                          </div>
                        </div>
                        <p id="citynameerr"></p>
                    </div>

                    <label for="pincode" class="col-sm-1">Pin</label>
                    <div class="col-sm-3">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            
                            <input type="text" class="form-control onlynumber"  name="pincode" id="pincode" im-insert="false" value="" maxlength='6'>
                          </div>
                        </div>
                         <p id="pincodeerr"></p>
                    </div>
                      
                  </div> 
                   
                   <div class="row">
                    <label for="email" class="col-sm-3">Email Address</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <div class="input-group input-group-sm">
                            
                            <input type="email" class="form-control" name="email" id="email" im-insert="false" value="">
                          </div>
                        </div>
                    </div>

                    <label for="admissiondate" class="col-sm-2">Admission Date</label>
                    <div class="col-sm-2">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="admission_dt" id="admission_dt" im-insert="false" value="">
                          </div>
                        </div>
                         <p id="admissiondterr"></p>
                    </div>
                      
                  </div> 

                  <div class="row">
                    
                  </div> 

                  <div class="row">
                    <label for="email" class="col-sm-3">Category</label>
                    <div class="col-sm-4">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                       <select class="form-control select2" id="category" name="category" style="width: 100%;">
                    <option value=''>Select</option>
                    <?php foreach ($bodycontent['studentcategory'] as $studentcategory) { ?>

                      <option value="<?php echo $studentcategory->category_name; ?>" ><?php echo $studentcategory->category_name; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                          </div>
                        </div>
                        <p id="cateerr" ></p>
                    </div>

                    <label for="email" class="col-sm-1">Status</label>
                    <div class="col-sm-3">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                       <select class="form-control select2" id="status" name="status" style="width: 100%;">
                    <option value=''>Select</option>
                    <?php foreach ($bodycontent['studentstatus'] as $studentstatus) { ?>

                      <option value="<?php echo $studentstatus; ?>"><?php echo $studentstatus; ?></option>
                     
                  <?php   } ?>
                   
                  </select>
                          </div>
                    </div>
                     <p id="statuserr" class="perrmsg"></p>
                  </div>
                      
                  </div>

                   
                  <div class="row">
                    <label for="studdob" class="col-sm-3">Exit Date</label>
                    <div class="col-sm-4">
                       <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="exit_dt" id="exit_dt" im-insert="false" value="">
                          </div>
                    </div>
                  </div>
 



                

          <fieldset class="scheduler-border"> <legend class="scheduler-border">Coaching Details</legend>
            
              <div class="row" style="margin-left: 3.5px;">

               <div class="col-md-4">
                          <div class="form-group ">
                            <label for="playgroup">Playing Group Name</label>
                           
                             <div class="input-group input-group-sm">
                              <select class="form-control select2" name="play_group" id="play_group" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['studentplaygroup'] as $studentplaygroup) { ?>

                              <option value="<?php echo $studentplaygroup->play_group_id; ?>">
                                <?php echo $studentplaygroup->play_group_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                 </div>
                <div class="col-md-3">
                          <div class="form-group">
                            <label for="specialcoching">Special Coaching</label>
                            <div class="input-group input-group-sm">
                               <select class="form-control select2" name="special_coaching" id="special_coaching" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['specialcoching'] as $specialcoching) { ?>

                              <option value="<?php echo $specialcoching; ?>"  >
                                <?php echo $specialcoching; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
               </div>

              
<!-- 
               <div class="col-md-3">
                          <div class="form-group">
                            <label for="openingbal">Opening Balance</label>
                            <div class="input-group input-group-sm">

                               <input type="text" class="form-control" name="opening_balnce" id="opening_balnce" im-insert="false">
                              
                            </div>

                          </div>
               </div> -->
               <div class="col-md-2">
                          <div class="form-group">
                            <label for="specialcoching">Billing Style</label>
                            <div class="input-group input-group-sm">
                               <select class="form-control select2" name="bill_style" id="bill_style" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['billtype'] as $key => $value) { ?>

                              <option value="<?php echo $key; ?>" >
                                <?php echo $value; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                            </div>

                          </div>
                          <p id="billstyleerr" class="perrmsg"></p>
               </div>
               <div class="col-md-3" style="max-width: 24% !important;">
                          <div class="form-group">
                            <label for="openingbal">
                              <span id="billstytext">
                              Monthaly</span> Subscription</label>
                            <div class="input-group input-group-sm">

                               <input type="text" class="form-control numberwithdecimal" name="monthly_sub" id="monthly_sub" im-insert="false" value="">
                              
                            </div>

                          </div>
                               
              </div>

               
                                
              </div>
             
                 
              </fieldset>

               <div class="row">                                  
                     <div class="col-md-5"></div>
                 <div class="col-md-2">
                          <div class="form-group">
                            <label for="eqpname">&nbsp;</label>
             
                         <!--   <button type="button" class="btn btn-block btn-primary" id="create_code">Continue</button> -->
                       

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="admissionsavebtn">Continue</button>
                    
                      <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Saving...</span>
                  </div>
                          </div>
                 </div><!-- end of col-md-2 -->
                  
                </div>

                             
                   </form>



            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>

            
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
              <h5 class="frm_header"></h5>
           
              </button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
            <table>
              <tr>
                <td><button type="button" class="btn btn-block btn-success btn-xs">Print Receipt</button></td>
                <td><button type="button" class="btn btn-block btn-danger btn-xs" data-dismiss="modal" aria-label="Close">Close</button></td>
              </tr>
            </table>
             
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->










