<script src="<?php echo base_url(); ?>assets/js/customJs/report/trialbalanc.js"></script>
<style type="text/css">

</style>
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Trial Balance</h3>             
                           
            </div><!-- /.card-header -->

           
        
            <div class="card-body">
                <div class="formblock-box">
        
            <div id="copy_div">
                <form name="trialbalance" id="trialbalance" >
                <div class="row">
                    <div class="col-md-4">
                        <label for="firstname">From Date</label>
                        <div class="form-group">                              
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="fromdate" id="fromdate" im-insert="false" value="<?php echo $bodycontent['AccountingStart_date']; ?>" >
                            </div>
                        </div>
                   </div>
                    <div class="col-md-4">
                        <label for="firstname">To Date</label>
                        <div class="form-group">                              
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" name="todate" id="todate" im-insert="false" value="<?php echo date('d/m/Y'); ?>" >
                            </div>
                        </div>
                   </div>
               

              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="button" class="btn btn-sm action-button" id="showtrialbalanceJasper">Generate PDF</button>
                            </div>

                          </div>
               
              </div>

     
              
            
             </div>
         
            
             <div class="row">
               <div class="col-md-3">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
               </div>
                 <div class="col-md-5 colmargin">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
             </div>

             </form>
             </div>
           </div>
                     
          </div> <!-- /.card-body -->


     


         



        </div><!-- /.card -->
   </section>



