<script src="<?php echo base_url(); ?>assets/js/customJs/grn/grn.js"></script>
  <section class="layout-box-content-format1">
        <div class="card card-primary">
            

            <div class="card-header box-shdw">
              <h3 class="card-title">Grn Register</h3>
               <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
                  <a href="<?php echo base_url(); ?>goodsreceiptnote/addGrn" class="btn btn-info btnpos">
                  <i class="fas fa-plus"></i> Add </a> 
                </div>
      
       
              <div class="btn-group btn-group-sm float-right" role="group" aria-label="MoreActionButtons" >
              
              </div>
            </div><!-- /.card-header -->

            <div class="card-body">
            <div class="list-search-block">
               <div class="row box"><div class="col-sm-2"></div>
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
                    
                 
                  

                <div class="col-md-2">
                 <button type="button" class="btn btn-block action-button btn-sm" id="grnshowbtn" style="width: 60%;">Show</button>

                   <!-- Total <span class="badge" id="total_amount_value">7</span> -->
               </div>
              </div>

              </div> <!-- End of search block -->


              <div class="formblock-box">
                <div style="text-align: center;display:none;" id="loader">
                   <img src="<?php echo base_url(); ?>assets/img/loader.gif" width="90" height="90" id="gear-loader" style="margin-left: auto;margin-right: auto;"/>
                   <span style="color: #bb6265;">Loading...</span>
               </div>
              <div id="grn_list_data">
              <table class="table customTbl table-bordered table-striped dataTable">
                <thead>
                    <tr>
                    <th>Sl.No</th>
                    <th>GRN No</th>
                    <th>GRN Dt.</th>
                    <th>Challan No</th>
                    <th>Challan Dt.</th>
                    <th>Purchase Order No</th>
                    <th>Purchase Order Date</th>
                    <th>Vendor</th>

                    <th>Action</th>
                                        
                    </tr>
                </thead>
                <tbody>

                <?php 
                $total=0;
                $i=1;
                foreach ($bodycontent['grnList'] as $grnlist) { 
               
                   
                  ?>
                   <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $grnlist->grn_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($grnlist->grn_date)); ?></td>
                   <td><?php echo $grnlist->challan_no; ?></td>
                   <td><?php if($grnlist->challan_date!=''){ echo $grnlist->challan_date;} ?></td>
                   <td><?php echo $grnlist->purchase_order_no; ?></td>
                   <td><?php echo date("d-m-Y", strtotime($grnlist->purchase_order_date)); ?></td>
                
                  
                   <td><?php echo $grnlist->vendor_name; ?></td>
                    <td>
                         <a href="<?php echo base_url(); ?>goodsreceiptnote/addGrn/<?php echo $grnlist->grn_id; ?>" class="btn tbl-action-btn padbtn">
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