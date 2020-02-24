

<script src="<?php echo base_url(); ?>assets/js/customJs/party/partybooking.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/calender/fullcalendar.min.css">
<script src="<?php echo base_url(); ?>assets/calender/fullcalendar.min.js"></script>
<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Calender</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>partybooking/addeditpartybooking" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a>
            </div> -->
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
            <div class="formblock-box">
             <div class="row"> 
                               
                 <div class="col-sm-3">   
                         <label for="location">Location</label>               
                      
                         <div class="form-group">
                           <div class="input-group input-group-sm">
                            
                              <select class="form-control select2" name="location" id="location"  style="width: 100%;">
                                    <!-- <option value="All">Select</option> -->
                                    <?php
                                    foreach ($bodycontent['locationlist'] as $locationlist) {
                                    ?>
                                    <option value="<?php echo $locationlist->id;?>"><?php echo $locationlist->location_name; ?></option>
                                    <?php } ?>
                                 </select>
                                 
                              </div>
                              </div>
                              <button type="button" class="btn btn-block action-button btn-sm" id="datebooking">Show</button>  
                      
                 </div>
                      <div class="col-sm-7 calcol">
                         <div id="calender" class="first" data-cla = ></div>
                      </div>
                   </div>   

           
</div>
        

             

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>