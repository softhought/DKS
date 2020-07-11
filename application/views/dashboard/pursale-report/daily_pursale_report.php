<script src="<?php echo base_url(); ?>assets/js/customJs/dailypursalereport/dailypursalereport.js"></script>
<section class="layout-box-content-format1">

        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Daily Purchase/Sale Report</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              <a href="<?php echo base_url(); ?>salentryissue/addeditsaleissuse" class="btn btn-default btnpos">
               <i class="fas fa-plus"></i> Add </a> 
            </div>-->
             
              
            </div><!-- /.card-header -->
           
            <div class="card-body">
           
              <div class="formblock-box">
                    <div class="row">
                            <div class="col-md-3">
                                <label>Select Mode</label>
                                <div class="form-group">
                                        <div class="input-group input-group-sm" >
                                        <select class="form-control select2" id="selmode" name="selmode" style="width: 100%;">
                                        <!-- <option value=''>Select</option> -->
                                        <?php foreach ($bodycontent['modelist'] as  $modelist) { ?>

                                            <option value="<?php echo $modelist; ?>"                            

                                            ><?php echo $modelist; ?></option>
                                        
                                        <?php   } ?>
                                        
                                        </select>
                                        
                                        </div>
                                    </div>
                            
                                    </div>
                           
                            <div class="col-sm-2">
                            <label for="from_dt">From Date</label>
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
                           
                            <div class="col-sm-2">
                            <label for="to_date">To Date</label>
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
                            <div class="col-sm-1">
                             <label for="to_date">&nbsp;</label>
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                            <button type="button" class="btn btn-block action-button btn-sm" id="reprtviewbtn" >View</button>
                               </div>
                             </div>
                            </div>

                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                    <div style="text-align: center;display:none;" id="loader">
                            <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                            <span style="color: #bb6265;">Loading...</span>
                    </div>
                    <div id="report">   </div>
                    </div>
                 </div>
                </tbody>
              </table> 
            </div>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
   </section>