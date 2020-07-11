<script src="<?php echo base_url(); ?>assets/js/customJs/bill/member_bill_generate.js"></script>
<style type="text/css">
  .table td, .table th {
    padding: .01rem;
    
}
</style>

  <section class="layout-box-content-format1">
        <div class="card card-primary">
            
            <!-- <div class="list-summary">
              <div class="row summary-box-container">

                <div class="col-md-9  bg-3">
                
                </div>
                <div class="col-md-3 summary-box bg-4">
                  <div class="row">
                    <div class="col-md-3 align-vh-center">
                      <i class="fab fa-algolia"></i>
                    </div>
                    <div class="col-md-9">
                      <h3>Total Amount</h3>
                      <h4><span  id="total_amount_value"></span></h4>
                    </div>
                  </div>
                </div>
                
              </div>
            </div> -->


            <div class="card-header box-shdw">
              <h3 class="card-title">BILL Register</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>memberbillgenerate/addBill" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a>
                </div> -->
      
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box">


                    <label for="student" class="col-sm-1">Member Code</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="sel_member" id="sel_member"  style="width: 100%;">
                              <option value="">Select</option>
                              <?php
                              foreach ($bodycontent['memberList'] as $memberlist) {
                              ?>
                              <option value="<?php echo $memberlist->member_id;?>"><?php echo $memberlist->member_code?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>

                    <label for="student" class="col-sm-1">Month</label>

                           <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                     <select class="form-control select2" name="month" id="month" >
                             <!--  <option value="">Select</option> -->
                              <?php foreach ($bodycontent['monthList'] as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"
                                >
                                <?php echo $value->short_name; ?></option>
                               
                              <?php } ?>
                                                           
                            </select>
                          </div>
                        </div>
                        <p id="studenterr" ></p>
                    </div>

               




                <div class="col-md-1">
                 <button type="button" class="btn btn-block action-button btn-sm" id="membermonthbillshowbtn">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
               <!-- <div class="col-md-1">
                 <button type="button" class="btn btn-block action-button btn-sm" id="multiplebillprint">Print</button>

                   Total <span class="badge" id="total_amount_value">7</span> -->
               <!-- </div>  -->
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="membermonthbill_list_data">
              <table id="mmemexample" class="table customTbl table-bordered table-striped">
                <thead>
                    <tr>
                    <th style="width:55px;">Sl.No</th>
                    <th style="width:100px;">Bill No.</th>
                    <th style="width:100px;">Bill dt.</th>
                    <th style="width:100px;">Member Code</th>
                    <th style="width:150px;">Member Name</th>
                    <th style="width:70px;">Month</th>
                    <th style="width:100px;">Opening Bal.</th>
                    <th style="width:100px;">Monthly Sub</th>
                    <th style="width:100px;">Bar Amt.</th>
                    <th style="width:100px;">Bar GST</th>
                    <th style="width:100px;">Canteen Amt.</th>
                    <th style="width:100px;">Canteen GST</th>
                    <th style="width:100px;">Swimming</th>
                    <th style="width:100px;">GYM</th>
                    <th style="width:120px;">Locker Charges</th>
                    <th style="width:130px;">Hard Court Extra</th>
                    <th style="width:110px;">Guest Charges</th>
                    <th style="width:110px;">Towel Charges</th>
                    <th style="width:110px;">Benvolent Fund</th>
                    <th style="width:130px;">Fixed Hard Court</th>
                    <th style="width:90px;">Card Play</th>
                    <th style="width:120px;">Devlopment Chrg.</th>
                    <th style="width:110px;">Puja Contribution</th>
                    <th style="width:70px;">Corrections</th>
                    <th style="width:90px;">Receipts Amt.</th>
                    <th style="width:100px;">Min Bill Amt.</th>
                    <th style="width:140px;">GST On Outgoing Chrg.</th>
                    <th style="width:130px;">Outstanding Amt.</th>
                  
          
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['billList'] as $billlist) { 
                  if ($billlist->net_amount!='') {
                   $total+=$billlist->net_amount;
                  }
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $billlist->member_bill_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($billlist->bill_date)); ?></td>
                   <td><?php echo $billlist->member_code; ?></td>
                   <td><?php echo $billlist->member_name; ?></td>
                   <td><?php echo $billlist->month_name; ?></td>
                   <td align="right"><?php echo $billlist->month_open; ?></td>
                   <td align="right"><?php echo $billlist->month_subs; ?></td>
                   <td align="right"><?php echo $billlist->bar_amount; ?></td>
                   <td align="right"><?php echo $billlist->bar_cgst + $billlist->bar_sgst; ?></td>
                   <td align="right"><?php echo $billlist->cat_amount; ?></td>
                   <td align="right"><?php echo $billlist->cat_cgst + $billlist->cat_sgst; ?></td>
                   <td align="right"><?php echo $billlist->swimming; ?></td>
                   <td align="right"><?php echo $billlist->gym; ?></td>
                   <td align="right"><?php echo $billlist->locker_charge; ?></td>
                   <td align="right"><?php echo $billlist->hard_court_extra; ?></td>
                   <td align="right"><?php echo $billlist->guest_charge; ?></td>
                   <td align="right"><?php echo $billlist->towel_charge; ?></td>
                   <td align="right"><?php echo $billlist->ben_fund; ?></td>
                   <td align="right"><?php echo $billlist->fixed_hard; ?></td>
                   <td align="right"><?php echo $billlist->card_play; ?></td>
                   <td align="right"><?php echo $billlist->development_charge; ?></td>
                   <td align="right"><?php echo $billlist->puja_contribution; ?></td>
                   <td align="right"><?php echo $billlist->corrections; ?></td>
                   <td align="right"><?php echo $billlist->receipt_amt; ?></td>
                   <td align="right"><?php echo $billlist->min_bill_amt; ?></td>
                   <td align="right"><?php echo $billlist->outgoing_cgst + $billlist->outgoing_sgst; ?></td>
                   <td align="right"><?php echo $billlist->net_amount; ?></td>
                
                 
                   
                  

               
                
               
                 


                 </tr>
                <?php } ?>                       
                         
                </tbody>
                <tfoot>
            <tr>
                <th colspan="6">Total&nbsp;:<br>&nbsp;Net Amt&nbsp;:</th>
                 <!-- <th></th>
                <th></th>
                <th></th>
                <th></th> 
                 <th></th> -->
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
              </table>
              <input type="hidden" name="total_amt" id="total_amt" value="<?php echo number_format($total,2);?>">
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>



    <div id="billModalDetails" class="modal fade customModal format1 right"  data-keyboard="false" data-backdrop="false">
  <div class="modal-dialog modal-xs" style="width: 350px;margin-top: 90px;">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, #A60711 0%,#4E3FFB 100%);background-color: rgba(0, 0, 0, 0);
padding: 5px;color: #fff;">
       <h4 class="frm_header">Bill Details</h4>
        <button type="button" class="close" data-dismiss="modal"  >&times;<span class="sr-only">Close</span></button>
       
      </div>
      <div class="modal-body" style="height: 450px;
    overflow-y: auto;">
        <div id="bill_details_data"></div>
      </div>
    </div>
  </div>
</div>
