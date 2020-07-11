<script src="<?php echo base_url(); ?>assets/js/customJs/block_unblock_register/block_unblock_register.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
 <style> 
         
            @media print { 
               .noprint { 
                  visibility: hidden; 
               } 
            } 
        </style>             
            
       <form name="blockunblockFrom" id="blockunblockFrom" method="post" action="<?php echo base_url(); ?>blockunblockregister/print_blockunblock"  target="_blank">

            <div class="card-header box-shdw">
              <h3 class="card-title">Block/Unblock Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                 
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

         

               

                   <div class="col-md-2" >
                 <div class="form-group">
                            <label for="firstname">Member Code Starting with</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="member_start_letter" name="member_start_letter" placeholder="" autocomplete="off" value="" maxlength="1" style="text-transform: capitalize;"   >
                            </div>
                          </div>
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

                  <div class="col-md-2" >
                          <div class="form-group">
                            <label for="specialcoching">Block/Unblock </label>
                            <div class="input-group input-group-sm" id="member_drp">
                              <select class="form-control select2" name="sel_block_unblock" id="sel_block_unblock" >
                              <option value="">Select</option>
                              <option value="Y">Block</option>
                              <option value="N">Unblock</option>
                              
                                                       
                            </select>
                            </div>
                          </div>    
               </div>  

                <div class="col-md-2" >
                 <div class="form-group">
                            <label for="firstname">&#60;Balance</label>
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control forminputs " id="balance" name="balance" placeholder="" autocomplete="off" value="" onKeyUp="numericFilter(this);" >
                            </div>
                          </div>
                  </div>        


              <div class="col-sm-2">
                     <div class="form-group">
                            <label for="firstname">&nbsp;</label>
                            <div class="input-group input-group-sm">
                              <button type="button" class="btn btn-block action-button btn-sm noprint" id="blockunblockshowbtn" style="width: 60%;">Show</button>
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
              <div id="member_list_data"  >
             
              </div>
            
              </div>
             
            </div><!-- /.card-body -->
        </div><!-- /.card -->
  </section>
  </from>