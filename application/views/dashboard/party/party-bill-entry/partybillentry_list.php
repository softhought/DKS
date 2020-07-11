<script src="<?php echo base_url(); ?>assets/js/customJs/party/partybooking.js"></script>
<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Party Bill Entry List</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>partybillentry/addPartyBillEntry" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div>
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
             
            <!-- <div class="list-search-block">
               <div class="row box">
                  <label for="from_dt" class="col-sm-1">From Date</label>
                    <div class="col-sm-2">
                       <div class="form-group">
                         <div class="input-group input-group-sm">
                           <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="from_dt" id="from_dt" im-insert="false" value="<?php echo date("d/m/Y", strtotime($bodycontent['accountingyear']->start_date)); ?>" readonly>
                          </div>
                        </div>
                        <p id="fromdaterr" style="font-size: 12px;"></p>
                    </div>
                    <label for="to_date" class="col-sm-1">To Date</label>
                    <div class="col-sm-2">
                       <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="to_date" id="to_date" im-insert="false" value="<?php echo date("d/m/Y", strtotime($bodycontent['accountingyear']->end_date)); ?>" readonly>
                          </div>
                        </div>
                         <p id="todateerr" style="font-size: 12px;"></p>
                    </div>
                    
                    <label for="timeslot" class="col-sm-1">Time Slot</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="timeslot" id="timeslot"  style="width: 100%;">
                              <option value="All">Select</option>
                              <?php
                              foreach ($bodycontent['timeslotlist'] as $timeslotlist) {
                              ?>
                              <option value="<?php echo $timeslotlist;?>"><?php echo $timeslotlist; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        
                    </div> 
                    <label for="location" class="col-sm-1">Location</label>
                    <div class="col-sm-2">
                      <div class="form-group">
                       <div class="input-group input-group-sm">
                            
                        <select class="form-control select2" name="location" id="location"  style="width: 100%;">
                              <option value="All">Select</option>
                              <?php
                              foreach ($bodycontent['locationlist'] as $locationlist) {
                              ?>
                              <option value="<?php echo $locationlist->id;?>"><?php echo $locationlist->location_name; ?></option>
                              <?php } ?>
                            </select>
                           
                          </div>
                        </div>
                       
               </div>
               <button type="button" class="btn btn-block action-button btn-sm" id="bookingshowbtn" style="width:5%;height: min-content;">Show</button>

              </div>



              </div> End of search block -->


              <div class="formblock-box">
              <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>

               <div id="partybilllistid">
                <table class="table customTbl table-bordered table-hover dataTable tablepad">
                  <thead>
                      <tr>
                      <th>Sl.No</th>
                      <th>Bill No.</th>
                      <th>Bill Date</th>
                      <th>Vendor Name</th>
                      <th>Bill Amount</th>                      
                      <th>Action</th>
                                          
                      </tr>
                  </thead>
                  <tbody>

                  <?php $i=1;
                  foreach ($bodycontent['partybillentrylist'] as $partybillentrylist) { ?>
                    <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $partybillentrylist->bill_no; ?></td>                    
                    <td><?php if($partybillentrylist->bill_date != ''){
                            echo date('d/m/Y',strtotime($partybillentrylist->bill_date));
                    } ?></td>
                    <td><?php echo $partybillentrylist->vendor_name; ?></td>                   
                    <td><?php echo $partybillentrylist->bill_amount; ?></td>
                   
                    
                    <td>
                      <a href="<?php echo base_url(); ?>partybillentry/addPartyBillEntry/<?php echo $partybillentrylist->bill_id; ?>" class="btn tbl-action-btn padbtn">
                    <i class="fas fa-edit"></i> 
                  </a>

                   
                      
                    </td>


                  </tr>
                  <?php } ?>                       
                          
                  </tbody>
                </table>
              </div>  
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>