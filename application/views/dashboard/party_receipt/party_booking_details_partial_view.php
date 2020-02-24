
  <h3 class="form-block-subtitle"><i class="fas fa-angle-double-right"></i> Party Booking Details </h3>

<div class="row">
<div class="col-md-1"></div>
<div class="col-md-2">
                      <div class="form-group">
                            <label for="firstname">Booking Date</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="booking_date" name="booking_date" placeholder="" autocomplete="off" value="<?php echo date("d/m/Y", strtotime($partyBookingData->booking_date)) ?>" readonly    >
                            </div>

                          </div>
                   
    </div>

     <div class="col-md-2">
                      <div class="form-group">
                            <label for="firstname">Party Date</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="party_date" name="party_date" placeholder="" autocomplete="off" value="<?php echo date("d/m/Y", strtotime($partyBookingData->party_date)) ?>" readonly    >
                            </div>

                          </div>
                   
    </div>


     <div class="col-md-2">
                      <div class="form-group">
                            <label for="firstname">Time</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="timeslot" name="timeslot" placeholder="" autocomplete="off" value="<?php echo $partyBookingData->time_slot; ?>" readonly    >
                            </div>

                          </div>
                   
     </div>

       <div class="col-md-1">
                      <div class="form-group">
                            <label for="firstname">Heads</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="head" name="head" placeholder="" autocomplete="off" value="<?php echo $partyBookingData->heads; ?>" readonly    >
                            </div>

                          </div>
                   
     </div>  


       <div class="col-md-2">
                      <div class="form-group">
                            <label for="firstname">Location</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="loc" name="loc" placeholder="" autocomplete="off" value="<?php echo $partyBookingData->location_name; ?>" readonly    >
                            </div>

                          </div>
                   
     </div>         
	
</div>
