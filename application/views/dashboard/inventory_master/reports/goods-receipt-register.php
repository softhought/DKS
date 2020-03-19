<script src="<?php echo base_url(); ?>assets/js/customJs/inventory/reports/gooda_receipt_report.js"></script>
<style type="text/css">

</style>
<section class="layout-box-content-format1">
        <div class="card card-primary">
            <div class="card-header box-shdw">
              <h3 class="card-title">Goods Receipt Report</h3>
               <!-- <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>billgeneratetennis/generatelistbill" class="btn btn-default btnpos">
                   <i class="fas fa-clipboard-list"></i> List </a>
            </div> -->
            <!--  <a href="<?php echo base_url(); ?>intratournament" class="">
              <button class="btn btn-info btnpos">List</button></a>  -->
                           
            </div><!-- /.card-header -->
           <form name="GoodsReceiptForm" id="GoodsReceiptForm" target="_blank">
        
        
            <div class="card-body">
                <div class="formblock-box">
        
            <div id="copy_div">
              
              
             <div class="row">
              <!-- <div class="col-md-1"></div> -->
              <div class="col-md-2"></div>
              <label for="from_date" class="col-md-1">From Date</label>
              <div class="col-md-2">
                
                          <div class="form-group">
                           
                          
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="from_date" id="from_date" value="<?php  echo date("d/m/Y", strtotime($bodycontent['from_dt'])); ?>" readonly>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-1"></div>
                        <label for="to_date" class="col-md-1">To Date</label>
                        <div class="col-md-2">
                          <div class="form-group">
                           
                         
                          <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="to_date" id="to_date" value="<?php  echo date("d/m/Y", strtotime($bodycontent['to_dt'])); ?>" readonly>
                          </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-2">
                          <input type="hidden" name="selectvendor" id="selectvendor" value="">
                        </div>               

                 <div class="col-md-7" >
                 <table class="table customTbl table-bordered table-striped dataTable purchtab">

                 <thead>
                 <tr>
                 
                 <th>Vendor</th>
                 <th align="center" style="width:110px;">
                 <input type="checkbox" class="rowCheckAll" name="rowCheckAll" id="rowCheckAll" value="Y" > Select All</th>
                 </tr>
                 </thead>
                 <tbody>
                     <?php $row = 1;
                     foreach($bodycontent['venderList'] as $venderList){ ?>
                      <tr>                      
                      <td><?php echo $venderList->vendor_name; ?></td>
                      <td align="center">
                  <input type="hidden" name="vendorid_<?php echo $row;?>" id="vendorid_<?php echo $row;?>" value="<?php echo $venderList->vendor_id;?>" >
                  <input type="checkbox" class="rowCheck" name="rowCheck[]" id="rowCheck_<?php echo $row;?>" value="<?php echo $row;?>" >
                  </td>
                
                      </tr>

                     <?php $row++; } ?>
                 </tbody>

                 </table>
                         
               </div> 
               </div>
               <div class="row">              
               <div class="col-md-5"> <p id="errormsg" class="errormsgcolor"></p></div>
              <div class="col-md-2">
                 <div class="form-group">
                            <label for="specialcoching">&nbsp;</label>
                            <div class="input-group input-group-sm">
                           <button type="submit" class="btn btn-sm action-button
                           " id="goodsreceiptprint">View Report</button>
                            </div>

                          </div>
               
              </div>

     
              
            
             </div>
         
            
             <!-- <div class="row">
               <div class="col-md-3">
               <p id="response_msg" style="font-weight: bold;color:#7d6060;"></p>
               </div>
                 <div class="col-md-5 colmargin">
                    <p id="errormsg" class="errormsgcolor"></p>
                 </div>
               
             </div> -->
            
           



             </div>
           </div>
                     
          </div> <!-- /.card-body -->
        

       <!--  <hr> -->

        <div id="student_list" style="padding: 5px;">
          
        </div>

     </form>


         



        </div><!-- /.card -->
   </section>



