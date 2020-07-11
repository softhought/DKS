<script src="<?php echo base_url(); ?>assets/js/customJs/daily_balance/daily_balance.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
 <style> 
         
            @media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
        </style>             
            
       <form name="gstDefaulterFrom" id="gstDefaulterFrom" method="post" action="<?php echo base_url(); ?>gstdefaulter/print_notice"  target="_blank">

            <div class="card-header box-shdw">
              <h3 class="card-title">GST Daily Balance</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>dailybalance/addDailybalance" class="btn btn-default btnpos">
                   <i class="fas fa-plus"></i> Add </a> 
                </div>
      
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">

            <div class="list-search-block">
 <fieldset class="scheduler-border formblock-box">
               <div class="row">
               <div class="col-sm-12">
               <div class="row">

         

                      <div class="col-sm-2">
                       <div class="form-group">
                         <label for="specialcoching">From Date</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="from_dt" id="from_dt" im-insert="false" value="<?php echo date('d/m/Y')?>" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>

                        <div class="col-sm-2">
                       <div class="form-group">
                         <label for="specialcoching">To Date</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="to_dt" id="to_dt" im-insert="false" value="<?php echo date('d/m/Y')?>" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>  
                    
               
               

                     
                  
                <div class="col-md-2" >
                          <div class="form-group">
                            <label for="specialcoching">Member </label>
                            <div class="input-group input-group-sm" id="member_drp">
                              <select class="form-control select2" name="sel_member_code" id="sel_member_code" >
                              <option value="">Select</option>
                              <?php foreach ($bodycontent['memberList'] as $memberlist) { ?>
                              <option value="<?php echo $memberlist->member_id; ?>"
                                 data-name="<?php echo $memberlist->title_one." ".$memberlist->member_name; ?>"
                                >
                              <?php echo $memberlist->member_code; ?></option>
                              <?php } ?>                             
                            </select>
                            </div>
                          </div>    
               </div>
                  <div class="col-md-2" >
                 <div class="form-group">
                            <label for="firstname">Name</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="member_name" name="member_name" placeholder="" autocomplete="off" value="" readonly    >
                            </div>
                          </div>
                        </div>


              <div class="col-sm-2">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="dailybalancehowbtn" style="width: 60%;">Show</button>
                            </div>
                          </div>
              </div>
      

              </div>


              </div>

           

 </fieldset>



              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="memberbill_list_data" style="max-height: 400px;overflow-y:scroll;" >
             
              </div>

              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>
  </from>