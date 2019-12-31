<script src="<?php echo base_url();?>assets/js/customJs/voucher/voucher.js"></script>

<style type="text/css">
  label{
    font-size: 12px;
    color: #354668 !important;
    font-weight: 700;
  }
#voucherlistTable{
   font-size: 12px;
}
</style>


<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Voucher List</h3>
              
            </div><!-- /.card-header -->

            <div class="card-body">
              <?php 
              $attr = array("id"=>"tennisPaymentForm","name"=>"tennisPaymentForm");
              echo form_open('',$attr); ?>
              
               <input type="hidden" name="startyear" id="startyear" value="2019"/>
               <input type="hidden" name="endyear" id="endyear" value="2020"/>
             <div class="row">
             <div class="col-md-1"></div>
         <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">From Date</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs datepicker" id="fromdate" name="fromdate" placeholder="" autocomplete="off" value="<?php echo date("d/m/Y", strtotime($bodycontent['fiscalStartDt']));?>"   readonly >
                            </div>

                          </div>
               </div><!-- end of col-md-3 -->
                   <div class="col-md-2">
                          <div class="form-group">
                            <label for="firstname">To Date</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs datepicker" id="todate" name="todate" placeholder="" autocomplete="off" value="<?php echo date("d/m/Y", strtotime($bodycontent['fiscalEndDt']));?>"   readonly >
                            </div>

                          </div>
               </div><!-- end of col-md-3 -->
                 <div class="col-md-2">
                          <div class="form-group ">
                            <label for="code">Transaction Type  </label>
                            <div id="resetstudentlist">
                             <div class="input-group input-group-sm" id="purchasetypeerr">
                              <select class="form-control select2" name="purchasetype" id="purchasetype" >
                              <option value="ALL">Select</option>
                            <?php 
                              $Transaction_opt = json_decode (TRANSATION_TYPE);
                              foreach($Transaction_opt as $key=>$transaction){ ?>
                                <option value="<?php echo $key; ?>"><?php echo $transaction; ?></option>
                            <?php
                              }
                            ?>
                             
                            </select>
                            </div></div>

                          </div>
                 </div><!-- end of col-md-3 -->
               <div class="col-md-3">
                          <div class="form-group ">
                            <label for="code">Account </label>
                            <div id="resetstudentlist">
                             <div class="input-group input-group-sm" id="accounterr">
                              <select class="form-control select2" name="account" id="account" >
                              <option value="0">Select</option>
                              <?php 
                              foreach ($bodycontent['accountList'] as  $accountlist) {
                                
                              ?>
                              <option value="<?php echo $accountlist->account_id;?>"
                            

                              ><?php echo $accountlist->account_name;?></option>
                              <?php } ?>
                             
                            </select>
                            </div></div>

                          </div>
                 </div><!-- end of col-md-3 -->

                    <div class="col-md-">
                          <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-md">
                            <button type="submit" class="btn btn-block btn-primary btn-sm" id="showvoucherlist">Show</button>
                            </div>

                          </div>
               </div><!-- end of col-md-3 -->

              
                

                
                
              </div>
               <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
               <div id="voucherlistdata">
                   
               </div>
           
         
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div><!-- /.row -->